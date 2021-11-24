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
        <div align="center"><a href='mvto.php?a=CDPP&nn=CDPP' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo2 Estilo4">
	Pasos a seguir para realizar la importaciond de DISPONIBILIDADES
	 </div>
	</div>	</td>
  </tr>
  <tr>
    <td>
<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	1. Descargue la plantilla de MS Excel &copy; presionando el boton izquierdo de su raton ...::: <a href="cdpp.xls"><strong>AQUI</strong></a> :::...	</div>	</td>
  </tr>
  <tr>
    <td>
	<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	2. Diligencie la plantilla siguiendo el ejemplo que se encuentra en la primera fila de la hoja de <span class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">MS Excel &copy;</span></div>	</td>
  </tr>
  <tr>
    <td>
	<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	3. Suba el archivo usando el siguiente cuadro:	</div>	</td>
  </tr>
  <tr>
    <td>
	<form action="sube_ica.php" method="post" enctype="multipart/form-data">
   <div align="center">
     <!-- <b>Campo de tipo texto:</b>
    <br>-->
     <!--<input type="text" name="cadenatexto" size="20" maxlength="100">-->
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
     <br>
     <span class="Estilo2"><strong>Subir Archivo de Homologacion de Gastos </strong></span><br />
     <br />
	 <span class="Estilo2"><em>Nombre del archivo: cdpp.csv<br />
	 (CSV delimitado por comas)     </em></span><br />
	 <br />
     <input name="userfile" type="file" class="Estilo2">
     <br><br />
     <input type="submit" class="Estilo2" value="Subir Archivo">
   </div>
</form>	
<br /></td>
  </tr>
</table>
<br />
<table width="800" border="1" align="center" class="bordepunteado1" cellpadding="2">
  <tr class="Estilo2 Estilo4" bgcolor='#DCE9E5'>
  	<td width="20%" align="center">FECHA</td>
    <td width="60%">CONCEPTO</td>
    <td width="10%" colspan="3" align="center">IMPRIMIR</td>
    <td width="10%" colspan="2"></td>
  </tr>
  <?php 
  	include('../config.php');
    $cx=mysql_connect ($server, $dbuser, $dbpass);
	
 	$sql="select * from recaudo_rica2 where ref !='' order by ref";
	//$rs1=mysql_query($sql);
	/*while ($rw1 = mysql_fetch_array($rs1))
	{
		echo "<tr class='Estilo2'>
			  	<td align='center'>$rw1[fecha_reg]</td>
    			<td>$rw1[ref]</td>
    			<td bgcolor='#DCE9E5' align='center' title='Imprime CDP y Registro'><a href='imp_lote.php?ref=$rw1[ref]' target='_new'>Todos</a></td>
				<td bgcolor='#DCE9E5' align='center' title='Imprime CDP'><a href='imp_lote_cdp.php?ref=$rw1[ref]' target='_new'>CDP</a></td>
				<td bgcolor='#DCE9E5' align='center' title='Imprime Registro'><a href='imp_lote_crp.php?ref=$rw1[ref]' target='_new'>CRP</a></td>
				<td bgcolor='#DCE9E5' align='center'><a href='borra_lote.php?ref=$rw1[ref]' ><img src='../simbolos/eliminarverde.png' width='20'   /></a></td>
				<td bgcolor='#DCE9E5' align='center'><img src='../simbolos/procesar.png' width='20'   /></td>
  			 </tr>";

	}*/
  ?>
  </table>
  
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../recaudos_tesoreria/recaudos_tesoreria.php?a=RICA&nn=RICA' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
}
?>