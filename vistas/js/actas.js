

/*=============================================
ACTAS
=============================================*/

// FUNCION SUMAR ANIMALES

const sumaParcialTotal = (tipoSuma)=>{

    let cantidades = document.getElementsByClassName(tipoSuma)

    let total = 0;

    for (const cantidad of cantidades) {

        total += Number(cantidad.value)
        
    }

    return total

}

const cargarAnimalesActa = (renspa,campania)=>{

    let url = 'ajax/animales.ajax.php'

    let data = new FormData()
    data.append('accion','cargarAnimales')
    data.append('renspa',renspa)
    data.append('campania',campania)
    
    fetch(url,{
        method:'post',
        body:data
    }).then(resp => resp.json())
    .then(respuesta=> {
        
        document.querySelector('input[name=vacas]').value = respuesta.vacas
        document.querySelector('input[name=toros]').value = respuesta.toros
        document.querySelector('input[name=toritos]').value = respuesta.toritos
        document.querySelector('input[name=novillos]').value = respuesta.novillos
        document.querySelector('input[name=novillitos]').value = respuesta.novillitos
        document.querySelector('input[name=vaquillonas]').value = respuesta.vaquillonas
        document.querySelector('input[name=terneras]').value = respuesta.terneras
        document.querySelector('input[name=terneros]').value = respuesta.terneros
        document.querySelector('input[name=bufaloMay]').value = respuesta.bufaloMay
        document.querySelector('input[name=bufaloMen]').value = respuesta.bufaloMen
        document.querySelector('input[name=caprinos]').value = respuesta.caprinos
        document.querySelector('input[name=ovinos]').value = respuesta.ovinos
        document.querySelector('input[name=porcinos]').value = respuesta.porcinos
        document.querySelector('input[name=equinos]').value = respuesta.equinos



    }).then(()=>{

        document.getElementById('campoTotal').value = sumaParcialTotal('sumTotal')
        document.getElementById('campoParcial').value = sumaParcialTotal('sumParcial')

    }).catch(er=>console.log(er))
    
}

if(seccionURL == 'aftosa/acta'){

    let renspa = getQueryVariable('renspa')

    let campania = getCookie('campania')

    // CARGAR ANIMALES EN EXISTENCIA

    cargarAnimalesActa(renspa,campania)

    // SUMAR TOTALES Y PARCIALES

    let cantidadesTotal = document.getElementsByClassName('sumTotal')

    for (const cantidad of cantidadesTotal) {
        
        cantidad.addEventListener('change',()=>{

            document.getElementById('campoTotal').value = sumaParcialTotal('sumTotal')

        })  
              
    }

    let cantidadesParcial = document.getElementsByClassName('sumParcial')

    for (const cantidad of cantidadesParcial) {
        
        cantidad.addEventListener('change',()=>{

            document.getElementById('campoParcial').value = sumaParcialTotal('sumParcial')

        })  

    }

    // CARGAR SELECT VETERINARIOS

    let params = {
        idSelect:'vacunador',
        accion:'listarVeterinarios',
        ajax:'veterinarios',
        value:'matricula',
        optText:'nombre'
    }
    
    cargarSelect(params)

    // SELECCIONAR VETERINARIO
    let matricula = document.getElementById('matriculaVeterinario').value

    setTimeout(() => {
        
        document.querySelector('#vacunador').value = matricula 
    
    }, 200);

    

// BTN INGRESA ACTA

const btnIngresarActa = document.getElementById('btnIngresarActa')

btnIngresarActa.addEventListener('click',(e)=>{
    e.preventDefault()

    let fechaRecepcion = document.getElementById('fechaRecepcion').value
    let fechaVacunacion = document.getElementById('fechaVacunacion').value
    let acta = document.getElementById('actaNumero').value

    if(fechaRecepcion == '' || fechaVacunacion == '' || acta == ''){

        swal({
              type: "error",
              title: "Hay campos que no puede ir vacios",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
            })
            
    }else{

        swal({
            title: "¿Cargar Acta?",
            text: "Revisar datos antes de confirmar",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, cargar Acta!"
        })
        .then(function(result){
                
            if (result.value) {
            
                document.getElementById('form-acta').submit()
                        
            }

        })

    }

})


}

if(seccionURL == 'aftosa/modificarActa'){

    let renspa = getQueryVariable('renspa')

    let campania = getCookie('campania')

    // CARGAR ANIMALES EN EXISTENCIA

   cargarAnimalesActa(renspa,campania)

    // SUMAR TOTALES Y PARCIALES

    let cantidadesTotal = document.getElementsByClassName('sumTotal')

    for (const cantidad of cantidadesTotal) {
        
        cantidad.addEventListener('change',()=>{

            document.getElementById('campoTotal').value = sumaParcialTotal('sumTotal')

        })  
              
    }

    let cantidadesParcial = document.getElementsByClassName('sumParcial')

    for (const cantidad of cantidadesParcial) {
        
        cantidad.addEventListener('change',()=>{

            document.getElementById('campoParcial').value = sumaParcialTotal('sumParcial')

        })  

    }

    // CARGAR SELECT VETERINARIOS
    let matricula = $('#matriculaVacunador').val()

    let params = {
        idSelect:'vacunador',
        accion:'listarVeterinarios',
        ajax:'veterinarios',
        value:'matricula',
        optText:'nombre',
        matricula
    }
    
    cargarSelect(params)

    // SELECCIONAR VETERINARIO
    matricula = document.getElementById('matriculaVeterinario').value

    setTimeout(() => {
        
        document.querySelector('#vacunador').value = matricula 
    
    }, 200);

    

// BTN INGRESA ACTA

const btnIngresarActa = document.getElementById('btnIngresarActa')

btnIngresarActa.addEventListener('click',(e)=>{
    e.preventDefault()

    let fechaRecepcion = document.getElementById('fechaRecepcion').value
    let fechaVacunacion = document.getElementById('fechaVacunacion').value
    let acta = document.getElementById('actaNumero').value

    if(fechaRecepcion == '' || fechaVacunacion == '' || acta == ''){

        swal({
              type: "error",
              title: "Hay campos que no puede ir vacios",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
            })
            
    }else{

        swal({
            title: "¿Modificar Acta?",
            text: "Revisar datos antes de confirmar",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, modificar Acta!"
        })
        .then(function(result){
                
            if (result.value) {
            
                document.getElementById('form-acta').submit()
                        
            }

        })

    }

})

}


// BTN CARGAR RENSPA ACTAS
const btnCargarActa = document.getElementById('btnCargarActa');

btnCargarActa.addEventListener('click',(e)=>{

    e.preventDefault()

    let campania = getCookie('campania');
    
    let renspa = $('#renspaAftosa').val();
    
    let interValido = (document.getElementById('interCampania').checked === true) ? 1 : 0

    renspa.trim()

    if(renspa.length == 0 ){
    
        swal({
          type: "error",
          title: "El campo R.E.N.S.P.A no puede estar Vacio",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
          })
      
    }else if(renspa.length == 17 ){
        
        // CHECKEAR SI EL PRODUCTOR EXISTE
        let url = 'ajax/productores.ajax.php'

        let data = new FormData()
        data.append('renspa',renspa)

        fetch(url,{
            method:'post',
            body:data
        }).then(resp => resp.json())
        .then(respuesta => {

            if(!respuesta){
                
            swal({
                type: "error",
                title: "El Productor no Existe",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                })

            }else{

                    let urlActa = 'ajax/actas.ajax.php'

                    let dataActa = new FormData()
                    dataActa.append('accion','validarActa')
                    dataActa.append('renspa',renspa)
                    dataActa.append('campania',campania)
                    dataActa.append('intercampania',interValido)
                
                    fetch(urlActa,{
                        method:'post',
                        body:dataActa
                    }).then(resp => resp.json())
                    .then(respuesta => {
                
                        if(respuesta.valida != 0){
                            
                            swal({
                                title: "El acta ya ha sido cargada. ¿Desea modificarla?",
                                text: "¡Si no puede cancelar la acción!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                cancelButtonText: "Cancelar",
                                confirmButtonText: "Si, modificar Acta!"
                            }).then(result=>{
                                
                                if(result.value){

                                    window.location = `index.php?ruta=aftosa/modificarActa&renspa=${renspa}&inter=${interValido}`
                                    
                                }

                            })
                
                        }else{

                            window.location = `index.php?ruta=aftosa/acta&renspa=${renspa}&campania=${campania}&inter=${interValido}`

                        }
                
                    })

            }

        })
    
    }else{
    
        swal({
            type: "error",
            title: "R.E.N.S.P.A Incorrecto",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            })
            
      }

});



/*=============================================
ACTAS POR PRODUCTOR
=============================================*/

const btnBuscarActasProductor = document.getElementById('btnBuscarActasProductor')

btnBuscarActasProductor.addEventListener('click',(e)=>{

    e.preventDefault()

    let renspa = document.getElementById('renspaActasProductor').value

    renspa.trim()

    if(renspa.length == 17){

        let ruta = `index.php?ruta=aftosa/actasProductor&renspa=${renspa}`

        productorExistente(renspa,ruta,false)
        
    }else{
        
        swal({

            type: "error",
            title: "R.E.N.S.P.A Incorrecto",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

         })
            
    }
    
})

if(seccionURL == 'aftosa/actasProductor'){

    let renspa = getQueryVariable('renspa')
    
    // CARGAR PROPIETARIO Y RENSPA

    let url = 'ajax/productores.ajax.php'

    let data = new FormData()
    data.append('renspa',renspa)

    fetch(url,{
        method:'post',
        body:data
    })
    .then(resp => resp.json())
    .then(respuesta => {

        document.getElementById('dataPropietarioActas').innerText = `${respuesta.propietario} || ${respuesta.renspa}`

    })


        
    $('.tablas').on('click','.btnEliminarActa',function(){

        let id = $(this).attr('idacta')

        swal({
            title: "¿Desea Eliminar el acta?",
            text: "¡Si no puede cancelar la acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminar Acta!"
        }).then(result=>{
            
            if(result.value){

                let renspa = getQueryVariable('renspa')

                window.location = `index.php?ruta=aftosa/actasProductor&renspa=${renspa}&acta=${id}`

                
            }

        })

        
    })


}


/*=============================================
BUSQUEDA DE DIFERENCIA
=============================================*/

let btnsDiferencias = document.getElementsByClassName('btnModificarActa')

if(btnsDiferencias.length  > 0){
    
    for (const btn of btnsDiferencias) {
        
        btn.addEventListener('click',(e)=>{

            let renspa
            let intercampania
            if(e.target.attributes.length > 1){
            
                renspa =  e.target.attributes.renspa.value 
                intercampania = e.target.attributes.inter.value 
            }else{
                
                renspa =  e.target.parentElement.attributes.renspa.value 
                intercampania =  e.target.parentElement.attributes.inter.value 
            
            }

            swal({
                title: `¿Modificar Acta?`,
                text: "¡Si no puede cancelar la acción!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Si, modificar"
                })
            .then(function(result){
                    
                if (result.value) {
                        
                    window.location = `index.php?ruta=aftosa/modificarActa&renspa=${renspa}&inter=${intercampania}`
                            
                }
        
            })


        })

    }

}


/*=============================================
ASIGNAR VETERINARIO
=============================================*/

const btnAsignarVet = document.getElementById('btnAsignarVet')

btnAsignarVet.addEventListener('click',()=>{

    let matricula = document.getElementById('asignarVet').value

    let url = 'ajax/productores.ajax.php'
    let renspa = getQueryVariable('renspa')

    let data = 'accion=asignarVet&matricula=' + matricula + '&renspa=' + renspa;


    let inter = getQueryVariable('inter')

    let campania = getCookie('campania')
    $.ajax({
        method:'post',
        url,
        data,
        success:(respuesta)=>{

            if(respuesta == "ok"){

                swal({
                    type: "success",
                    title: "El Veterinario fue asignado con exito",
                    showConfirmButton: true,
                    confirmButtonText: "Continuar"
                    }).then(function(result){
                                
                          window.location = `index.php?ruta=aftosa/acta&renspa=${renspa}&campania=${campania}&inter=${inter}`

                    })

            }else{

                swal({
                    type: "error",
                    title: "Hubo un error al asignar el veterinario. Avisar a Mauro",
                    showConfirmButton: true,
                    confirmButtonText: "Continuar"
                    }).then(function(result){
                                
                          window.location = `index.php?ruta=aftosa/acta&renspa=${renspa}&campania=${campania}&inter=${inter}`

                    })

            }

        }
    })

    $('#ventanaModalVeterinario').modal('hide');


})