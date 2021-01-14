<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "registrar") {
	$nombre_tarifa = $datos['nombre'];
	$precio_minimo = $datos['precio_minimo'];
	$precio_base = $datos['precio_base'];
	$estado_tarifa = $datos['estado_r'];
	$tipo_categoria = $datos['tipo_categoria_r'];
	$tipo_moneda = $datos['tipo_moneda_r'];

	$tarifa = new TarifasData();
    $tarifa->nombre_tarifa = $nombre_tarifa;
    $tarifa->precio_minimo = $precio_minimo;
    $tarifa->precio_base = $precio_base;
    $tarifa->estado_tarifa = $estado_tarifa;
	$tarifa->tipo_categoria = $tipo_categoria;
	$tarifa->tipo_moneda = $tipo_moneda;
    $tarifa->insertTarifa(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Tarifa se dio de Alta";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "RC"; 
}

if ($proceso == "recuperar") {
	$codigo = $datos['codigo_relacionado'];

	$resultado = TarifasData::obtenerTarifa($codigo);
}

if ($proceso == "actualizar") {
	$codigo = $datos['codigo_relacionado'];
	$nombre_tarifa = $datos['nombre'];
	$precio_minimo = $datos['precio_minimo'];
	$precio_base = $datos['precio_base'];
	$estado_tarifa = $datos['estado'];
	$tipo_categoria = $datos['tipo_categoria'];
	$tipo_moneda = $datos['tipo_moneda'];

	$tarifa = new TarifasData();
    $tarifa->id = $codigo; 
    $tarifa->nombre_tarifa = $nombre_tarifa;
    $tarifa->precio_minimo = $precio_minimo;
    $tarifa->precio_base = $precio_base;
    $tarifa->estado_tarifa = $estado_tarifa;
    $tarifa->tipo_categoria = $tipo_categoria;
	$tarifa->tipo_moneda = $tipo_moneda;
    $tarifa->updateTarifa(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Tarifa Actualizo informacion";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "AC"; 
}

if ($proceso == "eliminar") {
	$codigo = $datos['codigo_relacionado'];

	$tarifa = new TarifasData();
    $tarifa->id = $codigo; 
    $tarifa->deleteTarifa(); 

    $resultado = "EC"; 
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>