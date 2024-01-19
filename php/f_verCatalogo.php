<?php
include("op_sesion.php");
include("../class/solicitudes.php");

$sol = new solicitudes();
$sol->setSol_Codigo($_POST['codigo']);
$sol->consultar();
?>

<?php $nombre_fichero = "../imagenes/formatos/".$sol->getSol_Formato(); ?>
<?php if($sol->getSol_PDF() != '' && $sol->getSol_PDF() != NULL){ ?>
<?php $nombre_fichero2 = "../imagenes/PDF/".$sol->getSol_PDF(); }?>
<?php 
?>
<?php if (file_exists($nombre_fichero2)) { ?>
<embed src="../imagenes/PDF/<?php echo $sol->getSol_PDF(); ?>" type="application/pdf" width="100%" height="500px" />

<?php } else {
if (file_exists($nombre_fichero)){?>
 <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="Historial_<?php echo $sol->getSol_Formato(); ?>" target="_blank">Descargar: <?php echo $sol->getSol_Formato(); ?></a> 
<?php
}else{?>
  <td></td>
<?php
}
} ?>	