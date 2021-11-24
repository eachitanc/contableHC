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
    $sql = "SELECT id_novedad, seg_epss.id_eps, nombre_eps, CONCAT(nit, '-', digito_verific) AS nit, fec_afiliacion, fec_retiro
            FROM
                seg_novedades_eps
            INNER JOIN seg_epss 
                ON (seg_novedades_eps.id_eps = seg_epss.id_eps)
            WHERE id_empleado = '$id'
                ORDER BY fec_afiliacion DESC";
    $rs = $cmd->query($sql);
    $eps = $rs->fetchAll();
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
if (!empty($eps)) {
    foreach ($eps as $e) {
        if ((intval($permisos['editar'])) === 1) {
            $editar = '<button value="' . $e['id_novedad'] . '" class="btn btn-outline-primary btn-sm btn-circle editar" title="Editar"><span class="fas fa-pencil-alt fa-lg"></span></button>';
        } else {
            $editar = null;
        }
        if ((intval($permisos['borrar'])) === 1) {
            $borrar = '<button value="' . $e['id_novedad'] . '" class="btn btn-outline-danger btn-sm btn-circle borrar" title="Eliminar"><span class="fas fa-trash-alt fa-lg"></span></button>';
        } else {
            $borrar = null;
        }
        $data[] = [
            'id_novedad' => $e['id_novedad'],
            'nombre_eps' => $e['nombre_eps'],
            'nit' => $e['nit'],
            'fec_afiliacion' => $e['fec_afiliacion'],
            'fec_retiro' => $e['fec_retiro'],
            'botones' => '<div class="center-block">'.$editar.$borrar.'</div>'
        ];
    }
} else {
    $data = [
        'id_novedad' => '',
        'nombre_eps' => '',
        'nit' => '',
        'fec_afiliacion' => '',
        'fec_retiro' => '',
        'botones' => ''
    ];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
