<?
header('Content-Type: text/html; charset=latin1'); 
include '../config.php';
$cx=mysql_connect($server,$dbuser,$dbpass);
mysql_select_db("$database"); 
$id_crpp = $_GET['id'];
?>

<input type="button" name="boton" value="Nuevo" style="background:#72A0CF; color:#FFFFFF; border:none" onclick="cargaArchivo('form_cc.php','mostrar')" />
<table class="table">
					<thead>
						<tr>
							<th width="55%">Centro de costo</th>
							<th width="30%">Porcentaje</th>
                            <th width="15%"></th>
						</tr>
					</thead>
					<tbody>
					<? 
						$sq3="select * from cc_obcg	where id_doc='$id_crpp'";
						$rs3 =mysql_query($sq3,$cx);
						while ($rw3 =mysql_fetch_array($rs3))
						{
							// consultar datos del centro de costo
							$sq4="select * from cc where id='$rw3[id_cc]'";
							$rs4 =mysql_query($sq4,$cx);
							while ($rw4 =mysql_fetch_array($rs4))
							{
							$cc  =$rw4['nombre'];
							}
							echo "<tr>
									<td>$cc</td>
									<td>$rw3[valor]</td>
                            		<td>
										<ion-icon name='create-outline' ></ion-icon>
										<ion-icon name='close-circle-outline'></ion-icon>
									</td>
								</tr>";    
						}
					?>
					</tbody>
</table>
