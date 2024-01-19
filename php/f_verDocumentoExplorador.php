<?php
include("op_sesion.php");
include("../class/explorador_archivos.php");
$exp = new explorador_archivos();
$exp->setEArc_Codigo($_POST['codigo']);
$exp->consultar();

$arc = $exp->getEArc_Link();
$valores = explode('.', $arc);
$extension = end($valores);
//echo $extension;
?>

<?php if(strtoupper($extension) =='PNG' ||strtoupper($extension) =='JPG' ||strtoupper($extension) =='JPEG' ){ ?>
<!--
IMAGEN-->
<embed src="../imagenes/explorador/<?php echo $exp->getEArc_Link(); ?>" type="image/png" width="100%" height="500px" />
<?php }elseif(strtoupper($extension) =='PDF'){ ?>
<!--
PDF-->
<embed src="../imagenes/explorador/<?php echo $exp->getEArc_Link(); ?>" type="application/pdf" width="100%" height="500px" />
<?php }else{ ?>
<a href="../imagenes/explorador/<?php echo $exp->getEArc_Link(); ?>"><?php echo $exp->getEArc_Nombre(); ?></a>
<?php } ?>