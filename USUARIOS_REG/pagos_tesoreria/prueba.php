<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: login.php");
exit;
}
else 
{

if($_SESSION["rol"] == 'USUARIO')
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>
<?php

include('config.php');	
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlx = "select * from usuarios where login = '$hencor'";
$resultx = $cx->query($sqlx);
while($rowx = mysql_fetch_array($resultx))
{
$link= $rowx["tipo_doc"];
print ("link  : $link");
}

?>
<body>
</body>
</html>
<?php
}//FIN IF
}//FIN ELSE
?>