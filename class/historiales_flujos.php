<?php

require_once('basedatos.php');

class historiales_flujos extends basedatos {

    private $HistF_Codigo;
    private $Sol_Codigo;
    private $Usu_Codigo;
    private $HistF_Paso;
    private $HistF_Clasificacion;
    private $HistF_Observacion;
    private $HistF_FechaHora;
    private $HistF_Estado;
    private $HistF_Adjunto;

    function __construct($HistF_Codigo = NULL, $Sol_Codigo = NULL, $Usu_Codigo = NULL, $HistF_Paso = NULL, $HistF_Clasificacion = NULL, $HistF_Observacion = NULL, $HistF_FechaHora = NULL, $HistF_Estado = NULL, $HistF_Adjunto = NULL) {
        $this->HistF_Codigo = $HistF_Codigo;
        $this->Sol_Codigo = $Sol_Codigo;
        $this->Usu_Codigo = $Usu_Codigo;
        $this->HistF_Paso = $HistF_Paso;
        $this->HistF_Clasificacion = $HistF_Clasificacion;
        $this->HistF_Observacion = $HistF_Observacion;
        $this->HistF_FechaHora = $HistF_FechaHora;
        $this->HistF_Estado = $HistF_Estado;
        $this->HistF_Adjunto = $HistF_Adjunto;
        $this->tabla = "historiales_flujos";
    }

    function getHistF_Codigo() {
        return $this->HistF_Codigo;
    }

    function getSol_Codigo() {
        return $this->Sol_Codigo;
    }

    function getUsu_Codigo() {
        return $this->Usu_Codigo;
    }

    function getHistF_Paso() {
        return $this->HistF_Paso;
    }

    function getHistF_Clasificacion() {
        return $this->HistF_Clasificacion;
    }

    function getHistF_Observacion() {
        return $this->HistF_Observacion;
    }

    function getHistF_FechaHora() {
        return $this->HistF_FechaHora;
    }

    function getHistF_Estado() {
        return $this->HistF_Estado;
    }

    function getHistF_Adjunto() {
        return $this->HistF_Adjunto;
    }

    function setHistF_Codigo($HistF_Codigo) {
        $this->HistF_Codigo = $HistF_Codigo;
    }

    function setSol_Codigo($Sol_Codigo) {
        $this->Sol_Codigo = $Sol_Codigo;
    }

    function setUsu_Codigo($Usu_Codigo) {
        $this->Usu_Codigo = $Usu_Codigo;
    }

    function setHistF_Paso($HistF_Paso) {
        $this->HistF_Paso = $HistF_Paso;
    }

    function setHistF_Clasificacion($HistF_Clasificacion) {
        $this->HistF_Clasificacion = $HistF_Clasificacion;
    }

    function setHistF_Observacion($HistF_Observacion) {
        $this->HistF_Observacion = $HistF_Observacion;
    }

    function setHistF_FechaHora($HistF_FechaHora) {
        $this->HistF_FechaHora = $HistF_FechaHora;
    }

    function setHistF_Estado($HistF_Estado) {
        $this->HistF_Estado = $HistF_Estado;
    }

    function setHistF_Adjunto($HistF_Adjunto) {
        $this->HistF_Adjunto = $HistF_Adjunto;
    }

    public function insertar() {
        $campos = array("Sol_Codigo", "Usu_Codigo", "HistF_Paso", "HistF_Clasificacion", "HistF_Observacion", "HistF_FechaHora", "HistF_Estado", "HistF_Adjunto");
        $valores = array(
            array(
                $this->Sol_Codigo,
                $this->Usu_Codigo,
                $this->HistF_Paso,
                $this->HistF_Clasificacion,
                $this->HistF_Observacion,
                $this->HistF_FechaHora,
                $this->HistF_Estado,
                $this->HistF_Adjunto
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
        $sql = "SELECT * FROM historiales_flujos WHERE HistF_Codigo = :cod";
        $parametros = array(":cod" => $this->HistF_Codigo);
        if ($this->consultaSQL($sql, $parametros)) {
            $res = $this->cargarRegistro();

            $this->setSol_Codigo($res[1]);
            $this->setUsu_Codigo($res[2]);
            $this->setHistF_Paso($res[3]);
            $this->setHistF_Clasificacion($res[4]);
            $this->setHistF_Observacion($res[5]);
            $this->setHistF_FechaHora($res[6]);
            $this->setHistF_Estado($res[7]);
            $this->setHistF_Adjunto($res[8]);

            $this->desconectar();
        }
    }

    public function actualizar() {
        $campos = array("Sol_Codigo", "Usu_Codigo", "HistF_Paso", "HistF_Clasificacion", "HistF_Observacion", "HistF_FechaHora", "HistF_Estado", "HistF_Adjunto");
        $valores = array($this->getSol_Codigo(), $this->getUsu_Codigo(), $this->getHistF_Paso(), $this->getHistF_Clasificacion(), $this->getHistF_Observacion(), $this->getHistF_FechaHora(), $this->getHistF_Estado(), $this->getHistF_Adjunto());
        $llaveprimaria = "HistF_Codigo";
        $valorllaveprimaria = $this->getHistF_Codigo();
        $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
        $this->desconectar();
        return $res;
    }

    public function eliminar() {
        $sql = "DELETE FROM historiales_flujos WHERE HistF_Codigo = :cod";
        $parametros = array(":cod" => $this->HistF_Codigo);
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

    public function listarHistorialFlujoSolicitudesGestion($codigo) {

        $parametros = array(":cod" => $codigo);

        $sql = "SELECT HistF_Paso, HistF_Clasificacion, HistF_Observacion, HistF_FechaHora, usuarios.Usu_Usuario, parametros.Par_Nombre, HistF_Adjunto, parametros.Par_Orden, CONCAT_WS(' ',usuarios.Usu_Nombre, usuarios.Usu_Apellido)
FROM historiales_flujos
INNER JOIN usuarios ON historiales_flujos.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN parametros ON historiales_flujos.HistF_Paso = parametros.Par_Orden
WHERE Sol_Codigo = :cod AND HistF_Estado = 1 AND Par_Tipo = 2 order by HistF_FechaHora ASC";

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

    public function listarHistorialFlujoSolicitudesMMGestion($codigo) {

        $parametros = array(":cod" => $codigo);

        $sql = "SELECT HistF_Paso, HistF_Clasificacion, HistF_Observacion, HistF_FechaHora, usuarios.Usu_Usuario, parametros.Par_Nombre, HistF_Adjunto, parametros.Par_Orden, CONCAT_WS(' ',usuarios.Usu_Nombre, usuarios.Usu_Apellido)
FROM historiales_flujos
INNER JOIN usuarios ON historiales_flujos.Usu_Codigo = usuarios.Usu_Codigo
INNER JOIN parametros ON historiales_flujos.HistF_Paso = parametros.Par_Orden
WHERE Sol_Codigo = :cod AND HistF_Estado = 1 AND Par_Tipo = 3";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

}

?>
