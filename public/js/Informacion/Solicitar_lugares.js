var con_lugares
solicitar_lugares = (url, contenedor_respuesta) => {
    enviar_formulario(url)
        .then(respuesta => {
            if (respuesta) {
                con_lugares = respuesta.contenido.map(datos => {
                    let interfaz_lugar = new Lugar({
                        nombre_lugar: datos.Id_lugar,
                        datos_formulario: {
                            fecha_inicio: fecha_inicio,
                            fecha_fin: hoy,
                           
                        },
                        configuracion_grafica: {
                            tipo: "line",
                            alto: "250px",
                            posicion_etiquetas: "left",
                            ver_etiquetas: false,
                            ver_eje_x: false,
                            ver_eje_y: false,
                            borde: "",
                            eventos: []
                        },
                        titulo_grafica: "",
                        funcion_solicitar_datos: async function (padre, identificador, datos_formulario) {
                            let hoy=new Date()
                            let hora=hoy.getHours()
                            let array_ceros=[...Array(24).keys()].map(a=>0)
                            let carreras_json= await enviar_formulario("Carrera")
                            let data_completa=[]
                            if(carreras_json.respuesta){
                                let carreras=carreras_json.contenido
                                for(carrera of carreras){
                                    let data_carrera=[...Array(parseInt(hora)+2).keys()].map(a=>0)
                                    let dataset_carrera={
                                        label: carrera.Id_carrera,
                                        data: data_carrera,
                                        fill: false,
                                        borderColor: carrera.Color,
                                        tension: 0
                                    }
                                    let carrera_conteo = await enviar_formulario("Lugar/conteoHora", {
                                        Fecha: obtener_fecha(),
                                        Id_lugar: identificador,
                                        Id_carrera: carrera.Id_carrera
                                    })
                                    if(carrera_conteo.respuesta){
                                        carrera_conteo.contenido.forEach(({etiqueta, valor})=>{

                                            data_carrera[parseInt(etiqueta)+1]=valor
                                            array_ceros[etiqueta]+=parseInt(valor)
                                        })
                                    }
                                    data_completa.push(dataset_carrera)
                                }
                            }
                            data_completa.push({
                                label: "",
                                data: [0,10],
                                fill: false,
                                borderColor: "rgb(255,255,255)",
                                tension: 0
                            })
                            data_entradas = {
                                etiquetas: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                                datos: data_completa,
                                color: ["rgb(230,55,207)", "rgb(114,58,240)", "rgb(38, 235,43)", "rgb(63,130,217)"]
                            }
                            data_entradas.hora=hora
                            data_entradas.datos_por_luna=array_ceros
                            return data_entradas
                        }
                    })
                    interfaz_lugar.crear_interfaz()
                    interfaz_lugar.solicitar_datos(datos.Id_lugar)
                    interfaz_lugar.evento_por_hora()
                    contenedor_respuesta.appendChild(interfaz_lugar.get_elemento_principal())

                    add_eventos_lugar({principal: interfaz_lugar.get_elemento_principal(), datos: datos, cuadro_dias: cuadro_dias_lugar})
                    return interfaz_lugar
                });
            }
        })
}
window.addEventListener("load", function (ev) {
    let interfaz_lugar = new Lugar({
        nombre_lugar: "General",
        datos_formulario: {
            fecha_inicio: fecha_inicio,
            fecha_fin: hoy
        },
        configuracion_grafica: {
            tipo: "line",
            alto: "250px",
            posicion_etiquetas: "left",
            ver_etiquetas: false,
            ver_eje_x: false,
            ver_eje_y: false,
            borde: "",
            eventos: []
        },
        titulo_grafica: "",
        funcion_solicitar_datos: async function (padre, identificador, datos_formulario) {
            let hoy=new Date()
            let hora=hoy.getHours()
            let array_ceros=[...Array(24).keys()].map(a=>0)
            let carreras_json= await enviar_formulario("Carrera")
            let data_completa=[]
            if(carreras_json.respuesta){
                let carreras=carreras_json.contenido
                for(carrera of carreras){
                    let data_carrera=[...Array(parseInt(hora)+2).keys()].map(a=>0)
                    let dataset_carrera={
                        label: carrera.Id_carrera,
                        data: data_carrera,
                        fill: false,
                        borderColor: carrera.Color,
                        tension: 0
                    }
                    let carrera_conteo = await enviar_formulario("Lugar/conteoHora", {
                        Fecha: obtener_fecha(),
                       
                    })
                    if(carrera_conteo.respuesta){
                        carrera_conteo.contenido.forEach(({etiqueta, valor})=>{

                            data_carrera[parseInt(etiqueta)+1]=valor
                            array_ceros[etiqueta]+=parseInt(valor)
                        })
                    }
                    data_completa.push(dataset_carrera)
                }
            }
            data_completa.push({
                label: "",
                data: [0,10],
                fill: false,
                borderColor: "rgb(255,255,255)",
                tension: 0
            })
            data_entradas = {
                etiquetas: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                datos: data_completa,
                color: ["rgb(230,55,207)", "rgb(114,58,240)", "rgb(38, 235,43)", "rgb(63,130,217)"]
            }
            data_entradas.hora=hora
            data_entradas.datos_por_luna=array_ceros
            return data_entradas
        }
    })
    interfaz_lugar.crear_interfaz()
    interfaz_lugar.solicitar_datos("General")
    interfaz_lugar.evento_por_hora()

    add_eventos_lugar({principal: interfaz_lugar.get_elemento_principal(), datos: datos, cuadro_dias: cuadro_dias_lugar})
    
    lista_contenedor_lugares.appendChild(interfaz_lugar.get_elemento_principal())
    
    solicitar_lugares(url_lugares, lista_contenedor_lugares)//url_alumnos se encuentra en el index
    
    

})

function add_eventos_lugar({ principal, datos, cuadro_dias }) {
    principal.addEventListener("click", function () {
        modal_lugares({ principal: principal, datos: datos })
        grafica_lugar_CoL.solicitar_datos(datos.Id_lugar??"")
        grafica_lugar_CoC.solicitar_datos(datos.Id_lugar??"")
        cuadro_dias.reiniciar_estilos_cuadro()
        cuadro_dias.solicitar_datos(datos.Id_lugar??"")



        //asistencias
        solicitar_dias(datos.No_control, { Fecha: fecha_inicio, Fecha_fin: hoy })
            .then(contenido => {
                cuadro_dias.marcar_dias(contenido,"entradas_registradas", "asistencia", function(entradas, elemento){
                    elemento.innerText=entradas!=1?entradas+" Entradas":"1 Entrada"
                })
            }
            )
        // solicitar no asistencias
        solicitar_dias(datos.No_control, { Fecha: fecha_inicio, Fecha_fin: hoy, Hora_salida: "is null"})
            .then(contenido => {
                cuadro_dias.marcar_dias(contenido,"entradas_sin_salida", "no-asistencia", function(entradas, elemento){
                    
                    elemento.innerText=entradas!=1?entradas+" Entradas sin registro":"1 Entrada sin registro"
                })
            }
            )
    })

}


//scroll
