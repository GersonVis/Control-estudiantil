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
        $base_sql = "select * from accesos_p inner join personas_p using(Id_persona) inner join estudiantes_p using(Id_persona) ";
        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $base_sql = $this->formar_sql($base_sql, $entradas);

        return $this->db->consulta_codigo($conexion, $base_sql);
    }
    function conteo($entradas = "")
    {
        $conexion = $this->db->conectar();
        $base_sql = "select count(*) as conteo, case when hora_salida is null then 'vacio' else 'no vacio' end as Estado from accesos_p ";
        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql . " group by Estado");
        }
        $entradas = $this->limpiar($conexion, $entradas);

        $sql_armada = $this->formar_sql($base_sql, $entradas);
        $base_sql = $sql_armada . " group by Estado";
        //   echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }

    function registrarEntrada($lugar, $no_control, $nombre, $carrera, $apellido_paterno = "", $apellido_materno = "")
    {
        //nueva linea
        $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("no_control" => $no_control, "lugar" => $lugar, "nombre" => $nombre, "carrera" => $carrera, "apellido_paterno" => $apellido_paterno, "apellido_materno" => $apellido_materno));
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
        $sql = "select * from entradas_n where no_control = '$entradas[no_control]' and fecha=curdate() order by hora_entrada desc  limit 1;";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function sinSalida()
    {
        $conexion = $this->db->conectar();
        $sql = "call sin_salida();";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function resumenLugares()
    {
        $conexion = $this->db->conectar();
        $sql = "select Id_lugar, count(*) as conteo, case when hora_salida is null then 'no nulo' else 'nulo' end as esnulo from accesos_p where fecha=curdate() group by esnulo, Id_lugar;";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function entradaAumatica($lugar, $no_control, $nombre, $carrera, $apellido_paterno = "", $apellido_materno = "")
    {
        //nueva linea
        $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("no_control" => $no_control, "lugar" => $lugar, "nombre" => $nombre, "carrera" => $carrera, "apellido_paterno" => $apellido_paterno, "apellido_materno" => $apellido_materno));
        $sql = "call registro_accion_automatica('$entradas[lugar]', '$entradas[no_control]','$entradas[carrera]', '$entradas[nombre]', '$entradas[apellido_paterno]', '$entradas[apellido_materno]')";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function diasAlumno($entradas = "")
    {
        /* $conexion = $this->db->conectar();
        $entradas = $this->limpiar($conexion, array("no_control" =>$no_control));
        $sql = "select count(*) as conteo, fecha from accesos_p inner join estudiantes_p using(id_persona) where no_control='$entradas[no_control]' group by fecha";
        return $this->db->consulta_codigo($conexion, $sql);*/

        $conexion = $this->db->conectar();

        $base_sql = "select count(*) as conteo, fecha from accesos_p inner join estudiantes_p using(id_persona)  ";
        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $base_sql = $this->formar_sql($base_sql, $entradas) . " group by fecha";
        // echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }
    function conteoPorSemana($entradas = "")
    {
        /* $conexion = $this->db->conectar();
         $entradas = $this->limpiar($conexion, array("no_control" =>$no_control));
         $sql = "select count(*) as conteo, fecha from accesos_p inner join estudiantes_p using(id_persona) where no_control='$entradas[no_control]' group by fecha";
         return $this->db->consulta_codigo($conexion, $sql);*/

        $conexion = $this->db->conectar();

        $base_sql = "select dayofweek(fecha) as etiqueta, count(*) as valor, fecha from accesos_p inner join estudiantes_p using(id_persona) ";
        #   $base_sql = "select dayofweek(fecha) as dia_semana, count(*) as conteo, fecha from registro ";
        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $base_sql = $this->formar_sql($base_sql, $entradas) . " group by etiqueta;";
        //echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }
    function minutosPorEntrada($entradas = "")

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

    function conteoEntradas($entradas = "")
    {

        $conexion = $this->db->conectar();
        $base_sql = "select minute(hora_entrada) as etiqueta, count(*) as valor from accesos_p inner join estudiantes_p using(id_persona) ";

        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $limite_inicio = $entradas["Posicion_limite"];
        $numero_registros = $entradas["Numero_registros"];

        unset($entradas["Posicion_limite"]);
        unset($entradas["Numero_registros"]);

        $sentencia_limite = $numero_registros != "" ? " limit $limite_inicio, $numero_registros" : "";

        $base_sql = $this->formar_sql($base_sql, $entradas) . " group by etiqueta";
        $base_sql .= $sentencia_limite;
        //  echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }

    function conteoSalidas($entradas = "")
    {

        $conexion = $this->db->conectar();
        $base_sql = "select minute(hora_salida) as etiqueta, count(*) as valor from accesos_p inner join estudiantes_p using(id_persona) ";

        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $limite_inicio = $entradas["Posicion_limite"];
        $numero_registros = $entradas["Numero_registros"];

        unset($entradas["Posicion_limite"]);
        unset($entradas["Numero_registros"]);

        $sentencia_limite = $numero_registros != "" ? " limit $limite_inicio, $numero_registros" : "";

        $base_sql = $this->formar_sql($base_sql, $entradas) . " group by etiqueta";
        $base_sql .= $sentencia_limite;
        //  echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }


    function conteoHora($entradas = "")
    {
        $conexion = $this->db->conectar();

        $base_sql = "select count(*) as valor, minute(hora_entrada) as etiqueta from accesos_p inner join estudiantes_p using(id_persona)  ";

        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $base_sql = $this->formar_sql($base_sql, $entradas) . " group by etiqueta";
        //  echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }
    function entradasPorLugar($entradas = "")
    {
        $conexion = $this->db->conectar();

        $base_sql = "select count(*) as valor, Id_lugar as etiqueta from accesos_p inner join estudiantes_p using(id_persona) ";

        if (is_string($entradas)) {
            return $this->db->consulta_codigo($conexion, $base_sql);
        }
        $entradas = $this->limpiar($conexion, $entradas);
        $base_sql = $this->formar_sql($base_sql, $entradas) . " group by id_lugar;";
        //echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }
    function descargarconsulta($datos)
    {
        $conexion = $this->db->conectar();
        $columnas = $datos["columna"]??array();
        $where = $this->expandir_where($datos["where"] ?? array());
        $wherein = $datos["wherein"]??array();
        $columnas = $this->limpiar($conexion, $columnas);
        $parte_columnas = $this->formar_columnas($columnas);

        $where = $this->formar_sql("", $where);
        $wherein=$this->wherein($conexion, (array)$wherein);
        $base_sql="select ".$parte_columnas." from accesos_completo ".$where;
    
        if($where==""){
            $base_sql.=" where ".$wherein;
        }else{
            $base_sql.=" and ".$wherein;
        }
       // echo var_dump($datos);
       // echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }
    function eliminarConsulta($datos)
    {
        $conexion = $this->db->conectar();
        $columnas = $datos["columna"]??array();
        $where = $this->expandir_where($datos["where"] ?? array());
        $wherein = $datos["wherein"]??array();
        $columnas = $this->limpiar($conexion, $columnas);
        $parte_columnas = $this->formar_columnas($columnas);

        $where = $this->formar_sql("", $where);
        $wherein=$this->wherein($conexion, (array)$wherein);
        $base_sql="delete from accesos_completo ".$where;
    
        if($where==""){
            $base_sql.=" where ".$wherein;
        }else{
            $base_sql.=" and ".$wherein;
        }
       // echo var_dump($datos);
        echo $base_sql;
        return $this->db->consulta_codigo($conexion, $base_sql);
    }
    private function wherein($conexion, $datos){
        $whereis=array();
        foreach($datos as $key=>$contenido){
            $reconvertido=(array)$contenido;
            $key_in=$reconvertido["de"];
            if(!isset($whereis[$key_in])){
                $whereis[$key_in]="";
            }
            $limpio=$this->limpiar($conexion, array(0=>$reconvertido["valor"]));
            $whereis[$key_in].=" '$limpio[0]', ";
        }
        $wherein_sql="";
        foreach($whereis as $key=>$contenido){
            $sin_coma=substr($contenido, 0, -2);
            $wherein_sql.=" $key in ($sin_coma) and ";
        }
        $wherein_sql=substr($wherein_sql, 0, -5);
        return $wherein_sql;
    }
    private function expandir_where($contenido)
    {
        $contenido = (array)$contenido;
        $datos=array();
        foreach($contenido as $key=>$contenido_where){
         $valores=$contenido_where->valor;
         foreach($valores as $nombre_columna=>$valor){
             $reconvertido=(array)$valor;
             $keys=array_keys($reconvertido);


             $datos[$keys[0]]=$reconvertido[$keys[0]];
         }
       }
        return $datos;
    }
    private function formar_columnas($columnas)
    {
        $parte_formada = "";
        foreach ($columnas as $key => $nombre_columna) {
            $parte_formada .= " $nombre_columna, ";
        }
        return substr($parte_formada, 0, -2);
    }

    // prueba
    function prueba($consulta)
    {
        $conexion = $this->db->conectar();
        return $this->db->consulta_codigo($conexion, $consulta);
    }
}
