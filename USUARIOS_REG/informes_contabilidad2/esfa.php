<?php
// conexion con la base de datos
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=ESFA.xls");
header("Pragma: no-cache");
header("Expires: 0");
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		
// Funciones
function saldoAjustado($cuenta,$saldo_ini,$error_d,$error_c,$conver_d,$conver_c,$reclasifica_d,$reclasifica_c)
 {
	// Obtener el primer digito de la cuenta
	$cta =substr($cuenta,0,1);
		switch ($cta) {
		case 1:
			$valor = $saldo_ini+$error_d-$error_c+$conver_d-$conver_c+$reclasifica_d-$reclasifica_c;
			break;
		case 2:
			$valor = $saldo_ini-$error_d+$error_c-$conver_d+$conver_c-$reclasifica_d+$reclasifica_c;
			break;
		case 3:
			$valor = $saldo_ini-$error_d+$error_c-$conver_d+$conver_c-$reclasifica_d+$reclasifica_c;
			break;
	}
	return $valor;
}
function nivel ($cuenta)
{
	$largo = strlen($cuenta);
	if ($largo == 1)
	{
	$nivel =1;
	}else{
	$nivel = $largo-2;
	$nivel = ($nivel /2) +2;	
	}
	return $nivel;
}
// Consulto tercero con saldo incial
			echo "<table border=1>";
					echo "<tr bgcolor='#CCCCCC'>
							<td>Codigo</td>
							<td>Nombre</td>
							<td>Tipo</td>
							<td>Nivel</td>
							<td>Saldo</td>
							<td>Error debito</td>
							<td>Error credito</td>
							<td>Ajuste convergencia debito</td>
							<td>Ajuste convergencia credito</td>
							<td>Ajuste reclasificacion debito</td>
							<td>Ajuste reclasificacion credito</td>
							<td>Saldo ajustado</td>
						</tr>";
			$sq2 ="select * from pgcp order by cod_pptal";
			$re2 = mysql_query($sq2,$cx);
			$saldo =0;
			while ($rw = mysql_fetch_array($re2))
			{
					
				// Selecciono datos para saldo inicial de sico
				$sq1="select sum(debito) as debito, sum(credito) as credito from sico where cuenta like '$rw[cod_pptal]%' and tipo ='D'";
				$re1 = mysql_query($sq1,$cx);
				$rw1 = mysql_fetch_array($re1);
				$saldo_ini = $rw1['debito'] + $rw1['credito'];
				// seleccionar una  una las cuentas de libro auxiliar para saber si fue utilizada
				$sq3 ="select sum(debito) as debito, sum(credito) as credito from lib_aux where cuenta like '$rw[cod_pptal]%' and dcto like 'NCSP%'  ";
				$re3 = mysql_query($sq3,$cx);
				$rw3 = mysql_fetch_array($re3);
				$error_d = $rw3['debito']; 
				$error_c = $rw3['credito']; 
				// Datos para ajuste por convergencia
				$sq4 ="select sum(debito) as debito, sum(credito) as credito from lib_aux where cuenta like '$rw[cod_pptal]%' and dcto like 'NDSP%'  ";
				$re4 = mysql_query($sq4,$cx);
				$rw4 = mysql_fetch_array($re4);
				$conver_d = $rw4['debito'];
				$conver_c = $rw4['credito'];
				// Datos para Recalsificacion por convergencia
				$sq5 ="select sum(debito) as debito, sum(credito) as credito from lib_aux where cuenta like '$rw[cod_pptal]%' and dcto like 'NCON%'  ";
				$re5 = mysql_query($sq5,$cx);
				$rw5 = mysql_fetch_array($re5);
				$reclasifica_d = $rw5['debito'];
				$reclasifica_c = $rw5['credito'];
				// Calcular valor ajustado 
				$saldo_ajustado = saldoAjustado($rw['cod_pptal'],$saldo_ini,$error_d,$error_c,$conver_d,$conver_c,$reclasifica_d,$reclasifica_c);
				$mov = $saldo_ini + $error_d + $error_c + $conver_d + $conver_c + $reclasifica_d + $reclasifica_c;
				$nivel = nivel($rw['cod_pptal']);
				if ($mov != 0)
				{
							echo "<tr>
							<td>$rw[cod_pptal]</td>
							<td>$rw[nom_rubro]</td>
							<td>$rw[tip_dato]</td>
							<td>$nivel</td>
							<td align='right'>$saldo_ini</td>
							<td align='right'>$error_d</td>
							<td align='right'>$error_c</td>
							<td align='right'>$conver_d</td>
							<td align='right'>$conver_c</td>
							<td align='right'>$reclasifica_d</td>
							<td align='right'>$reclasifica_c</td>
							<td align='right'>$saldo_ajustado</td>
						</tr>";
				}
				$saldo_ini=0;
				$error_d =0;
				$error_c =0;
				$conver_d =0;
				$conver_c =0;
				$reclasifica_d =0;
				$reclasifica_c =0;
				$mov =0;
				$saldo_ajustado=0;
				$nivel =0;
			}
echo "</table>";
				echo "<br>";
?>
