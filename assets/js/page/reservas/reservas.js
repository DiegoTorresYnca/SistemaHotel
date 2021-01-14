document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
    timeZone: 'UTC-5',
    headerToolbar: {
      left: 'today, prev, next',
      center: 'title',
      right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth'
    },
    aspectRatio: 1.5,
    initialView: 'resourceTimelineMonth',
    locale: 'es',
    editable: true,
    selectable: true,
    weekends: true,
    firstDay: 1,
    resourceAreaWidth: '8%',
    resourceAreaHeaderContent: 'Habitaciones',
    //resources: '/index.php?action=reserva',
    //events: "/index.php?action=reserva&accion=eventos",
    resources: '/obtener-habitaciones.php',
    events: '/obtener-reservas.php',
    businessHours: {
      daysOfWeek: [ 1, 2, 3, 4, 5 ],
      startTime: '06:00',
      endTime: '21:00'
    },
    selectOverlap: false,
    dateClick: function(info) {
      //alert('clicked ' + info.dateStr + ' on resource ' + info.resource.id);
    },
    select: function(info) {
      //alert('selected ' + info.startStr + ' to ' + info.endStr + ' on resource ' + info.resource.id);

      var fecha_entrada = moment(info.startStr).format('X');
      var hoy = moment(new Date()).format('X');  

      console.log(fecha_entrada + " / " + hoy)  

      if (fecha_entrada >= hoy) {
        var fecha_entrada = moment(info.startStr).format('YYYY-MM-DD');
        var hora_entrada = moment(info.startStr).format('hh:mm A');
        var fecha_salida = moment(info.endStr).format('YYYY-MM-DD');
        var hora_salida = moment(info.endStr).format('hh:mm A');

        $('#reserva-agregar #id_habitacion').val(info.resource.id);  
        $('#reserva-agregar #habitacion').val(info.resource.title);  
        $("#reserva-agregar #cliente").val(0).change(); 
        $("#reserva-agregar #referido").val(0).change(); 
        $('#reserva-agregar #check_in').val(fecha_entrada.toString().split("-").reverse().join("/"));
        $('#reserva-agregar #hora_entrada').val(hora_entrada);
        $('#reserva-agregar #check_out').val(fecha_salida.toString().split("-").reverse().join("/"));
        $('#reserva-agregar #hora_salida').val(hora_salida);
        $("#reserva-agregar #agregado").val(0).change(); 
        $('#reserva-agregar #observacion').val('');
        $('#reserva-agregar #precio').val('');

        $('#reserva-agregar').modal('show');  
      } else {
        alert("No se pueden crear reserva en el pasado!");
      }
    },
    eventClick: function (info) {
      $("#proceso").val('recuperar');
      $("#codigo_relacionado").val(info.event._def.publicId);

      var datos_enviar = datos.find('#proceso, #codigo_relacionado');

      $.ajax({
          type: "POST",
          dataType: "jsonp",
          url: "./?action=reservas",
          data: datos_enviar.serialize(),
          success: function(data) {
            console.log(data)
            fecha_salida = data.fecha_salida + " " + data.hora_salida;

            var hoy = moment(new Date()).format('X');  
            var fecha_salida = moment(fecha_salida).format('X');

            console.log(hoy + " ### " + fecha_salida);

            if (hoy >= fecha_salida) {
              $("#reserva-edicion .actualizar_reserva").prop('disabled', true);
            } else {
              $("#reserva-edicion .actualizar_reserva").prop('disabled', false);              
            }

            fecha_ingreso = data.fecha_ingreso.toString().split("-").reverse().join("/");
            hora_ingreso = moment(data.hora_ingreso, ["HH.mm"]).format("hh:mm A");
            fecha_salida = data.fecha_salida.toString().split("-").reverse().join("/");
            hora_salida = moment(data.hora_salida, ["HH.mm"]).format("hh:mm A");

            $("#reserva-edicion #id_habitacion").val(data.id_habitacion);
            $("#reserva-edicion #habitacion").val(data.id_habitacion).change();
            $("#reserva-edicion #numero_habitacion").val(data.numero_habitacion);
            $("#reserva-edicion #nombre_cliente").val(data.nombre_cliente);
            $("#reserva-edicion #nombre_referido").val(data.nombre_referido);
            $("#reserva-edicion #check_in").val(fecha_ingreso);
            $("#reserva-edicion #hora_entrada").val(hora_ingreso);
            $("#reserva-edicion #check_out").val(fecha_salida);
            $("#reserva-edicion #hora_salida").val(hora_salida);
            $("#reserva-edicion #observacion").val(data.observacion);
      
            $('#reserva-edicion').modal('show');
          }
      });
    },    
  });

  calendar.render();

  $(".agregar-cliente").click(function(){
      $("#cliente-agregar #tipo_documento_r").val(0).change();
      $("#cliente-agregar #numero_documento").val('');
      $("#cliente-agregar #nombre").val('');
      $("#cliente-agregar #apellido_paterno").val('');
      $("#cliente-agregar #apellido_materno").val('');
      $("#cliente-agregar #celular").val('');
      $("#cliente-agregar #correo").val('');

      $("#cliente-agregar").modal('show');
  });

  var pais = 170;
  var departamento = "15";
  var provincia = "1501";

  $('#cliente-agregar .ubigeo_peru').css({"display":"block"});
  $('#cliente-agregar .ubigeo_extranjero').css({"display":"none"});

  $("#cliente-agregar #pais_r").load('/datos-dinamicos.php?b=PAI&cs=' + pais);
  $("#cliente-agregar #departamento_r").load('/datos-dinamicos.php?b=DEP&cf=' + pais + '&cs=' + departamento);
  $("#cliente-agregar #provincia_r").load('/datos-dinamicos.php?b=PRO&cf=' + departamento + '&cs=' + provincia);
  $("#cliente-agregar #distrito_r").load('/datos-dinamicos.php?b=DIS&cf=' + provincia);

  $("#cliente-agregar #pais_r").change(function(event){
      if ($("#cliente-agregar #pais_r").val() == 170) {
          $('#cliente-agregar .ubigeo_peru').css({"display":"block"});
          $('#cliente-agregar .ubigeo_extranjero').css({"display":"none"});
          $("#cliente-agregar #departamento_r").load('/datos-dinamicos.php?b=DEP&cf=' + pais + '&cs=' + departamento);
          $("#cliente-agregar #provincia_r").load('/datos-dinamicos.php?b=PRO&cf=' + departamento + '&cs=' + provincia);
          $("#cliente-agregar #distrito_r").load('/datos-dinamicos.php?b=DIS&cf=' + provincia);
          return;
      } else {
          $('#cliente-agregar .ubigeo_peru').css({"display":"none"});
          $('#cliente-agregar .ubigeo_extranjero').css({"display":"block"});
          return;
      }
  }); 

  $("#cliente-agregar #departamento_r").change(function(event){
      var id = $("#cliente-agregar #departamento_r").find(':selected').val();
      $("#cliente-agregar #provincia_r").load('/datos-dinamicos.php?b=PRO&cf=' + id);
      $("#cliente-agregar #distrito_r").load('/datos-dinamicos.php?b=DIS');
  }); 

  $("#cliente-agregar #provincia_r").change(function(event){
      var id = $("#cliente-agregar #provincia_r").find(':selected').val();
      $("#cliente-agregar #distrito_r").load('/datos-dinamicos.php?b=DIS&cf=' + id);
  });    

  $(".buscar_cliente").click(function(){
      event.preventDefault();

      seccion = $(this).attr('data-seccion');

      if (seccion == "registro") {
          tipo_documento = $("#cliente-agregar #tipo_documento_r");
          numero_documento = $("#cliente-agregar #numero_documento");            
      }

      if (seccion == "modificacion") {
          tipo_documento = $("#cliente-edicion #tipo_documento");
          numero_documento = $("#cliente-edicion #numero_documento");            
      }

      if (tipo_documento.val() == 0) {
          alert("Debe de seleccionar su Tipo de Documento.");
          tipo_documento.focus();
          return;
      }

      if (numero_documento.val() == "") {
          alert("Debe de ingresar su Numero de Documento.");
          numero_documento.focus();
          return;
      } else {
          if (numero_documento.val().length < 8) {
              alert("El Numero de Documento ingresado no es valido.");
              numero_documento.focus();
              return;                
          }
      }

      $("#proceso").val('consulta-datos');

      if (seccion == "registro") {
          var datos_enviar = datos.find('#proceso, #cliente-agregar #tipo_documento_r, #cliente-agregar #numero_documento');
      }

      if (seccion == "modificacion") {
          var datos_enviar = datos.find('#proceso, #cliente-edicion #tipo_documento, #cliente-edicion #numero_documento');
      }

      $.ajax({
          type: "POST",
          dataType: "jsonp",
          url: "./?action=clientes",
          data: datos_enviar.serialize(),
          success: function(data) {
              if (data.length == 0) {
                  alert("No se encontraron coincidencias, ingrese los datos manualmente.");
                  return;
              } else {
                  if (data[0].existe == "N") {
                      alert("No se encontraron coincidencias, ingrese los datos manualmente.");
                      return;
                  } else {
                      documento = data[0].documento;
                      if (documento == "DNI") {
                          if (seccion == "registro") {
                              $("#cliente-agregar #apellido_paterno").val(data[0].informacion.apellido_paterno);
                              $("#cliente-agregar #apellido_materno").val(data[0].informacion.apellido_materno);
                              $("#cliente-agregar #nombre").val(data[0].informacion.nombres);
                          }
                          if (seccion == "modificacion") {
                              $("#cliente-edicion #apellido_paterno").val(data[0].informacion.apellido_paterno);
                              $("#cliente-edicion #apellido_materno").val(data[0].informacion.apellido_materno);
                              $("#cliente-edicion #nombre").val(data[0].informacion.nombres);
                          }
                      }  
                      if (documento == "RUC") {
                          if (seccion == "registro") {
                              $("#cliente-agregar #nombre").val(data[0].informacion.razon_social);
                          }
                          if (seccion == "modificacion") {
                              $("#cliente-edicion #nombre").val(data[0].informacion.razon_social);
                          }
                      }                                              
                  }
              }
          }
      });
  });

  $(".registrar_cliente_reserva").click(function(){
      event.preventDefault();

      tipo_documento = $("#cliente-agregar #tipo_documento_r");
      numero_documento = $("#cliente-agregar #numero_documento");
      nombre = $("#cliente-agregar #nombre");
      apellido_paterno = $("#cliente-agregar #apellido_paterno");
      apellido_materno = $("#cliente-agregar #apellido_materno");
      celular = $("#cliente-agregar #celular");
      correo = $("#cliente-agregar #correo");
      estado = $("#cliente-agregar #estado_r");

      if (tipo_documento.val() == 0) {
          alert("Debe de seleccionar su Tipo de Documento.");
          tipo_documento.focus();
          return;
      }
      if (numero_documento.val() == "") {
          alert("Debe de ingresar su Numero de Documento.");
          numero_documento.focus();
          return;
      } else {
          if (numero_documento.val().length < 8) {
              alert("El Numero de Documento ingresado no es valido.");
              numero_documento.focus();
              return;                
          }
      }
      if (nombre.val() == "") {
          alert("Debe de ingresar su Nombre.");
          nombre.focus();
          return;
      }
      if (apellido_paterno.val() == "") {
          alert("Debe de ingresar su Apellido Paterno.");
          apellido_paterno.focus();
          return;
      }
      if (apellido_materno.val() == "") {
          alert("Debe de ingresar su Apellido Materno.");
          apellido_materno.focus();
          return;
      }
      /*
      if (celular.val() == "") {
          alert("Debe de ingresar su Teléfono Celular.");
          celular.focus();
          return;
      }
      if (correo.val() == "") {
          alert("Debe de ingresar su Correo Electrónico.");
          correo.focus();
          return;
      } else {
          if (!EsEmail(correo.val())) {
              alert("Debe de ingresar un Correo Electronico correcto.");
              correo.focus();
              return;
          }           
      }
      */

      $("#proceso").val('registrar');

      var datos_enviar = datos.find('#proceso, #id_modulo, #cliente-agregar #tipo_documento_r, #cliente-agregar #numero_documento, #cliente-agregar #nombre, #cliente-agregar #apellido_paterno, #cliente-agregar #apellido_materno, #cliente-agregar #celular, #cliente-agregar #correo, #cliente-agregar #pais_r, #cliente-agregar #departamento_r, #cliente-agregar #provincia_r, #cliente-agregar #distrito_r, #cliente-agregar #ciudad, #cliente-agregar #referido_r, #cliente-agregar #estado_r');

      $.ajax({
          type: "POST",
          dataType: "jsonp",
          url: "./?action=clientes",
          data: datos_enviar.serialize(),
          success: function(data){
              $("#cliente").load('/datos-dinamicos.php?b=CLI');

              alert("Los datos fueron registrados correctamente.");
              $("#cliente-agregar").modal('hide');
          }
      });
  });   

  $("#reserva-agregar .agregado_nombre").change(function(event){
    indice = $(this).find("option:selected").attr('data-indice');
    precio = $(this).find("option:selected").attr('data-precio');
    precio = Number.parseFloat(precio).toFixed(2);

    $("#reserva-agregar #precio_" + indice).val(precio);
  }); 

  $("#reserva-agregar .agregado_cantidad").blur(function(){
    indice = $(this).attr('data-indice');
    cantidad = $(this).val();

    precio = $("#reserva-agregar #precio_" + indice).val();
    subtotal = cantidad*precio;

    subtotal = Number.parseFloat(subtotal).toFixed(2);

    $("#reserva-agregar #subtotal_" + indice).val(subtotal);

    SumaAgregados();
  }); 

  $(".registrar_reserva").click(function(){
      event.preventDefault();

      cliente = $("#reserva-agregar #cliente");
      check_in = $("#reserva-agregar #check_in");
      hora_entrada = $("#reserva-agregar #hora_entrada");
      check_out = $("#reserva-agregar #check_out");
      hora_salida = $("#reserva-agregar #hora_salida");
      observacion = $("#reserva-agregar #observacion");

      if (cliente.val() == 0) {
          alert("Debe de seleccionar un Cliente");
          cliente.focus()
          return;
      }
      if (check_in.val() == "") {
          alert("Debe de seleccionar el Check In.");
          check_in.focus();
          return;
      }
      if (hora_entrada.val() == "") {
          alert("Debe de seleccionar la Hora de Entrada.");
          hora_entrada.focus();
          return;
      }
      if (check_out.val() == "") {
          alert("Debe de seleccionar el Check Out.");
          check_out.focus();
          return;
      }
      if (hora_salida.val() == "") {
          alert("Debe de seleccionar la Hora de Salida.");
          hora_salida.focus();
          return;
      }

      fecha_entrada = check_in.val().toString().split("/").reverse().join("-") + " " + hora_entrada.val();
      fecha_salida = check_out.val().toString().split("/").reverse().join("-") + " " + hora_salida.val();

      var hoy = moment(new Date()).format('X');  
      var fecha_entrada = moment(fecha_entrada).format('X');
      var fecha_salida = moment(fecha_salida).format('X');

      if (fecha_entrada >= hoy) {
        if (fecha_salida <= fecha_entrada) {
            alert("La fecha de Check Out no puede ser inferior al Check In.");
            return;
        }

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #reserva-agregar #id_habitacion, #reserva-agregar #cliente, #reserva-agregar #referido, #reserva-agregar #check_in, #reserva-agregar #hora_entrada, #reserva-agregar #check_out, #reserva-agregar #hora_salida, #reserva-agregar #agregado, #reserva-agregar #observacion, #reserva-agregar #precio');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=reservas",
            data: datos_enviar.serialize(),
            success: function(data){
              if (data == "RI") {
                alert("La reserva no se pudo registrar porque ya hay una Reserva en las fechas selecionadas.\nSeleccione otra fecha.");
                return;
              }
              if (data == "RC") {
                alert("Los datos fueron registrados correctamente.");
                $("#reserva-agregar").modal('hide');
                location.reload();              
              }
            }
        });
      } else {
        alert("No se pueden crear reserva en el pasado!");
      }
  });

  $(".actualizar_reserva").click(function(){
      event.preventDefault();

      habitacion = $("#reserva-edicion #habitacion");
      check_in = $("#reserva-edicion #check_in");
      hora_entrada = $("#reserva-edicion #hora_entrada");
      check_out = $("#reserva-edicion #check_out");
      hora_salida = $("#reserva-edicion #hora_salida");
      observacion = $("#reserva-edicion #observacion");

      if (habitacion.val() == 0) {
          alert("Debe de seleccionar una Habitacion.");
          habitacion.focus();
          return;
      }
      if (check_in.val() == "") {
          alert("Debe de seleccionar el Check In.");
          check_in.focus();
          return;
      }
      if (hora_entrada.val() == "") {
          alert("Debe de seleccionar la Hora de Entrada.");
          hora_entrada.focus();
          return;
      }
      if (check_out.val() == "") {
          alert("Debe de seleccionar el Check Out.");
          check_out.focus();
          return;
      }
      if (hora_salida.val() == "") {
          alert("Debe de seleccionar la Hora de Salida.");
          hora_salida.focus();
          return;
      }

      fecha_entrada = check_in.val().toString().split("/").reverse().join("-") + " " + hora_entrada.val();
      fecha_salida = check_out.val().toString().split("/").reverse().join("-") + " " + hora_salida.val();

      var hoy = moment(new Date()).format('X');  
      var fecha_entrada = moment(fecha_entrada).format('X');
      var fecha_salida = moment(fecha_salida).format('X');

      if (fecha_entrada >= hoy) {
        if (fecha_salida <= fecha_entrada) {
            alert("La fecha de Check Out no puede ser inferior al Check In.");
            return;
        }

        $("#proceso").val('actualizar');

        var datos_enviar = datos.find('#proceso, #codigo_relacionado, #id_modulo, #reserva-edicion #id_habitacion, #reserva-edicion #habitacion, #reserva-edicion #check_in, #reserva-edicion #hora_entrada, #reserva-edicion #check_out, #reserva-edicion #hora_salida, #reserva-edicion #observacion, #reserva-edicion #precio');

        $.ajax({
            type: "POST",
            dataType: "jsonp",
            url: "./?action=reservas",
            data: datos_enviar.serialize(),
            success: function(data){
              if (data == "AI") {
                alert("La reserva no se pudo registrar porque ya hay una Reserva en las fechas selecionadas.\nSeleccione otra fecha.");
                return;
              }
              if (data == "AC") {
                alert("Los datos fueron actualizados correctamente.");
                $("#reserva-edicion").modal('hide');
                location.reload();              
              }
            }
        });
      } else {
        alert("No se pueden crear reserva en el pasado!");
      }
  });  

  $(".pagar_reserva").click(function(){
  });

  $(".cancelar_reserva").click(function(){
      $('#reserva-agregar').modal('hide');
  });

});

function SumaAgregados() {
  i = 0;
  total_agregados = 0;
  $("#reserva-agregar .lista_agregados input").each(function(){
    i++;
    nombre_elemento = $(this).attr('id');
    valor_elemento = $(this).val();

    if (valor_elemento != "") {
      datos_elemento = nombre_elemento.split("_");
      if (datos_elemento[0] == "subtotal") {
        total_agregados = parseFloat(total_agregados) + parseFloat(valor_elemento);
      }
    }
  });  

  total_agregados = Number.parseFloat(total_agregados).toFixed(2);

  $("#reserva-agregar #total_agregados").val(total_agregados);
}