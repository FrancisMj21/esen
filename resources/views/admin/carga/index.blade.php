@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Lista de Carga Académica</h1>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-{{ session('icono', 'success') }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Asignaciones Registradas</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.cargas.create') }}" class="btn btn-primary">
                            Asignar Carga
                        </a>
                        <a href="{{ route('ejecutar.carga') }}" class="btn btn-success">
                            Descargar Carga Interna
                        </a>
                        <a href="{{ route('ejecutar.carga2') }}" class="btn btn-success">
                            Descargar Carga VIAC
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="tblCargas" class="table table-hover table-striped table-sm table-bordered">
                        <thead style="background-color: grey">
                            <tr>
                                <th class="text-center">Nro</th>
                                <th>Docente</th>
                                <th>Curso</th>
                                <th class="text-center">Ciclo</th>
                                <th class="text-center">Grupos</th>
                                <th class="text-center">Horas T</th>
                                <th class="text-center">Horas P</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1; @endphp
                            @foreach($cargas as $c)
                                <tr>
                                    <td class="text-center">{{ $n++ }}</td>
                                    <td>{{ optional($c->docente)->nombres }} {{ optional($c->docente)->apellidos }}</td>
                                    <td>{{ optional($c->curso)->nombre }}</td>
                                    <td class="text-center">{{ optional($c->curso)->ciclo }}</td>
                                    <td class="text-center">{{ $c->grupos_asignados }}</td>
                                    <td class="text-center">{{ $c->horas_t_carga }}</td>
                                    <td class="text-center">{{ $c->horas_p_carga }}</td>
                                    <td class="text-center"><strong>{{ $c->total_horas }}</strong></td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.cargas.show', $c->id) }}" class="btn btn-info btn-sm"
                                            title="Ver">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('admin.cargas.confirmDelete', $c->id) }}"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash2-fill"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        $(function () {
                            $("#tblCargas").DataTable({
                                pageLength: 10,
                                language: {
                                    emptyTable: "No hay información",
                                    info: "Mostrando _START_ a _END_ de _TOTAL_ Cargas",
                                    infoEmpty: "Mostrando 0 a 0 de 0 Cargas",
                                    infoFiltered: "(Filtrado de _MAX_ total Cargas)",
                                    lengthMenu: "Mostrar _MENU_ Cargas",
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
                                        buttons: [
                                            { extend: 'copy', text: 'Copiar' },
                                            { extend: 'pdf' },
                                            { extend: 'csv' },
                                            { extend: 'excel' },
                                            { extend: 'print', text: 'Imprimir' }
                                        ]
                                    },
                                    { extend: 'colvis', text: 'Visor de columnas', collectionLayout: 'fixed three-column' }
                                ],
                            }).buttons().container().appendTo('#tblCargas_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection