<?php
class Problema extends Controller{
    function __construct($nombre,$datos_usuario, $metodo)
    {
        echo "ocurrio un error";
        parent::__construct($nombre,$datos_usuario, $metodo, $this);
    }
    function principal(){
        echo "estamos en problema";
    }
}

?>