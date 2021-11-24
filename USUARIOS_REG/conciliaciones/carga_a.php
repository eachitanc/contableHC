
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
</head>
<body>
<?php
include('../config.php');
//
$db = mysql_connect($server,$dbuser,$dbpass) or die("No se puede conectar con la base de datos...");

// Establezco la viegencia de acuerdo a la vigecia
$ctrl='';
$filas =0;
mysql_db_query($database,"TRUNCATE TABLE aux_estracto",$db);

// Encabezado de la tabla para reporte
echo "<div align='center'>PENDIENTES CONCILIACION EXTRACTO</div>";
echo "<br>";
echo "<table border='1' align='center' width='80%' class='bordepunteado1'>";
echo "<tr bgcolor='#DCE9E5' class='Titulotd'>
		<td>Fila</td>
		<td>Documento</td>
		<td>Apellido 1</td>
		<td>Apellido 2</td>
		<td>Nombre 1</td>
		<td>Nombre 2</td>
		<td>Errores</td>
	  </tr>"	;
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='extracto.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {	
	 
				 // Trabajar con transacciones guarda en cdpp y crpp
			 
						   $import="INSERT INTO aux_estracto ( 
							fecha,
							deb
							)VALUES(
							'$data[0]',
							'$data[1]'
							)";
						   mysql_query($import) or die(mysql_error());
				// Reporte registro exitoso
				
			} // end campo D
	   fclose($handle);
	   
	echo "</table>";

printf("

<center >
<form method='post' action='upload_ter.php'>
<input type='hidden' name='nn' value='CDPP'>
 <input type='submit' name='Submit' value='Volver' class='Estilo4' style='background:#72A0CF; color:#FFFFFF; border:none; font-size: 13px;' /> 
</form>
</center>
");

?>
<input type="button" name="boton" value="Conciliar" style="background:#F60; color:#FFFFFF; border:none;cursor:pointer" onClick="window.open('preconciliacion.php', 'width=800, height=600')"/>
</body>
</html>
