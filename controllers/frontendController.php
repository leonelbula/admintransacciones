<?php

class frontendController{
	
	public function index() {		
		
		require_once 'views/login/login.php';
		
	}
   public function home() {
      require_once 'views/layout/menu.php';		
		require_once 'views/layout/principal.php';
   }
	
}

