<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "registrar") {
	$nombre_modulo = $datos['nombre'];
	$url_modulo = $datos['url'];
	$icono_modulo = $datos['icono'];
	$modulo_padre = $datos['modulo_padre_r'];
	$id_modulo_padre = $datos['id_modulo_padre_r'];

	$modulo = new ModulosData();
    $modulo->nombre_modulo = $nombre_modulo;
    $modulo->url_modulo = $url_modulo;
    $modulo->icono_modulo = $icono_modulo;
    $modulo->modulo_padre = $modulo_padre;
    $modulo->id_modulo_padre = $id_modulo_padre;
    $modulo->insertModulo(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Modulo se dio de Alta";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "RC"; 
}

if ($proceso == "recuperar") {
	$codigo = $datos['codigo_relacionado'];

	$resultado = ModulosData::obtenerModulo($codigo);
}

if ($proceso == "actualizar") {
	$codigo = $datos['codigo_relacionado'];
	$nombre_modulo = $datos['nombre'];
	$url_modulo = $datos['url'];
	$icono_modulo = $datos['icono'];
	$modulo_padre = $datos['modulo_padre'];
	$id_modulo_padre = $datos['id_modulo_padre'];

	$modulo = new ModulosData();
    $modulo->id = $codigo; 
    $modulo->nombre_modulo = $nombre_modulo;
    $modulo->url_modulo = $url_modulo;
    $modulo->icono_modulo = $icono_modulo;
    $modulo->modulo_padre = $modulo_padre;
    $modulo->id_modulo_padre = $id_modulo_padre;
    $modulo->updateModulo(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Modulo Actualizo informacion";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "AC"; 
}

if ($proceso == "eliminar") {
	$codigo = $datos['codigo_relacionado'];

	$modulo = new ModulosData();
    $modulo->id = $codigo; 
    $modulo->deleteModulo(); 

    $resultado = "EC"; 
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>