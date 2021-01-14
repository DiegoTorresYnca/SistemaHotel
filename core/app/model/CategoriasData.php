<?php
class CategoriasData {
	public static $tablename = "categoria";

	public static function obtenerCategorias(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoriasData());
	}
	
	public function insertCategoria(){
		$sql = "INSERT INTO ".self::$tablename." (nombre_categoria,estado_categoria) VALUE (\"$this->nombre_categoria\",\"$this->estado_categoria\")";
		Executor::doit($sql);
	}

	public static function obtenerCategoria($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CategoriasData());
	}

	public function updateCategoria(){
		$sql = "UPDATE ".self::$tablename." SET nombre_categoria=\"$this->nombre_categoria\",estado_categoria=\"$this->estado_categoria\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteCategoria(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}	

	public static function obtenerCategoriasActivos(){
		$sql = "SELECT * FROM ".self::$tablename ." WHERE estado_categoria='1'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ModulosData());
	}			
}
?>