<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201101_F03B_10_CDN.xls");
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
	mso-number-format:"#,##0.00"	
	}
</style>

</head>
<body>
 <?
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// llegan las variables
$fecha_ini=$_GET['fecha_ini'];
$fecha_fin=$_GET['fecha_fin'];
$mes = $_GET['mes'];
$periodo = array ("","MARZO", "JUNIO", "SEPTIEMBRE", "DICIEMBRE","ANUAL");
for ($i=1;$i<=13;$i++)
{
	if ($mes == $i) $per = $periodo[$i];
}

printf("
<center>
<table BORDER='1' class='bordepunteado1'  width='610'>
<tr>
<td  bgcolor='E0E0E0' align='center' width='140'><span class='Estilo41'>Documento</span></td>
<td  bgcolor='E0E0E0' align='center' width='140'><span class='Estilo41'>Fecha</span></td>
<td  bgcolor='DCE9E5' align='center' width='140'><span class='Estilo41'>Banco Origen</span></td>
<td  bgcolor='E0E0E0' align='center' width='140'><span class='Estilo41'>Cuenta contable</span></td>
<td  bgcolor='DCE9E5' align='center' width='140'><span class='Estilo41'>Numero Cuenta Bancaria</span></td>
<td  bgcolor='DCE9E5' align='center' width='100'><span class='Estilo41'>Fuente De Financiaci�n</span></td>
<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Valor Traslado</span></td>
<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Banco Receptor</span></td>
<td  bgcolor='E0E0E0' align='center' width='140'><span class='Estilo41'>Cuenta contable</span></td>
<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Numero Cuenta Bancaria</span></td>
<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Fuente De Financiaci�n</span></td>
<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Periodo reportado</span></td>
</tr>
");

$sq = "SELECT * from conta_tfin where fecha_ncon BETWEEN '$fecha_ini' AND '$fecha_fin' order by id asc";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re))
{
		$doc =$rw["id_manu_ncon"];
		$fecha =$rw["fecha_ncon"];
		$i=0;$j=0;$k=0;
		for ($i=0;$i<=15;$i++)
		{
			$deb = $rw["vr_deb_$i"];
			if ($deb > 0) 
			{
			$j++;
			$debitos[$j] =$deb;
			$cta_dest[$j] = $rw["pgcp$i"];
			}
			$cred = $rw["vr_cre_$i"];
			if ($cred > 0) 
			{
			$k++;
			$creditos[$k] =$cred;
			$cta_origen[$k] = $rw["pgcp$i"];
			}
		}
	$registros = count($debitos);
	$registros2 =  count($creditos);
	if ($registros != $registros2) {$fondo ="bgcolor='FF2D2D'";}else{$fondo ="bgcolor='E0E0E0'";}
	//echo "registros $registros";
	$e=0;$f=0;
	for ($e=1;$e<=$registros;$e++)
	{
		// Consulto el numero de la cuenta de la banco
		$sq1 = "SELECT fuentes_recursos, cod_sia, num_cta from pgcp where cod_pptal ='$cta_origen[$e]'";
		$re1 = mysql_db_query($database, $sq1, $cx);
		while ($rw1 = mysql_fetch_array($re1))
		{
		$banco_origen = $rw1["cod_sia"];
		$fuente_origen = $rw1["fuentes_recursos"];
		$cuenta_origen = $rw1["num_cta"];
		}
		if ($banco_origen =='') {$fondo1 ="bgcolor='#ffff66'";}else{$fondo1='';}
		if ($fuente_origen =='') {$fondo2 ="bgcolor='#ffff66'";}else{$fondo2='';}
		if ($cuenta_origen =='') {$fondo6 ="bgcolor='#ffff66'";}else{$fondo6='';}
		$sq2 = "SELECT fuentes_recursos, cod_sia, num_cta from pgcp where cod_pptal ='$cta_dest[$e]'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		while ($rw2 = mysql_fetch_array($re2))
		{
		$banco_dest = $rw2["cod_sia"];
		$fuente_dest = $rw2["fuentes_recursos"];
		$cuenta_dest = $rw2["num_cta"];
		}
		if ($banco_dest =='') {$fondo3 ="bgcolor='#ffff66'";}else{$fondo3='';}
		if ($fuente_dest =='') {$fondo4 ="bgcolor='#ffff66'";}else{$fondo4='';}
		if ($cuenta_dest =='') {$fondo5 ="bgcolor='#ffff66'";}else{$fondo5='';}
		echo "<tr>
				<td $fondo>$doc</td>
				<td $fondo align='center'>$fecha</td>
				<td $fondo1 align='center'>$banco_origen</td>
				<td align='center' $fondo >$cta_origen[$e]</td>
				<td align='center' $fondo6 class='text'>$cuenta_origen</td>
				<td $fondo2 align='center'>$fuente_origen</td>
				<td align='right'>$creditos[$e]</td>
				<td $fondo3 align='center'>$banco_dest</td>
				<td align='center' $fondo>$cta_dest[$e]</td>
				<td align='center' $fondo5>$cuenta_dest</td>
				<td $fondo4 align='center'>$fuente_dest</td>
				<td $fondo4 align='center'>$per</td>
			  </tr>";
		} 
/*print_r ($creditos);
echo "origen**";
print_r ($cta_origen);	
echo "<br>";
echo "<br>";
print_r ($debitos);
echo "destino**";
print_r ($cta_dest);
*/
	unset($debitos);
	unset($creditos);
	unset($cta_origen);
	unset($cta_dest);
}	

/*
	
		printf("
					<span class='Estilo4'>
					<tr>
					<td align='left' class='text'>%s</td>
					<td align='center'><span class='Estilo4'> %s </span></td>
					<td align='center' class='date'>%s</td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					</tr>", $rw["cod_pptal"], $tipo_acto, $fecha_adi, $valor_adi, $valor_adir); 
			*/	

	

printf("</table></center>");
}
?>

