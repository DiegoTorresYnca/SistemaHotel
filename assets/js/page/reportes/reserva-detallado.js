$(function(){
    $fecha_actual = new Date();    
    $("#fecha_ingreso").val(moment($fecha_actual).format('DD/MM/YYYY'));
    $("#fecha_salida").val(moment($fecha_actual).format('DD/MM/YYYY'));

    var $table = $('#tbReporte');

    var $dataTable = $table.DataTable({
      searching: true,
      responsive: true,
      lengthChange: false,
      paging: true, 
      "order": [[ 0, "desc" ]],
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      "displayLength": 25,
      "processing": true,
      "serverSide": true,
      "serverMethod": 'get',
      ajax: {
        url: '/reporte-reservas.php',
        dataSrc: 'tbReporte',
        data: function (data) {
            var fecha_ingreso = $("#fecha_ingreso").val();
            var fecha_salida = $("#fecha_salida").val();
            var estado_pago = $("#estado_pago").val();
            var usuario = $("#usuario").val();
            var categoria = $("#categoria").val();
            var habitacion = $("#habitacion").val();

            data.fecha_ingreso = fecha_ingreso;
            data.fecha_salida = fecha_salida;
            data.estado_pago = estado_pago;
            data.usuario = usuario;
            data.categoria = categoria;
            data.habitacion = habitacion;
        }
      },
      columns: [
        { data: 'id' },
        { data: 'cliente' },
        { data: 'email' },
        { data: 'referido' },
        { data: 'usuario' },
        { data: 'fecha_ingreso' },
        { data: 'fecha_salida' },
        { data: 'habitacion' },        
        { data: 'estado_pago' },       
        { data: 'monto' },        
        { data: 'detalles' }        
      ],
      columnDefs: [
          { orderable: false, targets: -1 },
          { orderable: false, targets: -2 },
          { orderable: false, targets: -3 },
      ],
      dom: "<'row'<'col-lg-9'lB><'col-lg-3 mt-2'f>>" +
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

    $("#content").on("click", "#btnFiltra", function () {
        $dataTable.draw();
    });
});

$(document).on('click', '.ver_reserva', function(){
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

$(document).on('click', '.ver_cliente', function(){
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