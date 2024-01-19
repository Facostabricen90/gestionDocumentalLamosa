<?php
require_once('basedatos.php');

  class permisos extends basedatos {
    private $Per_Codigo;
    private $Per_Modulo;
    private $Per_Tipo;
    private $Per_Archivo;

  function __construct($Per_Codigo = NULL, $Per_Modulo = NULL, $Per_Tipo = NULL, $Per_Archivo = NULL) {
    $this->Per_Codigo = $Per_Codigo;
    $this->Per_Modulo = $Per_Modulo;
    $this->Per_Tipo = $Per_Tipo;
    $this->Per_Archivo = $Per_Archivo;
    $this->tabla = "permisos";
  }

  function getPer_Codigo() {
    return $this->Per_Codigo;
  }

  function getPer_Modulo() {
    return $this->Per_Modulo;
  }

  function getPer_Tipo() {
    return $this->Per_Tipo;
  }

  function getPer_Archivo() {
    return $this->Per_Archivo;
  }

  function setPer_Codigo($Per_Codigo) {
    $this->Per_Codigo = $Per_Codigo;
  }

  function setPer_Modulo($Per_Modulo) {
    $this->Per_Modulo = $Per_Modulo;
  }

  function setPer_Tipo($Per_Tipo) {
    $this->Per_Tipo = $Per_Tipo;
  }

  function setPer_Archivo($Per_Archivo) {
    $this->Per_Archivo = $Per_Archivo;
  }

  public function insertar(){
    $campos = array("Per_Modulo", "Per_Tipo", "Per_Archivo");
    $valores = array(
    array(
      $this->Per_Modulo, 
      $this->Per_Tipo, 
      $this->Per_Archivo
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
    $sql =  "SELECT * FROM permisos WHERE Per_Codigo = :cod";
    $parametros = array(":cod"=>$this->Per_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPer_Modulo($res[1]);
      $this->setPer_Tipo($res[2]);
      $this->setPer_Archivo($res[3]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Per_Modulo", "Per_Tipo", "Per_Archivo");
    $valores = array($this->getPer_Modulo(), $this->getPer_Tipo(), $this->getPer_Archivo());
    $llaveprimaria = "Per_Codigo";
    $valorllaveprimaria = $this->getPer_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM permisos WHERE Per_Codigo = :cod";
    $parametros = array(":cod"=>$this->Per_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
    
    
    
  public function listarPermisosSelect($codigo){

		$parametros = array(':usu'=>$codigo);
	
    $sql = "SELECT p.Per_Codigo, Per_Modulo, up.UsuP_Ver, up.UsuP_Crear, up.UsuP_Modificar, up.UsuP_Eliminar, up.UsuP_Codigo FROM permisos p left join usuarios_permisos up on p.Per_Codigo = up.Per_Codigo where up.Usu_Codigo = :usu ORDER BY p.Per_Codigo ASC, p.Per_Modulo ASC";

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
  public function listarPermisosTodos(){

    $sql = "SELECT Per_Codigo, Per_Modulo FROM permisos";

    $this->consultaSQL($sql);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }

}
?>
