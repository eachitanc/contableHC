<?
set_time_limit(600);
include('../../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
//********************modifica tamaño campo tabla car_ppto_ing
$anadir5="TRUNCATE TABLE `aux_tipocontrato` ";
mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir5 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};

$db = mysql_connect($server,$dbuser,$dbpass) or die("Could not connect.");
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='clase.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {	
	 
			   	   $import="INSERT INTO aux_tipocontrato ( 
					clase 
					)VALUES(
					'$data[0]'
					)";
				   mysql_query($import) or die(mysql_error());
		}
       fclose($handle);
      // print "Import done";
//*** me voy
echo "Fin";
?>
