<?php
include("core/controller/Database.php");

$habitaciones = array();

$base = new Database();
$con = $base->connect();
$sql = "SELECT h.id, h.nombre_habitacion, c.nombre_categoria, h.detalles FROM habitacion AS h LEFT JOIN categoria AS c ON c.id=h.id_categoria WHERE h.estado_habitacion='1' ORDER BY h.nombre_habitacion ASC";
$query = $con->query($sql);

while($r = $query->fetch_array()){
	$id = $r['id'];
	$nombre_habitacion = utf8_decode($r['nombre_habitacion']);
	$nombre_categoria = utf8_decode($r['nombre_categoria']);
	$detalle_habitacion = $r['detalles'];

	$datos = array(
		'id' => $id,
		'title' => $nombre_habitacion . " -- " . $nombre_categoria
	);

	array_push($habitaciones,$datos);
}

$habitaciones = json_encode($habitaciones);

print_r($habitaciones);
?>