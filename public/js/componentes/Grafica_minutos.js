
function Grafica_minutos({fecha_inicio, fecha_fin, url_datos, rango, titulo_grafica}) {
    var global_canva
    var grafica
    var elemento_principal
    var fecha_inicio=fecha_inicio, fecha_fin=fecha_fin
    var url_api=this.url_datos
    var rango=rango??100
    var titulo_grafica=titulo_grafica
    var datos
    this.crear_interfaz = function crear_interfaz() {
        global_canva = crear_elemento({
            id: "grafica", tipo: "canvas", estilos: [{ estilo: "display", valor: "block" },
            {
                estilo: "box-sizing:", valor: "border-box",
                estilo: "max-height", valor: "180px"
            }]
        })//funcion de funciones publicas
        contenedor_grafica = crear_elemento({
            tipo: "div", clases: ["rounded", "d-flex", "flex-column"],
            estilos: [{ estilo: "border", valor: "1px solid var(--color-decorativo)" },
            { estilo: "padding", valor: "10px 10px 10px 10px" }
            ]
        })
        elemento_principal = crear_elemento({
            tipo: "div", clases: ["m-1", "d-flex", "flex-column", "p-1"],
        })
        texto_grafico = crear_elemento({
            tipo: "div", estilos: [{ estilo: "color", valor: "var(--color-prioridad-baja-media)" }
            ]
        })
        texto_grafico.innerText=titulo_grafica
        elemento_principal.appendChild(texto_grafico)
        contenedor_grafica.appendChild(global_canva)
        elemento_principal.appendChild(contenedor_grafica)
    }
    this.get_elemento_principal = function get_elemento_principal() {
        return elemento_principal
    }
    this.get_grafica = function get_grafica(){
        return grafica
    }
    this.set_grafica = function set_grafica(nuevo_valor){
        grafica=nuevo_valor
    }
    this.set_fecha_inicio=function set_fecha_inicio(fecha){
        fecha_inicio=fecha
    }
    this.set_fecha_fin=function set_fecha_fin(fecha){
        fecha_fin=fecha
    }
    this.get_canva= function get_canva(){
        return global_canva
    }
    this.get_datos=function get_datos(){
        return datos
    }
    this.pintar_grafica=function pintar_grafica(datos_grafica){
        if(grafica)grafica.destroy()
        grafica = new Chart(global_canva, datos_grafica);
    }
    this.solicitar_minutos = function solicitar_minutos(no_control="") {
        //const grafica=document.getElementById("grafica")
        if (grafica) grafica.destroy()
    
        enviar_formulario("Entrada/minutosPorEntrada/"+no_control, {
            Fecha: fecha_inicio, Fecha_fin: fecha_fin,
            Posicion_limite: 0, Numero_registros: 100,
            Hora_salida: "is not null"
        })
            .then(
                json => {
                    console.log(json)
                    datos=json
                    if (json.respuesta) {
                        data_entradas = {etiqueta:[], valor:[]}
                        json.contenido.forEach(data => {
                            data_entradas.etiqueta.push(data.etiqueta)
                            data_entradas.valor.push(data.valor)
                        })
                        let carga = {
                            type: 'line',
                            data: {
                                labels: data_entradas.etiqueta,
                                datasets: [{
                                    label: "Horas",
                                    data:  data_entradas.valor,
                                    backgroundColor: [
                                        'rgba(67, 153, 355, 1)'
                                        
                                    ],
                                    borderColor: [
                                        'rgba(67, 153, 355, 1)'
                                      
                                    ],
                                    borderWidth: 1
                                },
                                ]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        display: false,
                                        labels: {
                                            color: 'rgb(255, 99, 132)'
                                        }
                                    }
                                }
                            }
                        };




                        grafica = new Chart(global_canva, carga);
                    }
                }
            )
    }
}

/*

                            options: {
                                legend: {
                                    display: false
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        }*/