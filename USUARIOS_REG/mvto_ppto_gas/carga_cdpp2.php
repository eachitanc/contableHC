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
		$cx = new mysqli($server, $dbuser, $dbpass, $database)or die ("Conexion no Exitosa");
		 
       	$sql="SELECT ppto FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_query($sql,$cx);
		$rw =$res->fetch_assoc();
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
include ('../objetos/busca_terceros.php');
//
$db = mysql_connect($server,$dbuser,$dbpass) or die("No se puede conectar con la base de datos...");
$sq2 ="select fecha_ini from vf";
$rs2 =mysql_query($sq2,$cx);
$rw2 =mysql_fetch_array($rs2);
// Establezco la viegencia de acuerdo a la vigecia
$anno = split("/",$rw2['fecha_ini']);
$fecha_ini = "2020/01/01";
$fecha_fin = "2020/12/31";
$ctrl='';
$filas =0;
// Encabezado de la tabla para reporte
echo "<div align='center'>ERRORES DE IMPORTACION DE DISPONIBILIDADES</div>";
echo "<br>";
echo "<table border='1' align='center' width='80%' class='bordepunteado1'>";
echo "<tr bgcolor='#DCE9E5' class='Titulotd'>
		<td>Fila</td>
		<td>Fecha</td>
		<td>Cdp</td>
		<td>Rp</td>
		<td>Tercero</td>
		<td>Descripcion</td>
		<td>Rubro</td>
		<td>Valor</td>
		<td>Contrato</td>
		<td>Referencia</td>
		<td>Reporte</td>
	  </tr>"	;
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='cdpp.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {	 
	 if ($data[0] == 'D')
		 {	
		// Verificar si la fecha esta dentro de la vigencia actual
		  $fecha = $data[1];
		  if ($fecha < $fecha_ini || $fecha > $fecha_fin)
			{
				$ctrl ='1';
				$error .='La fecha no esta dentro de la vigencia actual <br>';
			}
		// Verificar que el campo descripcion este lleno
			if ($data[5] =='')
			{
				$ctrl ='1';
				$error .='El campo descripción no puede estar vacio <br>';
			}
		// Controlar que la cueta ptal exista y sea de detalle
			$sq3="select tip_dato from car_ppto_gas where cod_pptal = '$data[6]'";
			$rs3=mysql_query($sq3,$cx);
			$rw3=mysql_fetch_array($rs3);
			if($rw3['tip_dato'] !='D')
			{
				$ctrl ='1';
				$error .='El rubro presupuestal no existe o no es de detalle <br>';
			}
		// Verificar saldo disponible
			$saldo2 = saldo_cuenta_cdp($data[6]);
			if($saldo2 < $data[7])
			{
				$ctrl ='1';
				$error .='El saldo del rubro es insuficiente <br>';
			}
		// Verificar que el numero de cedp no fue utilizado previamente
			$sq4 = "select cdpp from cdpp where cdpp ='$data[2]'"; 
			$rs4 =mysql_query($sq4,$cx);
			$fi4 =mysql_num_rows($rs4);
			if ($fi4 > 0)
			{
				$ctrl ='1';
				$error .='El numero de Cdp ya fue registrado <br>';
			}
			$num ='CRPP'.$data[3];
			$sq5 = "select id_manu_crpp from crpp where id_manu_crpp ='$num'"; 
			$rs5 =mysql_query($sq5,$cx);
			$fi5 =mysql_num_rows($rs5);
			if ($fi5 > 0)
			{
				$ctrl ='1';
				$error .='El numero de Registro ya fue utilizado <br>';
			}
			// Verificar si existe el tercero 
			$ter = busca_terceros($data[4]);
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
			// verifica que el campo maneja contrato no este vacio
			if ($data[8]=='')
			{
				$ctrl ='1';
				$error .='El campo maneja contrato no se ha establecido <br>';
			}
			// Reporte registro con error 
			if ($ctrl =='1')
			{	
			 echo "<tr>
							<td>$filas</td>
							<td>$data[1]</td>
							<td>$data[2]</td>
							<td>$data[3]</td>
							<td>$data[4]</td>
							<td>$data[5]</td>
							<td>$data[6]</td>
							<td>$data[7]</td>
							<td>$data[8]</td>
							<td>$data[9]</td>
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
		 $filename='cdpp.csv'; 
         $handle = fopen("$filename", "r");
		 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		 {	 
		 if ($data[0] == 'D')
			 {	
					// DATOS PARA GRABAR EN LA TABLA CDPP
					// obtenr el id_auto del cdpp
					$sq6= "SHOW TABLE STATUS FROM $database LIKE 'cdpp'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$consecutivo = $rw6[Auto_increment];
					}
					// Obtengo el nombre del rubro
					$sq7="select nom_rubro from car_ppto_gas where cod_pptal ='$data[6]'";
					$rs7=mysql_query($sq7);
					$rw7=mysql_fetch_array($rs7);
					$nom_rubro= $rw7['nom_rubro'];
					// calcular la fecha de vencimiento a noventa dias
					$nuevafecha = strtotime ( '+90 day' , strtotime ( $fecha ) ) ;
					$nuevafecha = date ( 'Y/m/d' , $nuevafecha );
					// obtenr el id_auto del cdpp
					$sq8= "SHOW TABLE STATUS FROM $database LIKE 'crpp'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$id_auto_crpp = 'CRPP'.$rw8[Auto_increment];
					}
					// para cargar el valor del tercero
								// Verificar si existe el tercero 
					$ter = busca_terceros($data[4]);
					$tervar = split(",",$ter);
					if ($tervar[0]=='n')
					{
						$ter_nat=$tervar[1];
						$tercero=$tervar[2];
						$ter_jur=0;
					}
					if ($tervar[0]=='j')
					{
						$ter_jur=$tervar[1];
						$tercero=$tervar[2];
						$ter_nat=0;
					}
				 // Trabajar con transacciones guarda en cdpp y crpp
				 
							   $import="INSERT INTO cdpp ( 
								id_emp,
								consecutivo,
								fecha_reg,
								fecha_ven,
								des,
								cuenta,
								nom_rubro,
								valor,
								contab,
								cdpp,
								ref
								)VALUES(
								'2',
								'CDPP$consecutivo',
								'$data[1]',
								'$nuevafecha',
								'$data[5]',
								'$data[6]',
								'$nom_rubro',
								'$data[7]',
								'SI',
								'$data[2]',
								'$data[9]'
								)";
							   mysql_query($import) or die(mysql_error());
					//DATOS PARA GRABAR EN LA TABLA REGISTRO
								 $import="INSERT INTO crpp ( 
								id_emp,
								id_auto_crpp,
								id_manu_crpp,
								fecha_crpp,
								id_manu_cdpp,
								id_auto_cdpp,
								fecha_cdpp,
								tercero,
								ter_nat,
								ter_jur,
								des_cdpp,
								contrato,
								situacion,
								vr_digitado,
								cuenta,
								ctrl,
								detalle_crpp,
								ref,
								n_contrato
								)VALUES(
								'2',
								'$id_auto_crpp',
								'CRPP$data[3]',
								'$data[1]',
								'CDPP$data[2]',
								'CDPP$consecutivo',
								'$data[1]',
								'$tercero',
								'$ter_nat',
								'$ter_jur',
								'$data[5]',
								'$data[8]',
								'C',
								'$data[7]',
								'$data[6]',
								'NO',
								'$data[5]',
								'$data[9]',
								'$data[10]'
								)";
							   mysql_query($import) or die(mysql_error());
					// Reporte registro exitoso
						   
					}	// 		
				} // end campo D
				echo "Registro guardado con exito...";
			} // end while
	   fclose($handle);
	   
	echo "</table>";

?>
 <?php
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
