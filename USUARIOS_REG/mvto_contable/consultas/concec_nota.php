<?php
// conexion con la base de datos
header("Cache-Control: no-store, no-cache, must-revalidate");
		include('../../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		 
		$fecha = $_REQUEST['cod']; //LLega la fecha del formulario
		$anno =split("/",$fecha);
        $anno2 =$anno[0]."/01/01";
// Realizo la edicion de los datos
		$sq2 ="select max(dcto) as dcto from lib_aux2 where dcto like 'NCON%' and  fecha between '$anno2' and '$fecha' ";
		$rs2 = mysql_query($sq2);
		while ($rw2 = mysql_fetch_array($rs2))
			{
				$concec= substr($rw2['dcto'],4,20);
			}
		// Valido si exite registros en la base de datos
		$fin =0;
		if ($concec !='')
		{
			do{
				$concec++;
				$con="NCON".$concec;
				// Buscar hasta que el documento no exista 
				$sq3 ="select dcto from lib_aux2 where dcto = '$con'";
				$re3 = mysql_query($sq3);
				$fil = mysql_fetch_array($re3);
				if($fil ==0)
				{
					$fin =1;
					// Busco fecha del ultimo registro
					$id = "NCON".($concec-1);
					$sq4 ="select fecha from lib_aux2 where dcto = '$id'";
					$re4 = mysql_query($sq4);
					$rw4 = mysql_fetch_array($re4);
				}
		     } while ($fin<1);	
		}else{
			$concec =$anno[0]."0001";
		}
		echo $concec.",".$rw4['fecha'];	
//Cierro la conexion de la base de datos
$cx = null;
?>
