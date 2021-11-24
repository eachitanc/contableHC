<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header('Content-Type: text/html; charset=latin1'); 
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
$campo ='empresa';
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
if ($fl > 0 ) 
	{
		$ver1 = "style='display:none'";
		$obl = "";
	}else{
		$obl = "OBL_";
		$ver1 ='';
	}
$rw = mysql_fetch_array($rs);
// consulto el id del usuario
$sql="select id from usuarios where login = '$_SESSION[user]'";
$res =mysql_query($sql,$cx);
$row =mysql_fetch_array($res);
$log = $row['id'];
// consulto el nombre del dpto y mpio
$sq2="select nombre from dpto where cod_dpto ='$rw[cod_dpto]'";
$rs2 =mysql_query($sq2,$cx);
$rw2 =mysql_fetch_array($rs2);
$cod_dpto =$rw2["nombre"];
$sq3="select nombre from mpio where cod_mpio ='$rw[cod_mpio]' and cod_dpto ='$rw[cod_dpto]'";
$rs3 =mysql_query($sq3,$cx);
$rw3 =mysql_fetch_array($rs3);
$cod_mpio =$rw3["nombre"];
?>
<br />
<br />
<center>
<div id="contenedorr3">
<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%"  >
    <tr valign="center" bgcolor="#F5F5F5" class="menu3 arred"  >
      <td width="100%"  >&nbsp;DATOS EMPRESA   
         </td>
      <td width="3%" align="right" class="tituloForm" id="cerrar" onClick="cargaArchivo('admin/<?php echo $campo; ?>/reporte.php','columna1');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X&nbsp;</td>
    </tr>
    <tr valign="center" bgcolor="#FDFDFD" >
      <td colspan="2" > 
      
       <div class="tabbed-area">
        <!-- menu pestañas-->
                            <ul class="tabs group" id="lista">
                                <li><a href="#" id="lis_1" onclick="MostrarPes(id);">Datos generales</a></li>
                                <li><a href="#" id="lis_2" onclick="MostrarPes(id);">C&oacute;digos entidad</a></li>
                                <li><a href="#" id="lis_3" onclick="MostrarPes(id);">Regi&oacute;n</a></li>
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
      <td width="24%"  align="left" >Raz&oacute;n social:</td>
      <td width="73%" align="left"><input type="text" name="raz_soc" id="menu1_raz_soc" size="90" value="<?php echo $rw['raz_soc']; ?>" alt="1" onkeydown='displaycode(event,id);'/></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Nit:</td>
      <td align="left"><input type="text" name="nit" id="OBL_menu1_nit" size="16" value="<?php echo $rw['nit']; ?>" alt="1" onkeydown='displaycode(event,id);'/></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Direcci&oacute;n:</td>
      <td align="left"><input type="text" name="dir" id="menu1_dir" size="50" value="<?php echo $rw['dir']; ?>" alt="1" onkeydown='displaycode(event,id);' /></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Telef&oacute;no:</td>
      <td align="left"><input type="text" name="tel" id="menu1_tel" size="16" value="<?php echo $rw['tel']; ?>" alt="1" onkeydown='displaycode(event,id);'/></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Correo electr&oacute;nico:</td>
      <td align="left"><input type="text" name="email" id="menu1_email" size="30" value="<?php echo $rw['email']; ?>" alt="1" onkeydown='displaycode(event,id);'/></td>
    </tr>


<tr valign="center">
      <td> </td>
      <td  align="left" >Sitio web:</td>
      <td align="left"><input type="text" name="web_site" id="menu1_web_site" size="30" value="<?php echo $rw['web_site']; ?>" alt="1" onkeydown='displaycode(event,id);'/>	
      	</td>
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
      <td width="3%"> </td>
      <td width="26%"  align="left" >Departamento:</td>
      <td width="71%" align="left">
          		<input type='text' name='NO_cod_dpto' class='Estilo4' id='dpto' size='30' value="<?php echo $cod_dpto; ?>" />&nbsp;<i class='fa fa-caret-down'></i>
                <input type='hidden' name='cod_dpto' id='valdpto' value="<?php echo $rw['cod_dpto']; ?>"/>
    </tr>
    <tr valign="center">
      <td> </td>
      <td align="left" >Municipio:</td>
      <td align="left"><input type='text' name='NO_cod_mpio2' class='Estilo4' id='mpio' size='30' value="<?php echo $cod_mpio; ?>"/>&nbsp;<i class='fa fa-caret-down'></i>
                <input type='hidden' name='cod_mpio' id='valmpio' value="<?php echo $rw['cod_mpio']; ?>" /></td>
    </tr>
</table>

<table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_2" style="display:none">
   <tr>
   		<td colspan="3" height="1"></td>
   </tr>
    <tr valign="center" <?php echo $ver2; ?>>
      <td width="3%"> </td>
      <td width="24%"  align="left" >Codigo Minsalud (SIHO):</td>
      <td width="73%" align="left"><input type="text" name="cod_siho" id="menu1_cod_siho" size="20" value="<?php echo $rw['cod_siho']; ?>" alt="1" onkeydown='displaycode(event,id);'/></td>
    </tr>
    <tr valign="center" <?php echo $ver2; ?>>
      <td width="3%"> </td>
      <td width="24%"  align="left" >Codigo Contadur&iacute;a (CHIP):</td>
      <td width="73%" align="left"><input type="text" name="cod_cgn" id="menu1_cod_cgn" size="20" value="<?php echo $rw['cod_cgn']; ?>" alt="1" onkeydown='displaycode(event,id);'/></td>
    </tr>
    <tr valign="center" <?php echo $ver2; ?>>
      <td width="3%"> </td>
      <td width="24%"  align="left" >Codigo Contralor&iacute;a (SIRECI):</td>
      <td width="73%" align="left"><input type="text" name="cod_cgr" id="menu1_cod_cgr" size="20" value="<?php echo $rw['cod_cgr']; ?>" alt="1" onkeydown='displaycode(event,id);'/></td>
    </tr>
</table>

<table align="center" class="tr" border="0" cellspacing="0" width="100%" bgcolor="FDFDFD">
 <tr>
 <td height="4"></td>
 </tr>
 <tr  >
	 	 <td colspan="2" align="center">
           <input type="button" class="myButton" value="Enviar" id="enviar"  alt="1"   onclick="EnviarForm(form1,'admin/empresa/agregar.php','columna1');" onkeydown='displaycode(event,id);' />
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
	$("#dpto").autocomplete("admin/empresa/consultas/dpto.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		multiple:true,
		//highlight: false,
		//multipleSeparator: " ",
		selectFirst: false
	});
	$("#dpto").result(function(event, data, formatted) {
		$("#valdpto").val(data[1]);
	});
});

$().ready(function() {
	$("#mpio").autocomplete("admin/empresa/consultas/mpio.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		multiple:true,
		//highlight: false,
		//multipleSeparator: " ",
		selectFirst: false,
		dpto: "valdpto"
	});
	$("#mpio").result(function(event, data, formatted) {
		$("#valmpio").val(data[1]);
	});
});
document.getElementById("contenedorr3").style.width="80%";
document.getElementById("menu1_raz_soc").select(); 
</script>