<?php
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
// verifico permisos del usuario
		include('../../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT ter FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_query($sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['ter']=='SI')
{
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
</head>
<body>
<?php
include ('../../objetos/busca_terceros.php');
//
$db = mysql_connect($server,$dbuser,$dbpass) or die("No se puede conectar con la base de datos...");
$sq2 ="select fecha_ini from vf";
$rs2 =mysql_query($sq2,$cx);
$rw2 =mysql_fetch_array($rs2);
// Establezco la viegencia de acuerdo a la vigecia
$anno = split("/",$rw2['fecha_ini']);
$fecha_ini = $anno[0]."/01/01";
$fecha_fin = $anno[0]."/12/31";
$ctrl='';
$filas =0;
// Encabezado de la tabla para reporte
echo "<div align='center'>ERRORES DE IMPORTACION DE TERCEROS</div>";
echo "<br>";
echo "<table border='1' align='center' width='80%' class='bordepunteado1'>";
echo "<tr bgcolor='#DCE9E5' class='Titulotd'>
		<td>Fila</td>
		<td>Documento</td>
		<td>Apellido 1</td>
		<td>Apellido 2</td>
		<td>Nombre 1</td>
		<td>Nombre 2</td>
		<td>Errores</td>
	  </tr>"	;
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='terceros.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {	
	 
	 if ($data[0] == 'D')
		 {	
		// Verificar si la fecha esta dentro de la vigencia actual
		  $fecha = date('y/m/d');
		// Verificar que el campo documento este lleno
			if ($data[1] =='')
			{
				$ctrl ='1';
				$error .='El campo documento no puede estar vacio <br>';
			}
			if ($data[2] =='')
			{
				$ctrl ='1';
				$error .='El campo primer apellido no puede estar vacio <br>';
			}
			if ($data[4] =='')
			{
				$ctrl ='1';
				$error .='El campo primer nombre no puede estar vacio <br>';
			}
			// Verificar si existe el tercero 
			$ter = busca_terceros($data[4]);
			$tervar = split(",",$ter);
			if ($ter !='')
			{
				$ctrl ='1';
				$error .='El tercero ya existe en la base de datos <br>';
			}
     		// VERIFICO QUE NO EXISTAN ERRORES
			 if($ctrl !='1')
			 {

			 // Trabajar con transacciones guarda en cdpp y crpp
			 
						   $import="INSERT INTO terceros_naturales ( 
							id_emp,
							fecha_reg,
							tipo_id,
							num_id,
							clase,
							regimen,
							ent_ofi,
							pri_ape,
							seg_ape,
							pri_nom,
							seg_nom,
							dir,
							ref
							)VALUES(
							'2',
							'$fecha',
							'1',
							'$data[1]',
							'CONTRATISTA',
							'SIMPLIFICADO',
							'NO',
							'$data[2]',
							'$data[3]',
							'$data[4]',
							'$data[5]',
							'$data[6]',
							'$data[7]'
							)";
						   mysql_query($import) or die(mysql_error());
				// Reporte registro exitoso
				 }else{
				 // Reporte registro con error 
				 echo "<tr>
							<td>$filas</td>
							<td>$data[1]</td>
							<td>$data[2]</td>
							<td>$data[3]</td>
							<td>$data[4]</td>
							<td>$data[5]</td>
							<td>$error</td>
						  </tr>"	;
					 
				 } // end else errores
			} // end campo D
			$error='';
			$ctrl='';
			$filas++;
		} // end while
       
	   fclose($handle);
	   
	echo "</table>";

?>
 <?php
printf("

<center >
<form method='post' action='mvto.php'>
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
