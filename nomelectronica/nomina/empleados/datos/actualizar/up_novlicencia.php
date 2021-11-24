<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
$id = $_POST['id'];
$res = '';
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "SELECT *
            FROM
                seg_licenciasmp
            WHERE id_licmp = '$id'";
    $rs = $cmd->query($sql);
    $licencia = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$res .=
'<div id="divActuLicencia" class="shadow p-3 rounded fondo-sm">
    <form id="formUpLicencia">
        <input type="number" name="numidLicencia" value="'.$licencia['id_licmp'].'" hidden>
        <div class="form-row">';
            $fecinlic = $licencia['fec_inicio'];
            $fecfinlic = $licencia['fec_fin'];
            $licact = $licencia['id_licmp'];
            $diainac = $licencia['dias_inactivo'];
            $diahab = $licencia['dias_habiles'];
            $res .= '<div class="form-group col-md-4">
                <label for="datUpFecInicioLic">Fecha Inicio</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecInicioLic" name="datUpFecInicioLic" value="'.$fecinlic.'">
                    <div id="edatUpFecInicioLic" class="invalid-tooltip">
                        Inicio debe ser menor
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="datUpFecFinLic">Fecha Fin</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecFinLic" name="datUpFecFinLic" value="'.$fecfinlic.'">
                    <div id="edatUpFecFinLic" class="invalid-tooltip">
                        Fin debe ser mayor
                    </div>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label>Días inactivo</label>
                <div class="form-control" id="divUpCantDiasLic">
                    '.$diainac.'
                    <input type="number" id="numUpCantDiasLic" name="numUpCantDiasLic" value="'.$diainac .'" hidden>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="numUpCantDiasHabLic">Días hábiles</label>
                <input type="number" class="form-control" id="numUpCantDiasHabLic" name="numUpCantDiasHabLic" value="'.$diahab.'">
                <div id="enumUpCantDiasHabLic" class="invalid-tooltip">
                    Debe ser mayor a 0 y menor o igual a Dias inactivo
                </div>
            </div>
        </div>
        <center>
            <button class="btn btn-primary btn-sm actualizar" id="btnUpLicencia">Actualizar</button>
            <a class="btn btn-danger btn-sm cancelar">Cancelar</a>
        </center>
    </form>
</div>';

echo $res;