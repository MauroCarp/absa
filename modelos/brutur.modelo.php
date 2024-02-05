<?php

require_once "conexion.php";

class ModeloBruTur{

	/*=============================================
	VER REGISTROS LIBRES/RECERTIFICACION VENCIDOS
	=============================================*/

	static public function mdlEsVencido($tabla1,$tabla2,$today){
		
		$whereClause = ($tabla1 == 'brucelosis') ? $tabla1.".estado = 'DOES Total' OR ".$tabla1.".estado = 'MuVe' OR ".$tabla1.".estado = 'Libre' OR ".$tabla1.".estado = 'RecertificaciÃ³n'" : $tabla1.".estado = 'Libre' OR ".$tabla1.".estado = 'RecertificaciÃ³n'";

		$stmt = Conexion::conectar()->prepare("SELECT 
		$tabla1.renspa, 
		$tabla2.establecimiento, 
		$tabla2.propietario,
		$tabla2.explotacion,
		$tabla2.veterinario,
		$tabla1.estado,
		DATE_ADD($tabla1.fechaEstado, INTERVAL 365 DAY) as fechaVencido
		FROM $tabla1 
		INNER JOIN $tabla2 
		ON $tabla1.renspa = $tabla2.renspa 
		WHERE 
		DATE_ADD($tabla1.fechaEstado, INTERVAL 365 DAY) < '$today' 
		AND notificado = 0 AND ($whereClause)
		ORDER BY $tabla1.fechaEstado ASC");

		// return $stmt;
		
		$stmt->execute();
		

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

    static public function mdlPorVencer($tabla1,$tabla2,$today){
		
		$whereClause = ($tabla1 == 'brucelosis') ? $tabla1.".estado = 'DOES Total' OR ".$tabla1.".estado = 'MuVe' OR ".$tabla1.".estado = 'Libre' OR ".$tabla1.".estado = 'RecertificaciÃ³n'" : $tabla1.".estado = 'Libre' OR ".$tabla1.".estado = 'RecertificaciÃ³n'";

		$stmt = Conexion::conectar()->prepare("SELECT 
		$tabla1.renspa, 
		$tabla2.establecimiento, 
		$tabla2.propietario,
		$tabla2.explotacion,
		$tabla2.veterinario,
		$tabla1.estado,
		$tabla1.fechaEstado, 
		DATE_ADD($tabla1.fechaEstado, INTERVAL 365 DAY) as fechaVencido
		FROM $tabla1 
		INNER JOIN $tabla2 
		ON $tabla1.renspa = $tabla2.renspa 
		WHERE '$today' <  DATE_ADD($tabla1.fechaEstado, INTERVAL 365 DAY)AND '$today' > DATE_ADD($tabla1.fechaEstado, INTERVAL 11 MONTH) 
		AND notificado = 0 AND ($whereClause)
		ORDER BY $tabla1.fechaEstado ASC");


		$stmt->execute();
		
		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlNotificar($tabla,$renspa){
		
		$today = date('Y-m-d');

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET notificado = 1, fechaNotificado = :fechaNotificado WHERE renspa = :renspa");

		$stmt->bindParam(":fechaNotificado", $today, PDO::PARAM_STR);
		$stmt->bindParam(":renspa", $renspa, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;



	}

	static public function mdlEliminarRegistro($tabla,$item,$valor){

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

	static public function mdlMostrarBruTur($tabla,$tabla2,$item,$valor){
	
		$stmt = Conexion::conectar()->prepare("SELECT 
		$tabla.renspa as renspa,
		$tabla.protocolo as protocoloBruce, $tabla2.protocolo as protocoloTuber, 
		$tabla.estado as estadoBruce, $tabla2.estado as estadoTuber,
		-- $tabla.fechaRecepcion as fechaRecepcionBruce, $tabla2.fechaRecepcion as fechaRecepcionTuber, 
		$tabla.fechaEstado as fechaEstadoBruce, $tabla2.fechaEstado as fechaEstadoTuber, 
		$tabla.numeroCert as numeroCertBruce, $tabla2.numeroCert as numeroCertTuber,
		$tabla.vacas as vacasBruce, $tabla2.vacas as vacasTuber, 
		$tabla.vaquillonas as vaquillonasBruce, $tabla2.vaquillonas as vaquillonasTuber, 
		$tabla.toros as torosBruce, $tabla2.toros as torosTuber,
		$tabla2.terneros as ternerosTuber,
		$tabla2.terneras as ternerasTuber, 
		$tabla2.novillos as novillosTuber, 
		$tabla2.novillitos as novillitosTuber, 
		$tabla.saneamientoNumero as saneamientoNumeroBruce,
		$tabla2.saneamientoNumero as saneamientoNumeroTuber,
		$tabla.positivo as positivoBruce, $tabla2.positivo as positivoTuber, 
		$tabla.negativo as negativoBruce, $tabla2.negativo as negativoTuber, 
		$tabla.sospechoso as sospechosoBruce, $tabla2.sospechoso as sospechosoTuber

		FROM $tabla INNER JOIN $tabla2 ON $tabla.renspa = $tabla2.renspa WHERE $tabla.$item = :item");


		$stmt->bindParam(":item", $valor, PDO::PARAM_STR);

		$stmt->execute();

		// return $stmt->errorInfo();
		return $stmt->fetch();

		$stmt->close();

		$stmt = null;


	}

	static public function mdlIngresarRegistroHistorial($tabla,$datos){
	
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa,campania,protocolo,estado,fechaEstado,fechaCarga,saneamientoNumero,positivo,negativo,sospechoso) VALUES(:renspa,:campania,:protocolo,:estado,:fechaEstado,:fechaCarga,:saneamientoNumero,:positivo,:negativo,:sospechoso)");

		if($datos['estado'] != 'Libre' OR $datos['estado'] != 'Recertificacion'){

			$stmt->bindParam(":saneamientoNumero", $datos['saneamientoNum'], PDO::PARAM_STR);
			$stmt->bindParam(":positivo", $datos['positivo'], PDO::PARAM_STR);
			$stmt->bindParam(":negativo", $datos['negativo'], PDO::PARAM_STR);
			$stmt->bindParam(":sospechoso", $datos['sospechoso'], PDO::PARAM_STR);

		}else{
			$cero = 0;
			$stmt->bindParam(":saneamientoNumero", $cero, PDO::PARAM_STR);
			$stmt->bindParam(":positivo", $cero, PDO::PARAM_STR);
			$stmt->bindParam(":negativo", $cero, PDO::PARAM_STR);
			$stmt->bindParam(":sospechoso", $cero, PDO::PARAM_STR);
			
		}
		
		$hoy = date('Y-m-d');
		$stmt->bindParam(":renspa", $datos['renspa'], PDO::PARAM_STR);
		$stmt->bindParam(":campania", $datos['campania'], PDO::PARAM_STR);
		$stmt->bindParam(":protocolo", $datos['protocolo'], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
		$stmt->bindParam(":fechaEstado", $datos['fechaEstado'], PDO::PARAM_STR);
		$stmt->bindParam(":fechaCarga", $hoy, PDO::PARAM_STR);

		if($stmt->execute()){
			
			return 'ok';
			
		}else{
			var_dump($stmt->errorInfo());
			return 'error';

		};
		
		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR STATUS BRUTUR
	=============================================*/
    static public function mdlActualizarBruTur($tabla,$item,$datos){
		$queryFechaCarga = (isset($datos['fechaCarga'])) ? ',fechaCarga = :fechaCarga' : '';
		$saneamiento = ',saneamientoNumero = :saneamientoNumero,positivo = :positivo,negativo = :negativo,sospechoso = :sospechoso';

		if($tabla == 'tuberculosis'){

						
			if($datos['estado'] ==  'Libre' OR $datos['estado'] ==  'RecertificaciÃ³n' OR $datos['estado'] ==  'Recertificacion' OR $datos['estado'] ==  'No Libre'){

				$saneamiento = '';
				
			}	

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
			protocolo = :protocolo,
			notificado = 0,
			vacas = :vacas,
			vaquillonas = :vaquillonas,
			terneros = :terneros,
			terneras = :terneras,
			novillos = :novillos,
			novillitos = :novillitos,
			toros = :toros,
			fechaEstado = :fechaEstado $queryFechaCarga $saneamiento	
			WHERE $item = :item");

			$stmt->bindParam(":terneros", $datos['terneros'], PDO::PARAM_STR);
			$stmt->bindParam(":terneras", $datos['terneras'], PDO::PARAM_STR);
			$stmt->bindParam(":novillos", $datos['novillos'], PDO::PARAM_STR);
			$stmt->bindParam(":novillitos", $datos['novillitos'], PDO::PARAM_STR);


		}else{

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
			protocolo = :protocolo,
			notificado = 0,
			vacas = :vacas,
			vaquillonas = :vaquillonas,
			toros = :toros,
			fechaEstado = :fechaEstado $queryFechaCarga $saneamiento	
			WHERE $item = :item");
		
		}

		if(isset($datos['fechaCarga'])){

			$stmt->bindParam(":fechaCarga", $datos['fechaCarga'], PDO::PARAM_STR);
		
		}
		
		$stmt->bindParam(":protocolo", $datos['protocolo'], PDO::PARAM_STR);
		$stmt->bindParam(":vacas", $datos['vacas'], PDO::PARAM_STR);
		$stmt->bindParam(":vaquillonas", $datos['vaquillonas'], PDO::PARAM_STR);
		$stmt->bindParam(":toros", $datos['toros'], PDO::PARAM_STR);
		$stmt->bindParam(":fechaEstado", $datos['fechaEstado'], PDO::PARAM_STR);
		$stmt->bindParam(":item", $datos['renspa'], PDO::PARAM_STR);
		
		if($datos['estado'] !=  'Libre' AND $datos['estado'] !=  'RecertificaciÃ³n' AND $datos['estado'] !=  'Recertificacion' AND $datos['estado'] !=  'No Libre'){

			$stmt->bindParam(":saneamientoNumero", $datos['saneamientoNum'], PDO::PARAM_STR);
			$stmt->bindParam(":positivo", $datos['positivo'], PDO::PARAM_STR);
			$stmt->bindParam(":negativo", $datos['negativo'], PDO::PARAM_STR);
			$stmt->bindParam(":sospechoso", $datos['sospechoso'], PDO::PARAM_STR);

		}

		if($stmt->execute()){
			
			return 'ok';
			
		}else{

			return 'error';

		};

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR ESTADO BRUTUR
	=============================================*/

	static public function mdlActualizarEstadoBruTur($tabla,$item,$datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		estado = :estado,
		estadoSenasa = :estadoSenasa
		WHERE $item = :$item");

		
		$stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
		$stmt->bindParam(":estadoSenasa", $datos['estadoSenasa'], PDO::PARAM_STR);
		$stmt->bindParam(":".$item, $datos['renspa'], PDO::PARAM_STR);

		if($stmt->execute()){
			
			return 'ok';
			
		}else{
			var_dump($stmt->errorInfo());
			return 'error';

		};

		$stmt = null;

	}

	/*=============================================
	APROBAR ESTADO BRUTUR
	=============================================*/

	static public function mdlAprobarEstado($tabla,$item,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		estadoSenasa = 'Aprobado',
		numeroCert = :numeroCert
		WHERE $item = :$item");

		$stmt->bindParam(":numeroCert", $datos['certificado'], PDO::PARAM_STR);
		$stmt->bindParam(":".$item, $datos['renspa'], PDO::PARAM_STR);

		if($stmt->execute()){
				
			return 'ok';
			
		}else{
			print_r($stmt->errorInfo());
			return 'error';

		};

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PENDIENTES BRUTUR 
	=============================================*/

	static public function mdlMostrarPendientes($tabla,$item,$valor){
	
		$stmt = Conexion::conectar()->prepare("SELECT $tabla.renspa, $tabla.fechaEstado,$tabla.protocolo,$tabla.estado,$tabla.fechaCarga, productores.establecimiento,$tabla.estadoSenasa, $tabla.positivo FROM $tabla INNER JOIN productores ON $tabla.renspa = productores.renspa WHERE $item = :item AND $tabla.estado != 'S/D' AND $tabla.estado != 'En Saneamiento' AND $tabla.estado != 'Saneado'");


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