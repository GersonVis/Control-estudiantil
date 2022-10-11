/*
Actualización del panel de registros recientes
*/
var almacen_registros={}
const hoy=new Date();
const fecha_hoy=hoy.getFullYear()+"-"+String(hoy.getMonth()+1).padStart(2, "0")+"-"+String(hoy.getDate()).padStart(2, "0")
const datos_hoy=new FormData()
datos_hoy.append("fecha", fecha_hoy)

const nuevos_ingresos=()=>{
    console.log("llamada")
    fetch("Entrada/sinSalida",{
        method: "POST",
        body: datos_hoy
    })
    .then(respuesta=>respuesta.json())
    .then(json=>{
         if(json.respuesta){
            if(Object.keys(personas_registradas).length==0){
                respuesta.contenido.forEach(elemento=>{
                    registro_exitoso(elemento)
                })
                return
            }
            console.log(json)
            contenido=json.contenido
            parejas=[]
            nuevo_array={}
            Object.assign(nuevo_array, personas_registradas)
            encontrados=contenido.map(elemento=>{
                if(!nuevo_array[elemento.no_control]){
                    delete nuevo_array[elemento.no_control]
                    return elemento
                }
            })
            console.log("nuevos ingresos")
            
         }
        //  comparar_infomacion(almacen_registros, json.contenido)
    })
    .catch(er=>{
        console.error("ocurrio un error al hacer la consulta")
        console.error(er)
    })
}
const comparar_infomacion=(json_antigo, json_nuevo)=>{
   let json_antigo_s=JSON.stringify(json_antigo)
   let json_nuevo_s=JSON.stringify(json_nuevo)
   if(json_antigo_s!=json_nuevo_s){
        json_nuevo.forEach(element => {
            
        });
   }
}
const remover_de_padre=(id)=>{
    let padre, registro
    registro=document.querySelector("#"+id)
    console.log(registro)
    padre=registro.parentElement
    padre.removeChild(registro)
}