<?php

require_once "conexion.php";

class ModeloAftosa{

	/*=============================================
	CARGAR NUEVA CAMPAÑA
	=============================================*/

    static public function mdlCargarCampania($tabla, $item,$valor){
	
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numero)
		VALUES (:numero)");

		$stmt->bindParam(":numero", $valor, PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{
			return $stmt->errorInfo();
			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR CAMPAÑA
	=============================================*/

    static public function mdlEditarDatosCampania($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla
		SET 
		inicio = :fechaInicio,
		final = :fechaCierre,
		admA = :precioAdmAftosa,
		vacunaA = :precioVacunaAftosa,
		vacunadorA = :precioVacunaAftosa,
		admC = :precioAdmCarb,
		vacunadorC = :precioVacunaCarb,
		vacunaC = :precioVacunaCarb
		WHERE numero = :numero");

		$stmt->bindParam(":numero", $datos['numero'], PDO::PARAM_STR);
		$stmt->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaCierre", $datos["fechaCierre"], PDO::PARAM_STR);
		$stmt->bindParam(":precioAdmAftosa", $datos["precioAdmAftosa"], PDO::PARAM_STR);
		$stmt->bindParam(":precioVacunaAftosa", $datos["precioVacunaAftosa"], PDO::PARAM_STR);
		$stmt->bindParam(":precioVeterinarioAftosa", $datos["precioVeterinarioAftosa"], PDO::PARAM_STR);
		$stmt->bindParam(":precioAdmCarb", $datos["precioAdmCarb"], PDO::PARAM_STR);
		$stmt->bindParam(":precioVacunaCarb", $datos["precioVacunaCarb"], PDO::PARAM_STR);
		$stmt->bindParam(":precioVeterinarioCarb", $datos["precioVeterinarioCarb"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{
			// return $stmt->errorInfo();
			// 
			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR SEGUN ESTADO/RANGO
	=============================================*/

    static public function mdlMostrarDatosCampania($tabla, $item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY numero DESC");

			$stmt -> execute();

            return $stmt -> fetchAll();

		}
	}

	/*=============================================
	MOSTRAR DATOS
	=============================================*/

	static public function mdlMostrarDatos($tabla,$item,$valor,$orden){
    
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY $orden DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

			$stmt -> execute();
			
            return $stmt -> fetchAll();

		}
        

    }
	

	/*=============================================
	SUMAR DATOS
	=============================================*/

	static public function mdlSumarDatos($tabla,$campo,$item,$valor,$item2,$valor2){
    
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as total FROM $tabla WHERE $item = :$item");
			
			
			if($item2 != null){
				
				$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as total FROM $tabla WHERE $item = :$item AND $item2 = :$item2");
				
				$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
				
			}
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as total FROM $tabla");

			$stmt -> execute();
			
            return $stmt -> fetchAll();

		}
        

    }
	
	/*=============================================
	MOSTRAR MARCAS
	=============================================*/

	static public function mdlMostrarMarcas($tabla,$item){
    
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($item) FROM $tabla");

			$stmt -> execute();

            return $stmt -> fetchAll();

    }

	/*=============================================
	ELIMINAR DATOS
	=============================================*/

	static public function mdlEliminarDato($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM  $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{
			print_r($stmt->errorInfo());
			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;


    }
	/*=============================================
	CARGAR RECEPCION
	=============================================*/

	static public function mdlCargarRecepcion($tabla,$datos){
    
	
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(campania,marca,uel,fechaEntrega,fechaVencimiento,serie,cantidad)
		VALUES (:campania, :marca, :uel, :fechaEntrega, :fechaVencimiento, :serie, :cantidad)");

		$stmt->bindParam(":campania", $datos["campania"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":uel", $datos["uel"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaEntrega", $datos["fechaIng"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaVencimiento", $datos["fechaVenc"], PDO::PARAM_STR);
		$stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{
			print_r($stmt->errorInfo());
			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;

    }

	static public function mdlMostrarDistribucion($tabla,$item,$valor,$item2,$valor2){
    
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 ORDER BY fechaEntrega	DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			
			$stmt -> execute();
			
			return $stmt -> fetchAll();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2 = :$item2");
			
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			
			$stmt -> execute();

            return $stmt -> fetchAll();

		}
		
		$stmt->close();
		$stmt = null;

    }

   
	/*=============================================
	CARGAR DISTRIBUCION
	=============================================*/

	static public function mdlCargarDistribucion($tabla,$datos){
    
	
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(campania,marca,uel,fechaEntrega,matricula,cantidad)
		VALUES (:campania, :marca, :uel, :fechaEntrega, :matricula, :cantidad)");

		$stmt->bindParam(":campania", $datos["campania"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":uel", $datos["uel"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula", $datos["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaEntrega", $datos["fechaEntrega"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{
			print_r($stmt->errorInfo());
			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;

    }

}