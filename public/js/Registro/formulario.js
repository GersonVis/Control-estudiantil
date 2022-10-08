/*
VALIDACIONES Y ANIMACIONES DEL FORMULARIO
*/
var largo_no_control = 8
//var rellenar = ["❌", "❌", "❌", "❌", "❌", "❌", "❌", "❌"]
//"✔"
var valor_anterior=""
var prueba
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
validationCustom02.addEventListener("keypress", checkName)


function checkName(evt) {
  var charCode = evt.charCode;
  if (charCode != 0) {
    var numero=String.fromCharCode(charCode)
    if (!$.isNumeric(numero)) {
      validationCustom02.
      evt.preventDefault();
     // $("#mostrar_digitos").text("Solo números")
    
    }
  }
}