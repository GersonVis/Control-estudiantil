const agregar_registros = (contenedor, registros) => {
    
    registros.forEach(registro => {
        let contenedor_creado=contenedor_registro(registro)
        contenedor.appendChild(contenedor_creado)
    });
}
const contenedor_registro = ({ Id_acceso, No_control, Nombre, Hora_entrada, Hora_salida }) => {
    let registro = document.createElement("tr")
    registro.innerHTML=`
    <td width="4%">${Id_acceso}</td>
    <td width="38%">${Nombre}</td>
    <td width="20%">${No_control}</td>
    <td width="20%">${Hora_entrada}</td>
    <td width="20%">${Hora_salida?Hora_salida:""}</td>`
    return registro
}