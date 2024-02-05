<?php
require_once "../controladores/productores.controlador.php";
require_once "../modelos/productores.modelo.php";

class TablaNoVacunados{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTabla(){

		$item =  'campania';
		
		$valor = $_COOKIE['campania'];
		
		$orden = 'propietario';

		$noVacunados = ControladorProductores::ctrMostrarEstNoVac($item, $valor,$orden);

        if(count($noVacunados) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($noVacunados); $i++){

		//  /*=============================================
 	 	// 	TRAEMOS LAS ACCIONES
  		// 	=============================================*/ 

		  	$datosJson .='[
				"'.$noVacunados[$i]["propietario"].'",
				"'.$noVacunados[$i]["renspa"].'",
				"'.$noVacunados[$i]["establecimiento"].'",
				"'.$noVacunados[$i]["departamento"].'",
				"'.$noVacunados[$i]["distrito"].'",
				"'.$noVacunados[$i]["explotacion"].'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE NO VACUNADOS
=============================================*/ 

$mostrarTabla = new TablaNoVacunados();
$mostrarTabla -> mostrarTabla();

