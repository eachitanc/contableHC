<script>
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

function verNombre(){
	//donde se mostrará el formulario con los datos
	var cod = document.getElementById('OBL_pest1_codint').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST","user/med/inicial/consultas/nombre.php",false);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			var res = ajax.responseText
					document.getElementById('producto').value=res;
			//mostrar el formulario
			// divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("cod="+cod);
}

function verCodigo(){
	//donde se mostrará el formulario con los datos
	var cod = document.getElementById('producto').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST","user/med/inicial/consultas/codigo.php",false);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			var res = ajax.responseText
					document.getElementById('OBL_pest1_codint').value=res;
			//mostrar el formulario
			// divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("cod="+cod);
}


</script>

<?php
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
mysql_query("set names 'utf8'"); 
$id_cr =$_GET['id_crpp'];
$cuenta =$_GET['cuenta'];
$valor =$_GET['valor'];
// autocomplete
$sql = "select *  FROM crpp where id_auto_crpp ='$id_cr' and cuenta ='$cuenta'";
$res = mysql_query($sql,$cx);
$rw = mysql_fetch_array($res);

$sq2="select nom_rubro from car_ppto_gas where cod_pptal ='$cuenta'";
$rs2=mysql_query($sq2);
$rw2=mysql_fetch_array($rs2);
?>
<br />

<div id="fomulario">
 <form action="" method="post" name="form3" id="form3">
 <input type="hidden" name="id" value="<?php echo $id; ?>"  />

<table align="center" class="punteado" border="0" cellspacing="0" width="90%" bgcolor="#EFEFEF">
<tr>
<td>
    <table align="center" class="tr punteado ConcepForm" border="0" cellspacing="1" width="100%" bgcolor="#ffffff">
        <tr>
            <td width="2%" height="25"></td>
            <td width="98%" colspan="2" align="left">
            <input type="button" id="pest1" value="Datos b&aacute;sicos" style="background:#72A0CF; color:#FFFFFF; border:none; cursor:pointer"/>
		</td>
       </tr>
    </table>
<!-- ********************************* SEPARADOR PESTAÑA ***************************  -->     
    <table align="center" class="tr punteado ConcepForm" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="part1">
        <tr valign="center">
          <td> </td>
          <td  align="left" >Fecha registro:</td>
          <td align="left"><input name="fecha_reg" type="text" size="10" id="fecha_reg"  value="<?php echo $rw['fecha_crpp']; ?>" title="Formato de fecha aaaa/mm/dd"  />
		 					<input name="button2" type="button"  onClick="displayCalendar(document.form3.fecha_reg,'yyyy/mm/dd',this)" value="&nbsp;"  />
          </td>
		</tr>

 
        <tr valign="center">
          <td width="1%"> </td>
          <td width="25%"  align="left">Codigo Presupuestal:</td>
          <td width="74%" align="left"><?php echo $cuenta . " - " . $rw2['nom_rubro']; ?></td>
        </tr>
        
        <tr valign="center" >
          <td> </td>
          <td  align="left" >Valor:</td>
          <td align="left"><input type="text" name="producto" id="producto" size="18" value="<?php echo $valor; ?>" style="text-align:right"  /></td>
        </tr>
        
     
  </table>
    
 <!-- ********************************* SEPARADOR PESTAÑA ***************************  -->     
    
    
    
<!-- ********************************* SEPARADOR PESTAÑA ***************************  -->    
    
   
    <table align="center" class="tr punteado ConcepForm" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" style="display:none" id="part3">
    
    
    
     <tr>
            <td colspan="3" height="292" ></td>
     </tr>
    
    </table>
    
<!--  ***************************************************** FIN PESTAÑAS **************************************** -->
</td>
</tr>
</table>
<br />
<table align="center" class="tr" border="0" cellspacing="0" width="60%">
 <tr  >
	 	 <td colspan="2" align="center"><input type="button" name="Submit2" value="&nbsp;Enviar&nbsp;" style="background:#9C3; color:#FFFFFF; border:none" onClick="EnviarForm('user/med/inicial/agregar.php','contenido','form3');" />
	 	   <input type="reset" name="Submit" value="&nbsp;Limpiar&nbsp;" style="background:#72A0CF; color:#FFFFFF; border:none" /> 	
	</tr> 
</table>
</form>

</div>
<br />

