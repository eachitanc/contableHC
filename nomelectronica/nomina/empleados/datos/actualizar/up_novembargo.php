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
                    seg_embargos
                WHERE id_embargo = '$id'";
    $rs = $cmd->query($sql);
    $embargo = $rs->fetch();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_juzgados ORDER BY nom_juzgado ASC";
    $rs = $cmd->query($sql);
    $juzgados = $rs->fetchAll();
    $sql = "SELECT * 
            FROM seg_tipo_embargo
            ORDER BY id_tipo_emb ASC";
    $rs = $cmd->query($sql);
    $tipoembargo = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}

$res .= '<div id="divActuEmbargo" class="shadow p-3 rounded fondo-sm">
    <form id="formUpEmbargo">
        <input type="number" name="numidEmbargo" value="'.$embargo['id_embargo'].'" hidden="true">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="slcUpJuzgado">Juzgado</label>
                <select id="slcUpJuzgado" name="slcUpJuzgado" class="form-control py-0" aria-label="Default select example">';
                    $valtotal = $embargo['valor_total'];
                    $valmes = $embargo['valor_mes'];
                    $porcent = $embargo['porcentaje'];
                    $fecinemb = $embargo['fec_inicio'];
                    $fecfinemb = $embargo['fec_fin'];
                    $idembargo = $embargo['id_embargo'];
                    $jzactual = $embargo['id_juzgado'];
                    $tipembactual = $embargo['tipo_embargo'];
                    $dctomax = $embargo['dcto_max'];
                    foreach ($juzgados as $jz) {
                        if ($jz['id_juzgado'] !== $jzactual) {
                            $res .= '<option value="' . $jz['id_juzgado'] . '">' . $jz['nom_juzgado'] . '</option>';
                        } else {
                            $res .= '<option selected value="' . $jz['id_juzgado'] . '">' . $jz['nom_juzgado'] . '</option>';
                        }
                    }

            
            $res .=   '</select>
            </div>
            <div class="form-group col-md-3">
                <label for="slcUpTipoEmbargo">Tipo</label>
                <select id="slcUpTipoEmbargo" name="slcUpTipoEmbargo" class="form-control py-0" aria-label="Default select example">';
                    foreach ($tipoembargo as $tpem) {
                        if ($tpem['id_tipo_emb'] === $tipembactual) {
                            $res .= '<option selected value="' . 'te=' . $tpem['id_tipo_emb'] . '&ie=' .$embargo["id_empleado"]. '">' . mb_strtoupper($tpem['tipo']) . '</option>';
                        } else {
                            $res .= '<option value="' . 'te=' . $tpem['id_tipo_emb'] . '&ie=' .$embargo["id_empleado"]. '">' . mb_strtoupper($tpem['tipo']) . '</option>';
                        }
                    }
            $res .=   '</select>
            </div>
            <div class="form-group col-md-3">
                <label for="numUpDctoAprox">Dcto. Máximo</label>
                <div class="form-group">
                    <div class="form-control" id="divUpDctoAprox">
                        '.$dctomax.'
                        <input type="number" id="numUpDctoAprox" name="numUpDctoAprox" value="'.$dctomax.'" hidden>
                        <input type="number" name="numUpTipoEmbargo" value="'.$tipembactual.'" hidden>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="numUpTotEmbargo">Total Embargo</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="numUpTotEmbargo" name="numUpTotEmbargo" min="1" value="'.$valtotal.'" placeholder="Valor total">
                </div>
                <div id="enumUpTotEmbargo" class="invalid-tooltip">
                    Campo obligatorio
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="txtUpValEmbargoMes"> Valor Embargo Mensual</label>
                <div class="form-group">
                    <input type="number" class="form-control" id="txtUpValEmbargoMes" name="txtUpValEmbargoMes" min="1" value="'.$valmes.'" placeholder="Valor mes">
                </div>
                <div id="etxtUpValEmbargoMes" class="invalid-tooltip">
                    Campo obligatorio
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="txtUpPorcEmbMes"> % Embargo Mes</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="txtUpPorcEmbMes" name="txtUpPorcEmbMes" value="'.$porcent * 100 .'" placeholder="Ej: 5.2">
                </div>
                <div id="etxtUpPorcEmbMes" class="invalid-tooltip">
                    Campo obligatorio
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecInicioEmb">Fecha Inicio</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecInicioEmb" name="datUpFecInicioEmb" value="'. $fecinemb.'">
                    <div id="edatUpFecInicioEmb" class="invalid-tooltip">
                        Inicio debe ser menor
                    </div>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecFinEmb">Fecha Fin</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecFinEmb" name="datUpFecFinEmb" value="'.$fecfinemb .'">
                    <div id="edatUpFecFinEmb" class="invalid-tooltip">
                        Fin debe ser mayor
                    </div>
                </div>
            </div>
        </div>
        <center>
            <button class="btn btn-primary btn-sm actualizar" id="btnUpEmbargo">Actualizar</button>
            <a class="btn btn-danger btn-sm cancelar">Cancelar</a>
        </center>
    </form>
</div>';

echo $res;