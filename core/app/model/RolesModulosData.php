<?php
class RolesModulosData {
	public static $tablename = "rol_modulo";

	public static function obtenerRolesModulos($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id_rol=$id ORDER BY id_modulo_usuario ASC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new RolesModulosData());
	}

	public function insertRolesModulos(){
		$sql = "INSERT INTO ".self::$tablename." (id_rol,id_modulo_usuario) VALUE (\"$this->id_rol\",\"$this->id_modulo_usuario\")";
		Executor::doit($sql);
	}

	public function deleteRolesModulos(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id_rol=\"$this->id\"";
		Executor::doit($sql);
	}
}
?>