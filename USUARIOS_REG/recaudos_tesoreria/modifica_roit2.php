<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<style type="text/css">
<!--
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
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
<?php
$id = $_POST['id'];
$id_reip = $_POST['id_reip'];
$id_caic = $_POST['id_caic'];
$id_recau = $_POST['id_recau'];
$cuenta = $_POST['cuenta'];
$nombre = $_POST['nombre'];
$new_vr_digitado = $_POST['vr_digitado'];
$tercero = $_POST['tercero'];
$des_recaudo = $_POST['des_recaudo'];

/*printf("

id : %s <br> id_reip : %s <br> id_caic : %s <br> id_recau : %s <br> cuenta : %s <br> nombre : %s<br> new_vr_digitado : %.2f<br> tercero : %s<br> des_recaudo : %s

",
$id ,$id_reip, $id_caic, $id_recau, $cuenta ,$nombre ,$new_vr_digitado ,$tercero ,$des_recaudo 
);*/

// *** id emp ***
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
}

//******

$sql2 = "select * from recaudo_roit where id_emp='$id_emp' and id ='$id'";
$resultado2 = mysql_db_query($database, $sql2, $connectionxx);

while($rw2 = mysql_fetch_array($resultado2)) 
{
  $id_unico_reip=$rw2["id_unico_reip"];
  $vr_digitado=$rw2["vr_digitado"];
  $aux_vr_digitado=$rw2["vr_digitado"];// para usar en contabilidad
  $vr_orig_reip=$rw2["vr_orig_reip"];
}


// *******

$sql3 = "select * from reip_ing where id_emp='$id_emp' and id ='$id_unico_reip'";
$resultado3 = mysql_db_query($database, $sql3, $connectionxx);

while($rw3= mysql_fetch_array($resultado3)) 
{
  $vr_recaudado=$rw3["vr_recaudado"];
}

//*** 
$new_vr_recaudado = $vr_recaudado - $vr_digitado ;

$vrxrecaudar = $vr_orig_reip - $new_vr_recaudado ;



//****

if ($new_vr_digitado > $vrxrecaudar)
{

printf("
<br>
<center class='Estilo8'>
<span class='Estilo9'>EL VALOR DIGITADO <b>".$new_vr_digitado." </b>
<br>
EXCEDE EL VALOR QUE FALTA POR RECAUDAR AL RECONOCIMIENTO <b>...:::".$id_reip.":::...</b>
<br>
(".$vrxrecaudar.")
<br><br>
<b>VERIFIQUE</b> su informacion nuevamente
</span><BR><BR>
<form method='post' action='confirma_borra_roit.php'>
<input type='hidden' name='id_recau' value='%s'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
",$id_recau);

}
else
{
//***** actualizo descripcion a todos los roit

$sql10 = "update recaudo_roit set des_recaudo='$des_recaudo' where id_emp='$id_emp' and id_recau ='$id_recau' ";
$resultado10 = mysql_db_query($database, $sql10, $connectionxx);

//***** actualizo el vr digitado en recaudo_roip
$sql5 = "update recaudo_roit set vr_digitado='$new_vr_digitado' where id_emp='$id_emp' and id ='$id' ";
$resultado5 = mysql_db_query($database, $sql5, $connectionxx);

//**** actualizo el vr recaudado de reip_ing

$a = ($vr_recaudado - $vr_digitado) + $new_vr_digitado;

$sql6 = "update reip_ing set vr_recaudado='$a' where id_emp='$id_emp' and id ='$id_unico_reip' ";
$resultado6 = mysql_db_query($database, $sql6, $connectionxx);

//**** actualizo recaudo completo (si/no) - reip_ing

$sql7 = "select * from reip_ing where id_emp='$id_emp' and id ='$id_unico_reip'";
$resultado7 = mysql_db_query($database, $sql7, $connectionxx);

while($rw7= mysql_fetch_array($resultado7)) 
{
  $vr_rec=$rw7["vr_recaudado"];
  $valor_orig=$rw7["valor"];
}

		if($vr_rec == $valor_orig)
		{
		$sql8 = "update reip_ing set recaudo_completo='SI' where id_emp='$id_emp' and id ='$id_unico_reip' ";
		$resultado8 = mysql_db_query($database, $sql8, $connectionxx);
		}
		else
		{
		$sql8 = "update reip_ing set recaudo_completo='NO' where id_emp='$id_emp' and id ='$id_unico_reip' ";
		$resultado8 = mysql_db_query($database, $sql8, $connectionxx);
		
		$sql9 = "update cartera_cont set recaudado='NO' where id_emp='$id_emp' and consec_cartera ='$id_caic' ";
		$resultado9 = mysql_db_query($database, $sql9, $connectionxx);
		
		}
		


//************* actualizar contabilidad
$sql12 = "select * from recaudo_roit where id_emp='$id_emp' and id_recau ='$id_recau'";
$resultado12 = mysql_db_query($database, $sql12, $connectionxx);

while($rw12 = mysql_fetch_array($resultado12)) 
{

	for($i = 0 ; $i < 16 ; $i++)
	{
	
	  if($rw12["vr_deb_".$i] == $aux_vr_digitado)
	  {
	    $sql13 = "update recaudo_roit set vr_deb_".$i."='$new_vr_digitado' where id_emp='$id_emp' and id_recau ='$id_recau' ";
		$resultado13 = mysql_db_query($database, $sql13, $connectionxx);
	  }
	  
	  if($rw12["vr_cre_".$i] == $aux_vr_digitado)
	  {
	    $sql14 = "update recaudo_roit set vr_cre_".$i."='$new_vr_digitado' where id_emp='$id_emp' and id_recau ='$id_recau' ";
		$resultado14 = mysql_db_query($database, $sql14, $connectionxx);
	  }
	
	}
	



  $vr_orig_reip=$rw12["vr_orig_reip"];
}





printf("
<br>
<center class='Estilo8'>
<span class='Estilo9'>
REGISTRO ACTUALIZADO CON EXITO
</span><BR><BR>
<form method='post' action='confirma_borra_roit.php'>
<input type='hidden' name='id_recau' value='%s'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
",$id_recau);


}


?>
<?php
}
?>