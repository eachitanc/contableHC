<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
		
	// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT info FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['info']=='SI')
{

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
      $("#destino").load("informe1.php", function(){
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
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo8 {color: #FFFFFF}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script></head>

<body>
<center>
  <p><span class="Estilo1x">Antes de Proceder asegurese de : <br>
    <br>
    1. Haber actualizado todos los Mvtos Contables (Opciones 4.4 y/o 4.8 del Menu Principal). <br>
    2. Haber cargado la interfaz Presupuesto - Contabilidad (Opcion 4.12 del menu Principal).<br>
  <br>
    Caso Contrario, el Catalogo de Cuentas se generara de forma incorrecta.</span><br>
  </p>
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
<input name="Submit" type="submit" class="Estilo4" value="Seleccionar Corte" onClick="this.form.action = 'a.php'"  />
</div>
</form>
  <p>
<?
$corte = $_POST['corte'];
printf("<u><b><center class='EStilo4'>Fecha de Corte Seleccionada $corte </center></b></u>");
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
//************* borro la tabla		
$tabla6="aux_corte_cgn";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";
mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir6 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};
//********************crea tabla fut_aux_ing
$tabla7="aux_corte_cgn";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `corte` varchar(100) NOT NULL default ''

)TYPE=MyISAM AUTO_INCREMENT=1 COLLATE=latin1_general_ci ";
		
		mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}
		
$sql = "INSERT INTO aux_corte_cgn (corte) VALUES ('$corte')";
mysql_query($sql, $conexion) or die(mysql_error());

//***
$sql = "update aux_corte_cgn set corte='$corte'";
$resultado = mysql_db_query($database, $sql, $conexion);
		
?>    
    <a href="#" class="Estilo1x" id="enlaceajax"><b><br>
    Clic AQUI para Iniciar la Actualizacion de TODOS <br>
    los Movimientos y Saldos Contables <br>
    a la Fecha</b></a><br>
    <br>
    </p>
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
<img src="image.gif" width="160" height="150">
<br><center class="Estilo1x">La consulta tardara 6 Min aprox, Tenga Paciencia por favor</center>
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
}
?>