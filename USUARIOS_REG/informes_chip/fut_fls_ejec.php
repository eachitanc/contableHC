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
$corte =$_GET['corte'];
$tipo =$_GET['tipo'];
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Borro y creo la tabla auxiliar para genrar el informe
$anadir40.="DROP TABLE fut_aux_gasf_ok";

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
  `total` decimal(20,2) NOT NULL default '0.00',
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
// Lleno la tabla con los datos requeridos para el informe
if ($tipo == 'EJECUCION_PRESUPUESTAL')
{				
$sq = "select * from car_ppto_ing where fondo_local !='' order by cod_pptal";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto adiciones
			$sq10 = "SELECT sum(valor_adi) as adicion from adi_ppto_ing where cod_pptal ='$rw[cod_pptal]' and fecha_adi <='$corte' group by cod_pptal";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			// consulto recucciones realizadas al rubro
			$sq11 = "SELECT sum(valor_adi) as reduccion from red_ppto_ing where cod_pptal ='$rw[cod_pptal]' and fecha_adi <='$corte' group by cod_pptal";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			// Consulto valor de los recaudos.
			$sq12 = "SELECT sum(vr_digitado) as recaudo from recaudo_rcgt  where cuenta ='$rw[cod_pptal]' and fecha_recaudo <='$corte'";
			$re12 = mysql_db_query($database, $sq12, $cx);	
			$rw12 = mysql_fetch_array($re12);
			$sq13 = "SELECT sum(vr_digitado) as recaudo from recaudo_roit  where cuenta ='$rw[cod_pptal]' and fecha_recaudo <='$corte'";
			$re13 = mysql_db_query($database, $sq13, $cx);	
			$rw13 = mysql_fetch_array($re13);
			$sq14 = "SELECT sum(vr_digitado) as recaudo from recaudo_tnat  where cuenta ='$rw[cod_pptal]' and fecha_recaudo <='$corte'";
			$re14 = mysql_db_query($database, $sq14, $cx);	
			$rw14 = mysql_fetch_array($re14);
			$sq15 = "SELECT sum(vr_digitado) as recaudo from recaudo_ncbt  where cuenta ='$rw[cod_pptal]' and fecha_recaudo <='$corte'";
			$re15 = mysql_db_query($database, $sq15, $cx);	
			$rw15 = mysql_fetch_array($re15);
			$definitivo = $rw["ppto_aprob"] + $rw10["adicion"] - $rw11["reduccion"];
			$recaudado = $rw12["recaudo"] + $rw13["recaudo"] + $rw14["recaudo"] + $rw15["recaudo"];
				// Guardo la iformacion en la tabla
				$sql2 = "INSERT INTO fut_aux_gasf_ok (ctrl,cod_fut,fuente_rec,ppto_aprob,definitivo,compromisos) VALUES 
				('I','$rw[fondo_local]','$rw[libre_con_fut]','$rw[ppto_aprob]','$definitivo','$recaudado')";
				mysql_db_query($database, $sql2, $cx) or die(mysql_error());
}
$sq = "select * from car_ppto_gas where fondo_local !='' order by cod_pptal";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto adiciones
			$sq10 = "SELECT sum(valor_adi) as adicion from adi_ppto_gas where cod_pptal ='$rw[cod_pptal]' and fecha_adi <='$corte' group by cod_pptal";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			// consulto recucciones realizadas al rubro
			$sq11 = "SELECT sum(valor_adi) as reduccion from red_ppto_gas where cod_pptal ='$rw[cod_pptal]' and fecha_adi <='$corte' group by cod_pptal";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			// consulto creditos realizadas al rubro
			$sq15 = "SELECT sum(valor_adi) as creditos from creditos where cod_pptal ='$rw[cod_pptal]' and fecha_adi <='$corte' group by cod_pptal";
			$re15 = mysql_db_query($database, $sq15, $cx);	
			$rw15 = mysql_fetch_array($re15);
			// consulto contracreitos realizadas al rubro
			$sq16 = "SELECT sum(valor_adi) as contracreditos from contracreditos where cod_pptal ='$rw[cod_pptal]' and fecha_adi <='$corte' group by cod_pptal";
			$re16 = mysql_db_query($database, $sq16, $cx);	
			$rw16 = mysql_fetch_array($re16);
			// consulto creditos realizadas al rubro
			$sq17 = "SELECT sum(vr_digitado) as comprometido from crpp where cuenta ='$rw[cod_pptal]' and fecha_crpp <='$corte' group by cuenta";
			$re17 = mysql_db_query($database, $sq17, $cx);	
			$rw17 = mysql_fetch_array($re17);


$sq18 = "SELECT sum(vr_digitado) as obligado from cobp where cuenta ='$rw[cod_pptal]' and fecha_cobp <='$corte' group by cuenta";
			$re18 = mysql_db_query($database, $sq18, $cx);	
			$rw18 = mysql_fetch_array($re18);
			
// pagos
			
		$sqlceva = mysql_db_query($database,"SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE ceva.fecha_ceva <='$corte' AND cobp.cuenta = $rw[cod_pptal] AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI'",$cx) or die (mysql_error());
        $row8=mysql_fetch_row($sqlceva);
        $total_ceva1=$row8[0];
		
		$sq3 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where ceva.fecha_ceva <='$corte' AND cobp.cuenta = $rw[cod_pptal] AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI' ";
		$rs3 = mysql_db_query($database,$sq3,$cx);
		$rw3 = mysql_fetch_array ($rs3);
		$total_ceva_acum = $rw3['total2'];
		
		$total_ceva = $total_ceva1 + $total_ceva_acum;



			// Consulto valor comprometido
			$definitivo = $rw["ppto_aprob"] + $rw10["adicion"] - $rw11["reduccion"] + $rw15["creditos"] - $rw16["contracreditos"];
				// Guardo la iformacion en la tabla
				$sql2 = "INSERT INTO fut_aux_gasf_ok (ctrl,cod_fut,fuente_rec,ppto_aprob,definitivo,obligado,compromisos,pagado) VALUES 
				('G','$rw[fondo_local]','$rw[fuentes_recursos]','$rw[ppto_aprob]','$definitivo','$rw18[obligado]','$rw17[comprometido]',$total_ceva)";
				mysql_db_query($database, $sql2, $cx) or die(mysql_error());
}

	printf("
		<table  border='1'>
		<tr>
		<td align='center'>S</td>
		<td align='center'>$cod_cgn</td>
		<td align='center'>$periodo2</td>
		<td align='center'>$anno</td>
		<td align='center'>EJECUCION_PRESUPUESTAL</td>
		</tr>
		");
		// consulto la base para obtener resultados
		$sql = mysql_db_query ($database,"select cod_fut, sum(ppto_aprob),sum(definitivo),sum(compromisos),sum(obligado),sum(pagado),fuente_rec from fut_aux_gasf_ok group by cod_fut,fuente_rec",$cx);
		while ($row = mysql_fetch_array($sql))
		{
			printf("
			<tr>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			</tr>
			",'D',$row["cod_fut"],$row[fuente_rec],round($row["sum(ppto_aprob)"]/1000,0),round($row["sum(definitivo)"]/1000,0),round($row["sum(compromisos)"]/1000,0),round($row["sum(obligado)"]/1000,0),round($row["sum(pagado)"]/1000,0));
		}
	printf("</table></center>");
}
if ($tipo =='REPORTE_DE_TESORERIA')
{
// consulto la base para obtener resultados
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
					$sq3 = "select SUM(debito) as tot_debito, SUM(credito) as tot_creditos from lib_aux where cuenta = '$rw[cod_pptal]' and fecha <= '$corte'";
					$re3= mysql_db_query($database, $sq3, $cx);
					while($rw3 = mysql_fetch_array($re3)) 
					{
					  $debitos=$rw3["tot_debito"];
					  $creditos=$rw3["tot_creditos"]; 
					}
					$saldo_final = $sico + $debitos - $creditos;
					// guardo el saldo inicial de acuerdo a la cuenta seleccionada
					if ($rw["cta_maestra"]=='CMS0')
					{
						$rs_ini = round(($rs_ini + $sico)/1000,3);
											}
					if ($rw["cta_maestra"]=='CMS1')
					{
						
						$sp_ini = round(($sp_ini + $sico)/1000,3);
					
					}
					if ($rw["cta_maestra"]=='CMS2')
					{
						
						$ps_ini = round(($ps_ini+ $sico)/1000,3);
						
					}
					if ($rw["cta_maestra"]=='CMS3')
					{
						
						$oi_ini = round(($oi_ini + $sico)/1000,3);
						
					}
					if ($rw["cta_maestra"]=='CMS4')
					{
						
						$of_ini = round(($of_ini + $sico)/1000,3);
					}
					$sq2 = "INSERT INTO fut_aux_gasf_ok (ctrl,cod_fut,ppto_aprob,definitivo,compromisos,obligado,pagado) VALUES 
					('1','ITFS','$rs_ini', '$sp_ini', '$ps_ini', '$oi_ini', '$of_ini')";
					mysql_db_query($database, $sq2, $cx) or die(mysql_error());
					$rs_ini =0;
					$sp_ini =0;
					$ps_ini =0;
					$oi_ini =0;
					$of_ini =0;
			// consulto ingresos	
					$sq11 = mysql_db_query ($database,"select debito,cod_pptal from lib_aux where cuenta ='$rw[cod_pptal]' and (dcto LIKE  'ROIT%' OR dcto LIKE  'NCBT%' OR dcto LIKE  'TNAT%' OR dcto LIKE  'RCGT%') and fecha <='$corte'",$cx);
						
					while ($row = mysql_fetch_array($sq11))
					{
						$sqr = mysql_db_query($database,"select * from car_ppto_ing where cod_pptal ='$row[cod_pptal]'",$cx);
						$rwr = mysql_fetch_array($sqr);
						if ($rw["cta_maestra"]=='CMS0')
						{
							$rs_rec = round(($row["debito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS1')
						{
							$sp_rec = round(($row["debito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS2')
						{
							$ps_rec = round(($row["debito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS3')
						{
							$oi_rec = round(($row["debito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS4')
						{
							$of_rec = round(($row["debito"])/1000,3);
						}
						$ctrl ='2';
						$detalle ='';
						if ($rwr["fondo_local_tes"] =='') 
						{
							$rwr["fondo_local_tes"]=$row["cod_pptal"];
							$ctrl ='3';
							$detalle = 'RUBRO NO HOMOLOGADO';
						}
						$sq3 = "INSERT INTO fut_aux_gasf_ok (ctrl,cod_fut,ppto_aprob,definitivo,compromisos,obligado,pagado,tip_acto_adtvo) VALUES 
						('$ctrl','$rwr[fondo_local_tes]', '$rs_rec', '$sp_rec', '$ps_rec', '$oi_rec', '$of_rec','$detalle')";
						mysql_db_query($database, $sq3, $cx) or die(mysql_error());	
						$rs_rec = 0;
						$sp_rec = 0;
						$ps_rec = 0;
						$oi_rec = 0;
						$of_rec = 0;
						$recaudo= 0;
					} // end while ingresos
					$sq12 = mysql_db_query ($database,"select debito,dcto,detalle from lib_aux where cuenta ='$rw[cod_pptal]' and (dcto LIKE  'CESP%' OR dcto LIKE  'NCSP%' OR dcto LIKE  'NDSP%' OR dcto LIKE  'NCON%' OR dcto LIKE  'TFIN%' OR dcto LIKE  'COBA%') and fecha <='$corte'",$cx);
					while ($rw12 = mysql_fetch_array($sq12))
					{
					if ($rw12["debito"] != 0)
					{
						if ($rw["cta_maestra"]=='CMS0')
						{
							$rs_recsp = round(($rw12["debito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS1')
						{
							$sp_recsp = round(($rw12["debito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS2')
						{
							$ps_recsp = round(($rw12["debito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS3')
						{
							$oi_recsp =round(($rw12["debito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS4')
						{
							$of_recsp = round(($rw12["debito"])/1000,3);
						}
						$sq3 = "INSERT INTO fut_aux_gasf_ok (ctrl,cod_fut,ppto_aprob,definitivo,compromisos,obligado,pagado,tip_acto_adtvo) VALUES 
						('3','$rw12[dcto]', '$rs_recsp', '$sp_recsp', '$ps_recsp', '$oi_recsp', '$of_recsp','$rw12[detalle]')";
						mysql_db_query($database, $sq3, $cx) or die(mysql_error());	
						$rs_recsp =0;
						$sp_recsp =0;
						$ps_recsp =0;
						$oi_recsp =0;
						$of_recsp =0;
					}
					}
/// sumar ingresos cuado la cuenta no afecta presupuesto y cargarlos a un concepto
$sq31 ="select * from lib_aux where cuenta ='$rw[cod_pptal]' and (dcto LIKE  'CEVA%') and fecha <='$corte'";
$rs31 = mysql_db_query ($database,$sq31,$cx);

					while ($rw31 = mysql_fetch_array($sq31))
					{
						$sqr31 = mysql_db_query($database,"select * from car_ppto_gas where cod_pptal ='$rw31[cod_pptal]'",$cx);
						$rwr31 = mysql_fetch_array($sqr31);
						if ($rw["cta_maestra"]=='CMS0')
						{
							$rs_rec = round(($rw31["credito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS1')
						{
							$sp_rec = round(($rw31["credito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS2')
						{
							$ps_rec = round(($rw31["credito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS3')
						{
							$oi_rec =round(($rw31["credito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS4')
						{
							$of_rec = round(($rw31["credito"])/1000,3);
						}
						$codfut = substr($rwr31["fondo_local"],0,11);
						if (codfut =='FSG.A.2.4.1') {$tipo_pagos ='PTFS.F';}else{$tipo_pagos='PTFS.I';}
						$sq3 = "INSERT INTO fut_aux_gasf_ok (ctrl,cod_fut,ppto_aprob,definitivo,compromisos,obligado,pagado) VALUES 
						('4','$tipo_pagos', '$rs_rec', '$sp_rec', '$ps_rec', '$oi_rec', '$of_rec')";
						mysql_db_query($database, $sq3, $cx) or die(mysql_error());	
						$rs_rec = 0;
						$sp_rec = 0;
						$ps_rec = 0;
						$oi_rec = 0;
						$of_rec = 0;
				}
$sq32 = mysql_db_query ($database,"select credito,cod_pptal,dcto,detalle from lib_aux where cuenta ='$rw[cod_pptal]' and (dcto LIKE  'CESP%' OR dcto LIKE  'NCSP%' OR dcto LIKE  'NDSP%' OR dcto LIKE  'NCON%' OR dcto LIKE  'TFIN%' OR dcto LIKE  'COBA%' OR dcto LIKE  'CECP%') and fecha <='$corte'",$cx);
					while ($rw32 = mysql_fetch_array($sq32))
					{
					if ($rw32["credito"] !=0)
					{
						if ($rw["cta_maestra"]=='CMS0')
						{
							$rs_rec = round(($rw32["credito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS1')
						{
							$sp_rec = round(($rw32["credito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS2')
						{
							$ps_rec = round(($rw32["credito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS3')
						{
							$oi_rec = round(($rw32["credito"])/1000,3);
						}
						if ($rw["cta_maestra"]=='CMS4')
						{
							$of_rec = round(($rw32["credito"])/1000,3);
						}
						$sq4 = "INSERT INTO fut_aux_gasf_ok (ctrl,cod_fut,ppto_aprob,definitivo,compromisos,obligado,pagado,tip_acto_adtvo) VALUES 
						('5','$rw32[dcto]', '$rs_rec', '$sp_rec', '$ps_rec', '$oi_rec', '$of_rec','$rw32[detalle]')";
						mysql_db_query($database, $sq4, $cx) or die(mysql_error());	
						$rs_rec = 0;
						$sp_rec = 0;
						$ps_rec = 0;
						$oi_rec = 0;
						$of_rec = 0;
					}
				}
	}
	printf("
		<table  border='1'>
		<tr>
		<td align='center' bgcolor='#CCCCCC'>Detalle</td>
		<td align='center' bgcolor='#CCCCCC'>Tipo Movimiento</td>
		<td align='center'>S</td>
		<td align='center'>$cod_cgn</td>
		<td align='center'>$periodo2</td>
		<td align='center'>$anno</td>
		<td align='center'>REPORTE_DE_TESORERIA</td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		</tr>
		");
		printf("
		<tr>
		<td align='center' bgcolor='#CCCCCC'></td>
		<td align='center' bgcolor='#CCCCCC'></td>
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
		$sq8 = mysql_db_query($database,"select ctrl,tip_acto_adtvo,cod_fut,sum(ppto_aprob), sum(definitivo), sum(compromisos), sum(obligado), sum(pagado), sum(total) from fut_aux_gasf_ok   group by cod_fut order by ctrl asc",$cx);
		while ($rw8 = mysql_fetch_array($sq8))
		{
			$total = $rw8["sum(ppto_aprob)"] + $rw8["sum(definitivo)"] + $rw8["sum(compromisos)"] + $rw8["sum(obligado)"] + $rw8["sum(pagado)"]; 
			if ($total !=0)
			{
			if ($rw8["ctrl"] =='5' or $rw8["ctrl"] =='3')
			{
				$fondo ='bgcolor=#FFFF99';
			}else{
				$fondo ='';
			}
			if ($rw8["ctrl"] == '1') $tip_mto = 'Saldo inicial';
			if ($rw8["ctrl"] == '2') $tip_mto = 'Ingresos';
			if ($rw8["ctrl"] == '3') $tip_mto = 'Ingresos';
			if ($rw8["ctrl"] == '4') $tip_mto = 'Gastos';
			if ($rw8["ctrl"] == '5') $tip_mto = 'Gastos';
			printf("
				<tr>
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
				",$rw8["tip_acto_adtvo"],$tip_mto,'D',$rw8["cod_fut"], $rw8["sum(ppto_aprob)"], $rw8["sum(definitivo)"],$rw8["sum(compromisos)"],$rw8["sum(obligado)"],$rw8["sum(pagado)"],$total);	
		 }
}
$sq9 = mysql_db_query($database,"select sum(ppto_aprob), sum(definitivo), sum(compromisos), sum(obligado), sum(pagado), sum(total) from fut_aux_gasf_ok  where ctrl ='1' group by ctrl",$cx);		
$rw9 = mysql_fetch_array($sq9);
$sq10 = mysql_db_query($database,"select sum(ppto_aprob), sum(definitivo), sum(compromisos), sum(obligado), sum(pagado), sum(total) from fut_aux_gasf_ok  where ctrl ='2'  group by ctrl",$cx);		
$rw10 = mysql_fetch_array($sq10);
$sq11= mysql_db_query($database,"select sum(ppto_aprob), sum(definitivo), sum(compromisos), sum(obligado), sum(pagado), sum(total) from fut_aux_gasf_ok  where ctrl ='3'  group by ctrl",$cx);		
$rw11 = mysql_fetch_array($sq11);
$sq12 = mysql_db_query($database,"select sum(ppto_aprob), sum(definitivo), sum(compromisos), sum(obligado), sum(pagado), sum(total) from fut_aux_gasf_ok  where ctrl ='4' OR ctrl='5' group by ctrl",$cx);		
$rw12 = mysql_fetch_array($sq12);
$sq13 = mysql_db_query($database,"select sum(ppto_aprob), sum(definitivo), sum(compromisos), sum(obligado), sum(pagado), sum(total) from fut_aux_gasf_ok  where ctrl ='5' OR ctrl='5' group by ctrl",$cx);		
$rw13 = mysql_fetch_array($sq13);
// Total rs
$tot_rs = $rw9["sum(ppto_aprob)"] + $rw10["sum(ppto_aprob)"] +  $rw11["sum(ppto_aprob)"] - $rw12["sum(ppto_aprob)"] - + $rw13["sum(ppto_aprob)"];
$tot_sp = $rw9["sum(definitivo)"] + $rw10["sum(definitivo)"]  + $rw11["sum(definitivo)"] - $rw12["sum(definitivo)"]  - $rw13["sum(definitivo)"];
$tot_ps = $rw9["sum(compromisos)"] + $rw10["sum(compromisos)"]  + $rw11["sum(compromisos)"] - $rw12["sum(compromisos)"]  - $rw13["sum(compromisos)"];
$tot_oi = $rw9["sum(obligado)"] + $rw10["sum(obligado)"]  + $rw11["sum(obligado)"] - $rw12["sum(obligado)"]  - $rw13["sum(obligado)"];; 
$tot_of = $rw9["sum(pagado)"] + $rw10["sum(pagado)"]  + $rw11["sum(pagado)"] - $rw12["sum(pagado)"]  - $rw13["sum(pagado)"];
$tot_t = $tot_rs + $tot_sp + $tot_ps + $tot_oi + $tot_of;

printf("
				<tr>
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
				",'','Saldo fial','D','FTFS', $tot_rs , $tot_sp , $tot_ps , $tot_oi , $tot_of, $tot_t);	

printf("</table></center>");

}  // End if Tesoreria
}  // End encabezado sesion
?>
</body>
</html>
		