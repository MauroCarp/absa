<?php

require_once "conexion.php";

class ModeloVeterinarios{

	/*=============================================
	CREAR VETERINARIO
	=============================================*/

	static public function mdlIngresarVeterinario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(matricula,nombre,domicilio,telefono,email,cuit,tipo)
		VALUES (:matricula,:nombre,:domicilio,:telefono,:email,:cuit,:tipo)");

		$stmt->bindParam(":matricula", $datos["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["mail"], PDO::PARAM_STR);
		$stmt->bindParam(":cuit", $datos["cuit"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

		// $stmt->execute();
		
		// var_dump($datos);

		// return $stmt;
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR VETERINARIOS
	=============================================*/

	static public function mdlMostrarVeterinarios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY nombre ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR VETERINARIO
	=============================================*/

	static public function mdlEditarVeterinario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		nombre = :nombre,
		matricula = :matricula,
		domicilio = :domicilio,
		telefono = :telefono,
		email = :email,
		cuit = :cuit,
		tipo = :tipo
		WHERE vacunador_id = :id");

		$stmt->bindParam(":matricula", $datos["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["mail"], PDO::PARAM_STR);
		$stmt->bindParam(":cuit", $datos["cuit"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VETERINARIO
	=============================================*/

	static public function mdlEliminarVeterinario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE vacunador_id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	
			
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR VETERINARIO
	=============================================*/

	static public function mdlActualizarVeterinario($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


}