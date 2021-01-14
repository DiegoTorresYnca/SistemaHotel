<?php
class ReferidosData {
	public static $tablename = "referido";

	public static function obtenerReferidos(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReferidosData());
	}
	
	public function insertReferido(){
		$sql = "INSERT INTO ".self::$tablename." (nombre) VALUE (\"$this->nombre\")";
		Executor::doit($sql);
	}

	public static function obtenerReferido($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReferidosData());
	}

	public function updateReferido(){
		$sql = "UPDATE ".self::$tablename." SET nombre=\"$this->nombre\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteReferido(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}		
}
?>