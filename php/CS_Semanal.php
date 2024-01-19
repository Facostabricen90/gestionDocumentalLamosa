<?php
date_default_timezone_set('America/Bogota');
set_time_limit(0);

$fecha = date('YmdHis');
$ruta = "../imagenes/files/Semanales/";


date_default_timezone_set('America/Bogota');
set_time_limit(0);

$nombrearchivo = $ruta.$fecha.".sql";
shell_exec(sprintf('mysqldump --host=localhost --user=sanloren_csgestiondocumental --password=WevC92EqrFO43fVEhh sanloren_gestiondocumental > %s', $nombrearchivo));

//crear un archivo zip

$zip = new ZipArchive();
$filename = $ruta.$fecha.".zip";

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}
$zip->addFile($nombrearchivo);
$zip->close();

unlink($nombrearchivo);
?>