<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<style type="text/css">
<!--
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
a:link {
	color: #666666;
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
-->
</style>
<title>CONTAFACIL</title>
<body>

<?php

			
$id_cobp=$_GET['id']; 
$vr_cobp=$_GET['val']; 
			

include('../config.php');	

$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
}

$sqlxxqw = "select * from fecha_ini_op";
$resultadoxxqw = mysql_db_query($database, $sqlxxqw, $connectionxx);

while($rowxxqw = mysql_fetch_array($resultadoxxqw)) 
{
  $fecha_ini_op=$rowxxqw["fecha_ini_op"];
  
}

$link = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");


$result = mysql_query("SELECT * FROM car_ppto_gas where id_emp ='$id_emp' and tip_dato = 'D' and ano = '".$fecha_ini_op."'", $link);
$tot_ctas_d = mysql_num_rows($result);
printf("<br><br><center class ='Estilo2'>Total Cuentas Detalle encontradas y Creadas en la Fecha de Inicio de Operaciones ".$fecha_ini_op." = %s <br><br></center>",$tot_ctas_d);

$result2 = mysql_query("SELECT * FROM car_ppto_gas where id_emp ='$id_emp' and tip_dato = 'D' and pac ='SI' and ano = '$fecha_ini_op'", $link);
$tot_ctas_d_pac = mysql_num_rows($result2);
printf("<center class ='Estilo2'>Total Cuentas Detalle -  Creadas en la Fecha de Inicio de Operaciones con P.A.C elaborado = %s</center>",$tot_ctas_d_pac);

if($tot_ctas_d != $tot_ctas_d_pac)
{
printf("<br><br><br><center class ='Estilo2'>NO PUEDE REALIZAR PAGOS HASTA TANTO <BR><b>TODAS</b> LAS CUENTAS DEL PRESUPUESTO INICIAL DE GASTOS TENGAN P.A.C ELABORADO</center><br><br><br>");
}
else
{

		$sqlxxa1 = "select * from cobp where id_emp ='$id_emp' and id_auto_cobp = '$id_cobp'";
		$resultadoxxa1 = mysql_db_query($database, $sqlxxa1, $connectionxx);
		
		while($rowxxa1 = mysql_fetch_array($resultadoxxa1)) 
		{
		        $cuenta=$rowxxa1["cuenta"];
				$vr_digitado=$rowxxa1["vr_digitado"];
				

        }
		
		$ano2 = substr($ano,0,8);
		
		$sqlxxa2 = "select * from pac_gastos where id_emp ='$id_emp' and cod_pptal = '$cuenta' and fecha_reg like '".$ano2."%'";
		$resultadoxxa2 = mysql_db_query($database, $sqlxxa2, $connectionxx);
		
		while($rowxxa2 = mysql_fetch_array($resultadoxxa2)) 
		{
		  $sal_pac_ene=$rowxxa2["sal_pac_ene"];
		}
		
		/*if ($sal_pac_ene < $vr_cobp)
		{
		
		 $dife=$vr_cobp - $sal_pac_ene;
		
  		printf("<br><br><br><center class ='Estilo2'>NO PUEDE REALIZAR PAGOS HASTA TANTO ACTUALICE EL P.A.C DE CADA CUENTA Y/O
          <BR><BR><b>ADICIONE AL P.A.C</b> DE LA CUENTA ".$cuenta." <BR><BR>
		  EL VALOR DE $".$dife."= <br><br><br></center>");*/
		
		?>
<!--<br><center><a href="../ppto_gastos/adi_red_pac_ing.php" target="_parent" class="Estilo2"><strong>...::: HACER ADICION AL P.A.C :::...</strong></a></center><BR>
--><?php
		/*}
		else
		{*/
		
			?>
			
			<form  method="POST" action="p_pago_cobp.php">
			<div align="center">
			<input type="hidden" name="id_cobp" value="<?php printf("%s",$id_cobp); ?>">
			  <br>
<br>
...:::   
			  <input name="Submit" type="submit" class="Estilo2" value="CONTINUAR PAGO"> 
			  :::...  
			  <br>
			  <br>
			  
			</div>
			</form>
			<?php
//}
}
?>














<div align="center">
<?php
printf("

<center class='Estilo9'>
<form method='post' action='pagos_tesoreria.php'>
<input type='hidden' name='nn' value='CEVA'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo2' /> :::...
</form>
</center>
");

?>
</div>
</body>
</html>
<?php
}
?>