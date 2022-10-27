function Cuadro_dias(separacion, identificador) {
    this.separacion = separacion
    this.identificador = identificador
    this.cuadros_dias
    this.interfaz = {}
    this.cuadritos_seleccionados
    var cuadritos_seleccionados = []
    this.crear_interfaz = function () {

        let principal, contenedor_grilla
        let datos_creacion
        let contenedor_dias_dentro, p_numero_entradas

        p_numero_entradas = this.crear_elemento({ id: "numero_modal_lugar", tipo: "p", clases: ["m-0", "p-0"], estilos: [{ estilo: "color", valor: "var(--color-prioridad-baja-media)" }] })
        contenedor_dias_dentro = this.crear_elemento({ tipo: "div", clases: ["d-flex"] })
        contenedor_dias_dentro.appendChild(p_numero_entradas)

        principal = document.createElement("div")
        principal.classList.add("d-flex")
        principal.classList.add("flex-column")
        principal.classList.add("m-1")
        principal.classList.add("p-1")


        principal.appendChild(contenedor_dias_dentro)
        // datos del año para poder crear el cuadro de los días
        datos_creacion = this.datos_a_no(this.identificador)
        contenedor_grilla = document.createElement("div")
        contenedor_grilla.classList.add("rounded")
        contenedor_grilla.classList.add("d-flex")
        contenedor_grilla.classList.add("flex-column")
        contenedor_grilla.style.padding = "10px 10px 10px 10px"
        contenedor_grilla.style.border = "1px solid var(--color-decorativo)"
        let meses = this.obtener_meses_nombres()
        let contenedor_meses = this.crear_elemento({ tipo: "div", clases: ["w-100", "d-flex", "flex-row", "justify-content-around"] })
        contenedor_grilla.appendChild(contenedor_meses)
        datos_creacion["separacion"] = this.separacion
        //  console.log(datos_creacion)
        // cuadritos en mes son referencias a todos los cuadritos
        const { grilla, cuadritos_en_mes } = this.grilla_cuadros(datos_creacion)
        //creamos un elemento por cada mes
        var mes_anterior = ""
        datos_creacion.datos_a_no.forEach(({ nombre_mes }) => {
            let div_mes = this.crear_elemento({ tipo: "div", estilos: [{ estilo: "color", valor: "var(--color-prioridad-baja-media)" }] })
            //añadimos evento click del mnes
            div_mes.addEventListener("mouseover", function () {
                let dias_mios = cuadritos_en_mes[nombre_mes]
                //cuadritos_mes_lugar es una variable global esta en el index


                if (nombre_mes == mes_anterior) {
                    if (!dias_mios[0].classList.contains("seleccionado")) {
                        dias_mios.forEach(cuadrito => {
                            cuadrito.classList.remove("no-seleccionado")
                            cuadrito.classList.add("seleccionado")
                        })
                        return
                    }
                    dias_mios.forEach(cuadrito => {
                        cuadrito.classList.remove("seleccionado")
                        cuadrito.classList.add("no-seleccionado")
                    })
                    return
                }

                cuadritos_seleccionados.forEach(cuadrito => {
                    cuadrito.classList.replace("seleccionado", "no-seleccionado")
                })
                dias_mios.forEach(cuadrito => {
                    cuadrito.classList.remove("no-seleccionado")
                    cuadrito.classList.add("seleccionado")
                })

                cuadritos_seleccionados = dias_mios
                mes_anterior = nombre_mes

            })
            div_mes.innerText = nombre_mes
            contenedor_meses.appendChild(div_mes)
        })




        contenedor_grilla.appendChild(grilla)
        principal.appendChild(contenedor_grilla)
        pr_to = grilla

        let contenedor_indicadores = this.crear_elemento({ tipo: "div", clases: ["d-flex", "flex-column"] })

        let contenedor_asistencia = this.crear_elemento({
            tipo: "div", clases: ["d-flex", "flex-row", "align-items-center"],
            estilos: [{ estilo: "gap", valor: "4px" },
            { estilo: "color", valor: "var(--color-prioridad-baja-baja)" },
            { estilo: "font-size", valor: "10pt" }]
        })
        let contenedor_sin_salida = this.crear_elemento({
            tipo: "div", clases: ["d-flex", "flex-row", "align-items-center"],
            estilos: [{ estilo: "gap", valor: "4px" },
            { estilo: "color", valor: "var(--color-prioridad-baja-baja)" },
            { estilo: "font-size", valor: "10pt" }
            ]
        })

        let cuadrito_asistencia = this.crear_cuadrito("cuadrito_asitencia")
        cuadrito_asistencia.classList.add("asistencia")

        let cuadrito_sin_salida = this.crear_cuadrito("cuadrito_asitencia")
        cuadrito_sin_salida.classList.add("no-asistencia")



        contenedor_asistencia.appendChild(cuadrito_asistencia)
        contenedor_asistencia.innerHTML += "Asistencias"
        contenedor_sin_salida.appendChild(cuadrito_sin_salida)
        contenedor_sin_salida.innerHTML += "No registro salida"

        contenedor_indicadores.appendChild(contenedor_asistencia)
        contenedor_indicadores.appendChild(contenedor_sin_salida)



        contenedor_grilla.appendChild(contenedor_indicadores)


        this.cuadros_dias = cuadritos_en_mes
        this.interfaz["entradas_registradas"] = p_numero_entradas
        return principal
    }
    this.obtener_meses_nombres = function () {
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
    },
        this.reiniciar_estilos_cuadro = function reiniciar_estilos() {
            {

                Object.values(this.cuadros_dias).forEach(meses => {
                    meses.forEach(cuadrito => {
                        [a, b] = cuadrito.classList
                        cuadrito.classList = a + " " + b
                    })
                })
                cuadritos_seleccionados = []

            }
        }
    this.reiniciar_dias = function (identificador) {
        datos_mes
    }
    this.marcar_dias = function (dias, clase_nombre) {
        let entradas = 0
        dias.forEach(registro => {
            let fecha, datos_fecha
            let mes, dia
            entradas += +registro.conteo
            fecha = registro.fecha
            datos_fecha = fecha.split("-")
            mes = datos_fecha[1]
            dia = datos_fecha[2]
            let cuadrito = Object.values(this.cuadros_dias)[parseInt(mes) - 1][parseInt(dia) - 1]
            if (cuadrito) {
                cuadrito.classList.add(clase_nombre)
                return
            }
            //   console.log(registro.fecha)

        })
        this.interfaz["entradas_registradas"].innerText = entradas + " Entradas registradas"
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
    },


        this.grilla_cuadros = function ({ datos_a_no, dias_a_no, separacion, a_no }) {


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

            pos = 0
            datos_corte = datos_a_no[0]
            pos_corte = datos_corte["dias"]
            identificador_corte = datos_corte["mes"]
            nombre_mes = datos_corte["nombre_mes"]
            dias_en_mes[nombre_mes] = []
            color_mes = datos_corte["color"]
            id_corte = 1
            dia_mes = 0


            //recorrer días para coincidir con semana
            inicio_an_o = new Date(a_no + "-01-01")



          
         /*   renglon = this.crear_row()
            renglon.classList.add("justify-content-end")
            let dias_semana=["J", "V", "S", "D", "L", "M", "M"]
            for (dentro in [...Array(7).keys()]) {

               
                let cuadrito = this.crear_cuadrito({ id: "", color: color_mes, clase: identificador_corte })
                let dia_letra=this.crear_elemento({tipo: "p", 
                clases:["m-0","p-0"], estilos:[{estilo: "font-size", valor:"7pt"}]})
                dia_letra.innerText=dias_semana[dentro]
                cuadrito.appendChild(dia_letra)
                cuadrito.classList=[]
                cuadrito.classList.add("justify-content-center")
                cuadrito.classList.add("align-items-center")
                renglon.appendChild(cuadrito)
            }
            contenedor_grilla.appendChild(renglon)
*/

            let contenedor_cuadritos=this.cuadro();

            let recorrido = inicio_an_o.getUTCDay()
            renglon = this.crear_row()
          //  renglon.classList.add("justify-content-end")

            
           

            for (dentro in [...Array(recorrido).keys()]) {
                pos++
                dia_mes++
                let id_cuadrito = identificador_corte + "-" + dia_mes.toString().padStart(2, 0)
              //  console.log(id_cuadrito)
              let cuadrito = this.crear_cuadrito({mes:nombre_mes, id: id_cuadrito, color: color_mes, clase: identificador_corte, dia: dia_mes.toString().padStart(2, 0)})
                dias_en_mes[nombre_mes].push(cuadrito)
                renglon.appendChild(cuadrito)
            }

            
            contenedor_cuadritos.appendChild(renglon)


        //    contenedor_grilla.appendChild(contenedor_cuadritos)
            columnas = parseInt((dias_a_no - recorrido) / separacion)
            let crear_nuevo=false
            for (vuelta in [...Array(columnas).keys()]) {
                renglon = this.crear_row()
                
                for (dentro in [...Array(separacion).keys()]) {
                    
                    pos++
                    dia_mes++
                    if (pos > pos_corte) {
                        let datos = datos_a_no[id_corte]
                  //      console.log(datos)
                        if (datos) {
                            crear_nuevo=true
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
                    console.log(nombre_mes)
                    let id_cuadrito = identificador_corte + "-" + dia_mes.toString().padStart(2, 0)
                    //  console.log(id_cuadrito)
                    let cuadrito = this.crear_cuadrito({mes:nombre_mes, id: id_cuadrito, color: color_mes, clase: identificador_corte, dia: dia_mes.toString().padStart(2, 0)})
                    // guardamos el elemento en el array
                    dias_en_mes[nombre_mes].push(cuadrito)
                    renglon.appendChild(cuadrito)
                    
                }
                contenedor_cuadritos.appendChild(renglon)
                if(crear_nuevo){
                    crear_nuevo=false
                    contenedor_grilla.appendChild(contenedor_cuadritos)
                    contenedor_cuadritos=this.cuadro()
                }
               
            }
            let restantes = (dias_a_no - (columnas * separacion)) - recorrido
            if (restantes != 0) {
                renglon = this.crear_row()
                for (dentro in [...Array(restantes).keys()]) {
                    pos++
                    dia_mes++
                    let id_cuadrito = identificador_corte + "-" + dia_mes.toString().padStart(2, 0)
                 //   console.log(id_cuadrito)
                 let cuadrito = this.crear_cuadrito({mes:nombre_mes, id: id_cuadrito, color: color_mes, clase: identificador_corte, dia: dia_mes.toString().padStart(2, 0)})
                    dias_en_mes[nombre_mes].push(cuadrito)
                    renglon.appendChild(cuadrito)
                }
                contenedor_cuadritos.appendChild(renglon)
                
               
            }
            if(!crear_nuevo) contenedor_grilla.appendChild(contenedor_cuadritos)


            return { grilla: contenedor_grilla, cuadritos_en_mes: dias_en_mes }
        }
    this.cuadro=function(){
        let elemento=this.crear_elemento({tipo:"div",
        clases: ["d-flex", "flex-row"]
         })
         return elemento
    }
    this.crear_cuadrito = function ({ id, color, clase, dia, mes }) {
        let cuadrito = document.createElement("div")
        cuadrito.id = id
        cuadrito.title=(mes??"")+" "+(dia?parseInt(dia)+1:"")
        cuadrito.className = "cuadrito " + clase
        cuadrito.style.minHeight = "10px"
        // cuadrito.style.backgroundColor = color
        cuadrito.style.height = "10px"
        cuadrito.style.minWidth = "10px"
        cuadrito.style.width = "10px"
        // cuadrito.style.backgroundColor = "var(--color-prioridad-baja-baja)"
        cuadrito.style.margin = "1px"
        return cuadrito
    },
        this.crear_row = function () {
            let renglon = this.crear_elemento({
                tipo: "div",
                clases: ["d-flex", "flex-column"],
                estilos: [{ estilo: "flex-grow", valor: "1" }]
            })

            return renglon
        },
        this.datos_a_no = function (identificador) {
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
                datos_mes = { dias: dias, mes: identificador + a_no + "-" + mes.toString().padStart(2, 0), color: colores[mes - 1], nombre_mes: nombre_mes.substring(0, 3) + "." }
                datos_meses.push(datos_mes)
                dias_completo += dias

            }
            return { datos_a_no: datos_meses, dias_a_no: dias_completo, a_no: a_no }
        }
}