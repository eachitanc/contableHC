<?php 
set_time_limit(1200);
include('config.php');				
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
mysql_select_db($database);
$tabla = $_POST['tabla'];
$rubro = $_POST['rubro'];
$debito = $_POST['debito'];
$credito = $_POST['credito'];
$favor = $_POST['favor'];

	$sq6 = "SELECT * from $tabla where cuenta = '$rubro' and fecha_recaudo >'2014/01/01'";
	$rs6 =mysql_query($sq6,$cx);
	while ($rw6 =mysql_fetch_array($rs6))
	{
			
		 $sq3 ="select * from $tabla where id_recau = '$rw6[id_recau]' and pgcp1 !=''";
		 $rs3 =mysql_query($sq3,$cx);
		 $rw3 =mysql_fetch_array($rs3);
		 echo $rw6['fecha_recaudo'].",".$rw6['id_manu_rcgt']. ",".$rw6['vr_digitado'];	
		 for($i=1;$i<161;$i++)
			{
			 	
			  	if ($rw3['pgcp'.$i] ==$credito) 
				{
					echo ",".$rw3['vr_cre_'.$i];
					// editar cuenta 
					$sq4 ="UPDATE $tabla SET `pgcp$i` = '14011402' WHERE id_recau ='$rw6[id_recau]' and pgcp1 !='' ";
					echo ','.$sq4.';';
				}
				
			  	if ($rw3['pgcp'.$i] ==$debito) 
				{
					echo ",".$rw3['vr_deb_'.$i];
				}
				
				if ($rw3['pgcp'.$i] ==$favor) 
				{
					echo ",".$rw3['vr_deb_'.$i];
				}

				
			}
			
		echo "<br>";
	}
	 
?>
