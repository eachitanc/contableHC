<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
include('../config.php');	
$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
// Recibo los datos que bienen por el metodo post ya validados en el formulario
$cod_pptal =$_POST["cod_pptal"];
$nom_rubro =$_POST["nom_rubro"];
$tipo_dato =$_POST["selecprod"]; 
if ($tipo_dato =='M')
	{
		$nom_rubro = strtoupper($nom_rubro);	
	}else{
		$nom_rubro = ucfirst(strtolower($nom_rubro));
	}
$ppto_aprob =$_POST["ppto_aprob"];
$proc_rec =$_POST["proc_rec"];
$situacion =$_POST["situacion"];
// Realizo la actualizaci�n de los datos
$sql= "update cxp set cod_pptal='$cod_pptal',nom_rubro='$nom_rubro',tip_dato='$tipo_dato',ppto_aprob='$ppto_aprob',proc_rec='$proc_rec',situacion='$situacion',definitivo='$ppto_aprob' where cod_pptal ='$cod_pptal'";
$result=mysql_db_query($database,$sql,$cx) or die ("problemas con la base");
echo $result;
if ($result)
{
	?>
	<script type="text/javascript">
	alert("Registro guardado con exito...");
	window.location="carga_ppto_gas.php"; 
	</script>
	<?php
}else{
	?>
	<script type="text/javascript">
	alert("Error al guardar la modificaci�n");
	//window.location="carga_ppto_gas.php"; 
	</script>
	<?php
}
// fin de la sesion de logeo
}
?>