<? set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<script type="text/javascript" src="../js/carga.js"></script>
<style type="text/css">
<!--
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo4 {font-weight: bold}
a:link {
	color: #0000CC;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000CC;
}
a:hover {
	text-decoration: underline;
	color: #0000CC;
}
a:active {
	text-decoration: none;
	color: #0000CC;
}
.Estilo5 {
	color: #990000;
	font-weight: bold;
}
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head {  text-align: left;  font-size: 12px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo8 {color: #990000}
input { font-size:11px;border:none; 	
}
</style>

<script>
function teso (vali)
{
	var valor = pagol.tesoreria.checked;
	var filas = document.getElementById('filas').value;
	var i=0;
	if (valor == true)
	{
		for (i=1;i<=filas;i++)
		{
			document.getElementById('teso_'+i).checked=true;	
		}
	}
	if (valor == false)
	{
		for (i=1;i<=filas;i++)
		{
			document.getElementById('teso_'+i).checked=false;	
		}
	}
}

function fechas(fec)
{
	var filas = document.getElementById('filas').value;
	var i=0;
		for (i=1;i<=filas;i++)
		{
			document.getElementById('fecha_'+i).value=fec;	
		}
}

function conto(con)
{
	var filas = document.getElementById('filas').value;
		var i=0;
		for (i=1;i<=filas;i++)
		{
			document.getElementById('concep_'+i).value=con;	
		}
}

function validar()
{
	var filas = document.getElementById('filas').value;
	var i=0;
	// valido que la fecha no sea menor a la fecha del registro
	for (i=1;i<=filas;i++)
	{
		var errores =0;
		var crpp =document.getElementById('id_'+i).value;
		var fecha =	document.getElementById('fecha_'+i).value;
		var f_crpp = fecha_crpp(crpp);
		var errores = ValidaFecha(fecha);
		if (errores !='')
		{
			alert('La fecha no cumple formato aaaa/mm/dd en fila ' + i);	
			document.getElementById('fecha_'+i).focus();
			document.getElementById('fecha_'+i).select();
			return false;
		}
		if (fecha < f_crpp)
		{
			alert('La fecha no puede ser menor a la del registro presupuestal');
			document.getElementById('fecha_'+i).focus();	
			document.getElementById('fecha_'+i).select();
			return false;
		}
		// validar que el valor no sea mayor al saldo por obligar
		var valor = parseFloat(document.getElementById('valor_'+i).value.replace(/\,/g,''));
		var saldo = valor_obl(crpp);
		if (saldo < valor)
		{
			alert('El valor es mayor al saldo por obligar del registro');
			document.getElementById('valor_'+i).focus();	
			document.getElementById('valor_'+i).select();
			return false;
		}
		
	}
 return true;	
}

function fecha_crpp(crpp)
{
var dato='';
var pos_url2 = 'consultas/fecha_obliga.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				 dato = req1.responseText;
			}
		}
	
	req1.open('POST', pos_url2 +'?cod='+crpp,false);
	req1.send(null);
	}
	 return dato;	
}

function valor_obl(crpp)
{
var dato='';
var pos_url2 = 'consultas/saldo_obliga.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				 sal = req1.responseText;
			}
		}
	
	req1.open('POST', pos_url2 +'?cod='+crpp,false);
	req1.send(null);
	}
	 return sal;	
}

function forma(val,id)
{
	document.getElementById(id).value=formatea(val);
}

function formatea(valor)
{
	var valor = valor.toString();
	var num = valor.replace(/\,/g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,');
		num = num.split('').reverse().join('').replace(/^[\,]/,'');
		return num;
	}
}
function suma_sueldo(val,id)
{
	forma(val,id)
	var i=0; var suma = 0;
	var filas = document.getElementById('filas').value;	
	for (i=1;i<=filas;i++)
	{
		suma += parseFloat(document.getElementById('suel_'+i).value.replace(/\,/g,''));
	}
	document.getElementById('tot_suel').value=formatea(suma);
	var deven = devengo(id);

}
function suma_rep(val,id)
{
	forma(val,id)
	var i=0; var suma = 0;
	var filas = document.getElementById('filas').value;	
	for (i=1;i<=filas;i++)
	{
		suma += parseFloat(document.getElementById('rep_'+i).value.replace(/\,/g,''));
	}
	document.getElementById('tot_rep').value=formatea(suma);
	var deven = devengo(id);

}

function suma_trans(val,id)
{
	forma(val,id)
	var i=0; var suma = 0;
	var filas = document.getElementById('filas').value;	
	for (i=1;i<=filas;i++)
	{
		suma += parseFloat(document.getElementById('trans_'+i).value.replace(/\,/g,''));
	}
	document.getElementById('tot_trans').value=formatea(suma);
	var deven = devengo(id);

}

function suma_alimen(val,id)
{
	forma(val,id)
	var i=0; var suma = 0;
	var filas = document.getElementById('filas').value;	
	for (i=1;i<=filas;i++)
	{
		suma += parseFloat(document.getElementById('alimen_'+i).value.replace(/\,/g,''));
	}
	document.getElementById('tot_alimen').value=formatea(suma);
	var deven = devengo(id);
}

function devengo(id)
{
	var fil = id.split('_');
	var j=0; var suma2 =0;
	var total = parseFloat(document.getElementById('suel_'+fil[1]).value.replace(/\,/g,'')) + parseFloat(document.getElementById('rep_'+fil[1]).value.replace(/\,/g,'')) + parseFloat(document.getElementById('trans_'+fil[1]).value.replace(/\,/g,'')) + parseFloat(document.getElementById('alimen_'+fil[1]).value.replace(/\,/g,''));
	document.getElementById('deven_'+fil[1]).value= formatea(total);
	var filas = document.getElementById('filas').value;	
		for (j=1;j<=filas;j++)
	{
		suma2 += parseFloat(document.getElementById('deven_'+j).value.replace(/\,/g,''));
	}
	document.getElementById('tot_dev').value=formatea(suma2);

}
</script>

</head>

<body>
<div align="center">
      <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />    </div>
    </div>
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='menu_nomina.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
<?php
$per = $_POST['periodo'];
$fecha = date('Y/m/d');
$ref = 'SUELDO PERSONAL DE NOMINA MES DE '. $per;
?>
<br />
<form name="nomina_plan" id="nomina_plan" action="nomina_proc.php" method="post">
 <div style='padding-left:34px;'>
 <label class="fc_head">FECHA: </label> <input name="fecha" id="fecha" type="text" size="15" value="<?php echo $fecha; ?>" /><br />
 <label class="fc_head">CONCEPTO: </label> <input name="concepto" id="concepto" type="text" size="150" value="<?php echo $ref; ?>" />
 <input name="mes" id="mes" value="<?php echo $per; ?>" type="hidden" />
 </div>
<table border="1" align="center" width="95%" class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
	<td width='2%' align='center'>No</td>
    <td width='8%' align='center'>Centro</td>
    <td width='5%' align='center'>Cedula</td>
    <td width='20%' align='center'>Nombre</td>
    <td width='8%' align='center'>Basico</td>
    <td width='8%' align='center'>Gastos Rep</td>
    <td width='8%' align='center'>Aux Trasnporte</td>
    <td width='8%' align='center'>Aux Aliment</td>
    <td width='8%' align='center'>Devengado</td>
</tr>
  <?php 
  	include('../config.php');
    $cx=mysql_connect ($server, $dbuser, $dbpass);
	
	$sql="select * from nomina order by c_costo,cedula asc";
	$rs1=mysql_query($sql);
	$fil=mysql_num_rows($rs1);
	echo "<input name='filas' id='filas' value='$fil' type='hidden' />";
	$tot_suel=0;
	while ($rw1 = mysql_fetch_array($rs1))
	{
		$k++;
		// consultar si el tercero esta creado en la base de datos
		$sq2 = "select pri_ape,seg_ape,pri_nom,seg_nom from terceros_naturales where num_id ='$rw1[cedula]'";
		$rs2 = mysql_query($sq2,$cx);
		$rw2 = mysql_fetch_array($rs2);
		$nombre = $rw2['pri_ape'].' '.$rw2['seg_ape'].' '.$rw2['pri_nom'].' '.$rw2['seg_nom'];
		$sueldo =number_format($rw1['salario'],0,'.',','); 
		$rep =number_format($rw1['gastos_rep'],0,'.',','); 
		$trans =number_format($rw1['sub_trans'],0,'.',','); 
		$alimen =number_format($rw1['sub_alimen'],0,'.',','); 
		$deven =number_format($rw1['salario']+$rw1['gastos_rep']+$rw1['sub_trans']+$rw1['sub_alimen'],0,'.',',');
		echo "<tr class='fc_head'>
			<td align='center'>$k</td>
			<td align='center'>$rw1[c_costo]</td>
			<td align='center'><input name='cedula_$k' id='cedula_$k' value='$rw1[cedula]' size='12' readonly='readonly' style='text-align:center' /></td>
			<td align='left'><input name='nombre_$k' id='nombre_$k' value='$nombre' size='50' readonly='readonly' /></td>
			<td align='center'><input type='text' name='suel_$k' id='suel_$k' value='$sueldo'  size='12' style='text-align:right' onchange='suma_sueldo(value,id);' /></td>
			<td align='center'><input type='text' name='rep_$k' id='rep_$k' value='$rep'  size='10' style='text-align:right' onchange='suma_rep(value,id);' /></td>
			<td align='center'><input type='text' name='trans_$k' id='trans_$k' value='$trans'  size='10' style='text-align:right' onchange='suma_trans(value,id);'/></td>
			<td align='center'><input type='text' name='alimen_$k' id='alimen_$k' value='$alimen'  size='10' style='text-align:right' onchange='suma_alimen(value,id);' /></td>
			<td align='center'><input type='text' name='deven_$k' id='deven_$k' value='$deven'  size='10' style='text-align:right' /></td>
			</tr>
		";
		$tot_suel =$tot_suel + $rw1['salario'];
		$tot_rep = $tot_rep + $rw1['gastos_rep'];
		$tot_trans = $tot_trans + $rw1['sub_trans'];
		$tot_alimeta = $tot_alimeta + $rw1['sub_alimen'];
		$tot_dev = $tot_dev + $rw1['salario']+$rw1['gastos_rep']+$rw1['sub_trans']+$rw1['sub_alimen'];
		$sueldo=0;
		$rep=0;
		$trans=0;
		$alimen=0;
		$tot_suel2 =number_format($tot_suel,0,'.',',');
		$tot_rep2 =number_format($tot_rep,0,'.',',');
		$tot_trans2 =number_format($tot_trans,0,'.',',');
		$tot_alimeta2 =number_format($tot_alimeta,0,'.',',');
		$tot_dev2 =number_format($tot_dev,0,'.',',');
	}
  ?>
<tr bgcolor='#DCE9E5' class='fc_head'>
	<td align='center' colspan="4"><b>Total</b></td>
    <td align='center'><b><?php echo "<input type='text' name='tot_suel' id='tot_suel' value='$tot_suel2'  size='12' style='text-align:right;background:#DCE9E5;' />" ?></b></td>
    <td align='center'><b><?php echo "<input type='text' name='tot_rep' id='tot_rep' value='$tot_rep2'  size='12' style='text-align:right;background:#DCE9E5;' />" ?></b></td>
    <td align='center'><b><?php echo "<input type='text' name='tot_trans' id='tot_trans' value='$tot_trans2'  size='12' style='text-align:right;background:#DCE9E5;' />" ?></b></td>
    <td align='center'><b><?php echo "<input type='text' name='tot_alimen' id='tot_alimen' value='$tot_alimeta2'  size='12' style='text-align:right;background:#DCE9E5;' />" ?></b></td>
    <td align='center'><b><?php echo "<input type='text' name='tot_dev' id='tot_dev' value='$tot_dev2'  size='12' style='text-align:right;background:#DCE9E5;' />" ?></b></td>
</tr>

  </table>
<br />
<div align="center"><input name="btg" value="Generar Planilla" type="submit" style="background:#72A0CF; color:#FFFFFF; border:none;font-size:13px;" onclick="return validar()"  /></div>
</form>
  
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='menu_nomina.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
}
?>
