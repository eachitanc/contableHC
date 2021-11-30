<?php
include('../config.php');
$cx =mysql_connect($server,$dbuser,$dbpass) or die ("Fallo en la Conexion a la Base de Datos");

$filas = $_POST['filas'];
$i=0;
for ($i=1;$i<=$filas;$i++)
{
	//llega id obcg como campo de control
		$id_auto_crpp = $_POST['id_'.$i];
		// obtenr el id_auto del ceva
					$sq6= "SHOW TABLE STATUS FROM $database LIKE 'cobp'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$consecutivo = $rw6[Auto_increment];
					}
		//obtener datos del registro desde cobp
		$sql ="select * from crpp where id_auto_crpp = '$id_auto_crpp'";
		$rs1 =mysql_query($sql,$cx);
		$rw1 =mysql_fetch_array($rs1);
		// consulto los datos de la disponibilidad
		$sq2="select consecutivo,cdpp,fecha_reg,des from cdpp where consecutivo ='$rw1[id_auto_cdpp]'";
		$rs2=mysql_query($sq2,$cx);
		$rw2=mysql_fetch_array($rs2);
		// datos para guardar
		$id_emp=2;
		$id_auto_cobp='COBP'.$consecutivo;
		$id_manu_cobp='COBP'.$_POST['num_'.$i];
		$id_auto_cdpp=$rw2['consecutivo'];
		$id_manu_cdpp='CDPP'.$rw2['cdpp'];
		$fecha_cdpp=$rw2['fecha_reg'];
		$id_auto_crpp=$rw1['id_auto_crpp'];
		$id_manu_crpp=$rw1['id_manu_crpp'];
		$fecha_crpp=$rw1['fecha_crpp'];
		// consultas para definir tercero
			$ter_nat =$rw1['ter_nat'];
			$ter_jur =$rw1['ter_jur'];
			if ($ter_nat !='')
			{
				$sq3="select num_id,pri_ape,seg_ape,pri_nom,seg_nom from terceros_naturales where id ='$ter_nat'";
				$rs3=mysql_query($sq3,$cx);
				$rw3=mysql_fetch_array($rs3);
				$tercero=$rw3['pri_ape'].' '.$rw3['seg_ape'].' '.$rw3['pri_nom'].' '.$rw3['seg_nom'];
				$ccnit=$rw3['num_id'];
			}else{
				$sq4="select num_id2,raz_soc2 from terceros_juridicos where id ='$ter_jur'";
				$rs4=mysql_query($sq4,$cx);
				$rw4=mysql_fetch_array($rs3);
				$tercero=$rw4['raz_soc2'];
				$ccnit=$rw4['num_id2'];
			}
		$des_cdpp=$rw2['des'];
		$ref=$_POST['ref'];
		$cuenta=$rw1['cuenta'];
		// consulto en la base el nombre de la cuenta
			$sq5="select nom_rubro from car_ppto_gas where cod_pptal = '$cuenta'";
			$rs5=mysql_query($sq5,$cx);
			$rw5=mysql_fetch_array($rs5);	
		$nom_rubro=$rw5['nom_rubro'];
		$vr_digitado= str_replace(',','', $_POST['valor_'.$i]);
		$situacion='Con Situacion';
		$fecha_cobp=$_POST['fecha_'.$i];
		$des_cobp=$_POST['concep_'.$i];
			if ($_POST['teso_'.$i] =='') $tesoreria='NO' ; 
			if ($_POST['teso_'.$i] =='SI') $tesoreria='SI' ; 
		$t_humano='NO';
		$abc='NO';
		$detalle_crpp=$rw1['detalle_crpp'];
		$contab='NO'; 
		$pagado='NO';
		if ($vr_digitado > 0 )
		{
		$sql = "INSERT INTO cobp ( id_emp,id_auto_cobp,id_manu_cobp,id_auto_cdpp,id_manu_cdpp,fecha_cdpp,id_auto_crpp,id_manu_crpp,fecha_crpp,tercero,ccnit,des_cdpp,ref,cuenta,nom_rubro,vr_digitado,situacion,fecha_cobp,des_cobp,tesoreria,t_humano,abc,detalle_crpp,contab,pagado
			) VALUES ( 
'$id_emp','$id_auto_cobp','$id_manu_cobp','$id_auto_cdpp','$id_manu_cdpp','$fecha_cdpp','$id_auto_crpp','$id_manu_crpp','$fecha_crpp','$tercero','$ccnit','$des_cdpp','$ref','$cuenta','$nom_rubro','$vr_digitado','$situacion','$fecha_cobp','$des_cobp','$tesoreria','$t_humano','$abc','$detalle_crpp','$contab','$pagado'
			)";
$cx->query($sql) or die(mysql_error());
		}
//sacar total de vr_digitado y comparar con total de vr_cobp, si son =0 -> ctrl = si
	// compromisos
	$sq7="select SUM(vr_digitado) AS comp from crpp WHERE  id_auto_crpp = '$id_auto_crpp'";
	$rs7=mysql_query($sq7,$cx);
	$row=mysql_fetch_array($rs7);
	// obligacion
	$sq8="select SUM(vr_digitado) AS cobp from cobp WHERE id_auto_crpp = '$id_auto_crpp'";
	$rs8=mysql_query($sq8,$cx);
	$row2=mysql_fetch_array($rs8);
	if($row['comp'] == $row2['cobp'])
	{
		$sql3 = "update crpp set ctrl='SI' where id_auto_crpp = '$id_auto_crpp'";
		mysql_query($sql3, $cx) or die(mysql_error());
	
	}
$id_emp='';
$id_auto_cobp='';
$id_manu_cobp='';
$id_auto_cdpp='';
$id_manu_cdpp='';
$fecha_cdpp='';
$id_auto_crpp='';
$id_manu_crpp='';
$fecha_crpp='';
$tercero='';
$ccnit='';
$des_cdpp='';
$cuenta='';
$nom_rubro='';
$vr_digitado='';
$situacion='';
$fecha_cobp='';
$des_cobp='';
$tesoreria='';
$t_humano='';
$abc='';
$detalle_crpp='';
$contab='';
$pagado='';
}

?>
<br />
<center>
<table border="0" width="50%">
<tr>
	<td align="center"><a href="imp_lote_cobp.php?ref=<?php echo $ref; ?>" target="_blank"><img src="../simbolos/imprimirblanco.png" border="0" /></a></td>
</tr>
<tr style="color:#03C">
	<td class="Estilo9" align="center">Imprimir Obligaciones</td>
</tr>


</table>
</center>
<br />


<br />
<br />
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
      
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='obligar_lotes.php?<?php echo $ref; ?>' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
        </div>
</div>
