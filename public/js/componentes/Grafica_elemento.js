
function Grafica_elemento({datos_formulario,
    titulo_grafica,
    funcion_solicitar_datos
    }) 
    {
    var datos_formulario=datos_formulario
    var global_canva
    var grafica
    var elemento_principal
    var fecha_inicio=fecha_inicio, fecha_fin=fecha_fin
    var url_api=this.url_datos
    var rango=rango??100
    var titulo_grafica=titulo_grafica
    var datos
    var valores
    var function_datos=funcion_solicitar_datos
    var datos={}
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
    this.solicitar_datos = function solicitar_datos(no_control="") {
        //const grafica=document.getElementById("grafica")
        function_datos(this, no_control, datos_formulario)
        
        
     
    }
}
