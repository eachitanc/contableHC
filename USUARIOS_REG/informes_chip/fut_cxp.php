<?
set_time_limit(1800);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FUT_CUENTAS_POR_PAGAR.xls");
header("Pragma: no-cache");
header("Expires: 0");
$corte=$_GET['corte'];
include("../config.php");
$cx = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database, $cx);
// Borro y creo la tabla auxiliar para genrar el informe
$tabla6="fut_aux_gasf_ok";
$anadir6="DROP TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";
mysql_select_db ($datbase, $cx);

		if(mysql_query ($anadir6 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};
//********************crea tabla fut_aux_ing
$tabla7="fut_aux_gasf_ok";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `ctrl` varchar(200) NOT NULL default '',
  `cod_fut` varchar(200) NOT NULL default '',
  `ent_eje` varchar(200) NOT NULL default '',
  `fuente_rec` varchar(200) NOT NULL default '',
  `ppto_aprob` decimal(20,2) NOT NULL default '0.00',
  `definitivo` decimal(20,2) NOT NULL default '0.00',
  `compromisos` decimal(20,2) NOT NULL default '0.00',
  `obligado` decimal(20,2) NOT NULL default '0.00',
  `pagado` decimal(20,2) NOT NULL default '0.00',
  `tip_acto_adtvo` varchar(200) NOT NULL default '',
  `num_acto_adtvo` varchar(200) NOT NULL default '',
  `fecha_acto_adtvo` varchar(200) NOT NULL default '',
  `cod_ser_deuda` varchar(200) NOT NULL default '',
   PRIMARY KEY  (`id`)
)TYPE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci";
		
		mysql_select_db ($database, $cx);

		if(mysql_query ($anadir7 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}
// Lleno la tabla con los datos requeridos para el informe
$sql = mysql_db_query ($database,"select cod_pptal,cod_fut,fuentes_recursos,ppto_aprob from cxp where tip_dato ='D'",$cx);
while ($row = mysql_fetch_array($sql))
{
	$sq2=  mysql_db_query($database,"select sum(valor) as pagado from cecp_cuenta where cuenta ='$row[cod_pptal]' and fecha_cecp <='$corte'",$cx);
	$row2 = mysql_fetch_array($sq2);
	$cod_fut =$row["cod_fut"];
	$aprob =$row["ppto_aprob"];
	$pagado = $row2["pagado"];
// Guardo la iformacion en la tabla
$sql2 = "INSERT INTO fut_aux_gasf_ok (cod_fut,fuente_rec,ppto_aprob,pagado,fecha_acto_adtvo) VALUES 
('$row[cod_fut]','$row[fuentes_recursos]','$aprob','$pagado','$corte')";
mysql_db_query($database, $sql2, $cx) or die(mysql_error());
}
// Realizo consultas para generar el informe para el Chip
$rea =mysql_db_query($database,"select * from fut_aux_ing",$cx);
$rwa =mysql_fetch_array($rea);
$fecha = $rwa["fecha"];
$reb =mysql_db_query($database,"select * from empresa",$cx);
$rwb =mysql_fetch_array($reb);
$cod_cgn = $rwb["cod_cgn"];
$fecha2 = explode("/", $fecha);
$anno = $fecha2[0];
$periodo = $fecha2[1];
if ($periodo =='03') $periodo2 ='10103';
if ($periodo =='06') $periodo2 ='10406';
if ($periodo =='09') $periodo2 ='10709';
if ($periodo =='12') $periodo2 ='11012';
$sq3 = "SELECT cod_fut,fuente_rec,sum(ppto_aprob),sum(pagado) from fut_aux_gasf_ok group by cod_fut,fuente_rec";
$re3 = mysql_db_query($database,$sq3, $cx) or die(mysql_error());
$cott= 1;
	printf("
	<table  border='1'>
	<tr>
	<td align='center'>S</td>
	<td align='center'>$cod_cgn</td>
	<td align='center'>$periodo2</td>
	<td align='center'>$anno</td>
	<td align='center'>REPORTE_CUENTAS_POR_PAGAR</td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	</tr>
	");
	while($rw = mysql_fetch_assoc($re3)) 
	{ 
		printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		</tr>
		",'D',$rw["cod_fut"],'TIPO ACTO', 'NUMERO ACTO','FECHA ACTO', $rw["fuente_rec"],round($rw["sum(ppto_aprob)"]/1000,0),round($rw["sum(pagado)"]/1000,0)); 
	$total_apr = $total_apr +round($rw["sum(ppto_aprob)"]/1000,0);
	$total_pag = $total_pag +round($rw["sum(pagado)"]/1000,0);
	} 
		printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		</tr>
		",'D','VAL','6', '214','FECHA ACTO', 700,$total_apr,$total_pag); 
 
	printf("</table>");
?>
