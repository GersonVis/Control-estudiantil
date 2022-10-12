/*
VALIDACIONES Y ANIMACIONES DEL FORMULARIO
*/
//botón que envía el formulariov
const btn_enviar = document.querySelector("#enviar")
const formulario = document.querySelector("#forma")
const numero_validaciones = 4
const lista_lugares = document.querySelector("#list-lugares")
const lista_accciones = document.querySelector("#list-acciones")
const lista_ingresos = document.querySelector("#lista_ingresos")
const boton_enviar=document.querySelector("#enviar")

var personas_registradas = {}
var tiempo_bloqueo = 3000
var valor_anterior = ""
var prueba
var largo_no_control = 8
var nombre
var no_control
var lugar
var accion_por_opcion = {
    "Entrada": () => {
        let formdata = new FormData(forma)
        nombre = validationCustom03.value
        no_control = validationCustom02.value
        lugar = seleccion_opciones[1]
        formdata.append("lugar", lugar)
        enviar_formulario_entrada(formdata)
        return
    },
    "Automático": () => {
        // si no esta en la lista se puede registrar
        let persona = personas_registradas[no_control] ?? { disponible: true }
        if (lista_lugares.querySelectorAll(".active").length == 1) {
            if (persona.disponible) {
                let json_datos, registro
                let formdata
                let nombre, no_control, lugar

                bloquear_elemento(boton_enviar)

                formdata = new FormData(forma)
                nombre = validationCustom03.value
                no_control = validationCustom02.value
                lugar = seleccion_opciones[1]
                formdata.append("lugar", lugar)

             /*   if (personas[no_control]) {
                    json_datos = { no_control: no_control, lugar: lugar, nombre: nombre, hora_entrada: "Esperando respuesta" }
                    registro = crear_elemento(json_datos)
                }*/

                enviar_formulario(formdata)

                return
            }
            alert("Número control bloqueado por 3s")
            return
        }
        mostrar_informacion("Sin lugar seleccionado", "No has seleccionado ningún lugar todavía, da click sobre alguna de las opciones de la lista de lugares")
    },
    "Salida": () => {
        let persona = personas_registradas[no_control] ?? { disponible: true }

        if (persona.disponible) {
            let formdata = new FormData(forma)
            nombre = validationCustom03.value
            no_control = validationCustom02.value
            lugar = form_opciones[1][0]
            formdata.append("lugar", lugar)
            enviar_formulario_salida(formdata)
            return
        }

    }
}
//que hacer dependiendo de la respuesta del envio del formulario
const consecuencias = {
    "creacion": registro_exitoso,//funcion en el archivo inserción
    "actualizacion": ({ id_entrada }) => {

        remover_de_padre("registro" + id_entrada)

    }
}

// variable del formulario


btn_enviar.addEventListener("click", function () {
    if (formulario.querySelectorAll(":invalid").length == 0) {
        if (lista_accciones.querySelectorAll(".active").length == 1) {
            accion_por_opcion[seleccion_opciones[0]]()
            return
        }
        mostrar_informacion("Sin acción seleccionada", "No has seleccionado ningúna acción todavía, da click sobre alguna de las acciones de la lista de acciones")
    }
})



validationCustom02.addEventListener("keypress", impedir_letras)
validationCustom02.addEventListener("input", regla_numeros)
function regla_numeros(evt) {
    let largo = $('#validationCustom02').val().length

    $("#mostrar_digitos").text((largo_no_control - (largo)) + " Dígitos restantes")

}
function impedir_letras(evt) {
    var charCode = evt.charCode;
    if (charCode != 0) {
        var numero = String.fromCharCode(charCode)
        if (!$.isNumeric(numero)) {
            evt.preventDefault();
            // $("#mostrar_digitos").text("Solo números")
        }
    }
}
var prueba = ""
const enviar_formulario = (formdata) => {

    fetch("Entrada/entradaAumatica", {
        method: "POST",
        body: formdata
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            bloquear_elemento(boton_enviar, false)
            console.log(json)
            if (json.respuesta) {
                prueba = json
                registro = json.contenido[0]
                consecuencias[json.tipo_consulta](registro)
                agregar_registro(json)

                no_disponible(no_control)

                bloquear_por_tiempo(no_control, tiempo_bloqueo)
                console.log(json)
            }
        })
        .catch(er => {
            bloquear_elemento(boton_enviar, false)
            console.error("ocurrio un error en la solicitud")
            console.error(er)
        })
    return false
}
const enviar_formulario_entrada = (formdata) => {

    fetch("Entrada/registrarEntrada", {
        method: "POST",
        body: formdata
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            console.log(json)
            if (json.respuesta) {
                prueba = json
                registro = json.contenido[0]
                //agrega el registro a la lista pero sin animacion de bloqueo
                registro_exitoso_entrada(registro)
                agregar_registro(json)
                no_disponible(no_control)

                return
            }
            mostrar_informacion("Error", json.codigo)
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
        })
}
const enviar_formulario_salida = (formdata) => {

    fetch("Entrada/registrarSalida", {
        method: "POST",
        body: formdata
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            console.log(json)
            if (json.respuesta) {
                if (json.registros_afectados != 0) {
                    registro = json.contenido[0]
                    consecuencias[json.tipo_consulta](registro)
                    mostrar_informacion("Salida", json.codigo)
                    return
                }
                mostrar_informacion("Salida", "El usuario no se encontró dentro de ningún lugar")
                return
            }
            mostrar_informacion("Error", json.codigo)
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
        })
}



const disponibilidad = (no_control) => {
    personas_registradas[no_control].disponible = true
}
const no_disponible = (no_control) => {
    personas_registradas[no_control].disponible = false
}
const bloquear_por_tiempo = (no_control, tiempo) => {
    setTimeout(() => { disponibilidad(no_control) }, tiempo)
}
const agregar_registro = (json) => {
    personas_registradas[no_control] = json
    personas_registradas[no_control]["disponible"] = false
}
const bloquear_elemento=(elemento, bloquear=true)=>{
    elemento.disabled=bloquear
}
