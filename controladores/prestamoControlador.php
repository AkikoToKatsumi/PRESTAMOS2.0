    <?php

        if($peticionAjax){
            require_once "../modelos/prestamoModelo.php";
        }else{
            require_once "./modelos/prestamoModelo.php";
        }

        class prestamoControlador extends prestamoModelo{
            //controlador buscar cliente para prestamos
        
            public function buscar_cliente_prestamo_controlador(){
        //rec el texto
        $cliente=mainModel::limpiar_cadena($_POST['buscar_cliente']);

        //comprobar txt
        if($cliente==""){
            return '<div class="alert alert-warning" role="alert">
                    <p class="text-center mb-0">
                        <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                        Introduce, DNI, nombre, apellido, telefono
                    </p>
                    </div>';
                
        }
        // seleccionando clientes de la bd
        $datos_cliente=mainModel::ejecutar_consulta_simple("SELECT * FROM cliente WHERE cliente_dni LIKE '%$cliente%' OR
        cliente_nombre LIKE '%$cliente%' OR cliente_apellido LIKE '%$cliente%' OR cliente_telefono LIKE '%$cliente%' ORDER BY cliente_nombre ASC");


        if($datos_cliente->rowCount()>=1){
            $datos_cliente=$datos_cliente->fetchAll();

            $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';
            $tabla.='</tbody></table></div>';
            foreach($datos_cliente as $rows){
            $tabla.='   <tr class="text-center">
                                        <td>'.$rows['cliente_nombre'].' '.$rows['cliente_apellido'].'
                                        - '.$rows['cliente_dni'].'</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="agregar_cliente('.$rows['cliente_id'].')">
                                            <i class="fas fa-user-plus"></i></button>
                                        </td>
                                    </tr>';
            }
            return $tabla;
        }else{

            return '<div class="alert alert-warning" role="alert">
            <p class="text-center mb-0">
            <i class="fas fa-exclamation-triangle fa-2x"></i><br>
            No hemos encontrado ningun cliente en el sistema que coincida con <strong>"'.$cliente.'"</strong>
            </p>
            </div>';
        }
            }//fin controlador

            // contr para agg clientes al prestamo
            public function agregar_cliente_prestamo_controlador(){
                //rec el id cliente
        $id=mainModel::limpiar_cadena($_POST['id_agregar_cliente']);
        //comprobando el cliente en la DB
        $check_cliente=mainModel::ejecutar_consulta_simple("SELECT * FROM cliente WHERE cliente_id='$id'");

        if($check_cliente->rowCount()<=0){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"No hemos podido encontrar el cliente",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
        }else{
            $campos=$check_cliente->fetch();
            }
            //iniciando la sessionn
            session_start(['name'=>'SPM']);
            if(empty($_SESSION['datos_cliente'])){
                $_SESSION['datos_cliente']=[
                "ID"=>$campos['cliente_id'],
                "DNI"=>$campos['cliente_dni'],
                "Nombre"=>$campos['cliente_nombre'],
                "Apellido"=>$campos['cliente_apellido']

                ];
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Cliente Agregado",
                    "Texto"=>"El cliente se agrego para realizar un presamo o reservacion",
                    "Tipo"=>"success"
                ];
                echo json_encode($alerta);

            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido agregar el cliente al prestamo",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
            }

            }//fin

          // eliminar clientes
            public function eliminar_cliente_prestamo_controlador(){
                //iniciando la secc
                session_start(['name'=>'SPM']);
                
                unset($_SESSION['datos_cliente']);

                if(empty($_SESSION['datos_cliente'])){
                    $alerta=[
                        "Alerta"=>"recargar",
                        "Titulo"=>"Cliente removido",
                        "Texto"=>"Éxito",
                        "Tipo"=>"success"
                    ];
                }else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"No hemos podidoremover el cliente ",
                        "Tipo"=>"error"
                    ];

                } echo json_encode($alerta);

        }//fin controlador

        //controlador buscar item
        public function buscar_item_prestamo_controlador(){
            
            //rec el texto
        $item=mainModel::limpiar_cadena($_POST['buscar_item']);

        //comprobar txt
        if($item==""){
            return '<div class="alert alert-warning" role="alert">
                    <p class="text-center mb-0">
                        <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                        Introduce el codigo o nombre del
                    </p>
                    </div>';
                
        }
        // seleccionando clientes de la bd
        $datos_item=mainModel::ejecutar_consulta_simple("SELECT * FROM item WHERE (item_codigo 
        LIKE '%$item%' OR item_nombre LIKE '%$item%') AND (item_estado='Habilitado') ORDER BY item_nombre ASC");


        if($datos_item->rowCount()>=1){
            $datos_item=$datos_item->fetchAll();

            $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';
            $tabla.='</tbody></table></div>';
            foreach($datos_item as $rows){
            $tabla.='   <tr class="text-center">
                                        <td>'.$rows['item_codigo'].'-'.$rows['item_nombre'].'</td>
                                        <td>
                                            <button type="button" class="btn
                                             btn-primary"
                                             data-dismiss="modal"
                                             onclick="modal_agregar_item('.$rows['item_id'].')" ><i
                                             class="fas 
                                             fa-box-open"></i></button>
                                        </td>
                                    </tr>';
            }
            return $tabla;
        }else{

            return '<div class="alert alert-warning" role="alert">
            <p class="text-center mb-0">
            <i class="fas fa-exclamation-triangle fa-2x"></i><br>
            No hemos encontrado ningun item en el sistema que coincida con <strong>"'.$item.'"</strong>
            </p>
            </div>';
        
        }
    }//fin controlador

    //controlador agg item
    public function agregar_item_prestamo_controlador(){
        //rec el id
        $id=mainModel::limpiar_cadena($_POST['id_agregar_item']);
//comprobando item en la bd
         $check_item=mainModel::ejecutar_consulta_simple("SELECT * FROM item WHERE item_id='$id' AND item_estado='Habilitado'");
         if($check_item->rowCount()<=0){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error",
                "Texto"=>"No hemos podido seleccionar el item, intente nuevamente",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();

         }else{
            $campos=$check_item->fetch();
         }
         //recuperar detalles del prestamo
         $formato=mainModel::limpiar_cadena($_POST['detalle_formato']);
         $cantidad=mainModel::limpiar_cadena($_POST['detalle_cantidad']);
         $tiempo=mainModel::limpiar_cadena($_POST['detalle_tiempo']);
         $costo=mainModel::limpiar_cadena($_POST['detalle_costo_tiempo']);
         
         /*== comprobar campos vacios ==*/
         if($cantidad=="" || $tiempo=="" || $costo==""){
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
			if(mainModel::verificar_datos("[0-9-]{1,7}",$cantidad)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"La cantidad no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[0-9-]{1,7}",$tiempo)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El tiempo no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
            if(mainModel::verificar_datos("[0-9.]{1,15}",$costo)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El costo no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
            if($formato!="Horas" && $formato!="Dias" && $formato!="Evento" && $formato!="Mes"){
                $alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El formato no es valido",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
            }
            session_start(['name'=>'SPM']);

            if(empty($_SESSION['datos_item'][$id])){
                $costo=number_format($costo,2,'.','');
                $_SESSION['datos_item'][$id]=[
                 "ID"=>$campos['item_id'],
                 "Codigo"=>$campos['item_codigo'],
                 "Nombre"=>$campos['item_nombre'],
                 "Detalle"=>$campos['item_detalle'],
                 "Formato"=>$formato,
                 "Cantidad"=>$cantidad,
                 "Tiempo"=>$tiempo,
                 "Costo"=>$costo
                ];
                $alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Item Agregado",
					"Texto"=>"El item se agregó",
					"Tipo"=>"success"
				];
                echo json_encode($alerta);
				exit();

            }else{
                $alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El item que intenta agregar ya se encuentra seleccionado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();

            }
    }//fin controlador
}