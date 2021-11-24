<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$_GET[tipo].xls");
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
<?
// fehca de corte
$corte =$_GET['corte']; // borrar
$fecha2 = explode("/", $corte);
if ($fecha2[1] =='03') $fecha_ini =$fecha2[0].'/01/01'; 
if ($fecha2[1] =='06') $fecha_ini =$fecha2[0].'/04/01'; 
if ($fecha2[1] =='09') $fecha_ini =$fecha2[0].'/07/01'; 
if ($fecha2[1] =='12') $fecha_ini =$fecha2[0].'/10/01';   
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Realizo consultas para generar el informe para el Chip
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $cx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $fecha_ini_op=$rowxx3["fecha_ini_op"];
   }  

$rea =mysql_db_query($database,"select * from fut_aux_ing",$cx);
$rwa =mysql_fetch_array($rea);
$fecha = $rwa["fecha"];
$reb =mysql_db_query($database,"select * from empresa",$cx);
$rwb =mysql_fetch_array($reb);
$cod_cgn = $rwb["cod_cgn"];
$fecha2 = explode("/", $corte);
$anno = $fecha2[0];
$periodo = $fecha2[1];
if ($periodo =='03') $periodo2 ='10103';
if ($periodo =='06') $periodo2 ='10406';
if ($periodo =='09') $periodo2 ='10709';
if ($periodo =='12') $periodo2 ='11012';
	printf("
		<table  border='1'>
		");
		printf("
		<tr>
		<td align='left' bgcolor='#CCCCCC'>CUENTA</td>
		<td align='left' bgcolor='#CCCCCC'>DETALLE</td>
		<td align='left' bgcolor='#DCE9E5'>C</td>
		<td align='left' bgcolor='#DCE9E5'>CONCEPTO</td>
		<td align='center' bgcolor='#DCE9E5'>CUENTAS_CORRIENTES</td>
		<td align='center' bgcolor='#DCE9E5'>CUENTAS_AHORROS</td>
		<td align='center' bgcolor='#DCE9E5'>ENCARGO_FIDUCIARIO</td>
		<td align='center' bgcolor='#DCE9E5'>INFIS</td>
		<td bgcolor='#DCE9E5' align='center'>OTROS_DEPOSITOS</td>
		<td bgcolor='#DCE9E5' align='center'>OTROS_ENTIDAD</td>
		<td bgcolor='#DCE9E5' align='center'>RENDIMIENTOS</td>
		<td bgcolor='#DCE9E5' align='center'>CDT</td>
		<td bgcolor='#DCE9E5' align='center'>TES</td>
		<td bgcolor='#DCE9E5' align='center'>CARTERAS_COLECTIVAS</td>
		<td bgcolor='#DCE9E5' align='center'>OTRAS_INVERSIONES</td>
		</tr>
		");
	$sq = mysql_db_query ($database,"select * from pgcp where (cod_pptal like '1110%' or cod_pptal like '190101%') and tip_dato ='D' order by cod_pptal",$cx);
	while ($rw = mysql_fetch_array($sq))
	{
	// consultar el saldo en libros segun la fecha de corte
     	$sq2 = "select DISTINCT saldo_final from aux_conciliaciones2 where cuenta = '$rw[cod_pptal]' and fecha_fin ='$corte'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		$rw2 = mysql_fetch_array($re2);
		$valor_c=0;
		$valor_a=0;
		$sq5 ="select debito from sico where cuenta = '$rw[cod_pptal]'";
		$re5 = mysql_db_query($database, $sq5, $cx);
		$rw5= mysql_fetch_array($re5);
		
			$sq6 ="select sum(debito) as debito, sum(credito) as credito from lib_aux where cuenta = '$rw[cod_pptal]' and fecha <= '$corte' and fecha >='$fecha_ini_op'";
			$rs6 = mysql_db_query($database,$sq6,$cx);
			$rw6 = mysql_fetch_array($rs6);
			$saldo = $rw5['debito'] + $rw6['debito'] - $rw6['credito'];

		if($rw['tip_cta'] =='CORRIENTE') $valor_c = round($saldo/1000)  ;
		if($rw['tip_cta'] =='AHORROS') $valor_a =  round($saldo/1000) ;
		if($rw['tip_cta'] =='') $valor_c =  round($saldo/1000) ;
		// Rendimientos financieros
		$sq3 = "select * from lib_aux where cuenta = '$rw[cod_pptal]'";
		$rs3 = mysql_db_query($database,$sq3,$cx);
		$rend =0;
		$val = $valor_c + $valor_a;
		$doc = $rw['dcto'];
		while ($rw3 = mysql_fetch_array ($rs3))
		{
			/*$sq4 = "select debito as rendi from lib_aux where cuenta = '$rw[cod_pptal]' and (dcto like 'NCBT%' or dcto like 'NCSP%') ";	
			$rs4 = mysql_db_query($database,$sq4,$cx);
			$rw4 = mysql_fetch_array($rs4);
			$rend += round($rw4['debito']/1000); */
		}
			$sq4 = "select sum(debito) from lib_aux where cuenta = '$rw[cod_pptal]' and (dcto like 'NCBT%' or dcto like 'NCSP%')  and fecha <= '$corte' ";
			$rs4 = mysql_db_query($database,$sq4,$cx);
			$rw4 = mysql_fetch_array($rs4);
			$rend = round($rw4['sum(debito)']/1000); 
		if ($saldo != 0)
		{
		printf("
				<tr>
				<td align='left' bgcolor='#CCCCCC'>%s</td>
				<td align='left' bgcolor='#CCCCCC'>%s</td>
				<td align='left'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='center'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				</tr>
				",$rw['cod_pptal'],$rw['nom_rubro'],'D',$rw['cod_fut_el'],$valor_c,$valor_a,0,0,0,'NA',$rend,'0','0','0','0');
	$rend=0;
	$val =0;
	$saldo =0;
		}
	}

printf("</table></center>");
 }
?>
</body>
</html>
		