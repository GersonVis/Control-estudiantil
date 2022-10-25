function solicitar_dias(no_control){
  
    enviar_formulario("entrada/diasAlumno/"+no_control)
    .then(json=>{
        if(json.respuesta){
            json.contenido.forEach(registro=>{
                let cuadrito=document.querySelector("#lugar"+registro.fecha)
                if(cuadrito){
                    cuadrito.classList.add("asistencia")
                    return
                }
             //   console.log(registro.fecha)
                
            })
            let dias=json.contenido.length
            let grafico_dias_dentro=document.querySelector("#numero_modal_lugar")
            grafico_dias_dentro.innerText=dias+" dias dentro de algún lugar"
           
        }
    }
    )
}
solicitar_dias("20670109")