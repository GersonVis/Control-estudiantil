<?php
class Inicio extends Controller{
    function __construct($nombre,$datos_usuario, $metodo, $indice)
    {
        parent::__construct($nombre,$datos_usuario, $metodo, $this, $indice);
    }
    function prueba(){
        echo "somos metodo prueba";
    }
    function principal(){
        $this->view->nombre = "gerson";
        $this->view->opcion = "Registro";
       
        $this->view->renderizar();
    }
}

?>