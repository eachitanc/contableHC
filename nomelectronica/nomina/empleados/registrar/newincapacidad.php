<?php

session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';
$idemple = $_POST['idEmpIncapacidad'];
$tipincap = $_POST['slcTipIncapacidad'];
$inicio = date('Y-m-d', strtotime($_POST['datFecInicioIncap']));
$fin = date('Y-m-d', strtotime($_POST['datFecFinIncap']));
$cantdias = $_POST['numCantDiasIncap'];
$date = new DateTime('now', new DateTimeZone('America/Bogota'));
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "INSERT INTO seg_incapacidad (id_empleado, id_tipo, fec_inicio, fec_fin, can_dias, fec_reg) VALUES (?, ?, ?, ?, ?, ?)";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $idemple, PDO::PARAM_INT);
    $sql->bindParam(2, $tipincap, PDO::PARAM_INT);
    $sql->bindParam(3, $inicio, PDO::PARAM_STR);
    $sql->bindParam(4, $fin, PDO::PARAM_STR);
    $sql->bindParam(5, $cantdias, PDO::PARAM_INT);
    $sql->bindValue(6, $date->format('Y-m-d H:i:s'));
    $sql->execute();
    if ($cmd->lastInsertId() > 0) {
        echo '1';
    } else {
        print_r($sql->errorInfo()[2]);
    }
    $cmd = null;
} catch (PDOException $e) {
    echo  $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}