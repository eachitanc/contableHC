<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
$idafp = $_POST['idUpAfp'];

try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_afp WHERE id_afp = '$idafp'";
    $rs = $cmd->query($sql);
    $obj = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
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
                            <i class="fas fa-hand-pointer fa-lg" style="color: #07CF74;"></i>
                            FORMULARIO DE ACTUALIZACION DE AFP.
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <form id="formUpAfp">
                                <input type="number" name="numIdAfp" value="<?php echo $idafp ?>" hidden="true">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="txtNitUpAfp">NIT</label>
                                        <input type="text" class="form-control" id="txtNitUpAfp" name="txtNitUpAfp" value="<?php echo $obj['nit_afp'] ?>" placeholder="Sin dígito de verificación">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="txtNomUpAfp">Nombre</label>
                                        <input type="text" class="form-control" id="txtNomUpAfp" name="txtNomUpAfp" value="<?php echo $obj['nombre_afp'] ?>" placeholder="Nombre EPS">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="txtTelUpAfp">Teléfono</label>
                                        <input type="text" class="form-control" id="txtTelUpAfp" name="txtTelUpAfp" value="<?php echo $obj['telefono'] ?>" placeholder="celular o fijo">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="mailUpafp">Correo eléctronico</label>
                                        <input type="email" class="form-control" id="mailUpafp" name="mailUpafp" value="<?php echo $obj['correo'] ?>" placeholder="afp@correoafp.com">
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary btn-sm" id="btnUpAfp"> Actualizar</button>
                                <a type="button" class="btn btn-danger btn-sm" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/afp/listafp.php"> Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../../../footer.php' ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalAddUserError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeader">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-circle fa-lg" style="color:red"></i>
                            ¡Error!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divAddUserMsgError">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalAddUserDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divDone">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                            ¡Correcto!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divAddUserMsgDone">

                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary btn-sm" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/afp/listafp.php">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../../../scripts.php' ?>
</body>

</html>