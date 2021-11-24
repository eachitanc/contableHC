<?
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=BALANCE_DE_PRUEBA.xls");
header("Pragma: no-cache");
header("Expires: 0");
$fecha_ini=$_GET['fecha_ini']; //printf("fecha_ini : %s <br>",$fecha_ini);
$fecha_fin=$_GET['fecha_fin']; //printf("fecha_fin : %s <br>",$fecha_fin);
echo "<br />";
$aux='16';
//printf("Fecha de inicio : %s<br><br>",$fecha_ini);
//printf("Fecha de corte : %s<br><br>",$fecha_fin);
include('../config.php');
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
$idxx=$rowxx["id_emp"];
$id_emp=$rowxx["id_emp"];
$ano=$rowxx["ano"];
}
$sqldatos = "select * from empresa";
$resdatos= mysql_db_query($database,$sqldatos,$connectionxx);
while ($rw1 = mysql_fetch_array($resdatos))
	{
		$entidad = $rw1["raz_soc"];
		$nit = $rw1["nit"];
		$rep = $rw1["nom_rep_leg"];
		$conta = $rw1["nom_cont"];
	} 
// encabesados informe
?>
<html>
<head>
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
</head>
<body>
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
	<td><b>LIBRO OFICIAL:</b></td>
	<td>BALANCE GENERAL</td>
</tr>
<tr>
	<td><b>FECHA DE CORTE:</b></td>
	<td align="left"><?php echo $fecha_fin; ?></td>
</tr>
<tr>
	<td><b>FECHA REPORTE:</b></td>
	<td align="left"><?php echo date('Y/m/d'); 
; ?></td>
</tr>

</table>
<br />
<?php

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

//$sq = "select * from bal_prueba_deb order by codigo asc ";
$sq = "select * from bal_prueba_deb where nivel <= '$aux' order by codigo asc ";

$re = mysql_db_query($database, $sq, $cx);

// encabezados de tabla
printf("
<center>

<table width='960' BORDER='1' class='bordepunteado1'>
<tr>
<td align='center' width='150' bgcolor='#DCE9E5'><span class='Estilo4'><b>Cod. Pptal</b></span></td>
<td align='center' width='400' bgcolor='#DCE9E5'><span class='Estilo4'><b>Nombre Cuenta</b></span></td>
<td align='center' width='125' bgcolor='#DCE9E5'><span class='Estilo4'><b> Debito </b></span></td>
<td align='center' width='125' bgcolor='#DCE9E5'><span class='Estilo4'><b> Credito </b></span></td>
<td align='center' width='30' bgcolor='#DCE9E5'><span class='Estilo4'><b>Tipo</b></span></td>
<td align='center' width='30' bgcolor='#DCE9E5'><span class='Estilo4'><b> Nivel</b></span></td>

</tr>
");

while($rw = mysql_fetch_array($re)) 
{

$nn1=$rw["codigo"];
/*LAS CUENTAS QUE INICIAN CON : 1,5,6,7 Y 8 SON DE SALDO DEBITO
LAS CUENTAS QUE INICIAN CON : 2,3,4 Y 9 SON DE SALDO CREDITO*/
//******* naturaleza de la cuenta
			$nat1 = substr($nn1,0,1);
			
			$nat2 = substr($nn1,0,2);
			
		if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
			{	$naturaleza = "DEBITO";	}
			else
			{   if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89')
				{
				$naturaleza = "CREDITO";
				}
			}


if($naturaleza == 'DEBITO')
{

	$tipo=$rw["tipo"];
	$nivel=$rw["nivel"];
	if($tipo == 'D')
	{
		
			printf("
			<span class='Estilo4'>
			<tr>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='center' class='numero'>%2f</td>
			<td align='center' class='numero'>0.0</td>",$rw["codigo"], $rw["nombre"],$rw["debito"]);
			
			printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
					<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",  $rw["tipo"], $rw["nivel"]  );
					
				printf("</tr>");		
		
	
	}
	else
	{
				
				$cod=$rw["codigo"];
				$link=mysql_connect($server,$dbuser,$dbpass);
				$resulta=mysql_query("select SUM(debito) AS TOTAL from bal_prueba_deb WHERE tipo = 'D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
				$row=mysql_fetch_row($resulta);
				$total=$row[0]; 
				$nuevo_total = $total;
				//printf("acu : %s",$nuevo_total);
				
/*				if($nuevo_total == '')
				{$nuevo_total = 0.00;}*/
				
				if($nuevo_total == '')
				{
				
				}
				else
				{
				
						//*** nuevo 25/05/2010
						if($cod == '9')
						{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='numero'> 0.0 </span></td>
						<td align='center'><span class='numero'> 0.0 </span></td>",$rw["codigo"], $rw["nombre"]);
						
						printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
								<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>" , $rw["tipo"], $rw["nivel"] );
								
						printf("</tr>");
						
						}
						//**************
						else
						{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='center' class='numero'>%s</td>
						<td align='center'><span class='numero'> 0.0</span></td>",$rw["codigo"], $rw["nombre"], $nuevo_total);
						
						printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
								<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>", $rw["tipo"], $rw["nivel"]);
								
						printf("</tr>");
						}
						
				}
						
				
				
	
	}
	
}	
else// si la naturaleza es credito
{
	
	$tipo=$rw["tipo"];
	if($tipo == 'D')
	{
    printf("
	<span class='Estilo4'>
	<tr>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='center' class='numero'>0.0 </td>
	<td align='center' class='numero'>%s</td>",$rw["codigo"], $rw["nombre"],$rw["credito"] );
	 
	
	printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
			<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",$rw["tipo"], $rw["nivel"]);
			
		printf("</tr>");		
	
	}
	else
	{
	
	$cod=$rw["codigo"];
	$link=mysql_connect($server,$dbuser,$dbpass);
	$resulta=mysql_query("select SUM(credito) AS TOTAL from bal_prueba_deb WHERE tipo = 'D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total=$row[0]; 
	$nuevo_total = $total;
	//printf("acu : %s",$nuevo_total);
/*	if($nuevo_total == '')
	{$nuevo_total = 0.00;}*/
				if($nuevo_total == '')
				{
				
				}
				else
				{
					
				
						//*** nuevo 25/05/2010
						if($cod == '9')
						{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='numero'> 0.0 </span></td>
						<td align='center'><span class='numero'> 0.0</span></td>",$rw["codigo"], $rw["nombre"] );
						
						printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
								<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",$rw["tipo"], $rw["nivel"]);
								
						printf("</tr>");
						
						}
						else
						{
						//**************
							
							
							
							
							
							printf("
							<span class='Estilo4'>
							<tr>
							<td align='left'><span class='Estilo4'> %s </span></td>
							<td align='left'><span class='Estilo4'> %s </span></td>
							<td align='center'><span class='numero'> 0.0 </span></td>
							<td align='center'><span class='numero'> %s </span></td>",$rw["codigo"], $rw["nombre"], $nuevo_total);
							
							printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
									<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>", $rw["tipo"], $rw["nivel"]);
									
							printf("</tr>");
						}	
				}
	
	
	}

}
}//fin while
printf("</table></center>");
?>
	
	
	
	</td>
  </tr>
  
  
  
</table>
</body>
</html>

<?
}
?>