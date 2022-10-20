
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
        let json= await respuesta.text()
        
        return json
     } catch (error) {
        console.error(error)
        return {respuesta: false, contenido:[]}
    }
   
}