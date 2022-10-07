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
}
