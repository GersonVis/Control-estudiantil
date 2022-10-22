
solicitar_alumnos=(url, contenedor_respuesta)=>{
    enviar_formulario(url)
    .then(respuesta=>{
       if(respuesta){
                personas=respuesta.contenido.map(datos => {
                let interfaz_persona=alumno_lista(datos)
                contenedor_respuesta.appendChild(interfaz_persona.principal)
                return interfaz_persona
            });
       }
    })
}
window.addEventListener("load", function(ev){
    solicitar_alumnos(url_alumnos, lista_contenedor_alumnos)//url_alumnos se encuentra en el index
})
