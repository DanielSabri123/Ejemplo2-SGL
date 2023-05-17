@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EJEMPLO</h1>
@stop

@section('content')
<p>Ejemplo</p>
<div class="d-flex justify-content-end mb-2">
    <x-adminlte-button label="Nuevo" data-toggle="modal" id="nuevo" data-target="#modalCustom" class="bg-green" title="Agregar un ejemplo nuevo" />
</div>

<div class="card-body" id="show_all_ejemplos">
    <h1 class="text-center text-secondary my-5">Loading...</h1>
</div>

<x-adminlte-modal id="modalCustom" title="Registrar ejemplo" size="md" class="ml-auto" theme="dark" icon="fa-circle-plus" v-centered
    static-backdrop scrollable>
    <form id="registro-ejemplo">
        @csrf
        <div style="height:200px;" >
                <div class="d-block mb-0 " >
                    <x-adminlte-input name="Nombre" label="Nombre" placeholder="placeholder" id="Nombre" type="text"
                        fgroup-class="col-md-12" disable-feedback />
                </div>
            <div class="d-block">
                <x-adminlte-input name="Descripcion" id="Descripcion" label="Descripción" placeholder="placeholder"
                    type="text" fgroup-class="col-md-12" disable-feedback />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" class="ml-auto" label="Cerrar" data-dismiss="modal" />
            <x-adminlte-button class="btn-flat" id="btnAgregar" type="submit" label="Agregar" theme="success"
                form="registro-ejemplo" />
        </x-slot>
    </form>
</x-adminlte-modal>
{{-- Example button to open modal --}}


<x-adminlte-modal id="modalEditar" title="Actualizar ejemplo" size="md" theme="dark" icon="fa-circle-plus"
    v-centered static-backdrop scrollable>
    <form id="actualizacion-ejemplo">
        @csrf
        <div style="height:170px;">
            <div class="row d-none">
                <x-adminlte-input name="Id2" label="Id" placeholder="placeholder" id="Id2" type="text"
                    fgroup-class="col-md-12" disable-feedback />
            </div>
            <div class="row">
                <x-adminlte-input name="Nombre2" label="Nombre" placeholder="placeholder" id="Nombre2" type="text"
                    fgroup-class="col-md-12" disable-feedback />
            </div>
            <div class="row">
                <x-adminlte-input name="Descripcion2" id="Descripcion2" label="Descripción" placeholder="placeholder"
                    type="text" fgroup-class="col-md-12" disable-feedback />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" class="ml-auto" label="Cerrar" data-dismiss="modal" />
            <x-adminlte-button class="btn-flat" type="submit" id="btnEditar" label="Editar" theme="primary"
                form="actualizacion-ejemplo" />
        </x-slot>
    </form>
</x-adminlte-modal>
{{-- Example button to open modal --}}

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
{{-- Example button to open modal --}}
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
    
    <script>
        $(document).ready(function () {
            $("#registro-ejemplo").validate({
                ignore: [],
                errorClass: "border-danger text-danger",
                errorElement: "x-adminlte-input",
                errorPlacement: function (error, e) {
                    jQuery(e).parents(".form-group").append(error);
                },
                rules: {
                    Nombre: {
                        required: true,
                        minlength: 5,
                    },
                    Descripcion: {
                        required: true,
                    },
                },
                messages: {
                    Nombre: {
                        required: "Por favor ingresa el nombre",
                        minlength: "El nombre debe ser de no menos de 5 caracteres",
                    },
                    Descripcion: "Por favor ingresa una descripción",
                },
                submitHandler: function (form) { 
                    let Nombre = $("#Nombre").val();
                    let Descripcion = $("#Descripcion").val();
                    let _token = $("input[name=_token]").val();
                    $.ajax({
                        url: "{{route('ejemplo.store')}}",
                        type: "POST",
                        data: {
                            Nombre: Nombre,
                            Descripcion: Descripcion,
                            _token: _token,
                        },
                        beforeSend: function () {
                            $("#btnAgregar").html(
                                '<i class="fa fa-spin fa-spinner"></i> Guardando...'
                            );
                        },
                        success: function (response) {
                            if (response) {
                                $("#modalCustom").modal("hide");
                                $("#registro-ejemplo")[0].reset();
                                if(response.status == 200){
                                    show_swal(
                                    "Registro exitoso de ejemplo",
                                    "El ejemplo se realizo de porfa correcta",
                                    "success"
                                );
                                }
                                toastr.success(
                                    "Ejemplo registrado exitosamente",
                                    "Nuevo ejemplo",
                                    {
                                        timeOut: 5000,
                                    }
                                );
                                fetchEjemplos();
                            }
                            cambiarBotones();
                        },
                        error: function (data) {
                            show_swal(
                                "No se pudo realizar el registro",
                                `Estatus: ${data.statusText} <br> Causa: ${data.responseJSON.message}`,
                                "error"
                            );
                            toastr.error(
                                "No se pudo registrar el ejemplo",
                                "Error de registro",
                                {
                                    timeOut: 5000,
                                }
                            );
                            cambiarBotones();
                        },
                    });
                },
            });
        });

        fetchEjemplos();
        function fetchEjemplos(){
            $.ajax({
                url: "{{route('ejemplo.fetch')}}",
                type: "get",
                success: function (response) {
                    $("#show_all_ejemplos").html(response);
                    $("table").DataTable({
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay ningún registro",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                            "infoFiltered": "(Filtrado de _MAX_ total resgitros)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },
                        order: [0, 'desc']
                    });
                }
            });
        }

        $(document).on("click", ".editIcon", function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: "{{route('ejemplo.show')}}",
                type: "GET",
                data: {
                    Id_Ejemplo: id,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    if (response) {
                        $("#Id2").val(response.Id_Ejemplo);
                        $("#Nombre2").val(response.Nombre);
                        $("#Descripcion2").val(response.Descripcion);
                    }
                },
                error: function (data) {
                    show_swal(
                        "No se pudo acceder al registro",
                        `Estatus: ${data.statusText} <br> Causa: ${data.responseJSON.message}`,
                        "error"
                    );
                    toastr.error(
                        "No se pudo acceder al registro",
                        "Error de acceso",
                        {
                            timeOut: 5000,
                        }
                    );
                    cambiarBotones();
                },
            });
        });


        $(document).ready(function () {
            $("#actualizacion-ejemplo").validate({
                ignore: [],
                errorClass: "border-danger text-danger",
                errorElement: "x-adminlte-input",
                errorPlacement: function (error, e) {
                    jQuery(e).parents(".form-group").append(error);
                },
                rules: {
                    Nombre2: {
                        required: true,
                        minlength: 5,
                    },
                    Descripcion2: {
                        required: true,
                    },
                },
                messages: {
                    Nombre2: {
                        required: "Por favor ingresa el nombre",
                        minlength: "El nombre debe ser de no menos de 5 caracteres",
                    },
                    Descripcion2: "Por favor ingresa una descripción",
                },
                submitHandler: function (form) { 
                    let Id_Ejemplo = $("#Id2").val();
                    let Nombre = $("#Nombre2").val();
                    let Descripcion = $("#Descripcion2").val();
                    let _token = $("input[name=_token]").val();
                    swal({
                        title: '¿Estás seguro de realizar la actualización?',
                        text: 'Antes de confirmar verifica que la información introducida sea correcta.',
                        type: 'warning',
                        showCancelButton: true,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, actualizar',
                        cancelButtonText: 'No, cancelar',
                        cancelButtonColor: '#d50a0a'
                    }).then(r => {
                        $.ajax({
                            url: "{{route('ejemplo.update')}}",
                            type: "POST",
                            data: {
                                Id_Ejemplo: Id_Ejemplo,
                                Nombre: Nombre,
                                Descripcion: Descripcion,
                                _token: _token,
                            },
                            beforeSend: function () {
                                $("#btnEditar").html(
                                    '<i class="fa fa-spin fa-spinner"></i> Actualizando...'
                                );
                            },
                            success: function (response) {
                                if (response) {
                                    $("#modalEditar").modal("hide");
                                    $("#actualizacion-ejemplo")[0].reset();
                                    if(response.status == 200){
                                        show_swal(
                                            "Actualización exitosa",
                                            "El ejemplo se actualizó",
                                            "success"
                                        );
                                    }
                                    toastr.success(
                                        "Ejemplo actualizado exitosamente",
                                        "Actualización de ejemplo",
                                        {
                                            timeOut: 5000,
                                        }
                                    );
                                    fetchEjemplos();
                                }
                                cambiarBotones();
                            },
                            error: function (data) {
                                show_swal(
                                    "No se pudo actualizar el ejemplo",
                                    `Estatus: ${data.statusText} <br> Causa: ${data.responseJSON.message}`,
                                    "error"
                                );
                                toastr.error(
                                    "No se pudo actualizar el ejemplo",
                                    "Error de actualización",
                                    {
                                        timeOut: 5000,
                                    }
                                );
                                cambiarBotones();
                            },
                        });
                    }).catch(() => {
                        toastr.error(
                            "Actualización cancelada",
                            "Se canceló el proceso de actualización",
                            {
                                timeOut: 5000,
                            }
                        );
                    })
                },
            });
        });


        $(document).on("click", ".deleteIcon", function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            swal({
                title: '¿Estás seguro?',
                text: 'Al hacer esto el ejemplo será eliminado.',
                type: 'warning',
                showCancelButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'No, cancelar',
                cancelButtonColor: '#d50a0a'
            }).then(r => {
                $.ajax({
                        url: "{{route('ejemplo.destroy')}}",
                        type: "POST",
                        data: {
                            Id_Ejemplo: id,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            show_swal(
                                "Ejemplo eliminado",
                                "El ejemplo se eliminó de correcta",
                                "success"
                            );
                            toastr.success(
                                "Eliminación exitosa",
                                "El ejemplo fue eliminado",
                                {
                                    timeOut: 5000,
                                }
                            );
                            fetchEjemplos();
                        },
                        error: function (data) {
                            console.log(data);
                            show_swal(
                                "No se pudo eliminar el registro",
                                `Estatus: ${data.statusText} <br> Causa: ${data.responseJSON.message}`,
                                "error"
                            );
                            toastr.error(
                                "No se pudo eliminar el ejemplo",
                                "Error de eliminación",
                                {
                                    timeOut: 5000,
                                }
                            );
                            cambiarBotones();
                        },
                    });
            }).catch(() => {
                show_swal("Eliminación cancelada", "El proceso de eliminación fue cancelado", "warning");
                toastr.error(
                    "Eliminación cancelada",
                    "Se canceló el proceso de eliminación",
                    {
                        timeOut: 5000,
                    }
                );
            });
        });

        $(document).on("click", ".showIcon", function () {
            let id = $(this).attr('id');
            $.ajax({
                url: "{{route('ejemplo.show')}}",
                type: "GET",
                data: {
                    Id_Ejemplo: id,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    if (response) {
                        $("#Id3").val(response.Id_Ejemplo);
                        $("#Nombre3").val(response.Nombre);
                        $("#Descripcion3").val(response.Descripcion);
                    }
                },
                error: function (data) {
                    show_swal(
                        "No se pudo acceder al registro",
                        `Estatus: ${data.statusText} <br> Causa: ${data.responseJSON.message}`,
                        "error"
                    );
                    toastr.error(
                        "No se pudo acceder al registro",
                        "Error de acceso",
                        {
                            timeOut: 5000,
                        }
                    );
                    cambiarBotones();
                },
            });
        });

        function show_swal(titulo, mensaje, tipo) {
            swal({
                allowOutsideClick: false,
                allowEscapeKey: false,
                title: titulo,
                html: mensaje,
                type: tipo,
            });
        };

        function cambiarBotones() {
            $("#btnAgregar").text("Guardar");
            $("#btnAgregar").removeClass("btn-warning");
            $("#btnEditar").text("Actualizar");
            $("#btnEditar").removeClass("btn-warning");
        }
    </script>
@stop
