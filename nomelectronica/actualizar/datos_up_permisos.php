<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../index.php");</script>';
    exit();
}
include '../conexion.php';
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
?>
<div class="px-0">
    <div class="shadow mb-3">
        <div class="card-header" style="background-color: #16a085 !important;">
            <h5 style="color: white;"><i class="fas fa-user-lock fa-lg" style="color:#2FDA49"></i>ACTUALIZAR PERMISOS DE USUARIOS DEL SISTEMA</h5>
        </div>

        <div class="table-responsive py-3">
            <table id="dataTablePermiso" class="table-striped table-bordered table-sm" style="width:100%">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align:middle" class="text-center">Nombres</th>
                        <th rowspan="2" style="vertical-align:middle" class="text-center">Usuario</th>
                        <th colspan="4" style="vertical-align:middle" class="text-center">Permisos</th>
                    </tr>
                    <tr>
                        <th class="text-center">Listar</th>
                        <th class="text-center">Registrar</th>
                        <th class="text-center">Editar</th>
                        <th class="text-center">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($objs as $o) {
                    ?>
                        <tr>
                            <td><?php echo mb_strtoupper($o['nombre1'] . ' ' . $o['apellido1']) ?></td>
                            <td><?php echo mb_strtoupper($o['login']) ?></td>
                            <td class="text-center">
                                <?php if ($o['listar'] == '1') { ?>
                                    <button class="btn-estado">
                                        <span class="fas fa-check-circle fa-lg circle-verde listar" value="SI|<?php echo $o['id_permiso'] ?>|L"></span>
                                    </button>
                                <?php } else { ?>
                                    <button class="btn-estado">
                                        <span class="fas fa-times-circle fa-lg circle-rojo listar" value="NO|<?php echo $o['id_permiso'] ?>|L"></span>
                                    </button>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if ($o['registrar'] == '1') { ?>
                                    <button class="btn-estado">
                                        <span class="fas fa-check-circle fa-lg circle-verde registrar" value="SI|<?php echo $o['id_permiso'] ?>|R"></span>
                                    </button>
                                <?php } else { ?>
                                    <button class="btn-estado">
                                        <span class="fas fa-times-circle fa-lg circle-rojo registrar" value="NO|<?php echo $o['id_permiso'] ?>|R"></span>
                                    </button>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if ($o['editar'] == '1') { ?>
                                    <button class="btn-estado">
                                        <span class="fas fa-check-circle fa-lg circle-verde editar" value="SI|<?php echo $o['id_permiso'] ?>|E"></span>
                                    </button>
                                <?php } else { ?>
                                    <button class="btn-estado">
                                        <span class="fas fa-times-circle fa-lg circle-rojo editar" value="NO|<?php echo $o['id_permiso'] ?>|E"></span>
                                    </button>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if ($o['borrar'] == '1') { ?>
                                    <button class="btn-estado">
                                        <span class="fas fa-check-circle fa-lg circle-verde borrar" value="SI|<?php echo $o['id_permiso'] ?>|B"></span>
                                    </button>
                                <?php } else { ?>
                                    <button class="btn-estado">
                                        <span class="fas fa-times-circle fa-lg circle-rojo borrar" value="NO|<?php echo $o['id_permiso'] ?>|B"></span>
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-primary" data-dismiss="modal" style="width: 10rem;">Cerrar</button>
    </div>
</div>