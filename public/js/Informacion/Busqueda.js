/*Mostrar cuadro de información cuando hay texto en el cuadro de busqueda*/

input_busqueda.addEventListener("input", function(evt){
    let contenido
    let visible="hidden" 
    contenido=evt.target.value
    visible=cuadro_informacion.attributes.activo.value
    if(contenido!=""){
        if(visible=="hidden"){
           // cuadro_informacion.style.visibility="visible"
           mostrar_cuadro_informacion()
           activar_enter()
        }
        return
    }
    ocultar_cuadro_informacion()
})

const mostrar_cuadro_informacion=()=>{
    cuadro_informacion.attributes.activo.value="visible"
    cuadro_informacion.classList.remove("entrada-creciente-r")
    cuadro_informacion.classList.add("entrada-creciente")
}
const ocultar_cuadro_informacion=()=>{
    cuadro_informacion.attributes.activo.value="hidden"
    cuadro_informacion.classList.remove("entrada-creciente")
    cuadro_informacion.classList.add("entrada-creciente-r")
}
input_busqueda.addEventListener("focus", function(){
   console.log("focus")
})



const activar_enter=()=>{
    input_busqueda.addEventListener("keypress", function(e){
        enter_pulsado(e)
    })
}
const enter_pulsado=(e)=>{
    let tecla = e.keyCode
    if(tecla==13) alert("has pulsado enter")
}
//comentario para git
window.addEventListener("mousedown", function(e){
    let elemento=e.target
    let visible
    if(input_busqueda.contains(elemento) || cuadro_informacion.contains(elemento)){
       if(input_busqueda.value!=""){
        mostrar_cuadro_informacion()
       }
    }else{
        visible=cuadro_informacion.attributes.activo.value
        if(visible=="visible"){
            ocultar_cuadro_informacion()
        }
       
    }
})