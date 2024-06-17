<?php
	$peticionAjax=true;
	require_once "../config/APP.php";

	if(isset($_POST['empresa_nombre_reg'])){


		/*--------- Instancia al controlador ---------*/
		require_once "../controladores/empresaControlador.php";
		$ins_empresa = new empresaControlador();
     // agg empresa
        if(isset($_POST['empresa_nombre_reg'])){
          echo $ins_empresa->agregar_empresa_controlador();
        }


//si viiene definido las variables que estan ahi se puede actualizar ^usa el controlador^
		
	}else{
		session_start(['name'=>'SPM']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}