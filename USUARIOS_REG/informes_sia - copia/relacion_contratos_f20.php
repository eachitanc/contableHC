<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
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
 <?
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
printf("
<center>
<table width='1500' BORDER='1' class='bordepunteado1'>
<tr>
<td bgcolor='#DCE9E5' align='center'><b>1. Nit Entidad</b></td>
<td bgcolor='#DCE9E5' align='center'><b>2. Nombre Entidad</b></td>
<td bgcolor='#DCE9E5' align='center'><b>3. Regimen de Contrataci&oacute;n</b></td>
<td bgcolor='#DCE9E5' align='center'><b>4. Presupuesto de la Entidad</b></td>
<td bgcolor='#DCE9E5' align='center'><b>5. Origen del presupuesto</b></td>
<td bgcolor='#DCE9E5' align='center'><b>6. Departamento</b></td>
<td bgcolor='#DCE9E5' align='center'><b>7. Municipio</b></td>
<td bgcolor='#DCE9E5' align='center'><b>8. N�mero Del Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>9. Modalidad De Selecci�n</b></td>
<td bgcolor='#DCE9E5' align='center'><b>10. Procedimiento</b></td>
<td bgcolor='#DCE9E5' align='center'><b>11. Clase De Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>12. Tipo De Gasto</b></td>
<td bgcolor='#DCE9E5' align='center'><b>13. Sector del gasto</b></td>
<td bgcolor='#DCE9E5' align='center'><b>14. Objeto Del Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>15. Valor Inicial del Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>16. C�dula /nit Del Contratista</b></td>
<td bgcolor='#DCE9E5' align='center'><b>17. Nombre Completo Del Contratista</b></td>
<td bgcolor='#DCE9E5' align='center'><b>18. Persona natural o juridica</b></td>
<td bgcolor='#DCE9E5' align='center'><b>19. Fecha De Suscripci�n Del Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>20. C�dula/nit Del Interventor O Supervisor</b></td>
<td bgcolor='#DCE9E5' align='center'><b>21. Nombre Completo Del Interventor</b></td>
<td bgcolor='#DCE9E5' align='center'><b>22. Tipo De Vinculaci�n Interventor O Supervisor</b></td>
<td bgcolor='#DCE9E5' align='center'><b>23. Plazo De Ejecuci�n- Unidad De Ejecuci�n</b></td>
<td bgcolor='#DCE9E5' align='center'><b>24. Plazo De Ejecuci�n- N�mero De Unidades</b></td>
<td bgcolor='#DCE9E5' align='center'><b>25. �se Pact� Anticipo Al Contrato?</b></td>
<td bgcolor='#DCE9E5' align='center'><b>26. Valor de los anticipos</b></td>
<td bgcolor='#DCE9E5' align='center'><b>27. Constituyo fiducia mercantil</b></td>
<td bgcolor='#DCE9E5' align='center'><b>28. Fecha De Inicio Del Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>29. Fecha De Terminaci�n Del Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>30. Se P�blico En El Secop</b></td>
<td bgcolor='#DCE9E5' align='center'><b>31. N�mero Del Acto Que La Decreta La Urgencia Manifiesta</b></td>
<td bgcolor='#DCE9E5' align='center'><b>32. Fecha Del Acto Administrativo U M</b></td>
<td bgcolor='#DCE9E5' align='center'><b>33. Valor Recursos Propios (En Pesos)</b></td>
<td bgcolor='#DCE9E5' align='center'><b>34. Valor Recursos Regal�as (En Pesos)</b></td>
<td bgcolor='#DCE9E5' align='center'><b>35. Valor Recursos Sgp (En Pesos)</b></td>
<td bgcolor='#DCE9E5' align='center'><b>36. Fnc - Colombia Humanitaria (En Pesos)</b></td>
<td bgcolor='#DCE9E5' align='center'><b>37. Fecha De Autorizacion De La Vigencias Futuras</b></td>
<td bgcolor='#DCE9E5' align='center'><b>38. V F Autorizada A�o Inicia</b></td>
<td bgcolor='#DCE9E5' align='center'><b>39. V F Autorizada A�o Final</b></td>
<td bgcolor='#DCE9E5' align='center'><b>40. Monto Total De La V F Autorizado</b></td>
<td bgcolor='#DCE9E5' align='center'><b>41. Monto De La V F Apropiado En La Vigencia Inicial</b></td>
<td bgcolor='#DCE9E5' align='center'><b>42. Monto De La V F Ejecutado En La Vigencia Que Se Reporta</b></td>
<td bgcolor='#DCE9E5' align='center'><b>43. Saldo Total De La V F Por Comprometer</b></td>
<td bgcolor='#DCE9E5' align='center'><b>44. Prorrogas</b></td>
<td bgcolor='#DCE9E5' align='center'><b>45. Valor Total De Las Adiciones En Pesos</b></td>
<td bgcolor='#DCE9E5' align='center'><b>46. Fecha De Suscripci�n Del Acta De Liquidaci�n</b></td>
<td bgcolor='#DCE9E5' align='center'><b>47. Se Actualiz� En El Secop</b></td>
<td bgcolor='#DCE9E5' align='center'><b>48. Valor Pagos En El Bimestre</b></td>
<td bgcolor='#DCE9E5' align='center'><b>49. Valor Aporte Salud Mes 1</b></td>
<td bgcolor='#DCE9E5' align='center'><b>50. Valor Aporte Salud Mes 2</b></td>
<td bgcolor='#DCE9E5' align='center'><b>51. Valor Aporte Pensiones Mes 1</b></td>
<td bgcolor='#DCE9E5' align='center'><b>52. Valor Aporte Pensiones Mes 2</b></td>
</tr>
");
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Consulto nit y ombre del vigilado
	$sqn =mysql_db_query($database,"select * from fecha",$cx);
	$rwn = mysql_fetch_array($sqn);
	$emp = $rwn["id_emp"];
// Consulto empresa
	$sqem =mysql_db_query($database,"select * from empresa where cod_emp ='$emp'",$cx);
	$rwem = mysql_fetch_array($sqem);
// Cosnulto vigencia
	$sqvg =mysql_db_query($database,"select * from vf",$cx);
	$rwvg = mysql_fetch_array($sqvg);
	$fecha_ini = $rwvg["fecha_ini"];
	$fecha_fin = $rwvg["fecha_fin"];
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
// ***
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
				if ($vinculacion =='I') $viculac="INTERNA";
				if ($vinculacion =='E') $viculac="EXTERNA";
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
			// Consulto si el registro tiene marcado anticipos
			if ($rw["pago"] =='ANTICIPO')
			{
				$anticipo="SI";
			}else{
				$anticipo="NO";
			}
			// consulto si el contrato tiene prorroga, fecha y plazo
			$sq5 = "SELECT sum(valor_adicion) as valor_adicion,sum(plazo_numero) as plazo_numero from postcontratacion where num_contrato='$rw2[num_contrato]' and procedimientos ='ADICION O PRORROGA'";
			$re5 = mysql_db_query($database, $sq5, $cx);
			$rw5 = mysql_fetch_array($re5);
			if ($rw5["valor_adicion"]=='') $rw5["valor_adicion"]=0;
			if ($rw5["plazo_numero"]=='') $rw5["plazo_numero"]=0;
			// Consulto la fecha de terminacion cuando tenga acta de liquidacion
			$sq6 = "SELECT * from postcontratacion where num_contrato='$rw2[num_contrato]' and procedimientos ='LUIQUIDACION'";
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
			if ($modalidad =='CD') {$mod ='CONTRATACI�N DIRECTA'; } 
			if ($modalidad =='LP') {$mod ='LICITACI�N P�BLICA'; } 
			if ($modalidad =='CM') {$mod ='CONCURSO DE M�RITOS'; } 
			if ($modalidad =='OP') {$mod ='OTRO PROCEDIMIENTO'; } 
			if ($modalidad =='') {$mod =''; } 
			// Tipo de pago
			if ($rw9["opc1"] =='FUNCIONAMIENTO') {$tipo_pago ='FUNCIONAMIENTO';}
			if ($rw9["opc1"] =='INVERSION') {$tipo_pago ='INVERSI�N';}
			if ($rw9["opc1"] =='SERVICIO_DEUDA') {$tipo_pago ='SERVICIO DE LA DEUDA';}
			// filtro por fechas
			if ($rw["fecha_crpp"] >= $fecha_ini and  $rw["fecha_crpp"] <= $fecha_fin)
			{
			printf("
			
			<tr>
			<td  align='center'>%s</td>
			<td  align='center'>%s</td>
			<td  align='center'></td>
			<td  align='center'>%s</td>
			<td  align='center'></td>
			<td  align='center'>NARI&Ntilde;O</td>
			<td  align='center'></td>
			<td  align='center' class='text'>%s</td>
			<td  align='center'>%s</td>
			<td  align='center'></td>
			<td  align='center'>%s</td>
			<td  align='center'>%s</td>
			<td  align='center'></td>
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
			<td  align='center'>0</td>
			<td  align='center'></td>
			<td  align='center'>%s</td>
			<td  align='center'>%s</td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'>%s</td>
			<td  align='center'>%s</td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			<td  align='center'></td>
			</tr>",$rwem["nit"],$rwem["raz_soc"],$ppto_def,$rw2["num_contrato"],$mod,$rw2["clas_contrato"],$tipo_pago, ereg_replace("[,;]", "",$rw2["objeto"]),$rw["vr_digitado"],$doc,$rw["tercero"],$persona,$rw2["fec_firma"],$cc,$nom_inter,$viculac,'DIAS',$rw2["plazo_contrato"],$anticipo,$rw4["fecha_acto"],$rw6["fecha_terminacion"],$rw5["valor_adicion"],$rw6["fecha_acto"]); 
			} // end fin filtro contratos del periodo
			
} // end while
printf("</table></center>");
}
?>