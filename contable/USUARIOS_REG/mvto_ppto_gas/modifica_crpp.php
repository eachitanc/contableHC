<?
session_start();
if(!session_is_registered("login"))
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
.Estilo9 {color: #FFFFFF}
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo10 {color: #F5F5F5}
</style>
<!--muestra - oculta naturales -->
<SCRIPT language="javascript">
function MostrarOcultar (objetoVisualizar) 
{
	 
	 
		if (document.all['naturales'].style.display=='none') 
		{
		document.all['naturales'].style.display='block';
		document.a.ter_nat.disabled=false;
		document.all['juridicos'].style.display='none';
		document.a.ter_jur.disabled=true;
		}
		else 
		{
		document.a.ter_nat.disabled=true;
		document.a.ter_jur.disabled=true;
		document.all['naturales'].style.display='none';
		document.all['juridicos'].style.display='none';
		}
	
		
		
}
</SCRIPT>
<!--muestra - oculta juridicos -->
<SCRIPT language="javascript">
function MostrarOcultar2 (objetoVisualizar) 
{
	
		if (document.all['juridicos'].style.display=='none') 
		{
		document.all['naturales'].style.display='none';
		document.a.ter_nat.disabled=true;
		document.all['juridicos'].style.display='block';
		document.a.ter_jur.disabled=false;
		}
		else 
		{
		document.a.ter_nat.disabled=true;
		document.a.ter_jur.disabled=true;
		document.all['naturales'].style.display='none';
		document.all['juridicos'].style.display='none';
		}
}
</SCRIPT>  


<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>

<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script>
function chk_pgcp1(){
var pos_url = 'comprueba_cta.php';
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
var pos_url = 'comprueba_cta.php';
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
var pos_url = 'comprueba_cta.php';
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
var pos_url = 'comprueba_cta.php';
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
var pos_url = 'comprueba_cta.php';
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
var pos_url = 'comprueba_cta.php';
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
var pos_url = 'comprueba_cta.php';
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
var pos_url = 'comprueba_cta.php';
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
var pos_url = 'comprueba_cta.php';
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
var pos_url = 'comprueba_cta.php';
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
</script>
<script>
function chk_pgcp11(){
var pos_url = 'comprueba_cta.php';
var cod = document.getElementById('pgcp11').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado11').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp12(){
var pos_url = 'comprueba_cta.php';
var cod = document.getElementById('pgcp12').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado12').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp13(){
var pos_url = 'comprueba_cta.php';
var cod = document.getElementById('pgcp13').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado13').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp14(){
var pos_url = 'comprueba_cta.php';
var cod = document.getElementById('pgcp14').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado14').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script>
function chk_pgcp15(){
var pos_url = 'comprueba_cta.php';
var cod = document.getElementById('pgcp15').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado15').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>



<!--validacion de forms-->
<script src="../jquery.js"></script>
<script type="text/javascript" src="../jquery.validate.js"></script>
<style type="text/css">
* { font-family: Verdana; font-size: 10px; }
label { width: 10em; float: left; }
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
.Estilo10 {
	color: #990000;
	font-style: italic;
}
</style>

<script>
$(document).ready(function(){
$("#commentForm").validate();
});
</script>

<script>
function chk_crpp(){
var pos_url = '../comprobadores/comprueba_crpp.php';
var cod = document.getElementById('crpp').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('res_crpp').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>



<script>
var contt;

function Calcular()
{

total=0;
for(i=0;i <contt;i++){ 

 

var numeros= parseFloat(document.getElementById("vr_deb_1"+i).value);

var total=total+numeros;

  

	}
	 document.getElementById("tot_deb_a").value = total;
	}
	
</script>
<script language="JavaScript">

	var contt;

function Calcularc()
{

total=0;
for(i=0;i <contt;i++){ 

 

var numeros= parseFloat(document.getElementById("vr_cre_2"+i).value);

var total=total+numeros;

  

	}
	 document.getElementById("tot_cre_a").value = total;
	}
		
	
</script>

<script>	



var contt;
var contad;


function validarValor()
{

	for (iii=0; iii <contad; iii++)
	{

		var valor_digitado = parseFloat(document.getElementById("vr_digitado"+iii).value);
		var valor_original = parseFloat(document.getElementById("vr_original"+iii).value);
		var valor_obligado = parseFloat(document.getElementById("obligado"+iii).value);
		valor = valor_original - valor_digitado - valor_obligado;
		if (valor_digitado  >  valor_obligado)
		{
		alert("El valor que intenta modificar es mayor al valor previamente registrado");
		document.getElementById("vr_digitado"+iii).value=valor_obligado;
		document.getElementById("vr_deb_1"+iii).value=valor_obligado;
		document.getElementById("vr_cre_2"+iii).value=valor_obligado;
		Calcular();
		Calcularc();
		}
		
		else
		{
		
			for(ii=0;ii <contt;ii++){ 
	
			var valor= document.getElementById("vr_digitado"+ii).value;
			document.getElementById("vr_deb_1"+ii).value=valor;
			document.getElementById("vr_cre_2"+ii).value=valor;
			
			}
			Calcular();
			Calcularc();
		}
	
		
	}

}


function consecutivo2()
{
var fec = document.getElementById('fecha_crpp').value;
var pos_url2 = 'consultas/concec_crpp.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = req1.responseText;
				var elem = dato.split(',');
				concec = elem[0];
				fecha2 = elem[1];
				document.getElementById('crpp').value =concec;
				if (fec != fecha2)
				{
				alert ("Fecha sugerida para el consecutivo disponible: "+fecha2);
				}
			}
		}
	req1.open('POST', pos_url2 +'?cod='+fec,true);
	req1.send(null);
	}

}
var fecha_reg;
function validar_form()
{
	var fecha_crpp = document.getElementById('fecha_crpp').value;
	if (fecha_crpp < fecha_reg)
	{
		alert("La fecha del Registro es menor a la fecha del CDPP");
		document.getElementById('fecha_crpp').focus();
		return false;
	}
	
	var crpp = document.getElementById('crpp').value;
	if(crpp =='')
	{
		alert("Falta determinar el número de consecutivo del registro");
		document.getElementById('crpp').focus();
		return false;
	}
	var crpp_ctrl = document.getElementById('res_crpp').innerHTML;
	if (crpp_ctrl !="")
	{
		alert("El número de consecutivo ya fue utilizado");
		document.getElementById('crpp').focus();
		return false;
	}
	
	var ter_nat = document.getElementById('ter_nat').value;
	var ter_jur = document.getElementById('ter_jur').value;
	if (ter_nat =='' && ter_jur =='')
	{
		alert("Falta seleccionar un tercero");
		return false;
	}
	
	
return true;
}
</script>
<!--fin val forms--> 
</head>
<body onload="Calcular(); Calcularc();">
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3">
<?php 

$id = $_GET['id1a'];


include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
?>	
	<div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">


<div align="center"><br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <span class="Estilo4"><strong>CERTIFICADO DE REGISTRO PRESUPUESTAL<BR />
  ...::: CRPP :::...
</strong></span></div>
<?

mysql_connect($server, $dbuser, $dbpass);
$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'crpp'");
while($array = mysql_fetch_array($resulta)) 
{
$consecutivo = $array[Auto_increment];
}

?><br />
<form name="a" method="post" id="commentForm" 	action="p_modifica_crpp.php">
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="200"></td>
    <td width="200"></td>
    <td width="200"></td>
    <td width="200"></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><span class="Estilo4"><strong>Fecha de Registro del CRPP  :</strong> </span></div>
    </div></td>
    
    <script type="text/javascript">
function mostrarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
	var x =screen.width;
    ventana.style.marginTop = "200px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
    ventana.style.marginLeft = x-300;//((document.body.clientWidth-10) / 2) +  "px"; // Definimos su posición horizontal
    ventana.style.display = 'block'; // Y lo hacemos visible
	parent.frames['datamain'].window.location.reload();

}

function ocultarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
    ventana.style.display = 'none'; // Y lo hacemos invisible
}
</script>
	<?php
	include('../config.php');
	$cx=mysql_connect ($server, $dbuser, $dbpass);
	$res = mysql_db_query($database,"select * from crpp where id_auto_crpp ='$id'",$cx);
	$rowr = mysql_fetch_array($res);
	$sql3 = mysql_db_query($database,"select * from cdpp where consecutivo ='$rowr[id_auto_cdpp]'",$cx);
	$rw2 = mysql_fetch_array($sql3);
	$fecha_cdpp = $rw2["fecha_reg"];
	?>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left">
        <input name="fecha_crpp" type="text" class="required Estilo4" id="fecha_crpp" value="<? echo $rowr['fecha_crpp'];?>" size="12" onchange="consecutivo2();" />
        <span class="Estilo9">:::</span>
        <input name="button2" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].fecha_crpp,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
      </div>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><span class="Estilo12"><strong>Consecutivo del  Sistema :</strong> </span></div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo12">
        <div align="center"><? echo $rowr['id'];?></div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>Digite Numero de CRPP : </strong></div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <input name="crpp" type="text" class="required Estilo4" id="crpp" size="20" onkeypress="return validar(event)" style="text-align:center" onkeyup="chk_crpp();" value="<?php printf ("%s",substr($rowr['id_manu_crpp'],4,10));?>"  />
        <input name="id_crpp" type="hidden" value="<?php echo $id; ?>" />
        <a href="javascript:mostrarVentana();">Mas</a>
        <div id="miVentana" style="position: fixed; width: 210px; height: 330px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
          <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">CDPP</div>
          <iframe id="datamain" src="crppconsecutivo.php"  width="200" height="250" marginwidth="0" marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
          <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 6px;">
            <input id="btnAceptar" onclick="ocultarVentana();" name="btnAceptar" size="20" type="button" value=".:ok:." />
          </div>
        </div>
        <br />
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		<div class="Estilo4" align="center" id='res_crpp'></div>
		</div>
      </div>
    </div></td>
  </tr>
  <?php
  $res5 = mysql_db_query($database,"select * from cobp where id_auto_crpp ='$id'",$cx);
  $fil5 = mysql_num_rows($res5);
			//if ($fil5 > 0 ) {$ver_valor = "readonly"; $ver_ter ="disabled"; $ver_d ="display:none"; }
			if ($fil5 > 0 ) {$ver_valor = ""; $ver_ter ="disabled"; $ver_d ="display:none"; }
  ?>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; ">
      <div align="left" class="Estilo4">
        <div align="right"><strong>SELECCIONE TERCERO : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><table border="0" align="left">
            <tr>
              <td ><div class="Estilo4" style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px; <?php echo $ver_d; ?> ">
                  <div align="left"> <strong> Seleccione el Tipo de Tercero</strong> <br />
                      <br />
					  
                      <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" 

onclick="JavaScript:MostrarOcultar('naturales');"><font color="#0000FF"> NATURAL</font></span> - <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" 

onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar2('juridicos');"> <font color="#0000FF">JURIDICO</font></span> - <a href="../terceros/terceros.php" 

target="_parent">&iquest; NUEVO ?</a> </div>
              </div></td>
            </tr>
            
            <?php
			$veaterjur="display:none";
			$veaternat="display:none";
			$ter=$rowr['ter_nat'];
			$terj=$rowr['ter_jur']; 
					$sqx1 = "select * from terceros_naturales where id ='$ter'";
					$resx1 = mysql_db_query($database, $sqx1, $connectionxx);
					$rowx1 =mysql_fetch_array($resx1); 
					$num_reg = mysql_num_rows($resx1); 
					if ($num_reg >0)
					{
						$ter_natural =$rowx1['id'];
						$ter_juridico='';
						$veaternat="display:block";
						$enaterjur="disabled='disabled'"; 
						$enaternat="";
						$bannat=1;
						$banjur=0;
					}
					else
					{
						$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
						$sqx2 = "select id from terceros_juridicos where id ='$terj' ";
						$resx2 = mysql_db_query($database, $sqx2, $connectionxx);
						$rowx2 =mysql_fetch_array($resx2); 
						$ter_natural ='';
						$ter_juridico=$rowx2['id']; 
						$veaterjur="display:block";
						$enaternat="disabled='disabled'";
						$enaterjur="";
						$bannat=0;
						$banjur=1;
					}
			?>
            <tr style=" <?php echo $ver_d; ?> ">
              <td id="naturales" style=" <? print $veaternat ?> "><div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
                  <div align="left">
            <select name="ter_nat" class="Estilo4" id="ter_nat" style="width: 350px;" <?php echo $ver_d; ?> >
                      <option value="" selected="selected"></option>
					  <?

include('../config.php');
$db = mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$strSQL = "SELECT * FROM terceros_naturales  WHERE id_emp = '$idxx' order by pri_ape asc ";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) 
						{
							$r = mysql_fetch_array($rs);
							if ($r['id']==$ter_natural)
							{
								echo "<OPTION selected=".$r['pri_ape'].' '.$r['seg_ape'].' '.$r['pri_nom'].' '.$r['seg_nom']." VALUE=\"".$r["id"]."\">".$r["pri_ape"]." ".$r["seg_ape"]." ".$r["pri_nom"]." ".$r["seg_nom"]."</b></OPTION>";
							
							
							}
							else
							{
								echo "<OPTION VALUE=\"".$r["id"]."\">".$r["pri_ape"]." ".$r["seg_ape"]." ".$r["pri_nom"]." ".$r["seg_nom"]."</b></OPTION>";
							}
						}

?>

                    </select>
                  </div>
              </div></td>
            </tr>
            <tr style=" <?php echo $ver_d; ?> " >
              <td id="juridicos" style=" <? print $veaterjur ?> "><div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
                  <div align="left">
                    <select name="ter_jur" class="Estilo4" id="ter_jur" style="width: 350px;"   >
					  <option value="" selected="selected"></option>
                      <?
include('../config.php');
$db = mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$strSQL = "SELECT * FROM terceros_juridicos  WHERE id_emp = '$idxx' order by raz_soc2 asc ";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
							$r = mysql_fetch_array($rs);
							if ($r['id']==$ter_juridico)
							{
								echo "<OPTION selected=".$r['raz_soc2']." VALUE=\"".$r["id"]."\">".$r["raz_soc2"]."</b></OPTION>";
							}
							else
							{
								echo "<OPTION VALUE=\"".$r["id"]."\">".$r["raz_soc2"]."</b></OPTION>";
							}
}
?>
                    </select>
                  </div>
              </div></td>
			  </tr>
			 
          </table></td>
  </tr>
  <tr>
  <?
	$sql0 = "select distinct(consecutivo), fecha_reg, ter_nat, ter_jur, tercero, des, cdpp from cdpp where id_emp ='$id_emp' and consecutivo = '$rowr[id_auto_cdpp]' and liq1='' ";
	$resultado0 = mysql_db_query($database, $sql0, $connectionxx);
	
	while($row0 = mysql_fetch_array($resultado0)) 
	{
	   $fecha_reg=$row0["fecha_reg"];
	   $ter_nat=$row0["ter_nat"];
	   $ter_jur=$row0["ter_jur"];
	   $tercero=$row0["tercero"];
	   $des=$row0["des"];
	   $cdpp=$row0["cdpp"];
	   // onkeyup="a.detalle_crpp.value=a.detalle_crpp.value.toUpperCase()  matusculas
	  	 
	}
	?>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>CONCEPTO - DETALLE CRPP: </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left">
        
        
          <input name="detalle_crpp" type="text" class="required Estilo4" id="detalle_crpp" size="120" ; value="<?php print($rowr['detalle_crpp']); ?>" />
        </div>
      </div>
    </div></td>
    </tr>
  
  <tr>
    <td colspan="4" bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4">
        <div align="center"><strong>INFORMACION GENERAL DE LA DISPONIBILIDAD PRESUPUESTAL </strong></div>
      </div>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>No. CDPP : </strong></div>
      </div>
    </div></td>
    <td><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left">CDPP<? printf("%s",$cdpp);?>
          <input name="id_manu_cdpp" type="hidden" class="Estilo4" id="id_manu_cdpp" value="<? printf("%s",$cdpp);?>"/>
        </div>
      </div>
    </div></td>
    <td><input name="id_auto_cdpp" type="hidden" class="Estilo4" id="id_auto_cdpp" value="<? print($rowr['id_auto_cdpp']);?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>FECHA  CDPP : </strong></div>
      </div>
    </div></td>
    <td><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><? printf("%s",$fecha_reg);?>
          <input name="fecha_cdpp" type="hidden" class="Estilo4" id="fecha_cdpp" value="<? printf("%s",$fecha_reg);?>"/>
        </div>
      </div>
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4">
          <div align="right"><strong>DESCRIPCION DEL CDPP : </strong></div>
        </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4">
          <div align="left"><? printf("%s",$des);?>
              <input name="des_cdpp" type="hidden" class="Estilo4" id="des_cdpp" value="<? printf("%s",$des);?>"/>
          </div>
        </div>
    </div></td>
  </tr>
</table>
<br />
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="900" colspan="4" bgcolor="#DCE9E5"><div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>DATOS DEL CERTIFICADO DE REGISTRO PRESUPUESTAL </strong></div>
    </div></td>
  </tr> 
</table>
<br />
<?

// Datos del registro preupuestal
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select sum(valor) as valor, cuenta,consecutivo from cdpp where id_emp = '$id_emp' and consecutivo ='$rowr[id_auto_cdpp]' group by cuenta ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#F5F5F5'>
<td align='center' width='200'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>

<td align='center' width='300'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center' width='150'><span class='Estilo4'><b>NUEVO VALOR</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VALOR DEL REGISTRO</b></span></td>
<td align='center' width='120'><span class='Estilo4'><b>SIT. DE FONDOS</b></span></td>
</tr>
");

$contador=0;
$contador2=0;
$total=0;
$vr1x=0;
$vr2x=0;
// DATOS DE VALORES REGISTRADOS
while($rw = mysql_fetch_array($re)) 
{
			//***** CONSULTA SITUACION DE FONDOS   
			$cta=$rw["cuenta"];
			$sqlx1 = "select * from car_ppto_gas where id_emp ='$id_emp' and cod_pptal ='$cta'";
			$resultadox1 = mysql_db_query($database, $sqlx1, $connectionxx);
			
			while($rowx1 = mysql_fetch_array($resultadox1)) 
			{
			  $nom_cuenta=$rowx1["nom_rubro"];		
			  $situacion=$rowx1["situacion"];
			  if($situacion == 'C')
			  {
				$situacion='Con Situacion';
			  }
			  else
			  {
				$situacion='Sin Situacion';
			  }
			}
			
			//calculo del vr liquidado x el usuario
			$sqlx1a = "select * from cdpp where cuenta ='$cta'";
			$resultadox1a = mysql_db_query($database, $sqlx1a, $connectionxx);
			
			while($rowx1a = mysql_fetch_array($resultadox1a)) 
			{
			  $liq2=$rowx1a["liq2"];
			}
			$sql3 ="select sum(vr_digitado) as registrado from crpp where id_auto_crpp = '$id' and cuenta ='$cta' and liq1 =''";
			$res3 = mysql_db_query ($database,$sql3,$cx);
			while ($row3 = mysql_fetch_array($res3))
			{
			 $registrado = $row3['registrado'];	
			}
			$sql4 ="select * from crpp where id_auto_cdpp = '$rw[consecutivo]' and cuenta ='$cta'";
			$res4 = mysql_db_query ($database,$sql4,$cx);
			while ($row4 = mysql_fetch_array($res4))
			{
			 $valor_act = $row4['vr_digitado'];	
			}
	
			if ($registrado =='') $registrado =0;
			$dif =   $registrado  ;
	
	printf("
	<span class='Estilo4'>
	
	<!--cuenta-->
	<tr>
	<td align='left'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'> %s </span>
	</div>
	</td>
	
	<!--nom_rubro-->
	<input name='nom_rubro".$contador."' type='hidden' value='%s'>
	<td align='left'><span class='Estilo4'> &nbsp; %s </span></td>
	
	<td align='center'>
	<input name='vr_orig_cdpp".$contador."' type='hidden' value='%s' id='vr_original".$contador."'>
	<input $ver_valor  name='vr_digitado".$contador."' type='text' size='20' class='Estilo4' id='vr_digitado".$contador."' style='text-align:right' onkeypress=\"return validar(event)\" onchange='validarValor()' value='%.2f'>
	</td>
	
	<!--vr obligado-->
	<td align='right'><span class='Estilo4'>%.2f</span>
	<input name='obligado".$contador."' type='hidden' id='obligado".$contador."' value='%s'>
	</td>
	
	
	<!--situacion-->
	<td align='center'><span class='Estilo4'> %s <input name='situacion".$contador."' type='hidden' value='%s'> </span></td>
	
	<!--id_auto_crpp-->
	<input name='consecutivo".$contador."' type='hidden' value='%s'>
	
	<!--cuenta-->
	<input name='cuenta".$contador."' type='hidden' value='%s'>
	
	
	</tr>", $rw["cuenta"], $nom_cuenta, $nom_cuenta, $rw["valor"], $registrado, $registrado, $registrado, $situacion, $situacion, $consecutivo, $rw["cuenta"]); 
	
	$valor1=$registrado; 
	
	$contador++;
	$total= $total + $rw["valor"];
	$vr1x= $vr1x + $dif;
	$vr2x= $vr2x + $registrado;
	
}

printf("

<td colspan ='2' align='right'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>  TOTALES &nbsp;</span>
</div>
</td>
<td align='right'><span class='Estilo4'>  %.2f&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
<td align='right'><span class='Estilo4'> %.2f &nbsp; </span></td>
<td align='right'><span class='Estilo4'>  </span></td>

</table></center>",$vr1x,$vr2x );
//--------	

	?>
	<input name="contador" type="hidden" class="Estilo4" id="contador" value="<? printf("%s",$contador);?>"/>
	
<script>

var contad = "<?php echo $contador; ?>";
</script>
	
	
	<input name="total" type="hidden" class="Estilo4" id="total" value="<? printf("%s",$total);?>"/>
<br />
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="4" bgcolor="#DCE9E5">
	<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>OTROS DATOS DEL REGISTRO PRESUPUESTAL </strong></div>
    </div>	</td>
    </tr>
  <tr>
    <td width="200" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>MANEJA CONTRATO : </strong></div>
      </div>
    </div></td>
    <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <select name="contrato" class="Estilo4" id="contrato">
          <?php 
		   if ($rowr['contrato']=='SI')
		         {
					echo "<option value='NO'>NO</option>
          			<option value='SI' selected>SI</option>";
				 }
		   if ($rowr['contrato']=='NO')
		         {
					echo "<option value='NO' selected>NO</option>
          			<option value='SI' >SI</option>";
				 }
		  ?>
        </select>
        </div>
    </div></td>
    <td width="200" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong> ADICION : </strong></div>
      </div>
    </div></td>
    <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <select name="adicion" class="Estilo4" id="adicion">
                    <?php 
		   if ($rowr['adicion']=='SI')
		         {
					echo "<option value='NO'>NO</option>
          			<option value='SI' selected>SI</option>";
				 }
		   if ($rowr['adicion']=='NO')
		         {
					echo "<option value='NO' selected>NO</option>
          			<option value='SI' >SI</option>";
				 }
		  ?>

        </select>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>No CONTRATO : </strong></div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <input name="n_contrato" id="n_contrato" value="<?php echo $rowr['n_contrato']; ?>" size="12">
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>TALENTO HUMANO  : </strong></div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <select name="t_humano" class="Estilo4" id="t_humano">
          <option value="NO">NO</option>
          <option value="SI">SI</option>
        </select>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4">
          <div align="right"><strong>FORMA DE PAGO : </strong></div>
        </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4">
          <select name="pago" class="Estilo4" id="pago">
       <?php 
		   if ($rowr['pago']=='ANTICIPO')
		         {
					echo "<option value='ANTICIPO' selected='selected'>ANTICIPOS %</option>
           				  <option value='PAGOS PARCIALES'>PAGOS PARCIALES</option>
            			  <option value='PAGO TOTAL' >PAGO TOTAL</option>";
				 }
		   if ($rowr['pago']=='PAGOS PARCIALES')
		         {
					echo "<option value='ANTICIPO' >ANTICIPOS %</option>
           				  <option value='PAGOS PARCIALES' selected='selected'>PAGOS PARCIALES</option>
            			  <option value='PAGO TOTAL' >PAGO TOTAL</option>";
				 }
		    if ($rowr['pago']=='PAGO TOTAL')
		         {
					echo "<option value='ANTICIPO' >ANTICIPOS %</option>
           				  <option value='PAGOS PARCIALES' >PAGOS PARCIALES</option>
            			  <option value='PAGO TOTAL' selected='selected'>PAGO TOTAL</option>";
				 }
		  ?>
 
          
            
          </select>
        </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div align="center" class="Estilo4">
      <div align="right"><strong>REGIMEN SUBSIDIADO : </strong></div>
    </div></td>
    <td><div align="center" class="Estilo4">
      <select name="subsidiado" class="Estilo4" id="subsidiado">
        <option value="NO">NO</option>
        <option value="SI">SI</option>
      </select>
    </div></td>
  </tr>
</table>
	
	
<table width="800" border="1" align="center" class="bordepunteado1">
  <br />
  <tr>
    <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE </strong></div>
    </div></td>
  </tr>
  <tr>
    <td width="192" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><strong>DIGITE CUENTA P.G.C.P </strong></div>
    </div></td>
    <td width="329" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><strong>DESCRIPCION</strong> <strong>ADICIONAL</strong> </div>
    </div></td>
    <td width="130" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><strong>VALOR DEBITO </strong></div>
    </div></td>
    <td width="134" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><strong>VALOR CREDITO </strong></div>
    </div></td>
  </tr>
  
  
  <?php
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select sum(valor) as valor, cuenta,consecutivo from cdpp where id_emp = '$id_emp' and consecutivo ='$rowr[id_auto_cdpp]' group by cuenta ";

$re = mysql_db_query($database, $sq, $cx);



$contador2=0;
$total=0;
$vr1x=0;
$vr2x=0;
while($rw = mysql_fetch_array($re)) 
   {

		//***** CONSULTA SITUACION DE FONDOS   
		$cta=$rw["cuenta"];
		$sqlx1 = "select * from car_ppto_gas where id_emp ='$id_emp' and cod_pptal ='$cta'";
		$resultadox1 = mysql_db_query($database, $sqlx1, $connectionxx);
		
		while($rowx1 = mysql_fetch_array($resultadox1)) 
		{
		  $situacion=$rowx1["situacion"];
		  if($situacion == 'C')
		  {
			$situacion='Con Situacion';
		  }
		  else
		  {
			$situacion='Sin Situacion';
		  }
		}
		
		//calculo del vr liquidado x el usuario
		$sqlx1a = "select * from cdpp where cuenta ='$cta'";
		$resultadox1a = mysql_db_query($database, $sqlx1a, $connectionxx);
		
		while($rowx1a = mysql_fetch_array($resultadox1a)) 
		{
		  $liq2=$rowx1a["liq2"];
		}
		$sql3 ="select sum(vr_digitado) as registrado from crpp where id_auto_cdpp = '$rowr[id_auto_cdpp]' and cuenta ='$cta' and liq1=''";
		$res3 = mysql_db_query ($database,$sql3,$cx);
		while ($row3 = mysql_fetch_array($res3))
		{
		 $registrado = $row3['registrado'];	
		}
		if ($registrado =='') $registrado =0;


$dif =   $registrado;
   


$valor1=$rw["vr_obligado"]; 


$total= $total + $rw["valor"];
$vr1x= $vr1x + $dif;
$vr2x= $vr2x + $rw["vr_obligado"];


$sqlx11 = "select cod_pptal_crp, cod_pptal_gas_apr2, nom_pptal_gas_apr  from ctas0_gas_ok where id_emp ='$id_emp' and cod_pptal ='$cta'";
		$resultadox11 = mysql_db_query($database, $sqlx11, $connectionxx);
		
		while($rowx11 = mysql_fetch_array($resultadox11)) 
		{
		  $cuentad=$rowx11["cod_pptal_crp"];
		   $cuentac=$rowx11["cod_pptal_gas_apr2"];
		   $nomb=$rowx11["nom_pptal_gas_apr"];
		   
		    printf("
			<tr>
    <td valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
      <input name='pgcp1".$contador2."' type='text' class='Estilo4' id='pgcp1".$contador2."' style='width:180px;' value='$cuentad'/>
     
     
    </span> </div></td>
    <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
      <div align='center' class='Estilo4'>
        <div align='left'> <div align='left' id='resultado'>$nomb</div></div>
      </div>
    </div></td>
    <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
      <div align='center' class='Estilo4'>
        <div align='right'>
          <input name='vr_deb_1".$contador2."' type='text' class='Estilo4' style='text-align:right' onkeypress='return validar(event)' value='$dif' id='vr_deb_1".$contador2."' onKeyUp='Calcular();'/>
        </div>
      </div>
    </div></td>
    <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
      <div align='center' class='Estilo4'>
        <div align='right'>
          <input name='vr_cre_1' type='text' class='Estilo4' id='vr_cre_1' style='text-align:right' onkeypress='return validar(event)' onKeyUp='Calcularc();'/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
      <input name='pgcp2".$contador2."' type='text' class='Estilo4' id='pgcp2' style='width:180px;' value='$cuentac'/>
      
      
    </span> </div></td>
    <td bgcolor='#F5F5F5'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
      <div align='center' class='Estilo4'>
        <div align='left'><div align='left' id='resultado2'>$nomb</div></div>
      </div>
    </div></td>
    <td bgcolor='#F5F5F5'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
      <div align='center' class='Estilo4'>
        <div align='right'>
          <input name='vr_deb_2' type='text' class='Estilo4' id='vr_deb_2' style='text-align:right' onkeypress='return validar(event)' onkeyup='Calcular();' />
        </div>
      </div>
    </div></td>
    <td bgcolor='#F5F5F5'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
      <div align='center' class='Estilo4'>
        <div align='right'>
          <input name='vr_cre_2".$contador2."' type='text' class='Estilo4' id='vr_cre_2".$contador2."' style='text-align:right' onkeypress='return validar(event)'  value='$dif' onKeyUp='Calcularc();'/>
        </div>
      </div>
    </div></td>
  </tr>
		  ");
		 $contador2++;
		  }


}

?>

  <script>
var contt = "<?php echo $contador2; ?>" ;

</script>
  
 
  <tr>
    <td bgcolor="#990000">&nbsp;</td>
    <td bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8 Estilo9">
          <div align="center"><strong>VERIFIQUE QUE LAS SUMAS SEAN IGUALES ANTES DE GRABAR</strong></div>
        </div>
    </div></td>
    <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" onKeyUp="Calcular();"/>
          </div>
        </div>
    </div></td>
    <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" onKeyUp="Calcularc();"/>
          </div>
        </div>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<? 
echo '<script languaje="JavaScript">
var fecha_reg="'.$fecha_reg.'";
</script>';
	
?>
  <tr>
    <td colspan="4"><div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <input name="Submit322" type="submit" class="Estilo12"  value="Guardar Certificado de Registro Presupuestal" onClick="return validar_form()" />
      </div>
    </div></td>
  </tr>
  <!--secciones de fila -->
  <!--secciones de fila -->
</table>
</form>
</div>
	</div></td>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
	  
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center">
              <?
printf("

<center class='Estilo9'>
<form method='post' action='mvto.php'>
<input type='hidden' name='nn' value='CRPP'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");

?>
            </div>
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
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
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