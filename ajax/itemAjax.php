<?php
	$peticionAjax=true;
	require_once "../config/APP.php";

	if(isset($_POST['item_codigo_reg']) || isset($_POST['item_id_del']) || isset($_POST['cliente_id_up'])){

		

		/*--------- Instancia al controlador ---------*/
		require_once "../controladores/itemControlador.php";
		$ins_item = new itemControlador();

         /*AGG item*/
        if(isset($_POST['item_codigo_reg'])){
            echo $ins_item->agregar_item_controlador();
        }

		  //*Delete item*/
		  if(isset($_POST['item_id_del'])){
            echo $ins_item->eliminar_item_controlador();
        }

		/*Act item*/
		if(isset($_POST['item_id_up'])){
			echo $ins_item->actualizar_item_controlador();
		   }//f

//si viiene definido las variables que estan ahi se puede actualizar ^usa el controlador^
		
	}else{
		session_start(['name'=>'SPM']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}