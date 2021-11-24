<?
set_time_limit(1800);
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
     $filename='homologacion_cxp.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {
	       if ($data[2] == 'D')
		   {
				$sqlxx = "select * from cxp";
				$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
				while($rowxx = mysql_fetch_array($resultadoxx)) 
				{  
				   $cod_pptal=$rowxx["cod_pptal"];
					   $import="UPDATE cxp SET
						cod_fut='$data[3]',
						fuentes_recursos='$data[4]',
						unidad_ejecutora='$data[5]',
						cod_cgr='$data[7]',
						cod_rec='$data[8]',
						oer='$data[9]',
						cda='$data[10]',
						vigencia_gasto='$data[11]' ,
						finalidad_gasto='$data[12]',
						uni_ejec_cgr='$data[13]',
						ent_recip='$data[14]',
						cod_sia='$data[15]',
						clase_pago_sia='$data[16]',
						banco_pago='$data[17]'
						
						WHERE cod_pptal = '$data[0]'";
					   mysql_query($import) or die(mysql_error());
				}
			} // fin if
     }
       fclose($handle);
?>
<script type="text/javascript"> 
window.location="upload.php"; 
</script>