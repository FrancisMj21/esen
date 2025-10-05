<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cargo;
use App\Models\_Cargo;
use App\Models\Categoria;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::with(['user', 'cargo'])->get();
        return view('admin.docente.index', compact('docentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cargos = Cargo::orderBy('nombre')->get();
        $_cargos = _Cargo::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('nombre')->get();
        return view('admin.docente.create', compact('cargos', '_cargos', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dni' => 'required|unique:docentes,dni',
            'celular' => 'required',
            'fecha_nacimiento' => 'required|date',
            'cargo_id' => 'required|exists:cargos,id',
            '_cargo_id' => 'required|exists:cargo,id',
            'categoria_id' => 'required|exists:categoria,id',
            'email' => 'required|email|max:250|unique:users,email',
        ]);

        // Usuario
        $usuario = new User();
        $usuario->name = $request->nombres . ' ' . $request->apellidos;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->dni); // ✅ Contraseña = DNI
        $usuario->save();

        // Docente
        $docente = new Docente();
        $docente->user_id = $usuario->id;
        $docente->cargo_id = $request->cargo_id;
        $docente->nombres = $request->nombres;
        $docente->apellidos = $request->apellidos;
        $docente->dni = $request->dni;
        $docente->celular = $request->celular;
        $docente->fecha_nacimiento = $request->fecha_nacimiento;
        $docente->_cargo_id = $request->_cargo_id;
        $docente->categoria_id = $request->categoria_id;
        $docente->save();

        return redirect()->route('admin.docentes.index')
            ->with('mensaje', 'Se registró al docente correctamente. La contraseña inicial es el DNI.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $docente = Docente::with(['user', 'cargo'])->findOrFail($id);
        return view('admin.docente.show', compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $docente = Docente::with('user')->findOrFail($id);
        $cargos = Cargo::orderBy('nombre')->get();
        $_cargos = _Cargo::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('admin.docente.edit', compact('docente', 'cargos', '_cargos', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $docente = Docente::with('user')->findOrFail($id);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dni' => 'required|unique:docentes,dni,' . $docente->id,
            'celular' => 'required',
            'fecha_nacimiento' => 'required|date',
            'cargo_id' => 'required|exists:cargos,id',
            '_cargo_id' => 'required|exists:cargo,id',
            'categoria_id' => 'required|exists:categoria,id' . $docente->categoria_id,
            'email' => 'required|email|max:250|unique:users,email,' . $docente->user->id,
        ]);

        // Actualiza Docente
        $docente->cargo_id = $request->cargo_id;
        $docente->nombres = $request->nombres;
        $docente->apellidos = $request->apellidos;
        $docente->dni = $request->dni;
        $docente->celular = $request->celular;
        $docente->fecha_nacimiento = $request->fecha_nacimiento;
        $docente->_cargo_id = $request->_cargo_id;
        $docente->categoria_id = $request->categoria_id;
        $docente->save();

        // Actualiza Usuario asociado
        $usuario = User::find($docente->user->id);
        $usuario->name = $request->nombres . ' ' . $request->apellidos;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->dni); // ✅ Contraseña = DNI actualizado
        $usuario->save();

        return redirect()->route('admin.docentes.index')
            ->with('mensaje', 'El docente fue actualizado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Confirm delete view (opcional).
     */
    public function confirmDelete($id)
    {
        $docente = Docente::with('user')->findOrFail($id);
        return view('admin.docente.delete', compact('docente'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $docente = Docente::with('user')->findOrFail($id);

        // Elimina primero el usuario y luego el docente
        $user = $docente->user;
        if ($user) {
            $user->delete();
        }
        $docente->delete();

        return redirect()->route('admin.docentes.index')
            ->with('mensaje', 'Se eliminó al docente correctamente')
            ->with('icono', 'success');
    }
}
