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
.Estilo10 {	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #333333;
	font-weight: bold;
}
.Estilo9 {color: #FFFFFF}
-->
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
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
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
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
	
	<form name="a" method="post" action="con_x_tip.php">
		<table width="600" border="1" align="center" class="bordepunteado1">
          <tr>
            <td bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center" class="Estilo4"><strong>CONSULTA POR TIPO DE DOCUMENTO FUENTE<br />PRESUPUESTO DE INGRESOS </strong></div>
            </div></td>
          </tr>
          <tr>
            <td><?php 
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx['ano'];
   }

$sqlxx2 = "select * from fecha_ini_op";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
   {
   
   $desde=$rowxx2["fecha_ini_op"];
   
 
   }   
   
?>
                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                  <div align="center"><span class="Estilo4"><strong>Seleccione el Documento Fuente </strong>: </span>
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
          </tr>
        </table>
		<br />
		<table width="600" border="1" align="center" class="bordepunteado1">
          <tr>
            <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
                <div align="center" class="Estilo4"><b>NOTA</b>: La consulta se hara con base a la <b>Fecha de Inicio</b> y <b>Fecha Final</b> que usted seleccione </div>
            </div></td>
          </tr>
          <tr>
            <td><div class="Estilo10" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="center">SELECCIONE FECHA DE INICIO </div>
            </div></td>
            <td><div class="Estilo10" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="center">SELECCIONE FECHA FINAL </div>
            </div></td>
          </tr>
          <tr>
            <td><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center">
                  <input name="fecha_ini" type="text" class="Estilo4" id="fecha_ini" value="<?php printf($desde); ?>" size="12" />
                  <span class="Estilo9">::</span>
                  <input name="button" type="button" class="Estilo4" id="button" onclick="displayCalendar(document.a.fecha_ini,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
                </div>
            </div></td>
            <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center">
                  <input name="fecha_fin" type="text" class="Estilo4" id="fecha_fin" value="<?php printf($ano); ?>" size="12" />
                  <span class="Estilo9">::</span>
                  <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_fin,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
                </div>
            </div></td>
          </tr>
          <tr>
            <td colspan="2"><div class="Estilo10" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="Submit2" type="submit" class="Estilo4" value="Consultar" />
                </div>
            </div></td>
          </tr>
        </table>
      </form>	</td>
  </tr>
  <tr>
    <td colspan="3">
	  <div align="center">
	    <?
	printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo10'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	",$fecha_ini,$fecha_fin);
	?>
      </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <? 
	   $a=$_POST['nn'];
	   $fecha_ini=$_POST['fecha_ini'];
	   $fecha_fin=$_POST['fecha_fin'];
	   //printf("%s<br>%s<br>%s",$a,$fecha_ini,$fecha_fin);
	   if ($a == 'CAIC')
	   {

//-------
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");


//SELECT name, SUM(object1) AS o1_sum, SUM(object2) AS o2_sum FROM table GROUP BY name

//$sq = "SELECT name, SUM(object1) AS o1_sum, SUM(object2) AS o2_sum FROM table GROUP BY name ";
//$sq = "select distinct(consecutivo),(select sum(valor)), nat_com,jur_com,id_manu_reip,des from reip_ing where id_emp = '$id_emp' order by fecha_reg asc ";
$sq = "select * from cartera_cont where (fecha_causa between '$fecha_ini' and '$fecha_fin' ) and id_emp = '$id_emp' order by fecha_causa asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>

<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><B>No. COMP.</b></span>
</div>
</td>
<td align='center' width='80'><span class='Estilo4'><B>FECHA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><B>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><B>DESCRIPCION - REFERENCIA</b></span></td>


</tr>

");
$val=0;
while($rw = mysql_fetch_array($re)) 
   {

$tercero =  $rw["tercero"];
   
printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>


</tr>", $rw["consec_cartera"], $rw["fecha_causa"], $rw["tercero"], $rw["ref"]); 


   }

printf("</table></center>");

//--------	

		}
		?>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <? 
	   $a=$_POST['nn'];
	   $fecha_ini=$_POST['fecha_ini'];
	   $fecha_fin=$_POST['fecha_fin'];
	   //printf("%s<br>%s<br>%s",$a,$fecha_ini,$fecha_fin);
	   if ($a == 'OBCG')
	   {

//-------
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");


//SELECT name, SUM(object1) AS o1_sum, SUM(object2) AS o2_sum FROM table GROUP BY name

//$sq = "SELECT name, SUM(object1) AS o1_sum, SUM(object2) AS o2_sum FROM table GROUP BY name ";
//$sq = "select distinct(consecutivo),(select sum(valor)), nat_com,jur_com,id_manu_reip,des from reip_ing where id_emp = '$id_emp' order by fecha_reg asc ";
$sq = "select * from obcg where (fecha_obcg between '$fecha_ini' and '$fecha_fin' ) and id_emp = '$id_emp' order by fecha_obcg asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>

<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><B>No. COMP.</b></span>
</div>
</td>
<td align='center' width='80'><span class='Estilo4'><B>FECHA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><B>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><B>DESCRIPCION - REFERENCIA</b></span></td>


</tr>

");
$val=0;
while($rw = mysql_fetch_array($re)) 
   {

$tercero =  $rw["tercero"];
   
printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>


</tr>", $rw["id_manu_obcg"], $rw["fecha_obcg"], $rw["tercero"], $rw["concepto_obcg"]); 


   }

printf("</table></center>");

//--------	

		}
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
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>