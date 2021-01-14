<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if($proceso=="recuperar"){
    $codigo = $datos['codigo_relacionado'];
    $resultado = EstadoPagoData::obtenerEstadoPago($codigo);
}

if($proceso=="actualizar"){
    $codigo = $datos['codigo_relacionado'];
    $color = $datos['color'];

    $estado_pago = new EstadoPagoData();
    $estado_pago->id = $codigo;
    $estado_pago->color = $color;
    $estado_pago->updateEstadoPago();

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

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 
?>