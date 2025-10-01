@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Información del Docente {{ $docente->nombres }} {{ $docente->apellidos }}</h1>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos detallados</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Nombres</label>
                        <input type="text" class="form-control" value="{{ $docente->nombres }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" value="{{ $docente->apellidos }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>DNI</label>
                        <input type="text" class="form-control" value="{{ $docente->dni }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>Celular</label>
                        <input type="text" class="form-control" value="{{ $docente->celular }}" readonly>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" class="form-control" value="{{ $docente->fecha_nacimiento }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>Grado</label>
                        <input type="text" class="form-control" value="{{ $docente->cargo->nombre ?? '' }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ $docente->user->email ?? '' }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>Cargo</label>
                        <input type="text" class="form-control" value="{{ $docente->_cargo->nombre ?? '' }}" disabled>
                    </div>
                </div>

                <br>
                <div class="row">

                    <div class="col-md-3">
                        <label>Categoria</label>
                        <input type="text" class="form-control" value="{{ $docente->categoria->nombre ?? '' }}" disabled>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ url('admin/docentes') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection