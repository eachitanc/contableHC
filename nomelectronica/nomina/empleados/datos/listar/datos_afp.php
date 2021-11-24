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
    $sql = "SELECT id_novafp, seg_novedades_afp.id_afp, nombre_afp, CONCAT(nit_afp, '-',dig_verf) AS nitafp, fec_afiliacion, seg_novedades_afp.fec_retiro
            FROM
                seg_novedades_afp
            INNER JOIN seg_afp 
                ON (seg_novedades_afp.id_afp = seg_afp.id_afp)
            INNER JOIN seg_empleado 
                ON (seg_novedades_afp.id_empleado = seg_empleado.id_empleado)
            WHERE seg_empleado.id_empleado = '$id'
            ORDER BY fec_afiliacion ASC";
    $rs = $cmd->query($sql);
    $afp = $rs->fetchAll();
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
if (!empty($afp)) {
    foreach ($afp as $a) {
        if ((intval($permisos['editar'])) === 1) {
            $editar = '<button value="' . $a['id_novafp'] . '" class="btn btn-outline-primary btn-sm btn-circle editar" title="Editar"><span class="fas fa-pencil-alt fa-lg"></span></button>';
        } else {
            $editar = null;
        }
        if ((intval($permisos['borrar'])) === 1) {
            $borrar = '<button value="' . $a['id_novafp'] . '" class="btn btn-outline-danger btn-sm btn-circle borrar" title="Eliminar"><span class="fas fa-trash-alt fa-lg"></span></button>';
        } else {
            $borrar = null;
        }
        $data[] = [
            'id_novafp' => $a['id_novafp'],
            'nombre_afp' => $a['nombre_afp'],
            'nitafp' => $a['nitafp'],
            'fec_afiliacion' => $a['fec_afiliacion'],
            'fec_retiro' => $a['fec_retiro'],
            'botones' => '<div class="center-block">'.$editar. $borrar.'</div>'
        ];
    }
} else {
    $data = [
        'id_novafp' => '',
        'nombre_afp' => '',
        'nitafp' => '',
        'fec_afiliacion' => '',
        'fec_retiro' => '',
        'botones' => '',
    ];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
