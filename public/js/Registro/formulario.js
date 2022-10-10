/*
VALIDACIONES Y ANIMACIONES DEL FORMULARIO
*/
//botón que envía el formulariov
var btn_enviar = document.querySelector("#enviar")
var valor_anterior = ""
var prueba
var largo_no_control = 8
var nombre
var no_control
var lugar
//que hacer dependiendo de la respuesta del envio del formulario
const consecuencias = {
    "creacion": registro_exitoso,
    "actualizacion": () => {
        alert("Se registro salida")
    }
}

// variable del formulario


btn_enviar.addEventListener("click", function () {
    let formdata = new FormData(forma)
    nombre=validationCustom03.value
    no_control=validationCustom02.value
    lugar=form_opciones[1][0]
    formdata.append("lugar", lugar)
    enviar_formulario(formdata)
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
const enviar_formulario = (formdata) => {
   
    fetch("Entrada/entradaAumatica", {
        method: "POST",
        body: formdata
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            consecuencias[json.tipo_consulta](nombre, no_control, lugar)
            console.log(json)
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
        })
    return false
}
