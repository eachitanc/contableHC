<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=EJECUCION_DE_INGRESOS_ACUM.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<style type="text/css">
<!--
.Estilo10 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo11 {font-size: 10px}

.text
  {
 mso-number-format:"\@"
  }
-->
</style>
<?php
include('config.php');	
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
 
$sq = "select * from car_ppto_ing  order by cod_pptal asc ";
$re = mysql_query($sq, $cx);
	printf("
	<center>
	
	<table width='1800' BORDER='1' class='bordepunteado1'>
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='150'>Cod. Pptal</td>
	<td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones_mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos_mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Contracreditos_mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Contracreditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos_mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Recaudos_mes</b></span></td>
		<td align='center' width='150'><span class='Estilo4'><b>Recaudos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Saldo x Ejec</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Cuentas x Cobrar</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	</tr>");

while($rw = mysql_fetch_array($re)) 
{
	$sq1 = "select SUM(ini) AS TOTAL from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re1=mysql_query($sq1);
	$rw1=mysql_fetch_array($re1);
	$ini = $rw1['TOTAL'];
	
	$sq2 = "select SUM(adi_m) AS adi_m from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re2=mysql_query($sq2);
	$rw2=mysql_fetch_array($re2);
	$adi_m = $rw2['adi_m'];
	
	$sq2 = "select SUM(adi) AS adi from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re2=mysql_query($sq2);
	$rw2=mysql_fetch_array($re2);
	$adi = $rw2['adi'];
	
	$sq3 = "select SUM(red_m) AS red_m from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re3=mysql_query($sq3);
	$rw3=mysql_fetch_array($re3);
	$red_m = $rw3['red_m'];
	
	$sq3 = "select SUM(red) AS red from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re3=mysql_query($sq3);
	$rw3=mysql_fetch_array($re3);
	$red = $rw3['red'];
	
	$sq4 = "select SUM(cre) AS cre from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re4=mysql_query($sq4);
	$rw4=mysql_fetch_array($re4);
	$cre = $rw4['cre'];
	
	$sq4 = "select SUM(cre_m) AS cre_m from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re4=mysql_query($sq4);
	$rw4=mysql_fetch_array($re4);
	$ccre_m = $rw4['cre_m'];
	
	$sq5 = "select SUM(ccr) AS ccr from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re5=mysql_query($sq5);
	$rw5=mysql_fetch_array($re5);
	$ccr = $rw5['ccr'];
	
	$sq5 = "select SUM(ccr_m) AS ccr_m from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re5=mysql_query($sq5);
	$rw5=mysql_fetch_array($re5);
	$ccr_m = $rw5['ccr_m'];
	
	$sq6 = "select SUM(def) AS def from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re6=mysql_query($sq6);
	$rw6=mysql_fetch_array($re6);
	$def = $rw6['def'];
	
	$sq7 = "select SUM(rcp) AS rcp from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re7=mysql_query($sq7);
	$rw7=mysql_fetch_array($re7);
	$rcp = $rw7['rcp'];
	
	$sq7 = "select SUM(rcp_m) AS rcp_m from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re7=mysql_query($sq7);
	$rw7=mysql_fetch_array($re7);
	$rcp_m = $rw7['rcp_m'];
	
	$sq8 = "select SUM(rec) AS rec from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re8=mysql_query($sq8);
	$rw8=mysql_fetch_array($re8);
	$rec = $rw8['rec'];
	
	$sq8 = "select SUM(rec_m) AS rec_m from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re8=mysql_query($sq8);
	$rw8=mysql_fetch_array($re8);
	$rec_m = $rw8['rec_m'];
	
	$sq9 = "select SUM(sal) AS sal from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re9=mysql_query($sq9);
	$rw9=mysql_fetch_array($re9);
	$sal = $rw9['sal'];
	
	$sq10 = "select SUM(cxc) AS cxc from z_acum_ejec_ing where tipo ='D' and cod_pptal LIKE '$rw[cod_pptal]%'";
	$re10=mysql_query($sq10);
	$rw10=mysql_fetch_array($re10);
	$cxc = $rw10['cxc'];
	
	echo "
	<tr>
	<td class='text' >$rw[cod_pptal]</td>
	<td >$rw[nom_rubro]</td>
	<td >$ini</td>
	<td>$adi_m</td>
	<td>$adi</td>
	<td >$red_m</td>
	<td >$red</td>
	<td>$cre_m</td>
	<td>$cre</td>
	<td>$ccr_m</td>
	<td>$ccr</td>
	<td>$def</td>
	<td >$rcp_m</td>
	<td >$rcp</td>
	<td>$rec_m</td>
	<td>$rec</td>
	<td >$sal</td>
	<td >$cxc</td>
	<td>$rw[tip_dato]</td>
	<td >$rw[nivel]</td>
	</tr>
	";

	
}