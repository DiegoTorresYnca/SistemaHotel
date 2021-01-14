$(document).ready(function() {
    $(".registrar_modulo").click(function(){
        event.preventDefault();

        nombre = $("#modulo-agregar #nombre");
        url = $("#modulo-agregar #url");
        icono = $("#modulo-agregar #icono");
        modulo_padre = $("#modulo-agregar #modulo_padre_r");
        id_modulo_padre = $("#modulo-agregar #id_modulo_padre_r");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }
        if (url.val() == "") {
            alert("Debe de ingresar una URL.");
            url.focus();
            return;
        }
        if (icono.val() == "") {
            alert("Debe de ingresar un Icono.");
            icono.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #modulo-agregar #nombre, #modulo-agregar #url, #modulo-agregar #icono, #modulo-agregar #modulo_padre_r, #modulo-agregar #id_modulo_padre_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=modulos",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#modulo-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_modulo").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=modulos",
            data: datos.serialize(),
            success: function(data){
                $('#modulo-edicion #nombre').val(data.nombre_modulo);
                $('#modulo-edicion #url').val(data.url_modulo);
                $('#modulo-edicion #icono').val(data.icono_modulo);
                $('#modulo-edicion #modulo_padre').val(data.modulo_padre).change();
                $('#modulo-edicion #id_modulo_padre').val(data.id_modulo_padre).change();
                $("#modulo-edicion").modal();
            }
        }); 
    });

    $(".actualizar_modulo").click(function(){
        event.preventDefault();

        nombre = $("#modulo-edicion #nombre");
        url = $("#modulo-edicion #url");
        icono = $("#modulo-edicion #icono");
        modulo_padre = $("#modulo-edicion #modulo_padre");
        id_modulo_padre = $("#modulo-edicion #id_modulo_padre");


        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }
        if (url.val() == "") {
            alert("Debe de ingresar una URL.");
            url.focus();
            return;
        }
        if (icono.val() == "") {
            alert("Debe de ingresar un Icono.");
            icono.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #modulo-edicion #nombre, #modulo-edicion #url, #modulo-edicion #icono, #modulo-edicion #modulo_padre, #modulo-edicion #id_modulo_padre');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=modulos",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#modulo-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_modulo").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=modulos",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#modulo-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });
}); 