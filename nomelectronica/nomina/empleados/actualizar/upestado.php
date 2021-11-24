<?php

session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';
$idemp = $_POST['idemp'];
$estad = "";
$date = new DateTime('now', new DateTimeZone('America/Bogota'));
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "SELECT estado FROM seg_empleado WHERE id_empleado = '$idemp'";
    $rs = $cmd->query($sql);
    $obj = $rs->fetch();
    if ($obj['estado'] === '1') {
        $estad = '0';
    } else {
        $estad = '1';
    }
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sqlup = "UPDATE seg_empleado SET estado = ?, fec_actu = ? WHERE id_empleado = ?";
    $sqlup = $cmd->prepare($sqlup);
    $sqlup->bindParam(1, $estad);
    $sqlup->bindValue(2, $date->format('Y-m-d H:i:s'));
    $sqlup->bindParam(3, $idemp);
    $sqlup->execute();
    if ($sqlup->rowCount() > 0) {
        if ($estad === '0') {
            echo '<i class="fas fa-toggle-off fa-lg" style="color:gray;"></i>';
        } else {
            echo '<i class="fas fa-toggle-on fa-lg" style="color:#37E146;"></i>';
        }
    } else {
        echo  $sqlup->errorInfo();
    }
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
