/*
VALIDACIONES Y ANIMACIONES DEL FORMULARIO
*/
//botón que envía el formulariov
const btn_enviar = document.querySelector("#enviar")
const formulario = document.querySelector("#forma")
const numero_validaciones = 4
const lista_lugares = document.querySelector("#list-lugares")
const lista_accciones = document.querySelector("#list-acciones")
var personas_registradas = {}

var bloqueos = {}

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
        let persona = bloqueos[no_control] ?? { disponible: true }
        console.log(bloqueos)
        if (lista_lugares.querySelectorAll(".active").length == 1) {
            if (persona.disponible) {


                no_control = validationCustom02.value

                bloqueos[no_control] = { disponible: false }


                let formdata = new FormData(forma)
                nombre = validationCustom03.value

                lugar = seleccion_opciones[1]

                formdata.append("lugar", lugar)
                let no_control_dentro = no_control.toString()
                enviar_formulario(formdata, no_control_dentro)
                return
            }
            mostrar_informacion("Espera", "El número de control esta bloqueado por 3 segundos")
            return
        }
        mostrar_informacion("Sin lugar seleccionado", "No has seleccionado ningún lugar todavía, da click sobre alguna de las opciones de la lista de lugares")
    },
    "Salida": () => {
        let persona = personas_registradas[no_control] ?? { disponible: true }

        if (persona.disponible) {
            let no_control_pasar
            let formdata = new FormData(forma)
            nombre = validationCustom03.value
            no_control = validationCustom02.value
            no_control_pasar = no_control.toString()
            enviar_formulario_salida(formdata, no_control_pasar)
            return
        }

    }
}
//que hacer dependiendo de la respuesta del envio del formulario
const consecuencias = {
    "creacion": (json) => {
        personas_registradas[json.No_control] = json
        mostrar_informacion("Registro", "Se realizo el registro correctamente")
        registro_exitoso(json)

    },//funcion en el archivo inserción
    "actualizacion": ({ Id_acceso, No_control }) => {
        mostrar_informacion("Salida", "Se registro salida para el Número de control " + No_control)
        remover_de_padre("registro" + Id_acceso)
        delete personas_registradas[No_control]

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
const enviar_formulario = (formdata, no_control_dentro) => {
    mostrar_informacion("Formulario enviado", "Se esta realizando la petición")
    fetch("Entrada/entradaAumatica", {
        method: "POST",
        body: formdata
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            console.log(json)
            prueba = json
            if (json.respuesta) {
               


                registro = json.contenido[0]

                // no_disponible(no_control)
                bloqueos[no_control_dentro]["disponible"] = false
                // agregamos una nueva linea de codigo

                bloquear_por_tiempo(no_control_dentro, tiempo_bloqueo)

                consecuencias[json.tipo_consulta](registro)


            }else{
                mostrar_informacion("Error en la acción", json.codigo)
                bloqueos[no_control] = { disponible: true }
            }
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
            bloqueos[no_control] = { disponible: true }
            // bloqueos[no_control].disponible=true
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
             
              /*  prueba = json
                registro = json.contenido[0]
                //agrega el registro a la lista pero sin animacion de bloqueo
                registro_exitoso_entrada(registro)
                agregar_registro(json)
               // no_disponible(no_control)*/
               registro = json.contenido[0]

               // no_disponible(no_control)
               bloqueos[no_control]["disponible"] = false


             //  bloquear_por_tiempo(no_control, tiempo_bloqueo)

               consecuencias[json.tipo_consulta](registro)

                return
            }
            mostrar_informacion("Error en la acción", json.codigo)
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
        })
}
const enviar_formulario_salida = (formdata, no_control_dentro) => {

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
                    consecuencias[json.tipo_consulta](personas_registradas[no_control_dentro])
                 
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

const accion_salida = (Id_acceso, no_control_dentro) => {
    console.log(Id_acceso)
    console.log(no_control_dentro)
    let formdata = new FormData()
    //mostrar_informacion("Registrar salida", "Registraras salida para esta persona")
    formdata.append("No_control", no_control_dentro)
    formdata.append("Id_acceso", Id_acceso)
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
                    consecuencias[json.tipo_consulta](personas_registradas[no_control_dentro])

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
const remover_padre=()=>{

}


const disponibilidad = (no_control) => {
    personas_registradas[no_control].disponible = true
}
const no_disponible = (no_control) => {
    personas_registradas[no_control].disponible = false
}


const bloquear_por_tiempo = (no_control_a, tiempo) => {
    setTimeout(() => {
        bloqueos[no_control_a] = { disponible: true }
    }, tiempo)
}


const agregar_registro = (json) => {
    personas_registradas[json.no_control] = json
}

