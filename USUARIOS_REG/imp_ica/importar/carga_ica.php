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
$sq10 ="select fecha_ini,fecha_fin from imp_ica";
$re10 =mysql_query($sq10,$cx);
$rw10 =mysql_fetch_array($re10);
// borrar periodo precargado de base de datos para reemplazar  o no duplicar
$sSQL="delete FROM `recaudo_rica2` WHERE id_manu_rcgt like 'RICA%' and (fecha_recaudo between '$rw10[fecha_ini]' and '$rw10[fecha_fin]')";
			mysql_query($sSQL);
			$sSQL2="delete FROM `lib_aux2` WHERE dcto like 'RICA%' and (fecha between '$rw10[fecha_ini]' and '$rw10[fecha_fin]')";
			mysql_query($sSQL2);
// 
$sql = "select distinct cuenta from imp_ica";
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
$debito=0;
$sql = "select distinct no_recibo,ccnit,fecha_recaudo,pri_ape,seg_ape,pri_nom,seg_nom,razon_social,cuenta,ref from imp_ica";
$rsd = mysql_query($sql,$cx);
while($rw= mysql_fetch_array($rsd)) 
{
	// verificar tercero
	$sq3="select num_id from z_terceros where num_id = '$rw[ccnit]'";
	echo "<br>" . $sq3;
	$rs3 = mysql_query($sq3,$cx);
	$fi3 = mysql_num_rows($rs3);
	if ($fi3 >0 ) 
	{
		
	}else{
		$sq4="select razon_social from imp_ica where ccnit = '$rw[ccnit]'";
		$rs4 = mysql_query($sq4,$cx);
		$rw4 = mysql_fetch_array($rs4);
			if ($rw4['razon_social'] =='') 
			{
				$sq5 = "INSERT INTO terceros_naturales ( id_emp , fecha_reg , tipo_id , num_id , clase ,  pri_ape , seg_ape , pri_nom , seg_nom , pais , dpto , mpio,tesoreria ) VALUES ( '2' , '$rw[fecha_recaudo]' , '1' , '$rw[ccnit]' ,  'CONTRIBUYENTE_ICA' ,'$rw[pri_ape]' , '$rw[seg_ape]' , '$rw[pri_nom]' , '$rw[seg_nom]' ,  'Colombia' , 'Narino' , 'Ipiales','SI')";
		      $res5 = mysql_query($sq5, $cx);
			}else{
				// Insertar tercero juridico
				$sq6 = "INSERT INTO terceros_juridicos ( id_emp , fecha_reg , tip_id2 , num_id2 , clase2 ,  raz_soc2 , pais2 , dpto2 , mpio2,tesoreria2 ) VALUES ( '2','$rw[fecha_recaudo]','2','$rw[ccnit]','CONTRIBUYENTE_ICA','$rw[razon_social]', 'Colombia' , 'Narino' , 'Ipiales','SI')";
		$res6 = mysql_query($sq6, $cx);
			}
	}
	// busco nombre tercero
	$vigencia ='';
	$sq7="select nombre from z_terceros where num_id = '$rw[ccnit]'";
	$rs7 = mysql_query($sq7,$cx);
	$fw7 = mysql_fetch_array($rs7);
	$tercero =$fw7['nombre'];
	// consecutivo
	$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'recaudo_rica2'");
	while($array = mysql_fetch_array($resulta)) 
	{
	$consec_recaudo = $array[Auto_increment];
	}
	$sq22 = "select * from imp_ica where no_recibo = '$rw[no_recibo]'";
	$rs22 = mysql_query($sq22,$cx);
	while($rw22= mysql_fetch_array($rs22)) 
	{
		$actividad = substr($rw22['placa'],0,1); 
		if ($rw22['vigencia'] == 'ACTUAL' ) $vigencia ='VAL'; 
		if ($rw22['vigencia'] == 'ANTERIOR' ) $vigencia ='VAN'; 
		if($rw22['codigo'] > 17 and $rw22['codigo'] < 28)  $actividad=0;
		$sq2 ="select * from cca_ica where campo_i ='$rw22[codigo]' and tipo ='$vigencia' and ica ='$actividad'";
		$re2 =mysql_query($sq2,$cx);
		$rw2 =mysql_fetch_array($re2);
		$id =$rw22['codigo'];
		$rubro[$id]=$rw2['cuenta_press'];
		$pgcp[$id]=$rw2['cuenta_conta'];
		$valor[$id]=$rw22['valor'];
		$vigencia ='';
		$sq11 = "select nom_rubro from car_ppto_ing where cod_pptal = '$rw2[cuenta_press]'";
		$re11 =mysql_query($sq11,$cx);
		$rw11 =mysql_fetch_array($re11);

	//insert por cada recibo
	
		// INSERT IMPUESTO LEY 414
	
	if ($rw22['codigo'] == 17)
	{
	$j=1;
	$sp2 = "INSERT INTO recaudo_rica2 (id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,ter) 
	VALUES  
('2','RICA$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw2[cuenta_press]','$rw11[nom_rubro]','$rw22[valor]' ,'RICA$rw[no_recibo]','$rw[ccnit]')";
mysql_query($sp2, $cx) or die(mysql_error());
	}
	
	// INSERT AVISOS Y TABLEROS
	if ($rw22['codigo'] == 18)
	{
	$j=1;
	$sp3 = "INSERT INTO recaudo_rica2 (id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,ter) 
	VALUES  
('2','RICA$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw2[cuenta_press]','$rw11[nom_rubro]','$rw22[valor]','RICA$rw[no_recibo]','$rw[ccnit]')";
mysql_query($sp3, $cx) or die(mysql_error());
	}
	
	// SOBRETASA
	if ($rw22['codigo'] == 19)
	{
	$j=1;
	$sp4 = "INSERT INTO recaudo_rica2 (id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,ter) 
	VALUES  
('2','RICA$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw2[cuenta_press]','$rw11[nom_rubro]','$rw22[valor]','RICA$rw[no_recibo]','$rw[ccnit]')";
mysql_query($sp4, $cx) or die(mysql_error());
	}
	
	// ESTAMPILLA
	if ($rw22['codigo'] == 20)
	{
	$j=1;
	$sp5 = "INSERT INTO recaudo_rica2 (id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,ter) 
	VALUES  
('2','RICA$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw2[cuenta_press]','$rw11[nom_rubro]','$rw22[valor]','RICA$rw[no_recibo]','$rw[ccnit]')";
mysql_query($sp5, $cx) or die(mysql_error());
	}
	
	// CERTIFICASDO
	if ($rw22['codigo'] == 21)
	{
	$j=1;
	$sp6 = "INSERT INTO recaudo_rica2 (id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,ter) 
	VALUES  
('2','RICA$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw2[cuenta_press]','$rw11[nom_rubro]','$rw22[valor]','RICA$rw[no_recibo]','$rw[ccnit]')";
mysql_query($sp6, $cx) or die(mysql_error());
	}
	
	
	// SANCION
	if ($rw22['codigo'] == 22)
	{
	$j=1;
	$sp7 = "INSERT INTO recaudo_rica2 (id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,ter) 
	VALUES  
('2','RICA$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw2[cuenta_press]','$rw11[nom_rubro]','$rw22[valor]','RICA$rw[no_recibo]','$rw[ccnit]')";
mysql_query($sp7, $cx) or die(mysql_error());
	}
	
	// INTERES
	if ($rw22['codigo'] == 24)
	{
	$j=1;
	$sp8 = "INSERT INTO recaudo_rica2 (id_emp,id_recau,fecha_recaudo,des_recaudo,tercero,cuenta,nombre,vr_digitado,id_manu_rcgt,ter) 
	VALUES  
('2','RICA$consec_recaudo','$rw[fecha_recaudo]','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw2[cuenta_press]','$rw11[nom_rubro]','$rw22[valor]','RICA$rw[no_recibo]','$rw[ccnit]')";
mysql_query($sp8, $cx) or die(mysql_error());
	}
	

/******************************************************    CONTABILIDAD *******************************************************************/
// registro de cantabilidad por cada recibo
if($rw22['codigo'] == 17)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=1;
$sc1 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RICA$consec_recaudo','$idc','$rw[fecha_recaudo]','','RICA$rw[no_recibo]','','$rw2[cuenta_conta]','','','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw[ccnit]','0','$rw22[valor]','')";
mysql_query($sc1, $cx) or die(mysql_error());
$debito = $debito + $rw22['valor'];
}
if($rw22['codigo'] == 18)
{
	$conta_2x = $conta_2 + $conta_13;
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=2;
$sc2 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RICA$consec_recaudo','$idc','$rw[fecha_recaudo]','','RICA$rw[no_recibo]','','$rw2[cuenta_conta]','','','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw[ccnit]','0','$rw22[valor]','')";
mysql_query($sc2, $cx) or die(mysql_error());
$debito = $debito + $rw22['valor'];
}
if($rw22['codigo'] == 19)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=3;
$sc3 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RICA$consec_recaudo','$idc','$rw[fecha_recaudo]','','RICA$rw[no_recibo]','','$rw2[cuenta_conta]','','','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw[ccnit]','0','$rw22[valor]','')";
mysql_query($sc3, $cx) or die(mysql_error());
$debito = $debito + $rw22['valor'];
}
if($rw22['codigo'] == 20)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=4;
$sc4 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RICA$consec_recaudo','$idc','$rw[fecha_recaudo]','','RICA$rw[no_recibo]','','$rw2[cuenta_conta]','','','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw[ccnit]','0','$rw22[valor]','')";
mysql_query($sc4, $cx) or die(mysql_error());
$debito = $debito + $rw22['valor'];
}
if($rw22['codigo'] == 21)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=5;
$sc5 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RICA$consec_recaudo','$idc','$rw[fecha_recaudo]','','RICA$rw[no_recibo]','','$rw2[cuenta_conta]','','','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw[ccnit]','0','$rw22[valor]','')";
mysql_query($sc5, $cx) or die(mysql_error());
$debito = $debito + $rw22['valor'];
}
if($rw22['codigo'] == 22)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=6;
$sc6 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RICA$consec_recaudo','$idc','$rw[fecha_recaudo]','','RICA$rw[no_recibo]','','$rw2[cuenta_conta]','','','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw[ccnit]','0','$rw22[valor]','')";
mysql_query($sc6, $cx) or die(mysql_error());
$debito = $debito + $rw22['valor'];
}
if($rw22['codigo'] == 24)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=7;
$sc7 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RICA$consec_recaudo','$idc','$rw[fecha_recaudo]','','RICA$rw[no_recibo]','','$rw2[cuenta_conta]','','','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw[ccnit]','0','$rw22[valor]','')";
mysql_query($sc7, $cx) or die(mysql_error());
$debito = $debito + $rw22['valor'];
}
// registro cuenta de descuentos
if($rw22['codigo'] == 28)
{
	$sq8= "SHOW TABLE STATUS FROM $database LIKE 'lib_aux2'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$idc = $rw8[Auto_increment];
					} 
$k=13;
$descuento = $rw22['valor'] * -1;
$sc13 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RICA$consec_recaudo','$idc','$rw[fecha_recaudo]','','RICA$rw[no_recibo]','','$rw2[cuenta_conta]','','','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw[ccnit]','$descuento','0','')";
	mysql_query($sc13, $cx) or die(mysql_error());
$debito = $debito - $descuento;
}

}// end consulta por cada recibo
	
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
$sc12 = "INSERT  INTO lib_aux2 (id_auto,id_cons,fecha,dcto_a,dcto,ref,cuenta,cod_pptal,nombre,detalle,tercero,ccnit,debito,credito,cheque) VALUES ('RICA$consec_recaudo','$idc','$rw[fecha_recaudo]','','RICA$rw[no_recibo]','','$pgcp_d','','','RECAUDO IMPUESTO INDUSTRIA Y COMERCIO','$tercero','$rw[ccnit]','$debito','0','$rw[ref]')";
mysql_query($sc12, $cx) or die(mysql_error());
}
	
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
	$descuento = 0;
$debito =0;
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
