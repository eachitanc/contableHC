<?
set_time_limit(2600);
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{  $idxx=$rowxx["id_emp"];  $id_emp=$rowxx["id_emp"];  }
$db = mysql_connect($server,$dbuser,$dbpass) or die("Could not connect.");
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='homologacion_ingresos.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {
		  if ($data[2] == 'D')
		  {
			$sqlxx = "select * from car_ppto_ing";
			$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
			while($rowxx = mysql_fetch_array($resultadoxx)) 
       			{  
				   $cod_pptal=$rowxx["cod_pptal"];
			   	   $import="UPDATE car_ppto_ing SET
					cod_fut='$data[3]',
					libre_con_fut='$data[4]',
					acto_fut='$data[5]',
					num_acto_fut='$data[6]',
					porcentaje_fut='$data[7]',
					vr_fut='$data[8]',
					fondo_local='$data[9]',
					fondo_local_tes='$data[10]',
					cod_cgr='$data[11]',
					cod_rec='$data[12]' ,
					oer='$data[13]',
					cda='$data[14]',
					ent_recip='$data[15]',
					cod_sia='$data[16]',
					banco_sia='$data[17]',
					cod_cabildo='$data[18]',
					fuente_cabildo='$data[19]'
					WHERE cod_pptal = '$data[0]'";
				   mysql_query($import) or die(mysql_error());
				}
		   }
     }
       fclose($handle);
      // print "Import done";
//*** me voy
?>

<script type="text/javascript"> 
window.location="upload.php"; 
</script>