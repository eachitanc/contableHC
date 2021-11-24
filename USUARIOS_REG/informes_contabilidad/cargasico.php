<?
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{  $idxx=$rowxx["id_emp"];  $id_emp=$rowxx["id_emp"];  }

//*** la borro

$tabla6="sico";
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

//*** la creo

		$tabla7="sico";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `cuenta` varchar(200) NOT NULL default '',
  `nombre` varchar(200) NOT NULL default '',
  `debito` decimal(20,2) NOT NULL default '0.00',
  `credito` decimal(20,2) NOT NULL default '0.00'
)TYPE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci";
		
		mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{
		//echo "<center class='Estilo4'> <br> <center>La tabla $tabla7 se ha creado con exito<br></center>";
		}
		else
		{
		//echo "<center class='Estilo4'> <br> <center>La tabla $tabla7 se ha creado con exito - OK!<br></center>";
		}

//*** la lleno
$db = mysql_connect($server,$dbuser,$dbpass) or die("Could not connect.");

if(!$db) 

	die("no db");

if(!mysql_select_db($database,$db))

 	die("No database selected.");
	


     $filename='SICO.csv'; 

     $handle = fopen("$filename", "r");

     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

     {

       $import="INSERT into sico (cuenta,nombre,debito,credito) values ('$data[0]','$data[1]','$data[2]','$data[3]')";

       mysql_query($import) or die(mysql_error());

     }

       fclose($handle);

      // print "Import done";
	  
/*$archivo = fopen("SICO.csv");   
while($linea = fgetcsv($archivo,0,","))
{   
	$cuenta = $linea[0];   
	$nombre = $linea[1];   
	$debito = $linea[2];   
	$credito = $linea[3];   
}   
fclose($archivo);  

 $import="INSERT into sico (cuenta,nombre,debito,credito) values ('$linea[0]','$linea[1]','$linea[2]','$linea[3]')";
 mysql_query($import) or die(mysql_error());*/	  

//*** me voy

?>
<script type="text/javascript"> 
window.location="upload.php"; 
</script>