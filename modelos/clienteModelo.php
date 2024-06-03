<?php
	
	require_once "mainModel.php";

	class clienteModelo extends mainModel{
        		/*--------- Modelo agregar cliente ---------*/
		protected static function agregar_cliente_modelo($datos){
            $sql=mainModel::conectar()->prepare("INSERT INTO cliente(cliente_dni,
            cliente_nombre, cliente_apellido,cliente_telefono,cliente_direcion) 
            VALUES(:DNI,:Nombre,:Apellido,:Telefono,:Direccion)");
             
             $sql->bindParam(":DNI",$datos['DNI']);
             $sql->bindParam(":DNI",$datos['Nombre']);
             $sql->bindParam(":DNI",$datos['Apellido']);
             $sql->bindParam(":DNI",$datos['Telefono']);
             $sql->bindParam(":DNI",$datos['Direccion']);
            $sql->execute();
            return $sql;
              
        }


        }
