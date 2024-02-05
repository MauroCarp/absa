<?php

require_once "../../controladores/brucelosis.controlador.php";
require_once " ../../../../modelos/brucelosis.modelo.php";
require_once "../../controladores/tuberculosis.controlador.php";
require_once " ../../../../modelos/tuberculosis.modelo.php";
require_once "../../controladores/veterinarios.controlador.php";
require_once " ../../../../modelos/veterinarios.modelo.php";
require_once "../../controladores/productores.controlador.php";
require_once " ../../../../modelos/productores.modelo.php";

function formatearFecha($fecha){

    $fechaExplode = explode('-',$fecha);
  
    $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];
  
    return $fechaFormateada;
  }

$accion = $_GET['accion'];

class GenerarPDF{

  public $rango;

  public $renspa;

  public function informeGeneral(){

    //REQUERIMOS LA CLASE TCPDF

    include('fpdf.php');

    $rango = $this->rango;

    $rangoExp = explode('/',$rango);

    $fechaDesde = formatearFecha($rangoExp[0]);

    $fechaHasta = formatearFecha($rangoExp[1]);

    // ---------------------------------------------------------

    /*BRUCELOSIS*/

    // CANTIDAD DE ESTABLECIMIENTOS
    $item = 'estado';

    $valor = 'DOES Total';

    $valor2 = null;

    $item2 = 'fechaEstado';

    $cantEstDOEStotal = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = 'DOES Parcial';

    $cantEstDOESParcial = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = 'MuVe';

    $cantEstMuve = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = 'SAN';

    $cantEstSAN = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = 'CSM';

    $cantEstCSM = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = 'Control Interno';

    $cantEstConInt = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = 'Remuestreo';

    $cantEstRemuestreo = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = '0';

    $item = 'positivo';

    $cantEstPositivos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,null);

    $item = 'negativo';

    $cantEstNegativos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,null);

    $item = 'sospechoso';

    $cantEstSospechosos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,null);

    // // CANTIDAD DE ANIMALES

    $item = 'positivo';

    $cantAnimalesPositivos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,'sumar');

    $cantAnimalesPositivos = ($cantAnimalesPositivos == null) ? 0 : $cantAnimalesPositivos;
    
    $item = 'negativo';
    
    $cantAnimalesNegativos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,'sumar');
    
    $cantAnimalesNegativos = ($cantAnimalesNegativos == null) ? 0 : $cantAnimalesNegativos;
    
    $item = 'sospechoso';
    
    $cantAnimalesSospechosos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,'sumar');
    
    $cantAnimalesSospechosos = ($cantAnimalesSospechosos == null) ? 0 : $cantAnimalesSospechosos;
   
    $item = 'estado';

    $valor = 'DOES Total';

    $valor2 = null;

    $item2 = 'fechaEstado';

    $cantAnimalesDOESTotal = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    $valor = 'DOES Parcial';

    $cantAnimalesDOESParcial = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    $valor = 'MuVe';

    $cantAnimalesMuVe = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    $valor = 'SAN';

    $cantAnimalesSAN = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    $valor = 'CSM';

    $cantAnimalesCSM = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    $valor = 'Control Interno';

    $cantAnimalesContInt = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    $valor = 'Remuestreo';

    $cantAnimalesRemuestreo = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    // // CANTIDAD DE ESTABLECIMIENTOS LIBRES
    $valor = 'DOES Total';

    $valor2 = 'MuVe';

    $cantUPLibres = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango);

    $item2 = 'fechaCarga';

    $cantUPLibresCargadas = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango);

    // // CANTIDAD DE ANIMALES LIBRES

    $cantAnimalesLibres = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);


    // /*TUBERCULOSIS*/

    $item = 'estado';

    $valor = 'No Libre';

    $operador = '!=';
    
    $item2 = 'fechaEstado';
    
    $cantAnimalesTuberculinizados = ControladorTuberculosis::ctrSumarRegistros($item,$valor,$operador,$item2,$rango);
        
    $valor = 'Libre';
    
    $valor2 = null;
    
    $item2 = 'fechaEstado';
    
    $operador = '=';

    $cantAnimalesLibresTuberculinizados = ControladorTuberculosis::ctrSumarRegistros($item,$valor,$operador,$item2,$rango);

    // CONTAR ESTABLECIMIENTOS LIBRES

    $valor = 'Libre';

    $valor2 = 'RecertificaciÃ³n';

    $cantEstLibres = ControladorTuberculosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango);

    $item2 = 'fechaCarga';

    $cantEstLibresCargados = ControladorTuberculosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango);

    $titulo = 'Informe Entes Brucelosis-Tuberculosis';

    $cabezera = 'Informe Entes Brucelosis-Tuberculosis';

    include 'cabezera.php';

    $pdf->Cell(200,7,'Periodo: '.date("d-m-Y", strtotime($fechaDesde)). ' al '.date("d-m-Y", strtotime($fechaHasta)),0,0,'C',0);

    $pdf->SetFont('helvetica','B',12);
    /*AGREGAR PERIODO*/
    $pdf->Ln(22);
    $pdf->SetX(10);
    $pdf->Cell(190,0.1,'',0,1,'',1);
    $pdf->Ln(5);
    $pdf->SetFillColor(255,255,204);
    $pdf->Cell(190,7,'BRUCELOSIS',1,1,'C',1);
    $pdf->SetFont('helvetica','',12);
    $pdf->Cell(180,7,'Cantidad de Establecimientos DOES Total:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstDOEStotal[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos DOES Parcial:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstDOESParcial[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos MuVe:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstMuve[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos SAN:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstSAN[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos CSM:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstCSM[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos Control Interno:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstConInt[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos Remuestreo:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstRemuestreo[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos con A. Positivos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstPositivos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos con A. Negativos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstNegativos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos con A. Sospechosos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstSospechosos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales SAN:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesSAN[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales CSM:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesCSM[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales en Control Interno:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesContInt[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales en Remuestreo:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesRemuestreo[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Positivos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesPositivos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Negativos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesNegativos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Sospechosos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesSospechosos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de U.P Libres Certificadas en el Mes:',1,0,'L',0);
    $pdf->Cell(10,7,$cantUPLibres[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de U.P Libres Certificadas CARGADAS en el Mes:',1,0,'L',0);
    $pdf->Cell(10,7,$cantUPLibresCargadas[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Libres Total:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesLibres[0][0],1,1,'C',0);

    
    $pdf->Ln(5);
    $pdf->SetFont('helvetica','B',12);
    $pdf->SetFillColor(204,255,229);
    $pdf->Cell(190,7,'TUBERCULOSIS',1,1,'C',1);
    $pdf->SetFont('helvetica','',12);
    $pdf->Cell(180,7,'Cantidad de Animales Tuberculinizados:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesLibresTuberculinizados[0][0],1,1,'C',0);

    $pdf->Cell(180,7,'Cantidad de Animales Libres Tuberculinizados:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesLibresTuberculinizados[0][0],1,1,'C',0);

    $pdf->Cell(180,7,'Cantidad de Establecimientos Libres Certificados:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstLibres[0][0],1,1,'C',0);

    $pdf->Cell(180,7,'Cantidad de Establecimientos Libres Certificados CARGADOS:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstLibresCargados[0][0],1,1,'C',0);

    
    $pdf->Output();

  }

  public function statusVeterinario(){

    //REQUERIMOS LA CLASE TCPDF

    include('fpdf.php');

    // ---------------------------------------------------------

    $titulo = 'Status Sanitario de Establecimientos por Veterinario';

    $cabezera = 'Status Sanitario por Veterinario';
    
    include 'cabezera.php';

    $pdf->Ln(25);
    $pdf->Cell(210,0.1,'',0,1,'L',1);
    $pdf->SetFont('Times','B',12);
    $pdf->SetX(10);
    $pdf->Cell(50,7,'Veterinario',0,0,'L',0);
    $pdf->Cell(60,7,'Propietario',0,0,'L',0);
    $pdf->Cell(40,7,'Estado Brucelosis',0,0,'L',0);
    $pdf->Cell(50,7,'Estado Tuberculosis',0,1,'L',0);
    $pdf->SetFont('Times','',10);

    $item = null;

    $valor = null;

    $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios($item,$valor);
    for ($i=0; $i < sizeof($veterinarios) ; $i++) { 

      $matricula = $veterinarios[$i]['matricula'];

      $nombre = $veterinarios[$i]['nombre'];

      $item = 'veterinario';
      
      $statusEstablecimiento = ControladorProductores::ctrStatusEstablecimientos($item,$matricula);
      
      if(!empty($statusEstablecimiento)){
        $pdf->SetX(10);
        $pdf->Cell(50,7,$nombre,0,0,'L',0);
        
        for ($a=0; $a < sizeof($statusEstablecimiento) ; $a++) { 
          
          $pdf->SetX(10);
          $pdf->Cell(50,7,'',0,0,'L',0);
          $pdf->Cell(60,7,$statusEstablecimiento[$a]['establecimiento'],0,0,'L',0);
          $pdf->Cell(40,7,$statusEstablecimiento[$a]['estadoBrucelosis'],0,0,'L',0);
          $pdf->Cell(50,7,$statusEstablecimiento[$a]['estadoBrucelosis'],0,1,'L',0);

        }
        
      }

    }


    $pdf->Output();

  }

  public function situacionProductor(){

      //REQUERIMOS LA CLASE TCPDF

      include('fpdf.php');

      $item = 'renspa';

      $renspa = $this->renspa;

      $item2 = "campania";

      $campania = $_COOKIE['campania'];
      
      $productor = ControladorProductores::ctrSituacionProductor($item, $renspa,$item2, $campania);

      $animales = ControladorProductores::ctrAnimalesProductor($item, $renspa,$item2, $campania);

      if(!$productor){
        echo "<script>
          alert('Establecimiento NO vacunado');
          window.close()
          </script>";

       }

      $pdf = new FPDF('L','mm','A4');	
      $pdf->AddPage();
      $pdf->SetFillColor(0,4,162);
      $pdf->SetTitle(utf8_decode('Informe de Situación del Productor'));
      $pdf->SetDisplayMode('fullpage', 'single');
      $pdf->SetAutoPageBreak(1,1);
      $pdf->Image('img/logo-absa.png', 120, 5,55);
      $pdf->Ln(18);
      $pdf->SetFont('Times','B',11);
      $pdf->SetX(10);
      $pdf->Cell(100,7,utf8_decode('Sistema de Gestión de Aftosa'),0,1,'L',0);
      $pdf->Ln(1);
      $pdf->SetFont('Times','B',18);
      $pdf->Cell(190,10,utf8_decode('Sistema integrado de Vacunación Anti-Aftosa'),0,1,'L',0);
      $pdf->Cell(190,10,utf8_decode('Informe de Situación de Productor'),0,1,'L',0);
      $pdf->SetFont('Times','B',11);
      $pdf->Cell(190,10,utf8_decode('(Para presentar a quien corresponda)'),0,1,'L',0);
      $pdf->SetFont('Times','B',18);
      $pdf->SetTextColor(0,4,162);
      $pdf->SetX(25);
      $pdf->Cell(25,10,'Renspa:',0,0,'L',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(80,10,$renspa,0,0,'L',0);
      $pdf->SetTextColor(0,4,162);
      $pdf->Cell(15,10,'Doc:',0,0,'L',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(25,10,$productor['tipoDoc'],0,0,'L',0);
      $pdf->Cell(30,10,$productor['numDoc'],0,1,'L',0);
      $pdf->Ln(1);
      $pdf->SetFont('Times','B',10);
      $pdf->Cell(75,7,'Productor',0,0,'L',0);
      $pdf->Cell(60,7,'Departamento/Localidad',0,0,'L',0);
      $pdf->Cell(70,7,'Establecimiento',0,0,'L',0);
      $pdf->Cell(100,7,utf8_decode('Explotación'),0,1,'L',0);
      $pdf->Cell(230,.5,'',0,1,'L',1);

      $pdf->Cell(75,7,utf8_decode($productor['propietario']),0,0,'L',0);
      $pdf->Cell(60,7,'IRIONDO',0,0,'L',0);
      $pdf->Cell(70,7,$productor['establecimiento'],0,0,'L',0);
      $pdf->Cell(100,7,utf8_decode($productor['explotacion']),0,1,'L',0);
      $pdf->Cell(75,7,'',0,0,'L',0);
      $pdf->Cell(60,7,utf8_decode($productor['localidad']),0,0,'L',0);
      $pdf->Ln(2);
      $pdf->SetFont('Times','B',11);
      $pdf->Cell(100,7,utf8_decode('Composición del Rodeo'),0,1,'L',0);	
      $pdf->SetFont('helvetica','B',10);
      $pdf->SetTextColor(111,0,0);
      $pdf->Cell(30,7,'Vacas:',0,0,'R',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(40,7,$animales['vacas'],0,0,'L',0);
      $pdf->SetTextColor(111,0,0);
      $pdf->Cell(18,7,'Toros:',0,0,'L',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(30,7,$animales['toros'],0,0,'L',0);
      $pdf->SetTextColor(111,0,0);
      $pdf->Cell(20,7,'Toritos:',0,0,'L',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(10,7,$animales['toritos'],0,1,'L',0);
      $pdf->SetTextColor(111,0,0);

      $pdf->Cell(30,7,'Vaquillonas:',0,0,'R',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(40,7,$animales['vaquillonas'],0,0,'L',0);
      $pdf->SetTextColor(111,0,0);
      $pdf->Cell(18,7,'Novillos:',0,0,'L',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(30,7,$animales['novillos'],0,0,'L',0);
      $pdf->SetTextColor(111,0,0);
      $pdf->Cell(20,7,'Novillitos:',0,0,'L',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(10,7,$animales['novillitos'],0,1,'L',0);
      $pdf->SetTextColor(111,0,0);

      $pdf->Cell(30,7,'Terneros:',0,0,'R',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(40,7,$animales['terneros'],0,0,'L',0);
      $pdf->SetTextColor(111,0,0);
      $pdf->Cell(18,7,'Terneras:',0,0,'L',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(30,7,$animales['terneras'],0,1,'L',0);
      $pdf->SetTextColor(111,0,0);

      $pdf->Cell(30,7,utf8_decode('Búfalos Mayores:'),0,0,'R',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(40,7,$animales['bufaloMay'],0,0,'L',0);
      $pdf->SetTextColor(111,0,0);
      $pdf->Cell(32,7,utf8_decode('Búfalos Menores:'),0,0,'L',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(30,7,$animales['bufaloMen'],0,1,'L',0);

      $pdf->Ln(8);
      $pdf->SetFont('Times','',11);
      $pdf->Cell(32,7,utf8_decode('Fecha Vacunación:'),0,0,'L',0);
      $pdf->Cell(62,7,formatearFecha($productor['fechaVacunacion']),0,0,'L',0);
      $pdf->SetTextColor(111,0,0);
      $pdf->SetFont('helvetica','B',11);
      $pdf->Cell(45,7,utf8_decode('Regimen de Tenencia:'),0,0,'L',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('times','',11);
      $pdf->Cell(32,7,$productor['regimen'],0,1,'L',0);

      $pdf->Ln(15);
      $pdf->SetFont('times','B',11);
      $pdf->Cell(45,7,date('d/m/Y'),0,0,'L',0);



      $pdf->Output();

  }

}


if($accion == 'informeGeneral'){

    $informeGeneral = new GenerarPDF();
    $informeGeneral -> rango = $_GET["rango"];
    $informeGeneral -> informeGeneral();

}

if($accion == 'statusVeterinario'){

    $statusVeterinario = new GenerarPDF();
    $statusVeterinario -> statusVeterinario();

}

if($accion == 'situacionProductor'){

  $situacionProductor = new GenerarPDF();
  $situacionProductor -> renspa = $_GET['renspa'];
  $situacionProductor -> situacionProductor();

}

?>