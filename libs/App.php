<?php


include_once "libs/Controller.php";
include_once "libs/Model.php";
include_once "libs/View.php";
include_once "libs/Database.php";
include_once "config/configuraciones.php";

class App
{
    function __construct()
    {
       
      session_start();
      //variables
      //variable para comprobar nulos
      $nulos=0;
      //variables de session
      $nombre=null;  $usuario=null;  $perfil=null;
      //variables de controlador
      $controlador=null; $indice=null; $metodo=null;
      // fin variables

      $nombre=$_SESSION["nombre"]??$nulos++;
      $usuario=$_SESSION["usuario"]??$nulos++;
      $perfil=$_SESSION["perfil"]??$nulos++;
      $id_usuario=$_SESSION["id"]??"-1";
     // if($nulos==0){
      if(true){
         $controlador=$_GET["controlador"];
         
         if($controlador!=""){
            $metodo=$_GET["metodo"]??"";
            $indice=$_GET["indice"]??"";
            if(!$this->crear_controlador($controlador, array("usuario"=>preg_replace("[^A-Za-z]", "",$nombre), "id_usuario"=>$id_usuario), $metodo, $indice, false)){
                $this->crear_controlador("Problema");
            }
            exit();
         }
      }
      echo "Debes iniciar sesión";
    }
    private function crear_controlador($controlador, $datos_usuario=array(), $metodo="", $indice="")
    {
        $ruta = "controllers/$controlador.php";
        if (file_exists($ruta)) {
            include $ruta;
            return new $controlador($controlador, $datos_usuario, $metodo, $indice);
        }
        return false;
    }
    
}
