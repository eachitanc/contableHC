<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
		// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT conta FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['conta']=='SI')
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<link rel="StyleSheet" href="dtree.css" type="text/css" />
<script type="text/javascript" src="dtree.js"></script>

<style type="text/css">
<!--
.Estilo2 {font-size: 9px}
a {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:visited {
	color: #666666;
	text-decoration: none;
}
a:hover {
	color: #666666;
	text-decoration: underline;
}
a:active {
	color: #666666;
	text-decoration: none;
}
a:link {
	text-decoration: none;
}
.Estilo7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>

<script>
function muestraURL(){
var miPopup
miPopup = window.open("consulta_cta.php","CONTAFACIL","width=800,height=400,menubar=no,scrollbars=yes")
}
</script>

</head>

<!--<body onload = "document.forms[0]['a'].focus()">-->
<body>




<table width="850" border="0" align="center">
  <tr>
    
    <td width="980" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><table width="600" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="3" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:15px;">
          <div align="center" class="Estilo4"><strong>OPCIONES PRINCIPALES P.G.C.P.  </strong></div>
        </div></td>
        </tr>
      <tr>
        <td width="200">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		  <div align="center"><a href="carga_pgcp.php" target="_parent"><img src="nuevo.jpg" alt="nueva cuenta" width="80" height="80" border="0" /></a></div>
		</div>		</td>
        <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center">
		  <a href="#" onclick="muestraURL()">
		  <img src="busca.jpg" alt="busca cuenta" width="80" height="80" border="0" /> 
		  </a>
		  </div>
        </div></td>
        <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center"><a href="consulta_pgcp.php" target="_parent"><img src="lista_all.jpg" alt="ver todas" width="80" height="80" border="0" /></a> </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center"><strong>Nueva Cuenta PGCP </strong></div>
        </div></td>
        <td bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center"><strong>Buscar Cuenta PGCP </strong></div>
        </div></td>
        <td bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center"><strong>Ver Todas las Cuentas PGCP </strong></div>
        </div></td>
      </tr>
      <tr>
        <td class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center"><a href="modi_borra_pgcp/cambiar_codigo.php" target="_parent"><img src="cambiar_cta.jpg" alt="cambiar cuenta" width="80" height="80" border="0" /></a></div>
        </div></td>
        <td class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center"><a href="modi_borra_pgcp/eliminar_codigo.php" target="_parent"><img src="borrar_cta.jpg" alt="borrar cuenta" width="80" height="80" border="0" /></a></div>
        </div></td>
        <td class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center"><a href="bloqueo/bloqueo.php" target="_parent"><img src="bloquear_cta.jpg" alt="bloquear cuenta" width="80" height="80" border="0" /></a></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center"><strong>Cambiar Cuenta PGCP </strong></div>
        </div></td>
        <td bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center"><strong>Eliminar Cuenta PGCP </strong></div>
        </div></td>
        <td bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center"><strong>Bloquear Cuenta PGCP </strong></div>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER</a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <?php include('../config.php');				
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
          <span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  

  <tr align="center">
    <td width="980">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?php include('../config.php'); echo $nom_emp ?><br />
	    <?php echo $dir_tel ?><BR />
	    <?php echo $muni ?> <br />
	    <?php echo $email ?>	</div>
	</div>	</td>
    <td width="980">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="980">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>
<?php
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>