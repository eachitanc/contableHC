<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: <?php echo $_SESSION["urlin"] ?>/index.php');
    exit();
}
function pesos($valor)
{
    return '$' . number_format($valor, 2);
}

include '../conexion.php';
$iduser = $_SESSION['id_user'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM
                seg_usuarios
            INNER JOIN seg_rol 
                ON (seg_usuarios.id_rol = seg_rol.id_rol)";
    $rs = $cmd->query($sql);
    $obj = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
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
<?php include '../head.php' ?>

<body class="sb-nav-fixed <?php if ($_SESSION['navarlat'] === '1') {
                                echo 'sb-sidenav-toggled';
                            } ?>">
    <?php include '../navsuperior.php' ?>
    <div id="layoutSidenav">
        <?php include '../navlateral.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid p-2">
                    <div class="card mb-4">
                        <div class="card-header" id="divTituloPag">
                            <div class="row">
                                <div class="col-md-11">
                                    <i class="fas fa-users-cog fa-lg" style="color:#1D80F7"></i>
                                    LISTA DE USUARIOS DEL SISTEMA.
                                </div>
                                <div class="col-md-1" title="Agregar">
                                    <a type="button" class="btn btn-success btn-sm btn-circle float-right" href="<?php echo $_SESSION['urlin'] ?>/usuarios/registrar/formadduser.php">
                                        <i class="fas fa-user-plus fa-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered table-sm" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No. Doc.</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>User</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($obj as $o) {
                                            if ($o['id_usuario'] !== '1') {
                                        ?>
                                                <tr id="filaempl">
                                                    <td><?php echo $o['documento'] ?></td>
                                                    <td><?php echo mb_strtoupper($o['nombre1']) ?></td>
                                                    <td><?php echo mb_strtoupper($o['apellido1']) ?></td>
                                                    <td><?php echo $o['correo'] ?></td>
                                                    <td><?php echo $o['login'] ?></td>
                                                    <td>
                                                        <?php echo $o['nombre'] ?></td>
                                                    </td>
                                                    <td class="text-center" id="tdEstUser">
                                                        <?php if ($o['estado'] === '1') { ?>
                                                            <button class="btn-estado" value="<?php echo $o['id_usuario'] ?>">
                                                                <div id="divIconoshow<?php echo $o['id_usuario'] ?>">
                                                                    <i class="fas fa-toggle-on fa-lg" style="color:#37E146;"></i>
                                                                </div>
                                                                <div id="divIcono<?php echo $o['id_usuario'] ?>">

                                                                </div>
                                                            </button>
                                                        <?php } else { ?>
                                                            <button class="btn-estado" value="<?php echo $o['id_usuario'] ?>">
                                                                <div id="divIconoshow<?php echo $o['id_usuario'] ?>">
                                                                    <i class="fas fa-toggle-off fa-lg" style="color:gray;"></i>
                                                                </div>
                                                                <div id="divIcono<?php echo $o['id_usuario'] ?>">

                                                                </div>
                                                            </button>
                                                        <?php } ?>

                                                    </td>
                                                    <td>
                                                        <div class="center-block">
                                                            <div class="input-group">
                                                                <?php if (intval($permisos['editar']) === 1) { ?>
                                                                    <form action="<?php echo $_SESSION['urlin'] ?>/usuarios/actualizar/formupuser.php" method="POST">
                                                                        <input type="text" name="idUpUser" value="<?php echo $o['id_usuario'] ?>" hidden>
                                                                        <button type="submit" class="btn btn-outline-primary btn-sm btn-circle" title="Editar">
                                                                            <i class="fas fa-pencil-alt fa-lg"></i>
                                                                        </button>
                                                                    </form>
                                                                <?php }
                                                                if (intval($permisos['borrar']) === 1) { ?>
                                                                    <div id="divDelUser">
                                                                        <button class="btn btn-outline-danger btn-sm btn-circle" value="<?php echo $o['id_usuario'] ?>" title="Eliminar">
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
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No. Doc.</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>User</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <?php include '../footer.php' ?>
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
                        <button type="button" class="btn btn-primary btn-sm" id="btnConfirDelUser">Aceptar</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
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
                        <a type="button" class="btn btn-primary btn-sm" href="<?php echo $_SESSION['urlin'] ?>/usuarios/listusers.php">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../scripts.php' ?>
</body>

</html>