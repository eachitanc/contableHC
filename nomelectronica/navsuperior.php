<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
if ($_SESSION['rol'] == '1') {
    include 'conexion.php';
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "SELECT id_permiso, seg_usuarios.id_usuario, nombre1, nombre2, apellido1, apellido2, login, listar, registrar, editar, borrar
                FROM
                    seg_permisos_usuario
                INNER JOIN seg_usuarios 
                    ON (seg_permisos_usuario.id_usuario = seg_usuarios.id_usuario)
                WHERE estado = '1'";
        $rs = $cmd->query($sql);
        $objs = $rs->fetchAll();
        $cmd = null;
    } catch (PDOException $e) {
        echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
    }
}
?>
<nav id="navMenu" class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand sombra-nav" href="<?php echo $_SESSION['urlin'] ?>/inicio.php" title="Inicio"><img class="card-img-top" src="<?php echo $_SESSION['urlin'] ?>/images/logonomina.png" alt="logo"></a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 sombra-nav" id="sidebarToggle" value="<?php echo $_SESSION['navarlat']; ?>" href="#"><i id="navlateralSH" class="fas fa-bars fa-lg" style="color: #A9CCE3;"></i></button>
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item" id="btnFullScreen">
            <div id="fullscreen">
                <a type="button" class="nav-link sombra-nav">
                    <i id="iconFS" class="fas fa-expand-arrows-alt fa-lg" title="Ampliar" style="color: #9B59B6"></i>
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link sombra-nav" id="home" href="<?php echo $_SESSION['urlin'] ?>/inicio.php" role="button" aria-haspopup="true" aria-expanded="false" title="Inicio"> <i class="fas fa-house-user fa-lg" style="color:#5DADE2;"></i></i></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link sombra-nav" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Opciones usuario">
                <div class="form-group">
                    <i class="fas fa-user-circle fa-lg" style="color: #2ECC71;"></i>
                    <span class="dropdown-toggle"></span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" style="background-color:#fef5e7">
                <a class="dropdown-item sombra" href="<?php echo $_SESSION['urlin'] ?>/actualizar/usuario.php">Editar perfil</a>
                <?php if ($_SESSION['login']  === 'admin') { ?>
                    <a class="dropdown-item sombra" href="<?php echo $_SESSION['urlin'] ?>/actualizar/empresa/formupempresa.php">Editar Empresa</a>
                <?php } ?>
                <a class="dropdown-item sombra" href="<?php echo $_SESSION['urlin'] ?>/vigencia.php">Cambiar Vigencia</a>
                <?php if ($_SESSION['rol'] == '1') { ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item sombra" href="<?php echo $_SESSION['urlin'] ?>/usuarios/listusers.php">Gestión de usuarios</a>
                    <a class="dropdown-item sombra" href="#" id="hrefPermisos" data-toggle="modal" data-target="#divModalPermisos">Permisos</a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item sombra" href="<?php echo $_SESSION['urlin'] ?>/cerrar_sesion.php">Cerrar Sesión</a>

            </div>
        </li>
    </ul>
</nav>
<?php if ($_SESSION['rol'] === '1') { ?>
<!-- Modal -->
<div class="modal fade" id="divModalPermisos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div id="divTamModalPermisos" class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center" id="divTablePermisos">

            </div>
        </div>
    </div>
</div>
<?php }
