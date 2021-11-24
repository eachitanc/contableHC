<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$dato =$_REQUEST['cod']; 
$cont = $_REQUEST['con'];
$P="pgcp".$cont;
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from cecp where id_auto_cecp='$dato'";
	$res = mysql_db_query($database, $sql, $cx);
	while ($row = mysql_fetch_array($res))
	{	
			$pgcp=$row[$P];
			$sql2 = "select * from pgcp where cod_pptal ='$pgcp'";
			$res2 = mysql_db_query($database,$sql2,$cx);
			$row2 = mysql_fetch_array($res2); 
			$des=$row2['nom_rubro'];
			$deb=$row['vr_deb_'.$cont];
			$cre=$row['vr_cre_'.$cont];
			$cheque=$row['num_cheque'.$cont];	
					
	}
	echo $pgcp.'*'.$des.'*'.$deb.'*'.$cre.'*'.$cheque;
	//echo $dato.'/'.$dato.'/'.$dato.'/'.$cont.'/'.$cont;
	//echo $id2;
mysql_close($cx);
?>
