<?php
//importación componentes
include_once "views/Componentes/Lista_registro.php";
include_once "views/Componentes/Opcion.php";
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

        .vibrar {
            animation-name: slidein;
            animation-iteration-count: infinite;
            animation-duration: 0.5s;
            animation-direction: alternate-reverse;
            animation-timing-function: linear;
        }

        @keyframes slidein {
            from {
                transform:  rotateZ(5deg);
            }

            to {
                transform:  rotateZ(-5deg);
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
            <div class="w-|00 flex-column h-100 redondear bg-white d-flex" style="overflow: auto">
                <?php
                for ($c = 0; $c < 10; $c++) {
                    Lista_registro();
                }
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

                        <div class="w-|00 flex-column h-100 d-flex" style="overflow: auto">
                            <?php Opcion(); ?>

                        </div>
                    </div>
                    <div class="w-25 h-100 d-flex flex-column p-2" style="width: 20%;">
                        <p class="font-weight-bold text-left w-100 mb-3" style="margin: 0px">Lugares</p>

                        <div class="w-|00 flex-column h-100 d-flex" style="overflow: auto">
                            <?php Opcion(); ?>

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
            <div class="w-100 d-flex justify-content-center align-items-start flex-grow-1">
                <img class="" src="public/ilustraciones/registrando.png" style="width: 170px; transform: translatey(-2  0%)" />
            </div>
            <div class="form-group mb-2 w-100">
                <label class="m-0 label-inputs text-secondary" for="exampleInputEmail1">No. Control</label>
                <input type="email" class="form-control texto-label alto-seleccionable" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ej. 17670173">

            </div>
            <div class="form-group mb-2 w-100">
                <label class="m-0 label-inputs text-secondary" for="exampleInputEmail1">Nombre</label>
                <input type="email" class="form-control texto-label alto-seleccionable" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ej. Juan carlos">

            </div>
            <div class="form-group mb-2 w-100">
                <label class="m-0 label-inputs text-secondary" for="exampleInputEmail1">Carrera</label>
                <input type="email" class="form-control texto-label alto-seleccionable" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ej. Ingeniería en sistemas">

            </div>
            <button type="submit" class="btn btn-primary w-100 m-0 p-0 alto-seleccionable texto-label" style="color: white; min-height: 40px">REGISTRAR ACCESO</button>
        </div>
</body>
<script>
    window.onload = (ev) => {
        document.addEventListener("keydown", e => {
            if (e.ctrlKey && e.which == 69) {
                e.stopPropagation()
                e.preventDefault()
                mostrar_seleccionable()
            }
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
    }
    aplicar_clase=(elemento, animacion)=>{
        elemento.classList.add(animacion)
    }
</script>

</html>