function modal_lugares({principal, datos }){
    mostrar_modal({id_modal: "modal_datos_lugar"})
    editar_datos_lugar(datos)
}

function editar_datos_lugar({ Id_lugar }){
    nombre_lugar_modal.innerText=Id_lugar
    inicial_lugar_modal.innerText=Id_lugar[0]
}