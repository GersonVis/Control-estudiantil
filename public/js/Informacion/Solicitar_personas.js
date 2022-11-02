
solicitar_personas = (url, contenedor_respuesta) => {
    enviar_formulario(url)
        .then(respuesta => {
            if (respuesta) {
                personas = respuesta.contenido.map(datos => {
                    let interfaz_persona = alumno_lista(datos)
                    add_eventos_persona({ principal: interfaz_persona.principal, datos: datos, cuadro_dias: cuadro_dias_persona })
                    contenedor_respuesta.appendChild(interfaz_persona.principal)
                    return interfaz_persona
                });
            }
        })
}
window.addEventListener("load", function (ev) {
    solicitar_personas(url_personas, lista_contenedor_personas)//url_alumnos se encuentra en el index
})

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
