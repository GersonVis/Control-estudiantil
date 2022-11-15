const obtener_fecha = () => {
    const hoy = new Date();
    const fecha_hoy = hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, "0") + "-" + String(hoy.getDate()).padStart(2, "0")
    return fecha_hoy
}
const crear_elemento = function ({ tipo, clases, estilos, id }) {
    let elemento = document.createElement(tipo)
    elemento.id = id ?? ""
    estilos = estilos ?? []
    clases = clases ?? []
    clases.forEach(clase => {
        elemento.classList.add(clase)
    })
    estilos.forEach(datos => {
        // console.log(datos)
        elemento.style[datos["estilo"]] = datos["valor"]
    })
    return elemento
}
const mensaje_informatico = function ({ msg, titulo, cancelar, aceptar }) {
    $("#modal-msg").modal("show")
    cancelar=cancelar??{}
    aceptar=aceptar??{}
    modal_msg.titulo.innerText=titulo??"Aviso"
    modal_msg.cuerpo.innerText=msg??"Mensaje"
    modal_msg.aceptar.innerText=aceptar.texto??"Aceptar"

    modal_msg.cancelar.innerText=cancelar.texto??"Cancelar"

    modal_msg.aceptar.style.backgroundColor=aceptar.color??"#007bff"
    modal_msg.aceptar.style.color=aceptar.letras??"black"
    
    if(modal_msg.aceptar.evt_an){
        modal_msg.aceptar.removeEventListener("click", modal_msg.aceptar.evt_an, true)
    }
    modal_msg.aceptar.evt_an=function(){
        aceptar.evento()??function(){}
    }
    modal_msg.aceptar.addEventListener("click", modal_msg.aceptar.evt_an, true)
}
const animacion_carga = function (contenedor, color="blue") {
    let elemento_animacion = crear_elemento({
        tipo: "div", clases: ["animacion-carga", "position-absolute", "d-flex", "w-100", "h-100",
            "justify-content-center", "align-items-center"
        ],
        estilos:[
        {estilo: "top", valor: "0px"},
        {estilo: "left", valor: "0px"},
        {estilo: "background-color", valor: color}]
    })
    elemento_animacion.innerHTML = 
   `<div class="spinner-border spinner-border-sm" role="status">
   <span class="sr-only">Loading...</span>
 </div>
 <div class="spinner-grow spinner-grow-sm" role="status">
   <span class="sr-only">Loading...</span>
 </div>`
    contenedor.appendChild(elemento_animacion)
    return elemento_animacion
}
const carga_terminada=function(contenedor){
    let elemento_carga=contenedor.querySelectorAll(".animacion-carga")[0]
    elemento_carga.remove()

}