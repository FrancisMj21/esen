@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Panel principal</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $us }}</h3>

                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion bi bi-file-person-fill"></i>
                </div>
                <a href="{{ url('admin/usuarios') }}" class="small-box-footer">Más información <i
                        class="fas bi bi-file-person-fill"></i></a>
            </div>
        </div>

        <!-- separacion -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $do }}</h3>

                    <p>Docentes</p>
                </div>
                <div class="icon">
                    <i class="ion bi bi-file-person-fill"></i>
                </div>
                <a href="{{ url('admin/docentes') }}" class="small-box-footer">Más información <i
                        class="fas bi bi-file-person-fill"></i></a>
            </div>
        </div>

        <!-- separacion -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $cu }}</h3>

                    <p>Cursos</p>
                </div>
                <div class="icon">
                    <i class="ion bi bi-file-person-fill"></i>
                </div>
                <a href="{{ url('admin/cursos') }}" class="small-box-footer">Más información <i
                        class="fas bi bi-file-person-fill"></i></a>
            </div>
        </div>

    </div>
@endsection