function Avance(function_pasar, datos_pasar) {
    var interfaz
    var interfaz_elementos = {}
    var posicion=0
    var instancia=this
    this.crear_interfaz = function () {
        interfaz = crear_elemento({ tipo: "div", clases: ["d-flex", "justify-content-center", "align-items-center"],
        estilos: [{estilo: "gap", valor: "14px"}]
        })
        interfaz.innerHTML=`  <button type="button" class="btn-atras btn" style="width: 80px;height: 36px;border-radius: 13px;background: var(--prioridad-alta);"><i class="bi-arrow-left-circle"></i> </button>
        <button type="button" class="btn-adelante btn " style="width: 80px;height: 36px;border-radius: 13px;background: var(--prioridad-alta);" ><i class="bi-arrow-right-circle"></i> </button>
        `
        interfaz_elementos.btn_atras=interfaz.querySelectorAll(".btn-atras")[0]
        interfaz_elementos.btn_adelante=interfaz.querySelectorAll(".btn-adelante")[0]
        console.log(interfaz.querySelectorAll(".btn-adelante")[0])

        this.ocultar(interfaz_elementos.btn_atras)
        this.eventos()
    }
    this.ocultar=function ocultar(ele){
        ele.style.visibility="hidden"
    }
    this.mostrar=function mostrar(ele){
        ele.style.visibility="visible"
       // console.log(ele)
    }
    this.eventos = function eventos(){
        interfaz_elementos.btn_atras.addEventListener("click", function(){
            posicion--
            function_pasar(posicion, datos_pasar)
            instancia.retroceder(posicion)

        })
        interfaz_elementos.btn_adelante.addEventListener("click", function(){
            posicion++
            function_pasar(posicion, datos_pasar)
            instancia.avanzar(posicion)
          
           
        })
    }

    this.get_interfaz = function obtener_interfaz() {
        return interfaz
    }
    this.avanzar = function avanzar(posicion){
        if(posicion==1){
            instancia.mostrar(interfaz_elementos.btn_atras)
        }
        if(datos_pasar.lista_principales.length-1==posicion){
            instancia.ocultar(interfaz_elementos.btn_adelante)
        }
    }
    this.retroceder = function retroceder(posicion){
      //  console.log("lanzado", posicion)
        if(posicion==0){
            instancia.ocultar(interfaz_elementos.btn_atras)
        }
        if(datos_pasar.lista_principales.length-2==posicion){
            instancia.mostrar(interfaz_elementos.btn_adelante)
        }
    }

}