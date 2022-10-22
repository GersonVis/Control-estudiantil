
solicitar_lugares=(url, contenedor_respuesta)=>{
    enviar_formulario(url)
    .then(respuesta=>{
       if(respuesta){
            let lugares=respuesta.contenido.map(datos => {
                console.log(datos)
                let interfaz_lugar=lugar({nombre_lugar: datos.Id_lugar})
                contenedor_respuesta.appendChild(interfaz_lugar.principal)
                return interfaz_lugar
            });
       }
    })
}
window.addEventListener("load", function(ev){
    solicitar_lugares(url_lugares, lista_contenedor_alumnos)//url_alumnos se encuentra en el index
})
