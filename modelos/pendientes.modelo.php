<?php

require_once "conexion.php";

class ModeloPendientes{

	/*=============================================
	MOSTRAR PENDIENTES BRUTUR 
	=============================================*/

	static public function mdlMostrarPendientes($tabla,$item,$valor){
	
		$stmt = Conexion::conectar()->prepare("SELECT $tabla.renspa, $tabla.fechaEstado,$tabla.protocolo,$tabla.estado,$tabla.fechaCarga, productores.establecimiento,$tabla.estadoSenasa FROM $tabla INNER JOIN productores ON $tabla.renspa = productores.renspa WHERE $item = :item");


		$stmt->bindParam(":item", $valor, PDO::PARAM_STR);

		$stmt->execute();

		// return $stmt->errorInfo();
		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;


	}

	/*=============================================
	ENVIAR PENDIENTES BRUTUR 
	=============================================*/

	static public function mdlEnviarPendientes($tabla,$item,$valor,$valor2){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :estadoSenasaUpdate, fechaEnviado = :fechaEnviado WHERE $item = :$item");
		
		$today = date('Y-m-d');

		$stmt->bindParam(":estadoSenasaUpdate", $valor2, PDO::PARAM_STR);
		$stmt->bindParam(":fechaEnviado", $today, PDO::PARAM_STR);
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt->execute()){
				
			return 'ok';
			
		}else{
			print_r($stmt->errorInfo());
			return 'error';

		};
		
		$stmt = null;

	}

}