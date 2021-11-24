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

$numero_contrato = $_GET['id']; 

include('../config.php');
$cx= new mysqli($server, $dbuser, $dbpass, $database);

	
	$sqlk ="select id_auto_crpp from  contrataciones2 where num_contrato ='$numero_contrato'";
	$resultk = mysql_db_query($database,$sqlk, $cx);
	
	while($rowk = mysql_fetch_array($resultk)) 
	{
  		$id_auto_crpp2=$rowk["id_auto_crpp"];
	}
	$sql = "select * from postcontratacion where num_contrato = '$numero_contrato'";
	$result = mysql_db_query($database, $sql, $cx) or die(mysql_error());
	
	if (mysql_num_rows($result) == 0)
	{		

		?>
		<br />
		<br />
		<br />
		<br />
		
		<img src="../simbolos/ok.png" width="32" height="32" /><br /><br />
		<p align="center" class="sidebar2">EL CONTRATO FUE ELIMINADO CON EXITO	</p>
		
		<?  
			$sqla = "UPDATE crpp SET contrato_control ='' where id_auto_crpp = '$id_auto_crpp2'";
		    $result = mysql_db_query($database, $sqla, $cx);
		
		
			
			$sql = "Delete From contrataciones2 Where num_contrato='$numero_contrato'";
			mysql_query($sql);
		
		}else{
		echo" 
		<br />
		<br />
		<br />
		<br />
		<img src='../images/error.png' width='32' height='32' /><br /><br />
		<p align='center' class='sidebar2'>EL CONTRATO TIENE REGISTROS DE POSTCONTRATACION RELACIONADOS	</p>";
		}
		?> 
		<br />
		<br />
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
		<div align="center">
		<a href='index.php' target='_parent'>VOLVER</a></div>
		</div>
		</div>
		</center>
		<?

?>

</body>
</html>
