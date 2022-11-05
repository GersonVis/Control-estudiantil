
solicitar_lugares=(url, contenedor_respuesta)=>{
    enviar_formulario(url)
    .then(respuesta=>{
       if(respuesta){
           /* let lugares=respuesta.contenido.map(datos => {
              
                let interfaz_lugar=lugar({nombre_lugar: datos.Id_lugar})
                add_eventos_lugar({principal: interfaz_lugar.principal, datos: datos, cuadro_dias: cuadro_dias_lugar})
                contenedor_respuesta.appendChild(interfaz_lugar.principal)
                return interfaz_lugar
            });*/
       }
    })
}
window.addEventListener("load", function(ev){
    let elemento_general=lugar({nombre_lugar: "General"})
    lista_contenedor_lugares.appendChild(elemento_general.principal)
    solicitar_lugares(url_lugares, lista_contenedor_lugares)//url_alumnos se encuentra en el index
})

function add_eventos_lugar({principal,  datos, cuadro_dias}){
    principal.addEventListener("click", function(){
        modal_lugares({principal: principal, datos: datos})
        grafica_lugar_CoL.solicitar_datos(datos.Id_lugar)
        grafica_lugar_CoC.solicitar_datos(datos.Id_lugar)
        cuadro_dias.reiniciar_estilos_cuadro()
        cuadro_dias.solicitar_datos(datos.Id_lugar)



        //asistencias
        /*solicitar_dias(datos.No_control, { Fecha: fecha_inicio, Fecha_fin: hoy })
            .then(contenido => {
                cuadro_dias.marcar_dias(contenido,"entradas_registradas", "asistencia", function(entradas, elemento){
                    elemento.innerText=entradas!=1?entradas+" Entradas":"1 Entrada"
                })
            }
            )
        // solicitar no asistencias
        solicitar_dias(datos.No_control, { Fecha: fecha_inicio, Fecha_fin: hoy, Hora_salida: "is null"})
            .then(contenido => {
                cuadro_dias.marcar_dias(contenido,"entradas_sin_salida", "no-asistencia", function(entradas, elemento){
                    
                    elemento.innerText=entradas!=1?entradas+" Entradas sin registro":"1 Entrada sin registro"
                })
            }
            )*/
    })
 
}