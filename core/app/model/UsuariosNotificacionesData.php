<?php
class UsuariosNotificacionesData {
	public static $tablename = "usuario_notificacion";

	public static function obtenerUsuariosNotificaciones($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id_usuario=$id ORDER BY id_modulo_usuario ASC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UsuariosNotificacionesData());
	}

	public function insertUsuariosNotificaciones(){
		$sql = "INSERT INTO ".self::$tablename." (id_usuario,id_modulo_usuario) VALUE (\"$this->id_usuario\",\"$this->id_modulo_usuario\")";
		Executor::doit($sql);
	}

	public function deleteUsuariosNotificaciones(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id_usuario=\"$this->id\"";
		Executor::doit($sql);
	}

	public static function obtenerUsuariosNotificacion($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id_modulo_usuario=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UsuariosNotificacionesData());
	}

}
?>