<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo la cuenta y el nombre del rubro    	
		$sql = "select cuenta,debito,credito,cheque,id from lib_aux2 where id_auto='$id'";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{			
			$sum = $row["debito"]+ $row["credito"];
			if ($sum >0)
			{
		     if ($row["cuenta"] != '')
			 {
			 $cuenta .=",".$row["cuenta"].'_'.$row['id'];
			 $vr_deb .=",".$row["debito"];
			 $vr_cre .=",".$row["credito"];
			 $cheque .=",".$row["cheque"];
			 }
		}	}
	echo $cuenta .','. $vr_deb .','. $vr_cre .','. $cheque;
	//echo $sq2;
$cx = null;
?>
