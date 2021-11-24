<?
session_start();
if(!isset($_SESSION["login"]))
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
<?

include('../config.php');
// conexion				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// id_emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}

$id_manu_ncon = 'TFIN'.$_POST['id_manu_ncon']; //printf("%s<br>",$id_manu_ncon);
$id_auto_ncon = $_POST['id_auto_ncon'];//printf("%s<br>",$id_auto_ncon);
$fecha_ncon = $_POST['fecha_ncon'];//printf("%s<br>",$fecha_ncon);
$des_ncon = $_POST['des_ncon'];//printf("%s<br>",$des_ncon);

$pgcp1 = $_POST['pgcp1'];
$pgcp2 = $_POST['pgcp2'];
$pgcp3 = $_POST['pgcp3'];
$pgcp4 = $_POST['pgcp4'];
$pgcp5 = $_POST['pgcp5'];
$pgcp6 = $_POST['pgcp6'];
$pgcp7 = $_POST['pgcp7'];
$pgcp8 = $_POST['pgcp8'];
$pgcp9 = $_POST['pgcp9'];
$pgcp10 = $_POST['pgcp10'];
$pgcp11 = $_POST['pgcp11'];
$pgcp12 = $_POST['pgcp12'];
$pgcp13 = $_POST['pgcp13'];
$pgcp14 = $_POST['pgcp14'];
$pgcp15 = $_POST['pgcp15'];

$vr_deb_1 = $_POST['vr_deb_1'];
$vr_deb_2 = $_POST['vr_deb_2'];
$vr_deb_3 = $_POST['vr_deb_3'];
$vr_deb_4 = $_POST['vr_deb_4'];
$vr_deb_5 = $_POST['vr_deb_5'];
$vr_deb_6 = $_POST['vr_deb_6'];
$vr_deb_7 = $_POST['vr_deb_7'];
$vr_deb_8 = $_POST['vr_deb_8'];
$vr_deb_9 = $_POST['vr_deb_9'];
$vr_deb_10 = $_POST['vr_deb_10'];
$vr_deb_11 = $_POST['vr_deb_11'];
$vr_deb_12 = $_POST['vr_deb_12'];
$vr_deb_13 = $_POST['vr_deb_13'];
$vr_deb_14 = $_POST['vr_deb_14'];
$vr_deb_15 = $_POST['vr_deb_15'];

$vr_cre_1 = $_POST['vr_cre_1'];
$vr_cre_2 = $_POST['vr_cre_2'];
$vr_cre_3 = $_POST['vr_cre_3'];
$vr_cre_4 = $_POST['vr_cre_4'];
$vr_cre_5 = $_POST['vr_cre_5'];
$vr_cre_6 = $_POST['vr_cre_6'];
$vr_cre_7 = $_POST['vr_cre_7'];
$vr_cre_8 = $_POST['vr_cre_8'];
$vr_cre_9 = $_POST['vr_cre_9'];
$vr_cre_10 = $_POST['vr_cre_10'];
$vr_cre_11 = $_POST['vr_cre_11'];
$vr_cre_12 = $_POST['vr_cre_12'];
$vr_cre_13 = $_POST['vr_cre_13'];
$vr_cre_14 = $_POST['vr_cre_14'];
$vr_cre_15 = $_POST['vr_cre_15'];

$tot_deb = $vr_deb_1+$vr_deb_2+$vr_deb_3+$vr_deb_4+$vr_deb_5+$vr_deb_6+$vr_deb_7+$vr_deb_8+$vr_deb_9+$vr_deb_10+$vr_deb_11+$vr_deb_12+$vr_deb_13+$vr_deb_14+$vr_deb_15;
$tot_cre = $vr_cre_1+$vr_cre_2+$vr_cre_3+$vr_cre_4+$vr_cre_5+$vr_cre_6+$vr_cre_7+$vr_cre_8+$vr_cre_9+$vr_cre_10+$vr_cre_11+$vr_cre_12+$vr_cre_13+$vr_cre_14+$vr_cre_15;	

$tot_deb_a = number_format($tot_deb,2,',','.'); 
$tot_cre_a = number_format($tot_cre,2,',','.');

$banco1 = $_POST['banco1'];//printf("banco1 : %s<br>",$banco1);
$banco2 = $_POST['banco2'];//printf("banco2 : %s<br>",$banco2);
$banco3 = $_POST['banco3'];//printf("banco3 : %s<br>",$banco3);
$banco4 = $_POST['banco4'];//printf("banco4 : %s<br>",$banco4);
$banco5 = $_POST['banco5'];//printf("banco5 : %s<br>",$banco5);
$banco6 = $_POST['banco6'];//printf("banco6 : %s<br>",$banco6);
$banco7 = $_POST['banco7'];//printf("banco7 : %s<br>",$banco7);
$banco8 = $_POST['banco8'];//printf("banco8 : %s<br>",$banco8);
$banco9 = $_POST['banco9'];//printf("banco9 : %s<br>",$banco9);
$banco10 = $_POST['banco10'];//printf("banco10 : %s<br>",$banco10);
$banco11 = $_POST['banco11'];//printf("banco11 : %s<br>",$banco11);
$banco12 = $_POST['banco12'];//printf("banco12 : %s<br>",$banco12);
$banco13 = $_POST['banco13'];//printf("banco13 : %s<br>",$banco13);
$banco14 = $_POST['banco14'];//printf("banco14 : %s<br>",$banco14);
$banco15 = $_POST['banco15'];//printf("banco15 : %s<br>",$banco15);


$cta1 = $_POST['cta1'];//printf("cta1 : %s<br>",$cta1);
$cta2 = $_POST['cta2'];//printf("cta2 : %s<br>",$cta2);
$cta3 = $_POST['cta3'];//printf("cta3 : %s<br>",$cta3);
$cta4 = $_POST['cta4'];//printf("cta4 : %s<br>",$cta4);
$cta5 = $_POST['cta5'];//printf("cta5 : %s<br>",$cta5);
$cta6 = $_POST['cta6'];//printf("cta6 : %s<br>",$cta6);
$cta7 = $_POST['cta7'];//printf("cta7 : %s<br>",$cta7);
$cta8 = $_POST['cta8'];//printf("cta8 : %s<br>",$cta8);
$cta9 = $_POST['cta9'];//printf("cta9 : %s<br>",$cta9);
$cta10 = $_POST['cta10'];//printf("cta10 : %s<br>",$cta10);
$cta11 = $_POST['cta11'];//printf("cta11 : %s<br>",$cta11);
$cta12 = $_POST['cta12'];//printf("cta12 : %s<br>",$cta12);
$cta13 = $_POST['cta13'];//printf("cta13 : %s<br>",$cta13);
$cta14 = $_POST['cta14'];//printf("cta14 : %s<br>",$cta14);
$cta15 = $_POST['cta15'];//printf("cta15 : %s<br>",$cta15);


$cheque_1 = $_POST['cheque_1'];//printf("cheque1 : %s<br>",$cheque1);
$cheque_2 = $_POST['cheque_2'];//printf("cheque2 : %s<br>",$cheque2);
$cheque_3 = $_POST['cheque_3'];//printf("cheque3 : %s<br>",$cheque3);
$cheque_4 = $_POST['cheque_4'];//printf("cheque4 : %s<br>",$cheque4);
$cheque_5 = $_POST['cheque_5'];//printf("cheque5 : %s<br>",$cheque5);
$cheque_6 = $_POST['cheque_6'];//printf("cheque6 : %s<br>",$cheque6);
$cheque_7 = $_POST['cheque_7'];//printf("cheque7 : %s<br>",$cheque7);
$cheque_8 = $_POST['cheque_8'];//printf("cheque8 : %s<br>",$cheque8);
$cheque_9 = $_POST['cheque_9'];//printf("cheque9 : %s<br>",$cheque9);
$cheque_10 = $_POST['cheque_10'];//printf("cheque10 : %s<br>",$cheque10);
$cheque_11 = $_POST['cheque_11'];//printf("cheque11 : %s<br>",$cheque11);
$cheque_12 = $_POST['cheque_12'];//printf("cheque12 : %s<br>",$cheque12);
$cheque_13 = $_POST['cheque_13'];//printf("cheque13 : %s<br>",$cheque13);
$cheque_14 = $_POST['cheque_14'];//printf("cheque14 : %s<br>",$cheque14);
$cheque_15 = $_POST['cheque_15'];//printf("cheque15 : %s<br>",$cheque15);
// id_emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}
// vigencia fiscal
$consultax=mysql_query("select * from vf ",$connectionxx);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
} 
// consulta tipo_dato de pgcp
$sqla = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp1'";
$resultadoa = mysql_db_query($database, $sqla, $connectionxx);
while($rowa = mysql_fetch_array($resultadoa)) 
{  $tipa=$rowa["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlb = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp2'";
$resultadob = mysql_db_query($database, $sqlb, $connectionxx);
while($rowb = mysql_fetch_array($resultadob)) 
{  $tipb=$rowb["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlc = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp3'";
$resultadoc = mysql_db_query($database, $sqlc, $connectionxx);
while($rowc = mysql_fetch_array($resultadoc)) 
{  $tipc=$rowc["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqld = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp4'";
$resultadod = mysql_db_query($database, $sqld, $connectionxx);
while($rowd = mysql_fetch_array($resultadod)) 
{  $tipd=$rowd["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqle = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp5'";
$resultadoe = mysql_db_query($database, $sqle, $connectionxx);
while($rowe = mysql_fetch_array($resultadoe)) 
{  $tipe=$rowe["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlf = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp6'";
$resultadof = mysql_db_query($database, $sqlf, $connectionxx);
while($rowf = mysql_fetch_array($resultadof)) 
{  $tipf=$rowf["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlg = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp7'";
$resultadog = mysql_db_query($database, $sqlg, $connectionxx);
while($rowg = mysql_fetch_array($resultadog)) 
{  $tipg=$rowg["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlh = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp8'";
$resultadoh = mysql_db_query($database, $sqlh, $connectionxx);
while($rowh = mysql_fetch_array($resultadoh)) 
{  $tiph=$rowh["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqli = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp9'";
$resultadoi = mysql_db_query($database, $sqli, $connectionxx);
while($rowi = mysql_fetch_array($resultadoi)) 
{  $tipi=$rowi["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlj = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp10'";
$resultadoj = mysql_db_query($database, $sqlj, $connectionxx);
while($rowj = mysql_fetch_array($resultadoj)) 
{  $tipj=$rowj["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlk = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp11'";
$resultadok = mysql_db_query($database, $sqlk, $connectionxx);
while($rowk = mysql_fetch_array($resultadok)) 
{  $tipk=$rowk["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqll = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp12'";
$resultadol = mysql_db_query($database, $sqll, $connectionxx);
while($rowl = mysql_fetch_array($resultadol)) 
{  $tipl=$rowl["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlm = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp13'";
$resultadom = mysql_db_query($database, $sqlm, $connectionxx);
while($rowm = mysql_fetch_array($resultadom)) 
{  $tipm=$rowm["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqln = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp14'";
$resultadon = mysql_db_query($database, $sqln, $connectionxx);
while($rown = mysql_fetch_array($resultadon)) 
{  $tipn=$rown["tip_dato"]; }
// consulta tipo_dato de pgcp
$sqlo = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp15'";
$resultadoo = mysql_db_query($database, $sqlo, $connectionxx);
while($rowo = mysql_fetch_array($resultadoo)) 
{  $tipo=$rowo["tip_dato"]; }

// inicio del bloque
if ($fecha_ncon == '' or $id_manu_ncon == 'TFIN')
{
	
	printf("<br><br><center class='Estilo4'><b>NO</b> debe dejar casillas del Documento sin diligenciar<BR><BR>Verifique Fecha y/o No. TFIN<br><br></center> ");
	
}
else
{

if (($tipa =='M')or($tipb =='M')or($tipc =='M')or($tipd =='M')or($tipe =='M')or($tipf =='M')or($tipg =='M')or($tiph =='M')or($tipi =='M')or($tipj =='M')or($tipk =='M')or($tipl =='M')or($tipm =='M')or($tipn =='M')or($tipo =='M'))
{
printf("<br><br><center class='Estilo4'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br></center>");

}
else
{
if(($tot_deb_a != $tot_cre_a))
{
printf("<br><br><center class='Estilo4'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb_a." :::...) y Credito (...::: ".$tot_cre_a." :::...) del Documento <br><br><b>NO COINCIDEN</b> <BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br></center>");

}
else
{


	if($fecha_ncon > $bx or $fecha_ncon < $ax)
	{
	printf("<br><br><center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR></center>");

	}
	else
	{ 
		

		$sql = "update conta_tfin set 	
				id_manu_ncon='$id_manu_ncon',  fecha_ncon ='$fecha_ncon',  des_ncon ='$des_ncon',	
				pgcp1 ='$pgcp1', pgcp2 ='$pgcp2', pgcp3 ='$pgcp3', pgcp4 ='$pgcp4', pgcp5 ='$pgcp5', pgcp6 ='$pgcp6', pgcp7 ='$pgcp7', pgcp8 ='$pgcp8', 
				pgcp9 ='$pgcp9', pgcp10 ='$pgcp10', pgcp11 ='$pgcp11', 
				pgcp12 ='$pgcp12', pgcp13 ='$pgcp13', pgcp14 ='$pgcp14', pgcp15 ='$pgcp15', 
				vr_deb_1 ='$vr_deb_1', vr_deb_2 ='$vr_deb_2', vr_deb_3 ='$vr_deb_3', vr_deb_4 ='$vr_deb_4', vr_deb_5 ='$vr_deb_5', vr_deb_6 ='$vr_deb_6', 
				vr_deb_7 ='$vr_deb_7', vr_deb_8 ='$vr_deb_8', vr_deb_9 ='$vr_deb_9', 
				vr_deb_10 ='$vr_deb_10', vr_deb_11 ='$vr_deb_11', vr_deb_12 ='$vr_deb_12', vr_deb_13 ='$vr_deb_13', vr_deb_14 ='$vr_deb_14', vr_deb_15 ='$vr_deb_15', 
				vr_cre_1 ='$vr_cre_1', vr_cre_2 ='$vr_cre_2', vr_cre_3 ='$vr_cre_3', vr_cre_4 ='$vr_cre_4', vr_cre_5 ='$vr_cre_5', vr_cre_6 ='$vr_cre_6', 
				vr_cre_7 ='$vr_cre_7', vr_cre_8 ='$vr_cre_8', vr_cre_9 ='$vr_cre_9', 
				vr_cre_10 ='$vr_cre_10', vr_cre_11 ='$vr_cre_11', vr_cre_12 ='$vr_cre_12', vr_cre_13 ='$vr_cre_13', vr_cre_14 ='$vr_cre_14', vr_cre_15 ='$vr_cre_15', 
				tot_deb ='$tot_deb', tot_cre  ='$tot_cre', banco1  ='$banco1', banco2  ='$banco2', banco3  ='$banco3', banco4  ='$banco4',
				banco5  ='$banco5', banco6  ='$banco6', banco7  ='$banco7', banco8  ='$banco8', banco9  ='$banco9', banco10  ='$banco10', banco11  ='$banco11', banco12  ='$banco12', banco13  ='$banco13', banco14  ='$banco14', banco15  ='$banco15', cta1  ='$cta1', cta2  ='$cta2', cta3  ='$cta3', cta4  ='$cta4', cta5  ='$cta5', cta6  ='$cta6', cta7  ='$cta7', cta8  ='$cta8', cta9  ='$cta9', cta10  ='$cta10', cta11  ='$cta11', cta12  ='$cta12', cta13  ='$cta13', cta14  ='$cta14', cta15  ='$cta15', cheque1  ='$cheque_1', cheque2  ='$cheque_2', cheque3  ='$cheque_3', cheque4  ='$cheque_4', cheque5  ='$cheque_5', cheque6  ='$cheque_6', cheque7  ='$cheque_7', cheque8  ='$cheque_8', cheque9  ='$cheque_9', cheque10  ='$cheque_10', cheque11  ='$cheque_11', cheque12  ='$cheque_12', cheque13  ='$cheque_13', cheque14  ='$cheque_14', cheque15  ='$cheque_15'
				where id_auto_ncon ='$id_auto_ncon' ";
		
		$resultado = mysql_db_query($database, $sql, $connectionxx);

		printf("<br><br><center class='Estilo4'>EL REGISTRO HA SIDO ACTUALIZADO CON EXITO <BR><BR><BR><BR></center>");


}	
}	
}
}

printf("

<center class='Estilo4'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='TFIN'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");
?>


<?
}
?>