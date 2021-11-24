<?php
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database);

$sql = "select * from temp_ica where impuesto > 0 order by recibo asc, tipo asc";
$rs = mysql_query($sql,$cx);
$fil = mysql_num_rows($rs);
while($rw = mysql_fetch_array($rs)) 
{
	$vigencia = $rw['vigencia'];
	if ($vigencia =='2013' ||  $vigencia =='2014') $vig = 'VAL'; else $vig = 'VAN';
	$cod = $rw['codigo'];
	$c = $cod{0};
	$campo = $rw['tipo'];
	if ($campo == 4 || $campo == 5 || $campo == 6 || $campo == 7 || $campo == 8 || $campo == 9 || $campo == 10) $c=0;
	if ($campo == 5 || $campo == 6 || $campo == 7 || $campo == 8 || $campo == 9 || $campo == 10) $vig='';
	$sq2 ="select cuenta_press from cca_ica where campo ='$campo' and tipo = '$vig' and ica = '$c' ";
	$rs2 =mysql_query($sq2,$cx);
	$rw2 =mysql_fetch_array($rs2);
	$sq3= "select * from compensa_ica where cod = '$cod'";
	$rs3= mysql_query($sq3,$cx);
	$rw3 =mysql_fetch_array($rs3);
	if ($campo == 3) // es impuesto
	{
		$sq4 = "select impuesto from temp_ica where tipo ='12' and recibo ='$rw[recibo]'";
		$rs4 = mysql_query($sq4,$cx);
		$rw4 = mysql_fetch_array($rs4); 
		$imp = $rw['impuesto'] - ($rw3['impuesto'] - $rw3['descuent']) - $rw4['impuesto'];
		echo "<br>$campo = $rw[recibo] ----- $rw2[cuenta_press] ----->> $imp >>>> $rw3[cod] <br>
			";
	}
	if ($campo == 4) // es vallas
	{
		$sq4 = "select impuesto from temp_ica where tipo ='13' and recibo ='$rw[recibo]'";
		$rs4 = mysql_query($sq4,$cx);
		$rw4 = mysql_fetch_array($rs4); 
		$avisos = $rw['impuesto'] - $rw3['avisos'] - $rw4['impuesto'];
		echo "<br>$campo = $rw[recibo] ----- $rw2[cuenta_press] ----->> $avisos >>>> $rw3[cod] <br>";
	}
	if ($campo == 5) // es vallas
	{
		$bomber = $rw['impuesto'] - $rw3['bomberos'];
		echo "<br>$campo = $rw[recibo] ----- $rw2[cuenta_press] ----->> $bomber >>>> $rw3[cod] <br>";
	}
	if ($campo == 6) // es vallas
	{
		$estamp = $rw['impuesto'] - $rw3['procultura'];
		echo "<br>$campo = $rw[recibo] ----- $rw2[cuenta_press] ----->> $estamp >>>> $rw3[cod] <br>";
	}

	if ($campo == 7) // es vallas
	{
		$cert = $rw['impuesto'] - $rw3['certifi'];
		echo "<br>$campo = $rw[recibo] ----- $rw2[cuenta_press] ----->> $cert >>>> $rw3[cod] <br>";
	}
	if ($campo == 8) // es vallas
	{
		$extem = $rw['impuesto'] - $rw3['extempo'];
		echo "<br>$campo = $rw[recibo] ----- $rw2[cuenta_press] ----->> $extem >>>> $rw3[cod] <br>";
	}
	if ($campo == 9) // es vallas
	{
		$san= $rw['impuesto'] - $rw3['sancion'];
		echo "<br>$campo = $rw[recibo] ----- $rw2[cuenta_press] ----->> $san >>>> $rw3[cod] <br>";
	}
	if ($campo == 10) // es vallas
	{
		$inter= $rw['impuesto'] - $rw3['interes'];
		echo "<br>$campo = $rw[recibo] ----- $rw2[cuenta_press] ----->> $inter >>>> $rw3[cod] <br>";
	}
	// inserto un registro con cuenta vacia y valor presupuestal vacio pero con movimiento contable




	
	//Consulto la causación decuerdo a los parametros del registro
}
?>
