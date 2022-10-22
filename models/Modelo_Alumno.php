<?php

class Modelo_Alumno extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function todos($entradas = "", $nulos = 0)
    {
        $conexion = $this->db->conectar();
        $base_sql = "select * from estudiantes_p inner join personas_p using(Id_persona)";
        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $base_sql=$this->formar_sql($base_sql, $entradas);
       
        return $this->db->consulta_codigo($conexion, $base_sql);
    }
    function conteo($entradas = "")
    {
        $conexion = $this->db->conectar();
        $base_sql = "select count(*) as conteo, case when hora_salida is null then 'vacio' else 'no vacio' end as Estado from accesos_p ";
        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql." group by Estado");
        }
        $entradas = $this->limpiar($conexion, $entradas);
        
        $sql_armada=$this->formar_sql($base_sql, $entradas);
        $base_sql=$sql_armada." group by Estado";
     //   echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }

    function registrarEntrada($lugar, $no_control, $nombre, $carrera, $apellido_paterno="", $apellido_materno="")
    {
        //nueva linea
        $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("no_control" => $no_control, "lugar" => $lugar, "nombre" => $nombre, "carrera" => $carrera, "apellido_paterno" => $apellido_paterno, "apellido_materno"=> $apellido_materno));
        $sql = "call registrar_entrada('$entradas[lugar]', '$entradas[no_control]','$entradas[carrera]', '$entradas[nombre]', '$entradas[apellido_paterno]', '$entradas[apellido_materno]')";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function registrarSalida($No_control)
    {
        $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("No_control" => $No_control));
        $sql = "call registrar_salida('$entradas[No_control]');";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function borrar($entradas)
    {
        $conexion = $this->db->conectar();
        $base_sql = "delete from entradas_n ";
        $sql = "";

        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        if (isset($entradas["fecha"])) {
            if ($entradas["fecha"] != "") {
                $sql .= "fecha between '$entradas[fecha]' and '$entradas[fecha_fin]' ";
                if ($entradas["fecha_fin"] == "") {
                    $sql = " fecha='$entradas[fecha]'  ";
                }
                $sql .= " and ";
            }
            unset($entradas["fecha"]);
            unset($entradas["fecha_fin"]);
        }
        foreach ($entradas as $key => $data) {
            if ($data != "") {
                $sql .= " $key='$data' and ";
            }
        }
        $sql = substr($sql, 0, -4);
        $total = $base_sql . ($sql == "" ? "" : " where " . $sql);

        return $this->db->consulta_codigo($conexion, $total);
    }

    function estaDisponible($no_control)
    {
        $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("no_control" => $no_control));
        $sql = "select * from entradas_n where no_control= '$entradas[no_control]' and fecha=curdate() and hora_salida is null;";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function info($no_control)
    {
        $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("no_control" => $no_control));
        $sql = "select * from estudiantes_p inner join personas_p using(Id_persona) where no_control = '$entradas[no_control]' limit 1;";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function sinSalida()
    {
        $conexion = $this->db->conectar();
        $sql = "call sin_salida();";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function resumenLugares(){
        $conexion = $this->db->conectar();
        $sql="select Id_lugar, count(*) as conteo, case when hora_salida is null then 'no nulo' else 'nulo' end as esnulo from accesos_p where fecha=curdate() group by esnulo, Id_lugar;";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function entradaAumatica($lugar, $no_control, $nombre, $carrera, $apellido_paterno="", $apellido_materno="")
    {
        //nueva linea
        $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("no_control" => $no_control, "lugar" => $lugar, "nombre" => $nombre, "carrera" => $carrera, "apellido_paterno" => $apellido_paterno, "apellido_materno"=> $apellido_materno));
        $sql = "call registro_accion_automatica('$entradas[lugar]', '$entradas[no_control]','$entradas[carrera]', '$entradas[nombre]', '$entradas[apellido_paterno]', '$entradas[apellido_materno]')";
        return $this->db->consulta_codigo($conexion, $sql);
    }
}
