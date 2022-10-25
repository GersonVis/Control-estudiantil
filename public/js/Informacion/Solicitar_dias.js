var respuesta
function solicitar_dias(no_control){
    enviar_formulario("entrada/diasAlumno/"+no_control)
    .then(json=>{
        if(json.respuesta){
            respuesta=json
            json.contenido.forEach(registro=>{
                let fecha, datos_fecha
                let mes, dia
                fecha=registro.fecha
                datos_fecha=fecha.split("-")
                mes=datos_fecha[1]
                dia=datos_fecha[2]
                let cuadrito=Object.values(contenedor_dias)[parseInt(mes)][parseInt(dia)-1]
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
