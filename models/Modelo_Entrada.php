<?php

class Modelo_Entrada extends Model{
    function __construct()
    {
        parent::__construct();
    }
    
    function Todos(){
        $conexion=$this->db->conectar();
        $sql= "select * from entradas_n;";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function registrarEntrada($lugar, $no_control){
        $conexion=$this->db->conectar();
        $entradas=$this->limpiar($conexion, array("no_control"=>$no_control, "lugar"=>$lugar));
        $sql="insert into entradas_n( no_control, lugar) values('$entradas[lugar]', '$entradas[no_control]')";
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function borrar($entradas){
        $conexion=$this->db->conectar();
        $entradas=$this->limpiar($conexion, $entradas);
        $sql="";
        if($entradas["fecha"]!=""){
            $sql.="fecha between '$entradas[fecha]' and '$entradas[fecha_fin]' ";
            if($entradas["fecha_fin"]==""){
                $sql=" fecha='$entradas[fecha]'  ";
            }
        }
        $sql.=" and "; 
        unset($entradas["fecha"]);
        unset($entradas["fecha_fin"]);
        foreach($entradas as $key=>$data){
           if($data != ""){
            $sql.=" $key='$data' and ";
           }  
        }
        $sql=substr($sql, 0, -4);
        $sql="delete from entradas_n ".($sql==""?"":$sql);
        return $this->db->consulta_codigo($conexion, $sql);
    }
    function estaDisponible($no_control){
        $conexion=$this->db->conectar();
        $entradas=$this->limpiar($conexion, array("no_control"=>$no_control));
        $sql="select * from entradas_n where no_control= '$entradas[no_control]' and fecha=curdate() and hora_salida is null;";
        return $this->db->consulta_codigo($conexion, $sql);
    }

}

?>