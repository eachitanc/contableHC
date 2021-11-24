<?php
header ("Pragma: no-cache");
header("Content-type: application/ms-word");
header("Content-Disposition: attachment; filename=EJECUCION_GASTOS_REGISTRO.doc");
header("Pragma: no-cache");
header("Expires: 0");
$id_auto_crpp =$_GET["id"];
$id_auto_ceva=$_GET["id_ceva"];
$ruta_img = "http://$_SERVER[HTTP_HOST]/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
?>
<br />
<br />
<br />

<table border="0" width="95%" align="center">
<tr>
	<td align="center"><img src="<?php echo $ruta_img; ?>" /><br /></td>
</tr>
<tr>
	<td align="center">RESOLUCIÓN No. 028</td>
</tr>
<tr>
	<td align="center">Por medio de la cual se ordena un gasto con cargo al presupuesto de EMSERP E.S.P., vigencia fiscal del año 2015</td>
</tr>
<tr>
	<td align="center">La suscrita Gerente de la Empresa de Servicios Públicos Varios de Pupiales EMSERP E.S.P., en uso de sus Atribuciones legales, administrativas y,</td>
</tr>
<tr>
	<td align="center">CONSIDERANDO</td>
</tr>

<tr>
	<td align="justify">1. Que el día 08 de enero de 2014, EMSERP E.S.P. suscribió contrato de prestación de servicios No. 214-005 con el señor PEDRO PÉREZ, cuyo objeto es la prestación de servicios de barrido de calles y aseo de parques de acuerdo a la necesidad y en cumplimiento de las funciones propias del cargo, por valor de $1.000.000.oo</td>
</tr>
</table>