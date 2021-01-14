<?php
class UsuariosData {
	public static $tablename = "usuario";

	public static function obtenerUsuarios(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new UsuariosData());
	}
	
	public function insertUsuario(){
		$sql = "INSERT INTO ".self::$tablename." (nombre,apellido_paterno,apellido_materno,id_tipo_documento,numero_documento,correo_usuario,estado_usuario,eliminar_usuario,usuario,password,id_rol) VALUE (\"$this->nombre\",\"$this->apellido_paterno\",\"$this->apellido_materno\",\"$this->id_tipo_documento\",\"$this->numero_documento\",\"$this->correo_usuario\",\"$this->estado\",\"$this->eliminar\",\"$this->usuario\",\"$this->password\",\"$this->id_rol\")";
		Executor::doit($sql);
	}

	public static function obtenerUsuario($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UsuariosData());
	}

	public function updateUsuario(){
		$sql = "UPDATE ".self::$tablename." SET nombre=\"$this->nombre\",apellido_paterno=\"$this->apellido_paterno\",apellido_materno=\"$this->apellido_materno\",id_tipo_documento=\"$this->id_tipo_documento\",numero_documento=\"$this->numero_documento\",correo_usuario=\"$this->correo_usuario\",estado_usuario=\"$this->estado\",eliminar_usuario=\"$this->eliminar\",usuario=\"$this->usuario\",password=\"$this->password\",id_rol=\"$this->id_rol\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteUsuario(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}		

	public static function obtenerUsuarioPerfil($id){
		$sql = "SELECT u.nombre, u.apellido_paterno, u.apellido_materno, td.nombre_documento, u.numero_documento, u.correo_usuario, u.usuario, r.nombre_rol FROM ".self::$tablename." AS u LEFT JOIN tipo_documento AS td ON td.id=u.id_tipo_documento LEFT JOIN rol AS r ON r.id=u.id_rol WHERE u.id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UsuariosData());
	}

	public function updateUsuarioPerfil(){
		$sql = "UPDATE ".self::$tablename." SET nombre=\"$this->nombre\",apellido_paterno=\"$this->apellido_paterno\",apellido_materno=\"$this->apellido_materno\",id_tipo_documento=\"$this->id_tipo_documento\",numero_documento=\"$this->numero_documento\",correo_usuario=\"$this->correo_usuario\",usuario=\"$this->usuario\",password=\"$this->password\"";
		Executor::doit($sql);
	}

    public static function obtenerUsuariosActivos(){
        $sql = "SELECT * FROM ".self::$tablename ." WHERE estado_usuario='1'";
        $query = Executor::doit($sql);
        return Model::many($query[0],new EstadoPagoData());
    }           
}
?>