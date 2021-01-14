$(document).ready(function() {
    $(".registrar_agregado").click(function(){
        event.preventDefault();

        descripcion = $("#agregado-agregar #descripcion");
        costo = $("#agregado-agregar #costo");
        tipo_moneda_r = $("#agregado-agregar #tipo_moneda_r");
        estado = $("#agregado-agregar #estado_r");

        if (descripcion.val() == "") {
            alert("Debe de ingresar una Descripcion.");
            descripcion.focus();
            return;
        }
        if (costo.val() == "") {
            alert("Debe de ingresar un Costo.");
            costo.focus();
            return;
        }
        if (tipo_moneda_r.val() == "") {
            alert("Debe de seleccionar un Tipo de Moneda.");
            tipo_moneda_r.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #agregado-agregar #descripcion, #agregado-agregar #costo, #agregado-agregar #tipo_moneda_r, #agregado-agregar #estado_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=agregados",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#agregado-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_agregado").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=agregados",
            data: datos.serialize(),
            success: function(data){
                $('#agregado-edicion #descripcion').val(data.descripcion);
                $('#agregado-edicion #costo').val(data.costo);
                $('#agregado-edicion #tipo_moneda').val(data.id_tipo_moneda).change();
                $('#agregado-edicion #estado').val(data.estado).change();
                $("#agregado-edicion").modal();
            }
        }); 
    });

    $(".actualizar_agregado").click(function(){
        event.preventDefault();

        descripcion = $("#agregado-edicion #descripcion");
        costo = $("#agregado-edicion #costo");
        tipo_moneda_r = $("#agregado-edicion #tipo_moneda");
        estado = $("#agregado-edicion #estado");

        if (descripcion.val() == "") {
            alert("Debe de ingresar una Descripcion.");
            descripcion.focus();
            return;
        }
        if (costo.val() == "") {
            alert("Debe de ingresar un Costo.");
            costo.focus();
            return;
        }
        if (tipo_moneda_r.val() == "") {
            alert("Debe de seleccionar un Tipo de Moneda.");
            tipo_moneda_r.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #agregado-edicion #descripcion, #agregado-edicion #costo, #agregado-edicion #tipo_moneda, #agregado-edicion #estado');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=agregados",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#agregado-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_agregado").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=agregados",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#agregado-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });
}); 