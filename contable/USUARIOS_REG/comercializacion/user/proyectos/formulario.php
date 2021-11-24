<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
session_start();
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

</script>
<?php
// campó y tabla
$campo ='entidad';
$texto = strtoupper($campo);
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$id = $_GET["id"];
$sq = "select * from $campo where id = '$id'";
$rs = mysql_query($sq);
$fl = mysql_num_rows($rs);
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

?>
<br />
<br />
<div id="contenedorr3">


<table align="center" border="0" cellspacing="0" cellpadding="0" width="99%">
    <tr valign="center">
      <td width="99%"  >Datos <?php echo $texto; ?></td>
      <td width="3%" align="right" class="tituloForm" id="cerrar" onClick="cargaArchivo('admin/<?php echo $campo; ?>/reporte.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
    </tr>

  <tr  align="left" height="30">
	 	 <td colspan="2" > 
         <form action="" method="post" name="form_menu" id="form_menu">   
          <input type="button" id="menu1" value="Datos generales" style="background:#72A0CF; color:#FFFFFF; border:double;" onClick="VerPestana(id);"/> 
          </form>
		 </td>	
	</tr>
 </table>
 <div id="fomulario" style="background:#FFF">
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="tabla" value="<?php echo $campo; ?>"  /> 
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<table  class="tr punteado ConcepForm" border="0" cellspacing="10"  bgcolor="#ffffff" id="pestana_1" align="center">
   <tr>
   		<td colspan="3" height="1"></td>
   </tr>
    <tr valign="center">
      <td> </td>
      <td  align="left" >Nit:</td>
      <td align="left"><input type="text" name="nit" id="menu1_nit" size="16" value="<?php echo $rw['nit']; ?>" /></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Nombre:</td>
      <td align="left"><input type="text" name="nombre" id="<?php echo $obl2; ?>_menu1_nombre" size="80" value="<?php echo $rw['nombre']; ?>" /></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Direcci&oacute;n:</td>
      <td align="left"><input type="text" name="direccion" id="<?php echo $obl2; ?>menu1_dieccion" size="50" value="<?php echo $rw['direccion']; ?>" <?php echo $ver; ?>  /></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Tel&aacute;fono:</td>
      <td align="left"><input type="text" name="telefono" id="menu1_telefono" size="20" value="<?php echo $rw['telefono']; ?>" /></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Contacto:</td>
      <td align="left"><input type="text" name="contacto" id="menu1_contacto" size="50" value="<?php echo $rw['contacto']; ?>" /></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Correo:</td>
      <td align="left"><input type="text" name="correo" id="menu1_correo" size="50" value="<?php echo $rw['correo']; ?>" />
            <input type="hidden" name="login" id="menu1_login" size="50" value="<?php echo $log; ?>" /></td>
    </tr>
     <tr>
   		<td colspan="3" height="10"></td>
   </tr>
</table>

<br />
<table align="center" class="tr" border="0" cellspacing="0" width="99%">
 <tr  >
	 	 <td colspan="2" align="center"><input type="button" name="Submit2" value="&nbsp;Enviar&nbsp;" style="background:#9C3; color:#FFFFFF; border:groove" onclick="EnviarForm(form1,'admin/<?php echo $campo; ?>/agregar.php','contenido');" />
	 	   <input type="reset" name="Submit" value="&nbsp;Limpiar&nbsp;" style="background:#72A0CF; color:#FFFFFF; border:none" /> 	  </td>
	</tr> 
</table>
</form>
</div>
</div>
<script>
document.getElementById("contenedorr3").style.width="60%"; 
</script>