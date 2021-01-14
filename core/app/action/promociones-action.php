<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if($proceso=="registrar"){
    $descripcion = $datos['descripcion'];
    $costo = $datos['costo'];
    $id_tipo_moneda = $datos['tipo_moneda_r'];
    $id_categoria = $datos['tipo_categoria_r'];
    $dias_minimo = $datos['dias_minimo'];
    $fecha_vencimiento = date("Y-m-d", strtotime(str_replace('/', '-', $datos['fecha_vencimiento'])));
    $fecha_vencimiento = $fecha_vencimiento . " 00:00:00";   
    $estado = $datos['estado_r'];
    

    $promocion = new PromocionesData();
    $promocion->descripcion = $descripcion;
    $promocion->costo = $costo;
    $promocion->id_tipo_moneda = $id_tipo_moneda; 
    $promocion->dias_minimo = $dias_minimo;
    $promocion->fecha_vencimiento = $fecha_vencimiento;
    $promocion->estado = $estado;
    $promocion->id_categoria = $id_categoria;
    $promocion->insertarPromocion();

    $usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
        date_default_timezone_set('America/Lima');

        foreach($usuario_notificacion as $item) {
            $codigo_usuario = $item->id_usuario;

            $notificacion = new NotificacionesData();
            $notificacion->id_usuario = $codigo_usuario;
            $notificacion->id_modulo = $datos['id_modulo'];
            $notificacion->resumen = "Promocion se dio de Alta";
            $notificacion->fecha = date('Y-m-d H:i:s');
            $notificacion->estado_notificacion = "0";
            $notificacion->insertNotificaciones();
        }
    }

    $resultado = "RC"; 
}

if ($proceso=="recuperar") {
    $codigo = $datos['codigo_relacionado'];
    $resultado = PromocionesData::obtenerPromocion($codigo);
}

if ($proceso=="actualizar") {
    $codigo = $datos['codigo_relacionado'];
    $descripcion = $datos['descripcion'];
    $costo = $datos['costo'];
    $id_tipo_moneda = $datos['tipo_moneda'];
    $id_categoria = $datos['tipo_categoria'];
    $dias_minimo = $datos['dias_minimo'];
    $fecha_vencimiento = date("Y-m-d", strtotime(str_replace('/', '-', $datos['fecha_vencimiento'])));    
    $fecha_vencimiento = $fecha_vencimiento . " 00:00:00";   
    $estado = $datos['estado'];

    $promocion = new PromocionesData();
    $promocion->id = $codigo;
    $promocion->descripcion = $descripcion;
    $promocion->costo = $costo;
    $promocion->id_tipo_moneda = $id_tipo_moneda; 
    $promocion->dias_minimo = $dias_minimo;
    $promocion->fecha_vencimiento = $fecha_vencimiento;
    $promocion->estado = $estado;
    $promocion->id_categoria = $id_categoria;
    $promocion->updatePromocion();

    $usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
        date_default_timezone_set('America/Lima');

        foreach($usuario_notificacion as $item) {
            $codigo_usuario = $item->id_usuario;

            $notificacion = new NotificacionesData();
            $notificacion->id_usuario = $codigo_usuario;
            $notificacion->id_modulo = $datos['id_modulo'];
            $notificacion->resumen = "Promocion Actualizo informacion";
            $notificacion->fecha = date('Y-m-d H:i:s');
            $notificacion->estado_notificacion = "0";
            $notificacion->insertNotificaciones();
        }
    }

    $resultado = "AC"; 
}

if ($proceso == "eliminar"){
    $codigo = $datos['codigo_relacionado'];

    $promocion=new PromocionesData();
    $promocion->id=$codigo;
    $promocion->deletePromocion();

    $resultado="EC";
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 

?>