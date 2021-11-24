<?php
// Realizo la conexion con la base de datos
include ('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
?>
<form action="" method="post" name="form1" id="form1">
<table align="center" class="punteado" border="0" cellspacing="0" width="50%" bgcolor="#F4F4F4">
    <tr valign="center">
      <td width="95%" align="left"  >Agregar nueva tarea...</td>
      <td width="5%" align="center" id="cerrar" onClick="cargaArchivo('perfiles_reporte.php');" ><img src="../simbolos/volver.jpg" border="0" width="18"/></td>
    </tr>
</table>
<table align="center" class="punteado" border="0" cellspacing="10" width="50%" bgcolor="#FBFBFB">
    <tr valign="center">
      <td width="32%" align="center" nowrap="nowrap" >&nbsp;Fecha:</td>
      <td width="68%" align="left"><input name="fecha_ini"   type="text" size="8" id="fecha_ini" readonly="readonly" value="<?php echo date('Y/m/d'); ?>" />
		 	<input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form1.fecha_ini,'yyyy/mm/dd',this)" value="Seleccione Fecha" /> </td>
    </tr>
   <tr valign="center">
      <td nowrap="nowrap" align="center" >&nbsp;&nbsp;Cargo:</td>
      <td align="left"><input  type="text" name="cargo" id="OBL_cargo" size="59" value="<?php echo $consec3; ?>" /></td>
    </tr>
    
     <tr valign="center">
      <td nowrap="nowrap" align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Funciones:</td>
      <td align="left"><textarea name="des" id="OBL_des" rows="5" cols="39"><?php echo $des; ?></textarea></td>
    </tr>

    <tr>
   		<td colspan="2" height="2"></td>
   </tr>

</table>
<br />
<table align="center" class="tr" border="0" cellspacing="0" width="50%">
 <tr  >
	 	 <td colspan="2" align="center"><input type="button" name="Submit2" value="&nbsp;Enviar&nbsp;" style="background:#9C3; color:#FFFFFF; border:none" onclick="EnviarForm(form1,'perfiles_agregar.php');" />
	 	   <input type="reset" name="Submit" value="&nbsp;Limpiar&nbsp;" style="background:#72A0CF; color:#FFFFFF; border:none" /> 	  </td>
	</tr> 
</table>
</form>
