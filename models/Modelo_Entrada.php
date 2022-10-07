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
        $lugar=mysqli_real_escape_string($conexion, $lugar);
        $no_control=mysqli_real_escape_string($conexion, $no_control);
        $sql="insert into entradas_n( no_control, lugar) values('$lugar', '$no_control')";
        $resultado=$this->db->consulta($conexion, $sql);
        $error_code=mysqli_errno($conexion);
        return array("respuesta"=>$error_code==0?true:false, "codigo"=>$error_code, "contenido"=>$resultado);
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

}

?>