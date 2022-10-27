function modal_personas({principal, datos }){
    mostrar_modal({id_modal: "modal_persona"})
    editar_datos_persona(datos)
}

function editar_datos_persona({ No_control, Nombre }){
    nombre_persona_modal.innerText=Nombre
    no_control_persona_modal.innerText=No_control
}
function actualizar_cuadro_dias(cuadro_dias){
    cuadro_dias.actualizar_cuadro_dias()
}
window.addEventListener("load", function () {
    modal_persona_cerrar.addEventListener("click", function () {
     //   alert("pulsado")
       
    }
    )
})