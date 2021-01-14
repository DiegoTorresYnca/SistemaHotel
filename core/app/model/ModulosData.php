<?php
class ModulosData {
	public static $tablename = "modulo_usuario";

	public static function obtenerModulos(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ModulosData());
	}
	
	public function insertModulo(){
		$sql = "INSERT INTO ".self::$tablename." (nombre_modulo,url_modulo,icono_modulo,modulo_padre,id_modulo_padre) VALUE (\"$this->nombre_modulo\",\"$this->url_modulo\",\"$this->icono_modulo\",\"$this->modulo_padre\",\"$this->id_modulo_padre\")";
		Executor::doit($sql);
	}

	public static function obtenerModulo($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ModulosData());
	}

	public function updateModulo(){
		$sql = "UPDATE ".self::$tablename." SET nombre_modulo=\"$this->nombre_modulo\",url_modulo=\"$this->url_modulo\",icono_modulo=\"$this->icono_modulo\",modulo_padre=\"$this->modulo_padre\",id_modulo_padre=\"$this->id_modulo_padre\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteModulo(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}		

	public static function obtenerModuloPadre(){
		$sql = "SELECT * FROM ".self::$tablename ." WHERE modulo_padre='1' ORDER BY id ASC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ModulosData());
	}

	public static function obtenerModuloHijo($id){
		$sql = "SELECT * FROM ".self::$tablename ." WHERE modulo_padre='0' and id_modulo_padre=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ModulosData());
	}

	public static function obtenerIdModulo($url){
		$sql = "SELECT * FROM ".self::$tablename." WHERE url_modulo='$url'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ModulosData());
	}
}
?>