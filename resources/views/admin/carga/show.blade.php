@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Detalle de Carga Académica</h1>
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
                @php
                    // Calculamos horas prácticas y total por si no estuvieran persistidas
                    $hp = $carga->horas_p_carga ?? ($carga->grupos_asignados * ($carga->curso->horas_p ?? 0));
                    $total = $carga->total_horas ?? ($hp + ($carga->horas_t_carga ?? 0));
                @endphp

                <div class="row">
                    <div class="col-md-6">
                        <label>Docente</label>
                        <input type="text" class="form-control"
                            value="{{ $carga->docente?->nombres }} {{ $carga->docente?->apellidos }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Curso</label>
                        <input type="text" class="form-control" value="{{ $carga->curso?->nombre }}" readonly>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-2">
                        <label>Ciclo</label>
                        <input type="text" class="form-control" value="{{ $carga->curso?->ciclo }}" readonly>
                    </div>

                    <div class="col-md-2">
                        <label>Grupos prácticos</label>
                        <input type="number" class="form-control" value="{{ $carga->grupos_asignados }}" readonly>
                    </div>

                    <div class="col-md-2">
                        <label>Horas T asignadas</label>
                        <input type="number" class="form-control" value="{{ $carga->horas_t_carga }}" readonly>
                    </div>

                    <div class="col-md-2">
                        <label>Horas P</label>
                        <input type="number" class="form-control" value="{{ $hp }}" readonly>
                    </div>

                    <div class="col-md-2">
                        <label>Total horas</label>
                        <input type="number" class="form-control" value="{{ $total }}" readonly>
                    </div>
                </div>

                <hr>
                <a href="{{ route('admin.cargas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection