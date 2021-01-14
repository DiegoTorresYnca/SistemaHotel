$(document).ready(function() {
    $(".edicion_usuario").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=usuarios",
            data: datos.serialize(),
            success: function(data){
                $('#usuario-edicion #tipo_documento').val(data.id_tipo_documento).change();
                $('#usuario-edicion #numero_documento').val(data.numero_documento);
                $('#usuario-edicion #nombre').val(data.nombre);
                $('#usuario-edicion #apellido_paterno').val(data.apellido_paterno);
                $('#usuario-edicion #apellido_materno').val(data.apellido_materno);
                $('#usuario-edicion #correo').val(data.correo_usuario);
                $('#usuario-edicion #usuario_nombre').val(data.usuario);

                $("#usuario-edicion").modal();
            }
        }); 
    });

    $(".actualizar_usuario").click(function(){
        event.preventDefault();

        tipo_documento = $("#usuario-edicion #tipo_documento");
        numero_documento = $("#usuario-edicion #numero_documento");
        nombre = $("#usuario-edicion #nombre");
        apellido_paterno = $("#usuario-edicion #apellido_paterno");
        apellido_materno = $("#usuario-edicion #apellido_materno");
        correo = $("#usuario-edicion #correo");
        usuario_nombre = $("#usuario-edicion #usuario_nombre");
        password = $("#usuario-edicion #password");

        if (tipo_documento.val() == 0) {
            alert("Debe de seleccionar su Tipo de Documento.");
            tipo_documento.focus();
            return;
        }
        if (numero_documento.val() == "") {
            alert("Debe de ingresar su Numero de Documento.");
            numero_documento.focus();
            return;
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
        if (usuario_nombre.val() == "") {
            alert("Debe de ingresar su Usuario.");
            usuario_nombre.focus();
            return;
        }
        if (password.val() == "") {
            alert("Debe de ingresar su Password.");
            password.focus();
            return;
        }

        $("#proceso").val('actualizar-perfil');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #usuario-edicion #nombre, #usuario-edicion #apellido_paterno, #usuario-edicion #apellido_materno, #usuario-edicion #tipo_documento, #usuario-edicion #numero_documento, #usuario-edicion #correo, #usuario-edicion #usuario_nombre, #usuario-edicion #password');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=usuarios",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#usuario-edicion").modal('hide');
                location.reload();
            }
        });
    });    
}); 