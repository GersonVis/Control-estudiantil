
var pr_to
function crear_cuadro_dias(separacion, identificador, boton_reinicio) {
    var cuadritos_seleccionados
    let principal, contenedor_grilla
    let datos_creacion
    let contenedor_dias_dentro, p_mostrar_dias

    p_mostrar_dias=crear_elemento({id: "numero_modal_lugar", tipo: "p", clases: ["m-0", "p-0"], estilos: [{estilo: "color", valor: "var(--color-prioridad-baja-media)"}]})
    contenedor_dias_dentro=crear_elemento({tipo: "div", clases: ["d-flex"]})
    contenedor_dias_dentro.appendChild(p_mostrar_dias)

    principal = document.createElement("div")
    principal.classList.add("d-flex")
    principal.classList.add("flex-column")
    principal.classList.add("m-1")
    principal.classList.add("p-1")


    principal.appendChild(contenedor_dias_dentro)
    // datos del año para poder crear el cuadro de los días
    datos_creacion = datos_a_no(identificador)
    contenedor_grilla = document.createElement("div")
    contenedor_grilla.classList.add("rounded")
    contenedor_grilla.classList.add("d-flex")
    contenedor_grilla.classList.add("flex-column")
    contenedor_grilla.style.padding = "10px 10px 10px 10px"
    contenedor_grilla.style.border = "1px solid var(--color-decorativo)"
    let meses = obtener_meses_nombres()
    let contenedor_meses = crear_elemento({ tipo: "div", clases: ["w-100", "d-flex", "flex-row", "justify-content-around"] })
    contenedor_grilla.appendChild(contenedor_meses)
    datos_creacion["separacion"] = separacion
    //  console.log(datos_creacion)
    // cuadritos en mes son referencias a todos los cuadritos
    const { grilla, cuadritos_en_mes } = grilla_cuadros(datos_creacion)
    //creamos un elemento por cada mes
    datos_creacion.datos_a_no.forEach(({ nombre_mes }) => {
        let div_mes = crear_elemento({ tipo: "div", estilos: [{ estilo: "color", valor: "var(--color-prioridad-baja-media)" }] })
        //añadimos evento click del mnes
        div_mes.addEventListener("mouseover", function () {
            let dias_mios = cuadritos_en_mes[nombre_mes]
            //cuadritos_mes_lugar es una variable global esta en el index
            if (cuadritos_seleccionados) {
                cuadritos_seleccionados.forEach(cuadrito => {
                    cuadrito.classList.replace("seleccionado", "no-seleccionado")
                })
            }
            cuadritos_seleccionados = dias_mios
            dias_mios.forEach(cuadrito => {
                cuadrito.classList.remove("no-seleccionado")
                cuadrito.classList.add("seleccionado")
            })
        })
        div_mes.innerText = nombre_mes
        contenedor_meses.appendChild(div_mes)
    })

    contenedor_grilla.appendChild(grilla)
    principal.appendChild(contenedor_grilla)
    pr_to = grilla
    
    
    boton_reinicio.addEventListener("click", function(){
        if(cuadritos_seleccionados){
            Object.values(cuadritos_en_mes).forEach(meses => {
                meses.forEach(cuadrito=>{
                    cuadrito.classList.remove("seleccionado")
                    cuadrito.classList.remove("no-seleccionado")
                })
            })
            cuadritos_seleccionados=undefined
        }
    })


    return {principal: principal, etiqueta_dias_dentro: p_mostrar_dias,refencias_cuadritos: cuadritos_en_mes} 
}


function obtener_meses_nombres() {
    let meses = []
    let nombre_mes, mayuscula
    for (i = 1; i <= 12; i++) {
        nombre_mes = new Intl.DateTimeFormat('es-Es', { month: "long" }).format(new Date(i + "-1-2021"))
        //hacer mayuscula la primera letra
        mayuscula = nombre_mes[0].toUpperCase()
        nombre_mes = mayuscula + nombre_mes.substring(1)
        meses.push(nombre_mes)
    }
    return meses
}

function reiniciar_dias(identificador){
     datos_mes
}


function crear_elemento({ tipo, clases, estilos, id }) {
    let elemento = document.createElement(tipo)
    elemento.id = id ?? ""
    estilos = estilos ?? []
    clases = clases ?? []
    clases.forEach(clase => {
        elemento.classList.add(clase)
    })
    estilos.forEach(datos => {
        elemento.style[datos["estilo"]] = datos["valor"]
    })
    return elemento
}


function grilla_cuadros({ datos_a_no, dias_a_no, separacion }) {
    let renglon, pos, columnas
    let pos_corte, id_corte, dia_mes, identificador_corte, color_mes, nombre_mes
    let contenedor_grilla
    let dias_en_mes
    let datos_corte
    dias_en_mes = {}
    contenedor_grilla = document.createElement("div")
    contenedor_grilla.classList.add("d-flex")
    contenedor_grilla.classList.add("flex-row")
    contenedor_grilla.style.flexGrow = "1"
    columnas = parseInt(dias_a_no / separacion)
    pos = 0
    datos_corte = datos_a_no[0]
    pos_corte = datos_corte["dias"]
    identificador_corte = datos_corte["mes"]
    nombre_mes = datos_corte["nombre_mes"]
    dias_en_mes[nombre_mes] = []
    color_mes = datos_corte["color"]
    id_corte = 1
    dia_mes = 0
    for (vuelta in [...Array(columnas).keys()]) {
        renglon = crear_row()
        for (dentro in [...Array(separacion).keys()]) {
            pos++
            dia_mes++
            if (pos > pos_corte) {
                let datos = datos_a_no[id_corte]
                if (datos) {
                    identificador_corte = datos["mes"]
                    color_mes = datos["color"]
                    pos_corte += datos["dias"]
                    nombre_mes = datos["nombre_mes"]
                    dias_en_mes[nombre_mes] = []
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
            let cuadrito = crear_cuadrito({ id: id_cuadrito, color: color_mes, clase: identificador_corte })
            // guardamos el elemento en el array
            dias_en_mes[nombre_mes].push(cuadrito)

            renglon.appendChild(cuadrito)
        }
        contenedor_grilla.appendChild(renglon)
    }
    let restantes = dias_a_no - (columnas * separacion)
    if (restantes != 0) {
        renglon = crear_row()
        for (dentro in [...Array(restantes).keys()]) {
            pos++
            dia_mes++
            let id_cuadrito = identificador_corte + "-" + dia_mes.toString().padStart(2, 0)
            console.log(id_cuadrito)
            let cuadrito = crear_cuadrito({ id: id_cuadrito, color: color_mes, clase: identificador_corte })
            dias_en_mes[nombre_mes].push(cuadrito)
            renglon.appendChild(cuadrito)
        }
        contenedor_grilla.appendChild(renglon)
    }

    return { grilla: contenedor_grilla, cuadritos_en_mes: dias_en_mes }
}



function crear_cuadrito({ id, color, clase }) {
    let cuadrito = document.createElement("div")
    cuadrito.id = id
    cuadrito.className = "cuadrito " + clase
    cuadrito.style.minHeight = "10px"
    // cuadrito.style.backgroundColor = color
    cuadrito.style.height = "10px"
    cuadrito.style.minWidth = "10px"
    cuadrito.style.width = "10px"
    // cuadrito.style.backgroundColor = "var(--color-prioridad-baja-baja)"
    cuadrito.style.margin = "1px"
    return cuadrito
}
function crear_row() {
    let renglon = document.createElement("div")
    renglon.classList.add("d-flex")
    renglon.classList.add("flex-column")
    renglon.style.flexGrow = "1"
   // renglon.style.position = "relative"
    return renglon
}

function datos_a_no(identificador) {
    let datos_meses = []
    let hoy = new Date()
    let a_no = hoy.getFullYear()
    let dias_completo = 0
    let datos_mes = {}
    let dias = 0
    let colores = ["#2ECCE8", "#2ECCE8", "#2ECCE8", "#2ECCE8", "#2ECCE8", "#2ECCE8", "#2ECCE8", "#2ECCE8", "#2ECCE8", "#2ECCE8", "#2ECCE8", "#2ECCE8"]
    for (mes = 1; mes <= 12; mes++) {

        // Nombre del mes
        nombre_mes = new Intl.DateTimeFormat('es-Es', { month: "long" }).format(new Date(mes + "-1-2021"))
        //hacer mayuscula la primera letra
        mayuscula = nombre_mes[0].toUpperCase()
        nombre_mes = mayuscula + nombre_mes.substring(1)


        dias = new Date(a_no, mes, 0).getDate()
        //   console.log(a_no, mes, dias)
        datos_mes = { dias: dias, mes: identificador + a_no + "-" + mes.toString().padStart(2, 0), color: colores[mes - 1], nombre_mes: nombre_mes.substring(0,3)+"." }
        datos_meses.push(datos_mes)
        dias_completo += dias

    }
    return { datos_a_no: datos_meses, dias_a_no: dias_completo }
}