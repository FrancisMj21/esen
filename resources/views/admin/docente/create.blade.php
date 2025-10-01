@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Registrar Nuevo Docente</h1>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Llene los datos</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/docentes/create') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form group">
                                <label>Nombres</label> <b>*</b>
                                <input type="text" name="nombres" class="form-control"
                                       value="{{ old('nombres') }}" required>
                                @error('nombres') <small style="color:red">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form group">
                                <label>Apellidos</label> <b>*</b>
                                <input type="text" name="apellidos" class="form-control"
                                       value="{{ old('apellidos') }}" required>
                                @error('apellidos') <small style="color:red">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form group">
                                <label>DNI</label> <b>*</b>
                                <input type="text" name="dni" class="form-control"
                                       value="{{ old('dni') }}" required>
                                @error('dni') <small style="color:red">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form group">
                                <label>Celular</label> <b>*</b>
                                <input type="text" name="celular" class="form-control"
                                       value="{{ old('celular') }}" required>
                                @error('celular') <small style="color:red">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form group">
                                <label>Fecha de Nacimiento</label> <b>*</b>
                                <input type="date" name="fecha_nacimiento" class="form-control"
                                       value="{{ old('fecha_nacimiento') }}" required>
                                @error('fecha_nacimiento') <small style="color:red">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form group">
                                <label>Grado</label> <b>*</b>
                                <select name="cargo_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id }}"
                                            {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>
                                            {{ $cargo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cargo_id') <small style="color:red">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Datos de acceso (opcional, solo si el docente tendrá usuario) --}}
                        <div class="col-md-3">
                            <div class="form group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email') <small style="color:red">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form group">
                                <label>Cargo</label> <b>*</b>
                                <select name="_cargo_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach($_cargos as $_cargo)
                                        <option value="{{ $_cargo->id }}" {{ old('_cargo_id') == $_cargo->id ? 'selected' : '' }}>
                                            {{ $_cargo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('_cargo_id') <small style="color:red">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-3 mt-3">
                            <div class="form group">
                                <label>Categoría</label> <b>*</b>
                                <select name="categoria_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria_id') <small style="color:red">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('admin/docentes') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Registrar nuevo</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
