$("#list-lugares a").on("click", function (e) {
    nombre_lugar=$(this).text()


    if ($(this).text() == "Todos") {
        
        return
    }

})
$("#lista-supopciones .lista-opcion").on("click", function (ev) {
    ev.preventDefault();
    sub_opcion=$(this).attr("supopcion")
})

const realizar_accion=(nombre_lugar, supopcion)=>{
    enviar_formulario("entrada/todos", )
    .then(json => {
        if (json.respuesta) {
            agregar_registros(lista_registros, json.contenido)
        }
    })
}