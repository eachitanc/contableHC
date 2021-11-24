<?php
set_time_limit(600);
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
</head>
<body>
<?php
$fec=$_POST["mes"];
?>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />
<center>
<div align="center" class="Titulotd" style="width:50%;padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">GENERANDO REPORTE DE LIBROS OFICIALES</div>
<br />
<div align="center">
<img src="../simbolos/fuentes/espera.gif" />
</div>
</center>
<? echo"<script language='javascript'>window.location='mayor_balance2.php?fecha=$fec'</script>"; ?>
</body>
</html>
<?php 
}
?>
