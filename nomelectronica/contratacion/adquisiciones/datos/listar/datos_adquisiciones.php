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
    $sql = "SELECT modalidad, id_adquisicion, fecha_adquisicion, objeto, estado
            FROM
                seg_adquisiciones
            INNER JOIN seg_modalidad_contrata 
                ON (seg_adquisiciones.id_modalidad = seg_modalidad_contrata.id_modalidad)";
    $rs = $cmd->query($sql);
    $ladquis = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
if (!empty($ladquis)) {
    foreach ($ladquis as $la) {
        $id_adq = $la['id_adquisicion'];
        if ((intval($permisos['editar'])) === 1) {
            $editar = '<a value="' . $id_adq . '" class="btn btn-outline-primary btn-sm btn-circle shadow-gb editar" title="Editar"><span class="fas fa-pencil-alt fa-lg"></span></a>';
            $detalles = '<a value="' . $id_adq . '" class="btn btn-outline-warning btn-sm btn-circle shadow-gb detalles" title="Detalles"><span class="fas fa-eye fa-lg"></span></a>';
        } else {
            $editar = null;
            $detalles = null;
        }
        if ((intval($permisos['borrar'])) === 1) {
            $borrar = '<a value="' . $id_adq . '" class="btn btn-outline-danger btn-sm btn-circle shadow-gb borrar" title="Eliminar"><span class="fas fa-trash-alt fa-lg"></span></a>';
        } else {
            $borrar = null;
        }
        $data[] = [
            'modalidad' => $la['modalidad'],
            'adquisicion' => 'ADQ-' . $id_adq,
            'fecha' => $la['fecha_adquisicion'],
            'objeto' => $la['objeto'],
            'estado' => $la['estado'],
            'botones' => '<div class="text-center">' . $editar . $borrar . $detalles . '</div>',
        ];
    }
} else {
    $data = [];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
