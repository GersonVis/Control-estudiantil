<?php
class Entrada extends Controller
{
    function __construct($nombre, $datos_usuario, $metodo, $indice)
    {
        parent::__construct($nombre, $datos_usuario, $metodo, $this, $indice, true);
    }
    function principal()
    {
        $this->view->resultado = $this->todos();
        //$this->view->renderizar();
    }
    function otro()
    {
        echo "desde otro";
        echo var_dump($this->modelo->status());
    }
    function todos()
    {
        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $noControl = $_POST["No_control"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $this->view->resultado = $this->modelo->todos(array("fecha" => $fecha, "Id_lugar" => $lugar, "no_control" => $noControl, "fecha_fin" => $fecha_fin, "hora_salida"=>$hora_salida));
       
        $this->view->renderizar();
    }
    function conteo(){
        $fecha = $_POST["fecha"] ?? "";
        $Id_lugar = $_POST["Id_lugar"] ?? "";
        $noControl = $_POST["no_control"] ?? "";
        $fecha_fin = $_POST["fecha_fin"] ?? "";
        $hora_salida = $_POST["hora_salida"]??"";
        $this->view->resultado = $this->modelo->conteo(array("fecha" => $fecha, "Id_lugar" => $Id_lugar, "no_control" => $noControl, "fecha_fin" => $fecha_fin, "hora_salida"=>$hora_salida));
        $this->view->renderizar();
    }
    function dias_laboratorio(){
        
    }
    function registrarEntrada()
    {
        $json_respuesta = array();
        $requerido = $this->parametros_necesarios(array("nombre", "lugar", "no_control", "carrera"), $_POST);
        if ($requerido) {
            $this->view->resultado = $requerido;
            $this->view->renderizar();
            exit;
        }
        $no_control = $_POST["no_control"];
        $lugar = $_POST["lugar"];
        $nombre = $_POST["nombre"];
        $carrera= $_POST["carrera"];
        $json_respuesta = $this->modelo->registrarEntrada($lugar, $no_control, $nombre, $carrera);
        $this->view->resultado = $json_respuesta;
        $this->view->renderizar();
    }
    function borrar()
    {
        $fecha = $_POST["fecha"] ?? "";
        $lugar = $_POST["lugar"] ?? "";
        $noControl = $_POST["noControl"] ?? "";
        $fecha_fin = $_POST["fecha_fin"] ?? "";
        $this->view->resultado = $this->modelo->borrar(array("fecha" => $fecha, "lugar" => $lugar, "no_control" => $noControl, "fecha_fin" => $fecha_fin));
        $this->view->renderizar();
    }

    function entradaAumatica()
    {
        $json_respuesta = array();
        $requerido = $this->parametros_necesarios(array("nombre", "lugar", "no_control", "carrera"), $_POST);
        if ($requerido) {
            $this->view->resultado = $requerido;
            $this->view->renderizar();
            exit;
        }
        $no_control = $_POST["no_control"];
        $lugar = $_POST["lugar"];
        $nombre = $_POST["nombre"];
        $carrera= $_POST["carrera"];
        $json_respuesta = $this->modelo->entradaAumatica($lugar, $no_control, $nombre, $carrera);
        $this->view->resultado = $json_respuesta;
        $this->view->renderizar();
    }
    function registrarSalida()
    {
        $requerido=$this->parametros_necesarios(array("No_control"), $_POST);
        if($requerido){
            $this->view->resultado = $requerido;
            $this->view->renderizar();
            exit;
        }
        $no_control = $_POST["No_control"];
        $resultado = $this->modelo->registrarSalida($no_control);
        $this->view->resultado = $resultado;
        $this->view->renderizar();
    }
    function info($indice)
    {
        $no_control = $indice;
        $resultado = $this->modelo->info($no_control);
        $this->view->resultado = $resultado;
        $this->view->renderizar();
    }
    function sinSalida(){
        $resultado = $this->modelo->sinSalida();
        $this->view->resultado = $resultado;
        $this->view->renderizar();
    }
    function resumenLugares(){
        $resultado=$this->modelo->resumenLugares();
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }

    function prueba(){
        $nombre_archivo="prueba.csv";
        $creacion=$this->crear_archivo($nombre_archivo);
        //consultamos informacion a la base de datos
        $consulta=$_POST["consulta"];
        $contenido=$this->modelo->prueba($consulta)["contenido"];
        echo $creacion;
        $this->crear_csv($creacion, $contenido);
        fclose($creacion);
        if(!is_string($creacion)){
            $this->descargar_archivo($nombre_archivo);
            exit();       
        }
        $this->respuesta_formateada(false, $creacion, "creacion archivo", "0");
      /*  $consulta=$_POST["consulta"];
        $resultado=$this->modelo->prueba($consulta)["contenido"];
        echo var_dump(array_keys($resultado[0]));
        $archivo=fopen("public/archivos/data.csv", "w");
        foreach($resultado as $key=>$contenido){
           fputcsv($archivo, $contenido);
        }
        fclose($archivo);
       // $this->view->resultado=$resultado;
        $this->view->renderizar();*/
    }
    function diasAlumno($no_control=""){
        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $noControl = $_POST["No_control"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $no_control_d = $no_control;

        $resultado=$this->modelo->diasAlumno(array("fecha" => $fecha, "Id_lugar" => $lugar, "no_control" => $no_control_d, "fecha_fin" => $fecha_fin, "hora_salida"=>$hora_salida));
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
    function conteoPorSemana($no_control=""){
        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $carrera = $_POST["Id_carrera"] ?? "";
        $noControl = $_POST["No_control"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $no_control_d = $no_control;


        $resultado=$this->modelo->conteoPorSemana(array("fecha" => $fecha, "Id_carrera" => $carrera, "Id_lugar" => $lugar, "no_control" => $no_control_d, "fecha_fin" => $fecha_fin, "hora_salida"=>$hora_salida));
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
    function conteoEntradas($no_control=""){
        
        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $posicion_limite=$_POST["Posicion_limite"]??0;
        $numero_registros=$_POST["Numero_registros"]??"";
        $no_control_d = $no_control;


        $entradas_necesarias=array(
        "fecha" => $fecha,
        "Id_lugar" => $lugar,
        "no_control" => $no_control_d,
        "Posicion_limite" => $posicion_limite,
        "Numero_registros" => $numero_registros,
        "fecha_fin" => $fecha_fin,
        "hora_salida"=>$hora_salida);
        $resultado=$this->modelo->conteoEntradas($entradas_necesarias);
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
    function conteoSalidas($no_control=""){
        
        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $posicion_limite=$_POST["Posicion_limite"]??0;
        $numero_registros=$_POST["Numero_registros"]??"";
        $no_control_d = $no_control;


        $entradas_necesarias=array(
        "fecha" => $fecha,
        "Id_lugar" => $lugar,
        "no_control" => $no_control_d,
        "Posicion_limite" => $posicion_limite,
        "Numero_registros" => $numero_registros,
        "fecha_fin" => $fecha_fin,
        "hora_salida"=>$hora_salida);
        $resultado=$this->modelo->conteoSalidas($entradas_necesarias);
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
    function minutosPorEntrada($no_control=""){//no_control por url

        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $posicion_limite=$_POST["Posicion_limite"]??0;
        $numero_registros=$_POST["Numero_registros"]??"";
        $no_control_d = $no_control;
        $entradas_necesarias=array(
        "fecha" => $fecha,
        "Id_lugar" => $lugar,
        "no_control" => $no_control_d,
        "Posicion_limite" => $posicion_limite,
        "Numero_registros" => $numero_registros,
        "fecha_fin" => $fecha_fin,
        "hora_salida"=>$hora_salida);
        $resultado=$this->modelo->minutosPorEntrada($entradas_necesarias);
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
    function conteoHora($no_control=""){
        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $hora_salida = $_POST["Hora_salida"]??"";
        $no_control_d = $no_control;


        $entradas_necesarias=array(
        "fecha" => $fecha,
        "Id_lugar" => $lugar,
        "no_control" => $no_control_d,
        "fecha_fin" => $fecha_fin,
        "hora_salida"=>$hora_salida);
        $resultado=$this->modelo->conteoHora($entradas_necesarias);
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
    function entradasPorLugar($no_control=""){
        $fecha = $_POST["Fecha"] ?? "";
        $lugar = $_POST["Id_lugar"] ?? "";
        $fecha_fin = $_POST["Fecha_fin"] ?? "";
        $no_control_d = $no_control;
        $entradas_necesarias=array(
        "fecha" => $fecha,
        "Id_lugar" => $lugar,
        "no_control" => $no_control_d,
        "fecha_fin" => $fecha_fin);
        $resultado=$this->modelo->entradasPorLugar($entradas_necesarias);
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
    function descargarconsulta(){
        $datos=array();
        foreach($_POST as $key=>$contenido){
            $datos[$key]=json_decode($contenido);
        }
        $resultado=$this->modelo->descargarconsulta($datos);
        $this->view->resultado=$resultado;
        $this->view->renderizar();
    }
}
