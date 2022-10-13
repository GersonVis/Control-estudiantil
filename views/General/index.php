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
    </style>
</head>

<body class="w-100 h-100">
    <?php
    $this->renderizar_menu($this->opcion);
    ?>
    <div class="d-flex container-fluid w-100 h-100" style="padding-top: 110px;overflow: hidden;padding-left: 0px;padding-right: 0px;">
        <div class="w-100 m-0 d-flex flex-column">
            <div class="w-100 d-flex flex-column" style="width: 20%; padding: 0px 24px 0px 24px; height: 180px;">
                <p class="font-weight-bold  text-left w-100" style="margin: 0px">Información de lugares</p>
                <hr class="my-2 bg-decorativo">
                <div id="plugares_personas bg-primary" class="w-100">
                </div>
            </div>
            <div class="w-100 h-100">

            </div>
        </div>

</body>


</html>