<?php

require_once "../controladores/productores.controlador.php";
require_once "../modelos/productores.modelo.php";
require_once "../controladores/aftosa.controlador.php";
require_once "../modelos/aftosa.modelo.php";


class AjaxAftosa{
	
    public function ajaxCargarRecepcion($datos){

		$respuesta = ControladorAftosa::ctrCargarRecepcion($datos);

        echo json_encode($respuesta);
      
    }

    public function ajaxCargarDistribucion($datos){

		$respuesta = ControladorAftosa::ctrCargarDistribucion($datos);

        echo json_encode($respuesta);
      
    }
    
	
    public function ajaxMostrarDistribucion($matricula){

        $item = 'matricula';

        $valor = $matricula;

        $item2 = 'campania';

        $valor2 = $_COOKIE['campania'];
        
		$respuesta = ControladorAftosa::ctrMostrarDistribucion($item,$valor,$item2,$valor2);

        echo json_encode($respuesta);
      
    }
	
    public function ajaxDataCampania(){

        $item = 'numero';

        $valor = $_COOKIE['campania'];
        
		$respuesta = ControladorAftosa::ctrMostrarDatosCampania($item,$valor);

        echo json_encode($respuesta);
      
    }

    public function ajaxMarcasVacunas(){

        $item = 'marca';

		$respuesta = ControladorAftosa::ctrMostrarMarcas($item);

        echo json_encode($respuesta);
      
    }

}




if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'cargarRecepcion'){

		$cargarRecepcion = new AjaxAftosa();
		$cargarRecepcion -> ajaxCargarRecepcion($_POST);

    }

	if($accion == 'cargarDistribucion'){

		$cargarDistribucion = new AjaxAftosa();
		$cargarDistribucion -> ajaxCargarDistribucion($_POST);

    }
	
	if($accion == 'mostrarDistribucion'){

		$cargarDistribucion = new AjaxAftosa();
		$cargarDistribucion -> ajaxMostrarDistribucion($_POST['matricula']);

    }
	
	if($accion == 'dataCampania'){

		$mostrarCampania = new AjaxAftosa();
		$mostrarCampania -> ajaxDataCampania();

    }

    if($accion == 'marcasVacunas'){

		$marcasVacunas = new AjaxAftosa();
		$marcasVacunas -> ajaxMarcasVacunas();

    }
	
}