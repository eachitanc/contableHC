<?php
set_time_limit(4800);
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
.Estilo8 {color: #FFFFFF}
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


<!--linea de insercion del jquery-->

<script type="text/javascript" language="javascript" src="../jquery.js"></script>


<!-- inicio mostrar tabla-->

<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar").click(function(event) {
event.preventDefault();
$("#caja").slideToggle();
});

});
</script>
<!--**************************-->

<style type="text/css">

a{color:#993300; text-decoration:none;}

#caja {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

</style>

<!-- fin mostrar tabla--> 




</head>

<body>
<div align="center" class="Estilo4">
 <div style='padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;'>
     
      <?php
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
mysql_select_db ($database, $cx);

function esBisiesto($year=NULL) {
    return checkdate(2, 29, ($year==NULL)? date('Y'):$year); // devolvemos true si es bisiesto
}
$cuenta = $_POST['nn']; 
//list($cuenta, $nom_rubro) = split('[;]', $separar);
// actualizo la tabla aux conciliaciones con los datos de la cuenta seleccionada

//************* borro la tabla		
$tabla6="aux_conciliaciones";
$anadir6="DROP TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";



		if(mysql_query ($anadir6 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};
//**********************adiciona campo empresa genero
$tabla="CREATE TABLE aux_conciliaciones SELECT * FROM aux_conciliaciones2 where cuenta = '$cuenta';";
		if(mysql_query ($tabla ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};

// frear cuenta dependiente lib _aux
$fecha_fin=$_POST['fecha_fin'];
$saldo_extracto=str_replace(',','',$_POST['saldo']);
if($saldo_extracto == '')
{
		$sq = "select * from aux_conciliaciones where fecha_fin ='$fecha_fin' and cuenta='$cuenta'  ";
		$re = $cx->query($sq);
		while($rw = $re->fetch_assoc()) 
		{
		$saldo_extracto=$rw["saldo_extracto"];
		}//printf(" nom_rubro : $nom_rubro<br>");
}
else
{
		$saldo_extracto=str_replace(',','',$_POST['saldo']);
}

//menos un mes

$a = date("Y", strtotime($fecha_fin)); 
$b = date("m", strtotime($fecha_fin)); 
$c = date("d", strtotime($fecha_fin)); 
$bis = esBisiesto($a);
if ($bis ==1) $feb= $anio.'/02/29'; else $feb = $anio.'/02/28';


// dias calendario
if ($bis ==1)
{
$ene=31;$feb=29;$mar=31;$abr=30;$may=31;$jun=30;$jul=31;$ago=31;$sep=30;$oct=31;$nov=30;$dic=31;
}else{
$ene=31;$feb=28;$mar=31;$abr=30;$may=31;$jun=30;$jul=31;$ago=31;$sep=30;$oct=31;$nov=30;$dic=31;
}
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
$tsl;
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

//** generacion de libro aux
//** variables para el aux
$fecha_ini=$fecha_mes_ant;

$nn=$cuenta;
//*****


//********************************************
//********************************************
//********************************************
?>
      <br />
      <?php
//********************************************
//********************************************
//********************************************
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);




//********* ano e id_emp
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{

$idxx=$rowxx["id_emp"];
$id_emp=$rowxx["id_emp"];
$ano=$rowxx["ano"];

}


$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = $connectionxx->query($sqlxx3);

while($rowxx3 = $resultadoxx3->fetch_assoc()) 
   {
   $fecha_ini_op=$rowxx3["fecha_ini_op"];
   }  
//*********
//***** llegada de variables _GET
//$fecha_ini=$_GET['fecha_ini'];
//$fecha_fin=$_GET['fecha_fin'];
//$nn=$_GET['nn'];
//***** resta de 1 dia para fechas de calculo de saldo inicial

// restar 1 a la fecha inicial
$ts11 = strtotime($fecha_ini);
$tsa = strtotime('-1 day',$ts11);
$aux_fecha=date('Y/m/d', $tsa);



// restar 1 a la fecha final
$ts1 = strtotime($fecha_fin);
$ts = strtotime('-1 day',$ts1);
$hasta=date('Y/m/d', $ts);
//***** nombre del rubro para titulo
$ss22 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$nn'";
$rr22 = mysql_db_query($database, $ss22, $connectionxx);
while($rrw22 = mysql_fetch_array($rr22)) 
{
  $nom_rubro=$rrw22["nom_rubro"];
}
/*LAS CUENTAS QUE INICIAN CON : 1,5,6,7 Y 8 SON DE SALDO DEBITO
LAS CUENTAS QUE INICIAN CON : 2,3,4 Y 9 SON DE SALDO CREDITO*/

//******* naturaleza de la cuenta
$nat1 = substr($nn,0,1);

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

//************** extraccion del sico

$ss22a = "select * from sico where cuenta = '$nn'";
$rr22a = mysql_db_query($database, $ss22a, $connectionxx);
while($rrw22a = mysql_fetch_array($rr22a)) 
{
  $sico_d=$rrw22a["debito"];
  $sico_c=$rrw22a["credito"];
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
			$sq1 = "select * from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' )  and cuenta = '$nn' order by fecha asc ";
			$re1 = mysql_db_query($database, $sq1, $cx1);
			
			while($rw1 = mysql_fetch_array($re1)) 
			{
			   $cta_aux=$rw1["cuenta"];
			   
					//if($cta_aux == $nn)
					//{
						$acu_deb=$acu_deb+$rw1["debito"];
						$acu_cre=$acu_cre+$rw1["credito"];
						$saldo_inicial=$sico_d + $acu_deb - $acu_cre;	
							
					//}		
						
			}//fin while
		
		}
		else
		{
		
			$saldo_inicial=$sico_c;	
			$acu_deb=0;
			$acu_cre=0;
			
			$cx1 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
			//$sq1 = "select * from lib_aux where (fecha between '$fecha_ini_op' and '$hasta' ) order by fecha asc ";
			$sq1 = "select * from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' )  and cuenta = '$nn' order by fecha asc ";
			$re1 = mysql_db_query($database, $sq1, $cx1);
			
			while($rw1 = mysql_fetch_array($re1)) 
			{
			   $cta_aux=$rw1["cuenta"];
			   
					//if($cta_aux == $nn)
					//{
						$acu_deb=$acu_deb+$rw1["debito"];
						$acu_cre=$acu_cre+$rw1["credito"];
						$saldo_inicial=$sico_c - $acu_deb + $acu_cre;
					print ("saldo credito");		 
					//}		
						
			}//fin while
		    
			
		}

		
}//fin else

//****************
//**** variables para totalizar saldos
$total_debitos=0;
$total_creditos=0;
//***

//****** carga aux_conciliaciones de vrs obtenidos en lib_aux ************************************************************    MOVIMIENTOS DEL MES
	
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$nn' order by fecha asc ";
$re = $cx->query($sq);

if ( (mysql_num_rows($re) == 0) ){ // graba el saldo en extracto cuando la cuenta no tinen movimiento en le mes.

		$sqls = "select * from aux_conciliaciones where fecha_fin='$fecha_fin' and cuenta = '$nn'";
				$results = mysql_query($sqls, $cx) or die(mysql_error());
				if (mysql_num_rows($results) == 0)
				{
	
				$sql = "INSERT INTO aux_conciliaciones
				 (fecha_fin,saldo_extracto,cuenta,nom_rubro,fecha,dcto,tercero,cheque,debito,credito,estado,flag1,flag2) 
				VALUES
				('$fecha_fin','$saldo_extracto','$nn','$nom_rubro','$fecha_fin','NA',
				'NA','NA','0','0','','0','0')";
				$cx->query($sql) or die(mysql_error());
				
				}else{ 
				$sql = "update aux_conciliaciones set saldo_extracto='$saldo_extracto',nom_rubro='$nom_rubro'
				where fecha_fin='$fecha_fin' and cuenta = '$nn'";
				$results= $cx->query($sql);
				}
			
}else{

$saldo=$saldo_inicial;

while($rw = $re->fetch_assoc()) 
{
		// consulta de numero de cheques
		
		$var1=$rw["dcto"];
		
					$ss2a = "select * from conta_cesp where id_manu_ncon = '$var1'";
					$rr2a = mysql_db_query($database, $ss2a, $cx);
					while($rrw2a = mysql_fetch_array($rr2a)) 
					{
					  $cheque_conta_cesp1=$rrw2a["cheque1"]; 					  $cheque_conta_cesp2=$rrw2a["cheque2"];
					  $cheque_conta_cesp3=$rrw2a["cheque3"]; 					  $cheque_conta_cesp4=$rrw2a["cheque4"];
					  $cheque_conta_cesp5=$rrw2a["cheque5"]; 					  $cheque_conta_cesp6=$rrw2a["cheque6"];
					  $cheque_conta_cesp7=$rrw2a["cheque7"]; 					  $cheque_conta_cesp8=$rrw2a["cheque8"];
					  $cheque_conta_cesp9=$rrw2a["cheque9"]; 					  $cheque_conta_cesp10=$rrw2a["cheque10"];
					  $cheque_conta_cesp11=$rrw2a["cheque11"]; 					  $cheque_conta_cesp12=$rrw2a["cheque12"];
					  $cheque_conta_cesp13=$rrw2a["cheque13"]; 					  $cheque_conta_cesp14=$rrw2a["cheque14"];
					  $cheque_conta_cesp15=$rrw2a["cheque15"]; 
  
				    }
					
					if($cheque_conta_cesp1 == ''){$cheque_conta_cesp1 ='/';}
					if($cheque_conta_cesp2 == ''){$cheque_conta_cesp2 ='/';}
					if($cheque_conta_cesp3 == ''){$cheque_conta_cesp3 ='/';}
					if($cheque_conta_cesp4 == ''){$cheque_conta_cesp4 ='/';}
					if($cheque_conta_cesp5 == ''){$cheque_conta_cesp5 ='/';}
					if($cheque_conta_cesp6 == ''){$cheque_conta_cesp6 ='/';}
					if($cheque_conta_cesp7 == ''){$cheque_conta_cesp7 ='/';}
					if($cheque_conta_cesp8 == ''){$cheque_conta_cesp8 ='/';}
					if($cheque_conta_cesp9 == ''){$cheque_conta_cesp9 ='/';}
					if($cheque_conta_cesp10 == ''){$cheque_conta_cesp10 ='/';}
					if($cheque_conta_cesp11 == ''){$cheque_conta_cesp11 ='/';}
					if($cheque_conta_cesp12 == ''){$cheque_conta_cesp12 ='/';}
					if($cheque_conta_cesp13 == ''){$cheque_conta_cesp13 ='/';}
					if($cheque_conta_cesp14 == ''){$cheque_conta_cesp14 ='/';}
					if($cheque_conta_cesp15 == ''){$cheque_conta_cesp15 ='/';}
					
					$cheque_fin_cesp = $cheque_conta_cesp1.$cheque_conta_cesp2.$cheque_conta_cesp3.$cheque_conta_cesp4.$cheque_conta_cesp5.$cheque_conta_cesp6.$cheque_conta_cesp7.$cheque_conta_cesp8.$cheque_conta_cesp9.$cheque_conta_cesp10.$cheque_conta_cesp11.$cheque_conta_cesp12.$cheque_conta_cesp13.$cheque_conta_cesp14.$cheque_conta_cesp15;
					
					$cheque_fin_cesp = $cheque_fin_cesp;
					$cheque_fin_cesp=eregi_replace('[/]', '', $cheque_fin_cesp);
					
					
					$ss2 = "select * from cecp where id_manu_cecp = '$var1'";
					$rr2 = mysql_db_query($database, $ss2, $cx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $num_cheque_cecp1=$rrw2["num_cheque"]; 					  $num_cheque_cecp2=$rrw2["num_cheque2"];
					  $num_cheque_cecp3=$rrw2["num_cheque3"]; 					  $num_cheque_cecp4=$rrw2["num_cheque4"];
					  $num_cheque_cecp5=$rrw2["num_cheque5"]; 					  $num_cheque_cecp6=$rrw2["num_cheque6"];
					  $num_cheque_cecp7=$rrw2["num_cheque7"]; 					  $num_cheque_cecp8=$rrw2["num_cheque8"];
					  $num_cheque_cecp9=$rrw2["num_cheque9"]; 					  $num_cheque_cecp10=$rrw2["num_cheque10"];
					  $num_cheque_cecp11=$rrw2["num_cheque11"]; 					  $num_cheque_cecp12=$rrw2["num_cheque12"];
					  $num_cheque_cecp13=$rrw2["num_cheque13"]; 					  $num_cheque_cecp14=$rrw2["num_cheque14"];
					  $num_cheque_cecp15=$rrw2["num_cheque15"]; 
					}		
					
					if($num_cheque_cecp1 == ''){$num_cheque_cecp1 ='/';}
					if($num_cheque_cecp2 == ''){$num_cheque_cecp2 ='/';}
					if($num_cheque_cecp3 == ''){$num_cheque_cecp3 ='/';}
					if($num_cheque_cecp4 == ''){$num_cheque_cecp4 ='/';}
					if($num_cheque_cecp5 == ''){$num_cheque_cecp5 ='/';}
					if($num_cheque_cecp6 == ''){$num_cheque_cecp6 ='/';}
					if($num_cheque_cecp7 == ''){$num_cheque_cecp7 ='/';}
					if($num_cheque_cecp8 == ''){$num_cheque_cecp8 ='/';}
					if($num_cheque_cecp9 == ''){$num_cheque_cecp9 ='/';}
					if($num_cheque_cecp10 == ''){$num_cheque_cecp10 ='/';}
					if($num_cheque_cecp11 == ''){$num_cheque_cecp11 ='/';}
					if($num_cheque_cecp12 == ''){$num_cheque_cecp12 ='/';}
					if($num_cheque_cecp13 == ''){$num_cheque_cecp13 ='/';}
					if($num_cheque_cecp14 == ''){$num_cheque_cecp14 ='/';}
					if($num_cheque_cecp15 == ''){$num_cheque_cecp15 ='/';}
					
					$cheque_fin_cecp = $num_cheque_cecp1.$num_cheque_cecp2.$num_cheque_cecp3.$num_cheque_cecp4.$num_cheque_cecp5.$num_cheque_cecp6.$num_cheque_cecp7.$num_cheque_cecp8.$num_cheque_cecp9.$num_cheque_cecp10.$num_cheque_cecp11.$num_cheque_cecp12.$num_cheque_cecp13.$num_cheque_cecp14.$num_cheque_cecp15;
					
					$cheque_fin_cecp = $cheque_fin_cecp;
					$cheque_fin_cecp=eregi_replace('[/]', '', $cheque_fin_cecp);
					
					$ss2 = "select * from ceva where id_manu_ceva = '$var1'";
					$rr2 = mysql_db_query($database, $ss2, $cx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $num_cheque_ceva1=$rrw2["num_cheque"]; 					  $num_cheque_ceva2=$rrw2["num_cheque2"];
					  $num_cheque_ceva3=$rrw2["num_cheque3"]; 					  $num_cheque_ceva4=$rrw2["num_cheque4"];
					  $num_cheque_ceva5=$rrw2["num_cheque5"]; 					  $num_cheque_ceva6=$rrw2["num_cheque6"];
					  $num_cheque_ceva7=$rrw2["num_cheque7"]; 					  $num_cheque_ceva8=$rrw2["num_cheque8"];
					  $num_cheque_ceva9=$rrw2["num_cheque9"]; 					  $num_cheque_ceva10=$rrw2["num_cheque10"];
					  $num_cheque_ceva11=$rrw2["num_cheque11"]; 					  $num_cheque_ceva12=$rrw2["num_cheque12"];
					  $num_cheque_ceva13=$rrw2["num_cheque13"]; 					  $num_cheque_ceva14=$rrw2["num_cheque14"];
					  $num_cheque_ceva15=$rrw2["num_cheque15"]; 
					}	
					
					
					if($num_cheque_ceva1 == ''){$num_cheque_ceva1 ='/';}
					if($num_cheque_ceva2 == ''){$num_cheque_ceva2 ='/';}
					if($num_cheque_ceva3 == ''){$num_cheque_ceva3 ='/';}
					if($num_cheque_ceva4 == ''){$num_cheque_ceva4 ='/';}
					if($num_cheque_ceva5 == ''){$num_cheque_ceva5 ='/';}
					if($num_cheque_ceva6 == ''){$num_cheque_ceva6 ='/';}
					if($num_cheque_ceva7 == ''){$num_cheque_ceva7 ='/';}
					if($num_cheque_ceva8 == ''){$num_cheque_ceva8 ='/';}
					if($num_cheque_ceva9 == ''){$num_cheque_ceva9 ='/';}
					if($num_cheque_ceva10 == ''){$num_cheque_ceva10 ='/';}
					if($num_cheque_ceva11 == ''){$num_cheque_ceva11 ='/';}
					if($num_cheque_ceva12 == ''){$num_cheque_ceva12 ='/';}
					if($num_cheque_ceva13 == ''){$num_cheque_ceva13 ='/';}
					if($num_cheque_ceva14 == ''){$num_cheque_ceva14 ='/';}
					if($num_cheque_ceva15 == ''){$num_cheque_ceva15 ='/';}
					
					$cheque_fin_ceva = $num_cheque_ceva1.$num_cheque_ceva2.$num_cheque_ceva3.$num_cheque_ceva4.$num_cheque_ceva5.$num_cheque_ceva6.$num_cheque_ceva7.$num_cheque_ceva8.$num_cheque_ceva9.$num_cheque_ceva10.$num_cheque_ceva11.$num_cheque_ceva12.$num_cheque_ceva13.$num_cheque_ceva14.$num_cheque_ceva15;
					
					$cheque_fin_ceva = $cheque_fin_ceva;
					$cheque_fin_ceva=eregi_replace('[/]', '', $cheque_fin_ceva);
					
					$ss2 = "select * from conta_ncsp where id_manu_ncon = '$var1'";
					$rr2 = mysql_db_query($database, $ss2, $cx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $cheque_conta_ncsp1=$rrw2["cheque1"]; 					  $cheque_conta_ncsp2=$rrw2["cheque2"];
					  $cheque_conta_ncsp3=$rrw2["cheque3"]; 					  $cheque_conta_ncsp4=$rrw2["cheque4"];
					  $cheque_conta_ncsp5=$rrw2["cheque5"]; 					  $cheque_conta_ncsp6=$rrw2["cheque6"];
					  $cheque_conta_ncsp7=$rrw2["cheque7"]; 					  $cheque_conta_ncsp8=$rrw2["cheque8"];
					  $cheque_conta_ncsp9=$rrw2["cheque9"]; 					  $cheque_conta_ncsp10=$rrw2["cheque10"];
					  $cheque_conta_ncsp11=$rrw2["cheque11"]; 					  $cheque_conta_ncsp12=$rrw2["cheque12"];
					  $cheque_conta_ncsp13=$rrw2["cheque13"]; 					  $cheque_conta_ncsp14=$rrw2["cheque14"];
					  $cheque_conta_ncsp15=$rrw2["cheque15"]; 
					}
					
					if($cheque_conta_ncsp1 == ''){$cheque_conta_ncsp1 ='/';}
					if($cheque_conta_ncsp2 == ''){$cheque_conta_ncsp2 ='/';}
					if($cheque_conta_ncsp3 == ''){$cheque_conta_ncsp3 ='/';}
					if($cheque_conta_ncsp4 == ''){$cheque_conta_ncsp4 ='/';}
					if($cheque_conta_ncsp5 == ''){$cheque_conta_ncsp5 ='/';}
					if($cheque_conta_ncsp6 == ''){$cheque_conta_ncsp6 ='/';}
					if($cheque_conta_ncsp7 == ''){$cheque_conta_ncsp7 ='/';}
					if($cheque_conta_ncsp8 == ''){$cheque_conta_ncsp8 ='/';}
					if($cheque_conta_ncsp9 == ''){$cheque_conta_ncsp9 ='/';}
					if($cheque_conta_ncsp10 == ''){$cheque_conta_ncsp10 ='/';}
					if($cheque_conta_ncsp11 == ''){$cheque_conta_ncsp11 ='/';}
					if($cheque_conta_ncsp12 == ''){$cheque_conta_ncsp12 ='/';}
					if($cheque_conta_ncsp13 == ''){$cheque_conta_ncsp13 ='/';}
					if($cheque_conta_ncsp14 == ''){$cheque_conta_ncsp14 ='/';}
					if($cheque_conta_ncsp15 == ''){$cheque_conta_ncsp15 ='/';}
					
					$cheque_fin_ncsp = $cheque_conta_ncsp1.$cheque_conta_ncsp2.$cheque_conta_ncsp3.$cheque_conta_ncsp4.$cheque_conta_ncsp5.$cheque_conta_ncsp6.$cheque_conta_ncsp7.$cheque_conta_ncsp8.$cheque_conta_ncsp9.$cheque_conta_ncsp10.$cheque_conta_ncsp11.$cheque_conta_ncsp12.$cheque_conta_ncsp13.$cheque_conta_ncsp14.$cheque_conta_ncsp15;
					
					$cheque_fin_ncsp = $cheque_fin_ncsp;
					$cheque_fin_ncsp=eregi_replace('[/]', '', $cheque_fin_ncsp);
					
					$ss2 = "select * from conta_ndsp where id_manu_ncon = '$var1'";
					$rr2 = mysql_db_query($database, $ss2, $cx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $cheque_conta_ndsp1=$rrw2["cheque1"]; 					  $cheque_conta_ndsp2=$rrw2["cheque2"];
					  $cheque_conta_ndsp3=$rrw2["cheque3"]; 					  $cheque_conta_ndsp4=$rrw2["cheque4"];
					  $cheque_conta_ndsp5=$rrw2["cheque5"]; 					  $cheque_conta_ndsp6=$rrw2["cheque6"];
					  $cheque_conta_ndsp7=$rrw2["cheque7"]; 					  $cheque_conta_ndsp8=$rrw2["cheque8"];
					  $cheque_conta_ndsp9=$rrw2["cheque9"]; 					  $cheque_conta_ndsp10=$rrw2["cheque10"];
					  $cheque_conta_ndsp11=$rrw2["cheque11"]; 					  $cheque_conta_ndsp12=$rrw2["cheque12"];
					  $cheque_conta_ndsp13=$rrw2["cheque13"]; 					  $cheque_conta_ndsp14=$rrw2["cheque14"];
					  $cheque_conta_ndsp15=$rrw2["cheque15"]; 
					}	
					
					
					if($cheque_conta_ndsp1 == ''){$cheque_conta_ndsp1 ='/';}
					if($cheque_conta_ndsp2 == ''){$cheque_conta_ndsp2 ='/';}
					if($cheque_conta_ndsp3 == ''){$cheque_conta_ndsp3 ='/';}
					if($cheque_conta_ndsp4 == ''){$cheque_conta_ndsp4 ='/';}
					if($cheque_conta_ndsp5 == ''){$cheque_conta_ndsp5 ='/';}
					if($cheque_conta_ndsp6 == ''){$cheque_conta_ndsp6 ='/';}
					if($cheque_conta_ndsp7 == ''){$cheque_conta_ndsp7 ='/';}
					if($cheque_conta_ndsp8 == ''){$cheque_conta_ndsp8 ='/';}
					if($cheque_conta_ndsp9 == ''){$cheque_conta_ndsp9 ='/';}
					if($cheque_conta_ndsp10 == ''){$cheque_conta_ndsp10 ='/';}
					if($cheque_conta_ndsp11 == ''){$cheque_conta_ndsp11 ='/';}
					if($cheque_conta_ndsp12 == ''){$cheque_conta_ndsp12 ='/';}
					if($cheque_conta_ndsp13 == ''){$cheque_conta_ndsp13 ='/';}
					if($cheque_conta_ndsp14 == ''){$cheque_conta_ndsp14 ='/';}
					if($cheque_conta_ndsp15 == ''){$cheque_conta_ndsp15 ='/';}
					
					$cheque_fin_ndsp = $cheque_conta_ndsp1.$cheque_conta_ndsp2.$cheque_conta_ndsp3.$cheque_conta_ndsp4.$cheque_conta_ndsp5.$cheque_conta_ndsp6.$cheque_conta_ndsp7.$cheque_conta_ndsp8.$cheque_conta_ndsp9.$cheque_conta_ndsp10.$cheque_conta_ndsp11.$cheque_conta_ndsp12.$cheque_conta_ndsp13.$cheque_conta_ndsp14.$cheque_conta_ndsp15;
					
					$cheque_fin_ndsp = $cheque_fin_ndsp;
					$cheque_fin_ndsp=eregi_replace('[/]', '', $cheque_fin_ndsp);
					
					
					$ss2 = "select * from conta_tfin where id_manu_ncon = '$var1'";
					$rr2 = mysql_db_query($database, $ss2, $cx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $cheque_conta_tfin1=$rrw2["cheque1"]; 					  $cheque_conta_tfin2=$rrw2["cheque2"];
					  $cheque_conta_tfin3=$rrw2["cheque3"]; 					  $cheque_conta_tfin4=$rrw2["cheque4"];
					  $cheque_conta_tfin5=$rrw2["cheque5"]; 					  $cheque_conta_tfin6=$rrw2["cheque6"];
					  $cheque_conta_tfin7=$rrw2["cheque7"]; 					  $cheque_conta_tfin8=$rrw2["cheque8"];
					  $cheque_conta_tfin9=$rrw2["cheque9"]; 					  $cheque_conta_tfin10=$rrw2["cheque10"];
					  $cheque_conta_tfin11=$rrw2["cheque11"]; 					  $cheque_conta_tfin12=$rrw2["cheque12"];
					  $cheque_conta_tfin13=$rrw2["cheque13"]; 					  $cheque_conta_tfin14=$rrw2["cheque14"];
					  $cheque_conta_tfin15=$rrw2["cheque15"]; 
					}	
					
					if($cheque_conta_tfin1 == ''){$cheque_conta_tfin1 ='/';}
					if($cheque_conta_tfin2 == ''){$cheque_conta_tfin2 ='/';}
					if($cheque_conta_tfin3 == ''){$cheque_conta_tfin3 ='/';}
					if($cheque_conta_tfin4 == ''){$cheque_conta_tfin4 ='/';}
					if($cheque_conta_tfin5 == ''){$cheque_conta_tfin5 ='/';}
					if($cheque_conta_tfin6 == ''){$cheque_conta_tfin6 ='/';}
					if($cheque_conta_tfin7 == ''){$cheque_conta_tfin7 ='/';}
					if($cheque_conta_tfin8 == ''){$cheque_conta_tfin8 ='/';}
					if($cheque_conta_tfin9 == ''){$cheque_conta_tfin9 ='/';}
					if($cheque_conta_tfin10 == ''){$cheque_conta_tfin10 ='/';}
					if($cheque_conta_tfin11 == ''){$cheque_conta_tfin11 ='/';}
					if($cheque_conta_tfin12 == ''){$cheque_conta_tfin12 ='/';}
					if($cheque_conta_tfin13 == ''){$cheque_conta_tfin13 ='/';}
					if($cheque_conta_tfin14 == ''){$cheque_conta_tfin14 ='/';}
					if($cheque_conta_tfin15 == ''){$cheque_conta_tfin15 ='/';}
					
					$cheque_fin_tfin = $cheque_conta_tfin1.$cheque_conta_tfin2.$cheque_conta_tfin3.$cheque_conta_tfin4.$cheque_conta_tfin5.$cheque_conta_tfin6.$cheque_conta_tfin7.$cheque_conta_tfin8.$cheque_conta_tfin9.$cheque_conta_tfin10.$cheque_conta_tfin11.$cheque_conta_tfin12.$cheque_conta_tfin13.$cheque_conta_tfin14.$cheque_conta_tfin15;
					
					$cheque_fin_tfin = $cheque_fin_tfin;
					$cheque_fin_tfin=eregi_replace('[/]', '', $cheque_fin_tfin);
					
					$ss2 = "select * from conta_coba where id_manu_ncon = '$var1'";
					$rr2 = mysql_db_query($database, $ss2, $cx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $cheque_conta_coba1=$rrw2["cheque1"]; 					  $cheque_conta_coba2=$rrw2["cheque2"];
					  $cheque_conta_coba3=$rrw2["cheque3"]; 					  $cheque_conta_coba4=$rrw2["cheque4"];
					  $cheque_conta_coba5=$rrw2["cheque5"]; 					  $cheque_conta_coba6=$rrw2["cheque6"];
					  $cheque_conta_coba7=$rrw2["cheque7"]; 					  $cheque_conta_coba8=$rrw2["cheque8"];
					  $cheque_conta_coba9=$rrw2["cheque9"]; 					  $cheque_conta_coba10=$rrw2["cheque10"];
					  $cheque_conta_coba11=$rrw2["cheque11"]; 					  $cheque_conta_coba12=$rrw2["cheque12"];
					  $cheque_conta_coba13=$rrw2["cheque13"]; 					  $cheque_conta_coba14=$rrw2["cheque14"];
					  $cheque_conta_coba15=$rrw2["cheque15"]; 
					}		
					
					
					if($cheque_conta_coba1 == ''){$cheque_conta_coba1 ='/';}
					if($cheque_conta_coba2 == ''){$cheque_conta_coba2 ='/';}
					if($cheque_conta_coba3 == ''){$cheque_conta_coba3 ='/';}
					if($cheque_conta_coba4 == ''){$cheque_conta_coba4 ='/';}
					if($cheque_conta_coba5 == ''){$cheque_conta_coba5 ='/';}
					if($cheque_conta_coba6 == ''){$cheque_conta_coba6 ='/';}
					if($cheque_conta_coba7 == ''){$cheque_conta_coba7 ='/';}
					if($cheque_conta_coba8 == ''){$cheque_conta_coba8 ='/';}
					if($cheque_conta_coba9 == ''){$cheque_conta_coba9 ='/';}
					if($cheque_conta_coba10 == ''){$cheque_conta_coba10 ='/';}
					if($cheque_conta_coba11 == ''){$cheque_conta_coba11 ='/';}
					if($cheque_conta_coba12 == ''){$cheque_conta_coba12 ='/';}
					if($cheque_conta_coba13 == ''){$cheque_conta_coba13 ='/';}
					if($cheque_conta_coba14 == ''){$cheque_conta_coba14 ='/';}
					if($cheque_conta_coba15 == ''){$cheque_conta_coba15 ='/';}
					
					$cheque_fin_coba = $cheque_conta_coba1.$cheque_conta_coba2.$cheque_conta_coba3.$cheque_conta_coba4.$cheque_conta_coba5.$cheque_conta_coba6.$cheque_conta_coba7.$cheque_conta_coba8.$cheque_conta_coba9.$cheque_conta_coba10.$cheque_conta_coba11.$cheque_conta_coba12.$cheque_conta_coba13.$cheque_conta_coba14.$cheque_conta_coba15;
					
					$cheque_fin_coba = $cheque_fin_coba;
					$cheque_fin_coba=eregi_replace('[/]', '', $cheque_fin_coba);
		
		// inicio de impresion
		$fecha_fina=$fecha_fin;
		$saldo_extractoa=$saldo_extracto;
		$cuentaa=$cuenta;
		$nom_rubroa=$nom_rubro;
		$fechaa=$rw["fecha"];
		$dctoa=$rw["dcto"];
		$ccnit=$rw["ccnit"];
		$x1=$rw["tercero"];
		$terceroa = ereg_replace("[^A-Za-z0-9]", " ", $x1);
		$terceroa = $terceroa . " - " . $ccnit;
		$ax1 = $rw["dcto"];
		$a = substr($ax1,0,4);
		//**** dctos sin cheque
		if( $a == 'OBCG'){$chequea = '';}
		if( $a == 'CAIC'){$chequea = '';}
		if( $a == 'COBP'){$chequea = '';}
		if( $a == 'NCON'){$chequea = '';}
		if( $a == 'CRPP'){$chequea = '';}
		if( $a == 'NCBT'){$chequea = '';}
		if( $a == 'RCGT'){$chequea = '';}
		if( $a == 'ROIT'){$chequea = '';}
		if( $a == 'TNAT'){$chequea = '';}
		///* documentos con cheque
		if($a == 'CESP'){$chequea = $cheque_fin_cesp;}
		if($a == 'CECP'){$chequea = $cheque_fin_cecp;}
		if($a == 'CEVA'){$chequea = $cheque_fin_ceva;}
		if($a == 'NCSP'){$chequea = $cheque_fin_ncsp;}
		if($a == 'NDSP'){$chequea = $cheque_fin_ndsp;}
		if($a == 'TFIN'){$chequea = $cheque_fin_tfin;}
		if($a == 'COBA'){$chequea = $cheque_fin_coba;}


		$debitoa=$rw["debito"];
		$creditoa=$rw["credito"];
		$estadoa='NO';
		$flag1='0';
		$flag2='0';
		$consecutivo =$rw['id_cons'];

		$total_debitos=$total_debitos+$rw["debito"];
		$total_creditos=$total_creditos+$rw["credito"];
		
 // $sqlsx = "select * from lib_aux where  cuenta = '$cuentaa' and dcto='$dctoa' and debito='$debitoa' and credito='$creditoa' and id_cons ='$consecutivo'";
  $sqlsx = "select * from lib_aux where  cuenta = '$cuentaa' and dcto='$dctoa' and id_cons ='$consecutivo' and (fecha between '$fecha_ini' and '$fecha_fin') ";
  //echo  $sqlsx ."<br>";
				$rex = mysql_query($sqlsx, $cx) or die(mysql_error());
				$reg_lib_aux = mysql_num_rows($rex);
  // $sqls = "select * from aux_conciliaciones where fecha_fin='$fecha_fina' and cuenta = '$cuentaa' and dcto='$dctoa' and debito='$debitoa' and credito='$creditoa' and consecutivo ='$consecutivo'";
  $sqls = "select * from aux_conciliaciones where fecha_fin='$fecha_fina' and cuenta = '$cuentaa' and dcto='$dctoa' and consecutivo ='$consecutivo'";
  //echo  $sqls ."<br>";
				$results = mysql_query($sqls, $cx) or die(mysql_error());
				$reg_aux_conci = mysql_num_rows($results);
				//if (mysql_num_rows($results) == 0)
				if ($reg_aux_conci > $reg_lib_aux) 
					{
						$sq3 = "delete from aux_conciliaciones where dcto='$dctoa' and consecutivo = '$consecutivo' ";
						$rs3 = mysql_db_query($database, $sq3, $cx);
					}
				
				if ($reg_aux_conci < $reg_lib_aux)
				{
					$sql = "INSERT INTO aux_conciliaciones
					 (consecutivo,fecha_fin,saldo_extracto,cuenta,nom_rubro,fecha,dcto,tercero,cheque,debito,credito,estado,flag1,flag2) 
					VALUES
					('$consecutivo','$fecha_fina','$saldo_extractoa','$cuentaa','$nom_rubroa','$fechaa','$dctoa',
					'$terceroa','$chequea','$debitoa','$creditoa','$estadoa','$flag1','$flag2')";
					$resultado = $cx->query($sql);
				
				}
				else
				{
					$sql = "update aux_conciliaciones set consecutivo='$consecutivo',cheque='$chequea',debito='$debitoa',credito='$creditoa', nom_rubro='$nom_rubro'
					where fecha_fin='$fecha_fina' and cuenta = '$cuentaa' and dcto='$dctoa' and consecutivo = '$consecutivo'  ";
					$resultado = $cx->query($sql);
				}
			$chequea='';
		//}
}//fin while	
}
		if($naturaleza == 'DEBITO')
		{
		$saldo_final = $saldo_inicial + $total_debitos - $total_creditos;
		}
		else
		{
		$saldo_final = $saldo_inicial - $total_debitos + $total_creditos;
		}


$sql = "update aux_conciliaciones set saldo_extracto ='$saldo_extractoa' , total_debitos='$total_debitos', total_creditos='$total_creditos', saldo_final='$saldo_final', saldo_inicial='$saldo_inicial' where fecha_fin='$fecha_fina' and cuenta = '$cuentaa' ";
$resultado = $cx->query($sql);

$sq4 ="select consecutivo,dcto from aux_conciliaciones";
$re4 = mysql_db_query($database, $sq4, $cx);
while($rw4 = mysql_fetch_array($re4)) 
{
	$sq41 = "select id_cons from lib_aux where id_cons ='$rw4[consecutivo]' and dcto ='$rw4[dcto]'";
	$re41 = mysql_db_query($database, $sq41, $cx);
	$fi41 = mysql_num_rows($re41);
	if ($fi41 ==0)
	{
		$sq3 = "delete from aux_conciliaciones where dcto='$rw4[dcto]' and consecutivo = '$rw4[consecutivo]' and dcto != 'NA' ";
		$rs3 = mysql_db_query($database, $sq3, $cx);
		}
}


//***********************




?>


<?php

include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

$sql = "DELETE FROM aux_conciliaciones where (fecha_fin = '2010/01/') or (fecha_fin = '2010/02/') or (fecha_fin = '2010/03/') or (fecha_fin = '2010/04/') or (fecha_fin = '2010/05/') or (fecha_fin = '2010/06/') or (fecha_fin = '2010/07/') or (fecha_fin = '2010/08/') or (fecha_fin = '2010/09/') or (fecha_fin = '2010/10/') or (fecha_fin = '2010/11/') or (fecha_fin = '2010/12/')";
mysql_db_query($base, $sql, $conexion) or die(mysql_error());




$sql = "select * from aux_conciliaciones where estado='SI'";
$result = mysql_query($sql, $conexion) or die(mysql_error());
if (mysql_num_rows($result) == 0)
{
}
else
{
	$sqlxx = "select * from aux_conciliaciones where estado='SI'";
	$resultadoxx =$conexion->query($sqlxx);
	while($rowxx = $resultadoxx->fetch_assoc()) 
	{
	  $cuentaxx=$rowxx["cuenta"];
	  $dctoxx=$rowxx["dcto"];
	  
			$sql = "select * from aux_conciliaciones where estado='NO' and cuenta = '$cuentaxx' and dcto = '$dctoxx'";
			$result = mysql_query($sql, $conexion) or die(mysql_error());
			if (mysql_num_rows($result) == 0)
			{
			}
			else
			{
				mysql_db_query($base, $sql, $conexion) or die(mysql_error());
			}
	}

}

$sql = "select * from aux_conciliaciones where estado='NO'";
$result = mysql_query($sql, $conexion) or die(mysql_error());
if (mysql_num_rows($result) == 0)
{
}
else
{
	$sqlxx = "select * from aux_conciliaciones where estado='NO'";
	$resultadoxx =$conexion->query($sqlxx);
	while($rowxx = $resultadoxx->fetch_assoc()) 
	{
	  
	  $cuentaxx=$rowxx["cuenta"];
	  $dctoxx=$rowxx["dcto"];
	  $fechaxx=$rowxx["fecha"];
	  $fecha_finxx=$rowxx["fecha_fin"];
	  $fechaxx1 = substr($fechaxx,0,7);
	  $fechaxx2 = substr($fecha_finxx,0,7);

			if ($fechaxx1 == $fechaxx2)
			{
			}
			else
			{
				$sql = "DELETE FROM aux_conciliaciones where estado='NO' and cuenta = '$cuentaxx' and dcto = '$dctoxx' and fecha = '$fechaxx' and fecha_fin = '$fecha_finxx'";
				mysql_db_query($base, $sql, $conexion) or die(mysql_error());
			}
	}

} 

$sql = "select * from aux_conciliaciones where estado='SI'";
$result = mysql_query($sql, $conexion) or die(mysql_error());
if (mysql_num_rows($result) == 0)
{
}
else
{
	$sqlxx = "select * from aux_conciliaciones where estado='SI'";
	$resultadoxx =$conexion->query($sqlxx);
	while($rowxx = $resultadoxx->fetch_assoc()) 
	{
	  
	  $cuentaxx=$rowxx["cuenta"];
	  $dctoxx=$rowxx["dcto"];
	  $fechaxx=$rowxx["fecha"];
	  $fecha_finxx=$rowxx["fecha_fin"];
	  $fecha_marcaxx=$rowxx["fecha_marca"];
	  $fechaxx1 = substr($fechaxx,0,7);
	  $fechaxx2 = substr($fecha_finxx,0,7);

			if ($fechaxx1 == $fechaxx2)
			{
			}
			else
			{
				$sql = "update aux_conciliaciones set estado='NO' where cuenta = '$cuentaxx' and dcto = '$dctoxx'";
				$resultado = mysql_db_query($database, $sql, $conexion);

			}
	}

} 


?>


<script type="text/javascript"> 
//window.location="conciliaciones3.php"; 
</script>
<br />
CONCILIACION BANCARIA ACTUALIZADA CON EXITO<br /><br /><br />
<form id="form1" name="form1" method="post">
<input type="hidden" name="fecha_fin" value="<?php printf("%s",$fecha_fin);?>" />
<input type="hidden" name="cuenta" value="<?php printf("%s",$cuenta);?>" />
<input type="hidden" name="nom_rubro" value="<?php printf("%s",$nom_rubro);?>" />
<input type="hidden" name="saldo_extracto" value="<?php printf("%s",$saldo_extracto);?>" />
<input type="hidden" name="saldo_inicial" value="<?php printf("%s",$saldo_inicial);?>" />
<input type="hidden" name="saldo_final" value="<?php printf("%s",$saldo_final);?>" />
  
  <br />
  <table width="200" border="0" align="center">
    <tr>
      <td><div align="center">
        <input name="Submit" type="submit" class="Estilo4" value="Continuar Conciliacion" onclick="this.form.action = 'conciliaciones3_m.php'" />
      </div></td>
      <td><div align="center"></div></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
    <tr>
      <td valign="middle"><div align="center">
        <input name="Submit" type="submit" class="Estilo4" value="Imprimir Conciliacion" onclick="this.form.action = 'imp_conciliacion.php'" />
      </div></td>
      <td><div align="center"></div></td>
    </tr>

  </table>

  <br />
<a href="#" id="mostrar"><center><span class="Estilo4"><b>MOSTRAR / OCULTAR LISTA DE CONCILIACIONES REALIZADAS HASTA LA FECHA</b></span></center></a>
<div id="caja">
<?php
//********************
//********************
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);


include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select distinct (fecha_fin), cuenta , saldo_extracto from aux_conciliaciones where cuenta = '$cuenta' order by cuenta asc ";
//$sq = "select distinct (fecha_fin), cuenta , saldo_extracto from aux_conciliaciones order by cuenta asc ";
$re = $cx->query($sq);

printf("
<center>

<table width='500' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' colspan='3'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'>ANTES DE CONTINUAR VERIFIQUE LOS SALDOS DE LOS EXTRACTOS <br>CREADOS HASTA LA FECHA<br><b><u>se muestran ordenados por cuenta</u></b></span>
</div>
</td>

</tr>


<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'>Fecha Corte Extracto</span>
</div>
</td>
<td align='center' width='200'><span class='Estilo4'>Cuenta</span></td>
<td align='center' width='150'><span class='Estilo4'>Saldo Extracto</span></td>
</tr>

");

while($rw = $re->fetch_assoc()) 
   {
printf("
<span class='Estilo4'>
<tr>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
</tr>"

, $rw["fecha_fin"],$rw["cuenta"], number_format($rw["saldo_extracto"],2,',','.')); 


   }

printf("</table></center>");
//--------	 
?>
</div>
  
</form>
 </div>
</div>
<br />
<div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:120px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='conciliaciones.php' target='_parent'>VOLVER </a> </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php
}
?>