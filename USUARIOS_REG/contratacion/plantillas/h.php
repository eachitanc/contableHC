<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>

<?php

// Lee la plantilla
$plantilla = file_get_contents('plantilla1.rtf');

// Agregamos los escapes necesarios
$plantilla = addslashes($plantilla);
$plantilla = str_replace('\r','\\r',$plantilla);
$plantilla = str_replace('\t','\\t',$plantilla);

// Datos de la plantilla
$nombre = "Juan";
$apellido = "Perez";
$prefijo = "Sr.";
$curso = '"Programacion Web con PHP"';
$fecha = date("d-m-Y", time() - 7 * 24 * 60 * 60); // de esta manera el codigo no envejece :P

// Procesa la plantilla
eval( '$rtf = <<<EOF_RTF
' . $plantilla . '
EOF_RTF;
' );

// Guarda el RTF generado
file_put_contents("$apellido-$nombre-$fecha.rtf",$rtf);

?>

</body>
</html>
