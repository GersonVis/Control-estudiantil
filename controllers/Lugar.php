<?php
class Lugar extends Controller{
    function __construct($nombre,$datos_usuario, $metodo, $indice)
    {
        parent::__construct($nombre,$datos_usuario, $metodo, $this, $indice, true);
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
    function entradasPorCarrera($entrada){
        echo $entrada;
        $fecha = $_POST["Fecha"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $posicion_limite=$_POST["Posicion_limite"]??0;
        $numero_registros=$_POST["Numero_registros"]??"";
        $no_control_d =  $_POST["No_control"]??"";
        $id_Lugar=$_POST["Id_lugar"]??"";

        $entradas_necesarias=array(
        "fecha" => $fecha,
        "Id_lugar" => $id_Lugar,
        "No_control" => $no_control_d,
        "Posicion_limite" => $posicion_limite,
        "Numero_registros" => $numero_registros,
        "fecha_fin" => $fecha_fin,
        "Hora_salida"=>$hora_salida);
        $resultado=$this->modelo->entradasPorCarrera($entradas_necesarias);
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }

}

?>