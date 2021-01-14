<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "registrar") {
	$nombre = $datos['nombre'];
	$estado = $datos['estado_r'];

	$rol = new RolesData();
    $rol->nombre_rol = $nombre;
    $rol->estado_rol = $estado;
    $rol->insertRol(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Rol se dio de Alta";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "RC"; 
}

if ($proceso == "recuperar") {
	$codigo = $datos['codigo_relacionado'];

	$resultado = RolesData::obtenerRol($codigo);
}

if ($proceso == "recuperar-permisos") {
	$codigo = $datos['codigo_relacionado'];

	$listados = array();
	$modulos = ModulosData::obtenerModuloPadre();
	$habilitados = RolesModulosData::obtenerRolesModulos($codigo);

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

		$elementos = array();

		$hijos = ModulosData::obtenerModuloHijo($codigo_modulo);

		$tiene_hijos = count($hijos);

		if ($tiene_hijos == 0) {
		} else {
			foreach($hijos as $item_h) {
				$activo_h = 0;
				$codigo_modulo_h = $item_h->id;
				$nombre_modulo_h = $item_h->nombre_modulo;

				if (count($habilitados)>0) {
					foreach($habilitados as $element) {
						$codigo_habilitado = $element->id_modulo_usuario;

						if ($codigo_modulo_h == $codigo_habilitado) {
							$activo_h = 1;
						}
					}			
				}

				$datos = array(
					'id' => $codigo_modulo_h,
					'nombre_modulo' => $nombre_modulo_h,
					'activo' => $activo_h,
				);

				array_push($elementos,$datos);		
			}
		}

		$datos = array(
			'id' => $codigo_modulo,
			'nombre_modulo' => $nombre_modulo,
			'activo' => $activo,
			'hijos' => $elementos
		);

		array_push($listados,$datos);		
	}

	$resultado = $listados;
}

if ($proceso == "permisos") {
	$codigo = $datos['codigo_relacionado'];
	$modulos_activos = $datos['modulos_activos'];

	$rol = new RolesModulosData();
    $rol->id = $codigo; 
    $rol->deleteRolesModulos(); 

	$modulos = explode("-", $modulos_activos);

	foreach($modulos as $item) {
		if ($item == 0) {
		} else {
			$rol = new RolesModulosData();
		    $rol->id_rol = $codigo;
		    $rol->id_modulo_usuario = $item;
		    $rol->insertRolesModulos(); 			
		}
	}	

	$resultado = "EC";
}

if ($proceso == "actualizar") {
	$codigo = $datos['codigo_relacionado'];
	$nombre = $datos['nombre'];
	$estado = $datos['estado'];

	$rol = new RolesData();
    $rol->id = $codigo; 
    $rol->nombre_rol = $nombre;
    $rol->estado_rol = $estado;
    $rol->updateRol(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Rol Actualizo informacion";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "AC"; 
}

if ($proceso == "eliminar") {
	$codigo = $datos['codigo_relacionado'];

	$rol = new RolesData();
    $rol->id = $codigo; 
    $rol->deleteRol(); 

    $resultado = "EC"; 
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>