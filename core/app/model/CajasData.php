<?php
class CajasData {
	public static $tablename = "caja";

	public static function obtenerCajas(){
		$id_usuario = $_SESSION['user_id'];

		$sql = "SELECT * FROM ".self::$tablename." WHERE id_usuario=".$id_usuario;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CajasData());
	}

	public static function totalCajaDia(){
		$id_usuario = $_SESSION['user_id'];
		$fecha=date('Y-m-d');
		$sql="SELECT SUM(monto_cierre) as Total FROM ".self::$tablename."	
		where id_usuario=".$id_usuario." and fecha_apertura like '".$fecha."%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ModulosData());
	}
	
	public function insertCaja(){
		$sql = "INSERT INTO ".self::$tablename." (fecha_apertura,monto_apertura,id_usuario) VALUE (\"$this->fecha_apertura\",\"$this->monto_apertura\",\"$this->id_usuario\")";
		Executor::doit($sql);
	}

    public function updateCaja(){
        $sql = "UPDATE ".self::$tablename." SET fecha_cierre=\"$this->fecha_cierre\",monto_cierre=\"$this->monto_cierre\" WHERE id=\"$this->id\"";
		Executor::doit($sql);
    }

	public static function obtenerCaja(){
		$id_usuario = $_SESSION['user_id'];

		$sql = "SELECT * FROM ".self::$tablename." WHERE id_usuario=".$id_usuario." AND fecha_cierre IS NULL ORDER BY id DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ModulosData());
	}

}
?>