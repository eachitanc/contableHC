<? set_time_limit(600);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
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
        <div align="center"><a href='upload.php' target='_parent' class="Estilo2">VOLVER </a> </div>
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
	
	Listado de facturacion cargada durante la vigencia pendiente de radicar	</div>	</td>
  </tr>
  <tr>
    <td>
	<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	<table width="100%" border="1" class="bordepunteado1">
    <tr> 
    <td>Entidad</td>
    <td>Detalle</td>
    <td align="center">Valor</td>
    <td align="center">Acci&oacute;n</td>
    
    <?php
    include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
	
	$sq1="select cta_sinradicar from ctas_cartera";
		$rs1 =mysql_query($sq1,$cx);
	while ($rw1 =mysql_fetch_array($rs1))
	{
		// consulto en el libro auxiliar el estado de estas cuentas
		$sq2="select distinct proceso, tercero from lib_aux4 where cuenta = $rw1[cta_sinradicar] and radicado=0" ;
		$rs2 =mysql_query($sq2,$cx);
		while ($rw2 =mysql_fetch_array($rs2))
		{
			$sq3 ="select sum(debito) as valor, sum(credito) as descuentos from lib_aux4 where proceso ='$rw2[proceso]'";
			$rs3 =mysql_query($sq3,$cx);
			$rw3 =mysql_fetch_array($rs3);
			$valor_cartera = $rw3['valor'] - $rw3['decuentos'];
			$valor_cartera =number_format($valor_cartera,2,".",",");
			echo "<tr>
					<td> $rw2[tercero]</td>
					<td> $rw2[proceso]</td>
					<td align='right'>$valor_cartera</td>
					<td align='center'> <a href='radicar2.php?ref=$rw2[proceso]'> Radicar </a> </td>
			";
		}
		
	}
    ?>
    
    </table> </div>	</td>
  </tr>
  
</table>
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='upload.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
