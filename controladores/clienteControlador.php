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
            $direccion=mainModel::limpiar_Cadena($_POST['cliente_direccion_reg']);

			/*== comprobar campos vacios ==*/
            if($dni=="" || $nombre=="" || $apellido=="" || $telefono=="" || $direccion== ""){
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


            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El nombre no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}",$apellido)){
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

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$direccion)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"La direccion coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

			/*== comprobar DNI Para que nos e repita en DB ==*/
//vid51
		$check_dni=mainModel::ejecutar_consulta_simple("SELECT cliente_dni FROM
		cliente WHERE cliente_dni='$dni'");
		if($check_dni->rowCount()>0){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El DNI ya esta registrado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}
		$datos_cliente_reg=[
				"DNI"=>$dni,
				"Nombre"=>$nombre,
				"Apellido"=>$apellido,
				"Telefono"=>$telefono,
				"Direccion"=>$direccion
		];

        $agregar_cliente=clienteModelo::agregar_cliente_modelo($datos_cliente_reg);

			if($agregar_cliente->rowCount()==1){
				$alerta=[
					"Alerta"=>"limpiar",
					"Titulo"=>"Cliente",
					"Texto"=>"Los datos del cliente fueron registrados",
					"Tipo"=>"success"
				];
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No hemos podido registrar el cliente",
					"Tipo"=>"error"
				];
			}
			echo json_encode($alerta);
        } //fin controlador

			/*--------- Controlador paginar clientes ---------*/
			public function paginador_cliente_controlador($pagina,$registros,$privilegio,
			$url,$busqueda){

				$pagina=mainModel::limpiar_cadena($pagina);
				$registros=mainModel::limpiar_cadena($registros);
				$privilegio=mainModel::limpiar_cadena($privilegio);
					
				$url=mainModel::limpiar_cadena($url);
				$url=SERVERURL.$url."/";
	
				$busqueda=mainModel::limpiar_cadena($busqueda);
				$tabla="";
	
				$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
				$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

	            //contar cuantos registros hay en  la base dedatos
				if(isset($busqueda) && $busqueda!=""){
					$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE (( 
					cliente_dni LIKE '%$busqueda%' OR cliente_nombre LIKE 
					'%$busqueda%' OR cliente_apellido LIKE
					 '%$busqueda%' OR cliente_telefono LIKE 
					 '%$busqueda%'  LIKE '%$busqueda%')) ORDER BY cliente_nombre 
					 ASC LIMIT $inicio,$registros";
				//solo contara una cant de registro por pagina
				}else{
					$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente
					  ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
				}
				//conect a la DB para 
				$conexion = mainModel::conectar();
				//almacenar datos desde la DB
				$datos = $conexion->query($consulta);
				$datos = $datos->fetchAll(); 
				$total = $conexion->query("SELECT FOUND_ROWS()");
				$total = (int) $total->fetchColumn();
				//contar el # pag totales en la DB o registros x pag
				$Npaginas=ceil($total/$registros);
		
				$tabla.='<div class="table-responsive">
					<table class="table table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>DNI</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>TELÉFONO</th>
								<th>DIRECCION</th>';
								if($privilegio==1 || $privilegio==2){
									$tabla.='<th>ACTUALIZAR</th>';
								}
								if($privilegio==1){
									$tabla.='<th>ELIMINAR</th>';
								}
							$tabla.='</tr>
						</thead>
						<tbody>';

				if($total>=1 && $pagina<=$Npaginas){
					$contador=$inicio+1;
					$reg_inicio=$inicio+1;
					foreach($datos as $rows){
						$tabla.='
						<tr class="text-center" >
							<td>'.$contador.'</td>
							<td>'.$rows['cliente_dni'].'</td>
							<td>'.$rows['cliente_nombre'].'</td>
							<td>'.$rows['cliente_apellido'].'</td>
							<td>'.$rows['cliente_telefono'].'</td>
							<td><button type="button" class="btn btn-info"
							data-toggle="popover" data-trigger="hover" title="'.$rows['cliente_direccion'].'
							" data-content="'.$rows['cliente_direccion'].'">
										<i class="fas fa-info-circle"></i>
									</button></td>';

									if($privilegio==1 || $privilegio==2){
										$tabla.='<td>
										<a href="'.SERVERURL.'client-update/'.mainModel::
										encryption($rows['cliente_id']).'" class="btn 
										btn-success">
												<i class="fas fa-sync-alt"></i>	
										</a>
									</td>';
								}
								if($privilegio==1){
								$tabla.='<td>
									<form class="FormularioAjax" action="'.SERVERURL.'ajax/clienteAjax.php" 
									method="POST" data-form="delete" autocomplete="off">
										<input type="hidden" name="cliente_id_del" 
										value="'.mainModel::encryption($rows['cliente_id']).'">
										<button type="submit" class="btn btn-warning">
												<i class="far fa-trash-alt"></i>
										</button>
									</form>
								</td>';
								}
						$tabla.='</tr>';
						$contador++;
					}
					$reg_final=$contador-1;
				}else{
					//sino hay registros saldra el texto de no hay reg....
					if($total>=1){
						$tabla.='<tr class="text-center" ><td colspan="9">
						<a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">
						Haga clic aca para recargar el listado</a>
						</td></tr>';
					}else{
						$tabla.='<tr class="text-center" >
						<td colspan="9">No hay registros en el sistema</td></tr>';
					}
				}
	
				$tabla.='</tbody></table></div>';
	//texto para mostrar cantidad dependiendo la pagina
				if($total>=1 && $pagina<=$Npaginas){
					$tabla.='<p class="text-right">Mostrando cliente '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
	
					$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
				}
				return $tabla;
			} /* Fin controlador */

           /*__controlador eliminar clientes___*/
			public function eliminar_cliente_controlador(){
				//RECUPERAR ID del cliente
				$id=mainModel::decryption($_POST['cliente_id_del']);
				$id=mainModel::limpiar_cadena($id);

				//comprobar el cliente en la DB
				$check_cliente=mainModel::ejecutar_consulta_simple("SELECT cliente_id
				FROM cliente WHERE cliente_id='$id'");

				if($check_cliente->rowCount()<=0){
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrio un error ",
						"Texto"=> "No hemos encontrado el cliente en el sistema",
						"Tipo"=>"error"
					];
                echo json_encode($alerta);
				exit();
				}
				//comprobar prestamos
				$check_prestamos=mainModel::ejecutar_consulta_simple("SELECT cliente_id
				FROM prestamo WHERE cliente_id='$id' LIMIT 1");
				if($check_prestamos->rowCount()>0){
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrio un error ",
						"Texto"=> "No podemos eliminar el cliente del sistema",
						"Tipo"=>"error"
					];
                echo json_encode($alerta);
				exit();
				}
               
				//ccmprobar privilegios de cliente
				session_start(['name'=>'SPM']);
				if($_SESSION['privilegio_spm']!=1){

					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrio un error ",
						"Texto"=> "No tienes los permisos para realizar esta acción",
						"Tipo"=>"error"
					];
                echo json_encode($alerta);
				exit();
				}

				$eliminar_cliente=clienteModelo::eliminar_cliente_modelo($id);

				if($eliminar_cliente->rowCount()==1){
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Cliente eliminado ",
						"Texto"=> "cliente eliminado del sistema",
						"Tipo"=>"success"
					];

				}else{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrio un error inesperado ",
						"Texto"=> "No hemos podido eliminar el cliente, intenta otra vez",
						"Tipo"=>"error"
					];

				}
				echo json_encode($alerta);
				exit();
			} /* Fin controlador */

           /*__controlador selec datos clientes___*/
		   public function datos_cliente_controlador($tipo,$id){
			$tipo=mainModel::limpiar_cadena($tipo);

			$id=mainModel::decryption($id);
			$id=mainModel::limpiar_cadena($id);

			return clienteModelo::datos_cliente_modelo($tipo,$id);
		   }//fin controlador


		   //controlador act cliente//
		public function actualizar_cliente_controlador(){
			//recuoerar el id
			$id=mainModel::decryption($_POST['cliente_id_up']);
			$id=mainModel::limpiar_cadena($id);

			//comprobar el cliente en la DB
		   $check_cliente=mainModel::ejecutar_consulta_simple("SELECT * FROM 
		   cliente WHERE cliente_id='$id'");
		   if($check_cliente->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error",
					"Texto"=> "No hemos encontrado al cliente",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
		   }else{
			$campos=$check_cliente->fetch();
			}	  
			$dni=mainModel::limpiar_cadena($_POST['cliente_dni_up']);
			$nombre=mainModel::limpiar_cadena($_POST['cliente_nombre_up']);
			$apellido=mainModel::limpiar_cadena($_POST['cliente_apellido_up']);
        	$telefono=mainModel::limpiar_cadena($_POST['cliente_telefono_up']);
        	$direccion=mainModel::limpiar_cadena($_POST['cliente_direccion_up']);
        
			//comprobar campos vacios
			if($dni=="" || $nombre=="" || $apellido=="" || $telefono=="" || $direccion== ""){
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

			if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}",$nombre)){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El nombre no coincide con el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
			}

			if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}",$apellido)){
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

			if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$direccion)){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"La direccion coincide con el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
			}

			/*== comprobar DNI  ==*/
    		if($dni!=$campos['cliente_dni']){
			$check_dni=mainModel::ejecutar_consulta_simple("SELECT
		 	cliente_dni FROM cliente WHERE cliente_dni='$dni'");
			if($check_dni->rowCount()>0){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El DNI ya esta registrado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		  		}
	 		}	

		  // comprobar privillegios de admin
		session_start(['name'=>'SPM']);
		if($_SESSION['privilegio_spm']<1 || $_SESSION['privilegio_spm']>
		2){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No tienes los permisos suficientes",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
	    }
	         $datos_cliente_up=[
                "DNI"=>$dni,
				"Nombre"=>$nombre,
				"Apellido"=>$apellido,
				"Telefono"=>$telefono,
				"Direccion"=>$direccion,
				"ID"=>$id
			 ];
               if(clienteModelo::actualizar_cliente_modelo($datos_cliente_up)){
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Cliente actualizado",
					"Texto"=>"Los datos del cliente han sido actualizados",
					"Tipo"=>"success"
				];
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No pudimos actualizar los datos",
					"Tipo"=>"error"
				];
		    }
			echo json_encode($alerta);
		  
	}//fin de controlador
	}