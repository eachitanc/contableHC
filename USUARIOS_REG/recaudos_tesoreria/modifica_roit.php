<?php
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
<style type="text/css">
<!--
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
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo8 {color: #FFFFFF}
</style>

<style type="text/css">
<!--
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
.Estilo9 {font-size: 10px; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
table.bordepunteado1 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo10 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo10 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>

<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>
</head>
<body>

<?php
$id = $_POST['id'];
$id_reip = $_POST['id_reip'];
$id_caic = $_POST['id_caic'];
$id_recau = $_POST['id_recau'];
$cuenta = $_POST['cuenta'];
$nombre = $_POST['nombre'];
$vr_digitado = $_POST['vr_digitado'];
$tercero = $_POST['tercero'];
$des_recaudo = $_POST['des_recaudo'];

/*printf("

id : %s <br> id_reip : %s <br> id_caic : %s <br> id_recau : %s <br> cuenta : %s <br> nombre : %s<br> vr_digitado : %.2f<br> tercero : %s<br> des_recaudo : %s

",
$id ,$id_reip, $id_caic, $id_recau, $cuenta ,$nombre ,$vr_digitado ,$tercero ,$des_recaudo 
);*/

?>

<center>
  <span class="Estilo4"><strong>MODIFICACION DEL RECIBO OFICIAL DE INGRESOS</strong></span>
</center>
<form method="post" name="a" id="a" onSubmit="return confirm('Verifique si todos los datos estan correctos')">
  <table width="800" height="36" border="1" align="center" class="bordepunteado1">
    <tr>
      <td width="176" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4">
          <div align="center"><strong>TERCERO</strong> </div>
        </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4"><?php printf("%s",$tercero); ?></div>
      </div></td>
      <td width="200" bgcolor="#F5F5F5">
	  <input name="id" type="hidden" value="<?php printf("%s",$id); ?>" />
	  <input name="id_reip" type="hidden" value="<?php printf("%s",$id_reip); ?>" />
	  <input name="id_caic" type="hidden" value="<?php printf("%s",$id_caic); ?>" />
	  <input name="id_recau" type="hidden" value="<?php printf("%s",$id_recau); ?>" />
	  <input name="cuenta" type="hidden" value="<?php printf("%s",$cuenta); ?>" />
	  <input name="nombre" type="hidden" value="<?php printf("%s",$nombre); ?>" />
	  <input name="tercero" type="hidden" value="<?php printf("%s",$tercero); ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4">
          <div align="center"><strong>MODIFICA DESCRIPCION</strong> </div>
        </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4">
          <div align="center">
          <input name="des_recaudo" type="text" class="Estilo4" id="des_recaudo" onKeyUp="a.des_recaudo.value=a.des_recaudo.value.toUpperCase();" size="80" value="<?php printf("%s",$des_recaudo); ?>" />
          </div>
        </div>
      </div></td>
      <td bgcolor="#F5F5F5">&nbsp;</td>
    </tr>
  </table>
  <br />
  <table width="800" border="1" align="center" class="bordepunteado1">
    <tr>
      <td width="196" bgcolor="#FFFFFF"></td>
      <td width="190" bgcolor="#FFFFFF"></td>
      <td width="186" bgcolor="#FFFFFF"></td>
      <td width="198" bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center" class="Estilo4">
          <div align="center"><strong>IMPUTACION PRESUPUESTAL</strong></div>
        </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center"><span class="Estilo4"><strong>Digite Nuevo Valor</strong></span><br />
        </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <center class='Estilo4'>
            <span class="Estilo10"><?php printf("%s",$cuenta); ?></span>
          - <span class="Estilo10"><?php printf("%s",$nombre); ?></span>
          </center>
        </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <input name="vr_digitado" type="text" class="Estilo4" id="vr_digitado" size="20" onKeyPress="return validar(event)" style="text-align:right" value="<?php printf("%s",$vr_digitado); ?>" />
        </div>
      </div></td>
    </tr>
    
    <tr>
      <td colspan="4" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <input name="Submit322" type="submit" class="Estilo4"  value="Modificar" 
			onclick="this.form.action = 'modifica_roit2.php'" />
        </div>
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
printf("
<br>
<center class='Estilo8'>
<form method='post' action='confirma_borra_roit.php'>
<input type='hidden' name='id_recau' value='%s'>
<input type='submit' name='Submit' value='Volver Sin Hacer Cambios' class='Estilo9' />
</form>
</center>
",$id_recau);
}
?>