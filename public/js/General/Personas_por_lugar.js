
//hay un timer en la parte de abajo que actualiza el elemento de los lugares
var personas_lugar = {}
const personas_por_lugar = async () => {
     // creamos un json con la estructura
    // personas_lugar{Id_lugar:{esnulo: 2//numero de los, nulos: 4//numero de no nulos}}
    let json = await enviar_formulario("entrada/resumenLugares")
    let personas_lugar = {}
    if (json.respuesta) {
        json.contenido.forEach(registro => {
            if (!personas_lugar[registro.Id_lugar]) {
                personas_lugar[registro.Id_lugar] = {}
                personas_lugar[registro.Id_lugar][registro.esnulo] = registro.conteo
                return
            }
            personas_lugar[registro.Id_lugar][registro.esnulo] = registro.conteo
        })
    }
    return personas_lugar
}
const total_por_lugar = () => {
    personas_por_lugar()
        .then(informacion => {
            if (Object.keys(personas_lugar) == 0) {
    
                Object.entries(informacion).forEach((a) => {  
                    let json_informacion=elementos_con_referencias(a[0], a[1]["no nulo"] ?? 0, a[1]["nulo"] ?? 0)
                    personas_lugar[a[0]]=json_informacion
                    // lo agregamos al DOM
                    plugares_personas.appendChild(json_informacion.referencia)
                })
                return
            }
            let copia_personas={}
            let no_estan={}
            Object.assign(copia_personas, personas_lugar)
            Object.entries(informacion).forEach((a) => {
                if(!personas_lugar[a[0]]){
                    let json_informacion=elementos_con_referencias(a[0], a[1]["no nulo"] ?? 0, a[1]["nulo"] ?? 0)
                    personas_lugar[a[0]]=json_informacion
                    // lo agregamos al DOM
                    plugares_personas.appendChild(json_informacion.referencia)
                    return
                }
                delete copia_personas[a[0]]
                let lugar=personas_lugar[a[0]]
                let dentro=a[1]["no nulo"]??0
                let salidas=a[1]["nulo"]??0
                if(lugar["nulo"]!=dentro){
                    lugar["nulo"]=dentro
                    lugar.dentro.innerText=dentro
                }
                if(lugar["no nulo"]!=salidas){
                    lugar["no nulo"]=salidas
                    lugar.salidas.innerText=salidas
                }
            })
            Object.entries(copia_personas).forEach(a=>{
                 let elemento_dom=a[1].referencia
                 plugares_personas.removeChild(elemento_dom)
            })
            console.log(personas_lugar)
            console.log(informacion)
        })
}
const elementos_con_referencias=(lugar, nonulos, nulos)=>{
    let empaquetado={}
    let contenedor
    let id_dentro, id_salidas
    let id_general
    contenedor = cuadro_lugar(lugar, nonulos, nulos)
    id_general=lugar.replaceAll(" ", "")
    id_dentro="#dentro"+id_general
    id_salidas="#salidas"+id_general
    empaquetado["referencia"] = contenedor
    empaquetado["dentro"] = contenedor.querySelector(id_dentro)
    empaquetado["salidas"] = contenedor.querySelector(id_salidas)
    empaquetado["no nulo"]=nonulos
    empaquetado["nulo"]=nulos
    return empaquetado
}
const cuadro_lugar = (lugar, dentro, salidas) => {
    let id=lugar.replaceAll(" ", "")
    let elemento = document.createElement("div")
    elemento.style.width = "160px"
    elemento.style.height = "76px"
    elemento.classList.add("rounded")
    elemento.classList.add("border")
    elemento.innerHTML = `
    <div class="rounded border" style="width: 160px; height: 76px;">
                        <div class="w-100" style="height: 38%;">
                            <p class="m-1 h-50 font-weight-bold" align="center" style="font-size: 8pt;">
                                ${lugar}
                            </p>
                        </div>
                        <div class="w-100 h-50 d-flex">
                            <div class="h-100 d-flex" style="width: 80px;margin: 0px 4px 0px -2px;">
                                <div class="h-100 w-50 d-flex justify-content-center align-items-center">
                                    <img src="public/ilustraciones/entradas.png" style="height: auto; width: 50%;" alt="">
                                </div>
                                <div class="w-50 h-100 d-flex flex-column">
                                    <div class="h-25 w-100 d-flex">
                                        <p class="m-0 p-0 text-secondary justify-content-center align-content-center" style="font-size: 8pt;">
                                            Entradas
                                        </p>
                                    </div>
                                    <div class="h-100 w-100 d-flex">
                                        <div class="w-75 h-100 d-flex justify-content-center align-content-center">
                                            <p class="m-0 p-0" id="dentro${id}" style="font-size: 14pt;">
                                                ${dentro}
                                            </p>
                                        </div>
                                        <div class="w-100 h-100 d-flex justify-content-center align-content-center">
                                            <div style="width: 8px; height:auto;">
                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 283.64 461" style="enable-background:new 0 0 283.64 461;" xml:space="preserve">
                                                    <g>
                                                        <path fill="#DADADA" d="M112.32,453.36c-2.97-1.42-6.2-2.46-8.86-4.33c-7.16-5.03-9.23-12.45-9.22-20.86c0.05-78.94,0.03-157.89,0.03-236.83
		c0-16.19,0-32.39,0-48.58c0-2.36,0.32-4.64-3.33-4.68c-3.66-0.05-3.8,1.99-3.8,4.74c0.04,33.11,0,66.22,0.05,99.33
		c0.01,6.34-1.95,11.7-7.24,15.4c-5.4,3.78-11.29,4.37-17.23,1.4c-5.89-2.94-9.31-7.81-9.42-14.47c-0.19-11.27-0.1-22.55-0.1-33.83
		c-0.01-27.76,0.03-55.52-0.01-83.28c-0.02-14.12,4.71-26.01,16.08-34.82c5.96-4.62,12.74-7.76,20.29-7.8
		c34.4-0.21,68.82-0.58,103.21,0.02c19.3,0.34,34.46,15.24,37.1,34.39c0.39,2.85,0.54,5.76,0.54,8.65
		c0.03,37.88,0.12,75.76-0.12,113.64c-0.03,4.11-1.22,8.68-3.28,12.21c-3.54,6.06-11.2,8.3-17.88,6.44
		c-7.07-1.97-11.97-7.69-12.55-14.91c-0.23-2.88-0.12-5.78-0.12-8.67c-0.01-31.23-0.02-62.46,0.03-93.69c0-2.75-0.14-4.89-3.8-4.72
		c-2.37,0.11-3.48,0.94-3.33,3.36c0.08,1.3,0.01,2.6,0.01,3.9c0,93.4-0.12,186.8,0.13,280.21c0.04,13.79-4.45,23.54-18.18,27.79
		c-2.6,0-5.21,0-7.81,0c-14.78-6.16-18.16-11.3-18.16-27.66c0-53.76-0.08-110.32-0.08-164.08c0-1.3,0.36,0.09-0.05-1.07
		c-0.34-0.96-1.4-2.11-2.34-2.33c-4.07-0.93-4.66,1.36-4.66,4.89c0.09,55.21,0.04,110.41,0.08,165.62
		c0.01,7.25-1.51,13.98-7.32,18.67c-3.16,2.55-7.21,4.01-10.87,5.96C117.53,453.36,114.92,453.36,112.32,453.36z" />
                                                        <path fill="#DADADA" d="M141.65,72.8c-17.89-0.1-32.55-14.81-32.47-32.59c0.09-17.82,14.8-32.52,32.58-32.56c17.89-0.04,33.07,15.23,32.69,32.89
		C174.06,58.61,159.54,72.89,141.65,72.8z" />
                                                    </g>
                                                </svg>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="h-100 d-flex" style="width: 80px; margin: 0px 2px 0px 2px">
                                <div class="h-100 w-50 d-flex justify-content-center align-items-center">
                                    <img src="public/ilustraciones/salidas.png" style="height: auto; width: 50%;" alt="">
                                </div>
                                <div class="w-50 h-100 d-flex flex-column">
                                    <div class="h-25 w-100 d-flex">
                                        <p class="m-0 p-0 text-secondary justify-content-center align-content-center" style="font-size: 8pt;">
                                            Salidas
                                        </p>
                                    </div>
                                    <div class="h-100 w-100 d-flex">
                                        <div class="w-75 h-100 d-flex justify-content-center align-content-center">
                                            <p class="m-0 p-0" id="salidas${id}" style="font-size: 14pt;">
                                                ${salidas}
                                            </p>
                                        </div>
                                        <div class="w-100 h-100 d-flex justify-content-center align-content-center">
                                            <div style="width: 8px; height:auto;">
                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 283.64 461" style="enable-background:new 0 0 283.64 461;" xml:space="preserve">
                                                    <g>
                                                        <path fill="#DADADA" d="M112.32,453.36c-2.97-1.42-6.2-2.46-8.86-4.33c-7.16-5.03-9.23-12.45-9.22-20.86c0.05-78.94,0.03-157.89,0.03-236.83
		c0-16.19,0-32.39,0-48.58c0-2.36,0.32-4.64-3.33-4.68c-3.66-0.05-3.8,1.99-3.8,4.74c0.04,33.11,0,66.22,0.05,99.33
		c0.01,6.34-1.95,11.7-7.24,15.4c-5.4,3.78-11.29,4.37-17.23,1.4c-5.89-2.94-9.31-7.81-9.42-14.47c-0.19-11.27-0.1-22.55-0.1-33.83
		c-0.01-27.76,0.03-55.52-0.01-83.28c-0.02-14.12,4.71-26.01,16.08-34.82c5.96-4.62,12.74-7.76,20.29-7.8
		c34.4-0.21,68.82-0.58,103.21,0.02c19.3,0.34,34.46,15.24,37.1,34.39c0.39,2.85,0.54,5.76,0.54,8.65
		c0.03,37.88,0.12,75.76-0.12,113.64c-0.03,4.11-1.22,8.68-3.28,12.21c-3.54,6.06-11.2,8.3-17.88,6.44
		c-7.07-1.97-11.97-7.69-12.55-14.91c-0.23-2.88-0.12-5.78-0.12-8.67c-0.01-31.23-0.02-62.46,0.03-93.69c0-2.75-0.14-4.89-3.8-4.72
		c-2.37,0.11-3.48,0.94-3.33,3.36c0.08,1.3,0.01,2.6,0.01,3.9c0,93.4-0.12,186.8,0.13,280.21c0.04,13.79-4.45,23.54-18.18,27.79
		c-2.6,0-5.21,0-7.81,0c-14.78-6.16-18.16-11.3-18.16-27.66c0-53.76-0.08-110.32-0.08-164.08c0-1.3,0.36,0.09-0.05-1.07
		c-0.34-0.96-1.4-2.11-2.34-2.33c-4.07-0.93-4.66,1.36-4.66,4.89c0.09,55.21,0.04,110.41,0.08,165.62
		c0.01,7.25-1.51,13.98-7.32,18.67c-3.16,2.55-7.21,4.01-10.87,5.96C117.53,453.36,114.92,453.36,112.32,453.36z" />
                                                        <path fill="#DADADA" d="M141.65,72.8c-17.89-0.1-32.55-14.81-32.47-32.59c0.09-17.82,14.8-32.52,32.58-32.56c17.89-0.04,33.07,15.23,32.69,32.89
		C174.06,58.61,159.54,72.89,141.65,72.8z" />
                                                    </g>
                                                </svg>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>`
    return elemento

}

