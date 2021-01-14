<?php
include("core/controller/Database.php");

$reservas = array();

$base = new Database();
$con = $base->connect();
$sql = "SELECT id, nombre, fecha_inicio, fecha_termino FROM feriado WHERE estado_feriado='1'";
$query = $con->query($sql);

while($r = $query->fetch_array()){
	$id = $r['id'];
	$nombre = utf8_Decode($r['nombre']);
	$fecha_inicio = $r['fecha_inicio'] . " 00:00";
	$fecha_termino = $r['fecha_termino'] . " 23:59";

	$datos = array(
		'id' => 'FR' . $id,
		'title' => $nombre,
		'start' => $fecha_inicio,
		'end' => $fecha_termino,
		'className' => 'fc-event-feriados',
		'eventOverlap' => true
	);

	array_push($reservas,$datos);
}

$sql = "SELECT r.id, r.id_habitacion, r.fecha_ingreso, r.fecha_salida, r.hora_ingreso, r.hora_salida, c.nombre, c.apellido_paterno, c.apellido_materno, h.nombre_habitacion FROM reserva AS r, cliente AS c, habitacion AS h WHERE r.id_cliente=c.id AND r.id_habitacion=h.id";

$query = $con->query($sql);

while($r = $query->fetch_array()){
	$id = $r['id'];
	$id_habitacion = $r['id_habitacion'];
	$titulo = $r['nombre_habitacion'] . " " . $r['nombre'] . " " . $r['apellido_paterno'] . " " . $r['apellido_materno'];
	$fecha_ingreso = date("Y-m-d", strtotime(str_replace('/', '-', $r['fecha_ingreso']))) . " " . $r['hora_ingreso'];
	$fecha_salida = date("Y-m-d", strtotime(str_replace('/', '-', $r['fecha_salida']))) . " " . $r['hora_salida'];
	$indice = rand(1, 9);

	$datos = array(
		'id' => $id,
		'resourceId' => $id_habitacion,
		'title' => $titulo,
		'start' => $fecha_ingreso,
		'end' => $fecha_salida,
		'className' => 'fc-event-reservas_' . $indice
	);

	array_push($reservas,$datos);
}

$reservas = json_encode($reservas);

print_r($reservas);
?>