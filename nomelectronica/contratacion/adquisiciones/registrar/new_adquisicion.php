<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';
$modalidad = $_POST['slcModalidad'];
$id_empresa = '2';
$id_sede = '1';
$fec_adq = $_POST['datFecAdq'];
$fec_vig = $_POST['datFecVigencia'];
$objeto = $_POST['txtObjeto'];
$estado = '1';
$iduser = $_SESSION['id_user'];
$date = new DateTime('now', new DateTimeZone('America/Bogota'));

try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "INSERT INTO seg_adquisiciones (id_modalidad, id_empresa, id_sede, fecha_adquisicion, vigencia, objeto, estado, id_user_reg, fec_reg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $modalidad, PDO::PARAM_INT);
    $sql->bindParam(2, $id_empresa, PDO::PARAM_INT);
    $sql->bindParam(3, $id_sede, PDO::PARAM_INT);
    $sql->bindParam(4, $fec_adq, PDO::PARAM_STR);
    $sql->bindParam(5, $fec_vig, PDO::PARAM_STR);
    $sql->bindParam(6, $objeto, PDO::PARAM_STR);
    $sql->bindParam(7, $estado, PDO::PARAM_STR);
    $sql->bindParam(8, $iduser, PDO::PARAM_INT);
    $sql->bindValue(9, $date->format('Y-m-d H:i:s'));
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
