<?php
class View{
    function __construct($nombre)
    {
      $this->nombre=$nombre;
      echo "vista creada";
    }
    function renderizar($vista="index"){
        include_once "views//$this->nombre/$vista.php";
    }
 }

?>