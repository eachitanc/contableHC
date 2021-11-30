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
$id = $_POST['id'];
$fecha_c=$_POST['fecha_c'];// echo $fecha_c;
$id_reip = $_POST['id_reip'];
$id_caic = $_POST['id_caic'];
$id_recau = $_POST['id_recau'];
$fecha_recaudo = $_POST['fecha_recaudo'];
$cuenta = $_POST['cuenta'];// echo $cuenta;
include('../config.php');				
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$sql = "select nom_rubro from car_ppto_ing where cod_pptal ='$cuenta'";
	$resultado = mysql_db_query($database, $sql, $cx);
	while($row = $resultado->fetch_assoc()) 
   	{
	   $nombre=$row["nom_rubro"];
	 }
$new_vr_digitado = $_POST['vr_digitado'];
$vr_digitado = $_POST['vr_digitado'];
$tercero = $_POST['tercero'];
$des_recaudo = $_POST['des_recaudo'];
$id_manu_rcgt = $_POST['id_manu_ncbt'];

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

// *** id emp ***
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
  $idxx=$rowxx["id_emp"];
}

//*** defintivo
$cod=$cuenta;
$ss2 = "select * from car_ppto_ing where id_emp = '$id_emp' and cod_pptal = '$cod'";
$rr2 = mysql_db_query($database, $ss2, $connectionxx);
while($rrw2 = mysql_fetch_array($rr2)) 
{
  $nom_rubro=$rrw2["nom_rubro"];
  $tip_dato=$rrw2["tip_dato"];
  $definitivo=$rrw2["definitivo"];
}

// vigencia fiscal
 
$consultax=mysql_query("select * from vf ",$connectionxx);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
} 

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
$resultadoc = $connectionxx->query($sqlc);
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


// sumo todo lo que se ha recaudado en todos los dctos contables de tesoreria para esa cuenta y lo evaluo frente a definitivo del ppto de ing ************


$link=mysql_connect($server,$dbuser,$dbpass);

// en esta variable se acumulan todos los roit.... comparo con el total del reconocmiento ya que ese dinero esta reservado, no con lo recaudado hasta la fecha
$resulta=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE id_emp ='$id_emp' and cuenta ='$cuenta'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total_recaudado_reip=$row[0]; 


$resultb=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE id_emp ='$id_emp' and cuenta ='$cuenta'",$link) or die (mysql_error());
$rowb=mysql_fetch_row($resultb);
$total_recaudado_ncbt=$rowb[0]; 


$resultc=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE id_emp ='$id_emp' and cuenta ='$cuenta'",$link) or die (mysql_error());
$rowc=mysql_fetch_row($resultc);
$total_recaudado_tnat=$rowc[0]; 


$resultd=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE id_emp ='$id_emp' and cuenta ='$cuenta'",$link) or die (mysql_error());
$rowd=mysql_fetch_row($resultd);
$total_recaudado_rcgt=$rowd[0]; 


$todo_lo_recaudado = $total_recaudado_reip + $total_recaudado_ncbt + $total_recaudado_tnat + $total_recaudado_rcgt;


$vr_eval = $total_recaudado_reip + $total_recaudado_ncbt + $total_recaudado_tnat + $total_recaudado_rcgt + $vr_digitado;


$saldoxrecaudar = $definitivo - $todo_lo_recaudado;

// inicio del bloque

/*if($vr_eval > $definitivo)
{
printf("<br><br><center class='Estilo4'>El <b>SALDO</b> disponible para realizar <B>RECAUDOS</B> a la cuenta <b>".$cuenta."</b>  es <br><br>...::: ".$saldoxrecaudar." :::...<BR><BR><b>NO</b> puede hacer <b>RECAUDOS</b> por un valor superior al indicado<BR><BR>Verifique su Informacion<br><br><br>");
}
else
{*/
if(($des_recaudo == '') or ($vr_digitado == ''))
{
printf("<br><br><center class='Estilo4'>No debe dejar casillas <b>EN BLANCO</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>");
}
else
{
if (($tipa =='M')or($tipb =='M')or($tipc =='M')or($tipd =='M')or($tipe =='M')or($tipf =='M')or($tipg =='M')or($tiph =='M')or($tipi =='M')or($tipj =='M')or($tipk =='M')or($tipl =='M')or($tipm =='M')or($tipn =='M')or($tipo =='M') or ($tip_dato =='M'))
{
printf("<br><br><center class='Estilo4'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>");

}
else
		  {
			  
			  
				$sqlf="select * from vf";
				$resf=mysql_db_query($database,$sqlf,$connectionxx);
				$rowf=mysql_fetch_array($resf);
				$fecha_cierre=$rowf["fecha_ini"]; //echo $fecha_cierre;
				
				if($fecha_c<=$fecha_cierre)		
				{
					printf("
					<center class='Estilo4'><br><br>La Fecha de registro <b>NO</b> 
					se encuentra dentro de la Vigencia Fiscal Actual<br><br>
					</center>");
					printf("
					<center class='Estilo4'>
					<a href=\"confirma_borra_roit.php?id_recau2=%s\">...::: VOLVER :::...</a>
					</center>
					
					",$id_recau);
					
					
				}
				else
				{
						$sql10 = "update recaudo_rcgt set des_recaudo='$des_recaudo',
						id_manu_rcgt ='$id_manu_rcgt',fecha_recaudo ='$fecha_recaudo' where id_emp='$id_emp' and id_recau ='$id_recau' ";
						$resultado10 = mysql_db_query($database, $sql10, $connectionxx);
										
										//***** actualizo el vr digitado en recaudo_roip
						$sql5 = "update recaudo_rcgt set vr_digitado='$new_vr_digitado'
						where id_emp='$id_emp' and id ='$id' ";
						$resultado5 = mysql_db_query($database, $sql5, $connectionxx);
										
										//************* actualizar contabilidad
						$sql12 = "select * from recaudo_rcgt 
						where id_emp='$id_emp' and id_recau ='$id_recau'";
						$resultado12 = mysql_db_query($database, $sql12, $connectionxx);

						while($rw12 = mysql_fetch_array($resultado12)) 
						{

							$sql14 = "update recaudo_rcgt set cuenta ='$cuenta', nombre ='$nombre', 
							pgcp1 ='$pgcp1' ,  pgcp2 ='$pgcp2' ,  pgcp3 ='$pgcp3' ,  pgcp4 ='$pgcp4' ,
							pgcp5 ='$pgcp5' ,  pgcp6 ='$pgcp6' ,  pgcp7 ='$pgcp7' ,  pgcp8 ='$pgcp8' ,
							pgcp9 ='$pgcp9' ,  pgcp10 ='$pgcp10' ,  pgcp11 ='$pgcp11' ,  pgcp12 ='$pgcp12' ,
							pgcp13 ='$pgcp13' ,  pgcp14 ='$pgcp14' ,  pgcp15 ='$pgcp15' ,  des1 ='$des1' ,
							des2 ='$des2' ,  des3 ='$des3' ,  des4 ='$des4' ,  des5 ='$des5' ,  
							des6 ='$des6' ,  des7 ='$des7' ,  des8 ='$des8' ,  des9 ='$des9' ,  
							des10 ='$des10' ,  des11 ='$des11' ,  des12 ='$des12' ,  des13 ='$des13' ,
							des14 ='$des14' ,  des15 ='$des15' ,  vr_deb_1 ='$vr_deb_1' ,  
							vr_deb_2 ='$vr_deb_2' ,  vr_deb_3 ='$vr_deb_3' ,  vr_deb_4 ='$vr_deb_4' ,
							vr_deb_5 ='$vr_deb_5' ,  vr_deb_6 ='$vr_deb_6' ,  vr_deb_7 ='$vr_deb_7' ,
							vr_deb_8 ='$vr_deb_8' ,  vr_deb_9 ='$vr_deb_9' ,  vr_deb_10 ='$vr_deb_10' ,
							vr_deb_11 ='$vr_deb_11' ,  vr_deb_12 ='$vr_deb_12' ,  vr_deb_13 ='$vr_deb_13' ,
							vr_deb_14 ='$vr_deb_14' ,  vr_deb_15 ='$vr_deb_15' ,  vr_cre_1 ='$vr_cre_1' ,
							vr_cre_2 ='$vr_cre_2' ,  vr_cre_3 ='$vr_cre_3' ,  vr_cre_4 ='$vr_cre_4' , 
							vr_cre_5 ='$vr_cre_5' ,  vr_cre_6 ='$vr_cre_6' ,  vr_cre_7 ='$vr_cre_7' ,
							vr_cre_8 ='$vr_cre_8' ,  vr_cre_9 ='$vr_cre_9' ,  vr_cre_10 ='$vr_cre_10' ,
							vr_cre_11 ='$vr_cre_11' ,  vr_cre_12 ='$vr_cre_12' ,  vr_cre_13 ='$vr_cre_13' ,
							vr_cre_14 ='$vr_cre_14' ,  vr_cre_15 ='$vr_cre_15' where id_emp='$id_emp' 
							and id ='$id' ";										
   							$resultado14 = mysql_db_query($database, $sql14, $connectionxx);	
										   
							$sql15 = "update recaudo_rcgt set tot_deb='$tot_deb' , tot_cre='$tot_cre' 
							where id_emp='$id_emp' and id ='$id' ";										
   							$resultado15 = mysql_db_query($database, $sql15, $connectionxx);	
						}
						printf("<br><br><center class ='Estilo4'>
						REGISTRO MODIFICADO CON EXITO</center><br /><br />");
						
						printf("
					<center class='Estilo4'>
					<a href=\"confirma_borra_roit.php?id_recau2=%s\">...::: VOLVER :::...</a>
					</center>
					
					",$id_recau);
				}
				}
		}

?>

<?php
}
?>