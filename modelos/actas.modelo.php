<?php

require_once "conexion.php";

class ModeloActas{

	/*=============================================
	VALIDAR ACTA
	=============================================*/

	static public function mdlValidarActa($tabla,$item,$valor,$item2,$valor2,$item3,$valor3){
    
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as valida FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();


    }

	/*=============================================
	MOSTRAR ACTA
	=============================================*/

	static public function mdlMostrarActa($tabla,$item,$valor,$item2,$valor2,$item3,$valor3,$orderBy = false){
    
		if ($orderBy){
			$orderBy = "ORDER BY acta ASC";
		} else {
			$orderBy = '';
		}

		if($item != null){
			
			if($item3 != null){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3 $orderBy");
				$stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);
			}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 $orderBy");
			}
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			
			$stmt -> execute();
			
			if($item == 'matricula'){
				
				return $stmt -> fetchAll();
				
			}
				
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item3 = :$item3");

			$stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}	
		

    }

	/*=============================================
	CARGAR ACTA
	=============================================*/
	static public function mdlCargarActa($tabla,$datos){
    
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa,campania,fechaVacunacion,acta,matricula,cantidadPar,fechaRecepcion,vacunoCar,cantidadCar,vacunoBruce,cantidadBruce,pago,admAf,vacunadorAf,vacunaAf,admCar,vacunadorCar,vacunaCar,redondeoAf,redondeoCar,intercampania) VALUES (:renspa,:campania,:fechaVacunacion,:acta,:matricula,:cantidadPar,:fechaRecepcion,:vacunoCar,:cantidadCar,:vacunoBruce,:cantidadBruce,:pago,:admAf,:vacunadorAf,:vacunaAf,:admCar,:vacunadorCar,:vacunaCar,:redondeoAf,:redondeoCar,:intercampania)");

		$stmt->bindParam(":renspa", $datos["renspa"], PDO::PARAM_STR);
		$stmt->bindParam(":campania", $datos["campania"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaVacunacion", $datos["fechaVacunacion"], PDO::PARAM_STR);
		$stmt->bindParam(":acta", $datos["actaNumero"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula", $datos["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadPar", $datos["cantidadVacunas"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaRecepcion", $datos["fechaRecepcion"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunoCar", $datos["vacunoCarbunclo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadCar", $datos["cantidadCarbunclo"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunoBruce", $datos["vacunoBrucelosis"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadBruce", $datos["cantidadBrucelosis"], PDO::PARAM_STR);
		$stmt->bindParam(":pago", $datos["pago"], PDO::PARAM_STR);
		$stmt->bindParam(":admAf", $datos["admAf"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunadorAf", $datos["vacunadorAf"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunaAf", $datos["vacunaAf"], PDO::PARAM_STR);
		$stmt->bindParam(":admCar", $datos["admCar"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunadorCar", $datos["vacunadorCar"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunaCar", $datos["vacunaCar"], PDO::PARAM_STR);
		$stmt->bindParam(":redondeoAf", $datos["montoRedondeoAf"], PDO::PARAM_STR);
		$stmt->bindParam(":redondeoCar", $datos["montoRedondeoCar"], PDO::PARAM_STR);
		$stmt->bindParam(":intercampania", $datos["interCampania"], PDO::PARAM_STR);

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
	ACTUALIZAR ACTA
	=============================================*/
	static public function mdlActualizarActa($tabla,$datos){
    
		$interValida = 'AND intercampania = 0';
		
		if($datos['interCampania']){
			$interValida = 'AND intercampania = 1';
		}

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
		fechaVacunacion = :fechaVacunacion ,
		acta = :acta ,
		matricula = :matricula ,
		cantidadPar = :cantidadPar ,
		fechaRecepcion = :fechaRecepcion ,
		vacunoCar = :vacunoCar ,
		cantidadCar = :cantidadCar ,
		vacunoBruce = :vacunoBruce ,
		cantidadBruce = :cantidadBruce ,
		pago = :pago ,
		admAf = :admAf ,
		vacunadorAf = :vacunadorAf ,
		vacunaAf = :vacunaAf ,
		admCar = :admCar ,
		vacunadorCar = :vacunadorCar ,
		vacunaCar = :vacunaCar ,
		redondeoAf = :redondeoAf ,
		redondeoCar = :redondeoCar 
		WHERE renspa = :renspa AND campania = :campania $interValida");

		$stmt->bindParam(":renspa", $datos["renspa"], PDO::PARAM_STR);
		$stmt->bindParam(":campania", $datos["campania"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaVacunacion", $datos["fechaVacunacion"], PDO::PARAM_STR);
		$stmt->bindParam(":acta", $datos["actaNumero"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula", $datos["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadPar", $datos["cantidadVacunas"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaRecepcion", $datos["fechaRecepcion"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunoCar", $datos["vacunoCarbunclo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadCar", $datos["cantidadCarbunclo"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunoBruce", $datos["vacunoBrucelosis"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadBruce", $datos["cantidadBrucelosis"], PDO::PARAM_STR);
		$stmt->bindParam(":pago", $datos["pago"], PDO::PARAM_STR);
		$stmt->bindParam(":admAf", $datos["admAf"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunadorAf", $datos["vacunadorAf"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunaAf", $datos["vacunaAf"], PDO::PARAM_STR);
		$stmt->bindParam(":admCar", $datos["admCar"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunadorCar", $datos["vacunadorCar"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunaCar", $datos["vacunaCar"], PDO::PARAM_STR);
		$stmt->bindParam(":redondeoAf", $datos["montoRedondeoAf"], PDO::PARAM_STR);
		$stmt->bindParam(":redondeoCar", $datos["montoRedondeoCar"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			// return $stmt->errorInfo();
			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;


    }

	
	/*=============================================
	MOSTRAR ACTA
	=============================================*/

	static public function mdlContarActa($tabla,$item,$valor,$item2,$valor2,$item3,$valor3){
    
		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidadPar) FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();


	}
	
	/*=============================================
	SUMAR MONTOS
	=============================================*/

	static public function mdlSumarMontos($tabla,$item,$valor){
    
		$stmt = Conexion::conectar()->prepare("SELECT SUM(admAf) AS admAf, SUM(vacunadorAf) AS vacunadorAf, SUM(vacunaAf) AS vacunaAf, SUM(admCar) AS admCar, SUM(vacunadorCar) AS vacunadorCar, SUM(vacunaCar) AS vacunaCar, SUM(redondeoAf) AS redondeoAf, SUM(redondeoCar) AS redondeoCar FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

	}
	
	/*=============================================
	MOSTRAR ACTA Y ANIMALES (INNERJOIN)
	=============================================*/

	static public function mdlMostrarActasAnimales($tabla,$tabla2,$item,$valor,$item2,$valor2){
    
		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN $tabla2 ON $tabla.renspa = $tabla2.renspa WHERE $tabla.$item = :$item AND $tabla.$item2 = :$item2");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			
			$stmt -> execute();
			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM actas INNER JOIN animales ON $tabla.renspa = $tabla2.renspa WHERE $tabla.$item2 = :$item2 AND $tabla2.$item2 = :$item2");

			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			
			$stmt -> execute();

			return $stmt -> fetchAll();
			
		}
	}

	/*=============================================
	SUMAR VACUNADOS (INNERJOIN)
	=============================================*/

	static public function mdlSumarVacunados($tabla,$tabla2,$item,$valor,$item2,$valor2){
    

		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidadPar) as total FROM $tabla INNER JOIN $tabla2 ON $tabla.renspa = $tabla2.renspa WHERE $tabla2.$item = :$item AND $tabla.$item2 = :$item2");
		
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetch();
			
	
	}

	/*=============================================
	ELIMINAR ACTA
	=============================================*/

	static public function mdlEliminarActa($tabla,$item,$valor){
    

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :item");

		$stmt->bindParam(":item", $valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		
		$stmt->close();
		
		$stmt = null;
			
	
	}

}