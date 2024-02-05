<?php

require_once "../controladores/productores.controlador.php";
require_once "../modelos/productores.modelo.php";
require_once "../controladores/brucelosis.controlador.php";
require_once "../modelos/brucelosis.modelo.php";
require_once "../controladores/tuberculosis.controlador.php";
require_once "../modelos/tuberculosis.modelo.php";
require_once "../controladores/brutur.controlador.php";
require_once "../modelos/brutur.modelo.php";

class AjaxBrutur{

	public $renspa;
	
	public $campania;

	public $certificado;

	public $tabla;
	
    public function ajaxMostrarDatos(){

		$item = "renspa";
		$valor = $this->renspa;

		$respuesta = ControladorProductores::ctrMostrarProductores($item, $valor);

		echo json_encode($respuesta);


	}

	public function ajaxMostrarDatosBrucelosis(){

		$item = "renspa";
		$valor = $this->renspa;

		$respuesta = ControladorBrucelosis::ctrMostrarRegistros($item, $valor);

		echo json_encode($respuesta);


	}

	public function ajaxMostrarDatosTuberculosis(){

		$item = "renspa";
		$valor = $this->renspa;

		$respuesta = ControladorTuberculosis::ctrMostrarRegistros($item, $valor);

		echo json_encode($respuesta);

	}

	public function ajaxMostrarHistorial(){

		$item = 'renspa';
		$valor = $this->renspa;

		$item2 = 'campania';
		$valor2 = $this->campania;

		if ($valor2 == 'Brucelosis') {
			
			$respuesta = ControladorBrucelosis::ctrMostrarHistorial($item, $valor,$item2,$valor2);
			
		}else{
			
			$respuesta = ControladorTuberculosis::ctrMostrarHistorial($item, $valor,$item2,$valor2);

		}

		echo json_encode($respuesta);

	}

	public function ajaxMostrarBruTur(){

		$valor = $this->renspa;
			
		$respuesta = ControladorBruTur::ctrMostrarBruTur($valor);
		
		echo json_encode($respuesta);

	}

	public function ajaxAprobarEstado(){

		$item = 'renspa';
	 
		$tabla = $this->tabla;

		$datos = array('renspa'=>$this->renspa,
		'certificado'=>$this->certificado);

		$respuesta = ControladorBruTur::ctrAprobarEstado($tabla,$item,$datos);

		echo $respuesta;

	}

}



if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

    if($accion == 'productores'){

		$productor = new AjaxBrutur();
		$productor -> renspa = $_POST["renspa"];
		$productor -> ajaxMostrarDatos();
	
	}
    
	if($accion == 'brucelosis'){

		$brucelosis = new AjaxBrutur();
		$brucelosis -> renspa = $_POST["renspa"];
		$brucelosis -> ajaxMostrarDatosBrucelosis();
	
	}

	if($accion == 'tuberculosis'){

		$tuberculosis = new AjaxBrutur();
		$tuberculosis -> renspa = $_POST["renspa"];
		$tuberculosis -> ajaxMostrarDatosTuberculosis();
	
	}

	if($accion == 'historialBrucelosis'){

		$historialBrucelosis = new AjaxBrutur();
		$historialBrucelosis -> renspa = $_POST["renspa"];
		$historialBrucelosis -> campania = $_POST["campania"];
		$historialBrucelosis -> ajaxMostrarHistorial();
		
		
	}
	
	if($accion == 'historialTuberculosis'){
		
		$historialTuberculosis = new AjaxBrutur();
		$historialTuberculosis -> renspa = $_POST["renspa"];
		$historialTuberculosis -> campania = $_POST["campania"];
		$historialTuberculosis -> ajaxMostrarHistorial();
		
		
	}

	if($accion == 'aprobarEstado'){

		$aprobarEstado = new AjaxBrutur();
		$aprobarEstado -> renspa = $_POST["renspa"];
		$aprobarEstado -> certificado = $_POST["certificado"];
		$aprobarEstado -> tabla = $_POST["tabla"];
		$aprobarEstado -> ajaxAprobarEstado();

	}
	
}