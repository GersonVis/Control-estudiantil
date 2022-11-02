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
    function entradasPorCarrera($entradas = "")
    {

        $conexion = $this->db->conectar();
        $base_sql = "select date_format(Fecha, '%d/%m') as etiqueta, timestampdiff(minute, hora_entrada, hora_salida)/60 as valor from accesos_p inner join estudiantes_p using(id_persona) ";

        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $limite_inicio = $entradas["Posicion_limite"];
        $numero_registros = $entradas["Numero_registros"];

        unset($entradas["Posicion_limite"]);
        unset($entradas["Numero_registros"]);

        $sentencia_limite = $numero_registros != "" ? " limit $limite_inicio, $numero_registros" : "";

        $base_sql = $this->formar_sql($base_sql, $entradas) . $sentencia_limite;
        // echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }
}