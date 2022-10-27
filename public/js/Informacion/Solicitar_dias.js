
async function solicitar_dias(no_control, datos={}){
    let datos_dias= await enviar_formulario("Entrada/diasAlumno/"+no_control, datos)
    if(datos_dias.respuesta)return datos_dias.contenido
    return []        
}
