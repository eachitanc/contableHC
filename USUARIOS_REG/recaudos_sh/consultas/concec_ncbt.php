<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$fecha = $_REQUEST['cod'];
$anno =explode("/",$fecha);
$anno2 =$anno[0]."/01/01";
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
		$sql2 = "select max(id_manu_ncbt) from recaudo_ncbt where fecha_recaudo='$fecha'";
		$res = $cx->query($sql2);
		$row =$res->fetch_assoc();
		$dato = $row["max(id_manu_ncbt)"];
		$concec= substr($dato,4,20);
		if ($concec)
		{
			$i=1;
			do {
					$con = $concec + $i;
					$con2 ="NCBT".$con;
					$sq2 =$cx->query("select * from recaudo_ncbt where id_manu_ncbt ='$con2'");
					$fil = $sq2->num_rows;
					$conant = $con-1;
					$conant2 = "NCBT".$conant;
					$sq3 =$cx->query("select * from recaudo_ncbt where id_manu_ncbt ='$conant2'");
					$row3 = $sq3->fetch_assoc();
					$fecha2 =$row3["id_manu_ncbt"]; 
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
		// si la fecha no tiene registros
		}else{
			$k=0;
			// Cuando el sistema no encuentra un registro para la fecha seleccionada
			do {
					// redusca la fecha en d�as
					$fecha_b = date("Y/m/d", strtotime( "$fecha -$k day"));
					// para consultar solo en la vigencia
					if ($fecha_b < $anno2) break;
					// busco el valor maximo del consecutivo para la fecha reducida
					$sql4 = "select max(id_manu_ncbt) from recaudo_ncbt where fecha_recaudo='$fecha_b'";
					$res4 = $cx->query($sql4);
					$row4 = $res4->fetch_assoc();
					// Evaluo si la consulta arroja resultados
					$fila4 = $res4->num_rows;
					$dato = $row4["max(id_manu_ncbt)"];
					$concec2= substr($dato,4,20);
					if ($concec2)
						{
							// Si la consulta devuelve datos incremento consecutivo para repetir la busqueda hasta encontrar espacio
							// consultar consecutivo y verificar disponibilidad, romper el ciclo
							$i=1;
								do {
									$con = $concec2 + $i;
									$con2= "NCBT".$con;
									$sq2 =$cx->query("select * from recaudo_ncbt where id_manu_ncbt ='$con2'");
									$fil = $sq2->num_rows;
									$conant = $con-1;
									$conant2 = "NCBT".$conant;
									$sq3 =$cx->query("select * from recaudo_ncbt where id_manu_ncbt ='$conant2'");
									$row3 = $sq3->fetch_assoc();
									$fecha2 =$row3["fecha_recaudo"]; 
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
