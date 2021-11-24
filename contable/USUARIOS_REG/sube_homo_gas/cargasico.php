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
     $filename='homologacion_gastos.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {
	    if ($data[2] =='D')
		{
		    $sqlxx = "select * from car_ppto_gas";
			$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
			while($rowxx = mysql_fetch_array($resultadoxx)) 
			{  
			   $cod_pptal=$rowxx["cod_pptal"];
			   	   $import="UPDATE car_ppto_gas SET
					cod_fut='$data[4]',
					fuentes_recursos='$data[5]',
					unidad_ejecutora='$data[6]',
					vigencia ='$data[8]',
					fondo_local ='$data[9]',
					cod_ser_deuda='$data[10]',
					cod_cgr='$data[11]',
					cod_rec='$data[12]',
					oer='$data[13]',
					cda='$data[14]' ,
					vigencia_gasto='$data[15]',
					finalidad_gasto='$data[16]',
					uni_ejec_cgr='$data[17]',
					ent_recip='$data[18]',
					cod_sia='$data[19]',
					clase_pago_sia='$data[20]',
					banco_pago='$data[21]',
					fuente_recursos ='$data[22]',
					sectores_inversion ='$data[23]',
					cod_cabildo ='$data[24]',
					fuente_cabildo ='$data[25]'
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