<?php

class Modelo_Entrada extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function todos($entradas = "", $nulos = 0)
    {
        $conexion = $this->db->conectar();
        $base_sql = "select * from entradas_n ";
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
        $base_sql = "select count(*) as conteo, case when hora_salida is null then 'vacio' else 'no vacio' end as Estado from entradas_n ";
        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql." group by Estado");
        }
        $entradas = $this->limpiar($conexion, $entradas);
        
        $sql_armada=$this->formar_sql($base_sql, $entradas);
        $base_sql=$sql_armada." group by Estado";
     //   echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }

    function registrarEntrada($lugar, $no_control, $nombre)
    {
        //nueva linea
        $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("no_control" => $no_control, "lugar" => $lugar, "nombre" => $nombre));
        $sql = "insert into entradas_n( no_control, lugar, nombre) values('$entradas[lugar]', '$entradas[no_control]', '$entradas[nombre]')";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function registrarSalida($no_control)
    {
        $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("no_control" => $no_control));
        $sql = "update entradas_n set hora_salida=now() where fecha=curdate() and hora_salida is null and no_control='$entradas[no_control]'";
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
        $sql = "select * from entradas_n where no_control = '$entradas[no_control]' and fecha=curdate() order by hora_entrada desc  limit 1;";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function sinSalida()
    {
        $conexion = $this->db->conectar();
        $sql = "select * from entradas_n where hora_salida is null and fecha=curdate() order by id_entrada desc;";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function resumenLugares(){
        $conexion = $this->db->conectar();
        $sql="select lugar, count(*) as conteo, case when hora_salida is null then 'no nulo' else 'nulo' end as esnulo from entradas_n where fecha=curdate() group by esnulo, lugar;";
        return $this->db->consulta_codigo($conexion, $sql);
    }
}
