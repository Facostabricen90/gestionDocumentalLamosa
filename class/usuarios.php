<?php
require_once('basedatos.php');

  class usuarios extends basedatos {
    private $Usu_Codigo;
    private $Pla_Codigo;
    private $Usu_Usuario;
    private $Usu_Contrasena;
    private $Usu_Nombre;
    private $Usu_Apellido;
    private $Usu_FechaHoraCrea;
    private $Usu_Cargo;
    private $Usu_Correo;
    private $Usu_Telefono;
    private $Usu_Rol;
    private $Usu_Estado;
    private $Usu_TipoFlujo;

  function __construct($Usu_Codigo = NULL, $Pla_Codigo = NULL, $Usu_Usuario = NULL, $Usu_Contrasena = NULL, $Usu_Nombre = NULL, $Usu_Apellido = NULL, $Usu_FechaHoraCrea = NULL, $Usu_Cargo = NULL, $Usu_Correo = NULL, $Usu_Telefono = NULL, $Usu_Rol = NULL, $Usu_Estado = NULL, $Usu_TipoFlujo = NULL) {
    $this->Usu_Codigo = $Usu_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Usu_Usuario = $Usu_Usuario;
    $this->Usu_Contrasena = md5($Usu_Contrasena);
    $this->Usu_Nombre = $Usu_Nombre;
    $this->Usu_Apellido = $Usu_Apellido;
    $this->Usu_FechaHoraCrea = $Usu_FechaHoraCrea;
    $this->Usu_Cargo = $Usu_Cargo;
    $this->Usu_Correo = $Usu_Correo;
    $this->Usu_Telefono = $Usu_Telefono;
    $this->Usu_Rol = $Usu_Rol;
    $this->Usu_Estado = $Usu_Estado;
    $this->Usu_TipoFlujo = $Usu_TipoFlujo;
    $this->tabla = "usuarios";
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getUsu_Usuario() {
    return $this->Usu_Usuario;
  }

  function getUsu_Contrasena() {
    return $this->Usu_Contrasena;
  }

  function getUsu_Nombre() {
    return $this->Usu_Nombre;
  }

  function getUsu_Apellido() {
    return $this->Usu_Apellido;
  }

  function getUsu_FechaHoraCrea() {
    return $this->Usu_FechaHoraCrea;
  }

  function getUsu_Cargo() {
    return $this->Usu_Cargo;
  }

  function getUsu_Correo() {
    return $this->Usu_Correo;
  }

  function getUsu_Telefono() {
    return $this->Usu_Telefono;
  }

  function getUsu_Rol() {
    return $this->Usu_Rol;
  }

  function getUsu_Estado() {
    return $this->Usu_Estado;
  }
   
  function getUsu_TipoFlujo() {
    return $this->Usu_TipoFlujo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setUsu_Usuario($Usu_Usuario) {
    $this->Usu_Usuario = $Usu_Usuario;
  }

  function setUsu_Contrasena($Usu_Contrasena) {
    $this->Usu_Contrasena = md5($Usu_Contrasena);
  }

  function setUsu_Nombre($Usu_Nombre) {
    $this->Usu_Nombre = $Usu_Nombre;
  }

  function setUsu_Apellido($Usu_Apellido) {
    $this->Usu_Apellido = $Usu_Apellido;
  }

  function setUsu_FechaHoraCrea($Usu_FechaHoraCrea) {
    $this->Usu_FechaHoraCrea = $Usu_FechaHoraCrea;
  }

  function setUsu_Cargo($Usu_Cargo) {
    $this->Usu_Cargo = $Usu_Cargo;
  }

  function setUsu_Correo($Usu_Correo) {
    $this->Usu_Correo = $Usu_Correo;
  }

  function setUsu_Telefono($Usu_Telefono) {
    $this->Usu_Telefono = $Usu_Telefono;
  }

  function setUsu_Rol($Usu_Rol) {
    $this->Usu_Rol = $Usu_Rol;
  }

  function setUsu_Estado($Usu_Estado) {
    $this->Usu_Estado = $Usu_Estado;
  }
    
  function setUsu_TipoFlujo($Usu_TipoFlujo) {
    $this->Usu_TipoFlujo = $Usu_TipoFlujo;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "Usu_Usuario", "Usu_Contrasena", "Usu_Nombre", "Usu_Apellido", "Usu_FechaHoraCrea", "Usu_Cargo", "Usu_Correo", "Usu_Telefono", "Usu_Rol", "Usu_Estado", "Usu_TipoFlujo");
    $valores = array(
    array(
      $this->Pla_Codigo, 
      $this->Usu_Usuario, 
      $this->Usu_Contrasena, 
      $this->Usu_Nombre, 
      $this->Usu_Apellido, 
      $this->Usu_FechaHoraCrea, 
      $this->Usu_Cargo, 
      $this->Usu_Correo, 
      $this->Usu_Telefono, 
      $this->Usu_Rol, 
      $this->Usu_Estado,
      $this->Usu_TipoFlujo
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
    $sql =  "SELECT * FROM usuarios WHERE Usu_Codigo = :cod";
    $parametros = array(":cod"=>$this->Usu_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setUsu_Usuario($res[2]);
      $this->setUsu_Contrasena($res[3]);
      $this->setUsu_Nombre($res[4]);
      $this->setUsu_Apellido($res[5]);
      $this->setUsu_FechaHoraCrea($res[6]);
      $this->setUsu_Cargo($res[7]);
      $this->setUsu_Correo($res[8]);
      $this->setUsu_Telefono($res[9]);
      $this->setUsu_Rol($res[10]);
      $this->setUsu_Estado($res[11]);
      $this->setUsu_TipoFlujo($res[12]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "Usu_Usuario", "Usu_Nombre", "Usu_Apellido", "Usu_FechaHoraCrea", "Usu_Cargo", "Usu_Correo", "Usu_Telefono", "Usu_Rol", "Usu_Estado", "Usu_TipoFlujo");
    $valores = array($this->getPla_Codigo(), $this->getUsu_Usuario(), $this->getUsu_Nombre(), $this->getUsu_Apellido(), $this->getUsu_FechaHoraCrea(), $this->getUsu_Cargo(), $this->getUsu_Correo(), $this->getUsu_Telefono(), $this->getUsu_Rol(), $this->getUsu_Estado(), $this->getUsu_TipoFlujo());
    $llaveprimaria = "Usu_Codigo";
    $valorllaveprimaria = $this->getUsu_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM usuarios WHERE Usu_Codigo = :cod";
    $parametros = array(":cod"=>$this->Usu_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
    
    
  /* Autor: RxDavid
     Fecha: 12 de Febrero 2021
     Descripción: Valida la información de Logueo
  */
    
    public function validar(){
		$sql = "SELECT Usu_Codigo, Usu_Nombre, Usu_Apellido, Usu_Estado FROM usuarios WHERE Usu_Usuario = :usu AND Usu_Contrasena = :cla AND Usu_Estado = 1";
		$parametros = array(":usu"=>$this->Usu_Usuario, ":cla"=>$this->Usu_Contrasena);
		
		if($this->consultaSQL($sql, $parametros)){
			$res = $this->cargarRegistro();
      
      $this->setUsu_Codigo($res[0]);
			$this->setUsu_Nombre($res[1]);
			$this->setUsu_Apellido($res[2]);
			$this->setUsu_Estado($res[3]);
			
			$this->desconectar();
			
			if($res==NULL){
				return false;
			}else{
				return true;
			}
		}
		$this->desconectar();
		return false;
	}
    
  /*
  Autor: Willy
  Fecha: 14 de Febrero 2021
  Descripción:
  Parámetros:
  */
  public function listarUsuariosPrinpal($estado, $planta = NULL, $usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Usu_Codigo, Usu_Usuario, Usu_Nombre, Usu_Apellido, Usu_Cargo, Usu_Correo, Usu_Telefono, Usu_Rol, Usu_TipoFlujo, CONCAT_WS(' - ',Pla_Marca,Pla_Nombre)
FROM usuarios u INNER JOIN plantas p ON p.Pla_Codigo = u.Pla_Codigo
WHERE u.Pla_Codigo IN (SELECT up.Pla_Codigo FROM usuarios_plantas up WHERE up.Usu_Codigo = :usu) ";
    
    if($estado != "-1"){
      $sql .= " AND Usu_Estado = :est ";
      $parametros[':est'] = $estado;
    }
    if($planta != NULL){
      $priMar = 1;
      foreach($planta as $registro2){
        if($priMar == 1){
            $sql .= " AND p.Pla_Codigo IN (";
        }else{
            $sql .= " , ";
        }
        $sql .= " :pla".$priMar;
        $parametros[':pla'.$priMar] = $registro2;
        $priMar++;
      }
      $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
    }
    
    $sql .= " ORDER BY Usu_Nombre ASC, Usu_Apellido ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
    /*
  Autor: Willy
  Fecha: 14 de Febrero 2021
  Descripción:
  Parámetros:
  */
  public function listarUsuariosFluA($codigo, $usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT u.Usu_Codigo, CONCAT_WS(' ', u.Usu_Nombre, u.Usu_Apellido) AS Nomb
FROM usuarios u
WHERE u.Usu_Estado = 1 AND u.Pla_Codigo IN (SELECT up.Pla_Codigo FROM usuarios_plantas up WHERE up.Usu_Codigo = :usu) ";
    
    if($codigo != "-1"){
      $sql .= " AND u.Usu_Codigo = :cod ";
      $parametros[':cod'] = $codigo;
    }
    
    
    $sql .= " ORDER BY Nomb ASC";

//    echo $sql;
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    /*
  Autor: Willy
  Fecha: 18 de Febrero 2021
  Descripción:
  Parámetros:
  */
  public function crearUsuariosFluA($usuario){

    $parametros = array(":usu"=>$usuario);
    
    $sql = "SELECT Usu_Codigo, CONCAT(Usu_Nombre,' ', Usu_Apellido), a.Area_Nombre, a.Area_Codigo
FROM usuarios u INNER JOIN areas a ON u.Area_Codigo = a.Area_Codigo
WHERE u.Usu_Estado = 1 AND u.Usu_Codigo = :usu";

    $sql .= " ORDER BY Usu_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
		
	public function cambiarClave($nuevaclave){
    $sql =  "UPDATE usuarios SET Usu_Contrasena = :cla WHERE Usu_Usuario = :usu";
    $parametros = array(":cla"=>md5($nuevaclave), ":usu"=>$this->Usu_Usuario);

    $this->consultaSQL($sql, $parametros);
    $this->desconectar();
  }
		
	public function restaurarClave($codigo, $nuevaclave){
    $sql =  "UPDATE usuarios SET Usu_Contrasena = :cla WHERE Usu_Codigo = :cod";
    $parametros = array(":cla"=>md5($nuevaclave), ":cod"=>$codigo);

    $this->consultaSQL($sql, $parametros);
    $this->desconectar();
  }
    
  /*
  Autor: Willy
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarUsuariosCarge($usuario){
    
    $parametros = array(":usu"=>$usuario);
    
  $sql = "SELECT u.Usu_Codigo, CONCAT_WS(' ', Usu_Nombre, Usu_Apellido) as Nombre
FROM usuarios u
WHERE u.Pla_Codigo IN (SELECT up.Pla_Codigo FROM usuarios_plantas up WHERE up.Usu_Codigo = :usu)
ORDER BY Nombre";
		
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
  public function listarUsuariosConsolidado(){
		
  $sql = "SELECT Usu_Codigo, CONCAT_WS(' ', Usu_Nombre, Usu_Apellido) as Nombre
FROM usuarios
ORDER BY Nombre";
		
  $this->consultaSQL($sql);
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
  public function listarUltimoUsuarioCrear(){

//    $parametros = array(":aca"=>$notaria);

    $sql = "SELECT Usu_Codigo FROM usuarios ORDER BY Usu_Codigo DESC LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res[0];
  }

		
}
?>