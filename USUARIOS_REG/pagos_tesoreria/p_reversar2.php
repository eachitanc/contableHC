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
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
	text-decoration: none;
	color:#00C;
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

include('../config.php');
// conexion				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// id_emp
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
  $idxx=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
}
$check=$_POST['chk_reversar']; // printf("<br>id_obcg : %s <br>",$check);
$id_obcg = $_POST['id_obcg']; // printf("<br>id_obcg : %s <br>",$id_obcg);
$fecha_ceva = $_POST['fecha_ceva']; printf("<br>fecha_ceva : %s <br>",$fecha_ceva);
$id_auto_ceva = 'CEVA'.$_POST['id_auto_ceva']; //printf("<br>id_auto_ceva : %s <br>",$id_auto_ceva);
$id_manu_ceva = 'CEVA'.$_POST['id_manu_ceva']; //printf("<br>id_oid_manu_cevabcg : %s <br>",$id_manu_ceva);
$id_auto_ceva2=$_POST['id_ceva'];//printf("<br>id_auto_ceva2 : %s <br>",$id_auto_ceva2);
$des_ceva = $_POST['des_ceva']; //printf("<br>des_ceva : %s <br>",$des_ceva);
$id_manu_crpp = $_POST['id_manu_crpp']; //printf("<br>id_manu_crpp : %s <br>",$id_manu_crpp);
$id_auto_crpp = $_POST['id_auto_crpp']; //printf("<br>id_auto_crpp : %s <br>",$id_auto_crpp);
$fecha_crpp = $_POST['fecha_crpp']; //printf("<br>fecha_crpp : %s <br>",$fecha_crpp);
$tercero = $_POST['tercero']; //printf("<br>tercero : %s <br>",$tercero);
$ccnit = $_POST['ccnit']; //printf("<br>ccnit : %s <br>",$ccnit);
$pago = $_POST['pago']; //printf("<br>pago : %s <br>",$pago);
$id_manu_cobp = $_POST['id_manu_cobp']; //printf("<br>id_manu_cobp : %s <br>",$id_manu_cobp);
$id_auto_cobp = $_POST['id_auto_cobp']; //printf("<br>id_auto_cobp : %s <br>",$id_auto_cobp); 
$fecha_cobp = $_POST['fecha_cobp']; //printf("<br>fecha_cobp : %s <br>",$fecha_cobp); 
$des_cobp = $_POST['des_cobp']; //printf("<br>des_cobp : %s <br>",$des_cobp); 
$ref = $_POST['ref']; //printf("<br>ref : %s <br>",$ref); 
$iva = $_POST['iva']; //printf("<br>iva : %s <br>",$iva); 

$salud = $_POST['salud'] * -1; //printf("<br>salud : %s <br>",$salud); 
$pension = $_POST['pension'] * -1; //printf("<br>pension : %s <br>",$pension);
$libranza = $_POST['libranza'] * -1;  //printf("<br>libranza : %s <br>",$libranza);
$f_solidaridad = $_POST['f_solidaridad'] * -1; // printf("<br>f_solidaridad : %s <br>",$f_solidaridad);
$f_empleados = $_POST['f_empleados']* -1;  //printf("<br>f_empleados : %s <br>",$f_empleados);
$sindicato = $_POST['sindicato'] * -1;  //printf("<br>sindicato : %s <br>",$sindicato);
$embargo = $_POST['embargo'] * -1;  //printf("<br>embargo : %s <br>",$embargo);
$cruce = $_POST['cruce'] * -1;  //printf("<br>cruce : %s <br>",$cruce);
$otros = $_POST['otros'] * -1;  //printf("<br>otros : %s <br>",$otros);

$retefuente = $_POST['retefuente']; // printf("<br>retefuente : %s <br>",$retefuente);
$vr_retefuente = $_POST['vr_retefuente']; // printf("<br>vr_retefuente : %s <br>",$vr_retefuente);
$reteiva = $_POST['reteiva'];  //printf("<br>reteiva : %s <br>",$reteiva);
$vr_reteiva = $_POST['vr_reteiva']; // printf("<br>vr_reteiva : %s <br>",$vr_reteiva);
$reteica = $_POST['reteica'];  //printf("<br>reteica : %s <br>",$reteica);
$a_partir_reteica = $_POST['a_partir_reteica']; //printf("<br>a_partir_reteica : %s <br>",$a_partir_reteica); 
$tarifa_reteica = $_POST['tarifa_reteica'];  //printf("<br>tarifa_reteica : %s <br>",$tarifa_reteica);
$vr_reteica = $_POST['vr_reteica'];  //printf("<br>vr_reteica : %s <br>",$vr_reteica);
$estampilla1 = $_POST['estampilla1'];  //printf("<br>estampilla1 : %s <br>",$estampilla1);
$vr_estampilla1 = $_POST['vr_estampilla1'];  //printf("<br>vr_estampilla1 : %s <br>",$vr_estampilla1);
$estampilla2 = $_POST['estampilla2'];  //printf("<br>estampilla2 : %s <br>",$estampilla2);
$vr_estampilla2 = $_POST['vr_estampilla2'];  //printf("<br>vr_estampilla2 : %s <br>",$vr_estampilla2);
$estampilla3 = $_POST['estampilla3'];  //printf("<br>estampilla3 : %s <br>",$estampilla3);
$vr_estampilla3 = $_POST['vr_estampilla3'];  //printf("<br>vr_estampilla3 : %s <br>",$vr_estampilla3);
$estampilla4 = $_POST['estampilla4'];  //printf("<br>estampilla3 : %s <br>",$estampilla3);
$vr_estampilla4 = $_POST['vr_estampilla4'];  //printf("<br>vr_estampilla3 : %s <br>",$vr_estampilla3);
$estampilla5 = $_POST['estampilla5'];  //printf("<br>estampilla3 : %s <br>",$estampilla3);
$vr_estampilla5 = $_POST['vr_estampilla5'];  //printf("<br>vr_estampilla3 : %s <br>",$vr_estampilla3);
$forma_pago = $_POST['forma_pago'];  //printf("<br>forma_pago : %s <br>",$forma_pago);
$codigo_dian = $_POST['codigo_dian'];

$num_cheque = $_POST['num_cheque1'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque = $_POST['banco_cheque1'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque = $_POST['cta_cheque1'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);
$te = $_POST['te'];  //printf("<br>te : %s <br>",$te);
$total_pagado = $_POST['total_pagado']; //printf("<br>total_pagado : %s <br>",$total_pagado);

$num_cheque2 = $_POST['num_cheque2'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque2 = $_POST['banco_cheque2'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque2 = $_POST['cta_cheque2'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

$num_cheque3 = $_POST['num_cheque3'];  //printf("<br>num_cheque : %s <br>",$num_cheque);
$banco_cheque3 = $_POST['banco_cheque3'];  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
$cta_cheque3 = $_POST['cta_cheque3'];  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

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

echo $_post['pgcp11']."s: <br>";


$pgcp1 = $_POST['pgcp1'];printf("<br>pgcp df : %s <br>",$_POST['pgcp1']); 
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
$filas_t = $_POST['contador_f']; //printf("<br>filas : %d <br>",$filas_t); 

/*$tot_deb = $vr_deb_1+$vr_deb_2+$vr_deb_3+$vr_deb_4+$vr_deb_5+$vr_deb_6+$vr_deb_7+$vr_deb_8+$vr_deb_9+$vr_deb_10+$vr_deb_11+$vr_deb_12+$vr_deb_13+$vr_deb_14+$vr_deb_15;
$tot_cre = $vr_cre_1+$vr_cre_2+$vr_cre_3+$vr_cre_4+$vr_cre_5+$vr_cre_6+$vr_cre_7+$vr_cre_8+$vr_cre_9+$vr_cre_10+$vr_cre_11+$vr_cre_12+$vr_cre_13+$vr_cre_14+$vr_cre_15;*/
$tot_deb=$_POST['tot_cre_a'];
$tot_cre=$_POST['tot_deb_a'];

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

$sql_max= "select max(id) from conta_ncon ";
			$res_max= mysql_db_query($database, $sql_max, $connectionxx);
			$row_max= mysql_fetch_array($res_max);
			$max=$row_max["max(id)"]+1;			
			$max_m=$max;



$aux=$id_auto_cobp;

$consultax=mysql_query("select * from vf ",$connectionxx);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; // echo $ax;
	 $bx=$rowx["fecha_fin"]; // echo $bx;
} 
///$fecha_ceva


if( $fecha_ceva > $bx || $fecha_ceva < $ax )
{
	
	printf("
			<center class='Estilo4'><br><br>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
			</center>");

		printf("

<center class='Estilo4'>
<form method='post' action='pagos_tesoreria.php' >
<input type='hidden' name='nn' value='CEVA'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");

///**********************
}
else
{
	

$sql = "INSERT INTO ceva ( 
									
id_emp, fecha_ceva , id_auto_ceva, id_manu_ceva, des_ceva, 
id_manu_crpp, id_auto_crpp, fecha_crpp, tercero, ccnit, pago, 
id_manu_cobp, id_auto_cobp, fecha_cobp, des_cobp, ref, 
iva,


salud, pension, libranza, f_solidaridad, f_empleados, sindicato, embargo, cruce, otros,
retefuente, vr_retefuente, reteiva, vr_reteiva, 
reteica, a_partir_reteica, tarifa_reteica, vr_reteica,
estampilla1, vr_estampilla1, estampilla2, vr_estampilla2, estampilla3, vr_estampilla3, estampilla4, vr_estampilla4, estampilla5, vr_estampilla5, 
forma_pago, num_cheque, banco_cheque, cta_cheque, te, total_pagado,num_cheque2, banco_cheque2, cta_cheque2,num_cheque3, banco_cheque3, cta_cheque3,
num_cheque4, banco_cheque4, cta_cheque4,num_cheque5, banco_cheque5, cta_cheque5,num_cheque6, banco_cheque6, cta_cheque6,num_cheque7, banco_cheque7, cta_cheque7,
num_cheque8, banco_cheque8, cta_cheque8,num_cheque9, banco_cheque9, cta_cheque9,num_cheque10, banco_cheque10, cta_cheque10,num_cheque11, banco_cheque11, cta_cheque11,
num_cheque12, banco_cheque12, cta_cheque12,num_cheque13, banco_cheque13, cta_cheque13,num_cheque14, banco_cheque14, cta_cheque14,
num_cheque15, banco_cheque15, cta_cheque15,

pgcp1 , pgcp2 , pgcp3 , pgcp4 , pgcp5 , pgcp6 , pgcp7 , pgcp8 , pgcp9 , pgcp10 , pgcp11 , pgcp12 , pgcp13 , pgcp14 , pgcp15 , 
des1 , des2 , des3 , des4 , des5 , des6 , des7 , des8 , des9 , des10 , des11 , des12 , des13 , des14 , des15 , 
vr_deb_1 , vr_deb_2 , vr_deb_3 , vr_deb_4 , vr_deb_5 , vr_deb_6 , vr_deb_7 , vr_deb_8 , vr_deb_9 , 
vr_deb_10 , vr_deb_11 , vr_deb_12 , vr_deb_13 , vr_deb_14 , vr_deb_15 , 
vr_cre_1 , vr_cre_2 , vr_cre_3 , vr_cre_4 , vr_cre_5 , vr_cre_6 , vr_cre_7 , vr_cre_8 , vr_cre_9 , 
vr_cre_10 , vr_cre_11 , vr_cre_12 , vr_cre_13 , vr_cre_14 , vr_cre_15 , 
tot_deb, tot_cre,estado,id_ncon


) VALUES ( 
			
'$id_emp', '$fecha_ceva' , '$id_auto_ceva', '$id_manu_ceva', '$des_ceva', 
'$id_manu_crpp', '$id_auto_crpp', '$fecha_crpp', '$tercero', '$ccnit', '$pago', 
'$id_manu_cobp', '$id_auto_cobp', '$fecha_cobp', '$des_cobp', '$ref', 
'$iva',


'$salud', '$pension', '$libranza', '$f_solidaridad', '$f_empleados', '$sindicato', '$embargo', '$cruce', '$otros',
'$retefuente', '$vr_retefuente', '$reteiva', '$vr_reteiva', 
'$reteica', '$a_partir_reteica', '$tarifa_reteica', '$vr_reteica',
'$estampilla1', '$vr_estampilla1', '$estampilla2', '$vr_estampilla2', '$estampilla3', '$vr_estampilla3',  '$estampilla4', '$vr_estampilla4',  '$estampilla5', '$vr_estampilla5', 
'$forma_pago', '$num_cheque', '$banco_cheque', '$cta_cheque', '$te', '$total_pagado', 
'$num_cheque2', '$banco_cheque2', '$cta_cheque2','$num_cheque3', '$banco_cheque3', '$cta_cheque3',
'$num_cheque4', '$banco_cheque4', '$cta_cheque4','$num_cheque5', '$banco_cheque5', '$cta_cheque5','$num_cheque6', '$banco_cheque6', 
'$cta_cheque6','$num_cheque7', '$banco_cheque7', '$cta_cheque7',
'$num_cheque8', '$banco_cheque8', '$cta_cheque8','$num_cheque9', '$banco_cheque9', '$cta_cheque9','$num_cheque10', '$banco_cheque10', 
'$cta_cheque10','$num_cheque11', '$banco_cheque11', '$cta_cheque11',
'$num_cheque12', '$banco_cheque12', '$cta_cheque12','$num_cheque13', '$banco_cheque13', '$cta_cheque13','$num_cheque14', 
'$banco_cheque14', '$cta_cheque14',
'$num_cheque15', '$banco_cheque15', '$cta_cheque15',

'$pgcp1' , '$pgcp2' , '$pgcp3' , '$pgcp4' , '$pgcp5' , '$pgcp6' , '$pgcp7' , '$pgcp8' , '$pgcp9' , '$pgcp10' , '$pgcp11' , 
'$pgcp12' , '$pgcp13' , '$pgcp14' , '$pgcp15' , 
'$des1' , '$des2' , '$des3' , '$des4' , '$des5' , '$des6' , '$des7' , '$des8' , '$des9' , '$des10' , '$des11' , '$des12' , 
'$des13' , '$des14' , '$des15' , 
'$vr_deb_1' , '$vr_deb_2' , '$vr_deb_3' , '$vr_deb_4' , '$vr_deb_5' , '$vr_deb_6' , '$vr_deb_7' , '$vr_deb_8' , '$vr_deb_9' , 
'$vr_deb_10' , '$vr_deb_11' , '$vr_deb_12' , '$vr_deb_13' , '$vr_deb_14' , '$vr_deb_15' , 
'$vr_cre_1' , '$vr_cre_2' , '$vr_cre_3' , '$vr_cre_4', '$vr_cre_5' , '$vr_cre_6' , '$vr_cre_7' , '$vr_cre_8' , '$vr_cre_9' , 
'$vr_cre_10' , '$vr_cre_11' , '$vr_cre_12' , '$vr_cre_13' , '$vr_cre_14' , '$vr_cre_15' , 
'$tot_deb' , '$tot_cre','$id_auto_ceva2','$max_m'


)";

echo "base ---- ". $sql;
mysql_query($sql, $connectionxx) or die(mysql_error());




//*******VALIDAR OBCG O COBP*************************

$sql_e = "select * from cobp where id_auto_cobp='$id_auto_cobp'";
$res_e = mysql_db_query($database, $sql_e, $connectionxx);
while($row_e = mysql_fetch_array($res_e)) 
{
	  $tes=$row_e["tesoreria"]; 
	 // echo ($tes);
	  if($tes=="NO"&&$check==1)
	  {
		    $sql_e2 = "update obcg set pagado='SI', liq='SI' where  id_auto_cobp = '$id_auto_cobp'";
			$res_e2 = mysql_db_query($database, $sql_e2, $connectionxx);

			$sql_e3 = "update cobp set pagado='NO' , contab ='NO' where id_auto_cobp = '$id_auto_cobp'";
			$res_e3 = mysql_db_query($database, $sql_e3, $connectionxx);
			
			$sql_obcg = "select * from obcg where id_auto_cobp='$id_auto_cobp'";
			$res_obcg = mysql_db_query($database, $sql_obcg, $connectionxx);
			while($row_obcg = mysql_fetch_array($res_obcg)) 
			{
				$pgcp1o = $row_obcg["pgcp1"]; $pgcp6o = $row_obcg["pgcp6"]; $pgcp11o = $row_obcg["pgcp11"];
				$pgcp2o = $row_obcg["pgcp2"]; $pgcp7o = $row_obcg["pgcp7"]; $pgcp12o= $row_obcg["pgcp12"];
				$pgcp3o = $row_obcg["pgcp3"]; $pgcp8o = $row_obcg["pgcp8"]; $pgcp13o = $row_obcg["pgcp13"];
				$pgcp4o = $row_obcg["pgcp4"]; $pgcp9o = $row_obcg["pgcp9"]; $pgcp14o = $row_obcg["pgcp14"];
				$pgcp5o = $row_obcg["pgcp5"]; $pgcp10o = $row_obcg["pgcp10"]; $pgcp15o = $row_obcg["pgcp15"];
				
				$vr_deb_1o=$row_obcg["vr_deb_1"]; $vr_deb_6o=$row_obcg["vr_deb_6"]; $vr_deb_11o=$row_obcg["vr_deb_11"];
				$vr_deb_2o=$row_obcg["vr_deb_2"]; $vr_deb_7o=$row_obcg["vr_deb_7"]; $vr_deb_12o=$row_obcg["vr_deb_12"];
				$vr_deb_3o=$row_obcg["vr_deb_3"]; $vr_deb_8o=$row_obcg["vr_deb_8"]; $vr_deb_13o=$row_obcg["vr_deb_13"];
				$vr_deb_4o=$row_obcg["vr_deb_4"]; $vr_deb_9o=$row_obcg["vr_deb_9"]; $vr_deb_14o=$row_obcg["vr_deb_14"];
				$vr_deb_5o=$row_obcg["vr_deb_5"]; $vr_deb_10o=$row_obcg["vr_deb_10"]; $vr_deb_15o=$row_obcg["vr_deb_15"];
				
				$vr_cre_1o=$row_obcg["vr_cre_1"]; $vr_cre_6o=$row_obcg["vr_cre_6"]; $vr_cre_11o=$row_obcg["vr_cre_11"]; 
				$vr_cre_2o=$row_obcg["vr_cre_2"]; $vr_cre_7o=$row_obcg["vr_cre_7"]; $vr_cre_12o=$row_obcg["vr_cre_12"]; 
				$vr_cre_3o=$row_obcg["vr_cre_3"]; $vr_cre_8o=$row_obcg["vr_cre_8"]; $vr_cre_13o=$row_obcg["vr_cre_13"]; 
				$vr_cre_4o=$row_obcg["vr_cre_4"]; $vr_cre_9o=$row_obcg["vr_cre_9"]; $vr_cre_14o=$row_obcg["vr_cre_14"]; 
				$vr_cre_5o=$row_obcg["vr_cre_5"]; $vr_cre_10o=$row_obcg["vr_cre_10"]; $vr_cre_15o=$row_obcg["vr_cre_15"];
				
				$des_obcg=$row_obcg["des_cobp"];
				$tot_deb=$row_obcg["tot_deb"]; 
				$tot_cre=$row_obcg["tot_cre"];
				
				
				
				 $sq_ncon = "INSERT INTO conta_ncon ( 
                
                id_emp , id_auto_ncon,  id_manu_ncon,  fecha_ncon ,  des_ncon , tercero,                
                
                pgcp1 , pgcp2 , pgcp3 , pgcp4 , pgcp5 ,
				pgcp6 , pgcp7 , pgcp8 , pgcp9 , pgcp10 ,
				pgcp11 , pgcp12 , pgcp13 , pgcp14 , pgcp15 , 
                 
                vr_deb_1 , vr_deb_2 , vr_deb_3 , vr_deb_4 , vr_deb_5 ,
				vr_deb_6 , vr_deb_7 , vr_deb_8 , vr_deb_9 , vr_deb_10 ,
				vr_deb_11 , vr_deb_12 , vr_deb_13 , vr_deb_14 , vr_deb_15 , 
				
                vr_cre_1 , vr_cre_2 , vr_cre_3 , vr_cre_4 , vr_cre_5 ,
				vr_cre_6 , vr_cre_7 , vr_cre_8 , vr_cre_9 , vr_cre_10 , 
				vr_cre_11 , vr_cre_12 , vr_cre_13 , vr_cre_14 , vr_cre_15 ,
                tot_deb , tot_cre 
                
                ) VALUES ( 
                                
                '$id_emp' , '$max',  'NCON$max_m',  '$fecha_ceva',  'ANULACION - $des_obcg', '$tercero',                
                
                '$pgcp1o' , '$pgcp2o' , '$pgcp3o' , '$pgcp4o' , '$pgcp5o' , 
				'$pgcp6o' , '$pgcp7o' , '$pgcp8o' , '$pgcp9o' , '$pgcp10o' , 
				'$pgcp11o' , '$pgcp12o' , '$pgcp13o' , '$pgcp14o' , '$pgcp15o' , 	
          				
                '$vr_cre_1o' , '$vr_cre_2o' , '$vr_cre_3o' , '$vr_cre_4o' , '$vr_cre_5o' , 
				'$vr_cre_6o' , '$vr_cre_7o' , '$vr_cre_8o' , '$vr_cre_9o' , '$vr_cre_10o' , 
				'$vr_cre_11o' , '$vr_cre_12o' , '$vr_cre_13o' , '$vr_cre_14o' , '$vr_cre_15o' ,
            
				
				'$vr_deb_1o' , '$vr_deb_2o', '$vr_deb_3o' , '$vr_deb_4o' , '$vr_deb_5o' , 
				'$vr_deb_6o' , '$vr_deb_7o' , '$vr_deb_8o' , '$vr_deb_9o' , '$vr_deb_10o' , 
				'$vr_deb_11o' , '$vr_deb_12o' , '$vr_deb_13o' , '$vr_deb_14o' , '$vr_deb_15o',
				'$tot_deb' , '$tot_cre'  
                
                
                )";
        
        
                mysql_query($sq_ncon, $connectionxx) or die(mysql_error());       					
			}
			printf("<center class='Estilo9'><br><br>EL SISTEMA A GENERADO UNA NOTA DE CONTABILIDAD</center>");
			printf("<center class='Estilo9'><br>NUMERO: %s  REVERSANDO LA CAUSACION DEL GASTO </center>",$max_m);			
			printf("<center ><br>  <a href='../mvto_contable/modifica_ncon.php?id1=%s'>VER <BR /> </a> <BR /></center>",$max);
	  }
	  else
	  {
		    $sql_e4 = "update cobp set pagado='NO' where id_auto_cobp = '$id_auto_cobp'";
			$res_e4 = mysql_db_query($database, $sql_e4, $connectionxx);
			
			$sql_e5 = "update obcg set pagado='NO' where  id_auto_cobp = '$id_auto_cobp'";
			$res_e5 = mysql_db_query($database, $sql_e5, $connectionxx);
	  }
}

$sqlaceva = "update ceva set estado='anulado' where  id_auto_ceva = '$id_auto_ceva2'";
$resultadoaceva = mysql_db_query($database, $sqlaceva, $connectionxx);



printf("<center class='Estilo9'><br><br>REGISTRO ALMACENADO CON EXITO<br><br></center>");
printf("
<center class='Estilo4'>
<form method='post' action='pagos_tesoreria.php'>
<input type='hidden' name='nn' value='CEVA'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");


}
//fin else
?>


<?php
}
?>