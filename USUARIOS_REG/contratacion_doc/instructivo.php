<?
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/ms-word");
header("Content-Disposition: attachment; filename=Instructivo.doc");
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
.bordepunteado1 
	{
	 border-style: solid;
	 border-collapse:collapse; 
	 border-width: 1px; 
	 border-color: #004080;
	 }
</style>
</head>
<body>
<br />
<br />
<br />
<br />
<br />
<table border="0"  width="950" align="center" >
<tr>
	<td align="center"><font size="+2"><b>INSTRUCTIVO PLANTILLAS CONTRATACION</b></font></td>
</tr>
<br />
<tr>
	<td align="center"> 
		<table border="1"  width="600" class='bordepunteado1'>
			<tr>
				<td colspan="2" bgcolor="#DCE9E5">En la siguiente tabla se muestra como se deben grabar las plantillas para cada uno de las clases de contrato definidas en el módulo </td>
			</tr>
			<tr>
				<td width="70%" align="center" bgcolor="#CCCCCC"><b>Clase de Contrato</td>
				<td width="30%" align="center" bgcolor="#CCCCCC"><b> Nombre del archivo</td>		
			</tr>
			<tr>
				<td width="70%" align="left">PRESTACION DE SERVICIOS</td>
				<td width="30%" align="center"> C1.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">CONSULTORIA</td>
				<td width="30%" align="center"> C2.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">INTERVENTORIA</td>
				<td width="30%" align="center"> C3.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">MANTENIMIENTO Y/O REPARACION</td>
				<td width="30%" align="center">C4.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">OBRA PUBLICA</td>
				<td width="30%" align="center">C5.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">COMPRA Y/O SUMINISTRO</td>
				<td width="30%" align="center">C6.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">CONCESION</td>
				<td width="30%" align="center">C7.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">COMODATO</td>
				<td width="30%" align="center">C8.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">ARRENDAMIENTO O ADQUISICION DE INMUEBLES</td>
				<td width="30%" align="center">C9.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">FIDUCIA O ENCARGOS FIDUCITARIOS</td>
				<td width="30%" align="center">C10.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">PRESTAMO O MUTUO</td>
				<td width="30%" align="center">C11.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">TRANSPORTE</td>
				<td width="30%" align="center">C12.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">PUBLICIDAD</td>
				<td width="30%" align="center">C13.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">DEPOSITO</td>
				<td width="30%" align="center">C14.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">SEGUROS</td>
				<td width="30%" align="center">C15.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">PRESTACION DE LOS SERVICIOS DE SALUD</td>
				<td width="30%" align="center">C16.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">CONTRATO INTERADMINISTRATIVO</td>
				<td width="30%" align="center">C17.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">DESARROLLO DE ACT. CIENTIFICAS Y TECNOLOGICAS</td>
				<td width="30%" align="center">C18.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">OTROS</td>
				<td width="30%" align="center">C19.rtf</td>		
			</tr>
		</table>
	</td>
</tr>
<br />
<tr>
	<td align="center"> 
		<table border="1"  width="600" class='bordepunteado1'>
			<tr>
				<td colspan="2" bgcolor="#DCE9E5">En la siguiente tabla se muestra como se deben grabar las plantillas para cada uno de las clases de actos de POSTCONTRATACION </td>
			</tr>
			<tr>
				<td width="70%" align="center" bgcolor="#CCCCCC"><b>Clase de Acto</td>
				<td width="30%" align="center" bgcolor="#CCCCCC"><b> Nombre del archivo</td>		
			</tr>
			<tr>
				<td width="70%" align="left">CONSTITUCION GARANTIAS</td>
				<td width="30%" align="center">P1.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">ACTA DE INICIO</td>
				<td width="30%" align="center">P2.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">ADICION O PRORROGA</td>
				<td width="30%" align="center">P3.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">MODIFICACION</td>
				<td width="30%" align="center">P4.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">ACLARACION</td>
				<td width="30%" align="center">P5.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">SUSPENCION</td>
				<td width="30%" align="center">P6.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">INFORME INTERVENTORIA</td>
				<td width="30%" align="center">P7.rtf</td>		
			</tr>
			<tr>
				<td width="70%" align="left">LIQUIDACION</td>
				<td width="30%" align="center">P8.rtf</td>		
			</tr>
		</table>
	</td>
</tr>
<br />
<tr>
	<td align="center"> 
		<table border="1"  width="600" class='bordepunteado1'>
			<tr>
				<td colspan="2" bgcolor="#DCE9E5"  align="justify">Las plantillas se desarrollan en cualquier editor de texto (MS-Word) y se guardan como tipo Formato RTF (*.rtf) con el nombre indicado anteriormente, dentro de la plantilla se remplaza las variables por su equivalente presentado en la siguiente tabla. <br /><br />Por ejemplo "Entre los suscritos <font color="#FF0000">$nom_rep</font> identificado con <font color="#FF0000">$cc</font> y <font color="#FF0000">$nom_tercero</font> identificado con <font color="#FF0000">$cc_ter</font>" </td>
			</tr>
			<tr>
				<td width="70%" align="center" bgcolor="#CCCCCC"><b>Descripción del campo</td>
				<td width="30%" align="center" bgcolor="#CCCCCC"><b> Variable</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Número de registro presupuestal</td>
				<td width="30%" align="left">&nbsp;&nbsp;$id_manu_crpp</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Fecha del registro presupuestal</td>
				<td width="30%" align="left">&nbsp;&nbsp;$fecha_crpp</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Nombre Tercero</td>
				<td width="30%" align="left">&nbsp;&nbsp;$tercero</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Documento identificación tercero</td>
				<td width="30%" align="left">&nbsp;&nbsp;$cc_nit</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Rubro presupuestal afectado</td>
				<td width="30%" align="left">&nbsp;&nbsp;$cuenta</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Numero de contrato</td>
				<td width="30%" align="left">&nbsp;&nbsp;$num_contrato</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Clase de contrato</td>
				<td width="30%" align="left">&nbsp;&nbsp;$clas_contrato</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Modalidad de selección</td>
				<td width="30%" align="left">&nbsp;&nbsp;$modalidad</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Fecha de firma del contrato</td>
				<td width="30%" align="left">&nbsp;&nbsp;$fec_firma</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Objeto contractual</td>
				<td width="30%" align="left">&nbsp;&nbsp;$objeto</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Plazo del contrato número</td>
				<td width="30%" align="left">&nbsp;&nbsp;$plazo_contrato</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Plazo del contrato unidad</td>
				<td width="30%" align="left">&nbsp;&nbsp;$plazo_unidad</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Nombre del interventor</td>
				<td width="30%" align="left">&nbsp;&nbsp;$nombre_interventor</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Cedula del interventor</td>
				<td width="30%" align="left">&nbsp;&nbsp;$cedula_interventor</td>		
			</tr>
			<tr>
				<td width="70%" align="left">&nbsp;&nbsp;Valor del contrato</td>
				<td width="30%" align="left">&nbsp;&nbsp;$valor_inicial</td>		
			</tr>
			
		</table>
	</td>
</tr>
</table>
</body>
</html>
<?php 
}
?>