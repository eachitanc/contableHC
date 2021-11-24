<? session_start(); ?>
<html>
<head>
   <title>CONTAFACIL</title>
<script src="jquery-1.3.2.min.js" type="text/javascript"></script>   
<script>
$(document).ready(function(){
   $("#enlaceajax").click(function(evento){
      evento.preventDefault();
      $("#cargando").css("display", "inline");
      $("#destino").load("libro_auxiliar.php", function(){
         $("#cargando").css("display", "none");
      });
   });
})
</script>
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
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<?	// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sq13="select estado from actualizar";	
		$rs13 = mysql_db_query($database, $sq13, $cx);
		$rw13 = mysql_fetch_array($rs13);
		if ($rw13['estado'] != 0)
		{
		$sql="SELECT teso,conta FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
		}
if ($rw['teso']=='SI' || $rw['conta']=='SI')
{
	
	
?>
<body>
<center>
<br>
<a href="#" class="Estilo1x" id="enlaceajax"><b>Clic AQUI para Iniciar la Carga de <br><br><b>TODOS</b><br><br> los Movimientos Contables<br>Hasta la Fecha </b></a>
<br>
<br>
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:200px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../user.php' target='_parent' class="Estilo1x">VOLVER A PRINCIPAL </a> </div>
      </div>
    </div>
  </div>
</div>

<div id="cargando" style="display:none; color: green;">
<img src="libaux.gif" width="160" height="150">
<br><center class="Estilo1x">La consulta tardara 1min 10seg aprox, Tenga Paciencia por favor</center>
</div>
</center>

<br>
<div id="destino"></div>

</body>
</html> 
<?
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
?>