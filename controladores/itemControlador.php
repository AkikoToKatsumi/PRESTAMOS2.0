<?php

	if($peticionAjax){
		require_once "../modelos/itemModelo.php";
	}else{
		require_once "./modelos/itemModelo.php";
	}

	class itemControlador extends itemModelo{
            /*Controlador agg item*/
    public function agregar_item_controlador(){

    }/*fincontrolador*/

}