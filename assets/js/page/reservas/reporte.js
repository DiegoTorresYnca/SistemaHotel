$(function(){
    NioApp.DataTable.init = function () {
        NioApp.DataTable('.datatable-init', {
          responsive: {
            details: true,
          },          
        });
        $.fn.DataTable.ext.pager.numbers_length = 7;
    };

    $(".ver_reserva").click(function(){
        $("#proceso").val('reporte');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));                

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=reservas",
            data: datos.serialize(),
            success: function(data){  
                $('#reserva-ver .cliente').html(data.nombre + " " + data.apellido_paterno + " " + data.apellido_materno);
                $('#reserva-ver .referido').html(data.nombre_referido);
                $('#reserva-ver .habitacion').html(data.nombre_habitacion);
                $('#reserva-ver .check_in').html(data.fecha_ingreso);
                $('#reserva-ver .hora_entrada').html(data.hora_ingreso);
                $('#reserva-ver .check_out').html(data.fecha_salida);
                $('#reserva-ver .hora_salida').html(data.hora_salida);
                $('#reserva-ver .observacion').html(data.observacion);

                $("#reserva-ver").modal();
            }
        }); 
    });  

    $(".ver_cliente").click(function(){
        $("#proceso").val('reporte');
        $("#codigo_relacionado").val($(this).attr('data-relacionado'));        

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=clientes",
            data: datos.serialize(),
            success: function(data){  
                $('#cliente-ver .nombre').html(data.nombre);
                $('#cliente-ver .apellido_paterno').html(data.apellido_paterno);
                $('#cliente-ver .apellido_materno').html(data.apellido_materno);
                $('#cliente-ver .tipo_documento').html(data.nombre_documento);
                $('#cliente-ver .numero_documento').html(data.numero_documento);
                $('#cliente-ver .celular').html(data.celular_cliente);
                $('#cliente-ver .correo').html(data.correo_cliente);
                $('#cliente-ver .referido').html(data.nombre_referido);

                $("#cliente-ver").modal();
            }
        }); 
    });        
})