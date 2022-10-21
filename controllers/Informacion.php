<?php
class Informacion extends Controller{
    function __construct($nombre, $metodo, $indice)
    {
        parent::__construct($nombre, $metodo, $this, $indice);
    }
    function prueba(){
        echo "somos metodo prueba";
    }
    function principal(){
        $this->view->nombre = "gerson";
        $this->view->opcion = "Informacion";

        //lista de lugares para mostrar en las opciones
        $this->cargar_modelo("Lugar");
        $lugares=$this->modelo->todos();
        $this->view->lugares=$this->modelo->a_array($lugares);
        //mostramos en pantalla la informacion
        $this->view->renderizar();
    }

}

?>