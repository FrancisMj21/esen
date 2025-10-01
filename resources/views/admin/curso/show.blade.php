@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Información del Curso {{ $curso->nombre }}</h1>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos detallados</h3>
                <div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button></div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Nombre</label>
                        <input type="text" class="form-control" value="{{ $curso->nombre }}" readonly>
                    </div>
                    <div class="col-md-2">
                        <label>Ciclo</label>
                        <input type="text" class="form-control" value="{{ $curso->ciclo }}" readonly>
                    </div>
                    <div class="col-md-2">
                        <label>Horas T</label>
                        <input type="text" class="form-control" value="{{ $curso->horas_t }}" readonly>
                    </div>
                    <div class="col-md-2">
                        <label>Horas P</label>
                        <input type="text" class="form-control" value="{{ $curso->horas_p }}" readonly>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label>N° Estudiantes</label>
                        <input type="text" class="form-control" value="{{ $curso->n_estudiantes }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>N° Grupos</label>
                        <input type="text" class="form-control" value="{{ $curso->n_grupos }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>Practica</label>
                        <input type="text" class="form-control" value="{{ $curso->practica->nombre ?? '' }}" readonly>
                    </div>

                </div>

                <hr>
                <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection