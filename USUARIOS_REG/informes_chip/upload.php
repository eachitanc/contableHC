<? 
set_time_limit(600);
session_start();
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
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo4 {font-weight: bold}
a:link {
	color: #0000CC;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000CC;
}
a:hover {
	text-decoration: underline;
	color: #0000CC;
}
a:active {
	text-decoration: none;
	color: #0000CC;
}
.Estilo5 {
	color: #990000;
	font-weight: bold;
}
</style>
</head>
<body>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />
<?php 
include('../config.php');
$conexion=mysql_connect ($server, $dbuser, $dbpass);
$anadir38.="DROP TABLE cgr_gastos_acumula";
mysql_select_db ($database, $conexion);

		if(mysql_query ($anadir38 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};		
// ******************* Creo la tabla
		$tabla39="cgr_gastos_acumula";
		$anadir39="CREATE TABLE ";
		$anadir39.=$tabla39;
		$anadir39.="
		(
  `ctrl` varchar(100) NOT NULL,
  `cod_cgr` varchar(200) NOT NULL,
  `vig_gasto` varchar(200) NOT NULL,
  `unid_ejec` varchar(10) NOT NULL,
  `cod_rec` varchar(200) NOT NULL,
  `oer` varchar(200) NOT NULL,
  `cda` varchar(200) NOT NULL,
  `finalidad_gasto` varchar(200) NOT NULL,
  `situacion` varchar(200) NOT NULL,
  `n_com` decimal(20,2) NOT NULL,
  `n_obl` decimal(20,2) NOT NULL,
  `n_pag` decimal(20,2) NOT NULL,
  `reciproca` varchar(200) NOT NULL,
  `ppto_aprob` decimal(20,2) NOT NULL,
  `sum_adiciones` decimal(20,2) NOT NULL,
  `sum_reducciones` decimal(20,2) NOT NULL,
  `cancelaciones` decimal(20,2) NOT NULL,
  `sum_creditos` decimal(20,2) NOT NULL,
  `sum_contracreditos` decimal(20,2) NOT NULL,
  `sum_aplazamientos` decimal(20,2) NOT NULL,
  `sum_desaplazamientos` decimal(20,2) NOT NULL, 
  `definitivo` decimal(20,2) NOT NULL,
  `suma_cdpp` decimal(20,2) NOT NULL,
  `reversion_cdpp` decimal(20,2) NOT NULL,
  `compromisos_ca` decimal(10,2) NOT NULL,
  `compromisos_sa` decimal(10,2) NOT NULL,
  `compromisos_rev` decimal(10,2) NOT NULL,
  `obligaciones` decimal(10,2) NOT NULL,
  `obligaciones_rev` decimal(10,2) NOT NULL,
  `pagos` decimal(10,2) NOT NULL,
  `pagos_rev` decimal(10,2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1";
		mysql_select_db ($database, $conexion);
		if(mysql_query ($anadir39,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}
?>
<table width="60%" border="1" align="center" class="bordepunteado1">
  <tr>
    <td bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo2 Estilo4">Acumular C.G.R Programación de Gastos</div>
	</div>	</td>
  </tr>
  <tr>
    <td>
	<form action="sube_archivo.php" method="post" enctype="multipart/form-data">
   <div align="center">
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
     <br>
     <span class="Estilo2"><em>Nombre del archivo: CGR_GASTOS.csv<br />
	 (CSV delimitado por comas)     </em></span><br />
	 <br />
     <input name="userfile" type="file" class="Estilo2">
     <br><br />
     <input type="submit" class="Estilo2" value="Subir Archivo">
   </div>
</form>	
<br /></td>
  </tr>
</table>
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../user.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
?>
