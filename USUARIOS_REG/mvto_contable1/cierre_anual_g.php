<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
include('../config.php');
// conexion             
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$i=0;
for($i=1;$i<4;$i++)
	{
			$tipo = $_POST["tipo".$i];
			$cuenta_p = $_POST["cod_".$i];
			$sql = "INSERT INTO cierre_contable  (tipo,cuenta_pri, cuenta_sec ) VALUES ( 
					'$tipo','$cuenta_p', '')";
			mysql_query($sql, $cx) or die(mysql_error());
	}
}
?>
