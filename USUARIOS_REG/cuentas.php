<?php
// conexion con la base de datos
header("Cache-Control: no-store, no-cache, must-revalidate");
		include('config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		
// Consulto tercero con saldo incial
			echo "<table border=1>";
					echo "<tr bgcolor='#CCCCCC'>
							<td>Codigo</td>
							<td>Nombre</td>
							<td>Tipo</td>
							<td>Nivel</td>
						</tr>";
			$sq2 ="select * from pgcp order by cod_pptal";
			$re2 = mysql_query($sq2,$cx);
			$saldo =0;
			while ($rw = mysql_fetch_array($re2))
			{
					
				// seleccionar una  una las cuentas de libro auxiliar para saber si fue utilizada
				$sq3 ="select * from lib_aux where cuenta like '$rw[cod_pptal]%' ";
				$re3 = mysql_query($sq3,$cx);
				$fi3 = mysql_num_rows($re3);
				
							echo "<tr>
							<td>$rw[cod_pptal]</td>
							<td>$rw[nom_rubro]</td>
							<td>$rw[tip_dato]</td>
							<td>$rw[nivel]</td>
						</tr>";
				
				
			}
echo "</table>";
				echo "<br>";
?>
