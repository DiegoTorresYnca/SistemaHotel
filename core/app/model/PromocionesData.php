<?php
class PromocionesData{
    public static $tablename = "promociones";

    public static function obtenerPromociones(){
        $sql = "SELECT p.*,tm.simbolo FROM ".self::$tablename." p inner join tipo_moneda tm on p.id_tipo_moneda=tm.id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PromocionesData());
    }

    public static function obtenerPromocionesUsuarioFinal(){
        $sql = "SELECT p.id,p.descripcion,tm.simbolo,p.costo,p.dias_minimo,p.estado,c.nombre_categoria,p.fecha_vencimiento,p.id_categoria FROM ".self::$tablename." p inner join categoria c on p.id_categoria=c.id inner join tipo_moneda tm
        on p.id_tipo_moneda=tm.id where p.estado=1 and p.fecha_vencimiento>=now()";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PromocionesData());
    }

    public function insertarPromocion(){
        $sql = "INSERT INTO ".self::$tablename." (descripcion,costo,id_tipo_moneda,dias_minimo,fecha_vencimiento,estado,id_categoria) VALUE (\"$this->descripcion\",\"$this->costo\",\"$this->id_tipo_moneda\",\"$this->dias_minimo\",\"$this->fecha_vencimiento\",\"$this->estado\",\"$this->id_categoria\")";
        Executor::doit($sql);       
    }

    public static function obtenerPromocion($id){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PromocionesData());
    }

    public function updatePromocion(){
        $sql = "UPDATE ".self::$tablename." SET descripcion=\"$this->descripcion\",costo=\"$this->costo\",id_tipo_moneda=\"$this->id_tipo_moneda\",dias_minimo=\"$this->dias_minimo\",fecha_vencimiento=\"$this->fecha_vencimiento\",estado=\"$this->estado\",id_categoria=\"$this->id_categoria\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
    }

    public function deletePromocion(){
        $sql = "DELETE FROM ".self::$tablename." WHERE id=\"$this->id\"";
		Executor::doit($sql);
    }
}
?>