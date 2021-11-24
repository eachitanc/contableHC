<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=RADICADOR_CHEQUES.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style>
.text
  {
 mso-number-format:"\@"
  }
.date
	{
	mso-number-format:"yyyy\/mm\/dd"	
	}
.numero
	{
	mso-number-format:"0"	
	}
</style>
</head>
<body>
<?
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// llegan las variables
$fecha_ini=$_POST['fecha_ini'];
$fecha_fin=$_POST['fecha_fin'];
$mes = $_GET['mes'];
$periodo = array ("","ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE","ANUAL");
for ($i=1;$i<=13;$i++)
{
	if ($mes == $i) $per = $periodo[$i];
}

printf("
<center>
<table BORDER='1' class='bordepunteado1'>
<tr>
<td  bgcolor='#DCE9E5' align='center'>Fecha</td>
<td  bgcolor='#DCE9E5' align='center'>Banco</td>
<td  bgcolor='#DCE9E5' align='center'>Cheque</td>
<td  bgcolor='#DCE9E5' align='center'>Comprobante</td>
<td  bgcolor='#DCE9E5' align='center'>Detalle De Pago</td>
<td  bgcolor='#DCE9E5' align='center'>Beneficiario</td>
<td  bgcolor='#DCE9E5' align='center'>Neto Pagado</td>
<td  bgcolor='#DCE9E5' align='center'>Cedula</td>
<td  bgcolor='#DCE9E5' align='center'>Firma</td>
</tr>
");
$sq = "SELECT * from ceva where fecha_ceva BETWEEN '$fecha_ini' AND '$fecha_fin' order  by fecha_ceva asc";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re))
{
		$seg_soc=$rw["salud"]+$rw["pension"];
		$reten = $rw["vr_retefuente"] + $rw["vr_reteiva"] + $rw["vr_reteica"]; 
		$otros_des = $rw["libranza"] + $rw["f_solidaridad"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["cruce"] + $rw["embargo"] + $rw["otros"] +  $rw["vr_estampilla1"] + $rw["vr_estampilla2"] + $rw["vr_estampilla3"] + $rw["vr_estampilla4"] + $rw["vr_estampilla5"]; 
		//$valor = $neto + $otros_des + $reten + $seg_soc;  
		$i=0;
		for ($i=1;$i<=15;$i++)
		 {
			 $cod_conta = $rw['pgcp'.$i];
			 $cod_conta2 = substr($cod_conta,0,4); 
			 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
			 {
				$sq2 = "SELECT cod_sia,num_cta,fuentes_recursos from pgcp where cod_pptal ='$cod_conta'";
				$re2 = mysql_db_query($database, $sq2, $cx);	
				$rw2 = mysql_fetch_array($re2);
				if ($i =='1')
				{$j='';}else{$j=$i;}
				$banco = $rw2["cod_sia"];
				$fuente = $rw2["fuentes_recursos"];
				$cunta_ban = $rw2["num_cta"];		
				$cheque = $rw['num_cheque'.$j];
					if ($cheque =='')
					{
						$k=0;
						for ($k=1;$k<=15;$k++)
						{
							if ($k =='1')
							{$g='';}else{$g=$k;}
							$doc = $rw["num_cheque".$g];
							if ($doc !='')
							{
								$cheque =$doc;
							}
						}	
					}
			 }else{
			 $cod_conta ='';
			 }
		}  
		$sq7 ="select banco from bancos_sia where cod = '$banco'"; 
		$rs7 =mysql_db_query($database,$sq7,$cx);
		$rw7 =mysql_fetch_array($rs7);
		$banco = $rw7['banco'];
		$sq3 = "SELECT sum(vr_digitado) as pag_cobp from cobp  where (id_auto_cobp ='$rw[id_auto_cobp]' or ceva ='$rw[id_auto_ceva]') ";
		$re3 = mysql_db_query($database, $sq3, $cx);	
		$rw3 = mysql_fetch_array($re3);
		$valor = $rw3["pag_cobp"];
		$neto = round($valor - $seg_soc - $reten - $otros_des,2);
		$sq1 = "SELECT sum(vr_digitado) as pag,cuenta from cobp where (id_auto_cobp='$rw[id_auto_cobp]' or ceva ='$rw[id_auto_ceva]') group by cuenta";
		$re1 = mysql_db_query($database, $sq1, $cx);
		$rubros =mysql_num_rows($re1);
		
		$rubros=1;
		if ($rubros == 1)
		{
		 $rw1 = mysql_fetch_array($re1);
					$sq5 = "SELECT  clase_pago_sia,cod_sia  from car_ppto_gas where cod_pptal ='$rw1[cuenta]'";
					$re5 = mysql_db_query($database, $sq5, $cx);	
					$rw5 = mysql_fetch_array($re5);
		if ($rw5["cod_sia"] =='S' ||  $rw5["cod_sia"] =='E' || $rw5["cod_sia"] =='V' || $rw5["cod_sia"] =='' || $rw5["cod_sia"] =='T') $color = 'bgcolor=red';
		 if ($clase =='')
				{
					$clase = $rw5["clase_pago_sia"];
				}
		 	   	printf("
				<tr $color>
				<td align='center' class='date'>%s</td>
				<td align='left'>%s</td>
				<td align='left' class='text'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='right'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				
				</tr>",$rw["fecha_ceva"],$banco,$cheque,$rw["id_manu_ceva"],ucfirst(ereg_replace("[,;]", "",$rw["des_ceva"])),$rw["tercero"],number_format($neto,2,'.',','),'&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         ');
				$color='';
		}else{
				$p_seg_soc =$seg_soc/$valor;
				$p_reten = $reten/$valor;
				$p_otros_des =$otros_des/$valor;
				while($rw1 = mysql_fetch_array($re1))
					{
							
						if ($rw1["pag"] >0)
						{
							$cuenta =$rw1["cuenta"];
							$sq6 = "SELECT  clase_pago_sia,cod_sia  from car_ppto_gas where cod_pptal ='$cuenta'";
							$re6 = mysql_db_query($database, $sq6, $cx);	
							$rw6 = mysql_fetch_array($re6);
							if ($rw6["cod_sia"] =='S' ||  $rw6["cod_sia"] =='E' || $rw6["cod_sia"] =='V' || $rw6["cod_sia"] =='' || $rw6["cod_sia"] =='T') $color = 'bgcolor=yellow';

							if ($clase =='')
							{
								$clase = $rw6["clase_pago_sia"];
							}
							$seg_soc2 = round($rw1["pag"] * $p_seg_soc,2);
							$reten2 = round($rw1["pag"] * $p_reten,2);
							$otros_des2 = round($rw1["pag"] * $p_otros_des,2);
							$neto2 = round($rw1["pag"] - $seg_soc2 - $reten2 - $otros_des2,2); 
							printf("
								<tr $color>
								<td align='left' class='date'>%s</td>
								<td align='center'>%s</td>
								<td align='left' class='text'>%s</td>
								<td align='center'>%s</td>
								<td align='center'>%s</td>
								<td align='center'>%s</td>
								<td align='left'>%s</td>
								<td align='left'>%s</td>
								<td align='left'>%s</td>
								<td align='right'>%s</td>
								<td align='right'>%s</td>	
								<td align='right'>%s</td>
								<td align='right'>%s</td>
								<td align='right'>%s</td>
								<td align='center'>%s</td>
								<td align='center'>%s</td>
								<td align='center'>%s</td>
								<td align='center' bgcolor='#999999'>%s</td>
								</tr>",$rw["fecha_ceva"],$per,$rw6["cod_sia"].$rw1["cuenta"],$clase,$fuente,$rw["id_manu_ceva"],$rw["tercero"],$rw["ccnit"],ucfirst(ereg_replace("[,;]", "",$rw["des_ceva"])),$rw1["pag"],$seg_soc2,$reten2,$otros_des2,$neto2,$banco,$cunta_ban,$cheque,$rw['id_manu_crpp']);
							$color='';}	
					}
					
				} // end else rubros mayor a 1
				
} // end while
$neto=0;
$sq = "SELECT * from cecp where fecha_cecp BETWEEN '$fecha_ini' AND '$fecha_fin' order  by fecha_cecp asc";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re))
{
		$seg_soc=$rw["salud"]+$rw["pension"];
		$reten = $rw["vr_retefuente"] + $rw["vr_reteiva"] + $rw["vr_reteica"]; 
		$otros_des = $rw["libranza"] + $rw["f_solidaridad"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["cruce"] + $rw["embargo"] + $rw["otros"] +  $rw["vr_estampilla1"] + $rw["vr_estampilla2"] + $rw["vr_estampilla3"] + $rw["vr_estampilla4"] + $rw["vr_estampilla5"]; 
		//$valor = $neto + $otros_des + $reten + $seg_soc;  
		$i=0;
		for ($i=1;$i<=15;$i++)
		 {
			 $cod_conta = $rw['pgcp'.$i];
			 $cod_conta2 = substr($cod_conta,0,4); 
			 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
			 {
				$sq2 = "SELECT cod_sia,num_cta,fuentes_recursos from pgcp where cod_pptal ='$cod_conta'";
				$re2 = mysql_db_query($database, $sq2, $cx);	
				$rw2 = mysql_fetch_array($re2);
				if ($i =='1')
				{$j='';}else{$j=$i;}
				$banco = $rw2["cod_sia"];
				$fuente = $rw2["fuentes_recursos"];
				$cunta_ban = $rw2["num_cta"];		
				$cheque = $rw['num_cheque'.$j];
					if ($cheque =='')
					{
						$k=0;
						for ($k=1;$k<=15;$k++)
						{
							if ($k =='1')
							{$g='';}else{$g=$k;}
							$doc = $rw["num_cheque".$g];
							if ($doc !='')
							{
								$cheque =$doc;
							}
						}	
					}
			 }else{
			 $cod_conta ='';
			 }
		}  
		$sq7 ="select banco from bancos_sia where cod = '$banco'"; 
		$rs7 =mysql_db_query($database,$sq7,$cx);
		$rw7 =mysql_fetch_array($rs7);
		$banco = $rw7['banco'];
		$sq3 = "SELECT sum(vr_digitado) as pag_cobp from cobp  where (id_auto_cobp ='$rw[id_auto_cobp]' or ceva ='$rw[id_auto_ceva]') ";
		$re3 = mysql_db_query($database, $sq3, $cx);	
		$rw3 = mysql_fetch_array($re3);
		$valor = $rw3["total_pagado"];
		$neto = round($rw["total_pagado"],2);
		$sq1 = "SELECT sum(vr_digitado) as pag,cuenta from cobp where (id_auto_cobp='$rw[id_auto_cobp]' or ceva ='$rw[id_auto_ceva]') group by cuenta";
		$re1 = mysql_db_query($database, $sq1, $cx);
		$rubros =mysql_num_rows($re1);
		
		$rubros=1;
		if ($rubros == 1)
		{
		 $rw1 = mysql_fetch_array($re1);
					$sq5 = "SELECT  clase_pago_sia,cod_sia  from car_ppto_gas where cod_pptal ='$rw1[cuenta]'";
					$re5 = mysql_db_query($database, $sq5, $cx);	
					$rw5 = mysql_fetch_array($re5);
		if ($rw5["cod_sia"] =='S' ||  $rw5["cod_sia"] =='E' || $rw5["cod_sia"] =='V' || $rw5["cod_sia"] =='' || $rw5["cod_sia"] =='T') $color = 'bgcolor=red';
		 if ($clase =='')
				{
					$clase = $rw5["clase_pago_sia"];
				}
		 	if($neto > 0)
			{
			   	printf("
				<tr $color>
				<td align='center' class='date'>%s</td>
				<td align='left'>%s</td>
				<td align='left' class='text'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='right'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				
				</tr>",$rw["fecha_cecp"],$banco,$cheque,$rw["id_manu_cecp"],ucfirst(ereg_replace("[,;]", "",$rw["concepto_pago"])),$rw["nt"],number_format($neto,2,'.',','),'&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         ');
				$color='';
				$neto=0;
			}
		}	
}
printf("</table></center>");
} // end sesion
?>
</body>
</html>
		