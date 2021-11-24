<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201102_F13C_10_CDN.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

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

 <?
 //87217782

$documento=$_POST['tercero_doc'];
include('../config.php');
$conexion=mysql_connect ($server, $dbuser, $dbpass);
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$sqe = "SELECT * from terceros_naturales where num_id='$documento'";
$rese = mysql_db_query($database, $sqe, $cx);
$fil=mysql_num_rows($rese);
$rwe = mysql_fetch_array($rese);
if($fil>0)
{
	
	$pn=$rwe["pri_nom"];
	$sn=$rwe["seg_nom"];
	$pa=$rwe["pri_ape"];
	$sa=$rwe["seg_ape"];
	
	$nombre=$pn.' '.$sn.' '.$pa.' '.$sa;
	
}
else
{
	$sqe = "SELECT * from terceros_juridicos where num_id2='$documento'";
	$rese = mysql_db_query($database, $sqe, $cx);
	$rwe = mysql_fetch_array($rese);
	$pn=$rwe["pri_nom"];
	$sn=$rwe["seg_nom"];
	$pa=$rwe["pri_ape"];
	$sa=$rwe["seg_ape"];
	
	$nombre=$pn.' '.$sn.' '.$pa.' '.$sa;
}

$rwe = mysql_fetch_array($rese);


printf("
	<br />
	
	<table  BORDER='0' class='bordepunteado1'>
	<tr>
	<td colspan='4' align='center'><font size='+3'> </font> </td>
	</tr>
	<tr>
	<td colspan='4' align='center'><font size='+3'> Informe de ejecuci�n por Tercero</font> </td>
	</tr>
	
	<tr>
	<td colspan='1' bgcolor='#DCE9E5' align='right'><font size= '+2'><b>Nombre: </b></td>
	<td colspan='3' bgcolor='#DCE9E5' align='left'><b> %s </b></td>
	
	</tr>
	<tr>
	<td colspan='1' bgcolor='#DCE9E5' align='right'><font size= '+2'><b>Cedula: </b></td>
	<td colspan='3' bgcolor='#DCE9E5' align='left'><b> %s </b></td>
	
	</tr>",$nombre,$documento);
	
printf("
    <table  BORDER='0' class='bordepunteado1'>
	");	
	



$sqcrpp = "SELECT * from terceros_naturales where num_id='$documento'";
$rescrpp = mysql_db_query($database, $sqcrpp, $cx);
$filas=mysql_num_rows($rescrpp);

if($filas >0)
{
	printf("
	<br />
	<table  BORDER='1' class='bordepunteado1'>
	<tr>
	<td colspan='4' align='center'>Terceros naturales </td>
	</tr>
	
	<tr>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Detalle </b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Documento</b></td>
	</tr>");
}
$sumanat=0;
while($rw2 = mysql_fetch_array($rescrpp))
{
	$id=$rw2["id"];
	
	$sqnat = "SELECT * from crpp where ter_nat='$id'";
	$resnat = mysql_db_query($database, $sqnat, $cx);
	
	
	while($rw3 = mysql_fetch_array($resnat))
	{
		$sumanat=$sumanat+$rw3["vr_digitado"];
		$fecha_n=$rw3["fecha_crpp"];
		$descripcion_n=$rw3["detalle_crpp"];
		$valor_n=number_format($rw3["vr_digitado"],2,',','.');
		$doccrpp=$rw3["id_manu_crpp"];
	
		printf("<tr>
			<td  align='center'>%s</td>
			<td  align='justify'>%s</td>
			<td  class = 'numero' align='center'>%s</td>
			<td  align='center'>%s</td>
			</tr>",$fecha_n,$descripcion_n,$valor_n,$doccrpp);
	}
	printf("<tr>
        <td colspan='2' align='right'><b>Suma Total</b></td>
		<td  align='left'><b>%s</b></td>
		</tr>",$sumanat);
	
}


?>
</table>


<?


$sqcrpp = "SELECT * from terceros_juridicos where num_id2='$documento'";
$rescrpp = mysql_db_query($database, $sqcrpp, $cx);

$filas=mysql_num_rows($rescrpp);

if($filas >0)
{
	printf("
	<br />
	<table  BORDER='1' class='bordepunteado1'>
	<tr>
	<td colspan='4'> Terceros juridocos </td>
	</tr>
	<tr>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Detalle </b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Documento</b></td>
	</tr>");
}
$sumaju=0;
while($rw2 = mysql_fetch_array($rescrpp))
{
	$id=$rw2["id"];
	
	$sqnat = "SELECT * from crpp where ter_jur='$id'";
	$resnat = mysql_db_query($database, $sqnat, $cx);
	while($rw3 = mysql_fetch_array($resnat))
	{
		$sumaju=$sumaju+$rw3["vr_digitado"];
		$fecha_n=$rw3["fecha_crpp"];
		$descripcion_n=$rw3["detalle_crpp"];
		$valor_n=number_format($rw3["vr_digitado"],2,',','.');
		$doccrpp=$rw3["id_manu_crpp"];
	
		printf("<tr>
			<td  align='center'>%s</td>
			<td  align='justify'>%s</td>
			<td  class = 'numero' align='center'>%s</td>
			<td  align='center'>%s</td>
			</tr>",$fecha_n,$descripcion_n,$valor_n,$doccrpp);
	}
	
	printf("<tr>
        <td colspan='2' align='right'><b>Suma Total</b></td>
		<td  align='left'><b>%s</b></td>
		</tr>",$sumaju);
	
}

?>
</table>

<?

printf("
<br />
<table  BORDER='1' class='bordepunteado1'>
<tr>
	<td colspan='4' align='center'>Terceros COBP </td>
	</tr>
<tr>
<td bgcolor='#DCE9E5' align='center'><b>Fecha</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Detalle </b></td>
<td bgcolor='#DCE9E5' align='center'><b>Valor</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Documento</b></td>
</tr>");

$sumacobp=0;
$sqcobp = "SELECT * from cobp where ccnit='$documento'";
$rescobp = mysql_db_query($database, $sqcobp, $cx);
while($rw = mysql_fetch_array($rescobp))
{
	$fecha=$rw["fecha_cobp"];
	$descripcion=$rw["des_cobp"];
	$valorc=number_format($rw["vr_digitado"],2,',','.');
	$doccobp=$rw["id_manu_cobp"];
	$sumacobp=$sumacobp+$rw["vr_digitado"];
	printf("<tr>
			<td  align='center'>%s</td>
			<td  align='justify'>%s</td>
			<td class = 'numero' align='center'>%s</td>
			<td  align='center'>%s</td>
			</tr>",$fecha,$descripcion,$valorc,$doccobp);
}
printf("<tr>
        <td colspan='2' align='right'><b>Suma Total</b></td>
		<td  align='left'><b>%s</b></td>
		</tr>",$sumacobp);




?>

</table>

<?
printf("
<br />
<table  BORDER='1' class='bordepunteado1'>
<tr>
	<td colspan='4' align='center'>Terceros CEVA </td>
	</tr>
<tr>
<td bgcolor='#DCE9E5' align='center'><b>Fecha</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Detalle </b></td>
<td bgcolor='#DCE9E5' align='center'><b>Valor</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Documento</b></td>
</tr>");
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$sqcobp = "SELECT * from ceva where ccnit='$documento'";
$rescobp = mysql_db_query($database, $sqcobp, $cx);
$sumaceva=0;
while($rw = mysql_fetch_array($rescobp))
{
	$fecha=$rw["fecha_cobp"];
	$descripcion=$rw["des_cobp"];
	$valor=$rw["salud"]+$rw["pension"]+$rw["libranza"]+$rw["f_solidaridad"]+$rw["f_empleados"]+$rw["sindicato"]+$rw["embarfo"]+$rw["vruce"]+$rw["otros"]+$rw["vr_retefuente"]+$rw["vr_reteiva"]+$rw["vr_reteica"]+$rw["vr_estampilla1"]+$rw["vr_estampilla2"]+$rw["vr_estampilla3"]+$rw["vr_estampilla4"]+$rw["vr_estampilla5"]+$rw["total_pagado"];
	$docceba=$rw["id_manu_ceva"];
	$sumaceva=$sumaceva+$valor;
	
	printf("<tr>
			<td  align='center'>%s</td>
			<td  align='justify'>%s</td>
			<td  class = 'numero' align='center'>%s</td>
			<td  align='center'>%s</td>
			</tr>",$fecha,$descripcion,$valor,$docceba);
}
printf("<tr>
        <td colspan='2' align='right'><b>Suma Total</b></td>
		<td  align='left'><b>%s</b></td>
		</tr>",$sumaceva);




?>


</table>


</body>


<? } ?>