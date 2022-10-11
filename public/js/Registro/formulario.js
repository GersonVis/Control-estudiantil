/*
VALIDACIONES Y ANIMACIONES DEL FORMULARIO
*/
//botón que envía el formulariov
const btn_enviar = document.querySelector("#enviar")
const formulario = document.querySelector("#forma")
const numero_validaciones = 4

var personas_registradas = {}
var tiempo_bloqueo=3000
var valor_anterior = ""
var prueba
var largo_no_control = 8
var nombre
var no_control
var lugar
var accion_por_opcion = {
    "Entradad": () => {

    },
    "Automático": () => {
        // si no esta en la lista se puede registrar
        let persona=personas_registradas[no_control]??{disponible: true}
        console.log(persona)
        if (persona.disponible) {
            let formdata = new FormData(forma)
            nombre = validationCustom03.value
            no_control = validationCustom02.value
            lugar = form_opciones[1][0]
            formdata.append("lugar", lugar)
            enviar_formulario(formdata)
            return
        }
        alert("Número control bloqueado por 3s")
    },
    "Salida": () => {
        let persona=personas_registradas[no_control]??{disponible: true}
        console.log(persona)
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
    "actualizacion": ({id_entrada}) => {
        console.log("id_entrada"+id_entrada)
        console.log("registro"+id_entrada)
        remover_de_padre("registro"+id_entrada)

    }
}

// variable del formulario


btn_enviar.addEventListener("click", function () {
    if (formulario.querySelectorAll(":invalid").length == 0) {
        alert("Formulario enviado")
        accion_por_opcion[lugar = form_opciones[0][0]]()
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
           if(json.respuesta){
            prueba = json
            hora_entrada = json.contenido[0] ? json.contenido[0]["hora_entrada"] : ""
            id_entrada = json.contenido[0] ? json.contenido[0]["id_entrada"] : ""
            console.log("id_enctrada"+id_entrada)
            consecuencias[json.tipo_consulta]({id_entrada: id_entrada, 
                nombre: nombre, 
                no_control: no_control, 
                lugar:lugar, 
                hora_entrada: hora_entrada})
            agregar_registro(json)
            no_disponible(no_control)
            bloquear_por_tiempo(no_control, tiempo_bloqueo)
            console.log(json)
           }
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
        })
    return false
}

const disponibilidad=(no_control)=>{
    console.log("se ha cambiado la disponibilidad")
    personas_registradas[no_control].disponible=true
}
const no_disponible=(no_control)=>{
    personas_registradas[no_control].disponible=false
}
const bloquear_por_tiempo=(no_control, tiempo)=>{
    setTimeout(()=>{disponibilidad(no_control)}, tiempo)
}
const agregar_registro=(json)=>{
    personas_registradas[no_control]=json
    personas_registradas[no_control]["disponible"]=false
}

const enviar_formulario_salida=()=>{

}