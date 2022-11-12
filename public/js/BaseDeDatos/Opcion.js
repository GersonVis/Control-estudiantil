function Opcion(titulo, padre_disponible, padre_agregado, funciones={}, complemento="") {
    var interfaz
    var interfaz_elementos = {
        
    }
    var compartido={
        msg: undefined
    }
    var instancia = this
    this.crear_interfaz = function () {
        interfaz = crear_elemento({ tipo: "div" })
        let dentro=`<div class="d-flex align-items-center p-3" style="flex-grow: 1; border-radius: 8px; border: 1px solid var(--color-decorativo); height: 50px; width: 100%">
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
        if(complemento!=""){
            dentro=`<div class="d-flex align-items-center p-3" style="border-radius: 8px; border: 1px solid var(--color-decorativo); height: 70px; width: 100%">
        <div class="w-75 d-flex flex-column">
            <b class="p-0 m-0" style="color: var(--color-prioridad-baja-baja)">${titulo}</b>
            <div class="complemento d-flex justify-content-center align-items-center" style="flex-grow: 1">
                ${complemento}
            </div>
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
        }
        interfaz.innerHTML = dentro
        interfaz = interfaz.childNodes[0]
        interfaz_elementos.boton = interfaz.querySelectorAll(".btn-opcion-accion")[0]
        interfaz_elementos.icono = interfaz.querySelectorAll(".ico-opcion-accion")[0]

        this.agregar_eventos()

    }
    this.agregar_eventos = function agregar_eventos() {
        interfaz_elementos.boton.addEventListener("click", function (evt) {
            instancia.btn_click(undefined, evt)
        })
    }
    this.btn_click = function btn_click(mover=undefined, evt){
        let control = funciones.funcion_click({compartido: compartido,evt: evt, accion: mover, agregado: padre_agregado, disponible: padre_disponible, boton: interfaz_elementos.boton })
        if (control) return;
        let estado = mover??interfaz_elementos.boton.attributes["estado"].value
        if (estado == "agregado") {
            instancia.agregar_disponible()
            funciones.funcion_despues({compartido: compartido, accion: mover, agregado: padre_agregado, disponible: padre_disponible, boton: interfaz_elementos.boton })
            return
        }
        instancia.agregar_agregado()
        funciones.funcion_despues({ compartido: compartido, accion: mover, agregado: padre_agregado, disponible: padre_disponible, boton: interfaz_elementos.boton })
    }

    this.get_interfaz = function obtener_interfaz() {
        return interfaz
    }
    this.agregar_disponible = function agregar_disponible() {
        padre_disponible.appendChild(interfaz, 0)
        interfaz_elementos.icono.classList.remove("bi-x-circle")
        interfaz_elementos.icono.classList.add("bi-plus-circle")
        interfaz_elementos.boton.attributes["estado"].value = "diponible"
    }
    this.agregar_agregado = function agregar_disponible() {
        padre_agregado.appendChild(interfaz, 0)
        interfaz_elementos.icono.classList.remove("bi-plus-circle")
        interfaz_elementos.icono.classList.add("bi-x-circle")
        interfaz_elementos.boton.attributes["estado"].value = "agregado"
    }
}