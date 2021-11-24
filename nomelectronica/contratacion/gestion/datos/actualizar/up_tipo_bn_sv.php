<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
$idtbs = $_POST['idtbs'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "SELECT * FROM seg_tipo_bien_servicio WHERE id_tipo_b_s = '$idtbs'";
    $rs = $cmd->query($sql);
    $tbnsv = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}

if (!empty($tbnsv)) {
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "SELECT seg_tipo_contrata.id_tipo, tipo_compra, tipo_contrato
                FROM
                    seg_tipo_contrata
                INNER JOIN seg_tipo_compra 
                    ON (seg_tipo_contrata.id_tipo_compra = seg_tipo_compra.id_tipo)
                ORDER BY tipo_compra";
        $rs = $cmd->query($sql);
        $tcontrato = $rs->fetchAll();
        $cmd = null;
    } catch (PDOException $e) {
        echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
    }
    $error = "Debe diligenciar este campo";
?>
    <div class="px-0">
        <div class="shadow">
            <div class="card-header" style="background-color: #16a085 !important;">
                <h5 style="color: white;">ACTUALIZAR DATOS DE TIPO DE BIEN O SERVICIO</h5>
            </div>
            <form id="formActualizaBnSv">
                <input type="number" id="idTipoBnSv" name="idTipoBnSv" value="<?php echo $tbnsv['id_tipo_b_s'] ?>" hidden>
                <div class="form-row px-4 pt-2">
                    <div class="form-group col-md-4">
                        <label for="slcTipoContrato" class="small">TIPO DE BIEN O SERVICIO</label>
                        <select id="slcTipoContrato" name="slcTipoContrato" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                            <?php
                            foreach ($tcontrato as $tc) {
                                if ($tc['id_tipo'] !== $tbnsv['id_tipo_cotrato']) {
                                    echo '<option value="' . $tc['id_tipo'] . '">' . $tc['tipo_compra'] . ' || ' . $tc['tipo_contrato'] . '</option>';
                                } else {
                                    echo '<option selected value="' . $tc['id_tipo'] . '">' . $tc['tipo_compra'] . ' || ' . $tc['tipo_contrato'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="txtTipoBnSv" class="small">NOMBRE TIPO DE BIEN O SERVICIO</label>
                        <input id="txtTipoBnSv" type="text" name="txtTipoBnSv" class="form-control form-control-sm py-0 sm" aria-label="Default select example" value="<?php echo $tbnsv['tipo_bn_sv'] ?>">
                    </div>
                    <div class="text-center pb-3">
                        <button class="btn btn-primary btn-sm" id="btnUpTipoBnSv">Actualizar</button>
                        <a type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
} else {
    echo 'Error al intentar obtener datos';
} ?>