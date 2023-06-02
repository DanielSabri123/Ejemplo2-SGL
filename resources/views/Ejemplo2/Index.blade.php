@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EJEMPLO</h1>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('content')
<p>Ejemplo</p>

{{-- Botones que aparecen en el encabezado para eliminar o agregar registros --}}
<div class="d-flex justify-content-end mb-2">
    <x-adminlte-button label="Eliminar Todos" class=" btnEliminarMasivo bg-danger mr-2" title="Borrar todos los elementos seleccionados" /> <!--Boton para eliminar en masivo-->
    <x-adminlte-button label="Nuevo" data-toggle="modal" id="btnNuevoEjemplo" data-target="#modalCustom" class="bg-green" title="Agregar un ejemplo nuevo" /> <!--Boton para agregar un nuevo registro-->
</div>

{{-- Inicio de tabla --}}
<table id='table-ejemplo' class='table table-hoverdisplay table-striped table-hover responsive no-wrap' width='100%'>
    {{-- Encabezado de tabla --}}
    <thead class='bg-dark'>
        <tr>
            <td width='10%' class="d-none">ID</td>
            <td width='5%'>
                <input type="checkbox" id="checkAll">
              </td>
            <td width='35%'>Nombre</td>
            <td width='30%'>Descripcion</td>
            <td width='30%'>Acciones</td>
        </tr>
    </thead>
    {{-- Cuerpo de la tabla --}}
    <tbody id="show"></tbody>
</table>

{{-- Modal para agregar un nuevo registro --}}
<x-adminlte-modal id="modalCustom" title="Registrar ejemplo" size="md" class="ml-auto" theme="dark" icon="fa-circle-plus" v-centered
    static-backdrop scrollable>
    <form id="registro-ejemplo">
        @csrf
        <div style="height:180px;" >
                <div class="d-block mb-0 " >
                    <x-adminlte-input name="Nombre" label="Nombre" placeholder="placeholder" id="Nombre" type="text"
                        fgroup-class="col-md-12 mb-2" disable-feedback />
                </div>
            <div class="d-block">
                <x-adminlte-input name="Descripcion" id="Descripcion" label="Descripción" placeholder="placeholder"
                    type="text" fgroup-class="col-md-12 mb-2" disable-feedback />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" class="ml-auto" label="Cerrar" data-dismiss="modal" />
            <x-adminlte-button class="btn-flat" id="btnAgregar" type="submit" label="Agregar" theme="success"
                form="registro-ejemplo" />
        </x-slot>
    </form>
</x-adminlte-modal>
{{-- Fin de modal para agregar un registro --}}

{{-- Modal para editar un registro --}}
<x-adminlte-modal id="modalEditar" title="Actualizar ejemplo" size="md" theme="dark" icon="fa-circle-plus"
    v-centered static-backdrop scrollable>
    <form id="actualizacion-ejemplo">
        @csrf
        <div style="height:180px;">
            <div class="d-none">
                <x-adminlte-input name="Id2" label="Id" placeholder="placeholder" id="Id2" type="text"
                    fgroup-class="col-md-12 mb-2" disabled disable-feedback />
            </div>
            <div class="d-block">
                <x-adminlte-input name="Nombre2" label="Nombre" placeholder="placeholder" id="Nombre2" type="text"
                    fgroup-class="col-md-12 mb-2" disable-feedback />
            </div>
            <div class="d-block">
                <x-adminlte-input name="Descripcion2" id="Descripcion2" label="Descripción" placeholder="placeholder"
                    type="text" fgroup-class="col-md-12 mb-2" disable-feedback />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" class="ml-auto" label="Cerrar" data-dismiss="modal" />
            <x-adminlte-button class="btn-flat" type="submit" id="btnEditar" label="Editar" theme="primary"
                form="actualizacion-ejemplo" />
        </x-slot>
    </form>
</x-adminlte-modal>
{{-- Fin de modal para editar un registro --}}

{{-- Modal para ver los datos de un registro --}}
<x-adminlte-modal id="modalVer" title="Detalles ejemplo" size="md" theme="dark" icon="fa-circle-plus"
    v-centered static-backdrop scrollable>
    <form id="ver-ejemplo">
        @csrf
        <div style="height:170px;">
            <div class="row d-none">
                <x-adminlte-input name="Id3" label="Id3" placeholder="placeholder" id="Id2" type="text"
                    fgroup-class="col-md-12" disabled disable-feedback />
            </div>
            <div class="row">
                <x-adminlte-input name="Nombre3" label="Nombre" placeholder="placeholder" id="Nombre3" type="text"
                    fgroup-class="col-md-12" disabled disable-feedback />
            </div>
            <div class="row">
                <x-adminlte-input name="Descripcion3" id="Descripcion3" label="Descripción" placeholder="placeholder"
                    type="text" fgroup-class="col-md-12" disabled disable-feedback />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" class="ml-auto" label="Cerrar" data-dismiss="modal" />
        </x-slot>
    </form>
</x-adminlte-modal>
{{-- FIn de modal para ver los detalles de un registro --}}
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link rel="stylesheet" href="js/plugins/sweetalert/sweetalert2.css">

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="js/plugins/sweetalert/sweetalert2.js" charset="UTF-8"></script>
    <script src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/plugins/jquery-validation/additional-methods.js"></script>

    <script src="js/Generales/PeticionAjax.js"></script>
    <script src="js/Ejemplo/Index.js"></script>
@stop
