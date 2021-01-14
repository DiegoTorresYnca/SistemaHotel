$(document).ready(function() {
    $(".registrar_caja").click(function(){
        event.preventDefault();

        monto_apertura = $("#caja-agregar #monto_apertura");

        if (monto_apertura.val() == "") {
            alert("Debe de ingresar un Monto de Apertura.");
            monto_apertura.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #caja-agregar #fecha_apertura, #caja-agregar #monto_apertura');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=cajas",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#caja-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_caja").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=cajas",
            data: datos.serialize(),
            success: function(data){
                $("#caja-edicion #fecha_cierre").val(data);

                $("#caja-edicion").modal();
            }
        }); 
    });

    $(".actualizar_caja").click(function(){
        event.preventDefault();

        monto_cierre = $("#caja-edicion #monto_cierre");

        if (monto_cierre.val() == "") {
            alert("Debe de ingresar un Monto de Cierre.");
            monto_cierre.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #caja-edicion #fecha_cierre, #caja-edicion #monto_cierre');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=cajas",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#caja-edicion").modal('hide');
                location.reload();
            }
        });
    });    
}); 