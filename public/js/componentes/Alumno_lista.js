const alumno_lista = ({ No_control, Nombre }) => {
    let elemento_padre = document.createElement("div")
    elemento_padre.innerHTML = `
    <div class="w-100 d-flex flex-row" style="height: 70px">
    <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>
    </div>
    <div class="h-100 d-flex flex-column" style="flex-grow: 1">
        <div class="h-50 d-flex align-items-end">
            <b class="p-0 m-0 text-medio">${Nombre}</b>
        </div>
        <div class="h-50">
            <p class="text-bajo p-0 m-0">${No_control}</p>
        </div>
    </div>
    <div class="h-100">
        <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
            <i class="bi-arrow-up-right-circle"></i>
        </div>
    </div>
   </div>`
    return {principal: elemento_padre}
}