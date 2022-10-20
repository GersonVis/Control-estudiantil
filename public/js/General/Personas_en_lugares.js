
const solicitar_numeros = (lugar, fecha) => {
    let data = {
        Id_lugar: lugar,
        fecha: fecha
    }
 //   console.log(data)
    enviar_formulario("entrada/conteo", data)
        .then(json => {
            console.log(json)
            if (json.respuesta) {
                let dentro, entradas, salidas
                let estados
                estados = {}
                json.contenido.forEach(e => {
                    estados[e.Estado] = e.conteo
                })
                dentro = estados["vacio"] ?? 0
                salidas = estados["no vacio"] ?? 0
                entradas = (+dentro) + (+salidas)
                mostrar_dentro(dentro)
                mostrar_salidas(salidas)
                mostrar_entradas(entradas)
            }
        })
}
const mostrar_entradas = (numero) => {
    p_entradas.innerText = numero
}
const mostrar_salidas = (numero) => {
    p_salidas.innerText = numero
}
const mostrar_dentro = (numero) => {
    p_dentro.innerText = numero
}