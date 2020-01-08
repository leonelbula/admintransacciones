<?php

require_once 'config/DataBase.php';

class Transacciones {
	public  $db;
	
	function __construct() {
		$this->db = Database::connect();
	}
	public function listarTransacciones() {		
		$sql = "SELECT e.*, d.* FROM envios e, datos_bancario d WHERE e.id_datosbancarios = d.id AND e.estado = 1 ORDER BY e.id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}