<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if($proceso=="registrar"){
    $simbolo=$datos['simbolo'];
    $cambio=$datos['cambio'];   
    

    $tipo_moneda=new TipoMonedaData();
    $tipo_moneda->simbolo=$simbolo;
    $tipo_moneda->cambio=$cambio;
    $tipo_moneda->insertarTipoMoneda();

    $usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
        date_default_timezone_set('America/Lima');

        foreach($usuario_notificacion as $item) {
            $codigo_usuario = $item->id_usuario;

            $notificacion = new NotificacionesData();
            $notificacion->id_usuario = $codigo_usuario;
            $notificacion->id_modulo = $datos['id_modulo'];
            $notificacion->resumen = "Tipo de Moneda se dio de Alta";
            $notificacion->fecha = date('Y-m-d H:i:s');
            $notificacion->estado_notificacion = "0";
            $notificacion->insertNotificaciones();
        }
    }

    $resultado = "RC"; 
}

if($proceso=="recuperar"){
    $codigo = $datos['codigo_relacionado'];
    $resultado=TipoMonedaData::obtenerTipoMoneda($codigo);
}

if($proceso=="actualizar"){
    $codigo = $datos['codigo_relacionado'];
    $simbolo = $datos['simbolo'];
    $cambio = $datos['cambio'];
    $estado = $datos['estado'];

    $tipoMoneda=new TipoMonedaData();
    $tipoMoneda->id=$codigo;
    $tipoMoneda->simbolo=$simbolo;
    $tipoMoneda->cambio=$cambio;
    $tipoMoneda->estado=$estado;
    $tipoMoneda->updateTipoMoneda();

    $usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
        date_default_timezone_set('America/Lima');

        foreach($usuario_notificacion as $item) {
            $codigo_usuario = $item->id_usuario;

            $notificacion = new NotificacionesData();
            $notificacion->id_usuario = $codigo_usuario;
            $notificacion->id_modulo = $datos['id_modulo'];
            $notificacion->resumen = "Tipo de Moneda Actualizo informacion";
            $notificacion->fecha = date('Y-m-d H:i:s');
            $notificacion->estado_notificacion = "0";
            $notificacion->insertNotificaciones();
        }
    }

    $resultado="AC";
}

if($proceso=="eliminar"){
    $codigo = $datos['codigo_relacionado'];

    $tipoMoneda=new TipoMonedaData();
    $tipoMoneda->id=$codigo;
    $tipoMoneda->deleteTipoMoneda();

    $resultado = "EC"; 
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>