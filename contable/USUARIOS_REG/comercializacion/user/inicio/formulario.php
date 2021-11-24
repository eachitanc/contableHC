<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=latin1'); 
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
$campo ='inicio';
$texto = strtoupper($campo);
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$id = $_GET["id"];
/*
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
*/
// consulto el id del usuario
$sql="select id from usuarios where login = '$_SESSION[user]'";
$res =mysql_query($sql,$cx);
$row =mysql_fetch_array($res);
$log = $row['id'];


?>
<br />
<br />
<br />
<div id="contenedorr3">


<table align="center" border="0" cellspacing="0" cellpadding="0" width="99%">
    <tr valign="center">
      <td width="99%" class="menu3" valign="top"  >Sesi&oacute;n de trabajo </td>
      <td width="3%" align="right" class="menu3" id="cerrar" onClick="cargaArchivo('admin/<?php echo $campo; ?>/reporte.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();"  valign="top">X</td>
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
      <td  align="left" >Pais:</td>
      <td align="left"><select name="pais" id="pais">
						<?php
                        $sq2 = "select * from usuarios_acc where id_usuario = '$log' ";
                        $rs2 = mysql_query($sq2);
                        $fi2 = mysql_num_rows($rs2);
                        for ($i=0; $i<$fi2; $i++) {
                            $rw2 = mysql_fetch_array($rs2);
								// Busco el nombre del pais
								 $sq3 = "select pais_nombre,pais_id from pais where pais_id ='$rw2[id_pais]' ";
		                         $rs3 = mysql_query($sq3);
								 $rw3 = mysql_fetch_array($rs3);
								if ($rw2['id_usuario'] == $log)
		                            echo "<OPTION VALUE='$rw3[pais_id]' selected>$rw3[pais_nombre] </OPTION>";
        						else 
									echo "<OPTION VALUE='$rw3[pais_id]'>$rw3[pais_nombre] </OPTION>";
		                }
						?>
                       </select></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Provincia:</td>
      <td align="left"><select name="provincia" id="provincia">
						<?php
                        $sq2 = "select * from usuarios_acc where id_usuario = '$log' ";
                        $rs2 = mysql_query($sq2);
                        $fi2 = mysql_num_rows($rs2);
                        for ($i=0; $i<$fi2; $i++) {
                            $rw2 = mysql_fetch_array($rs2);
								// Busco el nombre del pais
								 $sq3 = "select provincias_nombre,provincias_id from provincias where provincias_id ='$rw2[id_prov]' ";
		                         $rs3 = mysql_query($sq3);
								 $rw3 = mysql_fetch_array($rs3);
								if ($rw2['id_usuario'] == $log)
		                            echo "<OPTION VALUE='$rw3[provincias_id]' selected>$rw3[provincias_nombre] </OPTION>";
        						else 
									echo "<OPTION VALUE='$rw3[provincias_id]'>$rw3[provincias_nombre] </OPTION>";
		                }
						?>
                       </select></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Comunidad:</td>
      <td align="left"><select name="comunidad" id="comunidad">
						<?php
                        $sq2 = "select * from usuarios_acc where id_usuario = '$log' ";
                        $rs2 = mysql_query($sq2);
                        $fi2 = mysql_num_rows($rs2);
                        for ($i=0; $i<$fi2; $i++) {
                            $rw2 = mysql_fetch_array($rs2);
								// Busco el nombre del pais
								 $sq3 = "select comunidad_nombre,comunidad_id  from comunidad where comunidad_id  ='$rw2[id_comunidad]' ";
		                         $rs3 = mysql_query($sq3);
								 $rw3 = mysql_fetch_array($rs3);
								if ($rw2['id_usuario'] == $log)
		                            echo "<OPTION VALUE='$rw3[comunidad_id]' selected>$rw3[comunidad_nombre] </OPTION>";
        						else 
									echo "<OPTION VALUE='$rw3[comunidad_id]'>$rw3[comunidad_nombre] </OPTION>";
		                }
						?>
                       </select></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Vigencia:</td>
      <td align="left"><select name="vigencia" id="vigencia">
      					<option value='2014' selected="selected">2014</option>
                        <option value='2015' selected="selected">2015</option>
                        </select>	
      	
      </td>
    </tr>

     <tr>
   		<td colspan="3" height="5"></td>
   </tr>
</table>


<table align="center" class="tr" border="0" cellspacing="0" width="99%">
 <tr  >
	 	 <td colspan="2" align="center"><input type="button" name="Submit2" value="&nbsp;Enviar&nbsp;" style="background:#9C3; color:#FFFFFF; border:groove" onclick="EnviarForm(form1,'user/<?php echo $campo; ?>/sesion.php','contenido');" />
	 	   <input type="reset" name="Submit" value="&nbsp;Limpiar&nbsp;" style="background:#72A0CF; color:#FFFFFF; border:none" /> 	  </td>
	</tr> 
</table>
</form>
</div>
</div>
<script>
document.getElementById("contenedorr3").style.width="35%"; 
</script>