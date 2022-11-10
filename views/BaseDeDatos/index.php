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
    <div class="d-flex justify-content-center" id="scroll_global" style="overflow: auto; height: var(--alto-global)">
            ESTAMOS EN Informacion
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
    const btn_buscar = document.querySelector("#btn_buscar")
    const btn_mostrar_todos = document.querySelector("#btn_mostrar_todos")
    const cuadro_informacion = document.querySelector("#cuadro_busqueda")
    const lista_contenedor_personas = document.querySelector("#contenedor_personas")
    const lista_contenedor_lugares = document.querySelector("#contenedor_lugares")
    const identificador_persona = document.querySelector("#identificador_persona")


    const modal_persona = document.querySelector("#modal_persona")
    const body_modal_persona = document.querySelector("#body_modal_persona")
    const modal_persona_cerrar = document.querySelector("#modal_persona_cerrar")
    const no_control_persona_modal = document.querySelector("#no_control_persona_modal")
    const nombre_persona_modal = document.querySelector("#nombre_persona_modal")
    const scroll_global = document.querySelector("#scroll_global")



    const body_modal_lugar = document.querySelector("#body_modal_lugar")
    const modal_datos_lugar = document.querySelector("#modal_datos_lugar")
    const modal_lugar_cerrar = document.querySelector("#modal_lugar_cerrar")
    const inicial_lugar_modal = document.querySelector("#inicial_lugar_modal")
    const nombre_lugar_modal = document.querySelector("#nombre_lugar_modal")

    const parte_lugares = document.querySelector("#parte_lugares")

    //carrusel
    const botones_lugares = document.querySelector("#botones_lugares")
    const carrusel_lugares = document.querySelector("#carrusel_lugares")

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



<script src="public/js/Informacion/Solicitar_personas.js"></script>
<script src="public/js/Informacion/Solicitar_lugares.js"></script>
<script src="public/js/Informacion/Solicitar_dias.js"></script>

<script src="public/js/Informacion/Busqueda.js"></script>

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
            let envio={
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
                Hora_salida: "is not null"
            }
            if(identificador!="General" && identificador!=""){
                envio["Id_lugar"]=identificador
            }
            let datos_dias_entradas = await enviar_formulario("Entrada/diasAlumno", envio)
            envio.Hora_salida="is null"
            let datos_dias_salidas = await enviar_formulario("Entrada/diasAlumno", envio)
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


    /* body_modal_lugar.appendChild(grafica_lugar_CoC2.get_elemento_principal())
     grafica_lugar_CoC2.solicitar_datos("")*/



    var grafica_lugar_CoC = new Grafica_elemento({
        datos_formulario: {
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy
        },
        configuracion_grafica: {
            tipo: "doughnut",
            alto: "250px",
            posicion_etiquetas: "left",
            ver_eje_x: false,
            ver_eje_y: false
        },
        titulo_grafica: "Entradas por carrera",
        funcion_solicitar_datos: async function(padre, identificador, datos_formulario) {
            let json_data = {
                Fecha: datos_formulario.fecha_inicio,
                Fecha_fin: datos_formulario.fecha_fin,
            }
            if (identificador != "General") {
                json_data["Id_lugar"] = identificador
            }
            let json = await enviar_formulario("Lugar/entradasPorCarrera/", json_data)

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

                for (const {
                        Id_carrera,
                        Color
                    } of contenido) {
                    let json_data = {
                        Fecha: datos_formulario.fecha_inicio,
                        Fecha_fin: datos_formulario.fecha_fin,
                        Id_carrera: Id_carrera,
                    }
                    if (identificador != "General") {
                        json_data["Id_lugar"] = identificador
                    }
                    let json = await enviar_formulario("Entrada/conteoPorSemana/", json_data)
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
        titulo_grafica: "Entradas por día de la semana",
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
            posicion_etiquetas: "bottom",
            max_x: 60
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
                Hora_salida: "is not null"
            }))
            //console.log("json_consultas", json_consultas)
            data_entradas = {
                etiquetas: [],
                datos: [],
            }
            json_consultas.forEach(data => {
                if (data.respuesta) {
                    contenedor_data = {
                        label: "",
                        backgroundColor: [],
                        data: [] //[...Array(60).keys()].map(a=>0),

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
            /*  data_entradas.datos.push({
                  
                  backgroundColor: [],
                  data: [{x:60, y:0}, {x:0, y:10}],
                  backgroundColor: "rgb(255,255,255)",
                  radius: 0,
                  labels:{
                      display: false
                  }
                 
              })*/

            //  data_entradas.datos[0].data=[2,3,22,2]
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
            posicion_etiquetas: "left",
            ver_eje_y: false,
            ver_eje_x: false
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