<?php
class AgregadosData{
    public static $tablename="agregado";        

    public static function obtenerAgregados(){
        $sql = "SELECT a.id,a.descripcion,tm.simbolo,a.costo,a.estado FROM ".self::$tablename." a INNER JOIN tipo_moneda tm on a.id_tipo_moneda=tm.id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AgregadosData());
    }

    public function insertarAgregado(){
        $sql = "INSERT INTO ".self::$tablename." (descripcion,costo,id_tipo_moneda,estado) VALUE (\"$this->descripcion\",\"$this->costo\",\"$this->id_tipo_moneda\",1)";
		Executor::doit($sql);
    }

    public static function obtenerAgregado($id){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AgregadosData());
    }

    public function updateAgregado(){
        $sql = "UPDATE ".self::$tablename." SET descripcion=\"$this->descripcion\",costo=\"$this->costo\",id_tipo_moneda=\"$this->id_tipo_moneda\",estado=\"$this->estado\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
    }

    public function deleteAgregado(){
        $sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
    }
}
?>