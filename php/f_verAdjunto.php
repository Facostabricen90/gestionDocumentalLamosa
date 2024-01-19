<?php
include("op_sesion.php");
include("../class/adjuntos.php");
$adj = new adjuntos();
$adj->setAdj_Codigo($_POST['codigo']);
$adj->consultar();

$arc = $adj->getAdj_Ruta();
$valores = explode('.', $arc);
$extension = strtoupper(end($valores));
if($extension == "PNG" || $extension == "JPG" || $extension == "JPEG"){
//echo $extension."<br>";
?>
 <img style="width: 60%;" src='../imagenes/adjuntos/<?php echo $adj->getAdj_Ruta(); ?>' alt="">
<?php
}elseif($extension == "PDF"){
?>
 <embed src='../imagenes/adjuntos/<?php echo $adj->getAdj_Ruta(); ?>' type="application/pdf" width="100%" height="600px" />
<?php
}else{
?>
 <a style="" class="e_AbrirPagina" href='../imagenes/adjuntos/<?php echo $adj->getAdj_Ruta(); ?>'><?php echo $adj->getAdj_Nombre();?> - Descargar</a>
<?php
}
?>
