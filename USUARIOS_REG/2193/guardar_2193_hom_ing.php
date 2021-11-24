<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<?

$cuenta=$_POST['cuenta'];
$nom_rubro=$_POST['nom_rubro'];
$definitivo=$_POST['definitivo'];
$cod_concepto_2193_ing=$_POST['concepto_2193_ing'];

include('../config.php');	

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
//**** verifico si ya existe


	$sql = "select * from 2193_ing_ok where cod_pptal='$cuenta'";
	$result = mysql_db_query($database, $sql, $cx) or die(mysql_error());
	if (mysql_num_rows($result) == 0)
	{
	
			$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
			$sqlxx = "select * from 2193_ing where cod = '$cod_concepto_2193_ing'";
			$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
			
			while($rowxx = mysql_fetch_array($resultadoxx)) 
			   {
			   
			   $tipo=$rowxx["tipo"];
			   $trimestre=$rowxx["trimestre"];
			   $concepto=$rowxx["concepto"];
			 
			   }
			   
			$sql = "INSERT INTO 2193_ing_ok ( cod , tipo, trimestre, concepto, cod_pptal, nom_rubro, definitivo)
			 VALUES ( '$cod_concepto_2193_ing' , '$tipo', '$trimestre', '$concepto', '$cuenta', '$nom_rubro', '$definitivo')";
			mysql_query($sql, $connectionxx) or die(mysql_error());
	
    } 
	else
	{
			
			$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
			$sqlxx = "select * from 2193_ing where cod = '$cod_concepto_2193_ing'";
			$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
			
			while($rowxx = mysql_fetch_array($resultadoxx)) 
			   {
			   
			   $tipo=$rowxx["tipo"];
			   $trimestre=$rowxx["trimestre"];
			   $concepto=$rowxx["concepto"];
			 
			   }
			
			$sql = "update 2193_ing_ok set cod='$cod_concepto_2193_ing' , tipo='$tipo', trimestre='$trimestre', concepto='$concepto' where cod_pptal = '$cuenta' ";
			$resultado = mysql_db_query($database, $sql, $connectionxx);

			
	}


?>
<script>

window.close()

</script>

<?
}
?>
