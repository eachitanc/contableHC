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
                seg_vacaciones
            WHERE id_vac = '$id'";
    $rs = $cmd->query($sql);
    $vacacion = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$res .=
'<div id="divActuVacacion" class="shadow p-3 rounded fondo-sm">
    <form id="formUpVacaciones">
        <input type="number" name="numidVacacion" value="'.$vacacion['id_vac'].'" hidden>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="slcUpVacAnticip">Anticipadas</label>
                <select id="slcUpVacAnticip" name="slcUpVacAnticip" class="form-control py-0" aria-label="Default select example">';
                    if ($vacacion['anticipo'] === '1') {
                        $uno = '1';
                        $dos = '2';
                        $si = 'Si';
                        $no = 'No';
                    } else {
                        $uno = '2';
                        $dos = '1';
                        $si = 'No';
                        $no = 'Si';
                    }
                    $res .= '<option selected value="' . $uno . '">' . $si . '</option><option value="' . $dos . '">' . $no . '</option>';
                    $fecinvac = $vacacion['fec_inicio'];
                    $fecfinvac = $vacacion['fec_fin'];
                    $vacact = $vacacion['id_vac'];
                    $diainac = $vacacion['dias_inactivo'];
                    $diahab = $vacacion['dias_habiles'];
            $res .= '</select>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecInicioVac">Fecha Inicio</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecInicioVac" name="datUpFecInicioVac" value="'.$fecinvac .'">
                    <div id="edatUpFecInicioVac" class="invalid-tooltip">
                        Inicio debe ser menor
                    </div>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecFinVac">Fecha Fin</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecFinVac" name="datUpFecFinVac" value="'.$fecfinvac.'">
                    <div id="edatUpFecFinVac" class="invalid-tooltip">
                        Fin debe ser mayor
                    </div>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label>Días inactivo</label>
                <div class="form-control" id="divUpCantDiasVac">
                    '.$diainac.'
                    <input type="number" id="numUpCantDiasVac" name="numUpCantDiasVac" value="'.$diainac.'" hidden>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="numUpCantDiasHabVac">Días hábiles</label>
                <input type="number" class="form-control" id="numUpCantDiasHabVac" name="numUpCantDiasHabVac" value="'.$diahab.'">
                <div id="enumUpCantDiasHabVac" class="invalid-tooltip">
                    Debe ser mayor a 0 y menor o igual a Dias inactivo
                </div>
            </div>
        </div>
        <center>
            <button class="btn btn-primary btn-sm actualizar" id="btnUpVacacion">Actualizar</button>
            <a class="btn btn-danger btn-sm cancelar">Cancelar</a>
        </center>
    </form>
</div>';

echo $res;