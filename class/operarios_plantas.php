<?php
require_once('basedatos.php');

  class usuarios_plantas extends basedatos {
    private $OPlan_Codigo;
    private $Ope_Codigo;
    private $Pla_Codigo;

  function __construct($OPlan_Codigo = NULL, $Ope_Codigo = NULL, $Pla_Codigo = NULL) {
    $this->OPlan_Codigo = $OPlan_Codigo;
    $this->Ope_Codigo = $Ope_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->tabla = "usuarios_plantas";
  }

  function getOPlan_Codigo() {
    return $this->OPlan_Codigo;
  }

  function getOpe_Codigo() {
    return $this->Ope_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function setOPlan_Codigo($OPlan_Codigo) {
    $this->OPlan_Codigo = $OPlan_Codigo;
  }

  function setOpe_Codigo($Ope_Codigo) {
    $this->Ope_Codigo = $Ope_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  public function insertar(){
    $campos = array("OPlan_Codigo", "Ope_Codigo", "Pla_Codigo");
    $valores = array(
    array(
      $this->OPlan_Codigo, 
      $this->Ope_Codigo, 
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
    $sql =  "SELECT * FROM usuarios_plantas WHERE OPlan_Codigo = :cod";
    $parametros = array(":cod"=>$this->OPlan_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setOpe_Codigo($res[1]);
      $this->setPla_Codigo($res[2]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("OPlan_Codigo", "Ope_Codigo", "Pla_Codigo");
    $valores = array($this->getOPlan_Codigo(), $this->getOpe_Codigo(), $this->getPla_Codigo());
    $llaveprimaria = "OPlan_Codigo";
    $valorllaveprimaria = $this->getOPlan_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM usuarios_plantas WHERE OPlan_Codigo = :cod";
    $parametros = array(":cod"=>$this->OPlan_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
}
?>
