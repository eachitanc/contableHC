<?php
$fecha_fin = $_GET['fecha_fin'];
$cuenta =$_GET['cuenta'];
?>
<br />
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="cuenta" id="cuenta" size="10" value="<?php echo $cuenta; ?>" />
<input type="hidden" name="fecha_fin" id="fecha_fin" size="10" value="<?php echo $fecha_fin; ?>"  />
<table width="500" border="0" align="center" class='bordepunteado1 Estilo4' cellpadding="3">
  <tr bgcolor="DCE9E5">
  	<td colspan="2" align="center"><b>REGISTRE DOCUMENTOS PENDIENTES SIN CONCILIAR</b></td>
  </tr>
  <tr>
  	<td align="right"><b>Fecha:</b></td>
    <td><input name="fecha" type="text" class="required Estilo4" id="fecha" value="<?php echo $ano; ?>" size="12"  onblur="ValidaFecha(id);" />
      <input name="button2" type="button" class="Estilo4" onclick="displayCalendar(document.form1.fecha,'yyyy/mm/dd',this)" value="Seleccione Fecha" /></td>
  </tr>
  <tr>
  	<td align="right"><b>No de documento:</b></td>
    <td><input type="text" name="dcto" id="dcto" size="10" /></td>
  </tr>
  <tr>
  	<td align="right"><b>Detalle:</b></td>
    <td><input type="text" name="detalle" id="detalle" size="40" /></td>
  </tr>
  <tr>
    <td align="right"><b>Cheque / Ref:</b></td>
    <td><input type="text" name="cheque" id="cheque" size="10" /></td>
  </tr>
  <tr>
    <td align="right"><b>Valor debito:</b></td>
    <td><input type="text" name="debito" id="debito" size="10" onkeypress='return validar(event)'  style="text-align:right" /></td>
  </tr>
  <tr>
    <td align="right"><b>Valor credito:</b></td>
    <td><input type="text" name="credito" id="credito" size="10" onkeypress='return validar(event)' style="text-align:right" /></td>
  </tr>
  <tr>
  	<td colspan="2" align="center"><input type="button" name="Submit2" value="&nbsp;Enviar&nbsp;" style="background:#9C3; color:#FFFFFF; border:none" onclick="EnviarForm(form1,'agregar_pen.php','conten');" /></td>
  </tr>

</table>
</form>