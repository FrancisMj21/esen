@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Modificar Docente: {{ $docente->nombres }} {{ $docente->apellidos }}</h1>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/docentes/' . $docente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-3">
                            <label>Nombres</label><b>*</b>
                            <input type="text" class="form-control" name="nombres"
                                value="{{ old('nombres', $docente->nombres) }}" required>
                            @error('nombres') <small style="color:red">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label>Apellidos</label><b>*</b>
                            <input type="text" class="form-control" name="apellidos"
                                value="{{ old('apellidos', $docente->apellidos) }}" required>
                            @error('apellidos') <small style="color:red">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label>DNI</label><b>*</b>
                            <input type="text" class="form-control" name="dni" value="{{ old('dni', $docente->dni) }}"
                                required>
                            @error('dni') <small style="color:red">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label>Celular</label><b>*</b>
                            <input type="text" class="form-control" name="celular"
                                value="{{ old('celular', $docente->celular) }}" required>
                            @error('celular') <small style="color:red">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Fecha de Nacimiento</label><b>*</b>
                            <input type="date" class="form-control" name="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento', $docente->fecha_nacimiento) }}" required>
                            @error('fecha_nacimiento') <small style="color:red">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label>Grado</label><b>*</b>
                            <select name="cargo_id" class="form-control" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($cargos as $cargo)
                                    <option value="{{ $cargo->id }}" {{ old('cargo_id', $docente->cargo_id) == $cargo->id ? 'selected' : '' }}>
                                        {{ $cargo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cargo_id') <small style="color:red">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label>Email</label><b>*</b>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $docente->user->email ?? '') }}" required>
                            @error('email') <small style="color:red">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label>Cargo</label><b>*</b>
                            <select name="_cargo_id" class="form-control" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($_cargos as $_cargo)
                                    <option value="{{ $_cargo->id }}" {{ old('_cargo_id', $docente->_cargo_id) == $_cargo->id ? 'selected' : '' }}>
                                        {{ $_cargo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cargo_id') <small style="color:red">{{ $message }}</small> @enderror
                        </div>


                        <div class="col-md-3 mt-3">
                            <label>Categoria</label><b>*</b>
                            <select name="categoria_id" class="form-control" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id', $docente->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria_id') <small style="color:red">{{ $message }}</small> @enderror
                        </div>

                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('admin/docentes') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar Docente</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection