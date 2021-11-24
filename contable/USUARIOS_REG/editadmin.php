<?
session_start();
if(!session_is_registered("login"))
{
header("Location: login.php");
exit;
} else {
?>
<HTML>
<HEAD>
<TITLE>CONTAFACIL ...::: Cambiar Password  :::...</TITLE>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.Estilo2 {font-size: 12px}
.Estilo3 {color: #FF0000}
-->
</style>
</HEAD>
<BODY>
<div align="center" class="Estilo1">
<h1 class="Estilo1 Estilo2">Actualizar Password</h1>
<br>
...::: <? echo $_SESSION["login"];?> :::... <span class="Estilo3">est&aacute; a punto de cambiar su contrase&ntilde;a</span><br>
<br>
<p><?


echo '<FORM METHOD="POST" ACTION="actualizar2.php">';


?>
  </p>
<p>  Digite su Nueva Contrase&ntilde;a<br>
  <INPUT TYPE="TEXT" NAME="new">
    <br>
  <br>
  <INPUT TYPE="SUBMIT" value="Actualizar">
  </FORM>
</p>
<p><a href="user.php" target="_parent">CANCELAR</a></p>
</div>
</BODY>
</HTML>
<?
}
?>