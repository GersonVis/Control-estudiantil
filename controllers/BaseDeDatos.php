<?php
class BaseDeDatos extends Controller{
    function __construct($nombre, $datos_usuario, $metodo, $indice)
    {
        parent::__construct($nombre,$datos_usuario, $metodo, $this, $indice);
    }

    function principal(){
        $this->view->nombre = "gerson";
        $this->view->opcion = "BaseDeDatos";

        //lista de lugares para mostrar en las opciones
        $this->cargar_modelo("Lugar");
        $lugares=$this->modelo->todos();
        $this->view->lugares=$this->modelo->a_array($lugares);
        //mostramos en pantalla la informacion
        $this->view->renderizar();
    }

}

?>