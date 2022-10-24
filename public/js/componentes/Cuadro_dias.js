
function datos_a_no(identificador) {
    let datos_meses = []
    let hoy = new Date()
    let a_no = hoy.getFullYear()
    let dias_completo = 0
    let datos_mes = {}
    let dias = 0
    for (mes = 1; mes <= 12; mes++) {
        dias = new Date(a_no, mes, 0).getDate()
     //   console.log(a_no, mes, dias)
        datos_mes = { dias: dias, mes: identificador + a_no + "-" + mes.toString().padStart(2, 0) }
        datos_meses.push(datos_mes)
        dias_completo += dias

    }
    return { datos_a_no: datos_meses, dias_a_no: dias_completo }
}
function crear_cuadro_dias(separacion, identificador) {
    let principal, grilla, contenedor_grilla
    let datos_creacion
    principal = document.createElement("div")
    principal.classList.add("d-flex")
    principal.classList.add("flex-column")
    principal.classList.add("m-1")
    principal.classList.add("p-1")
    principal.innerHTML =
        `<div class="d-flex">
        <p  id="numero_modal_lugar" class="m-0 p-0" style="color: var(--color-prioridad-baja-media)">
            132 dias dentro de algún lugar
        </p>
        </div>`
    // datos del año para poder crear el cuadro de los días
    datos_creacion = datos_a_no(identificador)
    contenedor_grilla = document.createElement("div")

    contenedor_grilla.classList.add("rounded")
    contenedor_grilla.classList.add("d-flex")
    contenedor_grilla.classList.add("flex-column")
    contenedor_grilla.style.padding="10px 10px 10px 10px"
    contenedor_grilla.style.border = "1px solid var(--color-decorativo)"
    contenedor_grilla.innerHTML = `<div class="w-100 d-flex flex-row justify-content-around" style="">
    <div>Ene.</div>
    <div>Feb.</div>
    <div>Mar.</div>
    <div>Abr.</div>
    <div>May.</div>
    <div>Jun.</div>
    <div>Jul.</div>
    <div>Ago.</div>
    <div>Sep.</div>
    <div>Oct.</div>
    <div>Nov.</div>
    <div>Dic.</div>
    <div>`


    datos_creacion["separacion"] = separacion
  //  console.log(datos_creacion)
    grilla = grilla_cuadros(datos_creacion)
    contenedor_grilla.appendChild(grilla)
    principal.appendChild(contenedor_grilla)
    return principal
}


function grilla_cuadros({ datos_a_no, dias_a_no, separacion }) {
    let renglon, pos, columnas
    let pos_corte, id_corte, dia_mes, identificador_corte
    let contenedor_grilla
    //  datos_corte = [{ dias: 30, mes: "Enero" }, { dias: 30, mes: "Febrero" }, { dias: 30, mes: "Marzo" }]
    contenedor_grilla = document.createElement("div")
    contenedor_grilla.classList.add("d-flex")
    contenedor_grilla.classList.add("flex-row")
   // contenedor_grilla.style.padding="10px 10px 0px 10px"
    //contenedor_grilla.classList.add("m-3")
    //contenedor_grilla.classList.add("p-3")
    contenedor_grilla.style.flexGrow = "1"
    columnas = parseInt(dias_a_no / separacion)
    pos = 0
    pos_corte = datos_a_no[0]["dias"]
    identificador_corte = datos_a_no[0]["mes"]
    id_corte = 1
    dia_mes = 0
    for (vuelta in [...Array(columnas).keys()]) {
        renglon = document.createElement("div")
        renglon.classList.add("d-flex")
        renglon.classList.add("flex-column")
        renglon.style.flexGrow = "1"
        for (dentro in [...Array(separacion).keys()]) {
            pos++
            dia_mes++
            if (pos > pos_corte) {
                let datos = datos_a_no[id_corte]
                if (datos) {
                    identificador_corte = datos["mes"]
                    pos_corte += datos["dias"]
                    id_corte++
                    //reiniciamos el contador del día del mes
                    dia_mes = 0
                } else {
                    identificador_corte = "NAN"
                    pos_corte = dias
                }
            }
            let id_cuadrito = identificador_corte + "-" + dia_mes.toString().padStart(2, 0)
            //  console.log(id_cuadrito)
            let cuadrito = crear_cuadrito(id_cuadrito)
            renglon.appendChild(cuadrito)
        }
        contenedor_grilla.appendChild(renglon)
    }
    let restantes = dias_a_no - (columnas * separacion)
   
    if (restantes != 0) {
        renglon = crear_row(restantes)
        contenedor_grilla.appendChild(renglon)
    }

    return contenedor_grilla
}



function crear_cuadrito(id) {
    let cuadrito = document.createElement("div")
    cuadrito.id = id
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
