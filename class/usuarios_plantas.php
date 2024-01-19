<?php
require_once('basedatos.php');

  class usuarios_plantas extends basedatos {
    private $UPlan_Codigo;
    private $Usu_Codigo;
    private $Pla_Codigo;

  function __construct($UPlan_Codigo = NULL, $Usu_Codigo = NULL, $Pla_Codigo = NULL) {
    $this->UPlan_Codigo = $UPlan_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->tabla = "usuarios_plantas";
  }

  function getUPlan_Codigo() {
    return $this->UPlan_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function setUPlan_Codigo($UPlan_Codigo) {
    $this->UPlan_Codigo = $UPlan_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  public function insertar(){
    $campos = array("UPlan_Codigo", "Usu_Codigo", "Pla_Codigo");
    $valores = array(
    array(
      $this->UPlan_Codigo, 
      $this->Usu_Codigo, 
      $this->Pla_Codigo
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
    $sql =  "SELECT * FROM usuarios_plantas WHERE UPlan_Codigo = :cod";
    $parametros = array(":cod"=>$this->UPlan_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setUsu_Codigo($res[1]);
      $this->setPla_Codigo($res[2]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("UPlan_Codigo", "Usu_Codigo", "Pla_Codigo");
    $valores = array($this->getUPlan_Codigo(), $this->getUsu_Codigo(), $this->getPla_Codigo());
    $llaveprimaria = "UPlan_Codigo";
    $valorllaveprimaria = $this->getUPlan_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM usuarios_plantas WHERE UPlan_Codigo = :cod";
    $parametros = array(":cod"=>$this->UPlan_Codigo);
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
  public function listarPlantasUsuarioTiene($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT ua.Pla_Codigo, a.Pla_Nombre, ua.UPlan_Codigo
FROM usuarios_plantas ua INNER JOIN usuarios u ON ua.Usu_Codigo = u.Usu_Codigo
INNER JOIN plantas a ON ua.Pla_Codigo= a.Pla_Codigo
WHERE u.Usu_Codigo = :usu
ORDER BY a.Pla_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
  
  public function listarPlantasUsuario($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT ua.Pla_Codigo, a.Pla_Nombre, ua.UPlan_Codigo
FROM usuarios_plantas ua INNER JOIN usuarios u ON ua.Usu_Codigo = u.Usu_Codigo
INNER JOIN plantas a ON ua.Pla_Codigo= a.Pla_Codigo
WHERE u.Usu_Codigo = :usu
ORDER BY a.Pla_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
