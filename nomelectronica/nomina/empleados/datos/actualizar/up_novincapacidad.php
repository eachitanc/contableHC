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
                seg_incapacidad
            WHERE id_incapacidad = '$id'";
    $rs = $cmd->query($sql);
    $incapacidad = $rs->fetch();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_tipo_incapacidad";
    $rs = $cmd->query($sql);
    $tipoincap = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$res .=
'<div id="divActuIncapacidad" class="shadow p-3 rounded fondo-sm">
    <form id="formUpIncapacidad">
        <input type="number" name="numidIncapacidad" value="'.$incapacidad['id_incapacidad'].'" hidden>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="slcUpTipIncapacidad">Tipo de incapacidad</label>
                <select id="slcUpTipIncapacidad" name="slcUpTipIncapacidad" class="form-control py-0" aria-label="Default select example">';
                    $fecinincap = $incapacidad['fec_inicio'];
                    $fecfinincap = $incapacidad['fec_fin'];
                    $incapactual = $incapacidad['id_tipo'];
                    $dias = $incapacidad['can_dias'];
                    foreach ($tipoincap as $tinc) {
                        if ($tinc['id_tipo'] !== $incapactual) {
                            $res .= '<option value="' . $tinc['id_tipo'] . '">' . mb_strtoupper($tinc['tipo']) . '</option>';
                        } else {
                            $res .= '<option selected value="' . $tinc['id_tipo'] . '">' . mb_strtoupper($tinc['tipo']) . '</option>';
                        }
                    }
    $res .= '</select>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecInicioIncap">Fecha Inicio</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecInicioIncap" name="datUpFecInicioIncap" value="'.$fecinincap.'">
                    <div id="edatUpFecInicioIncap" class="invalid-tooltip">
                        Inicio debe ser menor
                    </div>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecFinIncap">Fecha Fin</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecFinIncap" name="datUpFecFinIncap" value="'.$fecfinincap.'">
                    <div id="edatUpFecFinIncap" class="invalid-tooltip">
                        Fin debe ser mayor
                    </div>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label>Cantidad Días</label>
                <div class="form-control" id="divUpCantDiasIncap">
                    '.$dias.'
                    <input type="number" id="numUpCantDiasIncap" name="numUpCantDiasIncap" value="'.$dias.'" hidden>
                </div>
            </div>
        </div>
        <center>
            <button class="btn btn-primary btn-sm actualizar" id="btnUpIncapacidad">Actualizar</button>
            <a class="btn btn-danger btn-sm cancelar">Cancelar</a>
        </center>
    </form>
</div>';

echo $res;