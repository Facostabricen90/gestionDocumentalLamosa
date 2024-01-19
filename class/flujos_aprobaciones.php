<?php
require_once('basedatos.php');

  class flujos_aprobaciones extends basedatos {
    private $FluA_Codigo;
    private $Usu_Codigo;
    private $Area_Codigo;
    private $FluA_Paso;
    private $FluA_FechaHora;
    private $FluA_Usuario;
    private $FluA_Estado;
    private $FluA_TipoFlujo;
    private $Pla_Codigo;
    private $FluA_Responsable;

  function __construct($FluA_Codigo = NULL, $Usu_Codigo = NULL, $Area_Codigo = NULL, $FluA_Paso = NULL, $FluA_FechaHora = NULL, $FluA_Usuario = NULL, $FluA_Estado = NULL, $FluA_TipoFlujo = NULL, $Pla_Codigo = NULL, $FluA_Responsable = NULL) {
    $this->FluA_Codigo = $FluA_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->Area_Codigo = $Area_Codigo;
    $this->FluA_Paso = $FluA_Paso;
    $this->FluA_FechaHora = $FluA_FechaHora;
    $this->FluA_Usuario = $FluA_Usuario;
    $this->FluA_Estado = $FluA_Estado;
    $this->FluA_TipoFlujo = $FluA_TipoFlujo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->FluA_Responsable = $FluA_Responsable;
    $this->tabla = "flujos_aprobaciones";
  }

  function getFluA_Codigo() {
    return $this->FluA_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getArea_Codigo() {
    return $this->Area_Codigo;
  }

  function getFluA_Paso() {
    return $this->FluA_Paso;
  }

  function getFluA_FechaHora() {
    return $this->FluA_FechaHora;
  }

  function getFluA_Usuario() {
    return $this->FluA_Usuario;
  }

  function getFluA_Estado() {
    return $this->FluA_Estado;
  }

  function getFluA_TipoFlujo() {
    return $this->FluA_TipoFlujo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getFluA_Responsable() {
    return $this->FluA_Responsable;
  }

  function setFluA_Codigo($FluA_Codigo) {
    $this->FluA_Codigo = $FluA_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setArea_Codigo($Area_Codigo) {
    $this->Area_Codigo = $Area_Codigo;
  }

  function setFluA_Paso($FluA_Paso) {
    $this->FluA_Paso = $FluA_Paso;
  }

  function setFluA_FechaHora($FluA_FechaHora) {
    $this->FluA_FechaHora = $FluA_FechaHora;
  }

  function setFluA_Usuario($FluA_Usuario) {
    $this->FluA_Usuario = $FluA_Usuario;
  }

  function setFluA_Estado($FluA_Estado) {
    $this->FluA_Estado = $FluA_Estado;
  }

  function setFluA_TipoFlujo($FluA_TipoFlujo) {
    $this->FluA_TipoFlujo = $FluA_TipoFlujo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setFluA_Responsable($FluA_Responsable) {
    $this->FluA_Responsable = $FluA_Responsable;
  }

  public function insertar(){
    $campos = array("Usu_Codigo", "Area_Codigo", "FluA_Paso", "FluA_FechaHora", "FluA_Usuario", "FluA_Estado", "FluA_TipoFlujo", "Pla_Codigo", "FluA_Responsable");
    $valores = array(
    array(
      $this->Usu_Codigo, 
      $this->Area_Codigo, 
      $this->FluA_Paso, 
      $this->FluA_FechaHora, 
      $this->FluA_Usuario, 
      $this->FluA_Estado, 
      $this->FluA_TipoFlujo, 
      $this->Pla_Codigo, 
      $this->FluA_Responsable
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
    $sql =  "SELECT * FROM flujos_aprobaciones WHERE FluA_Codigo = :cod";
    $parametros = array(":cod"=>$this->FluA_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setUsu_Codigo($res[1]);
      $this->setArea_Codigo($res[2]);
      $this->setFluA_Paso($res[3]);
      $this->setFluA_FechaHora($res[4]);
      $this->setFluA_Usuario($res[5]);
      $this->setFluA_Estado($res[6]);
      $this->setFluA_TipoFlujo($res[7]);
      $this->setPla_Codigo($res[8]);
      $this->setFluA_Responsable($res[9]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Usu_Codigo", "Area_Codigo", "FluA_Paso", "FluA_FechaHora", "FluA_Usuario", "FluA_Estado", "FluA_TipoFlujo", "Pla_Codigo", "FluA_Responsable");
    $valores = array($this->getUsu_Codigo(), $this->getArea_Codigo(), $this->getFluA_Paso(), $this->getFluA_FechaHora(), $this->getFluA_Usuario(), $this->getFluA_Estado(), $this->getFluA_TipoFlujo(), $this->getPla_Codigo(), $this->getFluA_Responsable());
    $llaveprimaria = "FluA_Codigo";
    $valorllaveprimaria = $this->getFluA_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM flujos_aprobaciones WHERE FluA_Codigo = :cod";
    $parametros = array(":cod"=>$this->FluA_Codigo);
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
  public function listarFlujosAprPrincipal($estado, $area, $usuario, $tipoFlujo, $usuAdmin,$planta = NULL){

    $parametros = array(":tipflu"=>$tipoFlujo,":usua"=>$usuAdmin);

    $sql = "SELECT fa.FluA_Codigo,CONCAT(u.Usu_Nombre,' ',u.Usu_Apellido) AS NOMBRE, a.Area_Nombre, p.Par_Nombre, p.Par_Orden, p.Par_TipoFlujo, CONCAT_WS(' - ',pl.Pla_Marca,pl.Pla_Nombre) , CONCAT_WS(' - ',plt.Pla_Marca,plt.Pla_Nombre)  
FROM flujos_aprobaciones fa INNER JOIN usuarios u ON fa.Usu_Codigo = u.Usu_Codigo
INNER JOIN areas a ON fa.Area_Codigo = a.Area_Codigo
INNER JOIN parametros p ON fa.FluA_Paso = p.Par_Orden
INNER JOIN plantas pl ON pl.Pla_Codigo = u.Pla_Codigo
INNER JOIN plantas plt ON plt.Pla_Codigo = fa.Pla_Codigo
WHERE FluA_TipoFlujo = :tipflu AND u.Pla_Codigo IN (SELECT up.Pla_Codigo FROM usuarios_plantas up WHERE Usu_Codigo = :usua) ";
    
    if($tipoFlujo == "3"){
      $sql .= " AND p.Par_Tipo = '3' ";
    }else{
      $sql .= " AND p.Par_Tipo = '2' ";
    }
    
    if($estado != "-1"){
      $sql .= " AND fa.FluA_Estado = :est";
      $parametros[':est'] = $estado;
    }    
    if($area != "-1"){
      $sql .= " AND a.Area_Nombre = :are";
      $parametros[':are'] = $area;
    }
    
     if($usuario != "-1"){
      $sql .= " AND fa.Usu_Codigo = :usu";
      $parametros[':usu'] = $usuario;
    }
    
    if($planta != NULL){
      $priMar = 1;
      foreach($planta as $registro2){
        if($priMar == 1){
            $sql .= " AND plt.Pla_Codigo IN (";
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
		
		$sql .= " ORDER BY a.Area_Nombre ASC, p.Par_Orden ASC";

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
	public function listarFlujoAprobacionesSolicitudesUsuarios($usuario){

		$parametros = array(":usu"=>$usuario);

		$sql = "SELECT FluA_Codigo, Area_Codigo, FluA_Paso
FROM flujos_aprobaciones
WHERE FluA_Estado = 1 AND Usu_Codigo = :usu";

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
	public function listarFlujoAprobacionesSolicitudesUsuariosTipoFlujo($usuario){ //, $tipoFlujo

		$parametros = array(":usu"=>$usuario);

		$sql = "SELECT FluA_Codigo, Area_Codigo, FluA_Paso, FluA_TipoFlujo
FROM flujos_aprobaciones
WHERE FluA_Estado = 1 AND Usu_Codigo = :usu AND (FluA_TipoFlujo = 1 OR FluA_TipoFlujo = 2) ";

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
	public function listarFlujoAprobacionesSolicitudesUsuariosTipoFlujoMM($usuario){

		$parametros = array(":usu"=>$usuario);

		$sql = "SELECT FluA_Codigo, Area_Codigo, FluA_Paso, FluA_TipoFlujo
FROM flujos_aprobaciones
WHERE FluA_Estado = 1 AND Usu_Codigo = :usu AND FluA_TipoFlujo = 3 ";

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
	public function listarCorreosPasosNotificar($area, $paso){

		$parametros = array(":are"=>$area, ":pas"=>$paso);

		$sql = "SELECT CONCAT_WS(' ', Usu_Nombre, Usu_Apellido) AS NomUsu, Usu_Correo
FROM flujos_aprobaciones
INNER JOIN usuarios ON flujos_aprobaciones.Usu_Codigo = usuarios.Usu_Codigo
WHERE flujos_aprobaciones.Area_Codigo = :are AND FluA_Paso = :pas AND FluA_Estado = 1";

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
	public function listarCorreosPasosNotificarTipoFlujo($area, $paso, $tipoFlujo){

		$parametros = array(":are"=>$area, ":pas"=>$paso);

		$sql = "SELECT CONCAT_WS(' ', Usu_Nombre, Usu_Apellido) AS NomUsu, Usu_Correo
FROM flujos_aprobaciones
INNER JOIN usuarios ON flujos_aprobaciones.Usu_Codigo = usuarios.Usu_Codigo
WHERE flujos_aprobaciones.Area_Codigo = :are AND FluA_Paso = :pas AND FluA_Estado = 1 ";
    
    if($tipoFlujo != "A"){
      $sql .= " AND FluA_TipoFlujo = :tipflu ";
      $parametros[":tipflu"] = $tipoFlujo;
    }

		$this->consultaSQL($sql, $parametros);
		$res = $this->cargarTodo();
		$this->desconectar();
		return $res;
	}

}
?>
