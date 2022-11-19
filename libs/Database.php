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
    $this->codigos_error = array(1064 => "Error en la consulta sql", 1452 => "Un dato especificado no se encuentra en el catalago", 0 => "La tarea se realizo correctamente", -1 => "Error no especificado");
    $this->tipos_consulta = array(
      "select" => "seleccion",
      "delete" => "eliminacion",
      "update" => "actualizacion",
      "insert" => "creacion",
      "call" => "procedimiento",
      "noprocedio"=>"noprocedio",
      "error"=>"noprocedio"
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
  function consulta_call($conexion, $sqlConsulta)
  {
    // funcion solo si se realiza un procedimiento almacenado
    // la estructura de un procedimiento almacenado debe retornar
    // tipo string, mensaje string, solicitud bolean
    $conexion->multi_query($sqlConsulta);
    $registro=array();
    $array_contenido=array();
    do {
      if($resultado=$conexion->store_result()){
        //$claves=$resultado->fetch_assoc();
       // echo var_dump($claves);
        $array_contenido=$resultado->fetch_all(MYSQLI_ASSOC);
       /* echo "fetch all";
        echo var_dump($array_contenido);
        echo "fetch fin";*/
        $registro[]=$array_contenido;
        $resultado->free();
      }
    } while ($conexion->next_result());
   // echo var_dump($registro);
    if(count($registro)==0){
      $registro[]=array(0=>array(
        "mensaje"=> "Existe un error en la información proporcionada",
        "solicitud"=> "false",
        "tipo"=> "error"
      ));
    }
    return $registro;
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
    $pattern = "/([a-z]*)\ (.*)/i";
    preg_match_all($pattern, $sql, $resultado, PREG_SET_ORDER, 0);

    $tipo_consulta = strtolower($resultado[0][1]);
    if($tipo_consulta=="call"){
       $datos_consulta="";
       $codigo_respuesta="";
       $tipo_de_consulta="";
       $contenido=array();
       
       $registros = $this->consulta_call($conexion, $sql);

       $datos_consulta=$registros[0][0];
       $codigo_respuesta=$datos_consulta["mensaje"];
       $tipo_de_consulta=$datos_consulta["tipo"];
       $contenido=count($registros)>1?$registros[1]:$contenido;
       $error_code = mysqli_errno($conexion);
       
       if($datos_consulta["solicitud"]!="true"){
           $error_code=1;
       }
      // echo "tipo de consulta $tipo_de_consulta";
       return array(
        "respuesta" => $error_code == 0 ? true : false,
        "codigo" => $codigo_respuesta,
        "contenido" => $contenido,
        "tipo_consulta" => $this->tipos_consulta[$tipo_de_consulta],
        "registros_afectados" => $conexion->affected_rows
      );

    }
    $resultado = $this->consulta($conexion, $sql);
    //echo $sql;
    $registros = array();
    if(gettype($resultado)!="boolean"){
      if ($resultado->num_rows>0) {
        foreach ($resultado as $key => $registro) {
          $registros[$key] = $registro;
        }
      }
    }
    
    //  echo var_dump($resultado->store_result());
    $error_code = mysqli_errno($conexion);
    //  $afectados = $tipo_consulta!="select"?$conexion->affected_rows:"no es posible";
    return array(
      "respuesta" => $error_code == 0 ? true : false,
      "codigo" => isset($this->codigos_error[$error_code]) ? $this->codigos_error[$error_code] : "Error sin descripcion: $error_code",
      "contenido" => $registros,
      "tipo_consulta" => $this->tipos_consulta[$tipo_consulta],
      "registros_afectados" => $conexion->affected_rows
    );
  }
}
