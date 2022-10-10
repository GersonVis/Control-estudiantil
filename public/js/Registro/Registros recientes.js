/*
Actualización del panel de registros recientes
*/
var almacen_registros={}
const nuevos_ingresos=()=>{
    fetch("Entrada/entradaAumatica")
    .then(respuesta=>respuesta.json())
    .then(json=>{
        comparar_infomacion(almacen_registros, json.contenido)
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