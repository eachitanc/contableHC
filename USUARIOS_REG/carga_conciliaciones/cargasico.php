<?php
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{  $idxx=$rowxx["id_emp"];  $id_emp=$rowxx["id_emp"];  }

//*** la VACIO

$tabla6="aux_conciliaciones_vig_ant";
$anadir6="TRUNCATE TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir6 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};		

//*** la lleno
$db = mysql_connect($server,$dbuser,$dbpass) or die("Could not connect.");

if(!$db) 

	die("no db");

if(!mysql_select_db($database,$db))

 	die("No database selected.");
	


     $filename='CBVA.csv'; 

     $handle = fopen("$filename", "r");

     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

     {

       $import="INSERT into aux_conciliaciones_vig_ant 
	   (fecha,dcto,cuenta,nombre,cheque,tercero,debito,credito,estado,flag1,flag2,fecha_marca) 
	   values 
	   ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','NO','0','0','')";
       mysql_query($import) or die(mysql_error());

     }

       fclose($handle);

      // print "Import done";

  
//*** me voy

?>
<script type="text/javascript"> 
window.location="conciliaciones_vig_ant.php"; 
</script>