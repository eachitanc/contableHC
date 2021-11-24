<?php 
include('../config.php');
$cx=mysql_connect ($server, $dbuser, $dbpass);

$sq = "SELECT distinct id_auto,dcto FROM lib_aux where cuenta like '2917%' and id_auto not like 'RTIC%'";
$re = mysql_db_query($database, $sq, $cx);
echo $sq;
while($rw = mysql_fetch_array($re)) 
{
	$sq2 = "SELECT * FROM recaudo_rica where  id_manu_rcgt = '$rw[dcto]'";
	$re2 = mysql_db_query($database, $sq2, $cx);
	$fi3 = mysql_num_rows($re2);
	if (!empty($fi3))
	{ 
	echo "<br> $rw[dcto] esta en la base 1";
		$sq6 ="select vr_digitado from recaudo_rica where cuenta like '11010105%' and  id_recau = '$rw[id_auto]'";
		$re6 = mysql_db_query($database, $sq6, $cx);
		$rw6 = mysql_fetch_array($re6);
		echo ",  $rw6[vr_digitado]";
		// consulto valor en cuenta de saldo a favor
		$sq7 ="select sum(debito) as valor from lib_aux where cuenta like '291704%' and  id_auto = '$rw[id_auto]'";
		$re7 = mysql_db_query($database, $sq7, $cx);
		$rw7 = mysql_fetch_array($re7);
		echo ",  $rw7[valor]";
		// consulto el valor de los descuentos
		$sq8 ="select sum(debito) as valor from lib_aux where cuenta like '419511%' and  id_auto = '$rw[id_auto]'";
		$re8 = mysql_db_query($database, $sq8, $cx);
		$rw8 = mysql_fetch_array($re8);
		echo ",  $rw8[valor]";
		// consulto el valor de los impuesto
		$sq9 ="select sum(credito) as valor from lib_aux where cuenta like '130508%' and  id_auto = '$rw[id_auto]'";
		$re9 = mysql_db_query($database, $sq9, $cx);
		$rw9 = mysql_fetch_array($re9);
		echo ",  $rw9[valor]";
	}
	
	$sq4 = "SELECT * FROM recaudo_rica1 where  id_manu_rcgt = '$rw[dcto]'";
	$re4 = mysql_db_query($database, $sq4, $cx);
	$fi4 = mysql_num_rows($re4);
	if (!empty($fi4))
	{ 
	echo "<br> $rw[dcto] esta en la base 2";
			$sq6 ="select vr_digitado from recaudo_rica1 where cuenta like '11010105%' and  id_recau = '$rw[id_auto]'";
		$re6 = mysql_db_query($database, $sq6, $cx);
		$rw6 = mysql_fetch_array($re6);
		echo ",  $rw6[vr_digitado]";
		// consulto valor en cuenta de saldo a favor
		$sq7 ="select sum(debito) as valor from lib_aux where cuenta like '291704%' and  id_auto = '$rw[id_auto]'";
		$re7 = mysql_db_query($database, $sq7, $cx);
		$rw7 = mysql_fetch_array($re7);
		echo ", $rw7[valor]";
		// consulto el valor de los descuentos
		$sq8 ="select sum(debito) as valor from lib_aux where cuenta like '419511%' and  id_auto = '$rw[id_auto]'";
		$re8 = mysql_db_query($database, $sq8, $cx);
		$rw8 = mysql_fetch_array($re8);
		echo ",  $rw8[valor]";
		// consulto el valor de los impuesto
		$sq9 ="select sum(credito) as valor from lib_aux where cuenta like '130508%' and  id_auto = '$rw[id_auto]'";
		$re9 = mysql_db_query($database, $sq9, $cx);
		$rw9 = mysql_fetch_array($re9);
		echo ",  $rw9[valor]";

	}

	$sq5 = "SELECT * FROM recaudo_rica2 where  id_manu_rcgt = '$rw[dcto]'";
	$re5 = mysql_db_query($database, $sq5, $cx);
	$fi5 = mysql_num_rows($re5);
	if (!empty($fi5))
	{ 
	echo "<br> $rw[dcto] esta en la base 3";
			$sq6 ="select vr_digitado from recaudo_rica2 where cuenta like '11010105%' and  id_recau = '$rw[id_auto]'";
		$re6 = mysql_db_query($database, $sq6, $cx);
		$rw6 = mysql_fetch_array($re6);
		echo ",  $rw6[vr_digitado]";
		// consulto valor en cuenta de saldo a favor
		$sq7 ="select sum(debito) as valor from lib_aux where cuenta like '291704%' and  id_auto = '$rw[id_auto]'";
		$re7 = mysql_db_query($database, $sq7, $cx);
		$rw7 = mysql_fetch_array($re7);
		echo ",  $rw7[valor]";
		// consulto el valor de los descuentos
		$sq8 ="select sum(debito) as valor from lib_aux where cuenta like '419511%' and  id_auto = '$rw[id_auto]'";
		$re8 = mysql_db_query($database, $sq8, $cx);
		$rw8 = mysql_fetch_array($re8);
		echo ",  $rw8[valor]";
		// consulto el valor de los impuesto
		$sq9 ="select sum(credito) as valor from lib_aux where cuenta like '130508%' and  id_auto = '$rw[id_auto]'";
		$re9 = mysql_db_query($database, $sq9, $cx);
		$rw9 = mysql_fetch_array($re9);
		echo ",  $rw9[valor]";

	}

}


?> 
