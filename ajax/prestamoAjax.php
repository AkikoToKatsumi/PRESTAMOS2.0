<?php
	$peticionAjax=true;
	require_once "../config/APP.php";

	if() {

		/*--------- Instancia al controlador ---------*/
		require_once "../controladores/prestamoControlador.php";
		$ins_prestamo = new prestamoControlador();

      
//si viiene definido las variables que estan ahi se puede actualizar ^usa el controlador^
		
	}else{
		session_start(['name'=>'SPM']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}
