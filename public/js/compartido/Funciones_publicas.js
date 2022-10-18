const obtener_fecha=()=>{
    const hoy = new Date();
    const fecha_hoy = hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, "0") + "-" + String(hoy.getDate()).padStart(2, "0")
    return fecha_hoy
}