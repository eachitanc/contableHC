<?
session_start(listas);
	// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT contrat FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['contrat']=='SI')
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
<link type="text/css" rel="stylesheet" href="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>	
<SCRIPT type="text/javascript" src="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<style type="text/css">
<!--
.Estilo7 {color: #BF0000}
-->
</style>
</head>
<body>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>

  <?

if (empty($_GET["fec"]))								// Si Get esta vacio viene de recargar index u otra pagina
{

	if (empty($_POST["fecha"])) 						// Si get y fecha vacio viene de otra pagian y hay que cargar sesiones a las variables para realizar la consulta dinamoca
	{
		$fechafil = $_SESSION["fecha"]; 
		$fecha2= $_SESSION["fecha2"];
		$pendiente=$_SESSION["pendiente"];
		$registrado=$_SESSION["registrado"];
		$tercerox="";
		$tercero2="'".$tercerox."'";
		list($an, $me, $di)  = explode('/', $fechafil);
   		$f1 = "$an/$me/01";
  		$f2 = "$an/$me/31";

	}else{												// get es vacia pero fecha viene cargada... Es una recarga de index y los datos cambian, Recargar sesiones y asignar a las variables

		$_SESSION["fecha"]=$_POST["fecha"]; 
		$_SESSION["fecha2"]=$_POST["fecha2"];
		$_SESSION["pendiente"]=$_POST["pendiente"];
		$_SESSION["registrado"]=$_POST["registrado"];
		$fechafil = $_SESSION["fecha"]; 
		$fecha2= $_SESSION["fecha2"];
		$pendiente=$_SESSION["pendiente"];
		$registrado=$_SESSION["registrado"];
		$tercerox="";
		$tercero2="'".$tercerox."'";
		list($an, $me, $di)  = explode('/', $fechafil);
   		$f1 = "$an/$me/01";
  		$f2 = "$an/$me/31";
	}

}else{													// Get esta llena viene de Menu, asigno variables fijas y cargo sesiones 
		$_SESSION["fecha"]=$_GET["fec"]; 
														// Verifico si la ruta viene de CRPP para filtrar por dia
		$ruta = $_GET["ruta"];
		if ($ruta == 'CRPP')
		{
			$_SESSION["fecha2"]="DIA";
		}else{
			$_SESSION["fecha2"]="MES";
		}
		$_SESSION["pendiente"]=1;
		$_SESSION["registrado"]="";
		$fechafil = $_SESSION["fecha"]; 
		$fecha2= $_SESSION["fecha2"];
		$pendiente=$_SESSION["pendiente"];
		$registrado=$_SESSION["registrado"];
		$tercerox="";
		$tercero2="'".$tercerox."'";
		list($an, $me, $di)  = explode('/', $fechafil);
   		$f1 = "$an/$me/01";
  		$f2 = "$an/$me/31";
}

?>
		<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
		 	<div align="center">
		 		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  		<div align="center" class="Estilo6"><a href='../user.php' target='_parent' class="sidebar2">VOLVER</a>
				 		</div>
		        	</div>
        	    </div>      
			</div>
		</div>

<table border="0" width="93%" align="center">
<tr>
	<td align="right">
	<script type="text/javascript"  src="../wz_tooltip/wz_tooltip.js"></script>
	<a href="#" onmouseover="Tip('<br>&nbsp;6.5.1. <a href=\'../contratacion_doc/upload.php\' target=\'_parent\'>Cargar plantillas<\/a><br><br>&nbsp;6.5.2. <a href=\'perfiles.php\'>Configurar perfil de cargos<\/a> <br><br>&nbsp;6.5.3. <a href=\'#\'>Información contractual<\/a><br><br> ', WIDTH, 300, TITLE, '<center>&nbsp;&nbsp;</center>', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, 	CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Herramientas</a><br />
	</td>
</tr>
<tr>
	<td>
		<form class="form" action="index.php" method="post"  name="form1">
		<? 
			if (empty($pendiente)){
					?><input name="pendiente" type="checkbox" value="1" /><span class="sidebar">Pendientes</span><?
			}else{
					?><input name="pendiente"  type="checkbox" value="1"  checked /><span class="sidebar3">Pendien<span class="Estilo7">t</span>es</span><?
			} 
		
			if (empty($registrado)){
					?><input name="registrado" type="checkbox" value="1" /><span class="sidebar">Registrados</span><?
			}else{
					?><input name="registrado" type="checkbox" value="1"  checked /><span class="sidebar3">Registrados</span><?
			} 
		?>

					<input name="fecha" type="text" class="Estilo4" id="inicio" value="<?php printf($fechafil); ?>" size="12" />
					<input name="button" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].inicio,'yyyy/mm/dd',this)" value="Ver Calendario" />
					<select name="fecha2" class="Estilo4"> 
							<? 
							if (empty($fecha2))
							{ 
								echo "	<option>AÑO</option>
										<option selected> MES </option>
										<option>DIA </option>";
							}
							if ($fecha2 =="AÑO")
							{ 
								echo"	<option selected>AÑO</option>
										<option> MES </option>
										<option>DIA </option>";
							}
							 if ($fecha2 == "MES")
							{
								echo"	<option >AÑO</option>
										<option selected> MES </option>
										<option>DIA </option>";
							}
							if ($fecha2 == "DIA")
							{ 
								echo"	<option >AÑO</option>
										<option > MES </option>
										<option selected>DIA </option>";
							} 
							?>
					</select>
					<input type="submit" class="Estilo4" value="Filtrar" />
		</form>	
		</td>
</tr>	

</table>	
						
<!-- Muestro el formulario para aplicar filtros-->																
<?php
// buscar vigencia
include('../config.php');		
$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
mysql_select_db( "$database"); 

$vg =mysql_db_query($database,"select * from vf",$cx);
while ($rwvg = mysql_fetch_array($vg))
{
	$inicio = $rwvg["fecha_ini"];
	$final = $rwvg["fecha_fin"];
}
if ($pendiente ==""){			// Ejecuto la consulta de busqueda cunando pendiente esta marcado aplicando los criterios de fecha.
}else{
$a = "SELECT  id_auto_crpp,id_manu_crpp, fecha_crpp, tercero, detalle_crpp, sum(vr_digitado) as valor FROM crpp WHERE contrato='SI' and contrato_control='' and liq1 ='' ";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fecha_crpp between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fecha_crpp ='$fechafil'";}
	if ($fecha2 == "AÑO"){$f= "and fecha_crpp between '$inicio' and '$final'";}
	$gby = "GROUP BY id_auto_crpp,id_manu_crpp, fecha_crpp, tercero, detalle_crpp";
	$orden = "order by fecha_crpp, id_manu_crpp asc";
	$sql = "$a $b $c $f $gby $orden";
$rs = mysql_query($sql); 
$filas =mysql_num_rows($rs);
if ($filas > 0)
{
?>  
<br />
<p align="center" class="titlelista"><b>LISTA DE REGISTROS PRESUPUESTALES PENDIENTES DE REALIZAR CONTRATO</b></p>
<br />

 <center>
 <table width='90%' BORDER='1' class='bordepunteado1' cellspacing=0 cellpadding=2>
	<tr bgcolor='#DCE9E5'><td  align='center' width="12%" height='20'><span class='Estilo4'><b>NUMERO CRPP</b></span></td>
	 <td  align='center' width="8%" ><span class='Estilo4'><b>FECHA</b></span></td>
	 <td width='26%'  align='center' bgcolor="#DCE9E5" ><span class='Estilo4'><b>TERCERO</b></span></td>
 	<td  align='center' width="35%" ><span class='Estilo4'><b>DETALLE</b></span></td>
 	<td  align='center' width='10%' ><span class='Estilo4'><b>VALOR</b></span></td>
 	<td width='9%'></td>
 </tr>
 <?php
}
 while ($row = mysql_fetch_assoc($rs))
 {$numero = htmlentities($row["id_manu_crpp"]);
  $fec =$row["fecha_crpp"];
  $ter =$row["tercero"];
  $det=substr($row["detalle_crpp"],0,200);
  $vr=$row["valor"];

 ?>          
 <tr>
 	<td bgcolor='#DCE9E5' width="12%" class="Estilo4"> <?php echo $numero; ?></td>
 	<td align='center' width='8%' class="Estilo4"> <?php echo $fec; ?></td>
	<td align='left' width='19%' class="Estilo4"> <?php echo $ter; ?></td>
	<td width='42%' class="Estilo5"><?php echo $det; ?></td>
	<td align="right" width='10%' class="Estilo4"> <?php echo number_format($vr,2,",","."); ?></td>
	
	
<?php 
echo "<td bgcolor='#DCE9E5'><span class='Estilo4'>".$row[""]."<a href=\"contratar.php?num=$numero&valor=$vr\" style=\"color:#0033FF\"  target=\"_self\" onClick=\"window.open(this.href, this.target); return false;\">	
Contratar</a></span></td>\n";?>
</tr>
<?php          
}
} // end else pendientes
?>
</table>
</center>
<? 
if ($registrado ==""){
}else{
$g = "SELECT  id_auto_crpp, num_contrato,num_crpp,fec_registro,objeto,valor_inicial,clas_contrato FROM contrataciones2 WHERE id > '0'";
	if (empty($tercero)){$c = "";}else{$c= "and tercero =$tercero2";}
	if ($fecha2 == "MES"){$f= "and fec_registro between '$f1' and '$f2'";}
	if ($fecha2 == "DIA"){$f= "and fec_registro ='$fechafil'";}
	if ($fecha2 == "AÑO"){$f= "and fec_registro between '$inicio' and '$final'";}
	$orden2 = "GROUP BY id_auto_crpp";
	$sqlg = "$g $b $c $f ";
$rsg = mysql_query($sqlg);
$filas2 = mysql_num_rows($rsg);
if ($filas2 > 0)
{
?>  
 <center>
 <br />
<p align="center" class="titlelista"><b>LISTA DE CONTRATOS REGISTRADOS</b></p>
<br />
 <table width='90%' BORDER='1' class='bordepunteado1' cellspacing=0 cellpadding=2>
	<tr bgcolor='#DCE9E5'><td  align='center' width="8%" height='20'><span class='Estilo4'><b>CONTRATO</b></span></td>
	 <td  align='center' width="11%" ><span class='Estilo4'><b>FECHA</b></span></td>
	 <td  align='center' width='17%' ><span class='Estilo4'><b>TERCERO</b></span></td>
 	<td  align='center' width="41%" ><span class='Estilo4'><b>OBJETO</b></span></td>
 	<td  align='center' width='9%' ><span class='Estilo4'><b>VALOR</b></span></td>
 	<td width='1%'></td>
	<td width='1%'></td>
	<td width='6%'></td>
	<td width='6%'></td>
 </tr>
 <?php
} 
 while ($rowg = mysql_fetch_assoc($rsg))
 {
 	$numero_con=$rowg["num_contrato"];
  	$fec_con =$rowg["fec_registro"];
   	$num_crpp=$rowg["num_crpp"];
 	$det_con=substr($rowg["objeto"],0,100);
	$id_auto_crpp=$rowg["id_auto_crpp"];
	$valor_inicial=$rowg["valor_inicial"];
	$clase=$rowg["clas_contrato"];

		// SACAR VALORES DE CRPP
		
		$sqlh ="SELECT id_auto_crpp, tercero, vr_digitado FROM crpp WHERE id_auto_crpp='$id_auto_crpp' GROUP BY id_auto_crpp";
		$rsh = mysql_query($sqlh); 
		while ($rowh = mysql_fetch_assoc($rsh)){
		$ter_con=$rowh["tercero"];
  		
		// VERIFICO SI EL CONTRATO YA FUE LIQUIDADO.. SINO MUESTRO UN COLOR IDICATIVO
		$liq = mysql_db_query ($database,"select * from postcontratacion where num_contrato ='$numero_con' and procedimientos='LIQUIDACION'",$cx);
		$resk = mysql_num_rows($liq);
		if ($resk ==0)
		{
			$sin_liq = "bgcolor='#FFFF99'";
		}else{
			$sin_liq ='';
		}
		
		
 		?>          
 		<tr>
 	<td bgcolor='#DCE9E5' width="8%" class="Estilo4"> <?php echo $numero_con; ?></td>
 	<td <?php echo $sin_liq; ?> align='center' width='11%' class="Estilo4"> <?php echo $fec_con; ?></td>
	<td <?php echo $sin_liq; ?> align='left' width='28%' class="Estilo4"> <?php echo $ter_con; ?></td>
	<td <?php echo $sin_liq; ?> align='left' width='30%' class="Estilo5"><?php echo $det_con; ?></td>
	<td <?php echo $sin_liq; ?> align="right" width='9%' class="Estilo4"> <?php echo number_format($valor_inicial,2,",","."); ?></td>

	
<?php

echo "<td width='1%' class='Estilo4' bgcolor='#DCE9E5'><div id='eliminar'>".$row[""]."<a href=\"confirma_borrar.php?id=$numero_con\" style=\"color:#0033CC\"  target=\"_self\" onclick=\"if(!confirm('¿Esta seguro de borrar el contrato registrado?'))return false\"><img src=\"imagenes/eliminar.png\" width=\"20px\" height=\"20px\" border=\"0\" onmouseover=\"this.src='imagenes/eliminar1.png'\" onmouseout=\"this.src='imagenes/eliminar.png'\"></a></div></td>\n"; 


echo "<td width='1%' class='Estilo4' bgcolor='#DCE9E5'><div id='modificar'>".$row[""]."<a href=\"contratar_edita.php?contrato=$numero_con\" style=\"color:#0033CC\"  target=\"_self\" onClick=\"window.open(this.href, this.target); return false;\"><img src=\"imagenes/modificar.png\" width=\"20px\" height=\"20px\" border=\"0px\" onmouseover=\"this.src='imagenes/modificar.png'\" onmouseout=\"this.src='imagenes/modificar.png'\"></a></div></td>\n"; 
 
echo "<td bgcolor='#DCE9E5' width='6%'><span class='Estilo4'>".$rowg[""]."<a href=\"../contratacion_doc/generar_archivo.php?id=$id_auto_crpp&clase=$clase\" style=\"color:#0033FF\"  target=\"_blank\" onClick=\"window.open(this.href, this.target); return false;\">	
<img src=\"imagenes/reporte2.jpg\" width=\"20px\" height=\"20px\" border=\"0px\" onmouseover=\"this.src='imagenes/reporte2.jpg'\"  width=\"30px\" onmouseout=\"this.src='imagenes/reporte2.jpg'\"  width=\"30px\"></a></div></td>\n";

echo "<td bgcolor='#DCE9E5' width='6%'><span class='Estilo4'>".$rowg[""]."<a href=\"postcontratacion.php?num=$numero_con\" style=\"color:#0033FF\"  target=\"_self\" onClick=\"window.open(this.href, this.target); return false;\">	
Postcontrataci&oacute;n</a></span></td>\n";

?>
 </tr>
 
<?php          
}
}					// Ejecuto la consulta y muestro el informe de contratos registrados cuando la casilla esta marcada.
} 									// end else registrados
?>


</table>
</center>
</body>
</html>
<?
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
?>
