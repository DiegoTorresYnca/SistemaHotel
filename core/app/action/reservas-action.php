<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "registrar") {
	$habitacion = $datos['id_habitacion'];
	$cliente = $datos['cliente'];
	$referido = $datos['referido'];
    $check_in = date("Y-m-d", strtotime(str_replace('/', '-', $datos['check_in'])));    
	$hora_entrada = date("H:i", strtotime($datos['hora_entrada']));
    $check_out = date("Y-m-d", strtotime(str_replace('/', '-', $datos['check_out'])));    
    $hora_salida = date("H:i", strtotime($datos['hora_salida']));
    // $agregado = $datos['agregado'];
	$observacion = $datos['observacion'];
    $precio = $datos['precio'];

    $reservas = ReservasData::verifyReserva($check_in,$check_out,$habitacion);

    $total_reservas = count($reservas);

    if ($total_reservas == 0) {
        $reserva = new ReservasData();
        $reserva->id_cliente = $cliente;
        $reserva->observacion = $observacion;
        $reserva->id_referido = $referido;
        $reserva->fecha_ingreso = $check_in;
        $reserva->fecha_salida = $check_out;
        $reserva->hora_ingreso = $hora_entrada;
        $reserva->hora_salida = $hora_salida;
        $reserva->id_usuario = $_SESSION['user_id'];
        $reserva->id_habitacion = $habitacion;
        $reserva->id_estado_pago = 1;
        $reserva->insertReserva(); 

        $usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

        $total_usuarios = count($usuario_notificacion);

        if ($total_usuarios > 0) {
            date_default_timezone_set('America/Lima');

            foreach($usuario_notificacion as $item) {
                $codigo_usuario = $item->id_usuario;

                $notificacion = new NotificacionesData();
                $notificacion->id_usuario = $codigo_usuario;
                $notificacion->id_modulo = $datos['id_modulo'];
                $notificacion->resumen = "Reserva se dio de Alta";
                $notificacion->fecha = date('Y-m-d H:i:s');
                $notificacion->estado_notificacion = "0";
                $notificacion->insertNotificaciones();
            }
        }

        $resultado = "RC";
    } else {
        $resultado = "RI";         
    }
}

if ($proceso == "recuperar") {
    $codigo = $datos['codigo_relacionado'];

    $resultado = ReservasData::obtenerReserva($codigo);
}

if ($proceso == "actualizar") {
    $codigo = $datos['codigo_relacionado'];
    $id_habitacion = $datos['id_habitacion'];
    $habitacion = $datos['habitacion'];
    $check_in = date("Y-m-d", strtotime(str_replace('/', '-', $datos['check_in'])));    
    $hora_entrada = date("H:i", strtotime($datos['hora_entrada']));
    $check_out = date("Y-m-d", strtotime(str_replace('/', '-', $datos['check_out'])));    
    $hora_salida = date("H:i", strtotime($datos['hora_salida']));
    // $agregado = $datos['agregado'];
    $observacion = $datos['observacion'];
    $precio = $datos['precio'];

    $reservas = ReservasData::verifyReserva($check_in,$check_out,$habitacion);

    $total_reservas = count($reservas);

    $total_reservas = 0;

    if ($total_reservas == 0) {
        $reserva = new ReservasData();
        $reserva->id = $codigo;
        $reserva->id_habitacion = $habitacion;
        $reserva->fecha_ingreso = $check_in;
        $reserva->fecha_salida = $check_out;
        $reserva->hora_ingreso = $hora_entrada;
        $reserva->hora_salida = $hora_salida;
        $reserva->observacion = $observacion;
        $reserva->updateReserva(); 

        $usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

        $total_usuarios = count($usuario_notificacion);

        if ($total_usuarios > 0) {
            date_default_timezone_set('America/Lima');

            foreach($usuario_notificacion as $item) {
                $codigo_usuario = $item->id_usuario;

                $notificacion = new NotificacionesData();
                $notificacion->id_usuario = $codigo_usuario;
                $notificacion->id_modulo = $datos['id_modulo'];
                $notificacion->resumen = "Reserva se dio de Actualizacion";
                $notificacion->fecha = date('Y-m-d H:i:s');
                $notificacion->estado_notificacion = "0";
                $notificacion->insertNotificaciones();
            }
        }

        $resultado = "AC";
    } else {
        $resultado = "AI";         
    }
}

if ($proceso == "reporte") {
    $codigo = $datos['codigo_relacionado'];

    $resultado = ReporteReservaData::obtenerReservaReporte($codigo);
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>