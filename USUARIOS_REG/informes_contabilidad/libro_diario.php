<?php
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=LIBRO_DIARIO.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
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
.xl77
	{mso-style-parent:style0;
	text-align:left;
	border:.5pt solid black;}
</style>
<?php
$fec1 =$_GET['fec1'];
$fec2 =$_GET['fec2'];
include('../config.php');		
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlv = mysql_db_query($database,"select * from vf",$cx);
while ($rwv = mysql_fetch_array($sqlv))
	{
		$fecha_ini = $rwv["fecha_ini"];
	} 
	$cod2 = explode("/", $fecha_ini);
	$anno = $cod2[0]; 
$sql1 = mysql_db_query($database,"select * from empresa",$cx);
while ($rw1 = mysql_fetch_array($sql1))
	{
		$entidad = $rw1["raz_soc"];
		$nit = $rw1["nit"];
		$rep = $rw1["nom_rep_leg"];
		$conta = $rw1["nom_cont"];
	} 
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
	<td>LIBRO DIARIO </td>
</tr>
<tr>
	<td><b>PERIODO:</b></td>
	<td align="left"><?php echo "$fec1 a $fec2"; ?></td>
</tr>
<tr>
	<td><b>VIGENCIA:</b></td>
	<td align="left"><?php echo $anno; ?></td>
</tr>
<tr>
	<td><b>FECHA REPORTE:</b></td>
	<td align="left"><?php echo date('Y/m/d');  ?></td>
</tr>

</table>

<?php

printf ("<table width='1250' border ='1' align='center' class='bordepunteado1'>
		<tr>
		<td bgcolor='#DCE9E5' width='120' rowspan='2' align='center' class='Estilo4'><b>Cuenta</b></td>
		<td bgcolor='#DCE9E5' width='600' rowspan='2' align='center' class='xl77'><b>Nombre</b></td>
		<td bgcolor='#DCE9E5' width='240' colspan='2' align='center' class='Estilo4'><b>Movimiento</b></td>
		<td bgcolor='#DCE9E5' width='240'colspan='2' align='center' class='Estilo4'><b>Saldo</b></td>
		<td bgcolor='#DCE9E5' width='25' rowspan='2' align='center' class='Estilo4'><b>T</b></td>
		<td bgcolor='#DCE9E5' width='25' rowspan='2' align='center' class='Estilo4'><b>N</b></td>
		</tr>
		<tr>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Debito</b></td>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Credito</b></td>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Debito</b></td>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Credito</b></td>
		</tr>");
include('../config.php');		
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from pgcp group by cod_pptal order by cod_pptal asc";
$res = mysql_db_query($database, $sql, $cx) or die ($resultadoxx2 .mysql_error()."");
while($row = mysql_fetch_array($res)) 
{
	$ini_deb = 0;
				$ini_cred = 0;
				$deb = 0;
				$cred = 0;
				$sal_deb = 0;
				$sal_cred = 0;
	$cuenta=$row["cod_pptal"];
	$tip_dato=$row["tip_dato"];
	$nivel=$row["nivel"];
	$nombre=ereg_replace("[,;?]", "",$row["nom_rubro"]);
	$nivel =strlen($cuenta);
		$sq2 = "select sum(inicial_deb),sum(inicial_cred),sum(debito),sum(credito),sum(saldo_deb),sum(saldo_cred) from aux_contaduria_gral where cuenta like '$cuenta%'"; 	
		$re2 = mysql_db_query($database,$sq2,$cx);
		while ($rw2 = mysql_fetch_array($re2))
			{
				$ini_deb = $rw2["sum(inicial_deb)"];
				$ini_cred = $rw2["sum(inicial_cred)"];
				$deb = $rw2["sum(debito)"];
				$cred = $rw2["sum(credito)"];
				$sal_deb = $rw2["sum(saldo_deb)"];
				$sal_cred = $rw2["sum(saldo_cred)"];
				
				$suma = abs($ini_deb) + abs($ini_cred) + abs($deb) + abs($cred);
					if ($suma !=0)
					{
					printf("
							<tr>
							<td  align='left' class='text'>%s</td>
							<td  align='left' class='Estilo4'>%s</td>
							<td  align='right' class='Estilo4'>%s</td>
							<td  align='right' class='Estilo4'>%s</td>
							<td  align='right' class='Estilo4'>%s</td>
							<td  align='right' class='Estilo4'>%s</td>
							<td  align='left' class='Estilo4'>%s</td>
							<td  align='left' class='Estilo4'>%s</td>
							</tr>
							",$cuenta, $nombre, $deb,$cred,$sal_deb,$sal_cred,$tip_dato,$nivel);
					}
				$ini_deb = 0;
				$ini_cred = 0;
				$deb = 0;
				$cred = 0;
				$sal_deb = 0;
				$sal_cred = 0;
					
			}
}
printf("</table>");
} // Sesion 

?>

<br />
<br />
<br />

<table width='1320' border ='0' align='center' class='bordepunteado1'>
<tr>
	<td align="left" colspan="2" width="720"><b><?php echo $rep; ?></b></td>
	<td width="120"></td>
	<td width="240" colspan="2" align="left"><b><?php echo $conta; ?></b></td>
	<td width="120"></td>
	<td width="120"></td>
</tr>
<tr>
	<td align="left" colspan="2">Representante Legal</b></td>
	<td></td>
	<td align="left" colspan="2">Contador P&uacute;blico</td>
	<td></td>
	<td></td>
</tr>

</table>

