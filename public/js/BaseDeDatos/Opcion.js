function Opcion(titulo, padre_disponible, padre_agregado, funcion_click) {
    var interfaz
    var interfaz_elementos = {}
    this.crear_interfaz = function () {
        interfaz = crear_elemento({ tipo: "div" })
        interfaz.innerHTML = `<div class="d-flex align-items-center p-3" style="border-radius: 8px; border: 1px solid var(--color-decorativo); height: 50px; width: 100%">
        <div class="w-75">
            <b class="p-0 m-0" style="color: var(--color-prioridad-baja-baja)">${titulo}</b>
        </div>
        <div class="w-25 d-flex justify-content-end align-items-center" style="padding-right: 14px;">
            <button estado="agregado" class="btn-opcion-accion" style="
            width: 28px;
            height: 28px;
            border-radius: 50% 50%;
            background: none;
            border: none;
        ">
            <i class="ico-opcion-accion bi bi-x-circle"></i>
            </button>
        </div>
       </div>`
        interfaz = interfaz.childNodes[0]
        interfaz_elementos.boton = interfaz.querySelectorAll(".btn-opcion-accion")[0]
        interfaz_elementos.icono = interfaz.querySelectorAll(".ico-opcion-accion")[0]

        this.agregar_eventos()

    }
    this.agregar_eventos = function agregar_eventos() {
        interfaz_elementos.boton.addEventListener("click", function (evt) {

            let control = funcion_click({agregado: padre_agregado, disponible: padre_disponible, boton: interfaz_elementos.boton})
            if(control)return;

            let estado = interfaz_elementos.boton.attributes["estado"].value
            if (estado == "agregado") {
                padre_disponible.appendChild(interfaz)
                interfaz_elementos.icono.classList.remove("bi-x-circle")
                interfaz_elementos.icono.classList.add("bi-plus-circle")
                interfaz_elementos.boton.attributes["estado"].value="diponible"
                return
            }
            padre_agregado.appendChild(interfaz)
            interfaz_elementos.icono.classList.remove("bi-plus-circle")
            interfaz_elementos.icono.classList.add("bi-x-circle")
            interfaz_elementos.boton.attributes["estado"].value="agregado"
        })
    }

    this.get_interfaz = function obtener_interfaz() {
        return interfaz
    }
    this.agregar_disponible = function agregar_disponible() {
        padre_disponible.appendChild(interfaz)
    }
    this.agregar_agregado = function agregar_disponible() {
        padre_agregado.appendChild(interfaz)
    }
}