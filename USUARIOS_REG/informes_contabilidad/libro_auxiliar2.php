<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
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
 @media print {
    .oculto {display:none}
  }
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
<style type="text/css">
<!--
.Estilo11 {font-weight: bold; color: #FFFFFF; }
-->
</style>
<title>CONTAFACIL</title>
	<?

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//*** la creo
$conexion=mysql_connect ($server, $dbuser, $dbpass);
		$tabla7="sico";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `cuenta` varchar(200) NOT NULL default '',
  `nombre` varchar(200) NOT NULL default '',
  `debito` decimal(20,2) NOT NULL default '0.00',
  `credito` decimal(20,2) NOT NULL default '0.00'
)TYPE=MyISAM";
		
		mysql_select_db ($database, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{
		//echo "<center class='Estilo4'> <br> <center>La tabla $tabla7 se ha creado con exito<br></center>";
		}
		else
		{
		//echo "<center class='Estilo4'> <br> <center>La tabla $tabla7 se ha creado con exito - OK!<br></center>";
		}



//********* ano e id_emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{

$idxx=$rowxx["id_emp"];
$id_emp=$rowxx["id_emp"];
$ano=$rowxx["ano"];

}

// fecha_ini_op
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $fecha_ini_op=$rowxx3["fecha_ini_op"];
   }  
//*********
//***** llegada de variables POST
$fecha_ini=$_POST['fecha_ini'];
$fecha_fin=$_POST['fecha_fin'];
$nn=$_POST['nn'];
//***** resta de 1 dia para fechas de calculo de saldo inicial

// restar 1 a la fecha inicial
$ts11 = strtotime($fecha_ini);
$tsa = strtotime('-1 day',$ts11);
$aux_fecha=date('Y/m/d', $tsa);
//printf("$fecha_ini_op <br> $aux_fecha<br>");
// restar 1 a la fecha final
$ts1 = strtotime($fecha_fin);
$ts = strtotime('-1 day',$ts1);
$hasta=date('Y/m/d', $ts);
//***** nombre del rubro para titulo
$ss22 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$nn'";
$rr22 = mysql_db_query($database, $ss22, $connectionxx);
while($rrw22 = mysql_fetch_array($rr22)) 
{
  $nom_rubro22=$rrw22["nom_rubro"];
}
/*LAS CUENTAS QUE INICIAN CON : 1,5,6,7 Y 8 SON DE SALDO DEBITO
LAS CUENTAS QUE INICIAN CON : 2,3,4 Y 9 SON DE SALDO CREDITO*/

//******* naturaleza de la cuenta
$nat1 = substr($nn,0,1);

$nat2 = substr($nn,0,2);

if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
{	$naturaleza = "DEBITO";	}
else
{   if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89' )
	{
	$naturaleza = "CREDITO";
	}
}

//************** extraccion del sico

$ss22a = "select * from sico where cuenta = '$nn'";
$rr22a = mysql_db_query($database, $ss22a, $connectionxx);
while($rrw22a = mysql_fetch_array($rr22a)) 
{
  $sico_d=$rrw22a["debito"];
  $sico_c=$rrw22a["credito"];
  
 
}


if($sico_d == '')
{
  $sico_d=0;
 
}

if($sico_c == '')
{
  $sico_c=0;
 
}

		$sqlr = "select * from sico";
		$resultr = mysql_query($sqlr, $connectionxx) or die(mysql_error());
		if (mysql_num_rows($resultr) == 0)
		{
		printf("<center><span class='Estilo4'>CARGUE SALDOS INICIALES</span></center>");
		}




//************** calculo saldo inicial

if($fecha_ini == $fecha_ini_op)
{

		if($naturaleza == 'DEBITO')
		{
			$saldo_inicial=$sico_d;		 
			
		}
		else
		{
		    $saldo_inicial=$sico_c;
			
		}
		
}
else
{ 

		if($naturaleza == 'DEBITO')
		{
			$saldo_inicial=$sico_d;	
			$acu_deb=0;
			$acu_cre=0;
			
			$cx1 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
			//$sq1 = "select * from lib_aux where (fecha between '$fecha_ini_op' and '$hasta' ) order by fecha asc ";
		//	$sq1 = "select  * from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' ) order by fecha asc ";
			
			$sq1 = "select  cuenta, sum(debito) as sumadebito ,sum(credito) as sumacredito from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' ) group by cuenta having cuenta = '$nn'";
			
			$re1 = mysql_db_query($database, $sq1, $cx1) or die ($sq1 .mysql_error()."");
			
			while($rw1 = mysql_fetch_array($re1)) 
			{
				$saldo_inicial=$sico_d + $rw1[sumadebito] - $rw1[sumacredito];			
			}//fin while
		
		}
		else
		{
		
			$saldo_inicial=$sico_c;	
			$acu_deb=0;
			$acu_cre=0;
			
			$cx1 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
			//$sq1 = "select * from lib_aux where (fecha between '$fecha_ini_op' and '$hasta' ) order by fecha asc ";
			//$sq1 = "select  * from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' ) order by fecha asc ";
$sq1 = "select  cuenta, sum(debito) as sumadebito ,sum(credito) as sumacredito from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' ) group by cuenta having cuenta = '$nn'";		
			$re1 = mysql_db_query($database, $sq1, $cx1);
			
			while($rw1 = mysql_fetch_array($re1)) 
			{
				$saldo_inicial=$sico_c - $rw1[sumadebito] + $rw1[sumacredito];								
			}//fin while
		}

		
}//fin else

//****************
//**** variables para totalizar saldos
$total_debitos=0;
$total_creditos=0;
//***


		printf("<BR>
		<center>
		<span class='Estilo4'>
		<B>LIBRO AUXILIAR 
		<br>
		CUENTA ".$nn." - ".$nom_rubro22."</B>
		<BR><BR>
		Naturaleza de la Cuenta : <b>".$naturaleza."</b>
		<BR><BR>
		<b>Fecha Inicial</b> seleccionada <b>%s</b> - <b>Fecha Final</b> seleccionada <b>%s</b>
		</span>
		</center><BR>",$fecha_ini,$fecha_fin,$nn);



//*** encabezado del informe

printf("
<center>

<table width='970' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='70'><span class='Estilo4'><b>Fecha</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Documento</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>Detalle</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>Tercero</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Debito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Credito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Saldo</b></span></td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' colspan='5'>
<span class='Estilo4'><b></b></span>
</td>
<td align='center'>
<span class='Estilo4'><center><b>Saldo Inicial</b></center></span>
</td>
<td align='right'>
<span class='Estilo4'><b>%s</b></span>
</td>
</tr>

",number_format($saldo_inicial,2,".",","));
//*****************

//****** consulta en tabla auxiliar

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$nn' order by fecha asc ";
$re = mysql_db_query($database, $sq, $cx);

$saldo=$saldo_inicial;

while($rw = mysql_fetch_array($re)) 
{

										
						//if($rw["cuenta"] == $nn)
						//{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>",$rw["fecha"],$rw["dcto"]); 
						printf("
						<td style='text-align:left;' class='Estilo4'>&nbsp;%s&nbsp;</td>
						<td style='text-align:left;' class='Estilo4'>&nbsp;%s&nbsp;</td>
						<td style='text-align:right;' class='Estilo4'>%s</td>
						<td style='text-align:right;' class='Estilo4'>%s</td>
						",$rw["detalle"],$rw["tercero"],number_format($rw["debito"],2,".",","),number_format($rw["credito"],2,".",","));	
						
						$total_debitos=$total_debitos+$rw["debito"];
						$total_creditos=$total_creditos+$rw["credito"];
						
						
							
							if($naturaleza == 'DEBITO')
							{
							 	$saldo=$saldo + $rw["debito"] - $rw["credito"];			 
								printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($saldo,2,".",","));
							}
							else
							{
							   $saldo=$saldo - $rw["debito"] + $rw["credito"];
							   printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($saldo,2,".",","));
							}
						
						//}

				
				
 		  
}//fin while	

//***************** finalizacion de la tabla e impresion de totales


if($naturaleza == 'DEBITO')
{
$saldo_final = $saldo_inicial + $total_debitos - $total_creditos;
}
else
{
$saldo_final = $saldo_inicial - $total_debitos + $total_creditos;
}



printf("

<tr bgcolor='#DCE9E5'>
<td align='center' colspan='3'>
<span class='Estilo4'><b></b></span>
</td>
<td align='right'>
<span class='Estilo4'><b>Total de Movimientos</b>&nbsp;</span>
</td>
<td align='right'>
<span class='Estilo4'><b>%s</b></span>
</td>
<td align='right'>
<span class='Estilo4'><b>%s</b></span>
</td>
<td align='right'>
<span class='Estilo4'><b>%s</b></span>
</td>
</tr>


",number_format($total_debitos,2,".",","),number_format($total_creditos,2,".",","),number_format($saldo_final,2,".",","));

printf("</tr></table>");

//***********************
?>
<?
}
?>
<br />
<div class="oculto" style="padding-left:5px; padding-top:10px; padding-right:5px;  padding-bottom:5px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='libro_auxiliar.php' target='_parent'>VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
	