<?
session_start();
set_time_limit(150);
								// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT conta,importar FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['conta']=='SI' and $rw['importar'] =='SI')
{

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
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../user.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo2 Estilo4">
	Pasos a seguir para realizar la carga de Saldos Iniciales de Contabilidad	</div>
	</div>	</td>
  </tr>
  <tr>
    <td>
<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	1. Descargue la plantilla de MS Excel &copy; presionando el boton izquierdo de su raton ...::: <a href="plantilla/SICO.xls"><strong>AQUI</strong></a> :::...	</div>	</td>
  </tr>
  <tr>
    <td>
	<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	2. Diligencie la plantilla siguiendo las instrucciones que se encuentran en la Hoja no 2 de la Hoja de Calculo	</div>	</td>
  </tr>
  <tr>
    <td>
	<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	3. Suba el archivo usando el siguiente cuadro:	</div>	</td>
  </tr>
  <tr>
    <td>
	<form action="subesico.php" method="post" enctype="multipart/form-data">
   <div align="center">
     <!-- <b>Campo de tipo texto:</b>
    <br>-->
     <!--<input type="text" name="cadenatexto" size="20" maxlength="100">-->
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
     <br>
     <span class="Estilo2"><strong>Subir Archivo SICO ( Saldos Iniciales de Contabilidad )</strong></span><br />
     <br />
	 <span class="Estilo2"><em>Nombre del archivo SICO.csv<br />
	 (CSV delimitado por comas)     </em></span><br /><br />
     <input name="userfile" type="file" class="Estilo2">
     <br><br />
     <input type="submit" class="Estilo2" value="Subir Archivo">
   </div>
</form>	
<br /></td>
  </tr>
  <tr>
    <td><div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> 4. Verifique los saldos cargados a continuacion:</div></td>
  </tr>
  <tr>
    <td><div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> 
      <div align="center"><em>(si los saldos son incorrectos, realice nuevamente todo el proceso asegurandose que la informacion sea la correcta) <br /><br />
	      <span class="Estilo5">las cuentas se marcaran con color ROJO cuando no se encuentren dentro del P.G.C.P de la empresa	      </span></em></div>
    </div></td>
  </tr>
  <tr>
    <td><?php
//-------
include('../config.php');	
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $idxx=$rowxx["id_emp"];
  $id_emp=$rowxx["id_emp"];
}

			
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from sico order by cuenta asc ";
$re = mysql_db_query($database, $sq, $cx);
printf("<BR><center><span class='Estilo2'><B>SALDOS INICIALES DE CONTABILIDAD CARGADOS</B></span></center><BR>");
printf("
<center>
<table width='750' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo2'><b>CUENTA</b></span>
</div>
</td>
<td align='center' width='300'><span class='Estilo2'><b>NOMBRE</b></span></td>
<td align='center' width='150'><span class='Estilo2'><b>DEBITO</b></span></td>
<td align='center' width='150'><span class='Estilo2'><b>CREDITO</b></span></td>
</tr>


");

while($rw = @mysql_fetch_array($re)) 
   {
   		$eval_cuenta=$rw["cuenta"];
		$sqlr = "select * from pgcp where cod_pptal='$eval_cuenta' and id_emp='$id_emp'";
		$resultr = mysql_query($sqlr, $cx) or die(mysql_error());
		if (mysql_num_rows($resultr) == 0)
		{
		
				if($rw["cuenta"]=='' or $rw["cuenta"]=='CUENTA')
				{
				}
				else
				{
				printf("
				<span class='Estilo4'>
				<tr>
				<td bgcolor='#990000' align='left'><span class='Estilo2'><font color='#FFFFFF'>%s</font></span></td>
				<td bgcolor='#990000' align='left'><span class='Estilo2'><font color='#FFFFFF'>%s</font></span></td>
				<td bgcolor='#990000' align='right'><span class='Estilo2'><font color='#FFFFFF'>%s</font></span></td>
				<td bgcolor='#990000' align='right'><span class='Estilo2'><font color='#FFFFFF'>%s</font></span></td>
				</tr>",$rw["cuenta"],$rw["nombre"],number_format($rw["debito"],2,',','.'),number_format($rw["credito"],2,',','.'));
				}  
		
		
		}
		else
		{
		
				if($rw["cuenta"]=='' or $rw["cuenta"]=='CUENTA')
				{
				}
				else
				{
				printf("
				<span class='Estilo4'>
				<tr>
				<td align='left'><span class='Estilo2'><font color='#000000'>%s</font></span></td>
				<td align='left'><span class='Estilo2'><font color='#000000'>%s</font></span></td>
				<td align='right'><span class='Estilo2'><font color='#000000'>%s</font></span></td>
				<td align='right'><span class='Estilo2'><font color='#000000'>%s</font></span></td>
				</tr>",$rw["cuenta"],$rw["nombre"],number_format($rw["debito"],2,',','.'),number_format($rw["credito"],2,',','.'));
				}  
		
		
		}
		
				
				
				
				
				
 
 


   }

printf("</table></center>");
//--------	
?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
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
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
?>
