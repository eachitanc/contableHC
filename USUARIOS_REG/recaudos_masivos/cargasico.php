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
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT ppto FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_query($sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['ppto']=='SI')
{
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
</head>
<body>
<?php
include('../config.php');
include ('../objetos/saldo_cuenta.php');
include ('../objetos/busca_terceros_fac.php');
//
$db = mysql_connect($server,$dbuser,$dbpass) or die("No se puede conectar con la base de datos...");
$sq2 ="select fecha_ini from vf";
$rs2 =mysql_query($sq2,$cx);
$rw2 =mysql_fetch_array($rs2);
// Establezco la viegencia de acuerdo a la vigecia
$anno = split("/",$rw2['fecha_ini']);
$fecha_ini = "2019/01/01";
$fecha_fin = "2019/12/31";
$ctrl='';
$filas =0;
// Encabezado de la tabla para reporte
echo "<div align='center'>ERRORES DE IMPORTACION DE FACTURACION</div>";
echo "<br>";
echo "<table border='1' align='center' width='80%' class='bordepunteado1'>";
echo "<tr bgcolor='#DCE9E5' class='Titulotd'>
		<td>Fila</td>
		<td>Factura</td>
		<td>Nit</td>
		<td>Empresa</td>
		<td>Contrato</td>
		<td>Fecha</td>
		<td>Valor</td>
		<td>Reporte</td>
	  </tr>"	;
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='recaudos.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {	 
	 if ($data[0] != '')
		 {	
			
		// Verificar que el numero de fact existe en los registros cargdos
			$sq4 = "select ref from lib_aux4 where ref ='$data[0]'"; 
			$rs4 =mysql_query($sq4,$cx);
			$fi4 =mysql_num_rows($rs4);
			if ($fi4 < 1)
			{
				$ctrl ='1';
				$error .='El numero de factura no fue registrado encartera<br>';
			}
			
			// Verificar si existe el tercero 
			$ter = busca_terceros($data[1]);
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
				$ter_jur='';
			}
			if ($tervar[0]=='j')
			{
				$ter_jur=$tervar[1];
				$tercero=$tervar[2];
				$ter_nat='';
			}
			
			// Reporte registro con error 
			if ($ctrl =='1')
			{	
			 echo "<tr>
							<td>$filas</td>
							<td>$data[0]</td>
							<td>$data[1]</td>
							<td>$data[2]</td>
							<td>$data[4]</td>
							<td>$data[6]</td>
							<td>$data[8]</td>
							<td>$error</td>
						  </tr>"	;
			}
			} // end campo D
			$error='';
			$filas++;
		} // end while
       // si no hay errores guardar
		 if($ctrl =='')
		 {
		 $filename='recaudos.csv'; 
         $handle = fopen("$filename", "r");
		 while (($data = fgetcsv($handle, 2000, ",")) !== FALSE)
		 {	 
		 // Si flia 1 diferente de vacio
		 if ($data[0] != '')
			 {	
					// DATOS PARA GRABAR EN LA TABLA lib_aux10
					// obtenr el id_auto del cdpp
					$sq6= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux4'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$consecutivo = $rw6[Auto_increment];
					}
					
					$sq3= "SHOW TABLE STATUS FROM $database LIKE 'recaudo_riip'";
					$rs3 = mysql_query($sq3,$cx);
					while($rw3 = mysql_fetch_array($rs3)) 
					{
					$consec_ppto = $rw3[Auto_increment];
					}
					
					// calcular la fecha de vencimiento a noventa dias
					$nuevafecha = strtotime ( '+90 day' , strtotime ( $fecha ) ) ;
					$nuevafecha = date ( 'Y/m/d' , $nuevafecha );
					
					// para cargar el valor del tercero
					// Verificar si existe el tercero 
					$ter = busca_terceros($data[1]);
					$tervar = split(",",$ter);
						$ccnit=$tervar[0];
						$tercero=$tervar[1];
					// Consultar datos del contrato
					$sq5 ="select * from contrato_evento where contrato ='$data[3]'";
					$re5 =mysql_query($sq5,$cx);
					$rw5 =mysql_fetch_array($re5);
					$debito= $rw5['cuenta_bd'];
					$credito= $rw5['cuenta_cr'];
					$cod_pptal= $rw5['cuenta_pptal']; 	
					//	Consulto saldo de la cuenta
					$sq7 ="select sum(debito) as debito, sum(credito) as credito from lib_aux4 where ref ='$data[0]'";
					$re7 =mysql_query($sq7,$cx);
					$rw7 =mysql_fetch_array($re7);	
				 // Trabajar con transacciones guarda en cdpp y crpp
				 
							   $import="INSERT INTO lib_aux4 ( 
								id_auto,
								id_cons,
								fecha,
								fecha_ref,
								dcto,
								ref,
								cuenta,
								detalle,
								tercero,
								ccnit,
								debito,
								credito,
								cheque,
								proceso
								)VALUES(
								'RECF$consecutivo',
								'$consecutivo',
								'$data[4]',
								'$data[4]',
								'RECF$data[0]',
								'$data[0]',
								'$debito',
								'$data[6]',
								'$tercero',
								'$ccnit',
								'$data[7]',
								'0.00',
								'',
								'$data[8]'
								)";
							    mysql_query($import) or die(mysql_error());
					//DATOS PARA GRABAR EN LA TABLA REGISTRO
								$import="INSERT INTO lib_aux4 ( 
								id_auto,
								id_cons,
								fecha,
								fecha_ref,
								dcto,
								ref,
								cuenta,
								detalle,
								tercero,
								ccnit,
								debito,
								credito,
								cheque,
								proceso
								)VALUES(
								'RECF$consecutivo',
								'$consecutivo',
								'$data[4]',
								'$data[4]',
								'RECF$data[0]',
								'$data[0]',
								'$credito',
								'$data[6]',
								'$tercero',
								'$ccnit',
								'0.00',
								'$data[7]',
								'',
								'$data[8]'
								)";
							    mysql_query($import) or die(mysql_error());
							   // registrar valores recaudados en presupuesto
							   $importp="INSERT INTO recaudo_riip ( 
								id_emp,
								id_recau,
								fecha_recaudo,
								des_recaudo,
								tercero,
								cuenta,
								vr_digitado,
								id_manu_rcgt,
								ter,
								proceso
								)VALUES(
								'2',
								'FACT$consecutivo',
								'$data[4]',
								'$data[6]',
								'$tercero',
								'$cod_pptal',
								'$data[7]',
								'RECF$data[0]',
								'$ccnit',
								'$data[8]'
								)";
							    mysql_query($importp) or die(mysql_error());
							   
					// Reporte registro exitoso
						   
					}	// 		
				} // end campo D
				echo "Registro guardado con exito...";
			} // end while
	   fclose($handle);
	   
	echo "</table>";

?>
 <?
printf("

<center >
<form method='post' action='upload.php'>
<input type='hidden' name='nn' value='CDPP'>
 <input type='submit' name='Submit' value='Volver' class='Estilo4' style='background:#72A0CF; color:#FFFFFF; border:none; font-size: 13px;' /> 
</form>
</center>
");

?>


</body>
</html>
<?php
}
//$cx = null;
}
?>
