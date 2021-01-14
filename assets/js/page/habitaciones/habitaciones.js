$(document).ready(function() {
    $("#tipo_categoria").change(function(event){
        var id = $("#tipo_categoria").find(':selected').val();
        $("#habitacion").load('/datos-dinamicos.php?b=CAT&cf=' + id);
    }); 

    $(".registrar_habitacion").click(function(){
        event.preventDefault();

        nombre = $("#habitacion-agregar #nombre");
        detalles = $("#habitacion-agregar #detalles");
        id_categoria_r = $("#habitacion-agregar #id_categoria_r");
        url_imagen = $("#habitacion-agregar #url_imagen_r");
        estado = $("#habitacion-agregar #estado_r");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }
        if (detalles.val() == "") {
            alert("Debe de ingresar los Detalles.");
            detalles.focus();
            return;
        }

        $("#proceso").val('registrar');

        var formulario = $('#hoteles')[0]; 
        var datos = new FormData(formulario);  

        //var datos_enviar = datos.find('#proceso, #habitacion-agregar #nombre, #habitacion-agregar #detalles, #habitacion-agregar #id_categoria_r, #habitacion-agregar #url_imagen, #habitacion-agregar #estado_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=habitaciones",
            contentType: false,
            processData: false,
            data: datos,
            enctype: 'multipart/form-data',
            success: function(data){
                if (data == "RI") {
                    alert("La imagen seleccionada no es valida");
                    return;
                } else {
                    alert("Los datos fueron registrados correctamente.");
                    $("#habitacion-agregar").modal('hide');
                    location.reload();
                }
            }
        });
    });   

    $(".edicion_habitacion").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=habitaciones",
            data: datos.serialize(),
            success: function(data){
                $('#habitacion-edicion #nombre').val(data.nombre_habitacion);
                $('#habitacion-edicion #detalles').val(data.detalles);
                $('#habitacion-edicion #id_categoria').val(data.id_categoria).change();
                //$('#habitacion-edicion #url_imagen').val(data.url_imagen);
                $('#habitacion-edicion #estado').val(data.estado_habitacion).change();
                if (data.url_imagen != "") {
                    $("#imagen_actual").val(data.url_imagen);  
                    $("#habitacion-edicion #imagen_habitacion").attr("src", "/files_habitaciones/" + data.url_imagen);  
                }
                $("#habitacion-edicion").modal();
            }
        }); 
    });

    $(".actualizar_habitacion").click(function(){
        event.preventDefault();

        nombre = $("#habitacion-edicion #nombre");
        detalles = $("#habitacion-edicion #detalles");
        id_categoria_r = $("#habitacion-edicion #id_categoria");
        url_imagen = $("#habitacion-edicion #url_imagen");
        estado = $("#habitacion-edicion #estado");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }
        if (detalles.val() == "") {
            alert("Debe de ingresar los Detalles.");
            detalles.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos = new FormData();  
        datos.append("proceso", "actualizar");
        datos.append("codigo_relacionado", $("#codigo_relacionado").val());
        datos.append("nombre", $("#habitacion-edicion #nombre").val());
        datos.append("detalles", $("#habitacion-edicion #detalles").val());
        datos.append("id_categoria", $("#habitacion-edicion #id_categoria").val());
        datos.append("url_imagen", $('input[type=file]')[1].files[0]);
        datos.append("estado", $("#habitacion-edicion #estado").val());
        datos.append("id_modulo", $("#id_modulo").val());
        datos.append("imagen_actual", $("#imagen_actual").val());

        //var datos_enviar = datos.find('#proceso, #habitacion-agregar #nombre, #habitacion-agregar #detalles, #habitacion-agregar #id_categoria_r, #habitacion-agregar #url_imagen, #habitacion-agregar #estado_r');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=habitaciones",
            contentType: false,
            processData: false,
            data: datos,
            enctype: 'multipart/form-data',
            success: function(data){
                if (data == "AI") {
                    alert("La imagen seleccionada no es valida");
                    return;
                } else {
                    alert("Los datos fueron registrados correctamente.");
                    $("#habitacion-edicion").modal('hide');
                    location.reload();
                }
            }
        });
    });    

    $("#url_imagen_r").change(function() {
        archivo = $(this).val();
        extension = archivo.substring(archivo.length - 3, archivo.length);
        if ((extension.toLowerCase() != "jpg") && (extension.toLowerCase() != "png") && (extension.toLowerCase() != "gif")) {
            alert("Debe de seleccionar un archivo de tipo JPG, PNG o GIF.");
            $(this).val('');
            $(this).next('label').text('Choose file');
            return;
        }       
    });

    $("#url_imagen").change(function() {
        archivo = $(this).val();
        extension = archivo.substring(archivo.length - 3, archivo.length);
        if ((extension.toLowerCase() != "jpg") && (extension.toLowerCase() != "png") && (extension.toLowerCase() != "gif")) {
            alert("Debe de seleccionar un archivo de tipo JPG, PNG o GIF.");
            $(this).val('');
            $(this).next('label').text('Choose file');
            return;
        }       
    });

    $(".eliminar_habitacion").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=habitaciones",
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