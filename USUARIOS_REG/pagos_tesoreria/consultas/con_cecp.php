<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
$cuenta = $_REQUEST['cod'];
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar


$sql = "SELECT * from cca_cxp where cod_pptal='$cuenta'";
$res = $cx->query($sql);
$ncuenta = '';
$nombre = '';
//$numf=$res->num_rows;
while ($row = $res->fetch_assoc()) {
    $ncuenta = $row['pgcp1'];
    $nombre = $row['nom_rubro'];
}


//$valort=$valoret*$valor;
echo $ncuenta . ',' . $nombre;
//echo $numf;
//echo $reten;
$cx = null;
