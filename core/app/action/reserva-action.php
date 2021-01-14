<?php
    header('Content-Type: application/json');
    $base=new Database();
    $pdo = $base->connect1();
    $accion=(isset($_GET['accion']))?$_GET['accion']:'leer';
    
    switch($accion){
        case 'eventos':
            $sentenciaSQL=$pdo->prepare("SELECT r.id,r.id_habitacion as resourceId,convert(concat(r.fecha_ingreso,' ',r.hora_ingreso),datetime) as start,convert(concat(r.fecha_salida,' ',r.hora_salida),datetime) as end,concat(c.nombre,' ',c.apellido_paterno,' ',c.apellido_materno) as title,r.id_estado_pago as estado  FROM reserva r inner join cliente c on r.id_cliente=c.id");
            $sentenciaSQL->execute();
            $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
            break;
        default:
            $sentenciaSQL=$pdo->prepare("SELECT id,nombre_habitacion as title FROM habitacion");
            $sentenciaSQL->execute();
            $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
            break;
    }
?>