<?php
class Registro extends Controller{
    function __construct($nombre, $metodo, $indice)
    {
        parent::__construct($nombre, $metodo, $this, $indice);
    }
    function prueba(){
        echo "somos metodo prueba";
    }
    function principal(){
        $this->view->nombre = "gerson";
        $this->view->opcion = "Registro";
        //$this->cargar_modelo("Accion");

        $this->view->renderizar();
    }

}

?>