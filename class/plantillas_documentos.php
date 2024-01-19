<?php

require_once('basedatos.php');

class plantillas_documentos extends basedatos {

    private $PlaD_Codigo;
    private $PlaD_Tipo;
    private $PlaD_Plantilla;
    private $PlaD_FechaHora;
    private $PlaD_UsuarioCrea;
    private $PlaD_Estado;
    private $PlaD_TiempoRetencion;
    private $planta_codigo;

    function __construct($PlaD_Codigo = NULL, $PlaD_Tipo = NULL, $PlaD_Plantilla = NULL, $PlaD_FechaHora = NULL, $PlaD_UsuarioCrea = NULL, $PlaD_Estado = NULL, $PlaD_TiempoRetencion = NULL, $planta_codigo = NULL) {
        $this->PlaD_Codigo = $PlaD_Codigo;
        $this->PlaD_Tipo = $PlaD_Tipo;
        $this->PlaD_Plantilla = $PlaD_Plantilla;
        $this->PlaD_FechaHora = $PlaD_FechaHora;
        $this->PlaD_UsuarioCrea = $PlaD_UsuarioCrea;
        $this->PlaD_Estado = $PlaD_Estado;
        $this->PlaD_TiempoRetencion = $PlaD_TiempoRetencion;
        $this->planta_codigo = $planta_codigo;
        $this->tabla = "plantillas_documentos";
    }

    function getPlaD_Codigo() {
        return $this->PlaD_Codigo;
    }

    function getPlaD_Tipo() {
        return $this->PlaD_Tipo;
    }

    function getPlaD_Plantilla() {
        return $this->PlaD_Plantilla;
    }

    function getPlaD_FechaHora() {
        return $this->PlaD_FechaHora;
    }

    function getPlaD_UsuarioCrea() {
        return $this->PlaD_UsuarioCrea;
    }

    function getPlaD_Estado() {
        return $this->PlaD_Estado;
    }

    function getPlaD_TiempoRetencion() {
        return $this->PlaD_TiempoRetencion;
    }

    function getPlanta_codigo() {
        return $this->planta_codigo;
    }

    function setPlaD_Codigo($PlaD_Codigo) {
        $this->PlaD_Codigo = $PlaD_Codigo;
    }

    function setPlaD_Tipo($PlaD_Tipo) {
        $this->PlaD_Tipo = $PlaD_Tipo;
    }

    function setPlaD_Plantilla($PlaD_Plantilla) {
        $this->PlaD_Plantilla = $PlaD_Plantilla;
    }

    function setPlaD_FechaHora($PlaD_FechaHora) {
        $this->PlaD_FechaHora = $PlaD_FechaHora;
    }

    function setPlaD_UsuarioCrea($PlaD_UsuarioCrea) {
        $this->PlaD_UsuarioCrea = $PlaD_UsuarioCrea;
    }

    function setPlaD_Estado($PlaD_Estado) {
        $this->PlaD_Estado = $PlaD_Estado;
    }

    function setPlaD_TiempoRetencion($PlaD_TiempoRetencion) {
        $this->PlaD_TiempoRetencion = $PlaD_TiempoRetencion;
    }

    function setPlanta_codigo($planta_codigo) {
        $this->planta_codigo = $planta_codigo;
    }

    public function insertar() {
        $campos = array("PlaD_Tipo", "PlaD_Plantilla", "PlaD_FechaHora", "PlaD_UsuarioCrea", "PlaD_Estado", "PlaD_TiempoRetencion", "planta_codigo");
        $valores = array(
            array(
                $this->PlaD_Tipo,
                $this->PlaD_Plantilla,
                $this->PlaD_FechaHora,
                $this->PlaD_UsuarioCrea,
                $this->PlaD_Estado,
                $this->PlaD_TiempoRetencion,
                $this->planta_codigo
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
        $sql = "SELECT * FROM plantillas_documentos WHERE PlaD_Codigo = :cod";
        $parametros = array(":cod" => $this->PlaD_Codigo);
        if ($this->consultaSQL($sql, $parametros)) {
            $res = $this->cargarRegistro();

            $this->setPlaD_Tipo($res[1]);
            $this->setPlaD_Plantilla($res[2]);
            $this->setPlaD_FechaHora($res[3]);
            $this->setPlaD_UsuarioCrea($res[4]);
            $this->setPlaD_Estado($res[5]);
            $this->setPlaD_TiempoRetencion($res[6]);
            $this->setPlanta_codigo($res['planta_codigo']);

            $this->desconectar();
        }
    }

    public function actualizar() {
        $campos = array("PlaD_Tipo", "PlaD_Plantilla", "PlaD_FechaHora", "PlaD_UsuarioCrea", "PlaD_Estado", "PlaD_TiempoRetencion", "planta_codigo");
        $valores = array($this->getPlaD_Tipo(), $this->getPlaD_Plantilla(), $this->getPlaD_FechaHora(), $this->getPlaD_UsuarioCrea(), $this->getPlaD_Estado(), $this->getPlaD_TiempoRetencion(), $this->getPlanta_codigo());
        $llaveprimaria = "PlaD_Codigo";
        $valorllaveprimaria = $this->getPlaD_Codigo();
        $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
        $this->desconectar();
        return $res;
    }

    public function eliminar() {
        $sql = "DELETE FROM plantillas_documentos WHERE PlaD_Codigo = :cod";
        $parametros = array(":cod" => $this->PlaD_Codigo);
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

    public function cargarPlantillaTipoDocumento($tipo) {

        $parametros = array(":tip" => $tipo);

        $sql = "SELECT plantillas_documentos.PlaD_Plantilla
FROM plantillas_documentos
WHERE PlaD_Tipo = :tip AND PlaD_Estado = 1 LIMIT 1";

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
    public function cargarPlantillaTipoDocumentoPlanta($tipo,$planta) {

        $sql = "SELECT plantillas_documentos.PlaD_Plantilla
FROM plantillas_documentos
WHERE PlaD_Tipo = :tip AND PlaD_Estado = 1 and plantillas_documentos.planta_codigo = :pla order by plantillas_documentos.PlaD_Codigo desc LIMIT 1";
        $parametros = array(":tip" => $tipo, ":pla" => $planta);
        $res = $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        //var_dump($sql);
        $this->desconectar();
        return $res['PlaD_Plantilla'];
    }

    /*
      Autor: RxDavid
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarPlantillasDocumentosPrinpal() {

        $sql = "SELECT PlaD_Codigo, PlaD_Tipo, PlaD_Plantilla, PlaD_FechaHora, Usu_Usuario, PlaD_TiempoRetencion
FROM plantillas_documentos
INNER JOIN usuarios ON plantillas_documentos.PlaD_UsuarioCrea = usuarios.Usu_Codigo
WHERE PlaD_Estado = 1";

        $this->consultaSQL($sql);
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

    public function listarPlantillasDocumentosPrinpalPlanta() {

        $sql = "SELECT PlaD_Codigo, PlaD_Tipo, PlaD_Plantilla, PlaD_FechaHora, Usu_Usuario, PlaD_TiempoRetencion
FROM plantillas_documentos
INNER JOIN usuarios ON plantillas_documentos.PlaD_UsuarioCrea = usuarios.Usu_Codigo
WHERE PlaD_Estado = 1 and  planta_codigo = :pla";

        $parametros = array(":pla" => $this->planta_codigo);
        $res = $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

}

?>