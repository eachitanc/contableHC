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
                    seg_novedades_afp
                WHERE id_novafp = '$id'";
    $rs = $cmd->query($sql);
    $novafp = $rs->fetch();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_afp ORDER BY nombre_afp ASC";
    $rs = $cmd->query($sql);
    $afps = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$res .= '<div id="divActuNovAfp" class="fondo-sm shadow p-3 rounded">
    <form id="formUpNovAfp">
        <input type="number" name="numidnovafp" value="'.$novafp['id_novafp'].'" hidden="true">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="slcUpNovAfp">AFP</label>
                <select id="slcUpNovAfp" name="slcUpNovAfp" class="form-control py-0" aria-label="Default select example">';
                    $fec_afilafp = $novafp['fec_afiliacion'];
                    $fec_retirafp = $novafp['fec_retiro'];
                    $idaf = $novafp['id_afp'];
                    foreach ($afps as $a) {
                        if ($a['id_afp'] !== $idaf) {
                            $res .= '<option value="' . $a['id_afp'] . '">' . $a['nombre_afp'] . '</option>';
                        } else {
                            $res .= '<option selected value="' . $a['id_afp'] . '">' . $a['nombre_afp'] . '</option>';
                        }
                    }

                    
                $res .= '</select>
            </div>
            <div class="form-group col-md-3">
                <label for="datFecAfilUpNovAfp">Afilición</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datFecAfilUpNovAfp" name="datFecAfilUpNovAfp" value="'.$fec_afilafp.'">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="datFecRetUpNovAfp">Retiro</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datFecRetUpNovAfp" name="datFecRetUpNovAfp" value="'.$fec_retirafp.'">
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