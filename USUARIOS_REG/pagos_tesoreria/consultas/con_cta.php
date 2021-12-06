<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
$dato = $_REQUEST['cod'];
$cont = $_REQUEST['con'];
$P = "pgcp" . $cont;
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
$sql = "select * from cecp where id_auto_cecp='$dato'";
$res = $cx->query($sql) or die(mysqli_error($cx));
while ($row = $res->fetch_assoc()) {
	$pgcp = $row[$P];
	$sql2 = "select * from pgcp where cod_pptal ='$pgcp'";
	$res2 = $cx->query($sql2);
	$row2 = $res2->fetch_assoc();
	$des = $row2['nom_rubro'];
	$deb = $row['vr_deb_' . $cont];
	$cre = $row['vr_cre_' . $cont];
	$cheque = isset($row['num_cheque' . $cont]) ? $row['num_cheque' . $cont] : '';
}
echo $pgcp . '*' . $des . '*' . $deb . '*' . $cre . '*' . $cheque;
//echo $dato.'/'.$dato.'/'.$dato.'/'.$cont.'/'.$cont;
//echo $id2;
$cx = null;
