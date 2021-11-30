<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo2 {font-weight: bold}
.Estilo3 {font-weight: bold}
.Estilo4 {font-weight: bold}
.Estilo5 {font-weight: bold}
.Estilo6 {font-weight: bold}
.Estilo7 {font-weight: bold}
a:link {
	color: #666666;
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
</style>

</head>
<body>
<?php
$id=$_GET['id'];
//printf("%s",$id);

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
//id_emp
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
  
}

// datos de cartera cont
$sql2 = "select * from cartera_cont where id_emp='$id_emp' and id ='$id'";
$res2 = mysql_db_query($database, $sql2, $connectionxx);

while($row2 = mysql_fetch_array($res2)) 
{
  $id_reip=$row2["id_reip"];
  $consec_cartera=$row2["consec_cartera"];
  $fecha_causa=$row2["fecha_causa"];
  $valor_rec=$row2["valor_rec"];
}


// suma del vr total reip ing

$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE id_emp='$id_emp' and consecutivo ='$id_reip' ",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=$row[0]; 
$tot_vr_reip = $total;



//datos de reip ing
$sql3 = "select * from reip_ing where id_emp='$id_emp' and consecutivo ='$id_reip'";
$res3 = mysql_db_query($database, $sql3, $connectionxx);
while($row3 = mysql_fetch_array($res3)) 
{
  $fecha_reg=$row3["fecha_reg"];
}

?>
<br /><br />
<table width="400" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="2" bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	  <div align="center"><span class="Estilo1"><strong>Informacion del Reconocimiento </strong></span> </div>
	</div>	</td>
  </tr>
  <tr>
    <td width="200"><div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><span class="Estilo1">No Consecutivo : </span> </div>
    </div></td>
    <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><span class="Estilo1"><?php printf("%s",$id_reip); ?></span> </div>
    </div></td>
  </tr>
  <tr>
    <td><div class="Estilo3" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><span class="Estilo1">Fecha del Reconocimiento  : </span> </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><span class="Estilo1"><?php printf("%s",$fecha_reg); ?></span> </div>
    </div></td>
  </tr>
  <tr>
    <td><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><span class="Estilo1">Vr. Reconocido  : </span> </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><span class="Estilo1">$ <?php printf("%.2f",$tot_vr_reip); ?> = </span> </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><span class="Estilo1"><strong>Informacion de la Causacion </strong></span></div>
    </div></td>
  </tr>
  <tr>
    <td><div class="Estilo5" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><span class="Estilo1">No. Consecutivo  : </span> </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><span class="Estilo1"><?php printf("%s",$consec_cartera); ?></span> </div>
    </div></td>
  </tr>
  <tr>
    <td><div class="Estilo6" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><span class="Estilo1">Fecha de la Causacion .: </span> </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><span class="Estilo1"><?php printf("%s",$fecha_causa); ?></span> </div>
    </div></td>
  </tr>
  <tr>
    <td><div class="Estilo7" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><span class="Estilo1">Vr Causado . :</span> </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><span class="Estilo1">$ <?php printf("%.2f",$valor_rec); ?> = </span> </div>
    </div></td>
  </tr>
</table><BR />
<div align="center"><span class="Estilo1"><strong>RECIBOS OFICIALES DE INGRESO GENERADOS</strong></span> <br />
    <span style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
  <?php
$sq = "select distinct(id_recau) , fecha_recaudo , id_reip , id_caic, tercero  from recaudo_roit where id_emp = '$id_emp' and id_caic ='$consec_cartera' order by fecha_recaudo asc ";
$re = mysql_db_query($database, $sq, $connectionxx);

printf("
<center>

<table width='600' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='200'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo1'><b>CONSECUTIVOS</b></span>
</div>
</td>
<td align='center' width='200'><span class='Estilo1'><b>FECHAS DE RECAUDO</b></span></td>
<td align='center' width='200'><span class='Estilo1'><b>VRS. RECAUDADOS</b></span></td>

");

$total_rec=0;
while($rw = $re->fetch_assoc()) 
   {

$id_recau2=$rw["id_recau"];   
$link2=mysql_connect($server,$dbuser,$dbpass);
$resulta2=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE id_emp='$id_emp' and id_recau ='$id_recau2' ",$link2) or die (mysql_error());
$row2=mysql_fetch_row($resulta2);
$vr_total_roit=$row2[0]; 

printf("
<span class='Estilo4'>
<tr>
<td align='center'><span class='Estilo1'> %s </span></td>
<td align='center'><span class='Estilo1'> %s </span></td>
<td align='right'><span class='Estilo1'> %.2f &nbsp;</span></td>

</tr>", $rw["id_recau"], $rw["fecha_recaudo"], $vr_total_roit); 

$total_rec=$total_rec+$vr_total_roit;

   }

printf("</table></center>");

?>
  <?php $res_fin=$tot_vr_reip-$total_rec; ?>
  <br />
  <span class="Estilo1">TOTAL RECONOCIDO  ( $ <?php printf("%.2f",$tot_vr_reip); ?> = ) - TOTAL RECAUDADO ( $ <?php printf("%.2f",$total_rec); ?> = )<BR /> ...::: $ <?php printf("%.2f",$res_fin); ?> = :::...</span></span><br />
</div>
<br />
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='recaudos_tesoreria.php' target='_parent' class="Estilo1">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
}
?>