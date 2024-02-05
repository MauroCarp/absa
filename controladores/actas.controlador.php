<?php

class ControladorActas{
    

    /*=============================================
    VALIDAR ACTA
	=============================================*/

	static public function ctrValidarActa($item,$valor,$item2,$valor2,$item3,$valor3){
    
        $tabla = "actas";

        $respuesta = ModeloActas::mdlValidarActa($tabla, $item, $valor,$item2,$valor2,$item3,$valor3);

		return $respuesta;
    
    }

    /*=============================================
    MOSTRAR ACTA
	=============================================*/

	static public function ctrMostrarActa($item,$valor,$item2 = null,$valor2 = null,$orderBy = false){
    
        $tabla = "actas";

        $item3 = 'campania';

        $valor3 = $_COOKIE['campania'];
        
        $respuesta = ModeloActas::mdlMostrarActa($tabla, $item, $valor,$item2,$valor2,$item3,$valor3,$orderBy);

		return $respuesta;
    
    }

    /*=============================================
    CARGAR ACTA
	=============================================*/

	static public function ctrCargarActa(){
       
        if(!empty($_POST)){
            
            $campania = $_COOKIE['campania'];

            if($_POST['fechaVacunacion'] != '' AND $_POST['fechaRecepcion'] != ''  AND $_POST['actaNumero'] != '' ){

         
                $pago = (isset($_POST['pago']))? 1 : 0;

                $vacunoBrucelosis = (isset($_POST['vacunoBrucelosis']))? 1 : 0;
                
                $vacunoCarbunclo = (isset($_POST['vacunoCarbunclo']))? 1 : 0;

                $data = array(
                    'campania' => $campania,
                    'renspa' => $_POST['renspaProductor'],
                    'fechaVacunacion'=> $_POST['fechaVacunacion'],
                    'actaNumero'=> $_POST['actaNumero'],
                    'matricula'=> $_POST['matricula'],
                    'cantidadVacunas' => $_POST['cantidadVacunas'],
                    'fechaRecepcion'=> $_POST['fechaRecepcion'],
                    'pago' => $pago,
                    'vacunoCarbunclo' => $vacunoCarbunclo,
                    'cantidadCarbunclo' => $_POST['cantidadCarbunclo'],
                    'vacunoBrucelosis' => $vacunoBrucelosis,
                    'cantidadBrucelosis' => $_POST['cantidadBrucelosis'],
                    'montoRedondeoCar' => $_POST['montoRedondeoCar'],
                    'montoRedondeoAf' => $_POST['montoRedondeoAf'],
                    'interCampania' => $_POST['interCampania'],
                );

                var_dump($data);

                // OBTENGO DATOS DE VALORES DE LA CAMPAÑA
                
                $item = 'numero';

                $dataCampania = ControladorAftosa::ctrMostrarDatosCampania($item,$campania);

                $admAf = $dataCampania['admA'] * $data['cantidadVacunas'];  
                $vacunadorAf = $dataCampania['vacunadorA'] * $data['cantidadVacunas'];    
                $vacunaAf = $dataCampania['vacunaA'] * $data['cantidadVacunas'];   
                $admCar = $dataCampania['admC'] * $data['cantidadCarbunclo'];     
                $vacunadorCar= $dataCampania['vacunadorC'] * $data['cantidadCarbunclo'];    
                $vacunaCar = $dataCampania['vacunaC'] * $data['cantidadCarbunclo'];  

                $data['admAf'] = $admAf;

                $data['vacunadorAf'] = $vacunadorAf;

                $data['vacunaAf'] = $vacunaAf;

                $data['admCar'] = $admCar;

                $data['vacunadorCar'] = $vacunadorCar;

                $data['vacunaCar'] = $vacunaCar;

                $errores = array();

                $tabla = 'actas';

                $respuesta = ModeloActas::mdlCargarActa($tabla,$data);
                die();
                $errores[] = $respuesta;

                // DATA ANIMALES
                $dataAnimales = array(            
                    'renspa' => $_POST['renspaProductor'],
                    'campania' => $campania,
                    'vacas' => $_POST['vacas'],
                    'toros' => $_POST['toros'],
                    'toritos' => $_POST['toritos'],
                    'novillos' => $_POST['novillos'],
                    'novillitos' => $_POST['novillitos'],
                    'vaquillonas' => $_POST['vaquillonas'],
                    'terneras' => $_POST['terneras'],
                    'terneros' => $_POST['terneros'],
                    'bufaloMay' => $_POST['bufaloMay'],
                    'bufaloMen' => $_POST['bufaloMen'],
                    'caprinos' => $_POST['caprinos'],
                    'ovinos' => $_POST['ovinos'],
                    'porcinos' => $_POST['porcinos'],
                    'equinos' => $_POST['equinos'],
                );

                $respuesta = ControladorAnimales::ctrActualizarExistencia($dataAnimales);

                $errores[] = $respuesta;
            
                if(!in_array('error',$errores)){
                    
                    echo '<script>

                    swal({
                          type: "success",
                          title: "El Acta ha sido ingresada correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          })
                          .then(()=>{
                                                                  
                                window.location = "index.php?ruta=inicio"
    
                        })
                        
                    </script>';

                }else{

                    
                    echo'<script>

                    swal({
                        type: "error",
                        title: "Hubo un error en la carga. Informar a Mauro",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                                    
                            if (result.value) {

                                    window.location = "inicio";

                            }

                        })
                    
                    </script>';

                }

            }else{

                echo'<script>

                swal({
                      type: "error",
                      title: "Hay campos que no se completaron",
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
    ACTUALIZAR ACTA
	=============================================*/

	static public function ctrActualizarActa(){
       
        if(!empty($_POST)){

            $campania = $_COOKIE['campania'];

            if($_POST['fechaVacunacion'] != '' AND $_POST['fechaRecepcion'] != ''  AND $_POST['actaNumero'] != '' ){

                $pago = (isset($_POST['pago']))? 1 : 0;

                $vacunoBrucelosis = (isset($_POST['vacunoBrucelosis']))? 1 : 0;
                
                $vacunoCarbunclo = (isset($_POST['vacunoCarbunclo']))? 1 : 0;

                $data = array(
                    'campania' => $campania,
                    'renspa' => $_POST['renspaProductor'],
                    'fechaVacunacion'=> $_POST['fechaVacunacion'],
                    'actaNumero'=> $_POST['actaNumero'],
                    'matricula'=> $_POST['matricula'],
                    'cantidadVacunas' => $_POST['cantidadVacunas'],
                    'fechaRecepcion'=> $_POST['fechaRecepcion'],
                    'pago' => $pago,
                    'vacunoCarbunclo' => $vacunoCarbunclo,
                    'cantidadCarbunclo' => $_POST['cantidadCarbunclo'],
                    'vacunoBrucelosis' => $vacunoBrucelosis,
                    'cantidadBrucelosis' => $_POST['cantidadBrucelosis'],
                    'montoRedondeoCar' => $_POST['montoRedondeoCar'],
                    'montoRedondeoAf' => $_POST['montoRedondeoAf'],
                    'interCampania' => $_POST['interCampania']
                );

                // OBTENGO DATOS DE VALORES DE LA CAMPAÑA
                
                $item = 'numero';

                $dataCampania = ControladorAftosa::ctrMostrarDatosCampania($item,$campania);

                $admAf = $dataCampania['admA'] * $data['cantidadVacunas'];  
                $vacunadorAf = $dataCampania['vacunadorA'] * $data['cantidadVacunas'];    
                $vacunaAf = $dataCampania['vacunaA'] * $data['cantidadVacunas'];   
                $admCar = $dataCampania['admC'] * $data['cantidadCarbunclo'];     
                $vacunadorCar= $dataCampania['vacunadorC'] * $data['cantidadCarbunclo'];    
                $vacunaCar = $dataCampania['vacunaC'] * $data['cantidadCarbunclo'];  

                $data['admAf'] = $admAf;

                $data['vacunadorAf'] = $vacunadorAf;

                $data['vacunaAf'] = $vacunaAf;

                $data['admCar'] = $admCar;

                $data['vacunadorCar'] = $vacunadorCar;

                $data['vacunaCar'] = $vacunaCar;

                $errores = array();

                $tabla = 'actas';

                $respuesta = ModeloActas::mdlActualizarActa($tabla,$data);

                $errores[] = $respuesta;

                // DATA ANIMALES
                $dataAnimales = array(            
                    'renspa' => $_POST['renspaProductor'],
                    'campania' => $campania,
                    'vacas' => $_POST['vacas'],
                    'toros' => $_POST['toros'],
                    'toritos' => $_POST['toritos'],
                    'novillos' => $_POST['novillos'],
                    'novillitos' => $_POST['novillitos'],
                    'vaquillonas' => $_POST['vaquillonas'],
                    'terneras' => $_POST['terneras'],
                    'terneros' => $_POST['terneros'],
                    'bufaloMay' => $_POST['bufaloMay'],
                    'bufaloMen' => $_POST['bufaloMen'],
                    'caprinos' => $_POST['caprinos'],
                    'ovinos' => $_POST['ovinos'],
                    'porcinos' => $_POST['porcinos'],
                    'equinos' => $_POST['equinos'],
                );

                $respuesta = ControladorAnimales::ctrActualizarExistencia($dataAnimales);

                $errores[] = $respuesta;
          
                if(!in_array('error',$errores)){
                    
                    echo '<script>

                    swal({
                          type: "success",
                          title: "El Acta ha sido modificada correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          })
                          .then(()=>{
                                                                  
                                window.location = "index.php?ruta=inicio"
    
                        })
                        
                    </script>';

                }else{

                    
                    echo'<script>

                    swal({
                        type: "error",
                        title: "Hubo un error al modificar. Informar a Mauro",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                                    
                            if (result.value) {

                                    window.location = "inicio";

                            }

                        })
                    
                    </script>';

                }

            }else{

                echo'<script>

                swal({
                      type: "error",
                      title: "Hay campos que no se completaron",
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
    CONTAR ACTAS
	=============================================*/

    
	static public function ctrContarActas($item,$valor,$item2,$valor2){
        $tabla = "actas";

        $item3 = 'campania';

        $valor3 = $_COOKIE['campania'];

        $respuesta = ModeloActas::mdlContarActa($tabla, $item, $valor, $item2, $valor2, $item3, $valor3);

		return $respuesta;
    
    }
    
    /*=============================================
    SUMAR MONTOS DE ACTAS
    =============================================*/

    static public function ctrSumarMontos($item,$valor){

        $tabla = "actas";

        $respuesta = ModeloActas::mdlSumarMontos($tabla, $item, $valor);

        return $respuesta;

    }
    
    /*=============================================
    ACTAS INNER JOIN ANIMALES
    =============================================*/

    static public function ctrMostrarActasAnimales($item,$valor){

        $tabla = "actas";

        $tabla2 = 'animales';

        $item2 = 'campania';

        $valor2 = $_COOKIE['campania'];

        $respuesta = ModeloActas::mdlMostrarActasAnimales($tabla,$tabla2,$item,$valor,$item2,$valor2);

        return $respuesta;

    }
    
    /*=============================================
    SUMAR VACUNADOS INNER JOIN PRODUCTORES
    =============================================*/

    static public function ctrSumarVacunados($item,$valor){

        $tabla = "actas";

        $tabla2 = 'productores';

        $item2 = 'campania';

        $valor2 = $_COOKIE['campania'];

        $respuesta = ModeloActas::mdlSumarVacunados($tabla,$tabla2,$item,$valor,$item2,$valor2);

        return $respuesta;

    }


    
    /*=============================================
    ACTUALIZAR ACTA
	=============================================*/

	static public function ctrEliminarActa(){
       
        if(isset($_GET['acta'])){

            $renspa = $_GET['renspa'];
            $idActa = $_GET['acta'];

            $tabla = 'actas';

            $item = 'vacunas_id';

            $respuesta = ModeloActas::mdlEliminarActa($tabla,$item,$idActa);
          
            if($respuesta == 'ok'){
                
                echo '<script>

                swal({
                        type: "success",
                        title: "El Acta ha sido eliminada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        })
                        .then(()=>{
                                                                
                            window.location = "index.php?ruta=aftosa/actasProductor&renspa='.$renspa.'"


                    })
                    
                </script>';

            }else{

                
                echo'<script>

                swal({
                    type: "error",
                    title: "Hubo un error al modificar. Informar a Mauro",
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





}

