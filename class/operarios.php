<?php

require_once('basedatos.php');

class operarios extends basedatos {

    private $Ope_Codigo;
    private $Area_Codigo;
    private $Ope_Nombre;
    private $Ope_Apellido;
    private $Ope_Cedula;
    private $Ope_Correo;
    private $Ope_Telefono;
    private $Ope_FechaHoraCrea;
    private $Ope_Usuario;
    private $Ope_Estado;
    private $Ope_Sexo;
    private $Ope_CodigoCCosto;
    private $Ope_NombreCCosto;
    private $Ope_Jefe;
    private $Ope_Cargo;
    private $Ope_AreaLATAM;
    private $Ope_TipoFuncion;
    private $Ope_Gerencia;
    private $Ope_SubArea;
    private $Ope_Contrasena;
    private $Pla_Codigo;

    function __construct($Ope_Codigo = NULL, $Area_Codigo = NULL, $Ope_Nombre = NULL, $Ope_Apellido = NULL, $Ope_Cedula = NULL, $Ope_Correo = NULL, $Ope_Telefono = NULL, $Ope_FechaHoraCrea = NULL, $Ope_Usuario = NULL, $Ope_Estado = NULL, $Ope_Sexo = NULL, $Ope_CodigoCCosto = NULL, $Ope_NombreCCosto = NULL, $Ope_Jefe = NULL, $Ope_Cargo = NULL, $Ope_AreaLATAM = NULL, $Ope_TipoFuncion = NULL, $Ope_Gerencia = NULL, $Ope_SubArea = NULL, $Ope_Contrasena = NULL, $Pla_Codigo = NULL) {
        $this->Ope_Codigo = $Ope_Codigo;
        $this->Area_Codigo = $Area_Codigo;
        $this->Ope_Nombre = $Ope_Nombre;
        $this->Ope_Apellido = $Ope_Apellido;
        $this->Ope_Cedula = $Ope_Cedula;
        $this->Ope_Correo = $Ope_Correo;
        $this->Ope_Telefono = $Ope_Telefono;
        $this->Ope_FechaHoraCrea = $Ope_FechaHoraCrea;
        $this->Ope_Usuario = $Ope_Usuario;
        $this->Ope_Estado = $Ope_Estado;
        $this->Ope_Sexo = $Ope_Sexo;
        $this->Ope_CodigoCCosto = $Ope_CodigoCCosto;
        $this->Ope_NombreCCosto = $Ope_NombreCCosto;
        $this->Ope_Jefe = $Ope_Jefe;
        $this->Ope_Cargo = $Ope_Cargo;
        $this->Ope_AreaLATAM = $Ope_AreaLATAM;
        $this->Ope_TipoFuncion = $Ope_TipoFuncion;
        $this->Ope_Gerencia = $Ope_Gerencia;
        $this->Ope_SubArea = $Ope_SubArea;
        $this->Ope_Contrasena = $Ope_Contrasena;
        $this->Pla_Codigo = $Pla_Codigo;
        $this->tabla = "operarios";
    }

    function getOpe_Codigo() {
        return $this->Ope_Codigo;
    }

    function getArea_Codigo() {
        return $this->Area_Codigo;
    }

    function getOpe_Nombre() {
        return $this->Ope_Nombre;
    }

    function getOpe_Apellido() {
        return $this->Ope_Apellido;
    }

    function getOpe_Cedula() {
        return $this->Ope_Cedula;
    }

    function getOpe_Correo() {
        return $this->Ope_Correo;
    }

    function getOpe_Telefono() {
        return $this->Ope_Telefono;
    }

    function getOpe_FechaHoraCrea() {
        return $this->Ope_FechaHoraCrea;
    }

    function getOpe_Usuario() {
        return $this->Ope_Usuario;
    }

    function getOpe_Estado() {
        return $this->Ope_Estado;
    }

    function getOpe_Sexo() {
        return $this->Ope_Sexo;
    }

    function getOpe_CodigoCCosto() {
        return $this->Ope_CodigoCCosto;
    }

    function getOpe_NombreCCosto() {
        return $this->Ope_NombreCCosto;
    }

    function getOpe_Jefe() {
        return $this->Ope_Jefe;
    }

    function getOpe_Cargo() {
        return $this->Ope_Cargo;
    }

    function getOpe_AreaLATAM() {
        return $this->Ope_AreaLATAM;
    }

    function getOpe_TipoFuncion() {
        return $this->Ope_TipoFuncion;
    }

    function getOpe_Gerencia() {
        return $this->Ope_Gerencia;
    }

    function getOpe_SubArea() {
        return $this->Ope_SubArea;
    }

    function getOpe_Contrasena() {
        return $this->Ope_Contrasena;
    }

    function getPla_Codigo() {
        return $this->Pla_Codigo;
    }

    function setOpe_Codigo($Ope_Codigo) {
        $this->Ope_Codigo = $Ope_Codigo;
    }

    function setArea_Codigo($Area_Codigo) {
        $this->Area_Codigo = $Area_Codigo;
    }

    function setOpe_Nombre($Ope_Nombre) {
        $this->Ope_Nombre = $Ope_Nombre;
    }

    function setOpe_Apellido($Ope_Apellido) {
        $this->Ope_Apellido = $Ope_Apellido;
    }

    function setOpe_Cedula($Ope_Cedula) {
        $this->Ope_Cedula = $Ope_Cedula;
    }

    function setOpe_Correo($Ope_Correo) {
        $this->Ope_Correo = $Ope_Correo;
    }

    function setOpe_Telefono($Ope_Telefono) {
        $this->Ope_Telefono = $Ope_Telefono;
    }

    function setOpe_FechaHoraCrea($Ope_FechaHoraCrea) {
        $this->Ope_FechaHoraCrea = $Ope_FechaHoraCrea;
    }

    function setOpe_Usuario($Ope_Usuario) {
        $this->Ope_Usuario = $Ope_Usuario;
    }

    function setOpe_Estado($Ope_Estado) {
        $this->Ope_Estado = $Ope_Estado;
    }

    function setOpe_Sexo($Ope_Sexo) {
        $this->Ope_Sexo = $Ope_Sexo;
    }

    function setOpe_CodigoCCosto($Ope_CodigoCCosto) {
        $this->Ope_CodigoCCosto = $Ope_CodigoCCosto;
    }

    function setOpe_NombreCCosto($Ope_NombreCCosto) {
        $this->Ope_NombreCCosto = $Ope_NombreCCosto;
    }

    function setOpe_Jefe($Ope_Jefe) {
        $this->Ope_Jefe = $Ope_Jefe;
    }

    function setOpe_Cargo($Ope_Cargo) {
        $this->Ope_Cargo = $Ope_Cargo;
    }

    function setOpe_AreaLATAM($Ope_AreaLATAM) {
        $this->Ope_AreaLATAM = $Ope_AreaLATAM;
    }

    function setOpe_TipoFuncion($Ope_TipoFuncion) {
        $this->Ope_TipoFuncion = $Ope_TipoFuncion;
    }

    function setOpe_Gerencia($Ope_Gerencia) {
        $this->Ope_Gerencia = $Ope_Gerencia;
    }

    function setOpe_SubArea($Ope_SubArea) {
        $this->Ope_SubArea = $Ope_SubArea;
    }

    function setOpe_Contrasena($Ope_Contrasena) {
        $this->Ope_Contrasena = $Ope_Contrasena;
    }

    function setPla_Codigo($Pla_Codigo) {
        $this->Pla_Codigo = $Pla_Codigo;
    }

    public function insertar() {
        $campos = array("Area_Codigo", "Ope_Nombre", "Ope_Apellido", "Ope_Cedula", "Ope_Correo", "Ope_Telefono", "Ope_FechaHoraCrea", "Ope_Usuario", "Ope_Estado", "Ope_Sexo", "Ope_CodigoCCosto", "Ope_NombreCCosto", "Ope_Jefe", "Ope_Cargo", "Ope_AreaLATAM", "Ope_TipoFuncion", "Ope_Gerencia", "Ope_SubArea", "Ope_Contrasena", "Pla_Codigo");
        $valores = array(
            array(
                $this->Area_Codigo,
                $this->Ope_Nombre,
                $this->Ope_Apellido,
                $this->Ope_Cedula,
                $this->Ope_Correo,
                $this->Ope_Telefono,
                $this->Ope_FechaHoraCrea,
                $this->Ope_Usuario,
                $this->Ope_Estado,
                $this->Ope_Sexo,
                $this->Ope_CodigoCCosto,
                $this->Ope_NombreCCosto,
                $this->Ope_Jefe,
                $this->Ope_Cargo,
                $this->Ope_AreaLATAM,
                $this->Ope_TipoFuncion,
                $this->Ope_Gerencia,
                $this->Ope_SubArea,
                $this->Ope_Contrasena,
                $this->Pla_Codigo
            )
        );

        $resultado = $this->insertarRegistros($campos, $valores);
        $this->desconectar();

        if ($resultado[0] == "OK") {
            return true;
        } else {
            return false;
        }
    }

    public function consultar() {
        $sql = "SELECT * FROM operarios WHERE Ope_Codigo = :cod";
        $parametros = array(":cod" => $this->Ope_Codigo);
        if ($this->consultaSQL($sql, $parametros)) {
            $res = $this->cargarRegistro();

            $this->setArea_Codigo($res[1]);
            $this->setOpe_Nombre($res[2]);
            $this->setOpe_Apellido($res[3]);
            $this->setOpe_Cedula($res[4]);
            $this->setOpe_Correo($res[5]);
            $this->setOpe_Telefono($res[6]);
            $this->setOpe_FechaHoraCrea($res[7]);
            $this->setOpe_Usuario($res[8]);
            $this->setOpe_Estado($res[9]);
            $this->setOpe_Sexo($res[10]);
            $this->setOpe_CodigoCCosto($res[11]);
            $this->setOpe_NombreCCosto($res[12]);
            $this->setOpe_Jefe($res[13]);
            $this->setOpe_Cargo($res[14]);
            $this->setOpe_AreaLATAM($res[15]);
            $this->setOpe_TipoFuncion($res[16]);
            $this->setOpe_Gerencia($res[17]);
            $this->setOpe_SubArea($res[18]);
            $this->setOpe_Contrasena($res[19]);
            $this->setPla_Codigo($res[20]);

            $this->desconectar();
        }
    }

    public function actualizar() {
        $campos = array("Area_Codigo", "Ope_Nombre", "Ope_Apellido", "Ope_Cedula", "Ope_Correo", "Ope_Telefono", "Ope_FechaHoraCrea", "Ope_Usuario", "Ope_Estado", "Ope_Sexo", "Ope_CodigoCCosto", "Ope_NombreCCosto", "Ope_Jefe", "Ope_Cargo", "Ope_AreaLATAM", "Ope_TipoFuncion", "Ope_Gerencia", "Ope_SubArea", "Ope_Contrasena", "Pla_Codigo");
        $valores = array($this->getArea_Codigo(), $this->getOpe_Nombre(), $this->getOpe_Apellido(), $this->getOpe_Cedula(), $this->getOpe_Correo(), $this->getOpe_Telefono(), $this->getOpe_FechaHoraCrea(), $this->getOpe_Usuario(), $this->getOpe_Estado(), $this->getOpe_Sexo(), $this->getOpe_CodigoCCosto(), $this->getOpe_NombreCCosto(), $this->getOpe_Jefe(), $this->getOpe_Cargo(), $this->getOpe_AreaLATAM(), $this->getOpe_TipoFuncion(), $this->getOpe_Gerencia(), $this->getOpe_SubArea(), $this->getOpe_Contrasena(), $this->getPla_Codigo());
        $llaveprimaria = "Ope_Codigo";
        $valorllaveprimaria = $this->getOpe_Codigo();
        $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
        $this->desconectar();
        return $res;
    }

    public function eliminar() {
        $sql = "DELETE FROM operarios WHERE Ope_Codigo = :cod";
        $parametros = array(":cod" => $this->Ope_Codigo);
        $res = $this->consultaSQL($sql, $parametros);
        $this->desconectar();
        return $res;
    }

    /* Autor: RxDavid
      Fecha: 29 de Julio 2021
      Descripción: Valida la información de Logueo
     */

    public function validarOperario() {

        $parametros = array(":usu" => $this->Ope_Cedula, ":cla" => $this->Ope_Contrasena);

        $sql = "SELECT Ope_Codigo, Ope_Nombre, Ope_Apellido, Ope_Estado FROM operarios WHERE Ope_Cedula = :usu AND Ope_Contrasena = :cla AND Ope_Estado = 1";

        if ($this->consultaSQL($sql, $parametros)) {
            $res = $this->cargarRegistro();

            $this->setOpe_Codigo($res[0]);
            $this->setOpe_Nombre($res[1]);
            $this->setOpe_Apellido($res[2]);
            $this->setOpe_Estado($res[3]);

            $this->desconectar();

            if ($res == NULL) {
                return false;
            } else {
                return true;
            }
        }
        $this->desconectar();
        return false;
    }

    /*
      Autor: Willy
      Fecha: 15 de febrero de 2021
      Descripción:
      Parámetros:
     */

    public function listarOperariosPrinpal($estado, $area, $subArea , $usuario, $planta = NULL) {

        $parametros = array(":est" => $estado, ":usu" => $usuario);

        $sql = "SELECT Ope_Codigo, CONCAT_WS(' ', Ope_Nombre, Ope_Apellido) AS NOMBRE, Ope_Cedula, Ope_Sexo, Ope_CodigoCCosto, Ope_NombreCCosto, Ope_Jefe, 
    Ope_Cargo, Ope_TipoFuncion, Ope_AreaLATAM, Ope_Gerencia, Area_Nombre, Ope_SubArea, Ope_Correo, Ope_Telefono,  CONCAT_WS(' - ',Pla_Marca,Pla_Nombre), Pla_Nombre as planta_nombre
    FROM operarios op INNER JOIN areas ar 
    ON op.Area_Codigo = ar.Area_Codigo
    INNER JOIN plantas p ON p.Pla_Codigo = op.Pla_Codigo
    WHERE op.Pla_Codigo IN (SELECT up.Pla_Codigo FROM usuarios_plantas up WHERE Usu_Codigo = :usu) AND Ope_Estado = :est";

        if ($area != "-1") {
            $sql .= " AND ar.Area_Nombre = :are";
            $parametros[':are'] = $area;
        }
        
        if ($subArea != "-1") {
            $sql .= " AND op.Ope_SubArea = :subAre";
            $parametros[':subAre'] = $subArea;
        }

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND p.Pla_Codigo IN (";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
//      $sql .= " AND Pla_Marca IN (:pais) ";
//      $parametros[':pais'] = $pais;
        }

        $sql .= " ORDER BY Ope_Nombre ASC, Ope_Apellido ASC";

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

    public function listarOperariosFiltro($usuario) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT Ope_Codigo, Area_Codigo, Ope_Nombre, Ope_Apellido, Ope_Cedula, Ope_Correo, Ope_Telefono 
    FROM operarios 
    WHERE Pla_Codigo IN (SELECT Pla_Codigo FROM usuarios_plantas WHERE Usu_Codigo = :usu) AND Ope_Estado =1 
    ORDER BY Ope_Nombre ASC, Ope_Apellido ASC";

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

    public function cantidadOperariosArea($area, $planta) {

        $parametros = array(":are" => $area, ":pla" => $planta);

        $sql = "SELECT COUNT(Ope_Codigo) AS CantOpe
    FROM operarios
    WHERE Area_Codigo = :are 
      AND Ope_Estado = 1 AND Pla_Codigo = :pla
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

    public function listarOperariosCapacitaciones($area, $planta) {

        $parametros = array(":are" => $area, ":pla" => $planta);

        $sql = "SELECT Ope_Codigo, CONCAT_WS(' ', Ope_Nombre, Ope_Apellido) AS NomCom
    FROM operarios
    WHERE Area_Codigo = :are AND Ope_Estado = 1 AND Pla_Codigo = :pla ";

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

    public function listarOperariosCapacitaciones2($area, $planta) {

        $parametros = array(":are" => $area, ":pla" => $planta);

        $sql = "SELECT Ope_Codigo, CONCAT_WS(' ', Ope_Apellido,Ope_Nombre ) AS NomCom
    FROM operarios
    INNER JOIN  areas on  areas.Area_Codigo = operarios.Area_Codigo
    WHERE Area_Nombre = :are AND Ope_Estado = 1 AND areas.Pla_Codigo = :pla order by Ope_Apellido";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public function listarOperariosCapacitaciones3($area, $planta) {

        $parametros = array(":are" => $area, ":pla" => $planta);

        $sql = "SELECT Ope_Codigo,  CONCAT_WS(' ', Ope_Apellido,Ope_Nombre ) AS NomCom
FROM operarios
INNER JOIN  areas on  areas.Area_Codigo = operarios.Area_Codigo
WHERE areas.Area_Nombre = :are AND Ope_Estado = 1 AND areas.Pla_Codigo = 1
OR operarios.Ope_SubArea = :are
order by Ope_Apellido";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}

?>
