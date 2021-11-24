<?
set_time_limit(3600);
?>
<html>
<head>
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
</head>
<body>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />
<?php
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
$ctrl=0;
$cont=0;
echo "<center>";
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{  $idxx=$rowxx["id_emp"];  $id_emp=$rowxx["id_emp"];  }
$db = mysql_connect($server,$dbuser,$dbpass) or die("Could not connect.");
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='CGR_GASTOS.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1500, ",")) !== FALSE)
     {
		 if ($data[0] =='D')
			 {
				   $import="INSERT INTO cgr_gastos_acumula(
				    ctrl, cod_cgr, vig_gasto, cod_rec,oer, cda, finalidad_gasto, ppto_aprob, sum_adiciones, sum_reducciones, cancelaciones, sum_creditos, sum_contracreditos, sum_aplazamientos,sum_desaplazamientos, definitivo,suma_cdpp,reversion_cdpp)
					values ('$data[0]','$data[1]','$data[2]', '$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]', '$data[14]','$data[15]','$data[16]','$data[17]')";
				    mysql_query($import,$conexion) or die(mysql_error());
				
			 }
		
     }
    fclose($handle);
	
	
?>
<div style=" <?php print $ver_repor; ?> " align="center"><a href="cgr_gastos_acum.php" class="sidebar2"><font color="#0000FF" size="2">Generar reporte C.G.R. Programación de Gastos Acumulado</font></a> </div> 

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
