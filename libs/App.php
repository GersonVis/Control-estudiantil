<?php


include "libs/Controller.php";
include_once "libs/Model.php";
include_once "libs/View.php";


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
      $modelo=null; $controlador=null; $controlador_creado=null; $indice=null;
      // fin variables
      
      $nombre=$_SESSION["nombre"]??$nulos++;
      $usuario=$_SESSION["usuario"]??$nulos++;
      $perfil=$_SESSION["perfil"]??$nulos++;
      if($nulos==0){
         $nulos=0;
         $controlador=$_GET["controlador"]!=""?$_GET["controlador"]:$nulos++;
         $metodo=$_GET["metodo"]!=""?$_GET["metodo"]:$nulos++;
         $indice=$_GET["indice"]??null;
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
                    if($this->ejecuto_el_metodo($controlador_creado, $metodo, $indice))exit();
                }
                break;
         }
         $error = $this->crear_controlador("Error");
         exit();
      }
      echo "Debes iniciar sesión";
   }
   private function crear_controlador($nombre){
        $ruta="controllers/$nombre.php";
        if(file_exists($ruta)){
           include_once $ruta;
           return new $nombre;
        }
       echo "el archivo no existe";
       return false;
   }
   private function ejecuto_el_metodo($clase, $metodo){
        $existe_el_metodo=method_exists($clase, $metodo);
        if($existe_el_metodo){
            $clase->$metodo();
            return $existe_el_metodo;
        }
        return $existe_el_metodo;
   }
}
?>