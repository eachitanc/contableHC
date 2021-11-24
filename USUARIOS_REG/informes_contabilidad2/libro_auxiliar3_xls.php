<?
set_time_limit(1200);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=LIBRO_DIARIO.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

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
$cuenta=$_POST['nn'];
$cuenta_fin=$_POST['nn_fin'];
$tercero =$_POST['valtercero'];
if($tercero) $ter ="and ccnit ='$tercero'"; else $ter ='';

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
$sq3 ="select cod_pptal,nom_rubro from pgcp where cod_pptal between '$cuenta' and '$cuenta_fin' and tip_dato ='D'";
$rs3 = mysql_db_query($database,$sq3,$connectionxx);
while ($rw3 = mysql_fetch_array($rs3))
{
		$total_debitos=0;
		$total_creditos=0;
		$saldo_final=0;
		$saldo_inicial=0;
		$sico_d=0;
		$sico_c=0;
		$saldo=0;
		$suma=0;
		$nn = $rw3['cod_pptal'];
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
		
		$ss22a = "select debito,credito from sico where cuenta = '$nn'";
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
		
		
		// calculo saldo inicial
		
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
					
					$sq1 = "select  cuenta, sum(debito) as sumadebito ,sum(credito) as sumacredito from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' ) $ter group by cuenta having cuenta = '$nn'";
					
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
		$sq1 = "select  cuenta, sum(debito) as sumadebito ,sum(credito) as sumacredito from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' )  $ter group by cuenta having cuenta = '$nn'";		
					$re1 = mysql_db_query($database, $sq1, $cx1);
					
					while($rw1 = mysql_fetch_array($re1)) 
					{
						$saldo_inicial=$sico_c - $rw1[sumadebito] + $rw1[sumacredito];								
					}//fin while
				}
		
				
		}//fin else
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$nn' $ter order by fecha asc ";
		$re = mysql_db_query($database, $sq, $cx);
		$fil = mysql_num_rows($re);
		if ($fil >0)
		{
		//****************
		//**** variables para totalizar saldos
		$total_debitos=0;
		$total_creditos=0;
		//***
		
				printf("<BR><br>
				<center>
				<B>LIBRO AUXILIAR 
				<br>
				CUENTA ".$nn." - ".$rw3['nom_rubro']."</B>
				<br>
				<b>Fecha Inicial</b> seleccionada <b>%s</b> - <b>Fecha Final</b> seleccionada <b>%s</b>
				</center>",$fecha_ini,$fecha_fin,$nn);
		//*** encabezado del informe
		
		printf("
		<center>
		
		<table width='1080' BORDER='1' class='bordepunteado1'>
		
		<tr bgcolor='#DCE9E5'>
		<td align='center' width='80'><span class='Estilo4'><b>Fecha</b></span></td>
		<td align='center' width='100'><span class='Estilo4'><b>Documento</b></span></td>
		<td align='center' width='250'><span class='Estilo4'><b>Tercero</b></span></td>
		<td align='center' width='250'><span class='Estilo4'><b>cc/nit</b></span></td>
		<td align='center' width='250'><span class='Estilo4'><b>Detalle</b></span></td>
		<td align='center' width='100'><span class='Estilo4'><b>Cheque</b></span></td>
		<td align='center' width='100'><span class='Estilo4'><b>Debito</b></span></td>
		<td align='center' width='100'><span class='Estilo4'><b>Credito</b></span></td>
		<td align='center' width='100'><span class='Estilo4'><b>Cuenta</b></span></td>
		</tr>
		
			
		",$saldo_inicial);
	
		//*****************
		//****** consulta en tabla auxiliar
		
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		$sq = "select ccnit,debito,credito,tercero,dcto,detalle,cheque,cuenta,fecha from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$nn' $ter order by fecha asc ";
		$re = mysql_db_query($database, $sq, $cx);
		$saldo=$saldo_inicial;
		while($rw = mysql_fetch_array($re)) 
		{
								$ccnit =$rw['ccnit'];
								// Verificar que tenga tercero en el libro auxiliar
								if($ccnit=='')
								{
										// busco todos los terceros de la vista
										$sq4="select nombre,num_id from z_terceros";
										$rs4=mysql_db_query($database,$sq4,$cx);
										while ($rw4=mysql_fetch_array($rs4))
										{
										$nombre_ter = str_replace(' ','',$rw4['nombre']);
										$nombre_lib = str_replace(' ','',$rw['tercero']);								
										if($nombre_lib ==$nombre_ter) $ccnit = $rw4['num_id'];
										}
								}
								
								
								$total_debitos=$total_debitos+$rw["debito"];
								$total_creditos=$total_creditos+$rw["credito"];
								$suma =	$total_debitos + $total_creditos;			
								printf("
								<span class='Estilo4'>
								<tr>
								<td align='center'><span class='Estilo4'> %s </span></td>
								<td align='left'><span class='Estilo4'> %s </span></td>",$rw["fecha"],$rw["dcto"]); 
								printf("
								<td style='text-align:left;' class='Estilo4'>&nbsp;%s&nbsp;</td>
								<td align='center'><span class='Estilo4'> %s </span></td>
								<td style='text-align:left;' class='Estilo4'>&nbsp;%s&nbsp;</td>
								<td style='text-align:right;' class='Estilo4'>%s</td>
								<td style='text-align:right;' class='Estilo4'>%s</td>
								<td style='text-align:right;' class='Estilo4'>%s</td>
								",$rw["tercero"],$ccnit,$rw["dcto"]." - ".$rw["detalle"],$rw["cheque"],$rw["debito"],$rw["credito"]);	

									$sq5 ="select cuenta from lib_aux where dcto = '$rw[dcto]' and cuenta like '1110%'";
									$rs5=mysql_db_query($database,$sq5,$cx);
									$rw5=mysql_fetch_array($rs5);
									if($naturaleza == 'DEBITO')
									{
										$saldo=$saldo + $rw["debito"] - $rw["credito"];			 
										printf("<td style='text-align:right;' class='Estilo4'>%s</td>",$rw5["cuenta"]);
									}
									else
									{
									   $saldo=$saldo - $rw["debito"] + $rw["credito"];
									   printf("<td style='text-align:right;' class='Estilo4'>%s</td>",$rw5["cuenta"]);
									}
								$suma =0;
								//}
		
						$nombre_ter='';
						$nombre_lib='';	  
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
						<td align='center' colspan='5'>
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
						",$total_debitos,$total_creditos,$saldo_final);
							
						printf("</tr></table>");
						
						
		}
}
//***********************
?>
