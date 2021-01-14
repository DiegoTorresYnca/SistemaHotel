<?php
$datos = $_POST;
$proceso = $datos['proceso'];

if($proceso=="registrar"){
    $descripcion = $datos['descripcion'];
    $costo = $datos['costo'];
    $id_tipo_moneda = $datos['tipo_moneda_r'];
    
    $agregado=new AgregadosData();    
    $agregado->descripcion = $descripcion;
    $agregado->costo = $costo;
    $agregado->id_tipo_moneda = $id_tipo_moneda;    
    $agregado->insertarAgregado();

    $usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
        date_default_timezone_set('America/Lima');

        foreach($usuario_notificacion as $item) {
            $codigo_usuario = $item->id_usuario;

            $notificacion = new NotificacionesData();
            $notificacion->id_usuario = $codigo_usuario;
            $notificacion->id_modulo = $datos['id_modulo'];
            $notificacion->resumen = "Agregado se dio de Alta";
            $notificacion->fecha = date('Y-m-d H:i:s');
            $notificacion->estado_notificacion = "0";
            $notificacion->insertNotificaciones();
        }
    }

    $resultado = "RC"; 
}

if($proceso=="recuperar"){
    $codigo = $datos['codigo_relacionado'];
    $resultado=AgregadosData::obtenerAgregado($codigo);
}

if($proceso=="actualizar"){
    $codigo = $datos['codigo_relacionado'];
    $descripcion = $datos['descripcion'];
    $costo = $datos['costo'];
    $id_tipo_moneda = $datos['tipo_moneda'];
    $estado = $datos['estado'];

    $agregado=new AgregadosData();
    $agregado->id = $codigo;
    $agregado->descripcion = $descripcion;
    $agregado->costo = $costo;
    $agregado->id_tipo_moneda = $id_tipo_moneda;
    $agregado->estado = $estado;
    $agregado->updateAgregado();

    $usuario_notificacion = UsuariosNotificacionesData::obtenerUsuariosNotificacion($datos["id_modulo"]);

    $total_usuarios = count($usuario_notificacion);

    if ($total_usuarios > 0) {
        date_default_timezone_set('America/Lima');

        foreach($usuario_notificacion as $item) {
            $codigo_usuario = $item->id_usuario;

            $notificacion = new NotificacionesData();
            $notificacion->id_usuario = $codigo_usuario;
            $notificacion->id_modulo = $datos['id_modulo'];
            $notificacion->resumen = "Agregado Actualizo informacion";
            $notificacion->fecha = date('Y-m-d H:i:s');
            $notificacion->estado_notificacion = "0";
            $notificacion->insertNotificaciones();
        }
    }

    $resultado = "AC"; 
}

if($proceso=="eliminar"){
    $codigo = $datos['codigo_relacionado'];

    $agregado=new AgregadosData();
    $agregado->id = $codigo;
    $agregado->deleteAgregado();

    $resultado="EC";
}

$json = json_encode($resultado);
 
if ($_GET['callback']) {
	echo $_GET['callback']."(".$json.")";
} else {
 	echo $json;
} 

?>