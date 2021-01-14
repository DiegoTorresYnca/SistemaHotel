<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "registrar") {
	$nombre = $datos['nombre'];
	$fecha_inicio = date("Y-m-d", strtotime(str_replace('/', '-', $datos['fecha_inicio'])));	
	$fecha_termino = date("Y-m-d", strtotime(str_replace('/', '-', $datos['fecha_termino'])));	
	$estado = $datos['estado_r'];

	$feriado = new FeriadosData();
    $feriado->nombre = $nombre;
    $feriado->fecha_inicio = $fecha_inicio;
    $feriado->fecha_termino = $fecha_termino;
    $feriado->estado_feriado = $estado;
    $feriado->insertFeriado(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Feriado se dio de Alta";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "RC"; 
}

if ($proceso == "recuperar") {
	$codigo = $datos['codigo_relacionado'];

	$resultado = FeriadosData::obtenerFeriado($codigo);
}

if ($proceso == "actualizar") {
	$codigo = $datos['codigo_relacionado'];
	$nombre = $datos['nombre'];
	$fecha_inicio = date("Y-m-d", strtotime(str_replace('/', '-', $datos['fecha_inicio'])));	
	$fecha_termino = date("Y-m-d", strtotime(str_replace('/', '-', $datos['fecha_termino'])));	
	$estado = $datos['estado'];

	$feriado = new FeriadosData();
    $feriado->id = $codigo; 
    $feriado->nombre = $nombre;
    $feriado->fecha_inicio = $fecha_inicio;
    $feriado->fecha_termino = $fecha_termino;
    $feriado->estado_feriado = $estado;
    $feriado->updateFeriado(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Feriado Actualizo informacion";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "AC"; 
}

if ($proceso == "eliminar") {
	$codigo = $datos['codigo_relacionado'];

	$feriado = new FeriadosData();
    $feriado->id = $codigo; 
    $feriado->deleteFeriado(); 

    $resultado = "EC"; 
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>