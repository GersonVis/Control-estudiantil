
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
        let texto
        try{
            texto= await respuesta.text()
            convertir = JSON.parse(texto)
        }catch(error){
            console.error(error)
            convertir = {
                tipo: "Mensaje local",
                respuesta: false, 
                contenido: [], 
                mensaje: texto,
                error: "respuesta json no valida"
             }
            console.log(convertir)
        }
        return convertir
     } catch (error) {
        console.error(error)
        return {respuesta: false, contenido:[]}
    }
   
}