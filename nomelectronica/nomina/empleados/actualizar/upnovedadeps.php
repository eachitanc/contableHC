<?php

session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';

$idnov = $_POST['numidnov'];
$ideps = $_POST['slcUpNovEps'];
$fafil = date('Y-m-d', strtotime($_POST['datFecAfilUpNovEps']));
if ($_POST['datFecRetUpNovEps'] === '') {
    $fret;
} else {
    $fret = date('Y-m-d', strtotime($_POST['datFecRetUpNovEps']));
}
$date = new DateTime('now', new DateTimeZone('America/Bogota'));
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "UPDATE seg_novedades_eps SET id_eps = ?, fec_afiliacion= ?, fec_retiro = ? WHERE id_novedad = ?";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $ideps, PDO::PARAM_INT);
    $sql->bindParam(2, $fafil, PDO::PARAM_STR);
    $sql->bindParam(3, $fret, PDO::PARAM_STR);
    $sql->bindParam(4, $idnov, PDO::PARAM_INT);
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
        $sql = "UPDATE seg_novedades_eps SET  fec_act = ? WHERE id_novedad = ?";
        $sql = $cmd->prepare($sql);
        $sql->bindValue(1, $date->format('Y-m-d H:i:s'));
        $sql->bindParam(2, $idnov, PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            echo '1';
        } else {
            print_r($sql->errorInfo()[2]);
        }
    } else {
        echo 'No se ingresó ningún dato nuevo';
    }
    $cmd = null;
} catch (PDOException $e) {
   echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
