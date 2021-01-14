$(document).ready(function() {
    $(".registrar_promocion").click(function(){
        event.preventDefault();

        descripcion = $("#promocion-agregar #descripcion");
        costo = $("#promocion-agregar #costo");
        tipo_moneda = $("#promocion-agregar #tipo_moneda_r");
        dias_minimo = $("#promocion-agregar #dias_minimo");
        fecha_vencimiento = $("#promocion-agregar #fecha_vencimiento");
        estado = $("#promocion-agregar #estado_r");

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
        if (tipo_moneda.val() == "") {
            alert("Debe de seleccionar un Tipo de Moneda.");
            tipo_moneda_r.focus();
            return;
        }
        if (dias_minimo.val() == "") {
            alert("Debe de ingresar los Dias minimo.");
            dias_minimo.focus();
            return;
        }
        if (fecha_vencimiento.val() == "") {
            alert("Debe de ingresar una Fecha de Vencimiento.");
            fecha_vencimiento.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #promocion-agregar #descripcion, #promocion-agregar #costo, #promocion-agregar #tipo_categoria_r, #promocion-agregar #tipo_moneda_r, #promocion-agregar #dias_minimo, #promocion-agregar #fecha_vencimiento, #promocion-agregar #estado_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=promociones",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#promocion-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_promocion").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",


            dataType: "jsonp",
            url: "./?action=promociones",
            data: datos.serialize(),
            success: function(data){
                if (data.fecha_vencimiento == null) {
                } else {
                    fecha_vencimiento = data.fecha_vencimiento.split(" ");
                    fecha_vencimiento = fecha_vencimiento[0].toString().split("-").reverse().join("/");
                }

                $('#promocion-edicion #descripcion').val(data.descripcion);
                $('#promocion-edicion #costo').val(data.costo);
                $('#promocion-edicion #tipo_moneda').val(data.id_tipo_moneda).change();
                $('#promocion-edicion #tipo_categoria').val(data.id_categoria).change();
                $('#promocion-edicion #dias_minimo').val(data.dias_minimo);
                $('#promocion-edicion #fecha_vencimiento').val(fecha_vencimiento);
                $('#promocion-edicion #estado').val(data.estado).change();
                $("#promocion-edicion").modal();
            }
        }); 
    });

    $(".actualizar_promocion").click(function(){
        event.preventDefault();

        descripcion = $("#promocion-edicion #descripcion");
        costo = $("#promocion-edicion #costo");
        tipo_moneda = $("#promocion-edicion #tipo_moneda");
        dias_minimo = $("#promocion-edicion #dias_minimo");
        fecha_vencimiento = $("#promocion-edicion #fecha_vencimiento");
        estado = $("#promocion-edicion #estado");

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
        if (tipo_moneda.val() == "") {
            alert("Debe de seleccionar un Tipo de Moneda.");
            tipo_moneda_r.focus();
            return;
        }
        if (dias_minimo.val() == "") {
            alert("Debe de ingresar los Dias minimo.");
            dias_minimo.focus();
            return;
        }
        if (fecha_vencimiento.val() == "") {
            alert("Debe de ingresar una Fecha de Vencimiento.");
            fecha_vencimiento.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #promocion-edicion #descripcion, #promocion-edicion #costo, #promocion-edicion #tipo_moneda, #promocion-edicion #tipo_categoria, #promocion-edicion #dias_minimo, #promocion-edicion #fecha_vencimiento, #promocion-edicion #estado');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=promociones",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#promocion-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_promocion").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=promociones",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#promocion-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });
}); 