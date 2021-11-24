<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=REPORTE_RESERVAS_PRESUPUESTALES.xls");
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
$sq = "select * from car_ppto_gas where cod_ser_deuda  !='' and tip_dato ='D' order by cod_pptal";
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
			// Consulto valor comprometido
			$sq17 = "SELECT sum(vr_digitado) as comprometido from crpp where cuenta ='$rw[cod_pptal]' and fecha_crpp <='$corte' group by cuenta";
			$re17 = mysql_db_query($database, $sq17, $cx);	
			$rw17 = mysql_fetch_array($re17);
			// Consulto valor obligado
			$sq18 = "SELECT sum(vr_digitado) as obligado from cobp where cuenta ='$rw[cod_pptal]' and fecha_cobp <='$corte' group by cuenta";
			$re18 = mysql_db_query($database, $sq18, $cx);	
			$rw18 = mysql_fetch_array($re18);
			// consulto valor pagado
			$pagado=0;
			$sq19 = "SELECT * from cobp where cuenta ='$rw[cod_pptal]'";
			$re19 = mysql_db_query($database, $sq19, $cx);	
			while ($rw19 = mysql_fetch_array($re19))
			{
				$sq20 = "SELECT * from ceva where id_auto_cobp ='$rw19[id_auto_cobp]' and fecha_ceva <='$corte'";
				$re20 = mysql_db_query($database, $sq20, $cx);	
				$filas = mysql_num_rows($re20);
				if ($filas >0)
				{	
					while ($rw20 = mysql_fetch_array($re20))
					{
						$pagado =$rw19["vr_digitado"] + $pagado;
					}
				}
			}
			
			$definitivo = $rw["ppto_aprob"] + $rw10["adicion"] - $rw11["reduccion"] + $rw15["creditos"] - $rw16["contracreditos"];
				// Guardo la iformacion en la tabla
				$sql2 = "INSERT INTO fut_aux_gasf_ok (ctrl,cod_fut,fuente_rec,ppto_aprob,definitivo,compromisos,obligado,pagado) VALUES 
				('D','$rw[cod_ser_deuda]','$rw[fuentes_recursos]','$rw[ppto_aprob]','$definitivo','$rw10[adicion]','$rw18[obligado]','$pagado')";
				mysql_db_query($database, $sql2, $cx) or die(mysql_error());
}

	printf("
		<table  border='1'>
		<tr>
		<td align='center'>S</td>
		<td align='center'>$cod_cgn</td>
		<td align='center'>$periodo2</td>
		<td align='center'>$anno</td>
		<td align='center'>REPORTE_RESERVAS_PRESUPUESTALES</td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		</tr>
		");
		printf("
		<tr>
		<td bgcolor='#DCE9E5' align='center'>C</td>
		<td bgcolor='#DCE9E5' align='center'>Concepto</td>
		<td bgcolor='#DCE9E5' align='center'>Fuente Recurso</td>
		<td bgcolor='#DCE9E5' align='center'>Tipo Acto</td>
		<td bgcolor='#DCE9E5' align='center'>N�mero Acto</td>
		<td bgcolor='#DCE9E5' align='center'>Fecha Acto</td>
		<td bgcolor='#DCE9E5' align='center'>Reserva Definitiva</td>
		<td bgcolor='#DCE9E5' align='center'>Obligado</td>
		<td bgcolor='#DCE9E5' align='center'>Pagado</td>
		</tr>
		");
		// consulto la base para obtener resultados
		$sql = mysql_db_query ($database,"select cod_fut,fuente_rec,tip_acto_adtvo, num_acto_adtvo,fecha_acto_adtvo,sum(definitivo),sum(obligado),sum(pagado) from fut_aux_gasf_ok group by cod_fut,fuente_rec",$cx);
		while ($rw = mysql_fetch_array($sql))
		{
		printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		</tr>
		",'D',$rw["cod_fut"],$rw["fuente_rec"],$rw["tip_acto_adtvo"], $rw["num_acto_adtvo"],$rw["fecha_acto_adtvo"],round($rw["sum(definitivo)"]/1000,0), round($rw["sum(obligado)"]/1000,0),round($rw["sum(pagado)"]/1000,0));
		$total_def = $total_def + round($rw["sum(definitivo)"]/1000,0);
		$total_obl = $total_obl + round($rw["sum(obligado)"]/1000,0);
		$total_pag = $total_pag + round($rw["sum(pagado)"]/1000,0);
		}
		// val
		printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		</tr>
		",'D','VAL',700,'6', '','',$total_def , $total_obl,$total_pag);
		// adicionados
		// val
		printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		</tr>
		",'D','FRINC',700,'6', '','',0 ,0,0);
	
		
	printf("</table></center>");
}
?>
</body>
</html>
		