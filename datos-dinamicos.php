<?php
include("core/controller/Database.php");

$base = new Database();
$con = $base->connect();

if (isset($_GET["b"])) {
	$bloque = $_GET["b"];
}
if (isset($_GET["cf"])) {
	$codigo_filtro = $_GET["cf"];	
} else {
	$codigo_filtro = "";	
}
if (isset($_GET["cs"])) {
	$codigo_seleccion = $_GET["cs"];	
} else {
	$codigo_seleccion = "";	
}

if ($bloque == "CAT") {
?>
	<option value="0">Seleccione</option>
<?php
	if ($codigo_filtro == 0) {
		$sql = "SELECT * FROM habitacion ORDER BY nombre_habitacion ASC";
	} else {
		$sql = "SELECT * FROM habitacion WHERE id_categoria='$codigo_filtro' ORDER BY nombre_habitacion ASC";
	}
	$query = $con->query($sql);	

	while($r = $query->fetch_array()){
		$id_habitacion = $r['id'];
		$nombre_habitacion = $r['nombre_habitacion'];
?>
	<option value="<?php echo $id_habitacion; ?>"><?php echo $nombre_habitacion; ?></option>
<?php
	}
}

if ($bloque == "CLI") {
	?>
	<option value="0">Seleccione</option>
<?php
	$sql = "SELECT * FROM cliente";
	$query = $con->query($sql);	

	while($r = $query->fetch_array()){
		$id_cliente = $r['id'];
		$nombre_cliente = $r['nombre'];
		$apellido_paterno_cliente = $r['apellido_paterno'];
		$apellido_materno_cliente = $r['apellido_materno'];

		$alias_cliente = $nombre_cliente . " " . $apellido_paterno_cliente . " " . $apellido_materno_cliente;
?>
	<option value="<?php echo $id_cliente; ?>"><?php echo $alias_cliente; ?></option>
<?php
	}
}

if ($bloque == "PAI") {
	if ($codigo_seleccion == "") {
?>
	<option value="0">Seleccione</option>
<?php
	}

	$sql = "SELECT id, nombre_pais FROM pais ORDER BY nombre_pais ASC";
	$query = $con->query($sql);	

	while($r = $query->fetch_array()){
		$id_pais = $r['id'];
		$nombre_pais = utf8_encode($r['nombre_pais']);

		if ($codigo_seleccion == $id_pais) {
?>
	<option value="<?php echo $id_pais; ?>" selected="selected"><?php echo $nombre_pais; ?></option>
<?php
		} else {
?>
	<option value="<?php echo $id_pais; ?>"><?php echo $nombre_pais; ?></option>
<?php			
		}
	}
}

if ($bloque == "DEP") {
	if ($codigo_seleccion == "") {
?>
	<option value="0">Seleccione</option>
<?php
	}

	$sql = "SELECT id, nombre_departamento FROM departamento WHERE id_pais='$codigo_filtro' ORDER BY nombre_departamento ASC";
	$query = $con->query($sql);	

	while($r = $query->fetch_array()){
		$id_departamento = $r['id'];
		$nombre_departamento = utf8_encode($r['nombre_departamento']);

		if ($codigo_seleccion == $id_departamento) {
?>
	<option value="<?php echo $id_departamento; ?>" selected="selected"><?php echo $nombre_departamento; ?></option>
<?php
		} else {
?>
	<option value="<?php echo $id_departamento; ?>"><?php echo $nombre_departamento; ?></option>
<?php			
		}
	}
}

if ($bloque == "PRO") {
	if ($codigo_seleccion == "") {
?>
	<option value="0">Seleccione</option>
<?php
	}

	$sql = "SELECT id, nombre_provincia FROM provincia WHERE id_departamento='$codigo_filtro' ORDER BY nombre_provincia ASC";
	$query = $con->query($sql);	

	while($r = $query->fetch_array()){
		$id_provincia = $r['id'];
		$nombre_provincia = utf8_encode($r['nombre_provincia']);

		if ($codigo_seleccion == $id_provincia) {
?>
	<option value="<?php echo $id_provincia; ?>" selected="selected"><?php echo $nombre_provincia; ?></option>
<?php
		} else {
?>
	<option value="<?php echo $id_provincia; ?>"><?php echo $nombre_provincia; ?></option>
<?php			
		}
	}
}

if ($bloque == "DIS") {
	if ($codigo_seleccion == "") {
?>
	<option value="0">Seleccione</option>
<?php
	}

	$sql = "SELECT id, nombre_distrito FROM distrito WHERE id_provincia='$codigo_filtro' ORDER BY nombre_distrito ASC";
	$query = $con->query($sql);	

	while($r = $query->fetch_array()){
		$id_distrito = $r['id'];
		$nombre_distrito = utf8_encode($r['nombre_distrito']);

		if ($codigo_seleccion == $id_distrito) {
?>
	<option value="<?php echo $id_distrito; ?>" selected="selected"><?php echo $nombre_distrito; ?></option>
<?php
		} else {
?>
	<option value="<?php echo $id_distrito; ?>"><?php echo $nombre_distrito; ?></option>
<?php			
		}
	}
}
?>