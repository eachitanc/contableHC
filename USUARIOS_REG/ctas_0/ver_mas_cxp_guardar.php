<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<?
include('../config.php');	
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$id_emp=$_POST['id_emp']; 
	$cod_pptal=$_POST['cod_pptal']; 
	$nom_rubro=$_POST['nom_rubro']; 
	$vr_ini_aprob=$_POST['vr_ini_aprob']; 
  
   $cod_cxp_consti=$_POST["cod_cxp_consti"];
   $nom_cxp_consti=$_POST["nom_cxp_consti"];
   
   $cod_cxp_x_cancelar =$_POST["cod_cxp_x_cancelar"];
   $nom_cxp_x_cancelar =$_POST["nom_cxp_x_cancelar"];
   
    $cod_cxp_canceladas =$_POST["cod_cxp_canceladas"];
   $nom_cxp_canceladas =$_POST["nom_cxp_canceladas"];
   
   
$sql = "select * from ctas0_cxp_ok where cod_pptal='$cod_pptal'";

$resultado = mysql_db_query($database, $sql, $connectionxx);

$result = mysql_num_rows($resultado);

//printf("<br><br>filas %s",$result);


    if ($result == 0)
	{
	
	$sql2 = "INSERT INTO ctas0_cxp_ok 
	( 
   id_emp,cod_pptal,nom_rubro,vr_ini_aprob,
   cod_cxp_consti,nom_cxp_consti,
   cod_cxp_x_cancelar,nom_cxp_x_cancelar,
   cod_cxp_canceladas,nom_cxp_canceladas

	) 
	
	VALUES 
	(
   '$id_emp','$cod_pptal','$nom_rubro','$vr_ini_aprob',
   '$cod_cxp_consti','$nom_cxp_consti',
   '$cod_cxp_x_cancelar','$nom_cxp_x_cancelar',
   '$cod_cxp_canceladas','$nom_cxp_canceladas'
	
	)";
    
	
	
	mysql_db_query($database, $sql2, $connectionxx) or die(mysql_error());

	
	}
	else
	{
	
	$sql2 = "update ctas0_cxp_ok set 
	
    cod_cxp_consti='$cod_cxp_consti',nom_cxp_consti='$nom_cxp_consti',
    cod_cxp_x_cancelar='$cod_cxp_x_cancelar',nom_cxp_x_cancelar='$nom_cxp_x_cancelar',
	cod_cxp_canceladas='$cod_cxp_canceladas',nom_cxp_canceladas='$nom_cxp_canceladas'
    
	
	where 
	
	id_emp = '$id_emp' and cod_pptal = '$cod_pptal'
	
	";
    $re2 = mysql_db_query($database, $sql2, $connectionxx);

	
	}

	


?>
<script type="text/javascript"> 
	window.close()
</script>
<?
}
?>
