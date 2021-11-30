<?php
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=REPORTE_PLAN_DE_CUENTAS.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table border="1">
<tr>
    <td  bgcolor='#DCE9E5'>CODIGO</td>
    <td  bgcolor='#DCE9E5'>NOMBRE</td>
    <td  bgcolor='#DCE9E5'>TIPO</td>
    <td  bgcolor='#DCE9E5'>NIVEL</td>
    <td  bgcolor='#DCE9E5'>AFECTADO</td>
    <td  bgcolor='#DCE9E5'>BANCO</td>
    <td  bgcolor='#DCE9E5'>NOM_BANCO1</td>
    <td  bgcolor='#DCE9E5'>NOM_BANCO2</td>
    <td  bgcolor='#DCE9E5'>NUM_CTA</td>
    <td  bgcolor='#DCE9E5'>FUENTES_RECURSOS</td>
    <td  bgcolor='#DCE9E5'>SISPRO</td>
    <td  bgcolor='#DCE9E5'>NATURALEZA</td>
    <td  bgcolor='#DCE9E5'>C_NC</td>
    <td  bgcolor='#DCE9E5'>ALMACEN</td>
    <td  bgcolor='#DCE9E5'>DEPRECIABLE</td>
    <td  bgcolor='#DCE9E5'>CARTERA</td>
    <td  bgcolor='#DCE9E5'>TERCERO</td>
    <td  bgcolor='#DCE9E5'>BASE</td>
    <td  bgcolor='#DCE9E5'>C_COSTOS</td>
    <td  bgcolor='#DCE9E5'>CTA_COSTOS</td>
    <td  bgcolor='#DCE9E5'>ENT_RECIP</td>
    <td  bgcolor='#DCE9E5'>COD_SIA</td>
    <td  bgcolor='#DCE9E5'>TIP_CTA</td>
    <td  bgcolor='#DCE9E5'>SISPRO2</td>
    <td  bgcolor='#DCE9E5'>COD_FUT_EL</td>
    <td  bgcolor='#DCE9E5'>AFECTADO2</td>
    <td  bgcolor='#DCE9E5'>BLOQUEO</td>
    <td  bgcolor='#DCE9E5'>CTA_MAESTRA</td>
</tr>
<?php
   include('../config.php');				
   $cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
   $sq2="select * from pgcp order by cod_pptal asc";
   $rs = $cx->query($sq2);
	while($rw = $rs->fetch_assoc())
	{
echo("
<tr>
    <td align='left'>".$rw['cod_pptal']."</td>
    <td>".$rw['nom_rubro']."</td>
    <td>".$rw['tip_dato']."</td>
    <td>".$rw['nivel']."</td>
    <td>".$rw['afectado']."</td>
    <td>".$rw['banco']."</td>
    <td>".$rw['nom_banco1']."</td>
    <td>".$rw['nom_banco2']."</td>
    <td>".$rw['num_cta']."</td>
    <td>".$rw['fuentes_recursos']."</td>
    <td>".$rw['sispro']."</td>
    <td>".$rw['naturaleza']."</td>
    <td>".$rw['c_nc']."</td>
    <td>".$rw['almacen']."</td>
    <td>".$rw['depreciable']."</td>
    <td>".$rw['cartera']."</td>
    <td>".$rw['tercero']."</td>
    <td>".$rw['base']."</td>
    <td>".$rw['c_costos']."</td>
    <td>".$rw['cta_costos']."</td>
    <td>".$rw['ent_recip']."</td>
    <td>".$rw['cod_sia']."</td>
    <td>".$rw['tip_cta']."</td>
    <td>".$rw['sispro2']."</td>
    <td>".$rw['cod_fut_el']."</td>
    <td>".$rw['afectado2']."</td>
    <td>".$rw['bloqueo']."</td>
    <td>".$rw['cta_maestra']."</td>");
	}
?>
</tr>
</table>


</body>
</html>
<?php
}
?>