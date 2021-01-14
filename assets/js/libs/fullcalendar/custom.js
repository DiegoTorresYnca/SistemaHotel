$(function() { // document ready

    $('#calendar').fullCalendar({
      now: new Date(),
      editable: true,
      selectable: true,
      aspectRatio: 1.8,
      scrollTime: '00:00',
      header: {
        left: 'promptResource today prev,next',
        center: 'title',
        right: 'timelineMonth,timelineDay,timelineThreeDays'
      },
      defaultView: 'timelineMonth',
      views: {
        timelineThreeDays: {
          type: 'timeline',
          duration: { days: 5 } 
        }
      },
      resourceAreaWidth: '15%',   
      resourceColumns: [
        {
          labelText: 'Habitaciones', 
          field: 'title'
        }
      ],
      
      select: function(startDate, endDate,mjsEvent, view, resource) {

        var fechaHora=startDate.format().split("T");
        var fechaHoraEnd=endDate.format().split("T");

        var check = moment(startDate).format('YYYY-MM-DD');
        var today = moment(new Date()).format('YYYY-MM-DD');

        $('#txtDate').val(fechaHora[0]);
        $('#txtHour').val(fechaHora[1]);

        $('#txtDateEnd').val(fechaHoraEnd[0]);
        $('#txtHourEnd').val(fechaHoraEnd[1]);
        $('#id_habitacion').val(resource.id);
        $('#titleEvent').html(resource.title);
        if (check >= today) {
        $("#ModalEvent").modal();
        }
        else {
          alert("No se pueden crear reserva en el pasado!");
        }
        
    },
      eventClick:function(calEvent){
            // H2
            if (calEvent.estado == "3") {
            $('#titleEvent').html(calEvent.title);
            // Information events
            $('#id_habitacion').val(calEvent.resourceId);
            $('#documento').val(calEvent.documento);
            $('#txtId').val(calEvent.id);
            $('#nombre').val(calEvent.title);
            $('#direccion').val(calEvent.direccion);
            $('#observacion').val(calEvent.observacion);
            

            datehhour= calEvent.start._i.split(" ");
            datehhourEnd= calEvent.end._i.split(" ");
            $('#txtDate').val(datehhour[0]);
            $('#txtHour').val(datehhour[1]);
            $('#txtDateEnd').val(datehhourEnd[0]);
            $('#txtHourEnd').val(datehhourEnd[1]);

            $("#ModalEvent").modal();
          }

            


      },
      eventResize:function(calEvent, delta, revertFunc){
        if (calEvent.estado == "3") {
        $('#txtId').val(calEvent.id);
          $('#nombre').val(calEvent.title);
          $('#documento').val(calEvent.documento);
          $('#direccion').val(calEvent.direccion);
          $('#id_habitacion').val(calEvent.resourceId);
          $('#observacion').val(calEvent.observacion);

          var fechaHora= calEvent.start.format().split("T");
          var fechaHoraEnd= calEvent.end.format().split("T");
          $('#txtDate').val(fechaHora[0]);
          $('#txtHour').val(fechaHora[1]);

          $('#txtDateEnd').val(fechaHoraEnd[0]);
          $('#txtHourEnd').val(fechaHoraEnd[1]);

          DataGUI();
          DataSendUI('actualizar',NewEvent,true);
        }



      }, 
      eventDrop:function(calEvent){
           if (calEvent.estado == "3") {
            
        
          $('#id_habitacion').val(calEvent.resourceId);
          $('#documento').val(calEvent.documento);
          $('#txtId').val(calEvent.id);
          $('#nombre').val(calEvent.title);
          $('#observacion').val(calEvent.observacion);

          var fechaHora= calEvent.start.format().split("T");
          var fechaHoraEnd= calEvent.end.format().split("T");
          $('#txtDate').val(fechaHora[0]);
          $('#txtHour').val(fechaHora[1]);

          $('#txtDateEnd').val(fechaHoraEnd[0]);
          $('#txtHourEnd').val(fechaHoraEnd[1]);

           DataGUI();
           DataSendUI('actualizar',NewEvent,true);
           }
 
      }, 
                          
      

      resources: "index.php?action=reserva",
      events: "index.php?action=reservas",
      
 
 
     eventRender: function(calEvent, element) {

        
        var hoy = Date();
        
        if (calEvent.estado == '0') {
            element.css({
                'background-color': '#33ad85',
                'border-color': '#333333',
                'color': 'white'
            });
        }
        if (calEvent.estado == '3') {
            element.css({
                'background-color': '#f0ad4e',
                'border-color': '#333333',
                'color': 'white'
            });
        }
    }

    });
  
  }); 


   $('#bagregar').click(function(){
     
      DataGUI();
      DataSendUI('addroom',NewEvent);
      $('#ModalRoom').modal('toggle');
      limpiar();
      $('#calendar').fullCalendar('refetchResources');
    });

   $('#btnAdd').click(function(){
     
      DataGUI();
      DataSendUI('agregar',NewEvent);
      $('#ModalEvent').modal('toggle');
      limpiar();
    });

    $('#btnDel').click(function(){
      
      DataGUI();
      DataSendUI('eliminar',NewEvent);
      $('#ModalEvent').modal('toggle');
      limpiar();
    });

    $('#btnUpdate').click(function(){
      
      DataGUI();
      DataSendUI('actualizar',NewEvent);
      $('#ModalEvent').modal('toggle');
      limpiar();
    });

    $('#btnClose').click(function(){

      $('#ModalEvent').modal('toggle'),
      limpiar();
    });

    $('#btnClose1').click(function(){ 
      $('#ModalEvent').modal('toggle'),
      limpiar();
    });

  function limpiar() {
        document.getElementById("txtId").value = "";
        document.getElementById("id_habitacion").value = "";
        document.getElementById("documento").value = "";
        document.getElementById("nombre").value = "";
        document.getElementById("direccion").value = "";
        document.getElementById("txtDate").value = "";
        document.getElementById("txtDateEnd").value = "";
        document.getElementById("observacion").value = "";
        $("#titleEvent").empty();

    }

    function DataGUI(){

         NewEvent={
        // TABLE EVENTO 
        id:$('#txtId').val(),
        id_habitacion:$('#id_habitacion').val(),
        documento:$('#documento').val(),
        nombre:$('#nombre').val(),
        direccion:$('#direccion').val(),
        observacion:$('#observacion').val(),
        start:$('#txtDate').val()+" "+$('#txtHour').val(),
        end:$('#txtDateEnd').val()+" "+$('#txtHourEnd').val()
      };
 
    }       

    function DataSendUI(accion,objEvento){ 
        $.ajax({
          type:'POST',
          url:'index.php?action=reserva&accion='+accion,
          data:objEvento, 
          success:function(msg){
            if (msg){
              $('#calendar').fullCalendar('refetchEvents');
              if(!modal){
              $('#ModalEvent').modal('toggle');
              $('#ModalRoom').modal('toggle');
              }
            }
          },
          error:function(){
            alert("Hay un error");
          }
        });

    }