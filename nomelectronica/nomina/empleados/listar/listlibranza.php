<?php

session_start();
if (!isset($_SESSION['user'])) {
  echo '<script>window.location.replace("../../../index.php");</script>';
  exit();
}
include '../../../conexion.php';

function pesos($value) {
    return '$' . number_format($value, 2);
}
$idlib = $_POST['idlib'];
$cont = 1;
$resp = "";
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT val_mes_lib, mes_lib, nom_mes, anio_lib, CONCAT(anio_lib, mes_lib)AS ordenar  
            FROM seg_liq_libranza,seg_meses 
            WHERE seg_meses.codigo = seg_liq_libranza.mes_lib AND id_libranza = '$idlib' 
            ORDER BY ordenar ASC";
    $rs = $cmd->query($sql);
    $obj = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$resp .= '<table class="table table-striped table-bordered table-sm table-hover">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Valor Libranza</th>
      <th scope="col">Mes</th>
      <th scope="col">Año</th>
    </tr>
  </thead>
  <tbody>';
foreach ($obj as $o) {
    $resp .= '<tr>
    <th scope="row">' . $cont . '</th>
    <td>' . pesos($o["val_mes_lib"]) . '</td>
    <td>' . $o["nom_mes"] . '</td>
    <td>' . $o["anio_lib"] . '</td>
    </tr>';
    $cont++;
}
$resp .= '</tbody>
</table>';
echo $resp;
