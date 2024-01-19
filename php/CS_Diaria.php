<?php
date_default_timezone_set('America/Bogota');
set_time_limit(0);

$fecha = date('Y-m-d');
$hora = date('h:i:s');
$ruta = "../imagenes/files/Diarias/";
$carpeta = str_replace("-", "", $fecha).str_replace(":", "", $hora)."/";

mkdir($ruta.$carpeta);

$fecha3m = date('Y-m-d', mktime(0, 0, 0, (date('m')-6), date('d'), date('Y')));
$dia8h = date('Y-m-d', mktime((date('H')-9), 0, 0, date('m'), date('d'), date('Y')));

$archivos[0]['sql'] = sprintf("SELECT adjuntos.* FROM adjuntos");
$archivos[0]['nombre'] = "adjuntos";

$archivos[1]['sql'] = sprintf("SELECT areas.* FROM areas");
$archivos[1]['nombre'] = "areas";

$archivos[2]['sql'] = sprintf("SELECT capacitaciones_operarios.* FROM capacitaciones_operarios");
$archivos[2]['nombre'] = "capacitaciones_operarios";

$archivos[3]['sql'] = sprintf("SELECT festivos.* FROM festivos");
$archivos[3]['nombre'] = "festivos";

$archivos[4]['sql'] = sprintf("SELECT flujos_aprobaciones.* FROM flujos_aprobaciones");
$archivos[4]['nombre'] = "flujos_aprobaciones";

$archivos[5]['sql'] = sprintf("SELECT historiales_flujos.* FROM historiales_flujos");
$archivos[5]['nombre'] = "historiales_flujos";

$archivos[6]['sql'] = sprintf("SELECT operarios.* FROM operarios");
$archivos[6]['nombre'] = "operarios";

$archivos[7]['sql'] = sprintf("SELECT parametros.* FROM parametros");
$archivos[7]['nombre'] = "parametros";

$archivos[8]['sql'] = sprintf("SELECT permisos.* FROM permisos");
$archivos[8]['nombre'] = "permisos";

$archivos[9]['sql'] = sprintf("SELECT plantas.* FROM plantas");
$archivos[9]['nombre'] = "plantas";

$archivos[10]['sql'] = sprintf("SELECT plantillas_documentos.* FROM plantillas_documentos");
$archivos[10]['nombre'] = "plantillas_documentos";

$archivos[11]['sql'] = sprintf("SELECT solicitudes.* FROM solicitudes");
$archivos[11]['nombre'] = "solicitudes";

$archivos[12]['sql'] = sprintf("SELECT usuarios.* FROM usuarios");
$archivos[12]['nombre'] = "usuarios";

$archivos[13]['sql'] = sprintf("SELECT usuarios_areas.* FROM usuarios_areas");
$archivos[13]['nombre'] = "usuarios_areas";

$archivos[14]['sql'] = sprintf("SELECT usuarios_permisos.* FROM usuarios_permisos");
$archivos[14]['nombre'] = "usuarios_permisos";

for($i=0; $i<count($archivos); $i++){
	shell_exec(sprintf('mysql --host=localhost --user=sanloren_csgestiondocumental --password=WevC92EqrFO43fVEhh sanloren_gestiondocumental -e "%s" | sed \'s/\t/","/g;s/^/"/;s/$/"/;\' > %s', $archivos[$i]['sql'], $ruta.$carpeta.$archivos[$i]['nombre'].".csv"));
	echo "Archivo ".$ruta.$carpeta.$archivos[$i]['nombre'].".csv generado<br>";
	echo "SQL: ".$archivos[$i]['sql']."<br><br>";
}

$zip = new ZipArchive();
$zipfinal = $ruta.str_replace("-", "", $fecha).str_replace(":", "", $hora).".zip";
if ($zip->open($zipfinal, ZipArchive::CREATE)!==TRUE) {
    exit("cannot open <$zipfinal>\n");
}
$zip = comprimir_carpeta($ruta.$carpeta, $carpeta, $zip);
$zip->close();

function comprimir_carpeta($ruta, $carpeta, $zip){
	if (is_dir($ruta)){
		if ($dh = opendir($ruta)) { 
			while (($file = readdir($dh)) !== false) {
				if ($file!="." && $file!=".."){
					if (is_dir($ruta . $file)){
						$zip = comprimir_carpeta($ruta.$file."/", $carpeta.$file."/", $zip);
					}else{
						$zip->addFile($ruta.'/'.$file, $carpeta.'/'.$file);
					}
				}
			} 
      		closedir($dh); 
		}
	}else{
	   echo "<br>No es ruta valida"; 
	}
	return $zip;
}

eliminarDir($ruta.$carpeta);

function eliminarDir($carpeta){
    foreach(glob($carpeta . "/*") as $archivos_carpeta){ 
        if (is_dir($archivos_carpeta)){
            eliminarDir($archivos_carpeta);
        }else{
            unlink($archivos_carpeta);
        }
    }
    rmdir($carpeta);
}
?>