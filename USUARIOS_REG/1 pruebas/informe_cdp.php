<!-- Construyo los encabesados de la tabla -->
<table width='90%' border='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
    <td align='center'><b>CODIGO</b></td>
    <td align='center'><b>FECHA</b></td>
    <td align='center'><b>TERCERO</b></td>
    <td align='center'><b>DESCRIPCION DEL CDPP</b></td>
    <td align='center'><b>VALOR</b></td>
</tr>
<?php
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Conulto la disponibilidad por numero
$sql = "select * from cdpp where cdpp ='2110351' group by consecutivo order by fecha_reg,cdpp desc" ;
$res = mysql_db_query($database, $sql, $cx);

while($row = mysql_fetch_array($res)) 
   {
	echo" <tr>
		<td align='center'>CDPP$row[cdpp]</td>
		<td align='center'>$row[fecha_reg]</td>
		<td align='center'>&nbsp;</td>
		<td align='left'>$row[des]</td>
		<td align='center'>$row[valor]</td>
		</tr>";

   }
echo "<table>";
?>
