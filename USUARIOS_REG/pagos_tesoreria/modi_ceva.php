<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<head>
<title>CONTAFACIL</title>
<link type="text/css" rel="stylesheet" href="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>	
<SCRIPT type="text/javascript" src="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>


<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<style type="text/css">
<!--

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
.Estilo21 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo21 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo23 {font-weight: bold}
.Estilo25 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo26 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  

// crear tabla....

var contLin=1;

function agregar()
 {
	 fila = document.all.tablaf.rows.length - 1;
	 if(fila<14)
	 {
	var tr, td;
	var v1=document.getElementById('retefuente').value;
	var v2=document.getElementById('reteiva').value;
	//var v55=document.getElementById('id_obcg').value;

	tr = document.all.tablaf.insertRow();
	td = tr.insertCell();
	td.innerHTML = "<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'> <input type='text' size='28' style='text-align:left' id='pgcp"+contLin+"' name='pgcp"+contLin+"' value='' onkeyup='lookup(this.value,"+contLin+");' >  </span></div> <div class='suggestionsBox' id='sugges"+contLin+"' style='display: none; position:absolute; left: 130px;'><img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'> <div class='suggestionList' id='autoSug"+contLin+"' align=left> &nbsp;  </div> </div>";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='40' style='text-align:left' name='resulta"+contLin+"' id='resulta"+contLin+"' value='' readonly >";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='25' style='text-align:right' name='t"+contLin+"3' id='t" + contLin + "3' value=0  onKeyUp='cuatro();' onkeypress='return validar(event)' >";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='26' style='text-align:right' name='t" + contLin + "4' id='t" + contLin + "4' value=0  onKeyUp='cuatro();' onkeypress='return validar(event)' >";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='29' style='text-align:right' name='num_cheque"+contLin+"' id='num_cheque"+contLin+"' value='' >";
	contLin++;
	
	
	 }
}




/// fin crear tabla



</script>
<?php
class EnLetras
{
  var $Void = "";
  var $SP = " ";
  var $Dot = ".";
  var $Zero = "0";
  var $Neg = "MENOS";
  
function ValorEnLetras($x, $Moneda ) 
{
    $s="";
    $Ent="";
    $Frc="";
    $Signo="";
        
    if(floatVal($x) < 0)
     $Signo = $this->Neg . " ";
    else
     $Signo = "";
    
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
      $s = number_format($x,2,'.','');
    else
      $s = number_format($x,0,'.','');
       
    $Pto = strpos($s, $this->Dot);
        
    if ($Pto === false)
    {
      $Ent = $s;
      $Frc = $this->Void;
    }
    else
    {
      $Ent = substr($s, 0, $Pto );
      $Frc =  substr($s, $Pto+1);
    }

    if($Ent == $this->Zero || $Ent == $this->Void)
       $s = "CERO ";
    elseif( strlen($Ent) > 7)
    {
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
             "MILLONES " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
    }
    else
    {
      $s = $this->SubValLetra(intval($Ent));
    }

    if (substr($s,-9, 9) == "MILLONES " || substr($s,-7, 7) == "MILLON ")
       $s = $s . "de ";

    $s = $s . $Moneda;

    if($Frc != $this->Void)
    {
       $s = $s . " CON " . $this->SubValLetra(intval($Frc)) . "CENTAVOS";
       //$s = $s . " " . $Frc . "/100";
    }
    return ($Signo . $s . " M/CTE");
   
}


function SubValLetra($numero) 
{
    $Ptr="";
    $n=0;
    $i=0;
    $x ="";
    $Rtn ="";
    $Tem ="";

    $x = trim("$numero");
    $n = strlen($x);

    $Tem = $this->Void;
    $i = $n;
    
    while( $i > 0)
    {
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                           str_repeat($this->Zero, $i - 1 )));
       If( $Tem != "CERO" )
          $Rtn .= $Tem . $this->SP;
       $i = $i - 1;
    }

    
    //--------------------- GoSub FiltroMil ------------------------------
    $Rtn=str_replace(" MIL MIL", " UN MIL", $Rtn );
    while(1)
    {
       $Ptr = strpos($Rtn, "MIL ");       
       If(!($Ptr===false))
       {
          If(! (strpos($Rtn, "MIL ",$Ptr + 1) === false ))
            $this->ReplaceStringFrom($Rtn, "MIL ", "", $Ptr);
          Else
           break;
       }
       else break;
    }

    //--------------------- GoSub FiltroCiento ------------------------------
    $Ptr = -1;
    do{
       $Ptr = strpos($Rtn, "CIEN ", $Ptr+1);
       if(!($Ptr===false))
       {
          $Tem = substr($Rtn, $Ptr + 5 ,1);
          if( $Tem == "M" || $Tem == $this->Void)
             ;
          else          
             $this->ReplaceStringFrom($Rtn, "CIEN", "CIENTO", $Ptr);
       }
    }while(!($Ptr === false));

    //--------------------- FiltroEspeciales ------------------------------
    $Rtn=str_replace("DIEZ UN", "ONCE", $Rtn );
    $Rtn=str_replace("DIEZ DOS", "DOCE", $Rtn );
    $Rtn=str_replace("DIEZ TRES", "TRECE", $Rtn );
    $Rtn=str_replace("DIEZ CUATRO", "CATORCE", $Rtn );
    $Rtn=str_replace("DIEZ CINCO", "QUINCE", $Rtn );
    $Rtn=str_replace("DIEZ SEIS", "DIECISEIS", $Rtn );
    $Rtn=str_replace("DIEZ SIETE", "DIECISIETE", $Rtn );
    $Rtn=str_replace("DIEZ OCHO", "DIECIOCHO", $Rtn );
    $Rtn=str_replace("DIEZ NUEVE", "DIECINUEVE", $Rtn );
    $Rtn=str_replace("VEINTE UN", "VEINTIUN", $Rtn );
    $Rtn=str_replace("VEINTE DOS", "VEINTIDOS", $Rtn );
    $Rtn=str_replace("VEINTE TRES", "VEINTITRES", $Rtn );
    $Rtn=str_replace("VEINTE CUATRO", "VEINTICUATRO", $Rtn );
    $Rtn=str_replace("VEINTE CINCO", "VEINTICINCO", $Rtn );
    $Rtn=str_replace("VEINTE SEIS", "VEINTISEIS", $Rtn );
    $Rtn=str_replace("VEINTE SIETE", "VEINTISIETE", $Rtn );
    $Rtn=str_replace("VEINTE OCHO", "VEINTIOCHO", $Rtn );
    $Rtn=str_replace("VEINTE NUEVE", "VEINTINUEVE", $Rtn );

    //--------------------- FiltroUn ------------------------------
    If(substr($Rtn,0,1) == "M") $Rtn = "UN " . $Rtn;
    //--------------------- Adicionar Y ------------------------------
    for($i=65; $i<=88; $i++)
    {
      If($i != 77)
         $Rtn=str_replace("A " . Chr($i), "* Y " . Chr($i), $Rtn);
    }
    $Rtn=str_replace("*", "A" , $Rtn);
    return($Rtn);
}


function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
}


function Parte($x)
{
    $Rtn='';
    $t='';
    $i='';
    Do
    {
      switch($x)
      {
         Case 0:  $t = "CERO";break;
         Case 1:  $t = "UN";break;
         Case 2:  $t = "DOS";break;
         Case 3:  $t = "TRES";break;
         Case 4:  $t = "CUATRO";break;
         Case 5:  $t = "CINCO";break;
         Case 6:  $t = "SEIS";break;
         Case 7:  $t = "SIETE";break;
         Case 8:  $t = "OCHO";break;
         Case 9:  $t = "NUEVE";break;
         Case 10: $t = "DIEZ";break;
         Case 20: $t = "VEINTE";break;
         Case 30: $t = "TREINTA";break;
         Case 40: $t = "CUARENTA";break;
         Case 50: $t = "CINCUENTA";break;
         Case 60: $t = "SESENTA";break;
         Case 70: $t = "SETENTA";break;
         Case 80: $t = "OCHENTA";break;
         Case 90: $t = "NOVENTA";break;
         Case 100: $t = "CIEN";break;
         Case 200: $t = "DOSCIENTOS";break;
         Case 300: $t = "TRESCIENTOS";break;
         Case 400: $t = "CUATROCIENTOS";break;
         Case 500: $t = "QUINIENTOS";break;
         Case 600: $t = "SEISCIENTOS";break;
         Case 700: $t = "SETECIENTOS";break;
         Case 800: $t = "OCHOCIENTOS";break;
         Case 900: $t = "NOVECIENTOS";break;
         Case 1000: $t = "MIL";break;
         Case 1000000: $t = "MILLON";break;
      }

      If($t == $this->Void)
      {
        $i = $i + 1;
        $x = $x / 1000;
        If($x== 0) $i = 0;
      }
      else
         break;
           
    }while($i != 0);
   
    $Rtn = $t;
    Switch($i)
    {
       Case 0: $t = $this->Void;break;
       Case 1: $t = " MIL";break;
       Case 2: $t = " MILLONES";break;
       Case 3: $t = " BILLONES";break;
    }
    return($Rtn . $t);
}

}

?>

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
	
function algo()
{
	var fil=document.getElementById('filast').value;
	alert(fil);
}

	
</script>
<!--fin val forms--> 
</head>
<body onLoad="algo();">
<?php
$id_ceva=$_GET['id1'];


include('../config.php');	
				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx1 = "select * from fecha";
$resultadoxx1 = $connectionxx->query($sqlxx1);

while($rowxx1 = $resultadoxx1->fetch_assoc()) 
{
  $id_emp=$rowxx1["id_emp"];
}

$sqlxx = "select * from ceva where id_auto_ceva ='$id_ceva' and id_emp='$id_emp'";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_manu_ceva = $rowxx["id_manu_ceva"];
  $fecha_ceva = $rowxx["fecha_ceva"];
  $tercero = $rowxx["tercero"];  
  $ccnit = $rowxx["ccnit"];  
  $concepto_pago = $rowxx["des_ceva"];  
  $total_pagado = $rowxx["total_pagado"];  
  $salud = $rowxx["salud"];  
  $pension = $rowxx["pension"];  
  $libranza = $rowxx["libranza"];  
  $f_solidaridad = $rowxx["f_solidaridad"];  
  $f_empleados = $rowxx["f_empleados"]; 
  $sindicato = $rowxx["sindicato"]; 
  $embargo = $rowxx["embargo"]; 
  $cruce = $rowxx["cruce"]; 
  $otros = $rowxx["otros"]; 
  $retefuente = $rowxx["retefuente"]; 
  $vr_retefuente = $rowxx["vr_retefuente"]; 
  $reteiva = $rowxx["reteiva"]; 
  $vr_reteiva = $rowxx["vr_reteiva"]; 
  $reteica = $rowxx["reteica"]; 
  $vr_reteica = $rowxx["vr_reteica"]; 
  $estampilla1 = $rowxx["estampilla1"]; 
  $vr_estampilla1 = $rowxx["vr_estampilla1"]; 
  $estampilla2 = $rowxx["estampilla2"]; 
  $vr_estampilla2 = $rowxx["vr_estampilla2"]; 
  $estampilla3 = $rowxx["estampilla3"]; 
  $vr_estampilla3 = $rowxx["vr_estampilla3"]; 
    $estampilla4 = $rowxx["estampilla4"]; 
  $vr_estampilla4 = $rowxx["vr_estampilla4"]; 
    $estampilla5 = $rowxx["estampilla5"]; 
  $vr_estampilla5 = $rowxx["vr_estampilla5"]; 
  $forma_pago = $rowxx["forma_pago"]; 
  $num_cheque = $rowxx["num_cheque"]; 
  $te = $rowxx["te"]; 
  $banco_cheque = $rowxx["banco_cheque"]; 
  $cta_cheque = $rowxx["cta_cheque"]; 
  $id_auto_cobp = $rowxx["id_auto_cobp"];   
   
  $num_cheque2 = $rowxx["num_cheque2"]; 
  $banco_cheque2 = $rowxx["banco_cheque2"]; 
  $cta_cheque2 = $rowxx["cta_cheque2"]; 
    $num_cheque3 = $rowxx["num_cheque3"]; 
  $banco_cheque3 = $rowxx["banco_cheque3"]; 
  $cta_cheque3 = $rowxx["cta_cheque3"];
    $num_cheque4 = $rowxx["num_cheque4"]; 
  $banco_cheque4 = $rowxx["banco_cheque4"]; 
  $cta_cheque4 = $rowxx["cta_cheque4"];
    $num_cheque5 = $rowxx["num_cheque5"]; 
  $banco_cheque5 = $rowxx["banco_cheque5"]; 
  $cta_cheque5 = $rowxx["cta_cheque5"];
    $num_cheque6 = $rowxx["num_cheque6"]; 
  $banco_cheque6 = $rowxx["banco_cheque6"]; 
  $cta_cheque6 = $rowxx["cta_cheque6"];
    $num_cheque7 = $rowxx["num_cheque7"]; 
  $banco_cheque7 = $rowxx["banco_cheque7"]; 
  $cta_cheque7 = $rowxx["cta_cheque7"];
    $num_cheque8 = $rowxx["num_cheque8"]; 
  $banco_cheque8 = $rowxx["banco_cheque8"]; 
  $cta_cheque8 = $rowxx["cta_cheque8"];
    $num_cheque9 = $rowxx["num_cheque9"]; 
  $banco_cheque9 = $rowxx["banco_cheque9"]; 
  $cta_cheque9 = $rowxx["cta_cheque9"];
    $num_cheque10 = $rowxx["num_cheque10"]; 
  $banco_cheque10 = $rowxx["banco_cheque10"]; 
  $cta_cheque10 = $rowxx["cta_cheque10"];
  $num_cheque11 = $rowxx["num_cheque11"]; 
  $banco_cheque11 = $rowxx["banco_cheque11"]; 
  $cta_cheque11 = $rowxx["cta_cheque11"];
    $num_cheque12 = $rowxx["num_cheque12"]; 
  $banco_cheque12 = $rowxx["banco_cheque12"]; 
  $cta_cheque12 = $rowxx["cta_cheque12"];
    $num_cheque13 = $rowxx["num_cheque13"]; 
  $banco_cheque13 = $rowxx["banco_cheque13"]; 
  $cta_cheque13 = $rowxx["cta_cheque13"];
    $num_cheque14 = $rowxx["num_cheque14"]; 
  $banco_cheque14 = $rowxx["banco_cheque14"]; 
  $cta_cheque14 = $rowxx["cta_cheque14"];
    $num_cheque15 = $rowxx["num_cheque15"]; 
  $banco_cheque15 = $rowxx["banco_cheque15"]; 
  $cta_cheque15 = $rowxx["cta_cheque15"];
  
  
}
 



?>
<form name="a" method="post" id="commentForm"  >
<table width="798" border="1" align="center" class="bordepunteado1">
  
  <tr>
    <td colspan="3" bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4 Estilo23"> MODIFICAR COMPROBANTE DE EGRESO VIGENCIA ACTUAL </div>
    </div></td>
    </tr>
  <tr>
    <td colspan="3" bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo21" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center"> <span class="Estilo25">
        No. <?php printf("%s",$id_manu_ceva); ?> 
      </span></div>
    </div></td>
    </tr>
  <tr>
    <td width="149" bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo4"><strong>Fecha : </strong></div>
    </div></td>
    <td width="631" colspan="2" bgcolor="#FFFFFF" class="Estilo4"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo4">
	  
	  <input name="fecha" type="text" class="Estilo4" id="inicio" value="<?php printf("%s",$fecha_ceva); ?>" size="14" />
	  <input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].inicio,'yyyy/mm/dd',this)" value="Ver Calendario" />
	  
	 
	  </div>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo25">A Favor de  : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF" class="Estilo4"><div class="Estilo21" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo4"><?php printf("%s",$tercero); ?></div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right" class="Estilo25">CC / NIT  : </div>
      </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF" class="Estilo4"><div class="Estilo21" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo4"><?php printf("%s",$ccnit); ?></div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo25">Concepto  : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF" class="Estilo4"><div class="Estilo21" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo4"><input name="concepto" type="text"  size="120" value="<?php printf("%s",$concepto_pago); ?>"></div>
    </div></td>
  </tr>
  
  
  <tr>
    <td bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo25">Por valor de   : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF" class="Estilo4"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <?php 
	
	
	$vr=$total_pagado;
	$num=$vr;
 $V=new EnLetras();
 echo "<font class='Estilo1'>". $V->ValorEnLetras($num,"PESOS") ."</font>";//concatenar propiedades entre comilla doble
	?></div></td>
  </tr>
</table>
<br>

<div align="center">
  <?php
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp ='$id_auto_cobp' order by id asc ";
$re = $cx->query($sq);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='4'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<div align='center' class='Estilo4'><strong>DATOS PRESUPUESTALES</strong></div>
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
$xx=$rw["vr_digitado"];
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
<td align='right'><span class='Estilo4'> %s &nbsp; </span></td>

</tr>

", $rw["cuenta"], $nom_rubro, $fte, number_format($xx,2,',','.')); 

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
    <td align='right'><span class='Estilo4'><b> %s &nbsp;</b> </span></td>
  </tr>
</table></center>",number_format($nuevo_total,2,',','.'));

//--------	

	?><br>

  <table width="800" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <DIV align="center"><STRONG>DESCUENTOS , DEDUCCIONES, RETENCIONES POR IMPUESTOS, TASAS Y   CONTRIBUCIONES </STRONG></DIV>
          </div>
      </div></td>
    </tr>
    <tr>
      <td width="200"></td>
      <td width="200"></td>
      <td width="200"></td>
      <td width="200"></td>
    </tr>
    <tr>
      <?php if($salud =='0') {
  }
  else
  {
  ?>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><STRONG>Salud</STRONG> : </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><?php printf("%s",number_format($salud,2,',','.')); ?> </div>
          </div>
      </div></td>
      <?php } ?>
      <?php if($pension =='0') {
  }
  else
  {
  ?>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><STRONG>Pension </STRONG>: </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><?php printf("%s",number_format($pension,2,',','.')); ?> </div>
          </div>
      </div></td>
      <?php } ?>
    </tr>
    <tr>
      <?php if($libranza =='0') {
  }
  else
  {
  ?>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><STRONG>Libranzas </STRONG> : </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><?php printf("%s",number_format($libranza,2,',','.')); ?> </div>
          </div>
      </div></td>
      <?php } ?>
      <?php if($f_solidaridad =='0') {
  }
  else
  {
  ?>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><STRONG>Fondo Solidaridad </STRONG> : </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><?php printf("%s",number_format($f_solidaridad,2,',','.')); ?> </div>
          </div>
      </div></td>
      <?php } ?>
    </tr>
    <tr>
      <?php if($f_empleados =='0') {
  }
  else
  {
  ?>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><STRONG>Fondo Empleados </STRONG> : </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><?php printf("%s",number_format($f_empleados,2,',','.')); ?> </div>
          </div>
      </div></td>
      <?php } ?>
      <?php if($sindicato =='0') {
  }
  else
  {
  ?>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><STRONG>Sindicatos </STRONG> : </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><?php printf("%s",number_format($sindicato,2,',','.')); ?> </div>
          </div>
      </div></td>
      <?php } ?>
    </tr>
    <tr>
      <?php if($embargo =='0') {
  }
  else
  {
  ?>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><STRONG>Embargos Judiciales </STRONG> : </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><?php printf("%s",number_format($embargo,2,',','.')); ?> </div>
          </div>
      </div></td>
      <?php } ?>
      <?php if($cruce =='0') {
  }
  else
  {
  ?>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><STRONG>Cruce de Cuentas </STRONG> : </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><?php printf("%s",number_format($cruce,2,',','.')); ?> </div>
          </div>
      </div></td>
      <?php } ?>
    </tr>
    <tr>
      <?php if($otros =='0') {
  }
  else
  {
  ?>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><STRONG>Otros </STRONG> : </div>
          </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
          <div align="center" class="Estilo12">
            <div align="right"><?php printf("%s",number_format($otros,2,',','.')); ?> </div>
          </div>
      </div></td>
      <?php } ?>
      <td bgcolor="#FFFFFF"></td>
      <td bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
      <td colspan="4"><table width="800" border="0" align="center">
          <tr>
            <td width="200"></td>
            <td width="200"></td>
            <td width="200"></td>
            <td width="200"></td>
          </tr>
          <tr>
            <?php if($retefuente =='' and $vr_retefuente == '') {
  }
  else
  {
  ?>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><strong>RETEFUENTE</strong> : </div>
                </div>
            </div></td>
            <td colspan="2"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="left"><?php printf("%s",$retefuente); ?> </div>
                </div>
            </div></td>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><?php printf("%s",number_format($vr_retefuente,2,',','.')); ?> </div>
                </div>
            </div></td>
            <?php
 }
 ?>
          </tr>
          <tr>
            <?php if($reteiva =='' and $vr_reteiva == '') {
  }
  else
  {
  ?>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><strong>RETEIVA</strong> : </div>
                </div>
            </div></td>
            <td colspan="2"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="left"><?php printf("%s",$reteiva); ?> </div>
                </div>
            </div></td>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><?php printf("%s",number_format($vr_reteiva,2,',','.')); ?> </div>
                </div>
            </div></td>
            <?php } ?>
          </tr>
          <tr>
            <?php if($reteica =='' and $vr_reteica == '0') {
  }
  else
  {
  ?>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><strong>RETEICA / Otro</strong> : </div>
                </div>
            </div></td>
            <td colspan="2"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="left"><?php printf("%s",$reteica); ?> </div>
                </div>
            </div></td>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><?php printf("%s",number_format($vr_reteica,2,',','.')); ?> </div>
                </div>
            </div></td>
            <?php } ?>
          </tr>
          <tr>
            <?php if($estampilla1 =='' and $vr_estampilla1 == '0') {
  }
  else
  {
  ?>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><strong>ESTAMPILLA1</strong> : </div>
                </div>
            </div></td>
            <td colspan="2"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="left"><?php printf("%s",$estampilla1); ?> </div>
                </div>
            </div></td>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><?php printf("%s",number_format($vr_estampilla1,2,',','.')); ?> </div>
                </div>
            </div></td>
            <?php } ?>
          </tr>
          <tr>
            <?php if($estampilla2 =='' and $vr_estampilla2 == '0') {
  }
  else
  {
  ?>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><strong>ESTAMPILLA2</strong> : </div>
                </div>
            </div></td>
            <td colspan="2"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="left"><?php printf("%s",$estampilla2); ?> </div>
                </div>
            </div></td>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><?php printf("%s",number_format($vr_estampilla2,2,',','.')); ?> </div>
                </div>
            </div></td>
            <?php } ?>
          </tr>
          <tr>
            <?php if($estampilla3 =='' and $vr_estampilla3 == '0') {
  }
  else
  {
  ?>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><strong>ESTAMPILLA3</strong> : </div>
                </div>
            </div></td>
            <td colspan="2"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="left"><?php printf("%s",$estampilla3); ?> </div>
                </div>
            </div></td>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><?php printf("%s",number_format($vr_estampilla3,2,',','.')); ?> </div>
                </div>
            </div></td>
            <?php } ?>
          </tr>
          <tr>
            <?php if($estampilla4 =='' and $vr_estampilla4 == '0') {
  }
  else
  {
  ?>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><strong>ESTAMPILLA4</strong> : </div>
                </div>
            </div></td>
            <td colspan="2"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="left"><?php printf("%s",$estampilla4); ?> </div>
                </div>
            </div></td>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><?php printf("%s",number_format($vr_estampilla4,2,',','.')); ?> </div>
                </div>
            </div></td>
            <?php } ?>
          </tr>
          <tr>
            <?php if($estampilla5 =='' and $vr_estampilla5 == '0') {
  }
  else
  {
  ?>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><strong>ESTAMPILLA5</strong> : </div>
                </div>
            </div></td>
            <td colspan="2"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="left"><?php printf("%s",$estampilla5); ?> </div>
                </div>
            </div></td>
            <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><?php printf("%s",number_format($vr_estampilla5,2,',','.')); ?> </div>
                </div>
            </div></td>
            <?php } ?>
          </tr>
          <tr>
            <td><?php 
		$tot_desc = $salud+$pension+$libranza+$f_solidaridad+$f_empleados+$sindicato+$embargo+$cruce+$otros;
		//printf("%s",number_format($tot_desc,2,',','.')); 
		
		?>
            </td>
            <td colspan="2" bgcolor="#CCCCCC"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="center"><strong>TOTAL DESCTOS., DEDUCC/ y RETENCIONES</strong></div>
                </div>
            </div></td>
            <td bgcolor="#CCCCCC"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                <div align="center" class="Estilo21">
                  <div align="right"><strong>
                    <?php 
		$tot_rete=$vr_retefuente+$vr_reteica+$vr_reteiva+$vr_estampilla1+$vr_estampilla2+$vr_estampilla3+$vr_estampilla4+$vr_estampilla5 + $tot_desc;
		printf("%s",number_format($tot_rete,2,',','.'));
		
		?>
                  </strong></div>
                </div>
            </div></td>
          </tr>
      </table></td>
    </tr>
  </table>	
</div>
<br>
<div align="center">
<?php
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }

$sqlxxa = "select * from ceva where id_auto_ceva ='$id_ceva'";
$resultadoxxa = mysql_db_query($database, $sqlxxa, $connectionxx);
$filas= mysql_num_rows($resultadoxxa);

while($rowxxa = mysql_fetch_array($resultadoxxa)) 
   {
   
	$id_manu_ncon = substr($rowxxa["id_manu_ncon"],4,100);
	$id_auto_ncon = $rowxxa["id_auto_ncon"];
	$fecha_ncon = $rowxxa["fecha_ncon"];
	$tercero = $rowxxa["tercero"];
	$des_ncon = $rowxxa["des_ncon"];
	
	$pgcp1 = $rowxxa['pgcp1'];
	$pgcp2 = $rowxxa['pgcp2'];
	$pgcp3 = $rowxxa['pgcp3'];
	$pgcp4 = $rowxxa['pgcp4'];
	$pgcp5 = $rowxxa['pgcp5'];
	$pgcp6 = $rowxxa['pgcp6'];
	$pgcp7 = $rowxxa['pgcp7'];
	$pgcp8 = $rowxxa['pgcp8'];
	$pgcp9 = $rowxxa['pgcp9'];
	$pgcp10 = $rowxxa['pgcp10'];
	$pgcp11 = $rowxxa['pgcp11'];
	$pgcp12 = $rowxxa['pgcp12'];
	$pgcp13 = $rowxxa['pgcp13'];
	$pgcp14 = $rowxxa['pgcp14'];
	$pgcp15 = $rowxxa['pgcp15'];
	
	$vr_deb_1 = $rowxxa['vr_deb_1'];
	$vr_deb_2 = $rowxxa['vr_deb_2'];
	$vr_deb_3 = $rowxxa['vr_deb_3'];
	$vr_deb_4 = $rowxxa['vr_deb_4'];
	$vr_deb_5 = $rowxxa['vr_deb_5'];
	$vr_deb_6 = $rowxxa['vr_deb_6'];
	$vr_deb_7 = $rowxxa['vr_deb_7'];
	$vr_deb_8 = $rowxxa['vr_deb_8'];
	$vr_deb_9 = $rowxxa['vr_deb_9'];
	$vr_deb_10 = $rowxxa['vr_deb_10'];
	$vr_deb_11 = $rowxxa['vr_deb_11'];
	$vr_deb_12 = $rowxxa['vr_deb_12'];
	$vr_deb_13 = $rowxxa['vr_deb_13'];
	$vr_deb_14 = $rowxxa['vr_deb_14'];
	$vr_deb_15 = $rowxxa['vr_deb_15'];
	
	$vr_cre_1 = $rowxxa['vr_cre_1'];
	$vr_cre_2 = $rowxxa['vr_cre_2'];
	$vr_cre_3 = $rowxxa['vr_cre_3'];
	$vr_cre_4 = $rowxxa['vr_cre_4'];
	$vr_cre_5 = $rowxxa['vr_cre_5'];
	$vr_cre_6 = $rowxxa['vr_cre_6'];
	$vr_cre_7 = $rowxxa['vr_cre_7'];
	$vr_cre_8 = $rowxxa['vr_cre_8'];
	$vr_cre_9 = $rowxxa['vr_cre_9'];
	$vr_cre_10 = $rowxxa['vr_cre_10'];
	$vr_cre_11 = $rowxxa['vr_cre_11'];
	$vr_cre_12 = $rowxxa['vr_cre_12'];
	$vr_cre_13 = $rowxxa['vr_cre_13'];
	$vr_cre_14 = $rowxxa['vr_cre_14'];
	$vr_cre_15 = $rowxxa['vr_cre_15'];
	

	$num_cheque = $rowxxa["num_cheque"];
	$num_cheque2 = $rowxxa["num_cheque2"];
	$num_cheque3 = $rowxxa["num_cheque3"];
	$num_cheque4 = $rowxxa["num_cheque4"];
	$num_cheque5 = $rowxxa["num_cheque5"];
	$num_cheque6 = $rowxxa["num_cheque6"];
	$num_cheque7 = $rowxxa["num_cheque7"];
	$num_cheque8 = $rowxxa["num_cheque8"];
	$num_cheque9 = $rowxxa["num_cheque9"];
	$num_cheque10 = $rowxxa["num_cheque10"];
	$num_cheque11 = $rowxxa["num_cheque11"];
	$num_cheque12 = $rowxxa["num_cheque12"];
	$num_cheque13 = $rowxxa["num_cheque13"];
	$num_cheque14 = $rowxxa["num_cheque14"];
	$num_cheque15 = $rowxxa["num_cheque15"];
	
	

 
   }   
   
   
?>

<br>
  	  <script>
function muestraURL(){
var miPopup
miPopup = window.open("../pgcp/consulta_cta.php","CONTAFACIL","width=800,height=400,menubar=no,scrollbars=yes")
}
</script>

<input name="filast" type="hidden" id="filast"  value="<?php printf("%s",$filas);?>"/>
<table width="300" border="0" align="center">
  <tr>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
    <td width="200" valign="middle"><div align="center"><a href="#" onClick="muestraURL()">BUSCAR CUENTA PGCP</a></div></td>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
  </tr>
</table>
<br>

<table width="1000" border="1" id="tablaf" align="center" class="bordepunteado1">   
 
    </table>

<br>

<table width="1034" border="1" align="center" class="bordepunteado1">
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
            <span class="Estilo21">Presione la barra espaciadora dentro de cada codigo para ver los datos de la cuenta </span> </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo12"><strong>VALOR DEBITO </strong></div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo12"><strong>VALOR CREDITO </strong></div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo12"><strong>No. Dcto / cheque </strong></div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp1" type="text" class="Estilo12" id="pgcp1" style="width:180px;" onKeyUp="chk_pgcp1();" value="<?php printf("%s",$pgcp1);?>"/>
    </span> </div></td>
    <td><div align="left" class="Estilo21" id='resultado'></div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_1" type="text" class="Estilo12" id="vr_deb_1" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_1);?>"  onkeyup="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_1" type="text" class="Estilo12" id="vr_cre_1" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_1);?>"  onkeyup="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque" type="text" class="Estilo12" id="num_cheque" style="text-align:right" value="<?php printf("%s",$num_cheque);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp2" type="text" class="Estilo12" id="pgcp2" style="width:180px;" onKeyUp="chk_pgcp2();" value="<?php printf("%s",$pgcp2);?>"/>
    </span> </div></td>
    <td bgcolor="#F5F5F5"><div align="left" class="Estilo21" id='resultado2'></div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_2" type="text" class="Estilo12" id="vr_deb_2" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_2);?>"  onkeyup="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_2" type="text" class="Estilo12" id="vr_cre_2" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_2);?>"  onkeyup="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque2" type="text" class="Estilo12" id="num_cheque2" style="text-align:right" value="<?php printf("%s",$num_cheque2);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp3" type="text" class="Estilo12" id="pgcp3" style="width:180px;" onKeyUp="chk_pgcp3();" value="<?php printf("%s",$pgcp3);?>"/>
    </span> </div></td>
    <td><div align="left" class="Estilo21" id='resultado3'></div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_3" type="text" class="Estilo12" id="vr_deb_3" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_3);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_3" type="text" class="Estilo12" id="vr_cre_3" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_3);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque3" type="text" class="Estilo12" id="num_cheque3" style="text-align:right" value="<?php printf("%s",$num_cheque3);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp4" type="text" class="Estilo12" id="pgcp4" style="width:180px;" onKeyUp="chk_pgcp4();" value="<?php printf("%s",$pgcp4);?>"/>
    </span> </div></td>
    <td bgcolor="#F5F5F5"><div align="left" class="Estilo21" id='resultado4'></div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_4" type="text" class="Estilo12" id="vr_deb_4" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_4);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_4" type="text" class="Estilo12" id="vr_cre_4" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_4);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque4" type="text" class="Estilo12" id="num_cheque4" style="text-align:right" value="<?php printf("%s",$num_cheque4);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp5" type="text" class="Estilo12" id="pgcp5" style="width:180px;" onKeyUp="chk_pgcp5();" value="<?php printf("%s",$pgcp5);?>"/>
    </span> </div></td>
    <td><div align="left" class="Estilo21" id='resultado5'></div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_5" type="text" class="Estilo12" id="vr_deb_5" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_5);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_5" type="text" class="Estilo12" id="vr_cre_5" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_5);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque5" type="text" class="Estilo12" id="num_cheque5" style="text-align:right" value="<?php printf("%s",$num_cheque5);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp6" type="text" class="Estilo12" id="pgcp6" style="width:180px;" onKeyUp="chk_pgcp6();" value="<?php printf("%s",$pgcp6);?>"/>
    </span> </div></td>
    <td bgcolor="#F5F5F5"><div align="left" class="Estilo21" id='resultado6'></div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_6" type="text" class="Estilo12" id="vr_deb_6" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_6);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_6" type="text" class="Estilo12" id="vr_cre_6" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_6);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:6px; padding-top:3px; padding-right:6px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque6" type="text" class="Estilo12" id="num_cheque6" style="text-align:right" value="<?php printf("%s",$num_cheque6);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp7" type="text" class="Estilo12" id="pgcp7" style="width:180px;" onKeyUp="chk_pgcp7();" value="<?php printf("%s",$pgcp7);?>"/>
    </span> </div></td>
    <td><div align="left" class="Estilo21" id='resultado7'></div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_7" type="text" class="Estilo12" id="vr_deb_7" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_7);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_7" type="text" class="Estilo12" id="vr_cre_7" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_7);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque7" type="text" class="Estilo12" id="num_cheque7" style="text-align:right" value="<?php printf("%s",$num_cheque7);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp8" type="text" class="Estilo12" id="pgcp8" style="width:180px;" onKeyUp="chk_pgcp8();" value="<?php printf("%s",$pgcp8);?>"/>
    </span> </div></td>
    <td bgcolor="#F5F5F5"><div align="left" class="Estilo21" id='resultado8'></div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_8" type="text" class="Estilo12" id="vr_deb_8" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_8);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_8" type="text" class="Estilo12" id="vr_cre_8" style="text-align:right" onKeyPress="return validar(event)" /value="<?php printf("%s",$vr_cre_8);?>"  onkeyup="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque8" type="text" class="Estilo12" id="num_cheque8" style="text-align:right" value="<?php printf("%s",$num_cheque8);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp9" type="text" class="Estilo12" id="pgcp9" style="width:180px;" onKeyUp="chk_pgcp9();" value="<?php printf("%s",$pgcp9);?>"/>
    </span> </div></td>
    <td><div align="left" class="Estilo21" id='resultado9'></div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_9" type="text" class="Estilo12" id="vr_deb_9" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_9);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_9" type="text" class="Estilo12" id="vr_cre_9" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_9);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque9" type="text" class="Estilo12" id="num_cheque9" style="text-align:right" value="<?php printf("%s",$num_cheque9);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp10" type="text" class="Estilo12" id="pgcp10" style="width:180px;" onKeyUp="chk_pgcp10();" value="<?php printf("%s",$pgcp10);?>"/>
    </span> </div></td>
    <td bgcolor="#F5F5F5"><div align="left" class="Estilo21" id='resultado10'></div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_10" type="text" class="Estilo12" id="vr_deb_10" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_10);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_10" type="text" class="Estilo12" id="vr_cre_10" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_10);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque10" type="text" class="Estilo12" id="num_cheque10" style="text-align:right" value="<?php printf("%s",$num_cheque10);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp11" type="text" class="Estilo12" id="pgcp11" style="width:180px;" onKeyUp="chk_pgcp11();" value="<?php printf("%s",$pgcp11);?>"/>
    </span> </div></td>
    <td><div align="left" class="Estilo21" id='resultado11'></div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_11" type="text" class="Estilo12" id="vr_deb_11" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_11);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_11" type="text" class="Estilo12" id="vr_cre_11" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_11);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque11" type="text" class="Estilo12" id="num_cheque11" style="text-align:right" value="<?php printf("%s",$num_cheque11);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp12" type="text" class="Estilo12" id="pgcp12" style="width:180px;" onKeyUp="chk_pgcp12();" value="<?php printf("%s",$pgcp12);?>"/>
    </span> </div></td>
    <td bgcolor="#F5F5F5"><div align="left" class="Estilo21" id='resultado12'></div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_12" type="text" class="Estilo12" id="vr_deb_12" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_12);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_12" type="text" class="Estilo12" id="vr_cre_12" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_12);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque12" type="text" class="Estilo12" id="num_cheque122" style="text-align:right" value="<?php printf("%s",$num_cheque12);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp13" type="text" class="Estilo12" id="pgcp13" style="width:180px;" onKeyUp="chk_pgcp13();" value="<?php printf("%s",$pgcp13);?>"/>
    </span> </div></td>
    <td><div align="left" class="Estilo21" id='resultado13'></div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_13" type="text" class="Estilo12" id="vr_deb_13" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_13);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_13" type="text" class="Estilo12" id="vr_cre_13" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_13);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque13" type="text" class="Estilo12" id="num_cheque13" style="text-align:right" value="<?php printf("%s",$num_cheque13);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp14" type="text" class="Estilo12" id="pgcp14" style="width:180px;" onKeyUp="chk_pgcp14();" value="<?php printf("%s",$pgcp14);?>"/>
    </span> </div></td>
    <td bgcolor="#F5F5F5"><div align="left" class="Estilo21" id='resultado14'></div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_14" type="text" class="Estilo12" id="vr_deb_14" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_14);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_14" type="text" class="Estilo12" id="vr_cre_14" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_14);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque14" type="text" class="Estilo12" id="num_cheque14" style="text-align:right" value="<?php printf("%s",$num_cheque14);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
      <input name="pgcp15" type="text" class="Estilo12" id="pgcp15" style="width:180px;" onKeyUp="chk_pgcp15();" value="<?php printf("%s",$pgcp15);?>"/>
    </span> </div></td>
    <td><div align="left" class="Estilo21" id='resultado15'></div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_deb_15" type="text" class="Estilo12" id="vr_deb_15" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_deb_15);?>" onKeyUp="Calcular();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="vr_cre_15" type="text" class="Estilo12" id="vr_cre_15" style="text-align:right" onKeyPress="return validar(event)" value="<?php printf("%s",$vr_cre_15);?>" onKeyUp="Calcularc();"/>
        </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo12">
        <div align="center">
          <input name="num_cheque15" type="text" class="Estilo12" id="num_cheque15" style="text-align:right" value="<?php printf("%s",$num_cheque15);?>"/>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#990000">&nbsp;</td>
    <td bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8 Estilo9">
          <div align="center" class="Estilo26">VERIFIQUE QUE LAS SUMAS SEAN IGUALES ANTES DE GRABAR</div>
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
    <td width="190"> <input name="id_ceva" type="hidden" value="<?php printf("%s",$id_ceva);?>"/></td>
    <td width="420">&nbsp;</td>
    <td width="130">&nbsp;</td>
    <td width="130">&nbsp;</td>
    <td width="130">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
       
		<input name="Submit" type="submit" class="Estilo21" value="Modifica CEVA " onClick="this.form.action = 'p_modifica_ceva.php'"/>
      </div>
    </div></td>
  </tr>
</table>
</div>
<table width="800" border="0" align="center">
  <tr>
    <td width="798" colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='pagos_tesoreria.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
    </tr>
</table>
<br>
<center>
</center>
</form>
</body>
</html>
<?php
}
?>