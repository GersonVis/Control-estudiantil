<?php

use function PHPSTORM_META\type;

class Database
{
  private $host;
  private $user;
  private $password;
  private $db;
  private $tipos_consulta;
  function __construct()
  {
    $this->host = constant('HOST');
    $this->user = constant('USER');
    $this->password = constant('PASSWORD');
    $this->db = constant('DB');
    $this->codigos_error = array(1064=>"Error en la consulta sql", 1452 => "Un dato especificado no se encuentra en el catalago", 0 => "La tarea se realizo correctamente", -1 => "Error no especificado");
    $this->tipos_consulta= array(
      "select"=>"seleccion",
      "delete"=>"eliminacion",
      "update"=>"actualizacion",
      "insert"=>"creacion",
    );
  }
  function conectar()
  {
    $conexion = new mysqli($this->host, $this->user, $this->password, $this->db);
    if ($conexion->connect_errno) {
      echo "ocurrio un error";
      return false;
    }
    return $conexion;
  }
  function consulta($conexion, $sqlConsulta)
  {
    return $conexion->query($sqlConsulta);
  }

  function tiposDeDatoConsulta($conexion, $sqlConsulta)
  {
    $resultado = $conexion->query($sqlConsulta);
    $datosColumna = $resultado->fetch_fields();
    $columnasAsociadas = array();
    foreach ($datosColumna as $valor) {
      $columnasAsociadas[$valor->name] = array("tipo" => $this->tiposDeDato($valor->type), "otro" => $valor);
    }
    $informacion = array();
    while ($item = mysqli_fetch_assoc($resultado)) {
      $itemFabricado = array();
      foreach ($item as $etiqueta => $valor) {
        $reasignar = array("valor" => $valor, "tipo" => $columnasAsociadas[$etiqueta]["tipo"]);
        $total = array_merge($reasignar, (array)$columnasAsociadas[$etiqueta]["otro"]);
        $itemFabricado[$etiqueta] = $total;
      }
      $informacion[] = $itemFabricado;
    }
    return $informacion;
  }
  function tiposDeDato($valor)
  {
    switch ($valor) {
      case MYSQLI_TYPE_DECIMAL:
      case MYSQLI_TYPE_NEWDECIMAL:
      case MYSQLI_TYPE_FLOAT:
      case MYSQLI_TYPE_DOUBLE:
      case MYSQLI_TYPE_BIT:
      case MYSQLI_TYPE_TINY:
      case MYSQLI_TYPE_SHORT:
      case MYSQLI_TYPE_LONG:
      case MYSQLI_TYPE_LONGLONG:
      case MYSQLI_TYPE_INT24:
      case MYSQLI_TYPE_YEAR:
      case MYSQLI_TYPE_ENUM:
        return 'number';

      case MYSQLI_TYPE_TIMESTAMP:
      case MYSQLI_TYPE_DATE:
      case MYSQLI_TYPE_TIME:
      case MYSQLI_TYPE_DATETIME:
      case MYSQLI_TYPE_NEWDATE:
      case MYSQLI_TYPE_INTERVAL:
        return "date";
      case MYSQLI_TYPE_SET:
      case MYSQLI_TYPE_VAR_STRING:
      case MYSQLI_TYPE_STRING:
      case MYSQLI_TYPE_CHAR:
      case MYSQLI_TYPE_GEOMETRY:
      case MYSQLI_TYPE_TINY_BLOB:
      case MYSQLI_TYPE_MEDIUM_BLOB:
      case MYSQLI_TYPE_LONG_BLOB:
      case MYSQLI_TYPE_BLOB:
        return 'text';
      default:
        return 'text';
    }
  }
  function codigosError($codigo)
  {
    $codigos_error = array(0 => "La solicitud se realizo correctamente", 1452 => "Elija");
    return;
  }
  function consulta_codigo($conexion, $sql)
  {
    $pattern="/([a-z]*)\ (.*)/i";
    preg_match_all($pattern, $sql, $resultado, PREG_SET_ORDER, 0);

    $tipo_consulta=strtolower($resultado[0][1]);

   
    $resultado = $this->consulta($conexion, $sql);
    $registros = array();
    if(gettype($resultado)!="boolean"){
      if ($resultado->num_rows>0) {
        foreach ($resultado as $key => $registro) {
          $registros[$key] = $registro;
        }
      }
    }
    $error_code = mysqli_errno($conexion);
    return array(
      "respuesta" => $error_code == 0 ? true : false,
      "codigo" => isset($this->codigos_error[$error_code]) ? $this->codigos_error[$error_code] : "Error sin descripcion: $error_code",
      "contenido" => $registros,
      "tipo_consulta"=>$this->tipos_consulta[$tipo_consulta]
    );
  }
}
