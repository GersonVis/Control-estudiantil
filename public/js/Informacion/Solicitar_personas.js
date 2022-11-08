var datos_personas
solicitar_personas = function (url, contenedor_respuesta, cuantos = 5, desde_donde = 0) {
    var cuantos = cuantos
    var desde_donde = desde_donde ?? 0
    var en_uso = false, registros_completos = false
    var instancia = this
    var contenedor_respuesta = contenedor_respuesta
    var elemento_carga = crear_elemento({ tipo: "div", clases: ["d-flex", "w-100", "justify-content-center", "align-items-center"] })
    elemento_carga.innerHTML = `<div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>`
    var graficos = {
        carga: { elemento: elemento_carga, agregado: false }
    }
    var accion_anterior = "solicitud_personas"
    var complemento_anterior = ""
    var function_solicitud = {
        solicitud_personas: async function (desde_donde, cuantos) {
            return enviar_formulario(url,
                {
                    Posicion_limite: desde_donde,
                    Numero_registros: cuantos
                })
        },
        busqueda: async function (desde_donde, cuantos, complemento) {
            return enviar_formulario(
                "Alumno/buscar", {
                Palabras_clave: complemento,
                Posicion_limite: desde_donde,
                Numero_registros: cuantos
            })
        }
    }
    this.retraso_mostrar = function (datos) {
        setTimeout(function () {
            instancia.remover_carga()

            datos.map(datos => {
                return crear_persona_eventos(datos, contenedor_respuesta)
            });
            instancia.set_en_uso(false)
        }, 1000)
    }
    this.set_function_solicitud = function set_function_solicitud(valor) {

    }
    this.set_accion_seleccionada = function set_accion_seleccionada(valor) {
        accion_seleccionada = valor
    }
    this.remover_carga = function remover_carga() {
        contenedor_respuesta.removeChild(graficos.carga.elemento)
    }
    this.agregar_carga = function agregar_carga() {
        contenedor_respuesta.appendChild(graficos.carga.elemento)
    }
    this.solicitar_datos = async function solicitar_datos(tipo = "", complemento = undefined) {
    //    console.log("tipo", tipo)
        tipo = tipo == "" ? accion_anterior : tipo;
        if (accion_anterior != tipo) {
            accion_anterior = tipo
        }
        complemento = complemento ?? complemento_anterior
        complemento_anterior = complemento

        if (en_uso || registros_completos) return;
        this.agregar_carga()
        var instancias_creadas
        en_uso = true
        var personas = await function_solicitud[tipo](desde_donde, cuantos, complemento)
    //    console.log("tipo: ",tipo, "personas", personas)
        if (personas.respuesta) {
            let registros_obtenidos = personas.contenido.length
            desde_donde += parseInt(registros_obtenidos)
            registros_completos = registros_obtenidos == 0 ? true : false
            this.retraso_mostrar(personas.contenido)
        }
    }
    this.set_desde_donde = function set_desde_donde(valor) {
        desde_donde = valor
    }
    this.set_registros_completos=function set_registros_completos(valor){
        registros_completos=valor
    }
    this.set_en_uso = function set_en_uso(valor) {
        en_uso = valor
    }
}
window.addEventListener("load", function (ev) {
    datos_personas = new solicitar_personas(url_personas, lista_contenedor_personas)//url_alumnos se encuentra en el index
    datos_personas.solicitar_datos()
})
function crear_persona_eventos(datos, contenedor_respuesta) {
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

scroll_global.addEventListener("wheel", function (e) {
    let moviendo = e.target
    if (moviendo.scrollTop + moviendo.offsetHeight >= moviendo.scrollHeight) {
        //   alert("solicitando mas")
        datos_personas.solicitar_datos()
    }
})