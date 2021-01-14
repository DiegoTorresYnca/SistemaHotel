$(document).ready(function() {
    $(".registrar_documento").click(function(){
        event.preventDefault();

        nombre = $("#documento-agregar #nombre");
        estado = $("#documento-agregar #estado_r");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #documento-agregar #nombre, #documento-agregar #estado_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=documentos",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#documento-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_documento").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=documentos",
            data: datos.serialize(),
            success: function(data){
                $('#documento-edicion #nombre').val(data.nombre_documento);
                $('#documento-edicion #estado').val(data.estado_documento).change();
                $("#documento-edicion").modal();
            }
        }); 
    });

    $(".actualizar_documento").click(function(){
        event.preventDefault();

        nombre = $("#documento-edicion #nombre");
        estado = $("#documento-edicion #estado");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #documento-edicion #nombre, #documento-edicion #estado');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=documentos",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#documento-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_documento").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=documentos",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#documento-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });
}); 

function EsEmail(email) {
    if (email.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1) {
        return true;
    } else {
        return false;
    }
}

$(".date-picker").datepicker({
    format: 'dd/mm/yyyy'
});