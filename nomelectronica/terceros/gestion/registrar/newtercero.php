<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';
$tipotercero = $_POST['slcTipoTercero'];
$fecInicio = date('Y-m-d', strtotime($_POST['datFecInicio']));
$genero = $_POST['slcGenero'];
$fecNacimiento = date('Y-m-d', strtotime($_POST['datFecNacimiento']));
$tipodoc = $_POST['slcTipoDocEmp'];
$cc_nit = $_POST['txtCCempleado'];
$nomb1 = $_POST['txtNomb1Emp'];
$nomb2 = $_POST['txtNomb2Emp'];
$ape1 = $_POST['txtApe1Emp'];
$ape2 = $_POST['txtApe2Emp'];
$razonsoc = $_POST['txtRazonSocial'];
$pais = $_POST['slcPaisEmp'];
$dpto = $_POST['slcDptoEmp'];
$municip = $_POST['slcMunicipioEmp'];
$dir = $_POST['txtDireccion'];
$mail = $_POST['mailEmp'];
$tel = $_POST['txtTelEmp'];
$estado = '1';
$iduser = $_SESSION['id_user'];
$tipouser = 'user';
$nit_crea = $_SESSION['nit_emp'];
$pass = $_POST['passT'];
$date = new DateTime('now', new DateTimeZone('America/Bogota'));
//API URL
$url = 'http://localhost/api/terceros/datos/res/lista/' . $cc_nit;
$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
$terceros = json_decode($result, true);
$regAtTerc = 'NO';
$res = '';
if ($terceros !== '0') {
    $regAtTerc = 'SI';
} else {
    //API URL
    $url = 'http://localhost/api/terceros/datos/res/nuevo';
    $ch = curl_init($url);
    $data = [
        "slcTipoTercero" => $tipotercero,
        "slcGenero" => $genero,
        "datFecNacimiento" => $fecNacimiento,
        "slcTipoDocEmp" => $tipodoc,
        "txtCCempleado" => $cc_nit,
        "txtNomb1Emp" => $nomb1,
        "txtNomb2Emp" => $nomb2,
        "txtApe1Emp" => $ape1,
        "txtApe2Emp" => $ape2,
        "txtRazonSocial" => $razonsoc,
        "slcPaisEmp" => $pais,
        "slcDptoEmp" => $dpto,
        "slcMunicipioEmp" => $municip,
        "txtDireccion" => $dir,
        "mailEmp" => $mail,
        "txtTelEmp" => $tel,
        "id_user" => $iduser,
        "nit_emp" => $nit_crea,
        "pass" => $pass,
    ];
    $payload = json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $res = json_decode($result, true);
}
if ($res === '1' || $regAtTerc = 'SI') {
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $sql = "INSERT INTO seg_terceros(tipo_doc, id_tipo_tercero, no_doc, estado, fec_inicio, id_user_reg, fec_reg) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $sql = $cmd->prepare($sql);
        $sql->bindParam(1, $tipodoc, PDO::PARAM_INT);
        $sql->bindParam(2, $tipotercero, PDO::PARAM_INT);
        $sql->bindParam(3, $cc_nit, PDO::PARAM_STR);
        $sql->bindParam(4, $estado, PDO::PARAM_STR);
        $sql->bindParam(5, $fecInicio, PDO::PARAM_STR);
        $sql->bindParam(6, $iduser, PDO::PARAM_INT);
        $sql->bindValue(7, $date->format('Y-m-d H:i:s'));
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
} else {
    echo 'No se pudo Ristrar';
}
