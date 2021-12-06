<?php
set_time_limit(1800);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=MANTENIMIENTO.xls");
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
<div align="center" class="Estilo4">
<div style='padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;'>
 <?php
$fecha_ini=$_POST['fecha_ini'];
$fecha_fin=$_POST['fecha_fin'];
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
printf("
<center>
<table width='1500' BORDER='1' class='bordepunteado1'>
<tr>
	<td bgcolor='#DCE9E5' align='center'><b>Rubro</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>No</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>No CDP</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha CRP</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>No CRP</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Comprobante de egreso</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Objeto</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor Egreso</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor CDPP</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Contrato</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>CC / NIT</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Tercero</b></td>
</tr>
");
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// filtro la consulta para los rubros de mantenimiento
$sq3 ="select * from car_ppto_gas where opc1 ='MANTENIMIENTO'";
$rs3 = mysql_db_query($database,$sq3,$cx);
$cont=1;
while ($rw3 = mysql_fetch_array($rs3))
{		
	$sq = "SELECT * from crpp where cuenta = '$rw3[cod_pptal]' order by fecha_crpp asc";
	$re = mysql_db_query($database, $sq, $cx);
	while($rw = mysql_fetch_array($re))
	{
				// Consulto el valor del cdpp asociado
				$sq4 ="select sum(valor) from cdpp where consecutivo ='$rw[id_auto_cdpp]' and cuenta ='$rw3[cod_pptal]'";
				$rs4 =mysql_db_query($database,$sq4,$cx);
				$rw4 =mysql_fetch_array($rs4);
				// CONSULTO SI EL REGISTRO TIENE RELACIONADO UN NUMERO DE CONTRATO
				$id_auto_crpp=$rw["id_auto_crpp"];
				$sq2 = "SELECT * from contrataciones2 where id_auto_crpp ='$id_auto_crpp'";
				$re2 = mysql_db_query($database, $sq2, $cx);
				$rw2 = mysql_fetch_array($re2);
				// Consulto datos de los terceros
				$ter_nat =$rw["ter_nat"];
				$ter_jur =$rw["ter_jur"];
				if (!empty($ter_nat))
				{
					// ********* CONSULTO TERCEROS NATURALES	
					$sq8 = "SELECT * FROM terceros_naturales where id='$ter_nat'";	
					$re8 = mysql_db_query($database, $sq8, $cx);
					$rw8 = mysql_fetch_array($re8);
					$doc = $rw8["num_id"];
					$nombre =$rw8["pri_nom"]." ".$rw8["seg_nom"]." ".$rw8["pri_ape"]." ".$rw8["seg_ape"];
				}else{
					$sq8 = "SELECT * FROM terceros_juridicos where id='$ter_jur'";	
					$re8 = mysql_db_query($database, $sq8, $cx);
					$rw8 = mysql_fetch_array($re8);
					$doc =$rw8["num_id2"]; 
					$nombre ='JURIDICA';
				}
				// valor pagado en el bimestre o periodo reportado
					$sqlceva = "
					SELECT
						SUM(cobp.vr_digitado)
						, cobp.id_auto_crpp
						, ceva.fecha_ceva
						, ceva.id_manu_ceva
					FROM
						cobp
						INNER JOIN ceva 
							ON (cobp.id_auto_crpp = ceva.id_auto_crpp)
					WHERE (ceva.fecha_ceva between '$fecha_ini' and '$fecha_fin'
						AND cobp.pagado ='SI')
						AND cobp.id_auto_crpp ='$rw[id_auto_crpp]'
					GROUP BY cobp.id_auto_crpp,ceva.fecha_ceva,ceva.id_manu_ceva;		
						 ";
				$res8 = mysql_db_query($database,$sqlceva,$cx);		
				$row8=mysql_fetch_array($res8);
				$total_ceva1=$row8['SUM(cobp.vr_digitado)'];
				$n_ceva1 = $row8['id_manu_ceva'];
				if (!$total_ceva1) $total_ceva1=0;

		// Pagos acumulados
				$sqlceva2 = "
				
				SELECT
					SUM(cobp.vr_digitado)
					, cobp.id_auto_crpp
					, ceva.fecha_ceva
					, ceva.id_manu_ceva
				FROM
					cobp
					INNER JOIN ceva 
						ON (cobp.ceva = ceva.id_auto_ceva)
				WHERE (cobp.id_auto_crpp ='$rw[id_auto_crpp]'
					AND ceva.fecha_ceva between '$fecha_ini' and '$fecha_fin'
					AND cobp.ceva !='')
				GROUP BY cobp.id_auto_crpp;
						 ";
				$res9 = mysql_db_query($database,$sqlceva2,$cx);		
				$row9=mysql_fetch_array($res9);
				$total_ceva2=$row9['SUM(cobp.vr_digitado)'];
				$n_ceva2 = $row9['id_manu_ceva'];
				if (!$total_ceva2) $total_ceva2=0;

				//totales
				$total_ceva = $total_ceva1 + $total_ceva2;
				$n_ceva = $n_ceva1.$n_ceva2;
				
				// filtro por fechas
				//if ($rw["fecha_crpp"] >= $fecha_ini and  $rw["fecha_crpp"] <= $fecha_fin)
				//{
				printf("
				<tr>  
					<td  align='center'>%s</td>
					<td  align='center'>%s</td>
					<td  align='center'>%s</td>
					<td  align='center'>%s</td>
					<td  align='center'>%s</td>
					<td  align='center'>%s</td>
					<td  align='left'>%s</td>
					<td  align='center'>%s</td>
					<td  align='center'>%s</td>
					<td  align='center' class='text'>%s</td>
					<td  align='center'>%s</td>
					<td  align='center'>%s</td>
				</tr>",$rw["cuenta"],$cont,$rw["id_manu_cdpp"],$rw["fecha_crpp"],$rw["id_manu_crpp"],$n_ceva,$rw["detalle_crpp"],$total_ceva,$rw4['sum(valor)'],$rw2["num_contrato"],$doc,$nombre,$rw2["clas_contrato"]); 
				//} // end fin filtro contratos del periodo
				$cont++;
				$total_ceva=0;
				$n_ceva1='';$n_ceva2='';
				$total_ceva1=0;$total_ceva2=0;
				$id_auto_crpp='';
				
	}
} // end while
printf("</table></center>");
}
?>