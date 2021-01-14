$(function () {
    $('#calendar').fullCalendar({
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],        
        now: new Date(),
        editable: true,
        selectable: true,
        aspectRatio: 1.8,
        scrollTime: '00:00',
        header: {
            left: 'today',
            center: 'prev,next',
            right: 'title'
        },
        defaultView: 'timelineMonth',
        views: {
            timelineThreeDays: {
                type: 'timeline',
                duration: {
                    days: 7
                }
            }
        },
        resourceAreaWidth: '15%',
        resourceColumns: [{
            labelText: 'Habitaciones',
            field: 'title'
        }],        
        select: function(startDate, endDate,mjsEvent, view, resource) {
            var fechaHora = startDate.format().split("T");
            var fechaHoraEnd = endDate.format().split("T");
    
            var fecha_inicio = moment(startDate).format('YYYY-MM-DD');
            var fecha_termino = moment(endDate).format('YYYY-MM-DD');
            var today = moment(new Date()).format('YYYY-MM-DD');    
            
            if (fecha_inicio >= today) {
                $('#reserva-agregar #id_habitacion').val(resource.id);  
                $('#reserva-agregar #habitacion').val(resource.title);  
                $("#reserva-agregar #cliente").val(0).change(); 
                $("#reserva-agregar #referido").val(0).change(); 
                $('#reserva-agregar #check_in').val(fecha_inicio.toString().split("-").reverse().join("/"));
                $('#reserva-agregar #hora_entrada').val('');
                $('#reserva-agregar #check_out').val(fecha_termino.toString().split("-").reverse().join("/"));
                $('#reserva-agregar #hora_salida').val('');
                $("#reserva-agregar #agregado").val(0).change(); 
                $('#reserva-agregar #observacion').val('');
                $('#reserva-agregar #precio').val('');

                $('#reserva-agregar').modal('show');  
            } else {
              alert("No se pueden crear reserva en el pasado!");
            }
            
        },
        eventClick:function(calEvent){            
        },
        eventResize:function(calEvent, delta, revertFunc){            
        },
        eventDrop:function(calEvent){
        },
        resources: "/index.php?action=reserva", 
        events: "/index.php?action=reserva&accion=eventos",
        eventRender: function(calEvent, element) {
            console.log(element);
            var hoy = Date();
            
            if (calEvent.estado == '1') {
                element.css({
                    'background-color': '#33ad85',
                    'border-color': '#333333',
                    'color': 'white'
                });
            }
            if (calEvent.estado == '2') {
                element.css({
                    'background-color': '#f0ad4e',
                    'border-color': '#333333',
                    'color': 'white'
                });
            }
        }
    });

    $(".fc-clear").remove();

    $("#calendar .fc-left button").text("Hoy");

    //Nuevo evento
    function DataGUI(){
        NewEvent={
            //.. parametros
        }
    }

    function DataSendUI(objEvento){
        $.ajax({
            type:'POST',
            url:'',
            data:objEvento, 
            success:function(){
                $('#calendar').fullCalendar('refetchEvents');
            },
            error:function(){
              alert("Hay un error");
            }
        });
    }

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

        $("#proceso").val('registrar');

        var datos_enviar = datos.find('#proceso, #id_modulo, #cliente-agregar #tipo_documento_r, #cliente-agregar #numero_documento, #cliente-agregar #nombre, #cliente-agregar #apellido_paterno, #cliente-agregar #apellido_materno, #cliente-agregar #celular, #cliente-agregar #correo, #cliente-agregar #referido_r, #cliente-agregar #estado_r');

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

        fecha_entrada = check_in.val() + " " + hora_entrada.val();
        fecha_salida = check_out.val() + " " + hora_salida.val();


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
                alert("Los datos fueron registrados correctamente.");
                $("#reserva-agregar").modal('hide');
                location.reload();
            }
        });
    });

    $(".pagar_reserva").click(function(){
    });

    $(".cancelar_reserva").click(function(){
        $('#reserva-agregar').modal('hide');
    });
});

