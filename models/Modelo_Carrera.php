<?php

class Modelo_Carrera extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function todos($entradas = "", $nulos = 0)
    {
        $conexion = $this->db->conectar();
        $base_sql = "select * from carreras_p";
        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $base_sql = $this->formar_sql($base_sql, $entradas);

        return $this->db->consulta_codigo($conexion, $base_sql);
    }
}