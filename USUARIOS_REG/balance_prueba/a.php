<?
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<head>
   <title>CONTAFACIL</title>
<script src="jquery-1.3.2.min.js" type="text/javascript"></script>   
<script>
$(document).ready(function(){
   $("#enlaceajax").click(function(evento){
      evento.preventDefault();
      $("#cargando").css("display", "inline");
      $("#destino").load("balance_prueba.php", function(){
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

<body>
<center>
<br>
<a href="#" class="Estilo1x" id="enlaceajax"><b>Paso No. 1 : 
<br><br>Clic AQUI para Iniciar la Actualizacion de TODOS los Movimientos Contables <br>Generados por TODOS los usuarios del Sistema </b></a><br>
<div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:10px;">
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
<br><center class="Estilo1x">La consulta tardara 75 seg aprox, Tenga Paciencia por favor</center>
</div>
</center>

<br>
<div id="destino"></div>

</body>
</html> 
<?
}
?>