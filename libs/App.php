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
      $modelo=null; $controlador=null; $controlador_creado=null;
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
                $controlador_creado=$this->crear_controlador($controlador);
                if($controlador_creado){
                    $controlador_creado->renderizar();
                    exit();
                }
                break;
            case 2:
                $controlador_creado=$this->crear_controlador($controlador);
                if($controlador_creado){
                    if(method_exists())
                    $controlador_creado->renderizar();
                    exit();
                }
                exit();
                break;
         }

         exit();
      }
      echo "Debes iniciar sesión";
   }
   private function crear_controlador($nombre){
        $ruta="../controllers/$nombre.php";
        if(file_exists($ruta)){
           return new $nombre;
        }
       return false;
   }
   private function ejecuto_el_metodo($clase, $metodo){
        $existe_el_metodo=method_exists($clase, $metodo);
        if($existe_el_metodo){
            $clase->$metodo();
            return $true;
        }
        return $existe_el_metodo;
   }
}
?>