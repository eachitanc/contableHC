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
$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'lib_aux4'");
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
$id_manu_rcgt = 'NCSF'.$_POST['id_manu_rcgt']; 
$id_recau = 'NCSF'.$consec_recaudo; 
$fecha_recaudo = $_POST['fecha_recaudo'];
$des_recaudo = strtoupper($_POST['des_recaudo']);
$filas = $_POST['filas']; 
//union de terceros
$terd=split("-",$_POST['tercero']);
$tercero = $terd[1];
$ter = $terd[0];//

$k =0;
// Realizo el registro del movimiento contable
$contador = $_POST['contis'];
for ($i=1;$i<=$contador;$i++)
{
	$termov = $_POST["termov_".$i];
	if ($termov !='')
	{
	$sq4 = "select num_id as num_id, nombre  as nombre from z_terceros where num_id =$termov";
	$rs4=mysql_query($sq4);
	$rw4=mysql_fetch_array($rs4);
	$ter = $rw4['num_id'];
	$tercero = $rw4['nombre'];
	}
	//$ter = $terd[0];
	$id = '';//$_POST["id_".$i];
	$pgcp = $_POST['pgcp'.$i];
	$debito =  str_replace(',','',$_POST['vr_deb_'.$i]);
	$credito =  str_replace(',','',$_POST['vr_cre_'.$i]);
	$cheque = $_POST['cheque'.$i];
	// verificar si el id ya existe en la base de datos 
	$sq = "select id,id_auto from lib_aux4 where id = '$id'";
	$rs = mysql_query($sq,$cx);
	$rw = mysql_fetch_array($rs);
	$fi = mysql_num_rows($rs);
	if ($fi ==0)
	{
		// no existe insertar
		  // obtenr el id_auto del cdpp
					$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux4'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
		if($pgcp !=0)
		  { 
		   $sql = "INSERT  INTO lib_aux4 ( 
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
<form method='post' action='../mvto_contable/menu_cont.php'>
<input type='hidden' name='nn' value='NCSF'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo19' /> :::...
</form>
</center>
");

}
?>
