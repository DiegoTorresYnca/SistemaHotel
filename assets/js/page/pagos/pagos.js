$(document).ready(function() {
    $(".edicion_estado_pago").click(function () {
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=estado-pago",
            data: datos.serialize(),
            success: function (data) {
                $("#estado-pago-edicion #nombre").val(data.descripcion);
                $("#estado-pago-edicion #color").val(data.color);
                $("#estado-pago-edicion").modal();
            }
        }); 
    });

    $(".actualizar_estado_pago").click(function () {
        event.preventDefault();

        color = $("#estado-pago-edicion #color");        

        if (color.val() == "") {
            alert("Debe de ingresar un Color.");
            color.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #estado-pago-edicion #color');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=referidos",
            url: "./?action=estado-pago",
            data: datos_enviar.serialize(),
            success: function (data) {
                alert("Los datos fueron actualizados correctamente.");
                $("#referido-edicion").modal('hide');
                $("#estado-pago-edicion").modal('hide');
                location.reload();
            }
        });
    });  

}); 