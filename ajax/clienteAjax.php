<?php
	$peticionAjax=true;
	require_once "../config/APP.php";

	if(isset($_POST['cliente_dni_reg']) || isset($_POST['cliente_id_del']) || 
	isset($_POST['cliente_id_up'])){


		/*--------- Instancia al controlador ---------*/
		require_once "../controladores/clienteControlador.php";
		$ins_cliente = new clienteControlador();

        //Agg cliente
        if(isset($_POST['cliente_dni_reg']) && isset($_POST['cliente_nombre_reg']))
        {
            echo $ins_cliente->agregar_cliente_controlador();

        }
		/*Eliminar cliente*/
		if(isset($_POST['cliente_id_del'])){
         echo $ins_cliente->eliminar_cliente_controlador();
		}//fin contr

		/*Act cliente*/
		if(isset($_POST['cliente_id_up'])){
			echo $ins_cliente->actualizar_cliente_controlador();
		   }//f


//si viiene definido las variables que estan ahi se puede actualizar ^usa el controlador^
		
	}else{
		session_start(['name'=>'SPM']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}