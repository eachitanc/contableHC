<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
		
if($_SESSION["rol"]=="")
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
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
.Estilo15 {color: #000000}
.Estilo17 {font-weight: bold}
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
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='ctas_0_gas.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  
  <tr>
    <td colspan="3"><div align="center">
      <?php
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

			
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from car_ppto_gas where id_emp = '$id' order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>


<tr bgcolor='#DCE9E5'>

<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Cod. Pptal</b></span>
</div>
</td>

<td align='center' width='350'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
<td align='center' width='30'><span class='Estilo4'><b>Tipo</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cta 0 Aprob</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Nombre P.G.C.P</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Por Ejecutar</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Reg Pptales</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Obliga</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Pagos en Efec</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Pagos sin Flujos de Efec</b></span></td>

</tr>

");
$cont=0;
while($rw = mysql_fetch_array($re)) 
   {
$vr_aprob=$rw["ppto_aprob"];
$cod_pptal=$rw["cod_pptal"];
$tip_dato=$rw["tip_dato"];


printf("

<span class='Estilo4'>
<tr>

<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>


", $rw["cod_pptal"], $rw["nom_rubro"],$rw["tip_dato"]);

if($tip_dato == 'M')
{
printf("<td align='right'><span class='Estilo4'>  </span></td>");
printf("<td align='right'><span class='Estilo4'>  </span></td>");
printf("<td align='right'><span class='Estilo4'>  </span></td>");
printf("<td align='right'><span class='Estilo4'>  </span></td>");
printf("<td align='right'><span class='Estilo4'>  </span></td>");
printf("<td align='right'><span class='Estilo4'>  </span></td>");
printf("<td align='right'><span class='Estilo4'>  </span></td>");

}
else
{

	$sql4 = "select * from ctas0_gas_ok where cod_pptal = '$cod_pptal' and id_emp = '$id_emp'";
	$result4 = mysql_query($sql4, $connection) or die(mysql_error());
	if (mysql_num_rows($result4) == 0)
	{
	
		printf("<td align='right'><span class='Estilo4'>  </span></td>");
		printf("<td align='right'><span class='Estilo4'>  </span></td>");
		printf("<td align='right'><span class='Estilo4'>  </span></td>");
		printf("<td align='right'><span class='Estilo4'>  </span></td>");
		printf("<td align='right'><span class='Estilo4'>  </span></td>");
		printf("<td align='right'><span class='Estilo4'>  </span></td>");
		printf("<td align='right'><span class='Estilo4'>  </span></td>");	
	
	}
	else
	{
	

		$sql3 = "select * from ctas0_gas_ok where cod_pptal = '$cod_pptal' and id_emp = '$id_emp'";
		$resultado3 = mysql_db_query($database, $sql3, $connection);
	
		while($row3 = mysql_fetch_array($resultado3)) 
	   {
	   
	   $cod_pptal_gas_apr =$row3["cod_pptal_gas_apr"];
	   $nom_pptal_gas_apr =$row3["nom_pptal_gas_apr"];
	   $cod_pptal_gas_apr2 =$row3["cod_pptal_gas_apr2"];
	   $cod_pptal_crp =$row3["cod_pptal_crp"];   
	   $cod_pptal_cobp =$row3["cod_pptal_cobp"];   
	   $cod_pptal_ceva_con_sit =$row3["cod_pptal_ceva_con_sit"];   
	   $cod_pptal_ceva_sin_sit =$row3["cod_pptal_ceva_sin_sit"];   
	
	   }
	   
		printf("<td align='center'><span class='Estilo4'> %s </span></td>",$cod_pptal_gas_apr);
		printf("<td align='left'><span class='Estilo4'> %s </span></td>",$nom_pptal_gas_apr);
		printf("<td align='center'><span class='Estilo4'> %s </span></td>",$cod_pptal_gas_apr2);
		printf("<td align='center'><span class='Estilo4'> %s </span></td>",$cod_pptal_crp);
		printf("<td align='center'><span class='Estilo4'> %s </span></td>",$cod_pptal_cobp);
		printf("<td align='center'><span class='Estilo4'> %s </span></td>",$cod_pptal_ceva_con_sit);
		printf("<td align='center'><span class='Estilo4'> %s </span></td>",$cod_pptal_ceva_sin_sit);
	
	}


}

printf("</tr>");

$cont++;

   }//fin while

printf("</table></center>");
//--------	
?>
    </div></td>
  </tr>
  
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='ctas_0_gas.php' target='_parent'>VOLVER </a> </div>
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
else
{
	//echo "no tiene permisos para acceder ";
	include('../config.php');
	printf("
	
	<table width='600' border='0' align='center'>
  <tr>
    
    <td width='600' colspan='3'>
	<div class='Estilo2' id='main_div' style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;'>
	  <div align='center'><img src=\"../../ADMIN/images/PLANTILLA PNG PARA BANNER COMUN.png\" width='585' height='100' /></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan='3'>
		
			
		<table width='595' border='0' align='center'>
	
	
	<tr>
	<td>
	
	  <div align='center'>
	   <font size='5' color='#FF0000' > Usted no tiene permisos para acceder..! </font> 
		
	    
	   <br />
	    </div></td>
	</tr>
	</table>
		
		
		
	</td>
  </tr>
  <tr>
  
    <td colspan='3'>
	
	<form name='empresa' method='post' action=\"../proc_crear_emp.php\" >
	</form><br />
	<div align='center'>
	<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
  <div align='center'><a href=\"../user.php\" target='_parent'>VOLVER</a>  </div>
</div>
</div>
</div>
	
	</td>
	
  </tr>
  <tr> 
 	<td height='50'>
	<td> 
  </tr>
  <tr>
   
    <td colspan='3'>
	<div class='Estilo7' id='main_div' style='padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;'>
	  <div align='center'>Desarrollado por <br />
	    <a href=\http://www.qualisoftsalud.com\" target='_blank'><img src=\"../../ADMIN/images/logoqsft2.png\" width='150' height='69' border='0' /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
	
	");
	
}
}
?>