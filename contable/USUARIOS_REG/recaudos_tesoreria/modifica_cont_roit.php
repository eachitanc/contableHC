<?
session_start();
if(!session_is_registered("login"))
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
<?

$id_recau = $_POST['id_recau'];
$vr = $_POST['vr'];

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


// *** id emp ***
include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $idxx=$rowxx["id_emp"];
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



if (($tipa =='M')or($tipb =='M')or($tipc =='M')or($tipd =='M')or($tipe =='M')or($tipf =='M')or($tipg =='M')or($tiph =='M')or($tipi =='M')or($tipj =='M')or($tipk =='M')or($tipl =='M')or($tipm =='M')or($tipn =='M')or($tipo =='M'))
{
printf("<br><br><center class='Estilo4'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>");

}
else
{


	
		 if($tot_deb != $tot_cre)
	   	  {
					printf("<br><br><center class='Estilo4'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb." :::...) y Credito (...::: ".$tot_cre." :::...) del movimiento 					<br><br>
					<b>NO COINCIDEN</b> <BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>"
					);
				
     	  }
		 else
		  {
					/*if (($tot_deb != $vr) or ($tot_cre != $vr))
					{
					   // impresion de error
						printf("<br><center class='Estilo4'>
					************************************************************<br>
					************************************************************<br>
					<u><b>ERROR</b></u><br><br>
					Los totales DEBITO <b>(".$tot_deb.")</b> y CREDITO <b>(".$tot_cre.")</b> <br>
					<b>NO COINCIDEN</b>
					<br>
					con el total de los valores digitados en la Imputacion <b>(".$vr.")</b>
					<BR><br>

					Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>
					************************************************************<br>
					************************************************************<br>	");
					 
					}	
					 else
				 {*/
					 

					// procesos de modificacion
					
									
					//************* actualizar contabilidad
					$sql12 = "select * from recaudo_roit where id_emp='$id_emp' and id_recau ='$id_recau'";
					$resultado12 = mysql_db_query($database, $sql12, $connectionxx);

					while($rw12 = mysql_fetch_array($resultado12)) 
					{

				   $sql14 = "update recaudo_roit set pgcp1 ='$pgcp1' ,  pgcp2 ='$pgcp2' ,  pgcp3 ='$pgcp3' ,  pgcp4 ='$pgcp4' ,  pgcp5 ='$pgcp5' ,  pgcp6 ='$pgcp6' ,  pgcp7 ='$pgcp7' ,  pgcp8 ='$pgcp8' ,  pgcp9 ='$pgcp9' ,  pgcp10 ='$pgcp10' ,  pgcp11 ='$pgcp11' ,  pgcp12 ='$pgcp12' ,  pgcp13 ='$pgcp13' ,  pgcp14 ='$pgcp14' ,  pgcp15 ='$pgcp15' ,  des1 ='$des1' ,  des2 ='$des2' ,  des3 ='$des3' ,  des4 ='$des4' ,  des5 ='$des5' ,  des6 ='$des6' ,  des7 ='$des7' ,  des8 ='$des8' ,  des9 ='$des9' ,  des10 ='$des10' ,  des11 ='$des11' ,  des12 ='$des12' ,  des13 ='$des13' ,  des14 ='$des14' ,  des15 ='$des15' ,  vr_deb_1 ='$vr_deb_1' ,  vr_deb_2 ='$vr_deb_2' ,  vr_deb_3 ='$vr_deb_3' ,  vr_deb_4 ='$vr_deb_4' ,  vr_deb_5 ='$vr_deb_5' ,  vr_deb_6 ='$vr_deb_6' ,  vr_deb_7 ='$vr_deb_7' ,  vr_deb_8 ='$vr_deb_8' ,  vr_deb_9 ='$vr_deb_9' ,  vr_deb_10 ='$vr_deb_10' ,  vr_deb_11 ='$vr_deb_11' ,  vr_deb_12 ='$vr_deb_12' ,  vr_deb_13 ='$vr_deb_13' ,  vr_deb_14 ='$vr_deb_14' ,  vr_deb_15 ='$vr_deb_15' ,  vr_cre_1 ='$vr_cre_1' ,  vr_cre_2 ='$vr_cre_2' ,  vr_cre_3 ='$vr_cre_3' ,  vr_cre_4 ='$vr_cre_4' ,  vr_cre_5 ='$vr_cre_5' ,  vr_cre_6 ='$vr_cre_6' ,  vr_cre_7 ='$vr_cre_7' ,  vr_cre_8 ='$vr_cre_8' ,  vr_cre_9 ='$vr_cre_9' ,  vr_cre_10 ='$vr_cre_10' ,  vr_cre_11 ='$vr_cre_11' ,  vr_cre_12 ='$vr_cre_12' ,  vr_cre_13 ='$vr_cre_13' ,  vr_cre_14 ='$vr_cre_14' ,  vr_cre_15 ='$vr_cre_15'  where id_emp='$id_emp' and id_recau ='$id_recau' ";										
				   $resultado14 = mysql_db_query($database, $sql14, $connectionxx);	
					   
				   $sql15 = "update recaudo_roit set tot_deb='$tot_deb' , tot_cre='$tot_cre'  where id_emp='$id_emp' and id_recau ='$id_recau' ";										
				   $resultado15 = mysql_db_query($database, $sql15, $connectionxx);	
				  }
					
					
					printf("<br><br><center class ='Estilo4'>REGISTRO MODIFICADO CON EXITO</center><br /><br />");
										
																	
										
										
					//}
										
				}
					 
							
				

    
		
}




										printf("
										<br>
										<center class='Estilo8'>
										<form method='post' action='confirma_borra_roit.php'>
										<input type='hidden' name='id_recau' value='%s'>
										<input type='submit' name='Submit' value='Volver' class='Estilo9' />
										</form>
										</center>
										",$id_recau);



?>
<?
}
?>