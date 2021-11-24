<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../index.php");</script>';
    exit();
}
include '../../conexion.php';
$id_adq = $_SESSION['detalles'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT 
                *
            FROM
                seg_adquisiciones
            INNER JOIN seg_modalidad_contrata 
                ON (seg_adquisiciones.id_modalidad = seg_modalidad_contrata.id_modalidad) 
            WHERE id_adquisicion = '$id_adq'";
    $rs = $cmd->query($sql);
    $adquisicion = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}

if (!empty($adquisicion)) {
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "SELECT id_b_s, tipo_compra, tipo_contrato, tipo_bn_sv, bien_servicio
                FROM
                    seg_tipo_contrata
                INNER JOIN seg_tipo_compra 
                    ON (seg_tipo_contrata.id_tipo_compra = seg_tipo_compra.id_tipo)
                INNER JOIN seg_tipo_bien_servicio 
                    ON (seg_tipo_bien_servicio.id_tipo_cotrato = seg_tipo_contrata.id_tipo)
                INNER JOIN seg_bien_servicio 
                    ON (seg_bien_servicio.id_tipo_bn_sv = seg_tipo_bien_servicio.id_tipo_b_s)
                ORDER BY tipo_compra,tipo_contrato, tipo_bn_sv, bien_servicio";
        $rs = $cmd->query($sql);
        $bnsv = $rs->fetchAll();
        $cmd = null;
    } catch (PDOException $e) {
        echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
    }
?>
    !DOCTYPE html>
    <html lang="es">
    <?php include '../../head.php' ?>

    <body class="sb-nav-fixed <?php if ($_SESSION['navarlat'] === '1') {
                                    echo 'sb-sidenav-toggled';
                                } ?>">
        <?php include '../../navsuperior.php' ?>
        <div id="layoutSidenav">
            <?php include '../../navlateral.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid p-2">
                        <div class="card mb-4">
                            <div class="card-header" id="divTituloPag">
                                <div class="row">
                                    <div class="col-md-11">
                                        <i class="fas fa-copy fa-lg" style="color:#1D80F7"></i>
                                        DETALLES DE ADQUISICIÓN
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="shadow detalles-empleado">
                                    <div class="row">
                                        <div class="div-mostrar bor-top-left col-md-4">
                                            <label class="lbl-mostrar pb-2">MODALIDAD CONTRATACIÓN</label>
                                            <div class="div-cont pb-2"><?php echo $adquisicion['modalidad'] ?></div>
                                        </div>
                                        <div class="div-mostrar col-md-2">
                                            <label class="lbl-mostrar pb-2">ADQUISICIÓN</label>
                                            <div class="div-cont pb-2">ADQ-<?php echo mb_strtoupper($adquisicion['id_adquisicion']) ?></div>
                                        </div>
                                        <div class="div-mostrar col-md-3">
                                            <label class="lbl-mostrar pb-2">FECHA</label>
                                            <div class="div-cont pb-2"><?php echo $adquisicion['fecha_adquisicion'] ?></div>
                                        </div>
                                        <div class="div-mostrar bor-top-right col-md-3">
                                            <label class="lbl-mostrar pb-2">ESTADO</label>
                                            <div class="div-cont pb-2"><?php echo $adquisicion['estado'] ?></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="div-mostrar bor-down-right bor-down-left col-md-12">
                                            <label class="lbl-mostrar pb-2">OBJETO</label>
                                            <div class="div-cont text-left pb-2"><?php echo $adquisicion['objeto'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <form id="formDetallesAdq">
                                    <div class="pt-3">
                                        <table id="tableAdqBnSv" class="table table-striped table-bordered table-sm nowrap table-hover shadow" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Seleccionar</th>
                                                    <th>Bien o Servicio</th>
                                                    <th>Cantidad</th>
                                                    <th>Valor estimado Und.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($bnsv as $bs) { ?>
                                                    <tr>
                                                        <td>
                                                            <div class="text-center listado">
                                                                <input type="checkbox" name="check_<?php echo $bs['id_b_s'] ?>" class= "numChecks" value="1">
                                                            </div>
                                                        </td>
                                                        <td class="text-left"><i><?php echo $bs['tipo_compra'] . ' - ' . $bs['tipo_contrato'] . ' - ' . $bs['tipo_bn_sv'] . '</i> > <b>' . $bs['bien_servicio'] ?></b></td>
                                                        <td><input type="number" name="bnsv_<?php echo $bs['id_b_s'] ?>" id="bnsv_<?php echo $bs['id_b_s'] ?>" class="form-control altura"></td>
                                                        <td>$ 0.0</td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Seleccionar</th>
                                                    <th>Bien o Servicio</th>
                                                    <th>Cantidad</th>
                                                    <th>Valor estimado Und.</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include '../../footer.php' ?>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="divModalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header" id="divModalHeader">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                <i class="fas fa-exclamation-circle fa-lg" style="color:red"></i>
                                ¡Error!
                            </h5>
                        </div>
                        <div class="modal-body text-center" id="divMsgError">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <!-- Modal -->
            <div class="modal fade" id="divModalConfDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header" id="divModalHeaderConfir">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                <i class="fas fa-exclamation-triangle fa-lg" style="color: #E67E22;"></i>
                                ¡Confirmar!
                            </h5>
                        </div>
                        <div class="modal-body" id="divMsgConfdel">

                        </div>
                        <div class="modal-footer" id="divBtnsModalDel">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="divModalDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header" id="divDone">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                                ¡Correcto!
                            </h5>
                        </div>
                        <div class="modal-body text-center" id="divMsgDone">

                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-primary btn-sm" data-dismiss="modal"> Aceptar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <!-- Modal -->
            <div class="modal fade" id="divModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div id="divTamModalForms" class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center" id="divForms">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
        </div>
        <?php include '../../scripts.php' ?>
    </body>

    </html>
<?php
} else {
    echo 'Error al intentar obtener datos';
} ?>