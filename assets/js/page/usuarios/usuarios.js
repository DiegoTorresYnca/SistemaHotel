$(document).ready(function() {
    $(".registrar_usuario").click(function(){
        event.preventDefault();

        numero_documento = $("#usuario-agregar #numero_documento");
        nombre = $("#usuario-agregar #nombre");
        apellido_paterno = $("#usuario-agregar #apellido_paterno");
        apellido_materno = $("#usuario-agregar #apellido_materno");
        correo = $("#usuario-agregar #correo");
        estado = $("#usuario-agregar #estado_r");
        eliminar = $("#usuario-agregar #eliminar_r");
        usuario_nombre = $("#usuario-agregar #usuario_nombre");
        password = $("#usuario-agregar #password");

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

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #usuario-agregar #nombre, #usuario-agregar #apellido_paterno, #usuario-agregar #apellido_materno, #usuario-agregar #tipo_documento_r, #usuario-agregar #numero_documento, #usuario-agregar #correo, #usuario-agregar #estado_r, #usuario-agregar #eliminar_r, #usuario-agregar #usuario_nombre, #usuario-agregar #password, #usuario-agregar #rol_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=usuarios",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#usuario-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_usuario").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=usuarios",
            data: datos.serialize(),
            success: function(data){
                $('#usuario-edicion #nombre').val(data.nombre);
                $('#usuario-edicion #apellido_paterno').val(data.apellido_paterno);
                $('#usuario-edicion #apellido_materno').val(data.apellido_materno);
                $('#usuario-edicion #tipo_documento').val(data.id_tipo_documento).change();
                $('#usuario-edicion #numero_documento').val(data.numero_documento);
                $('#usuario-edicion #correo').val(data.correo_usuario);
                $('#usuario-edicion #estado').val(data.estado_usuario).change();
                $('#usuario-edicion #eliminar').val(data.eliminar_usuario).change();
                $('#usuario-edicion #usuario_nombre').val(data.usuario);
                $('#usuario-edicion #password').val(data.password);
                $('#usuario-edicion #rol').val(data.id_rol).change();

                $("#usuario-edicion").modal();
            }
        }); 
    });

    $(".permisos_usuario").click(function(){
        $("#proceso").val('recuperar-permisos');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=usuarios",
            data: datos.serialize(),
            success: function(data){
                $("#usuario-permisos #modulos").empty();
                data.forEach(function(valor, indice) {
                    id_modulo = valor['id'];
                    nombre_modulo = valor['nombre_modulo'];
                    activo = valor['activo'];

                    if (activo == 0) {
                        item = '';
                        item = '<div class="col-6">';
                        item += '<div class="custom-control custom-checkbox">';
                        item += '<input type="checkbox" class="custom-control-input" id="modulo' + id_modulo + '" value="' + id_modulo + '">';
                        item += '<label class="custom-control-label" for="modulo' + id_modulo + '">' + nombre_modulo + '</label>';
                        item += '</div>';
                        item += '</div">';
                    } else {
                        item = '';
                        item = '<div class="col-6">';
                        item += '<div class="custom-control custom-checkbox">';
                        item += '<input type="checkbox" class="custom-control-input" id="modulo' + id_modulo + '" value="' + id_modulo + '" checked>';
                        item += '<label class="custom-control-label" for="modulo' + id_modulo + '">' + nombre_modulo + '</label>';
                        item += '</div>';
                        item += '</div">';
                    }

                    $("#usuario-permisos #modulos").append(item);
                });

                item = '';
                item = '<div class="col-6">';
                item += '<div class="custom-control custom-checkbox">';
                item += '<input type="checkbox" class="custom-control-input" id="modulo0" value="0">';
                item += '<label class="custom-control-label" for="modulo0">Ninguno</label>';
                item += '</div>';
                item += '</div">';

                $("#usuario-permisos #modulos").append(item);

                $("#usuario-permisos").modal();
            }
        }); 
    });

    $(".registrar_permisos").click(function(){
        event.preventDefault();

        seleccionados_modulos = 0;

        $('#usuario-permisos input'). each(function() {
            if ($(this).prop('checked') == true) {
                seleccionados_modulos++;
            }
        });

        if (seleccionados_modulos == 0) {
            alert("Debe de seleccionar un Modulo");
            return;
        }

        $("#modulos_activos").val('');

        i = 0;
        modulos_activos = "";
        $('#usuario-permisos input'). each(function() {
            if ($(this).prop('checked') == true) {
                modulo = $(this).val();
                i++;

                if (i == 1) {
                    modulos_activos = modulo;
                } else {
                    modulos_activos += "-" + modulo;
                }
            }
        });

        $("#modulos_activos").val(modulos_activos);
        $("#proceso").val('permisos');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #modulos_activos');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=usuarios",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#usuario-permisos").modal('hide');
                location.reload();
            }
        });

    });

    $(".actualizar_usuario").click(function(){
        event.preventDefault();

        numero_documento = $("#usuario-edicion #numero_documento");
        nombre = $("#usuario-edicion #nombre");
        apellido_paterno = $("#usuario-edicion #apellido_paterno");
        apellido_materno = $("#usuario-edicion #apellido_materno");
        correo = $("#usuario-edicion #correo");
        estado = $("#usuario-edicion #estado");
        eliminar = $("#usuario-edicion #eliminar");
        usuario_nombre = $("#usuario-edicion #usuario_nombre");
        password = $("#usuario-edicion #password");

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

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #usuario-edicion #nombre, #usuario-edicion #apellido_paterno, #usuario-edicion #apellido_materno, #usuario-edicion #tipo_documento, #usuario-edicion #numero_documento, #usuario-edicion #correo, #usuario-edicion #estado, #usuario-edicion #eliminar, #usuario-edicion #usuario_nombre, #usuario-edicion #password, #usuario-edicion #rol');

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

    $(".eliminar_usuario").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=usuarios",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#usuario-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });
}); 