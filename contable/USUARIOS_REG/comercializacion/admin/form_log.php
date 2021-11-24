<script>
// asigono tabindex a tdos los que tengan title 1
$().ready(function() {
		var k =0;	
		 $(":input").each(function (i) {
			   var value = this.alt;
			  if (value ==1)
			  {
			  $(this).attr('tabindex', k + 1);
			  k++;
			  }
		 });
})
function displaycode(evt,camp)
 {
	 var charCode = (evt.which) ? evt.which : event.keyCode;
 	 //alert(charCode);
	 if (charCode == 40 || charCode ==13 )
	 {
		var tabx = document.getElementById(camp).tabIndex;
		var nextab =tabx+1;
 		$(':input[tabindex=\''+nextab+'\']').focus();
		$(':input[tabindex=\''+nextab+'\']').select();
	 }
  	 if (charCode == 38 )
	 {
		var tabx = document.getElementById(camp).tabIndex;
		var nextab =tabx-1;
 		$('input[tabindex='+nextab+']').select();
	 }
 }
</script>
<br />
<br />
<br />
<br />
<div id="contenedorr3">
<center>
 <div id="fomulario" style="background:#FFF">
<form action="" method="post" name="inicio" id="inicio">
<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr valign="center" bgcolor="#F9F9F9">
      <td width="100%" class="menu3"  >&nbsp;Iniciar sesi&oacute;n   
         </td>
      <td width="3%" align="right" class="tituloForm" id="cerrar" onClick="cargaArchivo('admin/<?php echo $campo; ?>/reporte.php','columna1');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X&nbsp;</td>
    </tr>
    <tr valign="center" bgcolor="#F9F9F9">
      <td colspan="2" align="center" > 
      
       <!--div class="tabbed-area">
        <!-- menu pestañas>
                            <ul class="tabs group">
                                <li><a href="#box-1">Datos generales</a></li>
                                <li><a href="#box-2">&nbsp;&nbsp;Otros&nbsp;&nbsp;</a></li>
                            </ul>
       	</div -->  
        <img src="logos/logo.png" width="130"  />
         </td>
             
 	

 </table>

<br />


	<label class="menu4">Usuario: </label><br />
	<input name="usuario" type="text" id="usuario" size="14" title="Ingrese el nombre de usuario registrado" alt="1" onkeydown='displaycode(event,id);'  />
	<br />
	<label class="menu4">Contrase&ntilde;a:</label><br />
	<input name="pass" type="password" id="pass" size="15" title="Ingrese su contraseña" alt="1" onkeydown='displaycode(event,id);'/>
	<br /><br />
	<!--a href="#" class="myButton" onclick="EnviarForm(inicio,'admin/logear.php','Log');" id="enviar">Enviar</a-->
    <input type="button" class="myButton" value="Enviar" id="enviar"  alt="1"  onclick="EnviarForm(inicio,'admin/logear.php','Log');" onkeydown='displaycode(event,id);'/>
	<br />
    <br />	
</form>	
</div>
</center>
</div>
<script>
document.getElementById("contenedorr3").style.width="25%"; 
document.getElementById("usuario").select();
</script>