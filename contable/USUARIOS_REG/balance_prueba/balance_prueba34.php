<?
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
	header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=BALANCE_DE_PRUEBA.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
.Estilo8 {color: #FFFFFF}
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
.Estilo9 {
	color: #FF0000;
	font-weight: bold;
}
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo9 {font-weight: bold}
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo15 {color: #000000}
.Estilo17 {font-weight: bold}
.Estilo1x {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}

.text
  {
 mso-number-format:"\@"
  }
-->
</style>



<script>

function hand()
{
	document.body.style.cursor="Pointer";
}

function nohand()
{
	document.body.style.cursor="default";
}




</script>
</head>


</head>

<body>
<?php
include('../config.php');
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$fecha_ini=$_GET['fecha_ini']; //printf("fecha_ini : %s <br>",$fecha_ini);
$fecha_fin=$_GET['fecha_fin'];//printf("fecha_fin : %s <br>",$fecha_fin);
$cod_ini=$_POST['cod_ini'];//printf("cod_ini : %s <br>",$cod_ini);
$cod_fin=$_POST['cod_fin'];//printf("cod_fin : %s <br>",$cod_fin);
$aux=$_POST['nivel'];
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
$idxx=$rowxx["id_emp"];
$id_emp=$rowxx["id_emp"];
$ano=$rowxx["ano"];
}
$sqldatos = "select * from empresa";
$resdatos= mysql_db_query($database,$sqldatos,$connectionxx);
while ($rw1 = mysql_fetch_array($resdatos))
	{
		$entidad = $rw1["raz_soc"];
		$nit = $rw1["nit"];
		$rep = $rw1["nom_rep_leg"];
		$conta = $rw1["nom_cont"];
	} 
?>
<table width='1380' border ='0' align='center' >
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
	<td>BALANCE DE PRUEBA</td>
</tr>
<tr>
	<td><b>FECHA DE CORTE:</b></td>
	<td align="left"><?php echo $fecha_fin; ?></td>
</tr>
<tr>
	<td><b>FECHA REPORTE:</b></td>
	<td align="left"><?php echo date('Y/m/d'); 
; ?></td>
</tr>

</table>
<table width="800" border="0" align="center">
  <tr>
    <td colspan="3">
<?
$sqlxx3 = "select * from aux_bal_prueba";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);
while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{
$mov=$rowxx3["mov"];
}


if($aux == '')
{
$aux='4';
}

$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
//$sq = "select * from bal_prueba_deb order by codigo asc ";
$sq = "select * from bal_prueba_deb  order by codigo asc ";
$re = mysql_db_query($database, $sq, $cx);
// encabezados de tabla
printf("
<center>
<table width='960' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='150'><span class='Estilo4'><b>Codigo</b></span></td>
<td align='center' width='400'><span class='Estilo4'><b>Nombre Cuenta</b></span></td>
<td align='center' width='30'><span class='Estilo4'><b>Tipo</b></span></td>
<td align='center' width='30'><span class='Estilo4'><b>Nivel</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>Debito</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>Credito</b></span></td>
<tr>
");

while($rw = mysql_fetch_array($re)) 
{
$nn1=$rw["codigo"];
/*LAS CUENTAS QUE INICIAN CON : 1,5,6,7 Y 8 SON DE SALDO DEBITO
LAS CUENTAS QUE INICIAN CON : 2,3,4 Y 9 SON DE SALDO CREDITO*/
//******* naturaleza de la cuenta
			$nat1 = substr($nn1,0,1);
			
			$nat2 = substr($nn1,0,2);
			
		if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
			{	$naturaleza = "DEBITO";	}
			else
			{   if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89')
				{
				$naturaleza = "CREDITO";
				}
			}


if($naturaleza == 'DEBITO')
{

	$tipo=$rw["tipo"];
	$nivel=$rw["nivel"];
	if($tipo == 'D')
	{
		if ($mov == 'SI') 
		{
			$cred = $rw["credito"]; }else{ $cred =0;
		}
			printf("
			<span class='Estilo4'>
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
			
			printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
					<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",number_format($rw["debito"],2,'.',','),number_format($cred,2,'.',','));
			
				printf("</tr>");		
	}
	else
	{
				
				$cod=$rw["codigo"];
				$link=mysql_connect($server,$dbuser,$dbpass);
				$resulta=mysql_query("select SUM(debito) AS TOTAL, sum(credito) as tot_cre from bal_prueba_deb WHERE tipo = 'D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
				$row=mysql_fetch_row($resulta);
				$total=$row[0]; 
				$tot_cre=$row[1]; 
				$nuevo_total = $total;
				//printf("acu : %s",$nuevo_total);
				
/*				if($nuevo_total == '')
				{$nuevo_total = 0.00;}*/
				
				if($nuevo_total == '')
				{
				
				}
				else
				{
				
						//*** nuevo 25/05/2010
						if($cod == '9')
						{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left' class='text'>%s</td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
						
						printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>0.00</span></td>
								<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>0.00</span></td>");
								
						printf("</tr>");
						
						}
						//**************
						else
						{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left' class='text'>%s </td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
						
						printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
								<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",number_format($nuevo_total,2,'.',','),number_format($tot_cre,2,'.',','));
								
						printf("</tr>");
						}
				}
	}
	
}	
else// si la naturaleza es credito
{
	$tipo=$rw["tipo"];
	if($tipo == 'D')
	{
		if ($mov == 'SI') 
		{
			$debit = $rw["debito"]; }else{ $debit =0;
		}
    printf("
	<span class='Estilo4'>
	<tr>
	<td align='left' class='text'>%s </td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='center'><span class='Estilo4'> %s </span></td>
	<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
	 
	
	printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
			<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",number_format($debit,2,'.',','),number_format($rw["credito"],2,'.',','));
			
		printf("</tr>");		
	
	}
	else
	{
	
	$cod=$rw["codigo"];
	$link=mysql_connect($server,$dbuser,$dbpass);
	$resulta=mysql_query("select SUM(credito) AS TOTAL, sum(debito) as tot_deb from bal_prueba_deb WHERE tipo = 'D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total=$row[0]; 
	$tot_deb=$row[1];
	$nuevo_total = $total;
	//printf("acu : %s",$nuevo_total);
/*	if($nuevo_total == '')
	{$nuevo_total = 0.00;}*/
				if($nuevo_total == '')
				{
				
				}
				else
				{
					
				
						//*** nuevo 25/05/2010
						if($cod == '9')
						{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left' class='text'>%s </td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
						
						printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>0.00</span></td>
								<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>0.00</span></td>");
								
						printf("</tr>");
						
						}
						else
						{
						//**************
							printf("
							<span class='Estilo4'>
							<tr>
							<td align='left' class='text'>%s </td>
							<td align='left'><span class='Estilo4'> %s </span></td>
							<td align='center'><span class='Estilo4'> %s </span></td>
							<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
							printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
									<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",number_format($tot_deb,2,'.',','),number_format($nuevo_total,2,'.',','));
									
							printf("</tr>");
						}	
				}
	}
}
}//fin while
printf("</table></center>");
?>
	</td>
  </tr>
</table>
</body>
</html>
<?
}
?>