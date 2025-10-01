<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\Carga;

class AdminController extends Controller
{
    //
    public function index()
    {
        $us = User::count();
        $do = Docente::count();
        $cu = Curso::count();
        $ca = Carga::count();
        return view('admin.index', compact('us', 'do', 'cu', 'ca'));
    }
}
