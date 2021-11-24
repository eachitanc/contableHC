<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header('Content-Type: text/html; charset=latin1'); 
?>
<script>
function calcula(valor)
{
	var cxm = valor * 0.004;
	document.getElementById('menu1_4x1000').value =cxm;
	suma();
}
function suma()
{
	
	var gastos = parseInt(document.getElementById('menu1_gen').value) + parseInt(document.getElementById('menu1_arre').value) + parseInt(document.getElementById('menu1_otros').value) + parseInt(document.getElementById('menu1_4x1000').value); 
	var unitar = (parseInt(document.getElementById('OBL_menu1_facturado').value ) - gastos) / parseInt(document.getElementById('OBL_menu1_entregados').value);
	document.getElementById('menu1_precio').value =parseInt(unitar);
}
</script>
<?php
// campó y tabla
$campo ='liquidacion';
$texto = strtoupper($campo);
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$id = $_GET["id"];
$fecha_ini = $_GET["fecha_ini"];
$fecha_fin = $_GET["fecha_fin"];
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
$sql="select sum(entrega) as entregados from despacho where fecha between '$fecha_ini' and '$fecha_fin' and cliente ='$cliente' and  liquidado =''";
$res =mysql_query($sql,$cx);
$row =mysql_fetch_array($res);
$litros = $row['entregados'];
?>
<br />
<br />
<center>
<div id="contenedorr3">
<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%"  >
    <tr valign="center" bgcolor="#F5F5F5" class="menu3 arred"  >
      <td width="100%"  >&nbsp;DATOS LIQUIDACION QUINCENA   
         </td>
      <td width="3%" align="right" class="tituloForm" id="cerrar" onClick="cargaArchivo('admin/<?php echo $campo; ?>/reporte.php','reporte');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X&nbsp;</td>
    </tr>
    <tr valign="center" bgcolor="#FDFDFD" >
      <td colspan="2" > 
      
       <div class="tabbed-area">
        <!-- menu pestañas-->
                            <ul class="tabs group" id="lista">
                                <li><a href="#" id="lis_1" onclick="MostrarPes(id);">Liquidacion</a></li>
                                <li><a href="#" id="lis_2" onclick="MostrarPes(id);">Registros</a></li>
                                <li><a href="#" id="lis_3" onclick="MostrarPes(id);">Pago</a></li>
                            </ul>
       	</div>  
         </td>
    </tr>


 </table>
 <div id="fomulario" style="background:#FFF">
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="tabla" value="<?php echo $campo; ?>"  /> 
<input type="hidden"  value="<?php echo $id; ?>"  />
<input type="hidden" name="cliente"  value="<?php echo $cliente; ?>"  />

<table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_1" >
   <tr>
   		<td colspan="3" height="1"></td>
   </tr>
    <tr valign="center">
      <td width="3%"> </td>
      <td width="24%"  align="left" >Fecha Inicial:</td>
      <td width="73%" align="left"><input type="text" name="fecha_ini" id="menu1_fechaini" size="12" value="<?php echo $fecha_ini; ?>" alt="1"  style="text-align:right"  /></td>
    </tr>
       
    <tr valign="center">
      <td> </td>
      <td  align="left" >Fecha final:</td>
      <td align="left"><input type="text" name="fecha_fin" id="OBL_menu1_fechafin" size="12" value="<?php echo $fecha_fin; ?>" alt="1"  style="text-align:right" /></td>
    </tr>  
    
     <tr valign="center">
      <td> </td>
      <td  align="left" >Litros entregados:</td>
      <td align="left"><input type="text" name="entregado" id="OBL_menu1_entregados" size="12" value="<?php echo $litros; ?>" alt="1"  style="text-align:right" readonly="readonly" /></td>
    </tr>
    
    <tr valign="center">
      <td> </td>
      <td  align="left" >Valor facturado:</td>
      <td align="left"><input type="text" name="facturado" id="OBL_menu1_facturado" size="12" value="0" alt="1"  style="text-align:right" onkeyup="calcula(value)"/></td>
    </tr>

    
    <tr valign="center">
      <td> </td>
      <td  align="left" >4 x 1000:</td>
      <td align="left"><input type="text" name="impuesto" id="menu1_4x1000" size="12" value="0" alt="1"  style="text-align:right" onkeyup="suma()"/></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Gastos generales:</td>
      <td align="left"><input type="text" name="gastos_gen" id="menu1_gen" size="12" value="0" alt="1"  style="text-align:right" onkeyup="suma()"/></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Arrendamientos:</td>
      <td align="left"><input type="text" name="arrenda" id="menu1_arre" size="12" value="0" alt="1"  style="text-align:right" onkeyup="suma()"/></td>
    </tr>

    <tr valign="center">
      <td> </td>
      <td  align="left" >Otros gastos:</td>
      <td align="left"><input type="text" name="otros" id="menu1_otros" size="12" value="0" alt="1"  style="text-align:right" onkeyup="suma()"/></td>
    </tr>
 <tr valign="center">
      <td> </td>
      <td  align="left" ><b>Precio neto a liquidar:</b></td>
      <td align="left"><input type="text" name="precio" id="menu1_precio" size="10" value="0" alt="1" style="text-align:right; font-weight:bold; background-color:#E9E9E9"/></td>
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
      <td width="100%" align="center"> </td>
     
    </tr>
   
</table>

<table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_3" style="display:none">
   <tr>
   		<td colspan="3" height="20"></td>
   </tr>
    <tr valign="center">
      <td width="100%" align="center"><a href="admin/recepcion/pagos.docx" target="_new">  <img src="admin/recepcion/images.jpg" width="80"  /> </a></td>
     
    </tr>
    <tr>
 <td height="80"></td>
 </tr>
</table>

<table align="center" class="tr" border="0" cellspacing="0" width="100%" bgcolor="FDFDFD">
 <tr>
 <td height="4"></td>
 </tr>
 <tr  >
	 	 <td colspan="2" align="center">
           <input type="button" class="myButton" value="Enviar" id="enviar"  alt="1"   onclick="EnviarForm(form1,'admin/liquidacion/agregar.php','columna1');"  />
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
document.getElementById("contenedorr3").style.width="70%";
</script>