$(document).ready(function() {
    $(".registrar_categoria").click(function(){
        event.preventDefault();

        nombre = $("#categoria-agregar #nombre");
        estado = $("#categoria-agregar #estado_r");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #categoria-agregar #nombre, #categoria-agregar #estado_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=categorias",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#categoria-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_categoria").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=categorias",
            data: datos.serialize(),
            success: function(data){
                $('#categoria-edicion #nombre').val(data.nombre_categoria);
                $('#categoria-edicion #estado').val(data.estado_categoria).change();
                $("#categoria-edicion").modal();
            }
        }); 
    });

    $(".actualizar_categoria").click(function(){
        event.preventDefault();

        nombre = $("#categoria-edicion #nombre");
        estado = $("#categoria-edicion #estado");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #categoria-edicion #nombre, #categoria-edicion #estado');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=categorias",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#categoria-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_categoria").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=categorias",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#categoria-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });
}); 