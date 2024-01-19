<?php
require_once('basedatos.php');

  class explorador_archivos extends basedatos {
    private $EArc_Codigo;
    private $EArc_Nombre;
    private $EArc_Referencia;
    private $EArc_Link;
    private $EArc_Tipo;
    private $EArc_Estado;
    private $EArc_Modulo;
    private $Usu_Modifica;
    private $EArc_FechaHora;

  function __construct($EArc_Codigo = NULL, $EArc_Nombre = NULL, $EArc_Referencia = NULL, $EArc_Link = NULL, $EArc_Tipo = NULL, $EArc_Estado = NULL, $EArc_Modulo = NULL, $Usu_Modifica = NULL, $EArc_FechaHora = NULL) {
    $this->EArc_Codigo = $EArc_Codigo;
    $this->EArc_Nombre = $EArc_Nombre;
    $this->EArc_Referencia = $EArc_Referencia;
    $this->EArc_Link = $EArc_Link;
    $this->EArc_Tipo = $EArc_Tipo;
    $this->EArc_Estado = $EArc_Estado;
    $this->EArc_Modulo = $EArc_Modulo;
    $this->Usu_Modifica = $Usu_Modifica;
    $this->EArc_FechaHora = $EArc_FechaHora;
    $this->tabla = "explorador_archivos";
  }

  function getEArc_Codigo() {
    return $this->EArc_Codigo;
  }

  function getEArc_Nombre() {
    return $this->EArc_Nombre;
  }

  function getEArc_Referencia() {
    return $this->EArc_Referencia;
  }

  function getEArc_Link() {
    return $this->EArc_Link;
  }

  function getEArc_Tipo() {
    return $this->EArc_Tipo;
  }

  function getEArc_Estado() {
    return $this->EArc_Estado;
  }

  function getEArc_Modulo() {
    return $this->EArc_Modulo;
  }

  function getUsu_Modifica() {
    return $this->Usu_Modifica;
  }

  function getEArc_FechaHora() {
    return $this->EArc_FechaHora;
  }

  function setEArc_Codigo($EArc_Codigo) {
    $this->EArc_Codigo = $EArc_Codigo;
  }

  function setEArc_Nombre($EArc_Nombre) {
    $this->EArc_Nombre = $EArc_Nombre;
  }

  function setEArc_Referencia($EArc_Referencia) {
    $this->EArc_Referencia = $EArc_Referencia;
  }

  function setEArc_Link($EArc_Link) {
    $this->EArc_Link = $EArc_Link;
  }

  function setEArc_Tipo($EArc_Tipo) {
    $this->EArc_Tipo = $EArc_Tipo;
  }

  function setEArc_Estado($EArc_Estado) {
    $this->EArc_Estado = $EArc_Estado;
  }

  function setEArc_Modulo($EArc_Modulo) {
    $this->EArc_Modulo = $EArc_Modulo;
  }

  function setUsu_Modifica($Usu_Modifica) {
    $this->Usu_Modifica = $Usu_Modifica;
  }

  function setEArc_FechaHora($EArc_FechaHora) {
    $this->EArc_FechaHora = $EArc_FechaHora;
  }

  public function insertar(){
    $campos = array("EArc_Nombre", "EArc_Referencia", "EArc_Link", "EArc_Tipo", "EArc_Estado", "EArc_Modulo", "Usu_Modifica", "EArc_FechaHora");
    $valores = array(
    array( 
      $this->EArc_Nombre, 
      $this->EArc_Referencia, 
      $this->EArc_Link, 
      $this->EArc_Tipo, 
      $this->EArc_Estado, 
      $this->EArc_Modulo, 
      $this->Usu_Modifica, 
      $this->EArc_FechaHora
      )
    );

    $resultado = $this->insertarRegistros($campos, $valores);
    $this->desconectar();

    if($resultado[0] == "OK"){
      return true;
    }else{
      return false;
    }
  }

  public function consultar(){
    $sql =  "SELECT * FROM explorador_archivos WHERE EArc_Codigo = :cod";
    $parametros = array(":cod"=>$this->EArc_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setEArc_Nombre($res[1]);
      $this->setEArc_Referencia($res[2]);
      $this->setEArc_Link($res[3]);
      $this->setEArc_Tipo($res[4]);
      $this->setEArc_Estado($res[5]);
      $this->setEArc_Modulo($res[6]);
      $this->setUsu_Modifica($res[7]);
      $this->setEArc_FechaHora($res[8]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array( "EArc_Nombre", "EArc_Referencia", "EArc_Link", "EArc_Tipo", "EArc_Estado", "EArc_Modulo", "Usu_Modifica", "EArc_FechaHora");
    $valores = array($this->getEArc_Nombre(), $this->getEArc_Referencia(), $this->getEArc_Link(), $this->getEArc_Tipo(), $this->getEArc_Estado(), $this->getEArc_Modulo(), $this->getUsu_Modifica(), $this->getEArc_FechaHora());
    $llaveprimaria = "EArc_Codigo";
    $valorllaveprimaria = $this->getEArc_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM explorador_archivos WHERE EArc_Codigo = :cod";
    $parametros = array(":cod"=>$this->EArc_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }

    
  /*
    Autor: Willy
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarArchivos($referencia, $modulo){

    $parametros = array(":ref"=>$referencia, ":mod"=>$modulo);

    $sql = "SELECT EArc_Codigo, EArc_Nombre, EArc_Link, EArc_Tipo, EArc_Referencia, CONCAT_WS(' ', u.Usu_Nombre, u.Usu_Apellido), EArc_FechaHora
FROM explorador_archivos ex INNER JOIN usuarios u ON ex.Usu_Modifica = u.Usu_Codigo
WHERE EArc_Modulo = :mod AND EArc_Estado = 1 AND EArc_Referencia = :ref
ORDER BY EArc_Tipo ASC, EArc_Nombre ASC";

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
  public function listarArchivosAnteriores($referencia, $modulo){

    $parametros = array(":ref"=>$referencia, ":mod"=>$modulo);

    $sql = "SELECT EArc_Referencia, EArc_Nombre
FROM explorador_archivos
WHERE EArc_Modulo = :mod AND EArc_Estado = 1 AND EArc_Codigo = :ref";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>
