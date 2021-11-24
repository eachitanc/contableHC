<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';

try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_afp";
    $rs = $cmd->query($sql);
    $obj = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$iduser = $_SESSION['id_user'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT * FROM seg_permisos_usuario WHERE id_usuario = '$iduser'";
    $rs = $cmd->query($sql);
    $permisos = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../../head.php' ?>

<body class="sb-nav-fixed <?php if ($_SESSION['navarlat'] === '1') {
                                echo 'sb-sidenav-toggled';
                            } ?>">
    <?php include '../../../navsuperior.php' ?>
    <div id="layoutSidenav">
        <?php include '../../../navlateral.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid p-2">
                    <div class="card mb-4">
                        <div class="card-header" id="divTituloPag">
                            <div class="row">
                                <div class="col-md-11">
                                    <i class="fas fa-hand-holding-usd fa-lg" style="color:#1D80F7"></i>
                                    LISTA DE ADMINISTRADORAS DE FONDOS DE PENSIONES (AFP).
                                </div>
                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                    <div class="col-md-1" title="Agregar">
                                        <a type="button" class="btn btn-success btn-sm btn-circle-plus float-right" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/afp/registrar/formaddafp.php">
                                            <i class="fas fa-hand-holding-medical fa-lg"></i>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div class="table-responsive scrollbar scrollbar-primary">
                                <table id="dataTable" class="table table-striped table-bordered table-sm" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">NIT</th>
                                            <th class="text-center">Teléfono</th>
                                            <th class="text-center">Correo</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($obj as $o) { ?>
                                            <tr id="filaempl">
                                                <td><?php echo mb_strtoupper($o['nombre_afp']) ?></td>
                                                <td><?php echo $o['nit_afp'] . '-' . $o['dig_verf'] ?></td>
                                                <td><?php echo $o['telefono'] ?></td>
                                                <td><?php echo $o['correo'] ?></td>
                                                <td>
                                                    <div class="center-block">
                                                        <div class="input-group">
                                                            <?php if ((intval($permisos['editar'])) === 1) { ?>
                                                                <form action="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/afp/actualizar/formupafp.php" method="POST">
                                                                    <input type="text" name="idUpAfp" value="<?php echo $o['id_afp'] ?>" hidden="true">
                                                                    <button type="submit" class="btn btn-outline-info btn-sm btn-circle" title="Editar">
                                                                        <i class="fas fa-pencil-alt fa-lg"></i>
                                                                    </button>
                                                                </form>
                                                            <?php }
                                                            if ((intval($permisos['borrar'])) === 1) {
                                                            ?>
                                                                <div class="col-md-3" id="divDelAfp">
                                                                    <button class="btn btn-outline-danger btn-sm btn-circle" value="<?php echo $o['id_afp'] ?>" title="Eliminar">
                                                                        <i class="fas fa-trash-alt fa-lg"></i>
                                                                    </button>
                                                                </div>
                                                            <?php } ?>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <?php include '../../../footer.php' ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModConfirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeaderConfir">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-triangle fa-lg" style="color: #E67E22;"></i>
                            ¡Confirmar!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divMsgConfir">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" id="btnConfirDelAfp">Aceptar</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="divModError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                        <a type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../../scripts.php' ?>
</body>

</html>