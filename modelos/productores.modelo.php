<?php

require_once "conexion.php";

class ModeloProductores{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlIngresarProductor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa,propietario,establecimiento,explotacion,regimen,tipoDoc,numDoc,iva,telefono,email,domicilio,localidad,provincia,departamento,distrito,veterinario)
		VALUES (:renspa, :propietario, :establecimiento, :explotacion, :regimen, :tipoDoc, :numDoc, :iva, :telefono, :mail, :domicilio, :localidad, :provincia, :departamento, :distrito,:veterinario)");

		$departamento = 8;
		$stmt->bindParam(":renspa", $datos["renspa"], PDO::PARAM_STR);
		$stmt->bindParam(":propietario", $datos["propietario"], PDO::PARAM_STR);
		$stmt->bindParam(":establecimiento", $datos["establecimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":explotacion", $datos["explotacion"], PDO::PARAM_STR);
		$stmt->bindParam(":regimen", $datos["regimen"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoDoc", $datos["tipoDoc"], PDO::PARAM_STR);
		$stmt->bindParam(":numDoc", $datos["numDoc"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":mail", $datos["mail"], PDO::PARAM_STR);
		$stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
		$stmt->bindParam(":localidad", $datos["localidad"], PDO::PARAM_STR);
		$stmt->bindParam(":provincia", $datos["provincia"], PDO::PARAM_STR);
		$stmt->bindParam(":departamento", $departamento, PDO::PARAM_INT);
		$stmt->bindParam(":distrito", $datos["distrito"], PDO::PARAM_INT);
		$stmt->bindParam(":veterinario", $datos["veterinario"], PDO::PARAM_STR);

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
	MOSTRAR PRDUCTORES
	=============================================*/

	static public function mdlMostrarProductores($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			if($item == 'distrito' OR $item == 'explotacion' OR $item == 'veterinario' )
				return $stmt -> fetchAll();

			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRDUCTORES DISTINCT
	=============================================*/

	static public function mdlMostrarProductoresDistinct($tabla, $item, $valor,$distinct){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($distinct) FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();
			// var_dump($stmt->errorInfo());
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($distinct) FROM $tabla");
			
			$stmt -> execute();
			
			// return $stmt->errorInfo();
			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTOR
	=============================================*/

	static public function mdlEditarProductor($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		renspa = :renspa,
		propietario = :propietario,
		establecimiento = :establecimiento,
		explotacion = :explotacion,
		regimen = :regimen,
		tipoDoc = :tipoDoc,
		numDoc = :numDoc,
		iva = :iva,
		telefono = :telefono,
		email = :email,
		domicilio = :domicilio,
		localidad = :localidad,
		provincia = :provincia,
		distrito = :distrito,
		veterinario = :veterinario
		WHERE productor_id = :id");



		$stmt->bindParam(":renspa", $datos["renspa"], PDO::PARAM_STR);
		$stmt->bindParam(":propietario", $datos["propietario"], PDO::PARAM_STR);
		$stmt->bindParam(":establecimiento", $datos["establecimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":explotacion", $datos["explotacion"], PDO::PARAM_STR);
		$stmt->bindParam(":regimen", $datos["regimen"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoDoc", $datos["tipoDoc"], PDO::PARAM_STR);
		$stmt->bindParam(":numDoc", $datos["numDoc"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["mail"], PDO::PARAM_STR);
		$stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
		$stmt->bindParam(":localidad", $datos["localidad"], PDO::PARAM_STR);
		$stmt->bindParam(":provincia", $datos["provincia"], PDO::PARAM_STR);
		$stmt->bindParam(":distrito", $datos["distrito"], PDO::PARAM_INT);
		$stmt->bindParam(":veterinario", $datos["veterinario"], PDO::PARAM_STR);
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
	EDITAR PARAMETRO
	=============================================*/

	static public function mdlEditarParametro($tabla, $item,$valor,$item2,$valor2){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		$item = :$item
		WHERE $item2 = :$item2");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);	

		if($stmt->execute()){

			return 'ok';

		}else{

			return 'error';
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR PRODUCTOR
	=============================================*/

	static public function mdlEliminarProductor($tabla,$datos){

		if(is_array($datos)){
			
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE renspa = :renspa");
			
			$stmt -> bindParam(":renspa", $datos['renspa'], PDO::PARAM_INT);
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE productor_id = :id");
			
			$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
		
		}

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarProductor($tabla, $item1, $valor1, $valor){

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

	/*=============================================
	PRDUCTORES SEGUN STATUS
	=============================================*/

	static public function mdlStatusEstablecimientos($tabla, $tabla2,$tabla3,$item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla.establecimiento, $tabla2.estado as estadoBrucelosis,$tabla3.estado as estadoTuberculosis FROM $tabla INNER JOIN $tabla2 ON $tabla.renspa = $tabla2.renspa INNER JOIN $tabla3 ON $tabla.renspa = $tabla3.renspa WHERE $tabla.$item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

		/*=============================================
	SITUACION PRODUCTOR
	=============================================*/
	static public function mdlSituacionProductor($tablas, $item, $valor, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablas[0] INNER JOIN $tablas[1] ON $tablas[0].$item = $tablas[1].$item WHERE $tablas[0].$item = :$item AND $tablas[1].$item2 = :$item2");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	SITUACION PRODUCTOR
	=============================================*/
	static public function mdlMostrarEstNoVac($tablas, $item, $valor,$orden){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablas[0] WHERE renspa NOT IN (SELECT renspa FROM $tablas[1] WHERE $item = :$item) ORDER BY $orden ASC");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	TABGEO
	=============================================*/
	static public function ctrMostrarLocation($tabla,$item, $valor,$item2,$valor2){

		$stmt = Conexion::conectar()->prepare("SELECT nombre,nombreDpto FROM $tabla WHERE $item = :$item");
		
		if($item2 != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT nombre,nombreDpto FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			
		}
		
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}