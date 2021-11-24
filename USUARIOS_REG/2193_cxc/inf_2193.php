<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
		// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT info FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['info']=='SI')
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


<style type="text/css">
<!--
.Estilo11 {font-weight: bold; color: #FFFFFF; }
-->
</style>
</head>


</head>

<body>
<?

include('../config.php');	

$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from fecha";
$resultado = mysql_db_query($database, $sql, $connection);

while($row = mysql_fetch_array($resultado)) 
   {
   
   $ano=$row["ano"];
  
   }
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connection);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   }   

?>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="798" colspan="3">
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
</table>
<div align="center">
<br />
<form name="a" method="post">
<table width="600" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><b>INFORME 2193 - CUENTAS POR COBRAR  </b></div>
    </div></td>
  </tr>
  <tr>
    <td width="291"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><strong>FECHA DE INICIO </strong></div>
    </div></td>
    <td width="291"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><strong>SELECCIONE FECHA DE CORTE </strong></div>
    </div></td>
  </tr>
  <tr>
    <td><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <input name="fecha_ini" type="hidden" value="<?php printf($desde); ?>"/>
        <?php printf($desde); ?> </div>
    </div></td>
    <td><div id="div3" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <input name="fecha_fin" type="text" class="Estilo4" id="fecha_fin" value="<?php printf($ano); ?>" size="12" />
        <span class="Estilo11">::</span>
        <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_fin,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
      </div>
    </div></td>
  </tr>
  
  <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <div align="center">
          <input name="Submit322" type="submit" class="Estilo4"  value="Consultar" 
			onclick="this.form.action = 'inf_2193.php'" />
        </div>
      </div>
    </div></td>
  </tr>
</table>
</form>
<br />
  <?php

$fecha_ini = $_POST['fecha_ini'];  
$fecha_fin = $_POST['fecha_fin'];  

if($fecha_ini == "" or $fecha_fin == "")
{
  $fecha_ini='2010/01/01';
  $fecha_fin='2010/01/01';
}

printf("<br><center><span class='Estilo4'><b>Fecha Inicial : %s <br> Fecha de Corte : %s </b><center><br><br>",$fecha_ini,$fecha_fin);
//-------
include('../config.php');	

$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from fecha";
$resultado = mysql_db_query($database, $sql, $connection);

while($row = mysql_fetch_array($resultado)) 
   {
   
   $id=$row["id_emp"];
   $idxx=$row["id_emp"];
   $id_emp=$row["id_emp"];

   }
//*** tabla auxiliar   
include('../config.php');	
$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$tabla6="aux_2193_cxc";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

mysql_select_db ($base, $connection);

		if(mysql_query ($anadir6 ,$connection)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};	


		$tabla7="aux_2193_cxc";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `auto_reip` varchar(200) NOT NULL default '',
  `manu_reip` varchar(200) NOT NULL default '',
  `cod_pptal` varchar(200) NOT NULL default '',
  `vr_reip` varchar(200) NOT NULL default '',
  `concepto_2193` varchar(200) NOT NULL default '',
  `auto_caic` varchar(200) NOT NULL default '',
  `tercero` varchar(200) NOT NULL default '',
  `fecha_causa` varchar(200) NOT NULL default '',
  `fecha_venci` varchar(200) NOT NULL default '',
  `tot_recaudado` varchar(200) NOT NULL default '',
  `saldoxrecaudar` varchar(200) NOT NULL default '',
  `edad_cartera` varchar(200) NOT NULL default ''
  )TYPE=MyISAM ";
		
		mysql_select_db ($base, $connection);

		if(mysql_query ($anadir7 ,$connection)) 
		{
		//echo "listo";
		}
		else
		{
		//echo "no se pudo";
		}
//********llena tabla auxiliar
$sql2 = "select * from reip_ing";
$resultado2 = mysql_db_query($database, $sql2, $connection);
while($row2 = mysql_fetch_array($resultado2)) 
{
   
   $consecutivo=$row2["consecutivo"];
   $cuenta=$row2["cuenta"];
   $id_manu_reip=$row2["id_manu_reip"];
   $valor=$row2["valor"];  

	$sql3 = "select * from 2193_ing_ok where cod_pptal ='$cuenta'";
	$resultado3 = mysql_db_query($database, $sql3, $connection);

	while($row3 = mysql_fetch_array($resultado3)) 
   	{
      $cod_pptal=$row3["cod_pptal"];
	  $concepto=$row3["concepto"];
   	}
	
	$sql4 = "select * from cartera_cont where id_reip ='$consecutivo'";
	$resultado4 = mysql_db_query($database, $sql4, $connection);

	while($row4 = mysql_fetch_array($resultado4)) 
   	{
      $consec_cartera=$row4["consec_cartera"];
	  $tercero=$row4["tercero"];
	  $fecha_causa=$row4["fecha_causa"];
	  $fecha_ven=$row4["fecha_ven"];
   	}
	
	//*****************
	//printf("<td align='center'><span class='Estilo4'>");
	$sql5 = "select * from recaudo_roit where id_reip ='$consecutivo'";
	$resultado5 = mysql_db_query($database, $sql5, $connection);
	while($row5 = mysql_fetch_array($resultado5)) 
   	{
	  $fecha_recaudo=$row5["fecha_recaudo"];
       //printf("%s<br>",$fecha_recaudo);
  	}   
	//printf("</span></td>");
	
	//**************
		//printf("<td align='right'><span class='Estilo4'>");
	$sql5 = "select * from recaudo_roit where id_reip ='$consecutivo'";
	$resultado5 = mysql_db_query($database, $sql5, $connection);
    $cont=0;
	while($row5 = mysql_fetch_array($resultado5)) 
   	{
      $vr_digitado=$row5["vr_digitado"];	  
	 // printf("%s<br>",number_format($vr_digitado,2,',','.'));
	  $cont = $cont + $vr_digitado;
  	}   
	//printf("</span></td>");
	//**************
	 $saldo = $valor - $cont;
	 //*************** edad
	 $startDate = $fecha_causa;
	 $endDate = $fecha_fin;
	 list($year, $month, $day) = explode('/', $startDate);  
	 $startDate = mktime(0, 0, 0, $month, $day, $year);  
	 list($year, $month, $day) = explode('/', $endDate);  
	 $endDate = mktime(0, 0, 0, $month, $day, $year);  
	 $totalDays = ($endDate - $startDate)/(60 * 60 * 24); 
	 
	 $edad_cartera=number_format($totalDays,0,',','.');
	 
$sql_ok = "INSERT INTO aux_2193_cxc 
						(auto_reip,manu_reip,cod_pptal,vr_reip,concepto_2193,auto_caic,tercero,fecha_causa,fecha_venci,tot_recaudado,saldoxrecaudar,edad_cartera) 
						VALUES 
						('$consecutivo','$id_manu_reip','$cuenta','$valor','$concepto','$consec_cartera','$tercero','$fecha_causa','$fecha_ven','$cont','$saldo','$edad_cartera') ";
						mysql_query($sql_ok, $connection) or die(mysql_error());	 
	 
}   
   
	
printf("<br><center><span class='Estilo4'><b>FILTRAR INFORME GENERAL</b><center><br>");

?>
<form name="aa" method="post">
<select name="filtro" class="Estilo4" id="filtro">
<?
$db1 = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL1 = "SELECT DISTINCT(concepto_2193),tercero,auto_reip FROM aux_2193_cxc group by tercero order by concepto_2193 asc";
$rs1 = mysql_query($strSQL1);
$nr1 = mysql_num_rows($rs1);
for ($i=0; $i<$nr1; $i++) {
	$r1 = mysql_fetch_array($rs1);
	echo "<OPTION VALUE=\"".$r1["concepto_2193"].";".$r1["tercero"]."\">".$r1["concepto_2193"]." - ".$r1["tercero"]."</OPTION>";
}
?>
</select>
<input type="hidden" name="fecha_ini" value="<? printf("%s",$fecha_ini); ?>" />
<input type="hidden" name="fecha_fin" value="<? printf("%s",$fecha_fin); ?>" />
<br />
<br />

<input name="Submit" type="submit" class="Estilo4" value="Filtrar Informe" onclick="this.form.action = '2193_cxc_filro.php'" />
</form>
<br />
<br />

<?
printf("
<center>
<table width='1200' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONSEC AUT REIP</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>CONSEC MANU REIP</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CUENTA PPTAL</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>VR REIP</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CONCEPTO 2193</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CONSEC CAIC</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>FECHA CAUSAC</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>FECHA VENCI</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>TOT RECAUDADO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>SALDO X RECAUDAR</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>EDAD CARTERA (Dias)</b></span></td>


</tr>

");

$fecha_f=$_POST['fecha_fin'];

$sql2 = "select * from aux_2193_cxc where fecha_causa <= '$fecha_f'";
$resultado2 = mysql_db_query($database, $sql2, $connection);
while($row2 = mysql_fetch_array($resultado2)) 
{
printf("<tr>");
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["auto_reip"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["manu_reip"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["cod_pptal"]);
printf("<td align='right'><span class='Estilo4'>%s</span></td>",number_format($row2["vr_reip"],2,',','.'));
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["concepto_2193"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["auto_caic"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["tercero"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["fecha_causa"]);
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["fecha_venci"]);
printf("<td align='right'><span class='Estilo4'>%s</span></td>",number_format($row2["tot_recaudado"],2,',','.'));
printf("<td align='right'><span class='Estilo4'>%s</span></td>",number_format($row2["saldoxrecaudar"],2,',','.'));
printf("<td align='center'><span class='Estilo4'>%s</span></td>",$row2["edad_cartera"]);
printf("</tr>");

}
printf("</table></center>"); 
?>
</div>
<table width="800" border="0" align="center">
  
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
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <?PHP include('../config.php'); echo $nom_emp ?>
        <br />
        <?PHP echo $dir_tel ?><br />
        <?PHP echo $muni ?> <br />
        <?PHP echo $email?> </div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <br />
        </a><br />
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a></div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
      <div align="center">Desarrollado por <br />
            <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
        Derechos Reservados - 2009 </div>
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>






<?
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>