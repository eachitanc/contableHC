<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
$id = $_POST['id'];
function pesos($valor)
{
    return '$' . number_format($valor, 2);
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM
                seg_cuota_sindical
            INNER JOIN seg_sindicatos 
                ON (seg_cuota_sindical.id_sindicato = seg_sindicatos.id_sindicato)
            WHERE id_empleado ='$id'";
    $rs = $cmd->query($sql);
    $sindicatos = $rs->fetchAll();
    $sql = "SELECT id_cuota_sindical, SUM(val_aporte) AS aportes, COUNT(val_aporte) AS cant_aportes
            FROM
                seg_liq_sindicato_aportes
            GROUP BY id_cuota_sindical";
    $rs = $cmd->query($sql);
    $tot_aportes = $rs->fetchAll();
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
if (!empty($sindicatos)) {
    foreach ($sindicatos as $s) {
        $idSind = $s['id_cuota_sindical'];
        if ((intval($permisos['editar'])) === 1) {
            $editar = '<button value="' . $idSind . '" class="btn btn-outline-primary btn-sm btn-circle editar" title="Editar"><span class="fas fa-pencil-alt fa-lg"></span></button>';
        } else {
            $editar = null;
        }
        if ((intval($permisos['borrar'])) === 1) {
            $borrar = '<button value="' . $idSind . '" class="btn btn-outline-danger btn-sm btn-circle borrar" title="Eliminar"><span class="fas fa-trash-alt fa-lg"></span></button>';
        } else {
            $borrar = null;
        }
        $key = array_search($idSind, array_column($tot_aportes, 'id_cuota_sindical'));
        if (false !== $key) {
            $aportes = $tot_aportes[$key]['aportes'];
            $cant_aportes = $tot_aportes[$key]['cant_aportes'];
        } else {
            $aportes = '0';
            $cant_aportes = '0';
        }
        $data[] = [
            'id_aporte' => $idSind,
            'sindicato' => mb_strtoupper($s['nom_sindicato']),
            'porcentaje' => $s['porcentaje_cuota']*100 .'%',
            'cantidad_aportes' => $cant_aportes,
            'total_aportes' => pesos($aportes),
            'fec_inicio' => $s['fec_inicio'],
            'fec_fin' => $s['fec_fin'],
            'botones' => '<div class="center-block">' . $editar . $borrar . '<button id= "datallesSind_' . $idSind . '" class="btn btn-outline-warning btn-sm btn-circle btn-change" title="Detalles Sindicato"><i value="' . $idSind . '" class="far fa-eye fa-lg i-change"></i></button></div>'
        ];
    }
} else {
    $data = [
        'id_aporte' => '',
        'sindicato' => '',
        'porcentaje' => '',
        'cantidad_aportes' => '',
        'total_aportes' => '',
        'fecha_inicio' => '',
        'fecha_fin' => '',
        'botones' => '',
    ];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
