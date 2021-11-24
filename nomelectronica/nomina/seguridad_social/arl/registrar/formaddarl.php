<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../../../head.php' ?>

<body class="sb-nav-fixed <?php if ($_SESSION['navarlat'] === '1') {
                                echo 'sb-sidenav-toggled';
                            } ?>">
    <?php include '../../../../navsuperior.php' ?>
    <div id="layoutSidenav">
        <?php include '../../../../navlateral.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid p-2">
                    <div class="card mb-4">
                        <div class="card-header" id="divTituloPag">
                            <i class="far fa-building fa-lg" style="color: #07CF74;"></i>
                            REGISTRAR ARL
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <form id="formAddArl">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="txtNitArl">NIT</label>
                                        <input type="text" class="form-control" id="txtNitArl" name="txtNitArl" placeholder="Sin dígito de verificación">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="txtNomArl">Nombre</label>
                                        <input type="text" class="form-control" id="txtNomArl" name="txtNomArl" placeholder="Nombre ARL">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="txtTelArl">Teléfono</label>
                                        <input type="text" class="form-control" id="txtTelArl" name="txtTelArl" placeholder="celular o fijo">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="maileps">Correo eléctronico</label>
                                        <input type="email" class="form-control" id="mailArl" name="mailArl" placeholder="arl@correoarl.com">
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary btn-sm" id="btnAddArl">Registrar</button>
                                <a type="button" class="btn btn-danger btn-sm" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/arl/listarl.php"> Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../../../footer.php' ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalAddEpsError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeader">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-circle fa-lg" style="color:red"></i>
                            ¡Error!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divAddArlMsgError">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalAddEpsDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divDone">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                            ¡Correcto!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divAddArlMsgDone">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../../../scripts.php' ?>
</body>

</html>