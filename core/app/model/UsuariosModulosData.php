<?php
class UsuariosModulosData {
	public static $tablename = "usuario_modulo";

	public static function obtenerUsuariosModulos($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id_usuario=$id ORDER BY id_modulo_usuario ASC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UsuariosModulosData());
	}

	public function insertUsuariosModulos(){
		$sql = "INSERT INTO ".self::$tablename." (id_usuario,id_modulo_usuario) VALUE (\"$this->id_usuario\",\"$this->id_modulo_usuario\")";
		Executor::doit($sql);
	}

	public function deleteUsuariosModulos(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id_usuario=\"$this->id\"";
		Executor::doit($sql);
	}
}
?>