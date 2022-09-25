<?php
class Alumno extends Controller
{
    function __construct($nombre, $metodo, $indice)
    {
        parent::__construct($nombre, $metodo, $this, $indice);
    }
    function prueba($indice){
        echo var_dump($_GET);
        echo "somos el metodo $indice";
    }
}
