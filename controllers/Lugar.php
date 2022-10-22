<?php
class Lugar extends Controller{
    function __construct($nombre, $metodo, $indice)
    {
        parent::__construct($nombre, $metodo, $this, $indice, true);
    }
    function principal(){
        $respuesta=$this->modelo->todos();
        $this->view->informacion=$respuesta;
        $this->view->renderizar();
    }
    function todos(){
        $respuesta=$this->modelo->todos();
        $this->view->informacion=$respuesta;
        $this->view->renderizar();
    }

}

?>