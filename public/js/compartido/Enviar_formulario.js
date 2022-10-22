
const enviar_formulario = async (url_formulario, datos={})=>{
    try {
        let formData=new FormData()
      
        Object.entries(datos).forEach(entrada=>{
            formData.append(entrada[0], entrada[1])
         })
        let respuesta = await fetch(url_formulario, {
            method: "POST",
            body: formData
        })
        let convertir;
        try{
            convertir = await respuesta.json()
        }catch(error){
            convertir = {
                tipo: "Mensaje local",
                respuesta: false, 
                contenido: [], 
                mensaje: await respuesta.text(),
                error: "respuesta json no valida"
             }
        }
        return convertir
     } catch (error) {
        console.error(error)
        return {respuesta: false, contenido:[]}
    }
   
}