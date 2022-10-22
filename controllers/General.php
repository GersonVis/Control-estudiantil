<?php
class General extends Controller{
    function __construct($nombre, $metodo, $indice)
    {
        parent::__construct($nombre, $metodo, $this, $indice);
    }
    function prueba(){
        echo "somos metodo prueba";
    }
    function principal(){
        $this->view->nombre = "gerson";
        $this->view->opcion = "General";

        //lista de lugares para mostrar en las opciones
        $this->cargar_modelo("Lugar");
        $lugares=$this->modelo->todos();
        $this->view->lugares=$this->modelo->a_array($lugares["contenido"]);
        //mostramos en pantalla la informacion
        $this->view->renderizar();
    }

}

?>