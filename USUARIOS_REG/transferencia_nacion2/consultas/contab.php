<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar    	
		$sql = "select * from recaudo_tnat where id='$id'";
		$res = mysql_db_query($database, $sql, $cx);
		$fil=mysql_num_rows($res);		
		$con=0;
		$pgcp='';
		$des='';
		$deb='';
		$cre='';
		while ($row = mysql_fetch_array($res))
		{			
		   for ($i=1;$i<=15;$i++)
		   { 
		   		if($row[pgcp.$i])
				{
					$pgcp.=$row[pgcp.$i].'*';
					$des.=$row[des.$i].'*';
					$deb.=$row[vr_deb_.$i].'*';
					$cre.=$row[vr_cre_.$i].'*';
					$con++;
				}
				else break;
		   }  
			 
		}		
	//$valort=$valoret*$valor;
	echo $con.'*'.$pgcp.$des.$deb.$cre;
	//echo $numf;
	//echo $reten;
$cx = null;
?>
