<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Tpractica;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::orderBy('ciclo')->orderBy('nombre')->get();
        return view('admin.curso.index', compact('cursos'));
    }

    public function create()
    {
        $practicas = Tpractica::orderBy('nombre')->get();
        return view('admin.curso.create', compact('practicas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:120',
            'ciclo' => 'required|integer|min:1|max:12',
            'horas_t' => 'required|integer|min:0|max:400',
            'horas_p' => 'required|integer|min:0|max:400',
            'n_estudiantes' => 'nullable|integer|min:0|max:500',
            'n_grupos' => 'nullable|integer|min:1|max:20',
            't_practica_id' => 'required|exists:t_practica,id'
        ]);

        Curso::create([
            'nombre' => $request->nombre,
            'ciclo' => $request->ciclo,
            'horas_t' => $request->horas_t,
            'horas_p' => $request->horas_p,
            'n_estudiantes' => $request->n_estudiantes ?? 0,
            'n_grupos' => $request->n_grupos ?? 1,
            't_practica_id' => $request->t_practica_id,
        ]);

        return redirect()->route('admin.cursos.index')
            ->with('mensaje', 'Curso registrado correctamente')
            ->with('icono', 'success');
    }

    public function show($id)
    {
        $curso = Curso::findOrFail($id);
        return view('admin.curso.show', compact('curso'));
    }

    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        $practicas = Tpractica::orderBy('nombre')->get();
        return view('admin.curso.edit', compact('curso', 'practicas'));
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:120',
            'ciclo' => 'required|integer|min:1|max:12',
            'horas_t' => 'required|integer|min:0|max:400',
            'horas_p' => 'required|integer|min:0|max:400',
            'n_estudiantes' => 'nullable|integer|min:0|max:500',
            'n_grupos' => 'nullable|integer|min:1|max:20',
            't_practica_id' => 'required|exists:t_practica,id',
        ]);

        $curso->update([
            'nombre' => $request->nombre,
            'ciclo' => $request->ciclo,
            'horas_t' => $request->horas_t,
            'horas_p' => $request->horas_p,
            'n_estudiantes' => $request->n_estudiantes ?? 0,
            'n_grupos' => $request->n_grupos ?? 1,
            't_practica_id' => $request->t_practica_id,
        ]);

        return redirect()->route('admin.cursos.index')
            ->with('mensaje', 'Curso actualizado correctamente')
            ->with('icono', 'success');
    }

    public function confirmDelete($id)
    {
        $curso = Curso::findOrFail($id);
        return view('admin.curso.delete', compact('curso'));
    }

    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('admin.cursos.index')
            ->with('mensaje', 'Curso eliminado correctamente')
            ->with('icono', 'success');
    }
}
