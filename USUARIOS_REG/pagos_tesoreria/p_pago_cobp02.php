<?php
session_start();
if(!$_SESSION["login"])
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
<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo13 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; font-style: italic; }
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo14 {color: #66CCCC}
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
var pos_url = 'comprueba_cta2.php';
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
var pos_url = 'comprueba_cta3.php';
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
var pos_url = 'comprueba_cta4.php';
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
var pos_url = 'comprueba_cta5.php';
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
var pos_url = 'comprueba_cta6.php';
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
var pos_url = 'comprueba_cta7.php';
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
var pos_url = 'comprueba_cta8.php';
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
var pos_url = 'comprueba_cta9.php';
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
var pos_url = 'comprueba_cta10.php';
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
var pos_url = 'comprueba_cta11.php';
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
var pos_url = 'comprueba_cta12.php';
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
var pos_url = 'comprueba_cta13.php';
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
var pos_url = 'comprueba_cta14.php';
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
var pos_url = 'comprueba_cta15.php';
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
.Estilo13 {color: #F5F5F5}
.Estilo13 {	color: #990000;
	font-style: italic;
} 
</style>

<script>
$(document).ready(function(){
$("#commentForm").validate();
}); 
</script>

<script>
function chk_ceva(){
var pos_url = '../comprobadores/comprueba_ceva.php';
var cod = document.getElementById('id_manu_ceva').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('res_ceva').innerHTML = req.responseText;
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
		
	
</script>
<!--fin val forms--> 

<script>
var par=false;
function parpadeo() {
	document.getElementById('txt').style.visibility= (par) ? 'visible' : 'hidden';
	par = !par;
}
</script>

</head>

<body onload="setInterval('parpadeo()',1000)">
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center">
              <?php
printf("

<center class='Estilo4'>
<form method='post' action='pagos_tesoreria.php'>
<input type='hidden' name='nn' value='CEVA'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");

?>
            </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>
        <?php 

include('../objetos/redondear.php');
include('../config.php');

$id_cobp=$_POST['id_cobp'];
if (!$_POST["id_cobp"])
{
$id_cobp=$_GET["id0"];
}			
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// id_emp
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $idxx=$rowxx["id_emp"];
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}

// info 
$sqlxx3 = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_cobp'";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{
  $id_manu_cobp=$rowxx3["id_manu_cobp"];
  $id_auto_cobp=$rowxx3["id_auto_cobp"];
  $a2x=$rowxx3["id_auto_cobp"];
  $id_auto_crpp=$rowxx3["id_auto_crpp"];
  $fecha_cobp=$rowxx3["fecha_cobp"];
  $des_cobp=$rowxx3["des_cobp"];
  $ref=$rowxx3["ref"];
  
}


// info 
$sqlxx4 = "select * from crpp where id_emp = '$id_emp' and id_auto_crpp = '$id_auto_crpp'";
$resultadoxx4 = mysql_db_query($database, $sqlxx4, $connectionxx);

while($rowxx4 = mysql_fetch_array($resultadoxx4)) 
{
  $id_auto_crpp=$rowxx4["id_auto_crpp"];
  $a1x=$rowxx4["id_auto_crpp"];
  $id_manu_crpp=$rowxx4["id_manu_crpp"];
  $fecha_crpp=$rowxx4["fecha_crpp"];
  $tercero=$rowxx4["tercero"];
  $ter_nat=$rowxx4["ter_nat"];
  $ter_jur=$rowxx4["ter_jur"];
  $pago=$rowxx4["pago"];
}  
  
  ?>

        COMPROBANTE DE EGRESO VIGENCIA ACTUAL </strong></div>
	</div>	</td>
  </tr>
  
  <form name="a" method="post" id="commentForm">

    <tr>
  <td colspan="3">
	<table width="800" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
      </tr>
     
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4"><strong>DATOS GENERALES DEL COMPROMISO PRESUPUESTAL </strong></div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="right">
			
			<strong>Codigo CRPP : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4"><?php printf("%s",$id_manu_crpp);?>
		
              <input name="id_cobp" type="hidden" value="<?php printf("%s",$id_cobp);?>" />
			  
			  <input name="id_manu_crpp" type="hidden" value="<?php printf("%s",$id_manu_crpp);?>" />
              <input name="id_auto_crpp" type="hidden" value="<?php printf("%s",$id_auto_crpp);?>" />
          </div>
        </div></td>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Fecha CRPP : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4"><?php printf("%s",$fecha_crpp);?>
              <input name="fecha_crpp" type="hidden" id="fecha_crpp" value="<?php printf("%s",$fecha_crpp);?>" />
          </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>A Favor de  : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left"><?php printf("%s",$tercero);?>
              <input name="tercero" type="hidden" id="tercero" value="<?php printf("%s",$tercero);?>" />
              </div>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>C.C. / NIT  : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left">
			
			<?php

$sql3 = "select * from recaudo_ncbt where id_recau='$id' and id_emp='$id_emp' limit 1 ";
$resultado3 = mysql_db_query($database, $sql3, $connectionxx);

while($row3 = mysql_fetch_array($resultado3)) 
{
  $ter_nat=$row3["ter_nat"];
  $ter_jur=$row3["ter_jur"];
}
//printf("%s<br>%s",$ter_nat, $ter_jur);
$sql4 = "select * from terceros_naturales where id='$ter_nat' and id_emp='$id_emp' ";
$resultado4 = mysql_db_query($database, $sql4, $connectionxx);

while($row4 = $resultado4->fetch_assoc()) 
{
  $num_id=$row4["num_id"];
  
}



$sql5 = "select * from terceros_juridicos where id='$ter_jur' and id_emp='$id_emp' ";
$resultado5 = mysql_db_query($database, $sql5, $connectionxx);

while($row5 = mysql_fetch_array($resultado5)) 
{
  $num_id2=$row5["num_id2"];
  
}


$ccnit=$num_id.$num_id2;
printf("%s",$ccnit);
	?>
			
              <input name="ccnit" type="hidden" id="ccnit" value="<?php printf("%s",$ccnit);?>" />
              </div>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Tipo de Pago  : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left">
              <?php printf("%s",$pago); ?>
              <input name="pago" type="hidden" id="pago" value="<?php printf("%s",$pago);?>" />
            </div>
          </div>
        </div></td>
        </tr>
    </table>
	<br />
	<div align="center"><?php

	
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from crpp where id_emp ='$id_emp' and id_auto_crpp ='$a1x' order by id asc ";
$re = $cx->query($sq);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='4'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<div align='center' class='Estilo4'><strong>IMPUTACION PRESUPUESTAL DEL REGISTRO</strong></div>
</div>
</td>
</tr>

<tr bgcolor='#F5F5F5'>
<td align='center' width='225'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>

<td align='center' width='325'><span class='Estilo4'><b>DESCRIPCION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>FTE FINANCIACION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>VALOR</b></span></td>
</tr>
");

$nuevo_total=0;

while($rw = $re->fetch_assoc()) 
   {
   
$cta = $rw["cuenta"];

$sq2 = "select proc_rec, nom_rubro from car_ppto_gas  where id_emp = '$id_emp' and cod_pptal ='$cta' order by id asc ";
$re2 = $cx->query($sq2);   
while($rw2 = $re2->fetch_assoc())
{

	$fte = $rw2["proc_rec"];  
	$nom_rubro = $rw2["nom_rubro"];  
	
}
if($fte == 'P')
{
$fte='PROPIO';
}
else
{
$fte='ADMINISTRADO';
}

printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %.2f &nbsp; </span></td>

</tr>

", $rw["cuenta"], $nom_rubro, $fte, $rw["vr_digitado"]); 

$nuevo_total=$nuevo_total + $rw["vr_digitado"];

   }

printf("


  <tr bgcolor='#F5F5F5'>
    <td colspan='2'>&nbsp;</td>
	<td align='center'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>VALOR TOTAL</b> </span>
	</div>
	</td>
    <td align='right'><span class='Estilo4'><b> %.2f &nbsp;</b> </span></td>
  </tr>
</table></center>",$nuevo_total);
//--------	

	?>
	</div>
	<br />
	<table width="800" border="1" align="center" class="bordepunteado1">
	  <tr>
	    <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4"><strong>DATOS DE LA OBLIGACION PRESUPUESTAL QUE AFECTA </strong></div>
	      </div></td>
	    </tr>
	  <tr>
	    <td width="200" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Codigo COBP : </strong></div>
          </div>
	      </div></td>
	    <td width="200" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4"><?php printf("%s",$id_manu_cobp);?>
              <input name="id_manu_cobp" type="hidden" value="<?php printf("%s",$id_manu_cobp);?>" />
              <input name="id_auto_cobp" type="hidden" id="id_auto_cobp" value="<?php printf("%s",$id_auto_cobp);?>" />
          </div>
	      </div></td>
	    <td width="200" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Fecha COBP : </strong></div>
          </div>
	      </div></td>
	    <td width="200" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4"><?php printf("%s",$fecha_cobp);?>
              <input name="fecha_cobp" type="hidden" value="<?php printf("%s",$fecha_cobp);?>" />
          </div>
	      </div></td>
	    </tr>
	  <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Concepto COBP   : </strong></div>
            </div>
        </div></td>
	    <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left"> <?php printf("%s",$des_cobp); ?>
                  <input name="des_cobp" type="hidden" id="des_cobp" value="<?php printf("%s",$des_cobp);?>" />
              </div>
            </div>
	      </div></td>
	    </tr>
	  <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Referencia COBP   : </strong></div>
            </div>
        </div></td>
	    <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left"> <?php printf("%s",$ref); ?>
                  <input name="ref" type="hidden" id="ref" value="<?php printf("%s",$ref);?>" />
              </div>
            </div>
	      </div></td>
	    </tr>
    </table>
	<br />


	<div align="center"></div>
	<div align="center"><?php
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp ='$a2x' order by id asc ";
$re = $cx->query($sq);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='4'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<div align='center' class='Estilo4'><strong>IMPUTACION PRESUPUESTAL DE LA OBLIGACION</strong></div>
</div>
</td>
</tr>

<tr bgcolor='#F5F5F5'>
<td align='center' width='225'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>

<td align='center' width='325'><span class='Estilo4'><b>DESCRIPCION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>FTE FINANCIACION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>VALOR</b></span></td>
</tr>
");

$nuevo_total=0;
while($rw = $re->fetch_assoc()) 
   {
   
$cta = $rw["cuenta"];

$sq2 = "select proc_rec, nom_rubro from car_ppto_gas  where id_emp = '$id_emp' and cod_pptal ='$cta' order by id asc ";
$re2 = $cx->query($sq2);   
while($rw2 = $re2->fetch_assoc())
{

	$fte = $rw2["proc_rec"];  
	$nom_rubro = $rw2["nom_rubro"];  
	
}
if($fte == 'P')
{
$fte='PROPIO';
}
else
{
$fte='ADMINISTRADO';
}

printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %.2f &nbsp; </span></td>

</tr>

", $rw["cuenta"], $nom_rubro, $fte, $rw["vr_digitado"]); 

$nuevo_total=$nuevo_total + $rw["vr_digitado"];
   }

printf("

  <tr bgcolor='#F5F5F5'>
    <td colspan='2'>&nbsp;</td>
	<td align='center'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>VALOR TOTAL</b> </span>
	</div>
	</td>
    <td align='right'><span class='Estilo4'><b> %.2f &nbsp;</b> </span></td>
  </tr>
</table></center>",$nuevo_total);

//--------	
 if($_POST['fecha_ceva']){
	  $fechat = $_POST['fecha_ceva'];
	}else{$fechat = date('Y/m/d');}
    if($_POST['des_ceva']){
	  $desseva = $_POST['des_ceva'];
	}else{$desseva = $des_cobp;}
	?>
	  </div>	  </td>
  </tr>
  <tr>
  <td colspan="3">
  <br />
  <table width="800" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo4"><strong>DATOS DEL COMPROBANTE DE EGRESO </strong></div>
      </div></td>
    </tr>
    <tr>
      <td width="200" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right"><strong>Fecha CEVA   : </strong></div>
        </div>
      </div></td>
      <td colspan="2" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="left">
          <input name="fecha_ceva" type="text" class="required Estilo12" id="fecha_ceva" value="<?php echo $fechat;?>" size="12" />
          <span class="Estilo8">:::</span>
          <input name="button2" type="button" class="Estilo12" onclick="displayCalendar(document.a.fecha_ceva,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
        </div>
      </div></td>
      <td width="200" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>No. de CEVA (Automatico)  : </strong></div>
          </div>
      </div></td>
      <td width="200" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <?php

new mysqli($server, $dbuser, $dbpass, $database);
$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'ceva'");
while($array = $resulta->fetch_assoc()) 
{
$conse = $array[Auto_increment];
}

?>
            <?php printf("%s",$conse);?>
            <input name="id_auto_ceva" type="hidden" class="Estilo12" id="id_auto_ceva" value="<?php printf("%s",$conse);?>"/>
          </div>
      </div></td>
      <td width="200" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Digite Numero de CEVA: </strong></div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="id_manu_ceva" type="text" class="required Estilo4" id="id_manu_ceva" style="text-align:center" onkeypress="return validar(event)" 
			  value="<?php $id_manu_ceva = $_POST['id_manu_ceva']; printf("%s",$id_manu_ceva); ?>" onkeyup="chk_ceva();" />
			  <br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		<div class="Estilo4" align="center" id='res_ceva'></div>
		</div>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Descripcion CEVA   : </strong></div>
          </div>
      </div></td>
      <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="left" class="Estilo20">
          <input name="des_ceva" type="text" class="required Estilo20" id="des_ceva" onkeyup="a.des_ceva.value=a.des_ceva.value.toUpperCase();" value="<?php echo $desseva; ?>" style="width:550px;" />
        </div>
      </div></td>
      </tr>
    
    <tr>
      <td colspan="4" bgcolor="#66CCCC"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo12">
          <div align="center"><strong>Si el pago a realizar no tiene IVA, deje la casilla en BLANCO,<BR /> 
          caso contrario, Digite Tarifa del IVA ( Ejemplo : 0.16 )<br /><BR /> </strong>
              <input name="iva" type="text" class="Estilo12" id="iva" style="text-align:center" onkeypress="return validar(event)" value="<?php $iva=$_POST['iva']; printf("%s",$iva); ?>" />
              <span class="Estilo14">:::</span>
              <input name="Submit2" type="submit" class="Estilo4" value="Calcular valores del Comprobante de Egreso" onclick="this.form.action = 'p_pago_cobp.php'" />
          </div>
        </div>
      </div></td>
      </tr>
  </table>
  <br />
  <div align="center">
      <?php
	  


	  
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp ='$a2x' order by id asc ";
$re = $cx->query($sq);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='5'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<div align='center' class='Estilo4'><strong>VALORES DEL COMPROBANTE DE EGRESO</strong></div>
</div>
</td>
</tr>


<tr bgcolor='#F5F5F5'>
<td align='center' width='140'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>

<td align='center' width='300'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center' width='120'><span class='Estilo4'><b>VR x PAGAR + IVA</b></span></td>
<td align='center' width='120'><span class='Estilo4'><b>VR x PAGAR - IVA</b></span></td>
<td align='center' width='120'><span class='Estilo4'><b>VR DEL IVA</b></span></td>
</tr>
");


$vr1x=0;
$vr2x=0;
$vr3x=0;

while($rw = $re->fetch_assoc()) 
   {

//***** CONSULTA SITUACION DE FONDOS  - NOM_CUENTA 
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

//***	  
	  
$new_iva= $iva+1;
$vr_sin_iva=$rw["vr_digitado"]/$new_iva;
$vr_iva=$rw["vr_digitado"]-$vr_sin_iva;

//***

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

<td align='left'><span class='Estilo4'> &nbsp; %s </span></td>

<!--vr x obligar-->


<td align='right'><span class='Estilo4'>  %s &nbsp;</span></td>

<!--vr x obligar sin iva-->

<td align='right'><span class='Estilo4'> %.2f &nbsp; </span></td>

<!--vr del iva-->

<td align='right'><span class='Estilo4'> %.2f &nbsp; </span></td>

</tr>", $rw["cuenta"], $nom_cuenta, $rw["vr_digitado"], $vr_sin_iva , $vr_iva); 


$vr1x= $vr1x + $rw["vr_digitado"];
$vr2x= $vr2x + $vr_sin_iva;
$vr3x= $vr3x + $vr_iva;


}

printf("
<tr bgcolor='#F5F5F5'>
<td colspan ='2' align='right'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>  TOTALES &nbsp;</span>
</div>
</td>
<td align='right'><span class='Estilo4'> <b>%.2f&nbsp;&nbsp;</b> </span></td>
<td align='right'><span class='Estilo4'> <b>%.2f &nbsp;</b> </span></td>
<td align='right'><span class='Estilo4'> <b>%.2f &nbsp;</b> </span></td>
</tr>
</table></center>", $vr1x,$vr2x,$vr3x);
//--------	

	?>
     
  </div>
  <br />

  <table width="800" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo12"><strong> DESCUENTOS Y DEDUCCIONES </strong></div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Salud </strong>(<span class="Estilo13">Digitar) </span><strong>: </strong></div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="salud" type="text" class="Estilo12" id="salud" style="text-align:right" onkeypress="return validar(event)" value="<?php $salud = $_POST['salud'];  printf("%.0f",$salud);	 ?>" />
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Pension </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="pension" type="text" class="Estilo12" id="pension" style="text-align:right" onkeypress="return validar(event)" value="<?php $pension = $_POST['pension'];  printf("%.0f",$pension);	 ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Libranzas </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="libranza" type="text" class="Estilo12" id="libranza" style="text-align:right" onkeypress="return validar(event)" value="<?php $libranza = $_POST['libranza'];  printf("%.0f",$libranza);	 ?>" />
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Fondo Solidaridad </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="f_solidaridad" type="text" class="Estilo12" id="f_solidaridad" style="text-align:right" onkeypress="return validar(event)" value="<?php $f_solidaridad = $_POST['f_solidaridad'];  printf("%.0f",$f_solidaridad);	 ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Fondo Empleados </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
          </div>
      </div></td>
      <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="f_empleados" type="text" class="Estilo12" id="f_empleados" style="text-align:right" onkeypress="return validar(event)" value="<?php $f_empleados = $_POST['f_empleados'];  printf("%.0f",$f_empleados);	 ?>" />
            </div>
          </div>
      </div></td>
      <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Sindicatos </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
          </div>
      </div></td>
      <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="sindicato" type="text" class="Estilo12" id="sindicato" style="text-align:right" onkeypress="return validar(event)" value="<?php $sindicato = $_POST['sindicato'];  printf("%.0f",$sindicato);	 ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Embargos Judiciales </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="embargo" type="text" class="Estilo12" id="embargo" style="text-align:right" onkeypress="return validar(event)" value="<?php $embargo = $_POST['embargo'];  printf("%.0f",$embargo);	 ?>" />
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Cruce de Cuentas </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="cruce" type="text" class="Estilo12" id="cruce" style="text-align:right" onkeypress="return validar(event)" value="<?php $cruce = $_POST['cruce'];  printf("%.0f",$cruce);	 ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Otros </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> </strong><strong>: </strong></div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="otros" type="text" class="Estilo12" id="otros" style="text-align:right" onkeypress="return validar(event)" value="<?php $otros = $_POST['otros'];  printf("%.0f",$otros);	 ?>" />
            </div>
          </div>
      </div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <?php
$sqlxx2 = "select * from modo_estampillas";
$resultadoxx2 = $connectionxx->query($sqlxx2);
while($rowxx2 = $resultadoxx2->fetch_assoc()) 
   {
   $auto=$rowxx2["auto"];
   $manu=$rowxx2["manu"];
   }
if($auto=='SI' and $manu=='NO')
{   
?>
  <br />
  <table width="800" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo12"><strong> RETENCIONES POR IMPUESTOS, TASAS Y CONTRIBUCIONES </strong>...::: automatico :::... </div>
      </div></td>
    </tr>
    <tr>
      <td width="410"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>ReteFuente</strong></div>
          </div>
      </div></td>
      <td width="130"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>BASE</strong></div>
          </div>
      </div></td>
      <td width="130"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Tarifa </strong></div>
          </div>
      </div></td>
      <td width="130"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Valor a Retener</strong></div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
            <select name="retefuente" class="Estilo12" id="retefuente" style="width: 300px;">
              <option value=""></option>
              <?php 
   $retefuente = $_POST['retefuente'];		  
   include('../config.php');
   $query="SELECT * FROM retefuente";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$retefuente) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <?php 
			  $r=0;
			  $sqlxb = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$retefuente'";
						$resxb = mysql_db_query($database, $sqlxb, $connectionxx);
							while($rowxb = mysql_fetch_array($resxb)) 
							{
								$base =$rowxb["base"]; 
								$tope =$rowxb["tope"];
								$tarifa =$rowxb["tarifa"]; 
								if ($nuevo_total >= $base and ($nuevo_total <= $tope or $tope==''))
									{
										$vr_retefuente = redondear_dos_decimal($vr2x * $tarifa); 
										$vr_aut_reten[$r]=$vr_retefuente;
										$r++;
										$base_retefuente = $base;
									    $tope_rete = $tope;
									    $tarifa_retefuente =$tarifa;
									}else{
									 $vr_retefuente = 0;
									 $vr_aut_reten[$r]=$vr_retefuente;
									 $r++;
									}
							}
echo number_format($base_retefuente,2,',','.');
//printf("%.0f",$a_partir_retefuente);
?>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"> <?php printf("%s",$tarifa_retefuente);//echo number_format($tarifa_retefuente,2,',','.'); //printf("%s",$tarifa_retefuente);?> </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
             
              <input name="vr_retefuente" type="text" class="Estilo12" id="vr_retefuente" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f",$vr_retefuente); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>ReteIVA</strong></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
            <select name="reteiva" class="Estilo12" id="reteiva" style="width: 300px;">
              <option value=""></option>
              <?php 
   $reteiva = $_POST['reteiva'];		  
   include('../config.php');
   $query="SELECT * FROM reteiva";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$reteiva) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <?php 
					$sqlxb = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$reteiva'";
						$resxb = mysql_db_query($database, $sqlxb, $connectionxx);
							while($rowxb = mysql_fetch_array($resxb)) 
							{
								$base =$rowxb["base"];
								$tope =$rowxb["tope"];
								$tarifa =$rowxb["tarifa"];
								if ($nuevo_total >= $base and ($nuevo_total <= $tope or $tope==''))
									{
										$vr_reteiva = redondear_dos_decimal($vr3x * $tarifa);
										$vr_aut_reten[$r]=$vr_reteiva;
										$r++;
										$a_partir_reteiva = $base;
									    $tope_iva = $tope;
									    $tarifa_reteiva =$tarifa;
									}else{
									 $vr_reteiva = 0;
									 $vr_aut_reten[$r]=$vr_reteiva;
									 $r++;
									}
							}
echo number_format($a_partir_reteiva,2,',','.');
//printf("%.0f",$a_partir_reteiva);
?>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"> <?php printf("%s",$tarifa_reteiva);//echo number_format($tarifa_reteiva,2,',','.'); //printf("%s",$tarifa_reteiva); ?> </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="vr_reteiva" type="text" class="Estilo12" id="vr_reteiva" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f",$vr_reteiva); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>ReteICA</strong><strong> / Otro</strong></div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center"><span class="Estilo4">
            <input name="reteica" type="text" class="Estilo4" id="reteica" readonly size="57"
			value="<?php print "RETE ICA"; ?>" />
          </span></div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="a_partir_reteica" type="text" class="Estilo12" id="a_partir_reteica" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $a_partir_reteica=$_POST['a_partir_reteica']; printf("%s",$a_partir_reteica); ?>" />
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="tarifa_reteica" type="text" class="Estilo12" id="tarifa_reteica" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $tarifa_reteica=$_POST['tarifa_reteica']; printf("%s",$tarifa_reteica); ?>" />
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="vr_reteica" type="text" class="Estilo12" id="vr_reteica" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $vr_reteica=$_POST['vr_reteica']; printf("%s",$vr_reteica); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 1</strong></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
            <select name="estampilla1" class="Estilo12" id="estampilla1" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla1 = $_POST['estampilla1'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla1) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
               <?php 
$sqlxd = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla1'";
						$resxd = mysql_db_query($database, $sqlxd, $connectionxx);
							while($rowxd = mysql_fetch_array($resxd)) 
							{
								$base =$rowxd["base"];
							    $tope =$rowxd["tope"];
							    $tarifa =$rowxd["tarifa"];
							    if ($nuevo_total >= $base and ($nuevo_total <= $tope or $tope==''))
								  {
									$vr_estampilla1 = redondear_dos_decimal($vr1x * $tarifa);
									$vr_aut_reten[$r]=$vr_estampilla1;
									$r++;
									$base_e1 = $base;
									$tope_e1 = $tope;
									$tarifa_e1 =$tarifa;
							  	  }else{
								   $vr_estampilla1=0;
									$vr_aut_reten[$r]=$vr_estampilla1;
									$r++;								 
								 }				  
						    }	

echo number_format($base_e1,2,',','.');
//printf("%s",$a_partir_estampilla1);
?>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"> <?php printf("%s",$tarifa_e1);//echo number_format($tarifa_estampilla1,2,',','.'); //printf("%s",$tarifa_estampilla1); ?> </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
            

              <input name="vr_estampilla1" type="text" class="Estilo12" id="vr_estampilla1" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f",$vr_estampilla1); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 2</strong></div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
            <select name="estampilla2" class="Estilo12" id="estampilla2" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla2 = $_POST['estampilla2'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla2) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
             <?php 
$sqlxd = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla2'";
						$resxd = mysql_db_query($database, $sqlxd, $connectionxx);
							while($rowxd = mysql_fetch_array($resxd)) 
							{
								$base =$rowxd["base"];
							    $tope =$rowxd["tope"];
							    $tarifa =$rowxd["tarifa"];
							    if ($nuevo_total >= $base and ($nuevo_total <= $tope or $tope==''))
								  {
									$vr_estampilla2 = redondear_dos_decimal($vr1x * $tarifa);
									$vr_aut_reten[$r]=$vr_estampilla2;
									$r++;
									$base_e2 = $base;
									$tope_e2 = $tope;
									$tarifa_e2 =$tarifa;
							  	  }else{
								   $vr_estampilla2=0;
									$vr_aut_reten[$r]=$vr_estampilla2;
									$r++;								 
								 }				  
						    }	

echo number_format($base_e2,2,',','.');
//printf("%s",$a_partir_estampilla1);
?>

            </div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"> <?php printf("%s",$tarifa_e2);//echo number_format($tarifa_estampilla2,2,',','.'); //printf("%s",$tarifa_estampilla2); ?> </div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              
              <input name="vr_estampilla2" type="text" class="Estilo12" id="vr_estampilla2" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f",$vr_estampilla2); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 3</strong></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
            <select name="estampilla3" class="Estilo12" id="estampilla3" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla3 = $_POST['estampilla3'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla3) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
                <?php 
$sqlxd = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla3'";
						$resxd = mysql_db_query($database, $sqlxd, $connectionxx);
							while($rowxd = mysql_fetch_array($resxd)) 
							{
								$base =$rowxd["base"];
							    $tope =$rowxd["tope"];
							    $tarifa =$rowxd["tarifa"];
							    if ($nuevo_total >= $base and ($nuevo_total <= $tope or $tope==''))
								  {
									$vr_estampilla3 = redondear_dos_decimal($vr1x * $tarifa);
									$vr_aut_reten[$r]=$vr_estampilla3;
									$r++;
									$base_e3 = $base;
									$tope_e3 = $tope;
									$tarifa_e3 =$tarifa;
							  	  }else{
								   $vr_estampilla3=0;
									$vr_aut_reten[$r]=$vr_estampilla3;
									$r++;								 
								 }				  
						    }	

echo number_format($base_e3,2,',','.');
//printf("%s",$a_partir_estampilla1);
?>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"> <?php printf("%s",$tarifa_e3);//echo number_format($tarifa_estampilla3,2,',','.'); //printf("%s",$tarifa_estampilla3); ?> </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              
              <input name="vr_estampilla3" type="text" class="Estilo12" id="vr_estampilla3" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f",$vr_estampilla3); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 4 </strong></div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
            <select name="estampilla4" class="Estilo12" id="estampilla4" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla4 = $_POST['estampilla4'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla4) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
             <?php 
$sqlxd = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla4'";
						$resxd = mysql_db_query($database, $sqlxd, $connectionxx);
							while($rowxd = mysql_fetch_array($resxd)) 
							{
								$base =$rowxd["base"];
							    $tope =$rowxd["tope"];
							    $tarifa =$rowxd["tarifa"];
							    if ($nuevo_total >= $base and ($nuevo_total <= $tope or $tope==''))
								  {
									$vr_estampilla4 = redondear_dos_decimal($vr1x * $tarifa);
									$vr_aut_reten[$r]=$vr_estampilla4;
									$r++;
									$base_e4 = $base;
									$tope_e4 = $tope;
									$tarifa_e4 =$tarifa;
							  	  }else{
								   $vr_estampilla4=0;
									$vr_aut_reten[$r]=$vr_estampilla4;
									$r++;								 
								 }				  
						    }	

echo number_format($base_e4,2,',','.');
//printf("%s",$a_partir_estampilla1);
?>
            </div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"> <?php printf("%s",$tarifa_e4);//echo number_format($tarifa_estampilla3,2,',','.'); //printf("%s",$tarifa_estampilla3); ?> </div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
             
              <input name="vr_estampilla4" type="text" class="Estilo12" id="vr_estampilla4" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f",$vr_estampilla4); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 5 </strong></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
            <select name="estampilla5" class="Estilo12" id="estampilla5" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla5 = $_POST['estampilla5'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla5) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <?php 
$sqlxd = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla5'";
						$resxd = mysql_db_query($database, $sqlxd, $connectionxx);
							while($rowxd = mysql_fetch_array($resxd)) 
							{
								$base =$rowxd["base"];
							    $tope =$rowxd["tope"];
							    $tarifa =$rowxd["tarifa"];
							    if ($nuevo_total >= $base and ($nuevo_total <= $tope or $tope==''))
								  {
									$vr_estampilla5 = redondear_dos_decimal($vr1x * $tarifa);
									$vr_aut_reten[$r]=$vr_estampilla5;
									$r++;
									$base_e5 = $base;
									$tope_e5 = $tope;
									$tarifa_e5 =$tarifa;
							  	  }else{
								   $vr_estampilla5=0;
									$vr_aut_reten[$r]=$vr_estampilla5;
									$r++;								 
								 }				  
						    }	

echo number_format($base_e5,2,',','.');
//printf("%s",$a_partir_estampilla1);
?>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"> <?php printf("%s",$tarifa_e5);//echo number_format($tarifa_estampilla3,2,',','.'); //printf("%s",$tarifa_estampilla3); ?> </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
             
              <input name="vr_estampilla5" type="text" class="Estilo12" id="vr_estampilla5" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f",$vr_estampilla5); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#66CCCC"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="Submit3" type="submit" class="Estilo4" value="Calcular TODOS los Valores a Retener" onclick="this.form.action = 'p_pago_cobp.php'" />
            </div>
          </div>
      </div></td>
      <td colspan="3" bgcolor="#990000"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo12"><span class="Estilo8"><strong> VALOR NETO A PAGAR : $
            <?php 

$total_pagado = $vr1x - ($salud + $pension + $libranza + $f_solidaridad + $f_empleados + $sindicato + $embargo + $cruce + $otros + 
											  $vr_retefuente +  $vr_reteiva + $vr_reteica + $vr_estampilla1 + $vr_estampilla2 + $vr_estampilla3 + $vr_estampilla4 + $vr_estampilla5);  
echo number_format($total_pagado,0,',','.');
//printf("%.0f",$total_pagado);
?>
            = </strong></span>
              <input name="total_pagado" type="hidden" class="Estilo12" id="total_pagado" value="<?php printf("%.0f",$total_pagado); ?>"/>
          </div>
      </div></td>
    </tr>
  </table>
  <?php
}
else
{
?>
  <br />
  <table width="800" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo12"><strong> RETENCIONES POR IMPUESTOS, TASAS Y CONTRIBUCIONES </strong>...::: manual :::... </div>
      </div></td>
    </tr>
    <tr>
      <td width="410"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>ReteFuente</strong></div>
          </div>
      </div></td>
      <td width="130"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>BASE</strong></div>
          </div>
      </div></td>
      <td width="130"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Tarifa </strong></div>
          </div>
      </div></td>
      <td width="130"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Valor a Retener</strong></div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
            <select name="retefuente" class="Estilo12" id="retefuente" style="width: 300px;">
              <option value=""></option>
              <?php 
   $retefuente = $_POST['retefuente'];		  
   include('../config.php');
   $query="SELECT * FROM retefuente";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$retefuente) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <?php 

/*$sqlxx2a = "SELECT * FROM retefuente WHERE concepto = '$retefuente' ";
$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);

while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
{
  $a_partir_retefuente=$rowxx2a["a_partir"];
  $tarifa_retefuente=$rowxx2a["tarifa"];

}
echo number_format($a_partir_retefuente,2,',','.');*/
//printf("%.0f",$a_partir_retefuente);
?>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"> <?php // printf("%s",$tarifa_retefuente);//echo number_format($tarifa_retefuente,2,',','.'); //printf("%s",$tarifa_retefuente);?> </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <?php 
/*if($vr_tot_obli_sin_iva >= $a_partir_retefuente)
{
 $vr_retefuente = $vr_obli_para_pago_sin_iva * $tarifa_retefuente;
}
else
{
 $vr_retefuente = 0;
}*/
// desde aqui
/*if($nuevo_total >= $a_partir_retefuente)
{
 $vr_retefuente = $vr2x * $tarifa_retefuente;
}
else
{
 $vr_retefuente = 0;
}*/
?>
<!--              <input name="vr_retefuente" type="text" class="Estilo12" id="vr_retefuente" style="text-align:right" onkeypress="return validar(event)" value="<?php //printf("%.0f",$vr_retefuente); ?>" />-->
			  
			  <input name="vr_retefuente" type="text" class="Estilo12" id="vr_retefuente" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $vr_retefuente=$_POST['vr_retefuente']; printf("%s",$vr_retefuente); ?>" />	
			  
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>ReteIVA</strong></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
            <select name="reteiva" class="Estilo12" id="select2" style="width: 300px;">
              <option value=""></option>
              <?php 
   $reteiva = $_POST['reteiva'];		  
   include('../config.php');
   $query="SELECT * FROM reteiva";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$reteiva) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <?php 

/*$sqlxx2b = "SELECT * FROM reteiva WHERE concepto = '$reteiva' ";
$resultadoxx2b = mysql_db_query($database, $sqlxx2b, $connectionxx);

while($rowxx2b = mysql_fetch_array($resultadoxx2b)) 
{
  $a_partir_reteiva=$rowxx2b["a_partir"];
  $tarifa_reteiva=$rowxx2b["tarifa"];

}
echo number_format($a_partir_reteiva,2,',','.');*/
//printf("%.0f",$a_partir_reteiva);
?>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"> <?php //printf("%s",$tarifa_reteiva);//echo number_format($tarifa_reteiva,2,',','.'); //printf("%s",$tarifa_reteiva); ?> </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <?php 
/*if($vr_tot_obli_sin_iva >= $a_partir_reteiva)
{
 $vr_reteiva = $iva_vr_obli_pago * $tarifa_reteiva;
}
else
{
 $vr_reteiva = 0;
}*/
//desde aqui
/*if($nuevo_total >= $a_partir_reteiva)
{
 $vr_reteiva = $vr3x * $tarifa_reteiva;
}
else
{
 $vr_reteiva = 0;
}*/

?>
<!--              <input name="vr_reteiva" type="text" class="Estilo12" id="vr_reteiva" style="text-align:right" onkeypress="return validar(event)" value="<?php //printf("%.0f",$vr_reteiva); ?>" />-->
			  
			  			  <input name="vr_reteiva" type="text" class="Estilo12" id="vr_reteiva" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $vr_reteiva=$_POST['vr_reteiva']; printf("%s",$vr_reteiva); ?>" />	
			  
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>ReteICA</strong><strong> / Otro</strong></div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center"><span class="Estilo4">
            <input name="reteica" type="text" class="Estilo4" id="reteica" onkeyup="a.reteica.value=a.reteica.value.toUpperCase();" size="60"
			value="<?php $reteica=$_POST['reteica']; printf("%s",$reteica); ?>" />
          </span></div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="a_partir_reteica" type="text" class="Estilo12" id="a_partir_reteica" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $a_partir_reteica=$_POST['a_partir_reteica']; printf("%s",$a_partir_reteica); ?>" />
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="tarifa_reteica" type="text" class="Estilo12" id="tarifa_reteica" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $tarifa_reteica=$_POST['tarifa_reteica']; printf("%s",$tarifa_reteica); ?>" />
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="vr_reteica" type="text" class="Estilo12" id="vr_reteica" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $vr_reteica=$_POST['vr_reteica']; printf("%s",$vr_reteica); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 1</strong></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center">
		  <select name="estampilla1" class="Estilo12" id="estampilla1" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla1 = $_POST['estampilla1'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla1) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select>
		  </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="vr_estampilla1" type="text" class="Estilo12" id="vr_estampilla1" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $vr_estampilla1=$_POST['vr_estampilla1']; printf("%s",$vr_estampilla1); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 2</strong></div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center"><select name="estampilla2" class="Estilo12" id="estampilla2" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla2 = $_POST['estampilla2'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla2) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select></div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"></div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"></div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="vr_estampilla2" type="text" class="Estilo12" id="vr_estampilla2" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $vr_estampilla2=$_POST['vr_estampilla2']; printf("%s",$vr_estampilla2); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 3</strong></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center"><select name="estampilla3" class="Estilo12" id="estampilla3" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla3 = $_POST['estampilla3'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla3) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select></div>
      </div></td>
      <td bgcolor="#F5F5F5">&nbsp;</td>
      <td bgcolor="#F5F5F5">&nbsp;</td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="vr_estampilla3" type="text" class="Estilo12" id="vr_estampilla3" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $vr_estampilla3=$_POST['vr_estampilla3']; printf("%s",$vr_estampilla3); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 4 </strong></div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center"><select name="estampilla4" class="Estilo12" id="estampilla4" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla4 = $_POST['estampilla4'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla4) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select></div>
      </div></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="vr_estampilla4" type="text" class="Estilo12" id="vr_estampilla4" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $vr_estampilla4=$_POST['vr_estampilla4']; printf("%s",$vr_estampilla4); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center"><strong>Estampilla 5 </strong></div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12"> </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center"><select name="estampilla5" class="Estilo12" id="estampilla5" style="width: 300px;">
              <option value=""></option>
              <?php 
   $estampilla5 = $_POST['estampilla5'];		  
   include('../config.php');
   $query="SELECT * FROM estampillas";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=$result->fetch_assoc())
   {
   	if ($row['concepto']==$estampilla5) 
   	{
	
 echo "<OPTION VALUE=\"".$row["concepto"]."\" selected>".$row["concepto"]."</OPTION>";
   	} 
	else 
   	{
echo "<OPTION VALUE=\"".$row["concepto"]."\">".$row["concepto"]."</OPTION>";
   	}
   }
 ?>
            </select></div>
      </div></td>
      <td bgcolor="#F5F5F5">&nbsp;</td>
      <td bgcolor="#F5F5F5">&nbsp;</td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="vr_estampilla5" type="text" class="Estilo12" id="vr_estampilla5" style="text-align:right" onkeypress="return validar(event)" 
			  value="<?php $vr_estampilla5=$_POST['vr_estampilla5']; printf("%s",$vr_estampilla5); ?>" />
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#66CCCC"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="Submit32" type="submit" class="Estilo4" value="Calcular TODOS los Valores a Retener" onclick="this.form.action = 'p_pago_cobp.php'" />
            </div>
          </div>
      </div></td>
      <td colspan="3" bgcolor="#990000"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo12"><span class="Estilo8"><strong> VALOR NETO A PAGAR : $
            <?php 

$total_pagado = $vr1x - ($salud + $pension + $libranza + $f_solidaridad + $f_empleados + $sindicato + $embargo + $cruce + $otros + 
											  $vr_retefuente +  $vr_reteiva + $vr_reteica + $vr_estampilla1 + $vr_estampilla2 + $vr_estampilla3 + $vr_estampilla4 + $vr_estampilla5);  
echo number_format($total_pagado,2,',','.');
//printf("%.0f",$total_pagado);
?>
            = </strong></span>
              <input name="total_pagado" type="hidden" class="Estilo12" id="total_pagado" value="<?php printf("%.0f",$total_pagado); ?>"/>
          </div>
      </div></td>
    </tr>
  </table>
  <?php 
} 
?>
  <br />
  <div style="padding-left:10px; padding-top10px; padding-right:10px; padding-bottom:10px;">
    <div align="center" class="Estilo12"> <br />
        <b>...::: SELECCIONE LA FORMA DE PAGO PARA ESTE COMPROBANTE :::...</b> <br />
      <br />
        <select name="forma_pago" class="Estilo4" id="forma_pago">
		 <?php 
		 $forma = array('CHEQUE','EFECTIVO','TRANSFERENCIA','CRUCE DE CUETAS','OTRO');
		 $forma_pago =$_POST['forma_pago']; 
		 $i=0;
		 for ($i=0;$i<=4;$i++)
		 {
		 	if($forma_pago == $forma[$i])
			{
				echo "<option value='$forma[$i]' selected>$forma[$i]</option>";
            }else{
				echo "<option value='$forma[$i]'>$forma[$i]</option>";
			 }
		 }
			?>
           
            </select>
    </div>
  </div>
  <span class="Estilo20">
  <?php
				
	$pgcp1 = $_POST['pgcp1'];
	$pgcp2 = $_POST['pgcp2'];
	$pgcp3 = $_POST['pgcp3'];
	$pgcp4 = $_POST['pgcp4'];
	$pgcp5 = $_POST['pgcp5'];
	$pgcp6 = $_POST['pgcp6'];
	$pgcp7 = $_POST['pgcp7'];
	$pgcp8 = $_POST['pgcp8'];
	$pgcp9 = $_POST['pgcp9'];
	$pgcp10 = $_POST['pgcp10'];
	$pgcp11 = $_POST['pgcp11'];
	$pgcp12 = $_POST['pgcp12'];
	$pgcp13 = $_POST['pgcp13'];
	$pgcp14 = $_POST['pgcp14'];
	$pgcp15 = $_POST['pgcp15'];
	$des1 = $_POST['des1'];
	$des2 = $_POST['des2'];
	$des3 = $_POST['des3'];
	$des4 = $_POST['des4'];
	$des5 = $_POST['des5'];
	$des6 = $_POST['des6'];
	$des7 = $_POST['des7'];
	$des8 = $_POST['des8'];
	$des9 = $_POST['des9'];
	$des10 = $_POST['des10'];
	$des11 = $_POST['des11'];
	$des12 = $_POST['des12'];
	$des13 = $_POST['des13'];
	$des14 = $_POST['des14'];
	$des15 = $_POST['des15'];
	$vr_deb_1 = $_POST['vr_deb_1'];
	$vr_deb_2 = $_POST['vr_deb_2'];
	$vr_deb_3 = $_POST['vr_deb_3'];
	$vr_deb_4 = $_POST['vr_deb_4'];
	$vr_deb_5 = $_POST['vr_deb_5'];
	$vr_deb_6 = $_POST['vr_deb_6'];
	$vr_deb_7 = $_POST['vr_deb_7'];
	$vr_deb_8 = $_POST['vr_deb_8'];
	$vr_deb_9 = $_POST['vr_deb_9'];
	$vr_deb_10 = $_POST['vr_deb_10'];
	$vr_deb_11 = $_POST['vr_deb_11'];
	$vr_deb_12 = $_POST['vr_deb_12'];
	$vr_deb_13 = $_POST['vr_deb_13'];
	$vr_deb_14 = $_POST['vr_deb_14'];
	$vr_deb_15 = $_POST['vr_deb_15'];
	$vr_cre_1 = $_POST['vr_cre_1'];
	$vr_cre_2 = $_POST['vr_cre_2'];
	$vr_cre_3 = $_POST['vr_cre_3'];
	$vr_cre_4 = $_POST['vr_cre_4'];
	$vr_cre_5 = $_POST['vr_cre_5'];
	$vr_cre_6 = $_POST['vr_cre_6'];
	$vr_cre_7 = $_POST['vr_cre_7'];
	$vr_cre_8 = $_POST['vr_cre_8'];
	$vr_cre_9 = $_POST['vr_cre_9'];
	$vr_cre_10 = $_POST['vr_cre_10'];
	$vr_cre_11 = $_POST['vr_cre_11'];
	$vr_cre_12 = $_POST['vr_cre_12'];
	$vr_cre_13 = $_POST['vr_cre_13'];
	$vr_cre_14 = $_POST['vr_cre_14'];
	$vr_cre_15 = $_POST['vr_cre_15'];

			
			?>
  </span><br />
  <center>
			  <span class="Estilo4">
			  <font color="#990000">
			  <span id="txt">
			  <b><U>ATENCION</U></b><BR /><BR />
			  </span>
			  RECUERDE CAMBIAR EL CODIGO P.G.C.P DE LAS CUENTAS DEBITO<br /><br />
			  Ajuste el Movimiento Contable segun sus Requerimientos			  </font>			  </span></center>
  <br />
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
  <table width="1000" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>IMPORTANTE</strong><br />
                <br />
              Si la cuenta que desea utilizar no aparece en el listado de CUENTAS P.G.C.P, posiblemente se encuentra BLOQUEADA. <br />
              Consulte el Item 4.2 del Menu Principal - Opcion &quot;Maestro P.G.C.P &quot; </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="5" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE </strong></div>
      </div></td>
    </tr>
    <tr>
      <td width="190"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DIGITE CUENTA P.G.C.P </strong></div>
      </div></td>
      <td width="420"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DATOS DE LA CUENTA</strong><strong></strong> </div>
      </div></td>
      <td width="130"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR DEBITO </strong></div>
      </div></td>
      <td width="130"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR CREDITO </strong></div>
      </div></td>
      <td width="130"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>No. Dcto / Cheque </strong></div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp1" type="text" class="Estilo4" id="pgcp1" style="width:180px;" onkeyup="chk_pgcp1();"/>
      </span> </div></td>
      <td><div align="left" class="Estilo4" id='resultado'></div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_1" type="text" class="Estilo12" id="vr_deb_1" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_1" type="text" class="Estilo12" id="vr_cre_1" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque" type="text" class="Estilo12" id="num_cheque" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp2" type="text" class="Estilo4" id="pgcp2" style="width:180px;" onkeyup="chk_pgcp2();"/>
      </span> </div></td>
      <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado2'></div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_2" type="text" class="Estilo12" id="vr_deb_2" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_2" type="text" class="Estilo12" id="vr_cre_2" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque2" type="text" class="Estilo12" id="num_cheque2" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp3" type="text" class="Estilo4" id="pgcp3" style="width:180px;" onkeyup="chk_pgcp3();"/>
      </span> </div></td>
      <td><div align="left" class="Estilo4" id='resultado3'></div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_3" type="text" class="Estilo12" id="vr_deb_3" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_3" type="text" class="Estilo12" id="vr_cre_3" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque3" type="text" class="Estilo12" id="num_cheque3" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp4" type="text" class="Estilo4" id="pgcp4" style="width:180px;" onkeyup="chk_pgcp4();"/>
      </span> </div></td>
      <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado4'></div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_4" type="text" class="Estilo12" id="vr_deb_4" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_4" type="text" class="Estilo12" id="vr_cre_4" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque4" type="text" class="Estilo12" id="num_cheque4" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp5" type="text" class="Estilo4" id="pgcp5" style="width:180px;" onkeyup="chk_pgcp5();"/>
      </span> </div></td>
      <td><div align="left" class="Estilo4" id='resultado5'></div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_5" type="text" class="Estilo12" id="vr_deb_5" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_5" type="text" class="Estilo12" id="vr_cre_5" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque5" type="text" class="Estilo12" id="num_cheque5" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp6" type="text" class="Estilo4" id="pgcp6" style="width:180px;" onkeyup="chk_pgcp6();"/>
      </span> </div></td>
      <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado6'></div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_6" type="text" class="Estilo12" id="vr_deb_6" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_6" type="text" class="Estilo12" id="vr_cre_6" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque6" type="text" class="Estilo12" id="num_cheque6" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp7" type="text" class="Estilo4" id="pgcp7" style="width:180px;" onkeyup="chk_pgcp7();"/>
      </span> </div></td>
      <td><div align="left" class="Estilo4" id='resultado7'></div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_7" type="text" class="Estilo4" id="vr_deb_7" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_7" type="text" class="Estilo4" id="vr_cre_7" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque7" type="text" class="Estilo4" id="num_cheque7" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp8" type="text" class="Estilo4" id="pgcp8" style="width:180px;" onkeyup="chk_pgcp8();"/>
      </span> </div></td>
      <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado8'></div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_8" type="text" class="Estilo4" id="vr_deb_8" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_8" type="text" class="Estilo4" id="vr_cre_8" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque8" type="text" class="Estilo4" id="num_cheque8" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp9" type="text" class="Estilo4" id="pgcp9" style="width:180px;" onkeyup="chk_pgcp9();"/>
      </span> </div></td>
      <td><div align="left" class="Estilo4" id='resultado9'></div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_9" type="text" class="Estilo4" id="vr_deb_9" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_9" type="text" class="Estilo4" id="vr_cre_9" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque9" type="text" class="Estilo4" id="num_cheque9" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp10" type="text" class="Estilo4" id="pgcp10" style="width:180px;" onkeyup="chk_pgcp10();"/>
      </span> </div></td>
      <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado10'></div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_10" type="text" class="Estilo4" id="vr_deb_10" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_10" type="text" class="Estilo4" id="vr_cre_10" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque10" type="text" class="Estilo4" id="num_cheque10" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp11" type="text" class="Estilo4" id="pgcp11" style="width:180px;" onkeyup="chk_pgcp11();"/>
      </span> </div></td>
      <td><div align="left" class="Estilo4" id='resultado11'></div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_11" type="text" class="Estilo4" id="vr_deb_11" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_11" type="text" class="Estilo4" id="vr_cre_11" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque11" type="text" class="Estilo4" id="num_cheque11" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp12" type="text" class="Estilo4" id="pgcp12" style="width:180px;" onkeyup="chk_pgcp12();"/>
      </span> </div></td>
      <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado12'></div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_12" type="text" class="Estilo4" id="vr_deb_12" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_12" type="text" class="Estilo4" id="vr_cre_12" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque12" type="text" class="Estilo4" id="num_cheque12" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp13" type="text" class="Estilo4" id="pgcp13" style="width:180px;" onkeyup="chk_pgcp13();"/>
      </span> </div></td>
      <td><div align="left" class="Estilo4" id='resultado13'></div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_13" type="text" class="Estilo4" id="vr_deb_13" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_13" type="text" class="Estilo4" id="vr_cre_13" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque13" type="text" class="Estilo4" id="num_cheque13" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp14" type="text" class="Estilo4" id="pgcp14" style="width:180px;" onkeyup="chk_pgcp14();"/>
      </span> </div></td>
      <td bgcolor="#F5F5F5"><div align="left" class="Estilo4" id='resultado14'></div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_14" type="text" class="Estilo4" id="vr_deb_14" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_14" type="text" class="Estilo4" id="vr_cre_14" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque14" type="text" class="Estilo4" id="num_cheque14" style="text-align:right"/>
            </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo4">
          <input name="pgcp15" type="text" class="Estilo4" id="pgcp15" style="width:180px;" onkeyup="chk_pgcp15();"/>
      </span> </div></td>
      <td><div align="left" class="Estilo4" id='resultado15'></div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_deb_15" type="text" class="Estilo4" id="vr_deb_15" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcular();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="vr_cre_15" type="text" class="Estilo4" id="vr_cre_15" style="text-align:right" onkeypress="return validar(event)"  onkeyup="Calcularc();"/>
            </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo4">
            <div align="center">
              <input name="num_cheque15" type="text" class="Estilo4" id="num_cheque15" style="text-align:right"/>
            </div>
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
      <td bgcolor="#FFFFFF"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right">
              <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF" class="Estilo4"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right">
              <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" equalto="#tot_deb_a"/>
            </div>
          </div>
      </div></td>
      <td bgcolor="#990000">&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="5"><div class="Estilo19" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center">
            <input name="Submit322" type="submit" class="Estilo19"  value="Grabar Comprobante de Vigencia Actual" 
			onclick="this.form.action = 'p_ceva.php'" />
          </div>
      </div></td>
    </tr>
  </table>
  <br /></td>
  </tr>
  </form>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
	  
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center">
			  <?php
printf("

<center class='Estilo4'>
<form method='post' action='pagos_tesoreria.php'>
<input type='hidden' name='nn' value='CEVA'>
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
    <td colspan="3"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
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