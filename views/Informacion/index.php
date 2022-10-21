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

        .entrada-creciente {
            animation-name: entrada-creciente;
            animation-duration: 1s;
            overflow: hidden;
            animation-fill-mode: forwards;
            animation-timing-function: jump-start;
        }

        .entrada-creciente-r {
            animation-name: entrada-creciente-r;
            animation-duration: 1s;
            overflow: hidden;
            animation-fill-mode: forwards;
        }

        @keyframes entrada-creciente {
            from {
                height: 0%;
            }

            to {
                height: 300px;
            }
        }

        @keyframes entrada-creciente-r {
            from {
                height: 300px;
            }

            to {
                height: 0px;

            }
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
    </style>
</head>

<body class="w-100 h-100">
    <?php
    $this->renderizar_menu($this->opcion);
    ?>
    <div class="d-flex container-fluid w-100 h-100 justify-content-center" style="padding-top: 110px; overflow: hidden;">
        <div class="w-50 h-100">
            <div class="w-100 d-flex justify-content-center align-items-center" style="height: 10%">
                <div class="d-flex justify-content-center align-items-center w-75 position-relative" style="height: 50%; min-height: 40px">
                    <input type="text" id="input_busqueda" placeholder="Buscar" class="p-2 w-100 h-100" style=" border-radius: 12px; background-color: var(--prioridad-alta); border: 0">
                    </input>
                    <div id="cuadro_busqueda" class="position-absolute d-flex bg-sub-prioridad-alta w-100  mt-1 redondear-secundario" style="z-index: 99; height: 0px; top: 100%; overflow: hidden;" activo="hidden">
                        <img src="public/ilustraciones/busqueda.png" style="height: 180px;margin-top: 24px;" />
                        <div class="d-flex flex-column" style="margin-top: 24px">
                            <b style="font-size: 120%; margin-bottom: 14px;">¡Iniciar búsqueda!</b>
                            <p style="margin-bottom: 14px; font-size: 70%;">Iniciaras la búsqueda de personas y de lugares, la búsqueda es en base al nombre.
                            </p>
                            <button type="button" class="btn btn-primary btn-block font-weight-bold w-75 m-0 p-0" style="border-radius: 12px; height: 30px;"><i class="bi-search"></i> BUSCAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100" style="height: 90%;">
                <div class="w-100 d-flex flex-column" style="height: 45%">
                    <b>Lugares</b>
                    <div class="w-100 d-flex flex-row p-1" style="height: 200px; overflow-x: auto; overflow-y: hidden; gap: 14px">
                        <div class="h-100 d-flex flex-column" style="min-width: 110px; width: 110px;">
                            <div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
                                <p class="text-secondary" style="font-size: 40pt;">G</p>
                                <div class="position-absolute d-flex justify-content-center align-items-center" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                            <div class="w-100" style="height: 25%;">
                                <p align="center" class="m-0 p-0 text-secondary">General</p>
                            </div>
                        </div>
                        <div class="h-100 d-flex flex-column" style="min-width: 110px; width: 110px;">
                            <div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
                                <p class="text-secondary" style="font-size: 40pt;">L</p>
                                <div class="position-absolute d-flex justify-content-center align-items-center" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                            <div class="w-100" style="height: 25%;">
                                <p align="center" class="m-0 p-0 text-secondary">Laboratorio de redes</p>
                            </div>
                        </div>
                        <div class="h-100 d-flex flex-column" style="min-width: 110px; width: 110px;">
                            <div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
                                <p class="text-secondary" style="font-size: 40pt;">L</p>
                                <div class="position-absolute d-flex justify-content-center align-items-center" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                            <div class="w-100" style="height: 25%;">
                                <p align="center" class="m-0 p-0 text-secondary">Laboratorio de redes</p>
                            </div>
                        </div>
                        <div class="h-100 d-flex flex-column" style="min-width: 110px; width: 110px;">
                            <div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
                                <p class="text-secondary" style="font-size: 40pt;">L</p>
                                <div class="position-absolute d-flex justify-content-center align-items-center" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                            <div class="w-100" style="height: 25%;">
                                <p align="center" class="m-0 p-0 text-secondary">Laboratorio de redes</p>
                            </div>
                        </div>
                        <div class="h-100 d-flex flex-column" style="min-width: 110px; width: 110px;">
                            <div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
                                <p class="text-secondary" style="font-size: 40pt;">L</p>
                                <div class="position-absolute d-flex justify-content-center align-items-center" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                            <div class="w-100" style="height: 25%;">
                                <p align="center" class="m-0 p-0 text-secondary">Laboratorio de redes</p>
                            </div>
                        </div>
                        <div class="h-100 d-flex flex-column" style="min-width: 110px; width: 110px;">
                            <div class="position-relative w-100 d-flex justify-content-center align-items-center" style="height: 75%; background-image: linear-gradient(#f3f8fbd9, #f3f8fbd9), url('public/ilustraciones/136.jpg'); background-size: cover;">
                                <p class="text-secondary" style="font-size: 40pt;">L</p>
                                <div class="position-absolute d-flex justify-content-center align-items-center" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                            <div class="w-100" style="height: 25%;">
                                <p align="center" class="m-0 p-0 text-secondary">Laboratorio de redes</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="w-100" style="height: 55%">
                    <div class="w-100" style="height: 20%;">
                        <b class="w-100" style="height: 20%; padding-bottom: 14px">Personas</b>
                    </div>
                    <div class="w-100 d-flex flex-column" id="contenedor_personas" style="height: 80%; overflow: auto; padding-bottom: 14px; gap: 14px">
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row" style="height: 70px">
                            <div class="h-100 d-flex justify-content-center align-items-center" style="width: 50px; margin: 0 14px 0 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill="#DADADA" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <div class="h-100 d-flex flex-column" style="flex-grow: 1">
                                <div class="h-50 d-flex align-items-end">
                                    <b class="p-0 m-0 text-medio">Gerson Visoso Ocampo</b>
                                </div>
                                <div class="h-50">
                                    <p class="text-bajo p-0 m-0">17670174</p>
                                </div>
                            </div>
                            <div class="h-100">
                                <div class="d-flex justify-content-center align-items-center m-2" style="top: 14px;background: white;border-radius: 50% 50%;right: 14px;width: 24px;height: 24px;">
                                    <i class="bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                        </div>
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="public/js/Informacion/Busqueda.js"></script>
<script src="public/js/Informacion/Lugares.js"></script>
<script>
    const input_busqueda = document.querySelector("#input_busqueda")
    const cuadro_informacion = document.querySelector("#cuadro_busqueda")
    //fovus al cuadro de búsqueda
    input_busqueda.focus();
</script>

</html>