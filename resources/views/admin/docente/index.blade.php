@extends('layouts.admin')
@section('content')

    <div class="row">
        <h1>Lista de docente</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">docente Registrados</h3>

                    <div class="card-tools">
                        <a href="{{ url('admin/docentes/create') }}" class="btn btn-primary">
                            Registrar Nuevo
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-hover table-striped table-sm table-bordered">
                        <thead style="background-color: grey">
                            <tr>
                                <td scope="col" class="text-center">Nro</td>
                                <td scope="col" class="text-center">Nombres</td>
                                <td scope="col" class="text-center">Apellidos</td>
                                <td scope="col" class="text-center">DNI</td>
                                <td scope="col" class="text-center">Celular</td>
                                <td scope="col" class="text-center">Fecha de nacimiento</td>
                                <td scope="col" class="text-center">Cargo</td>
                                <td scope="col" class="text-center">Email</td>
                                <td scope="col" class="text-center">Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $contador = 1; @endphp

                            @foreach($docentes as $docente)
                                <tr>
                                    <td class="text-center">{{ $contador++ }}</td>
                                    <td>{{ $docente->nombres }}</td>
                                    <td>{{ $docente->apellidos }}</td>
                                    <td>{{ $docente->dni }}</td>
                                    <td>{{ $docente->celular }}</td>
                                    <td>{{ $docente->fecha_nacimiento }}</td>
                                    <td>{{ $docente->cargo->nombre ?? '' }}</td>
                                    <td>{{ $docente->user->email ?? '' }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('/admin/docentes/' . $docente->id) }}" class="btn btn-info btn-sm"><i
                                                class="bi bi-eye-fill"></i></a>
                                        <a href="{{ url('/admin/docentes/' . $docente->id . '/edit') }}"
                                            class="btn btn-success btn-sm"><i class="bi bi-pen-fill"></i></a>
                                        <a href="{{ url('/admin/docentes/' . $docente->id . '/confirm-delete') }}"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash2-fill"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        $(function () {
                            $("#example1").DataTable({
                                pageLength: 10,
                                language: {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ docente",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 docente",
                                    "infoFiltered": "(Filtrado de _MAX_ total docente)",
                                    "lengthMenu": "Mostrar _MENU_ docente",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Último",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                responsive: true, lengthChange: true, autoWidth: false,
                                buttons: [
                                    {
                                        extend: 'collection',
                                        text: 'Reportes',
                                        orientation: 'landscape',
                                        buttons: [
                                            { extend: 'copy', text: 'Copiar' },
                                            { extend: 'pdf' },
                                            { extend: 'csv' },
                                            { extend: 'excel' },
                                            { extend: 'print', text: 'Imprimir' },
                                        ]
                                    },
                                    { extend: 'colvis', text: 'Visor de columnas', collectionLayout: 'fixed three-column' }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection