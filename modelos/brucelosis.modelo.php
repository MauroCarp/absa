<?php

require_once "conexion.php";

class ModeloBrucelosis{

    /*=============================================
	CREAR REGISTRO
	=============================================*/

    static public function mdlIngresarRegistro($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa) VALUES (:renspa)");

		$stmt->bindParam(":renspa", $datos["renspa"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{
			var_dump($stmt->errorInfo());
			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR SEGUN ESTADO/RANGO
	=============================================*/

    static public function mdlMostrarSD($tabla, $item,$valor,$desde,$hasta){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla.renspa, productores.propietario, $tabla.fechaSD FROM $tabla INNER JOIN productores ON $tabla.renspa = productores.renspa WHERE $tabla.$item = :$item AND $tabla.fechaSD BETWEEN '$desde' AND '$hasta'");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CONTAR SEGUN ESTADO/RANGO
	=============================================*/

    static public function mdlContarRegistros($tabla, $item,$valor,$valor2,$item2,$desde,$hasta){

		if($valor2 == null){

			$stmt = Conexion::conectar()->prepare("SELECT COUNT($item2) as total FROM $tabla WHERE $item = :$item AND $item2 BETWEEN '$desde' AND '$hasta'");
			
			if($valor == 'S/D'){
				
				$stmt = Conexion::conectar()->prepare("SELECT COUNT($item2) as total FROM $tabla WHERE $item = :$item");
			
			}
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);


		
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT($item2) as total FROM $tabla WHERE ($item = :$item OR $item = '$valor2') AND $item2 BETWEEN '$desde' AND '$hasta'");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);			

		}

		// var_dump($stmt);
		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CONTAR SEGUN + - S
	=============================================*/

    static public function mdlContarSumarRegistrosPosNegSos($tabla, $item,$valor,$item2,$desde,$hasta,$operacion){


		$stmt = Conexion::conectar()->prepare("SELECT COUNT($item) as total FROM $tabla WHERE $item != :$item AND fechaEstado BETWEEN '$desde' AND '$hasta'");
		
		if($operacion == 'sumar')
			$stmt = Conexion::conectar()->prepare("SELECT SUM($item) as total FROM $tabla WHERE $item != :$item AND fechaEstado BETWEEN '$desde' AND '$hasta'");
			
			// return $stmt;

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		// var_dump($stmt);
		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	SUMAR REGISTROS
	=============================================*/

    static public function mdlSumarRegistros($tabla, $item,$valor,$valor2,$item2,$desde,$hasta){

		
		$stmt = Conexion::conectar()->prepare("SELECT SUM(vacas + vaquillonas + toros) as total FROM $tabla WHERE $item = :$item AND $item2 BETWEEN '$desde' AND '$hasta'");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		
		
		if($valor2 != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM(vacas + vaquillonas + toros) as total FROM $tabla WHERE ($item = :$item OR $item = '$valor2') AND $item2 BETWEEN '$desde' AND '$hasta'");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		}
		// var_dump($stmt);
		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRDUCTORES
	=============================================*/

	static public function mdlMostrarRegistros($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN productores ON $tabla.renspa = productores.renspa WHERE $tabla.$item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			// var_dump($stmt);
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN productores ON $tabla.renspa = productores.renspa");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	/*=============================================
	MOSTRAR HISTORIAL
	=============================================*/

	static public function mdlMostrarHistorial($tabla, $item, $valor,$item2,$valor2){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 ORDER BY fechaEstado DESC");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		// var_dump($valor,$valor2);
		
		$stmt -> execute();


		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


}