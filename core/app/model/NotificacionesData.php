<?php
class NotificacionesData {
	public static $tablename = "notificacion";

	public static function obtenerNotificaciones($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id_usuario=$id ORDER BY fecha DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UsuariosNotificacionesData());
	}

	public function insertNotificaciones(){
		$sql = "INSERT INTO ".self::$tablename." (id_usuario,id_modulo,resumen,fecha,estado_notificacion) VALUE (\"$this->id_usuario\",\"$this->id_modulo\",\"$this->resumen\",\"$this->fecha\",\"$this->estado_notificacion\")";
		Executor::doit($sql);
	}

	public function updateNotificacion(){
		$sql = "UPDATE ".self::$tablename." SET estado_notificacion=\"$this->estado_notificacion\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function updateNotificaciones(){
		$sql = "UPDATE ".self::$tablename." SET estado_notificacion=\"$this->estado_notificacion\" WHERE id_usuario=\"$this->id_usuario\"";
		Executor::doit($sql);
	}
}
?>