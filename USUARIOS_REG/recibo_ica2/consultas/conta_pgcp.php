<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo la cuenta y el nombre del rubro    	
		for ($i=1;$i<=161;$i++)
		{
		$sql = "select pgcp$i,vr_deb_$i,vr_cre_$i,cheque_$i from recaudo_rica2 where id_recau='$id'";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{			
		     if ($row["pgcp".$i] != '')
			 {
			 $cuenta .=",".$row["pgcp".$i];
			 $vr_deb .=",".$row["vr_deb_".$i];
			 $vr_cre .=",".$row["vr_cre_".$i];
			 $cheque .=",".$row["cheque_".$i];
			 }
		}	
		}
	echo  $cuenta .','. $vr_deb .','. $vr_cre .','. $cheque;
	//echo $sq2;
?>
