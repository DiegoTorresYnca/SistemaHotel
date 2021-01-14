$(document).ready(function() {
    var pais = 170;
    var departamento = "15";
    var provincia = "1501";

    $('#cliente-agregar .ubigeo_peru').css({"display":"block"});
    $('#cliente-agregar .ubigeo_extranjero').css({"display":"none"});

    $("#cliente-agregar #pais_r").load('/datos-dinamicos.php?b=PAI&cs=' + pais);
    $("#cliente-agregar #departamento_r").load('/datos-dinamicos.php?b=DEP&cf=' + pais + '&cs=' + departamento);
    $("#cliente-agregar #provincia_r").load('/datos-dinamicos.php?b=PRO&cf=' + departamento + '&cs=' + provincia);
    $("#cliente-agregar #distrito_r").load('/datos-dinamicos.php?b=DIS&cf=' + provincia);

    $("#cliente-agregar #pais_r").change(function(event){
        if ($("#cliente-agregar #pais_r").val() == 170) {
            $('#cliente-agregar .ubigeo_peru').css({"display":"block"});
            $('#cliente-agregar .ubigeo_extranjero').css({"display":"none"});
            $("#cliente-agregar #departamento_r").load('/datos-dinamicos.php?b=DEP&cf=' + pais + '&cs=' + departamento);
            $("#cliente-agregar #provincia_r").load('/datos-dinamicos.php?b=PRO&cf=' + departamento + '&cs=' + provincia);
            $("#cliente-agregar #distrito_r").load('/datos-dinamicos.php?b=DIS&cf=' + provincia);
            return;
        } else {
            $('#cliente-agregar .ubigeo_peru').css({"display":"none"});
            $('#cliente-agregar .ubigeo_extranjero').css({"display":"block"});
            return;
        }
    }); 

    $("#cliente-agregar #departamento_r").change(function(event){
        var id = $("#cliente-agregar #departamento_r").find(':selected').val();
        $("#cliente-agregar #provincia_r").load('/datos-dinamicos.php?b=PRO&cf=' + id);
        $("#cliente-agregar #distrito_r").load('/datos-dinamicos.php?b=DIS');
    }); 

    $("#cliente-agregar #provincia_r").change(function(event){
        var id = $("#cliente-agregar #provincia_r").find(':selected').val();
        $("#cliente-agregar #distrito_r").load('/datos-dinamicos.php?b=DIS&cf=' + id);
    });     

    $(".buscar_cliente").click(function(){
        event.preventDefault();

        seccion = $(this).attr('data-seccion');

        if (seccion == "registro") {
            tipo_documento = $("#cliente-agregar #tipo_documento_r");
            numero_documento = $("#cliente-agregar #numero_documento");            
        }

        if (seccion == "modificacion") { 
            tipo_documento = $("#cliente-edicion #tipo_documento");
            numero_documento = $("#cliente-edicion #numero_documento");            
        }

        if (tipo_documento.val() == 0) {
            alert("Debe de seleccionar su Tipo de Documento.");
            tipo_documento.focus();
            return;
        }

        if (numero_documento.val() == "") {
            alert("Debe de ingresar su Numero de Documento.");
            numero_documento.focus();
            return;
        } else {
            if (numero_documento.val().length < 8) {
                alert("El Numero de Documento ingresado no es valido.");
                numero_documento.focus();
                return;                
            }
        }

        $("#proceso").val('consulta-datos');

        if (seccion == "registro") {
            var datos_enviar = datos.find('#proceso, #cliente-agregar #tipo_documento_r, #cliente-agregar #numero_documento');
        }

        if (seccion == "modificacion") {
            var datos_enviar = datos.find('#proceso, #cliente-edicion #tipo_documento, #cliente-edicion #numero_documento');
        }

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=clientes",
            data: datos_enviar.serialize(),
            success: function(data) {
                if (data.length == 0) {
                    alert("No se encontraron coincidencias, ingrese los datos manualmente.");
                    return;
                } else {
                    if (data[0].existe == "N") {
                        alert("No se encontraron coincidencias, ingrese los datos manualmente.");
                        return;
                    } else {
                        documento = data[0].documento;
                        if (documento == "DNI") {
                            if (seccion == "registro") {
                                $("#cliente-agregar #apellido_paterno").val(data[0].informacion.apellido_paterno);
                                $("#cliente-agregar #apellido_materno").val(data[0].informacion.apellido_materno);
                                $("#cliente-agregar #nombre").val(data[0].informacion.nombres);
                            }
                            if (seccion == "modificacion") {
                                $("#cliente-edicion #apellido_paterno").val(data[0].informacion.apellido_paterno);
                                $("#cliente-edicion #apellido_materno").val(data[0].informacion.apellido_materno);
                                $("#cliente-edicion #nombre").val(data[0].informacion.nombres);
                            }
                        }  
                        if (documento == "RUC") {
                            if (seccion == "registro") {
                                $("#cliente-agregar #nombre").val(data[0].informacion.razon_social);
                            }
                            if (seccion == "modificacion") {
                                $("#cliente-edicion #nombre").val(data[0].informacion.razon_social);
                            }
                        }                                              
                    }
                }
            }
        });
    });

    $(".registrar_cliente").click(function(){
        event.preventDefault();

        tipo_documento = $("#cliente-agregar #tipo_documento_r");
        numero_documento = $("#cliente-agregar #numero_documento");
        nombre = $("#cliente-agregar #nombre");
        apellido_paterno = $("#cliente-agregar #apellido_paterno");
        apellido_materno = $("#cliente-agregar #apellido_materno");
        celular = $("#cliente-agregar #celular");
        correo = $("#cliente-agregar #correo");
        estado = $("#cliente-agregar #estado_r");

        if (tipo_documento.val() == 0) {
            alert("Debe de seleccionar su Tipo de Documento.");
            tipo_documento.focus();
            return;
        }
        if (numero_documento.val() == "") {
            alert("Debe de ingresar su Numero de Documento.");
            numero_documento.focus();
            return;
        } else {
            if (numero_documento.val().length < 8) {
                alert("El Numero de Documento ingresado no es valido.");
                numero_documento.focus();
                return;                
            }
        }
        if (nombre.val() == "") {
            alert("Debe de ingresar su Nombre.");
            nombre.focus();
            return;
        }
        if (apellido_paterno.val() == "") {
            alert("Debe de ingresar su Apellido Paterno.");
            apellido_paterno.focus();
            return;
        }
        if (apellido_materno.val() == "") {
            alert("Debe de ingresar su Apellido Materno.");
            apellido_materno.focus();
            return;
        }
        /*
        if (celular.val() == "") {
            alert("Debe de ingresar su Teléfono Celular.");
            celular.focus();
            return;
        }
        if (correo.val() == "") {
            alert("Debe de ingresar su Correo Electrónico.");
            correo.focus();
            return;
        } else {
            if (!EsEmail(correo.val())) {
                alert("Debe de ingresar un Correo Electronico correcto.");
                correo.focus();
                return;
            }           
        }
        */

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #cliente-agregar #tipo_documento_r, #cliente-agregar #numero_documento, #cliente-agregar #nombre, #cliente-agregar #apellido_paterno, #cliente-agregar #apellido_materno, #cliente-agregar #celular, #cliente-agregar #correo, #cliente-agregar #pais_r, #cliente-agregar #departamento_r, #cliente-agregar #provincia_r, #cliente-agregar #distrito_r, #cliente-agregar #ciudad, #cliente-agregar #estado_r, #cliente-agregar #referido_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=clientes",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#cliente-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_cliente").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=clientes",
            data: datos.serialize(),
            success: function(data){
                console.log(data);

                $("#cliente-edicion #pais").load('/datos-dinamicos.php?b=PAI&cs=' + data.id_pais);

                if (data.id_pais == 170) {
                    $('#cliente-edicion .ubigeo_peru').css({"display":"block"});
                    $('#cliente-edicion .ubigeo_extranjero').css({"display":"none"});

                    $("#cliente-edicion #departamento").load('/datos-dinamicos.php?b=DEP&cf=' + data.id_pais + '&cs=' + data.id_departamento);
                    $("#cliente-edicion #provincia").load('/datos-dinamicos.php?b=PRO&cf=' + data.id_departamento + '&cs=' + data.id_provincia);
                    $("#cliente-edicion #distrito").load('/datos-dinamicos.php?b=DIS&cf=' + data.id_provincia + '&cs=' + data.id_distrito);
                } else {
                    $('#cliente-edicion .ubigeo_peru').css({"display":"none"});
                    $('#cliente-edicion .ubigeo_extranjero').css({"display":"block"});

                    $('#cliente-edicion #ciudad').val(data.ciudad);
                }

                $('#cliente-edicion #nombre').val(data.nombre);
                $('#cliente-edicion #apellido_paterno').val(data.apellido_paterno);
                $('#cliente-edicion #apellido_materno').val(data.apellido_materno);
                $('#cliente-edicion #tipo_documento').val(data.id_tipo_documento).change();
                $('#cliente-edicion #numero_documento').val(data.numero_documento);
                $('#cliente-edicion #celular').val(data.celular_cliente);
                $('#cliente-edicion #correo').val(data.correo_cliente);
                $('#cliente-edicion #referido').val(data.id_referido).change();
                $('#cliente-edicion #estado').val(data.estado_cliente).change();

                $("#cliente-edicion #pais").change(function(event){
                    if ($("#cliente-edicion #pais").val() == 170) {
                        $('#cliente-edicion .ubigeo_peru').css({"display":"block"});
                        $('#cliente-edicion .ubigeo_extranjero').css({"display":"none"});
                        $("#cliente-edicion #departamento").load('/datos-dinamicos.php?b=DEP&cf=' + pais + '&cs=' + departamento);
                        $("#cliente-edicion #provincia").load('/datos-dinamicos.php?b=PRO&cf=' + departamento + '&cs=' + provincia);
                        $("#cliente-edicion #distrito").load('/datos-dinamicos.php?b=DIS&cf=' + provincia);
                        return;
                    } else {
                        $('#cliente-edicion .ubigeo_peru').css({"display":"none"});
                        $('#cliente-edicion .ubigeo_extranjero').css({"display":"block"});
                        return;
                    }
                }); 

                $("#cliente-edicion #departamento").change(function(event){
                    var id = $("#cliente-edicion #departamento").find(':selected').val();
                    $("#cliente-edicion #provincia").load('/datos-dinamicos.php?b=PRO&cf=' + id);
                    $("#cliente-edicion #distrito").load('/datos-dinamicos.php?b=DIS');
                }); 

                $("#cliente-edicion #provincia").change(function(event){
                    var id = $("#cliente-edicion #provincia").find(':selected').val();
                    $("#cliente-edicion #distrito").load('/datos-dinamicos.php?b=DIS&cf=' + id);
                });


                $("#cliente-edicion").modal();
            }
        }); 
    });

    $(".actualizar_cliente").click(function(){
        event.preventDefault();

        numero_documento = $("#cliente-edicion #numero_documento");
        nombre = $("#cliente-edicion #nombre");
        apellido_paterno = $("#cliente-edicion #apellido_paterno");
        apellido_materno = $("#cliente-edicion #apellido_materno");
        celular = $("#cliente-edicion #celular");
        correo = $("#cliente-edicion #correo");
        estado = $("#cliente-edicion #estado");

        if (numero_documento.val() == "") {
            alert("Debe de ingresar su Numero de Documento.");
            numero_documento.focus();
            return;
        } else {
            if (numero_documento.val().length < 8) {
                alert("El Numero de Documento ingresado no es valido.");
                numero_documento.focus();
                return;                
            }
        }
        if (nombre.val() == "") {
            alert("Debe de ingresar su Nombre.");
            nombre.focus();
            return;
        }
        if (apellido_paterno.val() == "") {
            alert("Debe de ingresar su Apellido Paterno.");
            apellido_paterno.focus();
            return;
        }
        if (apellido_materno.val() == "") {
            alert("Debe de ingresar su Apellido Materno.");
            apellido_materno.focus();
            return;
        }
        /*
        if (celular.val() == "") {
            alert("Debe de ingresar su Teléfono Celular.");
            celular.focus();
            return;
        }
        if (correo.val() == "") {
            alert("Debe de ingresar su Correo Electrónico.");
            correo.focus();
            return;
        } else {
            if (!EsEmail(correo.val())) {
                alert("Debe de ingresar un Correo Electronico correcto.");
                correo.focus();
                return;
            }           
        }
        */

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #cliente-edicion #tipo_documento, #cliente-edicion #numero_documento, #cliente-edicion #nombre, #cliente-edicion #apellido_paterno, #cliente-edicion #apellido_materno, #cliente-edicion #celular, #cliente-edicion #correo, #cliente-edicion #pais, #cliente-edicion #departamento, #cliente-edicion #provincia, #cliente-edicion #distrito, #cliente-edicion #ciudad, #cliente-edicion #estado, #cliente-edicion #referido');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=clientes",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#cliente-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_cliente").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=clientes",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#cliente-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });
}); 