<? set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=PLANTILLA_NOMINA.xls");
header("Pragma: no-cache");
header("Expires: 0");


$per = $_POST['periodo'];
$fecha = date('Y/m/d');
$ref = 'SUELDO PERSONAL DE NOMINA MES DE '. $per;
?>

<table border="1" align="center" width="95%" class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
	<td width='2%' align='center'>No</td>
    <td width='8%' align='center'>Centro</td>
    <td width='5%' align='center'>Cedula</td>
    <td width='20%' align='center'>Nombre</td>
    <td width='8%' align='center'>Basico</td>
    <td width='8%' align='center'>Gastos Rep</td>
    <td width='8%' align='center'>Aux Trasnporte</td>
    <td width='8%' align='center'>Aux Aliment</td>
    <td width='8%' align='center'>Devengado</td>
</tr>
  <?php 
  	include('../config.php');
    $cx=mysql_connect ($server, $dbuser, $dbpass);
	
	$sql="select * from nomina order by c_costo,cedula asc";
	$rs1=mysql_query($sql);
	$fil=mysql_num_rows($rs1);
	echo "<input name='filas' id='filas' value='$fil' type='hidden' />";
	$tot_suel=0;
	while ($rw1 = mysql_fetch_array($rs1))
	{
		$k++;
		// consultar si el tercero esta creado en la base de datos
		$sq2 = "select pri_ape,seg_ape,pri_nom,seg_nom from terceros_naturales where num_id ='$rw1[cedula]'";
		$rs2 = mysql_query($sq2,$cx);
		$rw2 = mysql_fetch_array($rs2);
		$nombre = $rw2['pri_ape'].' '.$rw2['seg_ape'].' '.$rw2['pri_nom'].' '.$rw2['seg_nom'];
		$sueldo =number_format($rw1['salario'],0,'.',','); 
		$rep =number_format($rw1['gastos_rep'],0,'.',','); 
		$trans =number_format($rw1['sub_trans'],0,'.',','); 
		$alimen =number_format($rw1['sub_alimen'],0,'.',','); 
		$deven =number_format($rw1['salario']+$rw1['gastos_rep']+$rw1['sub_trans']+$rw1['sub_alimen'],0,'.',',');
		echo "<tr class='fc_head'>
			<td align='center'>$k</td>
			<td align='center'>$rw1[c_costo]</td>
			<td align='center'>$rw1[cedula]</td>
			<td align='left'>$nombre</td>
			<td align='right'>$sueldo</td>
			<td align='right'>$rep</td>
			<td align='right'>$trans</td>
			<td align='right'>$alimen</td>
			<td align='right'>$deven</td>
			</tr>
		";
		$tot_suel =$tot_suel + $rw1['salario'];
		$tot_rep = $tot_rep + $rw1['gastos_rep'];
		$tot_trans = $tot_trans + $rw1['sub_trans'];
		$tot_alimeta = $tot_alimeta + $rw1['sub_alimen'];
		$tot_dev = $tot_dev + $rw1['salario']+$rw1['gastos_rep']+$rw1['sub_trans']+$rw1['sub_alimen'];
		$sueldo=0;
		$rep=0;
		$trans=0;
		$alimen=0;
		$tot_suel2 =number_format($tot_suel,0,'.',',');
		$tot_rep2 =number_format($tot_rep,0,'.',',');
		$tot_trans2 =number_format($tot_trans,0,'.',',');
		$tot_alimeta2 =number_format($tot_alimeta,0,'.',',');
		$tot_dev2 =number_format($tot_dev,0,'.',',');
	}
  ?>
<tr bgcolor='#DCE9E5' class='fc_head'>
	<td align='center' colspan="4"><b>Total</b></td>
    <td align='center'><b><?php echo "+suma(E2:E" .$k+1 .")"; ?></b></td>
    <td align='center'><b><?php echo $tot_rep2; ?></b></td>
    <td align='center'><b><?php echo $tot_trans2; ?></b></td>
    <td align='center'><b><?php echo $tot_alimeta2; ?></b></td>
    <td align='center'><b><?php echo $tot_dev2; ?></b></td>
</tr>

  </table>
<?php
}
?>
