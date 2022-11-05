function lugar ({}) {
    
}


function Lugar({ nombre_lugar, datos_formulario,
    titulo_grafica,
    funcion_solicitar_datos,
    configuracion_grafica
    }) 
    {
    var nombre_lugar=nombre_lugar
    var configuracion_grafica=configuracion_grafica??{}
    var datos_formulario=datos_formulario
    var global_canva
    var grafica
    var elemento_principal
    var fecha_inicio=fecha_inicio, fecha_fin=fecha_fin
    var url_api=this.url_datos
    var rango=rango??100
    var titulo_grafica=titulo_grafica
    var datos

    var function_datos=funcion_solicitar_datos
    var datos={}
    this.crear_interfaz = function crear_interfaz() {
        <div class="d-flex flex-column" style="min-width: 260px; min-height: 240px; border: 1px solid">
                            <div class="d-flex w-100" style="height: 80px">
                                <p align="center" class="m-0 p-0 text-secondary" style="max-width: 100%; max-height: 100%; text-overflow: ellipsis; overflow: hidden">Laboratorio de aplicaciones</p>
                            </div>
                            <div class="d-flex w-100 flex-column" style="height: 80px">
                                <div style="height: 50px">
                                    <div class="d-flex flex-column" style="border: 1px solid red; width: 40px; height: 50px;">
                                        <b class="m-0 p-0" align="center" style="height: 30px; font-size: 14pt">30</b>
                                        <p class="m-0 p-0" align="center" style="height: 20px; font-size: 7pt">Entradas</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-center align-items-center w-100" style="height: 30px">
                                    <div class="d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px">
                                        <img src="public/icons/luna.svg" style="width: 20px; height: 20px;" />
                                    </div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                    <div style="border-radius: 50% 50%; width: 20px; height: 20px"></div>

                                </div>

                            </div>

                        </div>
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
    this.solicitar_datos = async function solicitar_datos(no_control="") {
        //const grafica=document.getElementById("grafica")
        
        data_entradas = await function_datos(this, no_control, datos_formulario)
        
        let carga = {
            type: configuracion_grafica["tipo"]??"bar",
            data: {
                labels: data_entradas.etiquetas,
                datasets: data_entradas.datos
            },
            options: {
                events: configuracion_grafica.eventos??["mousemove", "mouseout", "click", "touchstart", "touchmove", "touchend"],
                scales:{
                    y:{
                        display: configuracion_grafica.ver_eje_y??true
                    },
                    x:{
                        display: configuracion_grafica.ver_eje_x??true
                    }
                },
                elements:{
                   point:{
                    radius: 0
                   }
                },
                plugins: {
                    legend: {
                        position: configuracion_grafica.posicion_etiquetas??"top",
                        display: configuracion_grafica["ver_etiquetas"]??true,
                        labels: {
                            color: "rgb(169,169,169)",
                            font: 8
                        }
                    }
                }
            }
        };

        this.pintar_grafica(carga)
     
    }
}








let elemento_padre = document.createElement("div")
elemento_padre.style.minWidth = "300px"
elemento_padre.style.width = "300px"

elemento_padre.classList.add("h-100")
elemento_padre.classList.add("d-flex")
elemento_padre.classList.add("flex-column")


let seccion_titulo = crear_elemento({ tipo: "div", clases: ["d-flex"], 
estilos:[
    {estilo: "height",valor:"33%"}
]});
seccion_titulo.innerHTML = `<div class="w-100" style="height: 25%;">
    <p align="center" class="m-0 p-0 text-secondary" style="max-width: 100%; max-height: 100%; text-overflow: ellipsis; overflow: hidden">${nombre_lugar}</p>
</div>`
elemento_padre.appendChild(seccion_titulo)

let seccion_dia = crear_elemento({ tipo: "div", clases: ["d-flex"], 
estilos:[
    {estilo: "height",valor:"33%"}
]});
elemento_padre.appendChild(seccion_dia)

let seccion_grafica = crear_elemento({ tipo: "div", clases: ["d-flex"], 
estilos:[
    {estilo: "height",valor:"33%"}
]});
elemento_padre.appendChild(seccion_dia)




/* elemento_padre.innerHTML = `<div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
     <p class="text-secondary" style="font-size: 40pt;">${nombre_lugar[0]}</p>
     <div class="position-absolute d-flex justify-content-center align-items-center" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
         <i class="bi-arrow-up-right-circle"></i>
     </div>
 </div>
 <div class="w-100" style="height: 25%;">
     <p align="center" class="m-0 p-0 text-secondary" style="max-width: 100%; max-height: 100%; text-overflow: ellipsis; overflow: hidden">${nombre_lugar}</p>
 </div>`*/
var grafica_lugar_CoC2 = new Grafica_elemento({
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
        let json = await enviar_formulario("Lugar/entradasPorCarrera/", {
            Fecha: datos_formulario.fecha_inicio,
            Fecha_fin: datos_formulario.fecha_fin,
            Id_lugar: identificador
        })

        data_entradas = {
            etiquetas: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio"],
            datos: [{
                label: 'My First Dataset',
                data: [65, 59, 80, 81, 56, 55, 40],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }],
            color: ["rgb(230,55,207)", "rgb(114,58,240)", "rgb(38, 235,43)", "rgb(63,130,217)"]
        }
        /* if (json.respuesta) {
             json.contenido.forEach(data => {
                 data_entradas.etiquetas.push(data.etiqueta)
                 data_entradas.datos[0].data.push(data.valor)
                 data_entradas.datos[0].backgroundColor.push(data.color ?? `rgb(${Math.random()*255}, ${Math.random()*255}, ${Math.random()*255})`)
             })
         }*/
        return data_entradas
    }
})
/* grafica_lugar_CoC2.crear_interfaz()
 elemento_padre.appendChild(grafica_lugar_CoC2.get_elemento_principal())
 grafica_lugar_CoC2.solicitar_datos()*/




return { principal: elemento_padre }