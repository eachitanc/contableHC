<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<?php

include('../config.php');

// conexion				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// id_emp
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
}


$id_manu_roit = 'ROIT'.$_POST['id_manu_roit'];
$id_reip = $_POST['id_reip'];
$fecha_reg = $_POST['fecha_reg'];
$tercero = $_POST['tercero'];
//$des = $_POST['des'];
//$valor_rec = $_POST['valor_rec'];

$id_caic = $_POST['consec_cartera'];
//$fecha_causa = $_POST['fecha_causa'];
//$ref = $_POST['ref'];
//$fecha_ven = $_POST['fecha_ven'];


$id_recau = 'ROIT'.$_POST['consec_recaudo'];
$fecha_recaudo = $_POST['fecha_recaudo'];
$des_recaudo =strtoupper( $_POST['des_recaudo']);

$cont = $_POST['cont'];


/*printf("
id_emp : %s<br>
reip : %s<br>
caic : %s<br>
roit : %s<br>
fecha_recaudo : %s<br>
des_recaudo : %s<br><br>



",

$id_emp,
$id_reip,
$id_caic,
$id_recau ,
$fecha_recaudo ,
$des_recaudo 

);*/


// datos contables
$pgcp1 = $_POST['pgcp1'];
$pgcp2 = $_POST['pgcp2'];
$pgcp3 = $_POST['pgcp3'];
$pgcp4 = $_POST['pgcp4'];
$pgcp5 = $_POST['pgcp5'];
$pgcp6 = $_POST['pgcp6'];
$pgcp7 = $_POST['pgcp7'];
$pgcp8 = $_POST['pgcp8'];
$pgcp9 = $_POST['pgcp9'];
$pgcp10 = $_POST['pgcp10'];
$pgcp11 = $_POST['pgcp11'];
$pgcp12 = $_POST['pgcp12'];
$pgcp13 = $_POST['pgcp13'];
$pgcp14 = $_POST['pgcp14'];
$pgcp15 = $_POST['pgcp15'];
$des1 = $_POST['des1'];
$des2 = $_POST['des2'];
$des3 = $_POST['des3'];
$des4 = $_POST['des4'];
$des5 = $_POST['des5'];
$des6 = $_POST['des6'];
$des7 = $_POST['des7'];
$des8 = $_POST['des8'];
$des9 = $_POST['des9'];
$des10 = $_POST['des10'];
$des11 = $_POST['des11'];
$des12 = $_POST['des12'];
$des13 = $_POST['des13'];
$des14 = $_POST['des14'];
$des15 = $_POST['des15'];
$vr_deb_1 = $_POST['vr_cre_1'];
$vr_deb_2 = $_POST['vr_cre_2'];
$vr_deb_3 = $_POST['vr_cre_3'];
$vr_deb_4 = $_POST['vr_cre_4'];
$vr_deb_5 = $_POST['vr_cre_5'];
$vr_deb_6 = $_POST['vr_cre_6'];
$vr_deb_7 = $_POST['vr_cre_7'];
$vr_deb_8 = $_POST['vr_cre_8'];
$vr_deb_9 = $_POST['vr_cre_9'];
$vr_deb_10 = $_POST['vr_cre_10'];
$vr_deb_11 = $_POST['vr_cre_11'];
$vr_deb_12 = $_POST['vr_cre_12'];
$vr_deb_13 = $_POST['vr_cre_13'];
$vr_deb_14 = $_POST['vr_cre_14'];
$vr_deb_15 = $_POST['vr_cre_15'];
$vr_cre_1 = $_POST['vr_deb_1'];
$vr_cre_2 = $_POST['vr_deb_2'];
$vr_cre_3 = $_POST['vr_deb_3'];
$vr_cre_4 = $_POST['vr_deb_4'];
$vr_cre_5 = $_POST['vr_deb_5'];
$vr_cre_6 = $_POST['vr_deb_6'];
$vr_cre_7 = $_POST['vr_deb_7'];
$vr_cre_8 = $_POST['vr_deb_8'];
$vr_cre_9 = $_POST['vr_deb_9'];
$vr_cre_10 = $_POST['vr_deb_10'];
$vr_cre_11 = $_POST['vr_deb_11'];
$vr_cre_12 = $_POST['vr_deb_12'];
$vr_cre_13 = $_POST['vr_deb_13'];
$vr_cre_14 = $_POST['vr_deb_14'];
$vr_cre_15 = $_POST['vr_deb_15'];

$tot_deb = $vr_deb_1+$vr_deb_2+$vr_deb_3+$vr_deb_4+$vr_deb_5+$vr_deb_6+$vr_deb_7+$vr_deb_8+$vr_deb_9+$vr_deb_10+$vr_deb_11+$vr_deb_12+$vr_deb_13+$vr_deb_14+$vr_deb_15;
$tot_cre = $vr_cre_1+$vr_cre_2+$vr_cre_3+$vr_cre_4+$vr_cre_5+$vr_cre_6+$vr_cre_7+$vr_cre_8+$vr_cre_9+$vr_cre_10+$vr_cre_11+$vr_cre_12+$vr_cre_13+$vr_cre_14+$vr_cre_15;

$tot_deb_a = number_format($tot_deb,2,',','.'); 
$tot_cre_a = number_format($tot_cre,2,',','.'); 

$recaudado = 'SI';

// vigencia fiscal
 
$consultax=mysql_query("select * from vf ",$connectionxx);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
} 


// consulta tipo_dato de pgcp
$sqla = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp1'";
$resultadoa = mysql_db_query($database, $sqla, $connectionxx);
while($rowa = mysql_fetch_array($resultadoa)) 
{  $tipa=$rowa["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlb = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp2'";
$resultadob = mysql_db_query($database, $sqlb, $connectionxx);
while($rowb = mysql_fetch_array($resultadob)) 
{  $tipb=$rowb["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlc = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp3'";
$resultadoc = mysql_db_query($database, $sqlc, $connectionxx);
while($rowc = mysql_fetch_array($resultadoc)) 
{  $tipc=$rowc["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqld = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp4'";
$resultadod = mysql_db_query($database, $sqld, $connectionxx);
while($rowd = mysql_fetch_array($resultadod)) 
{  $tipd=$rowd["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqle = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp5'";
$resultadoe = mysql_db_query($database, $sqle, $connectionxx);
while($rowe = mysql_fetch_array($resultadoe)) 
{  $tipe=$rowe["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlf = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp6'";
$resultadof = mysql_db_query($database, $sqlf, $connectionxx);
while($rowf = mysql_fetch_array($resultadof)) 
{  $tipf=$rowf["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlg = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp7'";
$resultadog = mysql_db_query($database, $sqlg, $connectionxx);
while($rowg = mysql_fetch_array($resultadog)) 
{  $tipg=$rowg["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlh = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp8'";
$resultadoh = mysql_db_query($database, $sqlh, $connectionxx);
while($rowh = mysql_fetch_array($resultadoh)) 
{  $tiph=$rowh["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqli = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp9'";
$resultadoi = mysql_db_query($database, $sqli, $connectionxx);
while($rowi = mysql_fetch_array($resultadoi)) 
{  $tipi=$rowi["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlj = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp10'";
$resultadoj = mysql_db_query($database, $sqlj, $connectionxx);
while($rowj = mysql_fetch_array($resultadoj)) 
{  $tipj=$rowj["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlk = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp11'";
$resultadok = mysql_db_query($database, $sqlk, $connectionxx);
while($rowk = mysql_fetch_array($resultadok)) 
{  $tipk=$rowk["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqll = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp12'";
$resultadol = mysql_db_query($database, $sqll, $connectionxx);
while($rowl = mysql_fetch_array($resultadol)) 
{  $tipl=$rowl["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlm = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp13'";
$resultadom = mysql_db_query($database, $sqlm, $connectionxx);
while($rowm = mysql_fetch_array($resultadom)) 
{  $tipm=$rowm["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqln = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp14'";
$resultadon = mysql_db_query($database, $sqln, $connectionxx);
while($rown = mysql_fetch_array($resultadon)) 
{  $tipn=$rown["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlo = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp15'";
$resultadoo = mysql_db_query($database, $sqlo, $connectionxx);
while($rowo = mysql_fetch_array($resultadoo)) 
{  $tipo=$rowo["tip_dato"]; }



				
				
//printf("tot_deb : %s<br>tot_cre : %s<br>total : %s<br>",$tot_deb,$tot_cre,$total);				


// inicio del bloque

if (($tipa =='M')or($tipb =='M')or($tipc =='M')or($tipd =='M')or($tipe =='M')or($tipf =='M')or($tipg =='M')or($tiph =='M')or($tipi =='M')or($tipj =='M')or($tipk =='M')or($tipl =='M')or($tipm =='M')or($tipn =='M')or($tipo =='M'))
{
printf("<br><br><center class='Estilo4'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>");
printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='recaudos_tesoreria.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
}
else
{

	if($fecha_recaudo > $bx or $fecha_recaudo < $ax)
	{
	printf("<br><br><center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR>");
	printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='recaudos_tesoreria.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>"); 
	}
	else
	{ 
	
		if($fecha_recaudo < $fecha_reg)
		{
			printf("<br><br><center class='Estilo4'>La fecha de Recaudo <b>NO</b> debe ser <B>MENOR</B> a la fecha de <b>RECONOCIMIENTO</b><BR><BR>");
			printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='recaudos_tesoreria.php' target='_parent'>VOLVER </a> </div>
          	</div>
        	</div></center>"); 
		}
		else
		{ 
	
		    if($tot_deb_a != $tot_cre_a)
	   			{
					printf("<br><br><center class='Estilo4'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb_a." :::...) y Credito (...::: ".$tot_cre_a." :::...) del movimiento <br><br>
					<b>NO COINCIDEN</b> <BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>"
					);
					printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
         		    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            		<div align='center'><a href='recaudos_tesoreria.php' target='_parent'>VOLVER </a> </div>
          			</div>
        			</div></center>");
     			}
		    else
		    {
      			$total = 0;
				for($ii=0 ; $ii<$cont ; $ii++)
				{
				 $vrx = $_POST[$ii];
				 $total = $total + $vrx;
				}
				
				
	           for($i=0 ; $i<$cont ; $i++)
				{
					
					$id = $_POST['id'.$i];// id unico
					$cuenta = $_POST['cta'.$i];
					$nombre = $_POST['nom'.$i];
					$valor = $_POST['vr'.$i];//vr original del reip
					$valor_digitado = $_POST[$i];
				echo $id;
					// vr recaudado hasta la fecha
					$sql1 = "select * from reip_ing where id_emp ='$id_emp' and id ='$id'";
					$res1 = mysql_db_query($database, $sql1, $connectionxx);
					while($fil = mysql_fetch_array($res1)) 
					{ 
						$vr_recaudado_hlf = $fil["vr_recaudado"]; 
					}
					// calculo del saldo x recaudar
					$saldo = $valor - $vr_recaudado_hlf;	
									
					$vr_recaudado = $valor_digitado + $vr_recaudado_hlf;
					
						if($vr_recaudado > $valor)
		            				{
									// impresion de error
									printf("<br><center class='Estilo4'>
					************************************************************<br>
					************************************************************<br>
					<u><b>ERROR</b></u><br><br>
					El valor Recaudado $<b>".$valor_digitado."</b>=<br><br>
					es <b>MAYOR</b> al valor que falta por Recaudar al : <br><br>
					Reconocimiento :  <b>".$id_reip."</b><br>
					Imputacion : <b>".$cuenta."</b><br>
					Nombre : <b>".$nombre."</b><br><br>
					Valor Definido en el Reconocimiento : $<b>".$valor."</b>=<BR>
					Valor Recaudado hasta la fecha : $<b>".$vr_recaudado_hlf."</b>=<BR>
					Saldo x Recaudar : $<b>".$saldo."</b>=<BR><br>
					
					Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>
					************************************************************<br>
					************************************************************<br>	");
					
									}
									else
									{
										/*if (($tot_deb != $total) or ($tot_cre != $total))
										{
										   // impresion de error
											printf("<br><center class='Estilo4'>
										************************************************************<br>
										************************************************************<br>
										<u><b>ERROR</b></u><br><br>
										Los totales DEBITO <b>(".$tot_deb.")</b> y CREDITO <b>(".$tot_cre.")</b> <br>
										<b>NO COINCIDEN</b>
										<br>
										con el valor total del Recaudo <b>(".$total.")</b>
										<BR><br>
					
										Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>
										************************************************************<br>
										************************************************************<br>	");
										 
										}
										else
										{*/
								         
										// inserto nuevo roit
										$sql = "INSERT INTO recaudo_roit ( 
									
										id_emp , id_reip , id_caic , id_recau , fecha_recaudo , des_recaudo , tercero ,
										pgcp1 , pgcp2 , pgcp3 , pgcp4 , pgcp5 , pgcp6 , pgcp7 , pgcp8 , pgcp9 , pgcp10 , pgcp11 , pgcp12 , pgcp13 , pgcp14 , pgcp15 , 
										des1 , des2 , des3 , des4 , des5 , des6 , des7 , des8 , des9 , des10 , des11 , des12 , des13 , des14 , des15 , 
										vr_deb_1 , vr_deb_2 , vr_deb_3 , vr_deb_4 , vr_deb_5 , vr_deb_6 , vr_deb_7 , vr_deb_8 , vr_deb_9 , 
										vr_deb_10 , vr_deb_11 , vr_deb_12 , vr_deb_13 , vr_deb_14 , vr_deb_15 , 
										vr_cre_1 , vr_cre_2 , vr_cre_3 , vr_cre_4 , vr_cre_5 , vr_cre_6 , vr_cre_7 , vr_cre_8 , vr_cre_9 , 
										vr_cre_10 , vr_cre_11 , vr_cre_12 , vr_cre_13 , vr_cre_14 , vr_cre_15 , 
										tot_deb , tot_cre ,
										id_unico_reip, cuenta, nombre, vr_orig_reip, vr_digitado, id_manu_roit
									
										) VALUES ( 
													
										'$id_emp' , '$id_reip' , '$id_caic' , '$id_recau' , '$fecha_recaudo' , '$des_recaudo' ,'$tercero' ,
										'$pgcp1' , '$pgcp2' , '$pgcp3' , '$pgcp4' , '$pgcp5' , '$pgcp6' , '$pgcp7' , '$pgcp8' , '$pgcp9' , '$pgcp10' , '$pgcp11' , '$pgcp12' , 
										'$pgcp13' , '$pgcp14' , '$pgcp15' , 
										'$des1' , '$des2' , '$des3' , '$des4' , '$des5' , '$des6' , '$des7' , '$des8' , '$des9' , '$des10' , '$des11' , '$des12' , '$des13' , 
										'$des14' , '$des15' , 
										'$vr_deb_1' , '$vr_deb_2' , '$vr_deb_3' , '$vr_deb_4' , '$vr_deb_5' , '$vr_deb_6' , '$vr_deb_7' , '$vr_deb_8' , '$vr_deb_9' , 
										'$vr_deb_10' , '$vr_deb_11' , '$vr_deb_12' , '$vr_deb_13' , '$vr_deb_14' , '$vr_deb_15' , 
										'$vr_cre_1' , '$vr_cre_2' , '$vr_cre_3' , '$vr_cre_4', '$vr_cre_5' , '$vr_cre_6' , '$vr_cre_7' , '$vr_cre_8' , '$vr_cre_9' , 
										'$vr_cre_10' , '$vr_cre_11' , '$vr_cre_12' , '$vr_cre_13' , '$vr_cre_14' , '$vr_cre_15' , 
										'$tot_deb' , '$tot_cre' ,
										'$id' , '$cuenta' , '$nombre' , '$valor' , '$valor_digitado', '$id_manu_roit'
									
										)";
							
							
										mysql_query($sql, $connectionxx) or die(mysql_error());
										
										// actualizo elim_cont de reip
										
										$sql33 = "update reip_ing set elim_cont ='1' where id_emp= '$id_emp' and id ='$id' ";
            							$res33 = mysql_db_query($database, $sql33, $connectionxx);
					
										//actualizar vr_rec_hlf
						
									    	$sql2 = "select * from reip_ing where id_emp ='$id_emp' and id ='$id'";
					    					$res2 = mysql_db_query($database, $sql2, $connectionxx);
					   						 while($fil2 = mysql_fetch_array($res2)) 
											{ $vr_recaudado_hlf = $fil2["vr_recaudado"]; }
						
											$vr_recaudado_hlf = $vr_recaudado_hlf + $valor_digitado;
						
											$sql3 = "update reip_ing set vr_recaudado='$vr_recaudado_hlf' where id_emp= '$id_emp' and id ='$id' ";
            								$res3 = mysql_db_query($database, $sql3, $connectionxx);	
						
										// calculo nuevo saldo 
							
										$saldo2 = $vr_recaudado_hlf - $valor;
											if ($saldo2 == 0)
											{
											$sqlx = "update reip_ing set recaudo_completo='SI' where id_emp= '$id_emp' and id ='$id' ";
											$resultado = mysql_db_query($database, $sqlx, $connectionxx);
											$sqly = "update cartera_cont set recaudado = 'SI' where id_reip ='$id_reip' ";
											$resultado = mysql_db_query($database, $sqly, $connectionxx);	
	
											}
						
						
						   				//printf("<center class='Estilo4'><br>Recaudo a la cuenta ".$cuenta." - ".$nombre." <br><br>Almacenado con <b>EXITO</b></center><br>");
										printf("<center class='Estilo4'><br>Recaudo Almacenado con <b>EXITO</b></center><br>");
										
										
										}
										
								   // }//del else
					 
				}//del for
				
				
				printf("<br><center><div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
         		    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            		<div align='center'><a href='recaudos_tesoreria.php' target='_parent'>VOLVER </a> </div>
          			</div>
        			</div></center>");

    	    }
		}
	}
}

?>
<?php
}
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
</style>