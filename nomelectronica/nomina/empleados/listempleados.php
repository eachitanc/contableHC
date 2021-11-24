<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../index.php");</script>';
    exit();
}
function pesos($valor)
{
    return '$' . number_format($valor, 2);
}

include '../../conexion.php';
$iduser = $_SESSION['id_user'];
$vigencia = $_SESSION['vigencia'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *  FROM seg_empleado";
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
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, vigencia, salario_basico
            FROM
                seg_salarios_basico
            WHERE vigencia = '$vigencia'";
    $rs = $cmd->query($sql);
    $salarios = $rs->fetchAll();
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
                            <div class="row">
                                <div class="col-md-11">
                                    <i class="fas fa-users fa-lg" style="color:#1D80F7"></i>
                                    LISTA DE EMPLEADOS
                                </div>
                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                    <div class="col-md-1" title="Registrar">
                                        <a type="button" class="btn btn-success btn-sm btn-circle-plus float-right" href="<?php echo $_SESSION['urlin'] ?>/nomina/empleados/registrar/formaddempleado.php">
                                            <i class="fas fa-user-plus fa-lg"></i>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered table-sm nowrap table-hover shadow" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No. Doc.</th>
                                            <th>Apellidos</th>
                                            <th>Nombres</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Salario</th>
                                            <th>Estado</th>
                                            <th>Acción</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($obj as $o) {
                                            $ide = $o['no_documento'];
                                        ?>
                                            <tr id="filaempl">
                                                <td><?php echo $o['no_documento'] ?></td>
                                                <td><?php echo mb_strtoupper($o['apellido1'] . ' ' . $o['apellido2']) ?></td>
                                                <td><?php echo mb_strtoupper($o['nombre1'] . ' ' . $o['nombre2']) ?></td>
                                                <td><?php echo $o['correo'] ?></td>
                                                <td><?php echo $o['telefono'] ?></td>
                                                <td>
                                                    <?php
                                                    $emplkey = array_search($ide, array_column($salarios, 'id_empleado'));
                                                    if ($emplkey !== "") {
                                                        foreach ($salarios as $sa) {
                                                            if ($o['id_empleado'] === $sa['id_empleado']) {
                                                                echo pesos($sa['salario_basico']);
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center" id="tdEstado">
                                                    <?php
                                                    if ((intval($permisos['editar'])) === 1 && intval($_SESSION['rol']) === 1) {
                                                        if ($o['estado'] === '1') {
                                                    ?>
                                                            <button class="btn-estado" value="<?php echo $o['id_empleado'] ?>">
                                                                <div id="divIconoshow<?php echo $o['id_empleado'] ?>">
                                                                    <i class="fas fa-toggle-on fa-lg" style="color:#37E146;"></i>
                                                                </div>
                                                                <div id="divIcono<?php echo $o['id_empleado'] ?>">

                                                                </div>
                                                            </button>
                                                        <?php } else {
                                                        ?>
                                                            <button class="btn-estado" value="<?php echo $o['id_empleado'] ?>">
                                                                <div id="divIconoshow<?php echo $o['id_empleado'] ?>">
                                                                    <i class="fas fa-toggle-off fa-lg" style="color:gray;"></i>
                                                                </div>
                                                                <div id="divIcono<?php echo $o['id_empleado'] ?>">

                                                                </div>
                                                            </button>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo $o['estado'];
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <div class="center-block">
                                                        <div class="input-group">
                                                            <?php if (intval($permisos['editar']) === 1) { ?>
                                                                <form action="actualizar/formupempleado.php" method="POST">
                                                                    <input type="text" name="idUpEmpl" value="<?php echo $o['id_empleado'] ?>" hidden="true">
                                                                    <button type="submit" class="btn btn-outline-primary btn-sm btn-circle" title="Editar">
                                                                        <i class="fas fa-pencil-alt fa-lg"></i>
                                                                    </button>
                                                                </form>
                                                            <?php }
                                                            if (intval($permisos['registrar']) === 1) { ?>
                                                                <form action="../extras/horas/registrar/registrohe.php" method="POST">
                                                                    <input type="text" name="idEmHe" value="<?php echo $o['id_empleado'] ?>" hidden="true">
                                                                    <button type="submit" class="btn btn-outline-success btn-sm btn-circle" title="+ Horas extras">
                                                                        <i class="fas fa-clock fa-lg"></i>
                                                                    </button>
                                                                </form>
                                                                <form action="../extras/viaticos/registrar/registroviatico.php" method="POST">
                                                                    <input type="text" name="idEmViat" value="<?php echo $o['id_empleado'] ?>" hidden="true">
                                                                    <button type="submit" class="btn btn-outline-info btn-sm btn-circle" title="+ Viáticos">
                                                                        <i class="fas fa-suitcase fa-lg"></i>
                                                                    </button>
                                                                </form>
                                                            <?php
                                                            }
                                                            if (intval($permisos['borrar']) === 1) {
                                                            ?>
                                                                <div id="evaluate">
                                                                    <button class="btn btn-outline-danger btn-sm btn-circle" value="<?php echo $o['id_empleado'] ?>" title="Eliminar">
                                                                        <i class="fas fa-trash-alt fa-lg"></i>
                                                                    </button>
                                                                </div>
                                                            <?php } ?>
                                                            <form action="detallesempleado.php" method="POST">
                                                                <input type="text" name="idDetalEmpl" value="<?php echo $o['id_empleado'] ?>" hidden="true">
                                                                <button type="submit" class="btn btn-outline-warning btn-sm btn-circle" title="Detalles">
                                                                    <i class="far fa-eye fa-lg"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No. Doc.</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Salario</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <?php include '../../footer.php' ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalConfirmarDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeaderConfir">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-triangle fa-lg" style="color: #E67E22;"></i>
                            ¡Confirmar!
                        </h5>
                    </div>
                    <div class="modal-body" id="divConfirmdel">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" id="btnConfirDelEmpleado">Aceptar</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalHoExitoDelempl" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divDone">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                            ¡Correcto!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divMsgExitoDelEmpl">

                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary btn-sm" href="listempleados.php"> Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../scripts.php' ?>
</body>

</html>