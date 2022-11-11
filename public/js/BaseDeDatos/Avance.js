function Avance(final, function_pasar, datos_pasar) {
    var interfaz
    var interfaz_elementos = {}
    var interfaz_elementos={}
    this.crear_interfaz = function () {
        interfaz = crear_elemento({ tipo: "div", clases: ["d-flex", "justify-content-center", "align-items-center"],
        estilos: [{estilo: "gap", valor: "14px"}]
        })
        interfaz.innerHTML=`  <button type="button" class="btn-atras btn btn-primary"><i class="bi-arrow-left-circle"></i> </button>
        <button type="button" class="btn-avance btn btn-primary"><i class="bi-arrow-right-circle"></i> </button>
        `
        interfaz_elementos.btn_atras=interfaz.querySelectorAll(".btn-atras")[0]
        interfaz_elementos.btn_adelante=interfaz.querySelectorAll(".btn-adelante")[0]
    }
    this.eventos = function eventos(){
        interfaz_elementos.btn_atras.addEventListener("click", function(){
            function_pasar(datos_pasar)
        })
        interfaz_elementos.btn_atras.addEventListener("click", function(){
            function_pasar(datos_pasar)
        })
    }

    this.get_interfaz = function obtener_interfaz() {
        return interfaz
    }

}