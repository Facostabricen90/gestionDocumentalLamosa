<?php
require_once('basedatos.php');

  class adjuntos extends basedatos {
    private $Adj_Codigo;
    private $Adj_Nombre;
    private $Adj_Relacion;
    private $Adj_Ruta;
    private $Adj_FechaHora;
    private $Adj_Usuario;
    private $Adj_Estado;

  function __construct($Adj_Codigo = NULL, $Adj_Nombre = NULL, $Adj_Relacion = NULL, $Adj_Ruta = NULL, $Adj_FechaHora = NULL, $Adj_Usuario = NULL, $Adj_Estado = NULL) {
    $this->Adj_Codigo = $Adj_Codigo;
    $this->Adj_Nombre = $Adj_Nombre;
    $this->Adj_Relacion = $Adj_Relacion;
    $this->Adj_Ruta = $Adj_Ruta;
    $this->Adj_FechaHora = $Adj_FechaHora;
    $this->Adj_Usuario = $Adj_Usuario;
    $this->Adj_Estado = $Adj_Estado;
    $this->tabla = "adjuntos";
  }

  function getAdj_Codigo() {
    return $this->Adj_Codigo;
  }

  function getAdj_Nombre() {
    return $this->Adj_Nombre;
  }

  function getAdj_Relacion() {
    return $this->Adj_Relacion;
  }

  function getAdj_Ruta() {
    return $this->Adj_Ruta;
  }

  function getAdj_FechaHora() {
    return $this->Adj_FechaHora;
  }

  function getAdj_Usuario() {
    return $this->Adj_Usuario;
  }

  function getAdj_Estado() {
    return $this->Adj_Estado;
  }

  function setAdj_Codigo($Adj_Codigo) {
    $this->Adj_Codigo = $Adj_Codigo;
  }

  function setAdj_Nombre($Adj_Nombre) {
    $this->Adj_Nombre = $Adj_Nombre;
  }

  function setAdj_Relacion($Adj_Relacion) {
    $this->Adj_Relacion = $Adj_Relacion;
  }

  function setAdj_Ruta($Adj_Ruta) {
    $this->Adj_Ruta = $Adj_Ruta;
  }

  function setAdj_FechaHora($Adj_FechaHora) {
    $this->Adj_FechaHora = $Adj_FechaHora;
  }

  function setAdj_Usuario($Adj_Usuario) {
    $this->Adj_Usuario = $Adj_Usuario;
  }

  function setAdj_Estado($Adj_Estado) {
    $this->Adj_Estado = $Adj_Estado;
  }

  public function insertar(){
    $campos = array("Adj_Nombre", "Adj_Relacion", "Adj_Ruta", "Adj_FechaHora", "Adj_Usuario", "Adj_Estado");
    $valores = array(
    array(
      $this->Adj_Nombre, 
      $this->Adj_Relacion, 
      $this->Adj_Ruta, 
      $this->Adj_FechaHora, 
      $this->Adj_Usuario, 
      $this->Adj_Estado
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
    $sql =  "SELECT * FROM adjuntos WHERE Adj_Codigo = :cod";
    $parametros = array(":cod"=>$this->Adj_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAdj_Nombre($res[1]);
      $this->setAdj_Relacion($res[2]);
      $this->setAdj_Ruta($res[3]);
      $this->setAdj_FechaHora($res[4]);
      $this->setAdj_Usuario($res[5]);
      $this->setAdj_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Adj_Nombre", "Adj_Relacion", "Adj_Ruta", "Adj_FechaHora", "Adj_Usuario", "Adj_Estado");
    $valores = array($this->getAdj_Nombre(), $this->getAdj_Relacion(), $this->getAdj_Ruta(), $this->getAdj_FechaHora(), $this->getAdj_Usuario(), $this->getAdj_Estado());
    $llaveprimaria = "Adj_Codigo";
    $valorllaveprimaria = $this->getAdj_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM adjuntos WHERE Adj_Codigo = :cod";
    $parametros = array(":cod"=>$this->Adj_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
  public function listarAdjuntosNombre($tabla){

    $parametros = array(":tab"=>$tabla);

    $sql = "SELECT Adj_Codigo,Adj_Nombre,Adj_FechaHora,Adj_Ruta FROM adjuntos
WHERE Adj_Relacion = :tab ";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
