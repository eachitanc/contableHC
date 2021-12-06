<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
		// verifico permisos del usuario
		include('../config.php');
		$cx = new mysqli($server, $dbuser, $dbpass, $database)or die ("Conexion no Exitosa");
		
       	$sql="SELECT info FROM usuarios2 where login = '$_SESSION[login]'";
		$res=$cx->query($sql);
		$rw =mysql_fetch_array($res);
if ($rw['info']=='SI')
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>


<style type="text/css">
<!--
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo11 {font-weight: bold; color: #FFFFFF; }
-->
</style>
</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>FORMATO CONTRALORIA - CDN11 - RELACION DE PAGOS CUENTAS POR PAGAR </strong></div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
<?php
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   }    
?>	
	<form name="a" method="post" action="f_cdn11_cxp.php">
	  <table width="600" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><b>NOTA</b>: La consulta se hara con base a la <b>Fecha de Inicio</b> y <b>Fecha Final</b> que usted seleccione </div>
    </div></td>
  </tr>
  <tr>
    <td><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><strong>SELECCIONE FECHA DE INICIO </strong></div>
    </div></td>
    <td><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><strong>SELECCIONE FECHA FINAL </strong></div>
    </div></td>
  </tr>
  <tr>
    <td><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <input name="fecha_ini" type="text" class="Estilo4" id="fecha_ini" value="<?php printf($desde); ?>" size="12" />
        <span class="Estilo11">::</span>
        <input name="button" type="button" class="Estilo4" id="button" onclick="displayCalendar(document.a.fecha_ini,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
      </div>
    </div></td>
    <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <input name="fecha_fin" type="text" class="Estilo4" id="fecha_fin" value="<?php printf($ano); ?>" size="12" />
        <span class="Estilo11">::</span>
        <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_fin,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <input name="Submit" type="submit" class="Estilo4" value="Consultar" />
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div class="Estilo5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><strong>INFORMACION ADICIONAL </strong>: <br /><BR />
        1. Recuerde <strong>ACTUALIZAR SUS CUENTAS DE BANCOS</strong> en el PGCP (Opcion 4.2 del menu principal).<br />
2. Si desea exportar a Microsoft Excel &copy; seleccione la tabla, copie y pegue la informacion en la hoja de calculo. </div>
      </div>
    </div></td>
  </tr>
</table>
</form>	</td>
  </tr>
  <tr>
    <td colspan="3" class="Estilo4">
	<?php
	$fecha_ini=$_POST['fecha_ini'];
	$fecha_fin=$_POST['fecha_fin'];	
	printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo10'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	",$fecha_ini,$fecha_fin);
	?></td>
  </tr>
  <tr>
    <td colspan="3">
	
	 <?php
   
printf("
<center>

<table width='2250' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>

<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Cod_Pptal</b></span>
</div>
</td>

<td align='center' width='250'><span class='Estilo4'><b>Rubro(s) Pptal</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CxP Constituida</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Fecha Pago</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Tipo de Pago</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>No Comprob.</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>Beneficiario</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Cedula / NIT</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>Detalle Pago</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Valor</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Desc Seg Social</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Desc Retenciones</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Otros Dctos</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>NETO PAGADO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Codigo SIA Banco</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>No Cuenta</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>No. Dcto / Cheque</b></span></td>

</tr>

");

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cecp where (fecha_cecp between '$fecha_ini' and '$fecha_fin' ) and id_emp = '$id_emp' order by fecha_cecp asc ";
$re = mysql_db_query($database, $sq, $cx);

while($rw = mysql_fetch_array($re)) 
{

		//****cuenta
		printf("
		<span class='Estilo4'>
		<tr>
		<td align='left'><span class='Estilo4'>");
		
		$id_auto_cecp = $rw["id_auto_cecp"];
		$sqlxx2 = "select * FROM cecp where id_auto_cecp = '$id_auto_cecp'";
		$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);
		while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
		{$cuenta=$rowxx2["cuenta_cxp"]; 
		 printf("%s<br>",$cuenta);
		}  
		
		printf("</span></td>");

		//***** nom rubro
		printf("
		<td align='left'><span class='Estilo4'>");
		
		$cuenta_cxp = $rw["cuenta_cxp"];
		$sqlxx2 = "select * FROM cxp where cod_pptal = '$cuenta_cxp'";
		$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);
		while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
		{$nom_rubro=$rowxx2["nom_rubro"]; 
		 printf("%s<br>",$nom_rubro);
		}  
		
		printf("</span></td>");

		//***** definitivo
		printf("
		<td align='right'><span class='Estilo4'>");
		
		$sqlxx2 = "select * FROM cxp where cod_pptal = '$cuenta_cxp'";
		$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);
		while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
		{$definitivo=$rowxx2["definitivo"]; 
		 printf("".number_format($definitivo,2,',','.')."<br>");
		}  
		
		printf("</span></td>");

		//***** fecha de pago
		printf("<td align='center'><span class='Estilo4'>".$rw["fecha_cecp"]."</span></td>");
		//***** tipo de pago
		printf("<td align='center'><span class='Estilo4'>digitar</span></td>");
		//***** No comprobante
		printf("<td align='left'><span class='Estilo4'>".$rw["id_manu_cecp"]."</span></td>");
		//***** beneficiario
		printf("<td align='left'><span class='Estilo4'>".$rw["nt"]."</span></td>");
		//***** cedula/nit
		printf("<td align='left'><span class='Estilo4'>".$rw["cn"]."</span></td>");
		//***** concepto_pago
		printf("<td align='left'><span class='Estilo4'>".$rw["concepto_pago"]."</span></td>");
//***** valor bruto pagado
$bruto = $rw["total_pagado"] + $rw["salud"] + $rw["pension"] + $rw["libranza"] + $rw["f_solidaridad"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["embargo"] + $rw["cruce"] + $rw["otros"] + $rw["vr_retefuente"] + $rw["vr_reteiva"] + $rw["vr_reteica"] + $rw["vr_estampilla1"] + $rw["vr_estampilla2"] + $rw["vr_estampilla3"] + $rw["vr_estampilla4"] + $rw["vr_estampilla5"];
		printf("<td align='right'><span class='Estilo4'>".number_format($bruto,2,',','.')."</span></td>");
		//***** descuentos seguridad social
		$seg_soc = $rw["salud"] + $rw["pension"] + $rw["f_solidaridad"];
		printf("<td align='right'><span class='Estilo4'>".number_format($seg_soc,2,',','.')."</span></td>");
		//***** descuentos retenciones
		$desc_reten = $rw["vr_retefuente"] + $rw["vr_reteiva"];
		printf("<td align='right'><span class='Estilo4'>".number_format($desc_reten,2,',','.')."</span></td>");
//***** descuentos otros
$desc_otros = $rw["libranza"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["embargo"] + $rw["cruce"] + $rw["otros"] + $rw["vr_reteica"] + $rw["vr_estampilla1"] + $rw["vr_estampilla2"] + $rw["vr_estampilla3"] + $rw["vr_estampilla4"] + $rw["vr_estampilla5"];
		printf("<td align='right'><span class='Estilo4'>".number_format($desc_otros,2,',','.')."</span></td>");
		//***** neto pagado
		$neto_pagado = $bruto - $seg_soc - $desc_reten - $desc_otros;
		printf("<td align='right'><span class='Estilo4'>".number_format($neto_pagado,2,',','.')."</span></td>");

//***** codigo SIA del banco

printf("
<td align='center'><span class='Estilo4'>");

$id_auto_cecp = $rw["id_auto_cecp"];
$sqlxx3 = "select * FROM cecp where id_emp='$id_emp' and id_auto_cecp = '$id_auto_cecp'";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);
while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{

$pgcp1 = $rowxx3["pgcp1"];
$pgcp2 = $rowxx3["pgcp2"];
$pgcp3 = $rowxx3["pgcp3"];
$pgcp4 = $rowxx3["pgcp4"];
$pgcp5 = $rowxx3["pgcp5"];
$pgcp5 = $rowxx3["pgcp6"];
$pgcp7 = $rowxx3["pgcp7"];
$pgcp8 = $rowxx3["pgcp8"];
$pgcp9 = $rowxx3["pgcp9"];
$pgcp10 = $rowxx3["pgcp10"];
$pgcp11 = $rowxx3["pgcp11"];
$pgcp12 = $rowxx3["pgcp12"];
$pgcp13 = $rowxx3["pgcp13"];
$pgcp14 = $rowxx3["pgcp14"];
$pgcp15 = $rowxx3["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

if($a == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp1'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco1=$rowxx["nom_banco1"];
					   $num_cta1=$rowxx["num_cta"];
					   $cod_sia1=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia1);
					   }
					
					if(($nom_banco1 == '' and $num_cta1 == '') or $cod_sia1 =='')
					{
					   $nom_banco1="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta1="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia1="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}
					   	
						  
		
		}
		if($b == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp2'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco2=$rowxx["nom_banco1"];
					   $num_cta2=$rowxx["num_cta"];
					   $cod_sia2=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia2);
					   }
					
					if(($nom_banco2 == '' and $num_cta2 == '') or $cod_sia2 =='')
					{
					   $nom_banco2="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta2="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia2="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}				   
		
		
		}
		if($c == '1110')
		{			 
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp3'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco3=$rowxx["nom_banco1"];
					   $num_cta3=$rowxx["num_cta"];
					   $cod_sia3=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia3);
					   }
					
					if(($nom_banco3 == '' and $num_cta3 == '') or $cod_sia3 =='')
					{
					   $nom_banco3="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta3="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia3="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}					   		
		
		}
		if($d == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp4'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco4=$rowxx["nom_banco1"];
					   $num_cta4=$rowxx["num_cta"];
					   $cod_sia4=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia4);
					   }
					
					if(($nom_banco4 == '' and $num_cta4 == '') or $cod_sia4 =='')
					{
					   $nom_banco4="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta4="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia4="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}	
		
		}
		if($e == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp5'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco5=$rowxx["nom_banco1"];
					   $num_cta5=$rowxx["num_cta"];
					   $cod_sia5=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia5);
					   }
					
					if(($nom_banco5 == '' and $num_cta5 == '') or $cod_sia5 =='')
					{
					   $nom_banco5="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta5="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia5="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}					   		
					
		
		}
		if($f == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp6'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco6=$rowxx["nom_banco1"];
					   $num_cta6=$rowxx["num_cta"];
					   $cod_sia6=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia6);
					   }
					
					if(($nom_banco6 == '' and $num_cta6 == '') or $cod_sia6 =='')
					{
					   $nom_banco6="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta6="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia6="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($g == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp7'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco7=$rowxx["nom_banco1"];
					   $num_cta7=$rowxx["num_cta"];
					   $cod_sia7=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia7);
					   }
					
					if(($nom_banco7 == '' and $num_cta7 == '') or $cod_sia7 =='')
					{
					   $nom_banco7="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta7="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia7="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}					   			
					
		
		}
		if($h == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp8'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco8=$rowxx["nom_banco1"];
					   $num_cta8=$rowxx["num_cta"];
					   $cod_sia8=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia8);
					   }
					
					if(($nom_banco8 == '' and $num_cta8 == '') or $cod_sia8 =='')
					{
					   $nom_banco8="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta8="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia8="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($i == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp9'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco9=$rowxx["nom_banco1"];
					   $num_cta9=$rowxx["num_cta"];
					   $cod_sia9=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia9);
					   }
					
					if(($nom_banco9 == '' and $num_cta9 == '') or $cod_sia9 =='')
					{
					   $nom_banco9="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta9="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia9="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   		
					
		
		}
		if($j == '1110')
		{			 
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp10'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco10=$rowxx["nom_banco1"];
					   $num_cta10=$rowxx["num_cta"];
					   $cod_sia10=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia10);
					   }
					
					if(($nom_banco10 == '' and $num_cta10 == '') or $cod_sia10 =='')
					{
					   $nom_banco10="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta10="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia10="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   
							
					
		
		}
		if($k == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp11'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco11=$rowxx["nom_banco1"];
					   $num_cta11=$rowxx["num_cta"];
					   $cod_sia11=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia11);
					   }
					
					if(($nom_banco11 == '' and $num_cta11 == '') or $cod_sia11 =='')
					{
					   $nom_banco11="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta11="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia11="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($l == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp12'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco12=$rowxx["nom_banco1"];
					   $num_cta12=$rowxx["num_cta"];
					   $cod_sia12=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia12);
					   }
					
					if(($nom_banco12 == '' and $num_cta12 == '') or $cod_sia12 =='')
					{
					   $nom_banco12="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta12="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia12="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   		
					
		
		}
		if($m == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp13'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco13=$rowxx["nom_banco1"];
					   $num_cta13=$rowxx["num_cta"];
					   $cod_sia13=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia13);
					   }
					
					if(($nom_banco13 == '' and $num_cta13 == '') or $cod_sia13 =='')
					{
					   $nom_banco13="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta13="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia13="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   	
				
		
		}
		if($n == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp14'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco14=$rowxx["nom_banco1"];
					   $num_cta14=$rowxx["num_cta"];
					   $cod_sia14=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia14);
					   }
					
					if(($nom_banco14 == '' and $num_cta14 == '') or $cod_sia14 =='')
					{
					   $nom_banco14="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta14="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia14="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   	
		 		
		
		}
		if($o == '1110')
		{			
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp15'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco15=$rowxx["nom_banco1"];
					   $num_cta15=$rowxx["num_cta"];
					   $cod_sia15=$rowxx["cod_sia"];
					   printf("%s<br>",$cod_sia15);
					   }
					
					if(($nom_banco15 == '' and $num_cta15 == '') or $cod_sia15 =='')
					{
					   $nom_banco15="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta15="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $cod_sia15="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   	
				
		
		}

} 

printf("</span></td>");
//***** numero de cuenta
printf("
<td align='left'><span class='Estilo4'>");


$sqlxx3b = "select * FROM cecp where id_emp='$id_emp' and id_auto_cecp = '$id_auto_cecp'";
$resultadoxx3b = mysql_db_query($database, $sqlxx3b, $connectionxx);
while($rowxx3b = mysql_fetch_array($resultadoxx3b)) 
{

$pgcp1 = $rowxx3b["pgcp1"];
$pgcp2 = $rowxx3b["pgcp2"];
$pgcp3 = $rowxx3b["pgcp3"];
$pgcp4 = $rowxx3b["pgcp4"];
$pgcp5 = $rowxx3b["pgcp5"];
$pgcp5 = $rowxx3b["pgcp6"];
$pgcp7 = $rowxx3b["pgcp7"];
$pgcp8 = $rowxx3b["pgcp8"];
$pgcp9 = $rowxx3b["pgcp9"];
$pgcp10 = $rowxx3b["pgcp10"];
$pgcp11 = $rowxx3b["pgcp11"];
$pgcp12 = $rowxx3b["pgcp12"];
$pgcp13 = $rowxx3b["pgcp13"];
$pgcp14 = $rowxx3b["pgcp14"];
$pgcp15 = $rowxx3b["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

if($a == '1110')
		{			 /*printf("%s<br>",$cta_cheque);*/ printf("# %s<br>",$num_cta1); 	        }
		if($b == '1110')
		{			 /*printf("%s<br>",$cta_cheque2);*/ printf("# %s<br>",$num_cta2); 	        }
		if($c == '1110')
		{			 /*printf("%s<br>",$cta_cheque3);*/ printf("# %s<br>",$num_cta3); 	        }
		if($d == '1110')
		{			 /*printf("%s<br>",$cta_cheque4);*/ printf("# %s<br>",$num_cta4); 	        }
		if($e == '1110')
		{			 /*printf("%s<br>",$cta_cheque5);*/ printf("# %s<br>",$num_cta5); 	        }
		if($f == '1110')
		{			 /*printf("%s<br>",$cta_cheque6);*/ printf("# %s<br>",$num_cta6); 	        }
		if($g == '1110')
		{			 /*printf("%s<br>",$cta_cheque7);*/ printf("# %s<br>",$num_cta7); 	        }
		if($h == '1110')
		{			 /*printf("%s<br>",$cta_cheque8);*/ printf("# %s<br>",$num_cta8); 	        }
		if($i == '1110')
		{			 /*printf("%s<br>",$cta_cheque9);*/ printf("# %s<br>",$num_cta9); 	        }
		if($j == '1110')
		{			 /*printf("%s<br>",$cta_cheque10);*/ printf("# %s<br>",$num_cta10); 	        }
		if($k == '1110')
		{			 /*printf("%s<br>",$cta_cheque11);*/ printf("# %s<br>",$num_cta11); 	        }
		if($l == '1110')
		{			 /*printf("%s<br>",$cta_cheque12);*/ printf("# %s<br>",$num_cta12); 	        }
		if($m == '1110')
		{			 /*printf("%s<br>",$cta_cheque13);*/ printf("# %s<br>",$num_cta13); 	        }
		if($n == '1110')
		{			 /*printf("%s<br>",$cta_cheque14);*/ printf("# %s<br>",$num_cta14); 	        }
		if($o == '1110')
		{			 /*printf("%s<br>",$cta_cheque15);*/ printf("# %s<br>",$num_cta15); 	        }

} 			 


printf("</span></td>");


//***** numero de cheque
printf("
<td align='left'><span class='Estilo4'>");

$sqlxx3c = "select * FROM cecp where id_emp='$id_emp' and id_auto_cecp = '$id_auto_cecp'";
$resultadoxx3c = mysql_db_query($database, $sqlxx3c, $connectionxx);
while($rowxx3c = mysql_fetch_array($resultadoxx3c)) 
{

$pgcp1 = $rowxx3c["pgcp1"];
$pgcp2 = $rowxx3c["pgcp2"];
$pgcp3 = $rowxx3c["pgcp3"];
$pgcp4 = $rowxx3c["pgcp4"];
$pgcp5 = $rowxx3c["pgcp5"];
$pgcp5 = $rowxx3c["pgcp6"];
$pgcp7 = $rowxx3c["pgcp7"];
$pgcp8 = $rowxx3c["pgcp8"];
$pgcp9 = $rowxx3c["pgcp9"];
$pgcp10 = $rowxx3c["pgcp10"];
$pgcp11 = $rowxx3c["pgcp11"];
$pgcp12 = $rowxx3c["pgcp12"];
$pgcp13 = $rowxx3c["pgcp13"];
$pgcp14 = $rowxx3c["pgcp14"];
$pgcp15 = $rowxx3c["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

		if($a == '1110')
		{			 printf("%s<br>",$rowxx3c["num_cheque"]);	        }
		if($b == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque2"],$rowxx3c["num_cheque"]);		    }
		if($c == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque3"],$rowxx3c["num_cheque"]);			}
		if($d == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque4"],$rowxx3c["num_cheque"]);			}
		if($e == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque5"],$rowxx3c["num_cheque"]);			}
		if($f == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque6"],$rowxx3c["num_cheque"]);			}
		if($g == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque7"],$rowxx3c["num_cheque"]);			}
		if($h == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque8"],$rowxx3c["num_cheque"]);			}
		if($i == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque9"],$rowxx3c["num_cheque"]);			}
		if($j == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque10"],$rowxx3c["num_cheque"]);			}
		if($k == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque11"],$rowxx3c["num_cheque"]);			}
		if($l == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque12"],$rowxx3c["num_cheque"]);			}
		if($m == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque13"],$rowxx3c["num_cheque"]);			}
		if($n == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque14"],$rowxx3c["num_cheque"]);	 		}
		if($o == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque15"],$rowxx3c["num_cheque"]);			}

} 		

printf("</span></td>");	 

}//fin while


printf("</tr></table></center>");
//--------	
?>	</td>
  </tr>
  
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <?php include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
          </strong> </span> <br />
          <span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?php include('../config.php'); echo $nom_emp ?><br />
	    <?php echo $dir_tel ?><BR />
	    <?php echo $muni ?> <br />
	    <?php echo $email?>	</div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>






<?php
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>