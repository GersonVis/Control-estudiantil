<?php
class Session extends Controller{
    function __construct($nombre,$datos_usuario, $metodo, $indice)
    {
        echo "somos controlador alumno";
        parent::__construct($nombre, $datos_usuario, $metodo, $this, $indice);
    }
    function prueba(){
        echo "somos metodo prueba";
    }
}

?>