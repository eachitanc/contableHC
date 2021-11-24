<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
include('../config.php');     
	// verifico permisos del usuario
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT conta FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['conta']=='SI')
{
          
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
$mesh = array('cc','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   $idxx=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
   }
   list($an, $me, $di)  = explode('/', $ano);

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
.Estilo8 {
    color: #990000;
    font-weight: bold;
}
</style>
<!--muestra - oculta naturales -->
<script language="JavaScript" type="text/javascript" src="javas.js"></script>
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

function mostrah(){
 document.getElementById("caja14").style.display = "block";
document.getElementById("toncon").style.display = "none";
}
function quitarh(){
 document.getElementById("caja14").style.display = "none";
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



<script language="JavaScript">
<!--
var nav4 = window.Event ? true : false;
function acceptNum(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57));
}
//-->
</script>

<!--linea de insercion del jquery-->

<script type="text/javascript" language="javascript" src="../jquery.js"></script>


<!-- inicio mostrar tabla-->

<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar").click(function(event) {
event.preventDefault();
$("#caja").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja").slideUp();
});
});
</script>
<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar2").click(function(event) {
event.preventDefault();
$("#caja2").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja2").slideUp();
});
});
</script>
<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar3").click(function(event) {
event.preventDefault();
$("#caja3").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja3").slideUp();
});
});
</script>
<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar4").click(function(event) {
event.preventDefault();
$("#caja4").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja4").slideUp();
});
});
</script>
<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar5").click(function(event) {
event.preventDefault();
$("#caja5").slideToggle();
$("#toncon").slideUp();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja5").slideUp();
});
});
</script>
<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar6").click(function(event) {
event.preventDefault();
$("#caja6").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja6").slideUp();
});
});
</script>
<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar7").click(function(event) {
event.preventDefault();
$("#caja7").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja7").slideUp();
});
});
</script>
<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar8").click(function(event) {
event.preventDefault();
$("#caja8").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja8").slideUp();
});
});
</script>
<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar9").click(function(event) {
event.preventDefault();
$("#caja9").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja9").slideUp();
});
});
</script>
<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar10").click(function(event) {
event.preventDefault();
$("#caja10").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja10").slideUp();
});
});
</script>
<!--**************************-->
<style type="text/css">
body {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #666666; 
}

a{color:#993300; text-decoration:none;}

#caja {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

#caja2 {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar2{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

#caja3 {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar3{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

#caja4 {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar4{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

#caja5 {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar5{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

#caja6 {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar6{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

#caja7 {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar7{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

#caja8 {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar8{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

#caja9 {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar9{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}

#caja10 {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar10{
display:block;
width:100%;
padding:5px;
border:2px solid #D0E8F4;
background-color:#ECF8FD;
}
</style>

<!-- fin mostrar tabla--> 


<!--propiedades de las tablas-->

<style type="text/css" title="currentStyle">
@import "../libscroll/css/demo_table.css";
</style>
<!--<script type="text/javascript" language="javascript" src="../libscroll/js/jquery.js"></script>-->
<script type="text/javascript" language="javascript" src="../libscroll/js/jquery.dataTables.js"></script>


<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla1').dataTable( {
"sPaginationType": "full_numbers"
} );
} );
</script>


<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla2').dataTable( {
"sPaginationType": "full_numbers"
} );
} );
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla3').dataTable( {
"sPaginationType": "full_numbers"
} );
} );
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla4').dataTable( {
"sPaginationType": "full_numbers"
} );
} );
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla5').dataTable( {
"sPaginationType": "full_numbers"
} );
} );
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla6').dataTable( {
"sPaginationType": "full_numbers"
} );
} );

</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla7').dataTable( {
"sPaginationType": "full_numbers"
} );
} );
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla8').dataTable( {
"sPaginationType": "full_numbers"
} );
} );
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla9').dataTable( {
"sPaginationType": "full_numbers"
} );
} );
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla10').dataTable( {
"sPaginationType": "full_numbers"
} );
} );
</script>



<!-- FIN propiedades de las tablas-->


<SCRIPT TYPE="text/javascript" LANGUAGE="javascript">

<!-- PreLoad Wait - Script -->
<!-- This script and more from http://www.rainbow.arch.scriptmania.com 

function waitPreloadPage() { //DOM
if (document.getElementById){
document.getElementById('prepage').style.visibility='hidden';
}else{
if (document.layers){ //NS4
document.prepage.visibility = 'hidden';
}
else { //IE4
document.all.prepage.style.visibility = 'hidden';
}
}
}
// End -->

</SCRIPT>

</head>
<body>
<!--<body onLoad="waitPreloadPage();">
<DIV id="prepage" style="position:absolute; font-family:arial; font-size:16; left:0px; top:0px; background-color:white; layer-background-color:white; height:100%; width:100%;">
<center> 
<br /><br /><br /><br />
<TABLE width=100%><TR><TD><B class="Estilo4">Optimizando Listados para Busqueda y Ordenamiento Rapido ... ... Por favor Espere !</B></TD>
</TR></TABLE>
</center>
</DIV>-->

<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
    <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
      <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />    </div>
    </div>  </td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
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
    <td colspan="3">
    <div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>MOVIMIENTOS CONTABLES</strong></div>
    </div>  </td>
  </tr>
  <tr>
    <td colspan="3">
    <div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
<form method="post" action="menu_cont.php">
  <table width="800" border="0" align="center">
    <tr >
      <td width="600">
        <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right"><span class="Estilo4"><strong>Seleccione el Comprobante </strong>: </span>
            <select name="nn" class="Estilo4" style="width: 350px;">
              <?
include('../config.php');

$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM dctos_fuente_comprobantes  WHERE id_emp = '$idxx' AND cont = 'SI' ";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
    $r = mysql_fetch_array($rs);
    echo "<OPTION VALUE=\"".$r["cod"]."\">".$r["cod"]." - ".$r["nombre"]."</b></OPTION>";
}

$sq3 ="select cargo from usuarios2 where login = '$_SESSION[login]'";
$re3 = mysql_db_query($database,$sq3,$db);
$rw3 = mysql_fetch_array($re3);
if ($rw3['cargo'] == "REVISOR")
{
	$ver_boton = "style=display:none";
}

?>
            </select>
          </div>
        </div></td>
      <td width="190"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <input id="btncomp" name="Submit" type="submit" class="Estilo4" value="Seleccionar Comprobante" />
        </div>
      </div></td>
    </tr>
  </table>
</form>
<form method="post" action="menu_cont.php">
  <table width="800" border="0" align="center">
    <tr>
      <td width="600"><?php 
include('../config.php');               
?>
        <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right"><span class="Estilo4"><strong>Seleccione el Soporte </strong>: </span>
            <select name="nn" class="Estilo4" style="width: 350px;">
              <?
			  	// Datos para mostrar listas
	$ini=$_GET['ini'];
	$fin=$_GET['fin'];	
	$indice =$_GET['k'];
	$muestra = 250;
	if (!$_GET['ini']) 
	{
		$ini=0;
		$fin=$muestra;	
	}

include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM dctos_fuente_soportes  WHERE id_emp = '$idxx' AND afecta_con = 'SI' ";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
    $r = mysql_fetch_array($rs);
    echo "<OPTION VALUE=\"".$r["cod"]."\">".$r["cod"]." - ".$r["nombre"]."</b></OPTION>";
}
?>
            </select>
          </div>
        </div></td>
      <td width="190"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <input name="Submit" type="submit" class="Estilo4" value="Seleccionar Soporte" />
        </div>
      </div></td>
    </tr>
  </table>
</form>

  <div align="center">
    <?
	
$a="";
if(isset($_POST['nn']))
{$a=$_POST['nn'];
}

if(isset($_GET['a']))
{$a=$_GET['a'];
}


$archivo ="menu_cont.php";  // Para que el formulario del filtro me procese el nombre del archivo como action

if ($a == 'CAIC')
{

?>
<BR />
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
      <div align="center" class="Estilo4"><strong>CAUSACION DE CARTERA - CAIC <BR />
        <BR />
        <BR />
</strong></div></div>
<?php include('../objetos/filtro.php');  

if  ($pendiente =="") 
{

}else{
?>
<br />
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'><b>
      LISTA DE RECONOCIMIENTOS  ALMACENADOS</strong> &quot;SIN CONTABILIZAR&quot; </b><br />
      Estos Reconocimientos pueden ser Modificados accediendo a la Opcion 2.4.1 del Menu Principal </div>
		</div></div>
	<BR />
	
	<?php
	//-------
	
	include('../config.php');               
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	
	if  ($_POST["buscar"] != "")
	{
	$filtro ="and (id_manu_reip LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') "; 
	} 
	
	$a = "select distinct(consecutivo),sum(valor) as total, tercero , fecha_reg, id_manu_reip, valor from reip_ing where id_emp = '$idxx' and contab = 'NO'";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fecha_reg between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fecha_reg ='$fechafil'";}
	if ($fecha2 == "A�O"){$f= "and fecha_reg between '$a1' and '$a2'";}
	$gby = "group by consecutivo";
	$orden = "order by fecha_reg desc";
	$sq2 = "$a $c $filtro $f $gby $orden"; 

	$re = mysql_db_query($database, $sq2, $cx);
	
	echo("
	<center>
	<table width='100%' border='1' class=\"bordepunteado1\">
	<thead>
	<tr bgcolor='#DCE9E5'>
	<th align='center' width='15%' >
	<div style='padding-left:1px; padding-top:5px; padding-right:1px; padding-bottom:5px;'>
	<span class='Estilo4'><b>FECHA</b></span>
	</div>
	</th>
	<th align='center' width='10%' ><span class='Estilo4'><b>REIP</b></span></th>
	<th align='center' width='35%' ><span class='Estilo4'><b>TERCERO</b></span></th>
	<th align='center' width='20%' ><span class='Estilo4'><b>VALOR</b></span></th>
	<th align='center' width='20%' ><span class='Estilo4'><b>CONTABILIZAR</b></span></th>
	</tr>
	
	</thead>
	<tbody>
	");
	
	while($rw = mysql_fetch_array($re)) 
	   {
	printf("
	
	<tr>
	<td align='center' >
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>&nbsp;%s</span>
	</div>
	</td>
	<td align='left' ><span class='Estilo4'>&nbsp;%s</span></td>
	<td align='left' ><span class='Estilo4'>&nbsp;%s</span></td>
	<td align='right' width='200'><span class='Estilo4'>%s</span></td>
	
	<td align='center' >
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<form method='post' action='cartera_cont.php'>
	<input type='hidden' name='consecutivo_reip' > <a $ver_boton href='cartera_cont.php?valor=%s' style='color:#00C'> Contabilizar </a>
	</form>
	</div>
	</td>
	
	</tr>", $rw["fecha_reg"], $rw["id_manu_reip"], $rw["tercero"], $rw["total"], $rw["consecutivo"]); 
	
	
	   }
	
	printf("</tbody></table></center>");
	//--------  ------------------------------------------------------
}
	

if  ($registrado =="") 
{

}else{
	
	?>
	
	
	<BR />
	<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
		  <div align="center"><strong>      <span class="Estilo4">LISTA DE CAUSACIONES DE CARTERA ALMACENADAS Y </span></strong> <span class="Estilo4">&quot;CONTABILIZADAS&quot; <BR />
			  <BR />
			  <a href="../recaudos_tesoreria/recaudos_tesoreria.php" target="_parent">...::: IR A TESORERIA :::...      </a></span></div>
		</div>
	<BR />

	<?
	$limitar = "limit $ini,$fin";
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	
	if  ($_POST["buscar"] != "")
	{
	$filtro ="and (consec_cartera LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') "; 
	$limitar ='';
	} 
	
	$a = "select * from cartera_cont where id_emp = '$idxx'";
		if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
		if ($fecha2 == "MES"){$f= "and fecha_causa between '$f1' and '$f2'";}
		if ($fecha2 == "DIA"){$f= "and fecha_causa ='$fechafil'";}
		if ($fecha2 == "A�O"){$f= "and fecha_causa between '$a1' and '$a2'";}
		$gby = "";
		$orden = "order by fecha_causa desc, id desc";
		$sq = "$a $b $c $filtro $f $gby $orden"; 
		$resf =mysql_db_query($database,$sq,$cx);
		$filas = mysql_num_rows($resf);
		$listas = ceil($filas / $muestra);
		$sq2 = "$a $b $c $filtro $f $gby $orden $limitar";
		
	$re = mysql_db_query($database, $sq2, $cx);
	
	echo("
	<center>
	<table width='100%' border='1' class=\"bordepunteado1\" cellspacing='3'>
	<thead>
	
	<tr bgcolor='#DCE9E5'>
	<th align='center' width='5%'>
	<div style='padding-left:1px; padding-top:5px; padding-right:1px; padding-bottom:5px;'>
	<span class='Estilo4'><b>CONSEC.</b></span>
	</div>
	</th>
	<th align='center' width='10%'><span class='Estilo4'><b>FECHA CAUSAC.</b></span></th>
	<th align='center' width='10%'<span class='Estilo4'><b>REIP</b></span></th>
	<th align='center' width='10%'><span class='Estilo4'><b>FECHA REIP.</b></span></th>
	<th align='center' width='31%'><span class='Estilo4'><b>TERCERO</b></span></th>
	<th align='center' width='14%'><span class='Estilo4'><b>VALOR</b></span></th>
	<th align='center' width='14%'><span class='Estilo4'><b>CONTABILIZADO?</b></span></th>
	<th align='center' width='3%'<span class='Estilo4'></span></th>
	<th align='center' width='3%'><span class='Estilo4'></span></th>
	<th align='center' width='3%'><span class='Estilo4'></span></th>
	</tr>
	
	</thead>
	<tbody>
	");
	
	while($rw = mysql_fetch_array($re)) 
	   {
	
	$ab = $rw["id_reip"];
	$td1 = $rw["tot_deb"];
	$tc1 = $rw["tot_cre"];
	
	$sqlxx3 = "select fecha_reg, id_manu_reip from reip_ing where id_emp = '$idxx' and consecutivo ='$ab' ";
	$resultadoxx3 = mysql_db_query($database, $sqlxx3, $cx);
	$rowxx3 = mysql_fetch_array($resultadoxx3);
	$fech_reip=$rowxx3["fecha_reg"];
	$id_manu_reip=$rowxx3["id_manu_reip"];
	
	
	printf("
	
	<tr>
	<td align='center'>
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>%s</span>
	</div>
	</td>
	
	<td align='center'><span class='Estilo4'>%s</span></td>
	<td align='center' ><span class='Estilo4'>%s</span></td>
	<td align='center' ><span class='Estilo4'>%s</span></td>
	<td align='left' ><span class='Estilo4'>&nbsp;%s</span></td>
	<td align='right' ><span class='Estilo4'>&nbsp;%s</span></td>
	", $rw["consec_cartera"], $rw["fecha_causa"], $id_manu_reip, $fech_reip, $rw["tercero"],$rw["tot_deb"]);
	
	if($td1 == '0' && $tc1== '0')
	{
	printf("
	<td align='center' bgcolor ='#990000' ><span class='Estilo4' style='color:#FFFF00'>NO</span></td>
	");
	}
	else
	{
	printf("
	<td align='center' ><span class='Estilo4'>SI</span></td>
	");
	}
	
	printf("
	
	<td align='center' >
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>
	<a $ver_boton href=\"borra_cartera.php?id2=%s&fecha_c=%s\"><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a> 
	</span>
	</div>
	</td>
	
	<td align='center' >
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>
	<a $ver_boton href=\"modifica_cartera.php?id=%s\"><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a> 
	</span>
	</div>
	</td>
	
	<td align='center' >
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>
	<a href=\"imp_caic.php?id3=%s\" target='_blank' ><img src='../simbolos/imprimirblanco.png' width='20' height='20' border='0' title='Imprimir OBCG'></a>
	</span>
	</div>
	</td>

	
	</tr>",$rw["id_reip"], $fech_reip, $rw["consec_cartera"],$rw["consec_cartera"]); 
	
	}
	
	printf("</tbody></table>");
	
	echo "<br><&nbsp;";
for ($i =0; $i<$listas;$i++)
{
	$inicio =($i*$muestra)+1;
	$k =$i+1;
	if ($k ==$indice) 
	{
		echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=CAIC&k=$k&nn=CAIC'><b>$k</b></a>&nbsp;";
	}else{
		echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=CAIC&k=$k&nn=CAIC'>$k</a>&nbsp;";
	}
}
echo ">&nbsp; </center>";
	
	}
	}
	?>
</div>

<?
if(isset($_GET['id0'])){$b=$_GET['id0'];}
if(isset($_POST['nn'])){$a=$_POST['nn'];}

if ($a == 'OBCG' || $b == 'OBCG')
{

?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center" class="Estilo4">
    <p><strong>OBLIGACION CONTABLE DEL GASTO - OBCG <br />
       </strong></p>
</div>  
<br />
<?php
include('../objetos/filtro.php');  

if  ($pendiente =="") 
{

}else{

?>
	<br />
	<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
	  <div align="center" class="Estilo4">
		<p><strong>CERTIFICADOS DE OBLIGACION PRESUPUESTAL ALMACENADOS</strong> <span class="Estilo8">&quot;SIN CONTABILIZAR&quot;<br />
		  </span>Estas Obligaciones pueden ser Modificadas accediendo a la Opcion 2.4.2 del Menu Principal <br />
		  <br />
		  <a href="../mvto_ppto_gas/mvto.php" target="_parent">...::: IR A MVTOS PPTO DE GASTOS :::...</a>    </p>
	  </div>
	</div>
	<br />
	
	<?
	
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	
if  ($_POST["buscar"] != "")
{
$filtro ="and (id_manu_crpp LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR detalle_crpp LIKE '%$buscar%' or id_manu_cdpp like '%$buscar%')";

} 
$id_emp="2";
$a = "select id_auto_crpp,id_auto_cdpp, id_manu_crpp, id_manu_cdpp, fecha_crpp, tercero , contrato, t_humano, inversion, subsidiado  from crpp where ctrl = 'NO' ";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fecha_crpp between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fecha_crpp ='$fechafil'";}
	if ($fecha2 == "A�O"){$f= "and fecha_crpp <= '$a2'";}
	$gby = "group by id_auto_crpp";
	$orden = "order by fecha_crpp,id_manu_crpp desc";
	$sq2 = "$a $b $c $filtro $f $gby $orden";

$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='900' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CRPP</b></span>
</div>
</td>

<td align='center'><span class='Estilo4'><b>CDPP</b></span></td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR CRPP</b></span></td>
<td align='center'><span class='Estilo4'><b>X OBLIGAR</b></span></td>

<td align='center' colspan=5><span class='Estilo4'><b></b></span></td>
<td align='center' colspan=2><span class='Estilo4'><b>SIA</b></span></td>
</tr>

");

while($rw2 = mysql_fetch_array($re2)) 
   {
   
$axz11=$rw2["id_auto_crpp"];
$resulta=mysql_query("select SUM(vr_digitado) AS TOTAL from crpp WHERE id_auto_crpp = '$axz11' AND id_emp='$id_emp'",$cx) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=$row[0];
$resulta2=mysql_query("select SUM(vr_digitado) AS TOTAL from cobp WHERE id_auto_crpp = '$axz11' AND id_emp='$id_emp'",$cx) or die (mysql_error());
$row2=mysql_fetch_row($resulta2);
$total2=$row2[0]; 
 
$nuevo_total11 = $total;
$saldo = $total  - $total2;    
   
printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><div style='padding-left:10px; padding-top:3px; padding-right:3px; padding-bottom:3px;'><span class='Estilo4'> %s </span></div></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>



<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"nuevo_cobp.php?id0=%s\" style='color:#0033FF'>Obligar</a>
</span>
</div>
</td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"borra_crpp.php?id1=%s\" title='Eliminar'>
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"modifica_crpp.php?id1a=%s\" title='Modificar / Consultar'>
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar / Consultar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_crpp.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'></a>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"hiscrp.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1000,height=600,scrollbars=yes'); return false;\"  title ='Historia del Documento'>
<img $ver_boton src='../simbolos/fuentes/historia.png' width='20' height='20' border='0' title='Historia del Documento'></a>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_crppsia.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/rp.png' width='20' height='20' border='0' title='Imprimir'></a>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_cdppsia.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/cdp.png' width='20' height='20' border='0' title='Imprimir'></a>
</a>
</span>
</td>

</tr>", $rw2["id_manu_crpp"], $rw2["id_manu_cdpp"], $rw2["fecha_crpp"], $rw2["tercero"], number_format($nuevo_total11,2,',','.'), number_format($saldo,2,',','.'), $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_crpp"],$rw2["id_auto_crpp"],$rw2["id_auto_cdpp"]);

   }

printf("</table></center>");



	
}

?>
	<br />
	
	<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:25px;'>
	  <div align="center">
		<span class="Estilo4"><strong>OBLIGACIONES CONTABLES DEL GASTO ALMACENADAS Y </strong> &quot;CONTABILIZADAS&quot;<br />
		<br />
		<a href="../pagos_tesoreria/pagos_tesoreria.php" target="_parent">...::: IR A TESORERIA :::...</a></span> </div>
	</div>
        <input type="button" name="boton" value="Imprimir Lotes" style="background:#72A0CF; color:#FFFFFF; border:none" onclick="window.open('imp_obcg_lte.php','_self')" />
	<center>
	<?
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$limitar = "limit $ini,$fin";
	if  ($_POST["buscar"] != "")
	{
	$filtro ="and (id_manu_obcg LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') "; 
	$limitar ='';
	} 
	
	$a = "select * from obcg where id_emp = '$idxx'";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fecha_obcg between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fecha_obcg ='$fechafil'";}
	if ($fecha2 == "A�O"){$f= "and fecha_obcg between '$a1' and '$a2'";}
	$gby = "";
	$orden = "order by fecha_obcg desc, id desc";
	$sq9 = "$a  $c $filtro $f $gby $orden"; 
	$resf =mysql_db_query($database,$sq9,$cx);
	$filas = mysql_num_rows($resf);
	$listas = ceil($filas / $muestra);
	$sq2 = "$a $c $filtro $f $gby $orden $limitar";

	$re2 = mysql_db_query($database, $sq2, $cx);
	
	printf("
	<center>
	<table width='900' BORDER='1' class='bordepunteado1'>
	<thead>
	
	<tr bgcolor='#DCE9E5'>
	<th align='center'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>OBCG</b></span>
	</div>
	</th>
	<th align='center'><span class='Estilo4'><b>COBP</b></span></th>
	<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
	<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
	<th align='center'><span class='Estilo4'><b>X VALOR DE</b></span></th>
	<th align='center'><span class='Estilo4'><b>EDAD</b></span></th>
	<th align='center'><span class='Estilo4'><b>ESTADO</b></span></th>
	
	<th align='center'><span class='Estilo4'><b></b></span></th>
	<th align='center'><span class='Estilo4'><b></b></span></th>
	<th align='center'><span class='Estilo4'><b></b>
	<th align='center'><span class='Estilo4'><b></b>
	",$mesh[$me+0],$an);
	
	while($rw2 = mysql_fetch_array($re2)) 
	   {
	$idmanuobcg=$rw2["id_manu_obcg"]; 
	$td=$rw2["tot_deb"]; 
	$tc=$rw2["tot_cre"]; 
	$startDate = $rw2["fecha_obcg"];
	
	$vara2=$rw2["id_auto_cobp"]; 
	$resulta=mysql_query("select SUM(vr_digitado) AS TOTAL from cobp where id_emp = '$idxx' and id_auto_cobp ='$vara2'",$cx) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total=0;
	if(isset($row[0])){$total=$row[0];}
	//*************** edad
	 $startDate = $rw2["fecha_obcg"];
	 $endDate = date("Y/m/d");
	 list($year, $month, $day) = explode('/', $startDate);  
	 $startDate = mktime(0, 0, 0, $month, $day, $year);  
	 list($year, $month, $day) = explode('/', $endDate);  
	 $endDate = mktime(0, 0, 0, $month, $day, $year);  
	 $totalDays = ($endDate - $startDate)/(60 * 60 * 24);  
	//*****************
	$sq3 ="select id_manu_cdpp from cobp where id_auto_cobp ='$vara2'";
	$rs3 = mysql_query($sq3,$cx);
	$rw3 = mysql_fetch_array($rs3);
	printf("
	
	<tr>
	<td align='left' bgcolor='#DCE9E5'>
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>&nbsp;%s</span>
	</div>
	</td>
	<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
	<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
	<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
	<td align='right'><span class='Estilo4'>&nbsp;%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	", $rw2["id_manu_obcg"],$rw3["id_manu_cdpp"], $rw2["fecha_obcg"], $rw2["tercero"], number_format($total,2,',','.'), number_format($totalDays,0,',','.').' Dias');
	
	if($td == '0' && $tc == '0')
	{
	printf("
	<td align='center' bgcolor ='#990000'><span class='Estilo4' style='color:#FFFF00'>NO</span></td>
	");
	}
	else
	{
	printf("
	<td align='center'><span class='Estilo4'>SI</span></td>
	");
	}
	
	printf("
	<td align='center' bgcolor='#DCE9E5'>
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>
	<a $ver_boton href=\"borra_obcg.php?id2=%s\" ><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
	</span>
	</div>
	</td>
	
	<td align='center' bgcolor='#DCE9E5'>
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>
	<a $ver_boton href=\"modifica_obcg.php?id1=%s\" ><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
	</span>
	</div>
	</td>
	
	<td align='center' bgcolor='#DCE9E5'>
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>
	<a href=\"imp_obcg.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir OBCG'></a>
	</span>
	</div>
	</td>
	
	<td align='center' bgcolor='#DCE9E5'>
	<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
	<span class='Estilo4'>
	<a $ver_boton href=\"anula_cobp.php?id4=%s\"  ><img src='../simbolos/historiaverde.png' width='20' height='20' border='0' title='Imprimir OBCG'></a>
	</span>
	</div>
	</td>
	
	</tr>", $rw2["id_auto_obcg"], $rw2["id_auto_obcg"], $rw2["id_auto_obcg"],$rw2["id_auto_obcg"]); 
	 }
	mysql_close();
	printf("</tbody></table>");
	echo "<br><&nbsp;";
for ($i =0; $i<$listas;$i++)
{
	$inicio =($i*$muestra)+1;
	$k =$i+1;
	if ($k ==$indice) 
	{
		echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=OBCG&k=$k&nn=OBCG'><b>$k</b></a>&nbsp;";
	}else{
		echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=OBCG&k=$k&nn=OBCG'>$k</a>&nbsp;";
	}
}
echo ">&nbsp; </center>";

	

}

$a=$_POST['nn'];

if  (!$_POST['nn']) $a=$_GET['nn'];
if ($a == 'NCON')
{

?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong> NOTA DE RECLASIFICACION POR CONVERGENCIA <br />
     <br />

</strong></span></div></div></center>
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:300px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../mvto_contable2/recaudar1.php' target='_parent'>NOTA DE RECLASIFICACION POR CONVERGENCIA </a> </div>
      </div>
    </div>
  </div>
</div>
<BR />



	   <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
	  <div align="center"><span class="Estilo4"><strong>LISTA NOTA DE RECLASIFICACION POR CONVERGENCIA CREADAS HASTA LA FECHA</strong> </span><br />
	  </div>
	</div>
	<br />
   
<?php include('../objetos/filtro.php');  

if  ($registrado =="") 
{

}else{
	
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	if  ($_POST["buscar"] != "")
	{
	$filtro ="and (dcto LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR detalle LIKE  '%$buscar%') "; 
	} 
	$sq3 ="select DISTINCT id_auto from lib_aux2 where dcto like 'NCON%' order by fecha desc";
	$re3 = mysql_db_query($database, $sq3, $cx);
	printf("
		<center>
		<table width='1000' BORDER='1' class='bordepunteado1'>
		");
	printf("
		
		<thead>
		
		<tr bgcolor='#DCE9E5'>
		<th align='center'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo4'><b>NCON</b></span>
		</div>
		</th>
		
		
		<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
		<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
		<th align='center'><span class='Estilo4'><b>CONCEPTO</b></span></th>
		<th><span class='Estilo4'>VALOR</span></th>
		<th align='center'><span class='Estilo4'><b></b></span></th>
		<th align='center'><span class='Estilo4'><b></b></span></th>
		<th align='center'><span class='Estilo4'><b></b></span></th>
		<th align='center'><span class='Estilo4'><b></b></span></th>
		
		
		</tr>
		</thead>
		<tbody>
		",$mesh[$me+0],$an);
	while ($rw3 = mysql_fetch_array($re3))
	{
		$a = "select * from lib_aux2 where id_auto ='$rw3[id_auto]' ";
		if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
		if ($fecha2 == "MES"){$f= "and fecha between '$f1' and '$f2'";}
		if ($fecha2 == "DIA"){$f= "and fecha ='$fechafil'";}
		if ($fecha2 == "A�O"){$f= "and fecha between '$a1' and '$a2'";}
		$gby = "";
		$orden = "order by fecha desc";
		$sq2 = "$a  $c $filtro $f $gby $orden"; 
		$re2 = mysql_db_query($database, $sq2, $cx);
		$rw2 = mysql_fetch_array($re2); 
		$sq4 ="select sum(debito) as total from lib_aux2 where id_auto ='$rw3[id_auto]' group by id_auto";
		$re4 = mysql_db_query($database, $sq4, $cx);
		$rw4 = mysql_fetch_array($re4); 
		$debito = $rw4['total'];
		if ($rw2["dcto"] !='')
		{
		printf("
		<tr>
		<td align='left' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>&nbsp;%s</span>
		</div>
		</td>
		
		
		<td align='center'><span class='Estilo4'>%s</span></td>
		<td align='left'><span class='Estilo4'>%s</span></td>
		<td align='left'><span class='Estilo4'>%s</span></td>
		<td align='right'><span class='Estilo4'> %s</span></td>
		
		<td align='center' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>
		<a $ver_boton href=\"../mvto_contable2/borra_alterna.php?id=%s&fecha_c=%s\" ><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
		</span>
		</div>
		</td>
		
		<td align='center' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>
		<a $ver_boton href=\"../mvto_contable2/mod_recaudar1.php?id1=%s\" ><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
		</span>
		</div>
		</td>
		
		<td align='center' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>
		<a href=\"../mvto_contable2/imp_ncon.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir NCON'></a>
		</span>
		</div>
		</td>
		
			
		<td align='center' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>
		<a $ver_boton href=\"../mvto_contable2/dup_recaudar1.php?id1=%s\" ><img src='../simbolos/fuentes/duplicar.png' width='20' height='20' border='0' title='Duplicar'></a>
		</span>
		</div>
		</td>
		
						
		</tr>", $rw2["dcto"], $rw2["fecha"], $rw2["tercero"], $rw2["detalle"], number_format($debito,2,',','.'), $rw2["id_auto"],$rw2["fecha"], $rw2["id_auto"], $rw2["id_auto"], $rw2["id_auto"]); 
		}
		   
		}
	printf("</tbody></table></center>");
	
	
	
	}
	
}	

$a=$_POST['nn'];

if  (!$_POST['nn']) $a=$_GET['nn'];
if ($a == 'NCSF')
{

?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong> NOTA DE SALDO A FAVOR - NCSF <br />
     <br />

</strong></span></div></div></center>
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:300px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../mvto_contable3/recaudar1.php' target='_parent'>CREAR NUEVA NOTA DE SALDO A FAVOR  </a> </div>
      </div>
    </div>
  </div>
</div>
<BR />



	   <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
	  <div align="center"><span class="Estilo4"><strong>LISTA DE NOTAS CONTABILIDAD CREADAS HASTA LA FECHA</strong> </span><br />
	  </div>
	</div>
	<br />
   
<?php include('../objetos/filtro.php');  

if  ($registrado =="") 
{

}else{
	
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	if  ($_POST["buscar"] != "")
	{
	$filtro ="and (dcto LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR detalle LIKE  '%$buscar%') "; 
	} 
	$sq3 ="select DISTINCT id_auto from lib_aux4 where dcto like 'NCSF%' order by fecha desc";
	$re3 = mysql_db_query($database, $sq3, $cx);
	printf("
		<center>
		<table width='1000' BORDER='1' class='bordepunteado1'>
		");
	printf("
		
		<thead>
		
		<tr bgcolor='#DCE9E5'>
		<th align='center'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo4'><b>NCSF</b></span>
		</div>
		</th>
		
		
		<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
		<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
		<th align='center'><span class='Estilo4'><b>CONCEPTO</b></span></th>
		<th><span class='Estilo4'>VALOR</span></th>
		<th align='center'><span class='Estilo4'><b></b></span></th>
		<th align='center'><span class='Estilo4'><b></b></span></th>
		<th align='center'><span class='Estilo4'><b></b></span></th>
		<th align='center'><span class='Estilo4'><b></b></span></th>
		
		
		</tr>
		</thead>
		<tbody>
		",$mesh[$me+0],$an);
	while ($rw3 = mysql_fetch_array($re3))
	{
		$a = "select * from lib_aux4 where id_auto ='$rw3[id_auto]' ";
		if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
		if ($fecha2 == "MES"){$f= "and fecha between '$f1' and '$f2'";}
		if ($fecha2 == "DIA"){$f= "and fecha ='$fechafil'";}
		if ($fecha2 == "A�O"){$f= "and fecha between '$a1' and '$a2'";}
		$gby = "";
		$orden = "order by fecha desc";
		$sq2 = "$a  $c $filtro $f $gby $orden"; 
		$re2 = mysql_db_query($database, $sq2, $cx);
		$rw2 = mysql_fetch_array($re2); 
		$sq4 ="select sum(debito) as total from lib_aux4 where id_auto ='$rw3[id_auto]' group by id_auto";
		$re4 = mysql_db_query($database, $sq4, $cx);
		$rw4 = mysql_fetch_array($re4); 
		$debito = $rw4['total'];
		if ($rw2["dcto"] !='')
		{
		printf("
		<tr>
		<td align='left' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>&nbsp;%s</span>
		</div>
		</td>
		
		
		<td align='center'><span class='Estilo4'>%s</span></td>
		<td align='left'><span class='Estilo4'>%s</span></td>
		<td align='left'><span class='Estilo4'>%s</span></td>
		<td align='right'><span class='Estilo4'> %s</span></td>
		
		<td align='center' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>
		<a $ver_boton href=\"../mvto_contable3/borra_alterna.php?id=%s&fecha_c=%s\" ><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
		</span>
		</div>
		</td>
		
		<td align='center' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>
		<a $ver_boton href=\"../mvto_contable3/mod_recaudar1.php?id1=%s\" ><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
		</span>
		</div>
		</td>
		
		<td align='center' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>
		<a href=\"../mvto_contable3/imp_ncon.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir NCON'></a>
		</span>
		</div>
		</td>
		
			
		<td align='center' bgcolor='#DCE9E5'>
		<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
		<span class='Estilo4'>
		<a $ver_boton href=\"../mvto_contable3/dup_recaudar1.php?id1=%s\" ><img src='../simbolos/fuentes/duplicar.png' width='20' height='20' border='0' title='Duplicar'></a>
		</span>
		</div>
		</td>
		
						
		</tr>", $rw2["dcto"], $rw2["fecha"], $rw2["tercero"], $rw2["detalle"], number_format($debito,2,',','.'), $rw2["id_auto"],$rw2["fecha"], $rw2["id_auto"], $rw2["id_auto"], $rw2["id_auto"]); 
		}
		   
		}
	printf("</tbody></table></center>");
	
	
	
	}
	
}	


$a=$_POST['nn'];
if ($a == 'CESP')
{


?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong>COMPROBANTE DE EGRESO SIN AFECTACION PRESUPUESTAL - CESP <br />
     <br />
    <br />
</strong></span></div></div>
	
	
  
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:15px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:350px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='nuevo_cesp.php' target='_parent'>CREAR NUEVO COMP DE EGRESO SIN AFECTACION PPTAL </a> </div>
      </div>
    </div>
  </div>
</div>


 <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong> LISTA DE CESP's CREADOS HASTA LA FECHA </strong> </span><br />
  </div>
</div>
<?
include('../objetos/filtro.php'); 
if  ($registrado =="") 
{

}else{
 
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

if  ($_POST["buscar"] != "")
{
$filtro ="and (id_manu_ncon LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR des_ncon LIKE  '%$buscar%') "; 
} 

$a = "select * from conta_cesp where id_emp = '$idxx'";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fecha_ncon between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fecha_ncon ='$fechafil'";}
	if ($fecha2 == "A�O"){$f= "and fecha_ncon between '$a1' and '$a2'";}
	$gby = "";
	$orden = "order by fecha_ncon desc, id desc";
	$sq2p = "$a  $c $filtro $f $gby $orden"; 


$re2 = mysql_db_query($database, $sq2p, $cx);

printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1'>
<thead>

 
<tr bgcolor='#DCE9E5'>
<th align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CESP</b></span>
</div>
</th>


<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
<th align='center'><span class='Estilo4'><b>CONCEPTO</b></span></th>
<th align='center'><span class='Estilo4'><b>VALOR</b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>


</tr>
</thead>
<tbody>
",$mesh[$me+0],$an);

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("

<tr>
<td align='center' bgcolor='#DCE9E5'  width='100'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center' ><span class='Estilo4'>%s</span></td>
<td align='left' ><span class='Estilo4'>%s</span></td>
<td align='left' ><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>

<td align='center' bgcolor='#DCE9E5' >
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"borra_cesp.php?id=%s&fecha_c=%s\" ><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5' >
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"modifica_cesp.php?id1=%s\" ><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5' >
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_cesp.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir CESP'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a $ver_boton href=\"duplica_cesp.php?id1=%s\" ><img src='../simbolos/fuentes/duplicar.png' width='20' height='20' border='0' title='Duplicar'></a>
</td>




</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], number_format($rw2["tot_deb"],2,',','.'), $rw2["id_auto_ncon"], $rw2["fecha_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"], $rw2['id']); 


   }

printf("</tbody></table></center>");

}

} // fin if 



$a=$_POST['nn'];
if ($a == 'NCSP')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong> NOTA AJUSTES POR ERROR <br />
    <br />
    <br />
    </strong> </span><br />
  </div>
</div>

<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:15px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:350px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='nuevo_ncsp.php' target='_parent'>CREAR NOTA AJUSTES POR ERROR</a> </div>
      </div>
    </div>
  </div>
</div>

<?
include('../objetos/filtro.php');  

if  ($registrado =="") 
{

}else{

	
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	if  ($_POST["buscar"] != "")
	{
	$filtro ="and (id_manu_ncon LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR des_ncon LIKE  '%$buscar%') "; 
	} 

	$a = "select * from conta_ncsp where id_emp = '$idxx'";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fecha_ncon between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fecha_ncon ='$fechafil'";}
	if ($fecha2 == "A�O"){$f= "and fecha_ncon between '$a1' and '$a2'";}
	$gby = "";
	$orden = "order by fecha_ncon desc";
	$sq2 = "$a  $c $filtro $f $gby $orden"; 

$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1'>
<thead>



<tr bgcolor='#DCE9E5'>
<th align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>NCSP</b></span>
</div>
</th>


<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
<th align='center'><span class='Estilo4'><b>CONCEPTO</b></span></th>
<th align='center'><span class='Estilo4'><b>VALOR</b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>


</tr>
</thead>
<tbody>

",$mesh[$me+0],$an);

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"borra_ncsp.php?id=%s&fecha_c=%s\" ><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"modifica_ncsp.php?id1=%s\" ><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_ncsp.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir NCSP'></a>
</span>
</div>
</td>

</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], number_format($rw2["tot_deb"],2,',','.'), $rw2["id_auto_ncon"],$rw2["fecha_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 
   }

printf("</tbody></table></center>");


}
}

$a=$_POST['nn'];
if ($a == 'NDSP')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong> NOTA AJUSTES POR CONVERGENCIA - NDSP<br />
     <br />
    <br />
  </strong> </span><br />
  </div>
</div>
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:15px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:350px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='nuevo_ndsp.php' target='_parent'>CREAR NOTA AJUSTES POR CONVERGENCIA </a> </div>
      </div>
    </div>
  </div>
</div>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong>
    <br />
    LISTA DE NDSP's CREADOS HASTA LA FECHA </strong> </span><br />
  </div>
</div>
<?
include('../objetos/filtro.php'); 
if  ($registrado =="") 
{

}else{
 
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

if  ($_POST["buscar"] != "")
	{
	$filtro ="and (id_manu_ncon LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR des_ncon LIKE  '%$buscar%') "; 
	} 

	$a = "select * from conta_ndsp where id_emp = '$idxx'";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fecha_ncon between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fecha_ncon ='$fechafil'";}
	if ($fecha2 == "A�O"){$f= "and fecha_ncon between '$a1' and '$a2'";}
	$gby = "";
	$orden = "order by fecha_ncon desc, id desc";
	$sq2 = "$a $c $filtro $f $gby $orden"; 

$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1'>
<thead>


<tr bgcolor='#DCE9E5'>
<th align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>NDSP</b></span>
</div>
</th>


<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
<th align='center'><span class='Estilo4'><b>CONCEPTO</b></span></th>
<th align='center'><span class='Estilo4'><b>VALOR</b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>


</tr>
</thead>
<tbody>
",$mesh[$me+0],$an);

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("

<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"borra_ndsp.php?id=%s&fecha_c=%s\" ><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"modifica_ndsp.php?id1=%s\" ><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"imp_ndsp.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir NDSP'></a>
</span>
</div>
</td>




</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"],number_format($rw2["tot_deb"],2,',','.'), $rw2["id_auto_ncon"],$rw2["fecha_ncon"],$rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 


   }

printf("</tbody></table></center>");


}
} //FIN INF

$a=$_POST['nn'];
if ($a == 'TFIN')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong>TRANSFERENCIA DE FONDOS INTERNOS - TFIN <br />
    </strong> </span><br />
  </div>
</div>
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:15px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:350px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='nuevo_tfin.php' target='_parent'>CREAR NUEVA TRANSFERENCIA DE FONDOS INTERNOS </a></div>
      </div>
    </div>
  </div>
</div>

<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong>
    LISTA DE TFIN's CREADOS HASTA LA FECHA </strong> </span><br />
  </div>
</div>


<?

include('../objetos/filtro.php'); 
if  ($registrado =="") 
{

}else{
 
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

if  ($_POST["buscar"] != "")
	{
	$filtro ="and (id_manu_ncon LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR des_ncon LIKE  '%$buscar%') "; 
	} 

	$a = "select * from conta_tfin where id_emp = '$idxx'";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fecha_ncon between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fecha_ncon ='$fechafil'";}
	if ($fecha2 == "A�O"){$f= "and fecha_ncon between '$a1' and '$a2'";}
	$gby = "";
	$orden = "order by fecha_ncon desc, id desc";
	$sq2 = "$a $c $filtro $f $gby $orden"; 


$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1'>
<thead>


<tr bgcolor='#DCE9E5'>
<th align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>TFIN</b></span>
</div>
</th>


<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
<th align='center'><span class='Estilo4'><b>CONCEPTO</b></span></th>
<th align='center'><span class='Estilo4'><b>VALOR</b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>


</tr>
</thead>
<tbody>
",$mesh[$me+0],$an);

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("

<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'> %s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"borra_tfin.php?id=%s&fecha_c=%s\" ><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"modifica_tfin.php?id1=%s\"><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_tfin.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir TFN'></a>
</span>
</div>
</td>




</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], number_format($rw2["tot_deb"],2,',','.'), $rw2["id_auto_ncon"],$rw2["fecha_ncon"],  $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 


   }

printf("</tbody></table></center>");


}
}

$a=$_POST['nn'];
if (!$_POST['nn']) $a = $_GET['nn'];
if ($a == 'COBA')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong>CONSIGNACION BANCARIA - COBA <br />
   </strong> </span><br />
  </div>
</div>
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:15px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:350px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='nuevo_coba.php' target='_parent'>CREAR NUEVA CONSIGNACION BANCARIA </a></div>
      </div>
    </div>
  </div>
</div>

<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><span class="Estilo4"><strong>
    LISTA DE COBA's CREADOS HASTA LA FECHA </strong> </span><br />
  </div>
</div>
<?
include('../objetos/filtro.php'); 
if  ($registrado =="") 
{

}else{
 
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

if  ($_POST["buscar"] != "")
	{
	$filtro ="and (id_manu_ncon LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR des_ncon LIKE  '%$buscar%') "; 
	} 

	$a = "select * from conta_coba where id_emp = '$idxx'";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fecha_ncon between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fecha_ncon ='$fechafil'";}
	if ($fecha2 == "A�O"){$f= "and fecha_ncon between '$a1' and '$a2'";}
	$gby = "";
	$orden = "order by fecha_ncon desc, id desc";
	$sq2 = "$a $c $filtro $f $gby $orden"; 

$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1'>
<thead>


<tr bgcolor='#DCE9E5'>
<th align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>COBA</b></span>
</div>
</th>


<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
<th align='center'><span class='Estilo4'><b>CONCEPTO</b></span></th>
<th align='center'><span class='Estilo4'><b>VALOR</b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>


</tr>
</thead>
<tbody>
",$mesh[$me+1],$an);

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("

<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'> %s</span></td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"borra_coba.php?id=%s&fecha_c=%s\" ><img src='../simbolos/fuentes/Eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"modifica_coba.php?id1=%s\" ><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"imp_coba.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir COBA'></a>
</span>
</div>
</td>

</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], number_format($rw2["tot_deb"],2,',','.'), $rw2["id_auto_ncon"],$rw2["fecha_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 

   }

printf("</tbody></table></center>");


}
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
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
        </div>
    </div>  </td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? echo $ano;?>
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
        <?PHP echo $email?> </div>
    </div>  </td>
    <td width="266">
    <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
          </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO  </a></div>
    </div>  </td>
    <td width="266">
    <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
      <div align="center">Desarrollado por <br />
        <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
      Derechos Reservados - 2009    </div>
    </div>  </td>
  </tr>
</table>
</body>
</html>
<?
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
}
}
?>