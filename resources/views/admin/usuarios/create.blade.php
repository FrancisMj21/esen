@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registrar Nuevo Usuario</h1>
    </div>

    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Llene los datos</h3>
     <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
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
                                <input type="text" name="name" class="form-control" required>
                                @error('name')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <label for="">Email</label><b>*</b>
                                <input type="email" name="email" class="form-control" required>
                                @error('email')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <label for="">Contraseña</label><b>*</b>
                                <input type="password" name="password" class="form-control" required>
                                @error('password')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <label for="">Contraseña Verificación</label><b>*</b>
                                <input type="password" name="password_confirmation" class="form-control" required>
                                @error('password_confirmation')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Registrar Usuario</button>
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