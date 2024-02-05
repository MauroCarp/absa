<?php
require_once "../../controladores/veterinarios.controlador.php";
require_once " ../../../../modelos/veterinarios.modelo.php";
require_once "../../controladores/productores.controlador.php";
require_once " ../../../../modelos/productores.modelo.php";
require_once "../../controladores/aftosa.controlador.php";
require_once " ../../../../modelos/aftosa.modelo.php";
require_once "../../controladores/actas.controlador.php";
require_once " ../../../../modelos/actas.modelo.php";
require_once "../../controladores/animales.controlador.php";
require_once " ../../../../modelos/animales.modelo.php";

function formatearFecha($fecha){
    
    $fechaExplode = explode('-',$fecha);
    
    $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];
    
    return $fechaFormateada;
    
}

$informe = (isset($_GET['informe'])) ?  $_GET['informe'] : false;

class informePDF{

    public $matricula;
    
    public $mail;

    public function informe1(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Animales Totales Vacunados por Vacunador';

        $cabezera = "Sistema integrado de Vacunacion Anti-Aftosa \n Animales Totales Vacunados por Vacunador";

        include 'cabezera.php';

        $pdf->Ln(5);
        $pdf->SetFont('Times','B',14);
        $pdf->SetX(40);
        $pdf->Cell(190,10,'(Incluyendo establecimientos de distintos Distritos)',0,1,'L',0);
        $pdf->SetX(40);
        $pdf->Cell(65,8,'VACUNADOR',1,0,'C',0);
        $pdf->Cell(45,8,'TOTAL',1,1,'C',0);
        $pdf->SetFont('Times','',12);
        
        $total = 0;

        $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios(null,null);
     
        foreach ($veterinarios as $key => $value) {
         
            $item = 'matricula';

            $item2 = 'intercampania';

            $value2 = false;

            if(isset($_GET['intercampania'])){

                $value2 = true;

                $totalVacunados = ControladorActas::ctrContarActas($item,$value['matricula'],$item2,$value2);

            }else{
                
                $totalVacunados = ControladorActas::ctrContarActas($item,$value['matricula'],$item2,$value2);

            }

            $pdf->SetX(40);
            
            $pdf->Cell(85,8,utf8_decode($value['nombre']),0,0,'L',0);

            if ($totalVacunados[0] != null) {
            
                $pdf->Cell(45,8,number_format($totalVacunados[0],0,'','.'),0,1,'L',0);
                
                $total += $totalVacunados[0];
                
            }else{
                
                $pdf->Cell(45,8,number_format(0,0,'','.'),0,1,'L',0);

            }
        

        }
    
        $pdf->SetX(40);
        $pdf->SetFont('times','B',11);
        $pdf->Cell(85,8,'Total',0,0,'L',0);
        $pdf->Cell(45,8,number_format($total,0,'','.'),0,1,'L',0);
    
        $pdf->Output();
        

    }

    public function informe2(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Total Bovinos Vacunados por localidad y total departamental';

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Total Bovinos Vacunados por localidad y total departamental";

        include 'cabezera.php';

        $pdf->Ln(10);
        $pdf->SetFont('Times','B',12);
        $pdf->SetX(10);
        $pdf->Cell(50,7,'BELGRANO',0,0,'L',0);
        $pdf->Cell(60,7,'DISTRITO',0,0,'L',0);
        $pdf->Cell(40,7,'TOTAL animales',0,0,'L',0);
        $pdf->Cell(50,7,'Cant. Establ.',0,1,'L',0);
        $pdf->Cell(185,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',10);
        $pdf->SetFillColor(0,0,0);
    
        $distinct = 'distrito';

        $distritos = ControladorProductores::ctrMostrarProductoresDistinct(null,null,$distinct);
     
        $renspasPorDistrito = array();

        $totales = array('establecimientos'=>0,'vacunados'=>0,'parcial'=>0,'animales'=>0);

        foreach ($distritos as $key => $value) {
            
            if($value[0] != null){      

                $item = 'distrito';
                                
                // CALCULAR TOTAL ANIMALES VACUNADOS
                $animalesVacunados = ControladorActas::ctrSumarVacunados($item,$value[0]);

                $totales['vacunados'] += $animalesVacunados['total'];

                // CALCULAR TOTAL ANIMALES ExXISTENCIA
                
                $item2 = 'campania';

                $valor2 = $_COOKIE['campania'];
                
                $campo = 'renspa';

                $animalesExistencia = ControladorAnimales::ctrSumarAnimalesInnerProductor($item,$value[0],$item2,$valor2,$campo);

                $totalAnimalesExistencia = $animalesExistencia['totalExistencia'];

                $totales['animales'] += $totalAnimalesExistencia;

                // CALCULAR TOTAL EXISTENCIA VACUNADOS PARCIAL

                $parcialAnimalesExistencia = $animalesExistencia['parcialExistencia'];                

                $totales['parcial'] += $parcialAnimalesExistencia;

                $totales['establecimientos'] += $animalesExistencia['establecimientos'];

                $nombreDistrito = ControladorProductores::ctrMostrarLocation('departamento',1,'localidad',$value[0]);

                $pdf->Cell(50,7,'',0,0,'L',0);
                $pdf->Cell(40,7,utf8_decode($nombreDistrito['nombre']),0,0,'L',0);
                $pdf->Cell(30,7,'Total Vacunado',0,0,'L',0);
                $pdf->Cell(40,7,$animalesVacunados['total'],0,0,'L',0);
                $pdf->Cell(50,7,$animalesExistencia['establecimientos'],0,1,'L',0);
                $pdf->Cell(90,7,'',0,0,'L',0);
                $pdf->Cell(30,7,'Total Animales',0,0,'L',0);
                $pdf->Cell(40,7,$totalAnimalesExistencia,0,1,'L',0);
                $pdf->Cell(90,7,'',0,0,'L',0);
                $pdf->SetFont('Times','b',10);
                $pdf->Cell(30,7,'Parcial:',0,0,'L',0);
                $pdf->SetFont('Times','',10);
                $pdf->Cell(40,7,$parcialAnimalesExistencia,0,1,'L',0);
                $pdf->SetX(60);
                $pdf->Cell(120,.1,'',0,1,'L',1);

            }

        }
    
        
        $pdf->SetTextColor(0,4,162);
        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(40,7,'Promedio de Animales:',0,0,'L',0);
        
        $promedio = number_format(($totales['vacunados'] / $totales['establecimientos']),2,',','.');
        
        $pdf->Cell(45,7,$promedio,0,0,'L',0);
        $pdf->Cell(35,7,'Total Vacunado:',0,0,'L',0);
        $pdf->Cell(40,7,$totales['vacunados'],0,0,'L',0);
        $pdf->Cell(40,7,$totales['establecimientos'],0,1,'L',0);
        $pdf->Cell(90,7,'',0,0,'L',0);
        $pdf->SetFont('helvetica','b',10);
        $pdf->Cell(30,7,'Total Animales:',0,0,'L',0);
        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(40,7,$totales['animales'],0,1,'L',0);
        $pdf->SetFont('helvetica','b',10);
        $pdf->Cell(90,7,'',0,0,'L',0);
        $pdf->Cell(30,7,'Parcial:',0,0,'L',0);
        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(40,7,$totales['parcial'],0,1,'L',0);
    
        $pdf->Output();
        
    }

    public function informe3(){
        
        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Detalle de Animales Vacunados por Vacunador con Bufalos/as';

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Detalle de Animales Vacunados por Vacunador con Bufalos/as";

        include 'cabezeraLand.php';

        $matricula = $this->matricula;

        $item = 'matricula';

        $veterinario = ControladorVeterinarios::ctrMostrarVeterinarios($item, $matricula);

        $nombreVeterinario = $veterinario['nombre'];

        $pdf->Cell(40,7,'Vacunador:',0,0,'L',0);
        $pdf->Cell(40,7,$nombreVeterinario,0,1,'L',0);
        $pdf->Ln(3);
        $pdf->SetFont('Times','B',11);
        $pdf->SetX(10);
        $pdf->Cell(15,7,'Acta',0,0,'L',0);
        $pdf->Cell(25,7,'Fecha Vac.',0,0,'L',0);
        $pdf->Cell(70,7,'Propietario',0,0,'L',0);
        $pdf->Cell(65,7,'Establecimiento',0,0,'L',0);
        $pdf->Cell(40,7,'Renspa',0,0,'L',0);
        $pdf->Cell(25,7,'Cantidad',0,0,'L',0);
        $pdf->Cell(20,7,'Estado',0,0,'L',0);
        $pdf->Cell(40,7,'Debe',0,1,'L',0);
        $pdf->Cell(278,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',11);

        $item2 = 'intercampania';     
           
        $dataPorVacunador = ControladorActas::ctrMostrarActa($item,$matricula,$item2,0,true);
        
        $dataCampania = ControladorAftosa::ctrMostrarDatosCampania('numero',$_COOKIE['campania']);

        $totalAnimalesVacunados = 0;

        foreach ($dataPorVacunador as $key => $dataProductor) {

            $item = 'renspa';

            $productor = ControladorProductores::ctrMostrarProductores($item,$dataProductor['renspa']);

            $pdf->Cell(15,7,$dataProductor['acta'],0,0,'L',0);
            $pdf->Cell(25,7,formatearFecha($dataProductor['fechaVacunacion']),0,0,'L',0);
            $pdf->Cell(70,7,$productor['propietario'],0,0,'L',0);
            $pdf->Cell(65,7,$productor['establecimiento'],0,0,'L',0);
            $pdf->Cell(40,7,$dataProductor['renspa'],0,0,'L',0);
            $pdf->Cell(25,7,$dataProductor['cantidadPar'],0,0,'L',0);

            $totalAnimalesVacunados += $dataProductor['cantidadPar'];
            
            $pdf->SetFont('helvetica','B',9);

            if($dataProductor['pago']){

                $pdf->SetTextColor(0,175,12);
                $pdf->Cell(20,7,utf8_decode("Pagó"),0,1,'L',0);
                $pdf->SetFont('times','',11);
                $pdf->SetTextColor(0,0,0);
            
            }else{

                $pdf->SetTextColor(255,0,0);
                $pdf->Cell(20,7,utf8_decode("NO Pagó"),0,0,'L',0);
                $debe = ($dataProductor['cantidadPar'] * $dataCampania['vacunadorA']);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('times','',11);
                $pdf->Cell(40,7,"$ ".number_format($debe, 2, ",", "."),0,1,'L',0);

            }
        }
        
    
        $pdf->SetFont('times','B',11);
        $pdf->Cell(215,7,'',0,0,'L',0);
        $pdf->Cell(20,.5,'',0,1,'L',1);
        $pdf->Cell(215,7,'',0,0,'L',0);
        $pdf->Cell(40,7,$totalAnimalesVacunados,0,1,'L',0);	

        $pdf->Output();

    }

    public function informe4(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Entrega de vacunas por Vacunador';
        
        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Entrega de Vacunas por Productor incluida la de Búfalos/as";

        include 'cabezeraLand.php';

        $pdf->SetFont('Times','B',14);
        $pdf->SetFillColor(0,4,162);
        $pdf->SetX(10);
        $pdf->Cell(40,7,'Vacunador',0,0,'L',0);
        $pdf->Cell(40,7,utf8_decode('Matrícula'),0,0,'L',0);
        $pdf->Cell(40,7,'UEL',0,0,'L',0);
        $pdf->Cell(40,7,'Marca',0,0,'L',0);
        $pdf->Cell(50,7,'Fecha Entrega',0,0,'L',0);
        $pdf->Cell(40,7,'Dosis',0,1,'L',0);
        $pdf->Cell(250,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',11);

        $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios(null,null);

        $item = 'matricula';

        $item2 = 'campania';

        $campania = $_COOKIE['campania'];

        $total = 0;

        foreach ($veterinarios as $key => $value) {
            
            $distribuciones = ControladorAftosa::ctrMostrarDistribucion($item,$value['matricula'],$item2,$campania);
            
            if(!empty($distribuciones)){

                $pdf->Cell(40,7,utf8_decode($value['nombre']),0,0,'L',0);
                $pdf->Cell(40,7,$value['matricula'],0,0,'L',0);
                $pdf->Cell(40,7,'A.B.S.A Belgrano',0,0,'L',0);


                $first = true;
                
                $totalDosis = 0;

                foreach ($distribuciones as $key => $distribucion) {
                    
                    if($first){

                        $first = false;

                    }else{

                        $pdf->Cell(120,7,'',0,0,'L',0);

                    }
                    
                    $pdf->Cell(40,7,$distribucion['marca'],0,0,'L',0);
                    $pdf->Cell(40,7,formatearFecha($distribucion['fechaEntrega']),0,0,'L',0);
                    $pdf->Cell(40,7,$distribucion['cantidad'],0,1,'L',0);
                
                    $totalDosis += $distribucion['cantidad'];
                    $total += $distribucion['cantidad'];
                    
                };

                $pdf->Cell(200,7,'',0,0,'L',0);
                $pdf->Cell(40,.5,'',0,1,'L',1);
                $pdf->Cell(200,7,'',0,0,'L',0);
                $pdf->SetFont('Times','B',11);
                $pdf->Cell(40,7,$totalDosis,0,1,'L',0);
                $pdf->SetFont('Times','',11);
                $pdf->Ln(1);



            }

        }

        $pdf->Ln(15);
        $pdf->SetFont('times','B',11);
        $pdf->Cell(80,7,'',0,0,'L',0);
        $pdf->SetTextColor(0,4,162);
        $pdf->Cell(75,7,'Total Dosis Entregadas:',0,0,'L',0);
        $pdf->Cell(100,7,$total,0,0,'L',0);

	    $pdf->Output();

    }

    public function informe5(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Relacion Dosis entregadas y Vacuna Aplicada';
        
        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Relación Dosis entregadas y Vacuna Aplicada";

        include 'cabezeraLand.php';

        $pdf->SetFont('helvetica','B',10);
        $pdf->SetTextColor(0,4,162);
        $pdf->SetFillColor(0,4,162);
        $pdf->SetX(160);
        $pdf->Cell(100,7,utf8_decode('Totales'),0,1,'C',0);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(140,.2,'',0,0,'L',0);
        $pdf->Cell(110,.2,'',0,1,'L',1);
        $pdf->Ln(5);
        $pdf->SetFont('Times','B',12);
        $pdf->SetX(10);
        $pdf->Cell(40,7,'Veterinario',0,0,'L',0);
        $pdf->Cell(35,7,utf8_decode('Matrícula'),0,0,'L',0);
        $pdf->Cell(40,7,'Entrega',0,0,'L',0);
        $pdf->Cell(30,7,'Dosis',0,0,'L',0);
        $pdf->Cell(35,7,'Entregadas',0,0,'L',0);
        $pdf->Cell(35,7,'Aplicadas',0,0,'L',0);
        $pdf->Cell(35,7,'Sin Aplicar',0,1,'L',0);
        $pdf->Cell(250,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',11);
        $pdf->SetFillColor(0,0,0);

        $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios(null,null);

        $item = 'matricula';

        $item2 = 'campania';

        $campania = $_COOKIE['campania'];

        $totales = array('totalDosis'=>0,'totalVacunado'=>0);

        foreach ($veterinarios as $key => $value) {

            $distribuciones = ControladorAftosa::ctrMostrarDistribucion($item,$value['matricula'],$item2,$campania);
            
            if(!empty($distribuciones)){

                $pdf->Cell(40,7,utf8_decode($value['nombre']),0,0,'L',0);
                $pdf->Cell(35,7,$value['matricula'],0,0,'L',0);

                $first = true;
                
                $totalDosis = 0;

                foreach ($distribuciones as $key => $distribucion) {
                    
                    if($first){

                        $first = false;

                    }else{

                        $pdf->Cell(75,7,'',0,0,'L',0);

                    }
                    
                    $pdf->Cell(40,7,formatearFecha($distribucion['fechaEntrega']),0,0,'L',0);
                    $pdf->Cell(40,7,$distribucion['cantidad'],0,1,'L',0);
                
                    $totalDosis += $distribucion['cantidad'];

                    $totales['totalDosis'] += $distribucion['cantidad'];
                    
                };
                
                $pdf->Cell(145,7,'',0,0,'L',0);
                $pdf->SetFont('Times','B',11);
                $pdf->Cell(40,7,$totalDosis,0,0,'L',0);

                $tabla = 'actas';

                $campo = 'cantidadPar';

                $item = 'matricula';

                $totalVacunado = ControladorAftosa::ctrSumarDatos($tabla,$campo,$item,$value['matricula'],$item2,$campania);

                $totalVacunado = ($totalVacunado[0] != NULL) ? $totalVacunado[0] : 0;

                $totales['totalVacunado'] += $totalVacunado;

                $pdf->Cell(40,7,$totalVacunado,0,0,'L',0);
                $pdf->Cell(40,7,($totalDosis - $totalVacunado),0,1,'L',0);
                $pdf->Cell(250,.5,'',0,1,'L',1);
                $pdf->SetFont('Times','',11);
                $pdf->Ln(1);

            }

        }

        $pdf->Ln(15);
        $pdf->SetFont('times','B',11);
        $pdf->Cell(80,7,'',0,0,'L',0);
        $pdf->SetTextColor(0,4,162);
        $pdf->Cell(65,7,'Datos Finales de la relacion:',0,0,'L',0);
        $pdf->Cell(40,7,$totales['totalDosis'],0,0,'L',0);
        $pdf->Cell(40,7,$totales['totalVacunado'],0,0,'L',0);
        $pdf->Cell(40,7,($totales['totalDosis'] - $totales['totalVacunado']),0,0,'L',0);  
    
        $pdf->Output();

    }

    public function informe6(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Cant. de Establecimientos por distrito con detalle de categorías';
        
        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Cant. de Establecimientos por distrito con detalle de categorías del rodeo y total de hacienda";

        include 'cabezeraLand.php';

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Times','B',11);
        $pdf->SetX(10);
        $pdf->Cell(40,7,'Localidad',0,0,'L',0);
        $pdf->Cell(30,7,'Cant. Estable.',0,0,'L',0);
        $pdf->Cell(15,7,'Vacas',0,0,'L',0);
        $pdf->Cell(25,7,'Vaquillonas',0,0,'L',0);
        $pdf->Cell(20,7,'Terneros',0,0,'L',0);
        $pdf->Cell(20,7,'Terneras',0,0,'L',0);
        $pdf->Cell(20,7,'Novillos',0,0,'L',0);
        $pdf->Cell(25,7,'Novillitos',0,0,'L',0);
        $pdf->Cell(20,7,'Toros',0,0,'L',0);
        $pdf->Cell(25,7,'Toritos',0,0,'L',0);
        $pdf->Cell(20,7,'TOTAL',0,1,'L',0);
        $pdf->Cell(260,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',11);
        
        $distritos = ControladorProductores::ctrMostrarProductoresDistinct(null,null,'distrito');

        $item = 'distrito';

        $item2 = 'campania';

        $campania = $_COOKIE['campania'];

        $campo = 'renspa';

        $totales = array('establecimientos'=>0,'vacas'=>0,'vaquillonas'=>0,'toros'=>0,'toritos'=>0,'novillos'=>0,'novillitos'=>0,'terneros'=>0,'terneras'=>0);
        
        foreach ($distritos as $key => $value) {

            if($value[0] != NULL){
            
                $data = ControladorAnimales::ctrSumarAnimalesInnerProductor($item,$value[0],$item2,$campania,$campo);

                $nombreDistrito = ControladorProductores::ctrMostrarLocation('departamento',1,'localidad',$value[0]);

                $pdf->Cell(40,7,utf8_decode($nombreDistrito['nombre']),0,0,'L',0);
                $pdf->Cell(30,7,$data['establecimientos'],0,0,'L',0);
                $pdf->Cell(15,7,$data['vacas'],0,0,'L',0);
                $pdf->Cell(25,7,$data['vaquillonas'],0,0,'L',0);
                $pdf->Cell(20,7,$data['terneros'],0,0,'L',0);
                $pdf->Cell(20,7,$data['terneras'],0,0,'L',0);
                $pdf->Cell(20,7,$data['novillos'],0,0,'L',0);
                $pdf->Cell(25,7,$data['novillitos'],0,0,'L',0);
                $pdf->Cell(20,7,$data['toros'],0,0,'L',0);
                $pdf->Cell(25,7,$data['toritos'],0,0,'L',0);

                $pdf->Cell(20,7,($data['vacas'] + $data['vaquillonas'] + $data['terneros'] + $data['terneras'] + $data['novillos'] + $data['novillitos'] + $data['toros'] + $data['toritos']),0,1,'L',0);
                
                $pdf->Cell(255,.2,'',0,1,'L',1);

                $totales['establecimientos'] += $data['establecimientos'];
                $totales['vacas'] += $data['vacas'];
                $totales['vaquillonas'] += $data['vaquillonas'];
                $totales['terneros'] += $data['terneros'];
                $totales['terneras'] += $data['terneras'];
                $totales['novillos'] += $data['novillos'];
                $totales['novillitos'] += $data['novillitos'];
                $totales['toros'] += $data['toros'];
                $totales['toritos'] += $data['toritos'];

            }

        }

        $pdf->SetFont('helvetica','B',10);
        $pdf->SetTextColor(0,4,162);
        $pdf->Cell(40,7,'TOTALES',0,0,'L',0);
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(30,7,$totales['establecimientos'],0,0,'L',0);
        $pdf->Cell(15,7,$totales['vacas'],0,0,'L',0);
        $pdf->Cell(25,7,$totales['vaquillonas'],0,0,'L',0);
        $pdf->Cell(20,7,$totales['terneros'],0,0,'L',0);
        $pdf->Cell(20,7,$totales['terneras'],0,0,'L',0);
        $pdf->Cell(20,7,$totales['novillos'],0,0,'L',0);
        $pdf->Cell(25,7,$totales['novillitos'],0,0,'L',0);
        $pdf->Cell(20,7,$totales['toros'],0,0,'L',0);
        $pdf->Cell(25,7,$totales['toritos'],0,0,'L',0);

        $totalAnimales = ($totales['vacas']+$totales['vaquillonas']+$totales['terneros']+$totales['terneras']+$totales['novillos']+$totales['novillitos']+$totales['toros']+$totales['toritos']);

        $pdf->Cell(25,7,$totalAnimales,0,1,'L',0);

    	$pdf->Output();


    }

    public function informe7(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Nomina de Vacunadores ordenada Alfabeticamente';
        
        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Nómina de Vacunadores ordenada Alfabéticamente";

        include 'cabezera.php';
        
        $pdf->SetFont('Times','B',12);
        $pdf->SetX(10);
        $pdf->Cell(60,7,'Nombre',0,0,'L',0);
        $pdf->Cell(25,7,'Matricula',0,0,'L',0);
        $pdf->Cell(20,7,'Tipo',0,0,'L',0);
        $pdf->Cell(50,7,'Domicilio',0,0,'L',0);
        $pdf->Cell(30,7,'Telefono',0,1,'L',0);
        $pdf->Cell(185,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',10);
        $pdf->SetFillColor(0,0,0);

        $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios(null,null);

        foreach ($veterinarios as $key => $veterinario) {

            $pdf->Cell(60,7,utf8_decode($veterinario['nombre']),0,0,'L',0);
            $pdf->Cell(25,7,$veterinario['matricula'],0,0,'L',0);
            $pdf->Cell(20,7,$veterinario['tipo'],0,0,'L',0);
            $pdf->Cell(50,7,utf8_decode($veterinario['domicilio']),0,0,'L',0);
            $pdf->Cell(30,7,$veterinario['telefono'],0,1,'L',0);	

        }

        $pdf->Output();

    
    }

    public function informe8(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Detalle por Distrito de los Propietarios y Categorizacion de su Rodeo-Otras Especies';
        
        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Detalle por Distrito de los Propietarios y Categorización de su Rodeo-Otras Especies";

        include 'cabezeraLand.php';
        
        $pdf->SetFont('Times','B',12);
        $pdf->SetX(10);
        $pdf->Cell(40,7,'Distrito',0,0,'L',0);
        $pdf->Cell(60,7,'Propietario',0,0,'L',0);
        $pdf->Cell(65,7,'Establecimiento',0,0,'L',0);
        $pdf->Cell(30,7,'Explo.',0,0,'L',0);
        $pdf->Cell(20,7,'Caprinos',0,0,'L',0);
        $pdf->Cell(20,7,'Ovinos',0,0,'L',0);
        $pdf->Cell(20,7,'Porcinos',0,0,'L',0);
        $pdf->Cell(20,7,'Equinos',0,1,'L',0);
        $pdf->Cell(275,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',10);
        $pdf->SetFillColor(0,0,0);

        $distritos = ControladorProductores::ctrMostrarProductoresDistinct(null,null,'distrito');

        $item = 'distrito';

        $item2 = 'campania';

        $campania = $_COOKIE['campania'];

        $campo = 'renspa';

        $totalesFinal = array('establecimientos'=>0,'caprinos'=>0,'ovinos'=>0,'porcinos'=>0,'equinos'=>0);
        
        foreach ($distritos as $key => $value) {
            
            $totales = array('establecimientos'=>0,'caprinos'=>0,'ovinos'=>0,'porcinos'=>0,'equinos'=>0);
            
            if($value[0] != NULL){
                
                $nombreDistrito = ControladorProductores::ctrMostrarLocation('departamento',1,'localidad',$value[0]);
 
                $productoresPorDistrito = ControladorProductores::ctrMostrarProductores('distrito',$value[0]);

                $first = true;

                foreach ($productoresPorDistrito as $key => $productor) {
                    
                    $item = 'renspa';

                    $valor = $productor['renspa'];

                    $animales = ControladorAnimales::ctrMostrarAnimales($item,$valor,$item2,$campania);

                    $datosValidos = ($animales['caprinos'] != 0 OR $animales['ovinos'] != 0 OR $animales['porcinos'] != 0 OR $animales['equinos']) ? true : false;

                    if(!empty($animales)){
                        
                        if($datosValidos){

                            if($first){
                                               
                                $pdf->Cell(275,.2,'',0,1,'L',1);	
                                $pdf->Cell(40,7,utf8_decode($nombreDistrito['nombre']),0,0,'L',0);
                                $first = false;

                            }else{

                                $pdf->Cell(40,7,'',0,0,'L',0);

                            }
                            
                            $pdf->Cell(60,7,utf8_decode($productor['propietario']),0,0,'L', 0);
                            $pdf->Cell(65,7,$productor['establecimiento'],0,0,'L',0);
                            $pdf->Cell(30,7,utf8_decode($productor['explotacion']),0,0,'L',0);
                            $pdf->Cell(20,7,$animales['caprinos'],0,0,'C',0);
                            $pdf->Cell(20,7,$animales['ovinos'],0,0,'C',0);
                            $pdf->Cell(20,7,$animales['porcinos'],0,0,'C',0);
                            $pdf->Cell(20,7,$animales['equinos'],0,1,'C',0);
                            $pdf->Cell(40,7,'',0,0,'L',0);
                            $pdf->Cell(20,7,$productor['renspa'],0,1,'L',0);

                            $totales['caprinos'] += $animales['caprinos'];
                            $totales['ovinos'] += $animales['ovinos']; 
                            $totales['porcinos'] += $animales['porcinos'];
                            $totales['equinos'] += $animales['equinos'];
                            $totales['establecimientos']++;
                        
                        }
                    
                    }
                    
    
                    if($datosValidos){
                        
                        $pdf->Cell(100,7,'',0,0,'L',0);
                        $pdf->SetFillColor(0,4,162);
                        $pdf->Cell(175  ,.2,'',0,1,'L',1);	
                        $pdf->SetFillColor(0,0,0);
                        $pdf->Cell(100,7,'',0,0,'L',0);	
                        $pdf->SetFont('Times','b',10);
                        $pdf->SetTextColor(0,4,162);
                        $pdf->Cell(65,7,'Total por Localidad:',0,0,'L',0);
                        $pdf->Cell(30,7,'Cant. Est.: '.$totales['establecimientos'],0,0,'L',0);
                        $pdf->Cell(20,7,$totales['caprinos'],0,0,'C',0);
                        $pdf->Cell(20,7,$totales['ovinos'],0,0,'C',0);
                        $pdf->Cell(20,7,$totales['porcinos'],0,0,'C',0);
                        $pdf->Cell(20,7,$totales['equinos'],0,1,'C',0);
                        $pdf->SetTextColor(0,0,0);
                        $pdf->SetFont('Times','',10);
                        $pdf->SetFillColor(0,0,0);
                        $pdf->Ln(5);
    
                        $totalesFinal['establecimientos'] += $totales['establecimientos'];
                        $totalesFinal['caprinos'] += $totales['caprinos'];
                        $totalesFinal['ovinos'] += $totales['ovinos'];
                        $totalesFinal['porcinos'] += $totales['porcinos'];
                        $totalesFinal['equinos'] += $totales['equinos'];
    
                    }

                }

            }

        }

        $pdf->Ln(2);
        $pdf->SetFillColor(0,0,0);
        $pdf->Cell(275,.2,'',0,1,'L',1);	
        $pdf->Ln(2);
        $pdf->SetFillColor(0,4,162);
        $pdf->Cell(100,7,'',0,0,'L',0);	
        $pdf->Cell(175,.2,'',0,1,'L',1);	
        $pdf->SetFillColor(0,0,0);
        $pdf->Cell(100,7,'',0,0,'L',0);	
        $pdf->SetFont('Times','b',10);
        $pdf->SetTextColor(0,4,162);
        $pdf->Cell(65,7,'Total por Departamento:',0,0,'L',0);
        $pdf->Cell(30,7,'Cant. Est.: '.$totalesFinal['establecimientos'],0,0,'L',0);
        $pdf->Cell(20,7,$totalesFinal['caprinos'],0,0,'C',0);
        $pdf->Cell(20,7,$totalesFinal['ovinos'],0,0,'C',0);
        $pdf->Cell(20,7,$totalesFinal['porcinos'],0,0,'C',0);
        $pdf->Cell(20,7,$totalesFinal['equinos'],0,1,'C',0);	
        $pdf->Ln(5);

        $pdf->Cell(128,7,'',0,0,'L',0);	
        $pdf->Cell(58,7,'Cantidad de Establecimientos:',0,0,'R',0);
        $pdf->Cell(9,7,'',0,0,'R',0);

        $item = 'caprinos';
        
        $valor = 0;
        
        $establecimientosCaprinos = ControladorAnimales::ctrContarProductorSegunAnimales($item,$valor,$item2,$campania);
        
        $item = 'ovinos';
        
        $establecimientosOvinos = ControladorAnimales::ctrContarProductorSegunAnimales($item,$valor,$item2,$campania);
        
        $item = 'porcinos';
        
        $establecimientosPorcinos = ControladorAnimales::ctrContarProductorSegunAnimales($item,$valor,$item2,$campania);
        
        $item = 'equinos';
        
        $establecimientosEquinos = ControladorAnimales::ctrContarProductorSegunAnimales($item,$valor,$item2,$campania);

        $pdf->Cell(20,7,$establecimientosCaprinos['total'],0,0,'C',0);
        $pdf->Cell(20,7,$establecimientosOvinos['total'],0,0,'C',0);
        $pdf->Cell(20,7,$establecimientosPorcinos['total'],0,0,'C',0);
        $pdf->Cell(20,7,$establecimientosEquinos['total'],0,1,'C',0);

        $pdf->Output();
    
    }

    public function informe9(){

                
        function numberOfWeek ($date) {

            $timestamp = strtotime($date); 

            $newDate = date("Y-n-j", $timestamp );

            $fechaExplode = explode('-',$newDate);

            $fecha = mktime ($hora, $min, $seg, $fechaExplode[1], 1, $fechaExplode[0]);

            $numberOfWeek = ceil ((($fechaExplode[2] + (date («w», $fecha)))) / 7);

            return $numberOfWeek;

        }

        $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = utf8_decode('Evolucion semanal de la Campaña de Vacunacion Anti-Aftosa');
                
        $campania = $_COOKIE['campania'];

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Evolución semanal de la Campaña de Vacunación Anti-Aftosa - Campaña N° $campania";

        include 'cabezera.php';
       
        $pdf->SetFont('Times','B',12);
        $pdf->SetX(10);
        $pdf->Cell(30,7,'Mes',0,0,'L',0);
        $pdf->Cell(30,7,'Semana',0,0,'L',0);
        $pdf->Cell(45,7,"Cant. de Actas de Vac.",0,0,'L',0);
        $pdf->Cell(50,7,'Animales Vacunados',0,1,'L',0);
        $pdf->Cell(185,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',10);
        $pdf->SetFillColor(0,0,0);

        $dataActas = ControladorActas::ctrMostrarActa(null,null);

        $dataMensualSemanal = array();

        $totales = array('actas'=> 0 ,'animales'=> 0);

        foreach ($dataActas as $key => $acta) {
            
            $date = $acta['fechaVacunacion'];

            $weekNumber = numberOfWeek($date);

            setlocale(LC_TIME, "spanish");

            $month = ucfirst(strftime("%m", strtotime($date)));

            $dataMensualSemanal[$month][$weekNumber]['actas'] += 1;
            $dataMensualSemanal[$month][$weekNumber]['animales'] += $acta['cantidadPar'];

        }

        
        foreach($dataMensualSemanal as $mes => $value){
            
            $mesLabel = $meses[$mes - 1];

            $pdf->Cell(35,7,$mesLabel,0,0,'L',0);
            
            $rowValida = true;
            
            foreach ($value as $semana => $data) {
                  
                if($rowValida){

                    $rowValida = false;

                }else{
                    
                    $pdf->Cell(35,7,'',0,0,'L',0);		

                }
                
				$pdf->Cell(40,7,$semana,0,0,'L',0);		
                $pdf->Cell(45,7,$data['actas'],0,0,'L',0);
                $pdf->Cell(50,7,$data['animales'],0,1,'L',0);

                $totales['actas'] += $data['actas'];
                $totales['animales'] += $data['animales'];


            }

        }

        $pdf->SetFillColor(0,4,162);
        $pdf->SetTextColor(0,4,162);
        $pdf->SetFont('helvetica','B',11);
        $pdf->Cell(185,.5,'',0,1,'L',1);
        $pdf->Cell(35,7,"TOTALES",0,0,'L',0);
        $pdf->Cell(40,7,"",0,0,'L',0);		
        $pdf->Cell(45,7,$totales['actas'],0,0,'L',0);
        $pdf->Cell(50,7,$totales['animales'],0,1,'L',0);

        $pdf->Output();

    }

    public function informe10(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $campania = $_COOKIE['campania'];

        $titulo = utf8_decode("Montos de Campaña N° $campania");                

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Montos de Campaña N° $campania";

        include 'cabezera.php';
       
        $pdf->SetFont('Times','B',12);
        $pdf->SetX(10);
        $pdf->Cell(190,.5,'',0,1,'L',1);
        $pdf->SetFont('helvetica','',11);
        $pdf->SetFillColor(0,0,0);
        $pdf->Ln(1);

        $item = 'campania';
        
        $dataMontos = ControladorActas::ctrSumarMontos($item,$campania);
        
        $item = 'numero';

        $montosCampania = ControladorAftosa::ctrMostrarDatosCampania($item,$campania);

        $pdf->Cell(65,7,utf8_decode('Administración A.B.S.A Aftosa:'),0,0,'R',0);
        $pdf->Cell(25,7,"$ ".number_format($dataMontos['admAf'], 2, ",", ".")	,0,1,'L',0);
        $pdf->Cell(65,7,'Vacunadores Aftosa:',0,0,'R',0);
        $pdf->Cell(20,7,"$ ".number_format($dataMontos['vacunadorAf'], 2, ",", ".")	,0,1,'L',0);
        $pdf->Cell(65,7,'Vacunas Aftosa:',0,0,'R',0);
        $pdf->Cell(50,7,"$ ".number_format($dataMontos['vacunaAf'], 2, ",", ".")	,0,1,'L',0);
        $pdf->Cell(65,7,'Redondeo Aftosa:',0,0,'R',0);
        $pdf->Cell(60,7,utf8_decode("$ ".number_format(($dataMontos['redondeoAf'] * $montosCampania['vacunaA']), 2, ",", ".")),0,1,'L',0);
        $pdf->Cell(65,7,utf8_decode('Administración A.B.S.A Carbunclo:'),0,0,'R',0);
        $pdf->Cell(30,7,"$ ".number_format($dataMontos['admCar'], 2, ",", ".")	,0,1,'L',0);	
        $pdf->Cell(65,7,'Vacunadores Carbunclo:',0,0,'R',0);
        $pdf->Cell(30,7,"$ ".number_format($dataMontos['vacunadorCar'], 2, ",", ".")	,0,1,'L',0);
        $pdf->Cell(65,7,'Vacunas Carbunclo:',0,0,'R',0);
        $pdf->Cell(60,7,utf8_decode("$ ".number_format($dataMontos['vacunaCar'], 2, ",", ".")),0,1,'L',0);
        $pdf->Cell(65,7,'Redondeo Carbunclo:',0,0,'R',0);
        $pdf->Cell(60,7,utf8_decode("$ ".number_format(($dataMontos['redondeoCar'] * $montosCampania['vacunaC']), 2, ",", ".")),0,1,'L',0);


        $pdf->Output();

    }

    public function informe11(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $campania = $_COOKIE['campania'];

        $titulo = utf8_decode("Cantidad de Animales y establecimientos Vacunados");                

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Cantidad de Animales y establecimientos Vacunados";

        include 'cabezera.php';
      
        $pdf->SetFont('Times','B',14);
        $pdf->SetX(10);
        $pdf->Cell(40,7,'Vacunador',0,0,'L',0);
        $pdf->Cell(40,7,'Renspa',0,0,'L',0);
        $pdf->Cell(55,7,'Cant. Animales Carbunclo',0,0,'L',0);
        $pdf->Cell(50,7,'Cant. Animales Bruce.',0,1,'L',0);
        $pdf->Cell(190,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',11);

        
        $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios(null,null);

        $item = 'matricula';

        $totales = array('carbunclo'=>0,'brucelosis'=>0,'establecimientosCar'=>0,'establecimientosBruce');
        foreach ($veterinarios as $key => $veterinario) {

            $actasPorVet = ControladorActas::ctrMostrarActa($item,$veterinario['matricula']);

            $registroValido = (!empty($actasPorVet)) ? true : false;

            if($registroValido){

                $pdf->SetFillColor(0,0,0);
				$pdf->Cell(190,.1,'',0,1,'L',1);
				$pdf->SetFillColor(0,4,162);
				$pdf->Cell(40,7,utf8_decode($veterinario['nombre']),0,0,'L',0);

                $first = true;

                foreach ($actasPorVet as $key => $acta) {

                    if($first){

                        $first = false;

                    }else{

                        $pdf->Cell(40,7,'',0,0,'L',0);

                    }
                            
                    $pdf->Cell(40,7,$acta['renspa'],0,0,'L',0);
                    $pdf->Cell(55,7,$acta['cantidadCar'],0,0,'C',0);
                    $pdf->Cell(50,7,$acta['cantidadBruce'],0,1,'C',0);

                    if($acta['cantidadCar'] != 0){

                        $totales['carbunclo'] += $acta['cantidadCar'];
                        $totales['establecimientosCar']++;
                        
                    }
                    
                    if($acta['cantidadBruce'] != 0){
                        
                        $totales['brucelosis'] += $acta['cantidadBruce'];
                        $totales['establecimientosBruce']++;

                    }

                }

            }

        }

        $pdf->Cell(190,.5,'',0,1,'L',1);
        $pdf->Cell(60,7,'',0,0,'L',0);
        $pdf->Cell(20,7,'Totales:',0,0,'L',0);
        $pdf->Cell(55,7,$totales['carbunclo'],0,0,'C',0);
        $pdf->Cell(50,7,$totales['brucelosis'],0,1,'C',0);
        $pdf->Ln(5);
        $pdf->SetTextColor(0,4,162);
        $pdf->Cell(75,7,'Total Establecimientos Vacunados Carbunclo:',0,0,'L',0);
        $pdf->Cell(100,7,$totales['establecimientosCar'],0,1,'L',0);
        $pdf->Cell(75,7,'Total Establecimientos Vacunados Brucelosis:',0,0,'L',0);
        $pdf->Cell(100,7,$totales['establecimientosBruce'],0,1,'L',0);

        $pdf->Output();

    }

    public function informe12(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $campania = $_COOKIE['campania'];

        $titulo = utf8_decode("Establecimientos NO Vacunados");                

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Establecimientos NO Vacunados";

        include 'cabezera.php';
      
        $pdf->SetFont('Times','B',14);
        $pdf->SetX(10);
        $pdf->Cell(35,7,'Vacunador',0,0,'L',0);
        $pdf->Cell(40,7,'Renspa',0,0,'L',0);
        $pdf->Cell(50,7,'Establecimiento',0,0,'L',0);
        $pdf->Cell(30,7,'Carbunclo',0,0,'L',0);
        $pdf->Cell(30,7,'Brucelosis',0,1,'L',0);
        $pdf->Cell(190,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',11);
        
        $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios(null,null);

        $item = 'matricula';

        $totales = array('carbunclo'=>0,'brucelosis'=>0);

        foreach ($veterinarios as $key => $veterinario) {

            $actasPorVet = ControladorActas::ctrMostrarActa($item,$veterinario['matricula']);

            $registroValido = (!empty($actasPorVet)) ? true : false;

            if($registroValido){

                $pdf->SetFillColor(0,0,0);
				$pdf->Cell(190,.1,'',0,1,'L',1);
				$pdf->SetFillColor(0,4,162);
				$pdf->Cell(35,7,utf8_decode($veterinario['nombre']),0,0,'L',0);

                $first = true;

                foreach ($actasPorVet as $key => $acta) {

                    if($first){

                        $first = false;

                    }else{

                        $pdf->Cell(35,7,'',0,0,'L',0);

                    }
                    $pdf->Cell(40,7,$acta['renspa'],0,0,'L',0);

                    $item = 'renspa';

                    $dataProducto = ControladorProductores::ctrMostrarProductores($item,$acta['renspa']);

                    $pdf->Cell(45,7,$dataProducto['establecimiento'],0,0,'L',0);
                    
                    if($acta['cantidadCar'] == 0){

                        $pdf->Cell(30,7,'NO',0,0,'C',0);
                        
                        $totales['carbunclo'] ++;
                        
                    }else{
                        
                        $pdf->Cell(30,7,'SI',0,0,'C',0);

                    }
                    
                    if($acta['cantidadBruce'] == 0){

                        $pdf->Cell(35,7,'NO',0,1,'C',0);
                        
                        $totales['brucelosis'] ++;
                        
                    }else{
                        
                        $pdf->Cell(35,7,'SI',0,1,'C',0);

                    }

                }

            }

        }

        $pdf->Cell(190,.5,'',0,1,'L',1);
        $pdf->Ln(5);
        $pdf->SetTextColor(0,4,162);
        $pdf->Cell(85,7,'Total Establecimientos NO Vacunados Carbunclo:',0,0,'L',0);
        $pdf->Cell(100,7,$totales['carbunclo'],0,1,'L',0);
        $pdf->Cell(85,7,'Total Establecimientos NO Vacunados Brucelosis:',0,0,'L',0);
        $pdf->Cell(100,7,$totales['brucelosis'],0,1,'L',0);
        $pdf->SetTextColor(0,0,0);

        $pdf->Output();

    }

    public function informe13(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------
        $campania = $_COOKIE['campania'];

        $titulo = utf8_decode("Cant. Est. Segun Sist. Productivo");                

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Cantidad de Establecimientos segun Sistema Productivo";

        include 'cabezera.php';

        $pdf->SetX(5);
        $pdf->Cell(45,8,'Sist. Productivo',0,0,'C',0);
        $pdf->Cell(98,8,'Establecimiento',0,0,'L',0);
        $pdf->Cell(30,8,'R.E.N.S.P.A',0,0,'L',0);
        $pdf->Cell(20,8,'Animales',0,1,'L',0);
        $pdf->SetX(15);
        $pdf->Cell(185,0.01,'',1,1,'C',0);
        $pdf->SetFont('Times','',10);
      
        $tiposExplotacion = ControladorProductores::ctrMostrarProductoresDistinct(null,null,'explotacion');
        $translate = array('CrÃ­a '=>'Cria','CrÃ­a/Invernada'=>'Cria/Invernada','CabaÃ±a'=>'Cabaña','Feedlot'=>'Feedlot','Tambo'=>'Tambo','Invernada'=>'Invernada','U.P Feed-Lot'=>'U.P Feed-Lot');        
        foreach ($tiposExplotacion as $key => $value) {
            
            if($value[0] != null OR $value[0] != ''){

                $cantEstablecimientos = 0;

                $item = 'explotacion';

                $productoresPorExplotacion = ControladorProductores::ctrMostrarProductores($item,$value[0]);
                
                $pdf->SetFont('helvetica','B',12);
                $pdf->SetX(15);
                $pdf->Cell(185,.1,'',1,1,'L',0);
                $pdf->SetX(15);

                $pdf->Cell(35,8,utf8_decode($translate[$value[0]]),0,0,'L',0);
                $pdf->SetFont('helvetica','B',8);
                
                $first = true;
                
                foreach ($productoresPorExplotacion as $index => $productor) {
                    
                    if($first){
                        
                        $first = false;
                        
                    }else{
                        
                        $pdf->Cell(40,8,'',0,0,'L',0);

                    }

                    $pdf->Cell(98,6,$productor['establecimiento']." de ".$productor['propietario'],0,0,'L',0);
                    $pdf->Cell(30,6,$productor['renspa'],0,0,'L',0);
                    
                    $item = 'renspa';

                    $actaProductor = ControladorActas::ctrMostrarActa(null,null,$item,$productor['renspa']);
                    
                    $animales = (!empty($actaProductor)) ? $actaProductor['cantidadPar'] : 0 ;

                    $pdf->Cell(20,6,$animales,0,1,'C',0);

                    $cantEstablecimientos++;

                }

                $pdf->SetFont('helvetica','B',10);
                $pdf->SetX(15);
                $pdf->Cell(40,8,'Total Establecimientos: ',0,0,'L',0);
                $pdf->SetFont('helvetica','B',9);
                $pdf->Cell(40,8,$cantEstablecimientos,0,1,'L',0);

            }

        }

        $pdf->Output();

    }

    public function informe14(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $campania = $_COOKIE['campania'];

        $titulo = utf8_decode("Cant. Animales Segun Sist. Productivo");                

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Cantidad de Animales segun Sistema Productivo";

        include 'cabezera.php';

        $translate = array('CrÃ­a '=>'Cria','CrÃ­a/Invernada'=>'Cria/Invernada','CabaÃ±a'=>'Cabaña','Feedlot'=>'Feedlot','Tambo'=>'Tambo','Invernada'=>'Invernada','U.P Feed-Lot'=>'U.P Feed-Lot');   

        $pdf->SetFont('Times','B',14);
        $pdf->Ln(3);
        $pdf->SetX(40);
        $pdf->Cell(45,8,'Sist. Productivo',1,0,'C',0);
        $pdf->Cell(65,8,'Cant. Animales',1,1,'C',0);
        $pdf->SetFont('Times','',10);
      
        $tiposExplotacion = ControladorProductores::ctrMostrarProductoresDistinct(null,null,'explotacion');

        foreach ($tiposExplotacion as $key => $value) {
            
            if($value[0] != null OR $value[0] != ''){

                $campo = 'renspa';
        
                $item = 'explotacion';

                $valor = $value[0];
        
                $item2 = 'campania';
        
                $campania = $_COOKIE['campania'];
        
                $animales = ControladorAnimales::ctrSumarAnimalesInnerProductor($item,$valor,$item2,$campania,$campo);

                $totalAnimales = (array_sum($animales) - ($animales['establecimientos'] * 2));
            
                $pdf->SetX(50);
                $pdf->Cell(40,8,$translate[$value[0]],0,0,'L',0);
                // var_dump($tras)
                $pdf->Cell(65,8,$totalAnimales,0,1,'C',0);

            }

        }
        
        $pdf->Output();

    }

    public function informe15(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $campania = $_COOKIE['campania'];

        $titulo = utf8_decode("Cronograma por Veterinario");                

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Cronograma por Veterinario";

        include 'cabezeraLand.php';
        
        $matricula = $this->matricula;

        $item = 'matricula';

        $veterinario = ControladorVeterinarios::ctrMostrarVeterinarios($item,$matricula);

        $pdf->Ln(3);
        $pdf->Cell(40,7,'Vacunador:',0,0,'L',0);
        $pdf->Cell(40,7,utf8_decode($veterinario['nombre']),0,1,'L',0);
        $pdf->Ln(3);
        $pdf->SetFont('Times','B',11);
        $pdf->SetX(10);
        $pdf->Cell(40,7,utf8_decode('Fecha de Vacunación'),0,0,'L',0);
        $pdf->Cell(40,7,'Renspa',0,0,'L',0);
        $pdf->Cell(80,7,'Nombre/Apellido',0,0,'L',0);
        $pdf->Cell(25,7,'Parcial',0,0,'L',0);
        $pdf->Cell(25,7,'Total',0,0,'L',0);
        $pdf->Cell(25,7,'Fecha Vencimiento',0,1,'L',0);
        $pdf->Cell(278,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',11);

        $item = 'veterinario';

        $productoresSegunVet = ControladorProductores::ctrMostrarProductores($item,$matricula);

        $totales = array('total'=>0,'parcial'=>0);
        
        foreach ($productoresSegunVet as $key => $productor) {
        
            $item = 'renspa';

            $actasAnimales = ControladorActas::ctrMostrarActasAnimales($item,$productor['renspa']);

            if(!empty($actasAnimales)){
                
                $parcial = $actasAnimales['terneros'] + $actasAnimales['terneras'] + $actasAnimales['novillos'] + $actasAnimales['novillitos'] + $actasAnimales['toritos'] + $actasAnimales['vaquillonas'];

                $totalAnimales = $parcial + $actasAnimales['vacas'] + $actasAnimales['toros'];

                $fechaVencimiento = date("d/m/Y",strtotime($actasAnimales['fechaVacunacion']."+ 180 days"));

                $pdf->Cell(40,7,formatearFecha($actasAnimales['fechaVacunacion']),0,0,'L',0);
                $pdf->Cell(40,7,$productor['renspa'],0,0,'L',0);
                $pdf->Cell(80,7,$productor['propietario'],0,0,'L',0);
                $pdf->Cell(25,7,$parcial,0,0,'L',0);
                $pdf->Cell(25,7,$totalAnimales,0,0,'L',0);
                $pdf->Cell(25,7,$fechaVencimiento,0,1,'L',0);

                $totales['total'] += $totalAnimales;
                $totales['parcial'] += $parcial;

            }

        }


        $pdf->SetFillColor(100,100,255);
        $pdf->Cell(278,.01,'',0,1,'',1);
        $pdf->Cell(40);
        $pdf->Cell(40);
        $pdf->Cell(80,7,'Totales:',0,0,'R',0);
        $pdf->Cell(25,7,$totales['parcial'],0,0,'L',0);
        $pdf->Cell(25,7,$totales['total'] ,0,0,'L',0);
        $pdf->Cell(25);

        if(isset($this->mail)){
            
            $pdf->Output('F', '../../vistas/modulos/aftosa/informes/cronograma.pdf');

        }else{

            $pdf->Output();

        }

    }

    public function informe16(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $campania = $_COOKIE['campania'];

        $titulo = utf8_decode("Cronograma Actual por Veterinario");                

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Cronograma Actual por Veterinario";

        include 'cabezeraLand.php';
        
        $matricula = $this->matricula;

        $item = 'matricula';

        $veterinario = ControladorVeterinarios::ctrMostrarVeterinarios($item,$matricula);

        $pdf->Ln(3);
        $pdf->Cell(40,7,'Vacunador:',0,0,'L',0);
        $pdf->Cell(40,7,utf8_decode($veterinario['nombre']),0,1,'L',0);
        $pdf->Ln(3);
        $pdf->SetFont('Times','B',11);
        $pdf->SetX(10);
        $pdf->Cell(40,7,'Renspa',0,0,'L',0);
        $pdf->Cell(80,7,'Nombre/Apellido',0,0,'L',0);
        $pdf->Cell(25,7,'Parcial',0,0,'L',0);
        $pdf->Cell(25,7,'Total',0,1,'L',0);
        $pdf->Cell(278,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',11);

        $item = 'veterinario';

        $productoresSegunVet = ControladorProductores::ctrMostrarProductores($item,$matricula);

        $totales = array('total'=>0,'parcial'=>0);

        foreach ($productoresSegunVet as $key => $productor) {
        
            $item = 'renspa';

            $item2 = 'campania';

            $campania = $_COOKIE['campania'];

            $animales = ControladorAnimales::ctrMostrarAnimales($item,$productor['renspa'],$item2,$campania);
                
            $parcial = $animales['terneros'] + $animales['terneras'] + $animales['novillos'] + $animales['novillitos'] + $animales['toritos'] + $animales['vaquillonas'];

            $totalAnimales = $parcial + $animales['vacas'] + $animales['toros'];

            $pdf->Cell(40,7,$productor['renspa'],0,0,'L',0);
            $pdf->Cell(80,7,$productor['propietario'],0,0,'L',0);
            $pdf->Cell(25,7,$parcial,0,0,'L',0);
            $pdf->Cell(25,7,$totalAnimales,0,1,'L',0);

            $totales['total'] += $totalAnimales;
            $totales['parcial'] += $parcial;

        }

        $pdf->SetFillColor(100,100,255);
        $pdf->Cell(278,.01,'',0,1,'',1);
        $pdf->Cell(40);
        $pdf->Cell(80,7,'Totales:',0,0,'R',0);
        $pdf->Cell(25,7,$totales['parcial'],0,0,'L',0);
        $pdf->Cell(25,7,$totales['total'] ,0,0,'L',0);
        $pdf->Cell(25);

        if(isset($this->mail)){
            
            $pdf->Output('F', '../../vistas/modulos/aftosa/informes/cronograma.pdf');

        }else{

            $pdf->Output();

        }

    }

}


if($informe){

    $informeGeneral = new informePDF();

    if($informe == 'informe3' OR $informe == 'informe15' OR $informe == 'informe16')
        $informeGeneral->matricula = $_GET['matricula'];
        
    if(isset($_GET['mail']))
            $informeGeneral->mail = $_GET['mail'];

    $informeGeneral -> $informe();

}

$mail = (isset($_POST['mail'])) ? true : false;

if($mail){

    $informeGeneral = new informePDF();
    $informeGeneral->matricula = $_POST['matricula'];
    $informeGeneral->mail = $_POST['mail'];

    $informe = $_POST['informe'];

    $informeGeneral -> $informe();

    echo json_encode("ok");

}



?>