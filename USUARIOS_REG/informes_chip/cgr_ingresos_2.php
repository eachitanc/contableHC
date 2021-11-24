<?
set_time_limit(3600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<title>CONTAFACIL</title>
<style type="text/css">
<!--
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<?
$corte=$_POST['corte'];


include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//************* borro la tabla		
$tabla6="cgr_aux_ing";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir6 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};

//********************crea tabla fut_aux_ing

$tabla7="cgr_aux_ing";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(

  `id` int(11) NOT NULL auto_increment,
  `fecha` varchar(100) NOT NULL default '',
  `cuenta` varchar(100) NOT NULL default '',
  `cod_cgr` varchar(50) NOT NULL default '',
  `rec` varchar(20) NOT NULL default '',
  `oer` varchar(20) NOT NULL default '',
  `cda` varchar(20) NOT NULL default '',
  `recip` varchar(50) NOT NULL default '',
  `sit_fondos` varchar(2) NOT NULL default '',
  `acto` varchar(50) NOT NULL default '',
  `registros` int(13) NOT NULL default '0',
  `inicial` decimal(20,2) NOT NULL default '0.00',
  `adiciones` decimal(20,2) NOT NULL default '0.00',
  `reducciones` decimal(20,2) NOT NULL default '0.00',
  `creditos` decimal(20,2) NOT NULL default '0.00',
  `contracreditos` decimal(20,2) NOT NULL default '0.00',
  `recaudos` decimal(20,2) NOT NULL default '0.00',
   PRIMARY KEY  (`id`)
)TYPE=MyISAM AUTO_INCREMENT=1 COLLATE=latin1_general_ci";
		
		mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}

//*****************
//*****************

include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from car_ppto_ing where tip_dato = 'D' order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);

while($rw = mysql_fetch_array($re)) 
{

$link=mysql_connect($server,$dbuser,$dbpass);
//****
$cod=$rw["cod_pptal"];
$cod_cgr=$rw["cod_cgr"];
if ($cod_cgr !='')
{
//****
$resulta=mysql_query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE (fecha_adi <= '$corte' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total_adi=$row[0]; 
//****
$resulta2=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE (fecha_adi <= '$corte' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row2=mysql_fetch_row($resulta2);
$total_red=$row2[0];
//****
$resulta8=mysql_query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE (fecha_adi <= '$corte' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row8=mysql_fetch_row($resulta8);
$total_cred=$row8[0];
//****
$resulta9=mysql_query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE (fecha_adi <= '$corte' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row9=mysql_fetch_row($resulta9);
$total_ccred=$row9[0];

//****

$resulta4=mysql_query("select SUM(valor) AS TOTAL, count(num) as registros from z_aux_ing WHERE (fecha <= '$corte' ) and  rubro LIKE '$cod%'",$link) or die (mysql_error());
$row4=mysql_fetch_row($resulta4);
$total_ncbt=$row4[0];
$registros=$row4[1];
/*
$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo <= '$corte' ) and  cuenta LIKE '$cod%'",$link) or die (mysql_error());
$row5=mysql_fetch_row($resulta5);
$total_rcgt=$row5[0];

$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo <= '$corte' ) and  cuenta LIKE '$cod%'",$link) or die (mysql_error());
$row6=mysql_fetch_row($resulta6);
$total_tnat=$row6[0];

$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo <= '$corte' ) and  cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
$row7=mysql_fetch_row($resulta7);
$total_roit=$row7[0];
*/

$recaudos = $total_ncbt;

//****

$sql = "
INSERT INTO cgr_aux_ing (fecha,cuenta,cod_cgr,rec,oer,cda,recip,acto,sit_fondos,registros,inicial,adiciones,reducciones,creditos,contracreditos,recaudos) 
VALUES
('$corte','$cod','$rw[cod_cgr]','$rw[cod_rec]','$rw[oer]','$rw[cda]','$rw[ent_recip]','$rw[acto_fut]','$rw[situacion]','$registros','$rw[ppto_aprob]','$total_adi','$total_red','$total_cred','$total_ccred','$recaudos')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}
}

//**********************
//**********************
//************* borro la tabla		
$tabla6="cgr_aux_ing_ok";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

mysql_select_db ($base, $conexion);

if(mysql_query ($anadir6 ,$conexion)) 
{
echo "";
}
else
{
echo "";
};

//********************crea tabla fut_aux_ing

$tabla7="cgr_aux_ing_ok";
$anadir7="CREATE TABLE ";
$anadir7.=$tabla7;
$anadir7.="
(
`id` int(11) NOT NULL auto_increment,
`ctrl` varchar(200) NOT NULL default '',
`cod_cgr` varchar(200) NOT NULL default '',
`recurso` varchar(200) NOT NULL default '',
`oer` varchar(200) NOT NULL default '',
`der_x_cobrar` decimal(20,2) NOT NULL default '0.00',
`num_recaudos` decimal(20,2) NOT NULL default '0.00',
`reciproca` varchar(200) NOT NULL default '',
`sit_fondos` varchar(200) NOT NULL default '',
`acto` varchar(200) NOT NULL default '',
`der_x_cob` decimal(20,2) NOT NULL default '0.00',
`dest_recaudo_adm_central` varchar(200) NOT NULL default '',
`acto_adtvo_destinacion` varchar(200) NOT NULL default '',
`ppto_inicial` decimal(20,2) NOT NULL default '0.00',
`adiciones` decimal(20,2) NOT NULL default '0.00',
`reducciones` decimal(20,2) NOT NULL default '0.00',
`creditos` decimal(20,2) NOT NULL default '0.00',
`contracreditos` decimal(20,2) NOT NULL default '0.00',
`aplazamientos` decimal(20,2) NOT NULL default '0.00',
`desaplazamientos` decimal(20,2) NOT NULL default '0.00',
`reversion_der_x_cobrar` decimal(20,2) NOT NULL default '0.00',
`recaudos` decimal(20,2) NOT NULL default '0.00',
`devoluciones` decimal(20,2) NOT NULL default '0.00',
`reversion_recaudos` decimal(20,2) NOT NULL default '0.00',
`otras_ejecuciones` decimal(20,2) NOT NULL default '0.00',
`reversion_otras_ejecuciones` decimal(20,2) NOT NULL default '0.00',
`reconocimientos` decimal(20,2) NOT NULL default '0.00',
`recaudos_vig_anteriores` decimal(20,2) NOT NULL default '0.00',
`reversion_recaudos_vig_anteriores` decimal(20,2) NOT NULL default '0.00',
PRIMARY KEY  (`id`)
)TYPE=MyISAM AUTO_INCREMENT=1 COLLATE=latin1_general_ci";

mysql_select_db ($base, $conexion);

if(mysql_query ($anadir7 ,$conexion)) 
{
echo "";
}
else
{
echo "";
}
//**********************
//**********************

$ctrl='D';
$der_x_cobrar = 0;
$der_x_cob = 0;
$creditos  = 0;
$contracreditos  = 0;
$aplazamientos  = 0;
$desaplazamientos  = 0;
$der_x_cobrar  = 0;
$reversion_der_x_cobrar  = 0;
$devoluciones  = 0;
$reversion_recaudos  = 0;
$otras_ejecuciones  = 0;
$reversion_otras_ejecuciones  = 0;
$recaudos_vig_anteriores  = 0;
$reversion_recaudos_vig_anteriores  = 0;

/*
$sqlxx2 = "SELECT 

car_ppto_ing.cod_cgr, 
car_ppto_ing.cod_rec, 
car_ppto_ing.oer, 
car_ppto_ing.ent_recip,
car_ppto_ing.cda, 
sum(car_ppto_ing.ppto_aprob) as tx,
sum(cgr_aux_ing.adiciones) as total1 ,
sum(cgr_aux_ing.reducciones) as total2 ,
sum(cgr_aux_ing.recaudos) as total3 ,
sum(cgr_aux_ing.reconocimientos) as total4 ,
sum(cgr_aux_ing.creditos) as total5 ,
sum(cgr_aux_ing.contracreditos) as total6 ,
car_ppto_ing.acto_fut,
car_ppto_ing.num_acto_fut,
car_ppto_ing.tip_dato, 
car_ppto_ing.cod_pptal, 
cgr_aux_ing.cuenta,
car_ppto_ing.situacion

FROM car_ppto_ing LEFT JOIN cgr_aux_ing ON car_ppto_ing.cod_pptal = cgr_aux_ing.cuenta

WHERE car_ppto_ing.tip_dato = 'D'

GROUP BY car_ppto_ing.cod_pptal
";

$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion) or die ($resultadoxx2 .mysql_error()."");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
		
		$cod_pptal = $rowxx2["cod_pptal"]; 
		$cod_cgr = $rowxx2["cod_cgr"];
		
		//***** conteo de registros
		$resulta4=mysql_query("
		SELECT COUNT(DISTINCT(id_manu_ncbt)) 
		FROM recaudo_ncbt JOIN car_ppto_ing ON car_ppto_ing.cod_pptal = recaudo_ncbt.cuenta
		WHERE car_ppto_ing.cod_cgr = '$cod_cgr'
		GROUP BY car_ppto_ing.cod_cgr
		",$link) or die (mysql_error());
		$row4=mysql_fetch_row($resulta4);
		$total_reg_ncbt=$row4[0];
		
		
		$resulta5=mysql_query("
		SELECT COUNT(DISTINCT(id_manu_rcgt)) 
		FROM recaudo_rcgt JOIN car_ppto_ing ON car_ppto_ing.cod_pptal = recaudo_rcgt.cuenta
		WHERE car_ppto_ing.cod_cgr = '$cod_cgr'
		GROUP BY car_ppto_ing.cod_cgr
		",$link) or die (mysql_error());
		$row5=mysql_fetch_row($resulta5);
		$total_reg_rcgt=$row5[0];
		
		
		$resulta5=mysql_query("
		SELECT COUNT(DISTINCT(id_manu_tnat)) 
		FROM recaudo_tnat JOIN car_ppto_ing ON car_ppto_ing.cod_pptal = recaudo_tnat.cuenta
		WHERE car_ppto_ing.cod_cgr = '$cod_cgr'
		GROUP BY car_ppto_ing.cod_cgr
		",$link) or die (mysql_error());
		$row5=mysql_fetch_row($resulta5);
		$total_reg_tnat=$row5[0];
		
		
		$resulta5=mysql_query("
		SELECT COUNT(DISTINCT(id_manu_roit)) 
		FROM recaudo_roit JOIN car_ppto_ing ON car_ppto_ing.cod_pptal = recaudo_roit.cuenta
		WHERE car_ppto_ing.cod_cgr = '$cod_cgr'
		GROUP BY car_ppto_ing.cod_cgr
		",$link) or die (mysql_error());
		$row5=mysql_fetch_row($resulta5);
		$total_reg_roit=$row5[0];
		//**************************
		
		 
		$recurso = $rowxx2["cod_rec"]; 
		$oer = $rowxx2["oer"]; 
		$num_recaudos = $total_reg_ncbt+$total_reg_rcgt+$total_reg_tnat+$total_reg_roit;
		$reciproca = $rowxx2["ent_recip"]; 
		$acto = $rowxx2["acto_fut"]; 
		$ppto_inicial = number_format($rowxx2[tx],0,'',''); 
		$adiciones = number_format($rowxx2[total1],0,'','');  
		$reducciones = number_format($rowxx2[total2],0,'',''); 
		$creditos = number_format($rowxx2[total5],0,'',''); 
		$contracreditos = number_format($rowxx2[total6],0,'','');  
		$recaudos = number_format($rowxx2[total3],0,'','');  
		$reconocimientos = number_format($rowxx2[total4],0,'','');  
		$dest_recaudo_adm_central = $rowxx2["cda"]; 
		$acto_adtvo_destinacion = $rowxx2["acto_fut"]; 
		$sit_fondos = $rowxx2["situacion"]; 
		
		
		//****** inseto en cgr_aux_ing_ok
		
		$sql = "INSERT INTO cgr_aux_ing_ok 
		(ctrl,cod_cgr,recurso,oer,der_x_cobrar,num_recaudos,reciproca,sit_fondos,acto,der_x_cob,dest_recaudo_adm_central,acto_adtvo_destinacion,ppto_inicial,adiciones,reducciones,creditos,contracreditos,aplazamientos,desaplazamientos,reversion_der_x_cobrar,recaudos,devoluciones,reversion_recaudos,otras_ejecuciones,reversion_otras_ejecuciones,reconocimientos,recaudos_vig_anteriores,reversion_recaudos_vig_anteriores)
		VALUES 
		('$ctrl','$cod_cgr','$recurso','$oer','$der_x_cobrar','$num_recaudos','$reciproca','$sit_fondos','$acto','$der_x_cob','$dest_recaudo_adm_central','$acto_adtvo_destinacion','$ppto_inicial','$adiciones','$reducciones','$creditos','$contracreditos','$aplazamientos','$desaplazamientos','$reversion_der_x_cobrar','$recaudos','$devoluciones','$reversion_recaudos','$otras_ejecuciones','$reversion_otras_ejecuciones','$reconocimientos','$recaudos_vig_anteriores','$reversion_recaudos_vig_anteriores')";
		
		mysql_db_query($database, $sql, $conexion) or die(mysql_error());
		
}

?>


<?
*/
}

?>
<br />
<br />

<form id="form1" name="form1" method="post">
  <div align="center" class="Estilo4"><strong>QUE INFORME DESEA GENERAR ?</strong><br />
    <br />

    <select name="tipo" class="Estilo4" id="tipo">
        <option value="PROG">PROG DE INGRESOS</option>
        <option value="EJEC">EJEC DE INGRESOS</option>
    </select>
	<br />
	<br />
	<input name="Submit" type="submit" class="Estilo4" value="Generar Informe" onclick="this.form.action = 'cgr_ingresos_3.php'">
  </div>
</form>
<?
printf("
<br><br>
<div align='center'>
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='cgr_ingresos.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>

");	
?>