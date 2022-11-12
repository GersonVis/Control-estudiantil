function ContenedorPartes(titulo) {
    var interfaz
    var partes_interfaz={
        agregadas: undefined,
        disponibles: undefined
    }
    this.get_titulo=function get_titulo(){
        return titulo
    }
    this.crear_interfaz = function () {
         interfaz=crear_elemento({tipo: "div"})
         interfaz.innerHTML=`<div id="condicionales-entradas" class="d-flex w-100 p-3 flex-column" style="flex-grow: 1; overflow:auto">
         <div  class="agregadas d-flex flex-column" style="gap: 10px;"></div>
         <hr>
         </hr>
         <div  class="disponibles d-flex flex-column" style="gap: 10px;"></div>
         </div>`
         interfaz=interfaz.childNodes[0]
         partes_interfaz.agregadas=interfaz.querySelectorAll(".agregadas")[0]
         partes_interfaz.disponibles=interfaz.querySelectorAll(".disponibles")[0]
    }
    this.get_partes_interfaz=function get_partes_interfaz(){
        return partes_interfaz
    }
    this.get_interfaz = function obtener_interfaz() {
        return interfaz
    }

}