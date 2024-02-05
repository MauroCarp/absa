/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btnSD').daterangepicker(
{
    ranges   : {

    },
    startDate: moment(),
    endDate  : moment()
},
function (start, end) {
    $('#daterange-btnSD span').html(start.format('DD/MM/Y') + ' - ' + end.format('DD/MM/YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    localStorage.setItem('rangoSD', fechaInicial + '/' + fechaFinal);

    var capturarRango = $("#daterange-btnSD span").html();

}

)

$('#daterange-btnInforme').daterangepicker(
    {
        ranges   : {
    
        },
        startDate: moment(),
        endDate  : moment()
    },
    function (start, end) {
        $('#daterange-btnInforme span').html(start.format('DD/MM/Y') + ' - ' + end.format('DD/MM/YYYY'));
    
        var fechaInicial = start.format('YYYY-MM-DD');
    
        var fechaFinal = end.format('YYYY-MM-DD');
    
        localStorage.setItem('rangoInforme', fechaInicial + '/' + fechaFinal);
    
        var capturarRango = $("#daterange-btnInforme span").html();
    
    }
    
)


/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

localStorage.removeItem("rangoSD");
localStorage.removeItem("rangoInforme");
localStorage.clear();

$('#daterange-btnSD').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');
$('#daterange-btnInforme').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');

});


/*=============================================
MODAL ACTUALIZAR STATUS
=============================================*/
$('#actualizarStatus').on('click',function(e){
    
    e.preventDefault()

    let renspa = $('#renspa').val()

    let ruta = `index.php?ruta=brutur/actualizarStatus&renspa=${renspa}`;

    validarRenspa(renspa,ruta,false)  

});

/*=============================================
REGISTRAR CAMBIO EN STATUS BRUTUR
=============================================*/
const corroborarCambios = (idCampo,idCambios)=>{
    
    let estado = $(`#${idCampo}`).val();

    $(`#${idCampo}`).on('change',(evt)=>{
        
        let value = evt.target.value
        
        if(value != estado){

            $(`#${idCambios}`).val(true)
        
        }else{
            
            $(`#${idCambios}`).val(false)

        }
    
    })

}

// ESTADO
corroborarCambios('estadoBruceAct','cambiosBrucelosis')
corroborarCambios('estadoTuberAct','cambiosTuberculosis')
// FECHA MUESTRA
corroborarCambios('fechaMuestraTuberAct','cambiosTuberculosis')
corroborarCambios('fechaMuestraBruceAct','cambiosBrucelosis')
// PROTOCOLO
corroborarCambios('protocoloTuberAct','cambiosTuberculosis')
corroborarCambios('protocoloBruceAct','cambiosBrucelosis')
// SANEAMIENTOS
corroborarCambios('saneamientoNumTuberAct','cambiosTuberculosis')
corroborarCambios('saneamientoNumBruceAct','cambiosBrucelosis')
corroborarCambios('positivoTuberAct','cambiosTuberculosis')
corroborarCambios('positivoBruceAct','cambiosBrucelosis')
corroborarCambios('negativoTuberAct','cambiosTuberculosis')
corroborarCambios('negativoBruceAct','cambiosBrucelosis')
corroborarCambios('sospechosoTuberAct','cambiosTuberculosis')
corroborarCambios('sospechosoBruceAct','cambiosBrucelosis')




/*=============================================
GENERAR INFORME SD
=============================================*/

$('#generarReporteSD').click(()=>{

    let rango = localStorage.getItem('rangoSD');

    window.open(`extensiones/fpdf/generarPdf.php?rango=${rango}&accion=establecimientosSD`, '_blank');

});

/*=============================================
GENERAR INFORME GENERAL
=============================================*/

$('#generarInformeGeneral').click(()=>{

    let rango = localStorage.getItem('rangoInforme');

    window.open(`extensiones/fpdf/generarPdf.php?rango=${rango}&accion=informeGeneral`, '_blank');

});


/*=============================================
NOTIFICAR VACUNADOR
=============================================*/
$(".tablas").on("click", ".btnNotificar", function(){
    
	let renspa = $(this).attr("renspa");

	let campania = $(this).attr("campania");
	
    let alerta = $(this).attr("alerta");

    let estado = $(this).attr("estado");
	
	swal({
        title: '¿Notificar a Vacunador?',
        text: "¡Si no puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, notificar a Vacunador!'
      }).then(function(result){
        if (result.value) {
          
            window.location = `index.php?ruta=brutur/alertas&renspa=${renspa}&campania=${campania}&alerta=${alerta}&estado=${estado}&notificar=true`;
        
        }

  })

})

/*=============================================
ELIMINAR REGISTRO
=============================================*/

$(".table").on("click", ".btnEliminarRegistro", function(){
    
	let idRegistro = $(this).attr("idRegistro");
    
	let renspa = $(this).attr("renspa");

	swal({
        title: '¿Eliminar Registro?',
        text: "¡Si no puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar registro!'
      }).then(function(result){
        if (result.value) {
          
            window.location = `index.php?ruta=brutur/actualizarStatus&idRegistro=${idRegistro}&renspa=${renspa}`;
            
        }

  })

})

/*=============================================
CARGAR DATOS ACTUALIZAR STATUS
=============================================*/

const mostrarDatosStatus = (renspa)=>{

    url = 'ajax/brutur.ajax.php';
    
    data = `renspa=${renspa}&accion=productores`;

    // PRODUCTOR
    
    $.ajax({
        
        method: 'POST',

        url: url,

        data: data,

        success: function(response){
            
            response = JSON.parse(response);

            $('#renspaProductor').html(response.renspa);
            $('#establecimiento').html(response.establecimiento);
            $('#productor').html(response.propietario);
            mostrarVeterinario(response.veterinario);
            $('#tipoExplotacion').html(response.explotacion);           

        }

    })

    // BRUCELOSIS
    
    data = `renspa=${renspa}&accion=brucelosis`;

    $.ajax({
        
        method: 'POST',

        url: url,

        data: data,

        success: function(response){
           
            response = JSON.parse(response);
            
            let fechaVencimiento;

            $('#vacasBruce').html(response.vacas)
            $('#vaquillonasBruce').html(response.vaquillonas)
            $('#torosBruce').html(response.toros)
            $('#protocoloBrucelosis').html(response.protocolo)
            $('#estadoBrucelosis').html(response.estado)
            $('#estadoSenasaBrucelosis').html(response.estadoSenasa)
                        
            switch (response.estadoSenasa) {
                case 'Enviado':

                    $('#inputCertificadoBruce').show();

                    break;
            
                case 'Pendiente':

                    $('#inputCertificadoBruce').hide();
                    $('#divEstadoBruce').hide()

                    break;
                    
                    case 'Aprobado':
                                            
                        $('#certificadoBrucelosis').html(response.numeroCert)

                        $('#divEstadoBruce').show()
                    
                    break;
            
                default:
                    break;
            }

            fechaVencimiento = sumarFecha(response.fechaEstado,'año',1)
            $('#fechaVencimientoBrucelosis').html(formatearFecha(fechaVencimiento))

            $('#fechaEstadoBrucelosis').html(formatearFecha(response.fechaEstado))

            $('#fechaCargaBrucelosis').html(formatearFecha(response.fechaCarga))
            // $('#fechaRecepcionBrucelosis').html(formatearFecha(response.fechaRecepcion))
            
        }

    })

    // TUBERCULOSIS
    data = `renspa=${renspa}&accion=tuberculosis`;

    $.ajax({
        
        method: 'POST',

        url: url,

        data: data,

        success: function(respuesta){

            respuesta = JSON.parse(respuesta);
            
            let fechaVencimiento;

            fechaCarga = respuesta.fechaCarga ? respuesta.fechaCarga : '-'; 

            $('#vacasTuber').html(respuesta.vacas);
            $('#vaquillonasTuber').html(respuesta.vaquillonas);
            $('#ternerosTuber').html(respuesta.terneros);
            $('#ternerasTuber').html(respuesta.terneras);
            $('#novillosTuber').html(respuesta.novillos);
            $('#novillitosTuber').html(respuesta.novillitos);
            $('#torosTuber').html(respuesta.toros);
            $('#protocoloTuberculosis').html(respuesta.protocolo);
            $('#estadoTuberculosis').html(respuesta.estado);
            $('#estadoSenasaTuberculosis').html(respuesta.estadoSenasa);
            
            if(respuesta.estadoSenasa == 'Enviado'){
                
                $('#inputCertificadoTuber').css('display','block');
                $('#divEstado').css('display','none');
                
            }else{

                
                $('#divEstado').css('display','block');
                $('#certificadoTuberculosisText').html(respuesta.numeroCert)
                
            }

            switch (respuesta.estadoSenasa) {
                case 'Enviado':

                    $('#inputCertificadoTuber').show()
                    $('#divEstado').css('display','none');

                    break;
            
                case 'Pendiente':
                    
                    $('#inputCertificadoTuber').css('display','none');
                    $('#divEstado').hide()

                    break;
                    
                    case 'Aprobado':
                
                        $('#divEstado').css('display','block');
                        $('#certificadoTuberculosisText').html(respuesta.numeroCert)
                    
                    break;
            
                default:
                    break;
            }
            
            fechaVencimiento = sumarFecha(respuesta.fechaEstado,'año',1); 
            $('#fechaVencimientoTuberculosis').html(formatearFecha(fechaVencimiento));

            $('#fechaEstadoTuberculosis').html(formatearFecha(respuesta.fechaEstado));
            $('#fechaCargaTuberculosis').html(formatearFecha(fechaCarga));

        }

    })
}

const mostrarHistorial = (renspa)=>{

    // HISTORIAL BRUCELOSIS
    url = 'ajax/brutur.ajax.php';

    data = `renspa=${renspa}&campania=Brucelosis&accion=historialBrucelosis`;

    $.ajax({
        
        method: 'POST',

        url: url,

        data: data,

        success: function(respuesta){

            
            respuesta = JSON.parse(respuesta);
            
            let tbody;

            for (let index = 0; index < respuesta.length; index++) {
                
                let cantMuestras = parseFloat(respuesta[index]['positivo']) + parseFloat(respuesta[index]['negativo']) + parseFloat(respuesta[index]['sospechoso']);

                tbody += `<tr>
                    <td>${formatearFecha(respuesta[index]['fechaEstado'])}</td>
                    <td>${respuesta[index]['protocolo']}</td>
                    <td>${utf8(respuesta[index]['estado'])}</td>
                    <td>${cantMuestras}</td>
                    <td>${respuesta[index]['saneamientoNumero']}</td>
                    <td>${respuesta[index]['positivo']}</td>
                    <td>${respuesta[index]['negativo']}</td>
                    <td>${respuesta[index]['sospechoso']}</td>
                    <td><button class="btn btn-danger btnEliminarRegistro" idRegistro='${respuesta[index]['id']}' renspa='${respuesta[index]['renspa']}'><i class="fa fa-times"></i></button></td>
                    </tr>`;                
                    
            }
            
            $('#historialBrucelosis').append(tbody);

            
        }

    })

    // HISTORIAL TUBERCULOSIS

    data = `renspa=${renspa}&campania=Tuberculosis&accion=historialTuberculosis`;

    $.ajax({
        
        method: 'POST',

        url: url,

        data: data,

        success: function(respuesta){
            
            respuesta = JSON.parse(respuesta);
            
            let tbody;

            for (let index = 0; index < respuesta.length; index++) {
                
                let cantMuestras = parseFloat(respuesta[index]['positivo']) + parseFloat(respuesta[index]['negativo']) + parseFloat(respuesta[index]['sospechoso']);

                tbody += `<tr>
                    <td>${formatearFecha(respuesta[index]['fechaEstado'])}</td>
                    <td>${respuesta[index]['protocolo']}</td>
                    <td>${utf8(respuesta[index]['estado'])}</td>
                    <td>${cantMuestras}</td>
                    <td>${respuesta[index]['saneamientoNumero']}</td>
                    <td>${respuesta[index]['positivo']}</td>
                    <td>${respuesta[index]['negativo']}</td>
                    <td>${respuesta[index]['sospechoso']}</td>
                    <td><button class="btn btn-danger btnEliminarRegistro" idRegistro='${respuesta[index]['id']}' renspa='${respuesta[index]['renspa']}'><i class="fa fa-times"></i></button></td>
                    </tr>`;                
                    
            }
            
            $('#historialTuberculosis').append(tbody);

            
        }

    });
}

// MOSTRAR INPUT SEGUN ESTADO

const mostrarInputSegunEstado = (select)=>{
    
    let campania = (select == 'estadoBruceAct') ? 'Bruce' : 'Tuber';
      
    $(`#${select}`).on('change',()=>{
        
        let estado = $('#' + select).val();
        
       (estado == 'En Saneamiento' || estado == 'MuVe') ? $(`#inputSaneamiento${campania}`).css('display','block') : $(`#inputSaneamiento${campania}`).css('display','none')  
    
    })

}

mostrarInputSegunEstado('estadoTuberAct');
mostrarInputSegunEstado('estadoBruceAct');

// APROBAR ESTADO SENASA

$('.aprobarSenasa').on('click',function(){

    let dataButton= $(this).attr('dataButton')
    
    let certificado;
     
    if($(`#certificado${dataButton}Input`).val() != ''){ 
    
        certificado = $(`#certificado${dataButton}Input`).val()
    
    }else{

        return alert('El numero de certificado no puede ir vacio')
   
    } 
                 
    swal({

        title: "Desea aprobar el Estado?",
        text: "¡Si no lo está puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Aprobar"

    })
    .then((response)=>{
        
       if(response.value){

            let tabla = dataButton.toLowerCase()
        
            let renspa = getQueryVariable('renspa')
        
            if($(`#certificado${dataButton}Input`).val() != undefined){
                    
                let props = {
                    renspa,
                    tabla,
                    certificado
                }
        
                aprobarEstado(props);
        
            }
        
        }
        
    })
      

 });


const aprobarEstado = (props)=>{

    let url = 'ajax/brutur.ajax.php'

    let data = `accion=aprobarEstado&tabla=${props.tabla}&renspa=${props.renspa}&certificado=${props.certificado}&fecha=${props.fechaCertificado}`

    $.ajax({
        method:'post',
        url,
        data,
        success:(response)=>{
            
           if(response == 'ok'){
            
            swal({
                type: "success",
                title: "El estado  ha sido aprobado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                          
                    if (result.value) {

                          window.location = `index.php?ruta=brutur/actualizarStatus&renspa=${props.renspa}`;

                    }
                })

           }else{
            
                swal({
                    type: "error",
                    title: "¡El estado no pudo ser aprobado!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                    if (result.value) {

                    window.location = `index.php?ruta=brutur/actualizarStatus&renspa=${props.renspa}`;

                    }
                })
           }
            
        }
    })
}

$(document).ready(function() {

setTimeout(() => {
    
    let estadoBruce = $('#estadoBruceAct').val()

    let estadoTuber = $('#estadoTuberAct').val()

    if(estadoTuber == 'En Saneamiento'){
    
        $(`#inputSaneamientoTuber`).css('display','block')   
    
    }

}, 500);

})