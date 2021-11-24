<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cuenta = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar    	
		$sql = "select * from cca_ing where cod_pptal='$cuenta'";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{			
		     $pgcp1=$row["pgcp1"];	
			 $pgcp6=$row["pgcp6"];
			 
			 $sq2 = "select * from pgcp where cod_pptal='$pgcp1'";
			 $res2 = mysql_db_query($database, $sq2, $cx);
			 while ($row2 = mysql_fetch_array($res2))
			 {
				 $rubro=$row2["nom_rubro"];
			 }
			 
			 $sq3 = "select * from pgcp where cod_pptal='$pgcp6'";
			 $res3 = mysql_db_query($database, $sq3, $cx);
			 while ($row3 = mysql_fetch_array($res3))
			 {
				 $rubro2=$row3["nom_rubro"];
			 }
			 
		}		
	echo $pgcp1.','.$rubro.',',$pgcp6.','.$rubro2;
?>
