<?php


include_once "Controller.php";
include_once "Model.php";
include_once "View.php";


class App{
   function __construct()
   {
      session_start();
      //variables
      //variable para comprobar nulos
      $nulos=0;
      //variables de session
      $nombre=null;  $usuario=null;  $perfil=null;
      //variables de controlador
      $modelo=null; $controlador=null;
      // fin variables
      
      $nombre=$_SESSION["nombre"]??$nulos++;
      $usuario=$_SESSION["usuario"]??$nulos++;
      $perfil=$_SESSION["perfil"]??$nulos++;
      if($nulos==0){
         echo "dentro";
         $nulos=0;
         $controlador=$_GET["controlador"]??$nulos++;
         $metodo=$_GET["metodo"]??$nulos++;
         switch($nulos){
            case 1:
                $controlador;
                break;
            case 2: 
                break;
         }
         exit();
      }
      echo "Debes iniciar sesión";

   }
}
?>