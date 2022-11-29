/*
VALIDACIONES Y ANIMACIONES DEL FORMULARIO
*/
//botón que envía el formulariov

function teclado_bloquear(e) {
    e.stopPropagation()
    e.preventDefault()
    return
}
function desactivar_teclado() {
    document.addEventListener("keydown", teclado_bloquear, true)
}
function activar_teclado() {
    document.removeEventListener("keydown", teclado_bloquear, true)
}


const btn_enviar = document.querySelector("#enviar")
const formulario = document.querySelector("#forma")
const numero_validaciones = 4
const lista_lugares = document.querySelector("#list-lugares")
const lista_accciones = document.querySelector("#list-acciones")
var personas_registradas = {}

var bloqueos = {}

var tiempo_bloqueo = 3000
var valor_anterior = ""
var prueba
var largo_no_control = 8
var nombre
var no_control
var lugar
var accion_por_opcion = {
    "Entrada": () => {
        let formdata = new FormData()
        let lugar = seleccion_opciones[1]
        let no_control = validationCustom02.value
        let nombre = validationCustom03.value
        let carrera = validationCustom04.value
        formdata.append("lugar", lugar)
        formdata.append("no_control", no_control)
        formdata.append("carrera", carrera)
        formdata.append("nombre", nombre)
        //formdata.append("lugar", lugar)
        enviar_formulario_entrada(formdata)
        return
    },
    "Automático": () => {
        // si no esta en la lista se puede registrar
        let no_control = validationCustom02.value
        let persona = bloqueos[no_control] ?? { disponible: true }
        console.log(no_control)

        if (lista_lugares.querySelectorAll(".active").length == 1) {
           
            nombre = validationCustom03.value
            lugar = seleccion_opciones[1]
            let elemento_estatus = agregar_log({ No_control: no_control, Nombre: nombre })
            if (persona.disponible) {
                bloqueos[no_control] = { disponible: false }
                let formdata = new FormData(forma)
                formdata.append("lugar", lugar)
                let no_control_dentro = no_control.toString()
                enviar_formulario(formdata, no_control_dentro, elemento_estatus)
                return
            }
            actualizar_log(elemento_estatus, `<div id="" class="position-relative w-100 d-flex pt-1" style="min-height: 95px;flex-direction: column;align-items: center;">
            <div class="w-100 font-weight-bold texto-label " style="width: 60%;justify-content: center;align-items: center;">${nombre}</div>
            <div class="w-100  texto-label " style="width: 60%;justify-content: center;align-items: center;">${no_control}</div>
            <div class="w-100 d-flex flex-column justify-content-center align-items-center">
                <b>El número de control esta bloqueado</b>
                
            </div>
        </div>`)
            // mostrar_informacion("Espera", "El número de control esta bloqueado por 3 segundos")
            return
        }
        mostrar_informacion("Sin lugar seleccionado", "No has seleccionado ningún lugar todavía, da click sobre alguna de las opciones de la lista de lugares")
    },
    "Salida": () => {
        let persona = personas_registradas[no_control] ?? { disponible: true }
        let elemento_estatus = agregar_log({ No_control: no_control, Nombre: nombre })
        if (persona.disponible) {
            let no_control_pasar
            let formdata = new FormData(forma)
            nombre = validationCustom03.value
            no_control = validationCustom02.value
            no_control_pasar = no_control.toString()
            enviar_formulario_salida(formdata, no_control_pasar, elemento_estatus)
            return
        }

    }
}
//que hacer dependiendo de la respuesta del envio del formulario
const consecuencias = {
    "creacion": (json) => {
        personas_registradas[json.No_control] = json
        //mostrar_informacion("Registro", "Se realizo el registro correctamente")

        msg_registro_exitoso({

            fondo_color: "#6feddc6b",
            spin_color: "#007b67",
            img: "public/ilustraciones/3891942.png",
            contenido_html: `
                <div class="d-flex flex-column w-100 justify-content-end align-items-center" style="height: 40%">
                    <p class="m-0 p-0" style="font-size: 24pt">Se registró</p>
                    <b class="m-0 p-0" style="color: #00dbbe; letter-spacing: 10px; font-size: 34pt;padding-bottom: 50px;transform: translateY(-14px);">Entrada</b>
                </div>
                <div class="d-flex flex-column w-100 justify-content-end align-items-center" style="height: 20%">
                    <p class="m-0 p-0">Disfruta de nuestras instalaciones</p>
                    <b class="m-0 p-0" style="padding-bottom: 44px;">${json.Nombre}</b>
                </div>
               
        `})

        actualizar_log(json.elemento_estatus, `<div id="" class="position-relative w-100 d-flex pt-1 p-3" style="background-color: #c2f0e6; min-height: 95px;flex-direction: column;align-items: center;">
            <div class="w-100 font-weight-bold texto-label " style="width: 60%;justify-content: center;align-items: center;">${json.Nombre}</div>
            <div class="w-100  texto-label " style="width: 60%;justify-content: center;align-items: center;">${json.No_control}</div>
             <div class="w-100 d-flex flex-column justify-content-center align-items-center">
                <b>Se registro entrada</b>   
               </div>
            </div>`)

        registro_exitoso(json)

    },//funcion en el archivo inserción
    "actualizacion": ({ Id_acceso, No_control, Nombre, elemento_estatus }) => {
        // mostrar_informacion("Salida", "Se registro salida para el Número de control " + No_control)
      /*  msg_registro_exitoso({
            fondo_color: "#93a264ab",
            spin_color: "#d56977",
            img: "public/ilustraciones/6431139.png",
            contenido_html: `
                <div class="d-flex flex-column w-100 justify-content-end align-items-center" style="height: 40%">
                     <p class="m-0 p-0" style="font-size: 24pt">Se registró</p>
                     <b class="m-0 p-0" style="color: #6779d0; letter-spacing: 10px; font-size: 34pt;padding-bottom: 50px;transform: translateY(-14px);">Salida</b>
                </div>
                <div class="d-flex flex-column w-100 justify-content-end align-items-center" style="height: 20%">
                     <p class="m-0 p-0">Regresa pronto!</p>
                     <b class="m-0 p-0" style="padding-bottom: 44px;">${Nombre}</b>
                </div>
         `})*/
         actualizar_log(elemento_estatus, `<div id="" class="position-relative w-100 d-flex pt-1 p-3" style="background-color: #fcce47; min-height: 95px;flex-direction: column;align-items: center;">
         <div class="w-100 font-weight-bold texto-label " style="width: 60%;justify-content: center;align-items: center;">${Nombre}</div>
         <div class="w-100  texto-label " style="width: 60%;justify-content: center;align-items: center;">${No_control}</div>
          <div class="w-100 d-flex flex-column justify-content-center align-items-center">
             <b>Se registro salida</b>   
            </div>
         </div>`)
        remover_de_padre("registro" + Id_acceso)
        delete personas_registradas[No_control]

    }
}

// variable del formulario


btn_enviar.addEventListener("click", function () {
    // if (formulario.querySelectorAll(":invalid").length == 0) {
    //   if (lista_accciones.querySelectorAll(".active").length == 1) {
    accion_por_opcion[seleccion_opciones[0]]()
    //    btn_enviar.disabled=true
    validationCustom02.focus()
    /*    reiniciar_label()
        setTimeout(function(){
            btn_enviar.disabled=false
        },
        2000)
        return
    }
    mostrar_informacion("Sin acción seleccionada", "No has seleccionado ningúna acción todavía, da click sobre alguna de las acciones de la lista de acciones")
}*/
})


const agregar_log = ({ Id_acceso, Nombre, No_control, Id_lugar, Hora_entrada, msg }) => {
    let elemento = document.createElement("div")
    //let id = "registro" + Id_acceso
    // elemento.id = id
    elemento.classList.add("position-relative")
    elemento.classList.add("w-100")
    elemento.classList.add("d-flex")
    elemento.classList.add("pt-1")
    elemento.classList.add("mb-1")
    elemento.style.minHeight = "95px"
    elemento.innerHTML = `<div id="" class="position-relative w-100 redondear d-flex pt-1 " style="min-height: 95px;flex-direction: column;align-items: center;">
    <div class="w-100 font-weight-bold texto-label " style="width: 60%;justify-content: center;align-items: center;">${Nombre}</div>
    <div class="w-100  texto-label " style="width: 60%;justify-content: center;align-items: center;">${No_control}</div>
    <div class="w-100 d-flex flex-column justify-content-center align-items-center">
        <div class="spinner-border" role="status" style="">
            <span class="sr-only">Loading...</span>
        </div>
        <small class="m-3">Espera...</small>
    </div>
</div>`

    /*`<div class="w-100 h-25 d-flex">
    <div class="h-100 font-weight-bold texto-label " style="width: 60%;">${Nombre}</div>
    <div class="h-100 texto-label text-secondary" style="width: 20%">${Hora_entrada}</div>
    <div class="h-100 d-flex flex-center justify-content-center align-items-center" style="width: 20%">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" fill="#DADADA" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>
    </div>
</div>
<div class="w-100 h-75 d-flex ">
    <div class="d-flex h-100 w-75 flex-column justify-content-center">
        <p class="texto-label text-secondary m-0">${No_control}</p>
        <p class="texto-label  text-secondary m-0">${Id_lugar}</p>
        <b class="texto-label  text-secondary m-0">${msg}</b>
    </div>
    
</div>`*/
    let zero = lista_logs.childNodes[0]
    if (zero) {
        lista_logs.insertBefore(elemento, zero)
        return elemento
    }
    lista_logs.appendChild(elemento, 0)
    return elemento
}
function actualizar_log(log_item, contenido) {
    log_item.innerHTML = contenido
}



validationCustom02.addEventListener("keypress", impedir_letras)
validationCustom02.addEventListener("input", regla_numeros)
function regla_numeros(evt) {
    let largo = $('#validationCustom02').val().length

    $("#mostrar_digitos").text((largo_no_control - (largo)) + " Dígitos restantes")

}
function impedir_letras(evt) {
    var charCode = evt.charCode;
    if (charCode != 0) {
        var numero = String.fromCharCode(charCode)
        if (!$.isNumeric(numero)) {
            evt.preventDefault();
            // $("#mostrar_digitos").text("Solo números")
        }
    }
}
var prueba = ""
const enviar_formulario = (formdata, no_control_dentro, elemento_estatus) => {
    // mostrar_informacion("Formulario enviado", "Se esta realizando la petición")
    fetch("Entrada/entradaAumatica", {
        method: "POST",
        body: formdata
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            console.log(json)
            prueba = json
            if (json.respuesta) {



                registro = json.contenido[0]

                // no_disponible(no_control)
                bloqueos[no_control_dentro]["disponible"] = false
                // agregamos una nueva linea de codigo

                bloquear_por_tiempo(no_control_dentro, tiempo_bloqueo)
                registro["elemento_estatus"] = elemento_estatus
                consecuencias[json.tipo_consulta](registro)




            } else {
                mostrar_informacion("Error en la acción", json.codigo)
                bloqueos[no_control] = { disponible: true }
            }
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
            bloqueos[no_control] = { disponible: true }
            // bloqueos[no_control].disponible=true
        })
    return false
}
var formmm
const enviar_formulario_entrada = (formdata) => {
    formmm=formdata
    let nombre = validationCustom03.value
    let no_control = validationCustom02.value
    let elemento_estatus = agregar_log({ No_control: no_control, Nombre: nombre })
    fetch("Entrada/registrarEntrada", {
        method: "POST",
        body: formdata
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            console.log(json)
            if (json.respuesta) {

                /*  prueba = json
                  registro = json.contenido[0]
                  //agrega el registro a la lista pero sin animacion de bloqueo
                  registro_exitoso_entrada(registro)
                  agregar_registro(json)
                 // no_disponible(no_control)*/
                registro = json.contenido[0]
                registro["elemento_estatus"]=elemento_estatus
                // no_disponible(no_control)
                bloqueos[no_control]=bloqueos[no_control]??{}
                bloqueos[no_control]["disponible"] = true


                //  bloquear_por_tiempo(no_control, tiempo_bloqueo)

                consecuencias[json.tipo_consulta](registro)

                return
            }
            actualizar_log(elemento_estatus, `<div id="" class="position-relative w-100 d-flex pt-1 p-3" style="background-color: #fbc9c9; min-height: 95px;flex-direction: column;align-items: center;">
         <div class="w-100 font-weight-bold texto-label " style="width: 60%;justify-content: center;align-items: center;">${nombre}</div>
         <div class="w-100  texto-label " style="width: 60%;justify-content: center;align-items: center;">${no_control}</div>
          <div class="w-100 d-flex flex-column justify-content-center align-items-center">
             <b>${json.codigo}</b>   
            </div>
         </div>`)
         //   mostrar_informacion("Error en la acción", json.codigo)
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
        })
}
const enviar_formulario_salida = (formdata, no_control_dentro, elemento_estatus) => {
    let formulario = new FormData()
    formulario.append("No_control")
    fetch("Entrada/registrarSalida", {
        method: "POST",
        body: formulario
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            console.log(json)
            if (json.respuesta) {
                if (json.registros_afectados != 0) {
                    registro = json.contenido[0]
                    personas_registradas[no_control_dentro]["elemento_estatus"]=elemento_estatus
                    consecuencias[json.tipo_consulta](personas_registradas[no_control_dentro])

                    // mostrar_informacion("Salida", json.codigo)
                    return
                }
                mostrar_informacion("Salida", "El usuario no se encontró dentro de ningún lugar")
                return
            }
            mostrar_informacion("Error", json.codigo)
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
        })
}

const accion_salida = (Id_acceso, no_control_dentro) => {
  
    console.log(Id_acceso)
    console.log(no_control_dentro)
    let formdata = new FormData()
    //mostrar_informacion("Registrar salida", "Registraras salida para esta persona")
    formdata.append("No_control", no_control_dentro)
    formdata.append("Id_acceso", Id_acceso)
    let elemento_estatus = agregar_log({ No_control: no_control, Nombre: nombre })
    fetch("Entrada/registrarSalida", {
        method: "POST",
        body: formdata
    })
        .then(respuesta => respuesta.json())
        .then(json => {
            console.log(json)
            if (json.respuesta) {
                if (json.registros_afectados != 0) {
                    registro = json.contenido[0]
                    personas_registradas[no_control_dentro]["elemento_estatus"]=elemento_estatus
                    consecuencias[json.tipo_consulta](personas_registradas[no_control_dentro])

                    //mostrar_informacion("Salida", json.codigo)
                    return
                }
                mostrar_informacion("Salida", "El usuario no se encontró dentro de ningún lugar")
                return
            }
            mostrar_informacion("Error", json.codigo)
        })
        .catch(er => {
            console.error("ocurrio un error en la solicitud")
            console.error(er)
        })
}
const remover_padre = () => {

}


const disponibilidad = (no_control) => {
    personas_registradas[no_control].disponible = true
}
const no_disponible = (no_control) => {
    personas_registradas[no_control].disponible = false
}


const bloquear_por_tiempo = (no_control_a, tiempo) => {
    setTimeout(() => {
        bloqueos[no_control_a] = { disponible: true }
    }, tiempo)
}


const agregar_registro = (json) => {
    personas_registradas[json.no_control] = json
}

