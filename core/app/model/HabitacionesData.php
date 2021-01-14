<?php
class HabitacionesData {
	public static $tablename = "habitacion";

	public static function obtenerHabitaciones(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new HabitacionesData());
	}

	public static function obtenerHabitacionesCategoria($id){
		$sql = "SELECT * FROM ".self::$tablename." where id_categoria=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new HabitacionesData());
	}
	
	public function insertHabitacion(){
		$sql = "INSERT INTO ".self::$tablename." (nombre_habitacion,detalles,id_categoria,url_imagen,estado_habitacion,estado_reserva) VALUE (\"$this->nombre_habitacion\",\"$this->detalles\",\"$this->id_categoria\",\"$this->url_imagen\",\"$this->estado_habitacion\",0)";
		Executor::doit($sql);
	}

	public static function obtenerHabitacion($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new HabitacionesData());
	}

	public function updateHabitacion(){
		$sql = "UPDATE ".self::$tablename." SET nombre_habitacion=\"$this->nombre_habitacion\",detalles=\"$this->detalles\",id_categoria=\"$this->id_categoria\",url_imagen=\"$this->url_imagen\",estado_habitacion=\"$this->estado_habitacion\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteHabitacion(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}	

    public static function obtenerHabitacionesActivos(){
        $sql = "SELECT * FROM ".self::$tablename ." WHERE estado_habitacion='1'";
        $query = Executor::doit($sql);
        return Model::many($query[0],new HabitacionesData());
    }           		
}
?>