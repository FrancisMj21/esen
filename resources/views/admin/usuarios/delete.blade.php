@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Eliminar usuario: {{ $usuario->name }}</h1>
    </div>

    <div class="col-md-6">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">¿Estás seguro de eliminar?</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('admin/usuarios', $usuario->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <label for="">Nombre del Usuario</label>
                                <input type="text" value="{{ $usuario->name }}" name="name" class="form-control" disabled>
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
                                <label for="">Email</label>
                                <input type="email" value="{{ $usuario->email }}" name="email" class="form-control"
                                    disabled>
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
                                <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
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