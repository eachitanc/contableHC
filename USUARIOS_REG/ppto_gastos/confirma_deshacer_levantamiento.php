<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<?php
include("../config.php");
 
$id=$_POST['id'];

// saco el id de la empresa
   $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	    $sqlxx = "select * from fecha";
	    $resultadoxx = $connectionxx->query($sqlxx);
	    while($rowxx = $resultadoxx->fetch_assoc()) 
  	    {
     	 $idxx=$rowxx["id_emp"];
    	}
		
// saco toda la informacion de levanta_aplazamiento que coincide con id
			
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from levanta_aplazamientos where id ='$id' and id_emp ='$idxx'";
	$resultadoxx = $cx->query($sqlxx);
	while($r = $resultadoxx->fetch_assoc()) 
	{
 	$id_padre=$r["id_padre"];
	$valor_levantado=$r["valor_levantado"];
	}
	
// saco el valor de aplazamientos

	$ss = "select * from aplazamientos where id ='$id_padre' and id_emp ='$idxx'";
	$rr = mysql_db_query($database, $ss, $cx);
	while($rx = mysql_fetch_array($rr)) 
	{
 
	$valor_aplazado=$rx["valor_aplazado"];
	
	}	
 		
// actualizo el valor de aplazamientos
	$valor_aplazado = $valor_aplazado + $valor_levantado ;
		
		new mysqli($server, $dbuser, $dbpass, $database);
		
		$sSQL="Update aplazamientos Set valor_aplazado='$valor_aplazado' Where id = '$id_padre' and id_emp ='$idxx'";
		mysql_query($sSQL);
  
	   


new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Delete From levanta_aplazamientos Where id='$id' and id_emp ='$idxx'";
mysql_query($sSQL);

					printf("
<center class='Estilo4'><br><br><b>ACCION EJECUTADA CON EXITO</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='aplazamientos.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>");



?>
<?
}
?><title>CONTAFACIL</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 9px}
a {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:visited {
	color: #666666;
	text-decoration: none;
}
a:hover {
	color: #666666;
	text-decoration: underline;
}
a:active {
	color: #666666;
	text-decoration: none;
}
a:link {
	text-decoration: none;
}
.Estilo7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>