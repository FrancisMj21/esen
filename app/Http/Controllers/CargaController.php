<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Docente;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargaController extends Controller
{
    // Listado de cargas
    public function index()
    {
        $cargas = Carga::with(['docente', 'curso'])
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.carga.index', compact('cargas'));
    }

    // Formulario de creación de carga
    public function create()
    {
        $docentes = Docente::orderBy('apellidos')->orderBy('nombres')
            ->get(['id', 'nombres', 'apellidos']);

        // Cursos con disponibilidad calculada
        $cursos = Curso::leftJoin('cargas', 'cargas.curso_id', '=', 'cursos.id')
            ->groupBy('cursos.id', 'cursos.nombre', 'cursos.ciclo', 'cursos.horas_t', 'cursos.horas_p', 'cursos.n_grupos')
            ->orderBy('cursos.nombre')
            ->get([
                'cursos.*',
                DB::raw('COALESCE(SUM(cargas.grupos_asignados), 0) AS cargas_sum_grupos'),
                DB::raw('COALESCE(SUM(cargas.horas_t_carga), 0) AS cargas_sum_horas_t'),
            ])->map(function ($c) {
                $c->grupos_disponibles = max(0, $c->n_grupos - $c->cargas_sum_grupos);
                $c->horas_t_disponibles = max(0, $c->horas_t - $c->cargas_sum_horas_t);
                return $c;
            });

        return view('admin.carga.create', compact('docentes', 'cursos'));
    }

    // Almacenar carga académica
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $data = $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'curso_id' => 'required|exists:cursos,id',
            'grupos_asignados' => 'required|integer|min:0',
            'horas_t_carga' => 'required|integer|min:0',
            'observaciones' => 'nullable|string|max:255',
        ]);

        // Buscar el curso
        $curso = Curso::findOrFail($data['curso_id']);

        // Calcular la disponibilidad de grupos y horas
        $acum = Carga::selectRaw('COALESCE(SUM(grupos_asignados), 0) sum_g, COALESCE(SUM(horas_t_carga), 0) sum_t')
            ->where('curso_id', $curso->id)
            ->first();

        $dispG = max(0, $curso->n_grupos - $acum->sum_g);
        $dispT = max(0, $curso->horas_t - $acum->sum_t);

        // Verificar que haya suficiente disponibilidad
        if ($data['grupos_asignados'] > $dispG) {
            return back()->withErrors(['grupos_asignados' => "No hay grupos suficientes. Restantes: $dispG"])->withInput();
        }

        if ($data['horas_t_carga'] > $dispT) {
            return back()->withErrors(['horas_t_carga' => "No hay horas teóricas disponibles. Restantes: $dispT"])->withInput();
        }

        // Calcular las horas prácticas (horas por grupo multiplicadas por el número de grupos asignados)
        $horas_p_carga = $data['grupos_asignados'] * $curso->horas_p;

        $total_horas = $data['horas_t_carga'] + $horas_p_carga;

        // Registrar la carga académica con el valor calculado de horas prácticas
        Carga::create([
            'docente_id' => $data['docente_id'],
            'curso_id' => $data['curso_id'],
            'grupos_asignados' => $data['grupos_asignados'],
            'horas_t_carga' => $data['horas_t_carga'],
            'horas_p_carga' => $horas_p_carga, // Agregar el valor calculado
            'total_horas' => $total_horas,
            'observaciones' => $data['observaciones'] ?? null,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.cargas.index')
            ->with('mensaje', 'Carga registrada correctamente')
            ->with('icono', 'success');
    }



    // Ver detalles de una carga
    public function show($id)
    {
        $carga = Carga::with(['docente:id,nombres,apellidos,dni,celular', 'curso:id,nombre,ciclo,horas_t,horas_p'])
            ->findOrFail($id);

        $hp = $carga->horas_p_carga ?? ($carga->grupos_asignados * ($carga->curso->horas_p ?? 0));
        $total = $carga->total_horas ?? ($hp + ($carga->horas_t_carga ?? 0));

        return view('admin.carga.show', compact('carga', 'hp', 'total'));
    }

    // Editar carga académica
    public function edit($id)
    {
        $carga = Carga::with(['docente', 'curso'])->findOrFail($id);
        $docentes = Docente::orderBy('apellidos')->orderBy('nombres')->get();
        $cursos = Curso::withSum('cargas as cargas_sum_grupos', 'grupos_asignados')
            ->withSum('cargas as cargas_sum_horas_t', 'horas_t_carga')
            ->orderBy('nombre')
            ->get();

        foreach ($cursos as $c) {
            $c->grupos_disponibles = max(0, (int) $c->n_grupos - (int) ($c->cargas_sum_grupos ?? 0));
            $c->horas_t_disponibles = max(0, (int) $c->horas_t - (int) ($c->cargas_sum_horas_t ?? 0));
        }

        return view('admin.carga.edit', compact('carga', 'docentes', 'cursos'));
    }

    // Actualizar carga académica
    public function update(Request $request, Carga $carga)
    {
        $data = $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'curso_id' => 'required|exists:cursos,id',
            'grupos_asignados' => 'required|integer|min:0',
            'horas_t_carga' => 'required|integer|min:0',
            'observaciones' => 'nullable|string|max:255',
        ]);

        $curso = Curso::findOrFail($data['curso_id']);
        $acum = Carga::where('curso_id', $curso->id)
            ->where('id', '<>', $carga->id)
            ->selectRaw('COALESCE(SUM(grupos_asignados), 0) sum_g, COALESCE(SUM(horas_t_carga), 0) sum_t')
            ->first();

        $dispG = max(0, $curso->n_grupos - $acum->sum_g);
        $dispT = max(0, $curso->horas_t - $acum->sum_t);

        if ($data['grupos_asignados'] > $dispG) {
            return back()->withErrors(['grupos_asignados' => "No hay grupos suficientes. Restantes: $dispG"])->withInput();
        }

        if ($data['horas_t_carga'] > $dispT) {
            return back()->withErrors(['horas_t_carga' => "No hay horas teóricas disponibles. Restantes: $dispT"])->withInput();
        }

        try {
            $carga->update($data);
        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'No se pudo actualizar la carga académica.'])->withInput();
        }

        return redirect()->route('admin.carga.index')
            ->with('mensaje', 'Carga actualizada correctamente')
            ->with('icono', 'success');
    }

    // Confirmación de eliminación de carga
    public function confirmDelete($id)
    {
        $carga = Carga::with(['docente', 'curso'])->findOrFail($id);
        return view('admin.carga.delete', compact('carga'));
    }

    // Eliminar carga académica
    public function destroy($id)
    {
        $carga = Carga::with(['docente', 'curso'])->findOrFail($id);
        $carga->delete();

        return redirect()->route('admin.carga.index')
            ->with('mensaje', 'Carga eliminada correctamente')
            ->with('icono', 'success');
    }
}
