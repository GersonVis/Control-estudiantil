<?php
class Controller{
    function __construct($nombre, $metodo, $clase, $indice="")
    {
        $this->view=new View($nombre);
        if(!$this->ejecuto_el_metodo($clase, $metodo, $indice)){
          echo "no existe el metodo";
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
 }
?>