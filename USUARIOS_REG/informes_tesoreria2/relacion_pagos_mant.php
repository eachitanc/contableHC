<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
	include('../config.php');
					// verifico permisos del usuario
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT teso FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['teso']=='SI')
{


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=RELACION_DE_PAGOS_MANTENIMIENTO.xls");
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
$sxx = "select * from fecha";
$rxx = mysql_db_query($database, $sxx, $cx);
while($rowxxx = mysql_fetch_array($rxx)) 
   {
   $ano=$rowxxx["ano"];
   }
$anno  = split("/",$ano);
$vigencia = $anno[0];
$fecha_ini=$_POST['fecha_ini'];
$fecha_fin=$_POST['fecha_fin'];
$rubro = $_POST['cod_ini'];
$mes = 13;

$periodo = array ("","ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE","ANUAL");
for ($i=1;$i<=13;$i++)
{
	if ($mes == $i) $per = $periodo[$i];
}
$cont =0;
printf("
<center>
<table BORDER='1' class='bordepunteado1'>
<tr>
<td  bgcolor='#DCE9E5' align='center'>No</td>
<td  bgcolor='#DCE9E5' align='center'>Fecha CDP</td>
<td  bgcolor='#DCE9E5' align='center'>No CDP</td>
<td  bgcolor='#DCE9E5' align='center'>No RP</td>
<td  bgcolor='#DCE9E5' align='center'>No Comprobante</td>
<td  bgcolor='#DCE9E5' align='center'>Detalle De Pago</td>
<td  bgcolor='#DCE9E5' align='center'>Valor Pago</td>
<td  bgcolor='#DCE9E5' align='center'>No Contrato</td>
</tr>
");
$sq = "SELECT * from ceva where fecha_ceva BETWEEN '$fecha_ini' AND '$fecha_fin' order  by fecha_ceva asc";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re))
{
		$cont++;
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
		$sq3 = "SELECT sum(vr_digitado) as pag_cobp from cobp  where (id_auto_cobp ='$rw[id_auto_cobp]' or ceva ='$rw[id_auto_ceva]') ";
		$re3 = mysql_db_query($database, $sq3, $cx);	
		$rw3 = mysql_fetch_array($re3);
		$valor = $rw3["pag_cobp"];
		$neto = round($valor - $seg_soc - $reten - $otros_des,2);
		$sq1 = "SELECT sum(vr_digitado) as pag,cuenta,id_manu_crpp,id_manu_cdpp from cobp where (id_auto_cobp='$rw[id_auto_cobp]' or ceva ='$rw[id_auto_ceva]') group by cuenta,id_manu_crpp,id_manu_cdpp";
		$re1 = mysql_db_query($database, $sq1, $cx);
		$rubros =mysql_num_rows($re1);
		$sq4 = "SELECT clas_contrato,num_contrato from contrataciones2 where id_auto_crpp ='$rw[id_auto_crpp]'";
		$re4 = mysql_db_query($database, $sq4, $cx);	
		$rw4 = mysql_fetch_array($re4);
		$clase = $rw4["clas_contrato"];
		$sq7 = "select id_manu_cdpp,vr_digitado,id_auto_cdpp,n_contrato from crpp where id_auto_crpp ='$rw[id_auto_crpp]'";
		$re7 = mysql_db_query($database, $sq7, $cx);
		$rw7 = mysql_fetch_array($re7);
		// Consulta fecha de CDP
		$sq8 ="select fecha_reg from cdpp where consecutivo ='$rw7[id_auto_cdpp]'";
		$re8 =mysql_db_query($database,$sq8,$cx);
		$rw8 =mysql_fetch_array($re8);
		if ($clase =='MENOR CUANT�A') $clase=' C12';
		if ($clase =='DESIERTO LICITACI�N') $clase=' C12';
		if ($clase =='ENAJENACI�N BIENES') $clase='C12';
		if ($clase =='SERVICIOS DE SALUD') $clase='C12';
		if ($clase =='PRODUCTOS DE ORIGEN Y DESTINACI�N AGROPECUARIA') $clase='C12';
		if ($clase =='PROGRAMAS DE REINSERCION') $clase='C12';
		if ($clase =='BIENES Y SERVICIOS PARA LA DEFENSA Y SEGURIDAD') $clase='C12';
		if ($clase =='URGENCIA MANIFIESTA') $clase='C12';
		if ($clase =='EMPR�STITOS') $clase='C11';
		if ($clase =='CONTRATOS INTERADMINISTRATIVOS') $clase='C10';
		if ($clase =='CONTRATACI�N DE BIENES Y SERVICIOS EN EL SECTOR DEFENSA Y DAS CON RESERVA') $clase='C12';
		if ($clase =='ACTIVIDADES CIENT�FICAS Y TECNOL�GICAS') $clase='C12';
		if ($clase =='�NICO OFERENTE') $clase='C12';
		if ($clase =='PRESTACI�N DE SERVICIOS PROFESIONALES') $clase='C1';
		if ($clase =='DE APOYO A LA GESTI�N Y ART�STICOS') $clase='C12';
		if ($clase =='ARRENDAMIENTO O ADQUISICI�N DE INMUEBLES') $clase='C8';
		if ($clase =='CONVENIO INTERADMINISTRATIVO') $clase='C10';
		if ($clase =='CONVENIO DE ASOCIACI�N CON PARTICULARES') $clase='C12';
		if ($clase =='CONTRATOS DE APOYO CON PARTICULARESC�DIGOS CIVIL Y COMERCIO') $clase='C12';
		if ($clase =='CONTRATOS DE OBRA') $clase='C4';
		if ($clase =='CONSULTOR�A') $clase='C2';
		if ($clase =='SERVICIOS DE TRANSPORTE') $clase='C12';
		if ($clase =='SERVICIOS DE INTERMEDIACI�N PARA PROVEER TALENTO HUMANO') $clase='C12';
		if ($clase =='SUMINISTROS') $clase='C5';
		if ($clase =='DESARROLLO DE PROYECTOS CULTURALES') $clase='C12';
		if ($clase =='CONCESIONES') $clase='C6';
		if ($clase =='CONTRATO DE FIDUCIA O ENCARGO FIDUCIARIO') $clase='C12';
		if ($clase =='EMPRESTITO (DEUDA P�BLICA)') $clase='C11';
		if ($clase =='CORRETAJE O INTERMEDIACI�N DE SEGUROS') $clase='C9';
		if ($clase =='COMPRAVENTA (BIENES INMUEBLES)') $clase='C12';
		if ($clase =='ARRENDAMIENTO DE BIENES INMUEBLES') $clase='C8';
		if ($clase =='MANDATO') $clase='C12';
		if ($clase =='CONTRATOS CON ORGANISMOS MULTILATERALES') $clase='C12';
		if ($clase =='PRESTACI�N DE SERVICIOS') $clase='C1';
		if ($clase =='INTERVENTOR�A') $clase='C1';
		if ($clase =='MANTENIMIENTO Y/O REPARACI�N') $clase='C1';
		if ($clase =='OBRA P�BLICA') $clase='C4';
		if ($clase =='COMODATO') $clase='C7';
		if ($clase =='PRESTAMO O MUTUO') $clase='C11';
		if ($clase =='P�BLICIDAD') $clase='C1';
		if ($clase =='DEPOSITOS') $clase='C12';
		if ($clase =='PRESTACION DE SERVICIOS DE SALUD') $clase='C1';
		if ($clase =='OTROS') $clase='C12';
		if ($rubros == 1)
		{
		 $rw1 = mysql_fetch_array($re1);
					$sq5 = "SELECT  clase_pago_sia,cod_sia,nom_rubro,opc1  from car_ppto_gas where cod_pptal ='$rw1[cuenta]'";
					$re5 = mysql_db_query($database, $sq5, $cx);	
					$rw5 = mysql_fetch_array($re5);
		 if ($clase =='')
				{
					$clase = $rw5["clase_pago_sia"];
				}
		$saldo = $rw7['vr_digitado'] - $valor;
		 	   	if ($rw5['opc1'] =='MANTENIMIENTO')
				{
				printf("
				<tr>
				<td align='left'>%s</td>
				<td align='left' class='text'>%s</td>
				<td align='left'>%s</td>
				<td align='center'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				</tr>",$cont,$rw1['id_manu_cdpp'],$rw8['fecha_reg'],$rw1['id_manu_crpp'],$rw["id_manu_ceva"],ucfirst(ereg_replace("[,;]", "",$rw["des_cobp"])),$valor,$rw7['n_contrato']);
				}
		$banco ='';
		$cunta_ban='';
		$cheque='';
				}else{
				$p_seg_soc =$seg_soc/$valor;
				$p_reten = $reten/$valor;
				$p_otros_des =$otros_des/$valor;
				while($rw1 = mysql_fetch_array($re1))
					{
							
						if ($rw1["pag"] >0)
						{
							$cuenta =$rw1["cuenta"];
							$sq6 = "SELECT  clase_pago_sia,cod_sia,nom_rubro,opc1  from car_ppto_gas where cod_pptal ='$cuenta'";
							$re6 = mysql_db_query($database, $sq6, $cx);	
							$rw6 = mysql_fetch_array($re6);
							
							if ($clase =='')
							{
								$clase = $rw6["clase_pago_sia"];
							}
							$seg_soc2 = round($rw1["pag"] * $p_seg_soc,2);
							$reten2 = round($rw1["pag"] * $p_reten,2);
							$otros_des2 = round($rw1["pag"] * $p_otros_des,2);
							$neto2 = round($rw1["pag"] - $seg_soc2 - $reten2 - $otros_des2,2); 
							if ($rw6['opc1'] =='MANTENIMIENTO')
							{
							printf("
								<tr>
								<td align='left'>%s</td>
								<td align='left' class='text'>%s</td>
								<td align='left'>%s</td>
								<td align='center'>%s</td>
								<td align='left'>%s</td>
								<td align='left'>%s</td>
								<td align='right'>%s</td>
								<td align='right'>%s</td>
								</tr>",$cont,$rw1['id_manu_cdpp'],$rw8['fecha_reg'],$rw1['id_manu_crpp'],$rw["id_manu_ceva"],ucfirst(ereg_replace("[,;]", "",$rw["des_cobp"])),$rw1["pag"],$rw7['n_contrato']);
		}
		$banco ='';
		$cunta_ban='';
		$cheque='';
							}	
					}
					
				} // end else rubros mayor a 1
	$saldo =0;			
} // end while
printf("</table></center>");
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
} // end sesion
?>
</body>
</html>
		