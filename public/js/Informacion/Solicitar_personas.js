
solicitar_personas = (url, contenedor_respuesta) => {
    enviar_formulario(url)
        .then(respuesta => {
            if (respuesta) {
                personas = respuesta.contenido.map(datos => {
                    return crear_persona_eventos(datos, contenedor_respuesta)
                });
            }
        })
}
window.addEventListener("load", function (ev) {
    solicitar_personas(url_personas, lista_contenedor_personas)//url_alumnos se encuentra en el index
})
function crear_persona_eventos(datos, contenedor_respuesta){
    let interfaz_persona = alumno_lista(datos)
    add_eventos_persona({ principal: interfaz_persona.principal, datos: datos, cuadro_dias: cuadro_dias_persona })
    contenedor_respuesta.appendChild(interfaz_persona.principal, contenedor_respuesta)
    return interfaz_persona
}
function add_eventos_persona({ principal, datos, cuadro_dias }) {
    principal.addEventListener("click", function () {
        modal_personas({ principal: principal, datos: datos })
        cuadro_dias.reiniciar_estilos_cuadro()
        cuadro_dias.solicitar_datos(datos.No_control)
        grafica_persona_ds.solicitar_datos(datos.No_control)
        grafica_persona_h.solicitar_minutos(datos.No_control)
        grafica_persona_dh.solicitar_datos(datos.No_control)
        grafica_persona_CoL.solicitar_datos(datos.No_control)
    })

}
