<?
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=LIBRP_DIARIO.xls");
header("Pragma: no-cache");
header("Expires: 0");
set_time_limit(1800);
/*session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
</head>
<body>
<?php 
// llega el mes de corte
$mes = $_GET["fech"];
include('../config.php');		
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$cx1 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$base=$database;
// Estraigo informacion de la empresa para mostrar en encabezados
$sqldatos = "select * from empresa";
$resdatos= mysql_db_query($database,$sqldatos,$connectionxx);
while ($rw1 = mysql_fetch_array($resdatos))
	{
		$entidad = $rw1["raz_soc"];
		$nit = $rw1["nit"];
		$rep = $rw1["nom_rep_leg"];
		$conta = $rw1["nom_cont"];
	} 
// selecciono la fecha de incio de operaciones
$sqlv = mysql_db_query($database,"select * from vf",$connectionxx);
while ($rwv = mysql_fetch_array($sqlv))
	{
		$fecha_ini = $rwv["fecha_ini"];
	} 
	$cod2 = explode("/", $fecha_ini);
	$anno = $cod2[0]; 
$fechas_corte =array($anno.'/01/31',$anno.'/02/28',$anno.'/03/31',$anno.'/04/30',$anno.'/05/31',$anno.'/06/30',$anno.'/07/31',$anno.'/08/30',$anno.'/09/30',$anno.'/10/31',$anno.'/11/30',$anno.'/12/31',$anno.'/12/31');
	
$corte = $fechas_corte[$mes];
if ($mes ==12) 
	{
		$anno2=$anno-1;
		$corte_mes_anterior=$anno2.'/12/31';
	}else{
		$corte_mes_anterior=$fechas_corte[$mes-1];
	}
	
// Cargo array con la difrentes fechas para inicio de periodo
$fechas_corte_ini =array($anno.'/01/01',$anno.'/02/01',$anno.'/03/01',$anno.'/04/01',$anno.'/05/01',$anno.'/06/01',$anno.'/07/01',$anno.'/08/01',$anno.'/09/01',$anno.'/10/01',$anno.'/11/01',$anno.'/12/01',$anno.'/01/01');	
$corte_ini=$fechas_corte_ini[$mes];
// fecha inicial de la vigencia actual


?>

<table width='1380' border ='0' align='center' class='bordepunteado1'>
<tr>
	<td><b>ENTIDAD:</b></td>
	<td align="left"><?php echo $entidad; ?></td>
</tr>
<tr>
	<td><b>NIT:</b></td>
	<td align="left"><?php echo $nit; ?></td>
</tr>
<tr>
	<td><b>LIBRO OFICIAL:</b></td>
	<td>LIBRO DIARIO COLUMNARIO</td>
</tr>
<tr>
	<td><b>PERIODO:</b></td>
	<td align="left"><?php echo "$corte_ini a $corte"; ?></td>
</tr>
<tr>
	<td><b>VIGENCIA:</b></td>
	<td align="left"><?php echo $anno; ?></td>
</tr>
<tr>
	<td><b>FECHA REPORTE:</b></td>
	<td align="left"><?php echo date('Y/m/d'); 
; ?></td>
</tr>

</table>
<br />
<br />


<?php
$sqlf= "select * from vf";
$resf = mysql_db_query($database, $sqlf, $connectionxx);
while($rowf = mysql_fetch_array($resf)) 
{
  $fecha_ini_op=$rowf["fecha_ini"];
}
// listado de cuentas de la tabla libro_aux
$sqlxx3="select DISTINCT cod_pptal,nom_rubro,tip_dato from pgcp  where tip_dato='D' and cod_pptal NOT LIKE '0%' order by cod_pptal asc";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);
while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{
	//******* naturaleza de la cuenta
	$nat1 = substr($rowxx3[cod_pptal],0,1);
	$nat2 = substr($rowxx3[cod_pptal],0,2);
	if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
	{	$naturaleza = "DEBITO";	}
	else
	{   if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89' 						)
		{
		$naturaleza = "CREDITO";
		}
	}
	//consultar si la cuenta sico tiene saldo inicial
	$debito_suma=0;
	$credito_suma=0;
	$debito_sico=0;
	$credito_sico=0;
	$sqlsico= "select debito,credito,cuenta from sico where cuenta='$rowxx3[cod_pptal]'";
	$ressico = mysql_db_query($database, $sqlsico, $connectionxx);
	while($rowsico = mysql_fetch_array($ressico)) 
	{
  		$debito_sico=$rowsico["debito"];
  		$credito_sico=$rowsico["credito"];
	}
	//depurar B.D. 
	mysql_select_db($database,$connectionxx); 
	$sqldelete="delete  from lib_aux where debito = 0.00 and credito = 0.00";
	$resdelete = mysql_query($sqldelete);
	
	
	//consultamos el movimiento de la cuenta anterior al mes de reporte
	$sqlant = "select sum(debito),sum(credito) from lib_aux  where cuenta='$rowxx3[cod_pptal]' and fecha BETWEEN  '$fecha_ini' AND '$corte_mes_anterior'  group by cuenta";
	$resultadoant= mysql_db_query($database, $sqlant, $connectionxx);
	while($rowant = mysql_fetch_array($resultadoant)) 
	{
		$debito_suma=$rowant['sum(debito)'];
		$credito_suma=$rowant['sum(credito)'];
	}
	if ($naturaleza == "DEBITO")
	{
		$debito_t=$debito_sico+$debito_suma;
		$credito_t=$credito_sico+$credito_suma;
		$saldo_ini=$debito_t-$credito_t;
	}
	if ($naturaleza == "CREDITO")
	{
		$debito_t=$debito_sico+$debito_suma;
		$credito_t=$credito_sico+$credito_suma;
		$saldo_ini=$credito_t - $debito_t;
	}
	//consulto movimiento de cada cuenta auxiliar	
	$sqlxx2 = "select * from lib_aux  where cuenta='$rowxx3[cod_pptal]' and fecha BETWEEN  '$corte_ini' AND '$corte'  order by cuenta, fecha asc";
	$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);
	$filas=mysql_num_rows($resultadoxx2);
	
	if($filas>0 || $saldo_ini>0){
echo "<b>Cuenta: ".$rowxx3[cod_pptal]."  ".ucwords( $rowxx3[nom_rubro])."</b>";

echo "<table border='1' width='60%' align='center'>
  <tr>
    <td><b>Fecha</b></td>
    <td><b>Documento</b></td>
    <td><b>Detalle</b></td>
    <td><b>Debito</b></td>
    <td><b>Credito</b></td>
	<td><b>Saldo</b></td>
  </tr>";
 echo" <tr >
    <td ><b>  </b></td>
    <td><b> </b></td>
    <td>Saldo inicial </td>
    <td></td>
    <td></td>	
	<td align='right'>$saldo_ini</td>
	
  </tr>";
$saldo=$saldo_ini;
$acdebito=0;
$accredito=0;
while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
	if ($naturaleza == "DEBITO")
	{
		$saldo=$saldo+$rowxx2[debito]-$rowxx2[credito];
	}
	if ($naturaleza == "CREDITO")
	{
		$saldo=$saldo-$rowxx2[debito]+$rowxx2[credito];
	}
	// verificar si la cuenta tiene saldo o movimiento
	
	
	echo "<tr>
      <td>$rowxx2[fecha] </td>
      <td>$rowxx2[dcto] </td>
      <td>$rowxx2[detalle] </td>
      <td align='right'>$rowxx2[debito] </td>
      <td align='right'>$rowxx2[credito] </td>
	  <td align='right'>$saldo </td>
    </tr>";
	
	$acdebito=$acdebito+$rowxx2[debito];
	$accredito=$accredito+$rowxx2[credito];
	
} 
	
echo "<tr>
<td> </td>
<td> $rowxx2 </td>
<td> Saldo final </td>
<td align='right'>$acdebito </td>
<td align='right'>$accredito </td>
<td align='right'>$saldo </td>
</tr>";
echo"</table> <br>";
	}
}

mysql_free_result($resultadoxx3);

//     *****CUENTAS CERO  *************

mysql_select_db($database,$connectionxx); 
	$sqldelete="delete  from aux_cta_0 where debito = 0.00 and credito = 0.00";
	$resdelete = mysql_query($sqldelete);

$sql4="select DISTINCT cuenta from aux_cta_0 order by cuenta asc";
$res4 = mysql_db_query($database, $sql4, $connectionxx);
while($row4 = mysql_fetch_array($res4)) 
{
	//*** SALDO ANTRERIOR ***********
	
	$nat1 = substr($row4[cuenta],0,4);

if($nat1 == '0202' or $nat1 == '0203' or $nat1 == '0204' or $nat1 == '0207' or $nat1 == '0208' or $nat1 == '0209' or $nat1 == '0213' or $nat1 == '0243' or $nat1 == '0252' or $nat1 == '0331' or $nat1 == '0332' or $nat1 == '0334' or $nat1 == '0335' or $nat1 == '0336' or $nat1 == '0337' or $nat1 == '0350' or $nat1 == '0351' or $nat1 == '0352' or $nat1 == '0353' or $nat1 == '0354' or $nat1 == '0355' or $nat1 == '0360' or $nat1 == '0361' or $nat1 == '0362' or $nat1 == '0363' or $nat1 == '0364' or $nat1 == '0365' or $nat1 == '0370' or $nat1 == '0371' or $nat1 == '0372' or $nat1 == '0373' or $nat1 == '0374' or $nat1 == '0375' or $nat1 == '0378' or $nat1 == '0399' or $nat1 == '0432' or $nat1 == '0434' or $nat1 == '0436' or $nat1 == '0438' or $nat1 == '0440' or $nat1 == '0442' or $nat1 == '0444' or $nat1 == '0446' or $nat1 == '0450' or $nat1 == '0555' or $nat1 == '0556' or $nat1 == '0557' or $nat1 == '0558' or $nat1 == '0559' or $nat1 == '0560' or $nat1 == '0561' or $nat1 == '0562' or $nat1 == '0563' or $nat1 == '0564' or $nat1 == '0565' or $nat1 == '0566' or $nat1 == '0567' or $nat1 == '0568' or $nat1 == '0569' or $nat1 == '0570' or $nat1 == '0571' or $nat1 == '0572' or $nat1 == '0630' or $nat1 == '0631' or $nat1 == '0632' or $nat1 == '0633' or $nat1 == '0634' or $nat1 == '0635' or $nat1 == '0636' or $nat1 == '0637' or $nat1 == '0638' or $nat1 == '0639' or $nat1 == '0640' or $nat1 == '0641' or $nat1 == '0642' or $nat1 == '0643' or $nat1 == '0644' or $nat1 == '0645' or $nat1 == '0646' or $nat1 == '0647' or $nat1 == '0655' or $nat1 == '0656' or $nat1 == '0657' or $nat1 == '0658' or $nat1 == '0659' or $nat1 == '0660' or $nat1 == '0661' or $nat1 == '0662' or $nat1 == '0663' or $nat1 == '0664' or $nat1 == '0665' or $nat1 == '0666' or $nat1 == '0667' or $nat1 == '0668' or $nat1 == '0669' or $nat1 == '0670' or $nat1 == '0671' or $nat1 == '0672' or $nat1 == '0730' or $nat1 == '0731' or $nat1 == '0732' or $nat1 == '0733' or $nat1 == '0734' or $nat1 == '0735' or $nat1 == '0736' or $nat1 == '0737' or $nat1 == '0738' or $nat1 == '0739' or $nat1 == '0740' or $nat1 == '0741' or $nat1 == '0742' or $nat1 == '0743' or $nat1 == '0744' or $nat1 == '0745' or $nat1 == '0746' or $nat1 == '0747' or $nat1 == '0755' or $nat1 == '0756' or $nat1 == '0757' or $nat1 == '0758' or $nat1 == '0759' or $nat1 == '0760' or $nat1 == '0761' or $nat1 == '0762' or $nat1 == '0763' or $nat1 == '0764' or $nat1 == '0765' or $nat1 == '0766' or $nat1 == '0767' or $nat1 == '0768' or $nat1 == '0769' or $nat1 == '0770' or $nat1 == '0771' or $nat1 == '0772' or $nat1 == '0835' or $nat1 == '0840' or $nat1 == '0845' or $nat1 == '0855' or $nat1 == '0860' or $nat1 == '0935' or $nat1 == '0940')
{
$naturaleza = "DEBITO";
}
else
{
	if($nat1 == '0216' or $nat1 == '0217' or $nat1 == '0218' or $nat1 == '0219' or $nat1 == '0221' or $nat1 == '0222' or $nat1 == '0223' or $nat1 == '0224' or $nat1 == '0226' or $nat1 == '0227' or $nat1 == '0228' or $nat1 == '0229' or $nat1 == '0231' or $nat1 == '0242' or $nat1 == '0253' or $nat1 == '0254' or $nat1 == '0320' or $nat1 == '0321' or $nat1 == '0323' or $nat1 == '0324' or $nat1 == '0325' or $nat1 == '0326' or $nat1 == '0425' or $nat1 == '0430' or $nat1 == '0530' or $nat1 == '0531' or $nat1 == '0532' or $nat1 == '0533' or $nat1 == '0534' or $nat1 == '0535' or $nat1 == '0536' or $nat1 == '0537' or $nat1 == '0538' or $nat1 == '0539' or $nat1 == '0540' or $nat1 == '0541' or $nat1 == '0542' or $nat1 == '0543' or $nat1 == '0544' or $nat1 == '0545' or $nat1 == '0546' or $nat1 == '0547' or $nat1 == '0830' or $nat1 == '0850' or $nat1 == '0930')
	{
	$naturaleza = "CREDITO";
	}
}
	
	$sqlsuma = "select sum(debito),sum(credito) from aux_cta_0  where cuenta='$row4[cuenta]' and fecha BETWEEN  '$fecha_ini' AND '$corte_mes_anterior'  group by cuenta";
	$resulsuma= mysql_db_query($database, $sqlsuma, $connectionxx);
	while($rowsuma = mysql_fetch_array($resulsuma)) 
	{
		$debito_suma=$rowsuma['sum(debito)'];
		$credito_suma=$rowsuma['sum(credito)'];
	}
	
	if($naturaleza=="DEBITO")	
	$saldosuma=$debito_suma-$credito_suma;
	if($naturaleza=="CREDITO")	
	$saldosuma=$credito_suma-$debito_suma;
	
	
	//  **** MOVIMIENTOS DE LAS CUENTAS CERO AUXILIARES**********
	
	$sqlnom="select nom_rubro from pgcp where cod_pptal='$row4[cuenta]'";
	$resnom=mysql_db_query($database,$sqlnom,$connectionxx);
	$rownom=mysql_fetch_array($resnom);
	
	$sql5= "select * from aux_cta_0 where cuenta='$row4[cuenta]' and fecha BETWEEN  '$corte_ini' AND '$corte' order by cuenta asc";
	$res5 = mysql_db_query($database, $sql5, $connectionxx);
	$filassuma=mysql_num_rows($res5);
	if($filassuma>0|| $saldosuma!=0)
	{
	echo"<br>";

	echo "<table border='1' width='60%' align='center'>
 		 <tr>
    		<td><b>Fecha</b></td>
    		<td><b>Documento</b></td> 
			<td><b>Detalle</b></td>       
    		<td><b>Debito</b></td>
   			<td><b>Credito</b></td>
			<td><b>Saldo</b></td>
 		 </tr>";
 	echo" <tr >
    		<td ><b>  </b></td>
    		<td><b> </b></td>			
    		<td>Saldo inicial </td>
    		<td>0</td>	
			<td>0</td>	
			<td align='right'>$saldosuma</td>
		  </tr>";
		  $saldocero=$saldosuma;
		  $debitoac=0;
		  $creditoac=0;
		  while($row5 = mysql_fetch_array($res5)) 
		 {
			 
			 if($naturaleza=="DEBITO")
			 $saldocero=$saldocero+$row5[debito]-$row5[credito];
			 if($naturaleza=="CREDITO")
			 $saldocero=$saldocero-$row5[debito]+$row5[credito];
			 echo 
			 "<tr>
      				<td>$row5[fecha] </td>
					<td>$row5[dcto] </td>
			     	<td>$row5[detalle] </td>
				    <td align='right'>$row5[debito] </td>
				    <td align='right'>$row5[credito] </td>
					<td align='right'>$saldocero </td>
			 </tr>";
			 $debitoac=$debitoac+$row5[debito];
			 $creditoac=$creditoac+$row5[credito];
			 
		 }
		 echo" <tr >
    		<td ><b>  </b></td>
			<td ><b>  </b></td>
    		<td align='right'>Suma total </td>
    		<td align='right'>$debitoac </td>
    		<td align='right'>$creditoac</td>	
			<td align='right'>$saldocero</td>	
		  </tr>";
		 
		 echo "<b>Cuenta: ".$row4[cuenta]."  ".$rownom[nom_rubro]."</b>";
		 echo"</table>";
	}
	
}

?>

<br />
<br />
<br />

<table width='1380' border ='0' align='center' class='bordepunteado1'>
<tr>
	<td align="left" colspan="3"><b><?php echo $rep; ?></b></td>
	<td></td>
	<td align="left" colspan="2"><b><?php echo $conta; ?></b></td>
</tr>
<tr>
	<td align="left" colspan="3">Representante Legal</b></td>
	<td></td>
	<td align="left" colspan="2">Contador P&uacute;blico</td>
</tr>

</table>


</body>
</html>
<?php
?>
<?
//}
?>