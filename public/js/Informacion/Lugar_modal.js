function modal_lugares({ principal, datos }) {
    mostrar_modal({ id_modal: "modal_datos_lugar" })
    editar_datos_lugar(datos)
}

function editar_datos_lugar({ Id_lugar }) {
    nombre_lugar_modal.innerText = Id_lugar
    inicial_lugar_modal.innerText = Id_lugar[0]
}

window.addEventListener("load", function () {
    modal_lugar_cerrar.addEventListener("click", function () {
        console.log(cuadro_dias_lugar)
        cuadro_dias_lugar.reiniciar_estilos_cuadro()
    }
    )
})
