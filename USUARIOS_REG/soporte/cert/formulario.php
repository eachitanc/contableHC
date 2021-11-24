<br />
<center>
<form action="" method="post" name="inicio" id="form1">
	Usuario: <br />
	<input name="usuario" type="text" id="usuario" size="14" title="Ingrese el nombre de usuario registrado" />
	<br />
	Contrase&ntilde;a:<br />
	<input name="pass" type="password" id="pass" size="15" title="Ingrese su contraseña" />
	<br /><br />
	<input type="button"  name="submit" value="Enviar" style="background:#72A0CF; border:0;color: #FFFFFF;font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;"  onclick="EnviarForm('admin/logear.php','contenido');"/>
	<br />	
</form>	
</center>
<script>
document.getElementById("usuario").focus();
</script>