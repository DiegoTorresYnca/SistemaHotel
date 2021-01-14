$(document).ready(function() {
    $(".registrar_tipo_moneda").click(function(){
        event.preventDefault();

        simbolo = $("#tipo-moneda-agregar #simbolo");
        cambio = $("#tipo-moneda-agregar #cambio");       

        if (simbolo.val() == "") {
            alert("Debe de ingresar un Simbolo.");
            simbolo.focus();
            return;
        }
        if (cambio.val() == "") {
            alert("Debe de ingresar un Precio Cambio.");
            cambio.focus();
            return;
        }

        $("#proceso").val('registrar');
        
        var datos_enviar = datos.find('#proceso, #id_modulo, #tipo-moneda-agregar #simbolo, #tipo-moneda-agregar #cambio');
        
        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=tipo-moneda",
            data: datos_enviar.serialize(),
            success: function(data){                
                alert("Los datos fueron registrados correctamente.");
                $("#tipo-moneda-agregar").modal('hide');
                location.reload();
            }
        });
    });

    $(".edicion_tipo_moneda").click(function () {
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=tipo-moneda",
            data: datos.serialize(),
            success: function (data) {
                $("#tipo-moneda-edicion #simbolo").val(data.simbolo);
                $("#tipo-moneda-edicion #cambio").val(data.cambio);
                $("#tipo-moneda-edicion #estado").val(data.estado).change();
                $("#tipo-moneda-edicion").modal();
            }
        });

    });

    $(".actualizar_tipo_moneda").click(function () {
        event.preventDefault();

        simbolo = $("#tipo-moneda-edicion #simbolo");
        cambio = $("#tipo-moneda-edicion #cambio");        

        if (simbolo.val() == "") {
            alert("Debe de ingresar un Simbolo.");
            simbolo.focus();
            return;
        }
        if (cambio.val() == "") {
            alert("Debe de ingresar un Precio Cambio.");
            cambio.focus();
            return;
        }

        $("#proceso").val('actualizar');        

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #tipo-moneda-edicion #simbolo, #tipo-moneda-edicion #cambio, #tipo-moneda-edicion #estado');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=tipo-moneda",
            data: datos_enviar.serialize(),
            success: function (data) {
                alert("Los datos fueron actualizados correctamente.");
                $("#tipo-moneda-edicion").modal('hide');
                location.reload();
            }
        });
    }); 

    $(".eliminar_tipo_moneda").click(function(){        
        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');
            $("#codigo_relacionado").val($(this).attr('data-relacionado'));
            
            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=tipo-moneda",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#habitacion-edicion").modal('hide');
                    location.reload();
                }
            });
        }        
    });
}); 