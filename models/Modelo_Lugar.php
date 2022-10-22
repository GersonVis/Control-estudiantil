<?php

class Modelo_Lugar extends Model{
    function __construct()
    {
        parent::__construct();
    }
    
    function Todos(){
        $conexion = $this->db->conectar();
        $base_sql="select * from lugares_p";
        return $this->db->consulta_codigo($conexion, $base_sql);
    }

}

?>