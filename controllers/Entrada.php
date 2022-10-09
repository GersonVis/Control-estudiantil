<?php
class Entrada extends Controller
{
    function __construct($nombre, $metodo, $indice)
    {
        parent::__construct($nombre, $metodo, $this, $indice, true);
    }
    function principal()
    {
        $this->view->resultado=$this->modelo->todos();
        $this->view->renderizar();
    }
    function otro()
    {
        echo "desde otro";
        echo var_dump($this->modelo->status());
    }
    function todos()
    {
        $respuesta = $this->modelo->todos();
        $this->view->informacion = $this->modelo->a_array($respuesta);
        $this->view->renderizar();
    }
    function registrarEntrada()
    {
        
        $no_control = $_POST["noControl"];
        $lugar = $_POST["lugar"];
        $resultado = $this->modelo->registrarEntrada($no_control, $lugar);
        $this->view->resultado = $resultado;
        $this->view->renderizar();
        
    }
    function borrar(){
        $fecha=$_POST["fecha"]??"";
        $lugar=$_POST["lugar"]??"";
        $noControl=$_POST["noControl"]??"";
        $fecha_fin=$_POST["fecha_fin"]??"";
        $this->view->resultado=$this->modelo->borrar(array("fecha"=>$fecha, "lugar"=>$lugar, "no_control"=>$noControl, "fecha_fin"=>$fecha_fin));
        $this->view->renderizar();
    }
    function entradaAumatica(){
        $no_control=$_POST["noControl"]??"";
        $disponibilidad=$this->modelo->estaDisponible($no_control);
       // echo var_dump($disponibilidad["contenido"]);
        if(count($disponibilidad["contenido"])==0){
            $this->registrarEntrada();
        }
    }
}
