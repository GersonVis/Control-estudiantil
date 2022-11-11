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
                        <div class="d-flex flex-row justify-content-center align-items-center" style="padding-top: 14px;">
                            <div style="height: 15px; width: 15px; border-radius: 50% 50%; background-color: var(--color-decorativo)"></div>
                            <div style="height: 5px; width: 25px; background-color: var(--color-decorativo)"></div>
                            <div style="height: 15px; width: 15px; border-radius: 50% 50%; background-color: var(--color-decorativo)"></div>
                            <div style="height: 5px; width: 25px; background-color: var(--color-decorativo)"></div>
                            <div style="height: 15px; width: 15px; border-radius: 50% 50%; background-color: var(--color-decorativo)"></div>
                        </div>

                        <div style="margin-top: 14px;">
                            <b class="m-0 p-0" style="color: var(--color-baja-baja)">Cada registro debe contener: </b>
                        </div>
                    </div>
                    <div class="d-flex w-100 p-3 flex-column" style="flex-grow: 1; overflow:auto">
                        <div id="opciones-agregadas-entradas" class="d-flex flex-column" style="gap: 10px;"></div>
                        <hr>
                        </hr>
                        <div id="opciones-disponibles-entradas" class="d-flex flex-column" style="gap: 10px;"></div>

                    </div>
                    <div class="d-flex w-100" style="height: 10%"></div>
                </div>
            </div>
            <div class="d-flex" style="margin-left: 24px; height: 20%;">
                <div class="d-flex flex-column flex-column">
                    <div class="d-flex flex-row">
                        <button type="button" style="width: 200px; border-radius: 13px" class="mr-1 btn btn-primary">DESCARGAR CSV</button>
                        <button type="button" style="width: 200px; border-radius: 13px" class="ml-1 btn btn-light">APLICAR ELIMINACIÓN</button>
                    </div>
                    <p style="margin-top: 14px; color: var(--color-prioridad-baja-baja)">La consulta contiene <b style="color: black">1532</b> registros</p>
                </div>
            </div>
        </div>
    </div>
</body>


<script src="public/js/Compartido/Funciones_publicas.js"></script>
<script src="public/js/BaseDeDatos/Variables.js"></script>
<script src="public/js/BaseDeDatos/Opcion.js"></script>
<script>
    valores_opciones = {
        Nombre: {
            titulo: "Nombre",
            elemento: undefined
        },
        Hora_entrada: {
            titulo: "Hora de entrada",
            elemento: undefined
        },
        Hora_salida: {
            titulo: "Hora de salida",
            elemento: undefined
        },
        Lugar: {
            titulo: "Lugar",
            elemento: undefined
        },
        Hora_salida: {
            titulo: "Hora de salida",
            elemento: undefined
        },
        Fecha: {
            titulo: "Fecha",
            elemento: undefined
        }
    }
    Object.entries(valores_opciones).forEach(valor => {
        let opcion = new Opcion(valor[1].titulo, disponibles_entradas, agregadas_entradas)
        opcion.crear_interfaz()
        opcion.agregar_agregado()
        valor[1].elemento=opcion
    })
   
</script>

</html>