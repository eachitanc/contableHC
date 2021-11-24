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

<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
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
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
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
</style>

<script>
$(document).ready(function(){
$("#commentForm").validate();
});
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
		
	
</script>

<!--fin val forms--> 

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
    <td colspan="3">
	<div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>MODIFICA CAUSACION DE CARTERA </strong>
        <?
		
$cc=$_GET['id'];		


include('../config.php');
//id _emp				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $idxx=$rowxx["id_emp"];
}

$sql1 = "select * from cartera_cont where id_emp ='$idxx' and consec_cartera ='$cc'";
$resultado1 = mysql_db_query($database, $sql1, $connectionxx);

while($rw1 = mysql_fetch_array($resultado1)) 
{

$id_reip = $rw1["id_reip"];
$consecutivo_reip = $rw1["id_reip"];
$valor_rec = $rw1["valor_rec"];
$tercero = $rw1["tercero"];


$consec_cartera = $rw1["consec_cartera"];
$fecha_causa = $rw1["fecha_causa"];
$ref = $rw1["ref"];
$fecha_ven = $rw1["fecha_ven"];

$pgcp1 = $rw1["pgcp1"];
$pgcp2 = $rw1["pgcp2"];
$pgcp3 = $rw1["pgcp3"];
$pgcp4 = $rw1["pgcp4"];
$pgcp5 = $rw1["pgcp5"];
$pgcp6 = $rw1["pgcp6"];
$pgcp7 = $rw1["pgcp7"];
$pgcp8 = $rw1["pgcp8"];
$pgcp9 = $rw1["pgcp9"];
$pgcp10 = $rw1["pgcp10"];
$pgcp11 = $rw1["pgcp11"];
$pgcp12 = $rw1["pgcp12"];
$pgcp13 = $rw1["pgcp13"];
$pgcp14 = $rw1["pgcp14"];
$pgcp15 = $rw1["pgcp15"];

$des1 = $rw1["des1"];
$des2 = $rw1["des2"];
$des3 = $rw1["des3"];
$des4 = $rw1["des4"];
$des5 = $rw1["des5"];
$des6 = $rw1["des6"];
$des7 = $rw1["des7"];
$des8 = $rw1["des8"];
$des9 = $rw1["des9"];
$des10 = $rw1["des10"];
$des11 = $rw1["des11"];
$des12 = $rw1["des12"];
$des13 = $rw1["des13"];
$des14 = $rw1["des14"];
$des15 = $rw1["des15"];


$vr_deb_1 = $rw1["vr_deb_1"];
$vr_deb_2 = $rw1["vr_deb_2"];
$vr_deb_3 = $rw1["vr_deb_3"];
$vr_deb_4 = $rw1["vr_deb_4"];
$vr_deb_5 = $rw1["vr_deb_5"];
$vr_deb_6 = $rw1["vr_deb_6"];
$vr_deb_7 = $rw1["vr_deb_7"];
$vr_deb_8 = $rw1["vr_deb_8"];
$vr_deb_9 = $rw1["vr_deb_9"];
$vr_deb_10 = $rw1["vr_deb_10"];
$vr_deb_11 = $rw1["vr_deb_11"];
$vr_deb_12 = $rw1["vr_deb_12"];
$vr_deb_13 = $rw1["vr_deb_13"];
$vr_deb_14 = $rw1["vr_deb_14"];
$vr_deb_15 = $rw1["vr_deb_15"];

$vr_cre_1 = $rw1["vr_cre_1"];
$vr_cre_2 = $rw1["vr_cre_2"];
$vr_cre_3 = $rw1["vr_cre_3"];
$vr_cre_4 = $rw1["vr_cre_4"];
$vr_cre_5 = $rw1["vr_cre_5"];
$vr_cre_6 = $rw1["vr_cre_6"];
$vr_cre_7 = $rw1["vr_cre_7"];
$vr_cre_8 = $rw1["vr_cre_8"];
$vr_cre_9 = $rw1["vr_cre_8"];
$vr_cre_10 = $rw1["vr_cre_10"];
$vr_cre_11 = $rw1["vr_cre_11"];
$vr_cre_12 = $rw1["vr_cre_12"];
$vr_cre_13 = $rw1["vr_cre_13"];
$vr_cre_14 = $rw1["vr_cre_14"];
$vr_cre_15 = $rw1["vr_cre_15"];

$tot_deb = $rw1["tot_deb"];
$tot_cre = $rw1["tot_cre"];

}

?>
<?php 




$sql = "select distinct(fecha_reg) from reip_ing where id_emp ='$idxx' and consecutivo = '$consecutivo_reip'";
$resultado = mysql_db_query($database, $sql, $connectionxx);
while($row = mysql_fetch_array($resultado)) {  $fecha_reg=$row["fecha_reg"]; }

$sql2 = "select distinct(des) from reip_ing where id_emp ='$idxx' and consecutivo = '$consecutivo_reip'";
$resultado2 = mysql_db_query($database, $sql2, $connectionxx);
while($row2 = mysql_fetch_array($resultado2)) {  $des=$row2["des"]; }

$sql3 = "select distinct(tercero) from reip_ing where id_emp ='$idxx' and consecutivo = '$consecutivo_reip'";
$resultado3 = mysql_db_query($database, $sql3, $connectionxx);
while($row3 = mysql_fetch_array($resultado3)) {  $tercero=$row3["tercero"]; }

$sql3a = "select distinct(id_manu_reip) from reip_ing where id_emp ='$idxx' and consecutivo = '$consecutivo_reip'";
$resultado3a = mysql_db_query($database, $sql3a, $connectionxx);
while($row3a = mysql_fetch_array($resultado3a)) {  $id_manu_reip=$row3a["id_manu_reip"]; }

?>
      </div>
	</div>	</td>
  </tr>
  
  <form name="a" method="post" id="commentForm">
  <tr>
  <td colspan="3">
	<table width="780" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center" class="Estilo4"><strong>INFORMACION GENERAL DEL RECONOCIMIENTO </strong></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>No. del Reconocimiento </strong></div>
            </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><? printf("%s",$id_manu_reip);?>
                <input name="id_reip" type="hidden" value="<? printf("%s",$consecutivo_reip);?>" />
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="center"><strong>Fecha de Reconocimiento </strong></div>
            </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><? printf("%s",$fecha_reg);?></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Tercero</strong></div>
            </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="left" class="Estilo4"><? printf("%s",$tercero);?>
              <input name="tercero" type="hidden" id="tercero" value="<? printf("%s",$tercero);?>" />
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
            <div align="left" class="Estilo4"><? printf("%s",$des);?></div>
        </div></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFFFFF"><div class="Estilo4">
            <div align="center">
              <?php
//-------
				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from reip_ing where id_emp = '$idxx' and consecutivo ='$consecutivo_reip' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>

<table width='780'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='200'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Imputacion</b></span>
</div>
</td>
<td align='center' width='380'><span class='Estilo4'><b>Nombre</b></span></td>
<td align='center' width='200'><span class='Estilo4'><b>Valor</b></span></td>


</tr>


");

while($rw = mysql_fetch_array($re)) 
   {
printf("
<span class='Estilo4'>
<tr>


<td align='left' bgcolor='#F5F5F5'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>


<td align='left'><span class='Estilo4'> %s </span></td>
<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'> %.2f </span></td>



</tr>", $rw["cuenta"], $rw["nom_rubro"], $rw["valor"]); 


   }

printf("</table></center>");
//--------	
?>
            </div>
        </div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div class="Estilo4">
              <div align="center"><strong>Valor Total del Reconocimiento </strong></div>
            </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div class="Estilo4">
              <div align="center"> $
                <? printf("%.2f",$valor_rec);?>
                =
                <input name="valor_rec" type="text" id="valor_rec" value="<? printf("%.2f",$valor_rec);?>" />
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFFFFF"><span class="Estilo8">I</span></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>DATOS NECESARIOS PARA  LA CAUSACION DE CARTERA </strong></div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Consecutivo</strong></div>
          </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		  <div align="center"><span class="Estilo4"><? printf("%s",$consec_cartera);?>
		      <input name="consec_cartera" type="hidden" id="consec_cartera" value="<? printf("%s",$consec_cartera);?>" />
		      </span>		      </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>Fecha de Causacion </strong></div>
          </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">

            <? printf("%s",$fecha_causa);?>
            <input name="fecha_causa" type="hidden" id="fecha_causa" value="<? printf("%s",$fecha_causa);?>" />
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
            <div align="center">
              <input name="ref" type="text" class="required Estilo4" id="ref" onkeyup="a.ref.value=a.ref.value.toUpperCase();" size="60" value="<? printf("%s",$ref);?>" />
            </div>
          </div>
        </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Fecha de Vencimiento  </strong></div>
          </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center">(Mayor a la fecha de Causacion)</div>
          </div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center">
            <input name="fecha_ven" type="text" class="required Estilo4" id="fecha_ven" value="<? printf("%s",$fecha_ven);?>" size="12" />
             <span class="Estilo8">:::</span> 
             <input name="button" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].fecha_ven,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
          </div>
        </div></td>
        </tr>
      
      <tr>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
      </tr>
    </table>
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
</table> </td>
  </tr>
  <tr>
    <td colspan="3"><table width="1034" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo12">
              <div align="center"><strong>IMPORTANTE</strong><br />
                  <br />
                Si la cuenta que desea utilizar no aparece en el listado de CUENTAS P.G.C.P, posiblemente se encuentra BLOQUEADA. <br />
                Consulte el Item 4.2 del Menu Principal - Opcion &quot;Maestro P.G.C.P &quot; </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td colspan="5" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center" class="Estilo12"><strong>MOVIMIENTO CONTABLE </strong></div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo12"><strong>DIGITE CUENTA P.G.C.P </strong></div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo12"><strong>DATOS DE LA CUENTA</strong><strong></strong><br />
                <span class="Estilo4">Presione la barra espaciadora dentro de cada codigo para ver los datos de la cuenta </span> </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo12"><strong>VALOR DEBITO </strong></div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo12"><strong>VALOR CREDITO </strong></div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo12"><strong>No. Dcto / Cheque </strong></div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp1" type="text" class="Estilo12" id="pgcp1" style="width:180px;" onkeyup="chk_pgcp1();" value="<? printf("%s",$pgcp1);?>"/>
        </span> </div></td>
        <td><div align="left" class="Estilo4" id='resultado'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_1" type="text" class="Estilo12" id="vr_deb_1" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_1);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_1" type="text" class="Estilo12" id="vr_cre_1" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_1);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque1" type="text" class="Estilo12" id="cheque1" style="text-align:right" value="<? printf("%s",$cheque1);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp2" type="text" class="Estilo12" id="pgcp2" style="width:180px;" onkeyup="chk_pgcp2();" value="<? printf("%s",$pgcp2);?>"/>
        </span> </div></td>
        <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado2'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_2" type="text" class="Estilo12" id="vr_deb_2" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_2);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_2" type="text" class="Estilo12" id="vr_cre_2" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_2);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque2" type="text" class="Estilo12" id="cheque2" style="text-align:right" value="<? printf("%s",$cheque2);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp3" type="text" class="Estilo12" id="pgcp3" style="width:180px;" onkeyup="chk_pgcp3();" value="<? printf("%s",$pgcp3);?>"/>
        </span> </div></td>
        <td><div align="left" class="Estilo4" id='resultado3'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_3" type="text" class="Estilo12" id="vr_deb_3" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_3);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_3" type="text" class="Estilo12" id="vr_cre_3" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_3);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque3" type="text" class="Estilo12" id="cheque3" style="text-align:right" value="<? printf("%s",$cheque3);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp4" type="text" class="Estilo12" id="pgcp4" style="width:180px;" onkeyup="chk_pgcp4();" value="<? printf("%s",$pgcp4);?>"/>
        </span> </div></td>
        <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado4'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_4" type="text" class="Estilo12" id="vr_deb_4" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_4);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_4" type="text" class="Estilo12" id="vr_cre_4" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_4);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque4" type="text" class="Estilo12" id="cheque4" style="text-align:right" value="<? printf("%s",$cheque4);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp5" type="text" class="Estilo12" id="pgcp5" style="width:180px;" onkeyup="chk_pgcp5();" value="<? printf("%s",$pgcp5);?>"/>
        </span> </div></td>
        <td><div align="left" class="Estilo4" id='resultado5'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_5" type="text" class="Estilo12" id="vr_deb_5" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_5);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_5" type="text" class="Estilo12" id="vr_cre_5" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_5);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque5" type="text" class="Estilo12" id="cheque5" style="text-align:right" value="<? printf("%s",$cheque5);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp6" type="text" class="Estilo12" id="pgcp6" style="width:180px;" onkeyup="chk_pgcp6();" value="<? printf("%s",$pgcp6);?>"/>
        </span> </div></td>
        <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado6'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_6" type="text" class="Estilo12" id="vr_deb_6" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_6);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_6" type="text" class="Estilo12" id="vr_cre_6" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_6);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque6" type="text" class="Estilo12" id="cheque6" style="text-align:right" value="<? printf("%s",$cheque6);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp7" type="text" class="Estilo12" id="pgcp7" style="width:180px;" onkeyup="chk_pgcp7();" value="<? printf("%s",$pgcp7);?>"/>
        </span> </div></td>
        <td><div align="left" class="Estilo4" id='resultado7'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_7" type="text" class="Estilo12" id="vr_deb_7" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_7);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_7" type="text" class="Estilo12" id="vr_cre_7" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_7);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque7" type="text" class="Estilo12" id="cheque7" style="text-align:right" value="<? printf("%s",$cheque7);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp8" type="text" class="Estilo12" id="pgcp8" style="width:180px;" onkeyup="chk_pgcp8();" value="<? printf("%s",$pgcp8);?>"/>
        </span> </div></td>
        <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado8'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_8" type="text" class="Estilo12" id="vr_deb_8" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_8);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_8" type="text" class="Estilo12" id="vr_cre_8" style="text-align:right" onkeypress="return validar(event)" /value="<? printf("%s",$vr_cre_8);?>"  onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque8" type="text" class="Estilo12" id="cheque8" style="text-align:right" value="<? printf("%s",$cheque8);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp9" type="text" class="Estilo12" id="pgcp9" style="width:180px;" onkeyup="chk_pgcp9();" value="<? printf("%s",$pgcp9);?>"/>
        </span> </div></td>
        <td><div align="left" class="Estilo4" id='resultado9'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_9" type="text" class="Estilo12" id="vr_deb_9" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_9);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_9" type="text" class="Estilo12" id="vr_cre_9" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_9);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque9" type="text" class="Estilo12" id="cheque9" style="text-align:right" value="<? printf("%s",$cheque9);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp10" type="text" class="Estilo12" id="pgcp10" style="width:180px;" onkeyup="chk_pgcp10();" value="<? printf("%s",$pgcp10);?>"/>
        </span> </div></td>
        <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado10'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_10" type="text" class="Estilo12" id="vr_deb_10" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_10);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_10" type="text" class="Estilo12" id="vr_cre_10" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_10);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque10" type="text" class="Estilo12" id="cheque10" style="text-align:right" value="<? printf("%s",$cheque10);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp11" type="text" class="Estilo12" id="pgcp11" style="width:180px;" onkeyup="chk_pgcp11();" value="<? printf("%s",$pgcp11);?>"/>
        </span> </div></td>
        <td><div align="left" class="Estilo4" id='resultado11'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_11" type="text" class="Estilo12" id="vr_deb_11" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_11);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_11" type="text" class="Estilo12" id="vr_cre_11" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_11);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque11" type="text" class="Estilo12" id="cheque11" style="text-align:right" value="<? printf("%s",$cheque11);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp12" type="text" class="Estilo12" id="pgcp12" style="width:180px;" onkeyup="chk_pgcp12();" value="<? printf("%s",$pgcp12);?>"/>
        </span> </div></td>
        <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado12'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_12" type="text" class="Estilo12" id="vr_deb_12" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_12);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_12" type="text" class="Estilo12" id="vr_cre_12" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_12);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque12" type="text" class="Estilo12" id="cheque122" style="text-align:right" value="<? printf("%s",$cheque12);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp13" type="text" class="Estilo12" id="pgcp13" style="width:180px;" onkeyup="chk_pgcp13();" value="<? printf("%s",$pgcp13);?>"/>
        </span> </div></td>
        <td><div align="left" class="Estilo4" id='resultado13'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_13" type="text" class="Estilo12" id="vr_deb_13" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_13);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_13" type="text" class="Estilo12" id="vr_cre_13" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_13);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque13" type="text" class="Estilo12" id="cheque13" style="text-align:right" value="<? printf("%s",$cheque13);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp14" type="text" class="Estilo12" id="pgcp14" style="width:180px;" onkeyup="chk_pgcp14();" value="<? printf("%s",$pgcp14);?>"/>
        </span> </div></td>
        <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado14'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_14" type="text" class="Estilo12" id="vr_deb_14" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_14);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_14" type="text" class="Estilo12" id="vr_cre_14" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_14);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque14" type="text" class="Estilo12" id="cheque14" style="text-align:right" value="<? printf("%s",$cheque14);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
            <input name="pgcp15" type="text" class="Estilo12" id="pgcp15" style="width:180px;" onkeyup="chk_pgcp15();" value="<? printf("%s",$pgcp15);?>"/>
        </span> </div></td>
        <td><div align="left" class="Estilo4" id='resultado15'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_deb_15" type="text" class="Estilo12" id="vr_deb_15" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_deb_15);?>" onKeyUp="Calcular();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="vr_cre_15" type="text" class="Estilo12" id="vr_cre_15" style="text-align:right" onkeypress="return validar(event)" value="<? printf("%s",$vr_cre_15);?>" onKeyUp="Calcularc();"/>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo12">
              <div align="center">
                <input name="cheque15" type="text" class="Estilo12" id="cheque15" style="text-align:right" value="<? printf("%s",$cheque15);?>"/>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td width="190" bgcolor="#990000">&nbsp;</td>
        <td width="420" bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right" class="Estilo8 Estilo9">
            <div align="center"><strong>VERIFIQUE QUE LAS SUMAS SEAN IGUALES ANTES DE GRABAR</strong></div>
          </div>
        </div></td>
        <td width="130" bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right">
              <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right"/>
            </div>
          </div>
        </div></td>
        <td width="130" bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right">
              <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right"/>
            </div>
          </div>
        </div></td>
        <td width="130" bgcolor="#990000">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="5"><div class="Estilo19" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center">
            <input name="Submit" type="submit" class="Estilo20" value="Grabar Modificaciones Causacion de Cartera" onclick="this.form.action = 'proc_modi_cartera.php'" />
          </div>
        </div></td>
      </tr>
    </table></td>
  </tr>
  </form>
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

<center class='Estilo4'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='CAIC'>
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