
let columnas = [
    { data: "Id_Ejemplo", name: "Id_Ejemplo", className: "d-none" },
    {
        data: null,
        name: "checkbox",
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
            return (
                "<td class='text-center'><input type='checkbox' class='eliminarMasivo_checkbox' id=" +
                data.Id_Ejemplo +
                "></td>"
            );
        }, className:"text-center"
    },
    { data: "Nombre", name: "Nombre" }, // Columna 2: Nombre
    { data: "Descripcion", name: "Descripcion" }, // Columna 3: Email
    {
        data: null,
        name: "acciones",
        orderable: false,
        searchable: false,
        render: function (data) {
            var verBtn =
                "<a href='#' Id_Ejemplo=" +
                data.Id_Ejemplo +
                " id='verEjemplo' title='Detalles de " +
                data.Id_Ejemplo +
                "' class='btn btn-warning text-white m-1' data-toggle='modal' data-target='#modalVer'>Ver<a/>";
            var editarBtn =
                "<a href='#' Id_Ejemplo=" +
                data.Id_Ejemplo +
                " id='editarEjemplo' title='Modificar a " +
                data.Id_Ejemplo +
                "' class='btn btn-success m-1 ' data-toggle='modal' data-target='#modalEditar'>Editar<a/>";
            var eliminarBtn =
                "<a href='#' Id_Ejemplo=" +
                data.Id_Ejemplo +
                " id='borrarEjemplo' title='Eliminar a " +
                data.Id_Ejemplo +
                "' class='btn btn-danger m-1'>Eliminar<a/>";
            return verBtn + " " + editarBtn + " " + eliminarBtn;
        },
    },
];
let anchoColumnas = [
    { width: "10%", targets: 0 }, // Establecer el ancho de la primera columna a 150px
    { width: "5%", targets: 1 },
    { width: "35%", targets: 2 },
    { width: "30%", targets: 3 },
    { width: "30%", targets: 4 },
];

let tabla = document.getElementById("table-ejemplo");

let objeto = new Peticion(tabla, "/ejemplo2/fetch", columnas, anchoColumnas);

$(document).ready(function () {
    objeto.iniciarTabla();
});

$(document).on("click", "#btnAgregar", function () {
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
                pattern:
                    "^[a-zA-Z'.\\s.\\d._.!.¡.?.¿.{.}.$.^.-.'.+.*.&.%.#,°,=.ñ.Ñ]{1,250}$",
            },
            Descripcion: {
                required: true,
                pattern:
                    "^[a-zA-Z'.\\s.\\d._.!.¡.?.¿.{.}.$.^.-.'.+.*.&.%.#,°,=.ñ.Ñ]{1,250}$",
            },
        },
        //Si todas las reglas se cumplen se comienza con el envio del formulario
        submitHandler: function (form) {
            let formulario = document.getElementById("registro-ejemplo");
            let modal = document.getElementById("modalCustom");
            let btnModal = document.getElementById("btnAgregar");
            let datos = {
                _token: $('meta[name="csrf-token"]').attr("content"),
                nombre: $('[name="Nombre"]').val(),
                descripcion: $('[name="Descripcion"]').val(),
            };
            objeto.setUrlPeticion = "/ejemplo2/store";
            objeto.setDatosPeticion = datos;
            objeto.setFormulario = formulario;
            objeto.setModal = modal;
            objeto.setBtnModal = btnModal;
            objeto.insertarRegistro();
        },
    });
});

$(document).on("click", "#verEjemplo", function () {
    var id = $(this).attr("Id_Ejemplo");
    let datos = {
        Id_Ejemplo: id,
        _token: "{{ csrf_token() }}",
    };
    objeto.setUrlPeticion = "/ejemplo2/consultar";
    objeto.setDatosPeticion = datos;

    objeto.verDetallesRegistro(function (e) {
        $("#Id3").val(e.Id_Ejemplo);
        $("#Nombre3").val(e.Nombre);
        $("#Descripcion3").val(e.Descripcion);
    });
});

$(document).on("click", "#editarEjemplo", function () {
    var id = $(this).attr("Id_Ejemplo");
    let datos = {
        Id_Ejemplo: id,
        _token: "{{ csrf_token() }}",
    };
    objeto.setUrlPeticion = "/ejemplo2/consultar";
    objeto.setDatosPeticion = datos;
    objeto.verDetallesRegistro(function (e) {
        $("#Id2").val(e.Id_Ejemplo);
        $("#Nombre2").val(e.Nombre);
        $("#Descripcion2").val(e.Descripcion);
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
                pattern:
                    "^[a-zA-Z'.\\s.\\d._.!.¡.?.¿.{.}.$.^.-.'.+.*.&.%.#,°,=.ñ.Ñ]{1,250}$",
            },
        },
        submitHandler: function (form) {
            let formulario = document.getElementById("actualizacion-ejemplo");
            let modal = document.getElementById("modalEditar");
            let btnModal = document.getElementById("btnEditar");
            let datos = {
                _token: $('meta[name="csrf-token"]').attr("content"),
                idEjemplo: $('[name="Id2"]').val(),
                nombre: $('[name="Nombre2"]').val(),
                descripcion: $('[name="Descripcion2"]').val(),
            };

            objeto.setUrlPeticion = "/ejemplo2/actualizar";
            objeto.datosPeticion = datos;
            objeto.setFormulario = formulario;
            objeto.setModal = modal;
            objeto.setBtnModal = btnModal;
            objeto.modificarRegistro();
        },
    });
});

$(document).on("click", "#borrarEjemplo", function () {
    let arrayElementos = [];
    arrayElementos.push($(this).attr('Id_Ejemplo'));
    objeto.setUrlPeticion = "/ejemplo2/eliminar";
    objeto.datosPeticion = arrayElementos;
    console.log(arrayElementos);
    objeto.eliminacionRegistros();
});

$(document).on("click", ".btnEliminarMasivo", function(){
    let arrayElementos = [];
    $("input:checkbox[class=eliminarMasivo_checkbox]:checked").each(function(){
        arrayElementos.push($(this).attr('id'));
    });
    objeto.setUrlPeticion = "/ejemplo2/eliminar";
    objeto.datosPeticion = arrayElementos;
    objeto.eliminacionRegistros();
    
});


