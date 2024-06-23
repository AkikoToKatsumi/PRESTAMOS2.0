<?php
	$peticionAjax=true;
	require_once "../config/APP.php";

	if(isset($_POST['buscar_cliente']) || isset($_POST['id_agregar_cliente']) || isset($_POST['id_eliminar_cliente']) 
	|| isset($_POST['buscar_item']) || isset($_POST['id_agregar_item'])) {

		/*--------- Instancia al controlador ---------*/
		require_once "../controladores/prestamoControlador.php";
		$ins_prestamo = new prestamoControlador();

         // buscar cliente
        if(isset($_POST['buscar_cliente'])){
        echo $ins_prestamo->buscar_cliente_prestamo_controlador();

        }
        //AGREGAR CLIENTE
        if(isset($_POST['id_agregar_cliente'])){
            echo $ins_prestamo->agregar_cliente_prestamo_controlador();
        }

         //eliminar CLIENTE
         if(isset($_POST['id_eliminar_cliente'])){
            echo $ins_prestamo->eliminar_cliente_prestamo_controlador();
        }
       // buscar item
        if(isset($_POST['buscar_item'])){
        echo $ins_prestamo->buscar_item_prestamo_controlador();
        }

		// agg item
		if(isset($_POST['id_agregar_item'])){
			echo $ins_prestamo->agregar_item_prestamo_controlador();
			}

//si viiene definido las variables que estan ahi se puede actualizar ^usa el controlador^
		
	}else{
		session_start(['name'=>'SPM']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}
