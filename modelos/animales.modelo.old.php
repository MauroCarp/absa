<?php

error_reporting(E_ERROR | E_PARSE);

require_once "conexion.php";

class ModeloAnimales{

	/*=============================================
	MOSTRAR ANIMALES
	=============================================*/

	static public function mdlMostrarAnimales($tabla,$item,$valor,$item2,$valor2){

      if($item != null){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
  
        $stmt -> execute();
  
        return $stmt -> fetch();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item2 = :$item2");
        
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
  
        $stmt -> execute();
  
        return $stmt -> fetchAll();
      
      }
      

      $stmt -> close();

      $stmt = null;

  }

  /*=============================================
	MOSTRAR ANIMALES SEGUN CAMPO PRODUCTOR
	=============================================*/

	static public function mdlMostrarAnimalesCampo($tabla,$tabla2,$campo,$item,$valor,$item2,$valor2){
    
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN $tabla2 ON $tabla.$campo = $tabla2.$campo WHERE $tabla.$item = :$item AND $tabla2.$item2 = :$item2");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

  }

	/*=============================================
	CARGAR EXISTENCIA
	=============================================*/

	static public function mdlCargarExistencia($tabla,$datos){
    
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa,campania,vacas,vaquillonas,toros,toritos,terneros,terneras,novillos,novillitos) VALUES(:renspa, :campania, :vacas, :vaquillonas,	:toros,	:toritos,	:terneros, :terneras,	:novillos, :novillitos)");

        //$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET renspa = :renspa, campania = :campania, vacas = :vacas, vaquillonas = :vaquillonas, toros = :toros, toritos = :toritos, terneros = :terneros, terneras = :terneras, novillos = :novillos, novillitos = :novillitos WHERE renspa = :renspa AND campania = :campania");

        $stmt -> bindParam(":renspa", $datos['renspa'], PDO::PARAM_STR);
        $stmt -> bindParam(":campania", $datos['campania'], PDO::PARAM_STR);
        $stmt -> bindParam(":vacas", $datos['vacas'], PDO::PARAM_STR);
        $stmt -> bindParam(":vaquillonas", $datos['vaquillonas'], PDO::PARAM_STR);
        $stmt -> bindParam(":toros", $datos['toros'], PDO::PARAM_STR);
        $stmt -> bindParam(":toritos", $datos['toritos'], PDO::PARAM_STR);
        $stmt -> bindParam(":terneros", $datos['terneros'], PDO::PARAM_STR);
        $stmt -> bindParam(":terneras", $datos['terneras'], PDO::PARAM_STR);
        $stmt -> bindParam(":novillos", $datos['novillos'], PDO::PARAM_STR);
        $stmt -> bindParam(":novillitos", $datos['novillitos'], PDO::PARAM_STR);

      	if($stmt->execute()){

          return "ok";
    
        }else{
    
          return $stmt->errorInfo();
          // return "error";
        
        }
        
        $stmt->close();
        $stmt = null;
    
    

    

}
	/*=============================================
	ACTUALIZAR EXISTENCIA
	=============================================*/

	static public function mdlActualizarExistencia($tabla,$datos){
    
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
        	vacas = :vacas,
          vaquillonas = :vaquillonas,	
          toros = :toros,	
          toritos = :toritos,	
          terneros = :terneros,	
          terneras = :terneras,	
          novillos = :novillos,	
          novillitos = :novillitos,	
          caprinos = :caprinos,	
          ovinos = :ovinos,	
          porcinos = :porcinos,	
          equinos = :equinos,	
          bufaloMay = :bufaloMay,	
          bufaloMen = :bufaloMen
         WHERE renspa = :renspa AND campania= :campania");

        $stmt -> bindParam(":renspa", $datos['renspa'], PDO::PARAM_STR);
        $stmt -> bindParam(":campania", $datos['campania'], PDO::PARAM_STR);
        $stmt -> bindParam(":vacas", $datos['vacas'], PDO::PARAM_STR);
        $stmt -> bindParam(":vaquillonas", $datos['vaquillonas'], PDO::PARAM_STR);
        $stmt -> bindParam(":toros", $datos['toros'], PDO::PARAM_STR);
        $stmt -> bindParam(":toritos", $datos['toritos'], PDO::PARAM_STR);
        $stmt -> bindParam(":terneros", $datos['terneros'], PDO::PARAM_STR);
        $stmt -> bindParam(":terneras", $datos['terneras'], PDO::PARAM_STR);
        $stmt -> bindParam(":novillos", $datos['novillos'], PDO::PARAM_STR);
        $stmt -> bindParam(":novillitos", $datos['novillitos'], PDO::PARAM_STR);
        $stmt -> bindParam(":caprinos", $datos['caprinos'], PDO::PARAM_STR);
        $stmt -> bindParam(":ovinos", $datos['ovinos'], PDO::PARAM_STR);
        $stmt -> bindParam(":porcinos", $datos['porcinos'], PDO::PARAM_STR);
        $stmt -> bindParam(":equinos", $datos['equinos'], PDO::PARAM_STR);
        $stmt -> bindParam(":bufaloMay", $datos['bufaloMay'], PDO::PARAM_STR);
        $stmt -> bindParam(":bufaloMen", $datos['bufaloMen'], PDO::PARAM_STR);

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
    SUMAR ANIMALES INNER PRODUCTORES
  =============================================*/

	static public function mdlSumarAnimalesInnerProductor($tabla,$tabla2,$item,$valor,$item2,$valor2,$campo){
    
    $stmt = Conexion::conectar()->prepare("SELECT 
    SUM(vacas) as vacas,
    SUM(vaquillonas) as vaquillonas,
    SUM(toros) as toros,
    SUM(toritos) as toritos,
    SUM(terneros) as terneros,
    SUM(terneras) as terneras,
    SUM(novillos) as novillos,
    SUM(novillitos) as novillitos,
    SUM(vacas + vaquillonas + toros + toritos + terneros + terneras + novillos + novillitos) as totalExistencia, 
    SUM(vaquillonas + toritos + terneros + terneras + novillos + novillitos) as parcialExistencia,
    COUNT(*) as establecimientos FROM $tabla INNER JOIN $tabla2 ON $tabla.$campo = $tabla2.$campo WHERE $tabla2.$item = :$item AND $tabla.$item2 = :$item2");

    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
    $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetch();

    $stmt -> close();

    $stmt = null;

  } 

  /*=============================================
    CONTAR PRODUCTORES SEGUN ANIMALES 
  =============================================*/

	static public function mdlContarProductorSegunAnimales($tabla,$item,$valor,$item2,$valor2){
    
    $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item != :$item AND $item2 = :$item2");

    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
    $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetch();

    $stmt -> close();

    $stmt = null;

  } 


}