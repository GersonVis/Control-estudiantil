/*
Eventos despues de una exitosa insercion
*/
const div_ingresos = document.querySelector("#lista_ingresos")
const registro_exitoso = (json) => {
    elemento = crear_elemento(json)
   
    div_ingresos.appendChild(elemento)
   
}
const registro_exitoso_entrada = (json) => {
    elemento = crear_elemento(json)
    div_ingresos.appendChild(elemento)
   
}

/* */
const crear_elemento = ({ Id_acceso, Nombre, No_control, Id_lugar, Hora_entrada }) => {
    let elemento = document.createElement("div")
    let id="registro"+Id_acceso
    elemento.id=id
    elemento.classList.add("position-relative")
    elemento.classList.add("w-100")
    elemento.classList.add("dflex")
    elemento.classList.add("pt-1")
    elemento.classList.add("mb-3")
    elemento.style.minHeight = "95px"
    elemento.innerHTML = `<div class="w-100 h-25 d-flex">
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
    </div>
    <div class="botob-eliminar d-flex  w-25 h-100 justify-content-center align-items-center">
        <div onclick="accion_salida('${Id_acceso}', '${No_control}')" no-control="${No_control}" style="border-radius: 50% 50%; width: 30px; height: 30px" class="d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path fill="#A9A9A9" d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
            </svg>
        </div>
    </div>
</div>`

    return elemento
}

