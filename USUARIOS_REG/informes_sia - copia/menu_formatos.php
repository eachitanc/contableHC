<?php
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
</head>
<body>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />
<center>
<?php
include('../config.php');               
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from fecha";
$res = mysql_db_query($database, $sql, $cx);
while($row = mysql_fetch_array($res))
 {
   $idxx=$row["id_emp"];
   $id_emp=$row["id_emp"];
   $ano=$row["ano"];
 }
$ex=explode("/", $ano);
$anno =$ex[0];
// llega la variable mes
function esBisiesto($year=NULL) {
    return checkdate(2, 29, ($year==NULL)? date('Y'):$year); // devolvemos true si es bisiesto
}
$bis = esBisiesto($anno); 
$mes = $_POST['mes']; 
// Estable3sco fechas por mes que llega
if ($mes == 1) {$fecha_ini =$anno."/01/01"; $fecha_fin = $anno."/01/31";}
if ($mes == 2 && $bis ==1) {$fecha_ini =$anno."/02/01"; $fecha_fin = $anno."/02/29";}
if ($mes == 2 && $bis !=1) {$fecha_ini =$anno."/02/01"; $fecha_fin = $anno."/02/28";}
if ($mes == 3) {$fecha_ini =$anno."/03/01"; $fecha_fin = $anno."/03/31";}
if ($mes == 4) {$fecha_ini =$anno."/04/01"; $fecha_fin = $anno."/04/30";}
if ($mes == 5) {$fecha_ini =$anno."/05/01"; $fecha_fin = $anno."/05/31";}
if ($mes == 6) {$fecha_ini =$anno."/06/01"; $fecha_fin = $anno."/06/30";}
if ($mes == 7) {$fecha_ini =$anno."/07/01"; $fecha_fin = $anno."/07/31";}
if ($mes == 8) {$fecha_ini =$anno."/08/01"; $fecha_fin = $anno."/08/31";}
if ($mes == 9) {$fecha_ini =$anno."/09/01"; $fecha_fin = $anno."/09/30";}
if ($mes == 10) {$fecha_ini =$anno."/10/01"; $fecha_fin = $anno."/10/31";}
if ($mes == 11) {$fecha_ini =$anno."/11/01"; $fecha_fin = $anno."/11/30";}
if ($mes == 12) {$fecha_ini =$anno."/12/01"; $fecha_fin = $anno."/12/31";}
if ($mes == 13) {$fecha_ini =$anno."/01/01"; $fecha_fin = $anno."/12/31";}

if ($mes ==13) $ver = ""; else $ver ="style='display:none'"; 

$mes_lit =array('','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE','ANUAL');
	$i=1;
	for ($i=1;$i<=13;$i++)
	{
		if ($i==$mes) $periodo = $mes_lit[$i];		
	}
?>
<div align="center" class="Titulotd" style="width:50%;padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">PRESENTACION DE LA CUENTA <?php print $anno . " - PERIODO $periodo"; ?></div>
<br />
<table border="1" align="center" cellpadding="2" cellspacing="0" class="bordepunteado1" width="50%">
<tr class="Titulotd">
	<td width="20%">Formato</td>
	<td colspan="2" width="80%">Nombre</td>
</tr>
<tr class="Estilo4" <?php echo $ver; ?>>
	<td align="left">FORMATO 1</td>
	<td align="left">Cat&aacute;logo de Cuentas</td>
	<td><a href="catalogo_cuentas.php"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4">
	<td align="left">FORMATO 3A</td>
	<td align="left">Movimiento de Bancos</td>
	<td><a href="movimientos_bancos.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4">
	<td align="left">FORMATO 3B </td>
	<td align="left">Traslado de Fondos</td>
	<td><a href="traslado_fondos.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
</tr>
<tr class="Estilo4">
	<td align="left">FORMATO 6</td>
	<td align="left">Ejecuci�n Presupuestal de Ingresos</td>
	<td><a href="ejecucion_ingresos.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4">
	<td align="left">FORMATO 6A</td>
	<td align="left">Relaci�n De Ingresos</td>
	<td><a href="relacion_ingresos.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4">
	<td align="left">FORMATO 7</td>
	<td align="left">Ejecuci�n Presupuestal de Gastos</td>
	<td><a href="ejecucion_gastos.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4">
	<td align="left">FORMATO 7A</td>
	<td align="left">Relaci�n de Compromisos</td>
	<td><a href="relacion_compromisos.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4" <?php echo $ver; ?>>
	<td align="left">FORMATO 8A</td>
	<td align="left">Modificaciones al Presupuesto de Ingresos</td>
	<td><a href="modif_ppto_ing.php"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4" <?php echo $ver; ?>>
	<td align="left">FORMATO 8B</td>
	<td align="left">Modificaciones al Presupuesto de Gastos</td>
	<td><a href="modif_ppto_gas.php"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4">
	<td align="left">FORMATO 11</td>
	<td align="left">Cuentas por pagar</td>
	<td><a href="cuentas_x_pagar.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4" <?php echo $ver; ?>>
	<td align="left">FORMATO 13C</td>
	<td align="left">Formato de Contrataci�n</td>
	<td><a href="relacion_contratos.php"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4" <?php echo $ver; ?>>
	<td align="left">FORMATO 20A</td>
	<td align="left">Formato de Contrataci�n</td>
	<td><a href="relacion_contratos_f20.php"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>

<tr class="Estilo4">
	<td align="left">FORMATO F7B1</td>
	<td align="left">Relaci�n de Pagos</td>
	<td><a href="relacion_pagos.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4">
	<td align="left">FORMATO F7B2</td>
	<td align="left">Relaci�n de Pagos sin afectaci�n pptal</td>
	<td><a href="relacion_pagos_sp.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4" <?php echo $ver; ?>>
	<td align="left">FORMATO 33A</td>
	<td align="left">Inversion Detallada por Sectores</td>
	<td><a href="detalle_inversion.php"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>
<tr class="Estilo4">
	<td align="left">FORMATO F10</td>
	<td align="left">Informe Ejecuci&eacute;n de Reservas</td>
	<td><a href="ejecucion_reservas.php?<?php echo "fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&mes=$mes"; ?>"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
</tr>

</table>
</center>
<br />
<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
		 	<div align="center">
		 		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  		<div align="center" class="Estilo6"><a href='index.php' target='_parent' class="sidebar2">VOLVER</a>
				 		</div>
		        	</div>
        	    </div>      
			</div>
</div>
</body>
</html>
<?php 
}
?>
