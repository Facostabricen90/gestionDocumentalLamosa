<?php
require_once('basedatos.php');

  class usuarios_permisos extends basedatos {
    private $UsuP_Codigo;
    private $Per_Codigo;
    private $Usu_Codigo;
    private $UsuP_Ver;
    private $UsuP_Crear;
    private $UsuP_Modificar;
    private $UsuP_Eliminar;

  function __construct($UsuP_Codigo = NULL, $Per_Codigo = NULL, $Usu_Codigo = NULL, $UsuP_Ver = NULL, $UsuP_Crear = NULL, $UsuP_Modificar = NULL, $UsuP_Eliminar = NULL) {
    $this->UsuP_Codigo = $UsuP_Codigo;
    $this->Per_Codigo = $Per_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->UsuP_Ver = $UsuP_Ver;
    $this->UsuP_Crear = $UsuP_Crear;
    $this->UsuP_Modificar = $UsuP_Modificar;
    $this->UsuP_Eliminar = $UsuP_Eliminar;
    $this->tabla = "usuarios_permisos";
  }

  function getUsuP_Codigo() {
    return $this->UsuP_Codigo;
  }

  function getPer_Codigo() {
    return $this->Per_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getUsuP_Ver() {
    return $this->UsuP_Ver;
  }

  function getUsuP_Crear() {
    return $this->UsuP_Crear;
  }

  function getUsuP_Modificar() {
    return $this->UsuP_Modificar;
  }

  function getUsuP_Eliminar() {
    return $this->UsuP_Eliminar;
  }

  function setUsuP_Codigo($UsuP_Codigo) {
    $this->UsuP_Codigo = $UsuP_Codigo;
  }

  function setPer_Codigo($Per_Codigo) {
    $this->Per_Codigo = $Per_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setUsuP_Ver($UsuP_Ver) {
    $this->UsuP_Ver = $UsuP_Ver;
  }

  function setUsuP_Crear($UsuP_Crear) {
    $this->UsuP_Crear = $UsuP_Crear;
  }

  function setUsuP_Modificar($UsuP_Modificar) {
    $this->UsuP_Modificar = $UsuP_Modificar;
  }

  function setUsuP_Eliminar($UsuP_Eliminar) {
    $this->UsuP_Eliminar = $UsuP_Eliminar;
  }

  public function insertar(){
    $campos = array("Per_Codigo", "Usu_Codigo", "UsuP_Ver", "UsuP_Crear", "UsuP_Modificar", "UsuP_Eliminar");
    $valores = array(
    array(
      $this->Per_Codigo, 
      $this->Usu_Codigo, 
      $this->UsuP_Ver, 
      $this->UsuP_Crear, 
      $this->UsuP_Modificar, 
      $this->UsuP_Eliminar
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
    $sql =  "SELECT * FROM usuarios_permisos WHERE UsuP_Codigo = :cod";
    $parametros = array(":cod"=>$this->UsuP_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPer_Codigo($res[1]);
      $this->setUsu_Codigo($res[2]);
      $this->setUsuP_Ver($res[3]);
      $this->setUsuP_Crear($res[4]);
      $this->setUsuP_Modificar($res[5]);
      $this->setUsuP_Eliminar($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Per_Codigo", "Usu_Codigo", "UsuP_Ver", "UsuP_Crear", "UsuP_Modificar", "UsuP_Eliminar");
    $valores = array($this->getPer_Codigo(), $this->getUsu_Codigo(), $this->getUsuP_Ver(), $this->getUsuP_Crear(), $this->getUsuP_Modificar(), $this->getUsuP_Eliminar());
    $llaveprimaria = "UsuP_Codigo";
    $valorllaveprimaria = $this->getUsuP_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM usuarios_permisos WHERE UsuP_Codigo = :cod";
    $parametros = array(":cod"=>$this->UsuP_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
		
	public function Permisos($usuario, $permiso){
		$parametros = array(":usu"=>$usuario, ":per"=>$permiso);
		
	  $sql = "SELECT sp.Per_Codigo, permisos.Per_Modulo, sp.Usu_Codigo, UsuP_Ver, UsuP_Modificar, UsuP_Crear, UsuP_Eliminar
FROM usuarios_permisos sp
INNER JOIN permisos ON sp.Per_Codigo = permisos.Per_Codigo
INNER JOIN usuarios ON usuarios.Usu_Codigo = sp.Usu_Codigo
WHERE usuarios.Usu_Codigo = :usu AND permisos.Per_Codigo = :per";
	  
		$this->consultaSQL($sql, $parametros);
		$res = $this->cargarRegistro();
		$this->desconectar();
	  return $res;
	}
	
}
?>
