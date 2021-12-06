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
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
-->
</style>
<?php

include('../config.php');
// conexion				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// id_emp
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
}

$fecha = $_POST["fecha_ceva"];    //  printf("%s<br>",$fecha);
$concepto = $_POST["des_ceva"];    //printf("%s<br>",$concepto);
$id_auto_ceva = $_POST['id_ceva'];  //printf("%s<br>",$id_auto_ceva);


$pgcp1 = $_POST['pgcp1'];//printf("pgcp1 : %s<br>",$pgcp1);
$pgcp2 = $_POST['pgcp2'];//printf("pgcp2 : %s<br>",$pgcp2);
$pgcp3 = $_POST['pgcp3'];//printf("pgcp3 : %s<br>",$pgcp3);
$pgcp4 = $_POST['pgcp4'];//printf("pgcp4 : %s<br>",$pgcp4);
$pgcp5 = $_POST['pgcp5'];//printf("pgcp5 : %s<br>",$pgcp5);
$pgcp6 = $_POST['pgcp6'];//printf("pgcp6 : %s<br>",$pgcp6);
$pgcp7 = $_POST['pgcp7'];//printf("pgcp7 : %s<br>",$pgcp7);
$pgcp8 = $_POST['pgcp8'];//rintf("pgcp8 : %s<br>",$pgcp8);
$pgcp9 = $_POST['pgcp9'];//printf("pgcp9 : %s<br>",$pgcp9);
$pgcp10 = $_POST['pgcp10'];//printf("pgcp10 : %s<br>",$pgcp10);
$pgcp11 = $_POST['pgcp11'];//printf("pgcp11 : %s<br>",$pgcp11);
$pgcp12 = $_POST['pgcp12'];//printf("pgcp12 : %s<br>",$pgcp12);
$pgcp13 = $_POST['pgcp13'];//printf("pgcp13 : %s<br>",$pgcp13);
$pgcp14 = $_POST['pgcp14'];//printf("pgcp14 : %s<br>",$pgcp14);
$pgcp15 = $_POST['pgcp15'];//printf("pgcp15 : %s<br>",$pgcp15);

$vr_deb_1 = $_POST['t13'];
$vr_deb_2 = $_POST['t23'];
$vr_deb_3 = $_POST['t33'];
$vr_deb_4 = $_POST['t43'];
$vr_deb_5 = $_POST['t53'];
$vr_deb_6 = $_POST['t63'];
$vr_deb_7 = $_POST['t73'];
$vr_deb_8 = $_POST['t83'];
$vr_deb_9 = $_POST['t93'];
$vr_deb_10 = $_POST['t103'];
$vr_deb_11 = $_POST['t113'];
$vr_deb_12 = $_POST['t123'];
$vr_deb_13 = $_POST['t133'];
$vr_deb_14 = $_POST['t143'];
$vr_deb_15 = $_POST['t153'];
$vr_cre_1 = $_POST['t14'];
$vr_cre_2 = $_POST['t24'];
$vr_cre_3 = $_POST['t34'];
$vr_cre_4 = $_POST['t44'];
$vr_cre_5 = $_POST['t54'];
$vr_cre_6 = $_POST['t64'];
$vr_cre_7 = $_POST['t74'];
$vr_cre_8 = $_POST['t84'];
$vr_cre_9 = $_POST['t94'];
$vr_cre_10 = $_POST['t104'];
$vr_cre_11 = $_POST['t114'];
$vr_cre_12 = $_POST['t124'];
$vr_cre_13 = $_POST['t134'];
$vr_cre_14 = $_POST['t144'];
$vr_cre_15 = $_POST['t154']; 

$banco_cheque = $_POST['banco_cheque'];//printf("banco1 : %s<br>",$banco1);
$banco_cheque2 = $_POST['banco_cheque2'];//printf("banco2 : %s<br>",$banco2);
$banco_cheque3 = $_POST['banco_cheque3'];//printf("banco3 : %s<br>",$banco3);
$banco_cheque4 = $_POST['banco_cheque4'];//printf("banco4 : %s<br>",$banco4);
$banco_cheque5 = $_POST['banco_cheque5'];//printf("banco5 : %s<br>",$banco5);
$banco_cheque6 = $_POST['banco_cheque6'];//printf("banco6 : %s<br>",$banco6);
$banco_cheque7 = $_POST['banco_cheque7'];//printf("banco7 : %s<br>",$banco7);
$banco_cheque8 = $_POST['banco_cheque8'];//printf("banco8 : %s<br>",$banco8);
$banco_cheque9 = $_POST['banco_cheque9'];//printf("banco9 : %s<br>",$banco9);
$banco_cheque10 = $_POST['banco_cheque10'];//printf("banco10 : %s<br>",$banco10);
$banco_cheque11 = $_POST['banco_cheque11'];//printf("banco11 : %s<br>",$banco11);
$banco_cheque12 = $_POST['banco_cheque12'];//printf("banco12 : %s<br>",$banco12);
$banco_cheque13 = $_POST['banco_cheque13'];//printf("banco13 : %s<br>",$banco13);
$banco_cheque14 = $_POST['banco_cheque14'];//printf("banco14 : %s<br>",$banco14);
$banco_cheque15 = $_POST['banco_cheque15'];//printf("banco15 : %s<br>",$banco15);

$cta_cheque = $_POST['cta_cheque'];//printf("cta1 : %s<br>",$cta1);
$cta_cheque2 = $_POST['cta_cheque2'];//printf("cta2 : %s<br>",$cta2);
$cta_cheque3 = $_POST['cta_cheque3'];//printf("cta3 : %s<br>",$cta3);
$cta_cheque4 = $_POST['cta_cheque4'];//printf("cta4 : %s<br>",$cta4);
$cta_cheque5 = $_POST['cta_cheque5'];//printf("cta5 : %s<br>",$cta5);
$cta_cheque6 = $_POST['cta_cheque6'];//printf("cta6 : %s<br>",$cta6);
$cta_cheque7 = $_POST['cta_cheque7'];//printf("cta7 : %s<br>",$cta7);
$cta_cheque8 = $_POST['cta_cheque8'];//printf("cta8 : %s<br>",$cta8);
$cta_cheque9 = $_POST['cta_cheque9'];//printf("cta9 : %s<br>",$cta9);
$cta_cheque10 = $_POST['cta_cheque10'];//printf("cta10 : %s<br>",$cta10);
$cta_cheque11 = $_POST['cta_cheque11'];//printf("cta11 : %s<br>",$cta11);
$cta_cheque12 = $_POST['cta_cheque12'];//printf("cta12 : %s<br>",$cta12);
$cta_cheque13 = $_POST['cta_cheque13'];//printf("cta13 : %s<br>",$cta13);
$cta_cheque14 = $_POST['cta_cheque14'];//printf("cta14 : %s<br>",$cta14);
$cta_cheque15 = $_POST['cta_cheque15'];//printf("cta15 : %s<br>",$cta15);

$num_cheque = $_POST['num_cheque1']; // printf("num_cheque : %s<br>",$num_cheque);
$num_cheque2 = $_POST['num_cheque2']; //printf("num_cheque2 : %s<br>",$num_cheque2);
$num_cheque3 = $_POST['num_cheque3'];//printf("num_cheque3 : %s<br>",$num_cheque3);
$num_cheque4 = $_POST['num_cheque4'];//printf("num_cheque4 : %s<br>",$num_cheque4);
$num_cheque5 = $_POST['num_cheque5'];//printf("num_cheque5 : %s<br>",$num_cheque5);
$num_cheque6 = $_POST['num_cheque6'];//printf("num_cheque6 : %s<br>",$num_cheque6);
$num_cheque7 = $_POST['num_cheque7'];//printf("num_cheque7 : %s<br>",$num_cheque7);
$num_cheque8 = $_POST['num_cheque8'];//printf("num_cheque8 : %s<br>",$num_cheque8);
$num_cheque9 = $_POST['num_cheque9'];//printf("num_cheque9 : %s<br>",$num_cheque9);
$num_cheque10 = $_POST['num_cheque10'];//printf("num_cheque10 : %s<br>",$num_cheque10);
$num_cheque11 = $_POST['num_cheque11'];//printf("num_cheque11 : %s<br>",$num_cheque11);
$num_cheque12 = $_POST['num_cheque12'];//printf("num_cheque12 : %s<br>",$num_cheque12);
$num_cheque13 = $_POST['num_cheque13'];//printf("num_cheque13 : %s<br>",$num_cheque13);
$num_cheque14 = $_POST['num_cheque14'];//printf("num_cheque14 : %s<br>",$num_cheque14);
$num_cheque15 = $_POST['num_cheque15'];//printf("num_cheque15 : %s<br>",$num_cheque15);
$iva_e = $_POST['iva'];  

$tot_deb = $vr_deb_1+$vr_deb_2+$vr_deb_3+$vr_deb_4+$vr_deb_5+$vr_deb_6+$vr_deb_7+$vr_deb_8+$vr_deb_9+$vr_deb_10+$vr_deb_11+$vr_deb_12+$vr_deb_13+$vr_deb_14+$vr_deb_15;
$tot_cre = $vr_cre_1+$vr_cre_2+$vr_cre_3+$vr_cre_4+$vr_cre_5+$vr_cre_6+$vr_cre_7+$vr_cre_8+$vr_cre_9+$vr_cre_10+$vr_cre_11+$vr_cre_12+$vr_cre_13+$vr_cre_14+$vr_cre_15;	

// consulta tipo_dato de pgcp
$sqla = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp1'";
$resultadoa = $connectionxx->query($sqla);
while($rowa = $resultadoa->fetch_assoc()) 
{  $tipa=$rowa["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlb = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp2'";
$resultadob = $connectionxx->query($sqlb);
while($rowb = $resultadob->fetch_assoc()) 
{  $tipb=$rowb["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlc = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp3'";
$resultadoc = $connectionxx->query($sqlc);;
while($rowc = $resultadoc->fetch_assoc()) 
{  $tipc=$rowc["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqld = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp4'";
$resultadod = $connectionxx->query($sqld);
while($rowd = $resultadod->fetch_assoc()) 
{  $tipd=$rowd["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqle = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp5'";
$resultadoe = $connectionxx->query($sqle);
while($rowe = $resultadoe->fetch_assoc()) 
{  $tipe=$rowe["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlf = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp6'";
$resultadof = $connectionxx->query($sqlf);
while($rowf = $resultadof->fetch_assoc()) 
{  $tipf=$rowf["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlg = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp7'";
$resultadog = $connectionxx->query($sqlg);
while($rowg = $resultadog->fetch_assoc()) 
{  $tipg=$rowg["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlh = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp8'";
$resultadoh = $connectionxx->query($sqlh);
while($rowh = $resultadoh->fetch_assoc()) 
{  $tiph=$rowh["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqli = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp9'";
$resultadoi = $connectionxx->query($sqli);
while($rowi = $resultadoi->fetch_assoc()) 
{  $tipi=$rowi["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlj = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp10'";
$resultadoj = $connectionxx->query($sqlj);
while($rowj = $resultadoj->fetch_assoc()) 
{  $tipj=$rowj["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlk = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp11'";
$resultadok = $connectionxx->query($sqlk);
while($rowk = $resultadok->fetch_assoc()) 
{  $tipk=$rowk["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqll = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp12'";
$resultadol = $connectionxx->query($sqll);
while($rowl = $resultadol->fetch_assoc()) 
{  $tipl=$rowl["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlm = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp13'";
$resultadom = $connectionxx->query($sqlm);
while($rowm = $resultadom->fetch_assoc()) 
{  $tipm=$rowm["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqln = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp14'";
$resultadon = $connectionxx->query($sqln);
while($rown = $resultadon->fetch_assoc()) 
{  $tipn=$rown["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlo = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp15'";
$resultadoo = $connectionxx->query($sqlo);
while($rowo = $resultadoo->fetch_assoc()) 
{  $tipo=$rowo["tip_dato"]; }

$sqlp = "select * from ceva where  id_auto_ceva ='$id_auto_ceva'";
$resultadop = mysql_db_query($database, $sqlp, $connectionxx);
while($rowp = mysql_fetch_array($resultadop)) 
{  $fecha_cobp=$rowp["fecha_cobp"]; 
   $id_manu_cobp=$rowp["id_manu_cobp"];

}

/*$sqlq = "SELECT obcg.fecha_obcg , obcg.id_manu_cobp FROM obcg INNER JOIN ceva ON (obcg.id_manu_cobp = ceva.id_manu_cobp) WHERE (obcg.id_manu_cobp ='$id_manu_cobp')";

$resultadoq = mysql_db_query($database, $sqlq, $connectionxx);
while($rowq = mysql_fetch_array($resultadoq) ) 
{ 
	$fecha_obcg=$rowq["fecha_obcg"]; 
}

if (($fecha < $fecha_cobp) and ($fecha < $fecha_obcg))
{
	printf("<br><br><center class='Estilo4'>La fecha de  pagos debe ser <b>MAYOR</b><BR><BR> a la fecha de la OBLIGACION PRESUPUESTAL y de la CAUSACION DE LA OBLIGACION CONTABLE DEL GASTO<br><br>
<br></center>");

}
else 
{
// inicio del bloque


	if (($tipa =='M')or($tipb =='M')or($tipc =='M')or($tipd =='M')or($tipe =='M')or($tipf =='M')or($tipg =='M')or($tiph =='M')or($tipi =='M')or($tipj =='M')or($tipk =='M')or($tipl =='M')or($tipm =='M')or($tipn =='M')or($tipo =='M'))

	{
	printf("<br><br><center class='Estilo4'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br></center>");

	}
	else
	{
		if(($tot_deb != $tot_cre))
		{
printf("<br><br><center class='Estilo4'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb." :::...) y Credito (...::: ".$tot_cre." :::...) del Documento <br><br><b>NO COINCIDEN</b> <BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br></center>");

		}
		else
		{
*/

		

$sql = "update ceva set 
			
		pgcp1 ='$pgcp1', pgcp2 ='$pgcp2', pgcp3 ='$pgcp3', 
		pgcp4 ='$pgcp4', pgcp5 ='$pgcp5', pgcp6 ='$pgcp6', 
		pgcp7 ='$pgcp7', pgcp8 ='$pgcp8', pgcp9 ='$pgcp9',
		pgcp10 ='$pgcp10', pgcp11 ='$pgcp11', pgcp12 ='$pgcp12',
		pgcp13 ='$pgcp13', pgcp14 ='$pgcp14', pgcp15 ='$pgcp15', 
				
		vr_deb_1 ='$vr_deb_1', vr_deb_2 ='$vr_deb_2', vr_deb_3 ='$vr_deb_3',
		vr_deb_4 ='$vr_deb_4', vr_deb_5 ='$vr_deb_5', vr_deb_6 ='$vr_deb_6', 
		vr_deb_7 ='$vr_deb_7', vr_deb_8 ='$vr_deb_8', vr_deb_9 ='$vr_deb_9', 
		vr_deb_10 ='$vr_deb_10', vr_deb_11 ='$vr_deb_11', vr_deb_12 ='$vr_deb_12',
		vr_deb_13 ='$vr_deb_13', vr_deb_14 ='$vr_deb_14', vr_deb_15 ='$vr_deb_15', 
				
		vr_cre_1 ='$vr_cre_1', vr_cre_2 ='$vr_cre_2', vr_cre_3 ='$vr_cre_3', 
		vr_cre_4 ='$vr_cre_4', vr_cre_5 ='$vr_cre_5', vr_cre_6 ='$vr_cre_6', 
		vr_cre_7 ='$vr_cre_7', vr_cre_8 ='$vr_cre_8', vr_cre_9 ='$vr_cre_9', 
		vr_cre_10 ='$vr_cre_10', vr_cre_11 ='$vr_cre_11', vr_cre_12 ='$vr_cre_12', 
		vr_cre_13 ='$vr_cre_13', vr_cre_14 ='$vr_cre_14', vr_cre_15 ='$vr_cre_15',
				 
		banco_cheque  ='$banco_cheque', banco_cheque2  ='$banco_cheque2', banco_cheque3 ='$banco_cheque3',
		banco_cheque4  ='$banco_cheque4', banco_cheque5  ='$banco_cheque5', banco_cheque6  ='$banco_cheque6', 
		banco_cheque7  ='$banco_cheque7', banco_cheque8  ='$banco_cheque8', banco_cheque9  ='$banco_cheque9', 
		banco_cheque10  ='$banco_cheque10', banco_cheque11  ='$banco_cheque11', banco_cheque12  ='$banco_cheque12',
		banco_cheque13  ='$banco_cheque13', banco_cheque14  ='$banco_cheque14', banco_cheque15  ='$banco_cheque15', 
				
		cta_cheque  ='$cta_cheque', cta_cheque2  ='$cta_cheque2', cta_cheque3  ='$cta_cheque3',
		cta_cheque4  ='$cta_cheque4', cta_cheque5  ='$cta_cheque5', cta_cheque6  ='$cta_cheque6',
		cta_cheque7  ='$cta_cheque7', cta_cheque8  ='$cta_cheque8', cta_cheque9  ='$cta_cheque9',
		cta_cheque10  ='$cta_cheque10', cta_cheque11  ='$cta_cheque11', cta_cheque12  ='$cta_cheque12',
		cta_cheque13  ='$cta_cheque13', cta_cheque14  ='$cta_cheque14', cta_cheque15  ='$cta_cheque15', 
				
		num_cheque  ='$num_cheque', num_cheque2  ='$num_cheque2', num_cheque3  ='$num_cheque3',
		num_cheque4  ='$num_cheque4', num_cheque5  ='$num_cheque5', num_cheque6  ='$num_cheque6', 
		num_cheque7  ='$num_cheque7', num_cheque8  ='$num_cheque8', num_cheque9  ='$num_cheque9', 
		num_cheque10  ='$num_cheque10', num_cheque11  ='$num_cheque11', num_cheque12  ='$num_cheque12',
		num_cheque13  ='$num_cheque13', num_cheque14  ='$num_cheque14', num_cheque15  ='$num_cheque15', 
				
		fecha_ceva ='$fecha', des_ceva='$concepto',
		vr_reteiva='$iva_e'

		where id_auto_ceva ='$id_auto_ceva' ";
		
		$resultado = mysql_db_query($database, $sql, $connectionxx);

		printf("<br><br><center class='Estilo4'>EL REGISTRO HA SIDO ACTUALIZADO CON EXITO <BR><BR><BR><BR></center>");


	
//}	
//}
//}

printf("

<center class='Estilo4'>
<form method='post' action='pagos_tesoreria.php'>
<input type='hidden' name='nn' value='CEVA'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");
?>


<?php
}
?>