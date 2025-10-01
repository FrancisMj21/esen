@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Lista de Cursos</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cursos Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.cursos.create') }}" class="btn btn-primary">Registrar Nuevo</a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-hover table-striped table-sm table-bordered">
                        <thead style="background-color: grey">
                            <tr>
                                <th class="text-center">Nro</th>
                                <th>Nombre</th>
                                <th class="text-center">Ciclo</th>
                                <th class="text-center">Horas T</th>
                                <th class="text-center">Horas P</th>
                                <th class="text-center">N° Estudiantes</th>
                                <th class="text-center">N° Grupos</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1; @endphp
                            @foreach($cursos as $c)
                                <tr>
                                    <td class="text-center">{{ $n++ }}</td>
                                    <td>{{ $c->nombre }}</td>
                                    <td class="text-center">{{ $c->ciclo }}</td>
                                    <td class="text-center">{{ $c->horas_t }}</td>
                                    <td class="text-center">{{ $c->horas_p }}</td>
                                    <td class="text-center">{{ $c->n_estudiantes }}</td>
                                    <td class="text-center">{{ $c->n_grupos }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.cursos.show', $c->id) }}" class="btn btn-info btn-sm"><i
                                                class="bi bi-eye-fill"></i></a>
                                        <a href="{{ route('admin.cursos.edit', $c->id) }}" class="btn btn-success btn-sm"><i
                                                class="bi bi-pen-fill"></i></a>
                                        <a href="{{ route('admin.cursos.confirmDelete', $c->id) }}"
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
                                    emptyTable: "No hay información",
                                    info: "Mostrando _START_ a _END_ de _TOTAL_ Cursos",
                                    infoEmpty: "Mostrando 0 a 0 de 0 Cursos",
                                    infoFiltered: "(Filtrado de _MAX_ total Cursos)",
                                    lengthMenu: "Mostrar _MENU_ Cursos",
                                    loadingRecords: "Cargando...",
                                    processing: "Procesando...",
                                    search: "Buscador:",
                                    zeroRecords: "Sin resultados encontrados",
                                    paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" }
                                },
                                responsive: true, lengthChange: true, autoWidth: false,
                                buttons: [
                                    {
                                        extend: 'collection', text: 'Reportes', orientation: 'landscape',
                                        buttons: [{ extend: 'copy', text: 'Copiar' }, { extend: 'pdf' }, { extend: 'csv' }, { extend: 'excel' }, { extend: 'print', text: 'Imprimir' }]
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