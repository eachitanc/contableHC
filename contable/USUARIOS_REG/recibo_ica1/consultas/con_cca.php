<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod']; 
$tipo = $_REQUEST['tipo'];
$ica = $_REQUEST['ica']; 
$c = $ica{0};
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar    	
		$sql = "select cuenta_conta from cca_ica where campo='$id' and (tipo ='$tipo' or tipo ='') and (ica ='$c' or ica ='0')";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{			
		     $pgcp=$row["cuenta_conta"];	
			 
			 $sq2 = "select nom_rubro from pgcp where cod_pptal='$pgcp'";
			 $res2 = mysql_db_query($database, $sq2, $cx);
			 while ($row2 = mysql_fetch_array($res2))
			 {
				 $rubro=$row2["nom_rubro"];
			 }
		}		
	echo $pgcp.','.$rubro;
	
mysql_close($cx);
?>
