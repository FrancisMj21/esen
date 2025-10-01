@extends('layouts.admin')
@section('content')

    <div class="row">
        <h1>Lista de Usuarios</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios Registrados</h3>

                    <div class="card-tools">
                        <a href="{{ url('admin/usuarios/create') }}" class="btn btn-primary">
                            Registrar Nuevo
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    <table id="example1" class="table table-hover table-striped table-sm table-bordered">
                        <thead style="background-color: grey">
                            <tr>
                                <td scope="col" style="text-align: center">Nro</td>
                                <td scope="col" style="text-align: center">Nombre</td>
                                <td scope="col" style="text-align: center">Email</td>
                                <td scope="col" style="text-align: center">Acciones</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $contador = 1; ?>

                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td style="text-align: center">{{ $contador++ }}</td>
                                    <td>{{$usuario->name}}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td style="text-align: center">
                                        <!-- Botones de ejemplo -->
                                        <a href={{url('/admin/usuarios/' . $usuario->id)}} type="button"
                                            class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                        <a href={{url('/admin/usuarios/' . $usuario->id . '/edit')}} type="button"
                                            class="btn btn-success btn-sm"><i class="bi bi-pen-fill"></i></a>
                                        <a href={{ url('/admin/usuarios/' . $usuario->id . '/confirm-delete') }} button
                                            type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash2-fill"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                                    "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Usuarios",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true, "lengthChange": true, "autoWidth": false,
                                buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    }, {
                                        extend: 'csv'
                                    }, {
                                        extend: 'excel'
                                    }, {
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }
                                    ]
                                },
                                {
                                    extend: 'colvis',
                                    text: 'Visor de columnas',
                                    collectionLayout: 'fixed three-column'
                                }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
@endsection