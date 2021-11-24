<?php
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}
session_start();
$id = $_POST['idus'];
$_SESSION['del'] = $id;
$res = "Desea eliminar el actual registro: ".$id."?";

echo $res;
