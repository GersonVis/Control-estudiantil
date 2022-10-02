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
        </div>
        <div class="w-75 h-100 d-flex flex-column p-2" style="width: 20%;">
            <p class="font-weight-bold text-secondary text-left w-100" style="margin: 0px">Registrar</p>
            <hr class="my-2 bg-secondary" style="width: 200px">
            <div class="w-100 color-principal sombra-secundaria rounded" style="height: 90%; min-width: 110%"></div>
        </div>
    </div>
    <div class="sombra-principal redondear position-absolute bg-white display-flex flex-column container" style="width: 250px; height: 375px; right: 200px; bottom: 0px;">
        <div class="form-group mb-2">
            <label class="m-0" for="exampleInputEmail1">No. Control</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
           
        </div>
        <div class="form-group mb-2">
            <label class="m-0" for="exampleInputEmail1">Nombre</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            
        </div>
        <div class="form-group mb-2">
            <label class="m-0" for="exampleInputEmail1">Carrera</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        
        </div>
        <button type="submit" class="btn btn-primary w-100">REGISTRAR ACCESO</button>
    </div>
</body>

</html>