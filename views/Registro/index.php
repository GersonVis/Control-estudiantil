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

        .list-group-item {
            transition-property: min-height, background-color;
            transition-duration: 1s, 2s;

        }

        .list-group-item.active {
            background-color: var(--principal-color);
            min-height: 130px !important;
        }

        .list-group-item::after {
            content: "";

            position: absolute;
            bottom: 0;

            background-image: url("public/ilustraciones/registrando.png");
        }

        .list-group-item.active div .opcion-tecla {
            background-color: white;
        }

        .list-group-item div .opcion-tecla p {
            color: white;
        }

        .list-group-item.active .ptitulo p {
            color: black;
        }

        .list-group-item.active div .opcion-tecla p {
            color: black;
        }

        .list-group-item div .opcion-tecla {
            background-color: #6c757d;
        }

        .vibrar {
            animation-name: vibrar;
            animation-iteration-count: infinite;
            animation-duration: 0.5s;
            animation-direction: alternate-reverse;
            animation-timing-function: linear;
            background-color: #0062cc;
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
                background-color: #007bff;
            }

            to {
                transform: rotateZ(-5deg);
                background-color: #007bff;
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

        .bolita {
            position: absolute;
        }

        .bolita.entrada {
            animation-name: bolitaMoverA, ocultamiento;

            animation-duration: 1s, 2s;
            animation-timing-function: linear, steps(2, end);
            /*cubic-bezier(0.3, 0, 0.7, 1);*/
            animation-iteration-count: infinite, infinite;
            animation-direction: alternate-reverse, normal;

            left: 0px;
        }

        .bolitaa {
            animation-delay: 0.00s;
        }

        .bolitab {
            animation-delay: 0.25s;
        }

        .bolitac {
            animation-delay: 0.50s;
        }

        .bolitad {
            animation-delay: 0.75s;
        }

        .bolitae {
            animation-delay: 1.00s;
        }

        .bolitaf {
            animation-delay: 1.25s;
        }

        .bolitag {
            animation-delay: 1.50s;
        }

        .bolitah {
            animation-delay: 1.75s;
        }








        #contenedor-bolita-b .bolitaa {
            animation-delay: 0.05s;
        }

        #contenedor-bolita-b .bolitab {
            animation-delay: 0.30s;
        }

        #contenedor-bolita-b .bolitac {
            animation-delay: 0.55s;
        }

        #contenedor-bolita-b .bolitad {
            animation-delay: 0.80s;
        }

        #contenedor-bolita-b .bolitae {
            animation-delay: 1.05s;
        }

        #contenedor-bolita-b .bolitaf {
            animation-delay: 1.30s;
        }

        #contenedor-bolita-b .bolitag {
            animation-delay: 1.55s;
        }

        #contenedor-bolita-b .bolitah {
            animation-delay: 1.80s;
        }



        #contenedor-bolita-c .bolitaa {
            animation-delay: 0.10s;
        }

        #contenedor-bolita-c .bolitab {
            animation-delay: 0.35s;
        }

        #contenedor-bolita-c .bolitac {
            animation-delay: 0.60s;
        }

        #contenedor-bolita-c .bolitad {
            animation-delay: 0.85s;
        }

        #contenedor-bolita-c .bolitae {
            animation-delay: 1.10s;
        }

        #contenedor-bolita-c .bolitaf {
            animation-delay: 1.35s;
        }

        #contenedor-bolita-c .bolitag {
            animation-delay: 1.60s;
        }

        #contenedor-bolita-c .bolitah {
            animation-delay: 1.85s;
        }


        #contenedor-bolita-d .bolitaa {
            animation-delay: 0.15s;
        }

        #contenedor-bolita-d .bolitab {
            animation-delay: 0.40s;
        }

        #contenedor-bolita-d .bolitac {
            animation-delay: 0.65s;
        }

        #contenedor-bolita-d .bolitad {
            animation-delay: 0.90s;
        }

        #contenedor-bolita-d .bolitae {
            animation-delay: 1.15s;
        }

        #contenedor-bolita-d .bolitaf {
            animation-delay: 1.40s;
        }

        #contenedor-bolita-d .bolitag {
            animation-delay: 1.65s;
        }

        #contenedor-bolita-d .bolitah {
            animation-delay: 1.90s;
        }





        #contenedor-bolita-e .bolitaa {
            animation-delay: 0.20s;
        }

        #contenedor-bolita-e .bolitab {
            animation-delay: 0.45s;
        }

        #contenedor-bolita-e .bolitac {
            animation-delay: 0.70s;
        }

        #contenedor-bolita-e .bolitad {
            animation-delay: 0.95s;
        }

        #contenedor-bolita-e .bolitae {
            animation-delay: 1.20s;
        }

        #contenedor-bolita-e .bolitaf {
            animation-delay: 1.45s;
        }

        #contenedor-bolita-e .bolitag {
            animation-delay: 1.70s;
        }

        #contenedor-bolita-e .bolitah {
            animation-delay: 1.95s;
        }

        #contenedor-bolita-f .bolitaa {
            animation-delay: 0.25s;
        }

        #contenedor-bolita-f .bolitab {
            animation-delay: 0.50s;
        }

        #contenedor-bolita-f .bolitac {
            animation-delay: 0.75s;
        }

        #contenedor-bolita-f .bolitad {
            animation-delay: 1.00s;
        }

        #contenedor-bolita-f .bolitae {
            animation-delay: 1.25s;
        }

        #contenedor-bolita-f .bolitaf {
            animation-delay: 1.50s;
        }

        #contenedor-bolita-f .bolitag {
            animation-delay: 1.75s;
        }

        #contenedor-bolita-f .bolitah {
            animation-delay: 2.00s;
        }





        #contenedor-bolita-a div {
            background-color: #F60000;
            height: 10px;
            width: 10px;
        }

        #contenedor-bolita-b div {
            background-color: #F72B2B;
            height: 10px;
            width: 10px;
            border-radius: 50% 50%;
        }

        #contenedor-bolita-c div {
            background-color: #F95555;
            height: 10px;
            width: 10px;
            border-radius: 50% 50%;
        }

        #contenedor-bolita-d div {
            background-color: #FA8080;
            height: 10px;
            width: 10px;
            border-radius: 50% 50%;
        }

        #contenedor-bolita-e div {
            background-color: #FCAAAA;
            height: 10px;
            width: 10px;
            border-radius: 50% 50%;
        }

        #contenedor-bolita-f div {
            background-color: #FDCCCC;
            height: 10px;
            width: 10px;
            border-radius: 50% 50%;
        }

        #contenedor-bolita-g div {
            background-color: blue;
            height: 10px;
            width: 10px;
            border-radius: 50% 50%;
            border-radius: 50% 50%;
        }





        #contenedor-bolita-a {
            animation-delay: 1.25s;
        }

        #contenedor-bolita-b {
            animation-delay: 1.26s;
        }

        #contenedor-bolita-c {
            animation-delay: 1.35s;
        }

        #contenedor-bolita-d {
            animation-delay: 1.45s;
        }

        #contenedor-bolita-e {
            animation-delay: 1.55s;
        }

        #contenedor-bolita-f {
            animation-delay: 1.65s;
        }
        #contenedor-bolita-g {
           animation-delay: .5s;
           justify-content: center;
           align-items: center;
           animation-duration: 4s;
        }
      

        .contenedor-bolita.entrada {
            animation-name: cajaBolitaMover;
            animation-duration: 3s;
            left: 100px;
            bottom: 50%;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            animation-delay: 0s;
            width: 100px;

        }

        @keyframes cajaBolitaMover {

            from {
                bottom: 0%;
                width: 80px;
            }

            to {
                bottom: 100%;
                width: 40px;
            }

        }

        @keyframes bolitaMoverA {
            to {
                left: 100%;
            }
        }

        @keyframes ocultamiento {
            0% {
                z-index: 0;
            }

            100% {
                z-index: 100;
            }
        }
    </style>
</head>

<body class="w-100 h-100">
    <div style="background-color: #00000047; z-index: 300" class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center" id="msg_padre">
        <!-- <div class="msg-transotorio w-50 h-50 d-flex flex-column" id="msg_personalizado" style="border-radius: 13px; background-color: white">
            <div class="w-100 p-3" style="height: 80px" id="msg_titulo">
                <h2>Titulo</h2>
            </div>
        </div>-->
        <div id="contenedor-bolita-a" class="contenedor-bolita entrada position-absolute d-flex flex-row" style="left: 300px; height: 10px; ">
            <div class="bolitaa bolita entrada" style="bottom: 50%; width: 10px; height: 10px; border-radius: 50% 50%;"></div>
            <div class="bolitab bolita entrada" style="bottom: 50%; width: 10px; height: 10px; border-radius: 50% 50%;"></div>
            <div class="bolitac bolita entrada" style="bottom: 50%; width: 10px; height: 10px; border-radius: 50% 50%;"></div>
            <div class="bolitad bolita entrada" style="bottom: 50%; width: 10px; height: 10px; border-radius: 50% 50%;"></div>
            <div class="bolitae bolita entrada" style="bottom: 50%; width: 10px; height: 10px; border-radius: 50% 50%;"></div>
            <div class="bolitaf bolita entrada" style="bottom: 50%; width: 10px; height: 10px; border-radius: 50% 50%;"></div>
            <div class="bolitag bolita entrada" style="bottom: 50%; width: 10px; height: 10px; border-radius: 50% 50%;"></div>
            <div class="bolitah bolita entrada" style="bottom: 50%; width: 10px; height: 10px; border-radius: 50% 50%;"></div>
        </div>

        <div id="contenedor-bolita-b" class="contenedor-bolita entrada position-absolute d-flex flex-row" style="left: 300px; height: 10px; ">
            <div class="bolitaa bolita entrada" style=""></div>
            <div class="bolitab bolita entrada" style=""></div>
            <div class="bolitac bolita entrada" style=""></div>
            <div class="bolitad bolita entrada" style=""></div>
            <div class="bolitae bolita entrada" style=""></div>
            <div class="bolitaf bolita entrada" style=""></div>
            <div class="bolitag bolita entrada" style=""></div>
            <div class="bolitah bolita entrada" style=""></div>
        </div>

        <div id="contenedor-bolita-c" class="contenedor-bolita entrada position-absolute d-flex flex-row" style="left: 300px; height: 10px; ">
            <div class="bolitaa bolita entrada" style=""></div>
            <div class="bolitab bolita entrada" style=""></div>
            <div class="bolitac bolita entrada" style=""></div>
            <div class="bolitad bolita entrada" style=""></div>
            <div class="bolitae bolita entrada" style=""></div>
            <div class="bolitaf bolita entrada" style=""></div>
            <div class="bolitag bolita entrada" style=""></div>
            <div class="bolitah bolita entrada" style=""></div>
        </div>

        <div id="contenedor-bolita-d" class="contenedor-bolita entrada position-absolute d-flex flex-row" style="left: 300px; height: 10px; ">
            <div class="bolitaa bolita entrada" style=""></div>
            <div class="bolitab bolita entrada" style=""></div>
            <div class="bolitac bolita entrada" style=""></div>
            <div class="bolitad bolita entrada" style=""></div>
            <div class="bolitae bolita entrada" style=""></div>
            <div class="bolitaf bolita entrada" style=""></div>
            <div class="bolitag bolita entrada" style=""></div>
            <div class="bolitah bolita entrada" style=""></div>
        </div>

        <div id="contenedor-bolita-e" class="contenedor-bolita entrada position-absolute d-flex flex-row" style="left: 300px; height: 10px; ">
            <div class="bolitaa bolita entrada" style=""></div>
            <div class="bolitab bolita entrada" style=""></div>
            <div class="bolitac bolita entrada" style=""></div>
            <div class="bolitad bolita entrada" style=""></div>
            <div class="bolitae bolita entrada" style=""></div>
            <div class="bolitaf bolita entrada" style=""></div>
            <div class="bolitag bolita entrada" style=""></div>
            <div class="bolitah bolita entrada" style=""></div>
        </div>

        <div id="contenedor-bolita-f" class="contenedor-bolita entrada position-absolute d-flex flex-row" style="left: 300px; height: 10px; ">
            <div class="bolitaa bolita entrada" style=""></div>
            <div class="bolitab bolita entrada" style=""></div>
            <div class="bolitac bolita entrada" style=""></div>
            <div class="bolitad bolita entrada" style=""></div>
            <div class="bolitae bolita entrada" style=""></div>
            <div class="bolitaf bolita entrada" style=""></div>
            <div class="bolitag bolita entrada" style=""></div>
            <div class="bolitah bolita entrada" style=""></div>
        </div>

        <div id="contenedor-bolita-g" class="contenedor-bolita entrada position-absolute d-flex flex-column" style="left: 300px; ">
            <div class="  entrada" style=""></div>
           
           
        </div>

    </div>
    <?php
    $this->renderizar_menu($this->opcion);
    ?>
    <div class="d-flex w-100 " style="overflow: hidden; height: var(--alto-global)">
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
                            <div class="list-group" id="list-acciones" role="tablist">
                                <?php
                                foreach ($this->acciones as $key => $contenido) {
                                    $tecla = $contenido["Id_tecla"];
                                    $array_acciones[$tecla] = array($contenido["accion"], $tecla);
                                    Opcion($array_acciones[$tecla][0], $tecla, "accion", "paccion");
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="w-25 h-100 d-flex flex-column p-2" id="cpLugares" style="width: 20%;">
                        <p class="font-weight-bold text-left w-100 mb-3" style="margin: 0px">Lugares</p>

                        <div class="w-100 flex-column h-100 d-flex" id="" style="overflow: auto">
                            <div class="list-group" id="list-lugares" role="tablist">
                                <?php
                                foreach ($this->lugares as $key => $contenido) {
                                    $tecla = $contenido["Id_tecla"];
                                    $array_lugares[$tecla] = array($contenido["Id_lugar"], $tecla);
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
                        <input type="text" value="" autocomplete="off" minlength="8" maxlength="8" size="8" name="no_control" class="form-control texto-label alto-seleccionable" id="validationCustom02" value="" required>
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
                        <input type="text" minlength="3" value="" maxlength="32" name="nombre" size="32" class="form-control texto-label alto-seleccionable" id="validationCustom03" value="" required>
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
                    <input value="" type="text" name="carrera" class="form-control texto-label alto-seleccionable" id="validationCustom04" value="" required>
                </div>
                <button id="enviar" class="btn btn-primary w-100 m-0 p-0 alto-seleccionable texto-label" style="color: white; min-height: 40px">REGISTRAR ACCESO</button>
            </form>
        </div>
        <div class="modal fade" id="modalInformacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitulo">Información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalContenido">

                    </div>
                    <div class="modal-footer">
                        <button id="pruebaa" class="btn btn-primary">CLOSE</button>
                        <!--   <button id="modal_btn" type="button" class="btn btn-primary" data-dismiss="modal">Close</button>-->
                    </div>
                </div>
            </div>
        </div>

</body>
<script>
    validationCustom02.focus()
    pruebaa.addEventListener("click", function() {
        $("#modalInformacion").modal("hide")
        validationCustom02.focus()
        reiniciar_label()
    })
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

    var opcion_anterior = ""


    var opciones = document.querySelectorAll(".lista-opcion")
    const ocultar = (ele) => {
        ele.style.visibility = "hidden"
    }
    const mostrar = (ele) => {
        ele.style.visibility = "visible"
    }
    const remover_varios = (elementos, clase_nombre) => {
        elementos.forEach(ele => {
            ele.classList.remove(clase_nombre)
        })
    }
    const agregar_varios = (elementos, clase_nombre) => {
        elementos.forEach(ele => {
            ele.classList.add(clase_nombre)
        })
    }
    const elementos_clase = (prefijo, contenido) => {
        adjunto = {}
        contenido.forEach(ele => {
            adjunto[ele[1]] = {
                elemento: document.querySelector("#" + prefijo + ele[1]),
                opcion: ele[0]
            }
        })
        return adjunto
    }
    const evento_seleccion = (letra) => {
        seleccion = contenedor[c][letra]
        if (seleccion) {
            seleccion["elemento"].click()
            remover_varios(contenido_teclas[c], "vibrar")
            seleccion_opciones[c] = seleccion["opcion"]

            if (++c == 1) {
                seleccion["funcion"](cpLugares)
            } else {
                c = 0
                seleccionando = false
            }
        }
    }
    acciones = elementos_clase("paccion", Object.values(acciones))
    lugares = elementos_clase("plugar", Object.values(lugares))
    var teclas_acciones = document.querySelectorAll(".accion")
    var teclas_lugares = document.querySelectorAll(".lugar")
    var contenido_teclas = [teclas_acciones, teclas_lugares]

    var contenedor = [acciones, lugares]

    var seleccion_opciones = ["", ""]

    var todos = document.querySelectorAll(".lista-opcion")
    atr_todos = {}
    todos.forEach(ele => {
        atr_todos[ele.attributes["tecla"].value] = ele
    })
    Object.values(acciones).forEach(e => {
        if (e["opcion"] == "Salida") {
            e["funcion"] = (lugar) => {
                remover_varios(contenido_teclas[c], "vibrar")
                c = 0
                seleccionando = false
                ocultar(lugar)
            }

            return
        }
        e["funcion"] = mostrar
    })

    var seleccion
    var c = 0
    var seleccionando = false
    var ya_seleccionados = [false, false]
    window.onload = (ev) => {
        document.addEventListener("keydown", e => {
            let letra = String.fromCharCode(e.which)

            if (!seleccionando) {
                if (e.ctrlKey && e.which == 69) {
                    e.stopPropagation()
                    e.preventDefault()
                    c = 0
                    ya_seleccionados = [false, false]
                    remover_varios(opciones, "active")
                    agregar_varios(teclas_acciones, "vibrar")
                    agregar_varios(teclas_lugares, "vibrar")
                    mostrar(cpLugares)
                    //  aplicar_funcion_a_elementos(Object.values(referencias[0]), mostrar_normal)
                    //   aplicar_funcion_a_elementos(Object.values(referencias[1]), mostrar_normal)
                    // mostrar_seleccionable()
                    seleccionando = true
                }
                return
            }
            elemento = contenedor[c][letra]["elemento"]
            if (elemento) {
                elemento.click()
            }
        })
    }

    // var accion_seleccionada = Object.values(acciones)[0][1]
    //  var lugar_seleccionado = Object.values(lugares)[0][1]
    //   logica_seleccion(accion_seleccionada)
    //  logica_seleccion(lugar_seleccionado)
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
    //lista
    $('#list-acciones .lista-opcion').on('click', function(e) {
        e.preventDefault()
        /*  seleccion = contenedor[0][$(this).attr("tecla")]
          c = 1
          seleccion["funcion"](cpLugares)
          seleccion_opciones[0] = $(this).attr("nombre-accion")*/

        remover_varios(contenido_teclas[0], "vibrar")
        seleccion_opciones[0] = $(this).attr("nombre-accion")
        ya_seleccionados[0] = true

        c = 1
        if (ya_seleccionados[1]) {
            seleccionando = false
            c = 0
        } else {
            seleccionando = true
        }


        if ($(this).attr("nombre-accion") == "Salida") {
            remover_varios(contenido_teclas[1], "vibrar")
            ocultar(cpLugares)
            seleccionando = false
            c = 0
        } else {
            mostrar(cpLugares)
        }
        validationCustom02.focus()
    })
    $('#list-lugares .lista-opcion').on('click', function(e) {
        e.preventDefault()
        seleccion_opciones[1] = $(this).attr("nombre-accion")
        remover_varios(contenido_teclas[1], "vibrar")
        c = 0
        ya_seleccionados[1] = true
        if (ya_seleccionados[0]) {
            seleccionando = false
        } else {
            seleccionando = true
        }
        validationCustom02.focus()
    })
    const reiniciar_label = () => {
        validationCustom02.value = ""
        validationCustom03.value = ""
        validationCustom04.value = ""
    }
    const mostrar_informacion = (titulo, msg) => {
        $("#modalTitulo").text(titulo)
        $("#modalContenido").text(msg)
        $("#modalInformacion").modal("show")
    }
    teclas_acciones[0].click()
    teclas_lugares[0].click()

    const msg_transitorio = (tiempo) => {
        alert("mensaje mostrado")
        setTimeout(function() {
            alert("lanzado")
        }, tiempo)
    }
</script>
<script src="public/js/Registro/Remocion.js"></script>
<script src="public/js/Registro/Insercion.js"></script>
<script src="public/js/Registro/formulario.js"></script>
<script src="public/js/Registro/Registros recientes.js"></script>
<script src="public/js/Registro/Registros base.js"></script>

</html>