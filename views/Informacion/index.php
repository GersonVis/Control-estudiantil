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

        .list-group-item {
            transition-property: min-height, background-color;
            transition-duration: 1s, 2s;

        }

        .list-group-item.active {
            background-color: var(--principal-color);
            min-height: 130px !important;
        }

        .list-group-item::after {
            content: "";

            position: absolute;
            bottom: 0;

            background-image: url("public/ilustraciones/registrando.png");
        }

        .list-group-item.active div .opcion-tecla {
            background-color: white;
        }

        .list-group-item div .opcion-tecla p {
            color: white;
        }

        .list-group-item.active .ptitulo p {
            color: black;
        }

        .list-group-item.active div .opcion-tecla p {
            color: black;
        }

        .list-group-item div .opcion-tecla {
            background-color: #6c757d;
        }

        .vibrar {
            animation-name: vibrar;
            animation-iteration-count: infinite;
            animation-duration: 0.5s;
            animation-direction: alternate-reverse;
            animation-timing-function: linear;
            background-color: #0062cc;
        }

        .bloqueado::after {
            position: absolute;
            content: "";
            width: 100%;
            height: 3px;
            border-radius: 12px;
            background-color: red;
            bottom: 0;
            animation-name: bloqueado;
            animation-iteration-count: 1;
            animation-duration: 3s;
            animation-timing-function: cubic-bezier(0.06, 0.69, 0.59, -0.01);
            animation-fill-mode: forwards;
        }

        .entrada-creciente {
            animation-name: entrada-creciente;
            animation-duration: 1s;
            overflow: hidden;
            animation-fill-mode: forwards;
            animation-timing-function: jump-start;
        }

        .entrada-creciente-r {
            animation-name: entrada-creciente-r;
            animation-duration: 1s;
            overflow: hidden;
            animation-fill-mode: forwards;
        }

        .cuadrito {
            background-color: var(--sub-prioridad-alta);
        }

        .asistencia {
            background-color: rgb(97, 232, 0) !important;
        }

        .no-asistencia {
            background-color: red !important;
        }

        .cuadrito.seleccionado {
            background-color: #4399FF;
            /*  border: 1px solid black;*/
            position: relative;
            animation-name: desplazar;
            animation-duration: 1s;
            animation-fill-mode: forwards;
            z-index: 100;
        }

        .cuadrito.seleccionado::after {
            position: absolute;
            content: "";
            height: 10%;
            width: 100%;
            background-color: black;
            top: 45%;
            border-radius: 50% 50%;
        }

        .cuadrito.no-seleccionado {
            background-color: var(--sub-prioridad-alta);
            animation-name: desplazar-r;
            animation-duration: 1s;
            animation-fill-mode: forwards;
            z-index: 0;
        }

        .animacion_dentro {
            animation: 1s infinite steps(2, end) animacion-dentro;
        }

        @keyframes animacion-dentro {
            from {
                transform: translateX(0px);
            }

            to {
                transform: translateX(-120px);
            }

        }

        @keyframes desplazar {
            from {
                transform: translateY(0px);
                background-color: var(--sub-prioridad-alta);
            }

            to {
                transform: translateY(5px);
                background-color: #4399FF;
            }
        }

        @keyframes desplazar-r {
            from {
                transform: translateY(5px);
                background-color: #4399FF;
            }

            to {
                transform: translateY(0px);
                background-color: var(--sub-prioridad-alta);
            }
        }

        @keyframes entrada-creciente {
            from {
                height: 0%;
            }

            to {
                height: 300px;
            }
        }

        @keyframes entrada-creciente-r {
            from {
                height: 300px;
            }

            to {
                height: 0px;

            }
        }

        @keyframes vibrar {
            from {
                transform: rotateZ(5deg);
                background-color: #007bff;
            }

            to {
                transform: rotateZ(-5deg);
                background-color: #007bff;
            }
        }

        @keyframes bloqueado {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }
    </style>
</head>

<body class="w-100 h-100">
    <?php
    $this->renderizar_menu($this->opcion);
    ?>
    <div class="d-flex justify-content-center" style="overflow: auto; height: var(--alto-global)">
        <div class="w-50 h-100">
            <div class="w-100 d-flex justify-content-center align-items-center" style="height: 10%">
                <div class="d-flex justify-content-center align-items-center w-75 position-relative" style="height: 50%; min-height: 40px">
                    <input type="text" id="input_busqueda" placeholder="Buscar" class="p-2 w-100 h-100" style=" border-radius: 12px; background-color: var(--prioridad-alta); border: 0">
                    </input>
                    <div id="cuadro_busqueda" class="position-absolute d-flex bg-sub-prioridad-alta w-100  mt-1 redondear-secundario" style="z-index: 99; height: 0px; top: 100%; overflow: hidden;" activo="hidden">
                        <img src="public/ilustraciones/busqueda.png" style="height: 180px;margin-top: 24px;" />
                        <div class="d-flex flex-column" style="margin-top: 24px">
                            <b style="font-size: 120%; margin-bottom: 14px;">¡Iniciar búsqueda!</b>
                            <p style="margin-bottom: 14px; font-size: 70%;">Iniciaras la búsqueda de personas y de lugares, la búsqueda es en base al nombre.
                            </p>
                            <button type="button" class="btn btn-primary btn-block font-weight-bold w-75 m-0 p-0" style="border-radius: 12px; height: 30px;"><i class="bi-search"></i> BUSCAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100" style="height: 90%;">
                <div class="w-100 d-flex flex-column" style="height: 45%">
                    <b>Lugares</b>

                    <div class="w-100 d-flex flex-row p-1" id="contenedor_lugares" style="height: 200px; overflow-x: auto; overflow-y: hidden; gap: 14px">




                    </div>
                </div>
                <div class="w-100" style="height: 55%">
                    <div class="w-100" style="height: 20%;">
                        <b class="w-100" style="height: 20%; padding-bottom: 14px">Personas</b>
                    </div>
                    <div class="w-100 d-flex flex-column" id="contenedor_personas" style="height: 80%; padding-bottom: 14px; gap: 14px">
                       


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modales-->
    <!-- modal persona-->
    <div class="modal fade bd-example-modal-lg" id="modal_persona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="identificador_persona">
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio" id="nombre_persona_modal"></b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0" id="no_control_persona_modal"></p>
                                </div>
                            </div>
                            <div class="h-100">

                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" id="modal_persona_cerrar" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body_modal_persona">

                </div>
            </div>
        </div>
    </div>

    <!-- modal lugar-->
    <div class="modal fade bd-example-modal-lg" id="modal_datos_lugar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="identificador_persona">
                        <div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
                            <p class="text-secondary" style="font-size: 18pt;" id="inicial_lugar_modal"></p>

                        </div>
                        <div class="w-100" style="height: 25%;">
                            <p align="center" class="m-0 p-0 text-secondary" style="max-width: 100%; max-height: 100%; text-overflow: ellipsis; overflow: hidden" id="nombre_lugar_modal"></p>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" id="modal_lugar_cerrar" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body_modal_lugar">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" id="carruselDiasLugar">

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="public/node_modules/chart/package/dist/chart.js"></script>
<script src="public/js/Compartido/Funciones_publicas.js"></script>
<script>
    //urls de solicitudes
    const url_personas = "Alumno"
    const url_lugares = "Lugar"
    const hoy = obtener_fecha()
    const fecha_inicio = hoy.split("-")[0] + "-01-01" //para la obtención de rangos de datos
    //referencias a elementos
    const input_busqueda = document.querySelector("#input_busqueda")
    const cuadro_informacion = document.querySelector("#cuadro_busqueda")
    const lista_contenedor_personas = document.querySelector("#contenedor_personas")
    const lista_contenedor_lugares = document.querySelector("#contenedor_lugares")
    const identificador_persona = document.querySelector("#identificador_persona")

    const modal_persona = document.querySelector("#modal_persona")
    const body_modal_persona = document.querySelector("#body_modal_persona")
    const modal_persona_cerrar = document.querySelector("#modal_persona_cerrar")
    const no_control_persona_modal = document.querySelector("#no_control_persona_modal")
    const nombre_persona_modal = document.querySelector("#nombre_persona_modal")



    const body_modal_lugar = document.querySelector("#body_modal_lugar")
    const modal_datos_lugar = document.querySelector("#modal_datos_lugar")
    const modal_lugar_cerrar = document.querySelector("#modal_lugar_cerrar")
    const inicial_lugar_modal = document.querySelector("#inicial_lugar_modal")
    const nombre_lugar_modal = document.querySelector("#nombre_lugar_modal")


    //variable ocupada para deseleccionar
    var cuadritos_mes_lugar = undefined
</script>
<script src="public/node_modules/chart/package/dist/chart.js"></script>
<script src="public/js/Compartido/Enviar_formulario.js"></script>
<script src="public/js/Compartido/Mostrar_modal.js"></script>

<script src="public/js/Informacion/Persona_modal.js"></script>
<script src="public/js/Informacion/Lugar_modal.js"></script>

<script src="public/js/Componentes/Alumno_lista.js"></script>
<script src="public/js/Componentes/Lugar.js"></script>
<script src="public/js/Componentes/Cuadro_dias.js"></script>
<script src="public/js/Componentes/Grafica_dias.js"></script>
<script src="public/js/Componentes/Grafica_minutos.js"></script>
<script src="public/js/Componentes/Datos_hora.js"></script>
<script src="public/js/Componentes/Grafica_elemento.js"></script>

<script src="public/js/Informacion/Busqueda.js"></script>

<script src="public/js/Informacion/Solicitar_personas.js"></script>
<script src="public/js/Informacion/Solicitar_lugares.js"></script>
<script src="public/js/Informacion/Solicitar_dias.js"></script>
<script>
    //fovus al cuadro de búsqueda
    input_busqueda.focus();
    //funciones de carga de componentes
    var cuadro_dias_lugar = new Cuadro_dias({
        separacion: 7,
        identificador: "lugar",
        datos_formulario: {
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy
        },
        peticion_personalizada: async function(padre, identificador, datos_formulario) {
            let datos_dias_entradas = await enviar_formulario("Entrada/diasAlumno", {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
                Id_lugar: identificador,
                Hora_salida: "is not null"
            })

            let datos_dias_salidas = await enviar_formulario("Entrada/diasAlumno", {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
                Id_lugar: identificador,
                Hora_salida: "is null"
            })
            return [datos_dias_entradas.contenido, datos_dias_salidas.contenido]
        }
    })
    //var cuadro_dias_lugarb = new Cuadro_dias(7, "lugar")

    var cuadro_dias_persona = new Cuadro_dias({
        separacion: 7,
        identificador: "persona",
        datos_formulario: {
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy
        },
        peticion_personalizada: async function(padre, identificador, datos_formulario) {
            let datos_dias_entradas = await enviar_formulario("Entrada/diasAlumno/" + identificador, {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
                Hora_salida: "is not null"
            })
            let datos_dias_salidas = await enviar_formulario("Entrada/diasAlumno" + identificador, {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
                Hora_salida: "is null"
            })
            return [datos_dias_entradas.contenido, datos_dias_salidas.contenido]
        }
    })

    contenedor_carrusel = crear_elemento({
        tipo: "div",
        clases: ["carousel-item", "active"]
    })
    contenedor_carrusel.appendChild(cuadro_dias_lugar.crear_interfaz())
    // carruselDiasLugar.appendChild(contenedor_carrusel)


    contenedor_carrusel = crear_elemento({
        tipo: "div",
        clases: ["carousel-item", "active"]
    })
    /*contenedor_carrusel.appendChild(cuadro_dias_lugarb.crear_interfaz())
    carruselDiasLugar.appendChild(contenedor_carrusel)*/
    body_modal_lugar.appendChild(cuadro_dias_lugar.crear_interfaz())

    var grafica_lugar_CoC = new Grafica_elemento({
        datos_formulario: {
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy
        },
        configuracion_grafica: {
            tipo: "doughnut",
            alto: "250px",
            posicion_etiquetas: "left"
        },
        titulo_grafica: "Entradas por carrera",
        funcion_solicitar_datos: async function(padre, identificador, datos_formulario) {
            let json = await enviar_formulario("Lugar/entradasPorCarrera/", {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
                Id_lugar: identificador
            })

            data_entradas = {
                etiquetas: [],
                datos: [{
                    backgroundColor: [],
                    data: [],
                }],
                color: ["rgb(230,55,207)", "rgb(114,58,240)", "rgb(38, 235,43)", "rgb(63,130,217)"]
            }
            if (json.respuesta) {
                json.contenido.forEach(data => {
                    data_entradas.etiquetas.push(data.etiqueta)
                    data_entradas.datos[0].data.push(data.valor)
                    data_entradas.datos[0].backgroundColor.push(data.color ?? `rgb(${Math.random()*255}, ${Math.random()*255}, ${Math.random()*255})`)
                })
            }
            return data_entradas
        }
    })
    grafica_lugar_CoC.crear_interfaz()
    body_modal_lugar.appendChild(grafica_lugar_CoC.get_elemento_principal())



    var grafica_lugar_CoL = new Grafica_elemento({
        datos_formulario: {
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy
        },
        configuracion_grafica: {
            tipo: "bar",
            alto: "250px",
            posicion_etiquetas: "bottom",
            etiqueta: "# de entradas"
        },
        titulo_grafica: "Entradas por día de la semana",
        url_datos: "Entrada/conteoPorSemana/",
        funcion_solicitar_datos: async function(padre, identificador, datos_formulario) {
            datasets = {
                etiquetas: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
                datos: []
            }
            let carreras = await enviar_formulario("Carrera")
            if (carreras.respuesta) {
                let contenido = carreras.contenido
                console.log(contenido)
                for (const {
                        Id_carrera,
                        Color
                    } of contenido) {
                    let json = await enviar_formulario("Entrada/conteoPorSemana/", {
                        Fecha: datos_formulario.fecha_inicio,
                        Fecha_fin: datos_formulario.fecha_fin,
                        Id_carrera: Id_carrera,
                        Id_lugar: identificador,
                    })
                    data_entradas = {
                        valor: [0, 0, 0, 0, 0, 0, 0],
                        color: Color
                    }
                    if (json.respuesta) {
                        json.contenido.forEach(data => {
                            data_entradas.valor[data.etiqueta] = data.valor
                        })
                    }
                    datasets.datos.push({
                        label: Id_carrera,
                        data: data_entradas.valor,
                        backgroundColor: data_entradas.color,
                        borderColor: data_entradas.color,
                        borderWidth: 1
                    })
                }
            }
            return datasets
        }
    })
    grafica_lugar_CoL.crear_interfaz()
    body_modal_lugar.appendChild(grafica_lugar_CoL.get_elemento_principal())

    //   datos_dias_persona = crear_cuadro_dias(7, "persona", modal_persona_cerrar)

    body_modal_persona.appendChild(cuadro_dias_persona.crear_interfaz())

    /* var grafica_persona_ds = new Grafica_dias({
         fecha_inicio: fecha_inicio,
         fecha_fin: hoy,
         url_datos: "Entrada/conteoPorSemana/"
     })
     grafica_persona_ds.crear_interfaz()
     body_modal_persona.appendChild(grafica_persona_ds.get_elemento_principal())*/




    var grafica_persona_ds = new Grafica_elemento({
        datos_formulario: {
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy
        },
        configuracion_grafica: {
            tipo: "bar",
            alto: "250px",
            posicion_etiquetas: "bottom",
            ver_etiquetas: false
        },
        titulo_grafica: "Entradas y salidas en una hora",
        url_datos: "Entrada/conteoPorSemana/",
        funcion_solicitar_datos: async function(padre, identificador, datos_formulario) {
            let json_consulta
            let data_entradas
            json_consulta = await enviar_formulario("Entrada/conteoPorSemana/" + identificador, {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
            })
            data_entradas = {
                etiquetas: [],
                datos: []
            }

            if (json_consulta.respuesta) {
                contenedor_data = {
                    label: "entradas",
                    backgroundColor: ["rgb(63, 157, 255)"],
                    data: [0, 0, 0, 0, 0, 0, 0],
                }
                json_consulta.contenido.forEach(registro => {
                    contenedor_data.data[registro.etiqueta - 1] = registro.valor
                })
                data_entradas.datos.push(contenedor_data)
            }

            data_entradas.etiquetas = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado']
            //  console.log("entradas", data_entradas, json_consulta)


            return data_entradas
        }
    })
    grafica_persona_ds.crear_interfaz()
    body_modal_persona.appendChild(grafica_persona_ds.get_elemento_principal())


    var grafica_persona_h = new Grafica_minutos({
        fecha_inicio: fecha_inicio,
        fecha_fin: hoy,
        titulo_grafica: "Horas por entrada",
        url_datos: "Entrada/minutosPorEntrada/"
    })
    grafica_persona_h.crear_interfaz()
    body_modal_persona.appendChild(grafica_persona_h.get_elemento_principal())



    var grafica_persona_dh = new Grafica_elemento({
        datos_formulario: {
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy
        },
        configuracion_grafica: {
            tipo: "scatter",
            alto: "250px",
            posicion_etiquetas: "bottom"
        },
        titulo_grafica: "Entradas y salidas en una hora",
        url_datos: "Entrada/conteoHora/",
        funcion_solicitar_datos: async function(padre, identificador, datos_formulario) {
            let json_consultas
            let data_entradas
            let contenedor_data
            let registro_nuevo
            json_consultas = []
            json_consultas.push(await enviar_formulario("Entrada/conteoEntradas/" + identificador, {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
            }))
            json_consultas.push(await enviar_formulario("Entrada/conteoSalidas/" + identificador, {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
            }))
            // console.log(json_consultas)
            data_entradas = {
                etiquetas: [],
                datos: [],
            }
            json_consultas.forEach(data => {
                if (data.respuesta) {
                    contenedor_data = {
                        label: "",
                        backgroundColor: [],
                        data: [],
                    }
                    data.contenido.forEach(registro => {
                        data_entradas.etiquetas.push(registro.etiqueta)
                        registro_nuevo = {
                            x: 0,
                            y: 0
                        }
                        registro_nuevo.x = registro.etiqueta
                        registro_nuevo.y = registro.valor
                        contenedor_data.data.push(registro_nuevo)
                    })

                    data_entradas.datos.push(contenedor_data)
                }
            })
            data_entradas.datos[0].label = "Entradas"
            data_entradas.datos[1].label = "Salidas"
            data_entradas.datos[0].backgroundColor.push("rgb(63, 137, 255)")
            data_entradas.datos[1].backgroundColor.push("rgb(6255, 0, 0)")
            return data_entradas
        }
    })
    grafica_persona_dh.crear_interfaz()
    body_modal_persona.appendChild(grafica_persona_dh.get_elemento_principal())


    /*Grafica circular mostrando el lugar con mayores entradas */
    var grafica_persona_CoL = new Grafica_elemento({
        datos_formulario: {
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy
        },
        configuracion_grafica: {
            tipo: "doughnut",
            alto: "250px",
            posicion_etiquetas: "left"
        },
        titulo_grafica: "Entradas por lugar",
        funcion_solicitar_datos: async function(padre, identificador, datos_formulario) {
            let json = await enviar_formulario("Entrada/entradasPorLugar/" + identificador, {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
            })

            data_entradas = {
                etiquetas: [],
                datos: [{
                    backgroundColor: [],
                    data: [],
                }],
                color: ["rgb(230,55,207)", "rgb(114,58,240)", "rgb(38, 235,43)", "rgb(63,130,217)"]
            }
            if (json.respuesta) {
                json.contenido.forEach(data => {
                    data_entradas.etiquetas.push(data.etiqueta)
                    data_entradas.datos[0].data.push(data.valor)
                    data_entradas.datos[0].backgroundColor.push(`rgb(${Math.random()*255}, ${Math.random()*255}, ${Math.random()*255})`)
                })
            }
            return data_entradas
        }
    })
    grafica_persona_CoL.crear_interfaz()
    body_modal_persona.appendChild(grafica_persona_CoL.get_elemento_principal())





    /*
        var grafica_persona_cl = new Datos_hora({
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy,
            titulo_grafica: "Entradas y salidas resumidas en una hora",
            url_datos: "Entrada/conteoHora/"
        })
        grafica_persona_dh.crear_interfaz()
        body_modal_persona.appendChild(grafica_persona_dh.get_elemento_principal())
        /*
            const dias_lugar=datos_dias_lugar.refencias_cuadritos
            const dias_persona=datos_dias_persona.refencias_cuadritos*/

    //  solicitar_dias("20670109", {grilla_dias: dias_persona, label_dias_dentro: dias_lugar.etiqueta_dias_dentro})
</script>


</html>