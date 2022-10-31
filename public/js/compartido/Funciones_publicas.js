const obtener_fecha=()=>{
    const hoy = new Date();
    const fecha_hoy = hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, "0") + "-" + String(hoy.getDate()).padStart(2, "0")
    return fecha_hoy
}
this.crear_elemento = function ({ tipo, clases, estilos, id }) {
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