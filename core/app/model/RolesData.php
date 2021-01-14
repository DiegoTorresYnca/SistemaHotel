<?php
class RolesData {
	public static $tablename = "rol";

	public static function obtenerRoles(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new RolesData());
	}
	
	public function insertRol(){
		$sql = "INSERT INTO ".self::$tablename." (nombre_rol,estado_rol) VALUE (\"$this->nombre_rol\",\"$this->estado_rol\")";
		Executor::doit($sql);
	}

	public static function obtenerRol($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new RolesData());
	}

	public function updateRol(){
		$sql = "UPDATE ".self::$tablename." SET nombre_rol=\"$this->nombre_rol\",estado_rol=\"$this->estado_rol\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteRol(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}		

	public static function obtenerRolesActivos(){
		$sql = "SELECT * FROM ".self::$tablename ." WHERE estado_rol='1'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ModulosData());
	}			
}
?>