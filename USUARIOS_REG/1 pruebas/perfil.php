<!-- Construyo los encabesados de la tabla -->
<table width='90%' border='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
    <td align='center'><b>CODIGO</b></td>
    <td align='center'><b>FUNCIONES</b></td>
</tr>
<?php
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Conulto la disponibilidad por numero
$sql = "select * from perfiles" ;
$res = mysql_db_query($database, $sql, $cx);

while($row = mysql_fetch_array($res)) 
   {
	echo" <tr>
		<td align='center'>$row[cargo]</td>
		<td align='center'>$row[funciones]</td>
		</tr>";

   }
echo "<table>";
?>
