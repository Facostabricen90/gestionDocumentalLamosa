<?php

require_once('basedatos.php');

class areas extends basedatos {

    private $Area_Codigo;
    private $Area_Nombre;
    private $Pla_Codigo;
    private $Area_Estado;
    private $Area_FechaHora;
    private $Area_Usuario;
    private $Area_Informes;
    private $Area_Alias;

    function __construct($Area_Codigo = NULL, $Area_Nombre = NULL, $Pla_Codigo = NULL, $Area_Estado = NULL, $Area_FechaHora = NULL, $Area_Usuario = NULL, $Area_Informes = NULL, $Area_Alias = NULL) {
        $this->Area_Codigo = $Area_Codigo;
        $this->Area_Nombre = $Area_Nombre;
        $this->Pla_Codigo = $Pla_Codigo;
        $this->Area_Estado = $Area_Estado;
        $this->Area_FechaHora = $Area_FechaHora;
        $this->Area_Usuario = $Area_Usuario;
        $this->Area_Informes = $Area_Informes;
        $this->Area_Alias = $Area_Alias;
        $this->tabla = "areas";
    }

    function getArea_Codigo() {
        return $this->Area_Codigo;
    }

    function getArea_Nombre() {
        return $this->Area_Nombre;
    }

    function getPla_Codigo() {
        return $this->Pla_Codigo;
    }

    function getArea_Estado() {
        return $this->Area_Estado;
    }

    function getArea_FechaHora() {
        return $this->Area_FechaHora;
    }

    function getArea_Usuario() {
        return $this->Area_Usuario;
    }

    function getArea_Informes() {
        return $this->Area_Informes;
    }

    function getArea_Alias() {
        return $this->Area_Alias;
    }

    function setArea_Codigo($Area_Codigo) {
        $this->Area_Codigo = $Area_Codigo;
    }

    function setArea_Nombre($Area_Nombre) {
        $this->Area_Nombre = $Area_Nombre;
    }

    function setPla_Codigo($Pla_Codigo) {
        $this->Pla_Codigo = $Pla_Codigo;
    }

    function setArea_Estado($Area_Estado) {
        $this->Area_Estado = $Area_Estado;
    }

    function setArea_FechaHora($Area_FechaHora) {
        $this->Area_FechaHora = $Area_FechaHora;
    }

    function setArea_Usuario($Area_Usuario) {
        $this->Area_Usuario = $Area_Usuario;
    }

    function setArea_Informes($Area_Informes) {
        $this->Area_Informes = $Area_Informes;
    }

    function setArea_Alias($Area_Alias) {
        $this->Area_Alias = $Area_Alias;
    }

    public function insertar() {
        $campos = array("Area_Nombre", "Pla_Codigo", "Area_Estado", "Area_FechaHora", "Area_Usuario", "Area_Informes", "Area_Alias");
        $valores = array(
            array(
                $this->Area_Nombre,
                $this->Pla_Codigo,
                $this->Area_Estado,
                $this->Area_FechaHora,
                $this->Area_Usuario,
                $this->Area_Informes,
                $this->Area_Alias
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
        $sql = "SELECT * FROM areas WHERE Area_Codigo = :cod";
        $parametros = array(":cod" => $this->Area_Codigo);
        if ($this->consultaSQL($sql, $parametros)) {
            $res = $this->cargarRegistro();

            $this->setArea_Nombre($res[1]);
            $this->setPla_Codigo($res[2]);
            $this->setArea_Estado($res[3]);
            $this->setArea_FechaHora($res[4]);
            $this->setArea_Usuario($res[5]);
            $this->setArea_Informes($res[6]);
            $this->setArea_Alias($res[7]);

            $this->desconectar();
        }
    }

    public function actualizar() {
        $campos = array("Area_Nombre", "Pla_Codigo", "Area_Estado", "Area_FechaHora", "Area_Usuario", "Area_Informes", "Area_Alias");
        $valores = array($this->getArea_Nombre(), $this->getPla_Codigo(), $this->getArea_Estado(), $this->getArea_FechaHora(), $this->getArea_Usuario(), $this->getArea_Informes(), $this->getArea_Alias());
        $llaveprimaria = "Area_Codigo";
        $valorllaveprimaria = $this->getArea_Codigo();
        $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
        $this->desconectar();
        return $res;
    }

    public function eliminar() {
        $sql = "DELETE FROM areas WHERE Area_Codigo = :cod";
        $parametros = array(":cod" => $this->Area_Codigo);
        $res = $this->consultaSQL($sql, $parametros);
        $this->desconectar();
        return $res;
    }

    /*
      Autor: WillyTY
      Fecha: 12 de febrero de 2021
      Descripción:
      Parámetros:
     */

    public function listarAreasPrincipal($estado, $usuario, $planta = NULL) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT Area_Codigo, Area_Nombre, CONCAT_WS(' - ',Pla_Marca,Pla_Nombre) FROM areas a INNER JOIN plantas p ON p.Pla_Codigo = a.Pla_Codigo
    WHERE a.Pla_Codigo IN (SELECT u.Pla_Codigo FROM usuarios u WHERE Usu_Codigo = :usu)";

        if ($estado != "-1") {
            $sql .= " AND Area_Estado = :est ";
            $parametros[':est'] = $estado;
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
        $sql .= " ORDER BY Area_Nombre ASC";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha: 15 de febrero de 2021
      Descripción:
      Parámetros:
     */

    public function listarAreasFiltro() {

//    $parametros = array(":usu"=>$usuario);

        $sql = "SELECT Area_Codigo, Area_Nombre FROM areas 
    WHERE Area_Estado= 1
    ORDER BY Area_Nombre ASC";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    /*
      Autor: Willy
      Fecha: 15 de febrero de 2021
      Descripción:
      Parámetros:
     */

    public function listarAreasFiltroFluA($area, $usuario) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT Area_Codigo, Area_Nombre FROM areas 
    WHERE Pla_Codigo IN (SELECT Pla_Codigo FROM usuarios WHERE Usu_Codigo = :usu) AND Area_Estado= 1 ";

        if ($area != "-1") {
            $sql .= "AND Area_Codigo = :are ";
            $parametros[':are'] = $area;
        }

        $sql .= "ORDER BY Area_Nombre ASC";

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

    public function listarAreasPlantasDistintas($planta) {

        $parametros = array(":pla" => $planta);

        $sql = "SELECT Area_Codigo, Area_Nombre FROM areas WHERE Area_Estado = '1' AND Pla_Codigo = :pla Order BY Area_Nombre";

        /* if ($_SESSION['GD_Usuario'] == "2") {
            echo "---listarAreasPlantasDistintas---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        } */
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    
    //Enlista las area s que no se han agregado al usuario especificado en su edicion de perfil seccion usuarios -- S.Acosta
     public function listarAreasPlantasDistintasParaUsuarios($planta, $usuario) {

        $parametros = array(":pla" => $planta , ":usu" => $usuario);

        $sql = "SELECT Area_Codigo, Area_Nombre 
FROM areas 
WHERE Area_Estado = '1' 
AND Pla_Codigo = :pla
AND Area_Nombre NOT IN (
SELECT a.Area_Nombre
FROM usuarios_areas ua
INNER JOIN areas a ON ua.Area_Codigo = a.Area_Codigo
WHERE Usu_Codigo = :usu
)
Order BY Area_Nombre";

        if ($_SESSION['GD_Usuario'] == "2") {
            echo "---listarAreasPlantasDistintas---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        }
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    
    public function listarAreasPlantasDistintas2($planta) {

        $parametros = array();

        //$sql = "SELECT Area_Codigo, Area_Nombre FROM areas WHERE Area_Estado = '1' AND Area_Informes = '1' AND Pla_Codigo = :pla Order BY Area_Nombre";
        $sql = "SELECT Area_Codigo, Area_Nombre FROM areas WHERE Area_Estado = '1'";

        if ($planta != NULL) {
            $priMar = 1;
            foreach ($planta as $registro2) {
                if ($priMar == 1) {
                    $sql .= " AND Pla_Codigo IN ( '1' , ";
                } else {
                    $sql .= " , ";
                }
                $sql .= " :pla" . $priMar;
                $parametros[':pla' . $priMar] = $registro2;
                $priMar++;
            }
            $sql .= " )";
        }
            
            $sql .= " Order BY Area_Nombre";
        
        /* if ($_SESSION['GD_Usuario'] == "2") {
            echo "---listarAreasPlantasDistintas---" . "<br>" . $sql;
            var_dump($parametros);
            echo "<br>";
        } */
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

    public function listarUsuarioSolicitudesFlujo($usuario) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT ua.Area_Codigo
FROM usuarios u INNER JOIN usuarios_areas ua ON u.Usu_Codigo = ua.Usu_Codigo 
WHERE u.Usu_Codigo = :usu";

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

    public function listarAreasAliasFiltro($usuario) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT a.Area_Codigo, Area_Nombre, Area_Alias 
FROM usuarios u 
INNER JOIN usuarios_areas ua ON u.Usu_Codigo = ua.Usu_Codigo 
INNER JOIN areas a ON ua.Area_Codigo = a.Area_Codigo
    WHERE Area_Estado= 1 AND Area_Alias != '' AND Area_Alias IS NOT NULL AND u.Usu_Codigo = :usu
    ORDER BY a.Area_Nombre ASC";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    
    public function listarAreasAliasFiltroConPlantas($usuario) {

        $parametros = array(":usu" => $usuario);

        $sql = "SELECT a.Area_Codigo, Area_Nombre, Area_Alias 
FROM usuarios u 
INNER JOIN usuarios_areas ua ON u.Usu_Codigo = ua.Usu_Codigo 
INNER JOIN areas a ON ua.Area_Codigo = a.Area_Codigo
    WHERE Area_Estado= 1 AND Area_Alias != '' AND Area_Alias IS NOT NULL AND u.Usu_Codigo = :usu
    ORDER BY a.Area_Nombre ASC";

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

    public function codigoAreaPlantaNombre($nombre, $planta) {

        $parametros = array(":nom" => $nombre, ":pla" => $planta);

        $sql = "select Area_Codigo from areas where Area_Nombre = :nom and Pla_Codigo = :pla order by Area_Codigo desc limit 1";

        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarRegistro();
        $this->desconectar();
        return $res['Area_Codigo'];
    }

    /*
      Autor: Willy
      Fecha:
      Descripción:
      Parámetros:
     */

    public function listarAreasPlantas() {
        $sql = "Select Area_Codigo, Area_Nombre
From areas where Pla_Codigo = :pla and Area_Estado = 1 order by Area_Nombre";
        $parametros = array(":pla" => $this->Pla_Codigo);
        $this->consultaSQL($sql, $parametros);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    
    public function listarAreasPlantasFlujoTres() {
        $sql = "Select Area_Codigo, Area_Nombre, Area_Alias
From areas where Pla_Codigo = :pla and Area_Estado = 1 order by Area_Nombre";
        $parametros = array(":pla" => $this->Pla_Codigo);
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
WHERE plantas.Pla_Codigo = usuarios.Pla_Codigo AND usuarios.Usu_Codigo = :usu
ORDER BY areas.Area_Nombre ASC";

		$this->consultaSQL($sql, $parametros);
		$res = $this->cargarTodo();
		$this->desconectar();
		return $res;
	}
public function listarAreasUsuariosFiltroPlantare($usuario){

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
}
?>
