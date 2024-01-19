<?php
include("../class/areas.php");
$area = new areas();
$resultado = $area->listarAreasPorPlanta($_POST['codigo']);


?>
<?php foreach($resultado as $res){?>
<option value="<?php echo $res['Area_Codigo']?>"><?php echo $res['Area_Nombre']?></option>
<?php }?>

