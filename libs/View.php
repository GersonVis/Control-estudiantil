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
      include_once "views/Globales/Recursos_globales.php";
    } 
    function renderizar_menu(){
      $this->menu = array("General"=>array("General", "General"),
      "Registro"=>array("Registro", "Registro"),
      "Informacion"=>array("Información", "Informacion"),
      "Base"=>array("Base de datos", "BaseDeDatos"));
      include_once "views/Componentes/Menu.php";
    }

 }

?>