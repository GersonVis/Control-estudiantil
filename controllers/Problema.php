<?php
class Problema extends Controller{
    function __construct($nombre, $metodo)
    {
        echo "ocurrio un error";
        parent::__construct($nombre, $metodo, $this);
    }
    function principal(){
        echo "estamos en problema";
    }
}

?>