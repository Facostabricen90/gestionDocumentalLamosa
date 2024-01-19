<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$_POST['nombre'].".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<h1 align="center"><?php echo $_POST['nombre']; ?></h1>

<?php echo str_replace('\\"', '"', $_POST['resultado']); ?>
</body>