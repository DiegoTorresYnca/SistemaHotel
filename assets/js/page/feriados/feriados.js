$(document).ready(function() {
    $(".registrar_feriado").click(function(){
        event.preventDefault();

        nombre = $("#feriado-agregar #nombre");
        fecha_inicio = $("#feriado-agregar #fecha_inicio");
        fecha_termino = $("#feriado-agregar #fecha_termino");
        estado = $("#feriado-agregar #estado_r");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }
        if (fecha_inicio.val() == "") {
            alert("Debe de ingresar una Fecha de Inicio.");
            fecha_inicio.focus();
            return;
        }
        if (fecha_termino.val() == "") {
            alert("Debe de ingresar una Fecha de Termino.");
            fecha_termino.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #feriado-agregar #nombre, #feriado-agregar #fecha_inicio, #feriado-agregar #fecha_termino, #feriado-agregar #estado_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=feriados",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#feriado-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_feriado").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=feriados",
            data: datos.serialize(),
            success: function(data){
                fecha_inicio = data.fecha_inicio.toString().split("-").reverse().join("/");
                fecha_termino = data.fecha_termino.toString().split("-").reverse().join("/");

                $('#feriado-edicion #nombre').val(data.nombre);
                $('#feriado-edicion #fecha_inicio').val(fecha_inicio);
                $('#feriado-edicion #fecha_termino').val(fecha_termino);
                $('#feriado-edicion #estado').val(data.estado_feriado).change();
                $("#feriado-edicion").modal();
            }
        }); 
    });

    $(".actualizar_feriado").click(function(){
        event.preventDefault();

        nombre = $("#feriado-edicion #nombre");
        fecha_inicio = $("#feriado-edicion #fecha_inicio");
        fecha_termino = $("#feriado-edicion #fecha_termino");
        estado = $("#feriado-edicion #estado");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }
        if (fecha_inicio.val() == "") {
            alert("Debe de ingresar una Fecha de Inicio.");
            fecha_inicio.focus();
            return;
        }
        if (fecha_termino.val() == "") {
            alert("Debe de ingresar una Fecha de Termino.");
            fecha_termino.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #feriado-edicion #nombre, #feriado-edicion #fecha_inicio, #feriado-edicion #fecha_termino, #feriado-edicion #estado');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=feriados",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#feriado-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_feriado").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=feriados",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#feriado-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });
}); 