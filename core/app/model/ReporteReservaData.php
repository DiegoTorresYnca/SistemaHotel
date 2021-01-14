<?php
class ReporteReservaData{
    public static $tablename = "reserva";

    public static function obtenerReporteReservas(){
		$id_usuario=$_SESSION['user_id'];
		$sql = "SELECT r.id AS id_reserva, r.id_cliente AS id_cliente, CONCAT(LEFT(c.nombre,1), LEFT(c.apellido_paterno,1)) AS iniciales, CONCAT(c.nombre ,' ', c.apellido_paterno,' ', c.apellido_materno) AS cliente, c.correo_cliente AS email, CONCAT(r.fecha_ingreso,' ',r.hora_ingreso) AS ingreso, CONCAT(r.fecha_salida,' ',r.hora_salida) AS salida, ref.nombre AS referido, ep.descripcion AS estado_pago, ep.color FROM ".self::$tablename." r LEFT JOIN cliente c on r.id_cliente=c.id LEFT JOIN referido ref on ref.id=r.id_referido LEFT JOIN estado_pago ep on ep.id=r.id_estado_pago WHERE r.id_usuario=".$id_usuario;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReporteReservaData());
	}

	public static function obtenerReservasPendientePago(){
		$sql = "SELECT r.id AS id_reserva, r.id_cliente AS id_cliente, concat(left(c.nombre,1),left(c.apellido_paterno,1)) as iniciales,concat(c.nombre ,' ', c.apellido_paterno,' ', c.apellido_materno) as cliente,concat(r.fecha_ingreso,' ',r.hora_ingreso) as ingreso, concat(r.fecha_salida,' ',r.hora_salida) as salida,ref.nombre as referido,ep.descripcion as estado_pago,ep.color , h.nombre_habitacion FROM reserva r inner join cliente c on r.id_cliente=c.id inner join referido ref on ref.id=r.id_referido inner join estado_pago ep on ep.id=r.id_estado_pago INNER JOIN habitacion h on h.id=r.id_habitacion WHERE r.id_estado_pago !=7";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReporteReservaData());
	}
	
	public static function obtenerReservaReporte($id){
		$sql = "SELECT c.nombre, c.apellido_paterno, c.apellido_materno, r.observacion, rf.nombre AS nombre_referido, r.fecha_ingreso, r.hora_ingreso, r.fecha_salida, r.hora_salida, h.nombre_habitacion, ep.descripcion as estado_pago FROM reserva AS r LEFT JOIN cliente AS c ON r.id_cliente=c.id LEFT JOIN referido AS rf ON r.id_referido=rf.id LEFT JOIN habitacion AS h ON r.id_habitacion=h.id LEFT JOIN estado_pago AS ep ON r.id_estado_pago=ep.id WHERE r.id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReporteReservaData());
	}	
}
?>