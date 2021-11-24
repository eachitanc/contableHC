<?php

session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';
$idemple = $_POST['idEmpSindicato'];
$sindicato = $_POST['slcSindicato'];
$porcentaje = str_replace(',', '.', $_POST['txtPorcentajeSind']) / 100;
$finsind = date('Y-m-d', strtotime($_POST['datFecInicioSind']));
if ($_POST['datFecFinSind'] === '') {
    $ffinsind;
} else {
    $ffinsind = date('Y-m-d', strtotime($_POST['datFecFinSind']));
}
$date = new DateTime('now', new DateTimeZone('America/Bogota'));
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "INSERT INTO seg_cuota_sindical (id_sindicato, id_empleado, porcentaje_cuota, fec_inicio, fec_fin, fec_reg) VALUES (?, ?, ?, ?, ?, ?)";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $sindicato, PDO::PARAM_INT);
    $sql->bindParam(2, $idemple, PDO::PARAM_INT);
    $sql->bindParam(3, $porcentaje, PDO::PARAM_STR);
    $sql->bindParam(4, $finsind, PDO::PARAM_STR);
    $sql->bindParam(5, $ffinsind, PDO::PARAM_STR);
    $sql->bindValue(6, $date->format('Y-m-d H:i:s'));
    $sql->execute();
    if ($cmd->lastInsertId() > 0) {
        echo '1';
    } else {
        print_r($sql->errorInfo()[2]);
    }
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
