<?php
class TarifasData {
	public static $tablename = "tarifa";

	public static function obtenerTarifasActivas(){
		$sql="SELECT t.id,t.nombre_tarifa,tm.simbolo,t.precio_minimo,t.precio_base,c.nombre_categoria from tarifa t inner join tipo_moneda tm 
		on tm.id=t.id_tipo_moneda inner join categoria c on c.id=t.id_categoria where t.estado_tarifa=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TarifasData());
	}

	public static function obtenerTarifas(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new TarifasData());
	}
	
	public function insertTarifa(){
		$sql = "INSERT INTO ".self::$tablename." (nombre_tarifa,precio_minimo,precio_base,estado_tarifa,id_categoria,id_tipo_moneda) VALUE (\"$this->nombre_tarifa\",\"$this->precio_minimo\",\"$this->precio_base\",\"$this->estado_tarifa\",\"$this->tipo_categoria\",\"$this->tipo_moneda\")";
		Executor::doit($sql);
	}

	public static function obtenerTarifa($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TarifasData());
	}

	public function updateTarifa(){
		$sql = "UPDATE ".self::$tablename." SET nombre_tarifa=\"$this->nombre_tarifa\",precio_minimo=\"$this->precio_minimo\",precio_base=\"$this->precio_base\",estado_tarifa=\"$this->estado_tarifa\",id_categoria=\"$this->tipo_categoria\",id_tipo_moneda=\"$this->tipo_moneda\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}

	public function deleteTarifa(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
	}		
}
?>