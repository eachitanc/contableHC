<?
session_start();
if(!$_SESSION["login"])
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
///*****guia original
//********** primera llegada para validacion
$fecha_cecp = $_POST['fecha_cecpp'];
$id_manu_cecp = $_POST['id_manu_cecp'];

$nt = $_POST['nombre_tercero'];
$rt = $_POST['regimen_tercero'];
$cn = $_POST['ccnit'];
$concepto_pago = $_POST['concepto_pago'];
$cuenta_cxp = $_POST['cuenta_cxp'];
$iva = $_POST['iva']; 
//$vr_tot_obli_con_iva = $_POST['vr_tot_obli_con_iva']; 
//$saldo_vr_tot_obli_con_iva = $_POST['saldo_vr_tot_obli_con_iva']; 
$vr_obli_para_pago_mas_iva = $_POST['vr_obli_para_pago_mas_iva']; 
$forma_pago = $_POST['forma_pago']; 
$total_pagado = $_POST['total_pagado'];

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
{  $tipo=$rowo["tip_dato"];
}

if($fecha_cecp > $bx or $fecha_cecp < $ax)
{
		
		// envio de datos para correccion
		printf("<form name='a' method='POST'>");
		printf("<br><br><center class='Estilo9'><b>VERIFIQUE</b> <br><br>Que alguna de las siguientes casillas no esten en <b>BLANCO</b>: <br><BR>");
		printf("Fecha CECP, Numero CECP, Nombre / Regimen / C.C. - NIT del Tercero, Concepto de Pago,<BR>");
		printf("Rubro Pptal CxP, datos del Compromiso Vigencia Anterior, Forma de Pago<BR><br>");
		printf("<b>VERIFIQUE</b> Que la Fecha del CECP se encuentre dentro de la Vigencia Fiscal Actual<br><br>");	
		printf("<b>VERIFIQUE</b> que el Total Debito y el Total Credito no sean iguales 0 y que las sumas sean iguales<br><br></center><br><br>");	
		
		printf("
		<center>
		<input type='submit' class='Estilo9' value='Corregir' onclick=\"this.form.action = 'nuevo_cecp.php'\"/>
		</center>
		</form>
		");

///**********************
}
else
{
// grabacion
 
$id_auto_cecp = $_POST['id_cp']; 
$id_manu_cecp = 'CECP'.$_POST['id_manu_cecp']; //ok
$fecha_cecp = $_POST['fecha_cecpp'];
$ter_nat =$_POST['ter_nat']; 
$ter_jur =$_POST['ter_jur']; 
if ($ter_nat)
{
$sql4 = "select * from terceros_naturales where id='$ter_nat' and id_emp='$id_emp' ";
					$resultado4 = mysql_db_query($database, $sql4, $connectionxx);
					
					while($row4 = mysql_fetch_array($resultado4)) 
					{
					  $pri_ape=$row4["pri_ape"];
					  $seg_ape=$row4["seg_ape"];
					  $pri_nom=$row4["pri_nom"];
					  $seg_nom=$row4["seg_nom"];
					  $regimen=$row4["regimen"];
					  $num_id=$row4["num_id"];
					  $id=$row4["id"];
					}
					$nt = $pri_ape." ".$seg_ape." ".$pri_nom." ".$seg_nom;
					$rt = $regimen;
					$cn = $num_id;
				
}
if ($ter_jur)
{
$sql5 = "select * from terceros_juridicos where id='$ter_jur' and id_emp='$id_emp' ";
					$resultado5 = mysql_db_query($database, $sql5, $connectionxx);
					
					while($row5 = mysql_fetch_array($resultado5)) 
					{
					  $raz_soc=$row5["raz_soc2"];
					  $regimen2=$row5["regimen2"];
					  $num_id2=$row5["num_id2"];
					  $id=$row5["id"];
					  
					}
					$rt=$regimen2;
					$nt=$raz_soc;
					$cn=$num_id2;
					
}
$concepto_pago = $_POST['concepto_pago']; 
$salud = $_POST['salud']; 
$pension = $_POST['pension']; 
$libranza = $_POST['libranza']; 
$f_solidaridad = $_POST['f_solidaridad']; 
$f_empleados = $_POST['f_empleados']; 
$sindicato = $_POST['sindicato']; 
$embargo = $_POST['embargo']; 
$cruce = $_POST['cruce']; 
$otros = $_POST['otros']; 
$retefuente = $_POST['retefuente']; 
$vr_retefuente = $_POST['vr_retefuente']; 
$reteiva = $_POST['reteiva']; 
$vr_reteiva = $_POST['vr_reteiva']; 
$reteica = $_POST['reteica']; 
$a_partir_reteica = $_POST['a_partir_reteica']; 
$tarifa_reteica = $_POST['tarifa_reteica']; 
$vr_reteica = $_POST['vr_reteica']; 
$estampilla1 = $_POST['estampilla1']; 
$vr_estampilla1 = $_POST['vr_estampilla1']; 
$estampilla2 = $_POST['estampilla2']; 
$vr_estampilla2 = $_POST['vr_estampilla2']; 
$estampilla3 = $_POST['estampilla3']; 
$vr_estampilla3 = $_POST['vr_estampilla3']; 
$estampilla4 = $_POST['estampilla4']; 
$vr_estampilla4 = $_POST['vr_estampilla4']; 
$estampilla5 = $_POST['estampilla5']; 
$vr_estampilla5= $_POST['vr_estampilla5']; 


$forma_pago = $_POST['forma_pago']; 
$concepto_dian = $_POST['codigo_dian']; 
$num_cheque = $_POST['num_cheque1']; //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque = $_POST['banco_cheque1']; //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque = $_POST['cta_cheque1']; //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque2 = $_POST['num_cheque2'];  //printf("<br>num_cheque2 : %s <br>",$num_cheque2);
$banco_cheque2 = $_POST['banco_cheque2'];  //printf("<br>banco_cheque2 : %s <br>",$banco_cheque2);
$cta_cheque2 = $_POST['cta_cheque2'];  //printf("<br>cta_cheque2 : %s <br>",$cta_cheque2);

$num_cheque3 = $_POST['num_cheque3'];  //printf("<br>num_cheque3 : %s <br>",$num_cheque3);
$banco_cheque3 = $_POST['banco_cheque3'];  //printf("<br>banco_cheque3 : %s <br>",$banco_cheque3);
$cta_cheque3 = $_POST['cta_cheque3'];  //printf("<br>cta_cheque3 : %s <br>",$cta_cheque3);

$num_cheque4 = $_POST['num_cheque4'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque4 = $_POST['banco_cheque4'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque4 = $_POST['cta_cheque4'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque5 = $_POST['num_cheque5'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque5 = $_POST['banco_cheque5'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque5 = $_POST['cta_cheque5'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque6 = $_POST['num_cheque6'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque6 = $_POST['banco_cheque6'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque6 = $_POST['cta_cheque6'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque7 = $_POST['num_cheque7'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque7 = $_POST['banco_cheque7'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque7 = $_POST['cta_cheque7'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque8 = $_POST['num_cheque8'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque8 = $_POST['banco_cheque8'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque8 = $_POST['cta_cheque8'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque9 = $_POST['num_cheque9'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque9 = $_POST['banco_cheque9'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque9 = $_POST['cta_cheque9'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque10 = $_POST['num_cheque10'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque10 = $_POST['banco_cheque10'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque10 = $_POST['cta_cheque10'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque11 = $_POST['num_cheque11'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque11 = $_POST['banco_cheque11'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque11 = $_POST['cta_cheque11'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque12 = $_POST['num_cheque12'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque12 = $_POST['banco_cheque12'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque12 = $_POST['cta_cheque12'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque13 = $_POST['num_cheque13'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque13 = $_POST['banco_cheque13'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque13 = $_POST['cta_cheque13'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque14 = $_POST['num_cheque14'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque14 = $_POST['banco_cheque14'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque14 = $_POST['cta_cheque14'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque15 = $_POST['num_cheque15'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque15 = $_POST['banco_cheque15'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque15 = $_POST['cta_cheque15'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);


$te = $_POST['te']; 
$total_pagado = $_POST['total_pagado']; //ok


	
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

$sql = "update cecp set   
									
id_emp='$id_emp', id_auto_cecp='$id_auto_cecp', id_manu_cecp='$id_manu_cecp', fecha_cecp='$fecha_cecp', nt='$nt', rt='$rt', cn='$cn', concepto_pago='$concepto_pago', cuenta_cxp='$cuenta_cxp',iva='$iva', 
vr_obli_para_pago_mas_iva='$vr_obli_para_pago_mas_iva' ,
salud='$salud', pension= '$pension', libranza='$libranza', f_solidaridad='$f_solidaridad', f_empleados='$f_empleados', sindicato='$sindicato', embargo='$embargo', cruce='$cruce', otros='$otros',
retefuente ='$retefuente' ,  vr_retefuente='$vr_retefuente', reteiva='$reteiva', vr_reteiva='$vr_reteiva', 
reteica='$reteica' , a_partir_reteica='$a_partir_reteica', tarifa_reteica='$tarifa_reteica', vr_reteica='$vr_reteica',
estampilla1='$estampilla1', vr_estampilla1='$vr_estampilla1', estampilla2='$estampilla2', vr_estampilla2='$vr_estampilla2', estampilla3='$estampilla3', vr_estampilla3='$vr_estampilla3', estampilla4='$estampilla4', vr_estampilla4='$vr_estampilla4', estampilla5='$estampilla5', vr_estampilla5='$vr_estampilla5', 
forma_pago='$forma_pago', concepto_dian='$concepto_dian', num_cheque='$num_cheque', banco_cheque='$banco_cheque', cta_cheque='$cta_cheque', te='$te', total_pagado= '$total_pagado', num_cheque2='$num_cheque2', banco_cheque2='$banco_cheque2', cta_cheque2='$cta_cheque2',num_cheque3='$num_cheque3', banco_cheque3='$banco_cheque3', cta_cheque3='$cta_cheque3',
num_cheque4='$num_cheque4', banco_cheque4='$banco_cheque4', cta_cheque4='$cta_cheque4',num_cheque5='$num_cheque5', banco_cheque5='$banco_cheque5', cta_cheque5='$cta_cheque5',num_cheque6='$num_cheque6', banco_cheque6='$banco_cheque6', cta_cheque6='$cta_cheque6',num_cheque7='$num_cheque7', banco_cheque7='$banco_cheque7', cta_cheque7='$cta_cheque7',
num_cheque8='$num_cheque8', banco_cheque8='$banco_cheque8', cta_cheque8='$cta_cheque8',num_cheque9='$num_cheque9', banco_cheque9='$banco_cheque9', cta_cheque9='$cta_cheque9',num_cheque10='$num_cheque10', banco_cheque10='$banco_cheque10', cta_cheque10='$cta_cheque10',num_cheque11='$num_cheque11', banco_cheque11='$banco_cheque11', cta_cheque11='$cta_cheque11',
num_cheque12='$num_cheque12', banco_cheque12='$banco_cheque12', cta_cheque12='$cta_cheque12',num_cheque13='$num_cheque13', banco_cheque13='$banco_cheque13', cta_cheque13='$cta_cheque13',num_cheque14='$num_cheque14', banco_cheque14='$banco_cheque14', cta_cheque14='$cta_cheque14',
num_cheque15='$num_cheque15', banco_cheque15='$banco_cheque15', cta_cheque15='$cta_cheque15',

pgcp1 ='$pgcp1', pgcp2 ='$pgcp2', pgcp3 ='$pgcp3', pgcp4 = '$pgcp4', pgcp5 ='$pgcp5', pgcp6 ='$pgcp6', pgcp7 ='$pgcp7', pgcp8 ='$pgcp8', pgcp9 ='$pgcp9', pgcp10 ='$pgcp10', pgcp11 ='$pgcp11' , pgcp12 ='$pgcp12', pgcp13 ='$pgcp13', pgcp14 ='$pgcp14', pgcp15 ='$pgcp15' , 
des1 ='$des1', des2 ='$des2', des3 ='$des3', des4 ='$des4', des5 ='$des5', des6 ='$des6', des7 ='$des7', des8 = '$des8', des9 ='$des9', des10 ='$des10', des11 ='$des11', des12 ='$des12', des13 ='$des13', des14 ='$des14', des15 ='$des15', 
vr_deb_1 ='$vr_deb_1' , vr_deb_2 ='$vr_deb_2', vr_deb_3 ='$vr_deb_3', vr_deb_4 ='$vr_deb_4' , vr_deb_5 ='$vr_deb_5', vr_deb_6 ='$vr_deb_6', vr_deb_7 ='$vr_deb_7', vr_deb_8 ='$vr_deb_8', vr_deb_9 = '$vr_deb_9' , 
vr_deb_10 ='$vr_deb_10', vr_deb_11 ='$vr_deb_11', vr_deb_12 ='$vr_deb_12', vr_deb_13 ='$vr_deb_13' , vr_deb_14 ='$vr_deb_14', vr_deb_15 ='$vr_deb_15', 
vr_cre_1 ='$vr_cre_1' , vr_cre_2 ='$vr_cre_2', vr_cre_3 ='$vr_cre_3',vr_cre_4 ='$vr_cre_4', vr_cre_5 ='$vr_cre_5', vr_cre_6 ='$vr_cre_6', vr_cre_7 ='$vr_cre_7', vr_cre_8 ='$vr_cre_8', vr_cre_9 ='$vr_cre_9', 
vr_cre_10 ='$vr_cre_10', vr_cre_11 ='$vr_cre_11', vr_cre_12 ='$vr_cre_12', vr_cre_13 ='$vr_cre_13', vr_cre_14 ='$vr_cre_14', vr_cre_15 ='$vr_cre_15', 
tot_deb='$tot_deb', tot_cre ='$tot_cre' where id_auto_cecp ='$id_auto_cecp'";
mysql_db_query($database, $sql, $connectionxx) or die(mysql_error());


// borro los datos guardados para remplazar con las modificaciones
$consulta = "DELETE  FROM cecp_cuenta WHERE id_auto_cecp = '$id_auto_cecp'";
$result = mysql_db_query($database, $consulta,$connectionxx);
// vuelvo a guardar los registros de acuerdo a las modificaciones realizadas por el usuario
$filas =$_POST["filas"];
$i=0;
for ($i=1;$i<=$filas;$i++)
{
$cuenta = $_POST['cuenta_cxp'.$i]; 
$valor =$_POST['valor_pto'.$i];
$idc=$_POST['idc'.$i];
		$sqx2 = "select id, id_auto_cecp from cecp_cuenta where id='$idc' and id_auto_cecp='$id_auto_cecp' and cuenta='$cuenta'";
		$rex2 = mysql_db_query($database, $sqx2, $connectionxx);
		$maxi = mysql_num_rows($rex2);
		if (empty($maxi))
		{
			$sql2 = "INSERT INTO cecp_cuenta (fecha_cecp,id_auto_cecp,id_manu_cecp,cuenta,valor) VALUES ('$fecha_cecp','$id_auto_cecp', '$id_manu_cecp','$cuenta','$valor')";
			mysql_query($sql2, $connectionxx) or die(mysql_error());
		}
		else
		{
			$sql = "update cecp_cuenta set fecha_cecp='$fecha_cecp',id_auto_cecp='$id_auto_cecp',id_manu_cecp='$id_manu_cecp',cuenta='$cuenta',valor= '$valor' where id ='$idc'";
			mysql_db_query($database, $sql, $connectionxx) or die(mysql_error());
		}
}
printf("<center class='Estilo9'><br><br>REGISTRO ALMACENADO CON EXITO2<br><br></center>");
printf("
<center class='Estilo4'>
<form method='post' action='pagos_tesoreria_cxp.php'>
<input type='hidden' name='nn' value='CECP'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");
}//fin else
}
?>