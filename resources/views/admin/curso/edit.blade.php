@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Modificar Curso: {{ $curso->nombre }}</h1>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos</h3>
                <div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button></div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.cursos.update', $curso->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nombre</label><b>*</b>
                            <input type="text" name="nombre" class="form-control"
                                value="{{ old('nombre', $curso->nombre) }}" required>
                            @error('nombre')<small style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-2">
                            <label>Ciclo</label><b>*</b>
                            <input type="number" name="ciclo" class="form-control" value="{{ old('ciclo', $curso->ciclo) }}"
                                min="1" max="12" required>
                            @error('ciclo')<small style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-2">
                            <label>Horas T</label><b>*</b>
                            <input type="number" name="horas_t" class="form-control"
                                value="{{ old('horas_t', $curso->horas_t) }}" min="0" required>
                            @error('horas_t')<small style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-2">
                            <label>Horas P</label><b>*</b>
                            <input type="number" name="horas_p" class="form-control"
                                value="{{ old('horas_p', $curso->horas_p) }}" min="0" required>
                            @error('horas_p')<small style="color:red">{{ $message }}</small>@enderror
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>N° Estudiantes</label>
                            <input type="number" name="n_estudiantes" class="form-control"
                                value="{{ old('n_estudiantes', $curso->n_estudiantes) }}" min="0">
                            @error('n_estudiantes')<small style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-3">
                            <label>N° Grupos</label>
                            <input type="number" name="n_grupos" class="form-control"
                                value="{{ old('n_grupos', $curso->n_grupos) }}" min="1">
                            @error('n_grupos')<small style="color:red">{{ $message }}</small>@enderror
                        </div>
                    </div>

                <div class="col-md-3 mt-3">
                    <div class="form-group">
                        <label>Tipo de Práctica</label> <b>*</b>
                        <select name="t_practica_id" class="form-control" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($practicas as $practica)
                                <option value="{{ $practica->id }}" 
                                    {{ old('t_practica_id', $curso->t_practica_id) == $practica->id ? 'selected' : '' }}>
                                    {{ $practica->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('t_practica_id') 
                            <small style="color:red">{{ $message }}</small> 
                        @enderror
                    </div>
                </div>

                    <hr>
                    <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Actualizar Curso</button>
                </form>
            </div>
        </div>
    </div>
@endsection