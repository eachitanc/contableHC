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
// Crear tabla para consolidar informe
$anadir40.="truncate TABLE fut_aux_tes_ok";

mysql_select_db ($database, $cx);

		if(mysql_query ($anadir40 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};	
//********************crea tabla fut_aux_ing
$tabla7="fut_aux_tes_ok";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `ctrl` varchar(200) NOT NULL default '',
  `cod_fut` varchar(200) NOT NULL default '',
  `cta_maestra` varchar(200) NOT NULL default '',
  `valor` decimal(20,2) NOT NULL default '0.00',
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
// Realizo consultas para generar el informe para el Chip
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
		<td align='center' bgcolor='#CCCCCC'>Fecha</td>
		<td align='center' bgcolor='#CCCCCC'>Documento</td>
		<td align='center' bgcolor='#CCCCCC'>Cuenta</td>
		<td align='center' bgcolor='#CCCCCC'>Tercero</td>
		<td align='center' bgcolor='#CCCCCC'>Detalle</td>
		<td align='center' bgcolor='#CCCCCC'>Tipo</td>
		<td bgcolor='#DCE9E5' align='center'>C</td>
		<td bgcolor='#DCE9E5' align='center'>Concepto</td>
		<td bgcolor='#DCE9E5' align='center'>Regimen subsidiado</td>
		<td bgcolor='#DCE9E5' align='center'>Salud Publica</td>
		<td bgcolor='#DCE9E5' align='center'>Prestacion de servicios</td>
		<td bgcolor='#DCE9E5' align='center'>Otros Inversion</td>
		<td bgcolor='#DCE9E5' align='center'>Otros funcionamiento</td>
		<td bgcolor='#DCE9E5' align='center'>Total</td>
		</tr>
		");
	$sq = mysql_db_query ($database,"select * from pgcp where cta_maestra !=''",$cx);
	while ($rw = mysql_fetch_array($sq))
	{
	// consultar el saldo en libros segun la fecha de corte
     				$sq2 = "select * from sico where cuenta = '$rw[cod_pptal]'";
					$re2 = mysql_db_query($database, $sq2, $cx);
					$re22 = mysql_num_rows($re2);
					if ($re22 >0)
					{
					while($rw2 = mysql_fetch_array($re2)) 
						{
						  $sico=$rw2["debito"]; 
						}
					}else{
						$sico =0; 
					}
					// Calcular el movimiento de ingresos y gastos de la cueta
					$sq3 = "select SUM(debito) as tot_debito, SUM(credito) as tot_creditos from lib_aux where cuenta = '$rw[cod_pptal]' and fecha < '$fecha_ini'";
					$re3= mysql_db_query($database, $sq3, $cx);
					while($rw3 = mysql_fetch_array($re3)) 
					{
					  $debitos=$rw3["tot_debito"];
					  $creditos=$rw3["tot_creditos"]; 
					}
					$saldo_ini = $sico + $debitos - $creditos;
					// guardo los datos de saldo inicial
					$sq2 = "INSERT INTO fut_aux_tes_ok (ctrl,cod_fut,cta_maestra,valor) VALUES 
					('SI','ITFS','$rw[cta_maestra]', '$saldo_ini')";
					mysql_db_query($database, $sq2, $cx) or die(mysql_error());

		
		}
		// Cargo saldo inicial en el reporte
		$sq4 = mysql_db_query ($database,"select sum(valor) as total from fut_aux_tes_ok where ctrl ='SI' and cta_maestra ='CMS0'",$cx);
		$rw4 = mysql_fetch_array($sq4);
		$saldo_ini_rs = $rw4['total'];
		
		$sq4 = mysql_db_query ($database,"select sum(valor) as total from fut_aux_tes_ok where ctrl ='SI' and cta_maestra ='CMS1'",$cx);
		$rw4 = mysql_fetch_array($sq4);
		$saldo_ini_sp = $rw4['total'];
		
		$sq4 = mysql_db_query ($database,"select sum(valor) as total from fut_aux_tes_ok where ctrl ='SI' and cta_maestra ='CMS2'",$cx);
		$rw4 = mysql_fetch_array($sq4);
		$saldo_ini_ps = $rw4['total'];
		
		$sq4 = mysql_db_query ($database,"select sum(valor) as total from fut_aux_tes_ok where ctrl ='SI' and cta_maestra ='CMS3'",$cx);
		$rw4 = mysql_fetch_array($sq4);
		$saldo_ini_iv = $rw4['total'];
		
		$sq4 = mysql_db_query ($database,"select sum(valor) as total from fut_aux_tes_ok where ctrl ='SI' and cta_maestra ='CMS4'",$cx);
		$rw4 = mysql_fetch_array($sq4);
		$saldo_ini_fn = $rw4['total'];

		$total_ini = $saldo_ini_rs + $saldo_ini_sp + $saldo_ini_ps + $saldo_ini_iv + $saldo_ini_fn;
		printf("
				<tr>
				<td align='center' bgcolor='#CCCCCC'>$fecha_ini</td>
				<td align='center' bgcolor='#CCCCCC'></td>
				<td align='center' bgcolor='#CCCCCC'></td>
				<td align='left'  bgcolor='#CCCCCC'>%s</td>
				<td align='left'  bgcolor='#CCCCCC'>%s</td>
				<td align='left'  bgcolor='#CCCCCC'>%s</td>
				<td align='center'>%s</td>
				<td align='center' $fondo>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				</tr>
				",'','Saldo inicial','','D','ITFS', round($saldo_ini_rs/1000,0) , round($saldo_ini_sp/1000,0) , round($saldo_ini_ps/1000,0) , round($saldo_ini_iv/1000,0) , round($saldo_ini_fn/1000,0), round($total_ini/1000,0));	
				
// generar auxiliar de ingresos en el informe
	$sq = mysql_db_query ($database,"select * from pgcp where cta_maestra !=''",$cx);
	while ($rw = mysql_fetch_array($sq))
	{
		// Consulto movimiento de ingresos del periodo reportado
				
				$sq11 = mysql_db_query ($database,"select debito,fecha,dcto,tercero,detalle from lib_aux where cuenta ='$rw[cod_pptal]' and (dcto LIKE  'ROIT%' OR dcto LIKE  'NCBT%' OR dcto LIKE  'TNAT%' OR dcto LIKE  'RCGT%' OR dcto LIKE  'TFIN%' OR dcto LIKE  'NCON%' OR dcto LIKE  'NCSP%' OR dcto LIKE  'COBA%') and (fecha between '$fecha_ini' and '$corte') order by fecha desc",$cx);
				while ($rw11 = mysql_fetch_array($sq11))
				{
					if ($rw['cta_maestra'] =='CMS0') $val_rs = $rw11['debito']; else $val_rs =0;
					if ($rw['cta_maestra'] =='CMS1') $val_sp = $rw11['debito']; else $val_sp =0;
					if ($rw['cta_maestra'] =='CMS2') $val_ps = $rw11['debito']; else $val_ps =0;
					if ($rw['cta_maestra'] =='CMS3') $val_in = $rw11['debito']; else $val_in =0;
					if ($rw['cta_maestra'] =='CMS4') $val_of = $rw11['debito']; else $val_of =0;
					
					$val_total = $val_rs + $val_sp + $val_ps + $val_in + $val_of;
					if($val_total >0)
					{
					// consultar codigo homologacion
					$documento = $rw11['dcto'];
					$doc =substr($documento,0,4);
					$doca ='cuenta';
					if($doc=='ROIT') {$tabla ='recaudo_roit';$campo ='id_manu_roit';}
					if($doc=='TNAT') {$tabla ='recaudo_tnat';$campo ='id_manu_tnat';};
					if($doc=='NCBT') {$tabla ='recaudo_ncbt';$campo ='id_manu_ncbt';};
					if($doc=='RCGT') {$tabla ='recaudo_rcgt';$campo ='id_manu_rcgt';};
					if($doc=='NCON') {$tabla ='lib_aux2';$campo ='dcto'; $doca='*';};
					if($doc=='TFIN') {$tabla ='conta_tfin';$campo ='id_manu_ncon';$doca='*';};
					// Clasificar documento ROIT, TNAT, RCGT, NCBT con el nombre de la tabla
					$sq8="select $doca from $tabla where $campo ='$rw11[dcto]'";
					//echo $sq8;
					$rs8 = mysql_db_query($database,$sq8,$cx);
					$rw8 = mysql_fetch_array($rs8);
					// Consulto codigo de homologacion del rubro
					$sq9 ="select fondo_local_tes from car_ppto_ing where cod_pptal ='$rw8[cuenta]'";
					$rs9 = mysql_db_query($database,$sq9,$cx);
					$rw9 = mysql_fetch_array($rs9);
					$concepto = $rw9['fondo_local_tes'];
					// Consulta
					printf("
					<tr>
					<td align='center' bgcolor='#CCCCCC'>%s</td>
					<td align='center' bgcolor='#CCCCCC'>%s</td>
					<td align='center' bgcolor='#CCCCCC'>%s</td>
					<td align='left'  bgcolor='#CCCCCC'>%s</td>
					<td align='left'  bgcolor='#CCCCCC'>%s</td>
					<td align='left'  bgcolor='#CCCCCC'>%s</td>
					<td align='center'>%s</td>
					<td align='center' $fondo>%s</td>
					<td align='right'>%s</td>
					<td align='right'>%s</td>
					<td align='right'>%s</td>
					<td align='right'>%s</td>
					<td align='right'>%s</td>
					<td align='right'>%s</td>
					</tr>
					",$rw11['fecha'],$rw11['dcto'],$rw['cod_pptal'],$rw11['tercero'],$rw11['detalle'],'IN','D',$concepto,round($val_rs/1000,0),round($val_sp/1000,0),round($val_ps/1000,0),round($val_in/1000,0),round($val_of/1000,0),round($val_total/1000,0));
					}
					}
		$concepto='';
		}
// consulto el valor acumulado de los gastos vigencia ceva ACTUAL.
				$sq11 = "SELECT pgcp.cta_maestra, SUM(lib_aux.credito)
						FROM
							pgcp
							INNER JOIN lib_aux 
								ON (pgcp.cod_pptal = lib_aux.cuenta)
						WHERE (pgcp.cta_maestra !='') 
							   AND (lib_aux.fecha BETWEEN '$fecha_ini' AND '$corte')
						GROUP BY pgcp.cta_maestra";
				$rs11 = mysql_db_query($database,$sq11,$cx);
				while ($rw = mysql_fetch_array($rs11))
				{
				
 				if ($rw['cta_maestra'] =='CMS0') {$val_rs = $rw['SUM(lib_aux.credito)'];$concepto ='PTFS.I';} else { $val_rs =0; }
				if ($rw['cta_maestra'] =='CMS1') {$val_sp = $rw['SUM(lib_aux.credito)'];$concepto ='PTFS.I';} else { $val_sp =0; }
				if ($rw['cta_maestra'] =='CMS2') {$val_ps = $rw['SUM(lib_aux.credito)'];$concepto ='PTFS.I';} else { $val_ps =0; }
				if ($rw['cta_maestra'] =='CMS3') {$val_in = $rw['SUM(lib_aux.credito)'];$concepto ='PTFS.I';} else { $val_in =0; }
				if ($rw['cta_maestra'] =='CMS4') {$val_of = $rw['SUM(lib_aux.credito)'];$concepto ='PTFS.F';} else { $val_of =0; }
				$val_total = $val_rs + $val_sp + $val_ps + $val_in + $val_of;
				printf("
				<tr>
				<td align='center' bgcolor='#CCCCCC'>%s</td>
				<td align='center' bgcolor='#CCCCCC'>%s</td>
				<td align='center' bgcolor='#CCCCCC'>%s</td>
     			<td align='left'  bgcolor='#CCCCCC'>%s</td>
				<td align='left'  bgcolor='#CCCCCC'>%s</td>
				<td align='left'  bgcolor='#CCCCCC'>%s</td>
				<td align='center'>%s</td>
				<td align='center' $fondo>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				</tr>
				",'','','','','','EG','D',$concepto,round($val_rs/1000,0),round($val_sp/1000,0),round($val_ps/1000,0),round($val_in/1000,0),round($val_of/1000,0),round($val_total/1000,0));
		}
// ***************************************************************************************************************	
// consulto el valor acumulado de los gastos reserva ceva VIGENVIA_ANTERIOR.

// consulto el valor acumulado de los gastos cuentas por pagar CECP.		
		
		
// Saldo final en libros
			$sq6 ="SELECT
						pgcp.cta_maestra
						, (SUM(sico.debito) - SUM(sico.credito)) as final
					FROM
						pgcp
						INNER JOIN sico 
							ON (pgcp.cod_pptal = sico.cuenta)
					WHERE (pgcp.cta_maestra !='')
					GROUP BY pgcp.cta_maestra;
				  ";
			$rs6 = mysql_db_query($database,$sq6,$cx);
			while ($rw6 = mysql_fetch_array($rs6))
			{
				if ($rw6['cta_maestra'] =='CMS0') $fin_val_rs = $rw6['final'];  
				if ($rw6['cta_maestra'] =='CMS1') $fin_val_sp = $rw6['final'];
				if ($rw6['cta_maestra'] =='CMS2') $fin_val_ps = $rw6['final']; 
				if ($rw6['cta_maestra'] =='CMS3') $fin_val_in = $rw6['final'];
				if ($rw6['cta_maestra'] =='CMS4') $fin_val_of = $rw6['final'];
			}

			// consulto movimeinto de la cuenta hasta la fecha de corte
			  $sq7 ="SELECT
						pgcp.cta_maestra
						, (SUM(lib_aux.debito) - SUM(lib_aux.credito)) as mov
					FROM
						pgcp
						INNER JOIN lib_aux 
							ON (pgcp.cod_pptal = lib_aux.cuenta)
					WHERE (pgcp.cta_maestra !=''
						AND lib_aux.fecha <='$corte')
					GROUP BY pgcp.cta_maestra
				  ";
			$rs7 = mysql_db_query($database,$sq7,$cx);
			while ($rw7 = mysql_fetch_array($rs7))
			{
				if ($rw7['cta_maestra'] =='CMS0') $mov_val_rs = $rw7['mov']; 
				if ($rw7['cta_maestra'] =='CMS1') $mov_val_sp = $rw7['mov']; 
				if ($rw7['cta_maestra'] =='CMS2') $mov_val_ps = $rw7['mov'];
				if ($rw7['cta_maestra'] =='CMS3') $mov_val_in = $rw7['mov']; 
				if ($rw7['cta_maestra'] =='CMS4') $mov_val_of = $rw7['mov']; 
			}
			//Saldo final
			$saldo_fin = $fin_val_rs + $mov_val_rs+$fin_val_sp + $mov_val_sp+$fin_val_ps + $mov_val_ps+$fin_val_in + $mov_val_in+$fin_val_of + $mov_val_of;
			printf("
				<tr>
				<td align='center' bgcolor='#CCCCCC'>%s</td>
				<td align='center' bgcolor='#CCCCCC'>%s</td>
				<td align='center' bgcolor='#CCCCCC'>%s</td>
     			<td align='left'  bgcolor='#CCCCCC'>%s</td>
				<td align='left'  bgcolor='#CCCCCC'>%s</td>
				<td align='left'  bgcolor='#CCCCCC'>%s</td>
				<td align='center'>%s</td>
				<td align='center' $fondo>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				</tr>
				",'','','','','Saldo Final','','D','FTFS',round(($fin_val_rs + $mov_val_rs)/1000,0),round(($fin_val_sp + $mov_val_sp)/1000,0),round(($fin_val_ps + $mov_val_ps)/1000,0),round(($fin_val_in + $mov_val_in)/1000,0),round(($fin_val_of + $mov_val_of)/1000,0),round($saldo_fin/1000,0));

printf("</table></center>");
 }
?>
</body>
</html>
		