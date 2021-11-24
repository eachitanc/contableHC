<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
		// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT conta FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['conta']=='SI')
{

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
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo18 {font-weight: bold}
.Estilo19 {font-weight: bold}
-->
</style>
</head>


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
    <td colspan="3"><table width="750" border="0" align="center">
      
      <tr>
       <td width="750" colspan="3">
	   <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<form name="a" method="post" action="dctos_fuente2.php" onsubmit="return confirm('Confirme su seleccion')">
	<table width="350" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="3" bgcolor="#DCE9E5">
		 <div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
		   <div align="center" class="Estilo4"><strong>REGISTRO DE DOCUMENTOS	FUENTE	     </strong></div>
		 </div>		</td>
        </tr>
      <tr>
        <td width="175" class="Estilo4">
		<div class="Estilo18" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		  <div align="center">SOPORTES</div>
		</div>		</td>
        <td width="175" colspan="2" class="Estilo4"><div class="Estilo10 Estilo19" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
          <div align="center">COMPROBANTES</div>
        </div></td>
        </tr>
      <tr>
        <td><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
          <div align="center">
            <input name="a" type="radio" value="SOPORTES" checked="checked" />
          </div>
        </div></td>
        <td colspan="2"><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
         
          <div align="center">
            <input name="a" type="radio" value="COMPROBANTES" />
          </div>
          
</div></td>
        </tr>
      <tr>
       <td colspan="3">
	   <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	     <div align="center">
	       <input name="Submit" type="submit" class="Estilo4" value="Siguiente" />
         </div>
	   </div>	   </td>
       </tr>
    </table>
	</form>
	   </div>	   </td>
        </tr>
      
      
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="750" border="1" align="center" class="bordepunteado1">
      <tr>
        <td bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><strong>IMPORTANTE</strong></div>
        </div></td>
      </tr>
      <tr>
        <td align="left"><div style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <span class="Estilo4"> 1. Si desea <strong>MODIFICAR</strong> un DOCUMENTO FUENTE , debe ELIMINARLO Y VOLVER A CREARLO. (solo administrador del sistema) <br />
          2.         Si desea <strong>ELIMINAR</strong> un DOCUMENTO FUENTE, seleccione el NOMBRE del mismo.</span> <span class="Estilo4">(solo administrador del sistema) </span></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
      <div align="center"><strong>SOPORTES ALMACENADOS</strong></div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align="center">
        <?php
//-------
include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}

include('../config.php');				
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from dctos_fuente_soportes where id_emp = '$id_emp' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='750' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='50'>
<span class='Estilo4' ><b></b></span>
</td>
<td align='center' width='400'>
<span class='Estilo4'>
<b></b>
</span>
</td>
<td align='center' width='150' colspan='3'>
<span class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<b>PRESUPUESTO</b>
</div>
</span>
</td>
<td align='center' width='50' rowspan='2'><span class='Estilo4'><b>CONT</b></span></td>
</tr>


<tr bgcolor='#DCE9E5'>
<td align='center' width='50'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>COD</b></span>
</div>
</td>
<td align='center' width='400'>
<span class='Estilo4'>
<b>NOMBRE DEL SOPORTE</b>
</span>
</td>
<td align='center' width='50'><span class='Estilo4'><b>ING</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>GAS</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>TES</b></span></td>
</tr>

");

while($rw = mysql_fetch_array($re)) 
   {
printf("
<span class='Estilo4'>
<tr>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>

</tr>", $rw["cod"], $rw["nombre"], $rw["afecta_ing"], $rw["afecta_gas"], $rw["afecta_tes"], $rw["afecta_con"]); 


   }

printf("</table></center>");
//--------	------------------------------------------------------
?>
        </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div class="Estilo19" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align="center" class="Estilo4">COMPROBANTES ALMACENADOS </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align="center">
        <?php
//-------
include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}

include('../config.php');				
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from dctos_fuente_comprobantes where id_emp = '$id_emp' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='750' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='50'><span class='Estilo4'><b></b></span></td>
<td align='center' width='350'><span class='Estilo4'><b></b></span></td>
<td colspan='3' align='center' width='150'><span class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<b>PRESUPUESTO</b></span>
</div>
</td>
<td colspan='3' align='center' width='150'><span class='Estilo4'><b>TESORERIA</b></span></td>
<td rowspan='2' align='center' width='50'><span class='Estilo4'><b>CONT</b></span></td>
</tr>


<tr bgcolor='#DCE9E5'>
<td align='center' width='50'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>COD</b></span>
</div>
</td>
<td align='center' width='350'><span class='Estilo4'><b>NOMBRE DEL COMPROBANTE</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>ING</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>GAS</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>CXP</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>ING</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>GAS</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>CxP</b></span></td>
</tr>


");

while($rw = mysql_fetch_array($re)) 
   {
printf("
<span class='Estilo4'>
<tr>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>


</tr>", $rw["cod"], $rw["nombre"], $rw["ppto_ing"], $rw["ppto_gas"], $rw["ppto_cxp"], $rw["tes_ing"], $rw["tes_gas"], $rw["tes_cxp"], $rw["cont"]); 


   }

printf("</table></center>");
//--------	------------------------------------------------------
?>
      </div>
    </div></td>
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
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>