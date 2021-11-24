<?
session_start();
if(!session_is_registered("login"))
{
header("Location: login.php");
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
</head>


</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><table width="750" border="0" align="center">
      <tr>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
        <td width="250">&nbsp;</td>
        <td width="250">VERIFICA HIPERVICNULOS Y RUTA DEL CONFIG.PHP - OJO - </td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
      <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
      <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      <tr>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('config.php');				
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
	  <div align="center"><?PHP include('config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>






<?
}
?>