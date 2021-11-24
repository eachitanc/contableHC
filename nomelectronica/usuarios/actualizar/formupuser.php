<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: <?php echo $_SESSION["urlin"] ?>/index.php');
    exit;
}
include '../../conexion.php';
$idUser = $_POST['idUpUser'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_usuarios WHERE id_usuario = '$idUser'";
    $rs = $cmd->query($sql);
    $obj = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
?>

<!DOCTYPE html>
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
                            <i class="fas fa-user-plus fa-lg" style="color: #07cf74"></i>
                            FORMULARIO DE ACTUALIZACION DE USUARIO.
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <form id="formAddUser">
                                <input type="number" name="idUpUser" value="<?php echo $idUser; ?>" hidden="true">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="txtccUpUser">Número de documento</label>
                                        <input type="text" class="form-control" id="txtccUpUser" name="txtccUpUser" value="<?php echo $obj['documento'] ?>" placeholder="Identificación">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="txtNomb1Upuser">Primer nombre</label>
                                        <input type="text" class="form-control" id="txtNomb1Upuser" name="txtNomb1Upuser" value="<?php echo $obj['nombre1'] ?>" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="txtNomb2Upuser">Segundo nombre</label>
                                        <input type="text" class="form-control" id="txtNomb2Upuser" name="txtNomb2Upuser" value="<?php echo $obj['nombre2'] ?>" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="txtApe1Upuser">Primer apellido</label>
                                        <input type="text" class="form-control" id="txtApe1Upuser" name="txtApe1Upuser" value="<?php echo $obj['apellido1'] ?>" placeholder="Apellido">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="txtApe2Upuser">Segundo apellido</label>
                                        <input type="text" class="form-control" id="txtApe2user" name="txtApe2Upuser" value="<?php echo $obj['apellido2'] ?>" placeholder="Apellido">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="txtUplogin">Login</label>
                                        <input type="text" class="form-control" id="txtUplogin" name="txtUplogin" value="<?php echo $obj['login'] ?>" placeholder="Usuario">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="mailUpuser">Correo eléctronico</label>
                                        <input type="email" class="form-control" id="mailUpuser" name="mailUpuser" value="<?php echo $obj['correo'] ?>" placeholder="usuario@correo.com">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="passUpuser">Contraseña</label>
                                        <input type="password" class="form-control" id="passUpuser" name="passUpuser" value="<?php echo $obj['clave'] ?>" placeholder="password">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="slcRolUpUser">Rol</label>
                                        <select class="custom-select" id="slcRolUser" name="slcRolUpUser">
                                            <option <?php if ($obj['id_rol'] === '1') {
                                                        echo 'selected';
                                                    } ?> value="1">Administrador</option>
                                            <option <?php if ($obj['id_rol'] === '2') {
                                                        echo 'selected';
                                                    } ?> value="2">Básico</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary btn-sm" id="btnUpUser"> Actualizar</button>
                                <a type="button" class="btn btn-danger btn-sm" href="<?php echo $_SESSION['urlin'] ?>/usuarios/listusers.php"> Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../footer.php' ?>
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
    <?php include '../../scripts.php' ?>
</body>

</html>