<?php
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>

<script>
function cerrarVentana(){
window.close()
}
</script> 
<style type="text/css">
<!--
.Estilo2 {font-size: 9px}
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
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
<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>
<style type="text/css">
<!--
.Estilo8 {font-weight: bold}
.Estilo9 {font-weight: bold}
.Estilo10 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo11 {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="798" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='conciliaciones.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
</table>
<div align="center" class="Estilo4">
 <div style='padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;'>
   <b>DATOS SELECCIONADOS POR EL USUARIO</b><br /><br />
<?php
include('../config.php');

$fecha_fin=$_POST['fecha_fin'];
$cuenta=$_POST['cuenta'];
//$nom_rubro=$_POST['nom_rubro'];

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where fecha_fin ='$fecha_fin' and cuenta='$cuenta' ";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) {$saldo_extracto=$rw["saldo_extracto"];$nom_rubro=$rw['nom_rubro'];}//printf(" nom_rubro : $nom_rubro<br>");


//menos un mes

$a = date("Y", strtotime($fecha_fin)); 
$b = date("m", strtotime($fecha_fin)); 
$c = date("d", strtotime($fecha_fin)); 



// dias calendario
function esBisiesto($year=NULL) {
    return checkdate(2, 29, ($year==NULL)? date('Y'):$year); // devolvemos true si es bisiesto
}

$bis = esBisiesto($a);
// dias calendario
if ($bis ==1)
{
$ene=31;$feb=29;$mar=31;$abr=30;$may=31;$jun=30;$jul=31;$ago=31;$sep=30;$oct=31;$nov=30;$dic=31;
}else{
$ene=31;$feb=28;$mar=31;$abr=30;$may=31;$jun=30;$jul=31;$ago=31;$sep=30;$oct=31;$nov=30;$dic=31;
}

// no mes

$nene="01";
$nfeb="02";
$nmar="03";
$nabr="04";
$nmay="05";
$njun="06";
$njul="07";
$nago="08";
$nsep="09";
$noct="10";
$nnov="11";
$ndic="12";


//printf("nago: %s  b: %s ",$nago,$b);


if($b == $nene or $b == $nmar or $b == $nmay or $b == $njul or $b == $nago or $b == $noct or $b == $ndic)
{
$ts1 = strtotime($fecha_fin);
$ts = strtotime('-30 days',$ts1);
$fecha_mes_ant=date('Y/m/d', $ts);
}

if($b == $nabr or $b == $njun or $b == $nsep or $b == $nnov)
{
$ts1 = strtotime($fecha_fin);
$ts = strtotime('-29 days',$ts1);
$fecha_mes_ant=date('Y/m/d', $ts);
}

if($bis == 1)
{	
	if($b == $nfeb)
	{
	$ts1 = strtotime($fecha_fin);
	$ts = strtotime('-28 days',$ts1);
	$fecha_mes_ant=date('Y/m/d', $ts);
	}
}else{
	if($b == $nfeb)
	{
	$ts1 = strtotime($fecha_fin);
	$ts = strtotime('-27 days',$ts1);
	$fecha_mes_ant=date('Y/m/d', $ts);
	}
}
// imprime tabla del encabezado
printf("
<center class='Estilo4'>
<table width='600' border='1' align='center' class='bordepunteado1'>
<tr>
<td align='right' width='200'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Cuenta : </b>
</div>
</td>
<td align='center' width='400'>
%s
</td>
</tr>
<tr>
<td align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Nombre : </b>
</div>
</td>
<td align='center'>
%s
</td>
</tr>
<tr>
<td  align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Fecha Inicial : </b>
</div>
</td>
<td align='center'>
%s
</td>
</tr>
<tr>
<td align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Fecha Final : </b>
</div>
</td>
<td align='center'>
%s
</td>
</tr>
<tr>
<td  align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Saldo en Extracto : </b>
</div>
</td>
<td align='center'>
%s
</td>
</tr>
</table>
",$cuenta,$nom_rubro,$fecha_mes_ant,$fecha_fin,number_format($saldo_extracto,2,',','.'));   
?>
<br />
<!--LISTA DE DCTOS SIN CONCILIAR VIGENCIAS ANTERIORES--> 
<br />
<?php
//*** encabezado del informe

printf("
<center>

<table width='1000' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#006666'>
<td align='center' colspan='8'><span class='Estilo4' style=\"color:#FFFFFF\">
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>LISTA DE DOCUMENTOS SIN CONCILIAR VIGENCIAS ANTERIORES</b>
</div>
</span></td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'><span class='Estilo4'><b>Borrar de la Conciliacion</b></span></td>
<td align='center' width='100'><span class='Estilo4'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Fecha</b>
</div>
</span></td>
<td align='center' width='100'><span class='Estilo4'><b>Comprobante</b></span></td>

<td align='center' width='300'><span class='Estilo4'><b>Tercero</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Doc/Cheque</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Debito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Credito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Estado</b></span></td>
</tr>

");
//****** consulta en tabla auxiliar SIN CONCILIAR vigencias ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' order by fecha asc";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{
				
				$ctrl1x=$rw["fecha"];
				$ctrl2x=$rw["estado"];
				$fm=$rw["fecha_marca"];
				
				if($ctrl1x =='FECHA')
				{
				}
				else
				{
				
					if($ctrl2x == 'SI' and $fecha_fin < $fm)
					{

							printf("<tr><span class='Estilo4'>");
							printf("<td style='text-align:center;' class='Estilo4'>--</td>");
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["comprobante"]);
							printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto_cheque"]);
							printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
							printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));
							printf("<td class='Estilo4' bgcolor='#990000'><font style=\"color:#FFFFFF\">Conciliada el<br>%s</font></td>",$fm);
							printf("</tr></span>");
						
					}
					else
					{
						
						if($ctrl2x == 'NO' and $fm != $fecha_fin)
						{
						printf("<tr><span class='Estilo4'>");
						//***
						printf("<td style='text-align:center;' class='Estilo4'>
						<a href=\"elim_vig_ant.php?
						fecha_fin=%s
						&cuenta=%s
						&estado=%s
						&comprobante=%s
						&debito=%s
						&credito=%s
						\" target=\"_parent\">Eliminar</a>
						</td>",$fecha_fin,$cuenta,$rw["estado"],$rw["comprobante"],$rw["debito"],$rw["credito"]);
						//***
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["comprobante"]);
						printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto_cheque"]);
						printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
						printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));
						
						
						printf("<td style='text-align:center;' class='Estilo4'>
						<a href=\"../carga_conciliaciones/cambia_estado_no_vig_ant.php?
						fecha_fin=%s
						&cuenta=%s
						&estado=%s
						&comprobante=%s
						&debito=%s
						&credito=%s
						\" target=\"_parent\">%s</a>
						</td>",$fecha_fin,$cuenta,$rw["estado"],$rw["comprobante"],$rw["debito"],$rw["credito"],$rw["estado"]);
						
						printf("</tr></span>");
						
						}
					}
				}
}
printf("</table></center><br>");
?>
<br />
<!--LISTA DE DCTOS SIN CONCILIAR MESES ANTERIORES-->
<br />
<?php
//*** encabezado del informe

printf("
<center>

<table width='1000' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#006666'>
<td align='center' colspan='8'><span class='Estilo4' style=\"color:#FFFFFF\">
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>LISTA DE DOCUMENTOS SIN CONCILIAR MESES ANTERIORES</b>
</div>
</span></td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'><span class='Estilo4'><b>Borrar de la Conciliacion</b></span></td>
<td align='center' width='100'><span class='Estilo4'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Fecha</b>
</div>
</span></td>
<td align='center' width='100'><span class='Estilo4'><b>Comprobante</b></span></td>

<td align='center' width='300'><span class='Estilo4'><b>Tercero</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Doc/Cheque</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Debito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Credito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Estado</b></span></td>
</tr>

");
//****** consulta en tabla auxiliar SIN CONCILIAR MESES ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
/*$sq = "select * from aux_conciliaciones where (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0') order by fecha asc";*/
//printf("fecha mes antttttt : %s",$fecha_mes_ant);
$sq = "
select dcto,fecha_fin,fecha,cuenta,flag1,flag2,fecha_marca,estado,saldo_extracto,tercero,cheque,debito,credito from aux_conciliaciones
where 
(fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0')
or
(fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0')
order by fecha asc";

$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{

$fecha_marca_ctrl=$rw["fecha_marca"];

$fecha_marca_2=$rw["fecha_marca"];

$fecha_eval0=$rw["fecha_fin"];

$val1x=$rw["estado"];
$estado_ctrl=$rw["estado"];
$flag1_ctrl=$rw["flag1"];
$flag2_ctrl=$rw["flag2"];

$saldo_ext_eval=$rw["saldo_extracto"];


		if(($fecha_marca_ctrl == $fecha_fin) or ($fecha_fin > $fecha_marca_ctrl and $estado_ctrl == 'SI'))
		{
		}
		else
		{
				
		
		
				if( ($val1x == 'SI') )
				{
					printf("<tr><span class='Estilo4'>");
					printf("<td style='text-align:center;' class='Estilo4'>--</td>");
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
					printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));
					
					
					printf("<td class='Estilo4' bgcolor='#990000'>
					<font style=\"color:#FFFFFF\">Conciliada el<br>%s</font>
					</td>",$fecha_marca_ctrl);
				}
				
				else
				{
				
				
				     printf("<tr><span class='Estilo4'>");
					
						printf("<td style='text-align:center;' class='Estilo4'>
						<a href=\"elim_mes_ant.php?
						fecha_fin=%s
						&cuenta=%s
						&estado=%s
						&comprobante=%s
						&debito=%s
						&credito=%s
						\" target=\"_parent\">Eliminar</a>
						</td>",$fecha_fin,$cuenta,$rw["estado"],$rw["dcto"],$rw["debito"],$rw["credito"]);
						
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
					printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));

				
							printf("<td style='text-align:center;' class='Estilo4'>
		<a href=\"cambia_estado_no_mes_ant.php?dcto=%s&tercero=%s&cheque=%s&estado=%s&fecha_fin=%s&debito=%s&credito=%s&cuenta=%s&nom_rubro=%s&saldo_extracto=%s\" target=\"_parent\">%s</a>
		</td>",$rw["dcto"],$rw["tercero"],$rw["cheque"],$rw["estado"],$fecha_fin,$rw["debito"],$rw["credito"],$cuenta,$nom_rubro,$saldo_extracto,$rw["estado"]);
					
		
				}

		
		
		
				printf("</span></tr>");
				
	

				
		}	
					
 		  
}
printf("</table></center><br>");
?>
<br />
<!--LISTA DE DCTOS SIN CONCILIAR-->
<br />
<?php
//*** encabezado del informe

printf("
<center>

<table width='1000' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#006666'>
<td align='center' colspan='8'><span class='Estilo4' style=\"color:#FFFFFF\">
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>LISTA DE DOCUMENTOS SIN CONCILIAR DESDE : $fecha_mes_ant HASTA : $fecha_fin y/o CONCILIADOS EN MESES POSTERIORES</b>
</div>
</span></td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'><span class='Estilo4'><b>Borrar de la Conciliacion</b></span></td>
<td align='center' width='100'><span class='Estilo4'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Fecha</b>
</div>
</span></td>
<td align='center' width='100'><span class='Estilo4'><b>Comprobante</b></span></td>

<td align='center' width='300'><span class='Estilo4'><b>Tercero</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Doc/Cheque</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Debito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Credito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Estado</b></span></td>
</tr>

");
//*****************
//****** consulta en tabla auxiliar SIN CONCILIAR
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
/*$sq = "select * from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0') order by fecha asc";*/
$sq = "select  consecutivo,dcto, fecha,tercero,cheque,debito,credito,fecha_marca,estado,fecha_fin from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0') order by fecha asc";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{

$fecha_marca_ctrl=$rw["fecha_marca"];

//**** 25 ago 2010

$fecha_eval=$rw["fecha_fin"];

//****		
	
$val1x=$rw["estado"];


if($val1x == 'SI' and (ereg( "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha_eval, $regs )) and $fecha_eval == $fecha_fin)
{
	

		printf("<tr><span class='Estilo4'>");
		printf("<td style='text-align:center;' class='Estilo4'>--</td>");
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
		printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
		printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
		printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));
	
	
		printf("<td class='Estilo4' bgcolor='#990000'>
		<font style=\"color:#FFFFFF\">Conciliada el<br>%s</font>
		</td>",$fecha_marca_ctrl);
		
		
}
if($val1x == 'NO' and (ereg( "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha_eval, $regs ))  and $fecha_eval == $fecha_fin)
//if($val1x == 'NO')
{
	
	
		printf("<tr><span class='Estilo4'>");
		//***
		printf("<td style='text-align:center;' class='Estilo4'>
		<a href=\"elim_mes_act.php?
		fecha_fin=%s
		&cuenta=%s
		&estado=%s
		&comprobante=%s
		&debito=%s
		&credito=%s
		\" target=\"_parent\">Eliminar</a>
		</td>",$fecha_fin,$cuenta,$rw["estado"],$rw["dcto"],$rw["debito"],$rw["credito"]);
		//***
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
		printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
		printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
		printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));
	
	
			printf("<td style='text-align:center;' class='Estilo4'>
		<a href=\"cambia_estado.php?dcto=%s&tercero=%s&cheque=%s&estado=%s&fecha_fin=%s&debito=%s&credito=%s&cuenta=%s\" target=\"_parent\">%s</a>
		</td>",$rw["dcto"],$rw["tercero"],$rw["cheque"],$rw["estado"],$fecha_fin,$rw["debito"],$rw["credito"],$cuenta,$rw["estado"]);
		
}




		printf("</span></tr>");
		

		
				
 		  
}
printf("</table></center><br>");
?>
<br />
<!--LISTA DE DCTOS CONCILIADOS-->
<br />
<?php
//*** encabezado del informe
printf("
<center>

<table width='1000' BORDER='1' class='bordepunteado1'>


<tr bgcolor='#006666'>
<td align='center' colspan='8'><span class='Estilo4' style=\"color:#FFFFFF\">
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>LISTA DE DOCUMENTOS CONCILIADOS</b>
</div>
</span></td>
</tr>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'><span class='Estilo4'><b>Borrar de la Conciliacion</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Fecha</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Comprobante</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>Tercero</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Doc/Cheque</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Debito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Credito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Estado</b></span></td>
</tr>

");
//****** consulta en tabla auxiliar CONCILIADAS
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '1' and fecha_marca ='$fecha_fin') or (fecha_marca ='$fecha_fin' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0')  order by fecha asc";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{

		$comp1=$rw["fecha_fin"];
		$comp2=$rw["fecha_marca"];
		if($comp1 == $comp2){printf("<tr><span class='Estilo4'>");}else{printf("<tr bgcolor='#FFFF00'><span class='Estilo4'>");}
			
		//***
		printf("<td style='text-align:center;' class='Estilo4'>
		<a href=\"elim_conciliados.php?
		fecha_fin=%s
		&cuenta=%s
		&estado=%s
		&comprobante=%s
		&debito=%s
		&credito=%s
		\" target=\"_parent\">Eliminar</a>
		</td>",$fecha_fin,$cuenta,$rw["estado"],$rw["dcto"],$rw["debito"],$rw["credito"]);
		//***
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
		printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
		printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
		printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));

$val1x=$rw["estado"];
if($val1x == 'SI')
{
	printf("<td class='Estilo4' bgcolor='#006600' align='center'>
<a href=\"cambia_estado_no.php?dcto=%s&tercero=%s&cheque=%s&estado=%s&fecha_fin=%s&debito=%s&credito=%s&cuenta=%s&nom_rubro=%s&saldo_extracto=%s\" target=\"_parent\" style=\"color:#FFFFFF\">%s</a>
</td>",$rw["dcto"],$rw["tercero"],$rw["cheque"],$rw["estado"],$fecha_fin,$rw["debito"],$rw["credito"],$cuenta,$nom_rubro,$saldo_extracto,$rw["estado"]);
$debito = $debito + $rw["debito"];
$credito =$credito + $rw["credito"];
}

else
{
	printf("<td style='text-align:center;' class='Estilo4'>
<a href=\"cambia_estado_no.php?dcto=%s&tercero=%s&cheque=%s&estado=%s&fecha_fin=%s&debito=%s&credito=%s&cuenta=%s&nom_rubro=%s&saldo_extracto=%s\" target=\"_parent\">%s</a>
</td>",$rw["dcto"],$rw["tercero"],$rw["cheque"],$rw["estado"],$fecha_fin,$rw["debito"],$rw["credito"],$cuenta,$nom_rubro,$saldo_extracto,$rw["estado"]);
$debito = $debito + $rw["debito"];
$credito =$credito + $rw["credito"];

}


		printf("</span></tr>");
		

		
				
 		  
}

//*** a�ado lo de vig anteriores

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' and flag1='1' and flag2='0' and fecha_marca = '$fecha_fin'  order by fecha asc";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{

					  	printf("<tr bgcolor='#FFFF00'><span class='Estilo4'>");
						//***
						printf("<td style='text-align:center;' class='Estilo4'>
						<a href=\"elim_conciliados_vig_ant.php?
						fecha_fin=%s
						&cuenta=%s
						&estado=%s
						&comprobante=%s
						&debito=%s
						&credito=%s
						\" target=\"_parent\">Eliminar</a>
						</td>",$fecha_fin,$cuenta,$rw["estado"],$rw["comprobante"],$rw["debito"],$rw["credito"]);
						//***
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["comprobante"]);
						printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto_cheque"]);
						printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
						printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));
						printf("<td style='text-align:center;' class='Estilo4' bgcolor='#006600'>
						<a href=\"../carga_conciliaciones/cambia_estado_si_vig_ant.php?
						fecha_fin=%s
						&cuenta=%s
						&estado=%s
						&comprobante=%s
						&debito=%s
						&credito=%s
						\" target=\"_parent\" style=\"color:#FFFFFF\">%s</a>
						</td>",$fecha_fin,$cuenta,$rw["estado"],$rw["comprobante"],$rw["debito"],$rw["credito"],$rw["estado"]);
						printf("</tr></span>");
						$debito = $debito + $rw["debito"];
						$credito =$credito + $rw["credito"];
	}
$debito = number_format($debito,2,'.',',');
$credito = number_format($credito,2,'.',',');	
echo"</tr>
<tr bgcolor='#CCCCCC'>
<td align='center' width='100' colspan='5'><span class='Estilo4'><b>Total</b></span></td>
<td align='right' width='100'><span class='Estilo4'><b>$debito</b></span></td>
<td align='right' width='100'><span class='Estilo4'><b>$credito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
</tr>";

printf("</table></center><br>");
?>
<?php
//***************** finalizacion de la tabla e impresion de totales

// adicion para saldo inicial

$nat1 = substr($cuenta,0,1);

if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat1 == '8')
{
$naturaleza = "DEBITO";
}
else
{
	if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat1 == '9')
	{
	$naturaleza = "CREDITO";
	}
}



$ss22a = "select * from sico where cuenta = '$cuenta'";
$rr22a = $cx->query($ss22a);
while($rrw22a = mysql_fetch_array($rr22a)) 
{
  $sico_d=$rrw22a["debito"];
  $sico_c=$rrw22a["credito"];
}
if($naturaleza == 'DEBITO')
{
	$sini=$sico_d;		 
}
else
{
	$sini=$sico_c;
}


//************
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where fecha_fin = '$fecha_fin' and cuenta ='$cuenta'";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{


				$si=$_POST['saldo_inicial'];
				$sf=$_POST['saldo_final'];
				
				$saldo_inicial=$rw["saldo_inicial"];
				$saldo_final=$rw["saldo_final"];
				
				$total_debitos=$rw["total_debitos"];
				$total_creditos=$rw["total_creditos"];
				
				if(($saldo_inicial == '0' and $saldo_final == '0'))
				{
				 //$saldo_inicial=$si;
				 $saldo_inicial=$si;
				 $saldo_final=$sf;
				
				}

}

printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;'>
<span class='Estilo4'><center><b>
Saldo Inicial = %s 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Saldo Final = %s</b></center></span>
</div>
</td>
</tr>
</table>
</center><br>
",number_format($saldo_inicial,2,',','.'),number_format($saldo_final,2,',','.'));
//***********************
?>
<!--aqui resumen de conciliacion-->
 <br />
 <strong>RESUMEN DE LA CONCILIACION</strong> 
 <BR />
 <br />
 <table width="800" border="1" class="bordepunteado1">
   <tr>
     <td width="391" bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
         <div align="right" class="Estilo11"><strong>SALDO EN EXTRACTO 
           : </strong></div>
     </div></td>
     <td colspan="2" bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:30px; padding-bottom:5px;'>
         <div align="right" class="Estilo11">
           <div align="center"><?php printf("%s",number_format($saldo_extracto,2,'.',','));?> </div>
         </div>
       <div align="right"></div>
       <div align="right"></div>
     </div></td>
   </tr>
   
   <tr>
     <td rowspan="2">&nbsp;</td>
     <td width="194"><div class="Estilo9" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
         <div align="center">TOTAL DEBITOS PENDIENTES </div>
     </div></td>
     <td width="191"><div class="Estilo9" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
         <div align="center">TOTAL CREDITOS PENDIENTES </div>
     </div></td>
   </tr>
   <tr>
     <td><div style='padding-left:5px; padding-top:5px; padding-right:20px; padding-bottom:5px;'>
         <div align="right">
<?php
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0')  order by fecha asc";
$re = $cx->query($sq);
$acum_debito_1=0;
$acum_debito_2=0;
while($rw = $re->fetch_assoc()) 
{
$fecha_marca_ctrl=$rw["fecha_marca"];
$fecha_marca_2=$rw["fecha_marca"];
$val1x=$rw["estado"];
$estado_ctrl=$rw["estado"];
$flag1_ctrl=$rw["flag1"];
$flag2_ctrl=$rw["flag2"];
		if(($fecha_marca_ctrl == $fecha_fin) or ($fecha_fin > $fecha_marca_ctrl and $estado_ctrl == 'SI'))
		{
		}
		else
		{
				//printf("debito : %s<br>",number_format($rw["debito"],2,',','.'));
				$acum_debito_1=$acum_debito_1+$rw["debito"];
		}	
}
//***
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0')  order by fecha asc";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{
		$fecha_marca_ctrl=$rw["fecha_marca"];
		//printf("debito : %s<br>",number_format($rw["debito"],2,',','.'));
		$acum_debito_2=$acum_debito_2+$rw["debito"];
}

//*****

//****** consulta en tabla auxiliar SIN CONCILIAR vigencias ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' order by fecha asc";
$re = $cx->query($sq);
$acum_deb_va='0';
while($rw = $re->fetch_assoc()) 
{
				
				$ctrl1x=$rw["fecha"];
				$ctrl2x=$rw["estado"];
				$fm=$rw["fecha_marca"];
				
				if($ctrl1x =='FECHA')
				{
				}
				else
				{
				
					if($ctrl2x == 'SI' and $fecha_fin < $fm)
					{

							
							$acum_deb_va= $acum_deb_va+$rw["debito"];
							
						
					}
					else
					{
						
						if($ctrl2x == 'NO' and $fm != $fecha_fin)
						{
						
						    $acum_deb_va= $acum_deb_va+$rw["debito"];
						
						
						}
					}
				}
}



$tot_debitos = $acum_debito_1+$acum_debito_2+$acum_deb_va;
printf("%s",number_format($tot_debitos,2,'.',','));
?>
         </div>
     </div></td>
	 
	 
	 
<!--inicio creditos-->	 
	 
	 
	 
	 
     <td><div style='padding-left:5px; padding-top:5px; padding-right:20px; padding-bottom:5px;'>
         <div align="right">
<?php
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0')  order by fecha asc";
$re = $cx->query($sq);
$acum_credito_1=0;
$acum_credito_2=0;
while($rw = $re->fetch_assoc()) 
{
$fecha_marca_ctrl=$rw["fecha_marca"];
$fecha_marca_2=$rw["fecha_marca"];
$val1x=$rw["estado"];
$estado_ctrl=$rw["estado"];
$flag1_ctrl=$rw["flag1"];
$flag2_ctrl=$rw["flag2"];
		if(($fecha_marca_ctrl == $fecha_fin) or ($fecha_fin > $fecha_marca_ctrl and $estado_ctrl == 'SI'))
		{
		}
		else
		{
				//printf("credito : %s<br>",number_format($rw["credito"],2,',','.'));
				$acum_credito_1=$acum_credito_1+$rw["credito"];
		}	
}
//***
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0')  order by fecha asc";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{
		$fecha_marca_ctrl=$rw["fecha_marca"];
		//printf("credito : %s<br>",number_format($rw["credito"],2,',','.'));
		$acum_credito_2=$acum_credito_2+$rw["credito"];
}


//*****

//****** consulta en tabla auxiliar SIN CONCILIAR vigencias ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' order by fecha asc";
$re = $cx->query($sq);
$acum_cre_va='0';
while($rw = $re->fetch_assoc()) 
{
				
				$ctrl1x=$rw["fecha"];
				$ctrl2x=$rw["estado"];
				$fm=$rw["fecha_marca"];
				
				if($ctrl1x =='FECHA')
				{
				}
				else
				{
				
					if($ctrl2x == 'SI' and $fecha_fin < $fm)
					{

							
							$acum_cre_va= $acum_cre_va+$rw["credito"];
							
						
					}
					else
					{
						
						if($ctrl2x == 'NO' and $fm != $fecha_fin)
						{
						
						    $acum_cre_va= $acum_cre_va+$rw["credito"];
						
						
						}
					}
				}
}

$tot_creditos = $acum_credito_1+$acum_credito_2+$acum_cre_va;
printf("%s",number_format($tot_creditos,2,'.',','));


?>	 
		 </div>
     </div></td>
   </tr>
   
   <tr>
     <td bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
         <div align="right" class="Estilo10">SALDO CONTABLE  : </div>
     </div></td>
     <td colspan="2" bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:30px; padding-bottom:5px;'>
         <div align="right" class="Estilo11">
           <div align="center"><?php printf("%s",number_format($saldo_final,2,'.',','));?> </div>
         </div>
       <div align="right"></div>
     </div></td>
   </tr>
   <tr>
     <td bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
         <div align="right" class="Estilo10">DIFERENCIA A CONCILIAR  : </div>
     </div></td>
     <td colspan="2" bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:30px; padding-bottom:5px;'>
         <div align="right" class="Estilo11">
           <div align="center">
             <?php $diferencia = $saldo_extracto -  ($tot_creditos) + ($tot_debitos) - $saldo_final;
	 
	 printf("%s",number_format($diferencia,2,'.',','));?>
           </div>
         </div>
     </div></td>
   </tr>
 </table>
 <?php
?>
 </div>
</div>
<!--fin de la pagina-->
<table width="800" border="0" align="center">
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='conciliaciones.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
            <span class="Estilo4"> <strong>
            <?php include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
            </strong> </span> <br />
            <span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <?php include('../config.php'); echo $nom_emp ?>
        <br />
        <?php echo $dir_tel ?><br />
        <?php echo $muni ?> <br />
        <?php echo $email?> </div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <br />
        </a><br />
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a></div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
      <div align="center">Desarrollado por <br />
            <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
        Derechos Reservados - 2009 </div>
    </div></td>
  </tr>
</table>
</body>
</html>






<?php
}
?>