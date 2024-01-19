<?php
require_once('basedatos.php');

  class usuarios_areas extends basedatos {
    private $UsuA_Codigo;
    private $Usu_Codigo;
    private $Area_Codigo;
    private $UsuA_FechaHora;
    private $UsuA_UsuarioCrea;

  function __construct($UsuA_Codigo = NULL, $Usu_Codigo = NULL, $Area_Codigo = NULL, $UsuA_FechaHora = NULL, $UsuA_UsuarioCrea = NULL) {
    $this->UsuA_Codigo = $UsuA_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->Area_Codigo = $Area_Codigo;
    $this->UsuA_FechaHora = $UsuA_FechaHora;
    $this->UsuA_UsuarioCrea = $UsuA_UsuarioCrea;
    $this->tabla = "usuarios_areas";
  }

  function getUsuA_Codigo() {
    return $this->UsuA_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getArea_Codigo() {
    return $this->Area_Codigo;
  }

  function getUsuA_FechaHora() {
    return $this->UsuA_FechaHora;
  }

  function getUsuA_UsuarioCrea() {
    return $this->UsuA_UsuarioCrea;
  }

  function setUsuA_Codigo($UsuA_Codigo) {
    $this->UsuA_Codigo = $UsuA_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setArea_Codigo($Area_Codigo) {
    $this->Area_Codigo = $Area_Codigo;
  }

  function setUsuA_FechaHora($UsuA_FechaHora) {
    $this->UsuA_FechaHora = $UsuA_FechaHora;
  }

  function setUsuA_UsuarioCrea($UsuA_UsuarioCrea) {
    $this->UsuA_UsuarioCrea = $UsuA_UsuarioCrea;
  }

  public function insertar(){
    $campos = array("Usu_Codigo", "Area_Codigo", "UsuA_FechaHora", "UsuA_UsuarioCrea");
    $valores = array(
    array(
      $this->Usu_Codigo, 
      $this->Area_Codigo, 
      $this->UsuA_FechaHora, 
      $this->UsuA_UsuarioCrea
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
    $sql =  "SELECT * FROM usuarios_areas WHERE UsuA_Codigo = :cod";
    $parametros = array(":cod"=>$this->UsuA_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setUsu_Codigo($res[1]);
      $this->setArea_Codigo($res[2]);
      $this->setUsuA_FechaHora($res[3]);
      $this->setUsuA_UsuarioCrea($res[4]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Usu_Codigo", "Area_Codigo", "UsuA_FechaHora", "UsuA_UsuarioCrea");
    $valores = array($this->getUsu_Codigo(), $this->getArea_Codigo(), $this->getUsuA_FechaHora(), $this->getUsuA_UsuarioCrea());
    $llaveprimaria = "UsuA_Codigo";
    $valorllaveprimaria = $this->getUsuA_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM usuarios_areas WHERE UsuA_Codigo = :cod";
    $parametros = array(":cod"=>$this->UsuA_Codigo);
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
	public function listarAreasUsuariosFiltro($usuario){

		$parametros = array(":usu"=>$usuario);

		$sql = "SELECT usuarios_areas.Area_Codigo, areas.Area_Nombre
FROM usuarios_areas
INNER JOIN areas ON usuarios_areas.Area_Codigo = areas.Area_Codigo
WHERE usuarios_areas.Usu_Codigo = :usu AND areas.Area_Estado = 1
ORDER BY areas.Area_Nombre ASC";

		$this->consultaSQL($sql, $parametros);
		$res = $this->cargarTodo();
		$this->desconectar();
		return $res;
	}
        
        public function listarAreasUsuariosFiltroPlanta($usuario){

		$parametros = array(":usu"=>$usuario);

		$sql = "SELECT areas.Area_Codigo, areas.Area_Nombre
FROM areas
INNER JOIN plantas ON plantas.Pla_Codigo = areas.Pla_Codigo
INNER JOIN usuarios ON plantas.Pla_Codigo = usuarios.Pla_Codigo
WHERE plantas.Pla_Codigo = usuarios.Pla_Codigo AND usuarios.Usu_Codigo = :usu AND areas.Area_Estado = '1'
ORDER BY areas.Area_Nombre ASC";

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
  public function listarAreasUsuarioTiene($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT DISTINCT ua.Area_Codigo, a.Area_Nombre, ua.UsuA_Codigo
FROM usuarios_areas ua INNER JOIN usuarios u ON ua.Usu_Codigo = u.Usu_Codigo
INNER JOIN areas a ON ua.Area_Codigo = a.Area_Codigo
WHERE u.Usu_Codigo = :usu
ORDER BY a.Area_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }

}
?>
