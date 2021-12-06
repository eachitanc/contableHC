<?php
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
		// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		 
       	$sql="SELECT teso,conta FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['teso']=='SI' or $rw['conta']=='SI' )
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>


<style type="text/css">
<!--
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
.Estilo8 {color: #FFFFFF}
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
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46 || tecla == 45) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>

<!--<script>
function chk_saldo(){
var pos_url = 'comprueba_saldo.php';
var cod = document.getElementById('fecha_fin').value;
var cod1 = document.getElementById('nn').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado').innerHTML = req.responseText;
}
}
req.open('GET', pos_url+'?cod='+cod+'&cod1='+cod1,true);
req.send(null);
}
}
</script>-->




<!--**************************-->

</head>

<body>

<br />
<br />

<table width="600" border="0" align="center">
  
  <tr>
    <td width="798" colspan="3"><?php
include('../config.php');

//**** variables para generacion dinamica
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

$sqlxx = "select * from fecha";
$resultadoxx =$conexion->query($sqlxx);
while($rowxx = $resultadoxx->fetch_assoc()) 
{  $idxx=$rowxx["id_emp"];  $id_emp=$rowxx["id_emp"];  }
//********************** ano y fecha ini op
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = $connectionxx->query($sqlxx3);

while($rowxx3 = $resultadoxx3->fetch_assoc()) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   }  
//********************
//********************

?>
      <form name="a" method="post">
	  <table width="600" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><b>CONCILIACIONES BANCARIAS </b></div>
    </div></td>
  </tr>

  <tr>
    <td width="267"><div class="Estilo4" style="padding-left:10px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="left"><strong>SELECCIONE CUENTA : </strong></div>
    </div></td>
    <td width="315">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <select name="nn" class="Estilo4" style="width: 400px;">
          <?php
include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM pgcp WHERE id_emp = '$idxx' AND tip_dato = 'D' AND cod_pptal like '1110%' ORDER BY cod_pptal";
$rs = $db->query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = $rs->fetch_assoc();
	echo "<OPTION VALUE=\"".$r["cod_pptal"].";".$r["nom_rubro"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
}
?>
        </select>
      </div>
    </div></td>
    </tr>
  
  <tr>
    <td><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="right"><strong>SELECCIONE FECHA DE CORTE O PERIODO : </strong></div>
    </div></td>
    <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      
          <div align="center">
<?php
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
$ano=$rowxx["ano"];
}
$anio = substr($ano,0,4);

function esBisiesto($year=NULL) {
    return checkdate(2, 29, ($year==NULL)? date('Y'):$year); // devolvemos true si es bisiesto
}
$bis = esBisiesto($anio);
if ($bis ==1) $feb= $anio.'/02/29'; else $feb = $anio.'/02/28';


?>	  
<select name="fecha_fin" class="Estilo4" id="corte">
<option value="<?php printf("$anio/01/31");?>">ENERO </option>
<option value="<?php printf("$feb");?>">FEBRERO </option>
<option value="<?php printf("$anio/03/31");?>">MARZO </option>
<option value="<?php printf("$anio/04/30");?>">ABRIL </option>
<option value="<?php printf("$anio/05/31");?>">MAYO </option>
<option value="<?php printf("$anio/06/30");?>">JUNIO </option>
<option value="<?php printf("$anio/07/31");?>">JULIO </option>
<option value="<?php printf("$anio/08/31");?>">AGOSTO </option>
<option value="<?php printf("$anio/09/30");?>">SEPTIEMBRE </option>
<option value="<?php printf("$anio/10/31");?>">OCTUBRE </option>
<option value="<?php printf("$anio/11/30");?>">NOVIEMBRE </option>
<option value="<?php printf("$anio/12/31");?>">DICIEMBRE </option>
</select>		
          <br />
          </div>
    </div></td>
  </tr>
  
  <tr>
    <td><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="right"><strong>DIGITE SALDO EN EXTRACTO </strong>: </div>
    </div></td>
    <td><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">

                <div align="center">
                  <input name="saldo" type="text" class="Estilo4" id="saldo" onkeypress="return validar(event)" />
                <br />
				<em>(Dejar vacio si desea usar el valor previamente digitado)				</em></div>
    </div>	</td>
  </tr>
  
  <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <div align="center">
            <input name="Submit322" type="submit" class="Estilo4"  value="Generar Conciliacion Bancaria" 
			onclick="this.form.action = 'conciliaciones2.php'" />
          </div>
      </div>
    </div></td>
  </tr>
</table>
</form>	
<br />
<?php
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
///**** creo la tabla aux_conciliaciones

		$tabla7="aux_conciliaciones";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `consecutivo` varchar(200)  NOT NULL default '',
  `fecha_fin` varchar(200)  NOT NULL default '',
  `saldo_extracto` decimal(20,2) NOT NULL default '0.00',
  `cuenta` varchar(200)  NOT NULL default '',
  `nom_rubro` varchar(200)  NOT NULL default '',
  `fecha` varchar(200)  NOT NULL default '',
  `dcto` varchar(200)  NOT NULL default '',
  `tercero` varchar(200)  NOT NULL default '',
  `cheque` varchar(200)  NOT NULL default '',
  `debito` decimal(20,2) NOT NULL default '0.00',
  `credito` decimal(20,2) NOT NULL default '0.00',
  `estado` varchar(200)  NOT NULL default '',
  `saldo_inicial` decimal(20,2) NOT NULL default '0.00',
  `total_debitos` decimal(20,2) NOT NULL default '0.00',
  `total_creditos` decimal(20,2) NOT NULL default '0.00',
  `saldo_final` decimal(20,2) NOT NULL default '0.00',
  `flag1` varchar(200)  NOT NULL default '',
  `flag2` varchar(200)  NOT NULL default '',
  `fecha_marca` varchar(200)  NOT NULL default ''
) TYPE=MyISAM ";
		
	
		mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{
		//echo "<center class='Estilo4'> <br> <center>La tabla $tabla7 se ha creado con exito<br></center>";
		}
		else
		{
		//echo "<center class='Estilo4'> <br> <center>La tabla $tabla7 ya esta creada<br></center>";
		}	

//********************
//********************
?>
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
      </div>
    </div>
  </div>
</div></td>
  </tr>
</table>
</body>
</html>






<?php

}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>