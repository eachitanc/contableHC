<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
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


$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $fecha_ini_op=$rowxx3["fecha_ini_op"];
   }  
//*********
//***** llegada de variables _GET
$fecha_ini=$_GET['fecha_ini'];
$fecha_fin=$_GET['fecha_fin'];
$nn=$_GET['nn'];
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
  $nom_rubro22=$rrw22["nom_rubro"];
}
/*LAS CUENTAS QUE INICIAN CON : 1,5,6,7 Y 8 SON DE SALDO DEBITO
LAS CUENTAS QUE INICIAN CON : 2,3,4 Y 9 SON DE SALDO CREDITO*/

//******* naturaleza de la cuenta
$nat1 = substr($nn,0,4);

if($nat1 == '0202' or $nat1 == '0203' or $nat1 == '0204' or $nat1 == '0207' or $nat1 == '0208' or $nat1 == '0209' or $nat1 == '0213' or $nat1 == '0243' or $nat1 == '0252' or $nat1 == '0331' or $nat1 == '0332' or $nat1 == '0334' or $nat1 == '0335' or $nat1 == '0336' or $nat1 == '0337' or $nat1 == '0350' or $nat1 == '0351' or $nat1 == '0352' or $nat1 == '0353' or $nat1 == '0354' or $nat1 == '0355' or $nat1 == '0360' or $nat1 == '0361' or $nat1 == '0362' or $nat1 == '0363' or $nat1 == '0364' or $nat1 == '0365' or $nat1 == '0370' or $nat1 == '0371' or $nat1 == '0372' or $nat1 == '0373' or $nat1 == '0374' or $nat1 == '0375' or $nat1 == '0378' or $nat1 == '0399' or $nat1 == '0432' or $nat1 == '0434' or $nat1 == '0436' or $nat1 == '0438' or $nat1 == '0440' or $nat1 == '0442' or $nat1 == '0444' or $nat1 == '0446' or $nat1 == '0450' or $nat1 == '0555' or $nat1 == '0556' or $nat1 == '0557' or $nat1 == '0558' or $nat1 == '0559' or $nat1 == '0560' or $nat1 == '0561' or $nat1 == '0562' or $nat1 == '0563' or $nat1 == '0564' or $nat1 == '0565' or $nat1 == '0566' or $nat1 == '0567' or $nat1 == '0568' or $nat1 == '0569' or $nat1 == '0570' or $nat1 == '0571' or $nat1 == '0572' or $nat1 == '0630' or $nat1 == '0631' or $nat1 == '0632' or $nat1 == '0633' or $nat1 == '0634' or $nat1 == '0635' or $nat1 == '0636' or $nat1 == '0637' or $nat1 == '0638' or $nat1 == '0639' or $nat1 == '0640' or $nat1 == '0641' or $nat1 == '0642' or $nat1 == '0643' or $nat1 == '0644' or $nat1 == '0645' or $nat1 == '0646' or $nat1 == '0647' or $nat1 == '0655' or $nat1 == '0656' or $nat1 == '0657' or $nat1 == '0658' or $nat1 == '0659' or $nat1 == '0660' or $nat1 == '0661' or $nat1 == '0662' or $nat1 == '0663' or $nat1 == '0664' or $nat1 == '0665' or $nat1 == '0666' or $nat1 == '0667' or $nat1 == '0668' or $nat1 == '0669' or $nat1 == '0670' or $nat1 == '0671' or $nat1 == '0672' or $nat1 == '0730' or $nat1 == '0731' or $nat1 == '0732' or $nat1 == '0733' or $nat1 == '0734' or $nat1 == '0735' or $nat1 == '0736' or $nat1 == '0737' or $nat1 == '0738' or $nat1 == '0739' or $nat1 == '0740' or $nat1 == '0741' or $nat1 == '0742' or $nat1 == '0743' or $nat1 == '0744' or $nat1 == '0745' or $nat1 == '0746' or $nat1 == '0747' or $nat1 == '0755' or $nat1 == '0756' or $nat1 == '0757' or $nat1 == '0758' or $nat1 == '0759' or $nat1 == '0760' or $nat1 == '0761' or $nat1 == '0762' or $nat1 == '0763' or $nat1 == '0764' or $nat1 == '0765' or $nat1 == '0766' or $nat1 == '0767' or $nat1 == '0768' or $nat1 == '0769' or $nat1 == '0770' or $nat1 == '0771' or $nat1 == '0772' or $nat1 == '0835' or $nat1 == '0840' or $nat1 == '0845' or $nat1 == '0855' or $nat1 == '0860' or $nat1 == '0935' or $nat1 == '0940')
{
$naturaleza = "DEBITO";
}
else
{
	if($nat1 == '0216' or $nat1 == '0217' or $nat1 == '0218' or $nat1 == '0219' or $nat1 == '0221' or $nat1 == '0222' or $nat1 == '0223' or $nat1 == '0224' or $nat1 == '0226' or $nat1 == '0227' or $nat1 == '0228' or $nat1 == '0229' or $nat1 == '0231' or $nat1 == '0242' or $nat1 == '0253' or $nat1 == '0254' or $nat1 == '0320' or $nat1 == '0321' or $nat1 == '0323' or $nat1 == '0324' or $nat1 == '0325' or $nat1 == '0326' or $nat1 == '0425' or $nat1 == '0430' or $nat1 == '0530' or $nat1 == '0531' or $nat1 == '0532' or $nat1 == '0533' or $nat1 == '0534' or $nat1 == '0535' or $nat1 == '0536' or $nat1 == '0537' or $nat1 == '0538' or $nat1 == '0539' or $nat1 == '0540' or $nat1 == '0541' or $nat1 == '0542' or $nat1 == '0543' or $nat1 == '0544' or $nat1 == '0545' or $nat1 == '0546' or $nat1 == '0547' or $nat1 == '0830' or $nat1 == '0850' or $nat1 == '0930')
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
		//printf("<center><span class='Estilo4'>CARGUE SALDOS INICIALES</span></center>");
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
			//$sq1 = "select * from aux_cta_0 where (fecha between '$fecha_ini_op' and '$aux_fecha' ) and cuenta = '$nn' order by fecha asc ";
			
			$sq1 = "select  cuenta, sum(debito) as sumadebito ,sum(credito) as sumacredito from aux_cta_0 where (fecha between '$fecha_ini_op' and '$aux_fecha' ) group by cuenta having cuenta = '$nn'";			
			$re1 = mysql_db_query($database, $sq1, $cx1);
			
			while($rw1 = mysql_fetch_array($re1)) 
			{
			  // $cta_aux=$rw1["cuenta"];
			   
					//if($cta_aux == $nn)
					///{
					//	$acu_deb=$acu_deb+$rw1["debito"];
					//	$acu_cre=$acu_cre+$rw1["credito"];
					//	$saldo_inicial=$sico_d + $acu_deb - $acu_cre;	
						 
					//}		
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
			//$sq1 = "select * from aux_cta_0 where (fecha between '$fecha_ini_op' and '$aux_fecha' ) and cuenta = '$nn' order by fecha asc ";
			$sq1 = "select  cuenta, sum(debito) as sumadebito ,sum(credito) as sumacredito from aux_cta_0 where (fecha between '$fecha_ini_op' and '$aux_fecha' ) group by cuenta having cuenta = '$nn'";			
			
			$re1 = mysql_db_query($database, $sq1, $cx1);
			
			while($rw1 = mysql_fetch_array($re1)) 
			{
			   //$cta_aux=$rw1["cuenta"];
			   
					//if($cta_aux == $nn)
					//{
						//$acu_deb=$acu_deb+$rw1["debito"];
						//$acu_cre=$acu_cre+$rw1["credito"];
						//$saldo_inicial=$sico_c - $acu_deb + $acu_cre;
									 
					//}		
					
				$saldo_inicial=$sico_c - $rw1[sumadebito] + $rw1[sumacredito];	
			}//fin while
		    
			
		}

		
}//fin else

//****************
//**** variables para totalizar saldos
$total_debitos=0;
$total_creditos=0;
//***

/*if($fecha_ini == $fecha_ini_op)
{*/
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

/*}
else
{
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
		<BR><BR>
		Saldo Inicial calculado desde : <b>".$fecha_ini_op."</b> Hasta : <b>".$aux_fecha."</b><br>
		</span>
		</center><BR>",$fecha_ini,$fecha_fin,$nn);

}*/

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

",$saldo_inicial);
//*****************

//****** consulta en tabla auxiliar

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_cta_0 where (fecha between '$fecha_ini' and '$fecha_fin' )  and cuenta = '$nn' order by fecha asc ";
$re = mysql_db_query($database, $sq, $cx);

$saldo=$saldo_inicial;

while($rw = mysql_fetch_array($re)) 
{

										
						//if($rw["cuenta"] == $nn)
					//	{
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
						",$rw["detalle"],$rw["tercero"],$rw["debito"],$rw["credito"]);	
						
						$total_debitos=$total_debitos+$rw["debito"];
						$total_creditos=$total_creditos+$rw["credito"];
						
						
							
							if($naturaleza == 'DEBITO')
							{
							 	$saldo=$saldo + $rw["debito"] - $rw["credito"];			 
								printf("<td style='text-align:right;' class='Estilo4'>%.2f</td>",$saldo);
							}
							else
							{
							   $saldo=$saldo - $rw["debito"] + $rw["credito"];
							   printf("<td style='text-align:right;' class='Estilo4'>%.2f</td>",$saldo);
							}
						
					//	}
					//	else
					//	{
					//	}
					
				
				
 		  
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


",number_format($total_debitos,2,',','.'),number_format($total_creditos,2,',','.'),number_format($saldo_final,2,',','.'));

printf("</tr></table>");

//***********************

printf("<br><center class='Estilo4'>");  
printf("
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'>
			<input type=button value='Cerrar Ventana' onclick='cerrarVentana()'> 
			</div>
          </div>
        </center>"); 

?>
<?
}
?>
	