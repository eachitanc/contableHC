<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar    	
		$sql = "select * from recaudo_rcgt  where id='$id'";
		$res = $cx->query($sql);
		$fil=$res->num_rows;		
		$con=0;
		$pgcp='';
		$des='';
		$deb='';
		$cre='';
		$pgcp2='';
		while ($row = $res->fetch_assoc())
		{			
		   for ($i=1;$i<=15;$i++)
		   { 
		   		if($row[pgcp.$i])
				{
					$pgcp.=$row[pgcp.$i].'*';
					$pgcp2=$row[pgcp.$i].'*';
					//$sq2="select * from pgcp where cod_pptal=`$pgcp2`";
					//$res2 = $cx->query($sq2);
					//$row2 = mysql_fetch_array($res2);					
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
