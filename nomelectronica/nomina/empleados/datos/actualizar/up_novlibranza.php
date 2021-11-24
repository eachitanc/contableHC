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
                    seg_libranzas
                WHERE id_libranza = '$id'";
    $rs = $cmd->query($sql);
    $libranza = $rs->fetch();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_bancos ORDER BY nom_banco ASC";
    $rs = $cmd->query($sql);
    $bancos = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$res .= '<div id="divActuLibranza" class="shadow p-3 rounded fondo-sm">
    <form id="formUpLibranza">
        <input type="number" name="numidLibranza" value="'.$libranza['id_libranza'].'" hidden="true">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="slcUpEntidad">Entidad Financiera</label>
                <select id="slcUpEntidad" name="slcUpEntidad" class="form-control py-0" aria-label="Default select example">';
                    $valtotal = $libranza['valor_total'];
                    $cuotas = $libranza['cuotas'];
                    $desclib = $libranza['descripcion_lib'];
                    $valmes = $libranza['val_mes'];
                    $porcen = $libranza['porcentaje'] * 100;
                    $fecin = $libranza['fecha_inicio'];
                    $fecfin = $libranza['fecha_fin'];
                    $idlibranza = $libranza['id_libranza'];
                    $bancoactual = $libranza['id_banco'];
                    foreach ($bancos as $b) {
                        if ($b['id_banco'] !== $bancoactual) {
                            $res .= '<option value="' . $b['id_banco'] . '">' . $b['nom_banco'] . '</option>';
                        } else {
                            $res .= '<option selected value="' . $b['id_banco'] . '">' . $b['nom_banco'] . '</option>';
                        }
                    }

        $res .= '</select>
            </div>
            <div class="form-group col-md-3">
                <label for="numUpValTotal">Valor Total</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="numUpValTotal" name="numUpValTotal" value="'.$valtotal.'" min="1" placeholder="Total libranza">
                </div>
                <div id="enumUpValTotal" class="invalid-tooltip">
                    Diligenciar este campo
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="numUpTotCuotasLib">Cuotas Totales</label>
                <div class="form-group">
                    <input type="number" class="form-control" id="numUpTotCuotasLib" name="numUpTotCuotasLib" value="'.$cuotas.'" min="1" placeholder="Cant. de cuotas">
                </div>
                <div id="enumUpTotCuotasLib" class="invalid-tooltip">
                    Debe ser mayor a 0
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="txtUpDescripLib">Descripción</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="txtUpDescripLib" name="txtUpDescripLib" value="'.$desclib.'" placeholder="Descripción de la libranza">
                    <div id="etxtUpDescripLib" class="invalid-tooltip">
                        Campo Obligatorio
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="txtUpValLibMes">Valor mes</label>
                <div class="form-group">
                    <input type="number" class="form-control" id="txtUpValLibMes" name="txtUpValLibMes" value="'. $valmes.'" placeholder="Cuota mensual">
                </div>
                <div id="etxtUpValLibMes" class="invalid-tooltip">
                    Campo Obligatorio
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="txtUpPorcLibMes">Porcentaje %</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="txtUpPorcLibMes" name="txtUpPorcLibMes" value="'.$porcen.'" placeholder="Ej: 10.5">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecInicioLib">Fecha Inicio</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecInicioLib" name="datUpFecInicioLib" value="'.$fecin.'">
                    <div id="edatUpFecInicioLib" class="invalid-tooltip">
                        Inicio debe ser menor
                    </div>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecFinLib">Fecha Fin</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecFinLib" name="datUpFecFinLib" value="'.$fecfin.'">
                    <div id="edatUpFecFinLib" class="invalid-tooltip">
                        Fin debe ser mayor
                    </div>
                </div>
            </div>
        </div>
        <center>
            <button class="btn btn-primary btn-sm actualizar">Actualizar</button>
            <a class="btn btn-danger btn-sm cancelar">Cancelar</a>
        </center>
    </form>
</div>';
echo $res;