$(document).ready(function() {
    $(".registrar_notificaciones").click(function(){
        event.preventDefault();

        seleccionados_modulos = 0;

        $('#usuario-notificaciones input'). each(function() {
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
        $('#usuario-notificaciones input'). each(function() {
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
        $("#proceso").val('notificaciones');

        var datos_enviar = datos.find('#proceso, #codigo_relacionado, #modulos_activos');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=usuarios",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                location.reload();
            }
        });
    });
}); 