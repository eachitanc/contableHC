<script>
// JavaScript Document
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function cambiaColor(id){
	
    document.getElementById(id).style.backgroundColor='#FFFF00';
	}
function cambiaColor2(id){
	
    document.getElementById(id).style.backgroundColor='#ffffff';
	}


	//donde se mostrará el formulario con los datos
	/*var doc = document.getElementById('id_cobp').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST","user/censo/datos_gen/consultas/documento.php",false);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			alert (doc);
			$( "#dialog" ).dialog({
			autoOpen: false,
			height: 1200,
			width: 800,
			modal: true
			});
			$( "#"+doc ).click(function() {
			$( "#dialog" ).dialog( "open" );
			return false;
			});

			var res = ajax.responseText;
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("doc="+doc); */
</script>
</head>
<?php
$id = $_GET['id'];
include ('../../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

$sq = "select * from crpp where id ='$id'";
$rs = mysql_query($sq,$cx);
$rw = mysql_fetch_array($rs);
$id_auto_cdpp = $rw['id_auto_cdpp'];
$sq2 = "select * from cdpp where consecutivo = '$id_auto_cdpp'";
$rs2 = mysql_query($sq2,$cx);
$rw2 = mysql_fetch_array($rs2);
?>
<body>
<form name="form2" id="form2">
<center>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='0'> 
    <tr  bgcolor='#F4F4F4'>
    	<td width='92%' align='left'>HISTORIAL DEL DOCUMENTO</td>
        <td width='8%' align="right" ><b><font color="#003399" style="cursor:pointer" ><a href="conten.php">X&nbsp;</a></font></b></td>
    </tr>
</table>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='0'> 
    <tr bgcolor="#B4B4B4">
    	<td width='92%' align='left'>CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL</td>
        <td width='8%' align="right" ></td>
    </tr>
</table>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='0'> 
    <tr>
    	<td width='15%' align='left'>N&uacute;mero :</td>
        <td width='85%' align="left" ><?php echo "CDPP".$rw2['cdpp']; ?></td>
    </tr>
    <tr>
    	<td  align='left'>Fecha :</td>
        <td  align="left" ><?php echo $rw2['fecha_reg']; ?></td>
    </tr>
    <tr>
   		<td  align='left'>Detalle :</td>
        <td  align="left" ><?php echo $rw2['des']; ?></td>
    </tr>
</table>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='1'> 
    <tr bgcolor="#DCE9E5">
    	<td width='10%' align='left'>C&oacute;digo </td>
        <td width='30%' align='left'>Detalle</td>
        <td width='12%' align='center'>Valor Inicial</td>
        <td width='12%' align="center" >Valor Reversado</td>
        <td width='12%' align="center" >Valor CDP </td>
        <td width='12%' align="center" >Saldo x Comprometer</td>
        <td width='12%' align="center" >Reversar saldo</td>
    </tr>
<?php
$sq3 = "select * from cdpp where consecutivo = '$id_auto_cdpp' order by cuenta asc";
$rs3 = mysql_query($sq3,$cx);
while ($rw3 = mysql_fetch_array ($rs3))
{
	// Busco el nombre del codigo presupuestal
	$sq4 = "select nom_rubro from car_ppto_gas where cod_pptal ='$rw3[cuenta]'";
	$rs4 = mysql_query($sq4,$cx);
	$rw4 = mysql_fetch_array($rs4);
	$nom_rubro = ucfirst($rw4['nom_rubro']);
	$valor = number_format($rw3['valor'],2,'.',',');
	// Varfico si el cdp tiene reversiones de saldo para mostar en pantalla
	$sq5 = "select sum(valor) as valor from cdpp where consecutivo = '$id_auto_cdpp' and cuenta = '$rw3[cuenta]' and liq1='SI'";
	$rs5 = mysql_query($sq5,$cx);
	$rw5 = mysql_fetch_array($rs5);
	$valor_rev = number_format($rw5['valor'],2,'.',',');
	$saldo_fin = number_format($rw3['valor'] + $rw5['valor'],2,'.',',');
	// Consultar el valor registrado por cada cuenta para calcular si tiene saldo por liquidar
	$sq6 = "select sum(vr_digitado) from crpp where id_auto_cdpp = '$id_auto_cdpp' and cuenta = '$rw3[cuenta]'";
	$rs6 = mysql_query($sq6,$cx);
	$rw6 = mysql_fetch_array($rs6);
	$valor_crpp = $rw6['sum(vr_digitado)'];
	$saldo_x_comp = ($rw3['valor'] + $rw5['valor']) - $valor_crpp;
	$saldo_x_compf = number_format($saldo_x_comp,2,'.',',');
	// mostrar boton para liquidar si valor mayor a cero
	if ($saldo_x_comp > 0)  $btn_liquidar ="<td  align='center' bgcolor='#8AC5FF' style='cursor:pointer'><font color='#FFFFFF'>liquidar</font></td>"; else $btn_liquidar ="<td  align='right' >&nbsp;</td>";
	// Genero el reporte del cdp
	if ($valor > 0)
	{
	echo"<tr>
    	<td  align='left'>$rw3[cuenta]</td>
        <td  align='left'>$nom_rubro</td>
        <td  align='right'>$valor</td>
        <td  align='right'>$valor_rev</td>
        <td  align='right' >$saldo_fin</td>
		<td  align='right' >$saldo_x_compf</td>
		$btn_liquidar
    	</tr>";
	$total_cdp =$total_cdp + $rw3['valor'];
	$total_cdpp = number_format($total_cdp,2,'.',',');
	$total_rev = $total_rev + $rw5['valor'];
	$total_revf = number_format($total_rev,2,'.',',');
	$saldo_cdp = $total_cdp + $total_rev;
	$saldo_cdpf = number_format($saldo_cdp,2,'.',',');
	$saldo_x_comp_fin =  $saldo_x_comp_fin + $saldo_x_comp;
	$saldo_x_comp_finf = number_format($saldo_x_comp_fin,2,'.',',');
	}
}
// Total Disponibilidad
echo"<tr bgcolor='#F3F3F3'>
    	<td align='left' colspan='2'>Total</td>
        <td align='right'><b>$total_cdpp</b></td>
        <td align='right'><b>$total_revf</b></td>
        <td align='right'><b>$saldo_cdpf</b></td>
		<td align='right'><b>$saldo_x_comp_finf</b></td>
		<td align='right'>&nbsp;</td>
  	</tr>";

?>
</table>    
<!-- *********************************************** DATOS DEL CERTIFICADO DE REGISTRO PRESUPUESTAL *************************** -->
<br />
<br />
<?php
// Datos del tercero
$ter_nat = $rw['ter_nat']; 
$ter_jur = $rw['ter_jur']; 
$sq7 = "select * from terceros_naturales where id = '$ter_nat'";
$rs7 = mysql_query($sq7,$cx);
$fi7 = mysql_num_rows($rs7); 
if ($fi7 >0)
{
	$rw7 = mysql_fetch_array($rs7);
	$cc_nit = $rw7['num_id']; 
	$nombre = $rw7['pri_ape']." ".$rw7['seg_ape']." ".$rw7['pri_nom']." ".$rw7['seg_nom'];	
}else{
	$sq7 = "select * from terceros_juridicos where id = '$ter_jur'";
	$rs7 = mysql_query($sq7,$cx);
	$rw7 = mysql_fetch_array($rs7);
	$cc_nit = $rw7['num_id2'];  
	$nombre = $rw7['raz_soc2'];	

}
?>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='0'> 
    <tr bgcolor="#B4B4B4">
    	<td width='92%' align='left'>CERTIFICADO DE REGISTRO PRESUPUESTAL</td>
        <td width='8%' align="right" ></td>
    </tr>
</table>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='0'> 
    <tr>
    	<td width='20%' align='left'>N&uacute;mero :</td>
        <td width='80%' align="left" ><?php echo $rw['id_manu_crpp']; ?></td>
    </tr>
    <tr>
    	<td width='20%' align='left'>Fecha :</td>
        <td width='80%' align="left" ><?php echo $rw['fecha_crpp']; ?></td>
    </tr>
    <tr>
    	<td width='20%' align='left'>Tercero :</td>
        <td width='80%' align="left" ><?php echo $nombre; ?></td>
    </tr>
    <tr>
    	<td width='20%' align='left'>CC/NIT :</td>
        <td width='80%' align="left" ><?php echo $cc_nit; ?></td>
    </tr>

    <tr>
   	<td width='20%' align='left'>Detalle :</td>
        <td width='80%' align="left" ><?php echo $rw['detalle_crpp']; ?></td>
    </tr>
</table>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='1'> 
    <tr bgcolor="#DCE9E5">
    	<td width='10%' align='left'>C&oacute;digo </td>
        <td width='30%' align='left'>Detalle </td>
        <td width='12%' align='center'>Valor Inicial</td>
        <td width='12%' align="center" >Valor Reversado</td>
        <td width='12%' align="center" >Valor CRPP </td>
        <td width='12%' align="center" >Saldo x Obligar</td>
        <td width='12%' align="center" >Reversar saldo</td>
    </tr>
<?php
$sq8 = "select * from crpp where id_auto_crpp = '$rw[id_auto_crpp]' and liq1 !='SI' order by cuenta asc";
$rs8 = mysql_query($sq8,$cx);
while ($rw8 = mysql_fetch_array ($rs8))
{
	// Busco el nombre del codigo presupuestal
	$sq9 = "select nom_rubro from car_ppto_gas where cod_pptal ='$rw8[cuenta]'";
	$rs9 = mysql_query($sq9,$cx);
	$rw9 = mysql_fetch_array($rs9);
	$nom_rubro_crpp = ucfirst($rw9['nom_rubro']);
	$valor_crp = number_format($rw8['vr_digitado'],2,'.',',');
 	// Varfico si el crpp tiene reversiones de saldo para mostar en pantalla
	$sq10 = "select vr_digitado from crpp where  id_auto_crpp = '$rw[id_auto_crpp]' and cuenta = '$rw8[cuenta]' and liq1='SI'";
	$rs10 = mysql_query($sq10,$cx);
	$rw10 = mysql_fetch_array($rs10);
	$valor_crpp_rev = number_format($rw10['vr_digitado'],2,'.',',');
	$saldo_crpp_fin = number_format($rw8['vr_digitado'] + $rw10['vr_digitado'],2,'.',',');
	// Consultar el valor registrado por cada cuenta para calcular si tiene saldo por liquidar
	$sq11 = "select sum(vr_digitado) from cobp where id_auto_crpp = '$rw[id_auto_crpp]' and cuenta = '$rw8[cuenta]'";
	$rs11 = mysql_query($sq11,$cx);
	$rw11 = mysql_fetch_array($rs11);
	$valor_cobp = $rw11['sum(vr_digitado)'];
	$saldo_x_obl = ($rw8['vr_digitado'] + $rw10['vr_digitado']) - $valor_cobp;
	$saldo_x_compf = number_format($saldo_x_obl,2,'.',',');
	// mostrar boton para liquidar si valor mayor a cero
	if ($saldo_x_obl > 0)  $btn_liquidar_crpp ="<td  align='center' bgcolor='#8AC5FF' style='cursor:pointer'><font color='#FFFFFF'>liquidar</font></td>"; else $btn_liquidar_crpp ="<td  align='right' >&nbsp;</td>";
	// genero el repoprte
		echo"<tr>
    	<td  align='left'>$rw8[cuenta]</td>
        <td  align='left'>$nom_rubro_crpp</td>
        <td  align='right'>$valor_crp</td>
        <td  align='right'>$valor_crpp_rev</td>
		<td  align='right'>$saldo_crpp_fin</td>
		<td  align='right'>$saldo_x_compf</td>
		$btn_liquidar_crpp
    	</tr>";
	$total_crp = $total_crp + $rw8['vr_digitado'] ;
	$total_crpf = number_format($total_crp,2,'.',',');
	$total_crpp_rev = $total_crpp_rev + $rw10['vr_digitado'];
	$total_crpp_revf = number_format($total_crpp_rev,2,'.',',');
	$saldo_crpp = $total_crp + $total_crpp_rev;
	$saldo_crppf = number_format($saldo_crpp,2,'.',',');
	$total_x_obl = $total_x_obl + $saldo_x_obl;
	$total_x_oblf = number_format($total_x_obl,2,'.',',');
}
// Total Disponibilidad
echo"<tr bgcolor='#F3F3F3'>
    	<td align='left' colspan='2'>Total</td>
        <td align='right'><b>$total_crpf</b></td>
        <td align='right'><b>$total_crpp_revf</b></td>
        <td align='right'><b>$saldo_crppf</b></td>
		<td align='right'><b>$total_x_oblf</b></td>
		<td align='right'>&nbsp;</td>
  	</tr>";

?>
</table>
<!-- *********************************************** DATOS DE OBLIGACION PRESUPUESTAL *************************** -->
<br />
<br />
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='0'> 
    <tr bgcolor="#B4B4B4">
    	<td width='92%' align='left'>CERTIFICADOS DE OBLIGACION PRESUPUESTAL</td>
        <td width='8%' align="right" ></td>
    </tr>
</table>
<table width='90%'   class='punteado'  cellpadding='3' cellspacing='0' border='1'> 
    <tr bgcolor="#DCE9E5">
        <td width='10%' align='left'>Fecha </td>
        <td width='10%' align="center" >No COBP</td>
        <td width='38%' align='left'>Detalle </td>
        <td width='10%' align='center'>Valor Obligado</td>
        <td width='10%' align="center" >Contabilidad </td>
        <td width='10%' align="center" >Valor pagado</td>
        <td width='10%' align="center" >Cuentas x pagar</td>
    </tr>

<?php
$sq9 = "select sum(vr_digitado) as valor_cobp,fecha_cobp,id_manu_cobp,des_cobp,id_auto_cobp,tesoreria,ceva,vr_digitado from cobp where id_auto_crpp = '$rw[id_auto_crpp]' and vr_digitado > 0 group by id_manu_cobp,fecha_cobp order by fecha_cobp asc, id_manu_cobp asc";
$rs9 = mysql_query($sq9,$cx);
$cont =0;
while ($rw9 = mysql_fetch_array ($rs9))
{
		
		// Formatos
		$valor_cobp2 = number_format($rw9['valor_cobp'],2,'.',',');
		// consulto el valor contabilizado si la obligacion no fue enviada directo a tesorerìa
		if ($rw9['tesoreria'] == 'SI')
		{
			$total_deb ='Directo';
			$suma_total_debf = '0.00';
		}else{
			$sq12 ="select tot_deb from obcg where id_auto_cobp = '$rw9[id_auto_cobp]'";
			$rs12 = mysql_query($sq12,$cx);
			$rw12 = mysql_fetch_array($rs12);
			$total_deb = number_format($rw12['tot_deb'],2,'.',',');
			$suma_total_deb = $suma_total_deb + $rw12['tot_deb'];
			$suma_total_debf = number_format($suma_total_deb,2,'.',',');
		}
		// Consulto el valor pagado de cada obligaciòn
			$sq13= "select * from ceva where id_auto_cobp ='$rw9[id_auto_cobp]' or id_auto_ceva ='$rw9[ceva]'";
			$re13= mysql_query($sq13, $cx);
			$rw13 = mysql_fetch_array($re13);
			$fl13 = mysql_num_rows($re13);
			if ($fl13 >0)
				{
					$pagos = $rw9['valor_cobp']; 
					$valor_pagado = number_format($pagos,2,'.',',');
				}else{
					$valor_pagado ='0.00';
				}
		// Cálculo  el valor de la cuenta por pagar
		$cxp =  $rw9['valor_cobp'] - $pagos;
		$cxpf = number_format($cxp,2,'.',',');
		// formularios para llamado de ajax
		echo "<input name='id_cobp' id='id_cobp' value='$rw9[id_auto_cobp]' type='hidden' />";
		// Muestro la tabla del reporte
		?> <tr id='<? echo $rw9[id_auto_cobp]; ?>' onmousemove='cambiaColor(id)' onmouseout='cambiaColor2(id)' style='cursor:pointer;' onclick="VerCobp('generator/table2/formulario.php','vert');">
      <?
	  echo"
		<td  align='left'>$rw9[fecha_cobp]</td>
        <td  align='left'>$rw9[id_manu_cobp]</td>
        <td  align='left'>$rw9[des_cobp]</td>
        <td  align='right'>$valor_cobp2</td>
		<td  align='right'>$total_deb</td>
		<td  align='right'>$valor_pagado</td>
		<td  align='right'>$cxpf</td>
    	</tr>";
		// Valores acumulados
		$total_valor_cobp2 = $total_valor_cobp2 + $rw9['valor_cobp'];
		$total_valor_cobp2f = number_format($total_valor_cobp2,2,'.',',');
		$suma_valor_pagado = $suma_valor_pagado + $pagos;
		$suma_valor_pagadof = number_format($suma_valor_pagado,2,'.',',');
		$suma_cxp += $cxp;
		$suma_cxpf = number_format($suma_cxp,2,'.',',');
		$id_cobp = $rw9['id_auto_cobp'];
		$cxp=0;$pagos=0;
		$cont++;
}
echo "<input name='n_cobp' id='n_cobp' type='hidden' value='$cont' />";
// totales obligacion
// Total Disponibilidad
echo"<tr bgcolor='#F3F3F3'>
    	<td align='left' colspan='2'>Total</td>
        <td align='right'><b>&nbsp;</b></td>
        <td align='right'><b>$total_valor_cobp2f</b></td>
        <td align='right'><b>$suma_total_debf</b></td>
		<td align='right'><b>$suma_valor_pagadof</b></td>
		<td align='right'><b>$suma_cxpf</b></td>
  	</tr>";
?>
</table>
</form>
<!-- *********************************************** DETALLO EL COBP SELECCIONADO *************************** -->

