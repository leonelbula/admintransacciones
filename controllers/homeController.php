<?php

require_once 'models/Transacciones.php';
require_once 'models/Solicitudes.php';

class homeController{
	
	public function index() {		
		
		require_once 'views/login/login.php';
		
	}
   public function home() {
      require_once 'views/layout/menu.php';		
	  require_once 'views/layout/principal.php';
   }
   public function transacciones() {
		require_once 'views/layout/header.php';
		require_once 'views/layout/menu.php';	
		$transancion = new Transacciones();
		$detalles = $transancion->listarTransacciones();
		require_once 'views/transacciones/listatransacciones.php';
		
	}
	public function solicitudes() {
		require_once 'views/layout/header.php';
		require_once 'views/layout/menu.php';
		$solicitud = new Solicitudes();		
		$detalles = $solicitud->listarSolicitudes();
				
		require_once 'views/transacciones/listasolicitudes.php';
		
	}
	
}

