<?php

class ControladorVeterinarios{

	/*=============================================
	CREAR VETERINARIO
	=============================================*/

	static public function ctrCrearVeterinario(){

		if(isset($_POST["matricula"])){

			   	$tabla = "veterinarios";

				$item = 'matricula';

				$valor = $_POST['matricula'];

				$veterinarioValido = ControladorVeterinarios::ctrMostrarVeterinarios($item,$valor);

				if(!$veterinarioValido){

			

					$datos = array("nombre"=>$_POST["nombre"],
								"matricula"=>$_POST["matricula"],
								"domicilio"=>$_POST["domicilio"],
								"telefono"=>$_POST["telefono"],
								"mail"=>$_POST["email"],
								"cuit"=>$_POST["cuit"],
								"tipo"=>$_POST["tipo"]);

					$respuesta = ModeloVeterinarios::mdlIngresarVeterinario($tabla, $datos);
				
					if($respuesta == "ok"){

						echo'<script>

						swal({
							type: "success",
							title: "El Veterinario ha sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "veterinarios";

										}
									})

						</script>';

					}

				}else{

					echo'<script>

						swal({
							type: "error",
							title: "La matricula del Veterinario ya esta cargada. Verifique si la matricula es la correcta.",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "veterinarios";

										}
									})

						</script>';

				}
		
		}

	}

	/*=============================================
	MOSTRAR VETERINARIOS
	=============================================*/

	static public function ctrMostrarVeterinarios($item, $valor){

		$tabla = "veterinarios";

		$respuesta = ModeloVeterinarios::mdlMostrarVeterinarios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarVeterinario(){

		if(isset($_POST["matriculaEdit"])){

			   	$tabla = "veterinarios";

			   	$datos = array("nombre"=>$_POST["nombreEdit"],
								"matricula"=>$_POST["matriculaEdit"],
								"domicilio"=>$_POST["domicilioEdit"],
								"telefono"=>$_POST["telefonoEdit"],
								"mail"=>$_POST["emailEdit"],
								"cuit"=>$_POST["cuitEdit"],
								"tipo"=>$_POST["tipoEdit"],
					        	"id"=>$_POST["idEdit"]);
				
				$respuesta = ModeloVeterinarios::mdlEditarVeterinario($tabla, $datos);
							//    return $respuesta;
							// 	  die();
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Veterinario ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "veterinarios";

									}
								})

					</script>';

				}

		}

	}

	/*=============================================
	ELIMINAR PRODUCTOR
	=============================================*/

	static public function ctrEliminarVeterinario(){

		if(isset($_GET["idVeterinario"])){

			$tabla ="veterinarios";
			
			$datos = $_GET["idVeterinario"];

			$respuesta = ModeloVeterinarios::mdlEliminarVeterinario($tabla,$datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Veterinario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "veterinarios";

								}
							})

				</script>';

			}		

		}

	}

	/*=============================================
	GENERAR EXCEL VETERINARIOS
	=============================================*/

	static public function ctrGenerarExcelVeterinarios(){
		
		$item = null;

		$valor = null;
		
		$respuestaVeterinarios = ControladorVeterinarios::ctrMostrarVeterinarios($item,$valor);

		$nombreArchivo = 'Nomina Veterinarios.xls';
		
		header('Expires: 0');
		header('Cache-control: private');
		header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
		header("Cache-Control: cache, must-revalidate"); 
		header('Content-Description: File Transfer');
		header('Last-Modified: '.date('D, d M Y H:i:s'));
		header("Pragma: public"); 
		header('Content-Disposition:; filename="'.$nombreArchivo.'"');
		header("Content-Transfer-Encoding: binary");

		echo utf8_decode("<table border='0'> 

			<tr> 
			<td style='font-weight:bold; border:1px solid #eee;'>NOMBRE</td> 
			<td style='font-weight:bold; border:1px solid #eee;'>MATRICULA</td>
			<td style='font-weight:bold; border:1px solid #eee;'>DOMICILIO</td>
			<td style='font-weight:bold; border:1px solid #eee;'>TELEFONO</td>
			<td style='font-weight:bold; border:1px solid #eee;'>E-MAIL</td>	
			<td style='font-weight:bold; border:1px solid #eee;'>CUIT</td>	
			<td style='font-weight:bold; border:1px solid #eee;'>TIPO</td>	
			</tr>");


			for ($i=0; $i < sizeof($respuestaVeterinarios) ; $i++) { 
				

				echo utf8_decode("<tr> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaVeterinarios[$i]['nombre']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>'".$respuestaVeterinarios[$i]['matricula']."'</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaVeterinarios[$i]['domicilio']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaVeterinarios[$i]['telefono']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaVeterinarios[$i]['email']."</td> 		
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaVeterinarios[$i]['cuit']."</td> 		
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaVeterinarios[$i]['tipo']."</td> 		
				</tr>");

			}

		echo "</table>";

	}


	
}

