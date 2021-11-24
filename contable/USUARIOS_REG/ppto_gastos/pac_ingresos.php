<?
session_start();
if(!session_is_registered("login"))
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
.Estilo9 {
	color: #FF0000;
	font-weight: bold;
}
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo9 {font-weight: bold}
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo18 {	color: #FF0000;
	font-weight: bold;
}
.Estilo18 {font-weight: bold}
.Estilo19 {	color: #FF0000;
	font-weight: bold;
}
.Estilo19 {font-weight: bold}
.Estilo20 {
	color: #990000;
	font-weight: bold;
}
.Estilo21 {	color: #FF0000;
	font-weight: bold;
}
.Estilo21 {font-weight: bold}
-->
</style>
</head>

<body>
<table width="810" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='consulta_ppto_gas.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
	<form name="a" method="post" action="pac_ingresos_2.php" onsubmit="return confirm('Desea Continuar?')">
	<table width="750" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="3" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
<?php 
include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];

   }
?>
              <? 
			
		   mysql_connect($server,$dbuser,$dbpass); 
		   mysql_select_db($database);  
		   $a=$_GET['id1'];  
		   $a1=mysql_query("select * from car_ppto_gas where cod_pptal = '$a' and id_emp ='$idxx'");  
		   $result = @mysql_query($a1);
		   while($row = mysql_fetch_array($a1)) 
		   { 
			 $c3=$row["tip_dato"];
			 $c4=$row["nom_rubro"];
			 $c5=$row["ppto_aprob"];
			 $c6=$row["pac"];
			 $c7=$row["ano"];
			 

			} 
			
//			if ($c3 == 'D')
			if ($c3 == 'D' and $c6 == 'NO')
			{
			  $cod_pptal = $a;
			  $nom_rubro = $c4;
			  $definitivo = $c5;

			 
?>
              <strong>PROGRAMA ANUAL MENSUALIZADO DE CAJA<BR /> 
              - P.A.C - </strong></div>
        </div></td>
      </tr>
      <tr>
        <td class="Estilo4"><div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right">CODIGO PRESUPUESTAL : </div>
            </div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="left" class="Estilo4"> <? printf('%s <br><br> %s',$cod_pptal,$nom_rubro); ?>
                <input name="cod_pptal" type="hidden" class="Estilo4" id="cod_pptal" value="<? printf($cod_pptal); ?>"/>
            </div>
        </div></td>
      </tr>
      
      <tr>
        <td class="Estilo4"><div class="Estilo19" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right">VALOR ACTUAL :</div>
          </div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4"> <? printf('%.2f',$definitivo); ?>
              <input name="definitivo" type="hidden" class="Estilo4" id="definitivo" value="<? printf('%.2f',$definitivo); ?>"/>
          </div>
        </div></td>
      </tr>
      <tr>
        <td><div class="Estilo19" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right">CUENTA CREADA EL : </div>
          </div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4"> <? printf('%s',$c7); ?></div>
        </div></td>
      </tr>
      <tr>
        <td><div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right">NUMERO DE MESES A DIVIDIR </div>
            </div>
        </div></td>
        <td width="533" colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4"> 
<?
$connection = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$consultax=mysql_query("select * from vf ",$connection);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
} 		  
		  
 $startDate = $c7;
 $endDate = $bx;  
 list($year, $month, $day) = explode('/', $startDate);  
 $startDate = mktime(0, 0, 0, $month, $day, $year);  
 list($year, $month, $day) = explode('/', $endDate);  
 $endDate = mktime(0, 0, 0, $month, $day, $year);  
 $totalDays = ($endDate - $startDate)/(60 * 60 * 24);  
 //obtengo el valor absoulto de los dias (quito el posible signo negativo)
 $totalDays = abs($totalDays);
 // paso dias a meses
 $meses = $totalDays / 30;
 //quito los decimales a los meses de diferencia
 $meses = floor($meses);
?>
		  
           <input name="meses" type="text" class="Estilo4" id="meses" size="20" maxlength="2" value="<? echo $meses; ?>" />
              <span class="Estilo20">...::: (INCLUYA EL REZAGO Y EL MES ACTUAL SI ES NECESARIO) :::... </span></div>
        </div></td>
      </tr>
      <tr>
        <td colspan="3" class="Estilo4"><div class="Estilo18" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <input name="Submit" type="submit" class="Estilo4" value="Continuar" />
          </div>
        </div></td>
        </tr>
    </table>
	</form>



			<? 
			
			}
						
			else
			{
			  printf("<br><b>LA CUENTA SELECCIONADA ES DE TIPO MAYOR</b><BR><br>O YA SE CREO EL P.A.C<BR><BR>");
			} ?>
		</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='consulta_ppto_gas.php' target='_parent'>VOLVER </a> </div>
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
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
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
    <td width="270">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="270">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="270">
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