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
     $filename='Dian_1002.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {
		 $res = mysql_db_query($database,"select * from conceptos_dian where codigo ='$data[0]' and clase='RETENCION'",$conexion);
		 $cod_existe = mysql_num_rows($res);
		 if ($cod_existe ==0)
		  {
			$cont++;
			echo "<font color ='red'> Error fila:&nbsp; $cont &nbsp;Codigo registrado:&nbsp;$data[3]</font></br> ";
			$ver_repor ="display:none";
		  }else{
		  	$cont++; 
			   	   $import="INSERT INTO dian_1001(
				    concepto, tipo_doc, numero, dv,ape1, ape2, nom1, nom2, razon_social, dir, depto, mun, pais, valor_deduc, valor_nodeduc)
					values ('$data[0]','$data[1]','$data[2]', '$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]', '$data[14]')";
				    mysql_query($import,$conexion) or die(mysql_error());
		   }
     }
    fclose($handle);
	
	
?>
<div style=" <?php print $ver_repor; ?> " align="center"><a href="dian_1002_acum.php" class="sidebar2"><font color="#0000FF" size="2">Generar reporte Dian 1002...</font></a> </div> 

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
