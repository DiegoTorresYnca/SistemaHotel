<?php
class FeriadosData {
	public static $tablename = "feriado";

	public static function obtenerFeriados(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new FeriadosData());
	}
	
	public function insertFeriado(){
		$sql = "INSERT INTO ".self::$tablename." (nombre,fecha_inicio,fecha_termino,estado_feriado) VALUE (\"$this->nombre\",\"$this->fecha_inicio\",\"$this->fecha_termino\",\"$this->estado_feriado\")";
		Executor::doit($sql);
	}

	public static function obtenerFeriado($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new FeriadosData());
	}

	public function updateFeriado(){
		$sql = "UPDATE ".self::$tablename." SET nombre=\"$this->nombre\",fecha_inicio=\"$this->fecha_inicio\",fecha_termino=\"$this->fecha_termino\",estado_feriado=\"$this->estado_feriado\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteFeriado(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}		

	public static function obtenerFeriadosActivos(){
		$sql = "SELECT * FROM ".self::$tablename ." WHERE estado_feriado='1'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ModulosData());
	}			
}
?>