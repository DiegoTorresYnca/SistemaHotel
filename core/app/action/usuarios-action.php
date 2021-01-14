<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "registrar") {
	$nombre = $datos['nombre'];
	$apellido_paterno = $datos['apellido_paterno'];
	$apellido_materno = $datos['apellido_materno'];
	$id_tipo_documento = $datos['tipo_documento_r'];
	$numero_documento = $datos['numero_documento'];
	$correo_usuario = $datos['correo'];
	$estado = $datos['estado_r'];
	$eliminar = $datos['eliminar_r'];
	$usuario_nombre = $datos['usuario_nombre'];
	$password = sha1(md5($datos['password']));
	$id_rol = $datos['rol_r'];

	$usuario = new UsuariosData();
    $usuario->nombre = $nombre;
    $usuario->apellido_paterno = $apellido_paterno;
    $usuario->apellido_materno = $apellido_materno;
    $usuario->id_tipo_documento = $id_tipo_documento;
    $usuario->numero_documento = $numero_documento;
    $usuario->correo_usuario = $correo_usuario;
    $usuario->estado = $estado;
    $usuario->eliminar = $eliminar;
    $usuario->usuario = $usuario_nombre;
    $usuario->password = $password;
    $usuario->id_rol = $id_rol;
    $usuario->insertUsuario(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Usuario se dio de Alta";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "RC"; 
}

if ($proceso == "recuperar") {
	$codigo = $datos['codigo_relacionado'];

	$resultado = UsuariosData::obtenerUsuario($codigo);
}

if ($proceso == "recuperar-permisos") {
	$codigo = $datos['codigo_relacionado'];

	$listados = array();
	$modulos = ModulosData::obtenerModulos();
	$habilitados = UsuariosModulosData::obtenerUsuariosModulos($codigo);

	foreach($modulos as $item) {
		$activo = 0;
		$codigo_modulo = $item->id;
		$nombre_modulo = $item->nombre_modulo;

		if (count($habilitados)>0) {
			foreach($habilitados as $element) {
				$codigo_habilitado = $element->id_modulo_usuario;

				if ($codigo_modulo == $codigo_habilitado) {
					$activo = 1;
				}
			}			
		}

		$datos = array(
			'id' => $codigo_modulo,
			'nombre_modulo' => $nombre_modulo,
			'activo' => $activo
		);

		array_push($listados,$datos);		
	}

	$resultado = $listados;
}

if ($proceso == "permisos") {
	$codigo = $datos['codigo_relacionado'];
	$modulos_activos = $datos['modulos_activos'];

	$usuario = new UsuariosModulosData();
    $usuario->id = $codigo; 
    $usuario->deleteUsuariosModulos(); 

	$modulos = explode("-", $modulos_activos);

	foreach($modulos as $item) {
		if ($item == 0) {
		} else {
			$usuario = new UsuariosModulosData();
		    $usuario->id_usuario = $codigo;
		    $usuario->id_modulo_usuario = $item;
		    $usuario->insertUsuariosModulos(); 			
		}
	}	

	$resultado = "EC";
}

if ($proceso == "actualizar") {
	$codigo = $datos['codigo_relacionado'];
	$nombre = $datos['nombre'];
	$apellido_paterno = $datos['apellido_paterno'];
	$apellido_materno = $datos['apellido_materno'];
	$id_tipo_documento = $datos['tipo_documento'];
	$numero_documento = $datos['numero_documento'];
	$correo_usuario = $datos['correo'];
	$estado = $datos['estado'];
	$eliminar = $datos['eliminar'];
	$usuario_nombre = $datos['usuario_nombre'];
	$password = sha1(md5($datos['password']));
	$id_rol = $datos['rol'];

	$usuario = new UsuariosData();
    $usuario->id = $codigo; 
    $usuario->nombre = $nombre;
    $usuario->apellido_paterno = $apellido_paterno;
    $usuario->apellido_materno = $apellido_materno;
    $usuario->id_tipo_documento = $id_tipo_documento;
    $usuario->numero_documento = $numero_documento;
    $usuario->correo_usuario = $correo_usuario;
    $usuario->estado = $estado;
    $usuario->eliminar = $eliminar;
    $usuario->usuario = $usuario_nombre;
    $usuario->password = $password;
    $usuario->id_rol = $id_rol;
    $usuario->updateUsuario(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Usuario Actualizo informacion";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "AC"; 
}

if ($proceso == "eliminar") {
	$codigo = $datos['codigo_relacionado'];

	$usuario = new UsuariosData();
    $usuario->id = $codigo; 
    $usuario->deleteUsuario(); 

    $resultado = "EC"; 
}

if ($proceso == "notificaciones") {
	$codigo = $datos['codigo_relacionado'];
	$modulos_activos = $datos['modulos_activos'];

	$usuario = new UsuariosNotificacionesData();
    $usuario->id = $codigo; 
    $usuario->deleteUsuariosNotificaciones(); 

	$modulos = explode("-", $modulos_activos);

	foreach($modulos as $item) {
		if ($item == 0) {
		} else {
			$usuario = new UsuariosNotificacionesData();
		    $usuario->id_usuario = $codigo;
		    $usuario->id_modulo_usuario = $item;
		    $usuario->insertUsuariosNotificaciones(); 			
		}
	}	

	$resultado = "EC";
}

if ($proceso == "actualizar-perfil") {
	$codigo = $datos['codigo_relacionado'];
	$nombre = $datos['nombre'];
	$apellido_paterno = $datos['apellido_paterno'];
	$apellido_materno = $datos['apellido_materno'];
	$id_tipo_documento = $datos['tipo_documento'];
	$numero_documento = $datos['numero_documento'];
	$correo_usuario = $datos['correo'];
	$usuario_nombre = $datos['usuario_nombre'];
	$password = sha1(md5($datos['password']));

	/*
	$usuario = new UsuariosData();
    $usuario->id = $codigo; 
    $usuario->nombre = $nombre;
    $usuario->apellido_paterno = $apellido_paterno;
    $usuario->apellido_materno = $apellido_materno;
    $usuario->id_tipo_documento = $id_tipo_documento;
    $usuario->numero_documento = $numero_documento;
    $usuario->correo_usuario = $correo_usuario;
    $usuario->usuario = $usuario_nombre;
    $usuario->password = $password;
    $usuario->updateUsuarioPerfil(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Usuario Actualizo informacion";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }
    */

    $resultado = "AC"; 
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>