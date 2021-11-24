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
$idcsind = $_POST['idaporte'];
$cont = 1;
$resp = "";
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT val_aporte, mes_aporte, nom_mes, anio_aporte, CONCAT(anio_aporte,mes_aporte)AS ordenar  
            FROM seg_liq_sindicato_aportes,seg_meses 
            WHERE seg_meses.codigo = seg_liq_sindicato_aportes.mes_aporte AND id_cuota_sindical = '$idcsind' 
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
      <th scope="col">Aporte</th>
      <th scope="col">Valor Aporte</th>
      <th scope="col">Mes</th>
      <th scope="col">Año</th>
    </tr>
  </thead>
  <tbody>';
foreach ($obj as $o) {
    $resp .= '<tr>
    <th scope="row">' . $cont . '</th>
    <td>' . pesos($o["val_aporte"]) . '</td>
    <td>' . $o["nom_mes"] . '</td>
    <td>' . $o["anio_aporte"] . '</td>
    </tr>';
    $cont++;
}
$resp .= '</tbody>
</table>';
echo $resp;
