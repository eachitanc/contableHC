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
                    seg_novedades_eps
                WHERE id_novedad = '$id'";
    $rs = $cmd->query($sql);
    $eps = $rs->fetch();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_epss ORDER BY nombre_eps ASC";
    $rs = $cmd->query($sql);
    $epsnov = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$res .= '<div id="divActuNov" class="fondo-sm shadow rounded">
    <form id="formUpNovEps">
        <input type="number" name="numidnov" value="'.$eps['id_novedad'].'" hidden="true">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="slcUpNovEps">EPS</label>
                <select id="slcUpNovEps" name="slcUpNovEps" class="form-control py-0" aria-label="Default select example">';
                    $fec_afil = $eps['fec_afiliacion'];
                    $fec_retir = $eps['fec_retiro'];
                    $idep = $eps['id_eps'];
                    foreach ($epsnov as $e) {
                        if ($e['id_eps'] !== $idep) {
                            $res .= '<option value="' . $e['id_eps'] . '">' . $e['nombre_eps'] . '</option>';
                        }else{
                            $res .= '<option selected value="' . $e['id_eps'] . '">' . $e['nombre_eps'] . '</option>';
                        }
                    };
               $res .= '</select>
            </div>
            <div class="form-group col-md-4">
                <label for="datFecAfilUpNovEps">Afilición</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datFecAfilUpNovEps" name="datFecAfilUpNovEps" value="'.$fec_afil.'">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="datFecRetUpNovEps">Retiro</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datFecRetUpNovEps" name="datFecRetUpNovEps" value="'.$fec_retir.'">
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