<?php
class View{
    private $_nombre;
    function __construct($nombre)
    {
      $this->_nombre=$nombre;
    }
    function renderizar($vista="index", $carpeta=null){
        $carpeta=$carpeta??$this->_nombre;
        include_once "views/$carpeta/$vista.php";
    }
    function importaciones_globales(){
      $recursos='<link rel="stylesheet" href="/cat/SCA/public/node_modules/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="/cat/SCA/public/node_modules/bootstrap/dist/css/fonts.css">
      <script src="/cat/SCA/public/node_modules/jquery/dist/jquery.min.js"></script>
      <script src="/cat/SCA/public/node_modules/popper.js/dist/umd/popper.min.js"></script>
      <script src="/cat/SCA/public/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>';
      return $recursos;
    } 
 }

?>