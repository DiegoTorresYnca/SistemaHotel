$(document).ready(function() {
    $(".registrar_referido").click(function(){
        event.preventDefault();

        nombre = $("#referido-agregar #nombre");

        if (nombre.val() == "") {
            alert("Debe de ingresar su Nombre.");
            nombre.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #referido-agregar #nombre');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=referidos",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#referido-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_referido").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=referidos",
            data: datos.serialize(),
            success: function(data){
                $('#referido-edicion #nombre').val(data.nombre);

                $("#referido-edicion").modal();
            }
        }); 
    });

    $(".actualizar_referido").click(function(){
        event.preventDefault();

        nombre = $("#referido-edicion #nombre");

        if (nombre.val() == "") {
            alert("Debe de ingresar su Nombre.");
            nombre.focus();
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #referido-edicion #nombre');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=referidos",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#referido-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_referido").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=referidos",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#referido-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });

}); 