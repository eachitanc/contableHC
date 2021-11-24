<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {
?>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #006600;
}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #990000;
	font-weight: bold;
}
-->
</style>
<?php
include('../config.php');
global $server, $database, $dbpass,$dbuser,$charset;
	// Conexion con la base de datos
	$cx= new mysqli ($server, $dbuser, $dbpass, $database);


$sqlxx = "select * from fecha";
$resultadoxx = 	$cx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_array())

{
  $id_emp=$rowxx["id_emp"];
}

$servidor = $server;
$usuario = $dbuser;
$password = $dbpass;

$sql ="Select * from pgcp where cod_pptal like '".$_REQUEST['cod']."%' and id_emp ='$id_emp'";
$usuarios = $cx->query($sql); 
$num = $usuarios->num_rows;

if ($num==0)
{
printf("<span class='Estilo1'>COD. INCORRECTO</span>");
}
else
{
		$sql2 = "Select * from pgcp where cod_pptal like '".$_REQUEST['cod']."%' and id_emp ='$id_emp'";
		$resultado2 = $cx->query($sql2);
		printf("<center><table>");
		while($row2 = $resultado2->fetch_array()) 
		{
		  $cod_pptal=$row2["cod_pptal"];
		  $nom_rubro=$row2["nom_rubro"];
		  printf("
		  <tr>
		  <td>
		  <span class='Estilo1'><a href=\"modi_cuenta_pgcp_2.php?id=%s\">%s</a>&nbsp;&nbsp;&nbsp;</span>
		  </td>
		  <td><span class='Estilo1'>%s</span>
		  </td>
		  </tr>",$cod_pptal,$cod_pptal,$nom_rubro);
		}
		printf("</center></table>");		
}

}
?>

