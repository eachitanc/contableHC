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
     $filename='facturacion.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {	 
	 if ($data[0] != '')
		 {	
			
		// Verificar que el numero de fact no fue utilizado previamente
			$sq4 = "select ref from lib_aux4 where ref ='$data[0]'"; 
			$rs4 =mysql_query($sq4,$cx);
			$fi4 =mysql_num_rows($rs4);
			if ($fi4 > 0)
			{
				$ctrl ='1';
				$error .='El numero de factura ya fue registrado <br>';
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
			// Verifica numero de contrato
			$sq5 = "select contrato from contrato_evento where contrato ='$data[4]'"; 
			$rs5 =mysql_query($sq5,$cx);
			$fi5 =mysql_num_rows($rs5);
			if ($fi5 == 0)
			{
				$ctrl ='1';
				$error .='El numero de contrato no esta registrado <br>';
			}
			// Verifica el cento de costo
			$sq6 = "select * from cc where nombre ='$data[6]'"; 
			$rs6 =mysql_query($sq6,$cx);
			$fi6 =mysql_num_rows($rs6);
			if ($fi6 == 0 and $data[6] != '-')
			{
				$ctrl ='1';
				$error .='El centro de costo no esta registrado <br>';
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
		 $filename='facturacion.csv'; 
         $handle = fopen("$filename", "r");
		 while (($data = fgetcsv($handle, 2000, ",")) !== FALSE)
		 {	 
		 // Si flia 1 diferente de vacio
		 if ($data[0] != '')
			 {	
					// DATOS PARA GRABAR EN LA TABLA lib_aux4
					// obtenr el id_auto del lib aux4
					$sq6= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux4'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$consecutivo = $rw6[Auto_increment];
					}
					
					$sq7= "SHOW TABLE STATUS FROM $database LIKE 'reip_ing'";
					$rs7 = mysql_query($sq7,$cx);
					while($rw7 = mysql_fetch_array($rs7)) 
					{
					$consec_reip = $rw7[Auto_increment];
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
					// Consulta datos del contrato
					// Verifica numero de contrato
					$sq5 = "select * from contrato_evento where contrato ='$data[4]'"; 
					$rs5 =mysql_query($sq5,$cx);
					$rw5 =mysql_fetch_array($rs5);
					$cuenta_db =$rw5['cuenta_bd'];
					$cuenta_pptal =$rw5['cuenta_pptal'];
					$cta_copago =$rw5['cta_copago'];
					$cta_caja =$rw5['cta_caja'];
					// Verfifcio cuenta centro de costo
					// Verifica el cento de costo
					$sq6 = "select * from cc where nombre ='$data[6]'"; 
					$rs6 =mysql_query($sq6,$cx);
					$rw6 =mysql_fetch_array($rs6);
					$cta_factura =$rw6['cta_factura'];
				 // Trabajar con transacciones guarda en cdpp y crpp
				 	if($data[6] != '-')
					{
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
								'FACT$consecutivo',
								'$consecutivo',
								'$data[5]',
								'$data[5]',
								'FAC$data[0]',
								'$data[0]',
								'$cuenta_db',
								'VENTA DE SERVICIOS DE SALUD 1',
								'$tercero',
								'$ccnit',
								'$data[7]',
								'0.00',
								'',
								'$data[10]'
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
								'FACT$consecutivo',
								'$consecutivo',
								'$data[5]',
								'$data[5]',
								'FAC$data[0]',
								'$data[0]',
								'$cta_factura',
								'VENTA DE SERVICIOS DE SALUD 1',
								'$tercero',
								'$ccnit',
								'0.00',
								'$data[7]',
								'',
								'$data[10]'
								)";
							   mysql_query($import) or die(mysql_error());
					// Reporte registro exitoso
					 // registrar valores recaudados en presupuesto
							   $importp="INSERT INTO reip_ing ( 
								id_emp,
								consecutivo,
								fecha_reg,
								ccnit,
								des,
								cuenta,
								valor,
								tercero,
								contab,
								id_manu_reip,
								proceso
								)VALUES(
								'2',
								'FACT$consec_reip',
								'$data[5]',
								'$ccnit',
								'VENTA SERVICIOS DE SALUD 1',
								'$cuenta_pptal',
								'$data[7]',
								'$tercero',
								'SI',
								'FACT$data[0]',
								'$data[10]'
								)";
							    mysql_query($importp) or die(mysql_error());
						// contabilidad copagos y cuota moderadora
					}else{
						if ($data[9] >0)
						{
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
								'COPG$consecutivo',
								'$consecutivo',
								'$data[5]',
								'$data[5]',
								'COPG$data[0]',
								'$data[0]',
								'$cta_caja',
								'RECAUDO CUOTA MODERADORA',
								'$tercero',
								'$ccnit',
								'$data[9]',
								'0.00',
								'',
								'$data[10]'
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
								'COPG$consecutivo',
								'$consecutivo',
								'$data[5]',
								'$data[5]',
								'COPG$data[0]',
								'$data[0]',
								'$cuenta_db',
								'RECAUDO CUOTA MODERADORA',
								'$tercero',
								'$ccnit',
								'0.00',
								'$data[9]',
								'',
								'$data[10]'
								)";
							   mysql_query($import) or die(mysql_error());
						// Recaudo cuota moderadora 
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
								'COPG$consecutivo',
								'$data[5]',
								'RECAUDO CUOTA MODERADORA',
								'$tercero',
								'$cuenta_pptal',
								'$data[9]',
								'RECF$data[0]',
								'$ccnit',
								'$data[10]'
								)";
							    mysql_query($importp) or die(mysql_error());
						}
					}
							   
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
