<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
$id = $_POST['id'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM
            seg_licenciasmp
            WHERE id_empleado ='$id'";
    $rs = $cmd->query($sql);
    $licencias = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$iduser = $_SESSION['id_user'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT * FROM seg_permisos_usuario WHERE id_usuario = '$iduser'";
    $rs = $cmd->query($sql);
    $permisos = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
if (!empty($licencias)) {
    foreach ($licencias as $l) {
        $idLic = $l['id_licmp'];
        if ((intval($permisos['editar'])) === 1) {
            $editar = '<button value="' . $idLic . '" class="btn btn-outline-primary btn-sm btn-circle editar" title="Editar"><span class="fas fa-pencil-alt fa-lg"></span></button>';
        } else {
            $editar = null;
        }
        if ((intval($permisos['borrar'])) === 1) {
            $borrar = '<button value="' . $idLic . '" class="btn btn-outline-danger btn-sm btn-circle borrar" title="Eliminar"><span class="fas fa-trash-alt fa-lg"></span></button>';
        } else {
            $borrar = null;
        }
        $data[] = [
            'id_lic' => $idLic,
            'fec_inicio' => $l['fec_inicio'],
            'fec_fin' => $l['fec_fin'],
            'dias_inactivo' => $l['dias_inactivo'],
            'dias_hab' => $l['dias_habiles'],
            'botones' => '<div class="center-block">' . $editar . $borrar . '</div>'
        ];
    }
} else {
    $data = [
        'id_lic' => '',
        'fec_inicio' => '',
        'fec_fin' => '',
        'dias_inactivo' => '',
        'dias_hab' => '',
        'botones' => '',
    ];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
