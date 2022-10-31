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
            background-color: var(--principal-color);
            text-align: center;
            border: none;
            font-size: 10pt
        }

        .lista-opcion {
            position: relative;
        }

        .lista-opcion.active::after {
            content: "";
            position: absolute;
            bottom: 0;
            width: 6px;
            height: 6px;
            background-color: red;
            border-radius: 50% 50%;
            left: 0px;
            right: 0px;
            margin: auto;
        }
    </style>
</head>

<body class="w-100 h-100">
    <?php
    $this->renderizar_menu($this->opcion);
    ?>
     <div class="d-flex justify-content-center" style=" height: var(--alto-global)">
        <div class="w-100 m-0 d-flex flex-column">
            <div class="w-100 d-flex flex-column" style="width: 20%; padding: 0px 24px 0px 24px; min-height: 125px;">
                <p class="font-weight-bold  text-left w-100" style="margin: 0px">Información de lugares</p>
                <hr class="my-2 bg-decorativo">
                <div id="plugares_personas" class="d-flex flex-roww-100" style="gap: 14px">

                </div>
            </div>
            <div class="w-100  color-principal d-flex flex-row" style="overflow: hidden; box-shadow: 0px 0px 40px 0px rgb(203 201 201); flex-grow: 1;">
                <div class="h-100 w-25" style="min-height: 25px; min-height: 100%">
                    <div class="w-100 ml-4 d-flex align-items-center" style="height: 10%;">
                        <p class="m-0 p-0 font-weight-bold">Lugares</p>
                    </div>
                    <div class="w-100 pl-4" style="overflow: auto;height: 90%;max-height: 90%;overflow: auto;">
                        <div class="list-group" id="list-lugares" role="tablist" >
                            <a class="list-group-item list-group-item-action active" lugar="Todos" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home" style="">Todos</a>
                            <?php
                            foreach ($this->lugares as $registro => $contenido) {
                            ?>
                                <a class="list-group-item list-group-item-action" lugar="<?php echo $contenido["Id_lugar"]; ?>" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings" style="">
                                    <?php
                                    echo $contenido["Id_lugar"];
                                    ?>
                                </a>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="h-100 w-100">
                    <div class="w-100 h-25 d-flex flex-row p-3" id="lista-supopciones">
                        <div class="lista-opcion d-flex flex-row active" id="personas-dentro" supopcion="dentro" style="width: 200px;">
                            <div class="d-flex h-100 w-50 justify-content-center align-items-center">
                                <img src="public/ilustraciones/dentro.png" style="width: 80px; height: auto;" alt="">
                            </div>
                            <div class="h-100 w-50">
                                <div class="w-100 h-25">
                                    <p class="m-0 w-100 text-secondary" style="font-size: 8pt;">Personas dentro</p>
                                </div>
                                <div class="w-100 h-75 d-flex flex-row">
                                    <div class="d-flex justify-content-center align-items-center h-100 w-50">
                                        <p class=" text-secondary m-0 p-0" style="font-size: 26pt;" id="p_dentro"></p>
                                    </div>
                                    <div class="w-50 h-100 d-flex">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 10px; height:auto;">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 283.64 461" style="enable-background:new 0 0 283.64 461;" xml:space="preserve">
                                                <g>
                                                    <path fill="#DADADA" d="M112.32,453.36c-2.97-1.42-6.2-2.46-8.86-4.33c-7.16-5.03-9.23-12.45-9.22-20.86c0.05-78.94,0.03-157.89,0.03-236.83
		c0-16.19,0-32.39,0-48.58c0-2.36,0.32-4.64-3.33-4.68c-3.66-0.05-3.8,1.99-3.8,4.74c0.04,33.11,0,66.22,0.05,99.33
		c0.01,6.34-1.95,11.7-7.24,15.4c-5.4,3.78-11.29,4.37-17.23,1.4c-5.89-2.94-9.31-7.81-9.42-14.47c-0.19-11.27-0.1-22.55-0.1-33.83
		c-0.01-27.76,0.03-55.52-0.01-83.28c-0.02-14.12,4.71-26.01,16.08-34.82c5.96-4.62,12.74-7.76,20.29-7.8
		c34.4-0.21,68.82-0.58,103.21,0.02c19.3,0.34,34.46,15.24,37.1,34.39c0.39,2.85,0.54,5.76,0.54,8.65
		c0.03,37.88,0.12,75.76-0.12,113.64c-0.03,4.11-1.22,8.68-3.28,12.21c-3.54,6.06-11.2,8.3-17.88,6.44
		c-7.07-1.97-11.97-7.69-12.55-14.91c-0.23-2.88-0.12-5.78-0.12-8.67c-0.01-31.23-0.02-62.46,0.03-93.69c0-2.75-0.14-4.89-3.8-4.72
		c-2.37,0.11-3.48,0.94-3.33,3.36c0.08,1.3,0.01,2.6,0.01,3.9c0,93.4-0.12,186.8,0.13,280.21c0.04,13.79-4.45,23.54-18.18,27.79
		c-2.6,0-5.21,0-7.81,0c-14.78-6.16-18.16-11.3-18.16-27.66c0-53.76-0.08-110.32-0.08-164.08c0-1.3,0.36,0.09-0.05-1.07
		c-0.34-0.96-1.4-2.11-2.34-2.33c-4.07-0.93-4.66,1.36-4.66,4.89c0.09,55.21,0.04,110.41,0.08,165.62
		c0.01,7.25-1.51,13.98-7.32,18.67c-3.16,2.55-7.21,4.01-10.87,5.96C117.53,453.36,114.92,453.36,112.32,453.36z" />
                                                    <path fill="#DADADA" d="M141.65,72.8c-17.89-0.1-32.55-14.81-32.47-32.59c0.09-17.82,14.8-32.52,32.58-32.56c17.89-0.04,33.07,15.23,32.69,32.89
		C174.06,58.61,159.54,72.89,141.65,72.8z" />
                                                </g>
                                            </svg>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lista-opcion d-flex flex-row" supopcion="salidas" style="width: 200px;">
                            <div class="d-flex h-100 w-50 justify-content-center align-items-center">
                                <img src="public/ilustraciones/salidas.png" style="width: 80px; height: auto;" alt="">
                            </div>
                            <div class="h-100 w-50">
                                <div class="w-100 h-25">
                                    <p class="m-0 w-100 text-secondary" style="font-size: 8pt;">Salidas</p>
                                </div>
                                <div class="w-100 h-75 d-flex flex-row">
                                    <div class="d-flex justify-content-center align-items-center h-100 w-50">
                                        <p class=" text-secondary m-0 p-0" style="font-size: 26pt;" id="p_salidas"></p>
                                    </div>
                                    <div class="w-50 h-100 d-flex">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 10px; height:auto;">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 283.64 461" style="enable-background:new 0 0 283.64 461;" xml:space="preserve">
                                                <g>
                                                    <path fill="#DADADA" d="M112.32,453.36c-2.97-1.42-6.2-2.46-8.86-4.33c-7.16-5.03-9.23-12.45-9.22-20.86c0.05-78.94,0.03-157.89,0.03-236.83
		c0-16.19,0-32.39,0-48.58c0-2.36,0.32-4.64-3.33-4.68c-3.66-0.05-3.8,1.99-3.8,4.74c0.04,33.11,0,66.22,0.05,99.33
		c0.01,6.34-1.95,11.7-7.24,15.4c-5.4,3.78-11.29,4.37-17.23,1.4c-5.89-2.94-9.31-7.81-9.42-14.47c-0.19-11.27-0.1-22.55-0.1-33.83
		c-0.01-27.76,0.03-55.52-0.01-83.28c-0.02-14.12,4.71-26.01,16.08-34.82c5.96-4.62,12.74-7.76,20.29-7.8
		c34.4-0.21,68.82-0.58,103.21,0.02c19.3,0.34,34.46,15.24,37.1,34.39c0.39,2.85,0.54,5.76,0.54,8.65
		c0.03,37.88,0.12,75.76-0.12,113.64c-0.03,4.11-1.22,8.68-3.28,12.21c-3.54,6.06-11.2,8.3-17.88,6.44
		c-7.07-1.97-11.97-7.69-12.55-14.91c-0.23-2.88-0.12-5.78-0.12-8.67c-0.01-31.23-0.02-62.46,0.03-93.69c0-2.75-0.14-4.89-3.8-4.72
		c-2.37,0.11-3.48,0.94-3.33,3.36c0.08,1.3,0.01,2.6,0.01,3.9c0,93.4-0.12,186.8,0.13,280.21c0.04,13.79-4.45,23.54-18.18,27.79
		c-2.6,0-5.21,0-7.81,0c-14.78-6.16-18.16-11.3-18.16-27.66c0-53.76-0.08-110.32-0.08-164.08c0-1.3,0.36,0.09-0.05-1.07
		c-0.34-0.96-1.4-2.11-2.34-2.33c-4.07-0.93-4.66,1.36-4.66,4.89c0.09,55.21,0.04,110.41,0.08,165.62
		c0.01,7.25-1.51,13.98-7.32,18.67c-3.16,2.55-7.21,4.01-10.87,5.96C117.53,453.36,114.92,453.36,112.32,453.36z" />
                                                    <path fill="#DADADA" d="M141.65,72.8c-17.89-0.1-32.55-14.81-32.47-32.59c0.09-17.82,14.8-32.52,32.58-32.56c17.89-0.04,33.07,15.23,32.69,32.89
		C174.06,58.61,159.54,72.89,141.65,72.8z" />
                                                </g>
                                            </svg>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lista-opcion d-flex flex-row" supopcion="entradas" style="width: 200px;">
                            <div class="d-flex h-100 w-50 justify-content-center align-items-center">
                                <img src="public/ilustraciones/entradas.png" style="width: 80px; height: auto;" alt="">
                            </div>
                            <div class="h-100 w-50">
                                <div class="w-100 h-25">
                                    <p class="m-0 w-100 text-secondary" style="font-size: 8pt;">Entradas</p>
                                </div>
                                <div class="w-100 h-75 d-flex flex-row">
                                    <div class="d-flex justify-content-center align-items-center h-100 w-50">
                                        <p class=" text-secondary m-0 p-0" style="font-size: 26pt;" id="p_entradas"></p>
                                    </div>
                                    <div class="w-50 h-100 d-flex">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 10px; height:auto;">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 283.64 461" style="enable-background:new 0 0 283.64 461;" xml:space="preserve">
                                                <g>
                                                    <path fill="#DADADA" d="M112.32,453.36c-2.97-1.42-6.2-2.46-8.86-4.33c-7.16-5.03-9.23-12.45-9.22-20.86c0.05-78.94,0.03-157.89,0.03-236.83
		c0-16.19,0-32.39,0-48.58c0-2.36,0.32-4.64-3.33-4.68c-3.66-0.05-3.8,1.99-3.8,4.74c0.04,33.11,0,66.22,0.05,99.33
		c0.01,6.34-1.95,11.7-7.24,15.4c-5.4,3.78-11.29,4.37-17.23,1.4c-5.89-2.94-9.31-7.81-9.42-14.47c-0.19-11.27-0.1-22.55-0.1-33.83
		c-0.01-27.76,0.03-55.52-0.01-83.28c-0.02-14.12,4.71-26.01,16.08-34.82c5.96-4.62,12.74-7.76,20.29-7.8
		c34.4-0.21,68.82-0.58,103.21,0.02c19.3,0.34,34.46,15.24,37.1,34.39c0.39,2.85,0.54,5.76,0.54,8.65
		c0.03,37.88,0.12,75.76-0.12,113.64c-0.03,4.11-1.22,8.68-3.28,12.21c-3.54,6.06-11.2,8.3-17.88,6.44
		c-7.07-1.97-11.97-7.69-12.55-14.91c-0.23-2.88-0.12-5.78-0.12-8.67c-0.01-31.23-0.02-62.46,0.03-93.69c0-2.75-0.14-4.89-3.8-4.72
		c-2.37,0.11-3.48,0.94-3.33,3.36c0.08,1.3,0.01,2.6,0.01,3.9c0,93.4-0.12,186.8,0.13,280.21c0.04,13.79-4.45,23.54-18.18,27.79
		c-2.6,0-5.21,0-7.81,0c-14.78-6.16-18.16-11.3-18.16-27.66c0-53.76-0.08-110.32-0.08-164.08c0-1.3,0.36,0.09-0.05-1.07
		c-0.34-0.96-1.4-2.11-2.34-2.33c-4.07-0.93-4.66,1.36-4.66,4.89c0.09,55.21,0.04,110.41,0.08,165.62
		c0.01,7.25-1.51,13.98-7.32,18.67c-3.16,2.55-7.21,4.01-10.87,5.96C117.53,453.36,114.92,453.36,112.32,453.36z" />
                                                    <path fill="#DADADA" d="M141.65,72.8c-17.89-0.1-32.55-14.81-32.47-32.59c0.09-17.82,14.8-32.52,32.58-32.56c17.89-0.04,33.07,15.23,32.69,32.89
		C174.06,58.61,159.54,72.89,141.65,72.8z" />
                                                </g>
                                            </svg>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 h-75" style="overflow: auto;">
                        <div style="
    flex-grow: 1;
    overflow-x: auto;
">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-secondary" style="border: 0px;">ID</th>
                                        <th scope="col" class="text-secondary" style="border: 0px;">Nombre</th>
                                        <th scope="col" class="text-secondary" style="border: 0px;">No. Control</th>
                                        <th scope="col" class="text-secondary" style="border: 0px;">Hora entrada</th>
                                        <th scope="col" class="text-secondary" style="border: 0px;">Hora salida</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_registros">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
<script src="public/js/General/Personas_por_lugar.js"></script>
<script src="public/js/General/Agregar_registros.js"></script>
<script src="public/js/General/acciones_por_lugar.js"></script>
<script src="public/js/General/Seleccion_opcion.js"></script>
<script src="public/js/General/Personas_en_lugares.js"></script>


<script src="public/js/Compartido/Funciones_publicas.js"></script>
<script src="public/js/Compartido/Enviar_formulario.js"></script>


<script>
    const lista_registros = document.querySelector("#lista_registros")
    const p_dentro = document.querySelector("#p_dentro")
    const p_salidas = document.querySelector("#p_salidas")
    const p_entradas = document.querySelector("#p_entradas")
    const hoy = obtener_fecha()
    var nombre_lugar = "Todos"
    var sub_opcion = "dentro"
    var supopcion_seleccionada = document.querySelector("#personas-dentro")

    
    /*Cargas dinamias de elementos */
    // cargamos opcion por default
    ordenar_peticion(nombre_lugar, sub_opcion)
    total_por_lugar()

</script>
<!--Los timers necesitan que todas las demás funciones estén cargadas-->
<script src="public/js/General/Timers.js"></script>
</html>