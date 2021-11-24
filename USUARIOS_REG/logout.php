<?
session_start();
if(!isset($_SESSION)){
header("location:login.php");
} else {
session_unset();
session_destroy();
echo "<title>CONTAFACIL ...::: Salida del Sistema :::...</title>";
echo "<br><br><center class='Estilo4'>Las variables de sesion han sido eliminadas <br> La sesion se ha dado por finalizada correctamente <br> Click <a href=\"login.php\"><b>aqui para volver</b></a></center>";
}
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
	

<style type="text/css">
<!--
.Estilo18 {	color: #FF0000;
	font-weight: bold;
}
.Estilo18 {font-weight: bold}
.Estilo19 {	color: #FF0000;
	font-weight: bold;
}
.Estilo19 {font-weight: bold}
.Estilo20 {
	color: #990000;
	font-weight: bold;
}
.Estilo21 {	color: #FF0000;
	font-weight: bold;
}
.Estilo21 {font-weight: bold}
-->
</style>
