<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<head>
<title>CONTAFACIL</title>
<style type="text/css">
<!--
a {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:visited {
	color: #990000;
	text-decoration: none;
}
a:hover {
	color: #990000;
	text-decoration: underline;
}
a:active {
	color: #990000;
	text-decoration: none;
}
a:link {
	text-decoration: none;
	color: #990000;
}
.Estilo4 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #333333;
	font-weight: bold;
}
-->
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo8 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo8 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo8 {color: #FFFFFF}
.Estilo9 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo10 {color: #990000}
.Estilo18 {color: #F5F5F5}
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>

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
		
	
</script>

<!--fin val forms--> 

</head>
<body>

<div align="center">
<?php
include("../config.php");
 
$id_recau=$_POST['id_recau'];

// saco el id de la empresa
   $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	    $sqlxx = "select * from fecha";
	    $resultadoxx = $connectionxx->query($sqlxx);
	    while($rowxx = $resultadoxx->fetch_assoc()) 
  	    {
     	 $idxx=$rowxx["id_emp"];
		 $id_emp=$rowxx["id_emp"];
    	}
		


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_roit where id_emp = '$idxx' and id_recau='$id_recau' order by id asc ";
$re = $cx->query($sq);

printf("
<center>
<br>
<DIV style='background:#DCE9E5; padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px; width:800px;'>
<span class='Estilo4'>
<strong>DATOS  DEL  RECIBO OFICIAL DE INGRESOS</strong>
</span>
</DIV>
<BR>
</center>
");

printf("
<center>

<table width='990' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='80'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>FECHA</b></span>
</div>
</td>

<td align='center' width='200'><span class='Estilo4'><b>IMPUTACION</b></span></td>
<td align='center' width='200'><span class='Estilo4'><b>NOMBRE</b></span></td>
<td align='center' width='200'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>ELIMINAR</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>MODIFICAR</b></span></td>
</tr>
");
$cont=0;
$vr=0;
while($rw = $re->fetch_assoc()) 
{
printf("
<span class='Estilo4'>
<tr>

<td align='center'><span class='Estilo9'>%s</span></td>
<td align='left'><span class='Estilo9'>&nbsp;%s</span></td>
<td align='center'><span class='Estilo9'>%s</span></td>
<td align='center'><span class='Estilo9'>%s</span></td>
<td align='right'><span class='Estilo9'> %.2f &nbsp;</span></td>

<td align='center'>
<br>
<form method='post' action='borra1.php' onsubmit=\"return confirm('Esta Accion eliminara la Imputacion del Recibo y NO podra volver a agregarla Nuevamente, Desea Proceder?')\">
<input type='hidden' name='id' value='%s'>
<input type='hidden' name='id_reip' value='%s'>
<input type='hidden' name='id_caic' value='%s'>
<input type='hidden' name='id_recau' value='%s'>
<input type='hidden' name='cuenta' value='%s'>
<input type='hidden' name='nombre' value='%s'>
<input type='submit' name='Submit' value='Eliminar' class='Estilo9' />
</form>
</td>

<td align='center'>
<br>
<form method='post' action='modifica_roit.php'>
<input type='hidden' name='id' value='%s'>
<input type='hidden' name='id_reip' value='%s'>
<input type='hidden' name='id_caic' value='%s'>
<input type='hidden' name='id_recau' value='%s'>
<input type='hidden' name='cuenta' value='%s'>
<input type='hidden' name='nombre' value='%s'>
<input type='hidden' name='vr_digitado' value='%.2f'>
<input type='hidden' name='tercero' value='%s'>
<input type='hidden' name='des_recaudo' value='%s'>
<input type='submit' name='Submit' value='Modificar' class='Estilo9' />
</form>
</td>



</tr>", $rw["fecha_recaudo"] , $rw["cuenta"] , $rw["nombre"] , $rw["tercero"] , $rw["vr_digitado"] ,

$rw["id"] , $rw["id_reip"] , $rw["id_caic"] , $rw["id_recau"] , $rw["cuenta"] , $rw["nombre"] ,

$rw["id"] , $rw["id_reip"] , $rw["id_caic"] , $rw["id_recau"] , $rw["cuenta"] , $rw["nombre"] , $rw["vr_digitado"], $rw["tercero"], $rw["des_recaudo"]
); 

$aa=$rw["id_recau"];
$cont++;
$vr=$vr+$rw["vr_digitado"];
$id=$rw["id"];

   }

?>
  <?php
printf("
</table>
</center>
");
?>
  <br><br>
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
  <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
  <a href='recaudos_tesoreria.php' target='_parent' class='Estilo10'><B> ...::: CANCELAR PROCESO y/o VOLVER :::...</B> </a>
  </div>
  </div>
  <br><br>
  <span class="Estilo4">MODIFICAR CONTABILIDAD</span><br>
  <br>
  <span class="Estilo4">Este proceso modificara la contabilidad de  <?php printf("%s",$cont); ?> Imputacion(es) Presupuestales presentes en el Recibo Oficial de Ingresos </span><br>
  <br>
<?php
//************
include('../config.php');
//id _emp				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $idxx=$rowxx["id_emp"];
  $id_emp=$rowxx["id_emp"];
}

$sql1 = "select * from recaudo_roit where id_emp ='$idxx' and id ='$id'";
$resultado1 = mysql_db_query($database, $sql1, $connectionxx);

while($rw1 = mysql_fetch_array($resultado1)) 
{

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
	<script>
function muestraURL(){
var miPopup
miPopup = window.open("../pgcp/consulta_cta.php","CONTAFACIL","width=800,height=400,menubar=no,scrollbars=yes")
}
</script>
<table width="300" border="0" align="center">
  <tr>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
    <td width="200" valign="middle"><div align="center"><a href="#" onClick="muestraURL()">BUSCAR CUENTA PGCP</a></div></td>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
  </tr>
</table>
  <form name="a" method="post" onSubmit="return confirm('Verifique si todos los datos estan correctos')">
    <table width="828" border="1" align="center" class="bordepunteado11">
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo20"><strong>CONTABILIDAD</strong></div>
        </div></td>
      </tr>
      <tr>
        <td width="200" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo20"><strong>CUENTA P.G.C.P </strong></div>
        </div></td>
        <td width="340" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo20"><strong>DESCRIPCION ADICIONAL </strong></div>
        </div></td>
        <td width="130" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo20"><strong>VALOR DEBITO </strong></div>
        </div></td>
        <td width="130" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo20"><strong>VALOR CREDITO </strong></div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp1" type="text" class="Estilo20" id="pgcp1" style="width:180px;" onKeyUp="chk_pgcp1();" value="<?php printf("%s",$pgcp1); ?>"/>
            
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_1" type="text" class="Estilo20" id="vr_deb_1" style="text-align:right" onKeyPress="return validar(event)" size="20" value="<?php printf("%.2f",$vr_deb_1); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_1" type="text" class="Estilo20" id="vr_cre_1" style="text-align:right" onKeyPress="return validar(event)" size="20" value="<?php printf("%.2f",$vr_cre_1); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp2" type="text" class="Estilo20" id="pgcp2" style="width:180px;" onKeyUp="chk_pgcp2();" value="<?php printf("%s",$pgcp2); ?>"/>
           
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado2'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_2" type="text" class="Estilo20" id="vr_deb_2" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_2); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_2" type="text" class="Estilo20" id="vr_cre_2" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_2); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp3" type="text" class="Estilo20" id="pgcp3" style="width:180px;" onKeyUp="chk_pgcp3();" value="<?php printf("%s",$pgcp3); ?>"/>
          
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado3'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_3" type="text" class="Estilo20" id="vr_deb_3" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_3); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_3" type="text" class="Estilo20" id="vr_cre_3" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_3); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp4" type="text" class="Estilo20" id="pgcp4" style="width:180px;" onKeyUp="chk_pgcp4();" value="<?php printf("%s",$pgcp4); ?>"/>
            
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado4'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_4" type="text" class="Estilo20" id="vr_deb_4" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_4); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_4" type="text" class="Estilo20" id="vr_cre_4" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_4); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp5" type="text" class="Estilo20" id="pgcp5" style="width:180px;" onKeyUp="chk_pgcp5();" value="<?php printf("%s",$pgcp5); ?>"/>
           
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado5'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_5" type="text" class="Estilo20" id="vr_deb_5" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_5); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_5" type="text" class="Estilo20" id="vr_cre_5" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_5); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp6" type="text" class="Estilo20" id="pgcp6" style="width:180px;" onKeyUp="chk_pgcp6();" value="<?php printf("%s",$pgcp6); ?>"/>
            
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado6'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_6" type="text" class="Estilo20" id="vr_deb_6" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_6); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_6" type="text" class="Estilo20" id="vr_cre_6" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_6); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp7" type="text" class="Estilo20" id="pgcp7" style="width:180px;" onKeyUp="chk_pgcp7();" value="<?php printf("%s",$pgcp7); ?>"/>
           
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado7'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_7" type="text" class="Estilo20" id="vr_deb_7" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_7); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_7" type="text" class="Estilo20" id="vr_cre_7" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_7); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp8" type="text" class="Estilo20" id="pgcp8" style="width:180px;" onKeyUp="chk_pgcp8();" value="<?php printf("%s",$pgcp8); ?>"/>
            
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado8'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_8" type="text" class="Estilo20" id="vr_deb_8" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_8); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_8" type="text" class="Estilo20" id="vr_cre_8" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_8); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp9" type="text" class="Estilo20" id="pgcp9" style="width:180px;" onKeyUp="chk_pgcp9();" value="<?php printf("%s",$pgcp9); ?>"/>
          
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado9'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_9" type="text" class="Estilo20" id="vr_deb_9" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_9); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_9" type="text" class="Estilo20" id="vr_cre_9" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_9); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp10" type="text" class="Estilo20" id="pgcp10" style="width:180px;" onKeyUp="chk_pgcp10();" value="<?php printf("%s",$pgcp10); ?>"/>
           
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado10'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_10" type="text" class="Estilo20" id="vr_deb_10" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_10); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_10" type="text" class="Estilo20" id="vr_cre_10" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_10); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp11" type="text" class="Estilo20" id="pgcp11" style="width:180px;" onKeyUp="chk_pgcp11();" value="<?php printf("%s",$pgcp11); ?>"/>
           
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado11'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_11" type="text" class="Estilo20" id="vr_deb_11" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_11); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_11" type="text" class="Estilo20" id="vr_cre_11" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_11); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp12" type="text" class="Estilo20" id="pgcp12" style="width:180px;" onKeyUp="chk_pgcp12();" value="<?php printf("%s",$pgcp12); ?>"/>
          
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado12'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_12" type="text" class="Estilo20" id="vr_deb_12" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_12); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_12" type="text" class="Estilo20" id="vr_cre_12" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_12); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp13" type="text" class="Estilo20" id="pgcp13" style="width:180px;" onKeyUp="chk_pgcp13();" value="<?php printf("%s",$pgcp13); ?>"/>
            
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado13'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_13" type="text" class="Estilo20" id="vr_deb_13" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_13); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_13" type="text" class="Estilo20" id="vr_cre_13" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_13); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp14" type="text" class="Estilo20" id="pgcp14" style="width:180px;" onKeyUp="chk_pgcp14();" value="<?php printf("%s",$pgcp14); ?>"/>
           
        </span> </div></td>
        <td bgcolor="#F5F5F5" class="bordepunteado1"><div align="left" class="Estilo4" id='resultado14'></div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_14" type="text" class="Estilo20" id="vr_deb_14" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_14); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_14" type="text" class="Estilo20" id="vr_cre_14" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_14); ?>" onKeyUp="Calcularc();"/>
            </div>
        </div></td>
      </tr>
      <tr>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo20">
            <input name="pgcp15" type="text" class="Estilo20" id="pgcp15" style="width:180px;" onKeyUp="chk_pgcp15();" value="<?php printf("%s",$pgcp15); ?>"/>
           
        </span> </div></td>
        <td class="bordepunteado1"><div align="left" class="Estilo4" id='resultado15'></div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_deb_15" type="text" class="Estilo20" id="vr_deb_15" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_deb_15); ?>" onKeyUp="Calcular();"/>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo20">
              <input name="vr_cre_15" type="text" class="Estilo20" id="vr_cre_15" style="text-align:right" onKeyPress="return validar(event)"  size="20" value="<?php printf("%.2f",$vr_cre_15); ?>" onKeyUp="Calcularc();"/>
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
              <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right"/>
            </div>
          </div>
        </div></td>
        <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right">
              <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right"/>
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
      <tr>
        <td colspan="4"><div class="Estilo19" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center">
            <input name="id_recau" type="hidden" value="<?php printf("%s",$aa); ?>">
            <input name="vr" type="hidden" value="<?php printf("%s",$vr); ?>">
            <input name="Submit322" type="submit" class="Estilo19"  value="Modificar" 
			onclick="this.form.action = 'modifica_cont_roit.php'" />
          </div>
        </div></td>
      </tr>
      <!--secciones de fila -->
      <!--secciones de fila -->
    </table>
  </form>
  <br>
  
  
  
  
  
  
  <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
  <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
  <a href='recaudos_tesoreria.php' target='_parent' class='Estilo10'><B> ...::: CANCELAR PROCESO y/o VOLVER :::...</B> </a>
  </div>
  </div>
  <BR>
  <BR />
  <BR />
</div>
</body>
</html>

<?php
}
?>