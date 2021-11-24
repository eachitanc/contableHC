<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
    .suggestionsBox {
        position: relative;
        left: 60px;
        margin: 0px 0px 0px 0px;
        width: 600px;
        background-color:#335194;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        border: 2px solid #2AAAFF;  
        color: #fff;
        font-size: 11px;
    }
    
    .suggestionList {
        margin: 0px;
        padding: 0px;
    }
    
    .suggestionList li {
        
        margin: 0px 0px 3px 0px;
        padding: 3px;
        cursor: pointer;
    }
    
    .suggestionList li:hover {
        background-color:#659CD8;
    }
-->
</style>
<script type="text/javascript" src="javas.js"> </script>
<script src="../jquery.js"></script>
<script type="text/javascript" src="../jquery.validate.js"></script>

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



<script>
function chk_pgcp1(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp1').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp2(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp2').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado2').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp3(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp3').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado3').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp4(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp4').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado4').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp5(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp5').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado5').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp6(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp6').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado6').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp7(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp7').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado7').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp8(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp8').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado8').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp9(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp9').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado9').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp10(){
var pos_url = '../recaudos_sh/comprueba_cta.php';
var cod = document.getElementById('pgcp10').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado10').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script></head>

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
            <div align="center"><a href='ingresos.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
<?
$cod_pptal=$_GET['vr'];
$nom_rubro=$_GET['vr2'];  

include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from cca_ing where cod_pptal = '$cod_pptal'";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $uso=$rowxx["ctrl"];
}
if($uso == '')
{$uso = 'NINGUNO - CONFIGURAR';}
else
{$uso=$uso.' <br><b> SELECCIONE , CONSULTE y/o MODIFIQUE</b>';}

?>
<br />
<table width="400" border="1" align="center" class="bordepunteado1">
  <tr>
    <td bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><strong>USO QUE SE LE DA ACTUALMENTE A LA CUENTA </strong><br />
      </div>
    </div></td>
    </tr>
  <tr>
    <td><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><? printf("$uso");?>
      </div>
    </div></td>
    </tr>
</table>
<br />
<?php
$var1 =$_POST["ctrl"];

if ($var1 =="causacion")
{
$sel_causacion ="checked";
$sel_pago="";
$ver_boton="none";
$ver_directo="none";
}
if ($var1 =="directo")
{
$sel_causacion ="";
$sel_pago="checked";
$ver_boton="none";
$ver_causacion="none";
}

?>
<form name="aa" method="post">
  
  <table width="400" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center"><strong>QUE USO LE DARA A LA CUENTA SELECCIONADA ? </strong> <br />
        </div>
      </div>
	  <input name="codp" type="hidden" value="<? printf("%s",$cod_pptal);?>" />
	  <input name="nomr" type="hidden" value="<? printf("%s",$nom_rubro);?>" />
	  </td>
    </tr>
    <tr>
      <td colspan="2"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center"><span class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"><? printf("%s",$cod_pptal);?></span>		
		<br />
        <span class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"><? printf("%s",$nom_rubro);?></span>		</div>
      </div></td>
      </tr>
    <tr>
      <td  width="200" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" >
          Causacion del Ingreso
            <input name="ctrl" type="radio" value="causacion" <?php echo $sel_causacion; ?> style="display: <?php echo $ver_causacion; ?>" />
        </div>
      </div></td>
      <td width="200" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center"> Recaudo Directo
          <input name="ctrl" type="radio" value="directo" <?php echo $sel_pago; ?> style="display: <?php echo $ver_directo; ?>" />
        </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center">
          <input name="Submit2" type="submit" class="Estilo4" value="Aceptar" onclick="this.form.action = 'config_ing_1.php'" style="display: <?php echo $ver_boton; ?>" />
        </div>
      </div></td>
      </tr>
  </table>
</form>
<br />
	<script>
function muestraURL(){
var miPopup
miPopup = window.open("../pgcp/consulta_cta.php","CONTAFACIL","width=800,height=400,menubar=no,scrollbars=yes")
}
              </script>
</center>
	<!--<table width="300" border="0" align="center">
  <tr>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
    <td width="200" valign="middle"><div align="center"><a href="#" onclick="muestraURL()">BUSCAR CUENTA PGCP</a></div></td>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
  </tr>
</table> -->
<br />
<?
$var=$_POST['ctrl'];
$codp=$_POST['codp'];
$nomr=$_POST['nomr'];

if($var == 'causacion')
{

include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from cca_ing where cod_pptal = '$codp' and ctrl ='CAUSACION DEL INGRESO'";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  
  $ctrl=$rowxx["ctrl"];
}

?>
	<form name="a" method="post">
	<table width="800" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="194" bgcolor="#DCE9E5">
		<div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		  <div align="right"><strong>CODIGO  PPTAL SELECCIONADO : </strong></div>
		</div>		</td>
        <td width="176" bgcolor="#FFFFFF" align="center"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		<input type="hidden" name="cod_pptal" value="<? printf("%s",$codp);?>" />
		<? printf("%s",$codp);?>
		</div></td>
        <td colspan="2" align="center" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <input type="hidden" name="nom_rubro" value="<? printf("%s",$nomr);?>" />
          <? printf("%s",$nomr);?>
        </div></td>
        </tr>
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>SELECCIONE CUENTA DEBITO Y CREDITO DEL PGCP QUE SE USARAN EN LA CAUSACION DEL INGRESO </strong>
		  <BR />
		  (Si esta CONSULTANDO, presione la barra espaciadora en la cuenta para ver el nombre de la misma)
		  </div>
        </div></td>
        </tr>
      <tr>
        <td colspan="2" bgcolor="#DCE9E5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DEBITO</strong></div>
        </div>		</td>
        <td colspan="2" bgcolor="#DCE9E5" >
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>CREDITO</strong></div>
        </div>		</td>
        </tr>
      <tr>
	  	<?
			$sqlxx = "select * from cca_ing where cod_pptal = '$codp' and ctrl ='CAUSACION DEL INGRESO'";
			$resultadoxx = mysql_db_query($database, $sqlxx, $cx);
			if (mysql_num_rows($resultadoxx) == 0)
			{
				$ctrl=$rowxx["ctrl"];
					 //$acc='block';
					 $e=0;
					 for($i=1;$i<6;$i++)
					 {
						 $e = $i+5;
						 $f = $i+2;
						 $ff = $f+5;
						 echo "
						 <tr style='position:relative; display:$acc;' id='fil$i'>
						  <td bgcolor='#F5F5F5' valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
							  <input name='pgcp$i' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' value='$rowxx[$f]' onkeyup='lookup(this.value,$i);'>
						  </span></div>
						 <div class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 130px;'>
									<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
									<div class='suggestionList' id='autoSug$i'>
										&nbsp;
									</div>
						 </div></td>
						  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
							  <div align='center' class='Estilo4'>
								<div align='left' id='resulta$i'>$resnomb</div>
							  </div>
						  </div></td>
						  
						  
						  <td bgcolor='#F5F5F5' valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
							  <input name='pgcp$e' type='text' class='Estilo4' id='pgcp$e' style='width:180px;' value='$rowxx[$ff]' onkeyup='lookup(this.value,$e);'>
						  </span></div>
						 <div class='suggestionsBox' id='sugges$e' style='display: none; position:absolute; left: 130px;'>
									<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
									<div class='suggestionList' id='autoSug$e'>
										&nbsp;
									</div>
						 </div></td>
						  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
							  <div align='center' class='Estilo4'>
								<div align='left' id='resulta$e'>$resnombp</div>
							  </div>
						  </div></td>
						  
						</tr>";
						if($i==5){$acc='none';}
					}
			
			}
			else
			{
				while($rowxx = mysql_fetch_array($resultadoxx)) 
				{
					$ctrl=$rowxx["ctrl"];
					 //$acc='block';
					 $e=0;
					 for($i=1;$i<6;$i++)
					 {
						 $e = $i+5;
						 $f = $i+2;
						 $ff = $f+5;
						 if (!empty($rowxx[$f]))
						 {
							 $sqlxxp = "select * from pgcp where cod_pptal = '$rowxx[$f]'";
							$resultadoxxp = mysql_db_query($database, $sqlxxp, $cx);
							while($rowxxp = mysql_fetch_array($resultadoxxp)) 
							{
								$resnomb = $rowxxp['nom_rubro'];
							}
							 $sqlxxpp = "select * from pgcp where cod_pptal = '$rowxx[$ff]'";
							$resultadoxxpp = mysql_db_query($database, $sqlxxpp, $cx);
							while($rowxxpp = mysql_fetch_array($resultadoxxpp)) 
							{
								$resnombp = $rowxxpp['nom_rubro'];
							}
						 }
						 else
						 {
							$resnomb = '';
							$resnombp = '';
						 }
						 echo "
						 <tr style='position:relative; display:$acc;' id='fil$i'>
						  <td bgcolor='#F5F5F5' valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
							  <input name='pgcp$i' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' value='$rowxx[$f]' onkeyup='lookup(this.value,$i);'>
						  </span></div>
						 <div class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 130px;'>
									<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
									<div class='suggestionList' id='autoSug$i'>
										&nbsp;
									</div>
						 </div></td>
						  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
							  <div align='center' class='Estilo4'>
								<div align='left' id='resulta$i'>$resnomb</div>
							  </div>
						  </div></td>
						  
						  
						  <td bgcolor='#F5F5F5' valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
							  <input name='pgcp$e' type='text' class='Estilo4' id='pgcp$e' style='width:180px;' value='$rowxx[$ff]' onkeyup='lookup(this.value,$e);'>
						  </span></div>
						 <div class='suggestionsBox' id='sugges$e' style='display: none; position:absolute; left: 130px;'>
									<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
									<div class='suggestionList' id='autoSug$e'>
										&nbsp;
									</div>
						 </div></td>
						  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
							  <div align='center' class='Estilo4'>
								<div align='left' id='resulta$e'>$resnombp</div>
							  </div>
						  </div></td>
						  
						</tr>";
						if($i==5){$acc='none';}
					}
				}
			}
		?>
      </tr>
      <tr>
        <td colspan="4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
          <div align="center">
            <input name="ctrl" type="hidden" value="<? printf("CAUSACION DEL INGRESO");?>" />
			<input name="Submit" type="submit" class="Estilo4" value="Guardar Configuracion" onclick="this.form.action = 'config_ing_2.php'" />
          </div>
        </div></td>
        </tr>
    </table>
	</form>
<?
}
if($var == 'directo')
{

	include('../config.php');				
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from cca_ing where cod_pptal = '$codp' and ctrl ='RECAUDO DIRECTO'";
	$resultadoxx = mysql_db_query($database, $sqlxx, $cx);
	while($rowxx = mysql_fetch_array($resultadoxx)) 
	{
	  $ctrl=$rowxx["ctrl"];
	}
?>
	<form name="a" method="post">
	<table width="800" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="194" bgcolor="#DCE9E5">
		<div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		  <div align="right"><strong>CODIGO  PPTAL SELECCIONADO : </strong></div>
		</div>		</td>
        <td width="176" bgcolor="#FFFFFF" align="center"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		<input type="hidden" name="cod_pptal" value="<? printf("%s",$codp);?>" />
		<? printf("%s",$codp);?>
		</div></td>
        <td colspan="2" align="center" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <input type="hidden" name="nom_rubro" value="<? printf("%s",$nomr);?>" />
          <? printf("%s",$nomr);?>
        </div></td>
        </tr>
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>SELECCIONE CUENTA DEBITO Y CREDITO DEL PGCP QUE SE USARAN EN EL RECAUDO DIRECTO </strong>
		  <br />
(Si esta CONSULTANDO, presione la barra espaciadora en la cuenta para ver el nombre de la misma) 
		  </div>
        </div></td>
        </tr>
      <tr>
        <td colspan="2" bgcolor="#DCE9E5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DEBITO</strong></div>
        </div>		</td>
        <td colspan="2" bgcolor="#DCE9E5" >
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>CREDITO</strong></div>
        </div>		</td>
        </tr>
      <tr>
        <?
			$sqlxx = "select * from cca_ing where cod_pptal = '$codp' and ctrl ='RECAUDO DIRECTO'";
			$resultadoxx = mysql_db_query($database, $sqlxx, $cx);
			if (mysql_num_rows($resultadoxx) == 0)
			{
				$ctrl=$rowxx["ctrl"];
					 //$acc='block';
					 $e=0;
					 for($i=1;$i<6;$i++)
					 {
						 $e = $i+5;
						 $f = $i+2;
						 $ff = $f+5;
						 echo "
						 <tr style='position:relative; display:$acc;' id='fil$i'>
						  <td bgcolor='#F5F5F5' valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
							  <input name='pgcp$i' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' value='$rowxx[$f]' onkeyup='lookup(this.value,$i);'>
						  </span></div>
						 <div class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 130px; z-index:2;'>
									<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
									<div class='suggestionList' id='autoSug$i'>
										&nbsp;
									</div>
						 </div></td>
						  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
							  <div align='center' class='Estilo4'>
								<div align='left' id='resulta$i'>$resnomb</div>
							  </div>
						  </div></td>
						  
						  
						  <td bgcolor='#F5F5F5' valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
							  <input name='pgcp$e' type='text' class='Estilo4' id='pgcp$e' style='width:180px;' value='$rowxx[$ff]' onkeyup='lookup(this.value,$e);'>
						  </span></div>
						 <div class='suggestionsBox' id='sugges$e' style='display: none; position:absolute; left: 130px;  z-index:2;'>
									<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
									<div class='suggestionList' id='autoSug$e'>
										&nbsp;
									</div>
						 </div></td>
						  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
							  <div align='center' class='Estilo4'>
								<div align='left' id='resulta$e'>$resnombp</div>
							  </div>
						  </div></td>
						  
						</tr>";
						if($i==5){$acc='none';}
					}
			
			}
			else
			{
				while($rowxx = mysql_fetch_array($resultadoxx)) 
				{
					$ctrl=$rowxx["ctrl"];
					 //$acc='block';
					 $e=0;
					 for($i=1;$i<6;$i++)
					 {
						 $e = $i+5;
						 $f = $i+2;
						 $ff = $f+5;
						 if (!empty($rowxx[$f]))
						 {
							 $sqlxxp = "select * from pgcp where cod_pptal = '$rowxx[$f]'";
							$resultadoxxp = mysql_db_query($database, $sqlxxp, $cx);
							while($rowxxp = mysql_fetch_array($resultadoxxp)) 
							{
								$resnomb = $rowxxp['nom_rubro'];
							}
							 $sqlxxpp = "select * from pgcp where cod_pptal = '$rowxx[$ff]'";
							$resultadoxxpp = mysql_db_query($database, $sqlxxpp, $cx);
							while($rowxxpp = mysql_fetch_array($resultadoxxpp)) 
							{
								$resnombp = $rowxxpp['nom_rubro'];
							}
						 }
						 else
						 {
							$resnomb = '';
							$resnombp = '';
						 }
						 echo "
						 <tr style='position:relative; display:$acc;' id='fil$i'>
						  <td bgcolor='#F5F5F5' valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
							  <input name='pgcp$i' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' value='$rowxx[$f]' onkeyup='lookup(this.value,$i);'>
						  </span></div>
						 <div class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 130px;'>
									<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
									<div class='suggestionList' id='autoSug$i'>
										&nbsp;
									</div>
						 </div></td>
						  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
							  <div align='center' class='Estilo4'>
								<div align='left' id='resulta$i'>$resnomb</div>
							  </div>
						  </div></td>
						  
						  
						  <td bgcolor='#F5F5F5' valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
							  <input name='pgcp$e' type='text' class='Estilo4' id='pgcp$e' style='width:180px;' value='$rowxx[$ff]' onkeyup='lookup(this.value,$e);'>
						  </span></div>
						 <div class='suggestionsBox' id='sugges$e' style='display: none; position:absolute; left: 130px;'>
									<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
									<div class='suggestionList' id='autoSug$e'>
										&nbsp;
									</div>
						 </div></td>
						  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
							  <div align='center' class='Estilo4'>
								<div align='left' id='resulta$e'>$resnombp</div>
							  </div>
						  </div></td>
						  
						</tr>";
						if($i==5){$acc='none';}
					}
				}
			}
		?>
		
      </tr>
      <tr>
        <td colspan="4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
          <div align="center">
            <input name="ctrl" type="hidden" value="<? printf("RECAUDO DIRECTO");?>" />
			<input name="Submit" type="submit" class="Estilo4" value="Guardar Configuracion" onclick="this.form.action = 'config_ing_2.php'" />
          </div>
        </div></td>
        </tr>
    </table> 
	</form>	
<?
}
?>
	</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='ingresos.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('../config.php');				
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
          <span class="Estilo4"><b>Usuario: </b><u><? echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
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
<?
}
?>