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

        .list-group-item.active {
            background-color: red;
        }
        .list-group-item.active.opcion-tecla{
            background-color: blue;
        }
        .list-group-item.active div .opcion-tecla{
            background-color: yellow;
        }
        .list-group-item div .opcion-tecla{
            background-color: #6c757d;

        }
        .vibrar {
            animation-name: vibrar;
            animation-iteration-count: infinite;
            animation-duration: 0.5s;
            animation-direction: alternate-reverse;
            animation-timing-function: linear;
        }

        .bloqueado::after {
            position: absolute;
            content: "";
            width: 100%;
            height: 3px;
            border-radius: 12px;
            background-color: red;
            bottom: 0;
            animation-name: bloqueado;
            animation-iteration-count: 1;
            animation-duration: 3s;
            animation-timing-function: cubic-bezier(0.06, 0.69, 0.59, -0.01);
            animation-fill-mode: forwards;
        }

        @keyframes vibrar {
            from {
                transform: rotateZ(5deg);
            }

            to {
                transform: rotateZ(-5deg);
            }
        }

        @keyframes bloqueado {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }
    </style>
</head>

<body class="w-100 h-100">
    <?php
    $this->renderizar_menu($this->opcion);
    ?>
    <div class="d-flex container-fluid w-100 h-100" style="padding-top: 110px; overflow: hidden;">
        <div class="w-25 h-100 d-flex flex-column p-2" style="width: 20%;">
            <p class="font-weight-bold  text-left w-100" style="margin: 0px">Registros recientes</p>
            <hr class="my-2 bg-secondary" style="width: 200px">
            <div id="lista_ingresos" class="w-|00 flex-column h-100 redondear bg-white d-flex" style="overflow: auto">
                <?php
                // for ($c = 0; $c < 10; $c++) {
                //      Lista_registro();
                //   }
                ?>
            </div>
        </div>
        <div class="w-75 h-100 d-flex flex-column p-2" style="width: 20%;">
            <p class="font-weight-bold text-left w-100" style="margin: 0px">Registrar</p>
            <hr class="my-2 bg-secondary" style="width: 200px">
            <div class="w-100 color-principal sombra-secundaria rounded d-flex" style="height: 90%;min-width: 110%;background-image: url(public/imagenes/5291450.jpg);/* background-blend-mode: luminosity; */background-repeat: round;">
                <!-- <div class="w-100  d-flex" style="height: 90%;min-width: 110%;">-->
                <div class="d-flex w-100 h-100" style="overflow: hidden;">
                    <div class="w-25 h-100 d-flex flex-column p-2" style="width: 20%;">
                        <p class="font-weight-bold text-left w-100 mb-3" style="margin: 0px">Acción</p>

                        <div class="position-relative w-100 flex-column h-100 d-flex" style="overflow: auto">
                            <div class="list-group" id="list-tab" role="tablist">
                                <?php
                                foreach ($this->acciones as $key => $contenido) {
                                    $tecla = $contenido["tecla"];
                                    $array_acciones[$tecla] = array($contenido["accion"], $tecla);
                                    Opcion($array_acciones[$tecla][0], $tecla, "accion", "paccion");
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="w-25 h-100 d-flex flex-column p-2" style="width: 20%;">
                        <p class="font-weight-bold text-left w-100 mb-3" style="margin: 0px">Lugares</p>

                        <div class="w-100 flex-column h-100 d-flex" id="cpLugares" style="overflow: auto">
                            <div class="list-group" id="list-tab" role="tablist">
                                <?php
                                foreach ($this->lugares as $key => $contenido) {
                                    $tecla = $contenido["tecla"];
                                    $array_lugares[$tecla] = array($contenido["lugar"], $tecla);
                                    Opcion($array_lugares[$tecla][0], $tecla, "lugar", "plugar");
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="w-25 h-100 d-flex flex-column p-2" style="width: 20%;">
                        <div class="w-|00 flex-column h-100 d-flex" style="overflow: auto">
                            <p class="texto-label text-secondary m-0">Para activar la selección rápida oprime Ctrl+E</p>
                            <div class="d-flex ">
                                <div class="bg-decorativo rounded ml-1 pl-1 d-flex justify-content-start align-items-start" style="width: 30px; height: 30px">
                                    <p class="texto-label m-0 text-white">Ctrl</p>
                                </div>
                                <p class="texto-label text-secondary m-2">+</p>
                                <div class="bg-decorativo pl-1 rounded d-flex justify-content-start align-items-start" style="width: 30px; height: 30px">
                                    <p class="texto-label m-0 text-white">E</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sombra-principal flex-column pb-2 redondear position-absolute bg-white container align-items-center d-flex" style="width: 250px; height: 375px; right: 200px; bottom: 0px; border-radius: 22px 22px 0 0; display: flex; justify-content: end;">
            <form id="forma" class="row g-3 needs-validation w-100" onsubmit="return false;" novalidate>
                <div class="w-100 d-flex justify-content-center align-items-start flex-grow-1">
                    <img class="" src="public/ilustraciones/registrando.png" style="width: 170px; transform: translatey(-2  0%)" />
                </div>
                <div class="form-group mb-2 w-100">
                    <label class="m-0 label-inputs text-secondary" name="noControl" for="validationCustom01">No. Control</label>
                    <div class="w-100 position-relative">
                        <input type="text" value="12345678" autocomplete="off" minlength="8" maxlength="8" size="8" name="noControl" class="form-control texto-label alto-seleccionable" id="validationCustom02" value="" required>
                        <div id="mostrar_digitos" class=" texto-label position-absolute m-0" style="
    width: auto;
    font-size: 8pt;
    top: 0;
    transform: translateY(-100%);
    right: 0;
">
                            8 Dígitos restantes
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2 w-100">
                    <label class="m-0 label-inputs text-secondary" for="validationCustom03">Nombre</label>
                    <div class="w-100 position-relative">
                        <input type="text" minlength="3" value="gerson visoso ocampo" maxlength="32" name="nombre" size="32" class="form-control texto-label alto-seleccionable" id="validationCustom03" value="" required>
                        <div id="mostrar_digitos" class=" texto-label position-absolute m-0" style="
    width: auto;
    font-size: 8pt;
    top: 0;
    transform: translateY(-100%);
    right: 0;
">
                            Introduce minímo 3 letras
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2 w-100">
                    <label class="m-0 label-inputs text-secondary" for="validationCustom03">Carrera</label>
                    <input value="Ingeniería en sistemas" type="text" name="carrera" class="form-control texto-label alto-seleccionable" id="validationCustom04" value="" required>
                </div>
                <button id="enviar" class="btn btn-primary w-100 m-0 p-0 alto-seleccionable texto-label" style="color: white; min-height: 40px">REGISTRAR ACCESO</button>
            </form>
        </div>
</body>
<script>
    combinar_indices_elementos = (indices, prefijo) => {
        let elementos = {}
        indices.forEach(indice => {
            elementos[indice] = document.getElementById(prefijo + indice)
        })
        return elementos
    }
    pintar_tecla_seleccionada = (elemento) => {
        remover_clase(elemento, "bg-secondary")
        aplicar_clase(elemento, "bg-primary")

    }
    aplicar_funcion_a_elementos = (elementos, funcion_aplicar) => {
        elementos.forEach(elemento => {
            funcion_aplicar(elemento)
        })
    }
    mostrar_seleccionable = () => {
        let opciones = document.querySelectorAll(".opcion-tecla")
        opciones.forEach(elemento => {
            elemento.classList.remove("bg-secondary")
            elemento.style.backgroundColor = "black"
            aplicar_clase(elemento, "vibrar")
            aplicar_clase(elemento, "shadow")
        })
        cpLugares.style.visibility = "visible"
    }
    mostrar_normal = (elemento) => {
        aplicar_clase(elemento, "bg-secondary")
        remover_clase(elemento, "vibrar")
        remover_clase(elemento, "shadow")
        remover_clase(elemento, "bg-primary")
    }
    aplicar_clase = (elemento, clase) => {
        elemento.classList.add(clase)
    }
    remover_clase = (elemento, clase) => {
        elemento.classList.remove(clase)
    }
    var form_opciones = ["", ""]
    var logica_seleccion = (letra_local) => {

        elemento_seleccionado = referencias[contador][letra_local]
        opcion_seleccionada = opciones[contador][letra_local]
        if (elemento_seleccionado) {
            form_opciones[contador] = opciones[contador][letra_local]
            aplicar_funcion_a_elementos(Object.values(referencias[contador]), mostrar_normal)
            pintar_tecla_seleccionada(elemento_seleccionado)
            //hacer una determinada acción por la posicion del contador
            acciones_por_contador[contador](letra_local)
            //si la opcion seleccionada es la salida ejecutamos la función
            if (opcion_seleccionada[2]) {
                opcion_seleccionada[2]()
            }
            //desactivar cuando ya se han pulsado dos teclas
            if (++contador > 1) {
                contador = 0
                seleccionando = false
            }
        }
    }


    var acciones = <?php echo json_encode($array_acciones, JSON_UNESCAPED_UNICODE); ?>;
    var lugares = <?php echo json_encode($array_lugares, JSON_UNESCAPED_UNICODE); ?>;

    let acciones_valores = Object.values(acciones)

    var acciones_por_contador = [(valor) => {
        accion_seleccionada = valor
    }, (valor) => {
        lugar_seleccionado = valor
    }]


    var contador = 0
    var seleccionando = false
    var restaurar = () => {
        cpLugares.style.visibility = "visible"
    }
    acciones_valores.forEach(elemento => {
        if (elemento[0] == "Salida") {
            elemento.push(function() {
                cpLugares.style.visibility = "hidden"
                contador = 2
                seleccionando = false
            })
            return
        }
        elemento.push(restaurar)
    })

    var opciones = [acciones, lugares]

    // creamos referencias entre los elementos visuales y los ids de teclas
    var teclas_accion = combinar_indices_elementos(Object.keys(acciones), "accion")
    var teclas_lugares = combinar_indices_elementos(Object.keys(lugares), "lugar")


    var referencias = [teclas_accion, teclas_lugares]


    var accion_seleccionada
    var lugar_seleccionado

    // escogemos la primera opción de las opciones

    window.onload = (ev) => {
        document.addEventListener("keydown", e => {
            let letra = String.fromCharCode(e.which)
            if (!seleccionando) {
                if (e.ctrlKey && e.which == 69) {
                    e.stopPropagation()
                    e.preventDefault()

                    aplicar_funcion_a_elementos(Object.values(referencias[0]), mostrar_normal)
                    aplicar_funcion_a_elementos(Object.values(referencias[1]), mostrar_normal)

                    mostrar_seleccionable()
                    seleccionando = true
                }
                return
            }
            logica_seleccion(letra)
        })
    }

    var accion_seleccionada = Object.values(acciones)[0][1]
    var lugar_seleccionado = Object.values(lugares)[0][1]
    logica_seleccion(accion_seleccionada)
    logica_seleccion(lugar_seleccionado)
</script>

<script>
    //bootstrap
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {

                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<script src="public/js/Registro/Remocion.js"></script>
<script src="public/js/Registro/Insercion.js"></script>
<script src="public/js/Registro/formulario.js"></script>
<script src="public/js/Registro/Registros recientes.js"></script>
<script src="public/js/Registro/Registros base.js"></script>

</html>