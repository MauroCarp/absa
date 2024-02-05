<?php

require_once "../controladores/animales.controlador.php";
require_once "../modelos/animales.modelo.php";


class AjaxAnimales{
	
    public $renspa;
    
    public $campania;

    public function ajaxCargarAnimales(){

        $renspa = $this->renspa;

        $campania = $this->campania;

        $item = 'renspa';
        $item2 = 'campania';

		$respuesta = ControladorAnimales::ctrMostrarAnimales($item,$renspa,$item2,$campania);

        echo json_encode($respuesta);

      
    }

}

if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'cargarAnimales'){

        $cargarAnimales = new AjaxAnimales();
        $cargarAnimales-> campania = $_POST['campania'];
        $cargarAnimales-> renspa = $_POST['renspa'];
		$cargarAnimales -> ajaxCargarAnimales();

    }

}