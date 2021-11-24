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
    $sql = "SELECT *
            FROM
                seg_libranzas
            INNER JOIN seg_bancos 
                ON (seg_libranzas.id_banco = seg_bancos.id_banco) 
            WHERE id_empleado = '$id'";
    $rs = $cmd->query($sql);
    $libranzas = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT seg_liq_libranza.id_libranza, id_empleado, SUM(val_mes_lib) AS pagado, COUNT(seg_liq_libranza.id_libranza) AS cuotas
            FROM
                seg_liq_libranza
            INNER JOIN seg_libranzas 
                ON (seg_liq_libranza.id_libranza = seg_libranzas.id_libranza)
            GROUP BY id_libranza";
    $rs = $cmd->query($sql);
    $pagosLib = $rs->fetchAll();
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
if (!empty($libranzas)) {
    foreach ($libranzas as $li) {
        if ((intval($permisos['editar'])) === 1) {
            $editar = '<button value="' . $li['id_libranza'] . '" class="btn btn-outline-primary btn-sm btn-circle editar" title="Editar"><span class="fas fa-pencil-alt fa-lg"></span></button>';
        } else {
            $editar = null;
        }
        if ((intval($permisos['borrar'])) === 1) {
            $borrar = '<button value="' . $li['id_libranza'] . '" class="btn btn-outline-danger btn-sm btn-circle borrar" title="Eliminar"><span class="fas fa-trash-alt fa-lg"></span></button>';
        } else {
            $borrar = null;
        }
        $idlib = $li['id_libranza'];
        $key = array_search($idlib, array_column($pagosLib, 'id_libranza'));
        if (false !== $key) {
            $pago = $pagosLib[$key]['pagado'];
            $cuotas = $pagosLib[$key]['cuotas'];
        } else {
            $pago = '0';
            $cuotas = '0';
        }
        $data[] = [
            'id_libranza' => $li['id_libranza'],
            'nom_banco' => $li['nom_banco'],
            'valor_total' => pesos($li['valor_total']),
            'cuotas' => $li['cuotas'],
            'val_mes' => pesos($li['val_mes']),
            'porcentaje' => $li['porcentaje'] * 100 . '%',
            'val_pagado' => pesos($pago),
            'cuotas_pag' => $cuotas,
            'fecha_inicio' => $li['fecha_inicio'],
            'fecha_fin' => $li['fecha_fin'],
            'botones' => '<div class="center-block">' . $editar . $borrar . '<button id= "datalles_' . $idlib. '" class="btn btn-outline-warning btn-sm btn-circle btn-change" title="Detalles Libranza"><i value="' . $idlib. '" class="far fa-eye fa-lg i-change"></i></button></div>'
        ];
    }
} else {
    $data = [
        'id_libranza' => '',
        'nom_banco' => '',
        'valor_total' => '',
        'cuotas' => '',
        'val_mes' => '',
        'porcentaje' => '',
        'val_pagado' => '',
        'cuotas_pag' => '',
        'fecha_inicio' => '',
        'fecha_fin' => '',
        'botones' => '',
    ];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
