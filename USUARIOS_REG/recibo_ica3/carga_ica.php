<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
// verifico permisos del usuario
		include('../config.php');
		$db = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT ppto FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_query($sql,$db);
		$rw =mysql_fetch_array($res);
if ($rw['ppto']=='SI')
{
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
<style type="text/css">
<!--
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 1px; border-color: #004080; font-size:12px }
</style>

</head>
<body>
<div align="center">
      <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />    </div>
</div>
<br>
<br>
<?php
include('../config.php');
include ('../objetos/saldo_cuenta.php');
include ('../objetos/busca_terceros.php');
//
$sq2 ="select fecha_ini from vf";
$rs2 =mysql_query($sq2,$db);
$rw2 =mysql_fetch_array($rs2);
// Establezco la viegencia de acuerdo a la vigecia
$anno = split("/",$rw2['fecha_ini']);
$fecha_ini = $anno[0]."/01/01";
$fecha_fin = $anno[0]."/12/31";
$ctrl='';
$filas =0;
// Encabezado de la tabla para reporte
echo "<div align='center'>IMPORTACION DE RECIBO DE INDUSTRIA Y COMERCIO</div>";
echo "<br>";
echo "<table border='1' align='center' width='100%' class='bordepunteado1' id='tabla2'>";
echo "<tr bgcolor='#DCE9E5' class='Titulotd'>
		<td>Fila</td>
		<td>Codigo</td>
		<td>Razon Social</td>
		<td>CC</td>
		<td>Vigencia</td>
		<td>Impuesto</td>
		<td>Avisos</td>
		<td>Bomberil</td>
		<td>Cultura</td>
		<td>Patente</td>
		<td>Extem</td>
		<td>Sancion</td>
		<td>Interes</td>
		<td>Saldo</td>
		<td>Insentivo</td>
		<td>Des Impuesto</td>
		<td>Des Vallas</td>
		<td>Total</td>
		<td>Recibo</td>
		<td>Banco</td>
		<td>Error</td>
  </tr>";
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='ica.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {	 
	 if ($data[0] == 'D')
		 {	
		// Controlar que la cueta ptal exista y sea de detalle
			$sq3="select tip_dato from pgcp where cod_pptal = '$data[19]'";
			$rs3=mysql_query($sq3,$db);
			$rw3=mysql_fetch_array($rs3);
			if($rw3['tip_dato'] !='D')
			{
				$ctrl ='1';
				$error .='La cuenta seleccionada no es de detalle<br>';
			}
			// Verificar si existe el tercero 
			$ter = busca_terceros($data[3]);
			$tervar = split(",",$ter);
			if ($ter =='')
			{
				$ctrl ='1';
				$error .='El tercero no existe en la base de datos <br>';
			}
			if ($tervar[0]=='n')
			{
				$ter_nat=$tervar[1];
				$tercero=$tervar[2];
			}
			if ($tervar[0]=='j')
			{
				$ter_jur=$tervar[1];
				$tercero=$tervar[2];
			}
			// Reporte registro con error 
			// Colores validacion
			if ($error =='') {$colore ="bgcolor='#00CC33'"; $error ='Ok';} else $colore ="bgcolor='#FF3333' ";
			if ($ctrl =='1')
			{	
			 echo "<tr>
							<td>$filas</td>
							<td>$data[1]</td>
							<td>$data[2]</td>
							<td>$data[3]</td>
							<td align='center'>$data[4]</td>
							<td align='right'>$data[5]</td>
							<td align='right'>$data[6]</td>
							<td align='right'>$data[7]</td>
							<td align='right'>$data[8]</td>
							<td align='right'>$data[9]</td>
							<td align='right'>$data[10]</td>
							<td align='right'>$data[11]</td>
							<td align='right'>$data[12]</td>
							<td align='right'>$data[13]</td>
							<td align='right'>$data[14]</td>
							<td align='right'>$data[17]</td>
							<td align='right'>$data[18]</td>
							<td align='right'>$data[15]</td>
							<td align='center'>$data[16]</td>
							<td align='center'>$data[19]</td>
							<td align='center' $colore>$error</td>
						  </tr>"	;
			}
			} // end campo D
			$error='';
			$filas++;
		} // end while
       // si no hay errores guardar
		 if($ctrl =='')
		 {
     			 // Borrar la tabla temp
				$tabla="TRUNCATE TABLE `temp_ica`";
	
						if(mysql_query ($tabla,$db)) 
						{
						echo "";
						}
						else
						{
						echo "";
						};	

		 $filename='ica.csv'; 
         $handle = fopen("$filename", "r");
		 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		 {	 
		 if ($data[0] == 'D')
			 {	
				 
				 // hacer un registro por cada campo de la tabla
				 
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'3',
								'$data[5]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							 
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'4',
								'$data[6]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'5',
								'$data[7]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'6',
								'$data[8]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'7',
								'$data[9]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'8',
								'$data[10]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'9',
								'$data[11]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'10',
								'$data[12]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'11',
								'$data[13]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'12',
								'$data[17]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'13',
								'$data[18]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
							   
							   $import="INSERT INTO temp_ica ( 
								codigo,
								raz_social,
								cc,
								vigencia,
								tipo,
								impuesto,
								recibo,
								cta_banco,
								fecha,
								detalle
								)VALUES(
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$data[4]',
								'T',
								'$data[15]',
								'$data[16]',
								'$data[19]',
								'$data[20]',
								'$data[21]'
								)";
							   mysql_query($import) or die(mysql_error());
						   
					}	// 		
				} // end campo D
				
			} // end while
	   fclose($handle);
	echo "</table>";
	if($ctrl =='')
	{
		echo "<br>";
		echo "<center>Registros validados con exito...   <input type='button' name='boton' value='Procesar ' style='background:#66CC66; color:#FFFFFF; border:none' onclick=window.open('../recibo_ica/lote_ica.php','_self') /> 	</center>";
		// ocultar la tabla el encabezado cuando todo se procesa
		
		?>
		<script>
			document.getElementById('tabla2').style.display='none';
		</script>
		<?php
	}
?>
 <?
printf("


<br>
<br>
<div style=padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;>
  <div align=center>
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align=center><a href='upload.php?' target='_parent' class=Estilo2>VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
");

?>


</body>
</html>
<?php
}
//$cx = null;
}
?>