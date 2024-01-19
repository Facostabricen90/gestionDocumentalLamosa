<?php
require_once('basedatos.php');

  class festivos extends basedatos {
    private $Fes_Codigo;
    private $Fes_Fecha;

  function __construct($Fes_Codigo = NULL, $Fes_Fecha = NULL) {
    $this->Fes_Codigo = $Fes_Codigo;
    $this->Fes_Fecha = $Fes_Fecha;
    $this->tabla = "festivos";
  }

  function getFes_Codigo() {
    return $this->Fes_Codigo;
  }

  function getFes_Fecha() {
    return $this->Fes_Fecha;
  }

  function setFes_Codigo($Fes_Codigo) {
    $this->Fes_Codigo = $Fes_Codigo;
  }

  function setFes_Fecha($Fes_Fecha) {
    $this->Fes_Fecha = $Fes_Fecha;
  }

  public function insertar(){
    $campos = array("Fes_Fecha");
    $valores = array(
    array(
      $this->Fes_Fecha
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
    $sql =  "SELECT * FROM festivos WHERE Fes_Codigo = :cod";
    $parametros = array(":cod"=>$this->Fes_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setFes_Fecha($res[1]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Fes_Fecha");
    $valores = array($this->getFes_Fecha());
    $llaveprimaria = "Fes_Codigo";
    $valorllaveprimaria = $this->getFes_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM festivos WHERE Fes_Codigo = :cod";
    $parametros = array(":cod"=>$this->Fes_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
		
	/*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
	public function cantidadDiasFestivosFechas($fechaInicial, $fechaFinal){

		$parametros = array(":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

		$sql = "SELECT COUNT(festivos.Fes_Codigo) AS CantFes
FROM festivos
WHERE festivos.Fes_Fecha BETWEEN :fecini AND :fecfin";

		$this->consultaSQL($sql, $parametros);
		$res = $this->cargarRegistro();
		$this->desconectar();
		return $res[0];
	}
}
?>