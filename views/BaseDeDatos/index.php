<?php
//importación componentes
include_once "views/Componentes/Lista_registro.php";
include_once "views/Componentes/Opcion.php";
//variables
$array_acciones = array();
$array_lugares = array();
$tecla = "";
?>
<!DOCTYPE html>
<html lang="en" style="height: 100vh;">

<head>
    <?php
    $this->importaciones_globales();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->_nombre; ?></title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>

<body class="w-100 h-100">
    <?php
    $this->renderizar_menu($this->opcion);
    ?>
    <div class="d-flex justify-content-center align-items-center" id="scroll_global" style="overflow: auto; height: var(--alto-global)">
        <div class="w-75 d-flex flex-column position-relative" style="height: 80%; border-radius: 13px; border: 1px solid var(--color-decorativo)">
            <div class="d-flex" style="width: 40px; height: 40px; position: absolute; top: 14px; right: 8px;">
                <i class="bi-x-lg"></i>
            </div>
            <div class="d-flex" style="height: 80%; ">
                <div class="d-flex flex-column w-50 h-100">
                    <div class="d-flex align-items-end" style="padding-left: 24px; padding-top: 14px;  color: var(--color-prioridad-baja-baja)">
                        <p class="m-0 p-0">Estas consultando:</p>
                    </div>
                    <div class="d-flex flex-row justify-content-center" style="height: 80%; padding-top: 14px;">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="d-flex flex-row align-items-center" style="width: 45%; height: 80%">
                                <div style="width: 10px;height: 60px;background-color: var(--principal-color);border-radius: 13px;"></div>
                                <img style="width: 80%" src="public/ilustraciones/entradas.png">
                            </div>
                            <b style="width: 50px; font-size: 10pt; color: var(--color-prioridad-baja-baja)">Entradas</b>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column w-50 h-100">
                    <div class="d-flex w-100 flex-column" style="">
                        <div id="contenedor-steeps" class="d-flex flex-row justify-content-center align-items-center" style="padding-top: 14px;">

                        </div>

                        <div style="margin-top: 14px;">
                            <b id="subtitulo-entradas" class="m-0 p-0" style="color: var(--color-baja-baja)">Cada registro debe contener: </b>
                        </div>
                    </div>
                    <div id="padre-opciones-entradas" style="height: 80%; flex-grow: 1; overflow:auto">

                    </div>

                    <div id="avance-contener" class="pr-2 d-flex w-100 justify-content-center" style="height: 20%">
                    </div>
                </div>
            </div>
            <div class="d-flex" style="margin-left: 24px; height: 20%;">
                <div class="d-flex flex-column flex-column">
                    <div class="d-flex flex-row">
                        <button type="button" style="width: 200px; border-radius: 13px" class="mr-1 btn btn-primary">DESCARGAR CSV</button>
                        <button type="button" style="width: 200px; border-radius: 13px" class="ml-1 btn btn-light">APLICAR ELIMINACIÓN</button>
                    </div>
                    <p style="margin-top: 14px; color: var(--color-prioridad-baja-baja)">La consulta contiene <b style="color: black">1532</b> registros</p>
                </div>
            </div>
        </div>
    </div>
</body>


<script src="public/js/Compartido/Enviar_formulario.js"></script>
<script src="public/js/Compartido/Funciones_publicas.js"></script>
<script src="public/js/BaseDeDatos/Variables.js"></script>
<script src="public/js/BaseDeDatos/Opcion.js"></script>
<script src="public/js/BaseDeDatos/Steeps.js"></script>
<script src="public/js/BaseDeDatos/Avance.js"></script>
<script src="public/js/BaseDeDatos/ContenedorPartes.js"></script>
<script>
    valores_opciones = {
        Nombre: {
            titulo: "Nombre",
            elemento: undefined
        },
        Hora_entrada: {
            titulo: "Hora de entrada",
            elemento: undefined
        },
        Hora_salida: {
            titulo: "Hora de salida",
            elemento: undefined
        },
        Lugar: {
            titulo: "Lugar",
            elemento: undefined
        },
        Hora_salida: {
            titulo: "Hora de salida",
            elemento: undefined
        },
        Fecha: {
            titulo: "Fecha",
            elemento: undefined
        }
    }
    valores_condicionales = {
        Nombre: {
            titulo: "Nombre:",
            elemento: undefined,
            complemento: `
            <input class="formulario form-control form-control-sm" type="text" placeholder="Introduce un nombre">
            `
        },
        Fechas: {
            titulo: "Fecha",
            elemento: undefined,
            complemento: `
            <p class="" style="margin: 0px 5px 0px 0px;">De:</p>
            <input class="formulario form-control form-control-sm" type="date" placeholder="Introduce un nombre">
            <p class="" style="margin: 0px 5px 0px 5px;">al</p>
            <input class="formulario form-control form-control-sm" type="date" placeholder="Introduce un nombre">
            `
        },
        No_control: {
            titulo: "Numero de control:",
            elemento: undefined,
            complemento: `
            <input class="formulario form-control form-control-sm" type="number" placeholder="Introduce un número de control">
            `
        },
    }
    var steep_columnas = new ContenedorPartes("Cada registro debe contener: ")
    steep_columnas.crear_interfaz()
    columnas_partes = steep_columnas.get_partes_interfaz()
    Object.entries(valores_opciones).forEach(valor => {
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
        opcion.crear_interfaz()
        opcion.agregar_agregado()

    })
    //agregamos el elemento creado para el inicio de la interfaz
    padre_opciones_entradas.appendChild(steep_columnas.get_interfaz())

    var steep_condiciones = new ContenedorPartes("Agrega condiciones: ")
    steep_condiciones.crear_interfaz()
    condiciones_partes = steep_condiciones.get_partes_interfaz()
    var msg = undefined
    Object.entries(valores_condicionales).forEach(valor => {
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
    var steep_carrera = new ContenedorPartes("Selecciona las carreras:")
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
                        elemento: undefined
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

                })
            }
        })
    /*fin steep carrera*/

    /* elementos de steeps lugar */
    var steep_lugar = new ContenedorPartes("Selecciona los lugares:")
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
                        elemento: undefined
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

                })
            }
        })
    /*fin steep lugar*/

    let lista_principales=[steep_columnas.get_interfaz(), steep_condiciones.get_interfaz(), steep_carrera.get_interfaz(), steep_lugar.get_interfaz()]
    let lista_titulos=[steep_columnas.get_titulo(), steep_condiciones.get_titulo(), steep_carrera.get_titulo(), steep_lugar.get_titulo()]

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
</script>

</html>