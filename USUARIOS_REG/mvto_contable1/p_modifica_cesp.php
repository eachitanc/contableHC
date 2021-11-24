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


$id_manu_ncon = 'CESP'.$_POST['id_manu_ncon']; //printf("%s<br>",$id_manu_ncon);
$id_auto_ncon = $_POST['id_auto_ncon'];//printf("%s<br>",$id_auto_ncon);
$fecha_ncon = $_POST['fecha_ncon'];//printf("%s<br>",$fecha_ncon);
$des_ncon = $_POST['des_ncon'];//printf("%s<br>",$des_ncon);
$tercero = $_POST['tercero'];

$forma_pago = $_POST['forma_pago'];
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
$banco15 = $_POST['banco15'];
$banco16 = $_POST['banco16'];
$banco17 = $_POST['banco17'];
$banco18 = $_POST['banco18'];
$banco19 = $_POST['banco19'];
$banco20= $_POST['banco20'];
$banco21 = $_POST['banco21'];
$banco22 = $_POST['banco22'];
$banco23 = $_POST['banco23'];
$banco24 = $_POST['banco24'];
$banco25 = $_POST['banco25'];
$banco26 = $_POST['banco26'];
$banco27 = $_POST['banco27'];
$banco28 = $_POST['banco28'];
$banco29 = $_POST['banco29'];
$banco30 = $_POST['banco30'];
$banco31 = $_POST['banco31'];
$banco32 = $_POST['banco32'];
$banco33 = $_POST['banco33'];
$banco34 = $_POST['banco34'];
$banco35 = $_POST['banco35'];
$banco35 = $_POST['banco36'];
$banco37 = $_POST['banco37'];
$banco38 = $_POST['banco38'];
$banco39 = $_POST['banco39'];
$banco40 = $_POST['banco40'];
$banco41 = $_POST['banco41'];
$banco42 = $_POST['banco42'];
$banco43 = $_POST['banco43'];
$banco44 = $_POST['banco44'];
$banco45 = $_POST['banco45'];
$banco46 = $_POST['banco46'];
$banco47 = $_POST['banco47'];
$banco48 = $_POST['banco48'];
$banco49 = $_POST['banco49'];
$banco50 = $_POST['banco50'];


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
$cheque_16 = $_POST['cheque_16'];
$cheque_17 = $_POST['cheque_17'];
$cheque_18 = $_POST['cheque_18'];
$cheque_19 = $_POST['cheque_19'];
$cheque_20 = $_POST['cheque_20'];
$cheque_21 = $_POST['cheque_21'];
$cheque_22 = $_POST['cheque_22'];
$cheque_23 = $_POST['cheque_23'];
$cheque_24 = $_POST['cheque_24'];
$cheque_25 = $_POST['cheque_25'];
$cheque_26 = $_POST['cheque_26'];
$cheque_27 = $_POST['cheque_27'];
$cheque_28 = $_POST['cheque_28'];
$cheque_29 = $_POST['cheque_29'];
$cheque_30 = $_POST['cheque_30'];
$cheque_31 = $_POST['cheque_31'];
$cheque_32 = $_POST['cheque_32'];
$cheque_33 = $_POST['cheque_33'];
$cheque_34 = $_POST['cheque_34'];
$cheque_35 = $_POST['cheque_35'];
$cheque_36 = $_POST['cheque_36'];
$cheque_37 = $_POST['cheque_37'];
$cheque_38 = $_POST['cheque_38'];
$cheque_39 = $_POST['cheque_39'];
$cheque_40 = $_POST['cheque_40'];
$cheque_41 = $_POST['cheque_41'];
$cheque_42 = $_POST['cheque_42'];
$cheque_43 = $_POST['cheque_43'];
$cheque_44 = $_POST['cheque_44'];
$cheque_45 = $_POST['cheque_45'];
$cheque_46 = $_POST['cheque_46'];
$cheque_47 = $_POST['cheque_47'];
$cheque_48 = $_POST['cheque_48'];
$cheque_49 = $_POST['cheque_49'];
$cheque_50 = $_POST['cheque_50'];

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
$vr_deb_15 = $_POST['vr_deb_15']+0;
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
$vr_cre_15 = $_POST['vr_cre_15']+0;
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
$ips = $_POST['ips'];
$terd=split("-",$_POST['tercero']);
$tercero = $terd[1];
$ter = $terd[0];//

$sqla = "select * from terceros_naturales where id_emp ='$id_emp' and num_id ='$ter'";
$resultadoa = mysql_db_query($database, $sqla, $connectionxx);

while($rowa = mysql_fetch_array($resultadoa)) 
{
  $pri_ape=$rowa["pri_ape"];
  $seg_ape=$rowa["seg_ape"];
  $pri_nom=$rowa["pri_nom"];
  $seg_nom=$rowa["seg_nom"];
}
$natural = $pri_ape." ".$seg_ape." ".$pri_nom." ".$seg_nom;
$nat_com = $natural;

//printf("natural : %s<br>",$natural);
//printf("nat com : %s<br>",$nat_com);

// consulta tercero jur
$sqla = "select * from terceros_juridicos where id_emp ='$id_emp' and num_id2  ='$ter'";
$resultadoa = mysql_db_query($database, $sqla, $connectionxx);

while($rowa = mysql_fetch_array($resultadoa)) 
{
  $raz_soc=$rowa["raz_soc2"];
}
//printf("raz soc : %s",$raz_soc);
//union de terceros

$tercero = $nat_com.$raz_soc;

echo $cheque_10;

$tot_deb = $vr_deb_1+$vr_deb_2+$vr_deb_3+$vr_deb_4+$vr_deb_5+$vr_deb_6+$vr_deb_7+$vr_deb_8+$vr_deb_9+$vr_deb_10+$vr_deb_11+$vr_deb_12+$vr_deb_13+$vr_deb_14+$vr_deb_15+$vr_deb_16+$vr_deb_17+$vr_deb_18+$vr_deb_19+$vr_deb_20+$vr_deb_21+$vr_deb_22+$vr_deb_23+$vr_deb_24+$vr_deb_25+$vr_deb_26+$vr_deb_27+$vr_deb_28+$vr_deb_29+$vr_deb_30+$vr_deb_31+$vr_deb_32+$vr_deb_33+$vr_deb_34+$vr_deb_35+$vr_deb_36+$vr_deb_37+$vr_deb_38+$vr_deb_39+$vr_deb_40+$vr_deb_41+$vr_deb_42+$vr_deb_43+$vr_deb_44+$vr_deb_45+$vr_deb_46+$vr_deb_47+$vr_deb_48+$vr_deb_49+$vr_deb_50;
$tot_cre = $vr_cre_1+$vr_cre_2+$vr_cre_3+$vr_cre_4+$vr_cre_5+$vr_cre_6+$vr_cre_7+$vr_cre_8+$vr_cre_9+$vr_cre_10+$vr_cre_11+$vr_cre_12+$vr_cre_13+$vr_cre_14+$vr_cre_15+$vr_cre_16+$vr_cre_17+$vr_cre_18+$vr_cre_19+$vr_cre_20+$vr_cre_21+$vr_cre_22+$vr_cre_23+$vr_cre_24+$vr_cre_25+$vr_cre_26+$vr_cre_27+$vr_cre_28+$vr_cre_29+$vr_cre_30+$vr_cre_31+$vr_cre_32+$vr_cre_33+$vr_cre_34+$vr_cre_35+$vr_cre_36+$vr_cre_37+$vr_cre_38+$vr_cre_39+$vr_cre_40+$vr_cre_41+$vr_cre_42+$vr_cre_43+$vr_cre_44+$vr_cre_45+$vr_cre_46+$vr_cre_47+$vr_cre_48+$vr_cre_49+$vr_cre_50;    

$tot_deb_a = number_format($tot_deb,2,',','.'); 
$tot_cre_a = number_format($tot_cre,2,',','.'); 

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
if ($fecha_ncon == '' or $id_manu_ncon == 'CESP')
{
	
	printf("<br><br><center class='Estilo4'><b>NO</b> debe dejar casillas del Documento sin diligenciar<BR><BR>Verifique Fecha y/o No. CESP<br><br></center> ");
	
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
		

		$sql = "update conta_cesp set 	
				id_manu_ncon='$id_manu_ncon',  fecha_ncon ='$fecha_ncon',  des_ncon ='$des_ncon',tercero='$tercero',	
				pgcp1 ='$pgcp1', pgcp2 ='$pgcp2', pgcp3 ='$pgcp3', pgcp4 ='$pgcp4', pgcp5 ='$pgcp5', pgcp6 ='$pgcp6', pgcp7 ='$pgcp7', pgcp8 ='$pgcp8', 
				pgcp9 ='$pgcp9', pgcp10 ='$pgcp10', pgcp11 ='$pgcp11', 	pgcp12 ='$pgcp12', pgcp13 ='$pgcp13', pgcp14 ='$pgcp14', pgcp15 ='$pgcp15',  pgcp16 ='$pgcp16', pgcp17 ='$pgcp17', pgcp18 ='$pgcp18', pgcp19 ='$pgcp19', pgcp20 ='$pgcp20', pgcp21 ='$pgcp21', pgcp22 ='$pgcp22', pgcp23 ='$pgcp23', pgcp24 ='$pgcp24', pgcp25 ='$pgcp25', pgcp26 ='$pgcp26', pgcp27 ='$pgcp27', pgcp28 ='$pgcp28', pgcp29 ='$pgcp29', pgcp30 ='$pgcp30', pgcp31 ='$pgcp31', pgcp32 ='$pgcp32', pgcp33 ='$pgcp33', pgcp34 ='$pgcp34', pgcp35 ='$pgcp35', pgcp36 ='$pgcp36', pgcp37 ='$pgcp37', pgcp38 ='$pgcp38', pgcp39 ='$pgcp39', pgcp40 ='$pgcp40', pgcp41 ='$pgcp41', pgcp42 ='$pgcp42', pgcp43 ='$pgcp43', pgcp44 ='$pgcp44', pgcp45 ='$pgcp45', pgcp46 ='$pgcp46', pgcp47 ='$pgcp47', pgcp48 ='$pgcp48', pgcp49 ='$pgcp49', pgcp50 ='$pgcp50',
				vr_deb_1 ='$vr_deb_1', vr_deb_2 ='$vr_deb_2', vr_deb_3 ='$vr_deb_3', vr_deb_4 ='$vr_deb_4', vr_deb_5 ='$vr_deb_5', vr_deb_6 ='$vr_deb_6', vr_deb_7 ='$vr_deb_7', vr_deb_8 ='$vr_deb_8', vr_deb_9 ='$vr_deb_9', vr_deb_10 ='$vr_deb_10', vr_deb_11 ='$vr_deb_11', vr_deb_12 ='$vr_deb_12', vr_deb_13 ='$vr_deb_13', vr_deb_14 ='$vr_deb_14', vr_deb_15 ='$vr_deb_15',  vr_deb_15 ='$vr_deb_15', vr_deb_16 ='$vr_deb_16', vr_deb_17 ='$vr_deb_17', vr_deb_18 ='$vr_deb_18', vr_deb_19 ='$vr_deb_19', vr_deb_20 ='$vr_deb_20', vr_deb_21 ='$vr_deb_21', vr_deb_22 ='$vr_deb_22', vr_deb_23 ='$vr_deb_23', vr_deb_24 ='$vr_deb_24', vr_deb_25 ='$vr_deb_25', vr_deb_26 ='$vr_deb_26', vr_deb_27 ='$vr_deb_27', vr_deb_28 ='$vr_deb_28', vr_deb_29 ='$vr_deb_29', vr_deb_30 ='$vr_deb_30', vr_deb_31 ='$vr_deb_31', vr_deb_32 ='$vr_deb_32', vr_deb_33 ='$vr_deb_33', vr_deb_34 ='$vr_deb_34', vr_deb_35 ='$vr_deb_35', vr_deb_36 ='$vr_deb_36', vr_deb_37 ='$vr_deb_37', vr_deb_38 ='$vr_deb_38', vr_deb_39 ='$vr_deb_39', vr_deb_40 ='$vr_deb_40', vr_deb_41 ='$vr_deb_41', vr_deb_42 ='$vr_deb_42', vr_deb_43 ='$vr_deb_43', vr_deb_44 ='$vr_deb_44', vr_deb_45 ='$vr_deb_45', vr_deb_46 ='$vr_deb_46', vr_deb_47 ='$vr_deb_47', vr_deb_48 ='$vr_deb_48', vr_deb_49 ='$vr_deb_49', vr_deb_50 ='$vr_deb_50', 
				vr_cre_1 ='$vr_cre_1', vr_cre_2 ='$vr_cre_2', vr_cre_3 ='$vr_cre_3', vr_cre_4 ='$vr_cre_4', vr_cre_5 ='$vr_cre_5', vr_cre_6 ='$vr_cre_6', 
				vr_cre_7 ='$vr_cre_7', vr_cre_8 ='$vr_cre_8', vr_cre_9 ='$vr_cre_9', 
				vr_cre_10 ='$vr_cre_10', vr_cre_11 ='$vr_cre_11', vr_cre_12 ='$vr_cre_12', vr_cre_13 ='$vr_cre_13', vr_cre_14 ='$vr_cre_14', vr_cre_15 ='$vr_cre_15', vr_cre_16 ='$vr_cre_16', vr_cre_17 ='$vr_cre_17', vr_cre_18 ='$vr_cre_18', vr_cre_19 ='$vr_cre_19', vr_cre_20 ='$vr_cre_20', vr_cre_21 ='$vr_cre_21', vr_cre_22 ='$vr_cre_22', vr_cre_23 ='$vr_cre_23', vr_cre_24 ='$vr_cre_24', vr_cre_25 ='$vr_cre_25', vr_cre_26 ='$vr_cre_26', vr_cre_27 ='$vr_cre_27', vr_cre_28 ='$vr_cre_28', vr_cre_29 ='$vr_cre_29', vr_cre_30 ='$vr_cre_30', vr_cre_31 ='$vr_cre_31', vr_cre_32 ='$vr_cre_32', vr_cre_33 ='$vr_cre_33', vr_cre_34 ='$vr_cre_34', vr_cre_35 ='$vr_cre_35', vr_cre_36 ='$vr_cre_36', vr_cre_37 ='$vr_cre_37', vr_cre_38 ='$vr_cre_38', vr_cre_39 ='$vr_cre_39', vr_cre_40 ='$vr_cre_40', vr_cre_41 ='$vr_cre_41', vr_cre_42 ='$vr_cre_42', vr_cre_43 ='$vr_cre_43', vr_cre_44 ='$vr_cre_44', vr_cre_45 ='$vr_cre_45', vr_cre_46 ='$vr_cre_46', vr_cre_47 ='$vr_cre_47', vr_cre_48 ='$vr_cre_48', vr_cre_49 ='$vr_cre_49', vr_cre_50 ='$vr_cre_50', 
				tot_deb ='$tot_deb', tot_cre  ='$tot_cre', forma_pago  ='$forma_pago', banco1  ='$banco1', banco2  ='$banco2', banco3  ='$banco3', banco4  ='$banco4',
				banco5  ='$banco5', banco6  ='$banco6', banco7  ='$banco7', banco8  ='$banco8', banco9  ='$banco9', banco10  ='$banco10', banco11  ='$banco11', banco12  ='$banco12', banco13  ='$banco13', banco14  ='$banco14', banco15  ='$banco15', banco16  ='$banco16', banco17  ='$banco17',  banco18  ='$banco18', banco19  ='$banco19', banco20  ='$banco20', banco21  ='$banco21',banco22  ='$banco22', banco23  ='$banco23',  banco24  ='$banco24', banco25  ='$banco25', banco26  ='$banco26', banco27  ='$banco27', banco28  ='$banco28', banco29  ='$banco29', banco30  ='$banco30', banco31  ='$banco31', banco32  ='$banco32', banco33  ='$banco33', banco34  ='$banco34', banco35  ='$banco35', banco36  ='$banco36', banco37 ='$banco37', banco38  ='$banco38', banco39  ='$banco39', banco40  ='$banco40', banco41  ='$banco41', banco42  ='$banco42', banco43 ='$banco43', banco44  ='$banco44',banco45  ='$banco45',  banco46  ='$banco46', banco47  ='$banco47', banco48  ='$banco48',banco49  ='$banco49',banco50  ='$banco50',   
				cta1  ='$cta1', cta2  ='$cta2', cta3  ='$cta3', cta4  ='$cta4', cta5  ='$cta5', cta6  ='$cta6', cta7  ='$cta7', cta8  ='$cta8', cta9  ='$cta9', cta10  ='$cta10', cta11  ='$cta11', cta12  ='$cta12', cta13  ='$cta13', cta14  ='$cta14', cta15  ='$cta15', 
				cheque1  ='$cheque_1', cheque2  ='$cheque_2', cheque3  ='$cheque_3', cheque4  ='$cheque_4', cheque5  ='$cheque_5', cheque6  ='$cheque_6', cheque7  ='$cheque_7', cheque8  ='$cheque_8', cheque9  ='$cheque_9', cheque10  ='$cheque_10', cheque11  ='$cheque_11', cheque12  ='$cheque_12', cheque13  ='$cheque_13', cheque14  ='$cheque_14', cheque15  ='$cheque_15',cheque16  ='$cheque_16',cheque17  ='$cheque_17',cheque18  ='$cheque_18',cheque19  ='$cheque_19',cheque20  ='$cheque_20',cheque21  ='$cheque_21',cheque22  ='$cheque_22',cheque23  ='$cheque_23',cheque24  ='$cheque_24',cheque25  ='$cheque_25',cheque26  ='$cheque_26',cheque27  ='$cheque_27',cheque28  ='$cheque_28',cheque29  ='$cheque_29',cheque30='$cheque_30',cheque31='$cheque_31',cheque32='$cheque_32',cheque33='$cheque_33',cheque34='$cheque_34',cheque35='$cheque_35',cheque36='$cheque_36',cheque37='$cheque_37',cheque38='$cheque_38',cheque39='$cheque_39',cheque40='$cheque_40',cheque41='$cheque_41',cheque42='$cheque_42',cheque43='$cheque_43',cheque44='$cheque_44',cheque45='$cheque_45',cheque46='$cheque_46',cheque47='$cheque_47',cheque48='$cheque_48',cheque49='$cheque_49',cheque50='$cheque_50'
				, ips='$ips',ccnit ='$ter'
				where id_auto_ncon ='$id_auto_ncon' ";
		$resultado = mysql_db_query($database, $sql, $connectionxx);

		printf("<br><br><center class='Estilo4'>EL REGISTRO HA SIDO ACTUALIZADO CON EXITO... <BR><BR><BR><BR></center>");


}	
}	
}
}

printf("

<center class='Estilo4'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='CESP'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");
?>


<?
}
?>