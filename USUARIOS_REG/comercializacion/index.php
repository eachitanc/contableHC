<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--html xmlns="http://www.w3.org/1999/xhtml"-->
<html lang="es" xml:lang="es" xmlns= "http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>..: FARMACIA ::..</title>
<link rel=StyleSheet href="css/estilos.css" type="text/css" />
<link rel=StyleSheet href="css/font-awesome.css" type="text/css" />
<link rel=StyleSheet href="css/jquery.autocomplete.css" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/carga.js"></script>
<script type="text/javascript" src="js/estilos.js"></script>
<script type="text/javascript" src="js/vista_menu.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/municipios.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>

<!--- Calendario -->
<link type="text/css" rel="stylesheet" href="objetos/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
<script type="text/javascript" src="objetos/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style>
#divCargando
{
	position:absolute;
	top:5px;
	right:5px;
	background-color: red;
	color: white;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
	padding:5px;
}
</style>
</head>
<body>
<div id="divCargando" style="display:none">
	Por favor espere...
</div>
<!--- tabla para montar encabezado-->
<table border="0"  cellpadding="0" cellspacing="0"  width="100%" align="center" background="logos/sup.png" >
<tr>
  <td width="5%" rowspan="2" align="left" valign="bottom"><img src="logos/logo.png" width="80" align="middle" /></td>
  <td width="12%" rowspan="2" align="left" valign="bottom"><img src="logos/text.png" width="200"  /></td>
  <td height="5" align="right" valign="top"></td>
</tr>
<tr>
  <td width="83%" height="40" align="right" valign="top"><div id="Log" align="right" class="log"> <?php echo $_SESSION["nombre"].'&nbsp;  '; ?></div></td>
</tr>
</table>
<!-- Tabla para monter contenido -->
<table border="0"  cellpadding="0" cellspacing="0"  width="100%" bgcolor="#ffffff" >
<tr>
	<td valign="top"><div id='menuHoriz'><?php include('menu/menu_inicio.php'); ?></div></td>
  </tr>
<tr>
</table>
<div id='contenido' align="center">	
<i class="fa fa-user"></i>X

</div>
</body>
</html>