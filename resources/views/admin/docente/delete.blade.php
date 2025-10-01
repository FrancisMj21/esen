@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Eliminar Docente: {{ $docente->nombres }} {{ $docente->apellidos }}</h1>
    </div>

    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">¿Está seguro de eliminar este registro?</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/docentes/' . $docente->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="row">
                        <div class="col-md-3">
                            <label>Nombres</label>
                            <input type="text" class="form-control" value="{{ $docente->nombres }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Apellidos</label>
                            <input type="text" class="form-control" value="{{ $docente->apellidos }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>DNI</label>
                            <input type="text" class="form-control" value="{{ $docente->dni }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Celular</label>
                            <input type="text" class="form-control" value="{{ $docente->celular }}" disabled>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" class="form-control" value="{{ $docente->fecha_nacimiento }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Grado</label>
                            <input type="text" class="form-control" value="{{ $docente->cargo->nombre ?? '' }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ $docente->user->email ?? '' }}" disabled>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Cargo</label>
                            <input type="text" class="form-control" value="{{ $docente->_cargo->nombre ?? '' }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Categoria</label>
                            <input type="text" class="form-control" value="{{ $docente->categoria->nombre ?? '' }}"
                                disabled>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('admin/docentes') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-danger">Eliminar Docente</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection