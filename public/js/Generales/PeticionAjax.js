class Peticion {
    constructor(tabla, urlTabla, columnasTablas, anchoColumnas) {
        this.tabla = tabla;
        this.urlTabla = urlTabla;
        this.columnasTablas = columnasTablas;
        this.anchoColumnas = anchoColumnas;
    }

    set setTabla(tabla) {
        this.tabla = tabla;
    }

    get getTabla() {
        return this.tabla;
    }

    set setUrlTabla(urlTabla) {
        this.urlTabla = urlTabla;
    }

    get getUrlTabla() {
        return this.urlTabla;
    }

    set setColumnasTabla(columnasTablas) {
        this.columnasTablas = columnasTablas;
    }

    get getColumnasTablas() {
        return this.columnasTablas;
    }

    set setAnchoColumnas(anchoColumnas){
        this.anchoColumnas = anchoColumnas;
    }

    get getAnchoColumnas(){
        return this.AnchoColumnas;
    }

    set setUrlPeticion(urlPeticion) {
        this.urlPeticion = urlPeticion;
    }

    get getUrlPeticion() {
        return this.urlPeticion;
    }

    set setMethodPeticion(methodPeticion) {
        this.methodPeticion = methodPeticion;
    }

    get getMethodPeticion() {
        return this.methodPeticion;
    }

    set setDatosPeticion(datosPeticion) {
        this.datosPeticion = datosPeticion;
    }

    get getDatosPeticion() {
        return this.datosPeticion;
    }

    set setFormulario(formulario){
        this.formulario = formulario;
    }

    get getFormulario(){
        return this.formulario;
    }

    set setModal(modal){
        this.modal = modal;
    }

    get getModal(){
        return this.modal;
    }

    set setBtnModal(btnModal){
        this.btnModal = btnModal;
    }

    get getBtnModal(){
        return this.btnModal;
    }

    iniciarTabla() {
        $(this.getTabla).dataTable().fnDestroy();
        let errorOcurrido = false;
        let tabla = $(this.getTabla).DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: this.getUrlTabla,
                type: "GET",
                error: (xhr, error, thrown) => {
                    console.log("Error al inicializar la tabla: " + thrown );              
                },
            },
            columns: this.getColumnasTablas,
            columnDefs: this.getAnchoColumnas,
            language: {
                decimal: "",
                emptyTable: "No hay ningún registro",
                info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                infoEmpty: "Mostrando 0 a 0 de 0 Registros",
                infoFiltered: "(Filtrado de _MAX_ total registros)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_ Entradas",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                search: "Buscar:",
                zeroRecords: "No se encontraron resultados",
                paginate: {
                    first: "Primero",
                    last: "Ultimo",
                    next: "Siguiente",
                    previous: "Anterior",
                },
            },
            scrollY: "300px",
            scrollX: "300px",
            scrollCollapse: true,
            order: [0, "desc"],
            // drawCallback: function () {
            //     var table = this.api();
            
            //     // Agregar evento de escucha al checkbox del encabezado de selección
            //     $(table.table().container()).find('thead tr td input[type="checkbox"]').on('click', function () {
            //       var checkbox = $(this);
            //       var rows = table.rows({ search: 'applied' }).nodes();
                  
            //       // Marcar o desmarcar todas las filas según el estado del checkbox
            //       if (checkbox.prop('checked')) {
            //         $(rows).find('input[type="checkbox"]').prop('checked', true);
            //       } else {
            //         $(rows).find('input[type="checkbox"]').prop('checked', false);
            //       }
            //     });
            //   },
            
        });
    }


    insertarRegistro() {
        $.ajax({
            url: this.getUrlPeticion,
            type: "POST",
            data: {
                Datos: this.getDatosPeticion,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            //Cuando se este enviando la petición se cambia el mensaje del boton
            beforeSend: () => {
                $(this.getBtnModal).html(
                    '<i class="fa fa-spin fa-spinner"></i> Guardando...'
                );
                $(this.getBtnModal).addClass("btn-warning");
                console.log(this.getBtnModal);
            },
            //En caso de recibir una respuesta correcta del servidor
            success: (response) => {
                if (response) {
                    if (response.status == "success") { 
                        $(this.getModal).modal("hide"); //Ocultamos el modal
                        $(this.getFormulario)[0].reset(); //Borramos todos los datos del formulario
                        verAlerta(
                            response.titulo,
                            response.mensaje,
                            response.status
                        );
                        verAlertaSuperior("Registro exitoso", "Nuevo registro", "success", 5000);
                        $(this.getTabla).DataTable().ajax.reload(null, false);
                    }else if(response.status = "error"){
                            verAlerta(
                                //Mandamos a llamar la funcion para mostrar la alerta
                                response.titulo,
                                response.mensaje,
                                response.status
                            );
                            verAlertaSuperior("Error", "Error", "error", 5000);
                        
                    }
                    $(this.getBtnModal).text("Guardar");
                    $(this.getBtnModal).removeClass("btn-warning");
                }
            },
            error: (data) =>{
                verAlerta(
                    "No se pudo acceder al registro",
                    `Estatus: ${data.statusText} <br> Causa: ${data.responseJSON.message}`,
                    "error"
                );
                $(this.getBtnModal).text("Guardar");
                $(this.getBtnModal).removeClass("btn-warning");
            },
        });
        console.log(this.iniciarTabla);
    }

    verDetallesRegistro(successCallback){
        $.ajax({
            url: this.getUrlPeticion,
            type: "GET",
            data: {
                Datos: this.getDatosPeticion,
            },
            success: function (response) {  
                if (response.status == "error") {
                    verAlerta(
                        //Mandamos a llamar la funcion para mostrar la alerta
                        response.titulo,
                        response.mensaje,
                        response.status
                    );
                    verAlertaSuperior("Error", "Error", "error", 5000);
                }else if (typeof successCallback === 'function') {
                    successCallback(response);
                }
            },
            error: function (data) {
                verAlerta(
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
    }

    modificarRegistro(){
        $.ajax({
            url: this.getUrlPeticion,
            type: "POST",
            data: {
                Datos: this.getDatosPeticion,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            beforeSend: () => {
                $(this.getBtnModal).html(
                    '<i class="fa fa-spin fa-spinner"></i> Actualizando...'
                );
                $(this.getBtnModal).addClass("btn-warning");
            },
            success: (response) => {
                if (response) {
                    if (response.status == "success") {
                        $(this.getModal).modal("hide"); //Ocultamos el modal
                        $(this.getFormulario)[0].reset(); //Borramos todos los datos del formulario
                        verAlerta(
                            response.titulo,
                            response.mensaje,
                            response.status
                        );
                        verAlertaSuperior("Registro exitoso", "Nuevo registro", "success", 5000);
                        $(this.getTabla).DataTable().ajax.reload(null, false);
                    }else if(response.status = "error"){
                            verAlerta(
                                //Mandamos a llamar la funcion para mostrar la alerta
                                response.titulo,
                                response.mensaje,
                                response.status
                            );
                            verAlertaSuperior("Error", "Error", "error", 5000);
                        
                    }
                    $(this.getBtnModal).text("Editar");
                    $(this.getBtnModal).removeClass("btn-warning");
                }
            },
            error: (data) =>{
                verAlerta(
                    "No se pudo acceder al registro",
                    `Estatus: ${data.statusText} <br> Causa: ${data.responseJSON.message}`,
                    "error"
                );
                $(this.getBtnModal).text("Editar");
                $(this.getBtnModal).removeClass("btn-warning");
            },
        });
    }

    eliminacionRegistros(){
        if(this.getDatosPeticion.length > 0){
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
                        url: this.getUrlPeticion,
                        type: "POST",
                        data: {
                            Datos: this.getDatosPeticion,
                        },
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: (response) => {

                            if (response.status == "success") {
                                verAlerta(
                                    response.titulo,
                                    response.mensaje,
                                    response.status
                                );
                                verAlertaSuperior("Eliminación exitosa", "Eliminación", "success", 5000);
                                $(this.getTabla).DataTable().ajax.reload(null, false);
                            }else if(response.status = "error"){
                                    verAlerta(
                                        //Mandamos a llamar la funcion para mostrar la alerta
                                        response.titulo,
                                        response.mensaje,
                                        response.status
                                    );
                                    verAlertaSuperior("Error", "Error", "error", 5000);
                                
                            }
                            cambiarBotones();
                        },
                        error: function (data) {
                            verAlerta(
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
                verAlerta("Eliminación cancelada", "El proceso de eliminación fue cancelado", "warning");
                toastr.error(
                    "Eliminación cancelada",
                    "Se canceló el proceso de eliminación",
                    {
                        timeOut: 5000,
                    }
                );
            });
        }else{
            verAlerta(
                "No existen registros seleccionados",
                "Por favor seleccione los registros a eliminar",
                "warning"
            );
        }
        
        
    }

}


function verAlerta(titulo, mensaje, tipo) {
    swal({
        allowOutsideClick: false,
        allowEscapeKey: false,
        title: titulo,
        html: mensaje,
        type: tipo,
    });
}

function verAlertaSuperior(titulo, mensaje, tipo, tiempo){
    if(tipo == "error"){
        toastr.error(
            //Mostramos una alerta simple
            titulo,
            mensaje,
            {
                timeOut: tiempo,
            }
        );
    }else if( tipo == "success"){
        toastr.success(
            //Mostramos una alerta simple
            titulo,
            mensaje,
            {
                timeOut: tiempo,
            }
        );
    }
}




jQuery.extend(jQuery.validator.messages, {
    required: "Este campo es obligatorio.",
    remote: "Por favor, rellena este campo.",
    email: "Por favor, escribe una dirección de correo válida",
    url: "Por favor, escribe una URL válida.",
    date: "Por favor, escribe una fecha válida.",
    dateISO: "Por favor, escribe una fecha (ISO) válida.",
    number: "Por favor, escribe un número entero válido.",
    digits: "Por favor, escribe sólo dígitos.",
    creditcard: "Por favor, escribe un número de tarjeta válido.",
    equalTo: "Por favor, escribe el mismo valor de nuevo.",
    accept: "Por favor, escribe un valor con una extensión aceptada.",
    maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
    minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
    rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
    range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
    max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
    min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
});