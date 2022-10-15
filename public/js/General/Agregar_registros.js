const agregar_registros = (contenedor, registros) => {
    
    registros.forEach(registro => {
        let contenedor_creado=contenedor_registro(registro)
        contenedor.appendChild(contenedor_creado)
    });
}
const contenedor_registro = ({ id_entrada, no_control, nombre, hora_entrada, hora_salida }) => {
    let registro = document.createElement("tr")
    registro.innerHTML=`
    <td width="4%">${id_entrada}</td>
    <td width="38%">${nombre}</td>
    <td width="20%">${no_control}</td>
    <td width="20%">${hora_entrada}</td>
    <td width="20%">${hora_salida}</td>`
    return registro
}