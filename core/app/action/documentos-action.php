<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "registrar") {
	$nombre = $datos['nombre'];
	$estado = $datos['estado_r'];

	$documento = new DocumentosData();
    $documento->nombre_documento = $nombre;
    $documento->estado_documento = $estado;
    $documento->insertDocumento(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Tipo de Documento se dio de Alta";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "RC"; 
}

if ($proceso == "recuperar") {
	$codigo = $datos['codigo_relacionado'];

	$resultado = DocumentosData::obtenerDocumento($codigo);
}

if ($proceso == "actualizar") {
	$codigo = $datos['codigo_relacionado'];
	$nombre = $datos['nombre'];
	$estado = $datos['estado'];

	$documento = new DocumentosData();
    $documento->id = $codigo; 
    $documento->nombre_documento = $nombre;
    $documento->estado_documento = $estado;
    $documento->updateDocumento(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Tipo de Ducumento Actualizo informacion";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "AC"; 
}

if ($proceso == "eliminar") {
	$codigo = $datos['codigo_relacionado'];

	$documento = new DocumentosData();
    $documento->id = $codigo; 
    $documento->deleteDocumento(); 

    $resultado = "EC"; 
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>