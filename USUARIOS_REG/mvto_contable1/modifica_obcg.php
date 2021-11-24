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
    .suggestionsBox {
        position: relative;
        left: 30px;
        margin: 0px 0px 0px 0px;
        width: 600px;
        background-color:#335194;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        border: 2px solid #2AAAFF;  
        color: #fff;
        font-size: 10px;
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
.Estilo13 {color: #990000}
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
-->
</style>

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
function chk_obcg(){
var pos_url = '../comprobadores/comprueba_obcg.php';
var cod = document.getElementById('id_manu_obcg').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('res_obcg').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
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
      <div align="center" class="Estilo4"><strong>OBLIGACION CONTABLE DEL GASTO<br />
<br />
<span class="Estilo13">MODIFICAR</span> </strong>
<?php 


$id_auto_obcg = $_GET['id1'];



include('../config.php');
// id_emp			
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $idxx=$rowxx["id_emp"];
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}


$sqlxx1 = "select * from obcg where id_emp ='$id_emp' and id_auto_obcg ='$id_auto_obcg'";
$resultadoxx1 = mysql_db_query($database, $sqlxx1, $connectionxx);

while($rowxx1 = mysql_fetch_array($resultadoxx1)) 
{
  $id_auto_cobp=$rowxx1["id_auto_cobp"];
  $id_manu_obcg=$rowxx1["id_manu_obcg"];  
  $a = substr($id_manu_obcg,4,100);

  $fecha_o=$rowxx1["fecha_obcg"]; 
  $concepto_obcg=$rowxx1["concepto_obcg"];  
  $referencia_obcg=$rowxx1["referencia_obcg"];   
    $pgcp[1] = $rowxx1['pgcp1'];
    $pgcp[2] = $rowxx1['pgcp2'];
    $pgcp[3] = $rowxx1['pgcp3'];
    $pgcp[4] = $rowxx1['pgcp4'];
    $pgcp[5] = $rowxx1['pgcp5'];
    $pgcp[6] = $rowxx1['pgcp6'];
    $pgcp[7] = $rowxx1['pgcp7'];
    $pgcp[8] = $rowxx1['pgcp8'];
    $pgcp[9] = $rowxx1['pgcp9'];
    $pgcp[10] = $rowxx1['pgcp10'];
    $pgcp[11] = $rowxx1['pgcp11'];
    $pgcp[12] = $rowxx1['pgcp12'];
    $pgcp[13] = $rowxx1['pgcp13'];
    $pgcp[14] = $rowxx1['pgcp14'];
    $pgcp[15] = $rowxx1['pgcp15'];
    $pgcp[16] = $rowxx1['pgcp16'];
    $pgcp[17] = $rowxx1['pgcp17'];
    $pgcp[18] = $rowxx1['pgcp18'];
    $pgcp[19] = $rowxx1['pgcp19'];
    $pgcp[20] = $rowxx1['pgcp20'];
    $pgcp[21] = $rowxx1['pgcp21'];
    $pgcp[22] = $rowxx1['pgcp22'];
    $pgcp[23] = $rowxx1['pgcp23'];
    $pgcp[24] = $rowxx1['pgcp24'];
    $pgcp[25] = $rowxx1['pgcp25'];
    $pgcp[26] = $rowxx1['pgcp26'];
    $pgcp[27] = $rowxx1['pgcp27'];
    $pgcp[28] = $rowxx1['pgcp28'];
    $pgcp[29] = $rowxx1['pgcp29'];
    $pgcp[30] = $rowxx1['pgcp30'];
    $pgcp[31] = $rowxx1['pgcp31'];
    $pgcp[32] = $rowxx1['pgcp32'];
    $pgcp[33] = $rowxx1['pgcp33'];
    $pgcp[34] = $rowxx1['pgcp34'];
    $pgcp[35] = $rowxx1['pgcp35'];
    $pgcp[36] = $rowxx1['pgcp36'];
    $pgcp[37] = $rowxx1['pgcp37'];
    $pgcp[38] = $rowxx1['pgcp38'];
    $pgcp[39] = $rowxx1['pgcp39'];
    $pgcp[40] = $rowxx1['pgcp40'];
    $pgcp[41] = $rowxx1['pgcp41'];
    $pgcp[42] = $rowxx1['pgcp42'];
    $pgcp[43] = $rowxx1['pgcp43'];
    $pgcp[44] = $rowxx1['pgcp44'];
    $pgcp[45] = $rowxx1['pgcp45'];
    $pgcp[46] = $rowxx1['pgcp46'];
    $pgcp[47] = $rowxx1['pgcp47'];
    $pgcp[48] = $rowxx1['pgcp48'];
    $pgcp[49] = $rowxx1['pgcp49'];
    $pgcp[50] = $rowxx1['pgcp50'];
    for($i=1;$i <= 50;$i++){
       if($pgcp[$i] == ""){
         break;
       }
    }
    $contis=$i-1;
    $vr_deb[1] = $rowxx1['vr_deb_1'];
    $vr_deb[2] = $rowxx1['vr_deb_2'];
    $vr_deb[3]= $rowxx1['vr_deb_3'];
    $vr_deb[4] = $rowxx1['vr_deb_4'];
    $vr_deb[5] = $rowxx1['vr_deb_5'];
    $vr_deb[6] = $rowxx1['vr_deb_6'];
    $vr_deb[7] = $rowxx1['vr_deb_7'];
    $vr_deb[8] = $rowxx1['vr_deb_8'];
    $vr_deb[9] = $rowxx1['vr_deb_9'];
    $vr_deb[10] = $rowxx1['vr_deb_10'];
    $vr_deb[11] = $rowxx1['vr_deb_11'];
    $vr_deb[12] = $rowxx1['vr_deb_12'];
    $vr_deb[13] = $rowxx1['vr_deb_13'];
    $vr_deb[14] = $rowxx1['vr_deb_14'];
    $vr_deb[15] = $rowxx1['vr_deb_15'];
    $vr_deb[16] = $rowxx1['vr_deb_16'];
    $vr_deb[17] = $rowxx1['vr_deb_17'];
    $vr_deb[18] = $rowxx1['vr_deb_18'];
    $vr_deb[19] = $rowxx1['vr_deb_19'];
    $vr_deb[20] = $rowxx1['vr_deb_20'];
    $vr_deb[21] = $rowxx1['vr_deb_21'];
    $vr_deb[22] = $rowxx1['vr_deb_22'];
    $vr_deb[23] = $rowxx1['vr_deb_23'];
    $vr_deb[24] = $rowxx1['vr_deb_24'];
    $vr_deb[25] = $rowxx1['vr_deb_25'];
    $vr_deb[26] = $rowxx1['vr_deb_26'];
    $vr_deb[27] = $rowxx1['vr_deb_27'];
    $vr_deb[28] = $rowxx1['vr_deb_28'];
    $vr_deb[29] = $rowxx1['vr_deb_29'];
    $vr_deb[30] = $rowxx1['vr_deb_30'];
    $vr_deb[31] = $rowxx1['vr_deb_31'];
    $vr_deb[32] = $rowxx1['vr_deb_32'];
    $vr_deb[33] = $rowxx1['vr_deb_33'];
    $vr_deb[34] = $rowxx1['vr_deb_34'];
    $vr_deb[35] = $rowxx1['vr_deb_35'];
    $vr_deb[36] = $rowxx1['vr_deb_36'];
    $vr_deb[37] = $rowxx1['vr_deb_37'];
    $vr_deb[38] = $rowxx1['vr_deb_38'];
    $vr_deb[39] = $rowxx1['vr_deb_39'];
    $vr_deb[40] = $rowxx1['vr_deb_40'];
    $vr_deb[41] = $rowxx1['vr_deb_41'];
    $vr_deb[42] = $rowxx1['vr_deb_42'];
    $vr_deb[43] = $rowxx1['vr_deb_43'];
    $vr_deb[44] = $rowxx1['vr_deb_44'];
    $vr_deb[45] = $rowxx1['vr_deb_45'];
    $vr_deb[46] = $rowxx1['vr_deb_46'];
    $vr_deb[47] = $rowxx1['vr_deb_47'];
    $vr_deb[48] = $rowxx1['vr_deb_48'];
    $vr_deb[49] = $rowxx1['vr_deb_49'];
    $vr_deb[50] = $rowxx1['vr_deb_50'];

    $vr_cre[1] = $rowxx1['vr_cre_1'];
    $vr_cre[2] = $rowxx1['vr_cre_2'];
    $vr_cre[3] = $rowxx1['vr_cre_3'];
    $vr_cre[4] = $rowxx1['vr_cre_4'];
    $vr_cre[5] = $rowxx1['vr_cre_5'];
    $vr_cre[6] = $rowxx1['vr_cre_6'];
    $vr_cre[7] = $rowxx1['vr_cre_7'];
    $vr_cre[8] = $rowxx1['vr_cre_8'];
    $vr_cre[9] = $rowxx1['vr_cre_9'];
    $vr_cre[10] = $rowxx1['vr_cre_10'];
    $vr_cre[11] = $rowxx1['vr_cre_11'];
    $vr_cre[12] = $rowxx1['vr_cre_12'];
    $vr_cre[13] = $rowxx1['vr_cre_13'];
    $vr_cre[14] = $rowxx1['vr_cre_14'];
    $vr_cre[15] = $rowxx1['vr_cre_15'];
    $vr_cre[16] = $rowxx1['vr_cre_16'];
    $vr_cre[17] = $rowxx1['vr_cre_17'];
    $vr_cre[18] = $rowxx1['vr_cre_18'];
    $vr_cre[19] = $rowxx1['vr_cre_19'];
    $vr_cre[20] = $rowxx1['vr_cre_20'];
    $vr_cre[21] = $rowxx1['vr_cre_21'];
    $vr_cre[22] = $rowxx1['vr_cre_22'];
    $vr_cre[23] = $rowxx1['vr_cre_23'];
    $vr_cre[24] = $rowxx1['vr_cre_24'];
    $vr_cre[25] = $rowxx1['vr_cre_25'];
    $vr_cre[26] = $rowxx1['vr_cre_26'];
    $vr_cre[27] = $rowxx1['vr_cre_27'];
    $vr_cre[28] = $rowxx1['vr_cre_28'];
    $vr_cre[29] = $rowxx1['vr_cre_29'];
    $vr_cre[30] = $rowxx1['vr_cre_30'];
    $vr_cre[31] = $rowxx1['vr_cre_31'];
    $vr_cre[32] = $rowxx1['vr_cre_32'];
    $vr_cre[33] = $rowxx1['vr_cre_33'];
    $vr_cre[34] = $rowxx1['vr_cre_34'];
    $vr_cre[35] = $rowxx1['vr_cre_35'];
    $vr_cre[36] = $rowxx1['vr_cre_36'];
    $vr_cre[37] = $rowxx1['vr_cre_37'];
    $vr_cre[38] = $rowxx1['vr_cre_38'];
    $vr_cre[39] = $rowxx1['vr_cre_39'];
    $vr_cre[40] = $rowxx1['vr_cre_40'];
    $vr_cre[41] = $rowxx1['vr_cre_41'];
    $vr_cre[42] = $rowxx1['vr_cre_42'];
    $vr_cre[43] = $rowxx1['vr_cre_43'];
    $vr_cre[44] = $rowxx1['vr_cre_44'];
    $vr_cre[45] = $rowxx1['vr_cre_45'];
    $vr_cre[46] = $rowxx1['vr_cre_46'];
    $vr_cre[47] = $rowxx1['vr_cre_47'];
    $vr_cre[48] = $rowxx1['vr_cre_48'];
    $vr_cre[49] = $rowxx1['vr_cre_49'];
    $vr_cre[50] = $rowxx1['vr_cre_50'];
    
	$tot_deb = $rowxx1['tot_deb'];
    $tot_cre = $rowxx1['tot_cre'];
    $difere = $tot_deb - $tot_cre;
}

$sqlxx2 = "select * from cobp where id_emp ='$id_emp' and id_auto_cobp='$id_auto_cobp'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
  $id_manu_cobp=$rowxx2["id_manu_cobp"];
  $fecha_cobp=$rowxx2["fecha_cobp"];
  $tercero=$rowxx2["tercero"];
  $ccnit=$rowxx2["ccnit"];
  $des_cobp=$rowxx2["des_cobp"];
  $id_auto_crpp=$rowxx2["id_auto_crpp"];
  
  
}

$sqlxx3 = "select * from crpp where id_emp ='$id_emp' and id_auto_crpp='$id_auto_crpp'";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{
  $pago=$rowxx3["pago"];
}

?>
      </div>
	</div>	</td>
  </tr>
  
  <form name="a" method="post" id="commentForm" action='p_modifica_obcg.php'>
  <tr>
  <td colspan="3">
	<table width="915" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
      </tr>
     
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>DATOS GENERALES DE LA OBLIGACION PRESUPUESTAL </strong></div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Codigo COBP :  </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><? printf("%s",$id_manu_cobp);?>
              <input name="id_manu_cobp" type="hidden" value="<? printf("%s",$id_manu_cobp);?>" />
              <input name="id_auto_cobp" type="hidden" value="<? printf("%s",$id_auto_cobp);?>" />
          </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Fecha COBP : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><? printf("%s",$fecha_cobp);?>
              <input name="fecha_cobp" type="hidden" id="fecha_cobp" value="<? printf("%s",$fecha_cobp);?>" />
          </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Tercero : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left"><? printf("%s",$tercero);?>
              <input name="tercero" type="hidden" value="<? printf("%s",$tercero);?>" />
              </div>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>C.C. / NIT  : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left"><? printf("%s",$ccnit);?>
              <input name="ccnit" type="hidden" value="<? printf("%s",$ccnit);?>" />
              </div>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Descripcion COBP : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left"><? printf("%s",$des_cobp);?>
                <input name="des_cobp" type="hidden" value="<? printf("%s",$des_cobp);?>" />
            </div>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Tipo de Pago  : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left"><? printf("%s",$pago);?>
                <input name="pago" type="hidden" value="<? printf("%s",$pago);?>" />
            </div>
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
	<br />  
	<table width="915" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="900" colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><strong>DATOS DEL CERTIFICADO DE OBLIGACION PRESUPUESTAL </strong></div>
        </div></td>
      </tr>
    </table>
	<div align="center"><br />
	    <?
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp ='$id_auto_cobp' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='915' BORDER='1' class='bordepunteado1'>
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
while($rw = mysql_fetch_array($re)) 
   {
   
$cta = $rw["cuenta"];

$sq2 = "select proc_rec, nom_rubro from car_ppto_gas  where id_emp = '$id_emp' and cod_pptal ='$cta' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);   
while($rw2 = mysql_fetch_array($re2))
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

  <tr>
    <td colspan='4'>&nbsp;</td>
    
  </tr>


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
	    <input name="total" type="hidden" value="<? printf("%s",$nuevo_total);?>" />
	    <br />
	  <br />
	  <table width="915" border="1" align="center" class="bordepunteado1">
        <tr>
          <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><strong>DATOS DE CONTRATACION </strong></div>
          </div>		  </td>
        </tr>
        <tr>
          <td width="900" colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      </table>
    </div>
	<br />
	<br />

    <table width="915" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><strong>DATOS OBLIGACION CONTABLE DEL GASTO </strong></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Fecha  OBCG : </strong></div>
          </div>
        </div></td>
        <td colspan="2" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left">
            <input name="fecha_obcg" type="text" class="required Estilo12" id="fecha_obcg" value="<? printf("%s",$fecha_o);?>" size="12" />
            <span class="Estilo8">:::</span>
            <input name="button2" type="button" class="Estilo12" onclick="displayCalendar(document.forms[0].fecha_obcg,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
          </div>
        </div></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>
              Numero OBCG   : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><? printf("%s",$id_auto_obcg);?>
                <input name="id_auto_obcg" type="hidden" class="Estilo12" id="id_auto_obcg" value="<? printf("%s",$id_auto_obcg);?>"/>
            </div>
          </div>
        </div></td>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Digite Numero  de OBCG : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="id_manu_obcg" type="text" class="required Estilo4" id="id_manu_obcg" style="text-align:center" onkeypress="return validar(event)" value="<? printf("%s",$a);?>" onkeyup="chk_obcg();"/>
			  <br />
			  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div class="Estilo4" align="center" id='res_obcg'></div>
		        </div>
            </div>
          </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Concepto  OBCG : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="left">
              <input name="concepto_obcg" type="text" class="required Estilo12" id="concepto_obcg" size="115" onkeyup="a.concepto_obcg.value=a.concepto_obcg.value.toUpperCase();" value="<? printf("%s",$concepto_obcg);?>" />
            </div>
          </div>
        </div></td>
        </tr>
      
    </table>	</td>
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
    <table width="915" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="5" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
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
          <div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE
          <input type="hidden" name='contador' value=<? echo $contis; ?> id="contador"><br>
          <img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style="cursor: pointer"; onclick='masitem();' >
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span id='contis' class='Estilo4'><? echo $contis; ?></span>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='menitem();'>
          </strong></div>
      </div></td>
    </tr>
    <tr>
      <td width="192" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DIGITE CUENTA P.G.C.P </strong></div>
      </div></td>
      <td width="429" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>NOMBRE DE LA CUENTA</strong><strong></strong>
      </div></td>
      <td width="130" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR DEBITO </strong></div>
      </div></td>
      <td width="134" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR CREDITO </strong></div>
      </div></td>
         <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DOCUMENTO </strong></div>
      </div></td>

    </tr>
        <?
     //$acc='block';
     for($i=1;$i<51;$i++){
     echo "<tr style='position:relative; display:$acc;' id='fil$i'>
      <td valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
          <input name='pgcp$i' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' onkeyup='lookup(this.value,$i);' value='$pgcp[$i]'>
      </span></div>
     <div class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 200px; z-index:2'>
                <img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
                <div class='suggestionList' id='autoSug$i'>
                    &nbsp;
                </div>
     </div>
      </td>";
      $nomvcue='';
      if($i<=$contis){
        $query = mysql_query("Select nom_rubro from pgcp where cod_pptal = '$pgcp[$i]' and id_emp ='$id_emp' and tip_dato = 'D'",$connectionxx);
        $nomvcue = mysql_result($query,0,0);
      }
          echo "<td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='left' id='resulta$i'>$nomvcue</div>
          </div>
      </div></td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='right'>
              <input name='vr_deb_$i' type='text' class='Estilo4' id='vr_deb_$i' style='text-align:right' onkeypress='return validar(event)' onKeyUp='Calcular();' onfocus='siespgcp($i);' value='$vr_deb[$i]'>
            </div>
          </div>
      </div></td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='right'>
              <input name='vr_cre_$i' type='text' class='Estilo4' id='vr_cre_$i' style='text-align:right' onkeypress='return validar(event)' onKeyUp='Calcular();' onfocus='siespgcp($i);' value='$vr_cre[$i]'>
            </div>
          </div>
      </div></td>
	   <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='center'>
              <input name='cheque$i' type='text' class='Estilo12' id='cheque1' style='text-align:right'/>
            </div>
          </div>
      </div></td>
    </tr>";
    if($i==$contis){$acc='none';}}
    ?>

    <tr>
      <td colspan=3 bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8"><strong>VERIFIQUE QUE LAS SUMAS SEAN IGUALES ANTES DE GRABAR: </strong></div>
      </div></td>
      <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" value=<? echo $tot_deb; ?> onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
      <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value=<? echo $tot_cre; ?> onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td colspan=3 bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8"><strong>DIFERENCIA: </strong></div>
      </div></td>
      <td bgcolor="#990000" colspan=2><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="center">
            <input name="total" type="text" class="Estilo12" id="total" style="text-align:right" value=<? echo number_format($difere,2); ?> onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="5" bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right" class="Estilo8">
            <div align="center"><strong>VERIFIQUE FECHA, CONSECUTIVO, TERCERO Y DETALLE ANTES DE GRABAR</strong></div>
          </div>
      </div></td>
    </tr>
    
    <tr>
      <td colspan="5"><div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <input name="Submit" type="submit" class="Estilo4" value="Modifica OBCG" onclick="return noVacio3(this.form,this.form.contador.value);" >
        </div>
      </div></td>
    </tr>
    <!--secciones de fila -->
    <!--secciones de fila -->
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
<input type='hidden' name='nn' value='OBCG'>
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