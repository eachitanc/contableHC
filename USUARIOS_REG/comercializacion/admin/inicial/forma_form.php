<?php
session_start();
$id = $_GET['id'];
$tipo_art = $_GET['tipo_art'];
$nombre = $_GET['nombre'];
// Verifico permisos del sistema
if ($_SESSION["rool"] =="Admin" || $_SESSION["rool"] =="Regente") 
{
	// Realizo la conexion con la base de datos
	include ('../../config.php');
	$cx = mysql_connect($server,$dbuser,$dbpass);
	
	if (!$cx) {
		die('No pudo conectarse: ' . mysql_error());
	}
?>
<div id="tutulo" align="left" >
<form action="" method="post" name="form4" id="form4">  
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3">CREAR NUEVA FORMA</td>
        <td  align="right" id="cerrar" onClick="CierrVentana4()" onMouseOver="punteroOn();" onMouseOut="punteroOff();" > X</td>
	</tr>
 </table>

 <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">   
    <tr bgcolor="#F5F5F5">
    	<td align='left'>&nbsp;</td>
    </tr>
 </table> 
   <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">  
     <tr>
         <td>Forma:</td>
         <td><input type='hidden' name='id' id='id' size='5' value='<?php echo $id ; ?>' />
         <input type='text' name='forma' id='forma' size='80' value='<?php echo $nombre ; ?>' /></td>
     </tr>
      <tr>
         <td></td>
         <td><input type='hidden' name='tipo_art4' id='tipo_art4'  value='<?php echo $tipo_art ; ?>' /></td>
     </tr>
     <tr height="50" valign="top">  
         <td></td>
         <td colspan="2"> <input name="nuevo" id="nuevo4" type="button" class="myButton" value="Guardar" style="background-color:#E8EEFA" onClick="nuevoArt4();"   /></td>
         <td></td>
     </tr>
 </table>
 <br />
</form> 
  </div>
    
<?php
}else{  // Cuando el usuario no es admiistrador 
echo "<script>
		alert('El usuario no tiene permisos de Usuario. ');
		cargaArchivo('admin/form_log.php','contenido');	
	</script>";
}
?>
 <div id="reporte">
         	
    </div>
