<?php

	if($peticionAjax){
		require_once "../modelos/clienteModelo.php";
	}else{
		require_once "./modelos/clienteModelo.php";
	}

	class clienteControlador extends clienteModelo{
        //controlador agg 
		public  function agregar_cliente_controlador(){

            $dni=mainModel::limpiar_Cadena($_POST['cliente_dni_reg']);
            $nombre=mainModel::limpiar_Cadena($_POST['cliente_nombre_reg']);
            $apellido=mainModel::limpiar_Cadena($_POST['cliente_apellido_reg']);
            $telefono=mainModel::limpiar_Cadena($_POST['cliente_telefono_reg']);
            $direcion=mainModel::limpiar_Cadena($_POST['cliente_direccion_reg']);

			/*== comprobar campos vacios ==*/
            if($dni=="" || $nombre=="" || $apellido=="" || $telefono=="" || $direcion== ""){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No has llenado todos los campos que son obligatorios",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
            	/*== Verificando integridad de los datos ==*/
			if(mainModel::verificar_datos("[0-9-]{1,27}",$dni)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El DNI no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}


            if(mainModel::verificar_datos("[a-zA- ZáéíóúÁÉÍÓÚ]{1,40}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El nombre no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[a-zA- ZáéíóúÁÉÍÓÚ]{1,40}",$apellido)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El apellido coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[0-9()+]{8,20}",$telefono)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El telefono coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$direcion)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"La direccion coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
//vid50


        }//fin controlador
    }