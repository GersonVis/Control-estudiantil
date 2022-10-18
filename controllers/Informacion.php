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
        $this->view->opcion = "Registro";
        $this->cargar_modelo("Accion");
        //obtenemos las acciones y las teclas asignadas
        $acciones=$this->modelo->todos();
        $this->view->acciones=$this->modelo->a_array($acciones);

        //obtenemos los lugares con las teclas asignadas
        $this->cargar_modelo("Lugar");
        $lugares=$this->modelo->todos();
        $this->view->lugares=$this->modelo->a_array($lugares);

        //mostramos en el navegador
        $this->view->renderizar();
    }

}

?>