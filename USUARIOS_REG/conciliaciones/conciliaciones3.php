<?php
set_time_limit(1200);
include('../config.php');
$fecha_fin=$_GET['fecha_fin']; 
$cuenta=$_GET['cuenta']; 
$fecha_buscar =$_GET['fecha'];
$comp = $_GET['comp'];
$cheque = $_GET['cheque'];
$deb = $_GET['deb'];
$cre = $_GET['cre'];
if ($fecha_buscar !='') $fechab ="and fecha like '%$fecha_buscar%'";else $fechab='';
if ($comp !='') $comp2 ="and dcto like '%$comp%'";else $comp2='';
if ($cheque !='') $cheque2 ="and cheque like '%$cheque%'"; else $cheque2='';
if ($deb !='') $deb2 ="and  debito = '$deb'";else $deb2='';
if ($cre !='') $cre2 ="and credito ='$cre'";else $cre2=''; 
$fecha_b = $fechab . $comp2 . $cheque2 . $deb2 . $cre2;

if (!$fecha_fin)
{
$fecha_fin=$_POST['fecha_fin']; 
$cuenta=$_POST['cuenta']; 
}
/*
$fecha_fin='2015/07/31';
$cuenta='1110050903';
*/
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where fecha_fin ='$fecha_fin' and cuenta='$cuenta' ";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
	$saldo_extracto=$rw["saldo_extracto"];$nom_rubro=$rw['nom_rubro'];
	/*$cons = split("_",$rw['consecutivo']);
	$tipo = substr($rw['dcto'],0,4);
	$id_auto = $tipo.$cons[0];
	$sq2 ="select id_cons,debito,credito from lib_aux where id_cons='$rw[consecutivo]' and cuenta ='$rw[cuenta]' and id_auto ='$id_auto'";
	$rs2 = mysql_db_query($database,$sq2,$cx);
	$fi2 =mysql_num_rows($rs2);
	$rw2 =mysql_fetch_array($rs2);
	
	if ($fi2 ==0)
	{
		$sq4 ="delete from aux_conciliaciones where consecutivo ='$rw[consecutivo]' and cuenta ='$rw[cuenta]' and dcto ='$rw[dcto]'";
		//$resultado = mysql_db_query($database, $sq4, $cx);
	}/*else{
	if ($rw['debito'] != $rw2['debito'] || 	$rw['credito'] != $rw2['credito'])
		{
			$sq5 ="update aux_conciliaciones set debito ='$rw2[debito]',credito ='$rw2[credito]' where consecutivo='$rw[consecutivo]' and cuenta ='$rw[cuenta]' and fecha_fin ='$rw[fecha_fin]'";
			//$res5 = mysql_db_query($database, $sq5, $cx);
		}	
			
	}*/
	
}


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
printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1' cellpadding=1v cellspacing='0' >
<tr bgcolor='#DCE9E5'>
<td align='center' colspan='8' ><span class='Estilo4'><b>Pendientes vigencia anterior y sin identificar</b></span></td>
</tr>
");
//****** consulta en tabla auxiliar SIN CONCILIAR vigencias ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' and fecha <='$fecha_fin' $fecha_b order by fecha,debito asc";
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
							printf("<td style='text-align:center;' class='Estilo4' >--</td>");
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
							printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
							printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
							printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));
							printf("<td class='Estilo4' bgcolor='#990000'><font style=\"color:#FFFFFF\">Conciliada el<br>%s</font></td>",$fm);
							printf("</tr></span>");
							$debitoss = $debitoss +	$rw["debito"];
						$creditoss = $creditoss +	$rw["credito"];
						
					}
					else
					{
						
						if($ctrl2x == 'NO' and $fm != $fecha_fin)
						{
							printf("<tr>");
							//***
							printf("<td style='text-align:center;' class='Estilo4'><a href='#' onclick=borrarRegistro('eliminar_pen?cuenta=$rw[cuenta]&dcto=$rw[dcto]&fecha=$rw[fecha]&fecha_fin=$fecha_fin','conten'); > Eliminar 1x</a></td>");
							//***
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
							printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
							printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
							printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
							printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));
							printf("<td style='text-align:center;' class='Estilo4'><input type='checkbox' name='concia' id='$rw[dcto]_$rw[cuenta]_$fecha_fin' onclick=conciAnterior(id,'cambia_estado_si_vig_ant.php','ejecuta');></td>");
							printf("</tr>");
						
						$debitoss = $debitoss +	$rw["debito"];
						$creditoss = $creditoss +	$rw["credito"];				
						}
					}
				// DOCUMENTOS CONCILIADOS EN AMARRILLO
					
				}
}
?>

<!--LISTA DE DCTOS SIN CONCILIAR MESES ANTERIORES-->

<?php
//*** encabezado del informe


printf("
<tr bgcolor='#DCE9E5'>
<td align='center' colspan='8' ><span class='Estilo4'><b>Pendiente conciliar</b></span></td>
</tr>
");

//****** consulta en tabla auxiliar SIN CONCILIAR MESES ANTERIORES
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
/*$sq = "select * from aux_conciliaciones where (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or (fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0') order by fecha asc";*/
//printf("fecha mes antttttt : %s",$fecha_mes_ant);
$sq = "select consecutivo,dcto,fecha_fin,fecha,cuenta,flag1,flag2,fecha_marca,estado,saldo_extracto,tercero,cheque,debito,credito from aux_conciliaciones
where 
(fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0' $fecha_b)
or
(fecha < '$fecha_mes_ant' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0' $fecha_b)

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
						\" target=\"_parent\">Eliminar 2</a>
						</td>",$fecha_fin,$cuenta,$rw["estado"],$rw["dcto"],$rw["debito"],$rw["credito"]);
						
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
					printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
					printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
					printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));

				
							printf("<td style='text-align:center;' class='Estilo4'><input type='checkbox' name='concia' id='$rw[consecutivo]-$rw[cuenta]-$fecha_fin-$rw[dcto]' onclick=conciAnterior(id,'cambia_estado_no_mes_ant.php','ejecuta');></td>");
					
		
				}

		
		
		
				printf("</span></tr>");
				
	

				
		}	
					
 		  
}
//*** encabezado del informe

//*****************
//****** consulta en tabla auxiliar SIN CONCILIAR

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
/*$sq = "select * from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0') or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0') order by fecha asc";*/
$sq = "select  consecutivo,dcto, fecha,tercero,cheque,debito,credito,fecha_marca,estado,fecha_fin,cuenta from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '0' and flag2 = '0' $fecha_b ) or ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0' $fecha_b)  order by fecha,debito asc";
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
		$tot_deb = $tot_deb +  $rw["debito"];
		$tot_cre = $tot_cre +  $rw["credito"];
		
}
if($val1x == 'NO' and (ereg( "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha_eval, $regs ))  and $fecha_eval == $fecha_fin)
//if($val1x == 'NO')
{
	
	if ($rw['pre'] == 'SI') $color ="bgcolor='#FFCC33'"; else $color ='';
		printf("<tr >");
		//***
		printf("<td style='text-align:center;' >
		<a href='#' onclick=borrarRegistro('eliminar_pen2?cuenta=$rw[cuenta]&id=$rw[consecutivo]&fecha_fin=$fecha_fin','conten'); > Eliminar 3 </a>
		</td>");
		//***
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
		printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
		printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
		printf("<td style='text-align:right;' class='Estilo4' >%s</td>",number_format($rw["debito"],2,'.',','));
		printf("<td style='text-align:right;' class='Estilo4' >%s</td>",number_format($rw["credito"],2,'.',','));
	
	
			printf("<td style='text-align:center;' class='Estilo4' $color> <input type='checkbox' name='concias' id='$rw[consecutivo]-$rw[cuenta]-$fecha_fin-$rw[dcto]' onclick=conciAnterior(id,'cambia_estado.php','ejecuta');></td>");
		$tot_deb = $tot_deb +  $rw["debito"];
		$tot_cre = $tot_cre +  $rw["credito"];
		
}
		printf("</tr>");
}
$tot_deb =number_format($tot_deb + $debitoss,2,'.',',');
$tot_cre =number_format($tot_cre + $creditoss,2,'.',',');
echo"</tr>
<tr bgcolor='#CCCCCC'>
<td align='center' width='100' colspan='5'><span class='Estilo4'><b>Total Pendientes</b></span></td>
<td align='right' width='100'><span class='Estilo4'><b>$tot_deb</b></span></td>
<td align='right' width='100'><span class='Estilo4'><b>$tot_cre </b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
</tr>";
$tot_deb=0;
$tot_cre=0;	
$debitoss=0;
$creditoss=0;

//*** encabezado del informe
printf("
<tr bgcolor='#DCE9E5'>
<td align='center' colspan='8' ><span class='Estilo4'><b>Documentos conciliados</b></span></td>
</tr>
");

//****** consulta en tabla auxiliar CONCILIADAS
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones where ((fecha between '$fecha_mes_ant' and '$fecha_fin' ) and cuenta ='$cuenta' and flag1 = '1' and flag2 = '1' and fecha_marca ='$fecha_fin' $fecha_b) or (fecha_marca ='$fecha_fin' and cuenta ='$cuenta' and flag1 = '1' and flag2 = '0' $fecha_b)  order by fecha asc";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{

		$comp1=$rw["fecha_fin"];
		$comp2=$rw["fecha_marca"];
		if($comp1 == $comp2){printf("<tr><span class='Estilo4'>");}else{printf("<tr bgcolor='#FFFF00'><span class='Estilo4'>");}
			
		//***
		printf("<td style='text-align:center;' class='Estilo4'>
		<a href='#' onclick=borrarRegistro('eliminar_pen2?cuenta=$rw[cuenta]&id=$rw[consecutivo]&fecha_fin=$fecha_fin','conten'); > Eliminar 4</a>
		</td>");
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
	printf("<td class='Estilo4' bgcolor='#006600' align='center'><input type='checkbox' name='concias' id='$rw[consecutivo]-$rw[cuenta]-$fecha_fin-$rw[dcto] ' onclick=conciAnterior(id,'cambia_estado_no.php','ejecuta'); checked></td>");
$debito = $debito + $rw["debito"];
$credito =$credito + $rw["credito"];
}

else
{
	printf("<td style='text-align:center;' class='Estilo4'>cambia y</td>");
$debito = $debito + $rw["debito"];
$credito =$credito + $rw["credito"];

}


		printf("</span></tr>");
		

		
				
 		  
}

//*** a�ado lo de vig anteriores

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' and flag1='1' and flag2='0' and fecha_marca = '$fecha_fin' and fecha <='$fecha_fin' $fecha_b order by fecha asc";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{

					  	printf("<tr bgcolor='#FFFF00'><span class='Estilo4'>");
						//***
						printf("<td style='text-align:center;' class='Estilo4'>
						<a href='#' onclick=borrarRegistro('eliminar_pen?cuenta=$rw[cuenta]&dcto=$rw[dcto]&fecha=$rw[fecha]&fecha_fin=$fecha_fin','conten'); > Eliminar 5</a>
						</td>");
						//***
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["fecha"]);
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["dcto"]);
						printf("<td style='text-align:left;' class='Estilo4'>%s</td>",$rw["tercero"]);
						printf("<td style='text-align:center;' class='Estilo4'>%s</td>",$rw["cheque"]);
						printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["debito"],2,'.',','));
						printf("<td style='text-align:right;' class='Estilo4'>%s</td>",number_format($rw["credito"],2,'.',','));
						printf("<td style='text-align:center;' class='Estilo4' bgcolor='#006600'><input type='checkbox' name='concias' id='$rw[dcto]_$rw[cuenta]_$fecha_fin' onclick=conciAnterior(id,'cambia_estado_no_vig_ant.php','ejecuta'); checked></td>");
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
$sq = "select * from aux_conciliaciones where fecha_fin = '$fecha_fin' and cuenta ='$cuenta' $fecha_b";
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
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' and fecha <= '$fecha_fin' order by fecha asc";
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
$sq = "select * from aux_conciliaciones_vig_ant where cuenta ='$cuenta' and fecha <= '$fecha_fin' order by fecha asc";
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
</body>
</html>




