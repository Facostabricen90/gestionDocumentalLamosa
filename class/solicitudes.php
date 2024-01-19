<?php

require_once('basedatos.php');

class solicitudes extends basedatos {

    private $Sol_Codigo;
    private $Usu_Codigo;
    private $Area_Codigo;
    private $Sol_CodigoRadicado;
    private $Sol_CodigoDocumento;
    private $Sol_NombreDocumento;
    private $Sol_HistorialVersion;
    private $Sol_Formato;
    private $Sol_TipoDocumento;
    private $Sol_Tipo;
    private $Sol_Fecha;
    private $Sol_Hora;
    private $Sol_Tema;
    private $Sol_Observaciones;
    private $Sol_EstadoActual;
    private $Sol_PasoActual;
    private $Sol_Estado;
    private $Sol_AprobacionSolicitud;
    private $Sol_AccionDocumento;
    private $Sol_PDF;
    private $Sol_TipoFlujo;
    private $Sol_AjustePasos;
    private $Sol_FechaPublicacion;
    private $Sol_Archivo;

    function __construct($Sol_Codigo = NULL, $Usu_Codigo = NULL, $Area_Codigo = NULL, $Sol_CodigoRadicado = NULL, $Sol_CodigoDocumento = NULL, $Sol_NombreDocumento = NULL, $Sol_HistorialVersion = NULL, $Sol_Formato = NULL, $Sol_TipoDocumento = NULL, $Sol_Tipo = NULL, $Sol_Fecha = NULL, $Sol_Hora = NULL, $Sol_Tema = NULL, $Sol_Observaciones = NULL, $Sol_EstadoActual = NULL, $Sol_PasoActual = NULL, $Sol_Estado = NULL, $Sol_AprobacionSolicitud = NULL, $Sol_AccionDocumento = NULL, $Sol_PDF = NULL, $Sol_TipoFlujo = NULL, $Sol_AjustePasos = NULL, $Sol_FechaPublicacion = NULL, $Sol_Archivo = NULL) {
        $this->Sol_Codigo = $Sol_Codigo;
        $this->Usu_Codigo = $Usu_Codigo;
        $this->Area_Codigo = $Area_Codigo;
        $this->Sol_CodigoRadicado = $Sol_CodigoRadicado;
        $this->Sol_CodigoDocumento = $Sol_CodigoDocumento;
        $this->Sol_NombreDocumento = $Sol_NombreDocumento;
        $this->Sol_HistorialVersion = $Sol_HistorialVersion;
        $this->Sol_Formato = $Sol_Formato;
        $this->Sol_TipoDocumento = $Sol_TipoDocumento;
        $this->Sol_Tipo = $Sol_Tipo;
        $this->Sol_Fecha = $Sol_Fecha;
        $this->Sol_Hora = $Sol_Hora;
        $this->Sol_Tema = $Sol_Tema;
        $this->Sol_Observaciones = $Sol_Observaciones;
        $this->Sol_EstadoActual = $Sol_EstadoActual;
        $this->Sol_PasoActual = $Sol_PasoActual;
        $this->Sol_Estado = $Sol_Estado;
        $this->Sol_AprobacionSolicitud = $Sol_AprobacionSolicitud;
        $this->Sol_AccionDocumento = $Sol_AccionDocumento;
        $this->Sol_PDF = $Sol_PDF;
        $this->Sol_TipoFlujo = $Sol_TipoFlujo;
        $this->Sol_AjustePasos = $Sol_AjustePasos;
        $this->Sol_FechaPublicacion = $Sol_FechaPublicacion;
        $this->Sol_Archivo = $Sol_Archivo;
        $this->tabla = "solicitudes";
    }

    function getSol_Codigo() {
        return $this->Sol_Codigo;
    }

    function getUsu_Codigo() {
        return $this->Usu_Codigo;
    }

    function getArea_Codigo() {
        return $this->Area_Codigo;
    }

    function getSol_CodigoRadicado() {
        return $this->Sol_CodigoRadicado;
    }

    function getSol_CodigoDocumento() {
        return $this->Sol_CodigoDocumento;
    }

    function getSol_NombreDocumento() {
        return $this->Sol_NombreDocumento;
    }

    function getSol_HistorialVersion() {
        return $this->Sol_HistorialVersion;
    }

    function getSol_Formato() {
        return $this->Sol_Formato;
    }

    function getSol_TipoDocumento() {
        return $this->Sol_TipoDocumento;
    }

    function getSol_Tipo() {
        return $this->Sol_Tipo;
    }

    function getSol_Fecha() {
        return $this->Sol_Fecha;
    }

    function getSol_Hora() {
        return $this->Sol_Hora;
    }

    function getSol_Tema() {
        return $this->Sol_Tema;
    }

    function getSol_Observaciones() {
        return $this->Sol_Observaciones;
    }

    function getSol_EstadoActual() {
        return $this->Sol_EstadoActual;
    }

    function getSol_PasoActual() {
        return $this->Sol_PasoActual;
    }

    function getSol_Estado() {
        return $this->Sol_Estado;
    }

    function getSol_AprobacionSolicitud() {
        return $this->Sol_AprobacionSolicitud;
    }

    function getSol_AccionDocumento() {
        return $this->Sol_AccionDocumento;
    }

    function getSol_PDF() {
        return $this->Sol_PDF;
    }

    function getSol_TipoFlujo() {
        return $this->Sol_TipoFlujo;
    }

    function getSol_AjustePasos() {
        return $this->Sol_AjustePasos;
    }

    function getSol_FechaPublicacion() {
        return $this->Sol_FechaPublicacion;
    }

    function getSol_Archivo() {
        return $this->Sol_Archivo;
    }

    function setSol_Codigo($Sol_Codigo) {
        $this->Sol_Codigo = $Sol_Codigo;
    }

    function setUsu_Codigo($Usu_Codigo) {
        $this->Usu_Codigo = $Usu_Codigo;
    }

    function setArea_Codigo($Area_Codigo) {
        $this->Area_Codigo = $Area_Codigo;
    }

    function setSol_CodigoRadicado($Sol_CodigoRadicado) {
        $this->Sol_CodigoRadicado = $Sol_CodigoRadicado;
    }

    function setSol_CodigoDocumento($Sol_CodigoDocumento) {
        $this->Sol_CodigoDocumento = $Sol_CodigoDocumento;
    }

    function setSol_NombreDocumento($Sol_NombreDocumento) {
        $this->Sol_NombreDocumento = $Sol_NombreDocumento;
    }

    function setSol_HistorialVersion($Sol_HistorialVersion) {
        $this->Sol_HistorialVersion = $Sol_HistorialVersion;
    }

    function setSol_Formato($Sol_Formato) {
        $this->Sol_Formato = $Sol_Formato;
    }

    function setSol_TipoDocumento($Sol_TipoDocumento) {
        $this->Sol_TipoDocumento = $Sol_TipoDocumento;
    }

    function setSol_Tipo($Sol_Tipo) {
        $this->Sol_Tipo = $Sol_Tipo;
    }

    function setSol_Fecha($Sol_Fecha) {
        $this->Sol_Fecha = $Sol_Fecha;
    }

    function setSol_Hora($Sol_Hora) {
        $this->Sol_Hora = $Sol_Hora;
    }

    function setSol_Tema($Sol_Tema) {
        $this->Sol_Tema = $Sol_Tema;
    }

    function setSol_Observaciones($Sol_Observaciones) {
        $this->Sol_Observaciones = $Sol_Observaciones;
    }

    function setSol_EstadoActual($Sol_EstadoActual) {
        $this->Sol_EstadoActual = $Sol_EstadoActual;
    }

    function setSol_PasoActual($Sol_PasoActual) {
        $this->Sol_PasoActual = $Sol_PasoActual;
    }

    function setSol_Estado($Sol_Estado) {
        $this->Sol_Estado = $Sol_Estado;
    }

    function setSol_AprobacionSolicitud($Sol_AprobacionSolicitud) {
        $this->Sol_AprobacionSolicitud = $Sol_AprobacionSolicitud;
    }

    function setSol_AccionDocumento($Sol_AccionDocumento) {
        $this->Sol_AccionDocumento = $Sol_AccionDocumento;
    }

    function setSol_PDF($Sol_PDF) {
        $this->Sol_PDF = $Sol_PDF;
    }

    function setSol_TipoFlujo($Sol_TipoFlujo) {
        $this->Sol_TipoFlujo = $Sol_TipoFlujo;
    }

    function setSol_AjustePasos($Sol_AjustePasos) {
        $this->Sol_AjustePasos = $Sol_AjustePasos;
    }

    function setSol_FechaPublicacion($Sol_FechaPublicacion) {
        $this->Sol_FechaPublicacion = $Sol_FechaPublicacion;
    }

    function setSol_Archivo($Sol_Archivo) {
        $this->Sol_Archivo = $Sol_Archivo;
    }

    public function insertar() {
        $campos = array("Usu_Codigo", "Area_Codigo", "Sol_CodigoRadicado", "Sol_CodigoDocumento", "Sol_NombreDocumento", "Sol_HistorialVersion", "Sol_Formato", "Sol_TipoDocumento", "Sol_Tipo", "Sol_Fecha", "Sol_Hora", "Sol_Tema", "Sol_Observaciones", "Sol_EstadoActual", "Sol_PasoActual", "Sol_Estado", "Sol_AprobacionSolicitud", "Sol_AccionDocumento", "Sol_PDF", "Sol_TipoFlujo", "Sol_AjustePasos", "Sol_FechaPublicacion", "Sol_Archivo");
        $valores = array(
            array(
                $this->Usu_Codigo,
                $this->Area_Codigo,
                $this->Sol_CodigoRadicado,
                $this->Sol_CodigoDocumento,
                $this->Sol_NombreDocumento,
                $this->Sol_HistorialVersion,
                $this->Sol_Formato,
                $this->Sol_TipoDocumento,
                $this->Sol_Tipo,
                $this->Sol_Fecha,
                $this->Sol_Hora,
                $this->Sol_Tema,
                $this->Sol_Observaciones,
                $this->Sol_EstadoActual,
                $this->Sol_PasoActual,
                $this->Sol_Estado,
                $this->Sol_AprobacionSolicitud,
                $this->Sol_AccionDocumento,
                $this->Sol_PDF,
                $this->Sol_TipoFlujo,
                $this->Sol_AjustePasos,
                $this->Sol_FechaPublicacion,
                $this->Sol_Archivo
            )
        );

        $resultado = $this->insertarRegistros($campos, $valores);
        $this->desconectar();

        if ($resultado[0] == "OK") {
            return true;
        } else {
            return false;
        }
    }

    public function consultar() {
        $sql = "SELECT * FROM solicitudes WHERE Sol_Codigo = :cod";
        $parametros = array(":cod" => $this->Sol_Codigo);
        if ($this->consultaSQL($sql, $parametros)) {
            $res = $this->cargarRegistro();

            $this->setUsu_Codigo($res[1]);
            $this->setArea_Codigo($res[2]);
            $this->setSol_CodigoRadicado($res[3]);
            $this->setSol_CodigoDocumento($res[4]);
            $this->setSol_NombreDocumento($res[5]);
            $this->setSol_HistorialVersion($res[6]);
            $this->setSol_Formato($res[7]);
            $this->setSol_TipoDocumento($res[8]);
            $this->setSol_Tipo($res[9]);
            $this->setSol_Fecha($res[10]);
            $this->setSol_Hora($res[11]);
            $this->setSol_Tema($res[12]);
            $this->setSol_Observaciones($res[13]);
            $this->setSol_EstadoActual($res[14]);
            $this->setSol_PasoActual($res[15]);
            $this->setSol_Estado($res[16]);
            $this->setSol_AprobacionSolicitud($res[17]);
            $this->setSol_AccionDocumento($res[18]);
            $this->setSol_PDF($res[19]);
            $this->setSol_TipoFlujo($res[20]);
            $this->setSol_AjustePasos($res[21]);
            $this->setSol_FechaPublicacion($res[22]);
            $this->setSol_Archivo($res[23]);

            $this->desconectar();
        }
    }

    public function actualizar() {
        $campos = array("Usu_Codigo", "Area_Codigo", "Sol_CodigoRadicado", "Sol_CodigoDocumento", "Sol_NombreDocumento", "Sol_HistorialVersion", "Sol_Formato", "Sol_TipoDocumento", "Sol_Tipo", "Sol_Fecha", "Sol_Hora", "Sol_Tema", "Sol_Observaciones", "Sol_EstadoActual", "Sol_PasoActual", "Sol_Estado", "Sol_AprobacionSolicitud", "Sol_AccionDocumento", "Sol_PDF", "Sol_TipoFlujo", "Sol_AjustePasos", "Sol_FechaPublicacion", "Sol_Archivo");
        $valores = array($this->getUsu_Codigo(), $this->getArea_Codigo(), $this->getSol_CodigoRadicado(), $this->getSol_CodigoDocumento(), $this->getSol_NombreDocumento(), $this->getSol_HistorialVersion(), $this->getSol_Formato(), $this->getSol_TipoDocumento(), $this->getSol_Tipo(), $this->getSol_Fecha(), $this->getSol_Hora(), $this->getSol_Tema(), $this->getSol_Observaciones(), $this->getSol_EstadoActual(), $this->getSol_PasoActual(), $this->getSol_Estado(), $this->getSol_AprobacionSolicitud(), $this->getSol_AccionDocumento(), $this->getSol_PDF(), $this->getSol_TipoFlujo(), $this->getSol_AjustePasos(), $this->getSol_FechaPublicacion(), $this->getSol_Archivo());
        $llaveprimaria = "Sol_Codigo";
        $valorllaveprimaria = $this->getSol_Codigo();
        $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
        $this->desconectar();
        return $res;
    }

    public function eliminar() {
        $sql = "DELETE FROM solicitudes WHERE Sol_Codigo = :cod";
        $parametros = array(":cod" => $this->Sol_Codigo);
        $res = $this->consultaSQL($sql, $parametros);
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function codigoSolicitudCreadaUsuario($usuario) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT Sol_Codigo
FROM solicitudes
WHERE Sol_Estado = 1 AND Usu_Codigo = :usu
ORDER BY Sol_Codigo DESC LIMIT 1";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesPrinpal($fechaInicial, $fechaFinal, $estado, $area, $tipo, $usuario, $planta, $busqueda, $admin) {

        $parametros = array();

        $sql = "SELECT DISTINCT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
FROM solicitudes
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo
left JOIN plantas p ON p.Pla_Codigo = solicitudes.Sol_Tipo
WHERE Sol_Estado = 1 
AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2)";

        if ($busqueda == '') {
            if ($estado != "-1") {
                $sql .= " AND Sol_PasoActual = :est ";
                $parametros[':est'] = $estado;
            }

            if ($area != "-1") {
                $sql .= " AND areas.Area_Nombre = :are ";
                $parametros[':are'] = $area;
            }

            if ($admin != "Administrador") {
                $sql .= " AND usuarios.Pla_Codigo IN (SELECT usuarios_plantas.Pla_Codigo FROM usuarios_plantas WHERE usuarios_plantas.Usu_Codigo = :usu)";
                $parametros[':usu'] = $usuario;
            }

            if ($tipo != "-1") {
                $sql .= " AND Sol_TipoDocumento = :tip ";
                $parametros[':tip'] = $tipo;
            }
            if (($fechaInicial != "") && ($fechaFinal != "")) {
                $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

                $parametros[':fecini'] = $fechaInicial;
                $parametros[':fecfin'] = $fechaFinal;
            }

            if ($planta != NULL) {
                $priMar = 1;
                foreach ($planta as $registro2) {
                    if ($priMar == 1) {
                        $sql .= " AND p.Pla_Codigo IN (";
                    } else {
                        $sql .= " , ";
                    }
                    $sql .= " :pla" . $priMar;
                    $parametros[':pla' . $priMar] = $registro2;
                    $priMar++;
                }
                $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
            }
        } else {
            $sql .= " AND Sol_NombreDocumento like :bus or Sol_CodigoRadicado like :bus or Area_Nombre like :bus or Sol_TipoDocumento like :bus or Sol_CodigoDocumento like :bus or Sol_Tema like :bus";
            $parametros[':bus'] = "%" . $busqueda . "%";
        }
        $sql .= " ORDER BY Sol_Codigo DESC";

        //echo $sql;
        //var_dump($parametros);
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesMMPrinpal($fechaInicial, $fechaFinal, $estado, $area, $usuario, $planta) {

        $parametros = array(":fecini" => $fechaInicial, ":fecfin" => $fechaFinal, ":usu" => $usuario);

        $sql = "SELECT DISTINCT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
FROM solicitudes
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo
INNER JOIN plantas p ON p.Pla_Codigo = usuarios.Pla_Codigo
WHERE Sol_Estado = 1 AND Sol_Fecha BETWEEN :fecini AND :fecfin AND Sol_TipoFlujo = 3 
AND usuarios.Pla_Codigo IN (SELECT usuarios_plantas.Pla_Codigo FROM usuarios_plantas WHERE usuarios_plantas.Usu_Codigo = :usu) ";

        if ($estado != "-1") {
            $sql .= " AND Sol_PasoActual = :est ";
            $parametros[':est'] = $estado;
        }

        if ($area != "-1") {
            $sql .= " AND areas.Area_Nombre = :are ";
            $parametros[':are'] = $area;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }

        $sql .= " ORDER BY Sol_Codigo DESC";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesFiltroPublicadoInforme($area, $tipo, $usuario, $planta = NULL) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT DISTINCT Sol_Codigo, Sol_TipoDocumento, Sol_CodigoDocumento, 
solicitudes.Area_Codigo, Sol_HistorialVersion, areas.Area_Nombre
FROM solicitudes 
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo 
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo 
INNER JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo 
INNER JOIN plantas p ON p.Pla_Codigo = usuarios.Pla_Codigo 
WHERE Sol_Estado = 1 AND Sol_EstadoActual = 'Publicado' 
AND areas.Area_Estado = 1 
AND Sol_Archivo IS NULL 
AND usuarios.Pla_Codigo 
IN (SELECT usuarios_plantas.Pla_Codigo 
    FROM usuarios_plantas 
    WHERE usuarios_plantas.Usu_Codigo = 2) 
AND Sol_TipoDocumento 
NOT IN (SELECT Par_Nombre 
        FROM parametros 
        WHERE (UPPER(Par_Nombre) LIKE '%LATAM%' 
        OR UPPER(Par_Nombre) LIKE '%CORPORATIVO%') ) ";

        if ($area != "-1") {
            $sql .= " AND solicitudes.Area_Codigo = :are";
            $parametros[':are'] = $area;
        }
        if ($tipo != "-1") {
            $sql .= " AND solicitudes.Sol_TipoDocumento = :tip";
            $parametros[':tip'] = $tipo;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " ORDER BY Sol_CodigoRadicado DESC";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesFiltroPublicado($area, $tipo, $usuario, $planta = NULL) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT DISTINCT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, Sol_TipoFlujo, CONCAT_WS(' - ',Pla_Marca,Pla_Nombre)
FROM solicitudes
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo
INNER JOIN plantas p ON p.Pla_Codigo = usuarios.Pla_Codigo
WHERE Sol_Estado = 1 AND Sol_EstadoActual = 'Publicado' AND areas.Area_Estado = 1 AND Sol_Archivo IS NULL
AND usuarios.Pla_Codigo IN (SELECT usuarios_plantas.Pla_Codigo FROM usuarios_plantas WHERE usuarios_plantas.Usu_Codigo = :usu) ";

        if ($area != "-1") {
            $sql .= " AND solicitudes.Area_Nombre = :are";
            $parametros[':are'] = $area;
        }
        if ($tipo != "-1") {
            $sql .= " AND solicitudes.Sol_TipoDocumento = :tip";
            $parametros[':tip'] = $tipo;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " ORDER BY Sol_CodigoRadicado DESC";

        /* if ($_SESSION['GD_Usuario'] == "2") {
          echo "---listarConsolidadoDocumentosCicloEncataogo---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public function listarSolicitudesFiltroPublicadocater($area, $tipo, $usuario, $planta = NULL) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT DISTINCT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, Sol_TipoFlujo, CONCAT_WS(' - ',Pla_Marca,Pla_Nombre)
FROM solicitudes
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo
INNER JOIN plantas p ON p.Pla_Codigo = usuarios.Pla_Codigo
WHERE Sol_Estado = 1 AND Sol_EstadoActual = 'Publicado' AND areas.Area_Estado = 1 AND Sol_Archivo IS NULL
AND usuarios.Pla_Codigo IN (SELECT usuarios_plantas.Pla_Codigo FROM usuarios_plantas WHERE usuarios_plantas.Usu_Codigo = :usu) ";

        if ($area != "-1") {
            $sql .= " AND areas.Area_Nombre = :are";
            $parametros[':are'] = $area;
        }
        if ($tipo != "-1") {
            $sql .= " AND solicitudes.Sol_TipoDocumento = :tip";
            $parametros[':tip'] = $tipo;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " ORDER BY Sol_CodigoRadicado DESC";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesFiltroPublicadoUltimaVersion($area, $tipo, $usuario, $planta = NULL) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT Sol_CodigoDocumento, MAX(Sol_HistorialVersion) AS Ver
FROM solicitudes
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN plantas p ON p.Pla_Codigo = usuarios.Pla_Codigo
WHERE Sol_Estado = 1 AND Sol_EstadoActual = 'Publicado' AND areas.Area_Estado = 1 AND Sol_Archivo IS NULL
AND usuarios.Pla_Codigo IN (SELECT usuarios_plantas.Pla_Codigo FROM usuarios_plantas WHERE usuarios_plantas.Usu_Codigo = :usu) ";

        if ($area != "-1") {
            $sql .= " AND solicitudes.Area_Codigo = :are";
            $parametros[':are'] = $area;
        }
        if ($tipo != "-1") {
            $sql .= " AND solicitudes.Sol_TipoDocumento = :tip";
            $parametros[':tip'] = $tipo;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " GROUP BY Sol_CodigoDocumento ORDER BY Sol_CodigoRadicado DESC";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public function listarSolicitudesFiltroPublicadoUltimaVersioncater($area, $tipo, $usuario, $planta = NULL) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT Sol_CodigoDocumento, MAX(Sol_HistorialVersion) AS Ver
FROM solicitudes
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN plantas p ON p.Pla_Codigo = usuarios.Pla_Codigo
WHERE Sol_Estado = 1 AND Sol_EstadoActual = 'Publicado' AND areas.Area_Estado = 1 AND Sol_Archivo IS NULL
AND usuarios.Pla_Codigo IN (SELECT usuarios_plantas.Pla_Codigo FROM usuarios_plantas WHERE usuarios_plantas.Usu_Codigo = :usu) ";

        if ($area != "-1") {
            $sql .= " AND areas.Area_Nombre = :are";
            $parametros[':are'] = $area;
        }
        if ($tipo != "-1") {
            $sql .= " AND solicitudes.Sol_TipoDocumento = :tip";
            $parametros[':tip'] = $tipo;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " GROUP BY Sol_CodigoDocumento ORDER BY Sol_CodigoRadicado DESC";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesFiltroPublicadoUltimaVersionInforme($area, $tipo, $usuario, $planta = NULL) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT Sol_CodigoDocumento, MAX(Sol_HistorialVersion) AS Ver, solicitudes.Area_Codigo, areas.Area_Nombre 
FROM solicitudes 
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo 
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo 
INNER JOIN plantas p ON p.Pla_Codigo = usuarios.Pla_Codigo 
WHERE Sol_Estado = 1 AND Sol_EstadoActual = 'Publicado' 
AND areas.Area_Estado = 1 
AND Sol_Archivo IS NULL 
AND usuarios.Pla_Codigo 
IN (SELECT usuarios_plantas.Pla_Codigo 
    FROM usuarios_plantas 
    WHERE usuarios_plantas.Usu_Codigo = 2) 
AND Sol_TipoDocumento 
NOT IN (SELECT Par_Nombre 
        FROM parametros 
        WHERE (UPPER(Par_Nombre) LIKE '%LATAM%' 
        OR UPPER(Par_Nombre) LIKE '%CORPORATIVO%') )";

        if ($area != "-1") {
            $sql .= " AND solicitudes.Area_Codigo = :are";
            $parametros[':are'] = $area;
        }
        if ($tipo != "-1") {
            $sql .= " AND solicitudes.Sol_TipoDocumento = :tip";
            $parametros[':tip'] = $tipo;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " GROUP BY Sol_CodigoDocumento, solicitudes.Area_Codigo ORDER BY Sol_CodigoRadicado DESC";
        /* if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Resultado click Button---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarCodigoVersionValidar($codigo, $version) {

        $parametros = array(":cod" => $codigo, ":ver" => $version);

        $sql = "SELECT COUNT(Sol_Codigo) AS Cant
FROM solicitudes
WHERE Sol_CodigoDocumento = :cod AND Sol_HistorialVersion = :ver";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function HallarVersionSiguenteCodigo($codigo) {

        $parametros = array(":cod" => $codigo);

        $sql = "SELECT MAX(Sol_HistorialVersion) AS Ver
FROM solicitudes
WHERE Sol_CodigoDocumento = :cod AND Sol_Estado = 1";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarCodigosAntiguos($codigo, $usuario) {

        $parametros = array(":cod" => '%' . $codigo . '%', ":usu" => $usuario);

        $sql = "SELECT Sol_CodigoDocumento, Sol_NombreDocumento, Sol_HistorialVersion, CONCAT_WS('. ', Sol_PasoActual, Sol_EstadoActual)
FROM solicitudes
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
WHERE Sol_CodigoDocumento LIKE :cod  and solicitudes.Sol_Estado = 1
AND usuarios.Pla_Codigo IN (SELECT usuarios_plantas.Pla_Codigo FROM usuarios_plantas WHERE usuarios_plantas.Usu_Codigo = :usu)
ORDER BY Sol_HistorialVersion desc, Sol_CodigoDocumento DESC";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarConsolidadoDocumentos() {

        //$parametros = array(":aca"=>$notaria);

        $sql = "SELECT areas.Area_Codigo, Sol_TipoDocumento ,COUNT(Sol_TipoDocumento)
FROM solicitudes
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
WHERE Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2) AND Sol_EstadoActual = 'Publicado'
GROUP BY Area_Nombre, Sol_TipoDocumento
ORDER BY Area_Nombre ASC, Sol_TipoDocumento ASC ";

        $this->consultaSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarConsolidadoDocumentosCiclo($fechaInicial, $fechaFinal, $planta = NULL) {

//    $parametros = array(":aca"=>$notaria);
        $parametros = array();
        $sql = "SELECT DISTINCT areas.Area_Codigo, Sol_TipoDocumento ,COUNT(Sol_TipoDocumento),areas.Area_Nombre
FROM solicitudes
left JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
left JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
left JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo
left JOIN plantas p ON p.Pla_Codigo = solicitudes.Sol_Tipo
where Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2) AND Sol_EstadoActual != 'Publicado'";
        if (($fechaInicial != "") && ($fechaFinal != "")) {
            $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

            $parametros[':fecini'] = $fechaInicial;
            $parametros[':fecfin'] = $fechaFinal;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " GROUP BY Area_Nombre, Sol_TipoDocumento
ORDER BY Area_Nombre ASC, Sol_TipoDocumento ASC ";

        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---listarConsolidadoDocumentosCiclo---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarConsolidadoDocumentosFlujo($fechaInicial, $fechaFinal, $planta = NULL) {

//    $parametros = array(":aca"=>$notaria);
        $parametros = array();
        $sql = "SELECT DISTINCT areas.Area_Codigo, Sol_EstadoActual,  COUNT(Sol_EstadoActual),areas.Area_Nombre
FROM solicitudes s
INNER JOIN areas ON s.Area_Codigo = areas.Area_Codigo
INNER JOIN usuarios ON s.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo
INNER JOIN plantas p ON p.Pla_Codigo = s.Sol_Tipo
WHERE Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2) AND Sol_PasoActual NOT IN (12, 13)";
        if (($fechaInicial != "") && ($fechaFinal != "")) {
            $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

            $parametros[':fecini'] = $fechaInicial;
            $parametros[':fecfin'] = $fechaFinal;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " GROUP BY Area_Nombre, Sol_EstadoActual
ORDER BY Area_Nombre, Sol_EstadoActual";

        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---listarConsolidadoDocumentosFlujo---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
//    echo $sql;
//    var_dump($parametros);
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarConsolidadoDocumentosFlujoUsuarios($fechaInicial, $fechaFinal, $planta) {

        $parametros = array();

        $sql = "SELECT u.Usu_Codigo, Sol_EstadoActual, COUNT(Sol_EstadoActual), Sol_PasoActual 
FROM solicitudes s 
INNER JOIN areas ON s.Area_Codigo = areas.Area_Codigo
INNER JOIN usuarios u ON u.Usu_Codigo = s.Usu_Codigo 
INNER JOIN usuarios_plantas up ON up.Usu_Codigo = u.Usu_Codigo
INNER JOIN plantas p ON p.Pla_Codigo = s.Sol_Tipo 
WHERE Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2) 
AND Sol_PasoActual NOT IN (12, 13) AND areas.Area_Estado = 1";
        if (($fechaInicial != "") && ($fechaFinal != "")) {
            $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

            $parametros[':fecini'] = $fechaInicial;
            $parametros[':fecfin'] = $fechaFinal;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        $sql .= " GROUP BY Usu_Nombre, Sol_EstadoActual
ORDER BY Usu_Nombre, Sol_EstadoActual ";
        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Resultado click Button---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha: gatox431
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesConsolidadoAreasDoc($fechaInicial, $fechaFinal, $tipoDoc, $area, $planta) {

        $parametros = array();

        $sql = "SELECT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
FROM solicitudes
left JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
left JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
left JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo
left JOIN plantas p ON p.Pla_Codigo = solicitudes.Sol_Tipo 
WHERE Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2) 
AND Sol_EstadoActual != 'Publicado'
AND areas.Area_Estado = 1";

        if ($tipoDoc != "-1") {
            $sql .= " AND Sol_TipoDocumento = :tip ";
            $parametros[':tip'] = $tipoDoc;
        }

        if ($area != "-1") {
            $sql .= " AND  areas.Area_Nombre = :are ";
            $parametros[':are'] = $area;
        }

        if (($fechaInicial != "") && ($fechaFinal != "")) {
            $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

            $parametros[':fecini'] = $fechaInicial;
            $parametros[':fecfin'] = $fechaFinal;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " ORDER BY Sol_Codigo DESC";
//      echo $sql;
//      var_dump($parametros);
        if ($_SESSION['GD_Usuario'] == "2") {
            echo "------" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesConsolidadoAreasDocPasos($fechaInicial, $fechaFinal, $pasoDoc, $area, $planta = NULL) {

        $parametros = array();

        $sql = "SELECT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
  Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
  FROM solicitudes
  INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
  INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo
INNER JOIN plantas p ON p.Pla_Codigo = solicitudes.Sol_Tipo 
  WHERE Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2)";

        if ($pasoDoc != "-1") {
            $sql .= " AND Sol_PasoActual = :tip ";
            $parametros[':tip'] = $pasoDoc;
        } else {
            $sql .= " AND Sol_PasoActual NOT IN (12, 13) ";
        }

        if ($area != "-1") {
            $sql .= " AND  areas.Area_Nombre = :are ";
            $parametros[':are'] = $area;
        }

        if (($fechaInicial != "") && ($fechaFinal != "")) {
            $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

            $parametros[':fecini'] = $fechaInicial;
            $parametros[':fecfin'] = $fechaFinal;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " ORDER BY Sol_Codigo DESC";

        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Resultado click Button---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    //copia con distinct

    public function listarSolicitudesConsolidadoAreasDocPasos2($fechaInicial, $fechaFinal, $pasoDoc, $area, $planta = NULL, $nombreEst) {

        $parametros = array();

        $sql = "SELECT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
  Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
  FROM solicitudes
  INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo
  INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN usuarios_plantas ON usuarios.Usu_Codigo = usuarios_plantas.Usu_Codigo
INNER JOIN plantas p ON p.Pla_Codigo = solicitudes.Sol_Tipo 
  WHERE Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2) AND areas.Area_Estado = 1";

        if ($pasoDoc != "-1") {
            $sql .= " AND Sol_PasoActual = :tip ";
            $parametros[':tip'] = $pasoDoc;
        } else {
            $sql .= " AND Sol_PasoActual NOT IN (12, 13) ";
        }

        if ($area != "-1") {
            $sql .= " AND  areas.Area_Nombre = :are ";
            $parametros[':are'] = $area;
        }

        if (($fechaInicial != "") && ($fechaFinal != "")) {
            $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

            $parametros[':fecini'] = $fechaInicial;
            $parametros[':fecfin'] = $fechaFinal;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " AND Sol_EstadoActual = :est ";
        $parametros[':est'] = $nombreEst;
        $sql .= "ORDER BY Sol_Codigo DESC";

        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Resultado click Button---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesConsolidadoUsuariosTotalAbajo($fechaInicial, $fechaFinal, $paso, $planta) {

        $parametros = array();

        $sql = "SELECT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
  Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
  FROM solicitudes
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo 
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo 
INNER JOIN usuarios_plantas ON usuarios_plantas.Usu_Codigo = usuarios.Usu_Codigo 
INNER JOIN plantas p ON p.Pla_Codigo = solicitudes.Sol_Tipo 
  WHERE Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2)
  AND areas.Area_Estado = 1";

        if ($paso != "-1") {
            $sql .= " AND Sol_PasoActual = :est ";
            $parametros[':est'] = $paso;
        }

        if (($fechaInicial != "") && ($fechaFinal != "")) {
            $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

            $parametros[':fecini'] = $fechaInicial;
            $parametros[':fecfin'] = $fechaFinal;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " ORDER BY Sol_Codigo DESC";
        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Resultado click Button---" . "<br>" . $sql;
            var_dump($sql);
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesConsolidadoUsuariosTotal($fechaInicial, $fechaFinal, $usuario, $planta) {

        $parametros = array();

        $sql = "SELECT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
  Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
  FROM solicitudes
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo 
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo 
INNER JOIN usuarios_plantas ON usuarios_plantas.Usu_Codigo = usuarios.Usu_Codigo 
INNER JOIN plantas p ON p.Pla_Codigo = solicitudes.Sol_Tipo 
WHERE Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2) AND Sol_PasoActual != 12
AND areas.Area_Estado = 1";

        if ($usuario != "-1") {
            $sql .= " AND usuarios.Usu_Codigo = :usu ";
            $parametros[':usu'] = $usuario;
        }

        if (($fechaInicial != "") && ($fechaFinal != "")) {
            $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

            $parametros[':fecini'] = $fechaInicial;
            $parametros[':fecfin'] = $fechaFinal;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " ORDER BY Sol_Codigo DESC";
        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Resultado click Button---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarSolicitudesConsolidadoUsuarios($fechaInicial, $fechaFinal, $paso, $usuario, $planta) {

        $parametros = array();

        $sql = "SELECT DISTINCT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
  Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
  FROM solicitudes 
INNER JOIN areas ON solicitudes.Area_Codigo = areas.Area_Codigo 
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo 
INNER JOIN usuarios_plantas ON usuarios_plantas.Usu_Codigo = usuarios.Usu_Codigo 
INNER JOIN plantas p ON p.Pla_Codigo = solicitudes.Sol_Tipo 
WHERE Sol_Estado = 1 AND (Sol_TipoFlujo = 1 OR Sol_TipoFlujo = 2)
AND areas.Area_Estado = 1";

        if ($paso != "-1") {
            $sql .= " AND Sol_PasoActual = :est ";
            $parametros[':est'] = $paso;
        }

        if ($usuario != "-1") {
            $sql .= " AND usuarios.Usu_Codigo = :usu ";
            $parametros[':usu'] = $usuario;
        }

        if (($fechaInicial != "") && ($fechaFinal != "")) {
            $sql .= "  AND Sol_Fecha BETWEEN :fecini AND :fecfin ";

            $parametros[':fecini'] = $fechaInicial;
            $parametros[':fecfin'] = $fechaFinal;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }
        $sql .= " ORDER BY Sol_Codigo DESC";
        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Resultado click Button---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha:
      Descripción:
      Parámetros:
     */

    public function cargarPlantillaAnterior($codigoDoc, $version) {

        $parametros = array(":cod" => $codigoDoc, ":ver" => $version);

        $sql = "SELECT Sol_Codigo,Sol_HistorialVersion, Sol_CodigoDocumento,Sol_Formato, Sol_PDF FROM solicitudes WHERE 
Sol_CodigoDocumento = :cod AND Sol_HistorialVersion = (:ver-1)";

//    echo $sql;
//    var_dump($parametros);
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha:
      Descripción:
      Parámetros:
     */

    public function consultarUltimo($usuario) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT * FROM solicitudes WHERE Usu_Codigo = :usu ORDER BY Sol_Codigo DESC LIMIT 1";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res[0];
    }

    public function totalAreasTipo($area, $tipo, $planta = NULL) {

        $parametros = array(":are" => $area, ":tip" => $tipo);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
where areas.Area_Nombre = :are and solicitudes.Sol_TipoDocumento = :tip and Area_Estado = 1";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }

        /* if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Consulta activa---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function EspecificaAreasTipo($area, $tipo, $planta = NULL) {

        $parametros = array();

        $sql = "SELECT DISTINCT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
                Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, 
                solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, Sol_TipoFlujo, CONCAT_WS(' - ',Pla_Marca,Pla_Nombre) AS plantaNombre
                from solicitudes
                Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
                Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
                Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
                INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo 
                INNER JOIN usuarios_plantas ON usuarios_plantas.Usu_Codigo = usuarios.Usu_Codigo
                where Area_Estado = 1 AND Par_Estado = 1";
        if ($area != "-1") {
            $sql .= " AND areas.Area_Nombre = :are";
            $parametros[':are'] = $area;
        }
        if ($tipo != "-1") {
            $sql .= " AND solicitudes.Sol_TipoDocumento = :tip";
            $parametros[':tip'] = $tipo;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN ( ";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " ) ";
        }

        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Consulta activa---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    //---------------------Informe catalogo completo listar por tipo de documento o solicitud en el flujo de aprobacion - consultas - S.Acosta

    public function totalAreasParametro($area, $planta = NULL) {

        $parametros = array(":are" => $area);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
where areas.Area_Nombre = :are and Par_Estado = 1 and areas.Area_Estado = 1";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalAreasNombreArea($tipo, $planta = NULL) {

        $parametros = array(":tip" => $tipo);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
where parametros.Par_Nombre = :tip and Par_Estado = 1 and areas.Area_Estado = 1";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalGeneralAreas($planta = NULL) {

        $parametros = array();

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
where Par_Estado = 1 and areas.Area_Estado = 1";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        /* if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Consulta activa---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalGeneralAreasPorFlujo($planta = NULL) {

        $parametros = array();

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
where Par_Estado = 1 and areas.Area_Estado = 1 AND Sol_EstadoActual NOT IN ( 'Publicado' )";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        /* if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Consulta activa---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    //---------------------Informe ciclo documental listar por tipo de documento o solicitud en el flujo de aprobacion con fecha - consultas - S.Acosta
    public function totalAreasTipoConFecha($area, $tipo, $fechaInicio, $fechaFinal, $planta = NULL) {

        $parametros = array(":are" => $area, ":tip" => $tipo, ":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
where areas.Area_Nombre = :are and solicitudes.Sol_TipoDocumento = :tip and Area_Estado = 1
AND Sol_Fecha BETWEEN :fecIni AND :fecFin ";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }

        /* if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Consulta activa---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }
    
    public function totalAreasParametroConFecha($area, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":are" => $area, ":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
where areas.Area_Nombre = :are and Par_Estado = 1 and areas.Area_Estado = 1
AND Sol_Fecha BETWEEN :fecIni AND :fecFin ";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalAreasNombreAreaConFecha($tipo, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":tip" => $tipo, ":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
where parametros.Par_Nombre = :tip and Par_Estado = 1 and areas.Area_Estado = 1
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalGeneralAreasConFecha($planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
where Par_Estado = 1 and areas.Area_Estado = 1
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        /* if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Consulta activa---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalGeneralAreasPorFlujoConFecha($planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
where Par_Estado = 1 and areas.Area_Estado = 1 AND Sol_EstadoActual NOT IN ( 'Publicado' )
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        /* if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Consulta activa---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }
    
    public function EspecificaAreasTipoCorFecha($area, $tipo, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "SELECT DISTINCT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario,
                Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, 
                solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, Sol_TipoFlujo, CONCAT_WS(' - ',Pla_Marca,Pla_Nombre) AS plantaNombre
                from solicitudes
                Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
                Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
                Inner Join parametros On solicitudes.Sol_TipoDocumento = parametros.Par_Nombre 
                INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo 
                INNER JOIN usuarios_plantas ON usuarios_plantas.Usu_Codigo = usuarios.Usu_Codigo
                where Area_Estado = 1 AND Par_Estado = 1
                AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($area != "-1") {
            $sql .= " AND areas.Area_Nombre = :are";
            $parametros[':are'] = $area;
        }
        if ($tipo != "-1") {
            $sql .= " AND solicitudes.Sol_TipoDocumento = :tip";
            $parametros[':tip'] = $tipo;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN ( ";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " ) ";
        }

        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Consulta activa---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    //---------------------------------------------Informe ciclo documental listar por pasos en el flujo de aprobacion - consultas - S.Acosta
    public function totalAreasPasoFlujoAprobacion($area, $tipo, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":are" => $area, ":tip" => $tipo, ":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
where areas.Area_Nombre = :are and solicitudes.Sol_EstadoActual = :tip and Area_Estado = 1
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }

        /* if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Consulta activa---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalAreasParametroPorPasoFlujo($area, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":are" => $area, ":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join parametros On solicitudes.Sol_EstadoActual = parametros.Par_Nombre 
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
where areas.Area_Nombre = :are and Par_Estado = 1 and areas.Area_Estado = 1 
AND parametros.Par_Estado = 1 AND parametros.Par_Tipo = 2 
AND Par_Nombre != 'Publicado' 
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalAreasNombreAreaPorPasoFlujo($tipo, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":tip" => $tipo, ":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join parametros On solicitudes.Sol_EstadoActual = parametros.Par_Nombre 
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
where parametros.Par_Nombre = :tip and Par_Estado = 1 and areas.Area_Estado = 1
AND parametros.Par_Estado = 1 AND parametros.Par_Tipo = 2 
AND Par_Nombre != 'Publicado'
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }
    
    public function EspecificaAreasPasosFlujoConFecha($area, $tipo, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "SELECT DISTINCT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Usuario, 
                Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, 
                solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
                from solicitudes
                Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
                Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
                Inner Join parametros On solicitudes.Sol_EstadoActual = parametros.Par_Nombre 
                INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo 
                INNER JOIN usuarios_plantas ON usuarios_plantas.Usu_Codigo = usuarios.Usu_Codigo
                where Area_Estado = 1 AND parametros.Par_Estado = 1 
                AND parametros.Par_Tipo = 2 AND Par_Nombre != 'Publicado'
                AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        
        if ($area != "-1") {
            $sql .= " AND areas.Area_Nombre = :are";
            $parametros[':are'] = $area;
        }
        if ($tipo != "-1") {
            $sql .= " AND solicitudes.Sol_EstadoActual = :tip";
            $parametros[':tip'] = $tipo;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN ( ";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " ) ";
        }

        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Consulta activa---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    
    //---------------------------------------------Informe ciclo documental listar por usuarios en el flujo de aprobacion - consultas - S.Acosta
    public function totalTotalAreasUsuariosFlujosInfoDef($fechaInicio, $fechaFinal, $planta = NULL) {

        $parametros = array(":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "SELECT COUNT(Sol_Codigo) AS total 
FROM solicitudes s
INNER JOIN areas a ON s.Area_Codigo = a.Area_Codigo
INNER JOIN usuarios u ON u.Usu_Codigo = s.Usu_Codigo 
INNER JOIN usuarios_plantas up ON up.Usu_Codigo = u.Usu_Codigo 
INNER JOIN parametros On s.Sol_EstadoActual = parametros.Par_Nombre
INNER JOIN plantas p ON p.Pla_Codigo = s.Sol_Tipo 
WHERE Area_Estado = 1 AND s.Sol_Estado = 1 
AND parametros.Par_Estado = 1 AND parametros.Par_Tipo = 2 
AND Par_Nombre != 'Publicado' 
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }

        /*if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Consulta activa---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          }*/
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalAreasUsuariosFlujos($usuario, $tipo ,$fechaInicio, $fechaFinal, $planta = NULL) {

        $parametros = array(":usu"=>$usuario,":tip"=>$tipo ,":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
INNER JOIN usuarios_plantas ON usuarios_plantas.Usu_Codigo = solicitudes.Usu_Codigo 
Inner Join parametros On solicitudes.Sol_EstadoActual = parametros.Par_Nombre 
where usuarios_plantas.Usu_Codigo = :usu and solicitudes.Sol_EstadoActual = :tip and Area_Estado = 1
AND parametros.Par_Estado = 1 AND parametros.Par_Tipo = 2 
AND Par_Nombre != 'Publicado' 
AND solicitudes.Sol_Estado = 1
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }

         /*if ($_SESSION['GD_Usuario'] == "2") {
          echo "---Consulta activa---" . "<br>" . $sql;
          var_dump($parametros);
          echo "<br>";
          } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }
    
    public function totalAreasParametroPorUsuariosFlujo($usuario, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":usu" => $usuario, ":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join parametros On solicitudes.Sol_EstadoActual = parametros.Par_Nombre 
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
INNER JOIN usuarios_plantas ON usuarios_plantas.Usu_Codigo = solicitudes.Usu_Codigo 
where usuarios_plantas.Usu_Codigo = :usu and Par_Estado = 1 and areas.Area_Estado = 1 
AND parametros.Par_Estado = 1 AND parametros.Par_Tipo = 2 
AND Par_Nombre != 'Publicado' 
AND solicitudes.Sol_Estado = 1
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }

    public function totalAreasNombreAreaPorUsuariosFlujoInforme($tipo, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":tip" => $tipo, ":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "select count(Sol_Codigo) as total from solicitudes
Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo
Inner Join parametros On solicitudes.Sol_EstadoActual = parametros.Par_Nombre 
Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo
Inner Join usuarios_plantas On solicitudes.Usu_Codigo = usuarios_plantas.Usu_Codigo
where parametros.Par_Nombre = :tip and Par_Estado = 1 and areas.Area_Estado = 1
AND parametros.Par_Estado = 1 AND parametros.Par_Tipo = 2 
AND Par_Nombre != 'Publicado'
AND solicitudes.Sol_Estado = 1
AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
        
        /* if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Consulta activa---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['total'];
    }
    
    public function EspecificaAreasUsuariosFlujoConFecha($usuario = NULL, $tipo = NULL, $planta = NULL, $fechaInicio, $fechaFinal) {

        $parametros = array(":fecIni" => $fechaInicio, ":fecFin" => $fechaFinal);

        $sql = "SELECT Sol_Codigo, Sol_CodigoRadicado, Sol_Fecha, Area_Nombre, usuarios_plantas.Usu_Codigo, 
                Sol_TipoDocumento, Sol_CodigoDocumento, Sol_NombreDocumento, Sol_Tema, Sol_Observaciones, Sol_EstadoActual, Sol_Tipo, Sol_AprobacionSolicitud, 
                solicitudes.Area_Codigo, Sol_PasoActual, Sol_HistorialVersion, solicitudes.Usu_Codigo, Sol_TipoFlujo
                from solicitudes 
                Inner Join areas On solicitudes.Area_Codigo = areas.Area_Codigo 
                Inner Join plantas On solicitudes.Sol_Tipo = plantas.Pla_Codigo 
                INNER JOIN usuarios_plantas ON usuarios_plantas.Usu_Codigo = solicitudes.Usu_Codigo 
                Inner Join parametros On solicitudes.Sol_EstadoActual = parametros.Par_Nombre 
                where Area_Estado = 1 AND parametros.Par_Estado = 1 
                AND parametros.Par_Tipo = 2 AND Par_Nombre != 'Publicado' AND solicitudes.Sol_Estado = 1 
                AND Sol_Fecha BETWEEN :fecIni AND :fecFin";
        
        if ($usuario != NULL) {
            $sql .= " AND usuarios_plantas.Usu_Codigo = :usu";
            $parametros[':usu'] = $usuario;
        }
        if ($tipo != NULL) {
            $sql .= " AND solicitudes.Sol_EstadoActual = :tip";
            $parametros[':tip'] = $tipo;
        }
        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND plantas.Pla_Codigo IN ( ";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " ) ";
        }
        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---Consulta activa---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

}

?>
