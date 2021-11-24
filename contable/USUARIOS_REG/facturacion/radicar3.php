<? set_time_limit(600);
$proceso =$_POST['proceso'];
$fecha =$_POST['fecha'];
$cuenta =$_POST['cuenta'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<link type="text/css" rel="stylesheet" href="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
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
</style>
</head>

<body>
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='radicar.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo2 Estilo4">
	Pasos a seguir para realizar la raicacio&oacute;n de Facturaci&oacute;n mensual<BR />
	VENTA  DE SERVICIOS DE SALUD</div>
	</div>	</td>
  </tr>
  <tr>
    <td>
<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;" align="center">
		Listado de facturas radicadas	</div>	</td>
  </tr>
  <tr>
    <td>
	<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    <table width="80%" border="1" class="bordepunteado1" align="center">
    <tr> 
    <td width="40%">Fecha de readicacion</td>
    <td width="30%">No factura</td>
       <td width="30%">Valor</td>
    </tr>
   
   <?php
   include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
	$proceso2 =$proceso . "-R";
   // Realizao la consulta de cada factura segun el proceso referente
    $sq1="select distinct ref,tercero,ccnit from lib_aux4 where proceso = '$proceso' ";
	$rs1 =mysql_query($sq1,$cx);
	while ($rw1 =mysql_fetch_array($rs1))
	{
		$sq2="select sum(debito) as debito, sum(credito) as credito from lib_aux4 where ref ='$rw1[ref]' and cuenta = '13190101' group by ref";
		$rs2 =mysql_query($sq2,$cx);
		$rw2 =mysql_fetch_array($rs2);
		$valor = $rw2['debito']-$rw2['credito'];
				$sq6= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux4'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$consecutivo = $rw6[Auto_increment];
					}
		
		$import="INSERT INTO lib_aux4 ( 
								id_auto,
								id_cons,
								fecha,
								fecha_ref,
								dcto,
								ref,
								cuenta,
								detalle,
								tercero,
								ccnit,
								debito,
								credito,
								cheque,
								proceso,
								radicado,
								cta_cobro
								)VALUES(
								'RADC$consecutivo',
								'$consecutivo',
								'$fecha',
								'$fecha',
								'RAD$rw1[ref]',
								'$rw1[ref]',
								'13190201',
								'RADICACION DE CUENTAS POR COBRAR',
								'$rw1[tercero]',
								'$rw1[ccnit]',
								'$valor',
								'0.00',
								'',
								'$proceso2',
								'2',
								$cuenta
								)";
							   mysql_query($import) or die(mysql_error());
					//DATOS PARA GRABAR EN LA TABLA REGISTRO
								 $import="INSERT INTO lib_aux4 ( 
								id_auto,
								id_cons,
								fecha,
								fecha_ref,
								dcto,
								ref,
								cuenta,
								detalle,
								tercero,
								ccnit,
								debito,
								credito,
								cheque,
								proceso,
								radicado,
								cta_cobro
								)VALUES(
								'RADC$consecutivo',
								'$consecutivo',
								'$fecha',
								'$fecha',
								'RAD$rw1[ref]',
								'$rw1[ref]',
								'13190101',
								'RADICACION DE CUENTAS POR COBRAR',
								'$rw1[tercero]',
								'$rw1[ccnit]',
								'0.00',
								'$valor',
								'',
								'$proceso2',
								'2',
								$cuenta
								)";
							   mysql_query($import) or die(mysql_error());
			
			$sq3 ="UPDATE lib_aux4 SET radicado = '1' WHERE proceso ='$proceso';";
			mysql_query($sq3) or die(mysql_error());
	echo "<tr>
			<td>$rw1[tercero]</td>
			<td>$rw1[ref]</td>
			<td>$valor</td>
		</tr>	
		";
	}  
   ?>
    <tr> 
    <td>Cuenta de cobro</td>
    <td></td>
    <td></td>
    </tr>
    <tr> 
    <td colspan="2" align="center"></td>
    </tr>
    </table>
    
    </div>
  </tr>
  
</table>
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='radicar.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
