@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registrar Carga Académica</h1>
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
                <form id="myForm" action="{{ route('admin.cargas.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <label for="docente_id">Docente</label><b>*</b>
                            <select name="docente_id" id="docente_id" class="form-control" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($docentes as $d)
                                    <option value="{{ $d->id }}" {{ old('docente_id') == $d->id ? 'selected' : '' }}>
                                        {{ $d->nombres }} {{ $d->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('docente_id')<small style="color:red">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="curso_id">Curso</label><b>*</b>
                            <select id="curso_id" name="curso_id" class="form-control" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($cursos as $c)
                                    <option value="{{ $c->id }}" data-horasp="{{ $c->horas_p }}" data-horast="{{ $c->horas_t }}"
                                        data-grupos="{{ $c->n_grupos }}"
                                        data-grupos-disp="{{ $c->grupos_disponibles ?? ($c->n_grupos - ($c->cargas_sum_grupos ?? 0)) }}"
                                        data-horast-disp="{{ $c->horas_t_disponibles ?? ($c->horas_t - ($c->cargas_sum_horas_t ?? 0)) }}"
                                        {{ old('curso_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('curso_id')<small style="color:red">{{ $message }}</small>@enderror
                            <small class="text-muted d-block mt-1" id="infoCurso">
                                Seleccione un curso para ver disponibilidad.
                            </small>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="grupos_asignados">Grupos prácticos a asignar</label><b>*</b>
                            <input type="number" id="grupos_asignados" name="grupos_asignados" class="form-control" min="0"
                                value="{{ old('grupos_asignados', 0) }}" required>
                            @error('grupos_asignados')<small style="color:red">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-3">
                            <label for="horas_t_carga">Horas teóricas a asignar</label><b>*</b>
                            <input type="number" id="horas_t_carga" name="horas_t_carga" class="form-control" min="0"
                                value="{{ old('horas_t_carga', 0) }}" required>
                            @error('horas_t_carga')<small style="color:red">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-3">
                            <label for="horas_p_carga">Horas prácticas (calculadas)</label>
                            <input type="number" id="horas_p_carga" class="form-control" value="{{ old('horas_p_carga') }}"
                                readonly>
                        </div>

                        <div class="col-md-3">
                            <label for="total_horas">Total horas</label>
                            <input type="number" id="total_horas" class="form-control" value="{{ old('total_horas') }}"
                                readonly>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="observaciones">Observaciones</label>
                            <input type="text" id="observaciones" name="observaciones" class="form-control"
                                value="{{ old('observaciones') }}">
                            @error('observaciones')<small style="color:red">{{ $message }}</small>@enderror
                        </div>
                    </div>

                    <hr>
                    <a href="{{ asset('admin/cargas') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Registrar Asignación</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('#myForm').addEventListener('submit', function (e) {
            console.log('Formulario enviado');
            e.preventDefault();
            e.target.submit();
        });


    </script>
@endsection