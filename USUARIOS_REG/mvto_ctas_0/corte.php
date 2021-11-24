<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<head>
   <title>CONTAFACIL</title>

<style type="text/css">
<!--
.Estilo1x {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
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
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo8 {color: #FFFFFF}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
</head>
<body>
<center>

  <br>
  <span class="Estilo4"><strong>SELECCIONE FECHA DE CORTE PARA EL INFORME  </strong></span>
  <br>
<br>

  <form id="form1" name="form1" method="post">
<div align="center">
<?
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
$ano=$rowxx["ano"];
}
$anio = substr($ano,0,4);

?>	  
<select name="corte" class="Estilo4" id="corte">
<option value="<? printf("$anio/03/31");?>">A 31 DE MARZO DE <? printf("$anio");?></option>
<option value="<? printf("$anio/06/30");?>">A 30 DE JUNIO DE <? printf("$anio");?></option>
<option value="<? printf("$anio/09/30");?>">A 30 DE SEPTIEMBRE DE <? printf("$anio");?></option>
<option value="<? printf("$anio/12/31");?>">A 31 DE DICIEMBRE DE <? printf("$anio");?></option>
</select>
<br />
<br />
<input name="Submit" type="submit" class="Estilo4" value="Seleccionar Corte" onClick="this.form.action = 'mvto_cta_0.php'"  />
</div>
</form>
</center>
<?php
}
?>
</body>
</html>
