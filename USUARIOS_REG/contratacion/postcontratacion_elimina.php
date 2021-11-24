<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTRATACION - GCP</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
<style type="text/css">
<!--
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
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
.Estilo9 {font-size: 10px; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<body>
<center>
		<br />
		<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
<?

$id = $_GET['id']; echo $id;
$num= $_GET['num']; 

include('../config.php');
$cx= new mysqli($server, $dbuser, $dbpass, $database);
		?>
		<br />
		<br />
		<br />
		<br />
		
		<img src="../images/ok.png" width="32" height="32" /><br /><br />
		<p align="center" class="sidebar2">EL ACTO ADMINISTRATIVO FUE ELIMINADO CON EXITO	</p>
		<?  
			$sql = "Delete from postcontratacion Where id='$id'";
			 $result = mysql_db_query($database, $sql, $cx);
		?> 
		<br />
		<br />
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
		<div align="center">
		<?php echo"<a href='postcontratacion.php?num=$num' target='_parent'>VOLVER</a></div>"; ?>
		</div>
		</div>
		</center>
		<?
?>
</body>
</html>
