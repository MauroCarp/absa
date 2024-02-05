/*=============================================
EDITAR CAMPANIA
=============================================*/

// CARGAR DATA CAMPANIA 
const btnMenuCampania = document.getElementById('btnMenuCampania')

btnMenuCampania.addEventListener('click',()=>{

    let url = 'ajax/aftosa.ajax.php'

    let data = new FormData()
    data.append('accion','dataCampania')

    fetch(url,{
        method:'post',
        body:data
    }).then(resp => resp.json())
    .then(respuesta => {
        
        document.getElementById('campaniaNumero').value = respuesta.numero 
        document.getElementById('fechaInicio').value = respuesta.inicio 
        document.getElementById('fechaCierre').value = respuesta.final 
        document.getElementById('precioAdmAftosa').value = respuesta.admA 
        document.getElementById('precioVacunaAftosa').value = respuesta.vacunaA 
        document.getElementById('precioVeterinarioAftosa').value = respuesta.vacunadorA 
        document.getElementById('precioAdmCarb').value = respuesta.admC
        document.getElementById('precioVacunaCarb').value = respuesta.vacunaC 
        document.getElementById('precioVeterinarioCarb').value = respuesta.vacunadorC 

    })
    .catch(err=>console.log(err))



})


/*=============================================
NUEVA CAMPANIA
=============================================*/
const btnNuevaCampania = document.getElementById('nuevaCampania')

btnNuevaCampania.addEventListener('click',()=>{

    document.getElementById('inputNuevaCampania').style.display = 'block'

    const btnCargarCampania = document.getElementById('cargarNuevaCampania')

    btnCargarCampania.addEventListener('click',()=>{

        swal({
            title: "¿Cargar nueva campaña?",
            text: "¡Si no puede cancelar la acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, cargar Campaña"
          })
        .then(function(result){
                
            if (result.value) {
              
                let campania = document.getElementById('nuevaCampaniaNumero').value
        
                window.location = `index.php?ruta=inicio&campania=${campania}`
                        
            }

        })
        
    })

})


/*=============================================
RECEPCION
=============================================*/

// GENERAR INPUT RECEPCION

const generarInputRecepcion = ()=>{
    
    let form = document.createElement('POST')

    let trInput = document.createElement('TR')
    
    let tdFechaIng = document.createElement('TD')

    let tdUel = tdFechaIng.cloneNode(true)
    
    let tdCantidad = tdFechaIng.cloneNode(true)
    
    let tdMarca = tdFechaIng.cloneNode(true)
    
    let tdSerie = tdFechaIng.cloneNode(true)
    
    let tdFechaVenc = tdFechaIng.cloneNode(true)

    let inputFechaIng = document.createElement('INPUT')
    inputFechaIng.setAttribute('class','form-control')

    let inputUel = inputFechaIng.cloneNode(true)
    
    let inputCantidad =  inputFechaIng.cloneNode(true) 
        
    let inputSerie =  inputFechaIng.cloneNode(true) 
    
    let inputFechaVenc =  inputFechaIng.cloneNode(true) 

    let inputMarca =  document.createElement('SELECT') 
    inputMarca.setAttribute('class','form-control')
    inputMarca.setAttribute('id','marcaRecepcion')

    let  optMarca = document.createElement('OPTION')
    optMarca.setAttribute('value',' ')
    optMarca.innerText = 'Seleccionar Marca'

    let params = {
        idSelect:'marcaRecepcion',
        accion:'marcasVacunas',
        ajax:'aftosa',
        value:'marca',
        optText:'marca'
    }
    
    cargarSelect(params)

    inputMarca.appendChild(optMarca)

    inputFechaIng.setAttribute('type','date')
    inputFechaIng.setAttribute('name','fechaIngRecepcion')
    tdFechaIng.appendChild(inputFechaIng)

    inputUel.setAttribute('type','text')
    inputUel.setAttribute('name','uelRecepcion')
    inputUel.setAttribute('value','A.B.S.A')
    inputUel.setAttribute('readOnly','readOnly')
    tdUel.appendChild(inputUel)

    inputCantidad.setAttribute('type','number')
    inputCantidad.setAttribute('name','cantidadRecepcion')
    tdCantidad.appendChild(inputCantidad)

    inputMarca.setAttribute('name','marcaRecepcion')
    tdMarca.appendChild(inputMarca)

    inputSerie.setAttribute('type','text')
    inputSerie.setAttribute('name','serieRecepcion')
    tdSerie.appendChild(inputSerie)

    inputFechaVenc.setAttribute('type','date')
    inputFechaVenc.setAttribute('name','fechaVenRepecion')
    tdFechaVenc.appendChild(inputFechaVenc)

    trInput.appendChild(tdFechaIng)
    trInput.appendChild(tdUel)
    trInput.appendChild(tdCantidad)
    trInput.appendChild(tdMarca)
    trInput.appendChild(tdSerie)
    trInput.appendChild(tdFechaVenc)

    let btnAgregar = document.createElement('BUTTON')
    btnAgregar.setAttribute('class','btn btn-primary')
    btnAgregar.setAttribute('type','button')
    btnAgregar.setAttribute('id','agregarRecepcion')
    btnAgregar.style.marginTop = '10px'
    btnAgregar.style.marginLeft = '10px'
    btnAgregar.textContent = 'Cargar Recepción'
    trInput.appendChild(btnAgregar)
    form.appendChild(trInput)

    return trInput

}

// ELIMINAR RECEPCION

const eliminarRegistro = (id,ruta)=>{

    swal({
        title: `¿Eliminar ${capitalizarPrimeraLetra(ruta)}?`,
        text: "¡Si no puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Eliminar"
        })
    .then(function(result){
            
        if (result.value) {
                
            window.location = `index.php?ruta=aftosa/${ruta}&id=${id}`
                    
        }

    })

}

        
$('.btnEliminarRecepcion').on('click',function(){
            
    let id = $(this).attr('id')

    eliminarRegistro(id,'recepcion')

}) 
// INPUT OTRA MARCA
          
const otraMarcaOpt = (value,tabla,nodo)=>{

    if(value == 'otraMarca'){

        let selectTd = document.getElementById(tabla).firstElementChild.childNodes[nodo]
        
        let inputOtro = document.createElement('INPUT')
        inputOtro.setAttribute('id','inputOtraMarca')
        inputOtro.setAttribute('name','inputOtraMarca')
        inputOtro.setAttribute('type','text')
        inputOtro.setAttribute('class','form-control')
        inputOtro.setAttribute('style','margin-top:5px;')
        
        selectTd.append(inputOtro)

    }else{

        let inputOtro = document.getElementById('inputOtraMarca')

        if(document.body.contains(inputOtro)){

            inputOtro.parentNode.removeChild(inputOtro);

        }

    }

}


if(seccionURL == 'aftosa/recepcion'){

    // MOSTRAR INPUT RECEPCION

    let btnAgregarRecepcion = document.getElementById('btnAgregarRecepcion')

    if(isInPage(btnAgregarRecepcion))
        btnAgregarRecepcion.addEventListener('click',function(){

            document.querySelector('body').classList.add('sidebar-collapse')
            let tbody = document.getElementById('tablaRecepcion')
            
            let input = generarInputRecepcion()
            
            tbody.prepend(input)

            // OTRA MARCA
            const selectMarca = document.getElementById('marcaRecepcion')

            selectMarca.addEventListener('change',(ev)=>{
                
                let value = ev.target.value                
                
                let tabla = 'tablaRecepcion'

                otraMarcaOpt(value,tabla,3)

            })
    
            // CARGAR RECEPCION
            document.getElementById('agregarRecepcion').addEventListener('click',()=>{
            
                let fechaIng = document.querySelector('input[name="fechaIngRecepcion"]').value
                let uel = document.querySelector('input[name="uelRecepcion"]').value
                let cantidad = document.querySelector('input[name="cantidadRecepcion"]').value
                let marca = document.querySelector('select[name="marcaRecepcion"]').value
                let serie = document.querySelector('input[name="serieRecepcion"]').value
                let fechaVenc = document.querySelector('input[name="fechaVenRepecion"]').value
                
                if(fechaIng != '' && uel != '' && cantidad != '' && marca != '' && serie != '' && fechaVenc != ''){

                    let  url = 'ajax/aftosa.ajax.php';

                    let accion = 'cargarRecepcion'

                    let campania = getCookie('campania') 
                   
                    marcaVacuna = (marca == 'otraMarca') ? document.getElementById('inputOtraMarca').value : marca
                                        
                    let  formData = new FormData()
                    
                    formData.append('accion',accion)
                    formData.append('campania',campania)
                    formData.append('fechaIng',fechaIng)
                    formData.append('uel',uel)
                    formData.append('cantidad',cantidad)
                    formData.append('marca',marcaVacuna)
                    formData.append('serie',serie)
                    formData.append('fechaVenc',fechaVenc)  

                    fetch(url, {
                        method: 'POST', 
                        body: formData,

                    }).then(respuesta => respuesta.json())
                    .then(response => {
                        
                        if(response == 'ok'){
                            window.location = 'index.php?ruta=aftosa/recepcion'
                        }

                    })
                    .catch(error => console.error('Error:', error))

                }else{

                    swal({
                        title: "Hay campos vacios",
                        type: "error",
                        confirmButtonText: "¡Cerrar!"
                        })

                }   

                    
            })

            this.setAttribute('disabled','disabled')

        })

}

/*=============================================
DISTRIBUCION
=============================================*/

const cargarDistribuciones = (matricula,idTBody)=>{

    localStorage.setItem('matricula',matricula)
    
    let url = 'ajax/aftosa.ajax.php'

    let data = new FormData()
    data.append('matricula',matricula)
    data.append('accion','mostrarDistribucion')

    fetch(url,{
        method:'post',
        body:data
    })
    .then(resp => resp.json())
    .then(respuesta =>{
        
        if(respuesta.length > 0){
            let tbody = document.getElementById(idTBody)

            let emptyRow = tbody.firstElementChild
            
            if(isInPage(emptyRow))
                tbody.removeChild(emptyRow)

            tbody.innerHTML = ''

            let rows = document.createDocumentFragment()

            respuesta.map(registro =>{
                
                let row = document.createElement('TR')
                
                let marca = document.createElement('TD')
                let uel = marca.cloneNode(true)
                let tdMatricula = marca.cloneNode(true)
                let cantidad = marca.cloneNode(true)
                let fechaEntrega = marca.cloneNode(true)
                
                uel.textContent = 'A.B.S.A'
                tdMatricula.textContent = matricula
                marca.textContent = registro.marca
                cantidad.textContent = registro.cantidad
                fechaEntrega.textContent = formatearFecha(registro.fechaEntrega)

                row.appendChild(tdMatricula)
                row.appendChild(uel)
                row.appendChild(marca)
                row.appendChild(cantidad)
                row.appendChild(fechaEntrega)
                
                let btnEliminar = document.createElement('BUTTON')
                btnEliminar.setAttribute('class','btn btn-danger btnEliminarDistribucion')
                btnEliminar.setAttribute('id',registro.distri_id)
                btnEliminar.setAttribute('style','margin:5px 0')

                let crossIcon = document.createElement('I')
                crossIcon.setAttribute('class','fa fa-times')

                btnEliminar.appendChild(crossIcon)
                row.appendChild(btnEliminar)

                rows.appendChild(row)

            })

            tbody.appendChild(rows)

            document.getElementById('btnAgregarDistribucion').style.display = 'block'
            
        }else{
            
            document.getElementById('btnAgregarDistribucion').style.display = 'block'
            
            let tr = document.createElement('TR')
            tr.setAttribute('class','odd')

            let td  = document.createElement('TD')
            td.setAttribute('valign','top')
            td.setAttribute('colspan','6')
            td.setAttribute('class','dataTables_empty')
            td.innerText = 'Ningún dato disponible en esta tabla'

            tr.appendChild(td)

            document.getElementById(idTBody).innerHTML = ''
            document.getElementById(idTBody).appendChild(tr)
            
        }
    
        
        $('.btnEliminarDistribucion').on('click',function(){
            
            let id = $(this).attr('id')
        
            eliminarRegistro(id,'distribucion')
        
        })  
               


                
    })
    .catch(err=>console.log(err))
    

}

//ELIMINAR DISTRIBUCIONES



const btnCargarDistribuciones = document.querySelector('#cargarDistribuciones')

if(isInPage(btnCargarDistribuciones)){
    
    let params = {
        idSelect:'vacunadorDistri',
        accion:'listarVeterinarios',
        ajax:'veterinarios',
        value:'matricula',
        optText:'nombre'
    }
    
    cargarSelect(params)

    btnCargarDistribuciones.addEventListener('click',()=>{

    document.getElementById('btnAgregarDistribucion').removeAttribute('disabled')
    
    let matricula = document.getElementById('vacunadorDistri').value

    if(matricula != '')

        cargarDistribuciones(matricula,'tablaDistribucion')
   
    })


}

// // GENERAR INPUT DISTRIBUCION

const generarInputDistribucion = ()=>{

    let form = document.createElement('POST')

    let trInput = document.createElement('TR')
    
    let tdMatricula = document.createElement('TD')

    let tdUel = tdMatricula.cloneNode(true)
    
    let tdCantidad = tdMatricula.cloneNode(true)
    
    let tdMarca = tdMatricula.cloneNode(true)
        
    let tdFechaEntrega = tdMatricula.cloneNode(true)

    let inputMatricula = document.createElement('INPUT')
    inputMatricula.setAttribute('class','form-control')
    
    let matricula = localStorage.getItem('matricula')

    let inputUel = inputMatricula.cloneNode(true)
    
    let inputCantidad =  inputMatricula.cloneNode(true) 
    
    let inputFechaEntrega =  inputMatricula.cloneNode(true) 
    
    let inputMarca =  document.createElement('SELECT') 
    inputMarca.setAttribute('class','form-control')
    inputMarca.setAttribute('id','marcaDistribucion')

    let  optMarca = document.createElement('OPTION')
    optMarca.setAttribute('value',' ')
    optMarca.innerText = 'Seleccionar Marca'

    inputMarca.appendChild(optMarca)

    inputMatricula.setAttribute('type','text')
    inputMatricula.setAttribute('name','matriculaDistribucion')
    tdMatricula.appendChild(inputMatricula)

    inputUel.setAttribute('type','text')
    inputUel.setAttribute('name','uelDistribucion')
    inputUel.setAttribute('value','A.B.S.A')
    inputUel.setAttribute('readOnly','readOnly')
    tdUel.appendChild(inputUel)

    inputCantidad.setAttribute('type','number')
    inputCantidad.setAttribute('name','cantidadDistribucion')
    tdCantidad.appendChild(inputCantidad)

    inputMarca.setAttribute('name','marcaDistribucion')
    tdMarca.appendChild(inputMarca)

    let params = {
        idSelect:'marcaDistribucion',
        accion:'marcasVacunas',
        ajax:'aftosa',
        value:'marca',
        optText:'marca'
    }

    cargarSelect(params)

    inputFechaEntrega.setAttribute('type','date')
    inputFechaEntrega.setAttribute('name','fechaEntregaDistribucion')
    tdFechaEntrega.appendChild(inputFechaEntrega)

    inputMatricula.setAttribute('readOnly','readOnly')
    inputMatricula.setAttribute('value',matricula)

    trInput.appendChild(tdMatricula)
    trInput.appendChild(tdUel)
    trInput.appendChild(tdMarca)
    trInput.appendChild(tdCantidad)
    trInput.appendChild(tdFechaEntrega)

    let btnAgregar = document.createElement('BUTTON')
    btnAgregar.setAttribute('class','btn btn-primary')
    btnAgregar.setAttribute('type','button')
    btnAgregar.setAttribute('id','agregarDistribucion')
    btnAgregar.style.marginTop = '10px'
    btnAgregar.style.marginLeft = '10px'
    btnAgregar.textContent = 'Cargar Distribucion'
    trInput.appendChild(btnAgregar)
    form.appendChild(trInput)

    return trInput

}

// MOSTRAR INPUT DISTRIBUCION

let btnAgregarDistribucion = document.getElementById('btnAgregarDistribucion')

if(isInPage(btnAgregarDistribucion)){
    btnAgregarDistribucion.addEventListener('click',function(){

        let tbody = document.getElementById('tablaDistribucion')
        
        let input = generarInputDistribucion()
        
        tbody.prepend(input)

        // CARGAR DISTRIBUCION
        document.getElementById('agregarDistribucion').addEventListener('click',()=>{
            
            let matricula = document.querySelector('input[name="matriculaDistribucion"]').value
            let uel = document.querySelector('input[name="uelDistribucion"]').value
            let cantidad = document.querySelector('input[name="cantidadDistribucion"]').value
            let marca = document.querySelector('select[name="marcaDistribucion"]').value
            let fechaEntrega = document.querySelector('input[name="fechaEntregaDistribucion"]').value
            
            if(matricula != '' && uel != '' && cantidad != '' && marca != '' && fechaEntrega != ''){

                let  url = 'ajax/aftosa.ajax.php';

                let accion = 'cargarDistribucion'

                let campania = getCookie('campania') 
                
                let  formData = new FormData()
                
                formData.append('accion',accion)
                formData.append('campania',campania)
                formData.append('matricula',matricula)
                formData.append('uel',uel)
                formData.append('cantidad',cantidad)
                formData.append('marca',marca)
                formData.append('fechaEntrega',fechaEntrega)                

                fetch(url, {
                    method: 'POST', 
                    body: formData,

                }).then(respuesta => respuesta.json())
                .then(response => {
                    
                    if(response == 'ok'){
                        window.location = 'index.php?ruta=aftosa/distribucion'
                    }

                })
                .catch(error => console.error('Error:', error))

            }else{

                swal({
                    title: "Hay campos vacios",
                    type: "error",
                    confirmButtonText: "¡Cerrar!"
                    })

            }   

                
        })

        this.setAttribute('disabled','disabled')

    })
}


