<?php
require_once('basedatos.php');

  class plantas extends basedatos {
    private $Pla_Codigo;
    private $Pla_Grupo;
    private $Pla_Negocio;
    private $Pla_Distribucion;
    private $Pla_Marca;
    private $Pla_Nombre;
    private $Pla_Estado;
    private $Pla_Usuario;
    private $Pla_FechaHora;
    private $Pla_Alias;

  function __construct($Pla_Codigo = NULL, $Pla_Grupo = NULL, $Pla_Negocio = NULL, $Pla_Distribucion = NULL, $Pla_Marca = NULL, $Pla_Nombre = NULL, $Pla_Estado = NULL, $Pla_Usuario = NULL, $Pla_FechaHora = NULL, $Pla_Alias = NULL) {
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Pla_Grupo = $Pla_Grupo;
    $this->Pla_Negocio = $Pla_Negocio;
    $this->Pla_Distribucion = $Pla_Distribucion;
    $this->Pla_Marca = $Pla_Marca;
    $this->Pla_Nombre = $Pla_Nombre;
    $this->Pla_Estado = $Pla_Estado;
    $this->Pla_Usuario = $Pla_Usuario;
    $this->Pla_FechaHora = $Pla_FechaHora;
    $this->Pla_Alias = $Pla_Alias;
    $this->tabla = "plantas";
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getPla_Grupo() {
    return $this->Pla_Grupo;
  }

  function getPla_Negocio() {
    return $this->Pla_Negocio;
  }

  function getPla_Distribucion() {
    return $this->Pla_Distribucion;
  }

  function getPla_Marca() {
    return $this->Pla_Marca;
  }

  function getPla_Nombre() {
    return $this->Pla_Nombre;
  }

  function getPla_Estado() {
    return $this->Pla_Estado;
  }

  function getPla_Usuario() {
    return $this->Pla_Usuario;
  }

  function getPla_FechaHora() {
    return $this->Pla_FechaHora;
  }

  function getPla_Alias() {
    return $this->Pla_Alias;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setPla_Grupo($Pla_Grupo) {
    $this->Pla_Grupo = $Pla_Grupo;
  }

  function setPla_Negocio($Pla_Negocio) {
    $this->Pla_Negocio = $Pla_Negocio;
  }

  function setPla_Distribucion($Pla_Distribucion) {
    $this->Pla_Distribucion = $Pla_Distribucion;
  }

  function setPla_Marca($Pla_Marca) {
    $this->Pla_Marca = $Pla_Marca;
  }

  function setPla_Nombre($Pla_Nombre) {
    $this->Pla_Nombre = $Pla_Nombre;
  }

  function setPla_Estado($Pla_Estado) {
    $this->Pla_Estado = $Pla_Estado;
  }

  function setPla_Usuario($Pla_Usuario) {
    $this->Pla_Usuario = $Pla_Usuario;
  }

  function setPla_FechaHora($Pla_FechaHora) {
    $this->Pla_FechaHora = $Pla_FechaHora;
  }

  function setPla_Alias($Pla_Alias) {
    $this->Pla_Pla_Alias = $Pla_Alias;
  }

  public function insertar(){
    $campos = array("Pla_Grupo", "Pla_Negocio", "Pla_Distribucion", "Pla_Marca", "Pla_Nombre", "Pla_Estado", "Pla_Usuario", "Pla_FechaHora", "Pla_Alias");
    $valores = array(
    array(
      $this->Pla_Grupo, 
      $this->Pla_Negocio, 
      $this->Pla_Distribucion, 
      $this->Pla_Marca, 
      $this->Pla_Nombre, 
      $this->Pla_Estado, 
      $this->Pla_Usuario, 
      $this->Pla_FechaHora, 
      $this->Pla_Alias
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
    $sql =  "SELECT * FROM plantas WHERE Pla_Codigo = :cod";
    $parametros = array(":cod"=>$this->Pla_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Grupo($res[1]);
      $this->setPla_Negocio($res[2]);
      $this->setPla_Distribucion($res[3]);
      $this->setPla_Marca($res[4]);
      $this->setPla_Nombre($res[5]);
      $this->setPla_Estado($res[6]);
      $this->setPla_Usuario($res[7]);
      $this->setPla_FechaHora($res[8]);
      $this->setPla_Alias($res[9]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Grupo", "Pla_Negocio", "Pla_Distribucion", "Pla_Marca", "Pla_Nombre", "Pla_Estado", "Pla_Usuario", "Pla_FechaHora", "Pla_Alias");
    $valores = array($this->getPla_Grupo(), $this->getPla_Negocio(), $this->getPla_Distribucion(), $this->getPla_Marca(), $this->getPla_Nombre(), $this->getPla_Estado(), $this->getPla_Usuario(), $this->getPla_FechaHora(), $this->getPla_Alias());
    $llaveprimaria = "Pla_Codigo";
    $valorllaveprimaria = $this->getPla_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM plantas WHERE Pla_Codigo = :cod";
    $parametros = array(":cod"=>$this->Pla_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: RxDavid
  Fecha: 12 de Febrero 2021
  Descripción:
  Parámetros:
  */
  public function listarPlantasPrinpal($estado){

    $parametros = array();

    $sql = "SELECT Pla_Codigo, Pla_Nombre, Pla_Marca FROM plantas ";
    
    if($estado != "-1"){
      $sql .= " WHERE Pla_Estado = :est ";
      $parametros[':est'] = $estado;
    }
    
    $sql .= " ORDER BY Pla_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: RxDavid
  Fecha: 15 de febrero de 2021
  Descripción:
  Parámetros:
  */
  public function listarPlantasFiltro(){

    $sql = "SELECT Pla_Codigo, Pla_Nombre, Pla_Marca FROM plantas WHERE Pla_Estado = 1 ORDER BY Pla_Nombre ASC";

    $this->consultaSQL($sql);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
  
  public function listarPlantasFiltroConUsuarioPermisos($usuario){

      $parametros = array(":usu" => $usuario);
      
    $sql = "SELECT p.Pla_Codigo, p.Pla_Nombre, p.Pla_Marca FROM plantas p
INNER JOIN usuarios_plantas up ON up.Pla_Codigo = p.Pla_Codigo
WHERE Pla_Estado = 1 AND up.Usu_Codigo = :usu ORDER BY Pla_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    /*
  Autor: WillyTY
  Fecha: 12 de febrero de 2021
  Descripción:
  Parámetros:
  */
  public function listarPlantasUsuarioCrear($estado, $usuario){
    
    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Pla_Codigo, Pla_Nombre FROM plantas
    WHERE Pla_Codigo IN (SELECT Pla_Codigo FROM usuarios_plantas WHERE Usu_Codigo = :usu)";
    
    if($estado != "-1"){
      $sql .= " AND Pla_Estado = :est ";
      $parametros[':est'] = $estado;
    }

    $sql .= " ORDER BY Pla_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    /*
  Autor: WillyTY
  Fecha: 12 de febrero de 2021
  Descripción:
  Parámetros:
  */
  public function listarPlantasUsuarioCrearAdmin($estado){
    
    $parametros = array();

    $sql = "SELECT Pla_Codigo, Pla_Nombre FROM plantas ";
    
    if($estado != "-1"){
      $sql .= " WHERE Pla_Estado = :est ";
      $parametros[':est'] = $estado;
    }

    $sql .= " ORDER BY Pla_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    /*
  Autor: WillyTY
  Fecha: 12 de febrero de 2021
  Descripción:
  Parámetros:
  */
  public function listarMarcaFilto($usuario){
    
    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT DISTINCT Pla_Marca
FROM plantas
WHERE Pla_Estado = 1 AND Pla_Codigo IN (SELECT Pla_Codigo FROM usuarios_plantas WHERE Usu_Codigo = :usu) ";
    
    

    $sql .= " ORDER BY Pla_Marca ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    /*
  Autor: WillyTY
  Fecha: 12 de febrero de 2021
  Descripción:
  Parámetros:
  */
  public function listarPlantasFiltroMarca($usuario, $pais = NULL ){
    
    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Pla_Codigo, Pla_Nombre, Pla_Marca
FROM plantas
WHERE Pla_Estado = 1 AND Pla_Codigo IN (SELECT Pla_Codigo FROM usuarios_plantas WHERE Usu_Codigo = :usu)
";
    if($pais != NULL){
      $priMar = 1;
      foreach($pais as $registro2){
        if($priMar == 1){
            $sql .= " AND Pla_Marca IN (";
        }else{
            $sql .= " , ";
        }
        $sql .= " :pais".$priMar;
        $parametros[':pais'.$priMar] = $registro2;
        $priMar++;
      }
      $sql .= " )";
    }
    $sql .= " ORDER BY Pla_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
  
  public function listarPlantasFiltroMarcaPorUsuario($usuario){
    
    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Pla_Marca, Usu_Codigo
            FROM plantas p
            INNER JOIN usuarios u ON u.Pla_Codigo = p.Pla_Codigo
            WHERE Pla_Estado = 1 AND Usu_Codigo = :usu";
    
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
  public function listarFiltroAliasPlantas($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Pla_Codigo, Pla_Alias, Pla_Nombre FROM plantas WHERE Pla_Codigo IN (SELECT Pla_Codigo FROM usuarios_plantas WHERE Usu_Codigo = :usu) AND Pla_Alias IS NOT NULL ORDER BY Pla_Nombre";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
  
  public function listarFiltroAliasPlantasCatalogos($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Pla_Codigo, Pla_Nombre 
FROM plantas 
WHERE Pla_Codigo IN (SELECT Pla_Codigo FROM usuarios WHERE Usu_Codigo = :usu) 
ORDER BY Pla_Nombre";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
