<?php
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}
session_start();
include '../../conexion.php';
$iduser = $_POST['idus'];
$estad = "";
$date = new DateTime('now', new DateTimeZone('America/Bogota'));
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT estado FROM seg_usuarios WHERE id_usuario = '$iduser'";
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
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "UPDATE seg_usuarios SET estado = ?, fec_act = ? WHERE id_usuario = ?";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $estad, PDO::PARAM_INT);
    $sql->bindValue(2, $date->format('Y-m-d H:i:s'));
    $sql->bindParam(3, $iduser, PDO::PARAM_INT);
    $sql->execute();


    if ($sql->rowCount() > 0) {
        if ($estad === '0') {
            echo '<i class="fas fa-toggle-off fa-lg" style="color:gray;"></i>';
        } else {
            echo '<i class="fas fa-toggle-on fa-lg" style="color:#37E146;"></i>';
        }
    } else {
        echo $res = print_r($cmd->errorInfo());
    }
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}


    