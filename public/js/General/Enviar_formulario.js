
const enviar_formulario = async (url_formulario, datos={})=>{
    try {
        let formData=new FormData()
        console.log(datos)
        Object.entries(datos).forEach(entrada=>{
            formData.append(entrada[0], entrada[1])
         })
        let respuesta = await fetch(url_formulario, {
            method: "POST",
            body: formData
        })
        let json= await respuesta.json()
        
        return json
     } catch (error) {
        console.error(error)
        return {respuesta: false, contenido:[]}
    }
   
}