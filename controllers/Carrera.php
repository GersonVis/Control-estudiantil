<?php
class Carrera extends Controller
{
    function __construct($nombre, $datos_usuario, $metodo, $indice)
    {
        parent::__construct($nombre, $datos_usuario, $metodo, $this, $indice, true);
    }
    function principal()
    {
        $this->view->resultado = $this->todos();
        //$this->view->renderizar();
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
   
}
