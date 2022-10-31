<?php
class Model
{
    function __construct()
    {
        $this->db = new Database();
    }
    function crear_conexion()
    {
        return $this->db->conectar();
    }
    function a_array($respuesta)
    {
      
        $contenido = array();
        foreach ($respuesta as $key => $dentro) {
            $contenido[$key] = $dentro;
        }
        return $contenido;
    }
    protected function limpiar($conexion, $entradas){
        $reparado=array();
        foreach($entradas as $key=>$contenido){
            $reparado[$key]=mysqli_real_escape_string($conexion, $contenido);
        }
        return $reparado;
    }
    function crear_sql($entradas){
        $sql="";
        foreach ($entradas as $key => $data) {
           
            if($data=="is null"){
                $sql .= " $key is null and ";
                continue;
            }
            if($data=="is not null"){
                $sql .= " $key is not null and ";
                continue;
            }
            if ($data != "") {
                $sql .= " $key='$data' and ";
                continue;
            }
        }
        $sql = substr($sql, 0, -4);
        return $sql;
    }
    function formar_sql($base_sql, $entradas){
        $sql="";
        if (isset($entradas["fecha"])) {
            if ($entradas["fecha"] != "") {
                $sql .= "fecha between '$entradas[fecha]' and '$entradas[fecha_fin]' ";
                if ($entradas["fecha_fin"] == "") {
                    $sql = " fecha='$entradas[fecha]'  ";
                }
               
            }
            unset($entradas["fecha"]);
            unset($entradas["fecha_fin"]);
        }
        
        $sql_creado=$this->crear_sql($entradas);
        if($sql!=""){
            $sql.=$sql_creado!=""?" and ".$sql_creado:"";
        }else{
            $sql.=$sql_creado!=""?" ".$sql_creado:"";
        }
        

        $base_sql = $base_sql . ($sql == "" ? "" : " where " . $sql);

        return $base_sql;
    }
}
