<?
set_time_limit(1800);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT ppto FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_query($sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['ppto']=='SI')
{
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
</head>
<body>
<?php
$sq2 ="select fecha_ini from vf";
$rs2 =mysql_query($sq2,$cx);
$rw2 =mysql_fetch_array($rs2);
mysql_db_query($database,"TRUNCATE TABLE imp_predial",$cx);
// Establezco la viegencia de acuerdo a la vigecia
$anno = split("/",$rw2['fecha_ini']);
$fecha_ini = $anno[0]."/01/01";
$fecha_fin = $anno[0]."/12/31";
$ctrl='';
$filas =0;
if(!$cx) 
	die("no db");
if(!mysql_select_db($database,$cx))
 	die("No database selected.");
		 $filename='predial.csv'; 
         $handle = fopen("$filename", "r");
		 while (($data = fgetcsv($handle, 8000000000, ",")) !== FALSE)
		 {	 
		 if ($data[0] != 'CODIGO')
			 {	
				 
							   $import="INSERT INTO imp_predial ( 
								codigo, 
								fecha_recaudo,
								accesorio, 
								no_recibo, 
								ccnit, 
								pri_ape, 
								seg_ape, 
								pri_nom,
								seg_nom, 
								razon_social,
								valor, 
								ref, 
								cuenta, 
								fecha_ini, 
								fecha_fin 
								)VALUES(
								'$data[0]',
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'$data[5]',
								'$data[6]',
								'$data[7]',
								'$data[8]',
								'$data[9]',
								'$data[10]',
								'$data[11]',
								'$data[12]',
								'$data[13]',
								'$data[14]'
								)";
							   mysql_query($import) or die(mysql_error());
						   
					}	// 		
				 // end campo D
			} 
			fclose($handle);// end while
?>

<script type="text/javascript"> 
window.location="../recibo_predial/importar/carga.php"; 
</script>

</body>
</html>
<?php
}
//$cx = null;
}
?>
