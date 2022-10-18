/*
Actualización del panel de registros recientes
*/
var almacen_registros = {}
const hoy = new Date();
const fecha_hoy = hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, "0") + "-" + String(hoy.getDate()).padStart(2, "0")
const datos_hoy = new FormData()
datos_hoy.append("fecha", fecha_hoy)

var jsss

const nuevos_ingresos = () => {
    console.log("llamada")
    fetch("Entrada/sinSalida", {
        method: "POST",
        body: datos_hoy
    })
<<<<<<< HEAD
<<<<<<< HEAD
=======
    .then(respuesta=>respuesta.json())
    .then(json=>{
         if(json.respuesta){
            if(Object.keys(personas_registradas).length==0){
                json.contenido.forEach(elemento=>{
                    personas_registradas[elemento.no_control]=elemento
                    personas_registradas[elemento.no_control]["disponible"]=true
                    registro_exitoso(elemento)
=======
>>>>>>> a0e2fb6e9a441103fecb4f2339602181f884a3e1
        .then(respuesta => respuesta.json())
        .then(json => {
            if (json.respuesta) {
                if (Object.keys(personas_registradas).length == 0) {
                    json.contenido.forEach(elemento => {
                        personas_registradas[elemento.no_control] = elemento
                        personas_registradas[elemento.no_control]["disponible"] = true
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
                    personas_registradas[elemento.no_control] = elemento
                    personas_registradas[elemento.no_control]["disponible"] = true
                    if (!nuevo_array[elemento.no_control]) {
                        return elemento
                    }
                    delete nuevo_array[elemento.no_control]
                })
              /*  console.log("nuevo array2")
                console.log(nuevo_array)*/

                no_encontrados.forEach(elemento => {
                    registro_exitoso_entrada(elemento)
<<<<<<< HEAD
=======
    .then(respuesta=>respuesta.json())
    .then(json=>{
         if(json.respuesta){
            if(Object.keys(personas_registradas).length==0){
                json.contenido.forEach(elemento=>{
                    personas_registradas[elemento.no_control]=elemento
                    personas_registradas[elemento.no_control]["disponible"]=true
                    registro_exitoso(elemento)
>>>>>>> ff13c27 (doble elemento)
=======
>>>>>>> modificando-metodo-todos
>>>>>>> a0e2fb6e9a441103fecb4f2339602181f884a3e1
                })
                
                Object.values(nuevo_array).forEach(elemento => {
                    remover_de_padre("registro" + elemento.id_entrada)
                })
            }
<<<<<<< HEAD
<<<<<<< HEAD
=======
            let no_encontrados
            let nuevo_array={}
            let contenido
           
            contenido=json.contenido
            jjsss=contenido
            Object.assign(nuevo_array, personas_registradas)
      
            no_encontrados=contenido.filter(elemento=>{
                personas_registradas[elemento.no_control]=elemento
                personas_registradas[elemento.no_control]["disponible"]=true
                console.log(nuevo_array[elemento.no_control])
                if(!nuevo_array[elemento.no_control]){
                    console.log("entro")
                    return elemento
                }
                delete nuevo_array[elemento.no_control]
            })

          
            no_encontrados.forEach(elemento=>{
                registro_exitoso(elemento)
            })
            Object.values(nuevo_array).forEach(elemento=>{
                remover_de_padre("registro"+elemento.id_entrada)
            })
         }
        //  comparar_infomacion(almacen_registros, json.contenido)
    })
    .catch(er=>{
        console.error("ocurrio un error al hacer la consulta")
        console.error(er)
    })
=======
>>>>>>> a0e2fb6e9a441103fecb4f2339602181f884a3e1
            //  comparar_infomacion(almacen_registros, json.contenido)
        })
        .catch(er => {
            console.error("ocurrio un error al hacer la consulta")
            console.error(er)
        })
<<<<<<< HEAD
=======
            let no_encontrados
            let nuevo_array={}
            let contenido
           
            contenido=json.contenido
            jjsss=contenido
            Object.assign(nuevo_array, personas_registradas)
      
            no_encontrados=contenido.filter(elemento=>{
                personas_registradas[elemento.no_control]=elemento
                personas_registradas[elemento.no_control]["disponible"]=true
                console.log(nuevo_array[elemento.no_control])
                if(!nuevo_array[elemento.no_control]){
                    console.log("entro")
                    return elemento
                }
                delete nuevo_array[elemento.no_control]
            })

          
            no_encontrados.forEach(elemento=>{
                registro_exitoso(elemento)
            })
            Object.values(nuevo_array).forEach(elemento=>{
                remover_de_padre("registro"+elemento.id_entrada)
            })
         }
        //  comparar_infomacion(almacen_registros, json.contenido)
    })
    .catch(er=>{
        console.error("ocurrio un error al hacer la consulta")
        console.error(er)
    })
>>>>>>> ff13c27 (doble elemento)
=======
>>>>>>> modificando-metodo-todos
>>>>>>> a0e2fb6e9a441103fecb4f2339602181f884a3e1
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