/*Mostrar cuadro de información cuando hay texto en el cuadro de busqueda*/

input_busqueda.addEventListener("input", function (evt) {
    let contenido
    let visible = "hidden"
    contenido = evt.target.value
    visible = cuadro_informacion.attributes.activo.value
    if (contenido != "") {
        if (visible == "hidden") {
            // cuadro_informacion.style.visibility="visible"
            mostrar_cuadro_informacion()
            activar_enter()
        }
        return
    }

    ocultar_cuadro_informacion()
})

const mostrar_cuadro_informacion = () => {
    cuadro_informacion.attributes.activo.value = "visible"
    cuadro_informacion.classList.remove("entrada-creciente-r")
    cuadro_informacion.classList.add("entrada-creciente")
}
const ocultar_cuadro_informacion = () => {
    cuadro_informacion.attributes.activo.value = "hidden"
    cuadro_informacion.classList.remove("entrada-creciente")
    cuadro_informacion.classList.add("entrada-creciente-r")
}
input_busqueda.addEventListener("focus", function () {
    console.log("focus")
})

/*Boton buscar enviar formulario*/
btn_buscar.addEventListener("click", function () {
    ocultar_cuadro_informacion()
    lista_contenedor_personas.innerHTML = ""
    btn_mostrar_todos.style.visibility="visible"
    

    datos_personas.set_desde_donde(0)
    datos_personas.set_registros_completos(false)
    
    datos_personas.solicitar_datos("busqueda", input_busqueda.value)

    /*ocultar cuadro de lugares*/
    parte_lugares.style.visibility="hidden"
    parte_lugares.style.height= "0px"

  /*  enviar_formulario(
        "Alumno/buscar", {
        Palabras_clave: input_busqueda.value
    }
    ).then(json => {
        
        if (json.respuesta && json.contenido.length!=0){
            lista_contenedor_personas.innerHTML = ""
            personas = json.contenido.map(datos => {
                return crear_persona_eventos(datos, lista_contenedor_personas)
            });
            btn_mostrar_todos.style.visibility="visible"
        }
    })*/
})

btn_mostrar_todos.addEventListener("click", function(){
    lista_contenedor_personas.innerHTML = ""
    btn_buscar.disabled=true

    datos_personas.set_desde_donde(0)
    datos_personas.set_registros_completos(false)
    datos_personas.solicitar_datos("solicitud_personas", "")


    btn_mostrar_todos.style.visibility="hidden"
    input_busqueda.value=""

    parte_lugares.style.visibility="visible"
    parte_lugares.style.height= ""
})

const activar_enter = () => {
    input_busqueda.addEventListener("keyup", function (e) {
        enter_pulsado(e)
    })
}
const enter_pulsado = (e) => {
    let tecla = e.keyCode
    if (tecla == 13) {
        btn_buscar.click()
        console.log("clickeado")
        btn_buscar.disabled=true
    }
}
//comentario para git
window.addEventListener("mousedown", function (e) {
    let elemento = e.target
    let visible
    if (input_busqueda.contains(elemento) || cuadro_informacion.contains(elemento)) {
        if (input_busqueda.value != "") {
            mostrar_cuadro_informacion()
        }
    } else {
        visible = cuadro_informacion.attributes.activo.value
        if (visible == "visible") {
            ocultar_cuadro_informacion()
        }

    }
})