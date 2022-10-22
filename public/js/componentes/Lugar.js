const lugar = ({ nombre_lugar}) => {
    let elemento_padre = document.createElement("div")
    elemento_padre.style.minWidth="110px"
    elemento_padre.style.widows="110px"
    elemento_padre.classList.add("h-100")
    elemento_padre.classList.add("d-flex")
    elemento_padre.classList.add("flex-column")
    elemento_padre.innerHTML = `<div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
        <p class="text-secondary" style="font-size: 40pt;">G</p>
        <div class="position-absolute d-flex justify-content-center align-items-center" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
            <i class="bi-arrow-up-right-circle"></i>
        </div>
    </div>
    <div class="w-100" style="height: 25%;">
        <p align="center" class="m-0 p-0 text-secondary">${nombre_lugar}</p>
    </div>`
    return { principal: elemento_padre }
}