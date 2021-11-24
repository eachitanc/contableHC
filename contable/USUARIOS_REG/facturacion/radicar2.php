<? set_time_limit(600);
$proceso =$_GET['ref'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<link type="text/css" rel="stylesheet" href="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo4 {font-weight: bold}
a:link {
	color: #0000CC;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000CC;
}
a:hover {
	text-decoration: underline;
	color: #0000CC;
}
a:active {
	text-decoration: none;
	color: #0000CC;
}
.Estilo5 {
	color: #990000;
	font-weight: bold;
}
</style>
</head>

<body>
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='radicar.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo2 Estilo4">
	Pasos a seguir para realizar la raicacio&oacute;n de Facturaci&oacute;n mensual<BR />
	VENTA  DE SERVICIOS DE SALUD</div>
	</div>	</td>
  </tr>
  <tr>
    <td>
<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;" align="center">
		Datos para la readicaci&oacute;n de facturación	</div>	</td>
  </tr>
  <tr>
    <td>
	<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<form name="radicar" method="post" action="radicar3.php">
    <input name="proceso" id="proceso" type="hidden" value="<?php echo $proceso;?>" />
    <table width="80%" border="1" class="bordepunteado1" align="center">
    <tr> 
    <td width="40%">Fecha de readicacion</td>
    <td width="60%"><input name="fecha" type="text" class="Estilo2" id="fecha" value="<?php $bb=date("Y/m/d"); printf($bb); ?>" size="12" />
	     
	      <input name="button" type="button" class="Estilo2" onclick="displayCalendar(document.forms[0].fecha,'yyyy/mm/dd',this)" value="Ver Calendario" /></td>
    </tr>
    <tr> 
    <td>Cuenta de cobro</td>
    <td><input name="cuenta" id="cuenta" size="13" type="text"  /></td>
    </tr>
    <tr> 
    <td colspan="2" align="center"><input type="submit" value="enviar" /></td>
    </tr>
    </table>
    </form>
    </div>
  </tr>
  
</table>
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='radicar.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
