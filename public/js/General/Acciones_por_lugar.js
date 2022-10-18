$("#list-lugares a").on("click", function (e) {
    nombre_lugar=$(this).attr("lugar")
    ordenar_peticion(nombre_lugar, sub_opcion)
    
})
$("#lista-supopciones .lista-opcion").on("click", function (ev) {
    ev.preventDefault();
    sub_opcion=$(this).attr("supopcion")

    ordenar_peticion(nombre_lugar, sub_opcion)
   
    
    //cambiamos estilo y regresamos al estado normal el elemento anterior
    supopcion_seleccionada=pasar_seleccion(supopcion_seleccionada, this)
  
})
const ordenar_peticion=(nombre_lugar, sub_opcion)=>{
    nombre_lugar=nombre_lugar=="Todos"?"":nombre_lugar
    acciones={
        "dentro": "is null",
        "salidas": "is not null",
        "entradas": ""
    }
    data={
        lugar: nombre_lugar,
        hora_salida: acciones[sub_opcion],
        fecha: hoy
    }
    console.log("data")
    console.log(data)
    realizar_accion(data)
    //número de personas por acción
    solicitar_numeros(nombre_lugar, hoy)
}

const realizar_accion=(data)=>{
    enviar_formulario("entrada/todos", data)
    .then(json => {
        if (json.respuesta) {
            //limpiamos registros
            lista_registros.innerHTML=""
            agregar_registros(lista_registros, json.contenido)
        }
    })
}
const pasar_seleccion=(elemento_anterior, elemento_nuevo)=>{
    elemento_anterior.classList.remove("active")
    elemento_nuevo.classList.add("active")
    return elemento_nuevo
}