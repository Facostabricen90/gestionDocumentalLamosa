<?php
require_once('basedatos.php');

  class capacitaciones_operarios extends basedatos {
    private $CapO_Codigo;
    private $Sol_Codigo;
    private $Ope_Codigo;
    private $CapO_Fecha;
    private $CapO_Hora;
    private $CapO_Capacitado;
    private $CapO_Novedades;
    private $CapO_Observaciones;
    private $CapO_FechaHoraCrea;
    private $CapO_UsuarioCrea;
    private $CapO_Estado;
    private $CapO_HorasCapacitacion;

  function __construct($CapO_Codigo = NULL, $Sol_Codigo = NULL, $Ope_Codigo = NULL, $CapO_Fecha = NULL, $CapO_Hora = NULL, $CapO_Capacitado = NULL, $CapO_Novedades = NULL, $CapO_Observaciones = NULL, $CapO_FechaHoraCrea = NULL, $CapO_UsuarioCrea = NULL, $CapO_Estado = NULL, $CapO_HorasCapacitacion = NULL) {
    $this->CapO_Codigo = $CapO_Codigo;
    $this->Sol_Codigo = $Sol_Codigo;
    $this->Ope_Codigo = $Ope_Codigo;
    $this->CapO_Fecha = $CapO_Fecha;
    $this->CapO_Hora = $CapO_Hora;
    $this->CapO_Capacitado = $CapO_Capacitado;
    $this->CapO_Novedades = $CapO_Novedades;
    $this->CapO_Observaciones = $CapO_Observaciones;
    $this->CapO_FechaHoraCrea = $CapO_FechaHoraCrea;
    $this->CapO_UsuarioCrea = $CapO_UsuarioCrea;
    $this->CapO_Estado = $CapO_Estado;
    $this->CapO_HorasCapacitacion = $CapO_HorasCapacitacion;
    $this->tabla = "capacitaciones_operarios";
  }

  function getCapO_Codigo() {
    return $this->CapO_Codigo;
  }

  function getSol_Codigo() {
    return $this->Sol_Codigo;
  }

  function getOpe_Codigo() {
    return $this->Ope_Codigo;
  }

  function getCapO_Fecha() {
    return $this->CapO_Fecha;
  }

  function getCapO_Hora() {
    return $this->CapO_Hora;
  }

  function getCapO_Capacitado() {
    return $this->CapO_Capacitado;
  }

  function getCapO_Novedades() {
    return $this->CapO_Novedades;
  }

  function getCapO_Observaciones() {
    return $this->CapO_Observaciones;
  }

  function getCapO_FechaHoraCrea() {
    return $this->CapO_FechaHoraCrea;
  }

  function getCapO_UsuarioCrea() {
    return $this->CapO_UsuarioCrea;
  }

  function getCapO_Estado() {
    return $this->CapO_Estado;
  }

  function getCapO_HorasCapacitacion() {
    return $this->CapO_HorasCapacitacion;
  }

  function setCapO_Codigo($CapO_Codigo) {
    $this->CapO_Codigo = $CapO_Codigo;
  }

  function setSol_Codigo($Sol_Codigo) {
    $this->Sol_Codigo = $Sol_Codigo;
  }

  function setOpe_Codigo($Ope_Codigo) {
    $this->Ope_Codigo = $Ope_Codigo;
  }

  function setCapO_Fecha($CapO_Fecha) {
    $this->CapO_Fecha = $CapO_Fecha;
  }

  function setCapO_Hora($CapO_Hora) {
    $this->CapO_Hora = $CapO_Hora;
  }

  function setCapO_Capacitado($CapO_Capacitado) {
    $this->CapO_Capacitado = $CapO_Capacitado;
  }

  function setCapO_Novedades($CapO_Novedades) {
    $this->CapO_Novedades = $CapO_Novedades;
  }

  function setCapO_Observaciones($CapO_Observaciones) {
    $this->CapO_Observaciones = $CapO_Observaciones;
  }

  function setCapO_FechaHoraCrea($CapO_FechaHoraCrea) {
    $this->CapO_FechaHoraCrea = $CapO_FechaHoraCrea;
  }

  function setCapO_UsuarioCrea($CapO_UsuarioCrea) {
    $this->CapO_UsuarioCrea = $CapO_UsuarioCrea;
  }

  function setCapO_Estado($CapO_Estado) {
    $this->CapO_Estado = $CapO_Estado;
  }

  function setCapO_HorasCapacitacion($CapO_HorasCapacitacion) {
    $this->CapO_HorasCapacitacion = $CapO_HorasCapacitacion;
  }

  public function insertar(){
    $campos = array("Sol_Codigo", "Ope_Codigo", "CapO_Fecha", "CapO_Hora", "CapO_Capacitado", "CapO_Novedades", "CapO_Observaciones", "CapO_FechaHoraCrea", "CapO_UsuarioCrea", "CapO_Estado", "CapO_HorasCapacitacion");
    $valores = array(
    array(
      $this->Sol_Codigo, 
      $this->Ope_Codigo, 
      $this->CapO_Fecha, 
      $this->CapO_Hora, 
      $this->CapO_Capacitado, 
      $this->CapO_Novedades, 
      $this->CapO_Observaciones, 
      $this->CapO_FechaHoraCrea, 
      $this->CapO_UsuarioCrea, 
      $this->CapO_Estado,
      $this->CapO_HorasCapacitacion
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
    $sql =  "SELECT * FROM capacitaciones_operarios WHERE CapO_Codigo = :cod";
    $parametros = array(":cod"=>$this->CapO_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setSol_Codigo($res[1]);
      $this->setOpe_Codigo($res[2]);
      $this->setCapO_Fecha($res[3]);
      $this->setCapO_Hora($res[4]);
      $this->setCapO_Capacitado($res[5]);
      $this->setCapO_Novedades($res[6]);
      $this->setCapO_Observaciones($res[7]);
      $this->setCapO_FechaHoraCrea($res[8]);
      $this->setCapO_UsuarioCrea($res[9]);
      $this->setCapO_Estado($res[10]);
      $this->setCapO_HorasCapacitacion($res[11]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Sol_Codigo", "Ope_Codigo", "CapO_Fecha", "CapO_Hora", "CapO_Capacitado", "CapO_Novedades", "CapO_Observaciones", "CapO_FechaHoraCrea", "CapO_UsuarioCrea", "CapO_Estado", "CapO_HorasCapacitacion");
    $valores = array($this->getSol_Codigo(), $this->getOpe_Codigo(), $this->getCapO_Fecha(), $this->getCapO_Hora(), $this->getCapO_Capacitado(), $this->getCapO_Novedades(), $this->getCapO_Observaciones(), $this->getCapO_FechaHoraCrea(), $this->getCapO_UsuarioCrea(), $this->getCapO_Estado(), $this->getCapO_HorasCapacitacion());
    $llaveprimaria = "CapO_Codigo";
    $valorllaveprimaria = $this->getCapO_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM capacitaciones_operarios WHERE CapO_Codigo = :cod";
    $parametros = array(":cod"=>$this->CapO_Codigo);
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
	public function cantidadCapacitacionesOperariosArea($solicitud){

		$parametros = array(":sol"=>$solicitud);

		$sql = "SELECT COUNT(CapO_Codigo) AS CantCapacitados
FROM capacitaciones_operarios
WHERE CapO_Estado = 1 AND CapO_Capacitado = 1 AND capacitaciones_operarios.Sol_Codigo = :sol";

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
	public function cantidadCapacitacionesOperariosRegistroPublicar($solicitud){

		$parametros = array(":sol"=>$solicitud);

		$sql = "SELECT COUNT(CapO_Codigo) AS CantCapacitados
FROM capacitaciones_operarios
WHERE CapO_Estado = 1 AND capacitaciones_operarios.Sol_Codigo = :sol";

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
	public function listarCapacitacionesOperariosSolicitudes($solicitud){

		$parametros = array(":sol"=>$solicitud);

		$sql = "SELECT Ope_Codigo, CapO_Codigo, CapO_Capacitado, CapO_Novedades, CapO_Observaciones
FROM capacitaciones_operarios
WHERE CapO_Estado = 1 AND Sol_Codigo = :sol";

		$this->consultaSQL($sql, $parametros);
		$res = $this->cargarTodo();
		$this->desconectar();
		return $res;
	}
        
        public function listarCapacitacionesOperariosSolicitudesConSubareas($solicitud){

		$parametros = array(":sol"=>$solicitud);

		$sql = "SELECT capacitaciones_operarios.Ope_Codigo, CapO_Codigo, CapO_Capacitado, CapO_Novedades, CapO_Observaciones
FROM capacitaciones_operarios
INNER JOIN operarios ON operarios.Ope_Codigo = capacitaciones_operarios.Ope_Codigo
INNER JOIN areas ON operarios.Area_Codigo = areas.Area_Codigo
WHERE CapO_Estado = 1 AND Sol_Codigo = :sol  OR operarios.Ope_SubArea = areas.Area_Nombre";

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
  public function capacitacionesDatoFechaHoras($solicitud){

    $parametros = array(":sol"=>$solicitud);

    $sql = "SELECT CapO_Fecha, CapO_HorasCapacitacion
FROM capacitaciones_operarios
WHERE CapO_Estado = 1 AND Sol_Codigo = :sol
ORDER BY CapO_Codigo DESC
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
  public function excelCapacitacionesOperariosSolicitudes($solicitud){

    $parametros = array(":sol"=>$solicitud);

    $sql = "SELECT Sol_NombreDocumento, Ope_Cedula, CONCAT_WS(' ', Ope_Nombre, Ope_Apellido) AS NomOpe, Ope_Cargo, Ope_CodigoCCosto, Ope_AreaLATAM,
CONCAT_WS(' ', usuarios.Usu_Nombre, usuarios.Usu_Apellido) AS Prov, MONTH(CapO_Fecha), CapO_Fecha, CapO_HorasCapacitacion, Ope_Sexo,
Ope_TipoFuncion, Ope_Gerencia, areas.Area_Nombre, Ope_SubArea
FROM capacitaciones_operarios
INNER JOIN solicitudes ON capacitaciones_operarios.Sol_Codigo = solicitudes.Sol_Codigo
INNER JOIN operarios ON capacitaciones_operarios.Ope_Codigo = operarios.Ope_Codigo
INNER JOIN areas ON operarios.Area_Codigo = areas.Area_Codigo
INNER JOIN usuarios ON solicitudes.Usu_Codigo = usuarios.Usu_Codigo
WHERE CapO_Estado = 1 AND capacitaciones_operarios.Sol_Codigo = :sol
ORDER BY NomOpe ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>