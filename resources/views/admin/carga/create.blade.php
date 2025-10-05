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
                <form action="{{ route('admin.cargas.store') }}" method="POST">
                    <a href="{{ asset('admin/cargas') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Registrar Asignación</button>
                </form>
            </div>
        </div>
    </div>

@endsection