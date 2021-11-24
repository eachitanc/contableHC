<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$fecha = $_REQUEST['cod'];
$anno =split("/",$fecha);
$anno2 =$anno[0]."/01/01";
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
		$sql2 = "select max(dcto) from lib_aux4 where fecha='$fecha' and dcto like 'NCSF%'";
		$res = mysql_db_query($database,$sql2,$cx);
		$row = mysql_fetch_array($res);
		$dato = $row["max(dcto)"];
		$concec= substr($dato,4,20);
		if ($concec)
		{
			$i=1;
			do {
					$con = $concec + $i;
					$con2 ="NCSF".$con;
					$sq2 =mysql_db_query($database,"select * from lib_aux2 where dcto  ='$con2'",$cx);
					$fil = mysql_num_rows($sq2);
					$conant = $con-1;
					$conant2 = "NCSF".$conant;
					$sq3 =mysql_db_query($database,"select * from lib_aux2 where dcto  ='$conant2'",$cx);
					$row3 = mysql_fetch_array($sq3);
					$fecha2 =$row3["fecha"]; 
					if ($fil >0)
					{
						$i++;
						$j =0;
					}else{
						echo $con.",".$fecha2;
						$j=1;
						break;
					}
				} while ($j=1);	
		
		}else{
			$k=0;
			// Cuando el sistema no encuentra un registro para la fecha seleccionada
			do {
					// redusca la fecha en d�as
					$fecha_b = date("Y/m/d", strtotime( "$fecha -$k day"));
					// para consultar solo en la vigencia
					if ($fecha_b < $anno2) break;
					// busco el valor maximo del consecutivo para la fecha reducida
					$sql4 = "select max(dcto) from lib_aux4 where fecha='$fecha_b' and dcto like 'NCSF%'";
					$res4 = mysql_db_query($database,$sql4,$cx);
					$row4 = mysql_fetch_array($res4);
					// Evaluo si la consulta arroja resultados
					$fila4 = mysql_num_rows($res4);
					$dato = $row4["max(dcto)"];
					$concec2= substr($dato,4,20);
					if ($concec2)
						{
							// Si la consulta devuelve datos incremento consecutivo para repetir la busqueda hasta encontrar espacio
							// consultar consecutivo y verificar disponibilidad, romper el ciclo
							$i=1;
								do {
									$con = $concec2 + $i;
									$con2= "NCSF".$con;
									$sq2 =mysql_db_query($database,"select * from lib_aux2 where dcto  ='$con2'",$cx);
									$fil = mysql_num_rows($sq2);
									$conant = $con-1;
									$conant2 = "NCSF".$conant;
									$sq3 =mysql_db_query($database,"select * from lib_aux2 where dcto  ='$conant2'",$cx);
									$row3 = mysql_fetch_array($sq3);
									$fecha2 =$row3["fecha"]; 
									if ($fil >0)
									{
										$i++;
										$j =0;
									}else{
										echo $con.",".$fecha2;
										$j='1';
										break;
									}
								} while ($j=1);				
						break;
						}else{
							// restar la fecha en dos y repetir consulta hasta que fecha sea igual a inicio de vigencia
							$k++;
							$j=0;
						}
			} while ($j='1'); 

		 
		}
$cx = null;
?>
