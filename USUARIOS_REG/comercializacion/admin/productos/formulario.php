<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header('Content-Type: text/html; charset=utf8'); 
?>
<script>
function validaPass()
{
	var pass1 = document.getElementById("OBL_pass").value;	
	var pass2 = document.getElementById("OBL_pass2").value;	
	if (pass1 != pass2)
	{
		alert('Verifique la las constraseñas sean iguales...');
		document.getElementById("OBL_pass2").focus();		
	}

}
//
// JavaScript Document
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function ValidaDocumento(id){
	//donde se mostrará el formulario con los datos
	var doc = document.getElementById(id).value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST","admin/usuarios/consultas/documento.php",false);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			var res = ajax.responseText
			if (res >0)
				{
					alert("El número de documento ya fue registrado...");
					document.getElementById(id).value='';
					document.getElementById(id).focus();
				}
			//mostrar el formulario
			// divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("doc="+doc);
}

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
<?php
// campó y tabla
$campo ='productos';
$texto = strtoupper($campo);
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$id = $_GET["id"];
$sq = "select * from $campo where id = '$id'";
$rs = mysql_query($sq);
$fl = mysql_num_rows($rs);
$ver2 ="";
$rw = mysql_fetch_array($rs);
if ($fl > 0 ) 
	{
		$ver1 = "style='display:none'";
		$obl = "";
        $fecha_licen = "$rw[fecha_licen]";
		$fecha_soporte = "$rw[fecha_soporte]";
	}else{
		$obl = "OBL_";
		$ver1 ='';
		$fecha_licen = date('d/m/Y');
		$fecha_soporte = date('d/m/Y');
	}
// consulto el id del usuario
$sql="select id from usuarios where login = '$_SESSION[user]'";
$res =mysql_query($sql,$cx);
$row =mysql_fetch_array($res);
$log = $row['id'];

?>
<br />
<br />
<center>
<div id="contenedorr3">
<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%"  >
    <tr valign="center" bgcolor="#F5F5F5" class="menu3 arred"  >
      <td width="100%"  >&nbsp;CONFIGURACION DEL PRODUCTO 
         </td>
      <td width="3%" align="right" class="tituloForm" id="cerrar" onClick="cargaArchivo('admin/<?php echo $campo; ?>/reporte.php','columna1');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X&nbsp;</td>
    </tr>
    <tr valign="center" bgcolor="#FDFDFD" >
      <td colspan="2" > 
      
       <div class="tabbed-area">
        <!-- menu pestañas-->
                            <ul class="tabs group" id="lista">
                                <li><a href="#" id="lis_1" onclick="MostrarPes(id);">Datos generales</a></li>
                                 <li><a href="#" id="lis_2" onclick="MostrarPes(id);">Licencia</a></li>
                                 <li><a href="#" id="lis_3" onclick="MostrarPes(id);">Contacto</a></li>
                                 <li><a href="#" id="lis_4" onclick="MostrarPes(id);">Empresa</a></li>
                            </ul>
       	</div>  
         </td>
    </tr>


 </table>
 <div id="fomulario" style="background:#FFF">
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="tabla" value="<?php echo $campo; ?>"  /> 
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_1">
   <tr>
   		<td colspan="3" height="1"></td>
   </tr>
    <tr valign="center">
      <td width="3%"> </td>
      <td width="24%"  align="left" >Nombre producto:</td>
      <td width="73%" align="left"><input type='text' name='nombre' class='Estilo4' id='OBL_1_nombre' size='60' value='<?php echo $rw['nombre']; ?>' /> 
    </tr>
     <tr valign="center">
      <td> </td>
      <td  align="left" >Versi&oacute;n:</td>
      <td align="left"><input type="text" name="version" id="OBL_1_version" size="10" value="<?php echo $rw['version']; ?>" alt="1" onkeydown='displaycode(event,id);' /></td>
    </tr>
    
     <tr valign="center">
      <td> </td>
      <td  align="left" >Tipo licencia:</td>
      <td align="left"><select name="tip_licen" id="OBL_2_tip_licen" >
                        <option value=""></option>
						<?php
                        $sq2 = "SELECT * FROM tip_licen";
                        $rs2 = mysql_query($sq2);
                        $fi2 = mysql_num_rows($rs2);
                        for ($i=0; $i<$fi2; $i++) {
                            $rw2 = mysql_fetch_array($rs2);
								if ($rw2['id'] == $rw['tip_licen'])
		                            echo "<OPTION VALUE='$rw2[id]' selected>$rw2[tipo]</OPTION>";
        						else 
									echo "<OPTION VALUE='$rw2[id]'>$rw2[tipo]</OPTION>";
		                }
						?>
                       </select>	</td>
    </tr>
    
     <tr valign="center">
      <td> </td>
      <td  align="left" >Estado:</td>
      <td align="left"><select name="estado" id="OBL_1_estado">
      				   <option value=""></option>
					   <?php 
					   $i=0; $j=0;
                       $datos = array ("","Activo","Bloquedo","Suspendido");
                       for ($i=0; $i<3;$i++)
					   {
						   $j =$i+1 ;
					   if ($rw['estado'] == $j)
					   		echo "<option value='$j' selected>$datos[$j]</option>";
					   else		
                       		echo "<option value='$j' >$datos[$j]</option>";
					   }
						?> 
                       </select>	</td>
    </tr>
    
 <tr>
 <td height="8" colspan="3"> </td>
 </tr>
</table>

<table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_2" style="display:none"> 
     <tr>
   		<td colspan="3" height="1"></td>
   </tr>
    <tr valign="center">
      <td  width="3%"> </td>
      <td  width="24%"align="left" >No Licencia:</td>
      <td  width="73%"align="left"><input type="text" name="licencia" id="OBL_2_licencia" size="30" value="<?php echo $rw['licencia']; ?>" alt="1" onkeydown='displaycode(event,id);' /></td>
    </tr>
    
    
    <tr valign="center">
      <td> </td>
      <td  align="left" >Fecha Licencia:</td>
      <td align="left"><input name="fecha_licen"   type="text" size="10" id="OBL_2_fecha_licen"  value="<?php echo $fecha_licen; ?>" onblur="ValidaFecha(id);" title="Formato de fecha dd/mm/aaaa" />
		 	<input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form1.OBL_2_fecha_licen,'dd/mm/yyyy',this)" value="Selecionar fecha"  /></td>
    </tr>

	<tr valign="center">
      <td> </td>
      <td  align="left" >No Licencia soporte:</td>
      <td align="left"><input type="text" name="licen_soporte" id="OBL_2_licen_soporte" size="30" value="<?php echo $rw['licen_soporte']; ?>" alt="1" onkeydown='displaycode(event,id);' /></td>
    </tr>
    
    <tr valign="center">
      <td> </td>
      <td  align="left" >Fecha Licencia soporte:</td>
      <td align="left"><input name="fecha_soporte"   type="text" size="10" id="OBL_1_fecha_soporte"  value="<?php echo $fecha_soporte; ?>" onblur="ValidaFecha(id);" title="Formato de fecha dd/mm/aaaa" />
		 	<input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form1.OBL_1_fecha_soporte,'dd/mm/yyyy',this)" value="Selecionar fecha" /></td>
    </tr>
 <tr>
 <td height="8" colspan="3"> </td>
 </tr>
</table>

<table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_3" style="display:none"> 
     <tr>
   		<td colspan="3" height="1"></td>
   </tr>
   <tr valign="center">
      <td  width="3%"> </td>
      <td  width="24%" align="left" >Contacto:</td>
      <td  width="73%"align="left"><input type="text" name="contacto" id="contacto" size="60" value="<?php echo $rw['contacto']; ?>" alt="1" onkeydown='displaycode(event,id);' /></td>
    </tr>
    <tr valign="center">
      <td> </td>
      <td  align="left" >Tel&eacute;fono</td>
      <td align="left"><input type="text" name="telefono" id="telefono" size="20" value="<?php echo $rw['telefono']; ?>" alt="1" onkeydown='displaycode(event,id);' /></td>
    </tr>
    <tr valign="center">
      <td> </td>
      <td  align="left" >Correo</td>
      <td align="left"><input type="text" name="correo" id="correo" size="30" value="<?php echo $rw['correo']; ?>" alt="1" onkeydown='displaycode(event,id);' /></td>
    </tr>
    <tr valign="center">
      <td> </td>
      <td  align="left" >Web</td>
      <td align="left"><input type="text" name="web" id="web" size="60" value="<?php echo $rw['web']; ?>" alt="1" onkeydown='displaycode(event,id);' /></td>
    </tr>
 <tr>
 <td height="8" colspan="3"> </td>
 </tr>
</table>

    <table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_4" style="display:none"> 
         <tr>
            <td colspan="3" height="1"></td>
       </tr>
       <tr valign="center">
          <td  width="3%"> </td>
          <td  width="24%" align="left" >Empresa:</td>
          <td  width="73%"align="left"><select name="id_empresa" id="OBL_4_id_empresa" >
                        <option value=""></option>
						<?php
                        $sq2 = "SELECT id,raz_soc FROM empresa";
                        $rs2 = mysql_query($sq2);
                        $fi2 = mysql_num_rows($rs2);
                        for ($i=0; $i<$fi2; $i++) {
                            $rw2 = mysql_fetch_array($rs2);
								if ($rw2['id'] == $rw['id_empresa'])
		                            echo "<OPTION VALUE='$rw2[id]' selected>$rw2[raz_soc]</OPTION>";
        						else 
									echo "<OPTION VALUE='$rw2[id]'>$rw2[raz_soc]</OPTION>";
		                }
						?>
                       </select></td>
        </tr>
        
     <tr>
     <td height="8" colspan="3"> </td>
     </tr>
    </table>
<table align="center" class="tr" border="0" cellspacing="0" width="100%" bgcolor="FDFDFD">
 <tr>
 <td height="4"></td>
 </tr>
 <tr  >
	 	 <td colspan="2" align="center">
           <input type="button" class="myButton" value="Enviar" id="enviar"  alt="1"   onclick="EnviarForm(form1,'admin/productos/agregar.php','columna1');" onkeydown='displaycode(event,id);' />
           	  </td>
	</tr> 
   <tr>
 <td height="4"> </td>
 </tr>
</table>

</form>
</div>
</div>
</center>
<br />
<br />
<script>
$().ready(function() {
	$("#tercero").autocomplete("admin/actividades/empresa.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		multiple:true,
		//highlight: false,
		//multipleSeparator: " ",
		selectFirst: false
	});
	$("#tercero").result(function(event, data, formatted) {
		$("#valtercero").val(data[1]);
	});
});
document.getElementById("contenedorr3").style.width="70%";
document.getElementById("OBL_menu1_nit").select(); 
</script>