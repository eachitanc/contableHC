<?php
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}
session_start();
include '../../conexion.php';

$iduser = $_SESSION['del'];


try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "DELETE FROM seg_usuarios  WHERE id_usuario = ?";
    $sql = $cmd-> prepare($sql);
    $sql -> bindParam(1, $iduser, PDO::PARAM_INT);
    $sql->execute();
    if($sql->rowCount() > 0){
        $res = '1';
    }
    else{
        $res = print_r($cmd->errorInfo());
    }
    $cmd = null;
} catch (PDOException $e) {
    $res['mensaje'] = $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
echo $res;

