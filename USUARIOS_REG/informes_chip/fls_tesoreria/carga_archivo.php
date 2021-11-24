<?
set_time_limit(600);
?>
<html>
<head>
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
</head>
<body>
<div align="center">
<img src="../../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />
<?php
include('../../config.php');
$db = mysql_connect($server,$dbuser,$dbpass) or die("Could not connect.");
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='REPORTE_FLS_TESORERIA.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1500, ",")) !== FALSE)
     {
		 if ($data[6] =='D')
			 {
				   $import="INSERT INTO fls_tesoreria(
				    ctrl, cod_cgr, subsidiado, salud_publica,prest_servicios,inversion, funcionamiento, total)
					values ('$data[6]','$data[7]','$data[8]', '$data[9]','$data[10]','$data[11]','$data[12]','$data[13]')";
				    mysql_query($import,$db) or die(mysql_error());
				
			 }
		
     }
    fclose($handle);
	
	
?>
<div style=" <?php print $ver_repor; ?> " align="center"><a href="fut_fls_acum.php" class="sidebar2"><font color="#0000FF" size="2">Generar reporte FUT Fondo Local - Tesorería Acumulado</font></a> </div> 

</center>
<br />
<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
		 	<div align="center">
		 		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  		<div align="center" class="Estilo6"><a href='upload.php' target='_parent' class="sidebar2">VOLVER</a>
				 		</div>
		        	</div>
        	    </div>      
			</div>
</div>
</center>
</body>
</html>
