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

        .cuadrito {
            background-color: var(--sub-prioridad-alta);
        }

        .asistencia {
            background-color: rgb(97, 232, 0) !important;
        }

        .no-asistencia {
            background-color: red !important;
        }

        .cuadrito.seleccionado {
            background-color: #4399FF;
            /*  border: 1px solid black;*/
            position: relative;
            animation-name: desplazar;
            animation-duration: 1s;
            animation-fill-mode: forwards;
            z-index: 100;
        }

        .cuadrito.seleccionado::after {
            position: absolute;
            content: "";
            height: 10%;
            width: 100%;
            background-color: black;
            top: 45%;
            border-radius: 50% 50%;
        }

        .cuadrito.no-seleccionado {
            background-color: var(--sub-prioridad-alta);
            animation-name: desplazar-r;
            animation-duration: 1s;
            animation-fill-mode: forwards;
            z-index: 0;
        }

        @keyframes desplazar {
            from {
                transform: translateY(0px);
                background-color: var(--sub-prioridad-alta);
            }

            to {
                transform: translateY(5px);
                background-color: #4399FF;
            }
        }

        @keyframes desplazar-r {
            from {
                transform: translateY(5px);
                background-color: #4399FF;
            }

            to {
                transform: translateY(0px);
                background-color: var(--sub-prioridad-alta);
            }
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
        <canvas id="myChart" width="400" height="400" style="display: block;box-sizing: border-box;height: 1336px;width: 1336px;max-width: 400px;max-height: 400px;"></canvas>
    </div>



</body>
<script src="public/js/Compartido/Enviar_formulario.js"></script>
<script src="public/node_modules/chart/package/dist/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    enviar_formulario("Entrada/conteoPorSemana", {
            "No_contorl": "20670109"
        })
        .then(
            json => {
                if (json.respuesta) {
                    data_dias=[0,0,0,0,0,0,0]
                    json.contenido.forEach(data=>{
                        data_dias[data.dia_semana-1]=data.conteo
                    })

                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                            datasets: [{
                                label: '# de entradas',
                                data: data_dias,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            }
        )
</script>

</html>