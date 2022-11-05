const alumno_lista = ({ No_control, Nombre, Id_carrera, Valor, Entradas }) => {
    let elemento_padre = document.createElement("div")
    let parte_animada = Valor == "Activo" ? `<div style="width: 60px; overflow: hidden">
         <img class="animacion_dentro" width="120px" src="public/icons/dentro_animacion.svg">
     </div>`: `<div style="width: 60px; overflow: hidden">
     <img class="" width="60px" src="public/icons/vacio.svg">
 </div>`
    elemento_padre.innerHTML = ` <div class="alumno-lista d-flex w-100 flex-column" style="">
    <div class="d-flex flex-row" style="height: 80%; gap: 14px">
        <div class="d-flex flex-row" style="width: 80%;border: 1px solid var(--color-decorativo);border-radius: 12px;">
            <div class="d-flex h-100 justify-content-center align-items-center" style="width: 20%;">
                ${parte_animada}
            </div>
            <div class="d-flex h-100 flex-column" style="width: 80%; ">
                <div class="d-flex h-50  align-items-center p-0 m-0 text-medio" style="min-height: 40px">
                    <b>${Nombre}</b>
                </div>
                <div class="d-flex h-50  flex-column" style="min-height: 50px">
                    <p class="text-bajo p-0 m-0" style="font-size: 10pt;">${No_control}</p>
                    <p class="text-bajo p-0 m-0" style="font-size: 10pt;">${Id_carrera}</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center" style="width: 20%; border: 1px solid var(--color-decorativo);border-radius: 12px;">
            <p class="text-bajo p-0 m-0" style="font-size: 10pt;">Número de entradas</p>
            <p class="p-0 m-0 text-bajo" style="font-size: 22pt">${Entradas}</p>
        </div>
    </div>
    <div class="d-flex" style="margin-left: 14px;">
        <p class="text-bajo" style="padding: 4px 14px 4px 14px;margin: 0px 14px 0px 14px;font-size: 10pt;max-height: 45px;border-radius: 0px 0px 12px 12px; background-color: ${Valor == 'Activo' ? '#CAFFE6' : (Valor == 'Sin entradas') ? 'red' : 'var(--color-decorativo)'}">${Valor}</p>
    </div>
</div>`
    elemento_padre = elemento_padre.children[0]
    return { principal: elemento_padre }
}