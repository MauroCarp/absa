<?php

class ControladorBrucelosis{
    
    /*=============================================
	MOSTRAR REGISTROS SEGUN ESTADO / RANGO
	=============================================*/

	static public function ctrMostrarSD($item,$valor,$rango){
    
        $tabla = "brucelosis";

        $rango = explode('/',$rango);

        $desde = $rango[0];
        
        $hasta = $rango[1];
		
        $respuesta = ModeloBrucelosis::mdlMostrarSD($tabla, $item, $valor,$desde,$hasta);

		return $respuesta;
    
    }

    /*=============================================
	CONTAR REGISTROS SEGUN ESTADO / RANGO
	=============================================*/

	static public function ctrContarRegistros($item,$valor,$valor2,$item2,$rango){
    
        $tabla = "brucelosis";

        $rango = explode('/',$rango);

        $desde = $rango[0];
        
        $hasta = $rango[1];
		
        $respuesta = ModeloBrucelosis::mdlContarRegistros($tabla, $item, $valor,$valor2,$item2,$desde,$hasta);

		return $respuesta;
    
    }

    /*=============================================
	CONTAR/SUMAR REGISTROS SEGUN + - S
    =============================================*/

	static public function ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,$operacion){
    
        $tabla = "brucelosis";

        $rango = explode('/',$rango);

        $desde = $rango[0];
        
        $hasta = $rango[1];
		
        $respuesta = ModeloBrucelosis::mdlContarSumarRegistrosPosNegSos($tabla, $item, $valor,$item2,$desde,$hasta,$operacion);

		return $respuesta;
    
    }

    /*=============================================
	SUMAR REGISTROS 
    =============================================*/

	static public function ctrSumarRegistros($item,$valor,$valor2,$item2,$rango){
    
        $tabla = "brucelosis";

        $rango = explode('/',$rango);

        $desde = $rango[0];
        
        $hasta = $rango[1];
		
        $respuesta = ModeloBrucelosis::mdlSumarRegistros($tabla, $item, $valor,$valor2,$item2,$desde,$hasta);

		return $respuesta;
    
    }

    
    /*=============================================
	MOSTAR REGISTROS 
    =============================================*/
	static public function ctrMostrarRegistros($item, $valor){

		$tabla = "brucelosis";

		$respuesta = ModeloBrucelosis::mdlMostrarRegistros($tabla, $item, $valor);

		return $respuesta;

	}

    /*=============================================
	MOSTAR HISTORIAL
    =============================================*/

	static public function ctrMostrarHistorial($item, $valor,$item2,$valor2){

		$tabla = "registros";

		$respuesta = ModeloBrucelosis::mdlMostrarHistorial($tabla, $item, $valor,$item2,$valor2);

		return $respuesta;

	}

}

