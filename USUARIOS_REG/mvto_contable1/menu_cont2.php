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
.Estilo8 {
	color: #990000;
	font-weight: bold;
}
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
      <div align="center" class="Estilo4"><strong>MOVIMIENTOS CONTABLES</strong></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
<form method="post" action="menu_cont.php">
  <!--<table width="800" border="0" align="center">
    <tr>
      <td width="600"><?php 
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
 
   }
?>
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
?>
            </select>
          </div>
        </div></td>
      <td width="190"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <input name="Submit" type="submit" class="Estilo4" value="Seleccionar Comprobante" />
        </div>
      </div></td>
    </tr>
  </table>-->
</form>
<form method="post" action="menu_cont2.php">
  <table width="800" border="0" align="center">
    <tr>
      <td width="600"><?php 
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
 
   }
?>
        <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right"><span class="Estilo4"><strong>Seleccione el Soporte </strong>: </span>
            <select name="nn" class="Estilo4" style="width: 350px;">
              <?
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
$a=$_POST['nn'];
if ($a == 'CAIC')
{

?>
<BR />
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
      <div align="center"><strong>DOCUMENTO FUENTE ...::: CAIC :::...<BR />CAUSACION DE CARTERA<BR /><BR />
      LISTA DE RECONOCIMIENTOS  ALMACENADOS</strong> <span class="Estilo8">&quot;SIN CONTABILIZAR&quot; </span><br />
      Estos Reconocimientos pueden ser Modificados accediendo a la Opcion 2.4.1 del Menu Principal </div>
    </div>
<BR />
<?php
//-------
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}

include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select distinct(consecutivo), tercero , fecha_reg, id_manu_reip from reip_ing where id_emp = '$id_emp' and contab = 'NO' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='850' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:1px; padding-top:5px; padding-right:1px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONSEC.</b></span>
</div>
</td>

<td align='center' width='400'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>FECHA DE DCTO - REIP</b></span></td>

<td align='center' width='200'><span class='Estilo4'><b>CONTABILIZAR</b></span></td>

</tr>

");

while($rw = mysql_fetch_array($re)) 
   {
printf("

<tr>
<td align='left'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>

<td align='center'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<form method='post' action='cartera_cont.php'>
<input type='hidden' name='consecutivo_reip' value='%s'><input type='submit' name='Submit' value='Contabilizar' class='Estilo4' />
</form>
</div>
</td>

</tr>", $rw["id_manu_reip"], $rw["tercero"], $rw["fecha_reg"],  $rw["consecutivo"]); 


   }

printf("</table></center>");
//--------	------------------------------------------------------
?>
<BR />
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
      <div align="center"><strong>      LISTA DE CAUSACIONES DE CARTERA ALMACENADAS Y </strong> <span class="Estilo8">&quot;CONTABILIZADAS&quot; </span><BR /><BR />
	    <a href="../recaudos_tesoreria/recaudos_tesoreria.php" target="_parent">...::: IR A TESORERIA :::...	    </a></div>
    </div>
<BR />
<?
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cartera_cont where id_emp = '$id_emp' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:1px; padding-top:5px; padding-right:1px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONSEC.</b></span>
</div>
</td>

<td align='center' width='100'><span class='Estilo4'><b>FECHA CAUSAC.</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>REIP</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>FECHA REIP.</b></span></td>
<td align='center' width='400'><span class='Estilo4'><b>TERCERO</b></span></td>

<td align='center' width='100'><span class='Estilo4'></span></td>
<td align='center' width='100'><span class='Estilo4'></span></td>


</tr>

");

while($rw = mysql_fetch_array($re)) 
   {

$ab = $rw["id_reip"];

$sqlxx3 = "select fecha_reg, id_manu_reip from reip_ing where id_emp = '$id_emp' and consecutivo ='$ab' ";
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
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>

<td align='center'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_cartera.php?id2=%s\"> Eliminar </a> 
</span>
</div>
</td>

<td align='center'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_cartera.php?id=%s\"> Modificar </a> 
</span>
</div>
</td>

</tr>", $rw["consec_cartera"], $rw["fecha_causa"], $id_manu_reip, $fech_reip, $rw["tercero"],  $rw["id_reip"],  $rw["consec_cartera"]); 




}

printf("</table></center>");

?>
<?
}
?>
</div>
<?
$b=$_GET['id0'];
$a=$_POST['nn'];
if ($a == 'OBCG' or $b == 'OBCG')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center">
    <p><strong>DOCUMENTO FUENTE ...::: OBCG :::...<br />
      OBLIGACION CONTABLE DEL GASTO </strong></p>
    <p><strong>CERTIFICADOS DE OBLIGACION PRESUPUESTAL ALMACENADOS Y </strong> <span class="Estilo8">&quot;SIN CONTABILIZAR&quot;<br />
      </span><span class="Estilo4">Estas Obligaciones pueden ser Modificadas accediendo a la Opcion 2.4.2 del Menu Principal </span><br /><br />
      <a href="../mvto_ppto_gas/mvto.php" target="_parent">...::: IR A MVTOS PPTO DE GASTOS :::...</a>    </p>
  </div>
</div>
<br />
<?
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select distinct(id_auto_cobp), id_manu_cobp,  id_manu_crpp, id_manu_cdpp, fecha_cobp, tercero, tesoreria from cobp where id_emp = '$id_emp' and contab='NO' and tesoreria ='NO' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='620' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>COBP</b></span>
</div>
</td>


<td align='center' width='80'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>X VALOR DE</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>



</tr>

");

while($rw2 = mysql_fetch_array($re2)) 
   {

$a1a1=$rw2["id_auto_cobp"];
$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(vr_digitado) AS TOTAL from cobp WHERE id_auto_cobp = '$a1a1' AND id_emp='$id_emp'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=$row[0]; 
$nuevo_totala1 = $total;   
   
printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"nuevo_obcg.php?id0=%s\" style='color:#0033FF'>Contabilizar</a>
</span>
</div>
</td>




</tr>", $rw2["id_manu_cobp"], $rw2["fecha_cobp"], $rw2["tercero"], $nuevo_totala1, $rw2["id_auto_cobp"]); 


   }

printf("</table></center>");


?>
<br />
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:25px;'>
  <div align="center">
   <strong>OBLIGACIONES CONTABLES DEL GASTO  ALMACENADAS Y </strong> <span class="Estilo8">&quot;CONTABILIZADAS&quot;<br />
    </span><br />
    <a href="../pagos_tesoreria/pagos_tesoreria.php" target="_parent">...::: IR A TESORERIA :::...</a>  </div>
</div>



<?


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from obcg where id_emp = '$id_emp' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='880' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>OBCG</b></span>
</div>
</td>

<td align='center' width='100'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='260'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>X VALOR DE</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>EDAD</b></span></td>

<td align='center' width='80'><span class='Estilo4'><b></b></span></td>
<td align='center' width='80'><span class='Estilo4'><b></b></span></td>
<td align='center' width='80'><span class='Estilo4'><b></b></span></td>




</tr>

");


while($rw2 = mysql_fetch_array($re2)) 
   {
$vara1='CEVA';
$vara2=$rw2["id_auto_cobp"]; 
///****
$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(vr_digitado) AS TOTAL from cobp where id_emp = '$id_emp' and id_auto_cobp ='$vara2'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=$row[0]; 
//*************** edad
 $startDate = $rw2["fecha_obcg"];
 $endDate = date("Y/m/d");
 list($year, $month, $day) = explode('/', $startDate);  
 $startDate = mktime(0, 0, 0, $month, $day, $year);  
 list($year, $month, $day) = explode('/', $endDate);  
 $endDate = mktime(0, 0, 0, $month, $day, $year);  
 $totalDays = ($endDate - $startDate)/(60 * 60 * 24);  
 
///*****************


 
   
printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>



<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_obcg.php?id1=%s\" >Modificar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_obcg.php?id2=%s\" >Eliminar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_obcg.php?id3=%s\" target='_blank' >Imprimir OBCG</a>
</span>
</div>
</td>




</tr>", $rw2["id_auto_obcg"], $rw2["fecha_obcg"], $rw2["tercero"], $total, $totalDays.' Dias', $rw2["id_auto_obcg"], $rw2["id_auto_obcg"], $rw2["id_auto_obcg"]); 


   }

printf("</table></center>");


?>
<?
}
?>
<?
$a=$_POST['nn'];
if ($a == 'NCON')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><strong>DOCUMENTO FUENTE ...::: NCON :::...<br />
    NOTA DE CONTABILIDAD <br />
    <br />
    LISTA DE NOTAS CONTABILIDAD CREADAS HASTA LA FECHA </strong><span class="Estilo8"> </span><br />
  </div>
</div>
<br />
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:300px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='nuevo_ncon.php' target='_parent'>CREAR NUEVA NOTA DE CONTABILIDAD  </a> </div>
      </div>
    </div>
  </div>
</div>
<BR />
<?
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from conta_ncon where id_emp = '$id_emp' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>NCON</b></span>
</div>
</td>


<td align='center' width='80'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>CONCEPTO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>


</tr>

");

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_ncon.php?id=%s\" >Eliminar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_ncon.php?id1=%s\" >Modificar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_ncon.php?id3=%s\" target='_blank' >Imprimir NCON</a>
</span>
</div>
</td>




</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 


   }

printf("</table></center>");


?>

<?
}
?> <?
$a=$_POST['nn'];
if ($a == 'CESP')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><strong>DOCUMENTO FUENTE ...::: CESP :::...<br />
    COMPROBANTE DE EGRESO SIN AFECTACION PRESUPUESTAL <br />
    <br />
    LISTA DE CESP's CREADOS HASTA LA FECHA </strong><span class="Estilo8"> </span><br />
  </div>
</div>
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:15px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:350px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='nuevo_cesp.php' target='_parent'>CREAR NUEVO COMP DE EGRESO SIN AFECTACION PPTAL </a> </div>
      </div>
    </div>
  </div>
</div>

<?
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from conta_cesp where id_emp = '$id_emp' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CESP</b></span>
</div>
</td>


<td align='center' width='80'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>CONCEPTO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>


</tr>

");

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_cesp.php?id=%s\" >Eliminar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_cesp.php?id1=%s\" >Modificar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_cesp.php?id3=%s\" target='_blank' >Imprimir CESP</a>
</span>
</div>
</td>




</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 


   }

printf("</table></center>");


?>
<?
}
?>
<br />

<?
$a=$_POST['nn'];
if ($a == 'NCSP')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><strong>DOCUMENTO FUENTE ...::: NCSP :::...<br />
    NOTA CREDITO SIN AFECTACION PRESUPUESTAL <br />
    <br />
    LISTA DE NCSP's CREADOS HASTA LA FECHA </strong><span class="Estilo8"> </span><br />
  </div>
</div>
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:15px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:350px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='nuevo_ncsp.php' target='_parent'>CREAR NUEVA NOTA CREDITO SIN AFECTACION PPTAL </a> </div>
      </div>
    </div>
  </div>
</div>
<?
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from conta_ncsp where id_emp = '$id_emp' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>NCSP</b></span>
</div>
</td>


<td align='center' width='80'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>CONCEPTO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>


</tr>

");

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_ncsp.php?id=%s\" >Eliminar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_ncsp.php?id1=%s\" >Modificar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_ncsp.php?id3=%s\" target='_blank' >Imprimir NCSP</a>
</span>
</div>
</td>




</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 


   }

printf("</table></center>");


?>
<?
}
?>
<br />
<?
$a=$_POST['nn'];
if ($a == 'NDSP')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><strong>DOCUMENTO FUENTE ...::: NDSP :::...<br />
    NOTA DEBITO SIN AFECTACION PRESUPUESTAL <br />
    <br />
    LISTA DE NDSP's CREADOS HASTA LA FECHA </strong><span class="Estilo8"> </span><br />
  </div>
</div>
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:15px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:350px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='nuevo_ndsp.php' target='_parent'>CREAR NUEVA NOTA DEBITO SIN AFECTACION PPTAL </a> </div>
      </div>
    </div>
  </div>
</div>
<?
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from conta_ndsp where id_emp = '$id_emp' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>NDSP</b></span>
</div>
</td>


<td align='center' width='80'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>CONCEPTO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>


</tr>

");

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_ndsp.php?id=%s\" >Eliminar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_ndsp.php?id1=%s\" >Modificar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_ndsp.php?id3=%s\" target='_blank' >Imprimir NDSP</a>
</span>
</div>
</td>




</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 


   }

printf("</table></center>");


?><?
}
?>
<?
$a=$_POST['nn'];
if ($a == 'TFIN')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><strong>DOCUMENTO FUENTE ...::: TFIN :::...<br />
    TRANSFERENCIA DE FONDOS INTERNOS <br />
    <br />
    LISTA DE TFIN's CREADOS HASTA LA FECHA </strong><span class="Estilo8"> </span><br />
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
<?
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from conta_tfin where id_emp = '$id_emp' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>TFIN</b></span>
</div>
</td>


<td align='center' width='80'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>CONCEPTO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>


</tr>

");

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_tfin.php?id=%s\" >Eliminar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_tfin.php?id1=%s\" >Modificar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_tfin.php?id3=%s\" target='_blank' >Imprimir TFIN</a>
</span>
</div>
</td>




</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 


   }

printf("</table></center>");


?>
<?
}
?>
<?
$a=$_POST['nn'];
if ($a == 'COBA')
{
?>
<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
  <div align="center"><strong>DOCUMENTO FUENTE ...::: COBA :::...<br />
    CONSIGNACION BANCARIA <br />
    <br />
    LISTA DE COBA's CREADOS HASTA LA FECHA </strong><span class="Estilo8"> </span><br />
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
<?
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from conta_coba where id_emp = '$id_emp' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>COBA</b></span>
</div>
</td>


<td align='center' width='80'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>CONCEPTO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>
<td align='center' width='100'><span class='Estilo4'><b></b></span></td>


</tr>

");

while($rw2 = mysql_fetch_array($re2)) 
   {

printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_coba.php?id=%s\" >Eliminar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_coba.php?id1=%s\" >Modificar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_coba.php?id3=%s\" target='_blank' >Imprimir COBA</a>
</span>
</div>
</td>




</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]); 


   }

printf("</table></center>");


?>
<?
}
?></td>
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