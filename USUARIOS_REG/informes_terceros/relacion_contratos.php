<?php
set_time_limit(1800);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201102_F13C_10_CDN.xls");
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
<div align="center" class="Estilo4">
<div style='padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;'>
 <?php
$fecha_ini=$_POST['fecha_ini'];
$fecha_fin=$_POST['fecha_fin'];
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
printf("
<center>
<table width='1500' BORDER='1' class='bordepunteado1'>
<tr>
	<td bgcolor='#DCE9E5' align='center'><b>No Contrato</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Bpin</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Liena o estrategia</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fuente recursos</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Objeto</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Clase Contrato</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor del contrato</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Nombre Completo Del Contratista</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>C�dula /nit Del Contratista</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>No Cdp</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha Cdp</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor Cdp</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha firma contrato</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Forma contratacion</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha RP</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor RP</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Rubro presupuestal</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Se asigno interventor</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>C�dula/nit Del Interventor O Supervisor</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Nombre Completo Del Interventor</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Tipo De Vinculaci�n Interventor O Supervisor</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha aprobacion garantias></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha inicio contrato</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Plazo contrato</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Unidad ejecucion</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>�Se Pact� Anticipo Al Contrato?</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor del anticipo</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha pago anticipo</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha adicion o prorroga</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Plazo Adici�n O Pr�rroga</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor Adici�n O Pr�rroga</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Valor pagos realizados</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha terminacion contrato</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>Fecha Liquidacion</b></td>
	<td bgcolor='#DCE9E5' align='center'><b>CRP</b></td>
	</tr>
");
$periodo = $_POST["periodo"];
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Consulto nit y ombre del vigilado
	$sqn =mysql_db_query($database,"select * from fecha",$cx);
	$rwn = mysql_fetch_array($sqn);
	$emp = $rwn["id_emp"];
	$sqem =mysql_db_query($database,"select * from empresa where cod_emp ='$emp'",$cx);
	$rwem = mysql_fetch_array($sqem);
	$sq13 = "select entidad from conceptos_et where cod_mcipio = '$rwem[cod_mpio]' and cod_dpto='52'";
	$rs13 = mysql_db_query($database,$sq13,$cx);
	$rw13 = mysql_fetch_array($rs13);
	$mpio = strtoupper($rw13['entidad']);
	
// Regimen de contratacion
	$k=0;
	$datos = array("","LEY 80","CONVENIOS LEY 489","CONSTITUCION POLITICA ART. 355","REGIMEN PRIVADO");
	for ($i=0;$i<5;$i++)
	{
		if ($rwem["reg_contratacion"] == $i) $contrata = $datos[$i]; 
	}
// Orden de los recursos
	$k=0;
	$datos = array("","NACIONAL","DEPARTAMENTAL","MUNICIPAL");
	for ($i=0;$i<4;$i++)
	{
		if ($rwem["orden"] == $i) $orden = $datos[$i]; 
	}
// Consulto el valor del presupuesto de ingresos de acuerdo a la fecha de corte seleccionada
	$query = "SELECT SUM(ppto_aprob) as total from car_ppto_ing where tip_dato='D'"; 
	$resp = mysql_db_query($database,$query,$cx);
	$row = mysql_fetch_array($resp);
	$inicial_ing = $row["total"];
	$query1 = "SELECT SUM(valor_adi) as total1 from adi_ppto_ing where fecha_adi <='$fecha_fin'"; 
	$resp1 = mysql_db_query($database,$query1,$cx);
	$row1 = mysql_fetch_array($resp1);
	$adicion_ing = $row1["total1"];
	$query2 = "SELECT SUM(valor_adi) as total2 from red_ppto_ing where fecha_adi <='$fecha_fin'"; 
	$resp2 = mysql_db_query($database,$query2,$cx);
	$row2 = mysql_fetch_array($resp2);
	$reduccion_ing = $row2["total2"];  
	$ppto_def = $inicial_ing + $adicion_ing - $reduccion_ing;
// Consulto compromisoso que estan marcados para contrato
$sq = "SELECT * from crpp where contrato='SI' order by fecha_crpp asc";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re))
{
			$id_auto_crpp=$rw["id_auto_crpp"];
			$sq2 = "SELECT * from contrataciones2 where id_auto_crpp ='$id_auto_crpp'";
			$re2 = mysql_db_query($database, $sq2, $cx);
			$rw2 = mysql_fetch_array($re2);
			// Consulto si se determino interventor o supervisor del contrato
			if ($rw2["cedula_interventor"])
			{
				$interventor ="SI";
				$cc=$rw2["cedula_interventor"];
				$vinculacion =$rw2["tipo_vinculacion_interventor"];	
				if ($vinculacion =='I') $viculac="INTERNO";
				if ($vinculacion =='E') $viculac="EXTERNO";
				if ($vinculacion =='ND') $viculac="ND";
				// Consulto el nombre del interventor
					$sq9 = "SELECT * FROM terceros_naturales where num_id='$rw2[cedula_interventor]'";	
					$re9 = mysql_db_query($database, $sq9, $cx);
					$res = mysql_num_rows($re9);
					if ($res >0)
					{
					$rw9 = mysql_fetch_array($re9);
					$nom_inter = $rw9["pri_ape"]." ".$rw9["seg_ape"]." ".$rw9["pri_nom"]." ".$rw9["seg_nom"]; 
					}else{
					$sq9 = "SELECT * FROM terceros_juridicos where num_id2='$rw2[cedula_interventor]'";	
					$re9 = mysql_db_query($database, $sq9, $cx);
					$rw9 = mysql_fetch_array($re9);
					$nom_inter =$rw9["raz_soc2"] ;
					}
			}else{
				$interventor ="NO";
				$nom_interventor ="";
				$cc="";
				$vinculacion ="";
				$nom_inter="";
				$viculac ="";		
			}
			// Consulto fecha aprobacion garantia unica en postcontratacion
			$sq3 = "SELECT * from postcontratacion where num_contrato='$rw2[num_contrato]' and procedimientos ='CONSTITUCION GARANTIAS'";
			$re3 = mysql_db_query($database, $sq3, $cx);
			$rw3 = mysql_fetch_array($re3);
			// Consulto la fecha deinicio del contrato
			$sq4 = "SELECT * from postcontratacion where num_contrato='$rw2[num_contrato]' and procedimientos ='ACTA DE INICIO'";
			$re4 = mysql_db_query($database, $sq4, $cx);
			$rw4 = mysql_fetch_array($re4);
			if ($rw4["fecha_acto"]=='') { $rw4["fecha_acto"]=$rw2["fec_firma"];}
			// 	Consultar datos de adicion o prorroga
			$sq14 = "SELECT * from postcontratacion where num_contrato='$rw2[num_contrato]' and procedimientos ='ADICION O PRORROGA'";
			$re14 = mysql_db_query($database, $sq14, $cx);
			$rw14 = mysql_fetch_array($re14);
			// 	Consultar fecha de liquidacion
			$sq15 = "SELECT * from postcontratacion where num_contrato='$rw2[num_contrato]' and procedimientos ='LIQUIDACION'";
			$re15 = mysql_db_query($database, $sq15, $cx);
			$rw15 = mysql_fetch_array($re15);
			// Consulto si el registro tiene marcado anticipos
			if ($rw["pago"] =='ANTICIPO')
			{
				$anticipo="SI";
				// consulto el primer valor pagado del crpp
				$sq10 = "select vr_digitado from cobp where id_auto_crpp = '$rw[id_auto_crpp]' order by id asc";
				$rs10 = mysql_db_query($database,$sq10,$cx);
				$rw10 = mysql_fetch_array($rs10);
				$vr_anticipo = $rw10['vr_digitado'];
			}else{
				$anticipo="NO";
				$vr_anticipo = 0;
			}
			// PRORROGAS
			if ($rw['adicion']== 'SI') $prorrogas = 'SI'; else $prorrogas = 'NO'; 
 			
			// consulto si el contrato tiene prorroga, fecha y plazo
			$sq5 = "SELECT sum(valor_adicion) as valor_adicion,sum(plazo_numero) as plazo_numero from postcontratacion where num_contrato='$rw2[num_contrato]' and procedimientos ='ADICION O PRORROGA'";
			$re5 = mysql_db_query($database, $sq5, $cx);
			$rw5 = mysql_fetch_array($re5);
			if ($rw5["valor_adicion"]=='') $rw5["valor_adicion"]=0;
			if ($rw5["plazo_numero"]=='') $rw5["plazo_numero"]=0;
			// Consulto la fecha de terminacion cuando tenga acta de liquidacion
			$sq6 = "SELECT * from postcontratacion where num_contrato = '$rw2[num_contrato]' and procedimientos = 'LIQUIDACION'";
			$re6 = mysql_db_query($database, $sq6, $cx);
			$rw6 = mysql_fetch_array($re6);
			// Consulto los pagos realizados al registro presupuestal
			$sq7 = "SELECT sum(vr_digitado) as pagado from cobp where id_auto_crpp='$id_auto_crpp' and pagado='SI'";
			$re7 = mysql_db_query($database, $sq7, $cx);
			$rw7 = mysql_fetch_array($re7);
			// Consulto datos de los terceros
			$ter_nat =$rw["ter_nat"];
			$ter_jur =$rw["ter_jur"];
			if (!empty($ter_nat))
			{
				// ********* CONSULTO TERCEROS NATURALES	
				$sq8 = "SELECT * FROM terceros_naturales where id='$ter_nat'";	
				$re8 = mysql_db_query($database, $sq8, $cx);
				$rw8 = mysql_fetch_array($re8);
				$doc = $rw8["num_id"];
				$persona ='NATURAL';
			}else{
				$sq8 = "SELECT * FROM terceros_juridicos where id='$ter_jur'";	
				$re8 = mysql_db_query($database, $sq8, $cx);
				$rw8 = mysql_fetch_array($re8);
				$doc =$rw8["num_id2"]; 
				$persona ='JURIDICA';
			}
			// Consulto los pagos realizados al registro presupuestal
			$sq9 = "SELECT fuente_recursos,cod_sia,opc1 from car_ppto_gas where cod_pptal='$rw[cuenta]'";
			$re9 = mysql_db_query($database, $sq9, $cx);
			$rw9 = mysql_fetch_array($re9);
			if ($rw2["objeto"] =='')
			{
				$rw2["objeto"] = $rw["detalle_crpp"];
			}
			if ($rw2["fec_firma"] =='')
			{
				$rw2["fec_firma"] = $rw["fecha_crpp"];
			}
			$modalidad = substr($rw2["modalidad"],0,2);  
			if ($modalidad =='SA') {$mod ='SELECCI�N ABREVIADA'; }  
			if ($modalidad =='CD') {$mod ='DIRECTA'; } 
			if ($modalidad =='LP') {$mod ='LICITACI�N P�BLICA'; } 
			if ($modalidad =='CM') {$mod ='CONCURSO DE M�RITOS'; } 
			if ($modalidad =='OP') {$mod ='OTRO PROCEDIMIENTO'; } 
			if ($modalidad =='') {$mod =''; } 
			// Tipo de pago
			if ($rw9["opc1"] =='FUNCIONAMIENTO') {$tipo_pago ='FUNCIONAMIENTO';}
			if ($rw9["opc1"] =='INVERSION') {$tipo_pago ='INVERSI�N';}
			if ($rw9["opc1"] =='SERVICIO_DEUDA') {$tipo_pago ='SERVICIO DE LA DEUDA';}
			// forma de contracion
			$i=0; 
			$datos = array ("F1","F2","F3","F4","F5","F6","F7","F8");
			$formc = array ("SUBASTA INVERSA","COMPRA POR CATALOGO","BOLSA DE PRODUCTOS","","","ABIERTO","CON PRECLASIFICACION","");
                       for ($i=0; $i<8;$i++)
					   {
					   if ($rw2['for_contratacion'] == $datos[$i])
						$forma = $formc[$i];		
					   }
			if ($forma =='') $forma='NA';
			// valor pagado en el bimestre o periodo reportado
				$sqlceva = "
				SELECT
					cobp.vr_digitado
					, ceva.fecha_ceva
					, crpp.id_auto_crpp
					, cobp.pagado
				FROM
					crpp
					INNER JOIN cobp 
						ON (crpp.id_auto_crpp = cobp.id_auto_crpp)
					INNER JOIN ceva 
						ON (cobp.id_auto_cobp = ceva.id_auto_cobp)
				WHERE (ceva.fecha_ceva between '$fecha_ini' and '$fecha_fin' 
					AND crpp.id_auto_crpp ='$rw[id_auto_crpp]'
					AND cobp.pagado ='SI')";
			$res8 = mysql_db_query($database,$sqlceva,$cx);		
			$row8=mysql_fetch_array($res8);
			$total_ceva=$row8['vr_digitado'];
			if (!$total_ceva) $total_ceva=0;

			if ($rw6["fecha_acto"]=='') $rw6["fecha_acto"]='ND';
			$sq12 = "select sum(valor) as val_cdp from cdpp where consecutivo ='$rw[id_auto_cdpp]' and cuenta = '$rw[cuenta]'";
			$rs12 = mysql_db_query($database,$sq12,$cx);
			$rw12 = mysql_fetch_array($rs12);
			
			$sq33 ="select cod_sia from car_ppto_gas where cod_pptal = '$rw[cuenta]'";
			$rs33 =mysql_db_query($database,$sq33,$cx);
			$rw33 = mysql_fetch_array($rs33);
			
			// filtro por fechas
			if ($rw["fecha_crpp"] >= $fecha_ini and  $rw["fecha_crpp"] <= $fecha_fin)
			{
			
			echo "
			<tr>
				<td  align='center'>$rw2[num_contrato]</td>
				<td  align='left'>$rw2[bpin]</td>
				<td  align='center'>ND</td>
				<td  align='center'> </td>
				<td  align='left'>$rw2[objeto]</td>
				<td  align='left'>$rw2[clas_contrato]</td>
				<td  align='right'>$rw[vr_digitado]</td>
				<td  align='left'>$rw[tercero]</td>
				<td  align='left'>$doc</td>
				<td  align='left'>$rw[id_manu_cdpp]</td>
				<td  align='left'>$rw[fecha_cdpp]</td>
				<td  align='center'>$rw[vr_digitado]</td>
				<td  align='left'>$rw2[fec_firma]</td>
				<td  align='left'>$rw2[for_contratacion]</td>
				<td  align='left'>$rw[fecha_crpp]</td>
				<td  align='center'>$rw[vr_digitado]</td>
				<td  align='center'>$rw33[cod_sia]$rw[cuenta]</td>
				<td  align='center'>SI</td>
				<td  align='center'>$rw2[cedula_interventor]</td>
				<td  align='left'>$nom_inter</td>
				<td  align='center'>$viculac</td>
				<td  align='center'>$rw3[fecha_acto]</td>
				<td  align='center'>$rw4[fecha_acto]</td>
				<td  align='center'>$rw2[plazo_contrato]</td>
				<td  align='center'>DIAS</td>
				<td  align='center'>$anticipo</td>
				<td  align='center'>$rw2[valor_anticipo]</td>
				<td  align='center'>fecha anticipo</td>
				<td  align='center'>$rw14[fecha_acto]</td>
				<td  align='center'>$rw14[plazo_numero]</td>
				<td  align='center'>$rw14[valor_adicion]</td>
				<td  align='center'>$total_ceva</td>
				<td  align='center'>$rw2[fecha_terminacion]</td>
				<td  align='center'>$rw15[fecha_acto]</td>
				<td  align='center' bgcolor='#999999'>$rw[id_manu_crpp]</td>
			</tr>"; 
			$forma='';
			} // end fin filtro contratos del periodo
	// Cargar contratos anteriores sin liquidacion si marca no esta chequeada
	
	if ($periodo != 1)
	{	
	//
			if ($rw["fecha_crpp"] < $fecha_ini and $rw6["fecha_acto"] =='')
			{
				printf("
			<tr>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center' class='text'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center'>%s</td>
				<td  align='center' class='text'>%s</td>
				<td  align='center'>%s</td>
			</tr>",$rw['id_manu_crpp'],$rw['fecha_crpp'],$rwem["nit"],$rwem["raz_soc"],$contrata,$ppto_def,$orden,'NARI�O',$mpio,$rw2["num_contrato"],$mod,$forma,$rw2["clas_contrato"],$tipo_pago,'sector', ereg_replace("[,;]","",$rw2["objeto"]),$rw["vr_digitado"],$doc,$rw["tercero"],$persona,$rw2["fec_firma"],$cc,$nom_inter,$viculac,'DIAS',$rw2["plazo_contrato"],$anticipo,$vr_anticipo,'Fiducia',$rw4["fecha_acto"],$rw6["fecha_terminacion"],'SI','ND','ND','propios','regalias','sgp','col hum','fecha vf','VF inicia','VF fial','valor VF','VF apropiado','VF report','VF x comp',$prorrogas,$rw5["valor_adicion"],$rw6["fecha_acto"],'SI',$total_ceva,$rw['id_manu_cdpp'],$rw['fecha_cdpp'],$rw12["val_cdp"],$rw33['cod_sia'].$rw["cuenta"], 'Contrato sin liquidar');
			} // end contratos fecha anterior sin liquidar
	}
} // end while
printf("</table></center>");
}
?>