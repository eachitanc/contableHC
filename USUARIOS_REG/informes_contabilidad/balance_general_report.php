<?php
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=BALANCE_GENERAL.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<style>
.text
  {
 mso-number-format:"\@"
  }
.date
	{
	mso-number-format:"yyyy\/mm\/dd"	
	}
.numero
	{
	mso-number-format:"0"	
	}
</style>
<?php
include('../config.php');		
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
//**** borro tabla
$tabla6="aux_balance_gen";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";
mysql_select_db ($database, $cx);
		if(mysql_query ($anadir6 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}
mysql_select_db ($database, $cx);
// consulto la base generada en el paso anterior  para cargar solo las cuentas de balance
$sq3 = "select * from aux_contaduria_gral where cuenta like '1%' or cuenta like '2%' or cuenta like '3%' ";
$rs3 = mysql_db_query($database, $sq3, $cx) or die ($rs3 .mysql_error()."");
	while ($rw3 = mysql_fetch_array($rs3))
	{	
		// guardo los datos hasta la cuenta 3
		$sql_ok = "INSERT INTO aux_balance_gen 	(nivel,cuenta,nombre,mov_deb,mov_cre,saldo_deb,saldo_cred) 
					VALUES ('$rw3[nivel]','$rw3[cuenta]','$rw3[nombre]','$rw3[debito]','$rw3[credito]','$rw3[saldo_deb]','$rw3[saldo_cred]')";
		mysql_query($sql_ok, $cx) or die(mysql_error());
	}
// Consultas para calcular la perdida o ganancia del periodo
$sq4 = "select sum(saldo_deb), sum(saldo_cred) from aux_contaduria_gral where cuenta like '4%'";
$rs4 = mysql_db_query($database, $sq4, $cx) or die ($rs4 .mysql_error()."");
$rw4 = mysql_fetch_array($rs4);
$ingresos = $rw4['sum(saldo_cred)'] - $rw4['sum(saldo_deb)'];
// consulto el valor de los gastos
$sq5 = "select sum(saldo_deb), sum(saldo_cred) from aux_contaduria_gral where cuenta like '5%'";
$rs5 = mysql_db_query($database, $sq5, $cx) or die ($rs5 .mysql_error()."");
$rw5 = mysql_fetch_array($rs5);
$gastos = $rw5['sum(saldo_deb)'] - $rw5['sum(saldo_cred)'];
// consulto el valor de los costos de ventas
$sq6 = "select sum(saldo_deb), sum(saldo_cred) from aux_contaduria_gral where cuenta like '6%'";
$rs6 = mysql_db_query($database, $sq6, $cx) or die ($rs6 .mysql_error()."");
$rw6 = mysql_fetch_array($rs6);
$costos_ventas = $rw6['sum(saldo_deb)'] - $rw6['sum(saldo_cred)'];
// consulto el valor de los costos
$sq7= "select sum(saldo_deb), sum(saldo_cred) from aux_contaduria_gral where cuenta like '7%'";
$rs7 = mysql_db_query($database, $sq7, $cx) or die ($rs7 .mysql_error()."");
$rw7 = mysql_fetch_array($rs7);
$costos = $rw7['sum(saldo_deb)'] - $rw7['sum(saldo_cred)'];
$resultado = $ingresos - $gastos - $costos_ventas - $costos;
// busco cuentas de cierre establecidas para balance
$sq8="select * from cierre_contable where tipo = 'balance'";
$rs8=mysql_query($sq8,$cx);
$rw8=mysql_fetch_array($rs8);
if ($resultado > 0)
{
		
		// guardo los datos del resultado del rejercicio
		$sql_ok = "INSERT INTO aux_balance_gen 	(nivel,cuenta,nombre,saldo_deb,saldo_cred) 
					VALUES ('4','$rw8[cuenta_pri]','EXEDENTE DEL EJERCICIO','0.00','$resultado')";
		mysql_query($sql_ok, $cx) or die(mysql_error());

}
if ($resultado <= 0)
{
		// guardo los datos hasta la cuenta 3
		$sql_ok = "INSERT INTO aux_balance_gen 	(nivel,cuenta,nombre,saldo_deb,saldo_cred) 
					VALUES ('4','$rw8[cuenta_sec]','DEFICIT DEL EJERCICIO','0.00','$resultado*-1')";
		mysql_query($sql_ok, $cx) or die(mysql_error());

}
$fec1 =$_GET['fec1'];
$fec2 =$_GET['fec2'];
$nivel2 =$_GET['nivel2']; 
$resumen =$_GET['resumen'];
$movi = $_GET["mov"]; 
$sqlv = mysql_db_query($database,"select * from vf",$cx);
while ($rwv = mysql_fetch_array($sqlv))
	{
		$fecha_ini = $rwv["fecha_ini"];
	} 
	$cod2 = explode("/", $fecha_ini);
	$anno = $cod2[0]; 
$sql1 = mysql_db_query($database,"select * from empresa",$cx);
while ($rw1 = mysql_fetch_array($sql1))
	{
		$entidad = $rw1["raz_soc"];
		$nit = $rw1["nit"];
		$rep = $rw1["nom_rep_leg"];
		$conta = $rw1["nom_cont"];
	} 
?>
<table width='1380' border ='0' align='center' class='bordepunteado1'>
<tr>
	<td><b>ENTIDAD:</b></td>
	<td align="left"><?php echo $entidad; ?></td>
</tr>
<tr>
	<td><b>NIT:</b></td>
	<td align="left"><?php echo $nit; ?></td>
</tr>
<tr>
	<td><b>REPORTE:</b></td>
	<td>BALANCE GENERAL</td>
</tr>
<tr>
	<td><b>FECHA DE CORTE:</b></td>
	<td align="left"><?php echo "$fec2"; ?></td>
</tr>
<tr>
	<td><b>VIGENCIA:</b></td>
	<td align="left"><?php echo $anno; ?></td>
</tr>
<tr>
	<td><b>FECHA REPORTE:</b></td>
	<td align="left"><?php echo date('Y/m/d'); 
; ?></td>
</tr>

</table>

<?php
if ($movi=='SI')
{
	printf ("<table width='688' border ='1' align='center' class='bordepunteado1'>
			<tr>
			<td bgcolor='#DCE9E5' width='120'  align='center' class='Estilo4'><b>Cuenta</b></td>
			<td bgcolor='#DCE9E5' width='500' align='center' class='Estilo4'><b>Nombre</b></td>
			<td bgcolor='#DCE9E5' width='10' align='center' class='Estilo4' $ver><b>Movimiento desde <br> $fec1</b></td>
			<td bgcolor='#DCE9E5' width='50' align='center' class='Estilo4'><b>Saldo</b></td>
			<td bgcolor='#DCE9E5' width='4'  align='center'><b>T</b></td>
			<td bgcolor='#DCE9E5' width='4'  align='center'><b>N</b></td>
			</tr>");
}else{
	printf ("<table width='688' border ='1' align='center' class='bordepunteado1'>
			<tr>
			<td bgcolor='#DCE9E5' width='120'  align='center' class='Estilo4'><b>Cuenta</b></td>
			<td bgcolor='#DCE9E5' width='500' align='center' class='Estilo4'><b>Nombre</b></td>
			<td bgcolor='#DCE9E5' width='50' align='center' class='Estilo4'><b>Saldo</b></td>
			<td bgcolor='#DCE9E5' width='4'  align='center'><b>T</b></td>
			<td bgcolor='#DCE9E5' width='4'  align='center'><b>N</b></td>
			</tr>");
}
$sql = "select * from pgcp group by cod_pptal order by cod_pptal asc";
$res = mysql_db_query($database, $sql, $cx) or die ($resultadoxx2 .mysql_error()."");
while($row = mysql_fetch_array($res)) 
{
				$ini_deb = 0;
				$ini_cred = 0;
				$deb = 0;
				$cred = 0;
				$sal_deb = 0;
				$sal_cred = 0;
	$cuenta=$row["cod_pptal"];
	$tip_dato=$row["tip_dato"];
	$nivel=$row["nivel"];
	$nombre=ereg_replace("[,;?]", "",$row["nom_rubro"]);
	$nivel =strlen($cuenta);
		$sq2 = "select sum(saldo_deb),sum(saldo_cred),sum(mov_deb),sum(mov_cre) from aux_balance_gen where cuenta like '$cuenta%'"; 	
		$re2 = mysql_db_query($database,$sq2,$cx);
		while ($rw2 = mysql_fetch_array($re2))
			{
				$sal_deb = $rw2["sum(saldo_deb)"];
				$sal_cred = $rw2["sum(saldo_cred)"];
				$mov_deb = $rw2["sum(mov_deb)"];
				$mov_cred = $rw2["sum(mov_cre)"];
				$saldo = $sal_deb + $sal_cred;
				$saldo_mov = $mov_deb - $mov_cred; 
				// signo segun naturaleza
				$cta2 = substr($cuenta,0,1);
				if ($cta2 == 2 || $cta2 == 3 ) $saldo = $saldo * -1;
				
				$suma = abs($sal_deb) + abs($sal_cred); 
					if ($suma !=0)
					{
						// filtro por nivel -- calculo el nivel de la cueta que se esta consultando
						$n_cod = strlen($cuenta);
					  	if ($n_cod ==1) $niv=1;
						if ($n_cod ==2) $niv=2;
						if ($n_cod >2) $niv = ($n_cod/2)+1;
						
						if($niv <= $nivel2)
						{
							if ($movi=='SI')
							{
							printf("
								<tr>
								<td  align='left' class='text'>%s</td>
								<td  align='left' class='Estilo4'>%s</td>
								<td  align='right' class='Estilo4'>%s</td>
								<td  align='right' class='Estilo4'>%s</td>
								<td  align='right' class='Estilo4'>%s</td>
								<td  align='right' class='Estilo4'>%s</td>
								</tr>
								",$cuenta, $nombre,number_format($saldo_mov,2,'.',','),number_format($saldo,2,'.',','),$tip_dato,$niv);
							}else{
							printf("
								<tr>
								<td  align='left' class='text'>%s</td>
								<td  align='left' class='Estilo4'>%s</td>
								<td  align='right' class='Estilo4'>%s</td>
								<td  align='right' class='Estilo4'>%s</td>
								<td  align='right' class='Estilo4'>%s</td>
								</tr>
								",$cuenta, $nombre, number_format($saldo,2,'.',','),$tip_dato,$niv);
							}
						}
					}
				$ini_deb = 0;
				$ini_cred = 0;
				$deb = 0;
				$cred = 0;
				$sal_deb = 0;
				$sal_cred = 0;
					
			}
} // END while consulta saldos cuenta pgcp

printf("</tr></table>"); 
} // Sesion
?>
<br />
<?php
		$sq9 = "select sum(saldo_deb),sum(saldo_cred) from aux_balance_gen where cuenta like '1%'"; 	
		$re9 = mysql_db_query($database,$sq9,$cx);
		$rw9 = mysql_fetch_array($re9);
		$activo = number_format($rw9['sum(saldo_deb)'] - $rw9['sum(saldo_cred)'],2,'.',',');

		$sq10 = "select sum(saldo_deb),sum(saldo_cred) from aux_balance_gen where cuenta like '2%'"; 	
		$re10 = mysql_db_query($database,$sq10,$cx);
		$rw10 = mysql_fetch_array($re10);
		$credito =number_format($rw10['sum(saldo_cred)'] - $rw10['sum(saldo_deb)'],2,'.',',');
		
		$sq11 = "select sum(saldo_deb),sum(saldo_cred) from aux_balance_gen where cuenta like '3%'"; 	
		$re11 = mysql_db_query($database,$sq11,$cx);
		$rw11 = mysql_fetch_array($re11);
		$patrimonio = number_format($rw11['sum(saldo_cred)'] - $rw11['sum(saldo_deb)'],2,'.',',');
		
		$control = number_format(($rw10['sum(saldo_cred)'] - $rw10['sum(saldo_deb)']) + ($rw11['sum(saldo_cred)'] - $rw11['sum(saldo_deb)']),2,'.',',');

// Evaluar si resumen esta activado
if ($resumen=='SI')
{
 echo "<table width='1380' border ='0' align='center' class='bordepunteado1' style='display:none' >
		<tr>
			<td></td>
			<td>TOTAL ACTIVO:</td>
			<td></td>
			<td>$activo</td>
		</tr>
		<tr>
			<td></td>
			<td>TOTAL PASIVO:</td>
			<td></td>
			<td>$credito</td>
		</tr>
		<tr>
			<td></td>
			<td>TOTAL PATRIMONIO:</td>
			<td></td>
			<td>$patrimonio</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>PASIVO + PATRIMONIO:</td>
			<td></td>
			<td>$control</td>
		</tr>
		</table>";

}
else
{

}	
	
?>
<br />
<br />
<br />

<table width='1380' border ='0' align='center' class='bordepunteado1'>
<tr>
	<td align="left" colspan="2"><b><?php echo $rep; ?></b></td>
	<td></td>
	<td align="left" colspan="3"><b><?php echo $conta; ?></b></td>
</tr>
<tr>
	<td align="left" colspan="2">Representante Legal</b></td>
	<td></td>
	<td align="left" colspan="3 ">Contador P&uacute;blico</td>
</tr>

</table>