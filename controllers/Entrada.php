<?php
class Entrada extends Controller
{
    function __construct($nombre, $metodo, $indice)
    {
        parent::__construct($nombre, $metodo, $this, $indice, true);
    }
    function principal()
    {
        $this->view->resultado = $this->todos();
        $this->view->renderizar();
    }
    function otro()
    {
        echo "desde otro";
        echo var_dump($this->modelo->status());
    }
    function todos()
    {

        $fecha = $_POST["fecha"] ?? "";
        $lugar = $_POST["lugar"] ?? "";
        $noControl = $_POST["noControl"] ?? "";
        $fecha_fin = $_POST["fecha_fin"] ?? "";
        $this->view->resultado = $this->modelo->todos(array("fecha" => $fecha, "lugar" => $lugar, "no_control" => $noControl, "fecha_fin" => $fecha_fin));
        $this->view->renderizar();
    }
    function registrarEntrada()
    {
        $json_respuesta = array();
        $requerido = $this->parametros_necesarios(array("nombre", "lugar", "noControl"), $_POST);
        if ($requerido != "") {
            $json_respuesta["respuesta"] = false;
            $json_respuesta["codigo"] = $requerido;
            $this->view->resultado = $json_respuesta;
            $this->view->renderizar();
            exit;
        }
        $no_control = $_POST["noControl"];
        $lugar = $_POST["lugar"];
        $nombre = $_POST["nombre"];
        $json_respuesta = $this->modelo->estaDisponible($no_control);

        //ver si se encuentra registrado en algún lugar la persona

        //si en la consulta de disponibilidad no hay registros registramos
        if (count($json_respuesta["contenido"]) == 0) {
            $json_respuesta = $this->modelo->registrarEntrada($no_control, $lugar, $nombre);
            if ($json_respuesta["respuesta"]) {
                $resultado_registro = $this->modelo->info($no_control);
                $json_respuesta["contenido"] = $resultado_registro["contenido"];
                $this->view->resultado = $json_respuesta;
                $this->view->renderizar();
                exit;
            }
        }
        $json_respuesta["respuesta"] = false;
        $json_respuesta["codigo"] = "El usuario debe registrar salida primero";
        $json_respuesta["contenido"] = array();
        $this->view->resultado = $json_respuesta;
        $this->view->renderizar();
    }
    function borrar()
    {
        $fecha = $_POST["fecha"] ?? "";
        $lugar = $_POST["lugar"] ?? "";
        $noControl = $_POST["noControl"] ?? "";
        $fecha_fin = $_POST["fecha_fin"] ?? "";
        $this->view->resultado = $this->modelo->borrar(array("fecha" => $fecha, "lugar" => $lugar, "no_control" => $noControl, "fecha_fin" => $fecha_fin));
        $this->view->renderizar();
    }

    function entradaAumatica()
    {
        $json_respuesta = array();
        $requerido = $this->parametros_necesarios(array("nombre", "lugar", "noControl"), $_POST);
        if ($requerido != "") {
            $json_respuesta["respuesta"] = false;
            $json_respuesta["codigo"] = $requerido;
            $this->view->resultado = $json_respuesta;
            $this->view->renderizar();
            exit;
        }
        $no_control = $_POST["noControl"];
        $lugar = $_POST["lugar"];
        $nombre = $_POST["nombre"];
        //ver si se encuentra registrado en algún lugar la persona
        $disponibilidad = $this->modelo->estaDisponible($no_control);
        //si en la consulta de disponibilidad no hay registros registramos
        if (count($disponibilidad["contenido"]) == 0) {
            $registro_entrada = $this->modelo->registrarEntrada($no_control, $lugar, $nombre);
            if ($registro_entrada["respuesta"]) {
                // cargamos información del registro creado
                $info = $this->modelo->info($no_control);
                $registro_entrada["contenido"] = $info["contenido"];
                $this->view->resultado = $registro_entrada;
                $this->view->renderizar();
                exit;
            }
        }
        //registramos salida y añadimos información del registro afectado
        $salida = $this->modelo->registrarSalida($no_control);
        $info = $this->modelo->info($no_control);
        $salida["contenido"] = $info["contenido"];
        $this->view->resultado = $salida;
        $this->view->renderizar();
    }
    function registrarSalida()
    {
        $no_control = $_POST["noControl"];
        $resultado = $this->modelo->registrarSalida($no_control);
        $this->view->resultado = $resultado;
        $this->view->renderizar();
    }
    function info($indice)
    {
        $no_control = $indice;
        $resultado = $this->modelo->info($no_control);
        $this->view->resultado = $resultado;
        $this->view->renderizar();
    }
    function sinSalida(){
        $resultado = $this->modelo->sinSalida();
        $this->view->resultado = $resultado;
        $this->view->renderizar();
    }
}
