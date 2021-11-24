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


function totales()
{
 var man = parseInt(document.getElementById("OBL_menu1_recibido").value);	
 var tar = parseInt(document.getElementById("menu1_entrega").value);	
 document.getElementById("saldo").value= tar - man;	
}

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
$campo ='despacho';
$texto = strtoupper($campo);
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$id = $_GET["id"]; 
$fecha = $_GET["fecha"];
$cliente = $_GET["cliente"];
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
if ($id != '') 
{
	$sq3 ="select * from despacho where id ='$id'";
	$re3 =mysql_query($sq3,$cx);
	$rw3 =mysql_fetch_array($re3);
	$total = $rw3['recibido'];
	$entrega = $rw3['entrega'];
	$saldo = $rw3['saldo'];
}else{
	$sq3 ="select sum(cant) as litros from recepcion where despacho ='' and cliente ='$cliente' and fecha <= '$fecha' group by cliente";
	$re3 =mysql_query($sq3,$cx);
	$rw3 =mysql_fetch_array($re3);
	$total = $rw3['litros'];
}
?>
<br />
<br />
<center>
<div id="contenedorr3">
<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%"  >
    <tr valign="center" bgcolor="#F5F5F5" class="menu3 arred"  >
      <td width="100%"  >&nbsp;DATOS DESPACHO DIARIO DE LECHE   
         </td>
      <td width="3%" align="right" class="tituloForm" id="cerrar" onClick="cargaArchivo('admin/<?php echo $campo; ?>/reporte.php?fecha=<?php echo $fecha; ?>','reporte');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X&nbsp;</td>
    </tr>
    <tr valign="center" bgcolor="#FDFDFD" >
      <td colspan="2" > 
      
       <div class="tabbed-area">
        <!-- menu pestañas-->
                            <ul class="tabs group" id="lista">
                                <li><a href="#" id="lis_1" onclick="MostrarPes(id);">Datos generales</a></li>
                                <li><a href="#" id="lis_2" onclick="MostrarPes(id);">Registros</a></li>
                                <li><a href="#" id="lis_3" onclick="MostrarPes(id);">Historial</a></li>
                            </ul>
       	</div>  
         </td>
    </tr>
 </table>
 <div id="fomulario" style="background:#FFF">
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="tabla" value="<?php echo $campo; ?>"  /> 
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<input type="hidden" name="cliente"  value="<?php echo $cliente; ?>"  />
<table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_1">
   <tr>
   		<td colspan="3" height="1"></td>
   </tr>
    <tr valign="center">
      <td width="3%"> </td>
      <td width="24%"  align="left" >Fecha despacho:</td>
      <td width="73%" align="left"><input type="text" name="fecha" id="menu1_fecha" size="16" value="<?php echo $fecha; ?>" alt="1" readonly="readonly" /> </td>
    </tr>
    <tr valign="center">
      <td> </td>
      <td  align="left" >Total recibido:</td>
      <td align="left"><input type="text" name="recibido" id="OBL_menu1_recibido" size="5" value="<?php echo $total; ?>" alt="1" readonly="readonly" style="text-align:right" onkeyup="totales()"onkeydown='displaycode(event,id);'/></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Total entregado:</td>
      <td align="left"><input type="text" name="entrega" id="menu1_entrega" size="5" value="<?php echo $entrega; ?>" alt="1" onkeydown='displaycode(event,id);' style="text-align:right" onkeyup="totales()" /></td>
    </tr>
 <tr valign="center">
      <td> </td>
      <td  align="left" ><b>Saldo a favor:</b></td>
      <td align="left"><input type="text" name="saldo" id="saldo" size="5" value="<?php echo $saldo; ?>" alt="1" onkeydown='displaycode(event,id);' style="text-align:right; font-weight:bold; background-color:#E9E9E9  "/></td>
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
      <td width="100%" align="center"><img src="admin/recepcion/grafica.png" width="500"  /> </td>
     
    </tr>
   
</table>

<table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_2" style="display:none">
   <tr>
   		<td colspan="3" height="1"></td>
   </tr>
    <tr valign="center">
      <td width="100%" align="center"><img src="admin/recepcion/tabla.png" width="400"  /> </td>
     
    </tr>
</table>

<table align="center" class="tr" border="0" cellspacing="0" width="100%" bgcolor="FDFDFD">
 <tr>
 <td height="4"></td>
 </tr>
 <tr  >
	 	 <td colspan="2" align="center">
           <input type="button" class="myButton" value="Enviar" id="enviar"  alt="1"   onclick="EnviarForm(form1,'admin/despacho/agregar.php','reporte');" onkeydown='displaycode(event,id);' />
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
document.getElementById("contenedorr3").style.width="65%";
document.getElementById("menu1_entrega").select(); 
</script>