<?php

include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

$cod= $_GET['cod'];
$id= $_GET['id'];
$sq1="select * from farm_kardex where id ='$id' and tipo_mov ='INI'";
$re1=mysql_query($sq1);
$rw1=mysql_fetch_array($re1);
$sq2="select nombre from farm_med where id ='$cod'";
$re2=mysql_query($sq2);
$rw2=mysql_fetch_array($re2); 
$fecha_ven =$rw1['fecha_ven'];
if($rw1['fecha_ven'] == '') $fecha_ven = '';
?> 
<input name="id" id="id" type="hidden" value="<?php echo $id; ?>"  /> 
<table width="90%" border="0" class="punteado" cellpadding='1' cellspacing='0' align="center">  
     <tr>  
         <td width="15%">Codigo</td>
         <td width="20%"><input name="codigo" id="codigo" size="4" value="<?php echo $rw1['cod_int']; ?>" readonly="readonly" style="background-color:#F2F79F;text-align:right" /><label id="codigo_e" style="color:#F00"></label></td>
         <td width="15%">Producto</td>
         <td width="50%"><input name="producto" id="producto" size="65" alt="1" value="<?php echo $rw2['nombre']; ?>"  />
</td>
     </tr>
      <tr>  
         <td>Codigo de barras</td>
         <td><input name="barras" id="barras" size="18"  alt="1" value="<?php echo $rw1['cod_barras']; ?>" onchange="buscarBarras();" />&nbsp;
         </td>
         <td>Invima</td>
         <td><input name="Invima" id="Invima" size="20"  value="<?php echo $rw1['invima']; ?>"  alt="1"/></td>
     </tr>
      <tr>  
         <td>Lote</td>
         <td><input name="lote" id="lote" size="20"  alt="1" value="" />
         </td>
         <td>Fecha Vencimiento</td>
         <td>
         <select name="mes" id="mes" onchange="verMes(value)" tabindex="1">
         	<option value=""></option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
         </select>
         
         
         <input name="menos" type="button" onClick="sumarAnno('-','menu1_fecha_ven');" value="-" style='background:#E8EEFA;'/>
        <input type="text" name="dir" id="menu1_fecha_ven" size="12" value="<?php echo $fecha_ven; ?>"   onkeydown='displaycode(event,id);' readonly="readonly"  /> 
         <input name="mas" type="button" onClick="sumarAnno('+','menu1_fecha_ven');" value="+" style='background:#E8EEFA;'/> <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form2.menu1_fecha_ven,'yyyy/mm/dd',this)" value="Selecionar fecha"  />
         </td>
     </tr>
      <tr  valign="top">  
         <td>Cantidad</td>
         <td><input name="cant" id="cant" size="10" style="text-align:right" onkeypress='return validar(event)' alt="1" value="<?php echo $rw1['entrada']; ?>"/><label id="cant_e" style="color:#F00"></label></td>
         <td>Precio compra:</td>
         <td><input name="compra" id="compra" size="10" style="text-align:right" onchange="formato(id,value);" onkeypress='return validar(event)' value="<?php echo $rw1['venta']; ?>"  alt="1"/><label id="compra_e" style="color:#F00"></label> </td>
     </tr>
     <tr  valign="top">  
         <td>Precio de venta</td>
         <td><input name="venta" id="venta" size="10" style="text-align:right" onchange="formato(id,value);" onkeypress='return validar(event)' value="<?php echo $rw1['venta']; ?>"  alt="1"/><label id="venta_e" style="color:#F00"></label> 
         </td>
         <td></td>
         <td></td>
     </tr>
     <tr  valign="top">  
         <td></td>
         <td></td>
         <td> </td>
         <td></td>
     </tr>
 </table>
 
</form> 
  </div>
    
<script>
$().ready(function() {
		$("#producto").autocomplete("admin/recepcion/consultas/producto.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		multiple:true,
		//highlight: false,
		//multipleSeparator: " ",
		selectFirst: false
	});
	$("#producto").result(function(event, data, formatted) {
		$("#codigo").val(data[1]);
		buscarProducto(data[1]);
	});
	
});
document.getElementById('barras').focus();
</script>