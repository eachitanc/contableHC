<?
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
<title>CONTAFACIL</title>


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
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
</head>


</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="798" colspan="3">
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
            <div align="center"><a href='a.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>CATALOGO DE CUENTAS MAYORIZADO </strong></div>
    </div></td>
  </tr>
</table>
<div align="center">
<?php 
include('../config.php');		
		
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

// ide emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}

//******************* trimestres

$sxxq = "select * from fecha_ini_op";
$rxxq = mysql_db_query($database, $sxxq, $connectionxx);

while($rowxxxq = mysql_fetch_array($rxxq)) 
{
$fecha_ini_op=$rowxxxq["fecha_ini_op"];
}  
   
   
$ts1 = strtotime($fecha_ini_op);
$primer_t = strtotime('+3 month -1 day',$ts1);
$segundo_t = strtotime('+6 month -1 day',$ts1);
$tercer_t = strtotime('+9 month -1 day',$ts1);
$cuarto_t = strtotime('+12 month -1 day',$ts1);

$uno=date('Y/m/d', $primer_t);
$dos=date('Y/m/d', $segundo_t);
$tres=date('Y/m/d', $tercer_t);
$cuatro=date('Y/m/d', $cuarto_t);



include('../config.php');		
		
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");



//encabezado tabla
printf("
<center>

<table width='1360' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='30'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'></span>
</div>
</td>
<td align='center' width='30'><span class='Estilo4'><b>NIVEL</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CUENTA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>NOMBRE</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>INICIAL</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>DEBITO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>CREDITO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>SALDO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>CORRIENTE</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>NO CORRIENTE</b></span></td>
</tr>

");



$sqlxx2 = "select pgcp.cod_pptal,pgcp.nom_rubro,pgcp.tip_dato,aux_contaduria_gral_may.inicial,aux_contaduria_gral_may.debito,aux_contaduria_gral_may.credito,aux_contaduria_gral_may.saldo,aux_contaduria_gral_may.corriente,aux_contaduria_gral_may.no_corriente
from pgcp left join aux_contaduria_gral_may on pgcp.cod_pptal = aux_contaduria_gral_may.cuenta";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{

$tip_dato=$rowxx2["pgcp.tip_dato"];
$nivel=$rowxx2["aux_contaduria_gral_may.nivel"];
$cuenta=$rowxx2["pgcp.cod_pptal"];
$cuenta2=$rowxx2["aux_contaduria_gral_may.cuenta"];
$nombre=$rowxx2["aux_contaduria_gral_may.nombre"];
$inicial=$rowxx2["aux_contaduria_gral_may.inicial"];
$debito=$rowxx2["aux_contaduria_gral_may.debito"];
$credito=$rowxx2["aux_contaduria_gral_may.credito"];
$saldo=$rowxx2["aux_contaduria_gral_may.saldo"];
$corriente=$rowxx2["aux_contaduria_gral_may.corriente"];
$no_corriente=$rowxx2["aux_contaduria_gral_may.no_corriente"];

$ctrl1 = $inicial + $debito + $credito + $saldo + $corriente + $no_corriente;
		  
  if($ctrl1 == '' and $tip_dato == 'D')
  {
  }
  else
  {
  printf("<span class='Estilo4'><tr>");
  printf("<td align='center'><span class='Estilo4'> D </span></td>");
  printf("<td align='center'><span class='Estilo4'> %s </span></td>",$nivel);
  printf("<td align='center'><span class='Estilo4'> %s </span></td>",$cuenta2);
  printf("<td align='center'><span class='Estilo4'> %s </span></td>",$nombre);
  printf("<td align='center'><span class='Estilo4'> %s </span></td>",$inicial);
  printf("<td align='center'><span class='Estilo4'> %s </span></td>",$debito);
  printf("<td align='center'><span class='Estilo4'> %s </span></td>",$credito);
  printf("<td align='center'><span class='Estilo4'> %s </span></td>",$saldo);
  printf("<td align='center'><span class='Estilo4'> %s </span></td>",$corriente);
  printf("<td align='center'><span class='Estilo4'> %s </span></td>",$no_corriente);
  printf("</tr>"); 
  
  }			
			

} 

?>

 <?php
//-------
printf("</table></center>");
//--------	
?>

</div>
<table width="800" border="0" align="center">
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='a.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
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
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <?PHP include('../config.php'); echo $nom_emp ?>
        <br />
        <?PHP echo $dir_tel ?><br />
        <?PHP echo $muni ?> <br />
        <?PHP echo $email?> </div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <br />
        </a><br />
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a></div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
      <div align="center">Desarrollado por <br />
            <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
        Derechos Reservados - 2009 </div>
    </div></td>
  </tr>
</table>
</body>
</html>
<?
}
?>