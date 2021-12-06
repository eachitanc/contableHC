<?php
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
.Estilo16 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; font-weight: bold; }
-->
 @media print {
    .oculto {display:none}
  }

</style>
</head>

<body>
<form name="conci" action="../informes_contabilidad/libro_auxiliar2.php" method="post" target="_blank">
<?php
include('../config.php');				
$cx2 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from empresa";
$re2 = mysql_db_query($database, $sq2, $cx2);

while($row2 = $re2->fetch_assoc()) 
   {
	$raz_soc = $row2["raz_soc"];  
	$nit = $row2["nit"];  
	$dv = $row2["dv"];
	$nom_otr_resp = $row2["nom_otr_resp"];
	
	
   }
?>	
<table width="800" border="0" align="center">
  <tr>
    <td width="798" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo4"><img src="../images/PLANTILLA PNG PARA LOGO EMPRESA.png" width="107" height="88" /></div>
    </div></td>
    <td width="798" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
        <div align="center" class="Estilo9">

<b>
CONCILIACION BANCARIA
<br />
<?php printf("%s",$raz_soc);?>
<br />
NIT : <?php printf("%s",$nit);?> - <?php printf("%s",$dv);?></b>        </div>
    </div></td>
    <td width="798" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<div align="center" class="Estilo4">
 <div style='padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;'><?php
include('../config.php');

$fecha_fin=$_POST['fecha_fin'];
$cuenta=$_POST['cuenta'];
$nom_rubro=$_POST['nom_rubro'];

if (!$_POST['cuenta']) $cuenta=$_GET['cuenta'];
if (!$_POST['fecha_fin']) $fecha_fin=$_GET['fecha_fin'];

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where fecha_fin ='$fecha_fin' and cuenta='$cuenta'  ";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) {$saldo_extracto=$rw["saldo_extracto"];}//printf(" nom_rubro : $nom_rubro<br>");

$sq3 ="select nom_rubro from pgcp where cod_pptal = '$cuenta'";
$rs3 = mysql_db_query($database, $sq3, $cx);
$rw3 = mysql_fetch_array($rs3);
$nom_rubro = $rw3['nom_rubro'];

//menos un mes

$a = date("Y", strtotime($fecha_fin)); 
$b = date("m", strtotime($fecha_fin)); 
$c = date("d", strtotime($fecha_fin)); 


// texto del mes
if($b == '01')
{
$nom_mes='ENERO';
$fecha_ini=$a."/01/01";
}
if($b == '02')
{
$nom_mes='FEBRERO';
$fecha_ini=$a."/02/01";
}
if($b == '03')
{
$nom_mes='MARZO';
$fecha_ini=$a."/03/01";
}
if($b == '04')
{
$nom_mes='ABRIL';
$fecha_ini=$a."/04/01";
}
if($b == '05')
{
$nom_mes='MAYO';
$fecha_ini=$a."/05/01";
}
if($b == '06')
{
$nom_mes='JUNIO';
$fecha_ini=$a."/06/01";
}
if($b == '07')
{
$nom_mes='JULIO';
$fecha_ini=$a."/07/01";
}
if($b == '08')
{
$nom_mes='AGOSTO';
$fecha_ini=$a."/08/01";
}
if($b == '09')
{
$nom_mes='SEPTIEMBRE';
$fecha_ini=$a."/09/01";
}
if($b == '10')
{
$nom_mes='OCTUBRE';
$fecha_ini=$a."/10/01";
}
if($b == '11')
{
$nom_mes='NOVIEMBRE';
$fecha_ini=$a."/11/01";
}
if($b == '12')
{
$nom_mes='DICIEMBRE';
$fecha_ini=$a."/12/01";
}
//**************


// dias calendario

$ene=31;$feb=28;$mar=31;$abr=30;$may=31;$jun=30;$jul=31;$ago=31;$sep=30;$oct=31;$nov=30;$dic=31;

// no mes

$nene="01";$nfeb="02";$nmar="03";$nabr="04";$nmay="05";$njun="06";$njul="07";$nago="08";$nsep="09";$noct="10";$nnov="11";$ndic="12";

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

if($b == $nfeb)
{
$ts1 = strtotime($fecha_fin);
$ts = strtotime('-27 days',$ts1);
$fecha_mes_ant=date('Y/m/d', $ts);
}
// imprime tabla del encabezado
printf("
<center class='Estilo4'>
<table width='800' border='1' align='center' class='bordepunteado1'>
<tr>
<td align='right' width='300'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Codigo Cuenta PGCP : </b>
</div>
</td>
<td align='center' width='500'>
%s
</td>
</tr>
<tr>
<td align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Nombre Cuenta PGCP : </b>
</div>
</td>
<td align='center'>
%s
</td>
</tr>




<tr>
<td  align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Mes Conciliado : </b>
</div>
</td>
<td align='center'>
$nom_mes
</td>
</tr>




<tr>
<td  align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>A�o : </b>
</div>
</td>
<td align='center'>
$a
</td>
</tr>




</table>
",$cuenta,$nom_rubro,$fecha_mes_ant,$fecha_fin,number_format($saldo_extracto,2,',','.'));   
?>
<br />
<!--LISTA DE DCTOS SIN CONCILIAR VIGENCIAS ANTERIORES--> 

<!--LISTA DE DCTOS SIN CONCILIAR MESES ANTERIORES-->

<!--LISTA DE DCTOS SIN CONCILIAR-->


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
				$sf=$_GET['saldo'];
				
				$saldo_inicial=$rw["saldo_inicial"];
				$saldo_final=$rw["saldo_final"];
				
				$total_debitos=$rw["total_debitos"];
				$total_creditos=$rw["total_creditos"];
				
				if(($saldo_inicial == '0' and $saldo_final == '0'))
				{
				 //$saldo_inicial=$si;
				 $saldo_inicial=$sini;
				 $saldo_final=$sf;
				}

}


?>
<!--aqui resumen de conciliacion-->
 <table width="800" border="1" align="center" class="bordepunteado1">
   <tr>
     <td width="395" bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:20px; padding-bottom:5px;'>
       <div align="right" class="Estilo10">SALDO EN LIBROS (Contable) :  </div>
     </div></td>
     <td width="197"><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo4"><div align="right"><?php printf("%s",number_format($saldo_final,2,',','.'));?> </div> </div>
     </div></td>
     <td width="194"><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo4"> </div>
     </div></td>
   </tr>
   <tr>
     <td bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:20px; padding-bottom:5px;'>
       <div align="right" class="Estilo10">Total Debitos Pendientes ( + + ) : </div>
     </div></td>
     <td><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo4"> </div>
     </div></td>
     <td><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo4">
<?php

//****** consulta en tabla auxiliar SIN CONCILIAR vigencias ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' and fecha <='$fecha_fin' order by fecha asc";
$re = $cx->query($sq);
$ad1='0';
$ac1='0';
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
							$ad1=$ad1+$rw["debito"];
							$ac1=$ac1+$rw["credito"];
					}
					else
					{
						
						if($ctrl2x == 'NO' and $fm != $fecha_fin)
						{
						    $ad1=$ad1+$rw["debito"];
							$ac1=$ac1+$rw["credito"];
						}
					}
				}
}

//****** consulta en tabla auxiliar SIN CONCILIAR MESES ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0')  order by fecha asc";
$re = $cx->query($sq);
$ad2='0';
$ac2='0';
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
				
		
		
				if( ($val1x == 'SI') and ($fecha_fin < $fecha_marca_ctrl))
				{
					$ad2=$ad2+$rw["debito"];
					$ac2=$ac2+$rw["credito"];					
				}
				
				else
				{
				    $ad2=$ad2+$rw["debito"];
					$ac2=$ac2+$rw["credito"];
				}
		
			
		}	
					
 		  
}
//****** consulta en tabla auxiliar SIN CONCILIAR
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select distinct(dcto), fecha,tercero,cheque,debito,credito,fecha_marca,estado,fecha_fin,consecutivo from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0') order by fecha asc";
$re = $cx->query($sq);
$ad3='0';
$ac3='0';
while($rw = $re->fetch_assoc()) 
{

$fecha_marca_ctrl=$rw["fecha_marca"];
$fecha_eval=$rw["fecha_fin"];
$val1x=$rw["estado"];


	if($val1x == 'SI' and (ereg( "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha_eval, $regs )) and $fecha_eval == $fecha_fin)
	{
			$ad3=$ad3+$rw["debito"];
			$ac3=$ac3+$rw["credito"];
	}
	if($val1x == 'NO' and (ereg( "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha_eval, $regs ))  and $fecha_eval == $fecha_fin)
	{
			$ad3=$ad3+$rw["debito"];
			$ac3=$ac3+$rw["credito"];
	}
 		  
}

$tot_debitos=$ad1+$ad2+$ad3;
printf("%s",number_format($tot_debitos,2,',','.'));

?>	   
	    </div>
     </div></td>
   </tr>
   <tr>
     <td bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:20px; padding-bottom:5px;'>
       <div align="right" class="Estilo10">Total Creditos Pendientes ( - ) : </div>
     </div></td>
     <td><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo4"> </div>
     </div></td>
     <td><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo4">
<?php

//****** consulta en tabla auxiliar SIN CONCILIAR vigencias ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' and fecha <='$fecha_fin' order by fecha asc";
$re = $cx->query($sq);
$ad1='0';
$ac1='0';
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
							$ad1=$ad1+$rw["debito"];
							$ac1=$ac1+$rw["credito"];
					}
					else
					{
						
						if($ctrl2x == 'NO' and $fm != $fecha_fin)
						{
						    $ad1=$ad1+$rw["debito"];
							$ac1=$ac1+$rw["credito"];
						}
					}
				}
}

//****** consulta en tabla auxiliar SIN CONCILIAR MESES ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0')  order by fecha asc";
$re = $cx->query($sq);
$ad2='0';
$ac2='0';
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
				
		
		
				if( ($val1x == 'SI') and ($fecha_fin < $fecha_marca_ctrl))
				{
					$ad2=$ad2+$rw["debito"];
					$ac2=$ac2+$rw["credito"];					
				}
				
				else
				{
				    $ad2=$ad2+$rw["debito"];
					$ac2=$ac2+$rw["credito"];
				}
		
			
		}	
					
 		  
}
//****** consulta en tabla auxiliar SIN CONCILIAR
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select distinct(dcto), fecha,tercero,cheque,debito,credito,fecha_marca,estado,fecha_fin from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0') order by fecha asc";
$re = $cx->query($sq);
$ad3='0';
$ac3='0';
while($rw = $re->fetch_assoc()) 
{

$fecha_marca_ctrl=$rw["fecha_marca"];
$fecha_eval=$rw["fecha_fin"];
$val1x=$rw["estado"];


	if($val1x == 'SI' and (ereg( "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha_eval, $regs )) and $fecha_eval == $fecha_fin)
	{
			$ad3=$ad3+$rw["debito"];
			$ac3=$ac3+$rw["credito"];
	}
	if($val1x == 'NO' and (ereg( "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha_eval, $regs ))  and $fecha_eval == $fecha_fin)
	{
			$ad3=$ad3+$rw["debito"];
			$ac3=$ac3+$rw["credito"];
	}
 		  
}

$tot_creditos=$ac1+$ac2+$ac3;
printf("%s",number_format($tot_creditos,2,',','.'));

?>	   
	    </div>
     </div></td>
   </tr>
   <tr>
     <td bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:20px; padding-bottom:5px;'>
       <div align="right" class="Estilo10">SALDO EN EXTRACTO : </div>
     </div></td>
     <td><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo4"> </div>
     </div></td>
     <td><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo4">
<?php printf("%s",number_format($saldo_extracto,2,',','.'));?>	   
	    </div>
     </div></td>
   </tr>
   
   
<?php
$RES1=$saldo_extracto-$tot_creditos+$tot_debitos;


if($saldo_final == $RES1)

{
	 
?>
   
     <tr>
	 <td bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:20px; padding-bottom:5px;'>
       <div align="right" class="Estilo10">SUMAS IGUALES  : </div>
     </div></td>
     <td bgcolor="#009900"><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo10"><?php printf("%s",number_format($saldo_final,2,',','.'));?> </div>
     </div></td>
     <td bgcolor="#009900"><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo10"><?php printf("%s",number_format($saldo_final,2,',','.'));?> </div>
     </div></td>
	 </tr>
<?php

}
else
{
?>   
     <tr>
	 <td bgcolor="#990000"><div style='padding-left:5px; padding-top:5px; padding-right:20px; padding-bottom:5px;'>
       <div align="right" class="Estilo10">SUMAS IGUALES  : </div>
     </div></td>
     <td bgcolor="#990000"><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo10"><?php printf("%s",number_format($saldo_final,2,',','.'));?> </div>
     </div></td>
     <td bgcolor="#990000"><div style="padding-left:5px; padding-top:3px; padding-right:20px; padding-bottom:3px;">
       <div align="right" class="Estilo10"><?php printf("%s",number_format($saldo_final,2,',','.'));?> </div>
     </div></td>
	 </tr>

<?php
}
?>

   
 </table>
 <br />
<!--LISTA DE DCTOS SIN CONCILIAR VIGENCIAS ANTERIORES--> 
<?php
//*** encabezado del informe

printf("
<center>

<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>

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

</tr>

");
//****** consulta en tabla auxiliar SIN CONCILIAR vigencias ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' and fecha <='$fecha_fin' order by fecha asc";
$re = $cx->query($sq);
$ad1='0';
$ac1='0';
while($rw = $re->fetch_assoc()) 
{
				
		$ctrl1x=$rw["fecha"];
		$ctrl2x=$rw["estado"];
		$fm=$rw["fecha_marca"];
		$total = $rw["debito"] + $rw["credito"];		
				if($ctrl1x =='FECHA')
				{
				}
				else
				{
				
					if($ctrl2x == 'SI' and $fecha_fin < $fm)
					{

							if ($rw['comprobante'] != 'NA')
							{
							printf("<tr bgcolor='#FFFFFF'><span class='Estilo4'>");
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["comprobante"]);
							printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto_cheque"]);
							printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,',','.'));
							printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,',','.'));
							
							printf("</tr></span>");
							
							$ad1=$ad1+$rw["debito"];
							$ac1=$ac1+$rw["credito"];
							}
					}
					else
					{
						
						if($ctrl2x == 'NO' and $fm != $fecha_fin)
						{
							if ($rw['comprobante'] !='NA')
							{
						printf("<tr><span class='Estilo4'>");

						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["comprobante"]);
						printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto_cheque"]);
						printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,',','.'));
						printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,',','.'));
						
						printf("</tr></span>");
							}
						    $ad1=$ad1+$rw["debito"];
							$ac1=$ac1+$rw["credito"];
						
						}
					}
				}
}

?>
<!--LISTA DE DCTOS SIN CONCILIAR MESES ANTERIORES-->
<?php
//****** consulta en tabla auxiliar SIN CONCILIAR MESES ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0')  order by fecha asc";
$re = $cx->query($sq);
$ad2='0';
$ac2='0';
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
				if( ($val1x == 'SI') and ($fecha_fin < $fecha_marca_ctrl))
				{
					if ($rw['dcto'] !='NA')
							{
					printf("<tr bgcolor='#FFFFFF'><span class='Estilo4'>");
					
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
					printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,',','.'));
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,',','.'));
					
					$ad2=$ad2+$rw["debito"];
					$ac2=$ac2+$rw["credito"];					
							}
				}
				
				else
				{
				
				if ($rw['dcto'] !='NA')
							{
				    printf("<tr><span class='Estilo4'>");

					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
					printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,',','.'));
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,',','.'));

				    $ad2=$ad2+$rw["debito"];
					$ac2=$ac2+$rw["credito"];
							}
		
				}
		
				printf("</span></tr>");
				
		}	
					
 		  
}

?>
<!--LISTA DE DCTOS SIN CONCILIAR-->
<?php
//****** consulta en tabla auxiliar SIN CONCILIAR
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
/*$sq = "select * from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0') order by fecha asc";*/
$sq = "select distinct(dcto), fecha,tercero,cheque,debito,credito,fecha_marca,estado,fecha_fin,consecutivo from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0') order by fecha asc";
$re = $cx->query($sq);
$ad3='0';
$ac3='0';
while($rw = $re->fetch_assoc()) 
{

$fecha_marca_ctrl=$rw["fecha_marca"];

//**** 25 ago 2010

$fecha_eval=$rw["fecha_fin"];

//****		
	
$val1x=$rw["estado"];


if($val1x == 'SI' and (ereg( "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha_eval, $regs )) and $fecha_eval == $fecha_fin)
{
	if ($rw['dcto'] !='NA')
							{
		printf("<tr bgcolor='#FFFFFF'><span class='Estilo4'>");
		
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
		printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
		printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,',','.'));
		printf("<td style='text-align:right;' class='Estilo4'>%s</td></tr>",number_format($rw["credito"],2,',','.'));
	
	    $ad3=$ad3+$rw["debito"];
		$ac3=$ac3+$rw["credito"];
							}

		
		
}
if($val1x == 'NO' and (ereg( "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha_eval, $regs ))  and $fecha_eval == $fecha_fin)
//if($val1x == 'NO')
{
	if ($rw['dcto'] !='NA')
							{
	
		printf("<tr><span class='Estilo4'>");

		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
		printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
		printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,',','.'));
		printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,',','.'));
	
	    $ad3=$ad3+$rw["debito"];
		$ac3=$ac3+$rw["credito"];
							}
		
}
		printf("</span></tr>");
 		  
}
// total de la tabla

printf("</table></center>");
$tot_deb =$ad1+$ad2+$ad3;
$tot_cre =$ac1+$ac2+$ac3;
printf("<table width='800'  class='bordepunteado12'>");
printf("<tr  bgcolor='#DCE9E5'><span class='Estilo4'>");
		printf("<td style='text-align:left;' class='Estilo4' colspan='4' width='609'>Total</td>");
		printf("<td style='text-align:right;' class='Estilo4' width='96'>%s</td>",number_format($tot_deb,2,',','.'));
		printf("<td style='text-align:right;' class='Estilo4' width='96'>%s</td>",number_format($tot_cre,2,',','.'));
printf("</span></tr>");
printf("</table></center>");

?>

 </div>
</div>
<!--fin de la pagina-->
<table width="800" border="0" align="center">
  
  <tr>
    <td width="2394" colspan="3"><table width="800" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo4"><strong>PREPAR&Oacute;</strong></div>
        </div></td>
        <td width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo16">REVISO</div>
        </div></td>
        <td width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo16">APROBO  </div>
        </div></td>
        <td width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo16">NUMERO CUENTA  </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <input name="preparo" type="text" class="Estilo4" id="preparo" value="" size="30" onkeyup="a.preparo.value=a.preparo.value.toUpperCase();" style="border:0px" />
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <input name="preparo2" type="text" class="Estilo4" id="preparo2" value="" size="30" onkeyup="a.preparo.value=a.preparo.value.toUpperCase();" style="border:0px" />
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
                          </div>
        </div></td>
        <td>
<div align="center">

<?php
include_once("../class.barcode.php");

$consecutivo = $cuenta;

$barcode = new BarCode($consecutivo);
$barcode->drawBarCode();

?>

<input name="fecha_ini" id="fecha_ini" value="<?php echo $fecha_ini; ?>" type="hidden" />
<input name="fecha_fin" id="fecha_fin" value="<?php echo $fecha_fin; ?>" type="hidden" />
<input name="nn" id="nn" value="<?php echo $cuenta; ?>" type="hidden" />
</div>		</td>
      </tr>
      
    </table></td>
  </tr>
</table>
<table width="800" border="0" align="center">
  <tr>
    <td width="396"><div align="center"></div></td>
    <td width="6"><input name="imprimir" type="button" class="Estilo4 oculto" onclick="window.print();" value="Imprimir" /></td>
     <td width="6"><input name="libaux" type="submit"  class="Estilo4 oculto"  value="Imprimir Libro Auxiliar" /></td>
    <td width="396"><div align="center"></div></td>
  </tr>
  <tr class="oculto">
    <td colspan="4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      
    </div></td>
  </tr>
</table>
</form>
</body>
</html>






<?php
}
?>