<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $this->importaciones_globales();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->_nombre; ?></title>
</head>

<body >
    <?php
     $this->renderizar_menu($this->opcion);
    ?>
    <div class="container-fluid w-100 h-100">
        <div class="d-flex bg-primary"></div>
        <div class="d-flex bg-secundary"></div>
        <div class="d-flex"></div>
    </div>
</body>

</html>