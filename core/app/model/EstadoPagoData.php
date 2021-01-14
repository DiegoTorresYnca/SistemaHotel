<?php
class EstadoPagoData{
    public static $tablename = "estado_pago";

    public static function obtenerEstadoPagos(){
        $sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstadoPagoData());
    }

    public static function obtenerPagosCombo(){
        $sql="SELECT * FROM estado_pago where combo_opcion=1 and estado=1";
        $query = Executor::doit($sql);
		return Model::many($query[0],new EstadoPagoData());
    }

    public static function obtenerEstadoPagoUsuarioCombo(){
        $sql="SELECT * FROM estado_pago where combo_opcion=1 and estado=1 and id!=8";
        $query = Executor::doit($sql);
		return Model::many($query[0],new EstadoPagoData());
    }

    public static function obtenerEstadoPago($id){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EstadoPagoData());
    }

    public function updateEstadoPago(){
        $sql = "UPDATE ".self::$tablename." SET color=\"$this->color\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
    }

    public static function obtenerEstadoPagoActivos(){
        $sql = "SELECT * FROM ".self::$tablename ." WHERE estado='1'";
        $query = Executor::doit($sql);
        return Model::many($query[0],new EstadoPagoData());
    }           
}
?>