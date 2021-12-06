<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo8 {color: #990000}
input { font-size:11px; border:0;	
}
</style>

<link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
</head>
<?php
function numero($fec)
{
$fecha = $fec;
$anno =split("/",$fecha);
$anno2 =$anno[0]."/01/01";
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
		$sql2 = "select max(id_manu_ceva) from ceva where fecha_ceva='$fecha'";
		$res = mysql_db_query($database,$sql2,$cx);
		$row = $res->fetch_assoc();
		$dato = $row["max(id_manu_ceva)"];
		$concec= substr($dato,4,20);
		if ($concec)
		{
			$i=1;
			do {
					$con = $concec + $i;
					$con2 ="CEVA".$con;
					$sq2 =mysql_db_query($database,"select * from ceva where id_manu_ceva ='$con2'",$cx);
					$fil = mysql_num_rows($sq2);
					$conant = $con-1;
					$conant2 = "CEVA".$conant;
					$sq3 =mysql_db_query($database,"select * from ceva where id_manu_ceva ='$conant2'",$cx);
					$row3 = mysql_fetch_array($sq3);
					$fecha2 =$row3["fecha_ceva"]; 
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
					// para consultar solo en la vigencia
					if ($fecha_b < $anno2) break;
					// busco el valor maximo del consecutivo para la fecha reducida
					$sql4 = "select max(id_manu_ceva) from ceva where fecha_ceva='$fecha_b'";
					$res4 = mysql_db_query($database,$sql4,$cx);
					$row4 = mysql_fetch_array($res4);
					// Evaluo si la consulta arroja resultados
					$fila4 = mysql_num_rows($res4);
					$dato = $row4["max(id_manu_ceva)"];
					$concec2= substr($dato,4,20);
					if ($concec2)
						{
							// Si la consulta devuelve datos incremento consecutivo para repetir la busqueda hasta encontrar espacio
							// consultar consecutivo y verificar disponibilidad, romper el ciclo
							$i=1;
								do {
									$con = $concec2 + $i;
									$con2= "CEVA".$con;
									$sq2 =mysql_db_query($database,"select * from ceva where id_manu_ceva ='$con2'",$cx);
									$fil = mysql_num_rows($sq2);
									$conant = $con-1;
									$conant2 = "CEVA".$conant;
									$sq3 =mysql_db_query($database,"select * from ceva where id_manu_ceva ='$conant2'",$cx);
									$row3 = mysql_fetch_array($sq3);
									$fecha2 =$row3["fecha_ceva"]; 
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
}
?>
<script>
function neto (id)
{
	var cam = id.split('_');
	var val = document.getElementById('valor_'+cam[1]).value.replace(/\./g,'');
	var cul = document.getElementById('cult_'+cam[1]).value.replace(/\./g,'');
	var anc = document.getElementById('ancian_'+cam[1]).value.replace(/\./g,'');
	var udn = document.getElementById('udenar_'+cam[1]).value.replace(/\./g,'');
	var cxp = parseFloat(document.getElementById('cxp_'+cam[1]).value.replace(/\./g,''));
	document.getElementById('neto_'+cam[1]).value=formatea(val-cul-anc-udn);
	document.getElementById('tpagar_'+cam[1]).value=formatea(parseFloat(document.getElementById('neto_'+cam[1]).value.replace(/\./g,''))+cxp);
	
}

function valores (id,val)
{
	document.getElementById(id).value=formatea(val);	
	neto(id);
}

function formatea(valor)
{
	var valor = valor.toString();
	var num = valor.replace(/\./g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		return num;
	}
}

function fechas(fec)
{
	var filas = document.getElementById('fil').value;
	var i=0;
		for (i=1;i<=filas;i++)
		{
			document.getElementById('fecha_'+i).value=fec;	
		}
}

function cuenta(dat,val)
{
	var filas = document.getElementById('fil').value;
	var campo =dat.split("_");
	var i=0;
		for (i=1;i<=filas;i++)
		{
			document.getElementById(campo[0]+"_"+i).value=val;	
		}
}



</script>
<body>
<?php
include('../config.php');
$cx =mysql_connect($server,$dbuser,$dbpass) or die ("Fallo en la Conexion a la Base de Datos");

$ref_data = date('Ymd');
					$sq6= "SHOW TABLE STATUS FROM $database LIKE 'ceva'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$con = $rw6[Auto_increment];
					}
					$ref =$ref_data.'-'.$con;

?>
<form name="pagol" id="pagol" action="pagos_lote_proc_tes" method="post">
<label>REFERENCIA</label> <input name="ref" id="ref" type="text" size="20" value="<?php echo $ref; ?>"/> 
<table border="1" align="center" width="100%" class='bordepunteado1'>
<tr bgcolor="#DCE9E5">
	<td width="5%" align="center">No Ceva</td>
    <td width="5%" align="center">Fecha</td>
    <td width="5%" align="center">Tercero</td>
    <td width="15%" align="center">Nombre</td>
    <td width="15%" align="center">Concepto</td>
    <td width="5%" align="center">Valor</td>
    <td width="4%" align="center">Procultura</td>
    <td width="4%" align="center">Ancianos</td>
    <td width="4%" align="center">Udenar</td>
    <td width="4%" align="center">Neto</td>
    <td width="6%" align="center">Rubro</td>
    <td width="4%" align="center">Vr CxP</td>
    <td width="4%" align="center">Neto</td>
    <td width="5%" align="center">Cta Debito</td>
    <td width="5%" align="center">Cta Credito</td>
    <td width="5%" align="center">Cheque</td>
</tr>
<?php
$filas = $_POST['fil2'];
$fecha = date('Y/m/d');
$num = numero($fecha);
$num = $num-1;
$i=0;$k=0;$h=1;
for ($i=1;$i<=$filas;$i++)
{
	$dato[$i] = $_POST['campo_'.$i];
	if ($dato[$i] !='')
	{
		$k++;
		// consulta al cobp para obtener datos
		$sql ="select * from cobp where id_auto_cobp = '$dato[$i]'";
		$rs1 =mysql_query($sql,$cx);
		$rw1 =mysql_fetch_array($rs1);
		// consulto el valor obligado en cobo
		$sq2="select sum(vr_digitado) as valor from cobp where id_auto_cobp ='$rw1[id_auto_cobp]'";
		$rs2=mysql_query($sq2,$cx);
		$rw2=mysql_fetch_array($rs2);
		// consulto que el numero de documento no se haya utilizado
		  $numer = $num + $h;
		  $h++;
		// select 
		$valor =number_format($rw2['valor'],0,',','.');
		$tpagar = $valor;
		echo "<tr>
					<td><input name='id_$k' id='id_$k' value='$dato[$i]' type='hidden'/>
					<input name='num_$k' id='num_$i' value='$numer' size='8' /></td>
					<td><input name='fecha_$k' id='fecha_$k' value='$fecha' size='10' ondblclick='fechas(value);' /></td>
					<td><input name='ter_$k' id='ter_$k' value='$rw1[ccnit]' size='12'/></td>
					<td><input name='nom_$k' id='nom_$k' value='$rw1[tercero]' size='30' /></td>
					<td><input name='concep_$k' id='concep_$k' value='$rw1[des_cobp]'  size='30' /></td>
					<td><input name='valor_$k' id='valor_$k' value='$valor'  size='10' style='text-align:right' /></td>
					<td><input name='cult_$k' id='cult_$k' value=''  size='8' style='text-align:right' onblur='valores(id,value);' /></td>
					<td><input name='ancian_$k' id='ancian_$k' value=''  size='8' style='text-align:right' onblur='valores(id,value);'/></td>
					<td><input name='udenar_$k' id='udenar_$k' value=''  size='8' style='text-align:right' onblur='valores(id,value);'/></td>
					<td bgcolor='#CC3'><input name='neto_$k' id='neto_$k' value='$valor'  size='10' style='text-align:right;background-color:#CC3;border:0' /></td>
					<td><input name='valcuenta_$k' id='valcuenta_$k' value=''  size='14' style='text-align:right' style='border:0' />
					</td>
					<td><input name='cxp_$k' id='cxp_$k' value='0'  size='10' style='text-align:right' onblur='valores(id,value);'/></td>
					<td bgcolor='#CC3'><input name='tpagar_$k' id='tpagar_$k' value='$tpagar'  size='10' style='text-align:right;background-color:#CC3;border:0' /></td>
					<td><input name='deb_$k' id='deb_$k' value='$rw1[pgcp2]'  size='10' style='text-align:right' ondblclick='cuenta(id,value);' /></td>
					<td><input name='valcre_$k' id='valcre_$k' value=''  size='12' ondblclick='cuenta(id,value);'/>
					</td>
					<td><input name='cheq_$k' id='cheq_$k' value=''  size='6' ondblclick='cuenta(id,value);'  /></td>
			 </tr>";	
	}
}
echo "<input name='fil' id='fil' value='$k' type='hidden'>";

?>
</table>
<br />
<div align="center"><input name="btg" value="Procesar pagos" type="submit" /></div>
</form>
<br />
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
      
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='pagos_tesoreria.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
        </div>
</div>
</body>
</html>