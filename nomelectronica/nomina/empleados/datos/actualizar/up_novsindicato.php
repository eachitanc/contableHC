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
                seg_cuota_sindical
                WHERE id_cuota_sindical = '$id'";
    $rs = $cmd->query($sql);
    $sindicato = $rs->fetch();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_sindicatos ORDER BY nom_sindicato ASC";
    $rs = $cmd->query($sql);
    $listsind = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$res .=
'<div id="divActuSindicato" class="shadow p-3 rounded fondo-sm">
    <form id="formUpSindicato">
        <input type="number" name="numidSindicato" value="'.$sindicato['id_cuota_sindical'].'" hidden="true">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="slcUpSindicato">sindicato</label>
                <select id="slcUpSindicato" name="slcUpSindicato" class="form-control py-0" aria-label="Default select example">';
                    $porcentaje = $sindicato['porcentaje_cuota'];
                    $fecinsind = $sindicato['fec_inicio'];
                    $fecfinsind = $sindicato['fec_fin'];
                    $sindactual = $sindicato['id_sindicato'];

                    foreach ($listsind as $l) {
                        if ($l['id_sindicato'] !== $sindactual) {
                            $res .= '<option value="' . $l['id_sindicato'] . '">' . mb_strtoupper($l['nom_sindicato']) . '</option>';
                        } else {
                            $res .= '<option selected value="' . $l['id_sindicato'] . '">' . mb_strtoupper($l['nom_sindicato']) . '</option>';
                        }
                    }
               $res .= '</select>
            </div>
            <div class="form-group col-md-2">
                <label for="txtUpPorcentajeSind">Porcentaje %</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="txtUpPorcentajeSind" value="'.$porcentaje * 100 .'" placeholder="En decimal">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecInicioSind">Fecha Inicio</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecInicioSind" name="datUpFecInicioSind" value="'.$fecinsind.'">
                </div>
                <div id="edatUpFecInicioSind" class="invalid-tooltip">
                    Inicio debe ser menor
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="datUpFecFinSind">Fecha Fin</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="datUpFecFinSind" name="datUpFecFinSind" value="'.$fecfinsind .'">
                </div>
                <div id="edatUpFecFinSind" class="invalid-tooltip">
                    Fin debe ser Mayor
                </div>
            </div>
        </div>
        <center>
            <button class="btn btn-primary btn-sm actualizar" id="btnUpSindicato">Actualizar</button>
            <a class="btn btn-danger btn-sm cancelar">Cancelar</a>
        </center>
    </form>
</div>';

echo $res;