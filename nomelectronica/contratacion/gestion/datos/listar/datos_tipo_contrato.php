<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
include '../../../../permisos.php';
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT seg_tipo_contrata.id_tipo, tipo_compra, tipo_contrato
            FROM
                seg_tipo_contrata
            INNER JOIN seg_tipo_compra 
                ON (seg_tipo_contrata.id_tipo_compra = seg_tipo_compra.id_tipo)";
    $rs = $cmd->query($sql);
    $tcontrato = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
if (!empty($tcontrato)) {
    foreach ($tcontrato as $tc) {
        $id_tc = $tc['id_tipo'];
        if ((intval($permisos['editar'])) === 1) {
            $editar = '<a value="' . $id_tc . '" class="btn btn-outline-primary btn-sm btn-circle shadow-gb editar" title="Editar"><span class="fas fa-pencil-alt fa-lg"></span></a>';
        } else {
            $editar = null;
        }
        if ((intval($permisos['borrar'])) === 1) {
            $borrar = '<a value="' . $id_tc . '" class="btn btn-outline-danger btn-sm btn-circle shadow-gb borrar" title="Eliminar"><span class="fas fa-trash-alt fa-lg"></span></a>';
        } else {
            $borrar = null;
        }
        $data[] = [
            'tipo_compra' => $tc['tipo_compra'],
            'tipo_contrato' => $tc['tipo_contrato'],
            'botones' => '<div class="text-center">' .$editar. $borrar . '</div>',
        ];
    }
} else {
    $data = [];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
