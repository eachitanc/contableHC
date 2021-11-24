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
select {
	font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;
	}
</style>
</head>

<body>
<div align="center">
      <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />    </div>
    </div>
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../user.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
<br />
<div align="center" class="Estilo2 Estilo4">
<form name="nomina" id="nomina" action="nomina_plan.php" method="post">
<label>PERIODO A LIQUIDAR :</label> 
	<select name="periodo" id="periodo">
		<option value=""></option>
        <option value="ENERO">ENERO</option>
        <option value="FEBRERO">FEBRERO</option>
        <option value="MARZO">MARZO</option>
        <option value="ABRIL">ABRIL</option>
        <option value="MAYO">MAYO</option>
        <option value="JUNIO">JUNIO</option>
        <option value="JULIO">JULIO</option>
        <option value="AGOSTO">AGOSTO</option>
        <option value="SEPTIEMBRE">SEPTIEMBRE</option>
        <option value="OCTUBRE">OCTUBRE</option>
        <option value="NOVIEMBRE">NOVIEMBRE</option>
        <option value="DICIEMBRE">DICIEMBRE</option>
    </select>
    <input name="btn" id="btn" value="Generar " type="submit"   />
</form>
</div>
<br />
<table width="60%" border="1" align="center" class="bordepunteado1" cellpadding="2">
  <tr class="Estilo2 Estilo4" bgcolor='#DCE9E5'>
  	<td width="20%" align="center">FECHA</td>
    <td width="40%">CONCEPTO</td>
    <td width="15%" align="center">VALOR</td>
     <td width="10%" align="center">OBLIGAR</td>
    <td width="10%" colspan="4" align="center"></td>
  </tr>
  <?php 
  	include('../config.php');
    $cx=mysql_connect ($server, $dbuser, $dbpass);
	
 	$sql="select distinct periodo,fecha,concepto from nomina_plan  order by periodo,fecha,concepto";
	$rs1=mysql_query($sql);
	
	while ($rw1 = mysql_fetch_array($rs1))
	{
	$ref2 = 'NOMINA '.$rw1['periodo'];	
	$sq3 ="select sum(vr_digitado) from cobp where ref = '$ref2' group by ref";
	$rs3 = mysql_query ($sq3,$cx);
	$rw3 = mysql_fetch_array($rs3);
	$obligado = $rw3['sum(vr_digitado)'];
	if ($obligado >0 ) $obl = number_format($obligado,2,',','.'); else $obl = "<a href='obliga_lotes_proc.php?ref=$rw1[periodo]'>Obligar</a>";	
	$sq2 ="select sum(salario), sum(gastos_rep), sum(sub_trans), sum(sub_alimen) from nomina_plan where periodo ='$rw1[periodo]' group by periodo";
	$rs2 =mysql_query($sq2,$cx);
	$rw2 =mysql_fetch_array($rs2);
	$tot = number_format($rw2['sum(salario)']+$rw2['sum(gastos_rep)']+$rw2['sum(sub_trans)']+$rw2['sum(sub_alimen)'],2,'.',',');
 		echo "<tr class='Estilo2'>
			  	<td align='center'>$rw1[fecha]</td>
    			<td>$rw1[concepto]</td>
				<td align='right'>$tot</td>
				<td align='center'>$obl</td>
    			<td bgcolor='#DCE9E5' align='center' title='Imprime CDP'><a href='imp_lote_cdp.php?ref=$rw1[ref]' target='_new'><img src='../simbolos/eliminarverde.png' width='20'/></a></td>
				<td bgcolor='#DCE9E5' align='center' title='Imprime CDP'><a href='imp_lote_cdp.php?ref=$rw1[ref]' target='_new'><img src='../simbolos/imprimirverde.png' width='20'/></a></td>
				<td bgcolor='#DCE9E5' align='center' title='Imprime Registro'><a href='imp_lote_crp.php?ref=$rw1[ref]' target='_new'><img src='../simbolos/procesar.png' width='20'/></a></td>
  			 </tr>";

	}
  ?>
  </table>
  
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../user.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
}
?>