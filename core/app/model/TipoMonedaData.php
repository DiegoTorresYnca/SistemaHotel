<?php
class TipoMonedaData{
    public static $tablename="tipo_moneda";

    public static function obtenerTipoMonedas(){
        $sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new TipoMonedaData());
    }

    public function insertarTipoMoneda(){
        $sql = "INSERT INTO ".self::$tablename." (simbolo,cambio,estado) VALUE (\"$this->simbolo\",\"$this->cambio\",1)";
		Executor::doit($sql);
    }

    public static function obtenerTipoMoneda($id){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TipoMonedaData());
    }

    public function updateTipoMoneda(){
        $sql = "UPDATE ".self::$tablename." SET simbolo=\"$this->simbolo\",cambio=\"$this->cambio\",estado=\"$this->estado\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
    }

    public function deleteTipoMoneda(){
        $sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
    }

    public static function obtenerTipoMonedaActivos(){
        $sql = "SELECT * FROM ".self::$tablename ." WHERE estado='1'";
        $query = Executor::doit($sql);
        return Model::many($query[0],new TipoMonedaData());
    }           
}
?>