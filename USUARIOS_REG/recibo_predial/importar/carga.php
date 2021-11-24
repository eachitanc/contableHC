<?php
set_time_limit(3600);
include('../../config.php');
?>
<style type="text/css">
<!--
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<?php
$cx = new mysqli($server, $dbuser, $dbpass, $database);

// verifica las cuentas bancarias
$sq10 ="select fecha_ini,fecha_fin from imp_predial";
$re10 =mysql_query($sq10,$cx);
$rw10 =mysql_fetch_array($re10);
// borrar periodo precargado de base de datos para reemplazar  o no duplicar
$sSQL="delete FROM `recaudo_riip` WHERE (id_manu_rcgt like 'IPU%' or id_manu_rcgt like 'RC%') and (fecha_recaudo between '$rw10[fecha_ini]' and '$rw10[fecha_fin]')";
			mysql_query($sSQL);
			$sSQL2="delete FROM `lib_aux2` WHERE (dcto like 'IPU%' or dcto like 'RC%') and (fecha between '$rw10[fecha_ini]' and '$rw10[fecha_fin]')";
			mysql_query($sSQL2);
// continua
$sql = "select distinct cuenta from imp_predial";
$rsd = mysql_query($sql,$cx);
while($rw= mysql_fetch_array($rsd)) 
{
	$sq9 ="select * from ctas where cta = '$rw[cuenta]'";
	$rs9 = mysql_query($sq9,$cx);
	$fi9 = mysql_num_rows($rs9);
	if ($fi9 == 1) 
		{
		$error .='';
		}else{
			 $error .=$rw['cuenta'];
			 echo "Error cta bancaria $error<br>";
		}
}
if ($error == '')
{
// consultar codigo presupuestal y contable por cada cuenta
$i=0;
for ($i=1;$i<14;$i++)
{
	$sqx = "select cuenta_press, cuenta_conta from cca_predial where id ='$i'";
	$rsx = mysql_query($sqx,$cx);
	$rwx = mysql_fetch_array($rsx);
	$cuenta[$i]=$rwx['cuenta_press'];
	$sqy = "select nom_rubro from car_ppto_ing where cod_pptal ='$cuenta[$i]'";
	$rsy = mysql_query($sqy,$cx);
	$rwy = mysql_fetch_array($rsy);
	$rubro[$i]=$rwy['nom_rubro'];
	$pgcp[$i]=$rwx['cuenta_conta'];
}
$sql = "select distinct no_recibo,ccnit,fecha_recaudo,pri_ape,seg_ape,pri_nom,seg_nom,razon_social,cuenta,ref from imp_predial";
$rsd = mysql_query($sql,$cx);
while($rw= mysql_fetch_array($rsd)) 
{
	$vr_pred_ant = 0;
	$vr_pred_act =0; 
	$vr_corp_ant=0;
	$vr_corp_act=0;
	$vr_int_pred=0;
	$vr_int_stact=0;
	$vr_int_stant=0;
	$vr_bomberos=0;
	$debito=0;
	
	// volver a consultar para procesar por recibo
	$sq2 = "select * from imp_predial where no_recibo = '$rw[no_recibo]'";
	$rs2 = mysql_query($sq2,$cx);
	while($rw2= mysql_fetch_array($rs2)) 
	{
	/********************  REGISTRO PRESUPUESTAL *******************/
		// predial unificado vigencia anterior
		if ($rw2['codigo'] == 1 || $rw2['codigo'] == 8)
		{
		$vr_pred_ant = $vr_pred_ant+$rw2['valor'];
		}
		// predial unificado vigencia actual
		if ($rw2['codigo'] == 2 || $rw2['codigo'] == 9)
		{
		$vr_pred_act = $vr_pred_act+$rw2['valor'];
		}
		// Corponariño anterior
		if ($rw2['codigo'] == 3 )
		{
		$vr_corp_ant = $vr_corp_ant+$rw2['valor'];
		}
		// Corponariño anterior
		if ($rw2['codigo'] == 4 )
		{
		$vr_corp_act = $vr_corp_act+$rw2['valor'];
		}
		// Interes predial
		if ($rw2['codigo'] == 7 )
		{
		$vr_int_pred = $vr_int_pred+$rw2['valor'];
		}
	   // Interes sobretasa actual
		if ($rw2['codigo'] == 6 )
		{
		$vr_int_stact = $vr_int_stact+$rw2['valor'];
		}
		// Interes sobretasa anterior
		if ($rw2['codigo'] == 5 )
		{
		$vr_int_stant = $vr_int_stant+$rw2['valor'];
		}
		// Bomberos actual
		if ($rw2['codigo'] == 10 || $rw2['codigo'] == 11)
		{
		$vr_bomberos = $vr_bomberos+$rw2['valor'];
		}
		// valores para contabilidad
		if ($rw2['codigo'] == 1) $conta_1 =$rw2['valor'];
		if ($rw2['codigo'] == 2) $conta_2 =$rw2['valor'];
		if ($rw2['codigo'] == 3) $conta_3 =$rw2['valor'];
		if ($rw2['codigo'] == 4) $conta_4 =$rw2['valor'];
		if ($rw2['codigo'] == 5) $conta_5 =$rw2['valor'];
		if ($rw2['codigo'] == 6) $conta_6 =$rw2['valor'];
		if ($rw2['codigo'] == 7) $conta_7 =$rw2['valor'];
		if ($rw2['codigo'] == 8) $conta_8 =$rw2['valor'];
		if ($rw2['codigo'] == 9) $conta_9 =$rw2['valor'];
		if ($rw2['codigo'] == 10) $conta_10 =$rw2['valor'];
		if ($rw2['codigo'] == 11) $conta_11 =$rw2['valor'];
		if ($rw2['codigo'] == 13) $conta_13 =$rw2['valor'];
		//Valores para presupuesto
		$press_1 =$vr_pred_ant;
		$press_2 =$vr_pred_act;
		$press_3 =$vr_corp_ant;
		$press_4 =$vr_corp_act;
		$press_5 =$vr_int_stant;
		$press_6 =$vr_int_stact;
		$press_7 =$vr_int_pred;
		$press_8 =0;
		$press_9 =0;
		$press_10 =0;
		$press_11 =$vr_bomberos;
		
	}
	// verificar tercero
	
	$sq3="select num_id from z_terceros where num_id = '$rw[ccnit]'";
	$rs3 = mysql_query($sq3,$cx);
	$fi3 = mysql_num_rows($rs3);
	if ($fi3 >0 ) 
	{
		
	}else{
		$sq4="select razon_social from imp_predial where ccnit = '$rw[ccnit]'";
		$rs4 = mysql_query($sq4,$cx);
		$rw4 = mysql_fetch_array($rs4);
			if ($rw4['razon_social'] =='') 
			{
				$sq5 = "INSERT INTO terceros_naturales ( id_emp , fecha_reg , tipo_id , num_id , clase ,  pri_ape , seg_ape , pri_nom , seg_nom , pais , dpto , mpio,tesoreria ) VALUES ( '2' , '$rw[fecha_recaudo]' , '1' , '$rw[ccnit]' ,  'CONTRIBUYENTE' ,'$rw[pri_ape]' , '$rw[seg_ape]' , '$rw[pri_nom]' , '$rw[seg_nom]' ,  'Colombia' , 'Narino' , 'Ipiales','SI')";
		      $res5 = mysql_query($sq5, $cx);
			}else{
				// Insertar tercero juridico
				$sq6 = "INSERT INTO terceros_juridicos ( id_emp , fecha_reg , tip_id2 , num_id2 , clase2 ,  raz_soc2 , pais2 , dpto2 , mpio2,tesoreria2 ) VALUES ( '2','$rw[fecha_recaudo]','2','$rw[ccnit]','CONTRIBUYENTE','$rw[razon_social]', 'Colombia' , 'Narino' , 'Ipiales','SI')";
		$res6 = mysql_query($sq6, $cx);
			}
	}
	// busco nombre tercero
	$sq7="select nombre from z_terceros where num_id = '$rw[ccnit]'";
	$rs7 = mysql_query($sq7,$cx);
	$fw7 = mysql_fetch_array($rs7);
	$tercero =$fw7['nombre'];
	//insert por cada recibo
	$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'recaudo_riip'");
	while($array = mysql_fetch_array($resulta)) 
	{
	$consec_recaudo = $array[Auto_increment];
	}
	// INSERT 1 predial vigencia anterior

	if ($vr_pred_ant >0)
	{
	$j=1;
	$sp1 = "INSERT INTO recaudo_riip 			(id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,conta_1,conta_2,conta_3,conta_4,conta_5,conta_6,conta_7,conta_8,conta_9,conta_10,conta_11,press_1,press_2,press_3,press_4,press_5,press_6,press_7,press_8,press_9,press_10,press_11,ter) 
	VALUES  
('2','RIIP$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO PREDIAL','$tercero','$cuenta[$j]','$rubro[$j]','$vr_pred_ant ','IPU$rw[no_recibo]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',	'$rw[ccnit]')";
mysql_query($sp1, $cx) or die(mysql_error());
	}
	
	// INSERT 2 predial vigencia actual
	if ($vr_pred_act >0)
	{
	$j=2;
	$sp2 = "INSERT INTO recaudo_riip 			(id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,conta_1,conta_2,conta_3,conta_4,conta_5,conta_6,conta_7,conta_8,conta_9,conta_10,conta_11,press_1,press_2,press_3,press_4,press_5,press_6,press_7,press_8,press_9,press_10,press_11,ter) 
	VALUES  
('2','RIIP$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO PREDIAL','$tercero','$cuenta[$j]','$rubro[$j]','$vr_pred_act ','IPU$rw[no_recibo]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',	'$rw[ccnit]')";
mysql_query($sp2, $cx) or die(mysql_error());
	}
	
	// INSERT 3 Corponariño anterior
	if ($vr_corp_ant >0)
	{
	$j=3;
	$sp3 = "INSERT INTO recaudo_riip 			(id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,conta_1,conta_2,conta_3,conta_4,conta_5,conta_6,conta_7,conta_8,conta_9,conta_10,conta_11,press_1,press_2,press_3,press_4,press_5,press_6,press_7,press_8,press_9,press_10,press_11,ter) 
	VALUES  
('2','RIIP$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO PREDIAL','$tercero','$cuenta[$j]','$rubro[$j]','$vr_corp_ant ','IPU$rw[no_recibo]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',	'$rw[ccnit]')";
mysql_query($sp3, $cx) or die(mysql_error());
	}
	
	// INSERT 4 Corponariño actual
	if ($vr_corp_act >0)
	{
	$j=4;
	$sp4 = "INSERT INTO recaudo_riip 			(id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,conta_1,conta_2,conta_3,conta_4,conta_5,conta_6,conta_7,conta_8,conta_9,conta_10,conta_11,press_1,press_2,press_3,press_4,press_5,press_6,press_7,press_8,press_9,press_10,press_11,ter) 
	VALUES  
('2','RIIP$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO PREDIAL','$tercero','$cuenta[$j]','$rubro[$j]','$vr_corp_act ','IPU$rw[no_recibo]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',	'$rw[ccnit]')";
mysql_query($sp4, $cx) or die(mysql_error());
	}
	
	// INSERT 5 Interes sobretasa anterior
	if ($vr_int_stant >0)
	{
	$j=5;
	$sp5 = "INSERT INTO recaudo_riip 			(id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,conta_1,conta_2,conta_3,conta_4,conta_5,conta_6,conta_7,conta_8,conta_9,conta_10,conta_11,press_1,press_2,press_3,press_4,press_5,press_6,press_7,press_8,press_9,press_10,press_11,ter) 
	VALUES  
('2','RIIP$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO PREDIAL','$tercero','$cuenta[$j]','$rubro[$j]','$vr_int_stant ','IPU$rw[no_recibo]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',	'$rw[ccnit]')";
mysql_query($sp5, $cx) or die(mysql_error());
	}
	
	// INSERT 6 Interes sobretasa actual
	if ($vr_int_stact >0)
	{
	$j=6;
	$sp6 = "INSERT INTO recaudo_riip 			(id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,conta_1,conta_2,conta_3,conta_4,conta_5,conta_6,conta_7,conta_8,conta_9,conta_10,conta_11,press_1,press_2,press_3,press_4,press_5,press_6,press_7,press_8,press_9,press_10,press_11,ter) 
	VALUES  
('2','RIIP$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO PREDIAL','$tercero','$cuenta[$j]','$rubro[$j]','$vr_int_stact ','IPU$rw[no_recibo]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',	'$rw[ccnit]')";
mysql_query($sp6, $cx) or die(mysql_error());
	}
	
	// INSERT 7 Interes 
	if ($vr_int_pred >0)
	{
	$j=7;
	$sp7 = "INSERT INTO recaudo_riip 			(id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,conta_1,conta_2,conta_3,conta_4,conta_5,conta_6,conta_7,conta_8,conta_9,conta_10,conta_11,press_1,press_2,press_3,press_4,press_5,press_6,press_7,press_8,press_9,press_10,press_11,ter) 
	VALUES  
('2','RIIP$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO PREDIAL','$tercero','$cuenta[$j]','$rubro[$j]','$vr_int_pred ','IPU$rw[no_recibo]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',	'$rw[ccnit]')";
mysql_query($sp7, $cx) or die(mysql_error());
	}
	
	
// INSERT 8 bomberos
	$j=11;
	$sp8 = "INSERT INTO recaudo_riip 			(id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,conta_1,conta_2,conta_3,conta_4,conta_5,conta_6,conta_7,conta_8,conta_9,conta_10,conta_11,press_1,press_2,press_3,press_4,press_5,press_6,press_7,press_8,press_9,press_10,press_11,ter) 
	VALUES  
('2','RIIP$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO PREDIAL','$tercero','$cuenta[$j]','$rubro[$j]','$vr_bomberos','IPU$rw[no_recibo]','$conta_1','$conta_2','$conta_3','$conta_4','$conta_5','$conta_6','$conta_7','$conta_8','$conta_9','$conta_10','$conta_11','$press_1','$press_2','$press_3','$press_4','$press_5','$press_6','$press_7','$press_8','$press_9','$press_10','$press_11',	'$rw[ccnit]')";
mysql_query($sp8, $cx) or die(mysql_error());
$conta_2x=0;
/******************************************************    CONTABILIDAD *******************************************************************/
// registro de cantabilidad por cada recibo
if($conta_1 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=1;
$sc1 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_1','')";
mysql_query($sc1, $cx) or die(mysql_error());
$debito = $debito + $conta_1;
}
if($conta_2 >0)
{
	$conta_2x = $conta_2 + $conta_13;
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=2;
$sc2 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_2x','')";
mysql_query($sc2, $cx) or die(mysql_error());
$debito = $debito + $conta_2;
}
if($conta_3 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=3;
$sc3 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_3','')";
mysql_query($sc3, $cx) or die(mysql_error());
$debito = $debito + $conta_3;
}
if($conta_4 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=4;
$sc4 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_4','')";
mysql_query($sc4, $cx) or die(mysql_error());
$debito = $debito + $conta_4;
}
if($conta_5 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=5;
$sc5 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_5','')";
mysql_query($sc5, $cx) or die(mysql_error());
$debito = $debito + $conta_5;
}
if($conta_6 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=6;
$sc6 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_6','')";
mysql_query($sc6, $cx) or die(mysql_error());
$debito = $debito + $conta_6;
}
if($conta_7 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=7;
$sc7 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_7','')";
mysql_query($sc7, $cx) or die(mysql_error());
$debito = $debito + $conta_7;
}
if($conta_8 >0)
{

	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=8;
$sc8 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_8','')";
mysql_query($sc8, $cx) or die(mysql_error());
$debito = $debito + $conta_8;
}
if($conta_9 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=9;
$sc9 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_9','')";
mysql_query($sc9, $cx) or die(mysql_error());
$debito = $debito + $conta_9;
}
if($conta_10 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=10;
$sc10 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_10','')";
mysql_query($sc10, $cx) or die(mysql_error());
$debito = $debito + $conta_10;
}
if($conta_11 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=11;
$sc11 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','0','$conta_11','')";
mysql_query($sc11, $cx) or die(mysql_error());
$debito = $debito + $conta_11;
}
// registro cuenta de descuentos
if($conta_13 >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=13;
	if ($conta_2x > 0)
	{
	$sc13 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp[$k]','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','$conta_13','0','')";
	mysql_query($sc13, $cx) or die(mysql_error());
	}
}
// registro cuenta de bancos
$sq9 ="select * from ctas where cta = '$rw[cuenta]'";
	$rs9 = mysql_query($sq9,$cx);
	$rw9 = mysql_fetch_array($rs9);
	$pgcp_d=$rw9['codigo'];
if($debito >0)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$sc12 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RIIP$consec_recaudo','$idc','$rw[fecha_recaudo]','','IPU$rw[no_recibo]','','$pgcp_d','','','RECAUDO IMPUESTO PREDIAL','$tercero','$rw[ccnit]','$debito','0','$rw[ref]')";
mysql_query($sc12, $cx) or die(mysql_error());


}// end consulta por cada recibo
	$conta_1 = 0;
	$conta_2 = 0;
	$conta_3 = 0;
	$conta_4 = 0;
	$conta_5 = 0;
	$conta_6 = 0;
	$conta_7 = 0;
	$conta_8 = 0;
	$conta_9 = 0;
	$conta_10 = 0;
	$conta_11 = 0;
	$conta_12 = 0;
	$conta_13 = 0;
$conta_2x =0;
}

echo "<br>";
echo "<br>";
echo "<center>";
echo "<img src='../../simbolos/ok.png' />";
echo "<br>Proceso realizado con exito...";
echo "<br>";
?>
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../../recaudos_tesoreria/recaudos_tesoreria.php?a=RIIP&nn=RIIP' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
<?php

echo "</center>";
}else{
	echo "Error";	
}

?>
