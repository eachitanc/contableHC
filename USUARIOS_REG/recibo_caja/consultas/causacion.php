<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo la cuenta y el nombre del rubro    	
		$sql = "select cuenta,vr_digitado from recaudo_rcgt where id_recau='$id'";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{			
		     $cuenta .=",".$row["cuenta"];
			 $cuenta2 =	$row["cuenta"];
			 $valor .=",".$row["vr_digitado"]; 
			 $sq2 = "select nom_rubro from car_ppto_ing where cod_pptal='$cuenta2'";
			 $res2 = mysql_db_query($database, $sq2, $cx);
			 while ($row2 = mysql_fetch_array($res2))
			 {
				 $rubro .=",".$row2["nom_rubro"];
			 }
			 
		}		
	echo $cuenta.','.$rubro.','.$valor;
	//echo $sq2;
$cx = null;
?>
