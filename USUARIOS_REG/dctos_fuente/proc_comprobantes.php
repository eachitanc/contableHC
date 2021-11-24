<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<?php
   
   	
	//-------saco el id de la empresa
	include('../config.php');				
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$sql = "select * from fecha";
	$resultado = mysql_db_query($database, $sql, $cx);
	while($row = mysql_fetch_array($resultado)) 
   	{
	   $id_emp=$row["id_emp"];
	}
	

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}

$fecha_reg = $ano;




//	$fecha_reg = date("Y/m/d"); 
	$cod = $_POST['cod'];
	$nombre = $_POST['nombre'];
	
	//----------------
	$ppto_ing = $_POST['ppto_ing'];
	if($ppto_ing == 'SI')
	{
	 $ppto_ing = $_POST['ppto_ing'];
	}
	else
	{
	 $ppto_ing = 'NO';
	}
	//----------------
	$ppto_gas = $_POST['ppto_gas'];
	if($ppto_gas == 'SI')
	{
	 $ppto_gas = $_POST['ppto_gas'];
	}
	else
	{
	 $ppto_gas = 'NO';
	}
	//----------------
	$ppto_cxp = $_POST['ppto_cxp'];
	if($ppto_cxp == 'SI')
	{
	 $ppto_cxp = $_POST['ppto_cxp'];
	}
	else
	{
	 $ppto_cxp = 'NO';
	}
	//----------------
	$tes_ing = $_POST['tes_ing'];
	if($tes_ing == 'SI')
	{
	 $tes_ing = $_POST['tes_ing'];
	}
	else
	{
	 $tes_ing = 'NO';
	}
	//----------------
	$tes_gas = $_POST['tes_gas'];
	if($tes_gas == 'SI')
	{
	 $tes_gas = $_POST['tes_gas'];
	}
	else
	{
	 $tes_gas = 'NO';
	}
	//----------------
	$tes_cxp = $_POST['tes_cxp'];
	if($tes_cxp == 'SI')
	{
	 $tes_cxp = $_POST['tes_cxp'];
	}
	else
	{
	 $tes_cxp = 'NO';
	}
	//----------------
	$cont = $_POST['cont'];
	if($cont == 'SI')
	{
	 $cont = $_POST['cont'];
	}
	else
	{
	 $cont = 'NO';
	}
	
	
$consultax=mysql_query("select * from vf ",$cx);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
} 
					
if($fecha_reg > $bx or $fecha_reg < $ax)
{
printf("<center class='Estilo4'>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='dctos_fuente.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
		</center>");
}
else
{ 

		$sq = "INSERT INTO dctos_fuente_comprobantes ( 	id_emp , cod , nombre , ppto_ing , ppto_gas , ppto_cxp , tes_ing , tes_gas , tes_cxp , cont )  VALUES ( '$id_emp' , '$cod' , '$nombre' , '$ppto_ing' , '$ppto_gas' , '$ppto_cxp' , '$tes_ing' , '$tes_gas' , '$tes_cxp' , '$cont' )";

		$res = mysql_db_query($database, $sq, $cx);


/*		new mysqli($server, $dbuser, $dbpass, $database);
		
		$sSQL="Update car_ppto_ing Set pac='$pac' , afectado_otros='$afectado_otros' Where cod_pptal = '$cod_pptal' and id_emp ='$id_emp'";
		mysql_query($sSQL);*/

		printf("<br><br><center class='Estilo4'>COMPROBANTE ALMACENADO CON EXITO<br><br>");  
		printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='dctos_fuente.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");  
		
}
			
?>
<?
}
?>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.Estilo4 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #333333;
}
a:link {
	color: #990000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #990000;
}
a:hover {
	text-decoration: underline;
	color: #990000;
}
a:active {
	text-decoration: none;
	color: #990000;
}
.Estilo6 {color: #FFFFFF}
-->
</style> <title>CONTAFACIL</title>