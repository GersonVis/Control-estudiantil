<?php
//importación componentes
include_once "views/Componentes/Lista_registro.php";
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
    <div class="d-flex container-fluid w-100 h-100" style="padding-top: 110px; overflow: hidden;">
        <div class="w-25 h-100 d-flex flex-column p-2" style="width: 20%;">
            <p class="font-weight-bold text-secondary text-left w-100" style="margin: 0px">Registros recientes</p>
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
            <p class="font-weight-bold text-secondary text-left w-100" style="margin: 0px">Registrar</p>
            <hr class="my-2 bg-secondary" style="width: 200px">
            <div class="w-100 color-principal sombra-secundaria rounded d-flex" style="height: 90%; min-width: 110%">
                <div class="d-flex w-100 h-100" style="overflow: hidden;">
                    <div class="w-25 h-100 d-flex flex-column p-2" style="width: 20%;">
                        <p class="font-weight-bold text-secondary text-left w-100" style="margin: 0px">Laboratorios</p>
                        <hr class="my-2 bg-secondary" style="width: 200px">
                        <div class="w-|00 flex-column h-100 redondear bg-white d-flex" style="overflow: auto">
                            <div class="w-100 dflex pt-1 mb-3" style="min-height: 95px">
                                <div class="w-100 h-25 d-flex">
                                    <div class="h-100 font-weight-bold texto-label " style="width: 60%;">Juan carlos castro</div>
                                    <div class="h-100 texto-label text-secondary" style="width: 20%">12:34 pm</div>
                                    <div class="h-100 d-flex flex-center justify-content-center align-items-center" style="width: 20%">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path fill="#DADADA" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path fill-rule="evenodd" fill="#DADADA" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-100 h-75 d-flex ">
                                    <div class="d-flex h-100 w-75 flex-column justify-content-center">
                                        <p class="texto-label text-secundary m-0">17670174</p>
                                        <p class="texto-label  text-secondary m-0">Laboratorio de Redes</p>
                                    </div>
                                    <div class="d-flex  w-25 h-100 justify-content-center align-items-center">
                                        <div style="border-radius: 50% 50%; background-color: #FFCACA; width: 30px; height: 30px" class="d-flex justify-content-center align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path fill="#A9A9A9" d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sombra-principal flex-column pb-2 redondear position-absolute bg-white container align-items-center d-flex" style="width: 250px; height: 375px; right: 200px; bottom: 0px; border-radius: 22px 22px 0 0; display: flex; justify-content: end;">
            <div class="w-100 d-flex justify-content-center align-items-start flex-grow-1">
                <img class="bg-white" src="public/ilustraciones/image-removebg-preview.png" style="width: 115px; border-radius: 50% 50%; transform: translatey(-10%)" />
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
            <button type="submit" class="btn btn-primary w-100 m-0 p-0 alto-seleccionable texto-label" style="color: white">REGISTRAR ACCESO</button>
        </div>
</body>

</html>