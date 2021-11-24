<html>
<head>
<title>CONTAFACIL ...::: Acceso al Sistema  :::...</title>

<script language="">
<!--
function cursor(){document.login.login.focus();}
// -->
</script>

<style type="text/css">
<!--
.Estilo1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo2 {font-size: 9px}
.Estilo4 {color: #666666}
.Estilo5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	font-size: 12px;
	font-weight: bold;
}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
a:link {
	text-decoration: none;
	color: #0000FF;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: underline;
	color: #0000FF;
}
a:active {
	text-decoration: none;
	color: #0000FF;
}
.Estilo8 {
	font-size: 12px;
	font-family: Verdana;
}
.Estilo11 {color: #CC0000}
a {
	font-family: Verdana;
	font-size: 9px;
}
.Estilo12 {font-size: 10px}
-->
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo9 {font-weight: bold}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body onLoad=cursor()>
<?php
global $nom_emp, $dir_tel, $muni, $email;

?>

<table width="600" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="3"><div align="center"><img src="../ADMIN/images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100"></div></td>
  </tr>
  <tr>
    <td colspan="3">
	<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center" class="Estilo5"><span>ACCESO AL SISTEMA COMO <span class="Estilo11">USUARIO REGISTRADO </span> </span><BR>
	    <BR><br>
	  </div>
	  <div align="center" class="Estilo8 ">
	   Por Favor escriba su Login y Password</div>
	</div>
	</td>
  </tr>
  
  <tr>
    <td colspan="3">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:15px; padding-right:3px; padding-bottom:5px;">
	  <div align="center">
	    
		
		<table border="0" cellspacing="0" cellpadding="2">
  <form action="comprueba.php" method="POST" class="miform" name="login">
    <tr>
      <td>
	  <div id="main_div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	    <div align="right"><span class="Estilo5">Usuario</span> </div>
	  </div>	  </td>
      <td>
        <input type="text" name="login">     </td>
    </tr>
    <tr>
      <td height="6">
	   <div id="main_div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	     <div align="right"><span class="Estilo5">Password</span></div>
	   </div>	  </td>
      <td height="6">
        <input type="password" name="pass">      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:3px;">
            <center><input type="submit" value="Entrar" class="boton"></center>
          </div></td>
    </tr>
  </form>
  </table>
		<BR>
  <a href="../../index.php" class="Estilo12">VOLVER AL INICIO </a>	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td width="200">
	<div class="dtree Estilo1 Estilo2 Estilo4" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?php include('config.php'); echo $nom_emp ?><br />
	    <?php echo $dir_tel ?><BR />
	    <?php echo $muni ?> <br />
	    <?php echo $email ?>	</div>
	</div>	</td>
    <td width="200">
	<div class="dtree Estilo1 Estilo2 Estilo4" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="200">
	<div class="dtree Estilo1 Estilo2 Estilo4" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../ADMIN/images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>


<!-- --------------------------------------------- -->


</body>
</html>