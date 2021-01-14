<?php
class DocumentosData {
	public static $tablename = "tipo_documento";

	public static function obtenerDocumentos(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new DocumentosData());
	}
	
	public function insertDocumento(){
		$sql = "INSERT INTO ".self::$tablename." (nombre_documento,estado_documento) VALUE (\"$this->nombre_documento\",\"$this->estado_documento\")";
		Executor::doit($sql);
	}

	public static function obtenerDocumento($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new DocumentosData());
	}

	public function updateDocumento(){
		$sql = "UPDATE ".self::$tablename." SET nombre_documento=\"$this->nombre_documento\",estado_documento=\"$this->estado_documento\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteDocumento(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}	

	public static function obtenerDocumentosActivos(){
		$sql = "SELECT * FROM ".self::$tablename ." WHERE estado_documento='1'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ModulosData());
	}			
}
?>