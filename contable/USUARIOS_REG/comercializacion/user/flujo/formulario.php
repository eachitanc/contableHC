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
<div id="contenedorr3">
<table align="center" border="0" cellspacing="0" cellpadding="0" width="99%">
    <tr valign="center">
      <td width="99%"  ><form action="" method="post" name="form_menu" id="form_menu">   
          <input type="button" id="menu1" value="Movimientos" style="background:#72A0CF; color:#FFFFFF; border:double;" onClick="VerPestana(id);"/> 
          </form></td>
      <td width="3%" align="right" class="tituloForm" id="cerrar" onClick="cargaArchivo('admin/<?php echo $campo; ?>/reporte.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
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
      <td  align="left" >Tipo:</td>
      <td align="left"><select name="provincia" id="provincia">
						<option value=""></option>
						<?php
                        $sq2 = "select * from movimientos ";
                        $rs2 = mysql_query($sq2);
                        $fi2 = mysql_num_rows($rs2);
                        for ($i=0; $i<$fi2; $i++) {
                            $rw2 = mysql_fetch_array($rs2);
								// Busco el nombre del pais
								if ($rw2['id_usuario'] == $log)
		                            echo "<OPTION VALUE='$rw2[id]' selected>$rw2[tipo] </OPTION>";
        						else 
									echo "<OPTION VALUE='$rw2[id]'>$rw2[tipo] </OPTION>";
		                }
						?>
                       </select></td>
      <td  align="left" >Grupo:</td>
      <td align="left"><select name="provincia" id="provincia">
						<option value=""></option>
						<?php
                        $sq3 = "select * from grupos where tipo ='gastos' ";
                        $rs3 = mysql_query($sq3);
                        $fi3 = mysql_num_rows($rs3);
                        for ($i=0; $i<$fi3; $i++) {
                            $rw3 = mysql_fetch_array($rs3);
								// Busco el nombre del pais
							echo "<OPTION VALUE='$rw3[id]'>$rw3[grupo] </OPTION>";
		                }
						?>
                       </select></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Fecha:</td>
      <td align="left"><input type="text" name="nit" id="menu1_nit" size="16" value="<?php echo $rw['nit']; ?>" /></td>
      <td  align="left" >Cuenta:</td>
      <td align="left"><select name="provincia" id="provincia">
						<option value=""></option>
						<?php
                        $sq4 = "select * from cuentas where tipo ='gastos' and grupo ='Instituciones educativas' ";
                        $rs4 = mysql_query($sq4);
                        $fi4 = mysql_num_rows($rs4);
                        for ($i=0; $i<$fi4; $i++) {
                            $rw4 = mysql_fetch_array($rs4);
								// Busco el nombre del pais
							echo "<OPTION VALUE='$rw4[cod]'>$rw4[cuenta] </OPTION>";
		                }
						?>
                       </select></td>
    </tr>
    
    <tr valign="center">
      <td> </td>
      <td  align="left" >Documento:</td>
      <td align="left"><input type="text" name="nit" id="menu1_nit" size="16" value="<?php echo $rw['nit']; ?>" /></td>
      <td  align="left" >Detalle:</td>
      <td align="left"><input type="text" name="nit" id="menu1_nit" size="80" value="<?php echo $rw['nit']; ?>" /></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Ingreso:</td>
      <td align="left"><input type="text" name="nit" id="menu1_nit" size="16" value="<?php echo $rw['nit']; ?>" /></td>
      <td  align="left" >Gasto:</td>
      <td align="left"><input type="text" name="nit" id="menu1_nit" size="16" value="<?php echo $rw['nit']; ?>" /></td>
    </tr>


     <tr>
   		<td colspan="3" height="5"></td>
   </tr>
</table>
<table align="center" class="tr" border="0" cellspacing="0" width="99%">
 <tr  >
	 	 <td colspan="2" align="center"><input type="button" name="Submit2" value="&nbsp;Enviar&nbsp;" style="background:#9C3; color:#FFFFFF; border:groove" onclick="EnviarForm(form1,'admin/<?php echo $campo; ?>/agregar.php','contenido');" />
	 	   <input type="reset" name="Submit" value="&nbsp;Limpiar&nbsp;" style="background:#72A0CF; color:#FFFFFF; border:none" /> 	  </td>
	</tr> 
</table>
</form>
</div>
</div>

<?php
include('reporte.php');
?>
<script>
document.getElementById("contenedorr3").style.width="75%"; 
</script>