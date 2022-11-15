<?php
class Controller
{
    private $ruta_publica;
    private $id_usuario;
    function __construct($nombre, $datos_usuario = array(), $metodo, $clase, $indice = "", $carga_de_modelo = false)
    {
        $this->view = new View($nombre);
        $this->nombre = $nombre;

        // cada usuario tiene su carpeta, creada apartir de la ruta publica su id de usuario
        // y su nombre de usuario
        $this->usuario = $datos_usuario["usuario"];
        $this->id_usuario = $datos_usuario["id_usuario"];
        $this->ruta_publica = constant("RUTA_PUBLICA");
        $this->ruta_usuario = $this->ruta_publica . $this->usuario . $this->id_usuario;


        //decidir si cargar modelo para consultas a la base de datos
        if ($carga_de_modelo) {
            $this->cargar_modelo();
        }
        if (!$this->ejecuto_el_metodo($clase, $metodo, $indice)) {
            $clase->principal();
        }
        exit();
    }
    private function ejecuto_el_metodo($clase, $metodo, $indice = "")
    {
        $existe_el_metodo = method_exists($clase, $metodo);
        if ($existe_el_metodo) {
            $clase->$metodo($indice);
            return $existe_el_metodo;
        }
        return $existe_el_metodo;
    }
    function cargar_modelo($nombre_modelo = "")
    {
        $nombre_modelo = "Modelo_" . ($nombre_modelo == "" ? $this->nombre : $nombre_modelo);

        // cargamos el archivo con el modelo para poder crear la clase
        include_once "Models/$nombre_modelo.php";
        $this->modelo = new $nombre_modelo();
    }
    function parametros_necesarios($array_parametros, $array_busqueda)
    {
        $msg = "";
        foreach ($array_parametros as $parametro) {
            if (!isset($array_busqueda[$parametro])) {
                $msg .= " $parametro no encontrado, es necesario ";
                continue;
            }
            if ($array_busqueda[$parametro] == "") {
                $msg .= " $parametro no puede estar vacío ";
                continue;
            }
            if ($array_busqueda[$parametro] == "undefined") {
                $msg .= " $parametro no puede ser undefined ";
                continue;
            }
        }

        if ($msg != "") {
            $json_respuesta["respuesta"] = false;
            $json_respuesta["codigo"] = $msg;
            return $json_respuesta;
        }
        return false;
    }
    function crear_archivo($nombre_archivo)
    {
        $archivo = null;
        if (!file_exists($this->ruta_usuario)) {
            try {
                mkdir($this->ruta_usuario);
            } catch (Error $e) {
                return "No se pudo crear la carpeta del usuario";
            }
        }
        $ruta_completa = $this->ruta_usuario . "/" . $nombre_archivo;
        try {
            $archivo = fopen($ruta_completa, "w");
        } catch (Error $e) {
            return "No se pudo crear el archivo";
        }
        return $archivo;
    }
    function descargar_archivo($nombre_archivo)
    {
        $ruta_completa = $this->ruta_usuario . "/" . $nombre_archivo;
        if (file_exists($ruta_completa)) {
            header('Content-Description: File Transfer');
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename=' . basename($ruta_completa));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($ruta_completa));
            ob_clean();
            flush();
            readfile($ruta_completa);
            exit;
        } else {
            echo 'Archivo no disponible.';
        }
    }
    function respuesta_formateada($respuesta = "", $codigo = "", $tipo_consulta = "", $registros_afectados, $contenido = array())
    {
       return array("respuesta" => $respuesta, "codigo" => $codigo, "contenido" => $contenido, "tipo_consulta" => $tipo_consulta, "registros_afectados" => $registros_afectados);
    }
    function crear_csv($archivo, $contenido)
    {
        try {
            foreach ($contenido as $key => $contenido) {
                fputcsv($archivo, $contenido);
            }
            return true;
        } catch (Error $e) {
            return false;
        }
    }
}
