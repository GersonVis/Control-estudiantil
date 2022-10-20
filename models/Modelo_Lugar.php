<?php

class Modelo_Lugar extends Model{
    function __construct()
    {
        parent::__construct();
    }
    
    function Todos(){
        $conexion=$this->db->conectar();
        $resultado=$this->db->consulta($conexion, "select * from lugares_p;");
        return $resultado;
    }

}

?>