function Steeps(cuantos_pasos) {
    var interfaz
    var interfaz_elementos = {}
    this.crear_interfaz = function () {
        interfaz = crear_elemento({ tipo: "div", clases: ["d-flex", "justify-content-center", "align-items-center"] })



        for (let steep = 0; steep < cuantos_pasos - 1; steep++) {
            interfaz.innerHTML += `<div class="circulo-steep" style="height: 15px; width: 15px; border-radius: 50% 50%; background-color: var(--color-decorativo)"></div>
            <div class="barra-steep" style="height: 5px; width: 25px; background-color: var(--color-decorativo)"></div>`
        }
        interfaz.innerHTML += `<div class="circulo-steep" style="height: 15px; width: 15px; border-radius: 50% 50%; background-color: var(--color-decorativo)"></div>`
        interfaz_elementos.circulos = interfaz.querySelectorAll(".circulo-steep")
        interfaz_elementos.barras = interfaz.querySelectorAll(".barra-steep")
    }
    this.marcar_steep = function marcar_steep(posicion) {
       const { circulos, barras } = interfaz_elementos
        
        if(posicion < circulos.length ) {
            for (let pos = 0; pos <= posicion; pos++) {
                circulos[pos].style.backgroundColor="green"
            }
            for (let pos = 0; pos <= posicion-1; pos++) {
                barras[pos].style.backgroundColor="green"
            }

            for (let pos = posicion+1; pos < circulos.length; pos++) {
                circulos[pos].style.backgroundColor="red"
            }
            for (let pos = posicion; pos < barras.length; pos++) {
                barras[pos].style.backgroundColor="red"
            }
        }
    }
    this.reiniciar_conteo=function reiniciar_conteo() {
        const { circulos, barras } = interfaz_elementos
    }
    this.agregar_eventos = function agregar_eventos() {
        interfaz_elementos.boton.addEventListener("click", function (evt) {

            let control = funcion_click({ agregado: padre_agregado, disponible: padre_disponible, boton: interfaz_elementos.boton })
            if (control) return;

            let estado = interfaz_elementos.boton.attributes["estado"].value
            if (estado == "agregado") {
                padre_disponible.appendChild(interfaz)
                interfaz_elementos.icono.classList.remove("bi-x-circle")
                interfaz_elementos.icono.classList.add("bi-plus-circle")
                interfaz_elementos.boton.attributes["estado"].value = "diponible"
                return
            }
            padre_agregado.appendChild(interfaz)
            interfaz_elementos.icono.classList.remove("bi-plus-circle")
            interfaz_elementos.icono.classList.add("bi-x-circle")
            interfaz_elementos.boton.attributes["estado"].value = "agregado"
        })
    }

    this.get_interfaz = function obtener_interfaz() {
        return interfaz
    }

}