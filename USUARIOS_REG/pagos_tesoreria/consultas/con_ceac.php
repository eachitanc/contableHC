<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cuenta = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
    		$sql = "select * from obcg where id_auto_cobp='$cuenta'";
			$res = $cx->query($sql);
			//$numf=$res->num_rows;
			$row = $res->fetch_assoc();
			for ($i=1;$i<=15;$i++)
			{
				if ($row['vr_cre_'.$i] > 0 )
				 {
					$ncuenta = $row['pgcp'.$i];
					$sq2 ="select nom_rubro from pgcp where cod_pptal = '$ncuenta'";
					$rs2 = mysql_db_query($database,$sq2,$cx);
					$rw2 = mysql_fetch_array($rs2);
					$nombre = $rw2['nom_rubro'];
				 }
			}
	//$valort=$valoret*$valor;
	echo $ncuenta.','.$nombre;
	//echo $numf;
	//echo $reten;
$cx = null;
?>
