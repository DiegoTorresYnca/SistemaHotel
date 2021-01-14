<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");

if (!isset($_SESSION["user_id"])) {
	$user = $_POST['usuario'];
	$pass = sha1(md5($_POST['password']));

	$base = new Database();
	$con = $base->connect();
	$sql = "SELECT u.id, u.usuario, u.correo_usuario, r.id AS id_rol, r.nombre_rol AS nombre_rol FROM usuario AS u INNER JOIN rol AS r ON u.id_rol=r.id WHERE usuario=\"".$user."\" AND password=\"".$pass."\" AND estado_usuario=1";

	$query = $con->query($sql);
	$found = false;
	$userid = null;
	while($r = $query->fetch_array()){
		$found = true;
		$user_id = $r['id'];
		$user_nombre = $r['usuario'];
		$user_correo = $r['correo_usuario'];
		$rol_id = $r['id_rol'];
		$rol_nombre = $r['nombre_rol'];
	}

	if($found==true) {
	//	session_start();
	//	print $userid;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['user_nombre'] = $user_nombre;
		$_SESSION['user_correo'] = $user_correo;
		$_SESSION['rol_id'] = $rol_id;
		$_SESSION['rol_nombre'] = $rol_nombre;
	//	setcookie('userid',$userid);
	//	print $_SESSION['userid'];
		
		print "<script>window.location='index.php?view=reservas';</script>";
	} else {
		?>
	    <script>alert("USUARIO O CONTRASEÑA INCORRECTA");</script>
	    <?php
		print "<script>window.location='index.php?view=login';</script>";
	}
} else {
	print "<script>window.location='index.php?view=reservas';</script>";
}
?>