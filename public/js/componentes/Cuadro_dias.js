

function crear_cuadro_dias(dias, separacion) {
    let principal, grilla
    principal = document.createElement("div")
    principal.classList.add("d-flex")
    principal.classList.add("flex-column")
    principal.classList.add("m-1")
    principal.classList.add("p-1")
    principal.innerHTML =
        `<div class="d-flex">
        <p class="m-0 p-0" style="color: var(--color-prioridad-baja-media)">
            132 dias dentro de algún lugar
        </p>
        </div>`


    grilla = grilla_cuadros(dias, separacion)
    principal.appendChild(grilla)
    return principal
}


function grilla_cuadros(dias, separacion) {
    let renglon, pos
    let pos_corte, id_corte, datos_corte, identificador_corte
    let contenedor_grilla
    datos_corte = [{ dias: 30, mes: "Enero" }, { dias: 30, mes: "Febrero" }, { dias: 30, mes: "Marzo" }]
    contenedor_grilla = document.createElement("div")
    contenedor_grilla.classList.add("d-flex")
    contenedor_grilla.classList.add("flex-row")
    contenedor_grilla.classList.add("m-3")
    contenedor_grilla.classList.add("p-3")
    contenedor_grilla.classList.add("rounded")
    contenedor_grilla.style.border = "1px solid var(--color-decorativo)"
    contenedor_grilla.style.flexGrow = "1"
    let columnas = parseInt(dias / separacion)
    pos = 0
    pos_corte = datos_corte[0]["dias"]
    identificador_corte = datos_corte[0]["mes"]
    id_corte = 1
    for (vuelta in [...Array(columnas).keys()]) {
        let renglon = document.createElement("div")
        renglon.classList.add("d-flex")
        renglon.classList.add("flex-column")
        renglon.style.flexGrow = "1"
        for (dentro in [...Array(separacion).keys()]) {
            pos++
            if (pos > pos_corte) {
                let datos = datos_corte[id_corte]
                if (datos) {
                    identificador_corte = datos["mes"]
                    pos_corte += datos["dias"]
                    id_corte++
                } else {
                    identificador_corte="NAN"
                    pos_corte = dias
                }
            }
            let id_cuadrito=pos+"-"+identificador_corte
            console.log(id_cuadrito)
            let cuadrito = crear_cuadrito(id_cuadrito)
            renglon.appendChild(cuadrito)
        }
        contenedor_grilla.appendChild(renglon)
    }
    let restantes=dias-(columnas*separacion)
    if(restantes!=0){
        renglon=crear_row(restantes)
        contenedor_grilla.appendChild(renglon)
    }
   

   
     
    /*  pos = 0
      pos_corte = datos_corte[0]["dias"]
      identificador_corte = datos_corte[0]["mes"]
      id_corte=1
      while (pos <= dias) {
          if(pos>pos_corte){
              let sumar_corte=datos_corte[id_corte]["dias"]
              if(sumar_corte){
                  identificador_corte = sumar_corte["mes"]
                  pos_corte+=sumar_corte
                  id_corte++
                  console.log("ha ocurrido un corte", pos_corte)
              }else{
                  pos_corte=dias
              }
  
          }
  
          renglon = crear_row(separacion, pos, pos_corte)
          contenedor_grilla.appendChild(renglon)
          pos += separacion
  
      }
      console.log(pos, dias)
      diferencia=pos-dias
      if(diferencia!=0){
          renglon = crear_row(diferencia)
          contenedor_grilla.appendChild(renglon)
      }
      
     */

    return contenedor_grilla
}



function crear_cuadrito(id) {
    let cuadrito = document.createElement("div")
    cuadrito.id=id
    cuadrito.style.minHeight = "10px"
    cuadrito.style.height = "10px"
    cuadrito.style.minWidth = "10px"
    cuadrito.style.width = "10px"
    cuadrito.style.backgroundColor = "var(--color-prioridad-baja-baja)"
    cuadrito.style.margin = "1px"
    return cuadrito
}
function crear_row(largo) {
    let renglon = document.createElement("div")
    renglon.classList.add("d-flex")
    renglon.classList.add("flex-column")
    renglon.style.flexGrow = "1"
    for (pos in [...Array(largo).keys()]) {
        let cuadrito = crear_cuadrito()
        renglon.appendChild(cuadrito)
    }
    return renglon
}
