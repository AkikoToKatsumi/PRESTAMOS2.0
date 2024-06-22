<?php

	if($peticionAjax){
		require_once "../modelos/itemModelo.php";
	}else{
		require_once "./modelos/itemModelo.php";
	}

	class itemControlador extends itemModelo{
            /*Controlador agg item*/
    public function agregar_item_controlador(){
	$codigo=mainModel::limpiar_cadena($_POST['item_codigo_reg']);
	$nombre=mainModel::limpiar_cadena($_POST['item_nombre_reg']);
	$stock=mainModel::limpiar_cadena($_POST['item_stock_reg']);
	$estado=mainModel::limpiar_cadena($_POST['item_estado_reg']);
	$detalle=mainModel::limpiar_cadena($_POST['item_detalle_reg']);
    
	/*== comprobar campos vacios ==*/
	if($codigo=="" || $nombre=="" ||$stock=="" || $estado==""){
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
	if(mainModel::verificar_datos("[a-zA-Z0-9-]{1,45}",$codigo)){
		$alerta=[
			"Alerta"=>"simple",
			"Titulo"=>"Ocurrió un error inesperado",
			"Texto"=>"El codigo no coincide con el formato solicitado",
			"Tipo"=>"error"
		];
		echo json_encode($alerta);
		exit();
	}

	if(mainModel::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,140}",$nombre)){
		$alerta=[
			"Alerta"=>"simple",
			"Titulo"=>"Ocurrió un error inesperado",
			"Texto"=>"El Nombre no coincide con el formato solicitado",
			"Tipo"=>"error"
		];
		echo json_encode($alerta);
		exit();
	}

	if(mainModel::verificar_datos("[0-9]{1,9}",$stock)){
		$alerta=[
			"Alerta"=>"simple",
			"Titulo"=>"Ocurrió un error inesperado",
			"Texto"=>"El Stock no coincide con el formato solicitado",
			"Tipo"=>"error"
		];
		echo json_encode($alerta);
		exit();
	}
	if($detalle!=""){
		if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}",$detalle)){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El detalle no coincide con el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

	}

	if($estado!="Habilitado" && $estado!= "Deshabilitado"){
					$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El estado no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			
     	}
        /**Comp codigos*/
		$check_codigo=mainModel::ejecutar_consulta_simple("SELECT 
		item_codigo FROM item WHERE item_codigo='$codigo'");
		if($check_codigo->rowCount()>0){
		   $alerta=[
			   "Alerta"=>"simple",
			   "Titulo"=>"Ocurrió un error inesperado",
			   "Texto"=>"El codigo ya existe ",
			   "Tipo"=>"error"
		   ];
		   echo json_encode($alerta);
		   exit();
		}
		 /**Comp codigos*/
		 $check_nombre=mainModel::ejecutar_consulta_simple("SELECT item_nombre FROM item WHERE item_nombre='$nombre'");
		 if($check_nombre->rowCount()>0){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El Nombre del item ya existe ",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		 }
		$datos_item_reg=[
         "Codigo"=>$codigo,
		 "Nombre"=>$nombre,
		 "Stock"=>$stock,
		 "Estado"=>$estado,
		 "Detalle"=>$detalle
		];

		$agregar_item=itemModelo::agregar_item_modelo($datos_item_reg);
		if($agregar_item->rowCount()==1 ){
			$alerta=[
				"Alerta"=>"limpiar",
				"Titulo"=>"Item Registrado",
				"Texto"=>"Datos del item registrados",
				"Tipo"=>"success"
			];
		}else{
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No hemos registrar el item",
				"Tipo"=>"error"
			];
		}//vid72
		echo json_encode($alerta); 
	}/*fincontrolador*/
/*--------- Controlador paginar items ---------*/
public function paginador_item_controlador($pagina,$registros,$privilegio,$url,$busqueda){

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
		$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM item WHERE
		item_codigo LIKE '%$busqueda%' OR item_nombre LIKE 
		'%$busqueda%' ORDER BY item_nombre ASC LIMIT $inicio,$registros";
	//solo contara una cant de registro por pagina
	}else{
		$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM item
		  ORDER BY item_nombre ASC LIMIT $inicio,$registros";
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
					<th>CODIGO</th>
					<th>NOMBRE</th>
					<th>STOCK</th>
					<th>ESTADO</th>
					<th>DETALLE</th>';
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
				<td>'.$rows['item_codigo'].'</td>
				<td>'.$rows['item_nombre'].'</td>
				<td>'.$rows['item_stock'].'</td>
				<td>'.$rows['item_estado'].'</td>
				<td><button type="button" class="btn btn-info"
				data-toggle="popover" data-trigger="hover" title="'.$rows['item_nombre'].'"data-content="'.$rows['item_detalle'].'">
							<i class="fas fa-info-circle"></i>
						</button></td>';

						if($privilegio==1 || $privilegio==2){
							$tabla.='<td>
							<a href="'.SERVERURL.'item-update/'.mainModel::
							encryption($rows['item_id']).'" class="btn 
							btn-success">
									<i class="fas fa-sync-alt"></i>	
							</a>
						</td>';
					}
					if($privilegio==1){
					$tabla.='<td>
						<form class="FormularioAjax" action="'.SERVERURL.'ajax/itemAjax.php" 
						method="POST" data-form="delete" autocomplete="off">
							<input type="hidden" name="item_id_del" 
							value="'.mainModel::encryption($rows['item_id']).'">
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
			$tabla.='<tr class="text-center" ><td colspan="8">
			<a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">
			Haga clic aca para recargar el listado</a>
			</td></tr>';
		}else{
			$tabla.='<tr class="text-center" >
			<td colspan="8">No hay registros en el sistema</td></tr>';
		}
	}

	$tabla.='</tbody></table></div>';
//texto para mostrar cantidad dependiendo la pagina
	if($total>=1 && $pagina<=$Npaginas){
		$tabla.='<p class="text-right">Mostrando item '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';

		$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
	}
	return $tabla;
} /* Fin controlador */

 /*Controlador liminaritem*/
 public function eliminar_item_controlador(){

	$id=mainModel::decryption($_POST['item_id_del']);
	$id=mainModel::limpiar_cadena($id);
  
	//Comprobar que el item este refistrado en DB
	$check_item=mainModel::ejecutar_consulta_simple("SELECT item_id FROM item WHERE item_id='$id'");
	if($check_item->rowCount()<=0){
	  $alerta=[
		  "Alerta"=>"simple",
		  "Titulo"=>"Ocurrió un error inesperado",
		  "Texto"=>"El item no existe",
		  "Tipo"=>"error"
	  ];
	  echo json_encode($alerta);
	  exit();
	   }
	   //Comprobando detalles de prestamos
	   $check_prestamos=mainModel::ejecutar_consulta_simple("SELECT item_id FROM detalle WHERE item_id='$id' LIMIT 1");
	   if($check_prestamos->rowCount()>0){
		 $alerta=[
			 "Alerta"=>"simple",
			 "Titulo"=>"Ocurrió un error inesperado",
			 "Texto"=>"No se puede eliminar el item, tiene prestamos asociados",
			 "Tipo"=>"error"
		 ];
		 echo json_encode($alerta);
		 exit();
		  }
		  //ccmprobar privilegios 
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
		  $eliminar_item=itemModelo::eliminar_item_modelo($id);
  
		  if($eliminar_item->rowCount()==1){
			  $alerta=[
				  "Alerta"=>"recargar",
				  "Titulo"=>"Item eliminado",
				  "Texto"=> "Item eliminado",
				  "Tipo"=>"success"
			  ];
  
		  }else{
			  $alerta=[
				  "Alerta"=>"simple",
				  "Titulo"=>"Ocurrio un error ",
				  "Texto"=> "No hemos podido eliminar el item",
				  "Tipo"=>"error"
			  ];
		  }
		  echo json_encode($alerta);
		}

		 /*__controlador  datos item*/
		 public function datos_item_controlador($tipo,$id){
			$tipo=mainModel::limpiar_cadena($tipo);

			$id=mainModel::decryption($id);
			$id=mainModel::limpiar_cadena($id);

			return itemModelo::datos_item_modelo($tipo,$id);
		   }//fin controlador

	           //controlador act iteem//
	public function actualizar_item_controlador(){
		//recuPerar el id
		$id=mainModel::decryption($_POST['item_id_up']);
		$id=mainModel::limpiar_cadena($id);

		//comprobar el item en la DB
	   $check_item=mainModel::ejecutar_consulta_simple("SELECT * FROM item WHERE item_id='$id'");
	   if($check_item->rowCount()<=0){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error",
				"Texto"=> "No hemos encontrado el item",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
	   }else{
		$campos=$check_item->fetch();
	   }
		$codigo=mainModel::limpiar_cadena($_POST['item_codigo_up']);
		$nombre=mainModel::limpiar_cadena($_POST['item_nombre_up']);
		$stock=mainModel::limpiar_cadena($_POST['item_stock_up']);
		$estado=mainModel::limpiar_cadena($_POST['item_estado_up']);
		$detalle=mainModel::limpiar_cadena($_POST['item_detalle_up']);
	   
	/*== comprobar campos vacios ==*/
	if($codigo=="" || $nombre=="" ||$stock=="" || $estado==""){
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
	if(mainModel::verificar_datos("[a-zA-Z0-9-]{1,45}",$codigo)){
		$alerta=[
			"Alerta"=>"simple",
			"Titulo"=>"Ocurrió un error inesperado",
			"Texto"=>"El codigo no coincide con el formato solicitado",
			"Tipo"=>"error"
		];
		echo json_encode($alerta);
		exit();
	}

	if(mainModel::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,140}",$nombre)){
		$alerta=[
			"Alerta"=>"simple",
			"Titulo"=>"Ocurrió un error inesperado",
			"Texto"=>"El Nombre no coincide con el formato solicitado",
			"Tipo"=>"error"
		];
		echo json_encode($alerta);
		exit();
	}

	if(mainModel::verificar_datos("[0-9]{1,9}",$stock)){
		$alerta=[
			"Alerta"=>"simple",
			"Titulo"=>"Ocurrió un error inesperado",
			"Texto"=>"El Stock no coincide con el formato solicitado",
			"Tipo"=>"error"
		];
		echo json_encode($alerta);
		exit();
	}
	if($detalle!=""){
		if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}",$detalle)){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El detalle no coincide con el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

	}
	if($estado!="Habilitado" && $estado!= "Deshabilitado"){
					$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El estado no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			
     	}
        /**Comp codigos*/
		if($codigo!=$campos['item_codigo']){
			$check_codigo=mainModel::ejecutar_consulta_simple("SELECT 
			item_codigo FROM item WHERE item_codigo='$codigo'");
			if($check_codigo->rowCount()>0){
			   $alerta=[
				   "Alerta"=>"simple",
				   "Titulo"=>"Ocurrió un error inesperado",
				   "Texto"=>"El codigo ya existe ",
				   "Tipo"=>"error"
			   ];
			   echo json_encode($alerta);
			   exit();
			}
		}

		 /**Comp cnom*/
		 if($nombre!=$campos['item_nombre']){
			 $check_nombre=mainModel::ejecutar_consulta_simple("SELECT 
			 item_nombre FROM item WHERE item_nombre='$nombre'");
			 if($check_nombre->rowCount()>0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El Nombre del item ya existe ",
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
		$datos_item_up=[
			"Codigo"=>$codigo,
			"Nombre"=>$nombre,
			"Stock"=>$stock,
			"Estado"=>$estado,
			"Detalle"=>$detalle,
			"ID"=>$id
		   ];
		   if(itemModelo::actualizar_item_modelo($datos_item_up)){
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"ACTUALIZADO",
				"Texto"=>"Los datos han sido guardados ",
				"Tipo"=>"success"
			];
			
		   }else{
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se pudo actualizar el item",
				"Tipo"=>"error"
			];
		}
		echo json_encode($alerta);
    }//fin de controlador
}