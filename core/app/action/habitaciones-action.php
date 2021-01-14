<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "registrar") {
	if ($_FILES["url_imagen_r"]['tmp_name'] != "") {
		$finfo = finfo_open( FILEINFO_MIME_TYPE );
		$mime_type = finfo_file($finfo, $_FILES["url_imagen_r"]['tmp_name']);
		finfo_close($finfo);

		if ($mime_type == "image/jpeg" || $mime_type == "image/png" || $mime_type == "image/gif") {
			foreach ($_FILES as $vAdjunto){ 		  
				if ($vAdjunto["size"] > 0){ 							   
					$uploadname = $vAdjunto["name"];
					$uploadtempname = $vAdjunto['tmp_name'];
					$uploaddir = 'files_habitaciones/' . $uploadname;
					if (move_uploaded_file($uploadtempname, $uploaddir)) {
						chmod($uploaddir, 0777);
					}
				 } 		  
			} 
		} else {
			$resultado = "RI";
			die();
		}
	} else {
		$uploadname = "";
	}

	$nombre_habitacion = $datos['nombre'];
	$detalles = $datos['detalles'];
	$id_categoria = $datos['id_categoria_r'];
	$url_imagen = $uploadname;
	$estado_habitacion = $datos['estado_r'];

	$habitacion = new HabitacionesData();
    $habitacion->nombre_habitacion = $nombre_habitacion;
    $habitacion->detalles = $detalles;
    $habitacion->id_categoria = $id_categoria;
    $habitacion->url_imagen = $url_imagen;
    $habitacion->estado_habitacion = $estado_habitacion;
    $habitacion->insertHabitacion(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Habitacion se dio de Alta";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "RC"; 
}

if ($proceso == "recuperar") {
	$codigo = $datos['codigo_relacionado'];

	$resultado = HabitacionesData::obtenerHabitacion($codigo);
}

if ($proceso == "actualizar") {
	if (count($_FILES) != 0) {
		$finfo = finfo_open( FILEINFO_MIME_TYPE );
		$mime_type = finfo_file($finfo, $_FILES["url_imagen"]['tmp_name']);
		finfo_close($finfo);

		if ($mime_type == "image/jpeg" || $mime_type == "image/png" || $mime_type == "image/gif") {
			foreach ($_FILES as $vAdjunto){ 		  
				if ($vAdjunto["size"] > 0){ 							   
					$uploadname = $vAdjunto["name"];
					$uploadtempname = $vAdjunto['tmp_name'];
					$uploaddir = 'files_habitaciones/' . $uploadname;
					if (move_uploaded_file($uploadtempname, $uploaddir)) {
						chmod($uploaddir, 0777);
					}
				 } 		  
			} 
		} else {
			$resultado = "AI";
			die();
		}
	} else {
		$uploadname = "";
	}

	$codigo = $datos['codigo_relacionado'];
	$nombre_habitacion = $datos['nombre'];
	$detalles = $datos['detalles'];
	$id_categoria = $datos['id_categoria'];
	$estado_habitacion = $datos['estado'];
	$imagen_actual = $datos['imagen_actual'];

	if ($uploadname == "") {
		$url_imagen = $imagen_actual;
	} else {
		$url_imagen = $uploadname;
	}

	$habitacion = new HabitacionesData();
    $habitacion->id = $codigo; 
    $habitacion->nombre_habitacion = $nombre_habitacion;
    $habitacion->detalles = $detalles;
    $habitacion->id_categoria = $id_categoria;
    $habitacion->url_imagen = $url_imagen;
    $habitacion->estado_habitacion = $estado_habitacion;
    $habitacion->updateHabitacion(); 

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

if ($proceso == "eliminar") {
	$codigo = $datos['codigo_relacionado'];

	$habitacion = new HabitacionesData();
    $habitacion->id = $codigo; 
    $habitacion->deleteHabitacion(); 

    $resultado = "EC"; 
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>