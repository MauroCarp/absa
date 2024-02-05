<?php

class ControladorProductores{

	/*=============================================
	CREAR PRODUCTORES
	=============================================*/

	static public function ctrCrearProductor(){

		if(isset($_POST["propietario"])){

			   	$tabla = "productores";

			   	$datos = array("renspa"=>$_POST["renspa"],
							   "propietario"=>$_POST["propietario"],
							   "establecimiento"=>$_POST["establecimiento"],
							   "explotacion"=>$_POST["tipoExplotacion"],
							   "regimen"=>$_POST["regimen"],
							   "tipoDoc"=>$_POST["tipoDoc"],
							   "numDoc"=>$_POST["numDoc"],
							   "iva"=>$_POST["iva"],
							   "telefono"=>$_POST["telefono"],
							   "mail"=>$_POST["mail"],
							   "domicilio"=>$_POST["domicilio"],
							   "localidad"=>$_POST["localidad"],
							   "provincia"=>$_POST["provincia"],
							   "departamento"=>$_POST["departamento"],
							   "veterinario"=>$_POST["veterinario"],
							   "distrito"=>$_POST["distrito"]);

				$respuesta = ModeloProductores::mdlIngresarProductor($tabla, $datos);

				$tabla = "brucelosis";
				
				$datos = array("renspa"=>$_POST["renspa"]);
				
				$respuesta = ModeloBrucelosis::mdlIngresarRegistro($tabla, $datos);
				
				$tabla = "tuberculosis";
				
				$respuesta = ModeloTuberculosis::mdlIngresarRegistro($tabla, $datos);
				
				$datos['campania'] = $_COOKIE['campania'];

				$cargarAnimales = ModeloAnimales::mdlCrearRegistro($datos);
				
				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Productor/Establecimiento ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "productores";

									}
								})

					</script>';

				}else{

					$datos = array("renspa"=>$_POST["renspa"]);
					
					$tabla = "productores";

					$respuesta = ModeloProductores::mdlEliminarProductor($tabla, $datos);
				
					$tabla = "brucelosis";

					$respuesta = ModeloProductores::mdlEliminarProductor($tabla, $datos);
				
					$tabla = "tuberculosis";

					$respuesta = ModeloProductores::mdlEliminarProductor($tabla, $datos);

					echo'<script>

					swal({
						  type: "error",
						  title: "Hubo un error. El registro no fue guardado",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "productores";

									}
								})

					</script>';

				}

		
		}

	}

	/*=============================================
	CREAR PRODUCTOR EXISTENCIA
	=============================================*/

	static public function ctrCrearProductorExistencia($renspa,$propietario){

		$datos = array("renspa"=>$renspa,
		"propietario"=>$propietario,
		"establecimiento"=>NULL,
		"explotacion"=>NULL,
		"regimen"=>NULL,
		"tipoDoc"=>NULL,
		"numDoc"=>NULL,
		"iva"=>NULL,
		"telefono"=>NULL,
		"mail"=>NULL,
		"domicilio"=>NULL,
		"localidad"=>NULL,
		"provincia"=>NULL,
		"departamento"=>NULL,
		"veterinario"=>NULL,
		"distrito"=>NULL);

		$tabla = "productores";

		$respuesta = ModeloProductores::mdlIngresarProductor($tabla, $datos);

		$tabla = "brucelosis";
		
		$datos = array("renspa"=>$renspa);
		
		$respuesta = ModeloBrucelosis::mdlIngresarRegistro($tabla, $datos);
		
		$tabla = "tuberculosis";
		
		$respuesta = ModeloTuberculosis::mdlIngresarRegistro($tabla, $datos);
				

	}

	/*=============================================
	MOSTRAR PRODUCTORES
	=============================================*/

	static public function ctrMostrarProductores($item = null, $valor = null){

		$tabla = "productores";

		$respuesta = ModeloProductores::mdlMostrarProductores($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrMostrarProductoresDistinct($item, $valor,$distinct){

		$tabla = "productores";

		$respuesta = ModeloProductores::mdlMostrarProductoresDistinct($tabla, $item, $valor,$distinct);

		return $respuesta;

	}

	/*=============================================
	EDITAR PRODUCTOR
	=============================================*/

	static public function ctrEditarProductor(){
	
		if(isset($_POST["renspaEdit"])){

			$tabla = "productores";

			$datos = array("renspa"=>$_POST["renspaEdit"],
						"propietario"=>$_POST["propietarioEdit"],
						"establecimiento"=>$_POST["establecimientoEdit"],
						"explotacion"=>$_POST["tipoExplotacionEdit"],
						"regimen"=>$_POST["regimenEdit"],
						"tipoDoc"=>$_POST["tipoDocEdit"],
						"numDoc"=>$_POST["numDocEdit"],
						"iva"=>$_POST["ivaEdit"],
						"telefono"=>$_POST["telefonoEdit"],
						"mail"=>$_POST["mailEdit"],
						"domicilio"=>$_POST["domicilioEdit"],
						"localidad"=>$_POST["localidadEdit"],
						"provincia"=>$_POST["provinciaEdit"],
						"departamento"=>$_POST["departamentoEdit"],
						"distrito"=>$_POST["distritoEdit"],
						"veterinario"=>$_POST["veterinarioEdit"],
						"hola"=>$_POST["veterinarioEdit"],
						"id"=>$_POST["idEdit"]);

			$respuesta = ModeloProductores::mdlEditarProductor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					type: "success",
					title: "El Productor ha sido modificado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "productores";

								}
							})

				</script>';

			}

			}

	}

	/*=============================================
	EDITAR PARAMETRO
	=============================================*/

	static public function ctrEditarParametro($item,$valor,$item2,$valor2){

		$tabla = "productores";

		return $respuesta = ModeloProductores::mdlEditarParametro($tabla, $item,$valor,$item2,$valor2);

	}

	/*=============================================
	ELIMINAR PRODUCTOR
	=============================================*/

	static public function ctrEliminarProductor(){

		if(isset($_GET["idProductor"])){

			$tabla ="productores";
			
			$datos = $_GET["idProductor"];

			$respuesta = ModeloProductores::mdlEliminarProductor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El productor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "productores";

								}
							})

				</script>';

			}		

		}

	}

	/*=============================================
	PRODUCTORES SEGUN VETERINARIO
	=============================================*/

	static public function ctrStatusEstablecimientos($item, $valor){

		$tabla = "productores";

		$tabla2 = 'brucelosis';

		$tabla3 = 'tuberculosis';

		$respuesta = ModeloProductores::mdlStatusEstablecimientos($tabla, $tabla2,$tabla3,$item, $valor);

		return $respuesta;

	}

	
	/*=============================================
	SITUACION PRODUCTOR
	=============================================*/
	static public function ctrSituacionProductor($item, $valor,$item2, $valor2){
		
		$tablas = array();
		$tablas[] = 'productores';
		$tablas[] = 'actas';

		return $respuesta = ModeloProductores::mdlSituacionProductor($tablas,$item,$valor,$item2,$valor2); 

	}

	/*=============================================
	SITUACION PRODUCTOR
	=============================================*/
	static public function ctrAnimalesProductor($item, $valor,$item2, $valor2){
		
		$tablas = array();
		$tablas[] = 'productores';
		$tablas[] = 'animales';

		return $respuesta = ModeloProductores::mdlSituacionProductor($tablas,$item,$valor,$item2,$valor2); 

	}


	/*=============================================
	ESTAB. NO VACUNADOS
	=============================================*/
	static public function ctrMostrarEstNoVac($item, $valor,$orden){
		
		$tablas = array();
		$tablas[] = 'productores';
		$tablas[] = 'actas';

		return $respuesta = ModeloProductores::mdlMostrarEstNoVac($tablas,$item, $valor,$orden); 

	}


	/*=============================================
	TABGEO
	=============================================*/
	static public function ctrMostrarLocation($item, $valor,$item2,$valor2){
		
		$tabla = 'tabgeo';
		
		return $respuesta = ModeloProductores::ctrMostrarLocation($tabla,$item, $valor,$item2,$valor2); 

	}
	
}

