@extends('welcome')

@section('content')

{{-- Titulo --}}
<div class="text-center mt-4">
    <h2>Crear Tareas</h2>
</div>

{{-- Agreger Tarea --}}
<div class="text-right mt-4">
    <button class="btn btn-primary" id="agregarTarea">Agregar Tarea</button>
</div>

{{-- Tabla --}}
<div class="mt-4">
    <table class="table table-bordered table-sm" id="tabla_tareas">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tarea</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>


</div>

{{-- Modal Crear/Editar Tarea --}}
<div class=" modal fade" id="modalTarea" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {{-- Formulario --}}
            <form name="formTarea" id="formTarea">
                {{-- @csrf --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear una Tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom_tarea">Descripción de la Tarea</label>
                        <input type="text" class="form-control" name="des_tarea" id="des_tarea" autofocus>
                        {{-- Errores --}}
                        <div class="text-danger py-0 pl-2 mb-0 mt-2 d-none" id="des_tarea-error">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- Input hidden --}}
                    <input type="hidden" name="tarea_id" id="tarea_id">
                    <input type="hidden" value="Agregar" name="action" id="action">
                    <button type="submit" class="btn btn-primary w-100px action_button">Crear</button>
                    <button type="button" class="btn btn-danger w-100px" id="cerrarModalBtn">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Modal Eliminar --}}
<div class="modal fade" id="modalEliminarTarea">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title">Eliminar Tarea</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <span>¿Está seguro de eliminar esta tarea?</span>
            </div>
            <div class="modal-footer justify-content-center border-top-0">
                <button type="button" class="btn btn-danger" id="eliminaTareaBtn">Si, Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancelar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="{{ asset('scripts/script_tarea.js') }}"></script>

@endsection
