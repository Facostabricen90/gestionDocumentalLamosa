<?php
session_start();
unset($_SESSION['GD_Usuario']);
unset($_SESSION['GDOPE_Usuario']);
session_destroy();
header("Location: ../index.php");
?>