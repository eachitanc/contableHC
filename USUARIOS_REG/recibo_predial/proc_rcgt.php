<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {

include ('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass)or die ("Conexion no Exitosa");
 

// id_emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_query($sqlxx, $cx);
$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'recaudo_riip'");
while($array = mysql_fetch_array($resulta)) 
{
$consec_recaudo = $array[Auto_increment];
}
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}
$id_reip ='';
$id_caic ='';
$id_unico_reip='';
$vr_orig_reip='';
$id_manu_rcgt = 'RIIP'.$_POST['id_manu_rcgt']; 
$id_recau = 'RIIP'.$consec_recaudo; 
$fecha_recaudo = $_POST['fecha_recaudo'];
$des_recaudo = strtoupper($_POST['des_recaudo']);
$conta_1=str_replace('.','',$_POST['conta_1']);
$conta_2=str_replace('.','',$_POST['conta_2']);
$conta_3=str_replace('.','',$_POST['conta_3']);
$conta_4=str_replace('.','',$_POST['conta_4']);
$conta_5=str_replace('.','',$_POST['conta_5']);
$conta_6=str_replace('.','',$_POST['conta_6']);
$conta_7=str_replace('.','',$_POST['conta_7']);
$conta_8=str_replace('.','',$_POST['conta_8']);
$conta_9=str_replace('.','',$_POST['conta_9']);
$conta_10=str_replace('.','',$_POST['conta_10']);
$conta_11=str_replace('.','',$_POST['conta_11']);
$press_1=str_replace('.','',$_POST['press_1']);
$press_2=str_replace('.','',$_POST['press_2']);
$press_3=str_replace('.','',$_POST['press_3']);
$press_4=str_replace('.','',$_POST['press_4']);
$press_5=str_replace('.','',$_POST['press_5']);
$press_6=str_replace('.','',$_POST['press_6']);
$press_7=str_replace('.','',$_POST['press_7']);
$press_8=str_replace('.','',$_POST['press_8']);
$press_9=str_replace('.','',$_POST['press_9']);
$press_10=str_replace('.','',$_POST['press_10']);
$press_11=str_replace('.','',$_POST['press_11']);
$filas = $_POST['filas']; 
//union de terceros
$terd=split("-",$_POST['tercero']);
$tercero = $terd[1];
$ter = $terd[0];//
// realio el registro presupuestal
$k =0;
$sq2="select id,id_recau from recaudo_riip where id_recau ='$id_recau' ";
$rs2=mysql_query($sq2);
mysql_num_rows($rs2);
while ($rw2=mysql_fetch_array($rs2))
{
	$idv .=$rw2['id'].',';
}
$idv2 = split(",",$idv); 
for ($i=1;$i<=$filas;$i++)
					{	  // recibo variables 
						$cuenta = $_POST['cuenta_'.$i];
						$valor = str_replace('.','',$_POST['valor_'.$i]);
						// consulto nombre del rubro
						$sql = "select * from car_ppto_ing where id_emp ='$id_emp' and cod_pptal ='$cuenta'";
						$resultado = mysql_query($sql, $cx);
						while($row = mysql_fetch_array($resultado)) 
						{
						  $tip_dato=$row["tip_dato"];
						  $definitivo=$row["definitivo"];
						  $nom_rubro = $row["nom_rubro"];
						}
									// grabo los valores del presupuesto
									if ($i < $filas)
									{
										$sq5 = "INSERT  INTO recaudo_riip ( 
										id_emp,
										id_recau,
										fecha_recaudo,
										des_recaudo,
										tercero,
										cuenta,
										nombre,
										vr_digitado,
										id_manu_rcgt,
										ter
				   						) VALUES ( 
										'$id_emp',
										'$id_recau',
										'$fecha_recaudo',
										'$des_recaudo',
										'$tercero',
										'$cuenta',
										'$nom_rubro',
										'$valor',
										'$id_manu_rcgt',
										'$ter'
											)";
										mysql_query($sq5, $cx) or die(mysql_error());
									 }
									 if ($i == $filas)
									 {
									 	$sq6 = "INSERT INTO recaudo_riip ( 
													id_emp,
													id_recau,
													fecha_recaudo,
													des_recaudo,
													tercero,
													cuenta,
													nombre,
													vr_digitado,
													id_manu_rcgt,
													conta_1,
													conta_2,
													conta_3,
													conta_4,
													conta_5,
													conta_6,
													conta_7,
													conta_8,
													conta_9,
													conta_10,
													conta_11,
													press_1,
													press_2,
													press_3,
													press_4,
													press_5,
													press_6,
													press_7,
													press_8,
													press_9,
													press_10,
													press_11,
													ter
												) VALUES ( 
													'$id_emp',
													'$id_recau',
													'$fecha_recaudo',
													'$des_recaudo',
													'$tercero',
													'$cuenta',
													'$nom_rubro',
													'$valor',
													'$id_manu_rcgt',
													'$conta_1',
													'$conta_2',
													'$conta_3',
													'$conta_4',
													'$conta_5',
													'$conta_6',
													'$conta_7',
													'$conta_8',
													'$conta_9',
													'$conta_10',
													'$conta_11',
													'$press_1',
													'$press_2',
													'$press_3',
													'$press_4',
													'$press_5',
													'$press_6',
													'$press_7',
													'$press_8',
													'$press_9',
													'$press_10',
													'$press_11',
													'$ter'
												)";
										mysql_query($sq6, $cx) or die(mysql_error());
									 }
								    	 
							$k++;
					} // end for
// Realizo el registro del movimiento contable
$contador = $_POST['contis'];
for ($i=1;$i<=$contador;$i++)
{
	$id = $_POST["id_".$i];
	$pgcp = $_POST['pgcp'.$i];
	$debito =  str_replace('.','',$_POST['vr_deb_'.$i]);
	$credito =  str_replace('.','',$_POST['vr_cre_'.$i]);
	$cheque = $_POST['cheque'.$i];
	// verificar si el id ya existe en la base de datos 
	$sq = "select id,id_auto from lib_aux2 where id = '$id'";
	$rs = mysql_query($sq,$cx);
	$rw = mysql_fetch_array($rs);
	$fi = mysql_num_rows($rs);
	if ($fi ==0)
	{
	 	// no existe insertar
		  // obtenr el id_auto del cdpp
					$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
		if($pgcp !=0)
		  { 
		   $sql = "INSERT  INTO lib_aux2 ( 
						id_auto,
						id_cons,
						fecha,
						dcto_a,
						dcto,
						ref,
						cuenta,
						cod_pptal,
						nombre,
						detalle,
						tercero,
						ccnit,
						debito,
						credito,
						cheque
				   ) VALUES (    
						'$id_recau',
						'$idc',
						'$fecha_recaudo',
						'',
						'$id_manu_rcgt',
						'',
						'$pgcp',
						'',
						'',
						'$des_recaudo',
						'$tercero',
						'$ter',
						'$debito',
						'$credito',
						'$cheque'
						)";
					mysql_query($sql, $cx) or die(mysql_error());
		  }
	}

}
printf("<br><br><center class ='Estilo4'>REGISTRO INSERTADO CON EXITO</center><br /><br />");
printf("
<center class='Estilo9'>
<form method='post' action='../recaudos_tesoreria/recaudos_tesoreria.php'>
<input type='hidden' name='nn' value='RIIP'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo19' /> :::...
</form>
</center>
");

}
?>
