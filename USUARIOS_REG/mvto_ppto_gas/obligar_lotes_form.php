<?php set_time_limit(1200);
session_start();
if(!isset($_SESSION["login"]))
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
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		return num;
	}
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
        <div align="center"><a href='obligar_lotes.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
<?php
function numero($fec)
{
$fecha = $fec;
$anno =split("/",$fecha);
$anno2 =$anno[0]."/01/01";
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
		$sql2 = "select max(id_manu_cobp) from cobp where fecha_cobp='$fecha'";
		$res = mysql_db_query($database,$sql2,$cx);
		$row = $res->fetch_assoc();
		$dato = $row["max(id_manu_cobp)"];
		$concec= substr($dato,4,20);
		if ($concec)
		{
			$i=1;
			do {
					$con = $concec + $i;
					$con2 ="COBP".$con;
					$sq2 =mysql_db_query($database,"select * from cobp where id_manu_cobp ='$con2'",$cx);
					$fil = mysql_num_rows($sq2);
					$conant = $con-1;
					$conant2 = "COBP".$conant;
					$sq3 =mysql_db_query($database,"select * from cobp where id_manu_cobp ='$conant2'",$cx);
					$row3 = mysql_fetch_array($sq3);
					$fecha2 =$row3["fecha_cobp"]; 
					if ($fil >0)
					{
						$i++;
						$j =0;
					}else{
						return $con;
						$j=1;
						break;
					}
				} while ($j=1);	
		// si la fecha no tiene registros
		}else{
			$k=0;
			// Cuando el sistema no encuentra un registro para la fecha seleccionada
			do {
					// redusca la fecha en d�as
					$fecha_b = date("Y/m/d", strtotime( "$fecha -$k day"));
					// solo para consultar vigencia
					if ($fecha_b < $anno2) break;
					// busco el valor maximo del consecutivo para la fecha reducida
					$sql4 = "select max(id_manu_cobp) from cobp where fecha_cobp='$fecha_b'";
					$res4 = mysql_db_query($database,$sql4,$cx);
					$row4 = mysql_fetch_array($res4);
					// Evaluo si la consulta arroja resultados
					$fila4 = mysql_num_rows($res4);
					$dato = $row4["max(id_manu_cobp)"];
					$concec2= substr($dato,4,20);
					if ($concec2)
						{
							// Si la consulta devuelve datos incremento consecutivo para repetir la busqueda hasta encontrar espacio
							// consultar consecutivo y verificar disponibilidad, romper el ciclo
							$i=1;
								do {
									$con = $concec2 + $i;
									$con2= "COBP".$con;
									$sq2 =mysql_db_query($database,"select * from cobp where id_manu_cobp ='$con2'",$cx);
									$fil = mysql_num_rows($sq2);
									$conant = $con-1;
									$conant2 = "COBP".$conant;
									$sq3 =mysql_db_query($database,"select * from cobp where id_manu_cobp ='$conant2'",$cx);
									$row3 = mysql_fetch_array($sq3);
									$fecha2 =$row3["fecha_cobp"]; 
									if ($fil >0)
									{
										$i++;
										$j =0;
									}else{
										return $con;
										$j='1';
										break;
									}
								} while ($j=1);				
						break;
						}else{
							// restar la fecha en dos y repetir consulta hasta que fecha sea igual a inicio de vigencia
							$k++;
							$j=0;
						}
			} while ($j='1'); 

		 
		}
} // End function
$ref = $_GET['ref']; ?>
<br />
<form name="pagol" id="pagol" action="obliga_lotes_proc.php" method="post">
 <div style='padding-left:74px;'><label class="fc_head">REFERENCIA: </label> <input name="ref" id="ref" type="text" size="50" value="<?php echo $ref; ?>" readonly="readonly"  /> </div>
<table border="1" align="center" width="90%" class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
	<td width='10%' align='center'>No COBP</td>
    <td width='10%' align='center'>Fecha</td>
    <td width='25%' align='center'>Nombre</td>
    <td width='37%' align='center'>Concepto</td>
    <td width='10%' align='center'>Valor</td>
    <td width='8%' align='center'>Tesorer&iacute;a&nbsp;<input type="checkbox" name="tesoreria" id="tesoreria" value='1' onclick="teso(value)" /></td>
</tr>
  <?php 
  	include('../config.php');
    $cx=mysql_connect ($server, $dbuser, $dbpass);
	
	$fecha = date('Y/m/d');
	$num = numero($fecha);
	$num = $num-1;
	$k=0;
	$sql="select * from crpp where ref ='$ref' ";
	$rs1=mysql_query($sql);
	$fil=mysql_num_rows($rs1);
	echo "<input name='filas' id='filas' value='$fil' type='hidden' />";
	while ($rw1 = mysql_fetch_array($rs1))
	{
		
		$sq2="select sum(vr_digitado) as obl from cobp where id_auto_crpp ='$rw1[id_auto_crpp]' group by id_auto_crpp";
		$rs2=mysql_query($sq2);
		$rw2 = mysql_fetch_array($rs2);
		$valor = $rw1['vr_digitado'] - $rw2['obl']; 
		/*$sq2 = "select sum(vr_digitado) as valor from crpp where ref = '$rw1[ref]' group by ref";
		$rs2 = mysql_query($sq2);
		$rw2 = mysql_fetch_array($rs2);*/
				// obtenr el id_auto del ceva
					$sq6= "SHOW TABLE STATUS FROM $database LIKE 'cobp'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$consecutivo = $rw6[Auto_increment];
					}

		$k++;
		$numer = $num + $k;
		$val =number_format($valor,2,'.',','); 
		echo "<tr class='fc_head'>
			<td align='center'><input name='num_$k' id='num_$i' value='$numer' size='8' /> <input name='id_$k' id='id_$k' value='$rw1[id_auto_crpp]' type='hidden'/></td>
			<td align='center'><input name='fecha_$k' id='fecha_$k' value='$fecha' size='12' ondblclick='fechas(value);' /></td>
			<td align='left'>$rw1[tercero]</td>
			<td align='left'><input name='concep_$k' id='concep_$k' value='$rw1[detalle_crpp]'  size='80' ondblclick='conto(value);'  /></td>
			<td align='center'><input type='text' name='valor_$k' id='valor_$k' value='$val'  size='15' style='text-align:right' onchange='forma(value,id);' /></td>
			<td align='center'><input type='checkbox' name='teso_$k' id='teso_$k' value='SI'></td>
			</tr>
		";
		$valor =0;
	}
  ?>
  </table>
<br />
<div align="center"><input name="btg" value="Procesar Obligaci&oacute;n" type="submit" style="background:#72A0CF; color:#FFFFFF; border:none;font-size:13px;" onclick="return validar()"  /></div>
</form>
  
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='obligar_lotes.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
}
?>
