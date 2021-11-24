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
$campo ='farm_listado';
$texto = strtoupper($campo);
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$id = $_GET["id"]; 
$fecha = $_GET['fecha'];
$bodega = $_GET["bodega"]; 
$tip_art = $_GET["tip_art"]; 
$sq = "select * from $campo where id = '$id'";
$rs = mysql_query($sq);
$sq = "select max(cod_int) as codigo from farm_listado";
$rs = mysql_query($sq);
$rw = mysql_fetch_array($rs);
//$fl = mysql_num_rows($rs);
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
?>
<br />
<br />
<br />
<center>
<div id="contenedorr3">
<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%"  >
    <tr valign="center" bgcolor="#F5F5F5" class="menu3 arred"  >
      <td width="100%"  >&nbsp;CARGA INICIAL DE INVENTARIO   
         </td>
      <td width="3%" align="right" class="tituloForm" id="cerrar" onClick="cargaArchivo('admin/inventario/reporte.php','reporte2');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X&nbsp;</td>
    </tr>
    <tr valign="center" bgcolor="#FDFDFD" >
      <td colspan="2" > 
      
       <div class="tabbed-area">
        <!-- menu pestañas-->
                            <ul class="tabs group" id="lista">
                                <li><a href="#" id="lis_1" onclick="MostrarPes(id);">Articulo</a></li>
                                <li><a href="#" id="lis_2" onclick="MostrarPes(id);">Valores iniciales</a></li>
                                <li><a href="#" id="lis_3" onclick="MostrarPes(id);">Otros</a></li>
                            </ul>
       	</div>  
         </td>
    </tr>
 </table>
 <div id="fomulario" style="background:#FFF">
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="tabla" value="<?php echo $campo; ?>"  /> 
<input type="hidden" name="fecha"  value="<?php echo $fecha; ?>"  />
<input type="hidden" name="bodega"  value="<?php echo $bodega; ?>"  />
<input type="hidden" name="tip_art"  value="<?php echo $tip_art; ?>"  />
<table  class="tr punteado ConcepForm menu4" border="0" cellspacing="10" width="100%" bgcolor="#ffffff" id="p_1" >
   <tr>
   		<td colspan="3" height="1"></td>
   </tr>
     <tr valign="center">
      <td width="4%"> </td>
      <td width="24%"  align="left" >Codigo Interno:</td>
      <td width="72%" align="left"><input type="text" name="cod" id="menu1_cod" size="5" value="<?php echo $rw['cant']; ?>" alt="1"  style="text-align:right"  /></td>
    </tr>
    <tr valign="center">
      <td width="4%"> </td>
      <td width="24%"  align="left" >Codigo de barras:</td>
      <td width="72%" align="left"><input type="text" name="barras" id="menu1_barras" size="20" value="<?php echo $fecha2; ?>" alt="1"  /></td>
    </tr>
     <tr valign="center">
      <td width="4%"> </td>
      <td width="24%"  align="left" >Nombre:</td>
      <td width="72%" align="left"><input type="text" name="nombre" id="menu1_nombre" size="70" value="<?php echo $rw['cant']; ?>" alt="1" /></td>
    </tr>
    
    <tr valign="center">
      <td width="4%"> </td>
      <td width="24%"  align="left" >Unidad:</td>
      <td width="72%" align="left"><input type="text" name="unidad" id="menu1_unidad" size="40" value="<?php echo $rw['cant']; ?>" alt="1"   /></td>
    </tr>
    
    <tr valign="center">
      <td width="4%"> </td>
      <td width="24%"  align="left" >Cantidad:</td>
      <td width="72%" align="left"><input type="text" name="cant" id="menu1_cant" size="5" value="<?php echo $rw['cant']; ?>" alt="1"  style="text-align:right"  /></td>
    </tr>
       
    <tr valign="center">
      <td> </td>
      <td  align="left" >Fecha Vencimiento:</td>
      <td align="left">
         <input type="text" name="fechaven" id="menu1_fecha_ini" size="10" value="<?php echo $rw['fechaven']; ?>" alt="1" onkeydown='displaycode(event,id);' onchange="sumarfechas(15,value);"  /> <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form1.menu1_fecha_ini,'yyyy/mm/dd',this)" value="Seleccionar"  />
    </tr>  
    
     <tr valign="center">
      <td> </td>
      <td  align="left" >Registro Invima:</td>
      <td align="left"><input type="text" name="invima" id="OBL_menu1_invima" size="15" value="<?php echo $rw['invima']; ?>" alt="1"   /></td>
    </tr>
    
    <tr valign="center">
      <td> </td>
      <td  align="left" >Lote:</td>
      <td align="left"><input type="text" name="lote" id="menu1_lote" size="15" value="<?php echo $rw['lote']; ?>" alt="1"  /></td>
    </tr>

    
    <tr valign="center">
      <td> </td>
      <td  align="left" >Promedio compras / Mes:</td>
      <td align="left"><input type="text" name="promedio" id="promedio" size="5" value="<?php echo $rw['promedio']; ?>" alt="1"  style="text-align:right" /></td>
    </tr>
    
    <tr valign="center">
      <td> </td>
      <td  align="left" >Valor por unidad:</td>
      <td align="left"><input type="text" name="valor" id="OBL_menu1_valor" size="10" value="<?php echo $rw['valor']; ?>" alt="1"  style="text-align:right" /></td>
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
           <input type="button" class="myButton" value="Enviar" id="enviar"  alt="1"   onclick="EnviarForm(form1,'admin/inventario/agregar.php','reporte2');"  />
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
document.getElementById("menu1_cod").select();
</script>