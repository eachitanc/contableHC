<?php

session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';
$vigencia = $_SESSION['vigencia'];
$tipoemp = $_POST['slcTipoEmp'];
$subtipemp = $_POST['slcSubTipoEmp'];
$slcaltriesg = $_POST['slcAltoRiesgo'];
$tipocontrat = $_POST['slcTipoContratoEmp'];
$tipodoc = $_POST['slcTipoDocEmp'];
$cc = $_POST['txtCCempleado'];
$genero = $_POST['slcGenero'];
$nomb1 = $_POST['txtNomb1Emp'];
$nomb2 = $_POST['txtNomb2Emp'];
$ape1 = $_POST['txtApe1Emp'];
$ape2 = $_POST['txtApe2Emp'];
$fecha = date('Y-m-d', strtotime($_POST['datInicio']));
$salintegral = $_POST['slcSalIntegral'];
$sal = str_replace(',', '', $_POST['numSalarioEmp']);
$mail = $_POST['mailEmp'];
$tel = $_POST['txtTelEmp'];
$cargo = $_POST['slcCargoEmp'];
$pais = $_POST['slcPaisEmp'];
$dpto = $_POST['slcDptoEmp'];
$municip = $_POST['slcMunicipioEmp'];
$dir = $_POST['txtDireccion'];
$banco = $_POST['slcBancoEmp'];
$tipcta = $_POST['selTipoCta'];
$numcta = $_POST['txtCuentaBanc'];
$est = $_POST['numEstadoEmp'];
$eps = $_POST['slcEps'];
$afileps = date('Y-m-d', strtotime($_POST['datFecAfilEps']));
$reteps = date('Y-m-d', strtotime($_POST['datFecRetEps']));
$arl = $_POST['slcArl'];
$afilarl = date('Y-m-d', strtotime($_POST['datFecAfilArl']));
$retarl = date('Y-m-d', strtotime($_POST['datFecRetArl']));
$rl = $_POST['slcRiesLab'];
$afp = $_POST['slcAfp'];
$afilafp = date('Y-m-d', strtotime($_POST['datFecAfilAfp']));
$retafp = date('Y-m-d', strtotime($_POST['datFecRetAfp']));
$date = new DateTime('now', new DateTimeZone('America/Bogota'));

try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "SELECT * FROM seg_empleado WHERE no_documento = '$cc'";
    $rs = $cmd->query($sql);
    if ($rs->rowCount() > 0) {
        echo '0';
    } else {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $sql = "INSERT INTO seg_empleado(tipo_empleado, subtipo_empleado, alto_riesgo_pension, tipo_contrato, tipo_doc, no_documento, nombre1, nombre2, apellido1, apellido2, fech_inicio, salario_integral, correo, telefono, cargo, pais, departamento, municipio, direccion, id_banco, tipo_cta, cuenta_bancaria, estado, genero, fec_reg) "
            . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql = $cmd->prepare($sql);
        $sql->bindParam(1, $tipoemp, PDO::PARAM_INT);
        $sql->bindParam(2, $subtipemp, PDO::PARAM_INT);
        $sql->bindParam(3, $slcaltriesg, PDO::PARAM_INT);
        $sql->bindParam(4, $tipocontrat, PDO::PARAM_INT);
        $sql->bindParam(5, $tipodoc, PDO::PARAM_INT);
        $sql->bindParam(6, $cc, PDO::PARAM_STR);
        $sql->bindParam(7, $nomb1, PDO::PARAM_STR);
        $sql->bindParam(8, $nomb2, PDO::PARAM_STR);
        $sql->bindParam(9, $ape1, PDO::PARAM_STR);
        $sql->bindParam(10, $ape2, PDO::PARAM_STR);
        $sql->bindParam(11, $fecha, PDO::PARAM_STR);
        $sql->bindParam(12, $salintegral, PDO::PARAM_INT);
        $sql->bindParam(13, $mail, PDO::PARAM_STR);
        $sql->bindParam(14, $tel, PDO::PARAM_STR);
        $sql->bindParam(15, $cargo, PDO::PARAM_INT);
        $sql->bindParam(16, $pais, PDO::PARAM_INT);
        $sql->bindParam(17, $dpto, PDO::PARAM_INT);
        $sql->bindParam(18, $municip, PDO::PARAM_INT);
        $sql->bindParam(19, $dir, PDO::PARAM_STR);
        $sql->bindParam(20, $banco, PDO::PARAM_INT);
        $sql->bindParam(21, $tipcta, PDO::PARAM_INT);
        $sql->bindParam(22, $numcta, PDO::PARAM_STR);
        $sql->bindParam(23, $est, PDO::PARAM_INT);
        $sql->bindParam(24, $genero, PDO::PARAM_STR);
        $sql->bindValue(25, $date->format('Y-m-d H:i:s'));
        $sql->execute();
        $idinsert = $cmd->lastInsertId();
        if ($idinsert > 0) {
            $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
            $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            $sql = "INSERT INTO seg_novedades_eps (id_empleado, id_eps, fec_afiliacion, fec_retiro, fec_reg) VALUES (?, ?, ?, ?, ?)";
            $sql = $cmd->prepare($sql);
            $sql->bindParam(1, $idinsert, PDO::PARAM_INT);
            $sql->bindParam(2, $eps, PDO::PARAM_INT);
            $sql->bindParam(3, $afileps, PDO::PARAM_STR);
            $sql->bindParam(4, $reteps, PDO::PARAM_STR);
            $sql->bindValue(5, $date->format('Y-m-d H:i:s'));
            $sql->execute();
            if ($cmd->lastInsertId() > 0) {
                $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
                $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                $sql = "INSERT INTO seg_novedades_arl (id_empleado, id_arl, id_riesgo, fec_afiliacion, fec_retiro, fec_reg) VALUES (?, ?, ?, ?, ?, ?)";
                $sql = $cmd->prepare($sql);
                $sql->bindParam(1, $idinsert, PDO::PARAM_INT);
                $sql->bindParam(2, $arl, PDO::PARAM_INT);
                $sql->bindParam(3, $rl, PDO::PARAM_INT);
                $sql->bindParam(4, $afilarl, PDO::PARAM_STR);
                $sql->bindParam(5, $retarl, PDO::PARAM_STR);
                $sql->bindValue(6, $date->format('Y-m-d H:i:s'));
                $sql->execute();
                if ($cmd->lastInsertId() > 0) {
                    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
                    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                    $sql = "INSERT INTO seg_novedades_afp (id_empleado, id_afp, fec_afiliacion, fec_retiro, fec_reg) VALUES (?, ?, ?, ?, ?)";
                    $sql = $cmd->prepare($sql);
                    $sql->bindParam(1, $idinsert, PDO::PARAM_INT);
                    $sql->bindParam(2, $afp, PDO::PARAM_INT);
                    $sql->bindParam(3, $afilafp, PDO::PARAM_STR);
                    $sql->bindParam(4, $retafp, PDO::PARAM_STR);
                    $sql->bindValue(5, $date->format('Y-m-d H:i:s'));
                    $sql->execute();
                    if ($cmd->lastInsertId() > 0) {
                        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
                        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                        $sql = "INSERT INTO seg_salarios_basico (id_empleado, vigencia, salario_basico, fec_reg) VALUES (?, ?, ?, ?)";
                        $sql = $cmd->prepare($sql);
                        $sql->bindParam(1, $idinsert, PDO::PARAM_INT);
                        $sql->bindParam(2, $vigencia, PDO::PARAM_STR);
                        $sql->bindParam(3, $sal, PDO::PARAM_STR);
                        $sql->bindValue(4, $date->format('Y-m-d H:i:s'));
                        $sql->execute();
                        if ($cmd->lastInsertId() > 0) {
                            echo '1';
                        } else {
                           print_r($sql->errorInfo()[2]);
                        }
                    } else {
                        print_r($sql->errorInfo()[2]);
                    }
                } else {
                    print_r($sql->errorInfo()[2]);
                }
            } else {
                print_r($sql->errorInfo()[2]);
            }
        } else {
            print_r($sql->errorInfo()[2]);
        }
    }
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}