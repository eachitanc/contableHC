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
  $idxx=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
}

// campos control
$id_auto_obcg = $_POST['id_auto_obcg']; //printf("id_auto_obcg : %s<br>",$id_auto_obcg);

$id_auto_cobp = $_POST['id_auto_cobp']; //printf("id auto cdpp : %s<br>",$id_auto_cdpp);
$fecha_cobp = $_POST['fecha_cobp'];
$total = $_POST['total'];

//campos modificar

$fecha_obcg = $_POST['fecha_obcg']; //printf("fecha crpp : %s<br>",$fecha_crpp);
$id_manu_obcg = 'OBCG'.$_POST['id_manu_obcg']; //printf("id manu crpp : %s<br>",$id_manu_crpp);
$concepto_obcg= $_POST['concepto_obcg'];
$referencia_obcg = $_POST['referencia_obcg'];
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
$pgcp16 = $_POST['pgcp16'];
$pgcp17 = $_POST['pgcp17'];
$pgcp18 = $_POST['pgcp18'];
$pgcp19 = $_POST['pgcp19'];
$pgcp20 = $_POST['pgcp20'];
$pgcp21 = $_POST['pgcp21'];
$pgcp22 = $_POST['pgcp22'];
$pgcp23 = $_POST['pgcp23'];
$pgcp24 = $_POST['pgcp24'];
$pgcp25 = $_POST['pgcp25'];
$pgcp26 = $_POST['pgcp26'];
$pgcp27 = $_POST['pgcp27'];
$pgcp28 = $_POST['pgcp28'];
$pgcp29 = $_POST['pgcp29'];
$pgcp30 = $_POST['pgcp30'];
$pgcp31 = $_POST['pgcp31'];
$pgcp32 = $_POST['pgcp32'];
$pgcp33 = $_POST['pgcp33'];
$pgcp34 = $_POST['pgcp34'];
$pgcp35 = $_POST['pgcp35'];
$pgcp36 = $_POST['pgcp36'];
$pgcp37 = $_POST['pgcp37'];
$pgcp38 = $_POST['pgcp38'];
$pgcp39 = $_POST['pgcp39'];
$pgcp40 = $_POST['pgcp40'];
$pgcp41 = $_POST['pgcp41'];
$pgcp42 = $_POST['pgcp42'];
$pgcp43 = $_POST['pgcp43'];
$pgcp44 = $_POST['pgcp44'];
$pgcp45 = $_POST['pgcp45'];
$pgcp46 = $_POST['pgcp46'];
$pgcp47 = $_POST['pgcp47'];
$pgcp48 = $_POST['pgcp48'];
$pgcp49 = $_POST['pgcp49'];
$pgcp50 = $_POST['pgcp50'];

$des1 = $_POST['des1'];
$des2 = $_POST['des2'];
$des3 = $_POST['des3'];
$des4 = $_POST['des4'];
$des5 = $_POST['des5'];
$des6 = $_POST['des6'];
$des7 = $_POST['des7'];
$des8 = $_POST['des8'];
$des9 = $_POST['des9'];
$des10 = $_POST['des10'];
$des11 = $_POST['des11'];
$des12 = $_POST['des12'];
$des13 = $_POST['des13'];
$des14 = $_POST['des14'];
$des15 = $_POST['des15'];

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
$vr_deb_16 = $_POST['vr_deb_16']+0;
$vr_deb_17 = $_POST['vr_deb_17']+0;
$vr_deb_18 = $_POST['vr_deb_18']+0;
$vr_deb_19 = $_POST['vr_deb_19']+0;
$vr_deb_20 = $_POST['vr_deb_20']+0;
$vr_deb_21 = $_POST['vr_deb_21']+0;
$vr_deb_22 = $_POST['vr_deb_22']+0;
$vr_deb_23 = $_POST['vr_deb_23']+0;
$vr_deb_24 = $_POST['vr_deb_24']+0;
$vr_deb_25 = $_POST['vr_deb_25']+0;
$vr_deb_26 = $_POST['vr_deb_26']+0;
$vr_deb_27 = $_POST['vr_deb_27']+0;
$vr_deb_28 = $_POST['vr_deb_28']+0;
$vr_deb_29 = $_POST['vr_deb_29']+0;
$vr_deb_30 = $_POST['vr_deb_30']+0;
$vr_deb_31 = $_POST['vr_deb_31']+0;
$vr_deb_32 = $_POST['vr_deb_32']+0;
$vr_deb_33 = $_POST['vr_deb_33']+0;
$vr_deb_34 = $_POST['vr_deb_34']+0;
$vr_deb_35 = $_POST['vr_deb_35']+0;
$vr_deb_36 = $_POST['vr_deb_36']+0;
$vr_deb_37 = $_POST['vr_deb_37']+0;
$vr_deb_38 = $_POST['vr_deb_38']+0;
$vr_deb_39 = $_POST['vr_deb_39']+0;
$vr_deb_40 = $_POST['vr_deb_40']+0;
$vr_deb_41 = $_POST['vr_deb_41']+0;
$vr_deb_42 = $_POST['vr_deb_42']+0;
$vr_deb_43 = $_POST['vr_deb_43']+0;
$vr_deb_44 = $_POST['vr_deb_44']+0;
$vr_deb_45 = $_POST['vr_deb_45']+0;
$vr_deb_46 = $_POST['vr_deb_46']+0;
$vr_deb_47 = $_POST['vr_deb_47']+0;
$vr_deb_48 = $_POST['vr_deb_48']+0;
$vr_deb_49 = $_POST['vr_deb_49']+0;
$vr_deb_50 = $_POST['vr_deb_50']+0;

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
$vr_cre_16 = $_POST['vr_cre_16']+0;
$vr_cre_17 = $_POST['vr_cre_17']+0;
$vr_cre_18 = $_POST['vr_cre_18']+0;
$vr_cre_19 = $_POST['vr_cre_19']+0;
$vr_cre_20 = $_POST['vr_cre_20']+0;
$vr_cre_21 = $_POST['vr_cre_21']+0;
$vr_cre_22 = $_POST['vr_cre_22']+0;
$vr_cre_23 = $_POST['vr_cre_23']+0;
$vr_cre_24 = $_POST['vr_cre_24']+0;
$vr_cre_25 = $_POST['vr_cre_25']+0;
$vr_cre_26 = $_POST['vr_cre_26']+0;
$vr_cre_27 = $_POST['vr_cre_27']+0;
$vr_cre_28 = $_POST['vr_cre_28']+0;
$vr_cre_29 = $_POST['vr_cre_29']+0;
$vr_cre_30 = $_POST['vr_cre_30']+0;
$vr_cre_31 = $_POST['vr_cre_31']+0;
$vr_cre_32 = $_POST['vr_cre_32']+0;
$vr_cre_33 = $_POST['vr_cre_33']+0;
$vr_cre_34 = $_POST['vr_cre_34']+0;
$vr_cre_35 = $_POST['vr_cre_35']+0;
$vr_cre_36 = $_POST['vr_cre_36']+0;
$vr_cre_37 = $_POST['vr_cre_37']+0;
$vr_cre_38 = $_POST['vr_cre_38']+0;
$vr_cre_39 = $_POST['vr_cre_39']+0;
$vr_cre_40 = $_POST['vr_cre_40']+0;
$vr_cre_41 = $_POST['vr_cre_41']+0;
$vr_cre_42 = $_POST['vr_cre_42']+0;
$vr_cre_43 = $_POST['vr_cre_43']+0;
$vr_cre_44 = $_POST['vr_cre_44']+0;
$vr_cre_45 = $_POST['vr_cre_45']+0;
$vr_cre_46 = $_POST['vr_cre_46']+0;
$vr_cre_47 = $_POST['vr_cre_47']+0;
$vr_cre_48 = $_POST['vr_cre_48']+0;
$vr_cre_49 = $_POST['vr_cre_49']+0;
$vr_cre_50 = $_POST['vr_cre_50']+0;

$tot_deb = $vr_deb_1+$vr_deb_2+$vr_deb_3+$vr_deb_4+$vr_deb_5+$vr_deb_6+$vr_deb_7+$vr_deb_8+$vr_deb_9+$vr_deb_10+$vr_deb_11+$vr_deb_12+$vr_deb_13+$vr_deb_14+$vr_deb_15+$vr_deb_16+$vr_deb_17+$vr_deb_18+$vr_deb_19+$vr_deb_20+$vr_deb_21+$vr_deb_22+$vr_deb_23+$vr_deb_24+$vr_deb_25+$vr_deb_26+$vr_deb_27+$vr_deb_28+$vr_deb_29+$vr_deb_30+$vr_deb_31+$vr_deb_32+$vr_deb_33+$vr_deb_34+$vr_deb_35+$vr_deb_36+$vr_deb_37+$vr_deb_38+$vr_deb_39+$vr_deb_40+$vr_deb_41+$vr_deb_42+$vr_deb_43+$vr_deb_44+$vr_deb_45+$vr_deb_46+$vr_deb_47+$vr_deb_48+$vr_deb_49+$vr_deb_50;
$tot_cre = $vr_cre_1+$vr_cre_2+$vr_cre_3+$vr_cre_4+$vr_cre_5+$vr_cre_6+$vr_cre_7+$vr_cre_8+$vr_cre_9+$vr_cre_10+$vr_cre_11+$vr_cre_12+$vr_cre_13+$vr_cre_14+$vr_cre_15+$vr_cre_16+$vr_cre_17+$vr_cre_18+$vr_cre_19+$vr_cre_20+$vr_cre_21+$vr_cre_22+$vr_cre_23+$vr_cre_24+$vr_cre_25+$vr_cre_26+$vr_cre_27+$vr_cre_28+$vr_cre_29+$vr_cre_30+$vr_cre_31+$vr_cre_32+$vr_cre_33+$vr_cre_34+$vr_cre_35+$vr_cre_36+$vr_cre_37+$vr_cre_38+$vr_cre_39+$vr_cre_40+$vr_cre_41+$vr_cre_42+$vr_cre_43+$vr_cre_44+$vr_cre_45+$vr_cre_46+$vr_cre_47+$vr_cre_48+$vr_cre_49+$vr_cre_50;    



$tot_deb_a = number_format($tot_deb,2,',','.'); 
$tot_cre_a = number_format($tot_cre,2,',','.'); 

// vigencia fiscal
 
$consultax=mysql_query("select * from vf ",$connectionxx);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
} 

// tipo de dato de los pgcp
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

if ($fecha_obcg == '' or $id_manu_obcg == 'OBCG')
{
	
	printf("<br><br><center class='Estilo9'><b>NO</b> debe dejar casillas de la Obligacion Contable del Gasto sin diligenciar<BR><BR>Verifique Fecha y No. OBCG<br><br></center>");
	
}
else
{

if (($tipa =='M')or($tipb =='M')or($tipc =='M')or($tipd =='M')or($tipe =='M')or($tipf =='M')or($tipg =='M')or($tiph =='M')or($tipi =='M')or($tipj =='M')or($tipk =='M')or($tipl =='M')or($tipm =='M')or($tipn =='M')or($tipo =='M'))
{
printf("<br><br><center class='Estilo9'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br></center>");

}
else
{
/*if(($total != $tot_deb) or ($total != $tot_cre))
{
printf("<br><br><center class='Estilo9'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb." :::...) y Credito (...::: ".$tot_cre." :::...) de la Obligacion Contable <br><br><b>NO COINCIDEN</b> con el valor de la <b>OBLIGACION</b><BR><BR>Debe volver a realizar la causacion <b>VERIFICANDO</b> previamente su informacion<br><br><br></center>");

}
else
{*/


	if($fecha_obcg > $bx or $fecha_obcg < $ax)
	{
	printf("<br><br><center class='Estilo9'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR></center>");

	}
	else
	{ 
		if($fecha_obcg < $fecha_cobp)
		{
		printf("<br><br><center class='Estilo9'>la Fecha de la Obligacion Contable <b>NO</b> debe ser <B>MENOR</B> a la fecha del Certificadode Obligacion Presupuestal<BR><BR>Debe volver a realizar la 
		causacion <b>VERIFICANDO</b> previamente su informacion<br><br><BR><BR></center>");

		}
		else
		{ 
				
		
									$sql2 = "update obcg set 
									fecha_obcg = '$fecha_obcg' ,id_manu_obcg = '$id_manu_obcg' ,concepto_obcg = '$concepto_obcg' ,referencia_obcg = '$referencia_obcg' ,tot_cre = '$tot_cre' ,tot_deb = '$tot_deb' , 
               						 pgcp1 ='$pgcp1', pgcp2 ='$pgcp2', pgcp3 ='$pgcp3', pgcp4 ='$pgcp4', pgcp5 ='$pgcp5', pgcp6 ='$pgcp6', pgcp7 ='$pgcp7', pgcp8 ='$pgcp8', 
               						 pgcp9 ='$pgcp9', pgcp10 ='$pgcp10', pgcp11 ='$pgcp11', 
               						 pgcp12 ='$pgcp12', pgcp13 ='$pgcp13', pgcp14 ='$pgcp14', pgcp15 ='$pgcp15', pgcp16 ='$pgcp16', pgcp17 ='$pgcp17', pgcp18 ='$pgcp18', pgcp19 ='$pgcp19', pgcp20 ='$pgcp20', pgcp21 ='$pgcp21', pgcp22 ='$pgcp22', pgcp23 ='$pgcp23', pgcp24 ='$pgcp24', pgcp25 ='$pgcp25', pgcp26 ='$pgcp26', pgcp27 ='$pgcp27', pgcp28 ='$pgcp28', pgcp29 ='$pgcp29', pgcp30 ='$pgcp30', pgcp31 ='$pgcp31', pgcp32 ='$pgcp32', pgcp33 ='$pgcp33', pgcp34 ='$pgcp34', pgcp35 ='$pgcp35', pgcp36 ='$pgcp36', pgcp37 ='$pgcp37', pgcp38 ='$pgcp38', pgcp39 ='$pgcp39', pgcp40 ='$pgcp40', pgcp41 ='$pgcp41', pgcp42 ='$pgcp42', pgcp43 ='$pgcp43', pgcp44 ='$pgcp44', pgcp45 ='$pgcp45', pgcp46 ='$pgcp46', pgcp47 ='$pgcp47', pgcp48 ='$pgcp48', pgcp49 ='$pgcp49', pgcp50 ='$pgcp50',
									vr_deb_1 ='$vr_deb_1', vr_deb_2 ='$vr_deb_2', vr_deb_3 ='$vr_deb_3', vr_deb_4 ='$vr_deb_4', vr_deb_5 ='$vr_deb_5', vr_deb_6 ='$vr_deb_6', 
									vr_deb_7 ='$vr_deb_7', vr_deb_8 ='$vr_deb_8', vr_deb_9 ='$vr_deb_9', 
		vr_deb_10 ='$vr_deb_10', vr_deb_11 ='$vr_deb_11', vr_deb_12 ='$vr_deb_12', vr_deb_13 ='$vr_deb_13', vr_deb_14 ='$vr_deb_14', vr_deb_15 ='$vr_deb_15', vr_deb_16 ='$vr_deb_16', vr_deb_17 ='$vr_deb_17', vr_deb_18 ='$vr_deb_18', vr_deb_19 ='$vr_deb_19', vr_deb_20 ='$vr_deb_20', vr_deb_21 ='$vr_deb_21', vr_deb_22 ='$vr_deb_22', vr_deb_23 ='$vr_deb_23', vr_deb_24 ='$vr_deb_24', vr_deb_25 ='$vr_deb_25', vr_deb_26 ='$vr_deb_26', vr_deb_27 ='$vr_deb_27', vr_deb_28 ='$vr_deb_28', vr_deb_29 ='$vr_deb_29', vr_deb_30 ='$vr_deb_30', vr_deb_31 ='$vr_deb_31', vr_deb_32 ='$vr_deb_32', vr_deb_33 ='$vr_deb_33', vr_deb_34 ='$vr_deb_34', vr_deb_35 ='$vr_deb_35', vr_deb_36 ='$vr_deb_36', vr_deb_37 ='$vr_deb_37', vr_deb_38 ='$vr_deb_38', vr_deb_39 ='$vr_deb_39', vr_deb_40 ='$vr_deb_40', vr_deb_41 ='$vr_deb_41', vr_deb_42 ='$vr_deb_42', vr_deb_43 ='$vr_deb_43', vr_deb_44 ='$vr_deb_44', vr_deb_45 ='$vr_deb_45', vr_deb_46 ='$vr_deb_46', vr_deb_47 ='$vr_deb_47', vr_deb_48 ='$vr_deb_48', vr_deb_49 ='$vr_deb_49', vr_deb_50 ='$vr_deb_50', 
		                vr_cre_1 ='$vr_cre_1', vr_cre_2 ='$vr_cre_2', vr_cre_3 ='$vr_cre_3', vr_cre_4 ='$vr_cre_4', vr_cre_5 ='$vr_cre_5', vr_cre_6 ='$vr_cre_6', 
                vr_cre_7 ='$vr_cre_7', vr_cre_8 ='$vr_cre_8', vr_cre_9 ='$vr_cre_9', 
                vr_cre_10 ='$vr_cre_10', vr_cre_11 ='$vr_cre_11', vr_cre_12 ='$vr_cre_12', vr_cre_13 ='$vr_cre_13', vr_cre_14 ='$vr_cre_14', vr_cre_15 ='$vr_cre_15', vr_cre_16 ='$vr_cre_16', vr_cre_17 ='$vr_cre_17', vr_cre_18 ='$vr_cre_18', vr_cre_19 ='$vr_cre_19', vr_cre_20 ='$vr_cre_20', vr_cre_21 ='$vr_cre_21', vr_cre_22 ='$vr_cre_22', vr_cre_23 ='$vr_cre_23', vr_cre_24 ='$vr_cre_24', vr_cre_25 ='$vr_cre_25', vr_cre_26 ='$vr_cre_26', vr_cre_27 ='$vr_cre_27', vr_cre_28 ='$vr_cre_28', vr_cre_29 ='$vr_cre_29', vr_cre_30 ='$vr_cre_30', vr_cre_31 ='$vr_cre_31', vr_cre_32 ='$vr_cre_32', vr_cre_33 ='$vr_cre_33', vr_cre_34 ='$vr_cre_34', vr_cre_35 ='$vr_cre_35', vr_cre_36 ='$vr_cre_36', vr_cre_37 ='$vr_cre_37', vr_cre_38 ='$vr_cre_38', vr_cre_39 ='$vr_cre_39', vr_cre_40 ='$vr_cre_40', vr_cre_41 ='$vr_cre_41', vr_cre_42 ='$vr_cre_42', vr_cre_43 ='$vr_cre_43', vr_cre_44 ='$vr_cre_44', vr_cre_45 ='$vr_cre_45', vr_cre_46 ='$vr_cre_46', vr_cre_47 ='$vr_cre_47', vr_cre_48 ='$vr_cre_48', vr_cre_49 ='$vr_cre_49', vr_cre_50 ='$vr_cre_50'

								    where id_emp = '$id_emp' and id_auto_obcg = '$id_auto_obcg' ";
									$resultado2 = mysql_db_query($database, $sql2, $connectionxx);

									
		
		
									printf("<br><br><center class='Estilo9'>OBCG MODIFICADO CON EXITO<BR><BR>");

		
		
}
}	
//}	
}
}


printf("

<center class='Estilo9'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='OBCG'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");

?>


<?
}
?>