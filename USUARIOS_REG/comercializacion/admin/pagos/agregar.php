<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$claves =(array_keys($_POST));
		$datos =(array_values($_POST));
		$n = count($datos)-1;
		$tabla =$datos[0];
		$i=0;
		for ($i=1;$i<=$n;$i++)
		{
			$prueba = split("_",$claves[$i]);
			if($prueba[0] != 'NO')
			{
			if ($i<$n)
				{
					$campos .= $claves[$i]. ',';
					$valores .= "'".$datos[$i]. "',";
					$ediar .= $claves[$i]. "='".$datos[$i]."',";
				}
			if ($i==$n)
				{	
					$campos .= $claves[$i];
					$valores .= "'".$datos[$i]."'";
					$ediar .= $claves[$i]. "='".$datos[$i]."'";
				}
			}
		}
		$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'liquidacion'");
		while($array = mysql_fetch_array($resulta)) 
		{
		$consec = $array[Auto_increment];
		}
		// verifico si el documento ya existe
		$sq = "select * from $tabla where fecha_ini = '$datos[2]' and fecha_fin ='$datos[3]' and cliente ='$datos[1]'";
		$rs = mysql_query($sq);
		$fi = mysql_num_rows($rs);
		$id=$datos[1];
		if ($fi == 0)
		{
			$sql3 ="insert into $tabla ($campos) values( $valores)";
			$re2 = mysql_query($sql3);
			if (!$re2) {
				die('Invalid query: ' . mysql_error());
				echo "<script>alert('El registro no fue guardado..');</script>";
			}
			$sq4 = "update despacho set liquidado ='$consec' where cliente = '$datos[1]' and fecha between '$datos[2]' and '$datos[3]' ";
			$re4 = mysql_query($sq4);
		}else{
			$sq3 = "update $tabla set $ediar where cliente = '$datos[1]' and fecha ='$datos[2]'";
			$re3 = mysql_query($sq3);
			if (!$re3) {
				die('Invalid query: ' . mysql_error());
				echo "<script>alert('El registro no fue guardado..');</script>";
				}
		}
// Archivo a mostar desùes de guardar
			 echo "<script>	cargaArchivo('admin/$tabla/inicio.php?fecha=$datos[2]','columna1');</script>";	
$cx = null;

?>