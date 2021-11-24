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
<table width='950' BORDER='1' class='bordepunteado1'>
<tr>
<td bgcolor='#DCE9E5' align='center'><b>N�mero Del Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Codigo Banco Proyecto</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Linea O Estrategia Desarrollada</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fuente De Recurso</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Objeto</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Clase De Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Valor Del Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Nombre Del Contratista</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Nit O C�dula Del Contratista</b></td>
<td bgcolor='#DCE9E5' align='center'><b>No Disponibilidad Presupuestal</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fecha Disponibilidad</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Valor Disponibilidad</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fecha Firma Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Forma De Contrataci�n</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fecha Registro Presupuestal</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Valor Registro Presupuestal</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Rubro Registro Presupuestal</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Se Asign� Interventor?</b></td>
<td bgcolor='#DCE9E5' align='center'><b>C�dula/nit Del Interventor </b></td>
<td bgcolor='#DCE9E5' align='center'><b>Nombre Del Interventor</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Vinculaci�n Interventor</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fecha Aprobaci�n Garant�a Unica</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fecha Iniciaci�n Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Plazo Contrato En Dias Calendario</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Unidad De Ejecuci�n</b></td>
<td bgcolor='#DCE9E5' align='center'><b>�se Pact� Anticipo Al Contrato?</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Valor Pagado Por Anticipo</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fecha De Pago Anticipo</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fecha Adici�n O Pr�rroga</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Plazo Adici�n O Pr�rroga</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Valor Adici�n O Pr�rroga</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Valor Total Pagos Efectuados </b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fecha De Terminaci�n Contrato</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fecha De Acta De Liquidaci�n</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Rubro</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Detalle</b></td>
");
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
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
			// Consulto si el registro tiene marcado anticipos
			if ($rw["pago"] =='ANTICIPO')
			{
				$anticipo="SI";
			}else{
				$anticipo="NO";
			}
			// consulto si el contrato tiene prorroga, fecha y plazo
			$sq5 = "SELECT * from postcontratacion where num_contrato='$rw2[num_contrato]' and procedimientos ='ADICION O PRORROGA'";
			$re5 = mysql_db_query($database, $sq5, $cx);
			$rw5 = mysql_fetch_array($re5);
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
			}else{
				$sq8 = "SELECT * FROM terceros_juridicos where id='$ter_jur'";	
				$re8 = mysql_db_query($database, $sq8, $cx);
				$rw8 = mysql_fetch_array($re8);
				$doc =$rw8["num_id2"]; 
			}
			// Consulto los pagos realizados al registro presupuestal
			$sq9 = "SELECT fuente_recursos,cod_sia,nom_rubro from car_ppto_gas where cod_pptal='$rw[cuenta]'";
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
			
			printf("
			<tr>
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
			</tr>",$rw["n_contrato"],'Banco','Extrategia',$rw9["fuente_recursos"],ereg_replace("[,;]", "",$rw2["objeto"]),$rw2["clas_contrato"],$rw["vr_digitado"],$rw["tercero"],$doc,$rw["id_manu_cdpp"],$rw["fecha_cdpp"],$rw["vr_orig"],$rw2["fec_firma"],$rw2["for_contratacion"],$rw["fecha_crpp"],$rw["vr_digitado"],$rw9["cod_sia"].$rw["cuenta"],$interventor,$cc,$nom_inter,$viculac,$rw3["fecha_acto"],$rw4["fecha_acto"],$rw2["plazo_contrato"],'DIAS',$anticipo,'','',$rw5["fecha_acto"],$rw5["plazo_numero"],$rw5["valor_adicion"],$rw7["pagado"],$rw6["fecha_terminacion"],$rw6["fecha_acto"]," ".$rw['cuenta'],$rw9['nom_rubro']); 
	
			}
printf("</table></center>");
}
?>