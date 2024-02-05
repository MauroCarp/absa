<?php

class ControladorTuberculosis{
   
    /*=============================================
	SUMAR REGISTROS 
    =============================================*/

	static public function ctrSumarRegistros($item,$valor,$operador,$item3,$rango){
    
        $tabla = "tuberculosis";

        $rango = explode('/',$rango);

        $desde = $rango[0];
        
        $hasta = $rango[1];
		
        $respuesta = ModeloTuberculosis::mdlSumarRegistros($tabla, $item, $valor,$operador,$item3,$desde,$hasta);

		return $respuesta;
    
    }

    /*=============================================
	CONTAR REGISTROS 
    =============================================*/
    
	static public function ctrContarRegistros($item,$valor,$valor2,$item2,$rango){
    
        $tabla = "tuberculosis";

        $rango = explode('/',$rango);

        $desde = $rango[0];
        
        $hasta = $rango[1];
		
        $respuesta = ModeloTuberculosis::mdlContarRegistros($tabla, $item, $valor,$valor2,$item2,$desde,$hasta);

		return $respuesta;
    
    }

    /*=============================================
	MOSTAR REGISTROS 
    =============================================*/
	static public function ctrMostrarRegistros($item, $valor){

		$tabla = "tuberculosis";

		$respuesta = ModeloTuberculosis::mdlMostrarRegistros($tabla, $item, $valor);

		return $respuesta;

	}

    /*=============================================
	MOSTAR HISTORIAL
    =============================================*/

	static public function ctrMostrarHistorial($item, $valor,$item2,$valor2){

		$tabla = "registros";

		$respuesta = ModeloTuberculosis::mdlMostrarHistorial($tabla, $item, $valor,$item2,$valor2);
        
        return $respuesta;

    }
}

