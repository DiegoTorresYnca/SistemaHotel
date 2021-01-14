<?php
class ClientesData {
	public static $tablename = "cliente";

	public static function obtenerClientes(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ClientesData());
	}
	
	public function insertCliente(){
		$sql = "INSERT INTO ".self::$tablename." (nombre,apellido_paterno,apellido_materno,id_tipo_documento,numero_documento,celular_cliente,correo_cliente,id_pais,id_departamento,id_provincia,id_distrito,ciudad,estado_cliente,id_referido) VALUE (\"$this->nombre\",\"$this->apellido_paterno\",\"$this->apellido_materno\",\"$this->id_tipo_documento\",\"$this->numero_documento\",\"$this->celular_cliente\",\"$this->correo_cliente\",\"$this->id_pais\",\"$this->id_departamento\",\"$this->id_provincia\",\"$this->id_distrito\",\"$this->ciudad\",\"$this->estado_cliente\",\"$this->id_referido\")";
		Executor::doit($sql);
	}

	public static function obtenerCliente($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ClientesData());
	}

	public function updateCliente(){
		$sql = "UPDATE ".self::$tablename." SET nombre=\"$this->nombre\",apellido_paterno=\"$this->apellido_paterno\",apellido_materno=\"$this->apellido_materno\",id_tipo_documento=\"$this->id_tipo_documento\",numero_documento=\"$this->numero_documento\",celular_cliente=\"$this->celular_cliente\",correo_cliente=\"$this->correo_cliente\",id_pais=\"$this->id_pais\",id_departamento=\"$this->id_departamento\",id_provincia=\"$this->id_provincia\",id_distrito=\"$this->id_distrito\",ciudad=\"$this->ciudad\",estado_cliente=\"$this->estado_cliente\",id_referido=\"$this->id_referido\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteCliente(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}		

	public static function obtenerClienteReporte($id){
		$sql = "SELECT c.nombre, c.apellido_paterno, c.apellido_materno, td.nombre_documento, c.numero_documento, c.celular_cliente, c.correo_cliente, r.nombre AS nombre_referido FROM ".self::$tablename." AS c LEFT JOIN tipo_documento AS td ON c.id_tipo_documento=td.id LEFT JOIN referido AS r ON c.id_referido=r.id WHERE c.id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ClientesData());
	}
}
?>