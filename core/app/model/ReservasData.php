<?php
class ReservasData {
	public static $tablename = "reserva";

	public static function obtenerReservas(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservasData());
	}

	public static function verifyReserva($check_in,$check_out,$habitacion){
		$sql = "SELECT * FROM ".self::$tablename." WHERE ('$check_in' BETWEEN fecha_ingreso and fecha_salida OR '$check_out' BETWEEN fecha_ingreso and fecha_salida) AND id_habitacion='$habitacion'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservasData());
	}
	
	public function insertReserva(){
		$sql = "call insertReserva(\"$this->id_cliente\",\"$this->observacion\",\"$this->id_referido\",\"$this->fecha_ingreso\",\"$this->fecha_salida\",\"$this->hora_ingreso\",\"$this->hora_salida\",\"$this->id_usuario\",\"$this->id_habitacion\",\"$this->id_estado_pago\")";
		Executor::doit($sql);
	}	

	public static function obtenerReserva($id){
		$sql = "SELECT r.id, h.id AS id_habitacion, CONCAT(c.nombre, ' ', c.apellido_paterno, ' ', c.apellido_materno) AS nombre_cliente, ref.nombre AS nombre_referido, h.nombre_habitacion AS numero_habitacion, r.fecha_ingreso, r.hora_ingreso, r.fecha_salida, r.hora_salida, r.observacion FROM reserva AS r LEFT JOIN cliente AS c ON c.id=r.id_cliente LEFT JOIN referido AS ref ON ref.id=r.id_referido LEFT JOIN habitacion AS h ON h.id=r.id_habitacion WHERE r.id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservasData());
	}

	public function updateReserva(){
		$sql = "UPDATE ".self::$tablename." SET id_habitacion=\"$this->id_habitacion\",observacion=\"$this->observacion\",fecha_ingreso=\"$this->fecha_ingreso\",fecha_salida=\"$this->fecha_salida\",hora_ingreso=\"$this->hora_ingreso\",hora_salida=\"$this->hora_salida\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public static function obtenerReservasDashboard($estado){
		$id_usuario=$_SESSION['user_id'];

		if ($estado == "Todas") {
			$filtro_estado = "";

		}
		if ($estado == "Pagadas") {
			$filtro_estado = "AND r.id_estado_pago='7'";

		}
		if ($estado == "Pendientes") {
			$filtro_estado = "AND r.id_estado_pago!='7'";
		}

		$sql = "SELECT r.id AS id_reserva, CONCAT(LEFT(c.nombre,1),LEFT(c.apellido_paterno,1)) AS iniciales_cliente, CONCAT(c.nombre ,' ', c.apellido_paterno,' ', c.apellido_materno) AS nombre_cliente, h.nombre_habitacion AS nombre_habitacion, CONCAT(r.fecha_ingreso,' ',r.hora_ingreso) AS fecha_ingreso, ep.descripcion AS estado_pago, ep.color AS color_pago FROM reserva AS r LEFT JOIN cliente AS c ON c.id=r.id_cliente LEFT JOIN habitacion AS h ON h.id= r.id_habitacion left JOIN estado_pago AS ep ON ep.id=r.id_estado_pago WHERE r.id_usuario=$id_usuario $filtro_estado ORDER BY r.id DESC LIMIT 0, 10";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ClientesData());
	}
}
?>