<?php
class Controller{
    function __construct($nombre, $metodo, $clase, $indice="", $carga_de_modelo=false)
    {
        $this->view=new View($nombre);
        $this->nombre=$nombre;
        //decidir si cargar modelo para consultas a la base de datos
        if($carga_de_modelo){
            $this->cargar_modelo();
        }
        if(!$this->ejecuto_el_metodo($clase, $metodo, $indice)){
          $clase->principal();
        }
        exit();
    }
    private function ejecuto_el_metodo($clase, $metodo, $indice="")
    {
        $existe_el_metodo = method_exists($clase, $metodo);
        if ($existe_el_metodo) {
            $clase->$metodo($indice);
            return $existe_el_metodo;
        }
        return $existe_el_metodo;
    }
    function cargar_modelo($nombre_modelo=""){
        $nombre_modelo="Modelo_".($nombre_modelo==""?$this->nombre:$nombre_modelo);
       
        // cargamos el archivo con el modelo para poder crear la clase
        include_once "Models/$nombre_modelo.php";
        $this->modelo=new $nombre_modelo();
      
    }
 }
?>