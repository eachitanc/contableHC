<?php
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=MAYOR_Y_BALANCE.xls");
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
</style>
<?php
printf ("<table width='1340' border ='1' align='center' class='bordepunteado1'>
		<tr>
		<td bgcolor='#DCE9E5' width='120' rowspan='2' align='center' class='Estilo4'><b>Cuenta</b></td>
		<td bgcolor='#DCE9E5' width='500' rowspan='2' align='center' class='Estilo4'><b>Nombre</b></td>
		<td bgcolor='#DCE9E5' colspan='2' align='center' class='Estilo4'><b>Inicial</b></td>
		<td bgcolor='#DCE9E5' colspan='2' align='center' class='Estilo4'><b>Movimiento</b></td>
		<td bgcolor='#DCE9E5' colspan='2' align='center' class='Estilo4'><b>Saldo</b></td>
		</tr>
		<tr>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Debito</b></td>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Credito</b></td>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Debito</b></td>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Credito</b></td>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Debito</b></td>
		<td bgcolor='#DCE9E5' width='120' align='center' class='Estilo4'><b>Credito</b></td>
		</tr>");
include('../config.php');		
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from pgcp order by cod_pptal asc";
$res = mysql_db_query($database, $sql, $cx) or die ($resultadoxx2 .mysql_error()."");
while($row = mysql_fetch_array($res)) 
{
	$cuenta=$row["cod_pptal"];
	$nombre=ereg_replace("[,;?]", "",$row["nom_rubro"]);
	$nivel =strlen($cuenta);
	if ($nivel <=6)
	{
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
				$suma = $ini_deb + $ini_cred + $deb + $cred + $sal_deb + $sal_cred;
				if ($suma !=0)
					{
						printf("
							<tr>
							<td width='100' align='left' class='text'>%s</td>
							<td width='500' align='left' class='Estilo4'>%s</td>
							<td width='100' align='right' class='Estilo4'>%s</td>
							<td width='100' align='right' class='Estilo4'>%s</td>
							<td width='100' align='right' class='Estilo4'>%s</td>
							<td width='100' align='right' class='Estilo4'>%s</td>
							<td width='100' align='right' class='Estilo4'>%s</td>
							<td width='100' align='right' class='Estilo4'>%s</td>
							</tr>
							",$cuenta, $nombre, $ini_deb,$ini_cred,$deb,$cred,$sal_deb,$sal_cred);
					} 
			}
	}
}
printf("</tr></table>");
} // Sesion
?>
