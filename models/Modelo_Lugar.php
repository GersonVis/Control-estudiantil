<?php

class Modelo_Lugar extends Model{
    function __construct()
    {
        parent::__construct();
    }
    
    function todos($entradas = "", $nulos = 0)
    {
        $conexion = $this->db->conectar();
        $base_sql = "select * from lugares_p";
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
        $base_sql = "select Id_carrera as etiqueta, count(*) as valor, Color as color from accesos_p inner join estudiantes_p using(id_persona) inner join carreras_p using(Id_carrera) ";

        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $limite_inicio = $entradas["Posicion_limite"];
        $numero_registros = $entradas["Numero_registros"];

        unset($entradas["Posicion_limite"]);
        unset($entradas["Numero_registros"]);

        $sentencia_limite = "group by Id_carrera ".($numero_registros != "" ? " limit $limite_inicio, $numero_registros" : "");

        $base_sql = $this->formar_sql($base_sql, $entradas) . $sentencia_limite;
        // echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }
    function conteoHora($entradas=""){
        $conexion = $this->db->conectar();
        $base_sql = "select count(*) as valor, hour(Hora_entrada) as etiqueta from accesos_p inner join estudiantes_p using(Id_persona) ";
        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $limite_inicio = $entradas["Posicion_limite"];
        $numero_registros = $entradas["Numero_registros"];

        unset($entradas["Posicion_limite"]);
        unset($entradas["Numero_registros"]);

        $sentencia_limite = "GROUP by etiqueta ".($numero_registros != "" ? " limit $limite_inicio, $numero_registros" : "");

        $base_sql = $this->formar_sql($base_sql, $entradas) . $sentencia_limite;
        // echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
        
    }
}

?>