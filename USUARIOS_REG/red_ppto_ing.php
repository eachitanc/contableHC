<?
session_start();
if(!session_is_registered("login"))
{
header("Location: login.php");
exit;
} else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<link rel=StyleSheet href="css/estilos.css" TYPE="text/css" /> 

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
</head>


</head>

<body>
<table width="70%" border="0" align="center">
 <tr>
    <td colspan="3">
		<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  	<div align="center">
	  	<img src="images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
		</div>	
	</td>
 </tr>
  
 <tr>
 	 <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
    	<div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
        </div>
        </div>
     	</div>
    	</div>
	</td>
  </tr>
  
  <tr>
    <td colspan="3">
		<form name="a" method="post" action="red_ppto_ing_2.php" onsubmit="return confirm('Verifique si la cuenta seleccionada es la correcta')">
		<table width="100%" border="1" align="center" class="bordepunteado1">
      		<tr>
        		<td colspan="3" bgcolor="#DCE9E5">
		 			<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
		   			<div align="center" class="Estilo4"><strong>MODIFICACIONES AL PRESUPUESTO DE INGRESOS<br /><BR />
		     		Reducciones al Presupuesto </strong></div>
					 </div>
				</td>
        	</tr>
      <tr>
       <td width="43%" ><div id="div5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
         <div align="center"><span class="Estilo4"><strong>PASO 1. </strong><br />
           SELECCIONE la cuenta DETALLE a la que desea REDUCIR VALOR </span><br />
         </div>
       </div></td>
        <td width="57%"  colspan="2"><div id="div6" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center">
		  
		    <?php 
	include('config.php');				
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from fecha";
	$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $idxx=$rowxx["id_emp"];
}
?>
            <select name="nn" onchange="cambia()" class="Estilo4" style="width: 400px;">
                <?
include('config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM car_ppto_ing WHERE id_emp = '$idxx' AND tip_dato = 'D' ORDER BY cod_pptal";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</OPTION>";
}
?>
              </select>
          </div>
        </div></td>
        </tr>
      <tr>
        <td colspan="3">
		<div id="div6" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		  <div align="center">
		    <input name="Submit" type="submit" class="Estilo4" value="Continuar" />
          </div>
		</div>		</td>
        </tr>
      
    </table>
    </form>
	<br />
	<table width="100%" border="1" align="center" class="bordepunteado1">
      <tr>
        <td bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><strong>IMPORTANTE</strong></div>
        </div></td>
      </tr>
      <tr>
        <td align="left"><div style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <span class="Estilo4"> 1. Si desea <strong>MODIFICAR</strong> una <strong>REDUCCION</strong>, eliminela y creela nuevamente con los datos correctos.
          <br />
        </span> </div></td>
      </tr>
    </table>
	
	<table width="100%" border="0" align="center">
      <tr>
        <td width="1250" colspan="3" bgcolor="#FFFFFF">
		 <div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
		   <div align="center" class="Estilo4"><strong>REDUCCIONES REALIZADAS AL PRESUPUESTO HASTA LA FECHA</strong> </div>
		 </div>	</td>
		</tr>
	</table>  
   </td>
  </tr>
</table>

		<?php

				// conecto la base de datos
				include('config.php');				
				$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
				
				// Estraigo encabezados por tipo de acto, numero de acto y fecha
				$sq = "select fecha_adi, tipo_acto, num_acto,concepto_adi from red_ppto_ing  group by tipo_acto,num_acto order by fecha_adi asc ";
				$re = mysql_db_query($database, $sq, $cx);
				
				
				// imprimo encabezados 
				while ($rw = mysql_fetch_array ($re))
				{
					$acuerdo = $rw["num_acto"]; 
					$fecha = $rw["fecha_adi"]; 
					$doc = $rw["tipo_acto"];
					$concepto_adi = ereg_replace("[,;%]", "",$rw["concepto_adi"]);  
					
						?>
						<table width="68%" border="1" align="center" class="bordepunteado1">
						<tr class="Titulotd"> 
								<td colspan="5"> 
								<?php printf ("$doc&nbsp$acuerdo:&nbsp"); print ("<font size='1' color ='#666666'>$concepto_adi</font>");?>
								</td>
								<td > 
								<img src="simbolos/reporte_azul.JPG" width="16px" border="0" alt="Imprimir" align="right" />
								</td>
							</tr>
							<tr align="center" class="Titulotds">
								<td width="10%">
									FECHA
								</td>
								<td width="15%">
									RUBRO
								</td>
								<td width="54%">
									NOMBRE RUBRO PRESUPUESTAL
								</td>
								<td width="15%">
									VALOR 
								</td>
								<td width="3%">
									
								</td>
								<td width="3%">
									
								</td>
							</tr>
							
						<?php 
						
						// Selecciono los registros relacionados con el encabezado
						$sq2 = "select * from red_ppto_ing  where tipo_acto = '$doc' and num_acto ='$acuerdo'";
						$re2 = mysql_db_query($database, $sq2, $cx);
					
							while ($rw2 = mysql_fetch_array ($re2))
							{
									$id = $rw2[0];
									$cod_pptal = $rw2[2];
									$nom_rubro1 = $rw2[3];
									$nom_rubro = ereg_replace("[%]", "",$nom_rubro1);
									$fecha_adi = $rw2[4];
									$valor_adi = $rw2[8]; 
									
								?>
								 
								<tr class="Estilo4">
									<td align="center">
										<?php printf ("$fecha_adi"); ?>
									</td>
									<td>
										<?php printf ("$cod_pptal"); ?>
									</td>
									<td>
										<?php echo ("$nom_rubro"); ?>
									</td>
									<td align="right">
										<? printf(number_format($valor_adi,2,",","."));?>
									</td>
									<td>
										<img src="simbolos/modificarblanco.png" width="16px" border="0" alt="Eliminar"/>
									</td>
									<td>
										<?php
										echo "
										<a href=\"borra_red_ppto_ing.php?borrar=$id&fecha_a=$fecha_adi \"><img src=\"simbolos/eliminarblanco.png\" width=\"16px\" border=\"0\" alt=\"Modificar\" /></a>
										";
										?>
									</td>
								</tr>
								
							<?php	
							
							}
							
							$sq3 = "select sum(valor_adi) as valor from red_ppto_ing  where tipo_acto = '$doc' and num_acto ='$acuerdo'";
							$re3 = mysql_db_query($database, $sq3, $cx);
					
							while ($rw3 = mysql_fetch_array ($re3))
							{
									$total = $rw3["valor"];
								?>
								<tr class="Titulotds"> 
									<td colspan="3" align="right"> 
									TOTAL
									</td>
									
									<td align="right" > 
									<? printf(number_format($total,2,",","."));?>
									</td>
											
									<td >
									</td>
									
									</td>
									<td >
								</tr>
								<?php
							}
									
							print ("<br>");
							print ("</table>");
				} 
				
				$cx = null;
				?>


<table  align="center">
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('config.php');				
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
    <td width="296">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="296">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="296">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>






<?
}
?>