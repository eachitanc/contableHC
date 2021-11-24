<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
	
		
if($_SESSION["rol"]=="")
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
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
.Estilo9 {
	color: #FF0000;
	font-weight: bold;
}
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo9 {font-weight: bold}
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo15 {color: #000000}
.Estilo17 {font-weight: bold}
-->
</style>

<script>
function chk_cta0(){
var pos_url = 'comprueba_cta_0_gas.php';
var cod = document.getElementById('pgcp').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>


</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <form id="form1" name="form1" method="post" action="">
          <input name="Submit" type="submit" class="Estilo4" value="Presione este Boton para ACTUALIZAR la lista de cuentas Presupuestales CONFIGURADAS" onClick="document.location.reload();" />
                </form>
        </div>
    </div></td>
  </tr>
   <tr>
  <td colspan="3" align="right"><a href="reporte_cta_0_gas.php"><font color="#FF0000">VER REPORTE CONFIGURACION </font></a></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center"><?php
//-------
include('../config.php');	

$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from fecha";
$resultado = mysql_db_query($database, $sql, $connection);

while($row = mysql_fetch_array($resultado)) 
   {
   
   $id=$row["id_emp"];
   $idxx=$row["id_emp"];
   $id_emp=$row["id_emp"];

   }

			
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from car_ppto_gas where id_emp = '$id' order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='850' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>

<td align='center' colspan ='5'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>INSTRUCCIONES PARA LA CONFIGURACION DE CUENTAS 0</b></span>
</div>
</td>

</tr>

<tr bgcolor='#FFFFFF'>

<td align='left' colspan ='5'>
<div style='padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'>
<b>1.</b> Cuentas marcadas con color ROJO - NO HAN SIDO CONFIGURADAS<br>
<b>2.</b> Cuentas marcadas con color AZUL - CONFIGURADAS<br>
<b>3.</b> CLIC sobre la casilla de color AZUL para ver la configuracion realizada por el usuario<br>
<b>4.</b> CLIC sobre la palabra 'CONFIGURAR' para realizar una nueva configuracion o modificar la existente<br>


</span>
</div>
</td>

</tr>

<tr bgcolor='#DCE9E5'>

<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Cod. Pptal</b></span>
</div>
</td>

<td align='center' width='350'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial Aprob</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Configurar</b></span></td>
<td align='center' width='130'><span class='Estilo4'><b></b></span></td>

</tr>

");
$cont=0;
while($rw = mysql_fetch_array($re)) 
   {
$vr_aprob=$rw["ppto_aprob"];
$cod_pptal=$rw["cod_pptal"];
$tip_dato=$rw["tip_dato"];

printf("

<span class='Estilo4'>
<tr>

<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>


", $rw["cod_pptal"], $rw["nom_rubro"]);

if($tip_dato == 'M')
{
printf("<td align='right'><span class='Estilo4'>  </span></td>");
printf("<td align='right'><span class='Estilo4'>  </span></td>");
printf("<td align='right'><span class='Estilo4'>  </span></td>");

}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($rw["ppto_aprob"],2,',','.'));
printf("<td align='center'>
<span class='Estilo4'>
<a href=\"ver_mas_gas.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=900,height=510,scrollbars=yes'); return false;\">Configurar</a>
</span>
</td>",$rw["cod_pptal"]);

	$sql = "select * from ctas0_gas_ok  where cod_pptal='$cod_pptal' and id_emp='$id'";
	$result = mysql_query($sql, $cx) or die(mysql_error());
	if (mysql_num_rows($result) == 0)
	{
	printf("
	<td align='center' bgcolor ='#990000' style='color:#FFFF00' class='Estilo4' valign='middle'>SIN CONFIGURAR</td>");
    } 
	else
	{
	printf("
	<a href=\"ver_mas_gas_2.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=900,height=450,scrollbars=yes'); return false;\">
	<td align='center' bgcolor ='#000099' style='color:#FFFF00' class='Estilo4' valign='middle'>CONFIGURADA OK</td></a>",$rw["cod_pptal"]);
	}
}

printf("</tr>");

$cont++;

   }//fin while

printf("</table></center>");
//--------	
?></div></td>
  </tr>
   </tr>
   <tr>
  <td colspan="3" align="right"><a href="reporte_cta_0_gas.php"><font color="#FF0000">VER REPORTE CONFIGURACION </font></a></td>
  </tr>
  <tr>
    <td colspan="3">
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <form id="form2" name="form2" method="post" action="">
          <input name="Submit" type="submit" class="Estilo4" value="Presione este Boton para ACTUALIZAR la lista de cuentas Presupuestales CONFIGURADAS" onClick="document.location.reload();" />
                </form>
        </div>
    </div>	</td>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
          </strong> </span> <br />
          <span class="Estilo4"><b>Usuario: </b><u><? echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>






<?
}
else
{
	//echo "no tiene permisos para acceder ";
	include('../config.php');
	printf("
	
	<table width='600' border='0' align='center'>
  <tr>
    
    <td width='600' colspan='3'>
	<div class='Estilo2' id='main_div' style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;'>
	  <div align='center'><img src=\"../../ADMIN/images/PLANTILLA PNG PARA BANNER COMUN.png\" width='585' height='100' /></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan='3'>
		
			
		<table width='595' border='0' align='center'>
	
	
	<tr>
	<td>
	
	  <div align='center'>
	   <font size='5' color='#FF0000' > Usted no tiene permisos para acceder..! </font> 
		
	    
	   <br />
	    </div></td>
	</tr>
	</table>
		
		
		
	</td>
  </tr>
  <tr>
  
    <td colspan='3'>
	
	<form name='empresa' method='post' action=\"../proc_crear_emp.php\" >
	</form><br />
	<div align='center'>
	<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
  <div align='center'><a href=\"../user.php\" target='_parent'>VOLVER</a>  </div>
</div>
</div>
</div>
	
	</td>
	
  </tr>
  <tr> 
 	<td height='50'>
	<td> 
  </tr>
  <tr>
   
    <td colspan='3'>
	<div class='Estilo7' id='main_div' style='padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;'>
	  <div align='center'>Desarrollado por <br />
	    <a href=\http://www.qualisoftsalud.com\" target='_blank'><img src=\"../../ADMIN/images/logoqsft2.png\" width='150' height='69' border='0' /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
	
	");
	
}
}
?>