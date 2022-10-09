/*
VALIDACIONES Y ANIMACIONES DEL FORMULARIO
*/
//botón que envía el formulario
var valor_anterior = ""
var prueba
var largo_no_control = 8
var btn_enviar = document.querySelector("#enviar")
// variable del formulario


btn_enviar.addEventListener("click", function () {
    let formdata = new FormData(forma)
    formdata.append("lugar", form_opciones[1][0])
    enviar_formulario(formdata)
})





//var rellenar = ["❌", "❌", "❌", "❌", "❌", "❌", "❌", "❌"]
//"✔"

/*$('#validationCustom01').keyup(function (event) {
   // let rellenar = ["❌", "❌", "❌", "❌", "❌", "❌", "❌", "❌"]
    texto = $('#validationCustom01').val()
   /* for(let pos=0; pos<texto.length; pos++){
        rellenar[pos]="✔"
    }
    rellenar=rellenar.toString().replaceAll(",","")
    $("#mostrar_digitos").text(rellenar)*/
/*  console.log(event)
  prueba=event
  if(!$.isNumeric(texto)){
      alert("entro")
      event.preventDefault()
      return event
  }
  valor_anterior=texto
  $("#mostrar_digitos").text((largo_no_control-texto.length)+" Dígitos restantes")

})*/
validationCustom02.addEventListener("keypress", impedir_letras)


function impedir_letras(evt) {
    var charCode = evt.charCode;
    if (charCode != 0) {
        var numero = String.fromCharCode(charCode)
        if (!$.isNumeric(numero)) {
            evt.preventDefault();
            // $("#mostrar_digitos").text("Solo números")

        }
        let largo = $('#validationCustom02').val().length
        if(largo<8){
            $("#mostrar_digitos").text((largo_no_control - (largo+1)) + " Dígitos restantes")
        }
        
    }
}

//validamos formulario
//enviar.click()


const enviar_formulario = (formdata) => {

    console.log("formulario enviado")
    fetch("Entrada/entradaAumatica", {
        method: "POST",
        body: formdata
    })
        .then(respuesta => respuesta.text())
        .then(texto => {
            console.log(texto)
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
        })
    return false
}
