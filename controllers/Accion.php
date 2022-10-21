<?php
class Accion extends Controller{
    function __construct($nombre, $metodo, $indice)
    {
        parent::__construct($nombre, $metodo, $this, $indice, true);
    }
    function principal(){
        $respuesta=$this->modelo->todos();
        $this->view->informacion=$this->modelo->a_array($respuesta);
        $this->view->renderizar();
    }
    function otro(){
        echo "desde otro";
        echo var_dump($this->modelo->status());
    }
    function todos(){
        $respuesta=$this->modelo->todos();
        $this->view->informacion=$this->modelo->a_array($respuesta);
        $this->view->renderizar();
    }

}

?>