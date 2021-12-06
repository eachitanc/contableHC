<?php
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
					// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		 
       	$sql="SELECT conta FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =$res->fetch_assoc();
if ($rw['conta']=='SI')
{


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CBVA.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<script>
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>
<style>
.format
  {
 mso-number-format:\@
  }
.date
	{
	mso-number-format:"yyyy\/mm\/dd"	
	}
</style>
</head>
<body>
<?php
printf("
<center>
<table width='900' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<br>
<td align='center' width='140'><span class='Estilo2'>FECHA</span></td>
<td align='center' width='150'><span class='Estilo2'>COMPROBANTE</span></td>
<td align='center' width='200'><span class='Estilo2'>CUENTA</span></td>
<td align='center' width='150'><span class='Estilo2'>NOMBRE</span></td>
<td align='center' width='150'><span class='Estilo2'>DOCUMENTO/CHEQUE</span></td>
<td align='center' width='150'><span class='Estilo2'>TERCERO</span></td>
<td align='center' width='150'><span class='Estilo2'>DEBITO</span></td>
<td align='center' width='150'><span class='Estilo2'>CREDITO</span></td>
</tr>
");
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// consulto valores credito pendientes de conciliar de vigencias anteriores
		$sqx1 = "select * from aux_conciliaciones_vig_ant where fecha_marca='' and cuenta like '1110%' order by cuenta";
		$rex1 = mysql_db_query($database, $sqx1, $cx);
		
		while($rwx1 = mysql_fetch_array($rex1)) 
		{
	
		printf("
				<tr>
				<td align='center' class='date'>%s</td>
				<td align='center' ><span class='Estilo4'>%s</span></td>
				<td align='right'><span class='Estilo4'>%s</span></td>
				<td align='right'><span class='Estilo4'>%s</span></td>
				<td align='right'><span class='Estilo4'>%s</span></td>
				<td align='right'><span class='Estilo4'>%s</span></td>
				<td align='right' $color><span class='Estilo4'>%.2f</span></td>
				<td align='right' $color><span class='Estilo4'>%.2f</span></td>
				</tr>"
				, $rwx1["fecha"],$rwx1["comprobante"],$rwx1["cuenta"],$rwx1["nombre"], $rwx1["dcto_cheque"], $rwx1["tercero"],$rwx1["debito"],$rwx1["credito"]); 
		}
// Consulto pendientes de la vigencia 
	$sqx2 = "select * from aux_conciliaciones2 where fecha_marca='' or fecha_marca  IS NULL  and tercero !='NA' order by cuenta";
		$rex2 = mysql_db_query($database, $sqx2, $cx);
		
		while($rwx2 = mysql_fetch_array($rex2)) 
		{
		printf("
				<tr>
				<td align='center' class='format'>%s</td>
				<td align='center' ><span class='Estilo4'>%s</span></td>
				<td align='right'><span class='Estilo4'>%s</span></td>
				<td align='right'><span class='Estilo4'>%s</span></td>
				<td align='right'><span class='Estilo4'>%s</span></td>
				<td align='right'><span class='Estilo4'>%s</span></td>
				<td align='right'><span class='Estilo4'  class='format'>%s</span></td>
				<td align='right' $color><span class='Estilo4'>%.2f</span></td>
				</tr>"
				, $rwx2["fecha"],$rwx2["dcto"],$rwx2["cuenta"],$rwx2["nom_rubro"], $rwx2["cheque"], $rwx2["tercero"],$rwx2["debito"],$rwx2["credito"]); 
		
		}
printf("</table></center>");
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>

</body>
</html>

