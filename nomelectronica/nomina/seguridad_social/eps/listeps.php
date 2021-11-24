<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';

try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_epss";
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

<body class="sb-nav-fixed 
<?php if ($_SESSION['navarlat'] === '1') {
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
                                    <i class="fas fa-building fa-lg" style="color: #1D80F7;"></i>
                                    LISTA DE ENTIDADES PROMOTORAS DE SALUD (EPS).
                                </div>
                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                    <div class="col-md-1" title="Agregar">
                                        <a type="button" class="btn btn-success btn-sm btn-circle-plus float-right" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/eps/registrar/formaddeps.php">
                                            <i class="fas fa-plus-circle fa-lg"></i>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div class="table-responsive">
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
                                                <td><?php echo mb_strtoupper($o['nombre_eps']) ?></td>
                                                <td><?php echo $o['nit'] . '-' . $o['digito_verific'] ?></td>
                                                <td><?php echo $o['telefono'] ?></td>
                                                <td><?php echo $o['correo'] ?></td>
                                                <td>
                                                    <div class="center-block">
                                                        <div class="input-group">
                                                            <?php if ((intval($permisos['editar'])) === 1) { ?>
                                                                <form action="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/eps/actualizar/formupeps.php" method="POST">
                                                                    <input type="text" name="idUpEps" value="<?php echo $o['id_eps'] ?>" hidden="true">
                                                                    <button type="submit" class="btn btn-outline-primary btn-sm btn-circle" title="Editar">
                                                                        <i class="fas fa-pencil-alt fa-lg"></i>
                                                                    </button>
                                                                </form>
                                                            <?php }
                                                            if ((intval($permisos['borrar'])) === 1) {
                                                            ?>
                                                                <div id="divDelEps">
                                                                    <button class="btn btn-outline-danger btn-sm btn-circle" value="<?php echo $o['id_eps'] ?>" title="Eliminar">
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
        <div class="modal fade" id="divModalDelUserConfir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeaderConfir">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-triangle fa-lg" style="color: #E67E22;"></i>
                            ¡Confirmar!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divdelUserMsgConfir">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" id="btnConfirDelEPS">Aceptar</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
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