
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

        //asistencias
        solicitar_dias(datos.No_control, { Fecha: fecha_inicio, Fecha_fin: hoy })
            .then(contenido => {
                cuadro_dias.marcar_dias(contenido, "asistencia")
            }
            )
        // solicitar no asistencias
        solicitar_dias(datos.No_control, { Fecha: fecha_inicio, Fecha_fin: hoy, Hora_salida: "is null"})
            .then(contenido => {
                cuadro_dias.marcar_dias(contenido, "no-asistencia")
            }
            )

    })

}
