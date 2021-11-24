<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<?
include('../config.php');

//*** luis hillon

$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}

$servidor = $server;
$usuario = $dbuser;
$password = $dbpass;

$conexion = mysql_connect($servidor, $usuario, $password) or die("no se pudo conectar a base de datos".mysql_error());

$selec = mysql_select_db($database,$conexion);

$usuarios = mysql_query("Select * from pgcp where id_emp ='$id_emp' and tip_dato = 'D' and cod_pptal = '".$_REQUEST['cod']."'",$conexion);

$num = mysql_num_rows($usuarios);

if ($num==0)
{
printf("COD. INCORRECTO");
}
else
{
		$sql2 = "Select * from pgcp where id_emp ='$id_emp' and tip_dato = 'D' and cod_pptal = '".$_REQUEST['cod']."'";
		$resultado2 = mysql_db_query($database, $sql2, $conexion);
		
		while($row2 = mysql_fetch_array($resultado2)) 
		{
		  $nom_rubro=$row2["nom_rubro"];
		  $num_cta=$row2["num_cta"];
		  $nom_banco1=$row2["nom_banco1"];
		}
		
		$a1=$_REQUEST['cod'];
		$a = substr($a1,0,4);
		
		if($a == '1110')
		{
				
			if($num_cta == '' or $nom_banco1 == '')
			{
			printf("<br>&nbsp;<b>%s</b>
			<br><br>
			&nbsp;Nombre del Banco :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='banco1' type='text' class='Estilo4' style='width:240px;' value ='ACTUALICE PGCP - DATO NO EXISTE'/> <br><br>
			&nbsp;No. de la Cuenta :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='cta1' type='text' class='Estilo4' style='width:240px;' value ='ACTUALICE PGCP - DATO NO EXISTE'/> <br><br>",$nom_rubro);
			}
			else
			{
			printf("<br>&nbsp;<b>%s</b>
			<br><br>
			&nbsp;Nombre del Banco :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='banco1' type='text' class='Estilo4' style='width:240px;' value ='%s'/> <br><br>
			&nbsp;No. de la Cuenta :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='cta1' type='text' class='Estilo4' style='width:240px;' value ='%s'/> <br><br>
				",$nom_rubro,$nom_banco1,$num_cta);
			}				
				
				
			
		}
		else
		{
				printf("<br>&nbsp;&nbsp;%s&nbsp;<br><br>
				",$nom_rubro);
		}
		
		

}
mysql_close($conexion);
?>
<?
}
?>

