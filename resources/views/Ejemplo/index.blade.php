@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EJEMPLO</h1>
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
            <td width='5%'>Eliminación</td>
            <td width='35%'>Nombre</td>
            <td width='30%'>Descripcion</td>
            <td width='25%'>Acciones</td>
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

    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    



    
    <script>
        //Cuando el documento se carga se manda a llamar la función para traer los registros y pintar la tabla
        $(document).ready(function () {
            $("#table-ejemplo").DataTable({
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay ningún registro",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 a 0 de 0 Registros",
                            "infoFiltered": "(Filtrado de _MAX_ total registros)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "No se encontraron resultados",
                            "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf'
                        ],
                        order: [0, 'desc']
                    });
            fetchRegistros();
        });

        //función para traer los registros y pintar la tabla
        function fetchRegistros(){        
            let respuesta = "";
            //Petición ajax que arma la tabla para posteriormente mostrarla en el html
            $.ajax({
                url: "{{route('ejemplo.fetch')}}",
                type: "get",
                success: function (response) {
                    for(const resp in response){
                        respuesta += "<tr>"
                            +"          <td class='text-center'>"
                            +"              <input type='checkbox' class='eliminarMasivo_checkbox' id="+response[resp].Id_Ejemplo+">"
                            +"             </td>"
                            +"        <td class='m-0 py-2 d-none'>"+response[resp].Id_Ejemplo+"</td>"
                            +"              <td class='m-0 py-2 puto'>"+response[resp].Nombre+"</td>"
                            +"              <td class='m-0 py-2'>"+response[resp].Descripcion+"</td>"
                            +"        <td class='m-0 py-0 text-center'>"
                            +"              <a href='#' Id_Ejemplo="+response[resp].Id_Ejemplo+" id='verEjemplo' title='Detalles de "+response[resp].Id_Ejemplo+"' class='btn btn-warning text-white m-1' data-toggle='modal' data-target='#modalVer'>Ver<a/>"
                            +"              <a href='#' Id_Ejemplo="+response[resp].Id_Ejemplo+" id='editarEjemplo' title='Modificar a "+response[resp].Id_Ejemplo+"' class='btn btn-success m-1 ' data-toggle='modal' data-target='#modalEditar'>Editar<a/>"
                            +"              <a href='#' Id_Ejemplo="+response[resp].Id_Ejemplo+" id='borrarEjemplo' title='Eliminar a "+response[resp].Id_Ejemplo+"' class='btn btn-danger m-1'>Eliminar<a/>"
                            +"         </td>"
                            +"   </tr>";         
                    }
                    //Eliminamos la tabla para poder iniciarla de nuevo y lea los registros en la BD
                    $("#table-ejemplo").dataTable().fnDestroy();
                    $('#show').html(respuesta);
                    //Iniciamos la tabla
                    $("#table-ejemplo").DataTable({
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay ningún registro",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 a 0 de 0 Registros",
                            "infoFiltered": "(Filtrado de _MAX_ total registros)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "No se encontraron resultados",
                            "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },dom: 'Bfrtip',
                        buttons: [
                            {
                            extend: 'excelHtml5',
                            title: 'Ejemplo',
                            className: 'btn my-4',
                            text: "Excel",
                            exportOptions: {
                                columns: [2, 3] //exportar solo la primera y segunda columna
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Ejemplo',
                            className: 'btn ',
                            text: "CSV",
                            exportOptions: {
                                columns: [2, 3] //exportar solo la primera y segunda columna
                            }
                        },
                            {
                            extend: 'pdfHtml5',
                            title: 'PDF DE EJEMPLO',
                            className: 'btn',
                            text: "PDF",
                            exportOptions: {
                                columns: [2, 3] //exportar solo la primera y segunda columna
                            }
                        },
                        {
                            extend: 'print',
                            title: 'EJEMPLO',
                            className: 'btn',
                            text: "Imprimir",
                            exportOptions: {
                                columns: [2, 3] //exportar solo la primera y segunda columna
                            }
                        },
                        {
                            extend: 'copy',
                            title: 'Data export',
                            className: 'btn ',
                            text: "Copiar",
                            exportOptions: {
                                columns: [2, 3] //exportar solo la primera y segunda columna
                            }
                        }
                        ],
                        scrollY:        "300px",
                        scrollX:        true,
                        scrollCollapse: true,
                        order: [0, 'desc'],
                        "columnDefs": [
                            { "orderable": false, "targets": 1 },//ocultar para columna 1
                            { "orderable": false, "targets": 4 },//ocultar para columna 4
                        ],
                        exportOptions: {
                            columns: [0, 1] //exportar solo la primera y segunda columna
                        }
                    });
                }
            });  
        }

        //Funcion para agregar un nuevo registro a la base de datos
        $(document).on("click", "#btnAgregar", function(){
            //validamos el formulario para evitar que ingrese información errónea
            $("#registro-ejemplo").validate({
                ignore: [],
                errorClass: "border-danger text-danger",
                errorElement: "x-adminlte-input",
                errorPlacement: function (error, e) {
                    jQuery(e).parents(".form-group").append(error);
                },
                //Reglas que tendrá cada campo en el formulario
                rules: {
                    Nombre: {
                        required: true,
                        minlength: 5,
                        pattern: "^[a-zA-Z'.\\s.\\d._.!.¡.?.¿.{.}.$.^.-.'.+.*.&.%.#,°,=.ñ.Ñ]{1,250}$",
                    },
                    Descripcion: {
                        required: true,
                        pattern: "^[a-zA-Z'.\\s.\\d._.!.¡.?.¿.{.}.$.^.-.'.+.*.&.%.#,°,=.ñ.Ñ]{1,250}$",
                    },
                },
                //Mensajes que se mostrarán en caso de no cumplir con las reglas 
                messages: {
                    Nombre: {
                        required: "Por favor ingresa el nombre",
                        minlength: "El nombre debe ser de no menos de 5 caracteres",
                        pattern: "Carácteres permitidos: _ ! ¡ ? ¿ { } $ ^ - ' + * & % # ° =",
                    },
                    Descripcion: {
                        required: "Por favor ingresa una descripción",
                        pattern: "Carácteres permitidos: _ ! ¡ ? ¿ { } $ ^ - ' + * & % # ° =",
                    }
                },
                //Si todas las reglas se cumplen se comienza con el envio del formulario
                submitHandler: function (form) { 
                    //Obtenemos los valores de los campos de texto
                    let Nombre = $("#Nombre").val();
                    let Descripcion = $("#Descripcion").val();
                    let _token = $("input[name=_token]").val();
                    //Realizamos la petición ajax
                    $.ajax({
                        url: "{{route('ejemplo.store')}}",
                        type: "POST",
                        data: {
                            Nombre: Nombre,
                            Descripcion: Descripcion,
                            _token: _token,
                        },
                        //Cuando se este enviando la petición se cambia el mensaje del boton
                        beforeSend: function () {
                            $("#btnAgregar").html(
                                '<i class="fa fa-spin fa-spinner"></i> Guardando...'
                            );
                            $("#btnAgregar").addClass("btn-warning");
                        },
                        //En caso de recibir una respuesta correcta del servidor
                        success: function (response) {
                            if (response) {
                                $("#modalCustom").modal("hide");    //Ocultamos el modal
                                $("#registro-ejemplo")[0].reset();  //Borramos todos los datos del formulario
                                if(response.status == 200){
                                    show_swal(  //Llamamos a la función que muestra las alertas
                                    "Registro exitoso de ejemplo",
                                    "El ejemplo se realizo de porfa correcta",
                                    "success"
                                );
                                }
                                toastr.success( //Mostramos una alerta simple
                                    "Ejemplo registrado exitosamente",
                                    "Nuevo ejemplo",
                                    {
                                        timeOut: 5000,
                                    }
                                );
                                fetchRegistros();   //Mandamos a llamar a la función para que actualice la tabla
                            }
                            cambiarBotones();
                        },
                        //En caso de recibir una respuesta de error por parte del servidor
                        error: function (data) {
                            show_swal(  //Mandamos a llamar la funcion para mostrar la alerta
                                "No se pudo realizar el registro",
                                `Estatus: ${data.statusText} <br> Causa: ${data.responseJSON.message}`,
                                "error"
                            );
                            toastr.error(   //Mostramos una alerta simple
                                "No se pudo registrar el ejemplo",
                                "Error de registro",
                                {
                                    timeOut: 5000,
                                }
                            );
                            cambiarBotones();   //LLamamos a la funcion para regresar el texto y los colores a los botones que se cambiaron
                        },
                    });
                },
            });
        });

        $(document).on("click", "#editarEjemplo", function () {
            let id = $(this).attr('Id_Ejemplo');
            $.ajax({
                url: "{{route('ejemplo.show')}}",
                type: "GET",
                data: {
                    Id_Ejemplo: id,
              
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


        $(document).on("click", "#btnEditar", function () {
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
                        pattern: "^[a-zA-Z'.\\s.\\d._.!.¡.?.¿.{.}.$.^.-.'.+.*.&.%.#,°,=.ñ.Ñ]{1,250}$",
                    },
                },
                messages: {
                    Nombre2: {
                        required: "Por favor ingresa el nombre",
                        minlength: "El nombre debe ser de no menos de 5 caracteres",
                        pattern: "Carácteres permitidos: _ ! ¡ ? ¿ { } $ ^ - ' + * & % # ° =",
                    },
                    Descripcion2: {
                        required: "Por favor ingresa una descripción",
                        pattern: "Carácteres permitidos: _ ! ¡ ? ¿ { } $ ^ - ' + * & % # ° =",
                    }
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
                                $("#btnEditar").addClass("btn-warning");
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
                                    fetchRegistros();
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

        $(document).on("click", "#verEjemplo", function () {
            let id = $(this).attr('Id_Ejemplo');
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

        $(document).on("click", "#borrarEjemplo", function () {
            let arrayElementos = [];
            arrayElementos.push($(this).attr('Id_Ejemplo'));
            eliminacionElementos(arrayElementos);
        });

        $(document).on("click", ".btnEliminarMasivo", function(){
            let arrayElementos = [];
            $("input:checkbox[class=eliminarMasivo_checkbox]:checked").each(function(){
                arrayElementos.push($(this).attr('id'));
            });
            if(arrayElementos.length > 0){
                eliminacionElementos(arrayElementos);
            }else{
                show_swal(
                    "No existen registros seleccionados",
                    "Por favor seleccione los registros a eliminar",
                    "warning"
                );
            }
        });

        function eliminacionElementos($array){
            swal({
                title: '¿Estás seguro?',
                text: 'Al hacer esto se realizará la eliminación.',
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
                            Id_Ejemplo: $array,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            show_swal(
                                "Eliminación exitosa",
                                "El ejemplo se eliminó de correcta",
                                "success"
                            );
                            toastr.success(
                                "Eliminación exitosa",
                                "La eliminación se realizó de forma correcta.",
                                {
                                    timeOut: 5000,
                                }
                            );
                            fetchRegistros();
                        },
                        error: function (data) {
                            show_swal(
                                "No se pudo realizar la eliminación",
                                `Estatus: ${data.statusText} <br> Causa: ${data.responseJSON.message}`,
                                "error"
                            );
                            toastr.error(
                                "No se pudo realizar la eliminación",
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
        }


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
