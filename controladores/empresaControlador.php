<?php

	if($peticionAjax){
		require_once "../modelos/empresaModelo.php";
	}else{
		require_once "./modelos/empresaModelo.php";
	}

	class empresaControlador extends empresaModelo{

        /*controlador datos empresa*/
        public function datos_empresa_controlador(){
          return empresaModelo:: datos_empresa_modelo();
        }//fin de controlador

         /*controlador agg empresa*/
    public function agregar_empresa_controlador(){
      $nombre=mainModel::limpiar_cadena($_POST['empresa_nombre_reg']);
      $email=mainModel::limpiar_cadena($_POST['empresa_email_reg']);
      $telefono=mainModel::limpiar_cadena($_POST['empresa_telefono_reg'
    ]);
    $direccion=mainModel::limpiar_cadena($_POST['empresa_direccion_reg']);

    	/*== comprobar campos vacios ==*/
	if($nombre=="" || $email=="" ||$telefono=="" || $direccion==""){
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
			if(mainModel::verificar_datos("[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{1,70}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El Nombre no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[0-9()+]{8,20}",$telefono)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El telefono no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}",$direccion)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"La direccion no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"Ha ingresado un email no valido",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
         }
         /**Comp Empresas registradas  */
         $check_empresas=mainModel::ejecutar_consulta_simple("SELECT 
         empresa_id FROM empresa");
         if($check_empresas->rowCount()>=1){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"Ya hay una empresa registrada",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
         }

         $datos_empresa_reg=[
         "Nombre"=>$nombre,
         "Email"=>$email,
         "Telefono"=>$telefono,
         "Direccion"=>$direccion
         ];

         $agregar_empresa=empresaModelo::agregar_empresa_modelo(
            $datos_empresa_reg);
            if($agregar_empresa->rowCount()==1){
                    $alerta=[
                        "Alerta"=>"recargar",
                        "Titulo"=>"Empresa Registrada",
                        "Texto"=>"Los datos de la empresa se guardaron correctamente",
                        "Tipo"=>"success"
                    ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido registrar la empresa, intente otra vez",
                    "Tipo"=>"error"
                ];

            }
            echo json_encode($alerta);
    }//fin controlador

    /*controlador act empresa*/
    public function actualizar_empresa_controlador(){
    $id=mainModel::limpiar_cadena($_POST['empresa_id_up']);
    $nombre=mainModel::limpiar_cadena($_POST['empresa_nombre_up']);
    $email=mainModel::limpiar_cadena($_POST['empresa_email_up']);
    $telefono=mainModel::limpiar_cadena($_POST['empresa_telefono_up'
            ]);
    $direccion=mainModel::limpiar_cadena($_POST['empresa_direccion_up']);

    /*== comprobar campos vacios ==*/
	if($nombre=="" || $email=="" ||$telefono=="" || $direccion==""){
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
			if(mainModel::verificar_datos("[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{1,70}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El Nombre no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[0-9()+]{8,20}",$telefono)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El telefono no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}",$direccion)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"La direccion no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"Ha ingresado un email no valido",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
         }
         /*COMPROBANDO PRIVILEGIOS / */
         session_start(['name'=>'SPM']);
         if($_SESSION['privilegio_spm']<1 || $_SESSION['privilegio_spm']
         >2){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"No tienes permisos suficientes",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
         }
         $datos_empresa_up=[
            "ID"=>$id,
            "Nombre"=>$nombre,
            "Email"=>$email,
            "Telefono"=>$telefono,
            "Direccion"=>$direccion
            ];
            if(empresaModelo::actualizar_empresa_modelo($datos_empresa_up)){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Empresa Actualizada",
                    "Texto"=>"Actualizada con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido actualizar los datos",
                    "Tipo"=>"error"
                ];
            }
        echo json_encode($alerta);
        }//fin controlador

}