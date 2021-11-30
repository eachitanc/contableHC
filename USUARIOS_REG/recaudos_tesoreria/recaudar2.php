<?php
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
.Estilo8 {color: #FFFFFF}
.Estilo9 {color: #F5F5F5}
</style>


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
var par=false;
function parpadeo() {
	document.getElementById('txt').style.visibility= (par) ? 'visible' : 'hidden';
	par = !par;
}
</script>

<style type="text/css">
<!--
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
-->
</style>

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
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
</style>

<script>
$(document).ready(function(){
$("#commentForm").validate();
});
</script>

<script>
function chk_roit(){
var pos_url = '../comprobadores/comprueba_roit.php';
var cod = document.getElementById('id_manu_roit').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('res_roit').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>

<script language="JavaScript">

function Calcular()
{
   var a1 = document.a.vr_deb_1.value;   var a2 = document.a.vr_deb_2.value;
   var a3 = document.a.vr_deb_3.value;   var a4 = document.a.vr_deb_4.value;
   var a5 = document.a.vr_deb_5.value;   var a6 = document.a.vr_deb_6.value;
   var a7 = document.a.vr_deb_7.value;   var a8 = document.a.vr_deb_8.value;
   var a9 = document.a.vr_deb_9.value;   var a10 = document.a.vr_deb_10.value;
   
   var a11 = document.a.vr_deb_11.value;   var a12 = document.a.vr_deb_12.value;
   var a13 = document.a.vr_deb_13.value;   var a14 = document.a.vr_deb_14.value;
   var a15 = document.a.vr_deb_15.value;   

   
   
   
   if(a1 == "")
   {
   a1=0;
   }
   
   if(a2 == "")
   {
   a2=0;
   }
   if(a3 == "")
   {
   a3=0;
   }
   if(a4 == "")
   {
   a4=0;
   }
   if(a5 == "")
   {
   a5=0;
   }
   if(a6 == "")
   {
   a6=0;
   }
   if(a7 == "")
   {
   a7=0;
   }
   if(a8 == "")
   {
   a8=0;
   }
      if(a9 == "")
   {
   a9=0;
   }
      if(a10 == "")
   {
   a10=0;
   }
    if(a11 == "")
   {
   a11=0;
   }
   
   if(a12 == "")
   {
   a12=0;
   }
   if(a13 == "")
   {
   a13=0;
   }
   if(a14 == "")
   {
   a14=0;
   }
   if(a15 == "")
   {
   a15=0;
   }

   
   
   
   var total = parseFloat(a1) + parseFloat(a2) + parseFloat(a3) + parseFloat(a4) + parseFloat(a5)  + parseFloat(a6) + parseFloat(a7) + parseFloat(a8) + parseFloat(a9) + parseFloat(a10) + parseFloat(a11) + parseFloat(a12) + parseFloat(a13) + parseFloat(a14) + parseFloat(a15) ;
   
   
   
   document.getElementById("tot_deb_a").value = total.toFixed(2); 
}	
		
	
</script>

<script language="JavaScript">

function Calcularc()
{
	  
   var aa1 = document.a.vr_cre_1.value;   var aa2 = document.a.vr_cre_2.value;
   var aa3 = document.a.vr_cre_3.value;   var aa4 = document.a.vr_cre_4.value;
   var aa5 = document.a.vr_cre_5.value;   var aa6 = document.a.vr_cre_6.value;
   var aa7 = document.a.vr_cre_7.value;   var aa8 = document.a.vr_cre_8.value;
   var aa9 = document.a.vr_cre_9.value;   var aa10 = document.a.vr_cre_10.value;
   
   var aa11 = document.a.vr_cre_11.value;   var aa12 = document.a.vr_cre_12.value;
   var aa13 = document.a.vr_cre_13.value;   var aa14 = document.a.vr_cre_14.value;
   var aa15 = document.a.vr_cre_15.value;   


   
   
   
   if(aa1 == "")
   {   aa1=0;
   }
      if(aa2 == "")
   {   aa2=0;
   }
   if(aa3 == "")
   {   aa3=0;
   }
   if(aa4 == "")
   {   aa4=0;
   }
   if(aa5 == "")
   {   aa5=0;
   }
   if(aa6 == "")
   {   aa6=0;
   }
   if(aa7 == "")
   {   aa7=0;
   }
   if(aa8 == "")
   {   aa8=0;
   }
      if(aa9 == "")
   {   aa9=0;
   }
      if(aa10 == "")
   {   aa10=0;
   }
    if(aa11 == "")
   {   aa11=0;
   }
   
   if(aa12 == "")
   {   aa12=0;
   }
   if(aa13 == "")
   {   aa13=0;
   }
   if(aa14 == "")
   {   aa14=0;
   }
   if(aa15 == "")
   {   aa15=0;
   }
    
   
   
   var totalc = parseFloat(aa1) + parseFloat(aa2) + parseFloat(aa3) + parseFloat(aa4) + parseFloat(aa5) + parseFloat(aa6) + parseFloat(aa7) + parseFloat(aa8) + parseFloat(aa9) + parseFloat(aa10) + parseFloat(aa11) + parseFloat(aa12) + parseFloat(aa13) + parseFloat(aa14) + parseFloat(aa15);
   
   
   document.getElementById("tot_cre_a").value = totalc.toFixed(2);
}	
		

function consecutivo2()
{
var fec = document.getElementById('fecha_recaudo').value;
var pos_url2 = 'consultas/concec_roit.php';	
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
				document.getElementById('id_manu_roit').value =concec;
				if (fec != fecha2)
				{
				alert ("Fecha sugerida para el consecutivo disponible: "+fecha2);
				}
			}
		}
	req1.open('POST', pos_url2 +'?cod='+fec,false);
	req1.send(null);
	}

}

	
</script>

 
    <script type="text/javascript">
function mostrarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
	var x =screen.width;
    ventana.style.marginTop = "200px"; // Definimos su posici�n vertical. La ponemos fija para simplificar el c�digo
    ventana.style.marginLeft = x-300;//((document.body.clientWidth-10) / 2) +  "px"; // Definimos su posici�n horizontal
    ventana.style.display = 'block'; // Y lo hacemos visible
	parent.frames['datamain'].window.location.reload();

}

function ocultarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
    ventana.style.display = 'none'; // Y lo hacemos invisible
}

function Puntero()
{
	document.body.style.cursor="Pointer";
}

function PunteroNormal()
{
	document.body.style.cursor="Default";
}
</script>
<

<!--fin val forms--> 
</head>

<body onload= consecutivo2(); "setInterval('parpadeo()',1000)">
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
	<div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>RECIBO OFICIAL DE INGRESO  </strong>
        <?php

$id = $_GET['id'];
//printf("%s",$id);
		
include('../config.php');

// conexion				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// extraer datos
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
}		




$sqlxxx = "select * from cartera_cont where id_emp ='$id_emp' and id ='$id' ";
$resultadoxxx = mysql_db_query($database, $sqlxxx, $connectionxx);

while($rowxxx = mysql_fetch_array($resultadoxxx)) 
{
  
$id_reip = $rowxxx["id_reip"];
$tercero = $rowxxx["tercero"];
$valor_rec = $rowxxx["valor_rec"];


$consec_cartera = $rowxxx["consec_cartera"];
$fecha_causa = $rowxxx["fecha_causa"];
$ref = $rowxxx["ref"];
$fecha_ven = $rowxxx["fecha_ven"];

$pgcp1 = $rowxxx["pgcp1"];
$pgcp2 = $rowxxx["pgcp2"];
$pgcp3 = $rowxxx["pgcp3"];
$pgcp4 = $rowxxx["pgcp4"];
$pgcp5 = $rowxxx["pgcp5"];
$pgcp6 = $rowxxx["pgcp6"];
$pgcp7 = $rowxxx["pgcp7"];
$pgcp8 = $rowxxx["pgcp8"];
$pgcp9 = $rowxxx["pgcp9"];
$pgcp10 = $rowxxx["pgcp10"];
$pgcp11 = $rowxxx["pgcp11"];
$pgcp12 = $rowxxx["pgcp12"];
$pgcp13 = $rowxxx["pgcp13"];
$pgcp14 = $rowxxx["pgcp14"];
$pgcp15 = $rowxxx["pgcp15"];

$des1 = $rowxxx["des1"];
$des2 = $rowxxx["des2"];
$des3 = $rowxxx["des3"];
$des4 = $rowxxx["des4"];
$des5 = $rowxxx["des5"];
$des6 = $rowxxx["des6"];
$des7 = $rowxxx["des7"];
$des8 = $rowxxx["des8"];
$des9 = $rowxxx["des9"];
$des10 = $rowxxx["des10"];
$des11 = $rowxxx["des11"];
$des12 = $rowxxx["des12"];
$des13 = $rowxxx["des13"];
$des14 = $rowxxx["des14"];
$des15 = $rowxxx["des15"];


$vr_deb_1 = $rowxxx["vr_deb_1"];
$vr_deb_2 = $rowxxx["vr_deb_2"];
$vr_deb_3 = $rowxxx["vr_deb_3"];
$vr_deb_4 = $rowxxx["vr_deb_4"];
$vr_deb_5 = $rowxxx["vr_deb_5"];
$vr_deb_6 = $rowxxx["vr_deb_6"];
$vr_deb_7 = $rowxxx["vr_deb_7"];
$vr_deb_8 = $rowxxx["vr_deb_8"];
$vr_deb_9 = $rowxxx["vr_deb_9"];
$vr_deb_10 = $rowxxx["vr_deb_10"];
$vr_deb_11 = $rowxxx["vr_deb_11"];
$vr_deb_12 = $rowxxx["vr_deb_12"];
$vr_deb_13 = $rowxxx["vr_deb_13"];
$vr_deb_14 = $rowxxx["vr_deb_14"];
$vr_deb_15 = $rowxxx["vr_deb_15"];

$vr_cre_1 = $rowxxx["vr_cre_1"];
$vr_cre_2 = $rowxxx["vr_cre_2"];
$vr_cre_3 = $rowxxx["vr_cre_3"];
$vr_cre_4 = $rowxxx["vr_cre_4"];
$vr_cre_5 = $rowxxx["vr_cre_5"];
$vr_cre_6 = $rowxxx["vr_cre_6"];
$vr_cre_7 = $rowxxx["vr_cre_7"];
$vr_cre_8 = $rowxxx["vr_cre_8"];
$vr_cre_9 = $rowxxx["vr_cre_9"];
$vr_cre_10 = $rowxxx["vr_cre_10"];
$vr_cre_11 = $rowxxx["vr_cre_11"];
$vr_cre_12 = $rowxxx["vr_cre_12"];
$vr_cre_13 = $rowxxx["vr_cre_13"];
$vr_cre_14 = $rowxxx["vr_cre_14"];
$vr_cre_15 = $rowxxx["vr_cre_15"];

$tot_deb = $rowxxx["tot_deb"];
$tot_cre = $rowxxx["tot_cre"];
}

$sql2 = "select distinct(des) from reip_ing where id_emp ='$id_emp' and consecutivo = '$id_reip'";
$resultado2 = mysql_db_query($database, $sql2, $connectionxx);
while($row2 = mysql_fetch_array($resultado2)) {  $des=$row2["des"]; }

$sql = "select distinct(fecha_reg) from reip_ing where id_emp ='$id_emp' and consecutivo = '$id_reip'";
$resultado = mysql_db_query($database, $sql, $connectionxx);
while($row = mysql_fetch_array($resultado)) {  $fecha_reg=$row["fecha_reg"]; }


$sql3a = "select distinct(id_manu_reip) from reip_ing where id_emp ='$id_emp' and consecutivo = '$id_reip'";
$resultado3a = mysql_db_query($database, $sql3a, $connectionxx);
while($row3a = mysql_fetch_array($resultado3a)) {  $id_manu_reip=$row3a["id_manu_reip"]; }		

?>
      </div>
	</div>	</td>
  </tr>
<?php  

$sqlxx2 = "select * from reip_ing where id_emp = '$id_emp' and consecutivo = '$id_reip'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);
$a=0;
while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
  $recaudo_completo=$rowxx2["recaudo_completo"];
  if($recaudo_completo == 'SI')
  {
    $a++;
  }
}
//**
$link = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database, $link);
$result = mysql_query("select * from reip_ing where id_emp = '$id_emp' and consecutivo = '$id_reip'", $link);
$num_rows = mysql_num_rows($result);
//**
?>
  
  
  <form name="a" method="post" id="commentForm">
  <tr>
  <td colspan="3">
<?php
if($num_rows == $a)
{
printf("
<br><center class='Estilo4'>Esta Cuenta por Pagar ha sido Recaudada <b>EN SU TOTALIDAD</b>
<BR><BR>Sera Eliminada de la Lista de Cuentas x Cobrar (Cartera) por Recaudar o Recaudadas Parcialmente<br><br>");

$sqlx3 = "update cartera_cont set recaudado='SI' where id_emp ='$id_emp' and id_reip ='$id_reip'";
$rex3 = mysql_db_query($database, $sqlx3, $connectionxx);


}
else
{
?>  
  
  
	<table width="780" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="174"></td>
        <td width="186"></td>
        <td width="165"></td>
        <td width="225"></td>
      </tr>
     
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>HISTORIA FINANCIERA DEL MOVIMIENTO</strong></div>
        </div></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>INFORMACION DEL RECONOCIMIENTO 
            
          </strong></div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>No. del Reconocimiento </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
		  <?php 
		  
		  
		  
		  
		  printf("%s",$id_manu_reip);
		  
		  
		  ?><input name="id_reip" type="hidden" id="id_reip" value="<?php printf("%s",$id_reip);?>" />
          </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>Fecha de Reconocimiento </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><?php printf("%s",$fecha_reg);?>
            <input name="fecha_reg" type="hidden" id="fecha_reg" value="<?php printf("%s",$fecha_reg);?>" />
          </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Tercero</strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4"><?php printf("%s",$tercero);?>
            <input name="tercero" type="hidden" id="tercero" value="<?php printf("%s",$tercero);?>" />
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div class="Estilo4">
            <div align="right"><strong>Descripcion Reconocimiento </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4"><?php printf("%s",$des);?>
            <input name="des" type="hidden" id="des" value="<?php printf("%s",$des);?>" />
          </div>
        </div></td>
        </tr>
      <tr>
        <td colspan="4" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center" class="Estilo4"><strong>INFORMACION  DE LA CAUSACION DE CARTERA </strong></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Consecutivo</strong></div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center"> <span class="Estilo4"> <?php printf("%s",$consec_cartera); ?>
                  <input name="consec_cartera" type="hidden" id="consec_cartera" value="<?php printf("%s",$consec_cartera); ?>" />
            </span></div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="center"><strong>Fecha de Causacion </strong></div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"> <?php printf("%s",$fecha_causa);?>
                <input name="fecha_causa" type="hidden" id="fecha_causa" value="<?php printf("%s",$fecha_causa);?>" />
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Referencia </strong></div>
            </div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left"> <?php printf("%s",$ref);?>
                  <input name="ref" type="hidden" value="<?php printf("%s",$ref);?>" />
              </div>
            </div>
        </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Fecha de Vencimiento </strong></div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"> <?php printf("%s",$fecha_ven);?>
                <input name="fecha_ven" type="hidden" value="<?php printf("%s",$fecha_ven);?>" />
            </div>
        </div></td>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center" class="Estilo4"><strong>INFORMACION  REQUERIDA PARA EL RECAUDO</strong></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Fecha del Recaudo </strong></div>
          </div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left">
            <input name="fecha_recaudo" type="text" class="required Estilo4" id="fecha_recaudo" value="<?php printf("%s",$ano);?>" size="12" />
            <span class="Estilo8">:::</span>
            <input name="button2" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].fecha_recaudo,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
          </div>
        </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Consecutivo del Sistema </strong></div>
          </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center"> <span class="Estilo4">
            <?php

new mysqli($server, $dbuser, $dbpass, $database);
$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'recaudo_roit'");
while($array = mysql_fetch_array($resulta)) 
{
$consec_recaudo = $array[Auto_increment];
}

?>
            <?php printf("%s",$consec_recaudo);?>
            <input name="consec_recaudo" type="hidden" id="consec_recaudo" value="<?php printf("%s",$consec_recaudo);?>" />
          </span></div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Digite No. de ROIT  </strong></div>
          </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">

                <div align="center">
                  <input name="id_manu_roit" type="text" class="required Estilo4" id="id_manu_roit" style="text-align:center" onkeypress="return validar(event)" onkeyup="chk_roit();"/>
                  
                  
                  
                  
                 <a href="javascript:mostrarVentana();">Mas</a>
               <div id="miVentana" style="position: fixed; width: 210px; height: 330px; top: 0; left: 0; font-family:Verdana,
                    Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 
                     3px solid; background-color: #FAFAFA; color: #000000; display:none;"> 
                     
                    <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">
                          <table border="0" width="100%">
                           <tr>
                              <td>Consecutivos del Documento</td>
                              <td align="right"><img src="../simbolos/cerrar.png"  width="15" border="0"
                                 onclick="ocultarVentana();" onmouseover="Puntero();" onmouseout="PunteroNormal();">
                               </td>
                            </tr> 
                          </table>
                      </div>
                      <iframe id="datamain" src="roitconsecutivo.php"  width="200" height="290" marginwidth="0" 
                               marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
              </div>
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                  <div class="Estilo4" align="center" id='res_ncon'></div>
              </div>
                
                
                
                
				  </div>
          </div></div></td>
      </tr>
      
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Detalle  del Recaudo </strong></div>
            </div>
        </div></td>
        <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left">
                <input name="des_recaudo" type="text" class="required Estilo4" id="des_recaudo"  size="100" value="<?php printf("%s",$des);?>" />
              </div>
            </div>
        </div></td>
      </tr>
      
      <tr>
        <td width="174"></td>
        <td width="186"></td>
        <td width="165"></td>
        <td width="225"></td>
      </tr>
    </table>
	<br />
	<table width="780" border="1" align="center" class="bordepunteado1">
	  <tr>
	    <td width="980" colspan="4" bgcolor="#DCE9E5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center">
			<strong>VALORES DEL RECAUDO </strong>            </div>
          </div>
	      </div></td>
	    </tr>
	  
	  
	  <tr>
        <td colspan="4" bgcolor="#FFFFFF"><div class="Estilo4">
            <div align="center">
              <?php
//-------
				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select id,sum(valor),cuenta,nom_rubro from reip_ing where id_emp = '$id_emp' and consecutivo ='$id_reip' group by cuenta order by id asc ";
$re = $cx->query($sq);

printf("
<center>

<table width='930'>
<tr bgcolor='#F5F5F5'>
<td align='center' width='200'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Imputacion</b></span>
</div>
</td>
<td align='center' width='430'><span class='Estilo4'><b>Nombre</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Valor x Recaudar</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Valor Recaudado</b><br>(Hasta la fecha)</span></td>



</tr>


");
$cont=0; 

while($rw = $re->fetch_assoc()) 
   {
   	$sq32 = "select sum(vr_digitado) from recaudo_roit where id_reip = '$id_reip' and cuenta ='$rw[cuenta]'";
	$rs32 = mysql_db_query($database,$sq32,$cx); 
	$rw32 = mysql_fetch_array($rs32); 

$valor =$rw["sum(valor)"];
$dif= $rw["sum(valor)"]-$rw32["sum(vr_digitado)"];   
printf("
<span class='Estilo4'>
<tr>


<td align='left' bgcolor='#F5F5F5'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>


<td align='left'><span class='Estilo4'> %s </span></td>


<!--envio valor digitado x usuario-->
<td align='center' bgcolor='#F5F5F5'>
<input name='".$cont."' type='text' size='20' class='required Estilo4' style='text-align:right' onkeypress=\"return validar(event)\" value='%.2f'>
</td>


<td align='right'><span class='Estilo4'> %.2f&nbsp;</span></td>


<!--envio id de reip-->
<input name='id".$cont."' type='hidden' value='%s'>


<!--envio valor original del recaudo-->
<input name='vr".$cont."' type='hidden' value='%s'>

<!--envio de la cuenta-->
<input name='cta".$cont."' type='hidden' value='%s'>

<!--nom_rubro-->
<input name='nom".$cont."' type='hidden' value='%s'>

</tr>", $rw["cuenta"], $rw["nom_rubro"], $dif, $rw["vr_recaudado"], $rw["id"], $valor, $rw["cuenta"], $rw["nom_rubro"]); 

$cont++;

   }

printf("</table></center>");
//--------	
?>

              <input name="cont" type="hidden" id="cont" value="<?php printf("%s",$cont); ?>" />
            </div>
        </div></td>
	    </tr>
		<tr>
	    <td colspan="4" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div class="Estilo4">
            <div align="center">Valor Total del Reconocimiento : $
              <?php
printf("%.2f",$valor_rec); 
?>
              =
              <input name="valor_rec" type="hidden" id="valor_rec" value="<?php printf("%s",$valor_rec);?>" />
            </div>
          </div>
	      </div></td>
	    </tr>
    </table>
	<br />
	          <center>
			  <span class="Estilo4">
			  <font color="#990000">
			  <span id="txt">
			  <b><U>ATENCION</U></b><BR /><BR />
			  </span>
			  RECUERDE CAMBIAR EL CODIGO P.G.C.P DE LAS CUENTAS DEBITO<br /><br />
			  Ajuste el Movimiento Contable segun sus Requerimientos			  </font>			  </span></center>
	<br />	</td>
  </tr>
  <tr>
    <td colspan="3">
		<script>
function muestraURL(){
var miPopup
miPopup = window.open("../pgcp/consulta_cta.php","CONTAFACIL","width=800,height=400,menubar=no,scrollbars=yes")
}
</script>
<table width="300" border="0" align="center">
  <tr>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
    <td width="200" valign="middle"><div align="center"><a href="#" onclick="muestraURL()">BUSCAR CUENTA PGCP</a></div></td>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
  </tr>
</table>
	
	<table width="871" border="1" align="center" class="bordepunteado11">
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo20"><strong>CONTABILIDAD</strong></div>
        </div></td>
      </tr>
      <tr>
        <td width="190" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo20"><strong>CUENTA P.G.C.P </strong></div>
        </div></td>
        <td width="410" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo20"><strong>DESCRIPCION ADICIONAL </strong></div>
        </div></td>
        <td width="121" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo20"><strong>VALOR DEBITO </strong></div>
        </div></td>
        <td width="120" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo20"><strong>VALOR CREDITO </strong></div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp1" type="text" class="Estilo20" id="pgcp1" style="width:180px;" onkeyup="chk_pgcp1();" value="<?php printf("%s",$pgcp1); ?>"/>
            </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_1" type="text" class="Estilo20" id="vr_cre_1" style="text-align:right" onkeypress="return validar(event)" size="20" value="<?php printf("%.2f",$vr_cre_1); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_1" type="text" class="Estilo20" id="vr_deb_1" style="text-align:right" onkeypress="return validar(event)" size="20" value=" <?php printf("%s",$dif); ?> " onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp2" type="text" class="Estilo20" id="pgcp2" style="width:180px;" onkeyup="chk_pgcp2();" value=""/>
            
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado2'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_2" type="text" class="Estilo20" id="vr_cre_2" style="text-align:right" onkeypress="return validar(event)"  size="20" value="<?php printf("%s",$dif); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_2" type="text" class="Estilo20" id="vr_deb_2" style="text-align:right" onkeypress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_2); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp3" type="text" class="Estilo20" id="pgcp3" style="width:180px;" onkeyup="chk_pgcp3();" value=""/>
            
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado3'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_3" type="text" class="Estilo20" id="vr_cre_3" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_3" type="text" class="Estilo20" id="vr_deb_3" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp4" type="text" class="Estilo20" id="pgcp4" style="width:180px;" onkeyup="chk_pgcp4();" value=""/>
           
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado4'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_4" type="text" class="Estilo20" id="vr_cre_4" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_4" type="text" class="Estilo20" id="vr_deb_4" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp5" type="text" class="Estilo20" id="pgcp5" style="width:180px;" onkeyup="chk_pgcp5();" value=""/>
           
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado5'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_5" type="text" class="Estilo20" id="vr_cre_5" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_5" type="text" class="Estilo20" id="vr_deb_5" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp6" type="text" class="Estilo20" id="pgcp6" style="width:180px;" onkeyup="chk_pgcp6();" value=""/>
           
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado6'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_6" type="text" class="Estilo20" id="vr_cre_6" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_6" type="text" class="Estilo20" id="vr_deb_6" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp7" type="text" class="Estilo20" id="pgcp7" style="width:180px;" onkeyup="chk_pgcp7();" value=""/>
           
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado7'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_7" type="text" class="Estilo20" id="vr_cre_7" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_7" type="text" class="Estilo20" id="vr_deb_7" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp8" type="text" class="Estilo20" id="pgcp8" style="width:180px;" onkeyup="chk_pgcp8();" value=""/>
         
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado8'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_8" type="text" class="Estilo20" id="vr_cre_8" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_8" type="text" class="Estilo20" id="vr_deb_8" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp9" type="text" class="Estilo20" id="pgcp9" style="width:180px;" onkeyup="chk_pgcp9();" value=""/>
            
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado9'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_9" type="text" class="Estilo20" id="vr_cre_9" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_9" type="text" class="Estilo20" id="vr_deb_9" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp10" type="text" class="Estilo20" id="pgcp10" style="width:180px;" onkeyup="chk_pgcp10();" value=""/>
            
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado10'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_10" type="text" class="Estilo20" id="vr_cre_10" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_10" type="text" class="Estilo20" id="vr_deb_10" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp11" type="text" class="Estilo20" id="pgcp11" style="width:180px;" onkeyup="chk_pgcp11();" value=""/>
           
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado11'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_11" type="text" class="Estilo20" id="vr_cre_11" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_11" type="text" class="Estilo20" id="vr_deb_11" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp12" type="text" class="Estilo20" id="pgcp12" style="width:180px;" onkeyup="chk_pgcp12();" value=""/>
           
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado12'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_12" type="text" class="Estilo20" id="vr_cre_12" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_12" type="text" class="Estilo20" id="vr_deb_12" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp13" type="text" class="Estilo20" id="pgcp13" style="width:180px;" onkeyup="chk_pgcp13();" value=""/>
           
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado13'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_13" type="text" class="Estilo20" id="vr_cre_13" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_13" type="text" class="Estilo20" id="vr_deb_13" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp14" type="text" class="Estilo20" id="pgcp14" style="width:180px;" onkeyup="chk_pgcp14();" value=""/>
           
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado14'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_14" type="text" class="Estilo20" id="vr_cre_14" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_14" type="text" class="Estilo20" id="vr_deb_14" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp15" type="text" class="Estilo20" id="pgcp15" style="width:180px;" onkeyup="chk_pgcp15();" value=""/>
            
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado15'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_15" type="text" class="Estilo20" id="vr_cre_15" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_15" type="text" class="Estilo20" id="vr_deb_15" style="text-align:right" onkeypress="return validar(event)"  size="20" value="" onKeyUp="Calcular();"/>
            </div>
        </div></td>
      </tr>
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
              <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right"/>
            </div>
          </div>
        </div></td>
        <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right">
              <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right"/>
            </div>
          </div>
        </div></td>
      </tr>
      <tr>
        <td colspan="4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center">
            <input type="submit" name="Submit2" class="Estilo20" value="Grabar Recibo Oficial de Ingreso" onclick="this.form.action = 'comprobar_tot.php'" />
          </div>
        </div></td>
      </tr>
      <!--secciones de fila -->
      <!--secciones de fila -->
    </table></td>
  </tr>
  </form>

<?php
}
?>  
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
	  
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='recaudos_tesoreria.php' target='_parent'>VOLVER </a> </div>
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
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
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
}
?>