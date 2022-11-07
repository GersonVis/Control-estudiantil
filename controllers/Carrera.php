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
        $noControl = $_POST["No_control"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $this->view->resultado = $this->modelo->todos(array("fecha" => $fecha, "no_control" => $noControl, "fecha_fin" => $fecha_fin, "hora_salida"=>$hora_salida));
       
        $this->view->renderizar();
    }
    function entradasPorCarrera(){
        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $posicion_limite=$_POST["Posicion_limite"]??0;
        $numero_registros=$_POST["Numero_registros"]??"";
       
        $entradas_necesarias=array(
        "fecha" => $fecha,
        "Id_lugar" => $lugar,
     
        "Posicion_limite" => $posicion_limite,
        "Numero_registros" => $numero_registros,
        "fecha_fin" => $fecha_fin,
        "hora_salida"=>$hora_salida);
        $resultado=$this->modelo->entradasPorCarrera($entradas_necesarias);
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
   
}
