columnas_datos = {
    No_control: {
        titulo: "Número de control",
        elemento: undefined,
        tipo: {
            forma: "columna"
        },

    },
    Nombre: {
        titulo: "Nombre",
        elemento: undefined,
        tipo: {
            forma: "columna"
        },

    },
    Hora_entrada: {
        titulo: "Hora de entrada",
        elemento: undefined,
        tipo: {
            forma: "columna"
        },
    },
    Hora_salida: {
        titulo: "Hora de salida",
        elemento: undefined,
        tipo: {
            forma: "columna"
        },
    },
    Id_Lugar: {
        titulo: "Lugar",
        elemento: undefined,
        tipo: {
            forma: "columna"
        },
    },
    Hora_salida: {
        titulo: "Hora de salida",
        elemento: undefined,
        tipo: {
            forma: "columna"
        },
    },
    Fecha: {
        titulo: "Fecha",
        elemento: undefined,
        tipo: {
            forma: "columna"
        },
    }
}
condicionales_datos = {
    Nombre: {
        titulo: "Nombre:",
        elemento: undefined,
        tipo: {
            forma: "where"
        },
        complemento: `
        <input name="Nombre" class="formulario form-control form-control-sm" type="text" placeholder="Introduce un nombre">
        `
    },
    Fechas: {
        titulo: "Fecha",
        elemento: undefined,
        tipo: {
            forma: "where"
        },
        complemento: `
        <p class="" style="margin: 0px 5px 0px 0px;">De:</p>
        <input name="fecha" class="formulario form-control form-control-sm" type="date" placeholder="Introduce un nombre">
        <p class="" style="margin: 0px 5px 0px 5px;">al</p>
        <input name="fecha_fin" class="formulario form-control form-control-sm" type="date" placeholder="Introduce un nombre">
        `
    },
    No_control: {
        titulo: "Numero de control:",
        elemento: undefined,
        tipo: {
            forma: "where"
        },
        complemento: `
        <input name="No_control" class="formulario form-control form-control-sm" type="number" placeholder="Introduce un número de control">
        `
    },
}
var steep_columnas = new ContenedorPartes("columnas", "Cada registro debe contener: ")
steep_columnas.crear_interfaz()
columnas_partes = steep_columnas.get_partes_interfaz()
Object.entries(columnas_datos).forEach(valor => {
    let opcion = new Opcion(valor[1].titulo, columnas_partes.disponibles, columnas_partes.agregadas,
        funciones = {
            funcion_click(datos) {
                let hijos = datos.agregado.childNodes.length
                let estado = datos.boton.attributes["estado"].value
                if (estado == "agregado") {
                    if (hijos == 1) {
                        alert("No puedes remover todos")
                        return true
                    }
                }
            },
            funcion_despues(datos) {}
        }

    )
    valor[1].elemento = opcion
    opcion.crear_interfaz()
    opcion.agregar_agregado()

})
//agregamos el elemento creado para el inicio de la interfaz
padre_opciones_entradas.appendChild(steep_columnas.get_interfaz())

var steep_condiciones = new ContenedorPartes("condiciones", "Agrega condiciones: ")
steep_condiciones.crear_interfaz()
condiciones_partes = steep_condiciones.get_partes_interfaz()
var msg = undefined
Object.entries(condicionales_datos).forEach(valor => {
    let opcion = new Opcion(valor[1].titulo, condiciones_partes.disponibles, condiciones_partes.agregadas,
        funciones = {
            funcion_click(datos) {
                let hijos = datos.agregado.childNodes.length
                let estado = datos.boton.attributes["estado"].value
                if (hijos == 1 && datos.evt && msg) {
                    datos.agregado.innerHTML = ""
                    msg = false
                }
            },
            funcion_despues(datos) {
                let hijos = datos.agregado.childNodes.length
                if (hijos == 0) {
                    datos.agregado.innerHTM = ""
                    datos.agregado.innerHTML = "No hay condiciones seleccionadas"
                    msg = true
                }
            }
        },
        valor[1].complemento
    )
    opcion.crear_interfaz()
    //opcion.agregar_disponible()
    opcion.btn_click("agregado")
    valor[1].elemento = opcion
})




/* elementos de steeps carrera */
var steep_carrera = new ContenedorPartes("carreras", "Selecciona las carreras:")
steep_carrera.crear_interfaz()
carrera_partes = steep_carrera.get_partes_interfaz()
var carreras_datos = {}
enviar_formulario("carrera")
    .then(respuesta => {
        if (respuesta.respuesta) {
            respuesta.contenido.forEach(({
                Id_carrera
            }) => {
                carreras_datos[Id_carrera] = {
                    titulo: Id_carrera,
                    elemento: undefined,
                    tipo: {
                        forma: "wherein",
                        de: "Id_carrera"
                    },
                }
            })
            Object.entries(carreras_datos).forEach(valor => {
                let opcion = new Opcion(valor[1].titulo, carrera_partes.disponibles, carrera_partes.agregadas,
                    funciones = {
                        funcion_click(datos) {
                            let hijos = datos.agregado.childNodes.length
                            let estado = datos.boton.attributes["estado"].value
                            if (estado == "agregado") {
                                if (hijos == 1) {
                                    mensaje_informatico({
                                        msg: "Para búsqueda completa, selecciona todas las opciones"
                                    })
                                    return true
                                }
                            }
                        },
                        funcion_despues(datos) {}
                    }

                )
                opcion.crear_interfaz()
                opcion.agregar_agregado()
                valor[1].elemento = opcion

            })
        }
    })
/*fin steep carrera*/

/* elementos de steeps lugar */
var steep_lugar = new ContenedorPartes("lugares", "Selecciona los lugares:")
steep_lugar.crear_interfaz()
lugares_partes = steep_lugar.get_partes_interfaz()
var lugares_datos = {}
enviar_formulario("lugar")
    .then(respuesta => {
        if (respuesta.respuesta) {
            respuesta.contenido.forEach(({
                Id_lugar
            }) => {
                lugares_datos[Id_lugar] = {
                    titulo: Id_lugar,
                    elemento: undefined,
                    tipo: {
                        forma: "wherein",
                        de: "Id_lugar"
                    },
                }
            })
            Object.entries(lugares_datos).forEach(valor => {
                let opcion = new Opcion(valor[1].titulo, lugares_partes.disponibles, lugares_partes.agregadas,
                    funciones = {
                        funcion_click(datos) {
                            let hijos = datos.agregado.childNodes.length
                            let estado = datos.boton.attributes["estado"].value
                            if (estado == "agregado") {
                                if (hijos == 1) {
                                    mensaje_informatico({
                                        msg: "Para búsqueda completa, selecciona todas las opciones"
                                    })
                                    return true
                                }
                            }
                        },
                        funcion_despues(datos) {}
                    }

                )
                opcion.crear_interfaz()
                opcion.agregar_agregado()
                valor[1].elemento = opcion
            })
        }
    })
/*fin steep lugar*/

let lista_principales = [steep_columnas.get_interfaz(), steep_condiciones.get_interfaz(), steep_carrera.get_interfaz(), steep_lugar.get_interfaz()]
let lista_titulos = [steep_columnas.get_titulo(), steep_condiciones.get_titulo(), steep_carrera.get_titulo(), steep_lugar.get_titulo()]

let steeps_contener = new Steeps(lista_titulos.length)
steeps_contener.crear_interfaz()
steeps_contener.marcar_steep(0)
contenedor_steeps.appendChild(steeps_contener.get_interfaz())


let acciones_contener = new Avance(function(pos, elementos) {
    steeps_contener.marcar_steep(pos)
    subtitulo_entradas.innerText = elementos.subtitulos[pos]
    elementos.padre.innerHTML = ""
    elementos.padre.appendChild(elementos.lista_principales[pos])
}, {
    padre: padre_opciones_entradas,
    lista_principales: lista_principales,
    subtitulos: lista_titulos
})

acciones_contener.crear_interfaz()
acciones_contener.avanzar(0)
contener_avance.appendChild(acciones_contener.get_interfaz())

var inpp
var acciones_contenido = {
    "columna": function(key, tipo, valor, complemento) {
        return key
    },
    "wherein": function(key, tipo, valor, complemento) {
        return {
            valor: valor,
            key: key,
            tipo: tipo.forma,
            de: tipo.de
        }
    },
    "where": function(key, tipo, valor, complemento) {
        let inputs = complemento.querySelectorAll("input")
        let valores = []
        inputs.forEach(input => {
            let valor = {}
            valor[input.name] = input.value
            valores.push(valor)
        })
        return {
            valor: valores,
            key: key,
            tipo: tipo.forma
        }
    }
}

function examinar_selecciones(contenedores, principal) {
    let seleccionados = []
    Object.entries(contenedores).forEach(([key, contenedor]) => {
        let elementos_interfaz = contenedor.elemento.get_interfaz_elementos()
        let complemento = elementos_interfaz.complemento
        if (elementos_interfaz.boton.attributes["estado"].value == "agregado") {
            let tipo = contenedor.tipo.forma
            if (!principal[tipo]) {
                principal[tipo] = []
            }
            principal[tipo].push(acciones_contenido[tipo](key, contenedor.tipo, contenedor.titulo, complemento))
        }
    })
    return seleccionados
}
