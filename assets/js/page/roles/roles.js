$(document).ready(function() {
    $(".registrar_rol").click(function(){
        event.preventDefault();

        nombre = $("#rol-agregar #nombre");
        estado = $("#rol-agregar #estado_r");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #rol-agregar #nombre, #rol-agregar #estado_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=roles",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#rol-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_rol").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=roles",
            data: datos.serialize(),
            success: function(data){
                $('#rol-edicion #nombre').val(data.nombre_rol);
                $('#rol-edicion #estado').val(data.estado_rol).change();
                $("#rol-edicion").modal();
            }
        }); 
    });

    $(".permisos_rol").click(function(){
        $("#proceso").val('recuperar-permisos');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=roles",
            data: datos.serialize(),
            success: function(data){
                $("#rol-permisos #modulos").empty();
                data.forEach(function(valor, indice) {
                    id_modulo = valor['id'];
                    nombre_modulo = valor['nombre_modulo'];
                    activo = valor['activo'];
                    hijos = valor['hijos'];

                    if (activo == 0) {
                        item = '';
                        item = '<div class="col-6">';
                        item += '<div class="custom-control custom-checkbox">';
                        item += '<input type="checkbox" class="custom-control-input" id="modulo' + id_modulo + '" value="' + id_modulo + '">';
                        item += '<label class="custom-control-label" for="modulo' + id_modulo + '"><em class="icon ni ni-folder"></em> ' + nombre_modulo + '</label>';
                        item += '</div>';

                        if (hijos.length > 0) {
                            hijos.forEach(function(valor, indice) {
                                id_modulo_hijo = valor['id'];
                                nombre_modulo_hijo = valor['nombre_modulo'];
                                activo_hijo = valor['activo'];

                                if (activo_hijo == 0) {
                        item += '<div class="row gy-4">';
                        item += '<div class="col-2">';
                        item += '</div>';
                        item += '<div class="col-10">';
                        item += '<div class="custom-control custom-checkbox">';
                        item += '<input type="checkbox" class="custom-control-input" id="modulo' + id_modulo_hijo + '" value="' + id_modulo_hijo + '">';
                        item += '<label class="custom-control-label" for="modulo' + id_modulo_hijo + '"><em class="icon ni ni-file"></em> ' + nombre_modulo_hijo + '</label>';
                        item += '</div>';
                        item += '</div>';
                        item += '</div>';
                                } else {
                        item += '<div class="row gy-4">';
                        item += '<div class="col-2">';
                        item += '</div>';
                        item += '<div class="col-10">';
                        item += '<div class="custom-control custom-checkbox">';
                        item += '<input type="checkbox" class="custom-control-input" id="modulo' + id_modulo_hijo + '" value="' + id_modulo_hijo + '" checked>';
                        item += '<label class="custom-control-label" for="modulo' + id_modulo_hijo + '"><em class="icon ni ni-file"></em> ' + nombre_modulo_hijo + '</label>';
                        item += '</div>';
                        item += '</div>';
                        item += '</div>';
                                }
                            });
                        }

                        item += '</div">';
                    } else {
                        item = '';
                        item = '<div class="col-6">';
                        item += '<div class="custom-control custom-checkbox">';
                        item += '<input type="checkbox" class="custom-control-input" id="modulo' + id_modulo + '" value="' + id_modulo + '" checked>';
                        item += '<label class="custom-control-label" for="modulo' + id_modulo + '"><em class="icon ni ni-folder"></em> ' + nombre_modulo + '</label>';
                        item += '</div>';

                        if (hijos.length > 0) {
                            hijos.forEach(function(valor, indice) {
                                id_modulo_hijo = valor['id'];
                                nombre_modulo_hijo = valor['nombre_modulo'];
                                activo_hijo = valor['activo'];

                                if (activo_hijo == 0) {
                        item += '<div class="row gy-4">';
                        item += '<div class="col-2">';
                        item += '</div>';
                        item += '<div class="col-10">';
                        item += '<div class="custom-control custom-checkbox">';
                        item += '<input type="checkbox" class="custom-control-input" id="modulo' + id_modulo_hijo + '" value="' + id_modulo_hijo + '">';
                        item += '<label class="custom-control-label" for="modulo' + id_modulo_hijo + '"><em class="icon ni ni-file"></em> ' + nombre_modulo_hijo + '</label>';
                        item += '</div>';
                        item += '</div>';
                        item += '</div>';
                                } else {
                        item += '<div class="row gy-4">';
                        item += '<div class="col-2">';
                        item += '</div>';
                        item += '<div class="col-10">';
                        item += '<div class="custom-control custom-checkbox">';
                        item += '<input type="checkbox" class="custom-control-input" id="modulo' + id_modulo_hijo + '" value="' + id_modulo_hijo + '" checked>';
                        item += '<label class="custom-control-label" for="modulo' + id_modulo_hijo + '"><em class="icon ni ni-file"></em> ' + nombre_modulo_hijo + '</label>';
                        item += '</div>';
                        item += '</div>';
                        item += '</div>';
                                }
                            });
                        }

                        item += '</div">';
                    }

                    $("#rol-permisos #modulos").append(item);
                });

                item = '';
                item = '<div class="col-6">';
                item += '<div class="custom-control custom-checkbox">';
                item += '<input type="checkbox" class="custom-control-input" id="modulo0" value="0">';
                item += '<label class="custom-control-label" for="modulo0">Ninguno</label>';
                item += '</div>';
                item += '</div">';

                $("#rol-permisos #modulos").append(item);

                $("#rol-permisos").modal();
            }
        }); 
    });

    $(".registrar_permisos").click(function(){
        event.preventDefault();

        seleccionados_modulos = 0;

        $('#rol-permisos input'). each(function() {
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
        $('#rol-permisos input'). each(function() {
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
            url: "./?action=roles",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#rol-permisos").modal('hide');
                location.reload();
            }
        });

    });
    
    $(".actualizar_rol").click(function(){
        event.preventDefault();

        nombre = $("#rol-edicion #nombre");
        estado = $("#rol-edicion #estado");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #rol-edicion #nombre, #rol-edicion #estado');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=roles",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#rol-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_rol").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=roles",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#rol-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });
}); 