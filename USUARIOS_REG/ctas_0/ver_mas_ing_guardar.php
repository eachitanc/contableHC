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

	$id_emp=$_POST['id_emp']; //printf("id_emp  %s<br>",$id_emp);
	$cod_pptal=$_POST['cod_pptal']; //printf("cod_pptal  %s<br>",$cod_pptal);
	$nom_rubro=$_POST['nom_rubro']; //printf("nom_rubro  %s<br>",$nom_rubro);
	$vr_ini_aprob=$_POST['vr_ini_aprob']; //printf("vr_ini_aprob  %s<br>",$vr_ini_aprob);
  
   $cod_pptal_ing_apr=$_POST["cod_pptal_ing_apr"];//printf("cod_pptal_ing_apr  %s<br>",$cod_pptal_ing_apr);
   $nom_pptal_ing_apr=$_POST["nom_pptal_ing_apr"];//printf("nom_pptal_ing_apr  %s<br>",$nom_pptal_ing_apr);
   
   $cod_pptal_ing_x_eje=$_POST["cod_pptal_ing_x_eje"];//printf("cod_pptal_ing_x_eje  %s<br>",$cod_pptal_ing_x_eje);
   $nom_pptal_ing_x_eje=$_POST["nom_pptal_ing_x_eje"];//printf("nom_pptal_ing_x_eje  %s<br>",$nom_pptal_ing_x_eje);
   
   $cod_pptal_ing_eje=$_POST["cod_pptal_ing_eje"];//printf("cod_pptal_ing_eje  %s<br>",$cod_pptal_ing_eje);
   $nom_pptal_ing_eje=$_POST["nom_pptal_ing_eje"];//printf("nom_pptal_ing_eje  %s<br>",$nom_pptal_ing_eje);
  
   $cod_pptal_otros=$_POST["cod_pptal_otros"];//printf("cod_pptal_otros  %s<br>",$cod_pptal_otros);
   $nom_pptal_otros=$_POST["nom_pptal_otros"];//printf("nom_pptal_otros  %s<br>",$nom_pptal_otros);

   $cod_pptal_no_aforados=$_POST["cod_pptal_no_aforados"];//printf("cod_pptal_no_aforados  %s<br>",$cod_pptal_no_aforados);
   $nom_pptal_no_aforados=$_POST["nom_pptal_no_aforados"];//printf("nom_pptal_no_aforados  %s<br>",$nom_pptal_no_aforados);
   

$sql = "select * from ctas0_ing_ok where cod_pptal='$cod_pptal' ";

$resultado = mysql_db_query($database, $sql, $connectionxx);

$result = mysql_num_rows($resultado);

//printf("<br><br>filas %s",$result);


    if ($result == 0)
	{
	
	$sql2 = "INSERT INTO ctas0_ing_ok 
	( 
	id_emp,
	cod_pptal,
	nom_rubro,
	vr_ini_aprob,
	cod_pptal_ing_apr,
	nom_pptal_ing_apr,
	cod_pptal_ing_x_eje,
	nom_pptal_ing_x_eje,
	cod_pptal_ing_eje,
	nom_pptal_ing_eje,
	cod_pptal_otros,
	nom_pptal_otros,
	cod_pptal_no_aforados,
	nom_pptal_no_aforados
	) 
	
	VALUES 
	(
	'$id_emp',
	'$cod_pptal',
	'$nom_rubro',
	'$vr_ini_aprob',
	'$cod_pptal_ing_apr',
	'$nom_pptal_ing_apr',
	'$cod_pptal_ing_x_eje',
	'$nom_pptal_ing_x_eje',
	'$cod_pptal_ing_eje',
	'$nom_pptal_ing_eje',
	'$cod_pptal_otros',
	'$nom_pptal_otros',
	'$cod_pptal_no_aforados',
	'$nom_pptal_no_aforados'	
	)";
    
	
	
	mysql_db_query($database, $sql2, $connectionxx) or die(mysql_error());
	//printf("<br><br>nuevo");
	
	}
	else
	{
	
	$sql2 = "update ctas0_ing_ok set 
	
	cod_pptal_ing_apr='$cod_pptal_ing_apr',nom_pptal_ing_apr='$nom_pptal_ing_apr',
	cod_pptal_ing_x_eje='$cod_pptal_ing_x_eje',nom_pptal_ing_x_eje='$nom_pptal_ing_x_eje',
	cod_pptal_ing_eje='$cod_pptal_ing_eje',nom_pptal_ing_eje='$nom_pptal_ing_eje',
	cod_pptal_otros='$cod_pptal_otros',nom_pptal_otros='$nom_pptal_otros',
	cod_pptal_no_aforados='$cod_pptal_no_aforados',nom_pptal_no_aforados='$nom_pptal_no_aforados'	
	
	where 
	
	id_emp = '$id_emp' and cod_pptal = '$cod_pptal'
	
	";
    $re2 = mysql_db_query($database, $sql2, $connectionxx);
    //printf("<br><br>actualiza");

	
	}
	


?>
<script type="text/javascript"> 
	window.close()
</script>
<?
}
?>
