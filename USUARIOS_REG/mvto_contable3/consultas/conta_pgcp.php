<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo la cuenta y el nombre del rubro    	
		$sql = "select cuenta,debito,credito,cheque,id,ccnit from lib_aux4 where id_auto='$id'";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{			
		     if ($row["cuenta"] != '')
			 {
			 $cuenta .=",".$row["cuenta"].'_'.$row['id'];
			 $vr_deb .=",".$row["debito"];
			 $vr_cre .=",".$row["credito"];
			 $cheque .=",".$row["cheque"];
			 $ccnit .=",".$row["ccnit"];
			 }
		}	
	echo $cuenta .','. $vr_deb .','. $vr_cre .','. $cheque.','. $ccnit ;
	//echo $sq2;
$cx = null;
?>
