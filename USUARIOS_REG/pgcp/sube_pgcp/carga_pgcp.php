<?php
set_time_limit(600);
include('../../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
//********************modifica tamaño campo tabla car_ppto_ing
$anadir5="TRUNCATE TABLE `pgcp` ";
mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir5 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{  $idxx=$rowxx["id_emp"];  $id_emp=$rowxx["id_emp"];  }
$db = mysql_connect($server,$dbuser,$dbpass) or die("Could not connect.");
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename='pgcp.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {	
	// Calcular nivel de las cuentas
	  $n_cod = strlen($data[0]);
	  	if ($n_cod ==1) $nivel=1;
		if ($n_cod ==2) $nivel=2;
		if ($n_cod >2) $nivel = ($n_cod/2)+1;
   	// Verificar estructura presupuestal
		$residuo = $n_cod % 2;
		if ($residuo !=0 && $n_cod!=1) $data[0] = 'Sin nivel';
	// Calcular la cuenta padre
	    if ($n_cod ==1) $padre='';
		if ($n_cod ==2) $padre = substr($data[0], 0, -1);
		if ($n_cod >2)  $padre = substr($data[0], 0, -2); 
		// Verificar si tiene cuenta padre
		if ($n_cod >1) 
		{
		$sql ="select * from pgcp where cod_pptal = '$padre'";
		$res = mysql_db_query ($database,$sql,$conexion);
		$existe = mysql_num_rows($res);
		if ($existe < 1) $data[0] = 'Sin Padre'; echo $$data[0];
		}

	// Validaciones para definir afectacion de cuentas mayores
	if($data[2]=='M') {$afectado='1';}else{$afectado='0';}
	 
			   	   $import="INSERT INTO pgcp ( 
					ano,
					id_emp,
					cod_pptal,
					padre,
					nom_rubro,
					tip_dato,
					nivel,
					afectado,
					naturaleza,
					c_nc,
					bloqueo
					)VALUES(
					'2012/01/01',
					'$id_emp',
					'$data[0]',
					'$padre',
					'$data[1]',
					'$data[2]',
					'$nivel',
					'$afectado',
					'$data[3]',
					'$data[4]',
					'NO'
					)";
				   mysql_query($import) or die(mysql_error());
		}
       fclose($handle);
      // print "Import done";
//*** me voy
echo "Fin";
?>
