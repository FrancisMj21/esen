@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Usuario: {{ $usuario->name }}</h1>
    </div>

    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('/admin/usuarios/create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <label for="">Nombre del Usuario</label> <b>*</b>
                                <p>{{$usuario->name}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <label for="">Email</label><b>*</b>
                                <p>{{$usuario->email}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">Volver</a>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection