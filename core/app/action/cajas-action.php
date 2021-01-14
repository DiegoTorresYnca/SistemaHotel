<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "registrar") {
	$fecha_apertura = $datos['fecha_apertura'];
	$monto_apertura = $datos['monto_apertura'];
	$id_usuario = $_SESSION["user_id"];

	$datos_apertura = explode(" ", $fecha_apertura);

    $fecha_apertura = date("Y-m-d", strtotime(str_replace('/', '-', $datos_apertura[0])));
    $fecha_apertura = $fecha_apertura . " " . $datos_apertura[1];

	$caja = new CajasData();
    $caja->fecha_apertura = $fecha_apertura;
    $caja->monto_apertura = $monto_apertura;
    $caja->id_usuario = $id_usuario;
    $caja->insertCaja(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Caja se dio de Alta";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "RC"; 
}

if ($proceso == "recuperar") {
	date_default_timezone_set('America/Lima');
	$fecha_cierre = date('d/m/Y H:i:s');

	$resultado = $fecha_cierre;
}

if ($proceso == "actualizar") {
    $codigo = $datos['codigo_relacionado'];
	$fecha_cierre = $datos['fecha_cierre'];
	$monto_cierre = $datos['monto_cierre'];

	$datos_cierre = explode(" ", $fecha_cierre);

    $fecha_cierre = date("Y-m-d", strtotime(str_replace('/', '-', $datos_cierre[0])));
    $fecha_cierre = $fecha_cierre . " " . $datos_cierre[1];

	$caja = new CajasData();
    $caja->id = $codigo; 
    $caja->fecha_cierre = $fecha_cierre;
    $caja->monto_cierre = $monto_cierre;
    $caja->updateCaja(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Habitacion Actualizo Informacion";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "AC"; 
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>