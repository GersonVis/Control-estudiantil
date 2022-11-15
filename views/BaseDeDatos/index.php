<?php
//importación componentes
include_once "views/Componentes/Lista_registro.php";
include_once "views/Componentes/Opcion.php";
//variables
$array_acciones = array();
$array_lugares = array();
$tecla = "";
?>
<!DOCTYPE html>
<html lang="en" style="height: 100vh;">

<head>
    <?php
    $this->importaciones_globales();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->_nombre; ?></title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>

<body class="w-100 h-100">
    <?php
    $this->renderizar_menu($this->opcion);
    ?>
    <div class="d-flex justify-content-center align-items-center" id="scroll_global" style="overflow: auto; height: var(--alto-global)">

        <div class="w-75 d-flex flex-column position-relative" style="height: 80%; border-radius: 13px; border: 1px solid var(--color-decorativo)">
            <div class="d-flex" style="width: 40px; height: 40px; position: absolute; top: 14px; right: 8px;">
                <i class="bi-x-lg"></i>
            </div>

            <div class="d-flex" style="height: 80%; ">

                <div class="d-flex flex-column w-50 h-100">
                    <div class="d-flex align-items-end" style="padding-left: 24px; padding-top: 14px;  color: var(--color-prioridad-baja-baja)">
                        <p class="m-0 p-0">Estas consultando:</p>
                    </div>
                    <div class="d-flex flex-row justify-content-center" style="height: 80%; padding-top: 14px;">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="d-flex flex-row align-items-center" style="width: 45%; height: 80%">
                                <div style="width: 10px;height: 60px;background-color: var(--principal-color);border-radius: 13px;"></div>
                                <img style="width: 80%" src="public/ilustraciones/entradas.png">
                            </div>
                            <b style="width: 50px; font-size: 10pt; color: var(--color-prioridad-baja-baja)">Entradas</b>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column w-50 h-100">
                    <div class="d-flex w-100 flex-column" style="">
                        <div id="contenedor-steeps" class="d-flex flex-row justify-content-center align-items-center" style="padding-top: 14px;">

                        </div>

                        <div style="margin-top: 14px;">
                            <b id="subtitulo-entradas" class="m-0 p-0" style="color: var(--color-baja-baja)">Cada registro debe contener: </b>
                        </div>
                    </div>
                    <div id="padre-opciones-entradas" style="height: 80%; flex-grow: 1; overflow:auto">

                    </div>

                    <div id="avance-contener" class="pr-2 d-flex w-100 justify-content-center" style="height: 20%">
                    </div>
                </div>
            </div>
            <div class="d-flex" style="margin-left: 24px; height: 20%;">
                <div class="d-flex flex-column flex-column">
                    <div class="d-flex flex-row">
                        <button id="entradas_descargar_csv" type="button" style="width: 200px; border-radius: 13px; overflow: hidden" class="position-relative mr-1 btn btn-primary">DESCARGAR CSV</button>

                    </div>
                    <p style="margin-top: 8px; color: var(--color-prioridad-baja-baja)">La consulta contiene <b id="numero-regsitros" style="color: black">0</b> registros <button id="entradas-eliminacion" type="button" style="visibility: hidden; font-size: 10pt; width: 200px; border-radius: 13px" class="ml-1 btn btn-light">APLICAR ELIMINACIÓN</button></p>
                </div>
            </div>
        </div>
    </div>
    <div id="formularios-dimanimicos"></div>
    <div class="modal fade" id="modal-msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-msg">Aviso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-cancelar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="modal-aplicar" class="btn">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="public/node_modules/chart/package/dist/chart.js"></script>
<script src="public/js/Compartido/Enviar_formulario.js"></script>
<script src="public/js/Compartido/Funciones_publicas.js"></script>
<script src="public/js/BaseDeDatos/Variables.js"></script>
<script src="public/js/BaseDeDatos/Opcion.js"></script>
<script src="public/js/BaseDeDatos/Steeps.js"></script>
<script src="public/js/BaseDeDatos/Avance.js"></script>
<script src="public/js/BaseDeDatos/ContenedorPartes.js"></script>
<script src="public/js/BaseDeDatos/Interfaz_dinamica.js"></script>
<script>
    var json_entradas = [columnas_datos, condicionales_datos, lugares_datos, carreras_datos]
    var respuesta_csv
    var formulario
    var datos_entradas_csv
    entradas_csv.addEventListener("click", function(evt) {
        datos_entradas_csv = cargar_datos_formulario(json_entradas)
        hacer_eliminacion.style.visibility = "hidden"
        evt.target.disabled = true
        animacion_carga(evt.target)
        enviar_formulario("entrada/archivoConsulta", datos_entradas_csv).
        then(respuesta => {
            carga_terminada(evt.target)
            evt.target.disabled = false
            respuesta_csv = respuesta
            let numero_registros = respuesta.registros_afectados
            cuantos_registros.innerText = numero_registros
            if (respuesta.respuesta && numero_registros > 0) {
                hacer_eliminacion.style.visibility = "visible";
                let form = crear_elemento({
                    tipo: "div"
                })
                form.innerHTML = `<form action="entrada/descargarArchivo/" method="POST">
                <input type="hidden" name="nombre" value="${respuesta.contenido[0].Nombre}"/>
              </form>`
                form = form.childNodes[0]
                formulario_dinamicos.appendChild(form)
                form.submit()
                formulario_dinamicos.innerHTM = ""
                return
            }
            mensaje_informatico({
                aceptar: {
                    letras: "white",
                    evento: function() {
                        $("#modal-msg").modal("hide")
                    }
                },
                msg: "No hay resultados para la consulta"
            })

        })
    })

    function cargar_datos_formulario(info_formulario) {
        let datos_formulario = {}
        info_formulario.forEach(contenedor => {
            examinar_selecciones(contenedor, datos_formulario)
        })
        let reformado = {}
        Object.entries(datos_formulario).forEach(
            ([key, contenido]) => {
                reformado[key] = JSON.stringify(contenido)
            }
        )
        return reformado
    }

    hacer_eliminacion.addEventListener("click", function() {
        mensaje_informatico({
            titulo: "Eliminación",
            aceptar: {
                texto: "Eliminar",
                color: "#dc3545",
                letras: "white",
                evento: function() {
                    enviar_formulario("entrada/eliminarConsulta", datos_entradas_csv)
                        .then(json => {
                            console.log(json)
                            if (json.respuesta) {
                                cuantos_registros.innerText=0
                                hacer_eliminacion.style.visibility="hidden"
                                mensaje_informatico({
                                    titulo: "Tarea completada",
                                    msg: "Eliminaste correctamente los registros",
                                    aceptar: {
                                        letras:"white",
                                        evento: function() {
                                            $("#modal-msg").modal("hide")
                                        }
                                    }
                                })
                                return
                            }
                            mensaje_informatico({
                                titulo: "Tarea incompleta",
                                msg: "Inténtalo más tarde"
                            })
                        })
                }
            },
            msg: "Ten cuidado eliminarás " + cuantos_registros.innerText + " registros de la base de datos"
        })
    })
</script>

</html>