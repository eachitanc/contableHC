<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$reten = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$numf=0;
    for($i=1;$i<16;$i++)
	{
		$sql = "select * from obcg where vr_cre_$i!='' AND id_auto_obcg='$reten'";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{
			$numf++;
			$pgcp=$row[pgcp."$i"];
			$valor=$row[vr_cre_."$i"];
			$sq3="select nom_rubro from pgcp where cod_pptal='$pgcp'";
			$res3=mysql_db_query($database,$sq3,$cx);
			while ($row3 = mysql_fetch_array($res3))
			{
				$valor5=$row3[nom_rubro];
			}
			$valoret3.=$pgcp.",".$valor5.",".$valor.",";
		}
	}
	//$valort=$valoret*$valor;
	echo $numf.','.$valoret3;
	//echo $numf;
	//echo $reten;
mysql_close($cx);
?>
