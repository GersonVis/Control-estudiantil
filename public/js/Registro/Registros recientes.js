/*
Actualización del panel de registros recientes
*/
var almacen_registros = {}
const hoy = new Date();
const fecha_hoy = hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, "0") + "-" + String(hoy.getDate()).padStart(2, "0")
const datos_hoy = new FormData()
datos_hoy.append("fecha", fecha_hoy)

var dentro

const nuevos_ingresos = () => {
    console.log("llamada")
    fetch("Entrada/sinSalida", {
        method: "POST",
        body: datos_hoy
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            if (json.respuesta) {
                if (Object.keys(personas_registradas).length == 0) {
                    json.contenido.forEach(elemento => {
                        personas_registradas[elemento.No_control] = elemento
                        personas_registradas[elemento.No_control]["disponible"] = true
                        registro_exitoso_entrada(elemento)
                    })
                    return
                }
                let no_encontrados
                let nuevo_array = {}
                let contenido

                contenido = json.contenido
                jjsss = contenido
                Object.assign(nuevo_array, personas_registradas)
              /*  console.log("contenido")
                console.log(contenido)
                console.log("nuevo array")
                console.log(nuevo_array)*/

                no_encontrados = contenido.filter(elemento => {
                    personas_registradas[elemento.No_control] = elemento
                    personas_registradas[elemento.No_control]["disponible"] = true
                    if (!nuevo_array[elemento.No_control]) {
                        return elemento
                    }
                    delete nuevo_array[elemento.No_control]
                })
              /*  console.log("nuevo array2")
                console.log(nuevo_array)*/

                no_encontrados.forEach(elemento => {
                    registro_exitoso_entrada(elemento)
                })
                
                Object.values(nuevo_array).forEach(elemento => {
                    remover_de_padre("registro" + elemento.Id_acceso)
                })
            }
            //  comparar_infomacion(almacen_registros, json.contenido)
        })
        .catch(er => {
            console.error("ocurrio un error al hacer la consulta")
            console.error(er)
        })
}
const comparar_infomacion = (json_antigo, json_nuevo) => {
    let json_antigo_s = JSON.stringify(json_antigo)
    let json_nuevo_s = JSON.stringify(json_nuevo)
    if (json_antigo_s != json_nuevo_s) {
        json_nuevo.forEach(element => {

        });
    }
}
const remover_de_padre = (id) => {
    let padre, registro
    registro = document.querySelector("#" + id)
    if (registro) {
        padre = registro.parentElement
        padre.removeChild(registro)
    }
}