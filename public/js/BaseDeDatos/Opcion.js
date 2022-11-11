function Opcion(titulo, padre_disponible, padre_agregado){
    var interfaz
    this.crear_interfaz=function(){
        interfaz=crear_elemento({tipo: "div"})
        interfaz.innerHTML=`<div class="d-flex align-items-center p-3" style="border-radius: 8px; border: 1px solid var(--color-decorativo); height: 50px; width: 100%">
        <div class="w-75">
            <b class="p-0 m-0" style="color: var(--color-prioridad-baja-baja)">${titulo}</b>
        </div>
        <div class="w-25 d-flex justify-content-end align-items-center" style="padding-right: 14px;">
            <i class="bi bi-x-circle"></i>
        </div>
       </div>`
       interfaz=interfaz.childNodes[0]
    }
    this.get_interfaz=function obtener_interfaz()
    {
        return interfaz
    }
    this.agregar_disponible=function agregar_disponible(){
        padre_disponible.appendChild(interfaz)
    }
    this.agregar_agregado=function agregar_disponible(){
        padre_agregado.appendChild(interfaz)
    }
}