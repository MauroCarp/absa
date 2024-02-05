/*=============================================
SUMAR ANIMALES
=============================================*/

const sumarAnimales = (clase,idTotal,type)=>{

    let total = 0;
    $(`.${clase}`).each(function(){
        
       if(type == 'text'){
           
           let value = parseInt($(this).html())
           
           total += value

        }else{
            
            let value = parseInt($(this).val())
            
            total += value  
        }


    })
    
    if(type == "text"){

        $(`#${idTotal}`).text(total);
        
    }else{
        
        $(`#${idTotal}`).val(total);
    
    }

}

$('#btnActualizarStatus').on('click',()=>{
    
    sumarAnimales('animalesBruceEditar','totalBruceEditar','val')

    sumarAnimales('animalesTuberEditar','totalTuberEditar','val')

})

$('.animalesBruceEditar').on('change',()=>sumarAnimales('animalesBruceEditar','totalBruceEditar','val'))

$('.animalesTuberEditar').on('change',()=>sumarAnimales('animalesTuberEditar','totalTuberEditar','val'))
