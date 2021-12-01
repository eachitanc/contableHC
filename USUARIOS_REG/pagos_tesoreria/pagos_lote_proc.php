<?php
include('../config.php');
$cx =mysql_connect($server,$dbuser,$dbpass) or die ("Fallo en la Conexion a la Base de Datos");

$filas = $_POST['fil'];
$i=0;
for ($i=1;$i<=$filas;$i++)
{
	//llega id obcg como campo de control
		$id_obcg = $_POST['id_'.$i];
		// obtenr el id_auto del ceva
					$sq6= "SHOW TABLE STATUS FROM $database LIKE 'ceva'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$consecutivo = $rw6[Auto_increment];
					}
		//obtener datos del registro desde cobp
		$sql ="select * from obcg where id_auto_obcg = '$id_obcg'";
		$rs1 =mysql_query($sql,$cx);
		$rw1 =mysql_fetch_array($rs1);
		// consulto el valor obligado en cobo
		$sq2="select *  from cobp where id_auto_cobp ='$rw1[id_auto_cobp]'";
		$rs2=mysql_query($sq2,$cx);
		$rw2=mysql_fetch_array($rs2);
		// datos para guardar
		$id_emp='2';
		$fecha_ceva= $_POST['fecha_'.$i];
		$id_auto_ceva ='CEVA'.$consecutivo;
		$id_manu_ceva = 'CEVA'.$_POST['num_'.$i]; 
				// verificar si el numero de ceva ya existe
			include ('../objetos/concec_ceva.php');
			$id_manu_ceva = 'CEVA'.$_POST['id_manu_ceva']; 
			$sq6="select id_manu_ceva from ceva where id_manu_ceva ='$id_manu_ceva'";
			$rs6=mysql_db_query($database,$sq6,$connectionxx);
			$fil =mysql_num_rows($rs6);
			if($fil >0)
			{
				$id_manu_ceva1=consecut($fecha_ceva);
				$id_manu_ceva='CEVA'.$id_manu_ceva1;
			}
		$des_ceva = $_POST['concep_'.$i];
		$id_manu_crpp=$rw2['id_manu_crpp'];
		$id_auto_crpp=$rw2['id_auto_crpp'];
		$fecha_crpp=$rw2['fecha_crpp'];
		$tercero=$_POST['nom_'.$i];
		$ccnit=$_POST['ter_'.$i];
		$pago= 'PAGO TOTAL';
		$id_manu_cobp=$rw2['id_manu_cobp'];
		$id_auto_cobp=$rw2['id_auto_cobp'];
		$fecha_cobp=$rw2['fecha_cobp'];
		$des_cobp=$rw2['des_cobp'];
		$ref=$_POST['ref'];
		$estampilla1='ESTAMPILLA PRO CULTURA';
		$vr_estampilla1=str_replace('.','',$_POST['cult_'.$i]);
		if ($vr_estampilla1=='')
		{
			$estampilla1='';
			$vr_estampilla1='';
		}
		$estampilla2='ADULTO MAYOR';
		$vr_estampilla2= str_replace('.','',$_POST['ancian_'.$i]);
		if ($vr_estampilla2=='')
		{
			$estampilla2='';
			$vr_estampilla2= '';
		}
		$estampilla3='ESTAMPILLA PRO DESARROLLO UDENAR';
		$vr_estampilla3= str_replace('.','',$_POST['udenar_'.$i]);
		if ($vr_estampilla3=='')
		{
			$estampilla3='';
			$vr_estampilla3= '';
		}
		$suma = $vr_estampilla3+$vr_estampilla2+$vr_estampilla1;
		$forma_pago='CHEQUE';
		$total_pagado=str_replace('.','',$_POST['neto_'.$i]);
		$pgcp1=$_POST['deb_'.$i];
		$pgcp2='29109001';
		$pgcp3='29059008';
		$pgcp4='29059006';
		$pgcp5=$_POST['valcre_'.$i];
		$vr_deb_1=str_replace('.','',$_POST['valor_'.$i]);
		$vr_cre_2=str_replace('.','',$_POST['cult_'.$i]);
		$vr_cre_3=str_replace('.','',$_POST['ancian_'.$i]);
		$vr_cre_4=str_replace('.','',$_POST['udenar_'.$i]);
		$vr_cre_5=str_replace('.','',$_POST['neto_'.$i]);
		$tot_deb=str_replace('.','',$_POST['valor_'.$i]);
		$tot_cre=str_replace('.','',$_POST['valor_'.$i]);
		$num_cheque5=$_POST['cheq_'.$i];
		if ($suma ==0)
		{
			$pgcp2=$_POST['valcre_'.$i];
			$pgcp3='';
			$pgcp4='';
			$pgcp5='';
			$vr_deb_1=str_replace('.','',$_POST['valor_'.$i]);
			$vr_cre_2=str_replace('.','',$_POST['valor_'.$i]);
			$vr_cre_3='';
			$vr_cre_4='';
			$vr_cre_5='';
			$tot_deb=str_replace('.','',$_POST['valor_'.$i]);
			$tot_cre=str_replace('.','',$_POST['valor_'.$i]);
			$num_cheque2=$_POST['cheq_'.$i];
			$num_cheque5='';
		}
		
		$estado='nada';
		$id_ncon='nada';
		$aux =$rw1['id_auto_cobp'];
		
		$sqla1 = "update obcg set pagado='SI' where  id_auto_cobp = '$aux'";
		$resultadoa1 = mysql_db_query($database, $sqla1, $cx);
		
		$sqla2 = "update cobp set pagado='SI' where  id_auto_cobp = '$aux'";
		$resultadoa2 = mysql_db_query($database, $sqla2, $cx);
		
		
		$sql = "INSERT INTO ceva ( id_emp,fecha_ceva,id_auto_ceva,id_manu_ceva,des_ceva,id_manu_crpp,id_auto_crpp,fecha_crpp,tercero,ccnit,pago,id_manu_cobp,id_auto_cobp,fecha_cobp,des_cobp,ref,estampilla1,vr_estampilla1,estampilla2,vr_estampilla2,estampilla3,vr_estampilla3,forma_pago,total_pagado,pgcp1,pgcp2,pgcp3,pgcp4,pgcp5,vr_deb_1,vr_cre_2,vr_cre_3,vr_cre_4,vr_cre_5,tot_deb,tot_cre,num_cheque5,num_cheque2,estado,id_ncon
			) VALUES ( 
			'$id_emp','$fecha_ceva','$id_auto_ceva','$id_manu_ceva','$des_ceva','$id_manu_crpp','$id_auto_crpp','$fecha_crpp','$tercero','$ccnit','$pago','$id_manu_cobp','$id_auto_cobp','$fecha_cobp','$des_cobp','$ref','$estampilla1','$vr_estampilla1','$estampilla2','$vr_estampilla2','$estampilla3','$vr_estampilla3','$forma_pago','$total_pagado','$pgcp1','$pgcp2','$pgcp3','$pgcp4','$pgcp5','$vr_deb_1','$vr_cre_2','$vr_cre_3','$vr_cre_4','$vr_cre_5','$tot_deb','$tot_cre','$num_cheque5','$num_cheque2','$estado','$id_ncon'

			)";
mysql_query($sql, $cx) or die(mysql_error());
// para cuentas por pagar 
		// obtenr el id_auto del ceva
					$sq6= "SHOW TABLE STATUS FROM $database LIKE 'cecp'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$consec = $rw6[Auto_increment];
					$nume =$consec - 1;
					}
					$sq7="select max(id_manu_cecp) as num from cecp";
					$rs7=mysql_query($sq7,$cx);
					$rw7=mysql_fetch_array($rs7);
					$resultado = substr($rw7['num'],4,20);
		$id_emp='2';
		$id_auto_cecp='CECP'.$consec;
		$id_manu_cecp= 'CECP' .($resultado+1);
		$fecha_cecp=$_POST['fecha_'.$i];
		$nt=$_POST['nom_'.$i];
		$rt='SIMPLIFICADO';
		$cn=$_POST['ter_'.$i];
		$concepto_pago=$_POST['concep_'.$i];
		$vr_obli_para_pago_mas_iva=str_replace('.','',$_POST['cxp_'.$i]);
		$forma_pago='CHEQUE';
		$total_pagado=str_replace('.','',$_POST['cxp_'.$i]);
		$pgcp1=$_POST['deb_'.$i];
		$pgcp2=$_POST['valcre_'.$i];
		$vr_deb_1=str_replace('.','',$_POST['cxp_'.$i]);
		$vr_cre_2=str_replace('.','',$_POST['cxp_'.$i]);
		$num_cheque2=$_POST['cheq_'.$i];
		$cuenta = $_POST['valcuenta_'.$i];
		$sq8 = "INSERT INTO cecp ( 				id_emp,id_auto_cecp,id_manu_cecp,fecha_cecp,nt,rt,cn,concepto_pago,vr_obli_para_pago_mas_iva,forma_pago,total_pagado,pgcp1,pgcp2,vr_deb_1,vr_cre_2,num_cheque2,ref
		) VALUES ( 		'$id_emp','$id_auto_cecp','$id_manu_cecp','$fecha_cecp','$nt','$rt','$cn','$concepto_pago','$vr_obli_para_pago_mas_iva','$forma_pago','$total_pagado','$pgcp1','$pgcp2','$vr_deb_1','$vr_cre_2','$num_cheque2','$ref'
	)";
mysql_query($sq8, $cx) or die(mysql_error());	
$sq9 = "INSERT INTO cecp_cuenta (id_auto_cecp,id_manu_cecp,cuenta,valor,id_origen,fecha_cecp
		) VALUES ('$id_auto_cecp','$id_manu_cecp','$cuenta','$total_pagado','0','$fecha_cecp'
	)";
mysql_query($sq9, $cx) or die(mysql_error());

$num_cheque2='';
$num_cheque5='';
}


?>
<br />
<center>
<table border="0" width="50%">
<tr>
	<td align="center"><a href="imp_lote.php?ref=<?php echo $ref; ?>" target="_blank"><img src="../simbolos/imprimirblanco.png" border="0" /></a></td>
</tr>
<tr style="color:#03C">
	<td class="Estilo9" align="center">Imprimir Comprobantes</td>
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
            <div align="center"><a href='pagos_tesoreria.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
        </div>
</div>