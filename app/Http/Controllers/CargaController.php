<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Docente;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class CargaController extends Controller
{
    /** Listado */
    public function index()
    {
        $cargas = Carga::with(['docente', 'curso'])
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.carga.index', compact('cargas'));
    }

    /** Form de creación */
    public function create()
    {
        $docentes = Docente::orderBy('apellidos')->orderBy('nombres')
            ->get(['id', 'nombres', 'apellidos']);

        // Cursos con disponibilidad calculada
        $cursos = Curso::leftJoin('cargas', 'cargas.curso_id', '=', 'cursos.id')
            ->groupBy('cursos.id', 'cursos.nombre', 'cursos.ciclo', 'cursos.horas_t', 'cursos.horas_p', 'cursos.n_grupos', 'cursos.created_at', 'cursos.updated_at')
            ->orderBy('cursos.nombre')
            ->get([
                'cursos.*',
                DB::raw('COALESCE(SUM(cargas.grupos_asignados),0) AS cargas_sum_grupos'),
                DB::raw('COALESCE(SUM(cargas.horas_t_carga),0) AS cargas_sum_horas_t'),
            ])->map(function ($c) {
                $c->grupos_disponibles = max(0, $c->n_grupos - $c->cargas_sum_grupos);
                $c->horas_t_disponibles = max(0, $c->horas_t - $c->cargas_sum_horas_t);
                return $c;
            });

        return view('admin.carga.create', compact('docentes', 'cursos'));
    }

    /** Guardar */
    public function store(Request $request)
    {
        $data = $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'curso_id' => 'required|exists:cursos,id',
            'grupos_asignados' => 'required|integer|min:0',
            'horas_t_carga' => 'required|integer|min:0',
            'observaciones' => 'nullable|string|max:255',
        ]);

        // Validación amable en app (además de los triggers):
        $curso = Curso::findOrFail($data['curso_id']);
        $acum = Carga::selectRaw('COALESCE(SUM(grupos_asignados),0) sum_g, COALESCE(SUM(horas_t_carga),0) sum_t')
            ->where('curso_id', $curso->id)->first();
        $dispG = max(0, $curso->n_grupos - $acum->sum_g);
        $dispT = max(0, $curso->horas_t - $acum->sum_t);

        if ($data['grupos_asignados'] > $dispG) {
            return back()->withErrors(['grupos_asignados' => "No hay grupos suficientes. Restantes: $dispG"])
                ->withInput();
        }
        if ($data['horas_t_carga'] > $dispT) {
            return back()->withErrors(['horas_t_carga' => "No hay horas teóricas disponibles. Restantes: $dispT"])
                ->withInput();
        }

        try {
            Carga::create($data);
        } catch (QueryException $e) {
            // 23000: unique / FK; 45000: señales de triggers
            if ($e->getCode() === '23000' && str_contains($e->getMessage(), 'uniq_carga')) {
                return back()->withErrors(['docente_id' => 'Este docente ya tiene asignación para este curso.'])->withInput();
            }
            return back()->withErrors(['general' => 'No se pudo registrar: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('admin.cargas.index')
            ->with('mensaje', 'Carga registrada correctamente')
            ->with('icono', 'success');
    }

    /** Ver detalle */
    // app/Http/Controllers/CargaController.php
    public function show($id)
    {
        // Carga las relaciones necesarias
        $carga = Carga::with([
            'docente:id,nombres,apellidos,dni,celular',
            'curso:id,nombre,ciclo,horas_t,horas_p'
        ])->findOrFail($id);

        // Calcula por si no están persistidas
        $hp = $carga->horas_p_carga ?? ($carga->grupos_asignados * ($carga->curso->horas_p ?? 0));
        $total = $carga->total_horas ?? ($hp + ($carga->horas_t_carga ?? 0));

        return view('admin.carga.show', compact('carga', 'hp', 'total'));
    }

    public function edit($id)
    {
        $carga = Carga::with(['docente', 'curso'])->findOrFail($id);

        $docentes = Docente::orderBy('apellidos')->orderBy('nombres')->get();

        // Sumas con alias (compatible con todas las versiones recientes)
        $cursos = Curso::withSum('cargas as cargas_sum_grupos', 'grupos_asignados')
            ->withSum('cargas as cargas_sum_horas_t', 'horas_t_carga')
            ->orderBy('nombre')
            ->get();

        // (opcional) calcula disponibilidad para mostrar en el <select>
        foreach ($cursos as $c) {
            $c->grupos_disponibles = max(0, (int) $c->n_grupos - (int) ($c->cargas_sum_grupos ?? 0));
            $c->horas_t_disponibles = max(0, (int) $c->horas_t - (int) ($c->cargas_sum_horas_t ?? 0));
        }

        return view('admin.carga.edit', compact('carga', 'docentes', 'cursos'));
    }

    /** Actualizar */
    public function update(Request $request, Carga $carga)
    {
        $data = $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'curso_id' => 'required|exists:cursos,id',
            'grupos_asignados' => 'required|integer|min:0',
            'horas_t_carga' => 'required|integer|min:0',
            'observaciones' => 'nullable|string|max:255',
        ]);

        // Disponibilidad excluyendo la propia carga
        $curso = Curso::findOrFail($data['curso_id']);
        $acum = Carga::where('curso_id', $curso->id)
            ->where('id', '<>', $carga->id)
            ->selectRaw('COALESCE(SUM(grupos_asignados),0) sum_g, COALESCE(SUM(horas_t_carga),0) sum_t')
            ->first();
        $dispG = max(0, $curso->n_grupos - $acum->sum_g);
        $dispT = max(0, $curso->horas_t - $acum->sum_t);

        if ($data['grupos_asignados'] > $dispG) {
            return back()->withErrors(['grupos_asignados' => "No hay grupos suficientes. Restantes: $dispG"])
                ->withInput();
        }
        if ($data['horas_t_carga'] > $dispT) {
            return back()->withErrors(['horas_t_carga' => "No hay horas teóricas disponibles. Restantes: $dispT"])
                ->withInput();
        }

        try {
            $carga->update($data);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000' && str_contains($e->getMessage(), 'uniq_carga')) {
                return back()->withErrors(['docente_id' => 'Este docente ya tiene asignación para este curso.'])->withInput();
            }
            return back()->withErrors(['general' => 'No se pudo actualizar: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('admin.cargas.index')
            ->with('mensaje', 'Carga actualizada correctamente')
            ->with('icono', 'success');
    }

    /** Eliminar */
    public function destroy($id)
    {

        $carga = Carga::with(['docente', 'curso'])->findOrFail($id);

        $carga->delete();

        return redirect()->route('admin.cargas.index')
            ->with('mensaje', 'Carga eliminada correctamente')
            ->with('icono', 'success');
    }

    public function confirmDelete($id)
    {
        $carga = Carga::with(['docente', 'curso'])->findOrFail($id);
        return view('admin.carga.delete', compact('carga'));
    }
}
