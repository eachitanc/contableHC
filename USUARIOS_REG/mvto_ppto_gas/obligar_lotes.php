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
<div align="center">
      <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />    </div>
    </div>
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='mvto.php?a=CRPP&nn=CRPP' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>

<br />
<table width="60%" border="1" align="center" class="bordepunteado1" cellpadding="2">
  <tr class="Estilo2 Estilo4" bgcolor='#DCE9E5'>
  	<td width="20%" align="center">FECHA</td>
    <td width="40%">CONCEPTO</td>
    <td width="15%" align="center">VALOR CRP</td>
    <td width="15%" align="center">X OBLIGAR</td>
    <td width="10%" colspan="4" align="center"></td>
  </tr>
  <?php 
  	include('../config.php');
    $cx=mysql_connect ($server, $dbuser, $dbpass);
	
 	$sql="select distinct fecha_reg,ref from cdpp where ref !='' order by ref";
	$rs1=mysql_query($sql);
	while ($rw1 = mysql_fetch_array($rs1))
	{
		$sq2 = "select sum(vr_digitado) as valor from crpp where ref = '$rw1[ref]' group by ref";
		$rs2 = mysql_query($sq2);
		$rw2 = mysql_fetch_array($rs2);
		$val =number_format($rw2['valor'],2,'.',',');
		$sq3 = "select sum(vr_digitado) as obli from cobp where ref = '$rw1[ref]' group by ref";
		$rs3= mysql_query($sq3);
		$rw3 = mysql_fetch_array($rs3);
		$va2 =number_format($rw3['obli'],2,'.',',');
		$obligar = "<a href='obligar_lotes_form?ref=$rw1[ref]'>Obligar</a>";
		if ($rw2['valor'] == $rw3['obli']) $obligar = '';
		echo "<tr class='Estilo2'>
			  	<td align='center'>$rw1[fecha_reg]</td>
    			<td>$rw1[ref]</td>
				<td align='right'>$val</td>
				<td align='right'>$va2</td>
    			<td bgcolor='#DCE9E5' align='center' title='Obligar por lotes'>$obligar</td>
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
        <div align="center"><a href='mvto.php?a=CRPP&nn=CRPP' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
}
?>