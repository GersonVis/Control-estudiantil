<?php

class Modelo_Accion extends Model{
    function __construct()
    {
        parent::__construct();
    }
    
    function Todos(){
        $conexion=$this->db->conectar();
        $resultado=$this->db->consulta($conexion, "select * from acciones_p;");
        return $resultado;
    }

}

?>