<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Certificacion.doc");
setlocale(LC_TIME, 'Spanish');
$id = $_GET['var'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database);

// consulto tabla de terceros naturales
$sq1 = "select raz_soc, nit,nom_otr_resp from empresa where cod_emp ='2'";
$rs1 = $cx->query($sq1);
$rw1 = $rs1->fetch_assoc();
// Consultar vigencia
$sq4 = "select fecha_ini, fecha_fin from vf";
$rs4 = $cx->query($sq4);
$rw4 = $rs4->fetch_assoc();
$anno = explode("/", $rw4['fecha_fin']);
$anno2 = $anno[0];
// Consultar datos tecero
$sq5 = "select tercero from ceva where ccnit='$id'";
$rs5 = $cx->query($sq5);
$rw5 = $rs5->fetch_assoc();
$ruta_img = "http://$_SERVER[HTTP_HOST]/2012/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
?>
<table width="90%" border="0">
	<tr>
		<td width="12%" rowspan="3"><img src="<?php echo $ruta_img; ?>" /></td>
		<td width="68%" align="center"><?php echo $rw1['raz_soc']; ?></td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td align="center">Nit:&nbsp;<?php echo $rw1['nit']; ?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td height="41" align="center">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<br />
<br />
<br />
<br />

<table width="90%" border="0">
	<tr>
		<td align="center"><b>CERTIFICADO DE RETENCION DE FUENTE</b></td>
	</tr>
	<tr>
		<td align="center"><b>A&Ntilde;O GRAVABLE:&nbsp; <?php echo $anno2; ?></b></td>
	</tr>
	<tr>
		<td align="center"><b>DE:&nbsp; <?php echo $rw4['fecha_ini']; ?> &nbsp;A:&nbsp; <?php echo $rw4['fecha_fin']; ?></b></td>
	</tr>
</table>
<br />
<br />
<br />

<table width="90%" border="0">
	<tr>
		<td>RETUVO A:</td>
		<td><?php echo $rw5['tercero']; ?></td>
	</tr>
	<tr>
		<td>NIT:</td>
		<td><?php echo $id; ?> </td>
	</tr>

</table>

<br />

<table border='1' width='90%'>

	<tr>
		<td width='40%'>Concepto</td>
		<td width="30%">Base</td>
		<td width="30%">Tarifa</td>
		<td width="30%">Valor retenido</td>
	</tr>

	<?php

	$sq2 = "select concepto from retefuente";
	$rs2 = $cx->query($sq2);


	while ($rw2 = $rs2->fetch_assoc()) {
		$sq3 = "select sum(vr_retefuente) as reten, sum(vr_reteiva) as iva, (sum(salud) + sum(pension) + sum(libranza) + sum(f_solidaridad) + sum(f_empleados) + sum(sindicato) + sum(embargo) + sum(cruce) + sum(otros) + sum(vr_retefuente) + sum(vr_reteiva) + sum(vr_reteica) + sum(vr_estampilla1) + sum(vr_estampilla2) + sum(vr_estampilla3) + sum(vr_estampilla4) + sum(vr_estampilla5) + sum(total_pagado) ) as pagado  from ceva where retefuente ='$rw2[concepto]' and ccnit ='$id' group by retefuente";
		$rs3 = $cx->query($sq3);
		$rw3 = $rs3->fetch_assoc();

		//if ($rw3['sum(vr_reteiva)'] > 0) echo 'hola';
		if ($rw3['reten'] > 0) {
			$iva = $rw3['iva'];
			if ($iva > 0) $rw3['pagado'] = $rw3['pagado'] - ($iva * 2);
			$tarifa = round(($rw3['reten'] / $rw3['pagado']) * 100, 2);
			echo "<tr>
			  <td width='40%'>$rw2[concepto]</td>
			  <td width='30%'>$rw3[pagado]</td>
			  <td width='30%'>$tarifa</td>
			  <td width='30%'>$rw3[reten]</td>
			  </tr>";
		}
	}

	$fecha_a = date("Y/m/d");
	?>
</table>
<br />
<br />
<table width="90%" border="0">
	<tr>
		<td align="justify">Los valores retenidos fueron declarados y consignados oportunamente a la Direcci&oacute;n de Impuestos y Aduanas Nacionales</td>
	</tr>
</table>
<br />
<table width="90%" border="0">
	<tr>
		<td align="justify">Se expide el certificado para dar cumplimiento a lo previsto en el art&iacute;culo 381 del Estatuto Tributario, el d&iacute;a&nbsp; <?php $fec_larga = strftime("%d de %B de %Y", strtotime($fecha_a));
																																								echo $fec_larga; ?>;</td>
	</tr>
</table>
<br />
<br />
<br />
<br />
<table width="90%" border="0">
	<tr>
		<td><?php echo $rw1['nom_otr_resp']; ?></td>
	</tr>

</table>