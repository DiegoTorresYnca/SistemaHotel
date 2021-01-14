$(document).ready(function() {
    $(".registrar_tarifa").click(function(){
        event.preventDefault();

        nombre = $("#tarifa-agregar #nombre");
        tipo_categoria = $("#tarifa-agregar #tipo_categoria_r");
        tipo_moneda=$("#tarifa-agregar #tipo_moneda_r");
        precio_minimo = $("#tarifa-agregar #precio_minimo");
        precio_base = $("#tarifa-agregar #precio_base");
        estado = $("#tarifa-agregar #estado_r");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }
        if (tipo_categoria.val() == 0) {
            alert("Debe de seleccionar un Tipo de Categoria.");
            tipo_categoria.focus();
            return;
        }
        if (tipo_moneda.val() == 0) {
            alert("Debe de seleccionar un Tipo de Moneda.");
            tipo_moneda.focus();
            return;
        }
        if (precio_minimo.val() == "") {
            alert("Debe de ingresar un Precio Minimo.");
            precio_minimo.focus();
            return;
        }
        if (precio_base.val() == "") {
            alert("Debe de ingresar un Precio Base.");
            precio_base.focus();
            return;
        }
        if (parseInt(precio_base.val()) < parseInt(precio_minimo.val())) {
            alert("El Precio Base no puede ser minimo al Precio Base.");
            return;
        }
        if (estado.val() == "X") {
            alert("Debe de seleccionar un Estado.");
            estado.focus();
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #tarifa-agregar #nombre, #tarifa-agregar #precio_minimo, #tarifa-agregar #precio_base, #tarifa-agregar #tipo_moneda_r, #tarifa-agregar #tipo_categoria_r, #tarifa-agregar #estado_r');


        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=tarifas",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron registrados correctamente.");
                $("#tarifa-agregar").modal('hide');
                location.reload();
            }
        });
    });   

    $(".edicion_tarifa").click(function(){
        $("#proceso").val('recuperar');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=tarifas",
            data: datos.serialize(),
            success: function(data){
                $('#tarifa-edicion #nombre').val(data.nombre_tarifa);
                $('#tarifa-edicion #precio_minimo').val(data.precio_minimo);
                $('#tarifa-edicion #precio_base').val(data.precio_base);
                $('#tarifa-edicion #recargo_feriado').val(data.recargo_feriado);
                $('#tarifa-edicion #estado').val(data.estado_tarifa).change();
                $('#tarifa-edicion #tipo_moneda').val(data.id_tipo_moneda).change();
                $('#tarifa-edicion #tipo_categoria').val(data.id_categoria).change();
                $("#tarifa-edicion").modal();
            }
        }); 
    });

    $(".actualizar_tarifa").click(function(){
        event.preventDefault();

        nombre = $("#tarifa-edicion #nombre");
        tipo_categoria = $("#tarifa-edicion #tipo_categoria");
        tipo_moneda=$("#tarifa-edicion #tipo_moneda");
        precio_minimo = $("#tarifa-edicion #precio_minimo");
        precio_base = $("#tarifa-edicion #precio_base");
        estado = $("#tarifa-edicion #estado");

        if (nombre.val() == "") {
            alert("Debe de ingresar un Nombre.");
            nombre.focus();
            return;
        }
        if (tipo_categoria.val() == 0) {
            alert("Debe de seleccionar un Tipo de Categoria.");
            tipo_categoria.focus();
            return;
        }
        if (tipo_moneda.val() == 0) {
            alert("Debe de seleccionar un Tipo de Moneda.");
            tipo_moneda.focus();
            return;
        }
        if (precio_minimo.val() == "") {
            alert("Debe de ingresar un Precio Minimo.");
            precio_minimo.focus();
            return;
        }
        if (precio_base.val() == "") {
            alert("Debe de ingresar un Precio Base.");
            precio_base.focus();
            return;
        }
        if (parseInt(precio_base.val()) < parseInt(precio_minimo.val())) {
            alert("El Precio Base no puede ser minimo al Precio Base.");
            return;
        }
        if (estado.val() == "X") {
            alert("Debe de seleccionar un Estado.");
            estado.focus();
            return;
        }
       
        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #codigo_relacionado, #tarifa-edicion #nombre, #tarifa-edicion #precio_minimo, #tarifa-edicion #precio_base, #tarifa-edicion #recargo_feriado, #tarifa-edicion #estado, #tarifa-edicion #tipo_moneda, #tarifa-edicion #tipo_categoria');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=tarifas",
            data: datos_enviar.serialize(),
            success: function(data){
                alert("Los datos fueron actualizados correctamente.");
                $("#tarifa-edicion").modal('hide');
                location.reload();
            }
        });
    });    

    $(".eliminar_tarifa").click(function(){
        event.preventDefault();

        var r = confirm("¿Está seguro que desea eliminar este registro?");
        if (r == true) {
            $("#proceso").val('eliminar');

            $.ajax({
                type: "POST",
                dataType: "jsonp",
                url: "./?action=tarifas",
                data: datos.serialize(),
                success: function(data){
                    alert("Los datos fueron eliminados correctamente.");
                    $("#tarifa-edicion").modal('hide');
                    location.reload();
                }
            });
        } 
    });




    var $table = $('#tbTarifas');

    var $dataTable = $table.DataTable({
      searching: true,
      responsive: true,
      lengthChange: false,
      paging: true,       
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      "displayLength": 25,
      "processing": true,        
      dom: "<'row'<'col-lg-8'lB><'col-lg-3 mt-2'f>>" +
            "<'row'<'col-sm-12 mt-3'<'table-responsive'tr>>>" +
            "<'row mt-3'<'col-sm-9'i><'col-sm-3'<'pull-right' p>>>",
      "autoWidth": false,
      buttons: [
        {
          extend: 'excel',
          text: 'Exportar Excel',
          className: "btn btn-primary text-white"
        }
      ]
    });





}); 