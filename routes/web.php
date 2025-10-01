<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas para el admin

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth');
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::get('/admin/usuarios/{id}/confirm-delete', [App\Http\Controllers\UsuarioController::class, 'confirmDelete'])->name('admin.usuarios.confirmDelete')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');


//ruta para docente

// DOCENTES
Route::get('/admin/docentes', [App\Http\Controllers\DocenteController::class, 'index'])
    ->name('admin.docentes.index')->middleware('auth');

Route::get('/admin/docentes/create', [App\Http\Controllers\DocenteController::class, 'create'])
    ->name('admin.docentes.create')->middleware('auth');

Route::post('/admin/docentes/create', [App\Http\Controllers\DocenteController::class, 'store'])
    ->name('admin.docentes.store')->middleware('auth');

Route::get('/admin/docentes/{id}', [App\Http\Controllers\DocenteController::class, 'show'])
    ->name('admin.docentes.show')->middleware('auth');

Route::get('/admin/docentes/{id}/edit', [App\Http\Controllers\DocenteController::class, 'edit'])
    ->name('admin.docentes.edit')->middleware('auth');

Route::put('/admin/docentes/{id}', [App\Http\Controllers\DocenteController::class, 'update'])
    ->name('admin.docentes.update')->middleware('auth');

Route::get('/admin/docentes/{id}/confirm-delete', [App\Http\Controllers\DocenteController::class, 'confirmDelete'])
    ->name('admin.docentes.confirmDelete')->middleware('auth');

Route::delete('/admin/docentes/{id}', [App\Http\Controllers\DocenteController::class, 'destroy'])
    ->name('admin.docentes.destroy')->middleware('auth');


// CURSOS

Route::get('/admin/cursos', [App\Http\Controllers\CursoController::class, 'index'])
    ->name('admin.cursos.index')->middleware('auth');
Route::get('/admin/cursos/create', [App\Http\Controllers\CursoController::class, 'create'])->name('admin.cursos.create')->middleware('auth');
Route::post('/admin/cursos', [App\Http\Controllers\CursoController::class, 'store'])->name('admin.cursos.store')->middleware('auth');
Route::get('/admin/cursos/{id}', [App\Http\Controllers\CursoController::class, 'show'])->name('admin.cursos.show')->middleware('auth');
Route::get('/admin/cursos/{id}/edit', [App\Http\Controllers\CursoController::class, 'edit'])->name('admin.cursos.edit')->middleware('auth');
Route::put('/admin/cursos/{id}', [App\Http\Controllers\CursoController::class, 'update'])->name('admin.cursos.update')->middleware('auth');
Route::get('/admin/cursos/{id}/confirm-delete', [App\Http\Controllers\CursoController::class, 'confirmDelete'])->name('admin.cursos.confirmDelete')->middleware('auth');
Route::delete('/admin/cursos/{id}', [App\Http\Controllers\CursoController::class, 'destroy'])->name('admin.cursos.destroy')->middleware('auth');


// CARGAS


Route::get('/admin/cargas', [App\Http\Controllers\CargaController::class, 'index'])
    ->name('admin.cargas.index')->middleware('auth');
Route::get('/admin/cargas/create', [App\Http\Controllers\CargaController::class, 'create'])->name('admin.cargas.create')->middleware('auth');
Route::post('/admin/cargas', [App\Http\Controllers\CargaController::class, 'store'])->name('admin.cargas.store')->middleware('auth');
Route::get('/admin/cargas/{id}', [App\Http\Controllers\CargaController::class, 'show'])->name('admin.cargas.show')->middleware('auth');
Route::get('/admin/cargas/{id}/edit', [App\Http\Controllers\CargaController::class, 'edit'])->name('admin.cargas.edit')->middleware('auth');
Route::put('/admin/cargas/{id}', [App\Http\Controllers\CargaController::class, 'update'])->name('admin.cargas.update')->middleware('auth');
Route::get('/admin/cargas/{id}/confirm-delete', [App\Http\Controllers\CargaController::class, 'confirmDelete'])->name('admin.cargas.confirmDelete')->middleware('auth');
Route::delete('/admin/cargas/{id}', [App\Http\Controllers\CargaController::class, 'destroy'])->name('admin.cargas.destroy')->middleware('auth');