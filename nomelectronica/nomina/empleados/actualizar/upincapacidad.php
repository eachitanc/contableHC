<?php

session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';
$idincap = $_POST['numidIncapacidad'];
$idtipincap = $_POST['slcUpTipIncapacidad'];
$fini = date('Y-m-d', strtotime($_POST['datUpFecInicioIncap']));
$ffin = date('Y-m-d', strtotime($_POST['datUpFecFinIncap']));
$dias = $_POST['numUpCantDiasIncap'];
$date = new DateTime('now', new DateTimeZone('America/Bogota'));
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "UPDATE seg_incapacidad SET id_tipo = ?, fec_inicio = ?, fec_fin = ?,  can_dias = ? WHERE id_incapacidad = ?";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $idtipincap, PDO::PARAM_INT);
    $sql->bindParam(2, $fini, PDO::PARAM_STR);
    $sql->bindParam(3, $ffin, PDO::PARAM_STR);
    $sql->bindParam(4, $dias, PDO::PARAM_INT);
    $sql->bindParam(5, $idincap, PDO::PARAM_INT);
    $sql->execute();
    if ($sql->rowCount() > 0) {
        $updata = 1;
    } else {
        $updata = 0;
    }
    if (!($sql->execute())) {
        print_r($sql->errorInfo()[2]);
        exit();
    }
    if ($updata > 0) {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $sql = "UPDATE seg_incapacidad SET  fec_act = ? WHERE id_incapacidad = ?";
        $sql = $cmd->prepare($sql);
        $sql->bindValue(1, $date->format('Y-m-d H:i:s'));
        $sql->bindParam(2, $idincap, PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            echo '1';
        } else {
            print_r($sql->errorInfo()[2]);
        }
    } else {
        echo 'No se registró ningún dato nuevo.';
    }
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
