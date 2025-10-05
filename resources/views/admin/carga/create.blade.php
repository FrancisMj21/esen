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
                <form id="myForm" action="{{ route('admin.cargas.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <label for="docente_id">Docente</label><b>*</b>
                            <select name="docente_id" id="docente_id" class="form-control" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($docentes as $d)
                                    <option value="{{ $d->id }}" {{ old('docente_id') == $d->id ? 'selected' : '' }}>
                                        {{ $d->nombres }} {{ $d->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('docente_id')<small style="color:red">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="curso_id">Curso</label><b>*</b>
                            <select id="curso_id" name="curso_id" class="form-control" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($cursos as $c)
                                    <option value="{{ $c->id }}" data-horasp="{{ $c->horas_p }}" data-horast="{{ $c->horas_t }}"
                                        data-grupos="{{ $c->n_grupos }}"
                                        data-grupos-disp="{{ $c->grupos_disponibles ?? ($c->n_grupos - ($c->cargas_sum_grupos ?? 0)) }}"
                                        data-horast-disp="{{ $c->horas_t_disponibles ?? ($c->horas_t - ($c->cargas_sum_horas_t ?? 0)) }}"
                                        {{ old('curso_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('curso_id')<small style="color:red">{{ $message }}</small>@enderror
                            <small class="text-muted d-block mt-1" id="infoCurso">
                                Seleccione un curso para ver disponibilidad.
                            </small>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="grupos_asignados">Grupos prácticos a asignar</label><b>*</b>
                            <input type="number" id="grupos_asignados" name="grupos_asignados" class="form-control" min="0"
                                value="{{ old('grupos_asignados', 0) }}" required>
                            @error('grupos_asignados')<small style="color:red">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-3">
                            <label for="horas_t_carga">Horas teóricas a asignar</label><b>*</b>
                            <input type="number" id="horas_t_carga" name="horas_t_carga" class="form-control" min="0"
                                value="{{ old('horas_t_carga', 0) }}" required>
                            @error('horas_t_carga')<small style="color:red">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-3">
                            <label for="horas_p_carga">Horas prácticas (calculadas)</label>
                            <input type="number" id="horas_p_carga" class="form-control" value="{{ old('horas_p_carga') }}"
                                readonly>
                        </div>

                        <div class="col-md-3">
                            <label for="total_horas">Total horas</label>
                            <input type="number" id="total_horas" class="form-control" value="{{ old('total_horas') }}"
                                readonly>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="observaciones">Observaciones</label>
                            <input type="text" id="observaciones" name="observaciones" class="form-control"
                                value="{{ old('observaciones') }}">
                            @error('observaciones')<small style="color:red">{{ $message }}</small>@enderror
                        </div>
                    </div>

                    <hr>
                    <a href="{{ route('admin.cargas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Registrar Asignación</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Agregar evento de envío del formulario
        document.querySelector('form').addEventListener('submit', function (e) {
            console.log('Formulario enviado');
            e.preventDefault();  // Evita el envío para depurar
            e.target.submit();   // Enviar el formulario realmente
        });

        // Función autoejecutable para manejar la lógica del formulario
        (function () {
            // Selección de elementos del DOM
            const cursoSel = document.getElementById('curso_id');
            const info = document.getElementById('infoCurso');
            const inpGr = document.getElementById('grupos_asignados');
            const inpHt = document.getElementById('horas_t_carga');
            const inpHp = document.getElementById('horas_p_carga');
            const inpTot = document.getElementById('total_horas');

            // Función para limitar los valores dentro de un rango
            function clamp(v, min, max) {
                v = Number(v || 0);
                return Math.max(min, Math.min(max, v));
            }

            // Función para actualizar los valores basados en la selección del curso
            function refresh() {
                const opt = cursoSel.options[cursoSel.selectedIndex];
                if (!opt || !opt.dataset) return;

                // Obtener los datos del curso seleccionado
                const horasP = Number(opt.dataset.horasp || 0);  // Horas prácticas
                const horasT = Number(opt.dataset.horast || 0);  // Horas teóricas
                const grupos = Number(opt.dataset.grupos || 0);  // Total de grupos
                const dispG = Number(opt.dataset.gruposDisp || opt.getAttribute('data-grupos-disp') || 0); // Grupos disponibles
                const dispHT = Number(opt.dataset.horastDisp || opt.getAttribute('data-horast-disp') || 0); // Horas teóricas disponibles

                // Establecer los límites máximos de grupos y horas teóricas
                inpGr.max = dispG;
                inpHt.max = dispHT;

                // Corregir los valores si exceden los límites
                inpGr.value = clamp(inpGr.value, 0, dispG);
                inpHt.value = clamp(inpHt.value, 0, dispHT);

                // Cálculos para las horas prácticas y el total de horas
                const hp = Number(inpGr.value) * horasP;
                const tot = hp + Number(inpHt.value);

                // Actualizar los campos con los resultados
                inpHp.value = hp;
                inpTot.value = tot;

                // Mostrar la disponibilidad en la interfaz de usuario
                info.textContent =
                    `Disponibilidad: ${dispG} grupo(s) práctico(s) y ${dispHT} h teóricas. ` +
                    `(Curso: ${horasT}h T, ${horasP}h P, ${grupos} grupo(s) totales)`;
            }

            // Agregar los escuchadores de eventos
            cursoSel.addEventListener('change', refresh); // Al cambiar el curso
            inpGr.addEventListener('input', refresh);     // Al ingresar grupos prácticos
            inpHt.addEventListener('input', refresh);     // Al ingresar horas teóricas
            document.addEventListener('DOMContentLoaded', refresh); // Cuando la página se carga
        })();
    </script>




@endsection