<?php

require_once('basedatos.php');

class parametros extends basedatos {

    private $Par_Codigo;
    private $Par_Nombre;
    private $Par_Tipo;
    private $Par_FechaHora;
    private $Par_Usuario;
    private $Par_Estado;
    private $Par_Orden;
    private $Par_TipoFlujo;
    private $Pla_Codigo;
    private $Par_Alias;

    function __construct($Par_Codigo = NULL, $Par_Nombre = NULL, $Par_Tipo = NULL, $Par_FechaHora = NULL, $Par_Usuario = NULL, $Par_Estado = NULL, $Par_Orden = NULL, $Par_TipoFlujo = NULL, $Pla_Codigo = NULL, $Par_Alias = NULL) {
        $this->Par_Codigo = $Par_Codigo;
        $this->Par_Nombre = $Par_Nombre;
        $this->Par_Tipo = $Par_Tipo;
        $this->Par_FechaHora = $Par_FechaHora;
        $this->Par_Usuario = $Par_Usuario;
        $this->Par_Estado = $Par_Estado;
        $this->Par_Orden = $Par_Orden;
        $this->Par_TipoFlujo = $Par_TipoFlujo;
        $this->Pla_Codigo = $Pla_Codigo;
        $this->Par_Alias = $Par_Alias;
        $this->tabla = "parametros";
    }

    function getPar_Codigo() {
        return $this->Par_Codigo;
    }

    function getPar_Nombre() {
        return $this->Par_Nombre;
    }

    function getPar_Tipo() {
        return $this->Par_Tipo;
    }

    function getPar_FechaHora() {
        return $this->Par_FechaHora;
    }

    function getPar_Usuario() {
        return $this->Par_Usuario;
    }

    function getPar_Estado() {
        return $this->Par_Estado;
    }

    function getPar_Orden() {
        return $this->Par_Orden;
    }

    function getPar_TipoFlujo() {
        return $this->Par_TipoFlujo;
    }

    function getPla_Codigo() {
        return $this->Pla_Codigo;
    }

    function getPar_Alias() {
        return $this->Par_Alias;
    }

    function setPar_Codigo($Par_Codigo) {
        $this->Par_Codigo = $Par_Codigo;
    }

    function setPar_Nombre($Par_Nombre) {
        $this->Par_Nombre = $Par_Nombre;
    }

    function setPar_Tipo($Par_Tipo) {
        $this->Par_Tipo = $Par_Tipo;
    }

    function setPar_FechaHora($Par_FechaHora) {
        $this->Par_FechaHora = $Par_FechaHora;
    }

    function setPar_Usuario($Par_Usuario) {
        $this->Par_Usuario = $Par_Usuario;
    }

    function setPar_Estado($Par_Estado) {
        $this->Par_Estado = $Par_Estado;
    }

    function setPar_Orden($Par_Orden) {
        $this->Par_Orden = $Par_Orden;
    }

    function setPar_TipoFlujo($Par_TipoFlujo) {
        $this->Par_TipoFlujo = $Par_TipoFlujo;
    }

    function setPla_Codigo($Pla_Codigo) {
        $this->Pla_Codigo = $Pla_Codigo;
    }

    function setPar_Alias($Par_Alias) {
        $this->Par_Alias = $Par_Alias;
    }

    public function insertar() {
        $campos = array("Par_Nombre", "Par_Tipo", "Par_FechaHora", "Par_Usuario", "Par_Estado", "Par_Orden", "Par_TipoFlujo", "Pla_Codigo", "Par_Alias");
        $valores = array(
            array(
                $this->Par_Nombre,
                $this->Par_Tipo,
                $this->Par_FechaHora,
                $this->Par_Usuario,
                $this->Par_Estado,
                $this->Par_Orden,
                $this->Par_TipoFlujo,
                $this->Pla_Codigo,
                $this->Par_Alias
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
        $sql = "SELECT * FROM parametros WHERE Par_Codigo = :cod";
        $parametros = array(":cod" => $this->Par_Codigo);
        if ($this->consultaSQL($sql, $parametros)) {
            $res = $this->cargarRegistro();

            $this->setPar_Nombre($res[1]);
            $this->setPar_Tipo($res[2]);
            $this->setPar_FechaHora($res[3]);
            $this->setPar_Usuario($res[4]);
            $this->setPar_Estado($res[5]);
            $this->setPar_Orden($res[6]);
            $this->setPar_TipoFlujo($res[7]);
            $this->setPla_Codigo($res[8]);
            $this->setPar_Alias($res[9]);

            $this->desconectar();
        }
    }

    public function actualizar() {
        $campos = array("Par_Nombre", "Par_Tipo", "Par_FechaHora", "Par_Usuario", "Par_Estado", "Par_Orden", "Par_TipoFlujo", "Pla_Codigo", "Par_Alias");
        $valores = array($this->getPar_Nombre(), $this->getPar_Tipo(), $this->getPar_FechaHora(), $this->getPar_Usuario(), $this->getPar_Estado(), $this->getPar_Orden(), $this->getPar_TipoFlujo(), $this->getPla_Codigo(), $this->getPar_Alias());
        $llaveprimaria = "Par_Codigo";
        $valorllaveprimaria = $this->getPar_Codigo();
        $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
        $this->desconectar();
        return $res;
    }

    public function eliminar() {
        $sql = "DELETE FROM parametros WHERE Par_Codigo = :cod";
        $parametros = array(":cod" => $this->Par_Codigo);
        $res = $this->consultaSQL($sql, $parametros);
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha: 15 de Febrero 2021
      Descripción:
      Parámetros:
     */

    public function listarParametrosPrinpal($estado) {

        $parametros = array();

        $sql = "SELECT Par_Codigo, Par_Nombre, Par_Tipo, Par_TipoFlujo FROM parametros ";

        if ($estado != "-1") {
            $sql .= " WHERE Par_Estado = :est ";
            $parametros[':est'] = $estado;
        }

        $sql .= " ORDER BY Par_Tipo ASC, Par_Nombre ASC";

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

    public function listarParametroTipo($tipo, $pasos = NULL) {

        $parametros = array(":tip" => $tipo);

        $sql = "SELECT parametros.Par_Codigo, parametros.Par_Nombre, parametros.Par_Orden, parametros.Par_Alias
FROM parametros
WHERE parametros.Par_Estado = 1 AND parametros.Par_Tipo = :tip ";

        if ($pasos != "NULL") {
            $sql .= " AND Par_Orden IS NOT NULL ORDER BY parametros.Par_Orden ASC ";
        } else {
            $sql .= "AND Par_Alias IS NOT NULL AND Par_Alias != '' ORDER BY parametros.Par_Nombre ASC";
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

    public function listarParametroTipo2($tipo, $pasos = NULL) {

        $parametros = array(":tip" => $tipo);

        $sql = "SELECT parametros.Par_Codigo, parametros.Par_Nombre, parametros.Par_Orden, parametros.Par_Alias
FROM parametros
WHERE parametros.Par_Estado = 1 AND parametros.Par_Tipo = :tip ";

        if ($pasos != "NULL") {
            $sql .= " AND Par_Alias IS NOT NULL AND Par_Alias != '' ORDER BY parametros.Par_Nombre ASC ";
        } else {
            $sql .= "AND Par_Alias IS NOT NULL AND Par_Alias != '' ORDER BY parametros.Par_Nombre ASC";
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

    public function listarParametroTipoo($tipo) {

        $parametros = array(":tip" => $tipo);

        $sql = "SELECT parametros.Par_Codigo, parametros.Par_Nombre, parametros.Par_Orden
FROM parametros
WHERE parametros.Par_Estado = 1 AND parametros.Par_Tipo = :tip ";

        $sql .= " ORDER BY parametros.Par_Nombre ASC";

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

    public function listarParametroTipoFlujoNormal($tipo, $pasos = NULL) {

        $parametros = array(":tip" => $tipo);

        $sql = "SELECT parametros.Par_Codigo, parametros.Par_Nombre, parametros.Par_Orden
FROM parametros
WHERE parametros.Par_Estado = 1 AND parametros.Par_Tipo = :tip AND (Par_TipoFlujo = 1 OR Par_TipoFlujo = 2) ";

        if ($pasos != "NULL") {
            $sql .= " ORDER BY parametros.Par_Orden ASC";
        } else {
            $sql .= " ORDER BY parametros.Par_Nombre ASC";
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

    public function listarParametroTipoFlujoMatriz($tipo, $pasos = NULL) {

        $parametros = array(":tip" => $tipo);

        $sql = "SELECT parametros.Par_Codigo, parametros.Par_Nombre, parametros.Par_Orden
FROM parametros
WHERE parametros.Par_Estado = 1 AND parametros.Par_Tipo = :tip AND Par_TipoFlujo = 3 ";

        if ($pasos != "NULL") {
            $sql .= " ORDER BY parametros.Par_Orden ASC";
        } else {
            $sql .= " ORDER BY parametros.Par_Nombre ASC";
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

    public function listarParametroTipoCatalogo($tipo) {

        $parametros = array(":tip" => $tipo);

        $sql = "SELECT parametros.Par_Codigo, parametros.Par_Nombre, parametros.Par_Orden
FROM parametros
WHERE parametros.Par_Estado = 1 AND parametros.Par_Tipo = :tip ";

        $sql .= " ORDER BY parametros.Par_Nombre ASC";

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

    public function listarTipoDocumentoConsolidado() {


        $sql = "SELECT parametros.Par_Codigo, parametros.Par_Nombre, parametros.Par_Orden
FROM parametros
WHERE parametros.Par_Estado = 1 AND parametros.Par_Tipo = 1 ";

        $sql .= " ORDER BY parametros.Par_Nombre ASC";

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

    public function listarParametroTipoFluA() {


        $sql = "SELECT parametros.Par_Codigo, parametros.Par_Nombre, parametros.Par_Orden
FROM parametros
WHERE parametros.Par_Estado = 1 AND parametros.Par_Tipo = 2 ORDER BY parametros.Par_Codigo ASC";

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

    public function verificadorLatam() {


        $sql = "SELECT Par_Codigo, Par_Nombre
FROM parametros
WHERE (UPPER(Par_Nombre) LIKE '%LATAM%' OR UPPER(Par_Nombre) LIKE '%CORPORATIVO%')";

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

    public function hallarNombrePasoPorOrden($orden) {

        $parametros = array(":ord" => $orden);

        $sql = "SELECT Par_Nombre
FROM parametros
WHERE Par_Estado = 1 AND Par_Tipo = 2 AND Par_Orden = :ord
LIMIT 1";

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

    public function hallarNombrePasoPorOrdenEHS($orden) {

        $parametros = array(":ord" => $orden);

        $sql = "SELECT Par_Nombre
FROM parametros
WHERE Par_Estado = 1 AND Par_Tipo = 3 AND Par_Orden = :ord
LIMIT 1";

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

    public function listarParametroTipoFluAConsolidado() {


        $sql = "SELECT parametros.Par_Codigo, parametros.Par_Nombre, parametros.Par_Orden
FROM parametros
WHERE parametros.Par_Estado = 1 AND parametros.Par_Tipo = 2 AND Par_Nombre != 'Publicado' ORDER BY parametros.Par_Orden ASC";

        $this->consultaSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

}

?>
