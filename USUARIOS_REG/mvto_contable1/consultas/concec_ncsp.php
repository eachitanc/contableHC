<?php
// conexion con la base de datos
header("Cache-Control: no-store, no-cache, must-revalidate");
		include('../../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		 
		$fecha = $_REQUEST['cod']; //LLega la fecha del formulario
		$anno =split("/",$fecha);
        $anno2 =$anno[0]."/01/01";
// Realizo la edicion de los datos
		$sq2 ="select max(id_manu_ncon) as dcto from conta_ncsp where id_manu_ncon like 'NCSP%' and  fecha_ncon between '$anno2' and '$fecha' ";
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
				$con="NCSP".$concec;
				// Buscar hasta que el documento no exista 
				$sq3 ="select id_manu_ncon from conta_ncsp where id_manu_ncon = '$con'";
				$re3 = mysql_query($sq3);
				$fil = mysql_fetch_array($re3);
				if($fil ==0)
				{
					$fin =1;
					// Busco fecha del ultimo registro
					$id = "NCSP".($concec-1);
					$sq4 ="select fecha_ncon from conta_ncsp where id_manu_ncon = '$id'";
					$re4 = mysql_query($sq4);
					$rw4 = mysql_fetch_array($re4);
				}
		     } while ($fin<1);	
		}else{
			$concec =$anno[0]."0001";
			do{
				$concec++;
				$con="NCSP".$concec;
				// Buscar hasta que el documento no exista 
				$sq3 ="select id_manu_ncon from conta_ncsp where id_manu_ncon = '$con'";
				$re3 = mysql_query($sq3);
				$fil = mysql_fetch_array($re3);
				if($fil ==0)
				{
					$fin =1;
					// Busco fecha del ultimo registro
					$id = "NCSP".($concec-1);
					$sq4 ="select fecha_ncon from conta_ncsp where id_manu_ncon = '$id'";
					$re4 = mysql_query($sq4);
					$rw4 = mysql_fetch_array($re4);
				}
		     } while ($fin<1);
		}
		echo $concec.",".$rw4['fecha_ncon'];	
//Cierro la conexion de la base de datos
$cx = null;
?>
