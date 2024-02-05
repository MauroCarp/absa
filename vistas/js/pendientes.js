const enviarPendientes = ()=>{
    
    window.open(`vistas/modulos/brutur/excelPendientes.php`, '_blank');

    swal({
        type: "success",
        title: "El estado cambio a 'Enviados a SENASA'",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        }).then(function(result){
                  
            if (result.value) {

                  window.location = `index.php?ruta=brutur/informePendientes`;

            }
        })

}

$('#btnEnviarSenasa').on('click',()=>{

    enviarPendientes();

})