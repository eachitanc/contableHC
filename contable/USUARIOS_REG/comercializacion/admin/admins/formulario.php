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
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$id = $_GET["id"];
$sq = "select * from usuarios where id = '$id'";
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

?>

<br />
<div id="fomulario">

<table align="center" border="0" cellspacing="0" cellpadding="0" width="60%" bgcolor="#E8E8E8">
    <tr valign="center">
      <td width="97%" class="tituloForm"  >NUEVO USUARIO...</td>
      <td width="3%" align="right" class="tituloForm" id="cerrar" onClick="cargaArchivo('admin/usuarios/reporte.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
    </tr>
  <tr  bgcolor="#FBFBFB" align="left" height="30">
	 	 <td colspan="2" > 
         <form action="" method="post" name="form_menu" id="form_menu">   
          <input type="button" id="menu1" value="Datos" style="background:#FF952B; color:#FFFFFF; border:none;" onClick="VerPestana(id);"/> 
          </form>
		 </td>	
	</tr>
 </table>
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="tabla" value="usuarios"  /> 
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<table  class="tr punteado ConcepForm" border="0" cellspacing="10" width="60%" bgcolor="#FBFBFB" id="pestana_1">
   <tr>
   		<td colspan="3" height="1"></td>
   </tr>
    <tr valign="center" <?php echo $ver1; ?>>
      <td> </td>
      <td  align="left" >Login:</td>
      <td align="left"><input type="text" name="login" id="menu1_login" size="16" value="<?php echo $rw['login']; ?>" /></td>
    </tr>

    <tr valign="center" <?php echo $ver1; ?>>
      <td> </td>
      <td  align="left" >Contrase&ntilde;a:</td>
      <td align="left"><input type="password" name="pass" id="<?php echo $obl2; ?>_menu1_pass" size="16" value="<?php echo $rw['pass']; ?>" /></td>
    </tr>

    <tr valign="center" <?php echo $ver1; ?>>
      <td> </td>
      <td  align="left" >Cofirme contrase&ntilde;a:</td>
      <td align="left"><input type="password" name="pass2" id="<?php echo $obl2; ?>menu1_pass2" size="16" value="<?php echo $rw['pass2']; ?>" <?php echo $ver; ?> onblur="validaPass();" /></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Nombres:</td>
      <td align="left"><input type="text" name="nombres" id="menu1_nombres" size="50" value="<?php echo $rw['nombres']; ?>" /></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Apellidos:</td>
      <td align="left"><input type="text" name="apellidos" id="menu1_apellidos" size="50" value="<?php echo $rw['apellidos']; ?>" /></td>
    </tr>


<tr valign="center">
      <td> </td>
      <td  align="left" >Rol:</td>
      <td align="left"><select name="rol" id="rol">
      				   <?php 
					   $i=0; $j=0;
                       $datos = array ("","Economa General","Economa Provincial","Economa Local");
                       for ($i=0; $i<5;$i++)
					   {
					   if ($rw['rol'] == $datos[$i])
					   		echo "<option value='$datos[$i]' selected>$datos[$i]</option>";
					   else		
                       		echo "<option value='$datos[$i]' >$datos[$i]</option>";
					   }
						?> 
                       </select>	
      	</td>
</tr>
<tr valign="center">
      <td> </td>
      <td  align="left" >Estado:</td>
      <td align="left">
      					<?php
						if ($rw['estado'] == 'SI')
						{
						echo "
							<span class='ConcepForm'>Activo</span>
							<input name='estado' type='radio' value='SI' checked='checked' />
							<span class='ConcepForm'>Inactivo</span>  
							<input name='estado' type='radio' value='NO' />";
						}
						if ($rw['estado'] == 'NO')
						{
						echo "
							<span class='ConcepForm'>Activo</span>
							<input name='estado' type='radio' value='SI'  />
							<span class='ConcepForm'>Inactivo</span>  
							<input name='estado' type='radio' value='NO' checked='checked' />";
						}
						if (!$rw['estado'])
						{
						echo "
							<span class='ConcepForm'>Activo</span>
							<input name='estado' type='radio' value='SI'   />
							<span class='ConcepForm'>Inactivo</span>  
							<input name='estado' type='radio' value='NO' checked='checked'/>";
						}
						?>
         </td>
</tr>
</table>

<br />
<table align="center" class="tr" border="0" cellspacing="0" width="50%">
 <tr  >
	 	 <td colspan="2" align="center"><input type="button" name="Submit2" value="&nbsp;Enviar&nbsp;" style="background:#9C3; color:#FFFFFF; border:none" onclick="EnviarForm(form1,'admin/usuarios/agregar.php','contenido');" />
	 	   <input type="reset" name="Submit" value="&nbsp;Limpiar&nbsp;" style="background:#72A0CF; color:#FFFFFF; border:none" /> 	  </td>
	</tr> 
</table>
</form>
</div>
