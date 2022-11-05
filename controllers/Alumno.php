<?php
class Alumno extends Controller
{
    function __construct($nombre, $datos_usuario, $metodo, $indice)
    {
        parent::__construct($nombre, $datos_usuario, $metodo, $this, $indice, true);
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
        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $noControl = $_POST["No_control"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $this->view->resultado = $this->modelo->todos(array("fecha" => $fecha, "Id_lugar" => $lugar, "no_control" => $noControl, "fecha_fin" => $fecha_fin, "hora_salida"=>$hora_salida));
        $this->view->renderizar();
    }
    function buscar(){
       
        $requerido = $this->parametros_necesarios(array("Palabras_clave"), $_POST);
        if ($requerido) {
            $this->view->resultado = $requerido;
            $this->view->renderizar();
            exit;
        }
        $busqueda=$_POST["Palabras_clave"];
        $this->view->resultado = $this->modelo->buscar(array("Palabras_clave" => $busqueda));
        $this->view->renderizar();
    }
    function conteo(){
        $fecha = $_POST["fecha"] ?? "";
        $Id_lugar = $_POST["Id_lugar"] ?? "";
        $noControl = $_POST["no_control"] ?? "";
        $fecha_fin = $_POST["fecha_fin"] ?? "";
        $hora_salida = $_POST["hora_salida"]??"";
        $this->view->resultado = $this->modelo->conteo(array("fecha" => $fecha, "Id_lugar" => $Id_lugar, "no_control" => $noControl, "fecha_fin" => $fecha_fin, "hora_salida"=>$hora_salida));
        $this->view->renderizar();
    }
    function registrarEntrada()
    {
        $json_respuesta = array();
        $requerido = $this->parametros_necesarios(array("nombre", "lugar", "no_control", "carrera"), $_POST);
        if ($requerido) {
            $this->view->resultado = $requerido;
            $this->view->renderizar();
            exit;
        }
        $no_control = $_POST["no_control"];
        $lugar = $_POST["lugar"];
        $nombre = $_POST["nombre"];
        $carrera= $_POST["carrera"];
        $json_respuesta = $this->modelo->registrarEntrada($lugar, $no_control, $nombre, $carrera);
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
        $requerido = $this->parametros_necesarios(array("nombre", "lugar", "no_control", "carrera"), $_POST);
        if ($requerido) {
            $this->view->resultado = $requerido;
            $this->view->renderizar();
            exit;
        }
        $no_control = $_POST["no_control"];
        $lugar = $_POST["lugar"];
        $nombre = $_POST["nombre"];
        $carrera= $_POST["carrera"];
        $json_respuesta = $this->modelo->entradaAumatica($lugar, $no_control, $nombre, $carrera);
        $this->view->resultado = $json_respuesta;
        $this->view->renderizar();
    }
    function registrarSalida()
    {
        $requerido=$this->parametros_necesarios(array("No_control"), $_POST);
        if($requerido){
            $this->view->resultado = $requerido;
            $this->view->renderizar();
            exit;
        }
        $no_control = $_POST["No_control"];
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
    function resumenLugares(){
        $resultado=$this->modelo->resumenLugares();
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
}
