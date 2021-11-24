<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$fecha = $_REQUEST['cod'];
$tipo=$_REQUEST['tipo'];
$anno =split("/",$fecha);
$anno2 =$anno[0]."/01/01";
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
		$sql2 = "select max(num_contrato) from contrataciones2  where fec_registro='$fecha' and clas_contrato = '$tipo'";
		$res = mysql_db_query($database,$sql2,$cx);
		$row = mysql_fetch_array($res);
		$concec= $row["max(num_contrato)"];
		if ($concec)
		{
			$i=1;
			do {
					$con = $concec + $i;
					$sq2 =mysql_db_query($database,"select * from contrataciones2 where num_contrato ='$con'",$cx);
					$fil = mysql_num_rows($sq2);
					$conant = $con-1;
					$sq3 =mysql_db_query($database,"select * from contrataciones2 where num_contrato ='$conant'",$cx);
					$row3 = mysql_fetch_array($sq3);
					$fecha2 =$row3["fec_registro"]; 
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
					$sql4 = "select max(num_contrato) from contrataciones2 where fec_registro='$fecha_b' and clas_contrato = '$tipo'";
					$res4 = mysql_db_query($database,$sql4,$cx);
					$row4 = mysql_fetch_array($res4);
					// Evaluo si la consulta arroja resultados
					$fila4 = mysql_num_rows($res4);
					$concec2= $row4["max(num_contrato)"];
					if ($concec2)
						{
							// Si la consulta devuelve datos incremento consecutivo para repetir la busqueda hasta encontrar espacio
							// consultar consecutivo y verificar disponibilidad, romper el ciclo
							$i=1;
								do {
									$con = $concec2 + $i;
									$sq2 =mysql_db_query($database,"select * from contrataciones2 where num_contrato ='$con'",$cx);
									$fil = mysql_num_rows($sq2);
									$conant = $con-1;
									$sq3 =mysql_db_query($database,"select * from contrataciones2 where num_contrato ='$conant'",$cx);
									$row3 = mysql_fetch_array($sq3);
									$fecha2 =$row3["fec_registro"]; 
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
