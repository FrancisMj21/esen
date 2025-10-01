@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>
            Eliminar Carga:
            {{ $carga->docente?->nombres }} {{ $carga->docente?->apellidos }}
            — {{ $carga->curso?->nombre }}
        </h1>
    </div>

    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">¿Está seguro de eliminar esta asignación?</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                @php
                    $hp = $carga->horas_p_carga ?? ($carga->grupos_asignados * ($carga->curso->horas_p ?? 0));
                    $total = $carga->total_horas ?? ($hp + ($carga->horas_t_carga ?? 0));
                @endphp

                <form action="{{ route('admin.cargas.destroy', $carga->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="row">
                        <div class="col-md-6">
                            <label>Docente</label>
                            <input type="text" class="form-control"
                                value="{{ $carga->docente?->nombres }} {{ $carga->docente?->apellidos }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label>Curso</label>
                            <input type="text" class="form-control" value="{{ $carga->curso?->nombre }}" disabled>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <label>Ciclo</label>
                            <input type="text" class="form-control" value="{{ $carga->curso?->ciclo }}" disabled>
                        </div>
                        <div class="col-md-2">
                            <label>Grupos prácticos</label>
                            <input type="number" class="form-control" value="{{ $carga->grupos_asignados }}" disabled>
                        </div>
                        <div class="col-md-2">
                            <label>Horas T asignadas</label>
                            <input type="number" class="form-control" value="{{ $carga->horas_t_carga }}" disabled>
                        </div>
                        <div class="col-md-2">
                            <label>Horas P</label>
                            <input type="number" class="form-control" value="{{ $hp }}" disabled>
                        </div>
                        <div class="col-md-2">
                            <label>Total horas</label>
                            <input type="number" class="form-control" value="{{ $total }}" disabled>
                        </div>
                    </div>

                    @if($carga->observaciones)
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Observaciones</label>
                                <input type="text" class="form-control" value="{{ $carga->observaciones }}" disabled>
                            </div>
                        </div>
                    @endif

                    <hr>
                    <a href="{{ route('admin.cargas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Eliminar Carga</button>
                </form>
            </div>
        </div>
    </div>
@endsection