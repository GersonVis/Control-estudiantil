
solicitar_lugares=(url, contenedor_respuesta)=>{
    enviar_formulario(url)
    .then(respuesta=>{
       if(respuesta){
            let lugares=respuesta.contenido.map(datos => {
                //console.log(datos)
                let interfaz_lugar=lugar({nombre_lugar: datos.Id_lugar})
                add_eventos_lugar({principal: interfaz_lugar.principal, datos: datos})
                contenedor_respuesta.appendChild(interfaz_lugar.principal)
                return interfaz_lugar
            });
       }
    })
}
window.addEventListener("load", function(ev){
    let elemento_general=lugar({nombre_lugar: "General"})
    lista_contenedor_lugares.appendChild(elemento_general.principal)
    solicitar_lugares(url_lugares, lista_contenedor_lugares)//url_alumnos se encuentra en el index
})

function add_eventos_lugar({principal,  datos }){
    principal.addEventListener("click", function(){
        modal_lugares({principal: principal, datos: datos})
    })

}