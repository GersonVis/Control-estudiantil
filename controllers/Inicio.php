<?php
class Inicio extends Controller{
    function __construct($nombre, $metodo, $indice)
    {
        parent::__construct($nombre, $metodo, $this, $indice);
    }
    function prueba(){
        echo "somos metodo prueba";
    }
    /*function renderizar(){
        echo "vista mostrada";
    }*/
}

?>