var gr_d
function Grafica_dias({fecha_inicio, fecha_fin, url_datos}) {
    var global_canva
    var grafica_dias
    var elemento_principal
    var fecha_inicio=fecha_inicio, fecha_fin=fecha_fin
    var url_api=this.url_datos
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
        texto_grafico.innerText="Conteo total de entradas por día de la semana"
        elemento_principal.appendChild(texto_grafico)
        contenedor_grafica.appendChild(global_canva)
        elemento_principal.appendChild(contenedor_grafica)
    }
    this.get_elemento_principal = function get_elemento_principal() {
        return elemento_principal
    }
    this.set_fecha_inicio=function set_fecha_inicio(fecha){
        fecha_inicio=fecha
    }
    this.set_fecha_fin=function set_fecha_fin(fecha){
        fecha_fin=fecha
    }

    this.solicitar_dias = function solicitar_dias(no_control) {
        //const grafica=document.getElementById("grafica")
        if (grafica_dias) grafica_dias.destroy()
        enviar_formulario("Entrada/conteoPorSemana/" + no_control,{
            Fecha: fecha_inicio, Fecha_fin: fecha_fin
        })
            .then(
                json => {
                    if (json.respuesta) {
                        data_dias = [0, 0, 0, 0, 0, 0, 0]
                        json.contenido.forEach(data => {
                            data_dias[data.dia_semana - 1] = data.conteo
                        })
                        let carga = {
                            type: 'line',
                            data: {
                                labels: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                                datasets: [{
                                    label: "entradas",
                                    data: data_dias,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 99, 132, 0.2)',
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(255, 99, 132, 1)',
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




                        grafica_dias = new Chart(global_canva, carga);
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