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

<body>
    <?php
     $this->renderizar_menu($this->opcion);
    ?>

</body>

</html>