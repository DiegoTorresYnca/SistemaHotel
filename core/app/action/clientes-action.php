<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if ($proceso == "consulta-datos") {
	$informacion = array();

	if (isset($datos['tipo_documento_r'])) {
		$id_tipo_documento = $datos['tipo_documento_r'];		
	} else {
		$id_tipo_documento = $datos['tipo_documento'];
	}
	$numero_documento = $datos['numero_documento'];

	$datos_documento = DocumentosData::obtenerDocumento($id_tipo_documento);
	$nombre_documento = $datos_documento->nombre_documento;

	$res = 0;
	if (strtolower($nombre_documento) == "dni") {
		$url = "https://api.reniec.cloud/dni/" . $numero_documento;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$res = curl_exec($curl);
		curl_close($curl);

		if ($res == "null") {
			$temporal = array(
				'documento' => $nombre_documento,
				'existe' => 'N'
			);
		} else {
			$temporal = array(
				'documento' => $nombre_documento,
				'existe' => 'S',
				'informacion' => json_decode($res, true)
			);			
		}

		array_push($informacion,$temporal);
	}

	if (strtolower($nombre_documento) == "ruc") {
		$url = "https://api.sunat.cloud/ruc/" . $numero_documento;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$res = curl_exec($curl);
		curl_close($curl);

		if ($res == "null") {
			$temporal = array(
				'documento' => $nombre_documento,
				'existe' => 'N'
			);
		} else {
			$temporal = array(
				'documento' => $nombre_documento,
				'existe' => 'S',
				'informacion' => json_decode($res, true)
			);			
		}

		array_push($informacion,$temporal);
	}

	$resultado = $informacion;
}

if ($proceso == "registrar") {
	$nombre = $datos['nombre'];
	$apellido_paterno = $datos['apellido_paterno'];
	$apellido_materno = $datos['apellido_materno'];
	$id_tipo_documento = $datos['tipo_documento_r'];
	$numero_documento = $datos['numero_documento'];
	$celular = $datos['celular'];
	$correo = $datos['correo'];
	$estado = $datos['estado_r'];
	$referido = $datos['referido_r'];

	$id_pais = $datos['pais_r'];
	if ($id_pais == 170) {
		$id_departamento = $datos['departamento_r'];
		$id_provincia = $datos['provincia_r'];
		$id_distrito = $datos['distrito_r'];
		$ciudad = "";
	} else {
		$id_departamento = 0;
		$id_provincia = 0;
		$id_distrito = 0;
		$ciudad = $datos['ciudad'];
	}

	$cliente = new ClientesData();
    $cliente->nombre = $nombre;
    $cliente->apellido_paterno = $apellido_paterno;
    $cliente->apellido_materno = $apellido_materno;
    $cliente->id_tipo_documento = $id_tipo_documento;
    $cliente->numero_documento = $numero_documento;
    $cliente->celular_cliente = $celular;
    $cliente->correo_cliente = $correo;
    $cliente->estado_cliente = $estado;
    $cliente->id_referido = $referido;
    $cliente->id_pais = $id_pais;
    $cliente->id_departamento = $id_departamento;
    $cliente->id_provincia = $id_provincia;
    $cliente->id_distrito = $id_distrito;
    $cliente->ciudad = $ciudad;
    $cliente->insertCliente();

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Cliente se dio de Alta";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "RC"; 
}

if ($proceso == "recuperar") {
	$codigo = $datos['codigo_relacionado'];

	$resultado = ClientesData::obtenerCliente($codigo);
}

if ($proceso == "actualizar") {
	$codigo = $datos['codigo_relacionado'];
	$nombre = $datos['nombre'];
	$apellido_paterno = $datos['apellido_paterno'];
	$apellido_materno = $datos['apellido_materno'];
	$id_tipo_documento = $datos['tipo_documento'];
	$numero_documento = $datos['numero_documento'];
	$celular = $datos['celular'];
	$correo = $datos['correo'];
	$estado = $datos['estado'];
	$referido = $datos['referido'];

	$id_pais = $datos['pais'];
	if ($id_pais == 170) {
		$id_departamento = $datos['departamento'];
		$id_provincia = $datos['provincia'];
		$id_distrito = $datos['distrito'];
		$ciudad = "";
	} else {
		$id_departamento = 0;
		$id_provincia = 0;
		$id_distrito = 0;
		$ciudad = $datos['ciudad'];
	}

	$cliente = new ClientesData();
    $cliente->id = $codigo; 
    $cliente->nombre = $nombre;
    $cliente->apellido_paterno = $apellido_paterno;
    $cliente->apellido_materno = $apellido_materno;
    $cliente->id_tipo_documento = $id_tipo_documento;
    $cliente->numero_documento = $numero_documento;
    $cliente->celular_cliente = $celular;
    $cliente->correo_cliente = $correo;
    $cliente->estado_cliente = $estado;
    $cliente->id_referido = $referido;
    $cliente->id_pais = $id_pais;
    $cliente->id_departamento = $id_departamento;
    $cliente->id_provincia = $id_provincia;
    $cliente->id_distrito = $id_distrito;
    $cliente->ciudad = $ciudad;
    $cliente->updateCliente(); 

	$usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
    	date_default_timezone_set('America/Lima');

    	foreach($usuario_notificacion as $item) {
    		$codigo_usuario = $item->id_usuario;

			$notificacion = new NotificacionesData();
		    $notificacion->id_usuario = $codigo_usuario;
		    $notificacion->id_modulo = $datos['id_modulo'];
		    $notificacion->resumen = "Cliente Actualizo informacion";
		    $notificacion->fecha = date('Y-m-d H:i:s');
		    $notificacion->estado_notificacion = "0";
		    $notificacion->insertNotificaciones();
    	}
    }

    $resultado = "AC"; 
}

if ($proceso == "eliminar") {
	$codigo = $datos['codigo_relacionado'];

	$cliente = new ClientesData();
    $cliente->id = $codigo; 
    $cliente->deleteCliente(); 

    $resultado = "EC"; 
}

if ($proceso == "reporte") {
	$codigo = $datos['codigo_relacionado'];

	$resultado = ClientesData::obtenerClienteReporte($codigo);
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>