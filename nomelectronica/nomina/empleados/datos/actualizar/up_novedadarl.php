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
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT *
            FROM
                seg_novedades_arl
            WHERE id_novarl = '$id'";
    $rs = $cmd->query($sql);
    $nov_arl = $rs->fetch();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_riesgos_laboral";
    $rs = $cmd->query($sql);
    $rlaboral = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_arl ORDER BY nombre_arl ASC";
    $rs = $cmd->query($sql);
    $arls = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}

$res .= '<div id="divActuNovArl" class="fondo-sm shadow p-3 rounded">
    <form id="formUpNovArl">
        <input type="number" name="numidnovarl" value="'.$nov_arl['id_novarl'].'" hidden="true">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="slcUpNovArl">ARL</label>
                <select id="slcUpNovArl" name="slcUpNovArl" class="form-control py-0" aria-label="Default select example">';
                    $fec_afil = $nov_arl['fec_afiliacion'];
                    $fec_retir = $nov_arl['fec_retiro'];
                    $idar = $nov_arl['id_arl'];
                    $idrl = $nov_arl['id_riesgo'];
                    foreach ($arls as $a) {
                        if ($a['id_arl'] !== $idar) {
                            $res .= '<option value="' . $a['id_arl'] . '">' . $a['nombre_arl'] . '</option>';
                        } else {
                            $res .= '<option selected value="' . $a['id_arl'] . '">' . $a['nombre_arl'] . '</option>';
                        }
                    }
                $res .= '</select>
            </div>
            <div class="form-group col-md-3">
                <label for="slcRiesLabNovup">Riesgo laboral</label>
                <select id="slcRiesLabNovup" name="slcRiesLabNovup" class="form-control py-0" aria-label="Default select example">';
                    foreach ($rlaboral as $r) {
                        if ($r['id_rlab'] !== $idrl) {
                            $res .= '<option value="' . $r['id_rlab'] . '">' . $r['clase'] . ' - ' . $r['riesgo'] . '</option>';
                        }else{
                           $res .=  '<option selected value="' . $r['id_rlab'] . '">' . $r['clase'] . ' - ' . $r['riesgo'];
                        }
                    }
                    
                $res .= '</select>
            </div>
            <div class="form-group col-md-2">
                <label for="datFecAfilUpNovArl">Afilición</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datFecAfilUpNovArl" name="datFecAfilUpNovArl" value="'.$fec_afil.'">
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="datFecRetUpNovArl">Retiro</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datFecRetUpNovArl" name="datFecRetUpNovArl" value="'.$fec_retir.'">
                </div>
            </div>
        </div>
        <center>
            <button class="btn btn-primary btn-sm actualiar">Actualizar</button>
            <a class="btn btn-danger btn-sm cancelar">Cancelar</a>
        </center>
    </form>
</div>';
echo $res;