<?php

class ControladorAftosa{
    
    /*=============================================
	CARGAR NUEVA CAMPANIA
	=============================================*/

	static public function ctrCargarCampania(){
    
        if(isset($_GET['campania'])){
            
            $tabla = "campanias";
            
            $item = 'numero';

            $valor = $_GET['campania'];

            $respuesta = ModeloAftosa::mdlCargarCampania($tabla, $item, $valor);
    
            
            if($respuesta == "ok"){

                echo'<script>

                swal({
                      type: "success",
                      title: "La campaña fue cargada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                let date = new Date()

                                date.setTime(date.getTime()+(30*24*60*60*1000))
    
                                let expires = date.toGMTString()
                                
                                document.cookie = `campania = '.$valor.'";path=/sanidadAnimal;Expires=${expires}`

                                window.location = "inicio";

                                }
                            })

                </script>';

            }else{

                echo'<script>

                swal({
                      type: "error",
                      title: "Hubo un error. El registro no fue guardado",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "inicio";

                                }
                            })

                </script>';

            }

        }
    
    }

    /*=============================================
    MOSTRAR DATOS CAMPANIA
	=============================================*/

	static public function ctrMostrarDatosCampania($item,$valor){
    
        $tabla = "campanias";
		
        $respuesta = ModeloAftosa::mdlMostrarDatosCampania($tabla, $item, $valor);

		return $respuesta;
    
    }

    /*=============================================
    EDITAR DATOS CAMPANIA
	=============================================*/

	static public function ctrEditarDatosCampania(){
    
        if(isset($_POST['editarCampania'])){
            
            $tabla = "campanias";

            $datos = array('numero' => $_POST['campaniaNumero'],'fechaInicio' => $_POST['fechaInicio'],'fechaCierre' => $_POST['fechaCierre'],'precioAdmAftosa' => $_POST['precioAdmAftosa'],'precioVacunaAftosa' => $_POST['precioVacunaAftosa'],'precioVeterinarioAftosa' => $_POST['precioVacunaAftosa'],'precioAdmCarb' => $_POST['precioAdmCarb'],'precioVacunaCarb' => $_POST['precioVacunaCarb'],'precioVeterinarioCarb' => $_POST['precioVacunaCarb']);
            
            $respuesta = ModeloAftosa::mdlEditarDatosCampania($tabla,$datos);

            $errores = array();
            
            $errores[] = $respuesta;


            if($_FILES["existenciaAnimal"]['size'] > 0){

                require_once 'extensiones/excel/php-excel-reader/excel_reader2.php';

                require_once 'extensiones/excel/SpreadsheetReader.php';
                
                $productores = ControladorProductores::ctrMostrarProductores(null,null);

                $renspasExistentes = array();
    
                foreach ($productores as $key => $value) {
                    
                    $renspasExistentes[] = $value['renspa'];

                }

                $error = false;
            
                $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            
                if(in_array($_FILES["existenciaAnimal"]["type"],$allowedFileType)){
            
                    $ruta = "cargas/" . $_FILES['existenciaAnimal']['name'];
            
                    move_uploaded_file($_FILES['existenciaAnimal']['tmp_name'], $ruta);
            
                    $nombreArchivo = str_replace(' ', '',$_FILES['existenciaAnimal']['name']);
            
                    $rowNumber = 0;
            
                    $rowValida = FALSE;
                    
                    $rowValidaTemp = FALSE;
                                
                    $Reader = new SpreadsheetReader($ruta);	
            
                    $sheetCount = count($Reader->sheets());
            
                    for($i=0;$i<$sheetCount;$i++){
            
                        $Reader->ChangeSheet($i);
            
                            foreach ($Reader as $Row){;

                                $rowNumber++;
                                
                                
                                if($rowValida){   
                                    
                                    if(!in_array($Row[0], $renspasExistentes)) {
                        
                                        $respuesta = ControladorProductores::ctrCrearProductorExistencia($Row[0],$Row[1]);
                                    
                                    }

                                    $data = array(
                                        'renspa' => $Row[0],
                                        'vacas' => $Row[2],
                                        'vaquillonas' => $Row[3],
                                        'novillos' => $Row[4],
                                        'novillitos' => $Row[5],
                                        'terneras' => $Row[6],
                                        'terneros' => $Row[7],
                                        'toros' => $Row[8],
                                        'toritos' => $Row[9]
                                    );
                                    
                                    $respuesta = ControladorAnimales::ctrCargarExistencia($data);
                               
                                }
                                
                                if ($rowNumber == 1){
                                    
                                    $rowValida = TRUE;
                                
                                }
            

                            }		
                    }
            
                }

            }

            if($respuesta == "ok"){

                echo'<script>

                swal({
                      type: "success",
                      title: "La campaña fue modificada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "inicio";

                                }
                            })

                </script>';

            }else{

                echo'<script>

                swal({
                      type: "error",
                      title: "Hubo un error. El registro no fue guardado",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "inicio";

                                }
                            })

                </script>';

            }
        
        }
    
    }

    /*=============================================
    MOSTRAR DATOS
    =============================================*/

	static public function ctrMostrarDatos($tabla,$item,$valor,$orden){
    
        return $respuesta = ModeloAftosa::mdlMostrarDatos($tabla, $item, $valor, $orden);

    }

    /*=============================================
    MOSTRAR DATOS
    =============================================*/

	static public function ctrMostrarMarcas($item){
    
        $tabla = 'recepcion';

        return $respuesta = ModeloAftosa::mdlMostrarMarcas($tabla, $item);

    }

    /*=============================================
    SUMAR DATOS
    =============================================*/

	static public function ctrSumarDatos($tabla,$campo,$item,$valor,$item2,$valor2){
    
       return $respuesta = ModeloAftosa::mdlSumarDatos($tabla,$campo,$item,$valor,$item2,$valor2);

    }

    /*=============================================
    ELIMINAR DATOS
    =============================================*/

	static public function ctrEliminarRecepcion(){
    
        if(isset($_GET['id'])){

            $tabla = 'recepcion';

            $item = 'recepcion_id';

            $valor = $_GET['id'];

            $respuesta = ModeloAftosa::mdlEliminarDato($tabla, $item, $valor);
        
            if($respuesta == "ok"){

                echo'<script>

                swal({
                      type: "success",
                      title: "La Recepcion fue eliminada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "index.php?ruta=aftosa/recepcion";

                                }
                            })

                </script>';

            }else{

                echo'<script>

                swal({
                      type: "error",
                      title: "Hubo un error. El registro no fue guardado",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                    window.location = "index.php?ruta=aftosa/recepcion";

                                }
                            })

                </script>';

            }
        }

    }

    /*=============================================
    CARGAR RECEPCION
    =============================================*/

	static public function ctrCargarRecepcion($datos){
    
        $tabla = 'recepcion'; 

        return $respuesta = ModeloAftosa::mdlCargarRecepcion($tabla, $datos);

    }

    /*=============================================
    MOSTRAR DISTRIBUCION
    =============================================*/

	static public function ctrMostrarDistribucion($item,$valor,$item2,$valor2){
    
        $tabla = 'distribucion'; 

        return $respuesta = ModeloAftosa::mdlMostrarDistribucion($tabla, $item,$valor,$item2,$valor2);

    }

    /*=============================================
    CARGAR DISTRIBUCION
    =============================================*/

	static public function ctrCargarDistribucion($datos){
    
        $tabla = 'distribucion'; 

        return $respuesta = ModeloAftosa::mdlCargarDistribucion($tabla, $datos);

    }

    /*=============================================
    ENVIAR CRONOGRAMA
    =============================================*/

	static public function ctrEnviarMail($veterinario,$email){
    
        $rutaCronograma = $_SERVER['DOCUMENT_ROOT'].'/sanidadAnimal/vistas/modulos/aftosa/informes/cronograma.pdf';

        $rutaSend =  $_SERVER['DOCUMENT_ROOT'].'/sanidadAnimal/vistas/modulos/brutur/sendmail.php';
        $template =  $_SERVER['DOCUMENT_ROOT'].'/sanidadAnimal/vistas/modulos/brutur/email_template.html';

        include($rutaSend);//Mando a llamar la funcion que se encarga de enviar el correo electronico

        //Configuracion de variables para enviar el correo
        define('MAIL','pruebafissa@gmail.com');
        define('PASS','mauro425336');
        $mail_username = MAIL;//Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail_userpassword = PASS;//Tu contraseña de gmail
        $mail_addAddress = $email;//correo electronico que recibira el mensaje
        $mail_setFromEmail= "fundacioniriondosur@gmail.com";
        $mail_setFromName= "A.B.S.A";
        $txt_message="<h2>Cronograma del Vacunador ".$veterinario."</h2>
        <h4>Se adjunta Cronograma</h4>
        <br>
        <p align='center'>No responder este a e-mail<br>
        Consultas al e-mail fundacioniriondosur@gmail.com</p>";
        
        $mail_subject="Cronograma del Vacunador";
        
        return sendemailAttach($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template,$rutaCronograma);


    }

}

