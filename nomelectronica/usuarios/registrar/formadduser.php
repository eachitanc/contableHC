<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: <?php echo $_SESSION["urlin"] ?>/index.php');
    exit;
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
                            <i class="fas fa-user-plus fa-lg" style="color: #07CF74;"></i>
                            REGISTRAR USUARIO.
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <form id="formAddUser">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="txtCCuser">Número de documento</label>
                                        <input type="text" class="form-control" id="txtCCuser" name="txtCCuser" placeholder="Identificación">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="txtNomb1user">Primer nombre</label>
                                        <input type="text" class="form-control" id="txtNomb1user" name="txtNomb1user" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="txtNomb2user">Segundo nombre</label>
                                        <input type="text" class="form-control" id="txtNomb2user" name="txtNomb2user" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="txtApe1user">Primer apellido</label>
                                        <input type="text" class="form-control" id="txtApe1user" name="txtApe1user" placeholder="Apellido">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="txtApe2user">Segundo apellido</label>
                                        <input type="text" class="form-control" id="txtApe2user" name="txtApe2user" placeholder="Apellido">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="txtlogin">Login</label>
                                        <input type="text" class="form-control" id="txtlogin" name="txtlogin" placeholder="Usuario">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="mailuser">Correo eléctronico</label>
                                        <input type="email" class="form-control" id="mailuser" name="mailuser" placeholder="usuario@correo.com">
                                    </div>
                                    <div class="form-group col-md-6 campo">
                                        <label for="passuser">Contraseña</label>
                                        <input type="password" class="form-control" id="passuser" name="passuser" placeholder="Contraseña">
                                        <span class="ver"><i class="fas fa-eye" style="color:#2ECC71" id="icon"></i></span>
                                    </div>
                                </div>
                                <input type="number" class="form-control" name="numEstUser" value="1" hidden="true">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="slcRolUser">Rol</label>
                                        <select class="custom-select" id="slcRolUser" name="slcRolUser">
                                            <option value="0" selected>--Seleccionar--</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Básico</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary btn-sm" id="btnAddUser">Registrar</button>
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
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../scripts.php' ?>
</body>

</html>