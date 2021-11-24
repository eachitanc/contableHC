
<script>
// JavaScript Document
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


</script>
<!-- *********************************************** DATOS DE OBLIGACION CONTABLE DEL GASTO *************************** -->
<div id="dialog" title="Iniciar sesion">
<center>
<?php
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

mysql_query("set names 'utf8'"); 


$id_auto_cobp =$_GET['id_cobp']; 
$sq14 ="select * from cobp where id_auto_cobp = '$id_auto_cobp'";
$rs14 = mysql_query($sq14,$cx);
$rw14 = mysql_fetch_array($rs14);
?>
<br />
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='0'> 
    <tr bgcolor="#B4B4B4">
    	<td width='92%' align='left'>DETALLE DEL CERTIFICADO DE OBLIGACION PRESUPUESTAL</td>
        <td width='8%' align="right" ></td>
    </tr>
</table>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='0'> 
    <tr>
    	<td width='20%' align='left'>N&uacute;mero :</td>
        <td width='80%' align="left" ><?php echo $rw14['id_manu_cobp']; ?></td>
    </tr>
    <tr>
    	<td width='20%' align='left'>Fecha :</td>
        <td width='80%' align="left" ><?php echo $rw14['fecha_cobp']; ?></td>
    </tr>
    <tr>
    	<td width='20%' align='left'>Tercero :</td>
        <td width='80%' align="left" ><?php echo $rw14['tercero']; ?></td>
    </tr>
    <tr>
    	<td width='20%' align='left'>CC/NIT :</td>
        <td width='80%' align="left" ><?php echo $rw14['ccnit']; ?></td>
    </tr>

    <tr>
   	<td width='20%' align='left'>Detalle :</td>
        <td width='80%' align="left" ><?php echo $rw14['des_cobp']; ?></td>
    </tr>
</table>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='1'> 
    <tr bgcolor="#DCE9E5">
    	<td width='10%' align='left'>C&oacute;digo </td>
        <td width='40%' align='left'>Detalle </td>
        <td width='10%' align='center'>Valor Inicial</td>
        <td width='10%' align="center" >Valor Reversado</td>
        <td width='10%' align="center" >Valor COBP </td>
        <td width='10%' align="center" >Saldo x pagar</td>
        <td width='10%' align="center" >Reversar saldo</td>
    </tr>
<?php
$sq15 = "select sum(vr_digitado),cuenta,pagado from cobp where id_auto_cobp = '$id_auto_cobp'  group by cuenta";
$rs15 = mysql_query($sq15,$cx);
while ($rw15 = mysql_fetch_array($rs15))
{
	// Nombre del rubro presupuestal
	$sq16 = "select nom_rubro from car_ppto_gas where cod_pptal ='$rw15[cuenta]'";
	$rs16 = mysql_query($sq16,$cx);
	$rw16 = mysql_fetch_array($rs16);
	// Datos reversados de la obligacion presupuestal
	if ($rw15['pagado']=='SI') $saldo_x_pagar =0; else $saldo_x_pagar = $rw15['sum(vr_digitado)']; 
	// Datos del reporte
	$valor_obligado = number_format($rw15['sum(vr_digitado)'],2,'.',',');
	$valor_fin_cobp = $rw15['sum(vr_digitado)'] ; // valore reversaso cobp- 0;
	if ($saldo_x_pagar > 0)  $btn_liquidar_cobp ="<td  align='center' bgcolor='#8AC5FF' style='cursor:pointer'><font color='#FFFFFF'>liquidar</font></td>"; else $btn_liquidar_cobp ="<td  align='right' >&nbsp;</td>";
 	if ($valor_obligado > 0)
	{
	echo"<tr>
    	<td  align='left'>$rw15[cuenta]</td>
        <td  align='left'>$rw16[nom_rubro]</td>
        <td  align='right'>$valor_obligado</td>
        <td  align='right'>0</td>
		<td  align='right'>$valor_fin_cobp</td>
		<td  align='right'>$saldo_x_pagar</td>
		$btn_liquidar_cobp
    	</tr>";
		$total_cobp3 = $total_cobp3 + $rw15['sum(vr_digitado)'];
		$total_fin_cobp = $total_fin_cobp + $valor_fin_cobp;
		$total_x_pagar = $total_x_pagar + $saldo_x_pagar;
	}
}
// Total Disponibilidad
echo"<tr bgcolor='#F3F3F3'>
    	<td align='left' colspan='2'>Total</td>
        <td align='right'><b>$total_cobp3</b></td>
        <td align='right'><b>0</b></td>
        <td align='right'><b>$total_fin_cobp</b></td>
		<td align='right'><b>$total_x_pagar</b></td>
		<td align='right'><b></b></td>
  	</tr>";
?>
</table>
</center>


    </div>
<script>
//document.getElementById("OBL_pest1_codigo").focus();
</script>

