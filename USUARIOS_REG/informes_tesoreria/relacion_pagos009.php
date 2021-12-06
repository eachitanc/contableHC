<?php
set_time_limit(1200);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=RELACION_DE_PAGOS.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style>
.text
  {
 mso-number-format:"\@"
  }
.date
	{
	mso-number-format:"yyyy\/mm\/dd"	
	}
.numero
	{
	mso-number-format:"0"	
	}
</style>
</head>

<body>
<?php
include ('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database);

?>
<center>
 <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td  align='left'>No cdp</td>
        <td align='left'>No rp</td>
        <td  align='left'>cc/ nit</td>
         <td  align='right'>tercero</td>
        <td  align='right'>contrato</td>
       <td  align="center" >Total</td>
          <td  align="center" >Pagado</td>
             <td  align="center" >Saldo</td>
    </tr>
<?php
// Deberia seleccionar uno a uno los id_crpp pagados hasta la fecha
$sq1="select distinct id_auto_crpp from crpp where fecha_crpp <= '2016/05/31'";
$re1=mysql_query($sq1,$cx);
while($rw1 = $re1->fetch_assoc())
{
	$sq3="select sum(pagado) as pagado,tercero,ccnit from z_pagos where fecha_ceva <= '2016/05/31' and id_auto_crpp ='$rw1[id_auto_crpp]' group by id_auto_crpp";
	$re3=mysql_query($sq3,$cx);
	$rw3 = $re3->fetch_assoc();
	$pagado = $rw3['pagado'];
	$sq2="select sum(vr_digitado) as total,id_manu_crpp,id_manu_cdpp,ter_nat,ter_jur from crpp where id_auto_crpp ='$rw1[id_auto_crpp]' group by id_auto_crpp";
	$re2=mysql_query($sq2,$cx);
	$rw2 = $re2->fetch_assoc();
	$total = $rw2['total'];
	$tercero =  $rw3['tercero'];
	$ccnit =  $rw3['ccnit'];
	if ($rw3['ccnit'] =='')
	{
		$sq5 ="select pri_ape,seg_ape,pri_nom,seg_nom, num_id from terceros_naturales where id = '$rw2[ter_nat]'";	
		$re5=mysql_query($sq5,$cx);
		$rw5 = $re5->fetch_assoc();
		$tercero = $rw5['pri_nom']. " " . $rw5['seg_nom']. " " . $rw5['pri_ape']. " " . $rw5['seg_ape'];
		$ccnit = $rw5['num_id'];
		if($ccnit == '')
		{
				$sq6 ="select num_id2,raz_soc2 from terceros_juridicos where id = '$rw2[ter_jur]'";	
				$re6=mysql_query($sq6,$cx);
				$rw6 = $re6->fetch_assoc();
				$tercero = $rw6['raz_soc2'];
				$ccnit = $rw6['num_id2'];
			}
	}
	echo "
		 <tr>
			<td >$rw2[id_manu_cdpp]</td>
			<td >$rw2[id_manu_crpp]</td>
			<td >$ccnit</td>
			<td >$tercero</td>
			<td > </td>
			<td >$rw2[total]</td>
			 <td>$rw3[pagado]</td>
			  <td ></td>
		</tr>
	";
}
?>
</table>
</center>
</body>
</html>
<?php
}
?>