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
                seg_incapacidad
            INNER JOIN seg_tipo_incapacidad 
                ON (seg_incapacidad.id_tipo = seg_tipo_incapacidad.id_tipo) 
            WHERE id_empleado ='$id'";
    $rs = $cmd->query($sql);
    $incapacidades = $rs->fetchAll();
    $sql = "SELECT *
            FROM
            seg_liq_incap";
    $rs = $cmd->query($sql);
    $liqincap = $rs->fetchAll();
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
if (!empty($incapacidades)) {
    foreach ($incapacidades as $i) {
        $idIncap = $i['id_incapacidad'];
        $key = array_search($idIncap, array_column($liqincap, 'id_incapacidad'));
        if (false !== $key) {
            $valor = $liqincap[$key]['pago_empresa'] + $liqincap[$key]['pago_eps'] + $liqincap[$key]['pago_arl'];
            $estado = 'disabled';
        } else {
            $valor = '0';
            $estado ='';
        }
        if ((intval($permisos['editar'])) === 1) {
            $editar = '<button value="' . $idIncap . '" class="btn btn-outline-primary btn-sm btn-circle editar" title="Editar" '.$estado.'><span class="fas fa-pencil-alt fa-lg"></span></button>';
        } else {
            $editar = null;
        }
        if ((intval($permisos['borrar'])) === 1) {
            $borrar = '<button value="' . $idIncap . '" class="btn btn-outline-danger btn-sm btn-circle borrar" title="Eliminar"><span class="fas fa-trash-alt fa-lg"></span></button>';
        } else {
            $borrar = null;
        }
        $data[] = [
            'id_incap' => $idIncap,
            'tipo' => mb_strtoupper($i['tipo']),
            'fec_inicio' => $i['fec_inicio'],
            'fec_fin' => $i['fec_fin'],
            'dias' => $i['can_dias'],
            'valor' => pesos($valor),
            'botones' => '<div class="center-block">' . $editar . $borrar . '</div>'
        ];
    }
} else {
    $data = [
        'id_incap' => '',
        'tipo' => '',
        'fec_inicio' => '',
        'fec_fin' => '',
        'dias' => '',
        'valor' => '',
        'botones' => '',
    ];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
