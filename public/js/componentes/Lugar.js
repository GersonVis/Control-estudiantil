

function Lugar({ nombre_lugar, datos_formulario,
    titulo_grafica,
    funcion_solicitar_datos,
    configuracion_grafica
}) {

    var nombre_lugar = nombre_lugar ?? "lugar"
    var configuracion_grafica = configuracion_grafica ?? {}
    var datos_formulario = datos_formulario
    var global_canva
    var grafica
    var elemento_principal
    var fecha_inicio = fecha_inicio, fecha_fin = fecha_fin
    var url_api = this.url_datos
    var rango = rango ?? 100
    var titulo_grafica = titulo_grafica
    var datos

    var id = new Date()

    var function_datos = funcion_solicitar_datos
    var datos = {}
    var eventos = {
        evt_mover_luna: undefined
    }
    var instancia = this
    var lunas_control = {
        datos_por_luna: [...Array(24).keys()].map(a => 0),
        contenedor_texto: undefined,
        contenedor_lunas: undefined,
        contenedores_lunas: undefined,
        luna_anterior: undefined,
        imagenes_condicionales: {
            luna: '<img src="public/icons/luna.svg" style="width: 20px; height: 20px;" />',
            sol: '<img src="public/icons/sol.svg" style="border-radius: 50% 50%; background-color: #ffd900; width: 20px; height: 20px;" />',
        }
    }
    var instancias_graficas={
        carga: undefined
    }
    this.crear_interfaz = function crear_interfaz() {
        elemento_principal = crear_elemento({ tipo: "div" })
        elemento_principal.innerHTML = `
                       <div class="d-flex position-relative flex-column" style="border-radius: 13px;min-width: 480px;min-height: 240px;border: 1px solid var(--color-decorativo);width: 500px;">
                           <div class="carga d-flex justify-content-center align-items-center position-absolute h-100 w-100" style="border-radius: 13px; background: white">
                             <div class="spinner-border" role="status">
                              <span class="sr-only">Loading...</span>
                             </div>
                           </div>
                           <div class="p-1 d-flex w-75" style="height: 80px">
                                <b align="center" class="m-3 p-0 text-secondary" style="max-width: 100%; max-height: 100%; text-overflow: ellipsis; overflow: hidden">${nombre_lugar}</b>
                            </div>
                            <div class="d-flex w-100 flex-column" style="height: 80px">
                                <div style="height: 50px">
                                    <div  class=" contenedor-texto d-flex flex-column" style="width: 40px; height: 50px;">
                                        <b class="texto-lunas m-0 p-0" align="center" style="height: 30px; font-size: 14pt">30</b>
                                        <p class="m-0 p-0" align="center" style="height: 20px; font-size: 7pt">Entradas</p>
                                    </div>
                                </div>
                            <div class="contenedor-lunas d-flex flex-row justify-content-center align-items-center w-100" style="height: 30px">
                                
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900""></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px; background-color: #ffd900""></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>
                                <div class="luna d-flex justify-content-center align-items-center" style="border-radius: 50% 50%; width: 20px; height: 20px"></div>                        
                            </div>

                            </div>
                            <div class="contenedor-grafico p-1 d-flex w-100 flex-column" style="height: 70px">
                               <canvas class="global-canva" style="display: block; max-height: 70px; box-sizing: border-box; height: 70px; width: 728px;" width="728" height="250"></canvas>
                            </div>

                        </div>`

        elemento_principal = elemento_principal.children[0]

        lunas_control.contenedor_texto = elemento_principal.querySelectorAll(".contenedor-texto")[0]
        lunas_control.contenedor_lunas = elemento_principal.querySelectorAll(".contenedor-lunas")[0]
        lunas_control.contenedores_lunas = elemento_principal.querySelectorAll(".luna")

        lunas_control.texto_lunas = elemento_principal.querySelectorAll(".texto-lunas")[0]

        global_canva = elemento_principal.querySelectorAll(".global-canva")[0]

        
        instancias_graficas.carga = elemento_principal.querySelectorAll(".carga")[0]
      
        //    lunas_control.contenedor_texto = padre.

    }
    this.mover_lunas = function mover_lunas(avance) {
        console.log("avance", avance)
        if (lunas_control.luna_anterior) {
            lunas_control.luna_anterior.innerHTML = ""
        }

        luna_seleccionada = lunas_control.contenedores_lunas[avance]
        lunas_control.contenedor_texto.style.marginLeft = avance * 20 + "px"
        luna_seleccionada.innerHTML = lunas_control.imagenes_condicionales[avance < 7 || avance > 19 ? "luna" : "sol"]
        lunas_control.luna_anterior = luna_seleccionada

        let recomponer = avance
        lunas_control.texto_lunas.innerText = lunas_control.datos_por_luna[avance]

    }
    this.evento_por_hora = function evento_por_hora() {
        setInterval(function () {
            instancia.solicitar_datos(nombre_lugar)
        }, 60000)
    }

    this.evento_mover_luna = function evento_mover_luna(alcanzar) {
        /*mueve la luna una vez por hora en el minuto especificado*/
        console.log("moviendo")
        let evt_anterior = eventos.mover_lunas
        let faltan
        let hoy, minutos, milisegundos, horas
        hoy = new Date()
        minutos = hoy.getMinutes()
        horas = hoy.getHours()
        console.log("horas", horas, hoy)
        //milisegundos=hoy.milisegundos()
        faltan = alcanzar - minutos
        if (evt_anterior) {
            clearTimeout(evt_anterior)
        }
        instancia.mover_lunas(parseInt(horas))
        faltan = faltan > 0 ? faltan : (59 - (Math.abs(faltan) + alcanzar)) + alcanzar
        //console.log(faltan)
        setTimeout(function () {
            instancia.evento_mover_luna(alcanzar)
        }, faltan * 60000)

    }
    this.get_elemento_principal = function get_elemento_principal() {
        return elemento_principal
    }
    this.get_grafica = function get_grafica() {
        return grafica
    }
    this.get_canva = function get_canva() {
        return global_canva
    }
    this.get_lunas_control = function get_lunas_control() {
        return lunas_control
    }
    this.set_grafica = function set_grafica(nuevo_valor) {
        grafica = nuevo_valor
    }
    this.set_fecha_inicio = function set_fecha_inicio(fecha) {
        fecha_inicio = fecha
    }
    this.set_fecha_fin = function set_fecha_fin(fecha) {
        fecha_fin = fecha
    }
    this.get_canva = function get_canva() {
        return global_canva
    }
    this.get_datos = function get_datos() {
        return datos
    }
    this.get_instancias_graficas=function get_instancias_graficas(){
        return instancias_graficas
    }
    this.pintar_grafica = function pintar_grafica(datos_grafica) {
        if (grafica) grafica.destroy()
        grafica = new Chart(global_canva, datos_grafica);
    }
    this.remover_carga = function remover_carga(){
         instancias_graficas.carga.remove()
         instancias_graficas.carga=undefined
    }
    this.solicitar_datos = async function solicitar_datos(identificador = "") {
        //const grafica=document.getElementById("grafica")

        data_entradas = await function_datos(this, identificador, datos_formulario)
      //  console.log(nombre_lugar, data_entradas.datos)
        lunas_control.datos_por_luna = data_entradas.datos_por_luna

        instancia.mover_lunas(parseInt(data_entradas.hora))

        if(instancias_graficas.carga){
            
            setTimeout(function(){
                instancia.remover_carga()
            }, 400)
        }

        let carga = {
            type: configuracion_grafica["tipo"] ?? "bar",
            data: {
                labels: data_entradas.etiquetas,
                datasets: data_entradas.datos
            },
            options: {
                animation:{
                    duration: 0
                },
                events: configuracion_grafica.eventos ?? ["mousemove", "mouseout", "click", "touchstart", "touchmove", "touchend"],
                scales: {
                    y: {
                        display: configuracion_grafica.ver_eje_y ?? true
                    },
                    x: {
                        display: configuracion_grafica.ver_eje_x ?? true
                    }
                },
                elements: {
                    point: {
                        radius: 0
                    }
                },
                plugins: {
                    legend: {
                        position: configuracion_grafica.posicion_etiquetas ?? "top",
                        display: configuracion_grafica["ver_etiquetas"] ?? true,
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




/*



let elemento_padre = document.createElement("div")
elemento_padre.style.minWidth = "300px"
elemento_padre.style.width = "300px"

elemento_padre.classList.add("h-100")
elemento_padre.classList.add("d-flex")
elemento_padre.classList.add("flex-column")


let seccion_titulo = crear_elemento({
    tipo: "div", clases: ["d-flex"],
    estilos: [
        { estilo: "height", valor: "33%" }
    ]
});
seccion_titulo.innerHTML = `<div class="w-100" style="height: 25%;">
    <p align="center" class="m-0 p-0 text-secondary" style="max-width: 100%; max-height: 100%; text-overflow: ellipsis; overflow: hidden">${nombre_lugar}</p>
</div>`
elemento_padre.appendChild(seccion_titulo)

let seccion_dia = crear_elemento({
    tipo: "div", clases: ["d-flex"],
    estilos: [
        { estilo: "height", valor: "33%" }
    ]
});
elemento_padre.appendChild(seccion_dia)

let seccion_grafica = crear_elemento({
    tipo: "div", clases: ["d-flex"],
    estilos: [
        { estilo: "height", valor: "33%" }
    ]
});
elemento_padre.appendChild(seccion_dia)

*/


/* elemento_padre.innerHTML = `<div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
     <p class="text-secondary" style="font-size: 40pt;">${nombre_lugar[0]}</p>
     <div class="position-absolute d-flex justify-content-center align-items-center" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
         <i class="bi-arrow-up-right-circle"></i>
     </div>
 </div>
 <div class="w-100" style="height: 25%;">
     <p align="center" class="m-0 p-0 text-secondary" style="max-width: 100%; max-height: 100%; text-overflow: ellipsis; overflow: hidden">${nombre_lugar}</p>
 </div>`*/
/*var grafica_lugar_CoC2 = new Grafica_elemento({
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
/*  return data_entradas
}
})
/* grafica_lugar_CoC2.crear_interfaz()
elemento_padre.appendChild(grafica_lugar_CoC2.get_elemento_principal())
grafica_lugar_CoC2.solicitar_datos()*/

/*


return { principal: elemento_padre }*/