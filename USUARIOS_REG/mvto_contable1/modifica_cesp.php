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
-->
</style>
<script language="JavaScript" type="text/javascript" src="javas.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />



<!--validacion de forms-->
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
.Estilo13 { color: #990000;
    font-style: italic;
}
</style>

<script>
$(document).ready(function(){
$("#commentForm").validate();
});
</script>

<script>
function chk_ncon(){
var pos_url = '../comprobadores/comprueba_cesp.php';
var cod = document.getElementById('id_manu_ncon').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('res_ncon').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}

$().ready(function() {
	$("#tercero").autocomplete("terceros.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	$("#tercero").result(function(event, data, formatted) {
		$("#valtercero").val(data[1]);
	});
});

</script>

<!--fin val forms--> 

</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
    <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
      <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />    </div>
    </div>  </td>
  </tr>
  
  <tr>
    <td colspan="3">
    <div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>MODIFICA COMPROBANTE DE EGRESO SIN AFECTACION PRESUPUESTAL </strong></div>
    </div>  </td>
  </tr>
  
  <form name="a" method="post" id="commentForm" action='p_modifica_cesp.php'>
  <tr>
  <td colspan="3">
    <table width="915" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="4" bgcolor="#DCE9E5">
        <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
            <?
$id_ncon_1=$_GET['id1'];
include('../config.php');               
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx))
   {
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
   }
$sq2 ="select nit from empresa where cod_emp=2";
$res = mysql_db_query($database,$sq2,$connectionxx);
$nit = mysql_fetch_array($res);


$sqlxxa = "select * from conta_cesp where id_emp = '$id_emp' and id_auto_ncon ='$id_ncon_1'";
$resultadoxxa = mysql_db_query($database, $sqlxxa, $connectionxx);

while($rowxxa = mysql_fetch_array($resultadoxxa)) 
   {
   
    $id_manu_ncon = substr($rowxxa["id_manu_ncon"],4,100);
    $id_auto_ncon = $rowxxa["id_auto_ncon"];
    $fecha_ncon = $rowxxa["fecha_ncon"];
    $tercero = $rowxxa["tercero"];
    $des_ncon = $rowxxa["des_ncon"];
    
    $pgcp[1] = $rowxxa['pgcp1'];
    $pgcp[2] = $rowxxa['pgcp2'];
    $pgcp[3] = $rowxxa['pgcp3'];
    $pgcp[4] = $rowxxa['pgcp4'];
    $pgcp[5] = $rowxxa['pgcp5'];
    $pgcp[6] = $rowxxa['pgcp6'];
    $pgcp[7] = $rowxxa['pgcp7'];
    $pgcp[8] = $rowxxa['pgcp8'];
    $pgcp[9] = $rowxxa['pgcp9'];
    $pgcp[10] = $rowxxa['pgcp10'];
    $pgcp[11] = $rowxxa['pgcp11'];
    $pgcp[12] = $rowxxa['pgcp12'];
    $pgcp[13] = $rowxxa['pgcp13'];
    $pgcp[14] = $rowxxa['pgcp14'];
    $pgcp[15] = $rowxxa['pgcp15'];
    $pgcp[16] = $rowxxa['pgcp16'];
    $pgcp[17] = $rowxxa['pgcp17'];
    $pgcp[18] = $rowxxa['pgcp18'];
    $pgcp[19] = $rowxxa['pgcp19'];
    $pgcp[20] = $rowxxa['pgcp20'];
    $pgcp[21] = $rowxxa['pgcp21'];
    $pgcp[22] = $rowxxa['pgcp22'];
    $pgcp[23] = $rowxxa['pgcp23'];
    $pgcp[24] = $rowxxa['pgcp24'];
    $pgcp[25] = $rowxxa['pgcp25'];
    $pgcp[26] = $rowxxa['pgcp26'];
    $pgcp[27] = $rowxxa['pgcp27'];
    $pgcp[28] = $rowxxa['pgcp28'];
    $pgcp[29] = $rowxxa['pgcp29'];
    $pgcp[30] = $rowxxa['pgcp30'];
    $pgcp[31] = $rowxxa['pgcp31'];
    $pgcp[32] = $rowxxa['pgcp32'];
    $pgcp[33] = $rowxxa['pgcp33'];
    $pgcp[34] = $rowxxa['pgcp34'];
    $pgcp[35] = $rowxxa['pgcp35'];
    $pgcp[36] = $rowxxa['pgcp36'];
    $pgcp[37] = $rowxxa['pgcp37'];
    $pgcp[38] = $rowxxa['pgcp38'];
    $pgcp[39] = $rowxxa['pgcp39'];
    $pgcp[40] = $rowxxa['pgcp40'];
    $pgcp[41] = $rowxxa['pgcp41'];
    $pgcp[42] = $rowxxa['pgcp42'];
    $pgcp[43] = $rowxxa['pgcp43'];
    $pgcp[44] = $rowxxa['pgcp44'];
    $pgcp[45] = $rowxxa['pgcp45'];
    $pgcp[46] = $rowxxa['pgcp46'];
    $pgcp[47] = $rowxxa['pgcp47'];
    $pgcp[48] = $rowxxa['pgcp48'];
    $pgcp[49] = $rowxxa['pgcp49'];
    $pgcp[50] = $rowxxa['pgcp50'];
    for($i=1;$i <= 50;$i++){
       if($pgcp[$i] == ""){
         break;
       }
    }
    $contis=$i-1;
    
    $vr_deb[1] = $rowxxa['vr_deb_1'];
    $vr_deb[2] = $rowxxa['vr_deb_2'];
    $vr_deb[3]= $rowxxa['vr_deb_3'];
    $vr_deb[4] = $rowxxa['vr_deb_4'];
    $vr_deb[5] = $rowxxa['vr_deb_5'];
    $vr_deb[6] = $rowxxa['vr_deb_6'];
    $vr_deb[7] = $rowxxa['vr_deb_7'];
    $vr_deb[8] = $rowxxa['vr_deb_8'];
    $vr_deb[9] = $rowxxa['vr_deb_9'];
    $vr_deb[10] = $rowxxa['vr_deb_10'];
    $vr_deb[11] = $rowxxa['vr_deb_11'];
    $vr_deb[12] = $rowxxa['vr_deb_12'];
    $vr_deb[13] = $rowxxa['vr_deb_13'];
    $vr_deb[14] = $rowxxa['vr_deb_14'];
    $vr_deb[15] = $rowxxa['vr_deb_15'];
    $vr_deb[16] = $rowxxa['vr_deb_16'];
    $vr_deb[17] = $rowxxa['vr_deb_17'];
    $vr_deb[18] = $rowxxa['vr_deb_18'];
    $vr_deb[19] = $rowxxa['vr_deb_19'];
    $vr_deb[20] = $rowxxa['vr_deb_20'];
    $vr_deb[21] = $rowxxa['vr_deb_21'];
    $vr_deb[22] = $rowxxa['vr_deb_22'];
    $vr_deb[23] = $rowxxa['vr_deb_23'];
    $vr_deb[24] = $rowxxa['vr_deb_24'];
    $vr_deb[25] = $rowxxa['vr_deb_25'];
    $vr_deb[26] = $rowxxa['vr_deb_26'];
    $vr_deb[27] = $rowxxa['vr_deb_27'];
    $vr_deb[28] = $rowxxa['vr_deb_28'];
    $vr_deb[29] = $rowxxa['vr_deb_29'];
    $vr_deb[30] = $rowxxa['vr_deb_30'];
    $vr_deb[31] = $rowxxa['vr_deb_31'];
    $vr_deb[32] = $rowxxa['vr_deb_32'];
    $vr_deb[33] = $rowxxa['vr_deb_33'];
    $vr_deb[34] = $rowxxa['vr_deb_34'];
    $vr_deb[35] = $rowxxa['vr_deb_35'];
    $vr_deb[36] = $rowxxa['vr_deb_36'];
    $vr_deb[37] = $rowxxa['vr_deb_37'];
    $vr_deb[38] = $rowxxa['vr_deb_38'];
    $vr_deb[39] = $rowxxa['vr_deb_39'];
    $vr_deb[40] = $rowxxa['vr_deb_40'];
    $vr_deb[41] = $rowxxa['vr_deb_41'];
    $vr_deb[42] = $rowxxa['vr_deb_42'];
    $vr_deb[43] = $rowxxa['vr_deb_43'];
    $vr_deb[44] = $rowxxa['vr_deb_44'];
    $vr_deb[45] = $rowxxa['vr_deb_45'];
    $vr_deb[46] = $rowxxa['vr_deb_46'];
    $vr_deb[47] = $rowxxa['vr_deb_47'];
    $vr_deb[48] = $rowxxa['vr_deb_48'];
    $vr_deb[49] = $rowxxa['vr_deb_49'];
    $vr_deb[50] = $rowxxa['vr_deb_50'];

    $vr_cre[1] = $rowxxa['vr_cre_1'];
    $vr_cre[2] = $rowxxa['vr_cre_2'];
    $vr_cre[3] = $rowxxa['vr_cre_3'];
    $vr_cre[4] = $rowxxa['vr_cre_4'];
    $vr_cre[5] = $rowxxa['vr_cre_5'];
    $vr_cre[6] = $rowxxa['vr_cre_6'];
    $vr_cre[7] = $rowxxa['vr_cre_7'];
    $vr_cre[8] = $rowxxa['vr_cre_8'];
    $vr_cre[9] = $rowxxa['vr_cre_9'];
    $vr_cre[10] = $rowxxa['vr_cre_10'];
    $vr_cre[11] = $rowxxa['vr_cre_11'];
    $vr_cre[12] = $rowxxa['vr_cre_12'];
    $vr_cre[13] = $rowxxa['vr_cre_13'];
    $vr_cre[14] = $rowxxa['vr_cre_14'];
    $vr_cre[15] = $rowxxa['vr_cre_15'];
    $vr_cre[16] = $rowxxa['vr_cre_16'];
    $vr_cre[17] = $rowxxa['vr_cre_17'];
    $vr_cre[18] = $rowxxa['vr_cre_18'];
    $vr_cre[19] = $rowxxa['vr_cre_19'];
    $vr_cre[20] = $rowxxa['vr_cre_20'];
    $vr_cre[21] = $rowxxa['vr_cre_21'];
    $vr_cre[22] = $rowxxa['vr_cre_22'];
    $vr_cre[23] = $rowxxa['vr_cre_23'];
    $vr_cre[24] = $rowxxa['vr_cre_24'];
    $vr_cre[25] = $rowxxa['vr_cre_25'];
    $vr_cre[26] = $rowxxa['vr_cre_26'];
    $vr_cre[27] = $rowxxa['vr_cre_27'];
    $vr_cre[28] = $rowxxa['vr_cre_28'];
    $vr_cre[29] = $rowxxa['vr_cre_29'];
    $vr_cre[30] = $rowxxa['vr_cre_30'];
    $vr_cre[31] = $rowxxa['vr_cre_31'];
    $vr_cre[32] = $rowxxa['vr_cre_32'];
    $vr_cre[33] = $rowxxa['vr_cre_33'];
    $vr_cre[34] = $rowxxa['vr_cre_34'];
    $vr_cre[35] = $rowxxa['vr_cre_35'];
    $vr_cre[36] = $rowxxa['vr_cre_36'];
    $vr_cre[37] = $rowxxa['vr_cre_37'];
    $vr_cre[38] = $rowxxa['vr_cre_38'];
    $vr_cre[39] = $rowxxa['vr_cre_39'];
    $vr_cre[40] = $rowxxa['vr_cre_40'];
    $vr_cre[41] = $rowxxa['vr_cre_41'];
    $vr_cre[42] = $rowxxa['vr_cre_42'];
    $vr_cre[43] = $rowxxa['vr_cre_43'];
    $vr_cre[44] = $rowxxa['vr_cre_44'];
    $vr_cre[45] = $rowxxa['vr_cre_45'];
    $vr_cre[46] = $rowxxa['vr_cre_46'];
    $vr_cre[47] = $rowxxa['vr_cre_47'];
    $vr_cre[48] = $rowxxa['vr_cre_48'];
    $vr_cre[49] = $rowxxa['vr_cre_49'];
    $vr_cre[50] = $rowxxa['vr_cre_50'];
	
	
	
	$cheque [1] = $rowxxa["cheque1"];
	$cheque [2] = $rowxxa["cheque2"];
	$cheque [3] = $rowxxa["cheque3"];
	$cheque [4] = $rowxxa["cheque4"];
	$cheque [5] = $rowxxa["cheque5"];
	$cheque [6] = $rowxxa["cheque6"];
	$cheque [7] = $rowxxa["cheque7"];
	$cheque [8] = $rowxxa["cheque8"];
	$cheque [9] = $rowxxa["cheque9"];
	$cheque [10] = $rowxxa["cheque10"];
	$cheque [11] = $rowxxa["cheque11"];
	$cheque [12] = $rowxxa["cheque12"];
	$cheque [13] = $rowxxa["cheque13"];
	$cheque [14] = $rowxxa["cheque14"];
	$cheque [15] = $rowxxa["cheque15"];
	$cheque [16] = $rowxxa["cheque16"];
	$cheque [17] = $rowxxa["cheque17"];
	$cheque [18] = $rowxxa["cheque18"];
	$cheque [19] = $rowxxa["cheque19"];
	$cheque [20] = $rowxxa["cheque20"];
	$cheque [21] = $rowxxa["cheque21"];
	$cheque [22] = $rowxxa["cheque22"];
	$cheque [23] = $rowxxa["cheque23"];
	$cheque [24] = $rowxxa["cheque24"];
	$cheque [25] = $rowxxa["cheque25"];
	$cheque [26] = $rowxxa["cheque26"];
	$cheque [27] = $rowxxa["cheque27"];
	$cheque [28] = $rowxxa["cheque28"];
	$cheque [29] = $rowxxa["cheque29"];
	$cheque [30] = $rowxxa["cheque30"];
	$cheque [31] = $rowxxa["cheque31"];
	$cheque [32] = $rowxxa["cheque32"];
	$cheque [33] = $rowxxa["cheque33"];
	$cheque [34] = $rowxxa["cheque34"];
	$cheque [35] = $rowxxa["cheque35"];
	$cheque [36] = $rowxxa["cheque36"];
	$cheque [37] = $rowxxa["cheque37"];
	$cheque [38] = $rowxxa["cheque38"];
	$cheque [39] = $rowxxa["cheque39"];
	$cheque [40] = $rowxxa["cheque40"];
	$cheque [41] = $rowxxa["cheque41"];
	$cheque [42] = $rowxxa["cheque42"];
	$cheque [43] = $rowxxa["cheque43"];
	$cheque [44] = $rowxxa["cheque44"];
	$cheque [45] = $rowxxa["cheque45"];
	$cheque [46] = $rowxxa["cheque46"];
	$cheque [47] = $rowxxa["cheque47"];
	$cheque [48] = $rowxxa["cheque48"];
	$cheque [49] = $rowxxa["cheque49"];
	$cheque [50] = $rowxxa["cheque50"];
	
	
    
    $tot_deb = $rowxxa['tot_deb'];
    $tot_cre = $rowxxa['tot_cre'];
	$ips=$rowxxa['ips'];
	$ccnit = $rowxxa['ccnit'];
    $difere = $tot_deb - $tot_cre;
	$tercero2 =  $tercero;
	$ter=$rowxxa['ccnit'];
   }   
   
   
            ?>
            <strong>DATOS COMPROBANTE DE EGRESO SIN AFECTACION PRESUPUESTAL </strong>            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Fecha  CESP : </strong></div>
          </div>
        </div></td>
        <td colspan="2" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left">
            <input name="fecha_ncon" type="text" class="required Estilo12" id="fecha_ncon" value="<? printf("%s",$fecha_ncon);?>" size="12" />
            <span class="Estilo8">:::</span>
            <input name="button2" type="button" class="Estilo12" onclick="displayCalendar(document.forms[0].fecha_ncon,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" align="center">
        <input type="hidden" name="id_emp" value="<? printf("%s",$id_emp);?>" />
        <!-- espacio para diferenciar el registro segun la naaturaleza del movimiento-->
        <?php
		if ($nit[0]==837000096){
		if ($ips=='') echo "<input type='checkbox' name='ips' value='1'  > Registro ACIZI<br>"; else echo "<input type='checkbox' name='ips' value='1' checked='checked'  > Registro ACIZI<br>";
		}
		?>
        <!-- Fin -->
        </td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>
              No. Automatico de CESP   : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><? printf("%s",$id_auto_ncon);?>
                <input name="id_auto_ncon" type="hidden" class="Estilo12" id="id_auto_ncon" value="<? printf("%s",$id_auto_ncon);?>"/>
            </div>
          </div>
        </div></td>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Digite Numero  de CESP : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="id_manu_ncon" type="text" class="required Estilo4" id="id_manu_ncon" style="text-align:center" onkeypress="return validar(event)" value="<? printf("%s",$id_manu_ncon);?>" onkeyup="chk_ncon();"/>
              <br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div class="Estilo4" align="center" id='res_ncon'></div>
        </div>
              
            </div>
          </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Seleccione Tercero  : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">

            <div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
                <div align="left">
                 <input type='text' name='tercero' class='Estilo4' id='tercero' size='70' value="<?php echo $ter. '-' . $tercero2; ?>"  /> &nbsp;<a href="../terceros/terceros.php" target="_new">Nuevo</a>
                <input type='text' name='valtercero' id='valtercero' value="<?php echo $ter ?>" /></div></div></div>
          </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Concepto / Detalle CESP : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="left">
              <input name="des_ncon" type="text" class="required Estilo12" id="des_ncon" size="118" onkeyup="a.des_ncon.value=a.des_ncon.value.toUpperCase();" value="<? printf("%s",$des_ncon);?>" />
            </div>
          </div>
        </div></td>
        </tr>
    </table>    </td>
  </tr>
  <tr>
  <td colspan="5">
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
          <img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='masitem();'>
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
	  <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>No. Dcto / Cheque </strong></div>
      </div></td>	  
	  
    </tr>
        <?
    // $acc='block';
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
            <div align='right'>
              <input name='cheque_$i' type='text' class='Estilo4' id='cheque_$i' style='text-align:right' value='$cheque[$i]'>
            </div>
          </div>
      </div></td>	  
    </tr>";
    if($i==$contis){$acc='none';}}
    ?>

    <tr>
      <td colspan=2 bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
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
            <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value=<? echo $tot_deb; ?> onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
      <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
          
          </div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td colspan=2 bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8"><strong>DIFERENCIA: </strong></div>
      </div></td>
      <td bgcolor="#990000" colspan=2><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="center">
            <input name="total" type="text" class="Estilo12" id="total" style="text-align:right" value=<? echo number_format($difere,2); ?> onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
	  <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
           
          </div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="4" bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right" class="Estilo8">
            <div align="center"><strong>VERIFIQUE FECHA, CONSECUTIVO, TERCERO Y DETALLE ANTES DE GRABAR</strong></div>
          </div>
      </div></td>
	  <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
           
          </div>
        </div>
      </div></td>
    </tr>
    
    <tr>
      <td colspan="5"><div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <input name="Submit" type="submit" class="Estilo4" value="Modifica COMPROBANTE DE EGRESO SIN AFECTACION PRESUPUESTAL" onclick="return noVacio3(this.form,this.form.contador.value);" >
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
<input type='hidden' name='nn' value='CESP'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");
?>
            </div>
          </div>
        </div>
        </div>
    </div>  </td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('../config.php');              
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
mysql_close();
}
?>