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
<link type="text/css" rel="stylesheet" href="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>	
<SCRIPT type="text/javascript" src="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js"></script>

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
<body>
<?php 
// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT ppto FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['ppto']=='SI')
{

				
			$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
			$sqlxx = "select * from fecha";
			$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
			
			while($rowxx = mysql_fetch_array($resultadoxx)) 
			{
			  $ano=$rowxx["ano"];
			}

		$sqlxxx = "select * from vf";
			$resultadoxxx = mysql_db_query($database, $sqlxxx, $connectionxx);
			
			while($rowxxx = mysql_fetch_array($resultadoxxx)) 
			{
			  $fecha_inicio=$rowxxx["fecha_ini"];
			}

if (empty($_POST["fecha_corte"]))								// Si POST esta vacio viene de recargar index u otra pagina
{
$fecha_cor =$ano;
}else{
$fecha_cor =$_POST["fecha_corte"];
}
?>
<table width="800" border="0" align="center">
	<tr>
    	<td colspan="3">
			<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  		<div align="center">
	  		<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
			</div>	
		</td>
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
    		</div>
		</td>
  </tr>
</table>

<table width="800" border="0" align="center">
<form action="index.php" name="ecuacion" method="post">
  <tr>
  	 	<td colspan="3" bgcolor="#DCE9E5">
			<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		    <div align="center" class="Estilo4"><strong>ECUACION PRESUPUESTAL		</strong></div>
			</div>	
		</td>
   </tr>
  
   <tr>
	   <td bgcolor="#F5F5F5"><div align="center" class="Estilo4">
      	    <div align="right"><strong>FECHA DE CORTE  : </strong></div>
        	</div>
		</td>
        
		<td class="Estilo4" align="right">
			<input name="fecha_corte" type="text" class="Estilo4"  value="<?php echo $fecha_cor; ?>" size="12" />
			<input name="button" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].fecha_corte,'yyyy/mm/dd',this)" value="Ver Calendario" />
		</td>
		
        <td>&nbsp;
		</td>
    </tr>
    
	<tr>
       <td width="250" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
         <div align="center" class="Estilo4">
           <div align="right"><strong>TOTAL INGRESOS : </strong></div>
         </div>
       </div>
	   </td>
        <td width="250" class="Estilo4">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		  <div align="right"><?
		  // consolidacion de ingresos
				include('../config.php');				
				$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
				$query = "SELECT SUM(ppto_aprob) as total FROM car_ppto_ing where tip_dato='D' and ano ='$fecha_inicio'"; 
				$resp = mysql_db_query($database,$query,$cx);
				$row = mysql_fetch_array($resp);
				$inicial_ing = $row[total];
				$query1 = "SELECT SUM(valor_adi) as total1 FROM adi_ppto_ing where fecha_adi <='$fecha_cor'"; 
				$resp1 = mysql_db_query($database,$query1,$cx);
				$row1 = mysql_fetch_array($resp1);
				$adicion_ing = $row1[total1];
				$query2 = "SELECT SUM(valor_adi) as total2 FROM red_ppto_ing where fecha_adi <='$fecha_cor'"; 
				$resp2 = mysql_db_query($database,$query2,$cx);
				$row2 = mysql_fetch_array($resp2);
				$reduccion_ing = $row2[total2];  
				$query6 = "SELECT SUM(valor_adi) as total6 FROM creditos_ing where fecha_adi <='$fecha_cor'"; 
				$resp6 = mysql_db_query($database,$query6,$cx);
				$row6 = mysql_fetch_array($resp6);
				$creditos = $row6[total6];
				$queryx = "SELECT SUM(valor_adi) as total FROM contracreditos_ing where fecha_adi <='$fecha_cor'"; 
				$respx = mysql_db_query($database,$queryx,$cx);
				$rowx = mysql_fetch_array($respx);
				$contracreditos = $rowx[total];
				$def_ingresos = $inicial_ing + $adicion_ing - $reduccion_ing + $creditos - $contracreditos;
				printf("%s",number_format($def_ingresos,2,',','.'));
				
			
						?>
		      </div>
		</div>		
		</td>
        <td width="250">&nbsp;</td>
  </tr>
  
  <tr>
        <td width="250" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>TOTAL GASTOS : </strong></div>
          </div>
        </div>
		</td>
        <td width="250" class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="right"><?
				$query3 = "SELECT SUM(ppto_aprob) as total FROM car_ppto_gas where tip_dato='D' and ano ='$fecha_inicio'"; 
				$resp3 = mysql_db_query($database,$query3,$cx);
				$row3 = mysql_fetch_array($resp3);
				$inicial_gasto = $row3[total];
				$query4 = "SELECT SUM(valor_adi) as total4 FROM adi_ppto_gas where fecha_adi <='$fecha_cor'"; 
				$resp4 = mysql_db_query($database,$query4,$cx);
				$row4 = mysql_fetch_array($resp4);
				$adicion_gas = $row4[total4];
				$query5 = "SELECT SUM(valor_adi) as total5 FROM red_ppto_gas where fecha_adi <='$fecha_cor'"; 
				$resp5 = mysql_db_query($database,$query5,$cx);
				$row5 = mysql_fetch_array($resp5);
				$reduccion_gas = $row5[total5];
				$query6 = "SELECT SUM(valor_adi) as total6 FROM creditos where fecha_adi <='$fecha_cor'"; 
				$resp6 = mysql_db_query($database,$query6,$cx);
				$row6 = mysql_fetch_array($resp6);
				$creditos = $row6[total6];
				$queryx = "SELECT SUM(valor_adi) as total FROM contracreditos where fecha_adi <='$fecha_cor'"; 
				$respx = mysql_db_query($database,$queryx,$cx);
				$rowx = mysql_fetch_array($respx);
				$contracreditos = $rowx[total];
				$def_gastos = $inicial_gasto + $adicion_gas - $reduccion_gas + $creditos  - $contracreditos;
				printf("%s",number_format($def_gastos,2,',','.'));
				?>
            </div>
        </div>
		</td>
        <td width="250">&nbsp;</td>
    </tr>
    
	<tr>
        <td width="250" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>DIFERENCIA : </strong></div>
          </div>
        </div>
		</td>
        <td width="250" class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="right"><?
			    $res=$def_ingresos-$def_gastos;
				printf("%s",number_format($res,2,',','.'));
				?>
          </div>
        </div>
		</td>
        <td width="250">&nbsp;</td>
    </tr>
   
      <tr>
       <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
        <td width="250">&nbsp;</td>
      </tr>
      
 
  <tr>
    	<td colspan="3" align="center">
		<input type="submit" value="Consultar" />
		</form>
		</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
			<? 
			echo $ano;
			?>
          </strong> </span> <br />
          <span class="Estilo4"><b>Usuario: </b><u><? echo $_SESSION["login"];?></u> </span> </div>
    	</div>
	</td>
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