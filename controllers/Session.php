<?php
class Session extends Controller{
    function __construct($nombre, $metodo, $indice)
    {
        echo "somos controlador alumno";
        parent::__construct($nombre, $metodo, $this, $indice);
    }
    function prueba(){
        echo "somos metodo prueba";
    }
}

?>