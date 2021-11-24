<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
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
.Estilo8 {color: #FFFFFF}
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>

<?
$filtro=$_POST['filtro'];//llegan unidos por ;
$fecha_ini =$_POST['fecha_ini'];
$fecha_fin =$_POST['fecha_fin'];
$separar = $filtro;
list($c2193, $ter) = split('[;]', $separar);
?>
<?
include('../config.php');	
$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from fecha";
$resultado = mysql_db_query($database, $sql, $connection);
while($row = mysql_fetch_array($resultado)) 
   {
   $ano=$row["ano"];
   }			  
			  
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connection);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   } 
?>
<?
printf("
<center>
<table width='1200' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONSEC AUT REIP</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>CONSEC MANU REIP</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CUENTA PPTAL</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>VR REIP</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CONCEPTO 2193</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CONSEC CAIC</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>FECHA CAUSAC</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>FECHA VENCI</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>TOT RECAUDADO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>SALDO X RECAUDAR</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>EDAD CARTERA (Dias)</b></span></td>


</tr>

");

$sql2 = "select * from aux_2193_cxc where concepto_2193 ='$c2193' and tercero ='$ter' and fecha_causa <= '$fecha_fin'";
$resultado2 = mysql_db_query($database, $sql2, $connection);
$cont=0;
while($row2 = mysql_fetch_array($resultado2)) 
{

$cont=$cont + $row2["saldoxrecaudar"];
printf("<tr>");
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["auto_reip"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["manu_reip"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["cod_pptal"]);
printf("<td align='right'><span class='Estilo4'>%s</span></td>",number_format($row2["vr_reip"],2,',','.'));
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["concepto_2193"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["auto_caic"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["tercero"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["fecha_causa"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["fecha_venci"]);
printf("<td align='right'><span class='Estilo4'>%s</span></td>",number_format($row2["tot_recaudado"],2,',','.'));
printf("<td align='right'><span class='Estilo4'>%s</span></td>",number_format($row2["saldoxrecaudar"],2,',','.'));
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["edad_cartera"]);
printf("</tr>");

}
printf("<tr>

<td align='right' colspan='10'>
<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
<span class='Estilo4'><b>TOTAL&nbsp;&nbsp;&nbsp;</b></span>
</div>
</td>

");
printf("<td align='right'><span class='Estilo4'><b>%s</b></span></td>",number_format($cont,2,',','.'));
printf("<td align='center'><span class='Estilo4'><b></b></span></td></tr>");
printf("</table></center>"); 
?>







<title>CONTAFACIL</title><div align="center">
<?
printf("

<center class='Estilo4'>
<form method='post' action='inf_2193.php'>
<input type='hidden' name='fecha_ini' value='%s'>
<input type='hidden' name='fecha_fin' value='%s'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
",$fecha_ini,$fecha_fin);

?>
</div>
<?
}
?>	