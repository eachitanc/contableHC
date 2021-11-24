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
  
   $cod_pptal_gas_apr=$_POST["cod_pptal_gas_apr"];
   $nom_pptal_gas_apr=$_POST["nom_pptal_gas_apr"];
   
   $cod_pptal_gas_apr2 =$_POST["cod_pptal_gas_apr2"];
   $nom_pptal_gas_apr2 =$_POST["nom_pptal_gas_apr2"];
   
   $cod_pptal_crp =$_POST["cod_pptal_crp"];
   $nom_pptal_crp =$_POST["nom_pptal_crp"];
  
   $cod_pptal_cobp=$_POST["cod_pptal_cobp"];
   $nom_pptal_cobp=$_POST["nom_pptal_cobp"];
   
   $cod_pptal_ceva_con_sit =$_POST["cod_pptal_ceva_con_sit"];
   $nom_pptal_ceva_con_sit =$_POST["nom_pptal_ceva_con_sit"];
   
   $cod_pptal_ceva_sin_sit =$_POST["cod_pptal_ceva_sin_sit"];
   $nom_pptal_ceva_sin_sit =$_POST["nom_pptal_ceva_sin_sit"];	
   
$sql = "select * from ctas0_gas_ok where cod_pptal='$cod_pptal' ";

$resultado = mysql_db_query($database, $sql, $connectionxx);

$result = mysql_num_rows($resultado);

//printf("<br><br>filas %s",$result);


    if ($result == 0)
	{
	
	$sql2 = "INSERT INTO ctas0_gas_ok 
	( 
   id_emp,cod_pptal,nom_rubro,vr_ini_aprob,
   cod_pptal_gas_apr,nom_pptal_gas_apr,
   cod_pptal_gas_apr2,nom_pptal_gas_apr2,
   cod_pptal_crp,nom_pptal_crp,
   cod_pptal_cobp,nom_pptal_cobp,
   cod_pptal_ceva_con_sit,nom_pptal_ceva_con_sit,
   cod_pptal_ceva_sin_sit,nom_pptal_ceva_sin_sit
	) 
	
	VALUES 
	(
   '$id_emp','$cod_pptal','$nom_rubro','$vr_ini_aprob',
   '$cod_pptal_gas_apr','$nom_pptal_gas_apr',
   '$cod_pptal_gas_apr2','$nom_pptal_gas_apr2',
   '$cod_pptal_crp','$nom_pptal_crp',
   '$cod_pptal_cobp','$nom_pptal_cobp',
   '$cod_pptal_ceva_con_sit','$nom_pptal_ceva_con_sit',
   '$cod_pptal_ceva_sin_sit','$nom_pptal_ceva_sin_sit'	
	)";
    
	
	
	mysql_db_query($database, $sql2, $connectionxx) or die(mysql_error());

	
	}
	else
	{
	
	$sql2 = "update ctas0_gas_ok set 
	
    cod_pptal_gas_apr='$cod_pptal_gas_apr',nom_pptal_gas_apr='$nom_pptal_gas_apr',
    cod_pptal_gas_apr2='$cod_pptal_gas_apr2',nom_pptal_gas_apr2='$nom_pptal_gas_apr2',
    cod_pptal_crp='$cod_pptal_crp',nom_pptal_crp='$nom_pptal_crp',
    cod_pptal_cobp='$cod_pptal_cobp',nom_pptal_cobp='$nom_pptal_cobp',
    cod_pptal_ceva_con_sit='$cod_pptal_ceva_con_sit',nom_pptal_ceva_con_sit='$nom_pptal_ceva_con_sit',
    cod_pptal_ceva_sin_sit='$cod_pptal_ceva_sin_sit',nom_pptal_ceva_sin_sit='$nom_pptal_ceva_sin_sit'
	
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
