
function Datos_hora({fecha_inicio, fecha_fin, url_datos, rango, titulo_grafica}) {
    var global_canva
    var grafica
    var elemento_principal
    var fecha_inicio=fecha_inicio, fecha_fin=fecha_fin
    var url_api=this.url_datos
    var rango=rango??100
    var titulo_grafica=titulo_grafica
    var datos
    var valores
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
    this.solicitar_conteo = function solicitar_minutos(no_control="") {
        //const grafica=document.getElementById("grafica")
        if (grafica) grafica.destroy()
    
        enviar_formulario("Entrada/conteoHora/"+no_control, {
            Fecha: fecha_inicio, Fecha_fin: fecha_fin,
            Hora_salida: "is not null"
        })
            .then(
                json => {
                 
                    datos=json
                    if (json.respuesta) {
                        var valores_entradas=[]
                        json.contenido.forEach(data => {
                            let posicion={}
                            posicion["r"]=3
                            posicion["x"]=data.etiqueta
                            posicion["y"]=data.valor
                            valores_entradas.push(posicion)
                        })
                        valores_entradas.push({
                            r: 0,
                            y: 0,
                            x: 0
                        })
                        valores_entradas.push({
                            r: 0,
                            y: 0,
                            x: 59
                        })
                        enviar_formulario("Entrada/conteoHora/"+no_control, {
                            Fecha: fecha_inicio, Fecha_fin: fecha_fin,
                            Hora_salida: "is null"
                        })
                            .then(
                                json => {
                                    if(json.respuesta){
                                        let valores_salidas=[]
                                        json.contenido.forEach(data => {
                                            let posicion={}
                                            posicion["r"]=3
                                            posicion["x"]=data.etiqueta
                                            posicion["y"]=data.valor
                                            valores_salidas.push(posicion)
                                        })
                                        let carga = {
                                            type: 'bubble',
                                            data: {
                                                labels: valores,
                                                datasets: [{
                                                    label: "# de entradas:",
                                                    data:  valores_entradas,
                                                    backgroundColor: 'rgb(67, 153, 255)'
                                                  },
                                                  {
                                                    label: "# de salidas:",
                                                    data:  valores_salidas,
                                                    backgroundColor: 'rgb(255, 99, 132)'
                                                  }
                                                ]
                                            },
                                            options: {
                                                datasets:{
                                                    line:{
                                                        showLine: false
                                                    }
                                                },
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
                                    
                                })

                      



                        
                    }
                }
            )
    }
}
