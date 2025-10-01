@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Eliminar Curso: {{ $curso->nombre }}</h1>
    </div>

    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">¿Está seguro de eliminar este registro?</h3>
                <div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button></div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.cursos.destroy', $curso->id) }}" method="POST">
                    @csrf @method('DELETE')

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nombre</label>
                            <input type="text" class="form-control" value="{{ $curso->nombre }}" disabled>
                        </div>
                        <div class="col-md-2">
                            <label>Ciclo</label>
                            <input type="text" class="form-control" value="{{ $curso->ciclo }}" disabled>
                        </div>
                        <div class="col-md-2">
                            <label>Horas T</label>
                            <input type="text" class="form-control" value="{{ $curso->horas_t }}" disabled>
                        </div>
                        <div class="col-md-2">
                            <label>Horas P</label>
                            <input type="text" class="form-control" value="{{ $curso->horas_p }}" disabled>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>N° Estudiantes</label>
                            <input type="text" class="form-control" value="{{ $curso->n_estudiantes }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>N° Grupos</label>
                            <input type="text" class="form-control" value="{{ $curso->n_grupos }}" disabled>
                        </div>
                    </div>

                    <hr>
                    <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Eliminar Curso</button>
                </form>
            </div>
        </div>
    </div>
@endsection