<?php
include("core/controller/Database.php");

$base = new Database();
$link_select = $base->connect2();

$data = $_GET;
$parametros = $_GET["columns"];
$filtro = $_GET["search"]['value'];
$draw = $_GET["draw"];

//print_r($_GET);

$fecha_ingreso = "";
if (isset($_GET['fecha_ingreso'])) {
	if ($_GET['fecha_ingreso'] != "") {
		//$fecha_ingreso = date('Y-m-d', strtotime($_GET['fecha_ingreso']));
		$datos_fecha_ingreso = explode("/", $_GET['fecha_ingreso']);
		$fecha_ingreso = $datos_fecha_ingreso[2] . "-" . $datos_fecha_ingreso[1] . "-" . $datos_fecha_ingreso[0];
	}
}
$fecha_salida = "";
if (isset($_GET['fecha_salida'])) {
	if ($_GET['fecha_salida'] != "") {
		//$fecha_salida = date('Y-m-d', strtotime($_GET['fecha_salida']));
		$datos_fecha_salida = explode("/", $_GET['fecha_salida']);
		$fecha_salida = $datos_fecha_salida[2] . "-" . $datos_fecha_salida[1] . "-" . $datos_fecha_salida[0];
	}
}
$estado_pago = 0;
if (isset($_GET['estado_pago'])) {
	$estado_pago = $_GET['estado_pago'];	
}
$usuario = 0;
if (isset($_GET['usuario'])) {
	$usuario = $_GET['usuario'];	
}
$categoria = 0;
if (isset($_GET['categoria'])) {
	$categoria = $_GET['categoria'];	
}
$habitacion = 0;
if (isset($_GET['habitacion'])) {
	$habitacion = $_GET['habitacion'];	
}

/*
print_r($_GET['fecha_ingreso']);
print_r($_GET['fecha_salida']);

print_r($fecha_ingreso);
print_r($fecha_salida);lo ice
*/

$rows = array();
$temporal = array();

$columnas = array(
	0 => 'id',
	1 => 'c.id',
	2 => 'c.correo_cliente',
	3 => 'ref.id',
	4 => 'u.id',
	5 => 'r.fecha_ingreso',
	6 => 'r.fecha_salida',
	7 => 'h.nombre_habitacion',
	8 => 'ep.descripcion',
	9 => 'monto',
	10 => 'detalles'
);

$sql_total = "SELECT id FROM reserva";
$sql_filtrado = "SELECT r.id FROM reserva AS r, cliente AS c WHERE 1=1 AND r.id_cliente=c.id";
$sql_datos = "SELECT r.id, c.id AS id_cliente, c.nombre AS nombre_cliente, c.apellido_paterno AS apellido_paterno_cliente, c.apellido_materno AS apellido_materno_cliente, c.correo_cliente AS correo_cliente, ref.nombre AS nombre_referido, u.nombre AS nombre_usuario, u.apellido_paterno AS apellido_paterno_usuario, u.apellido_materno AS apellido_materno_usuario, r.fecha_ingreso, r.fecha_salida, h.nombre_habitacion, ep.descripcion AS estado_pago from reserva AS r LEFT JOIN cliente AS c ON c.id=r.id_cliente LEFT JOIN referido AS ref ON ref.id=r.id_referido LEFT JOIN usuario AS u ON u.id=r.id_usuario LEFT JOIN habitacion AS h ON h.id=r.id_habitacion LEFT JOIN estado_pago AS ep ON ep.id=r.id_estado_pago WHERE 1=1";

$rows['draw'] = $draw;

$rs = mysqli_query($link_select,$sql_total) or die("Error SQL Total : " . mysqli_error());
$contador_total = mysqli_num_rows($rs);
$contador_filtrado = mysqli_num_rows($rs);

if ($fecha_ingreso != "") {
	$sql_filtrado .= " AND (r.fecha_ingreso>='$fecha_ingreso')";
}
if ($fecha_salida != "") {
	$sql_filtrado .= " AND (r.fecha_salida<='$fecha_salida')";
}
if ($estado_pago != 0) {
	$sql_filtrado .= " AND (r.id_estado_pago='$estado_pago')";
}
if ($usuario != 0) {
	$sql_filtrado .= " AND (r.id_usuario='$usuario')";
}
/*
if ($categoria != 0) {
	$sql_filtrado .= " AND (id_usuario='$usuario')";
}
*/
if ($habitacion != 0) {
	$sql_filtrado .= " AND (r.id_habitacion='$habitacion')";
}
if ($filtro != "") {
	$sql_filtrado .= " AND (c.nombre LIKE '%$filtro%'";
	$sql_filtrado .= " OR c.apellido_paterno LIKE '%$filtro%'";
	$sql_filtrado .= " OR c.apellido_materno LIKE '%$filtro%')";
}

//echo $sql_filtrado;

$rs = mysqli_query($link_select,$sql_filtrado) or die("Error SQL Filtrado : " . mysqli_error());
$contador_filtrado = mysqli_num_rows($rs);

$rows['recordsTotal'] = $contador_total;
$rows['recordsFiltered'] = $contador_filtrado;

if ($fecha_ingreso != "") {
	$sql_datos .= " AND (r.fecha_ingreso>='$fecha_ingreso')";
}
if ($fecha_salida != "") {
	$sql_datos .= " AND (r.fecha_salida<='$fecha_salida')";
}
if ($estado_pago != 0) {
	$sql_datos .= " AND (r.id_estado_pago='$estado_pago')";
}
if ($usuario != 0) {
	$sql_datos .= " AND (r.id_usuario='$usuario')";
}
if ($habitacion != 0) {
	$sql_datos .= " AND (r.id_habitacion='$habitacion')";
}
if ($filtro != "") {
	$sql_datos .= " AND (c.nombre LIKE '%$filtro%'";
	$sql_datos .= " OR c.apellido_paterno LIKE '%$filtro%'";
	$sql_datos .= " OR c.apellido_materno LIKE '%$filtro%')";
}

$sql_datos .= " ORDER BY ". $columnas[$data['order'][0]['column']]." ".$data['order'][0]['dir']." LIMIT ".$data['start'].",".$data['length']."";

//echo $sql_datos;

$rs = mysqli_query($link_select,$sql_datos) or die("Error SQL Datos : " . mysqli_error());
while($row = mysqli_fetch_array($rs)) {
	$id = $row['id'];
	$id_cliente = $row['id_cliente'];
	$cliente = $row['nombre_cliente'] . " ". $row['apellido_paterno_cliente'] . " ". $row['apellido_materno_cliente'];
	$email = $row['correo_cliente'];
	$referido = $row['nombre_referido'];
	$usuario = $row['nombre_usuario'] . " ". $row['apellido_paterno_usuario'] . " ". $row['apellido_materno_usuario'];
	$fecha_ingreso = $row['fecha_ingreso'];
	$fecha_salida = $row['fecha_salida'];
	$habitacion = $row['nombre_habitacion'];
	$estado_pago = $row['estado_pago'];
	$monto = number_format(10000, 2,'.',' ');
	$detalles = '<ul class="nk-tb-actions gx-1"><li><div class="drodown"><a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a><div class="dropdown-menu dropdown-menu-right"><ul class="link-list-opt no-bdr"><li><a href="#" class="ver_reserva" data-relacionado="'.$id.'"><em class="icon ni ni-eye"></em><span>Ver detalles</span></a></li><li><a href="#" class="ver_cliente" data-relacionado="'.$id_cliente.'"><em class="icon ni ni-user-list-fill"></em><span>Información</span></a></li></ul></div></div></li></ul>';

	$datos = (array('id' => $id, 'cliente' => $cliente, 'email' => $email, 'referido' => $referido, 'usuario' => $usuario, 'fecha_ingreso' => $fecha_ingreso, 'fecha_salida' => $fecha_salida, 'habitacion' => $habitacion, 'estado_pago' => $estado_pago, 'monto' => $monto, 'detalles' => $detalles));

	array_push($temporal,$datos);
}
mysqli_free_result($rs);

$rows['tbReporte'] = $temporal;

echo json_encode($rows);
?>