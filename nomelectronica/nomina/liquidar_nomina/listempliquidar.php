<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../index.php");</script>';
    exit();
}
$anio = $_SESSION['vigencia'];

function pesos($valor)
{
    return '$' . number_format($valor, 2);
}

include '../../conexion.php';

try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM
                seg_salarios_basico
            INNER JOIN seg_empleado 
                ON (seg_salarios_basico.id_empleado = seg_empleado.id_empleado)
            WHERE estado = '1' AND vigencia = '$anio'";
    $rs = $cmd->query($sql);
    $obj = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT * FROM seg_meses";
    $rs = $cmd->query($sql);
    $meses = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
if (isset($_GET['mes'])) {
    $dia = '01';
    $mes = $_GET['mes'];
    switch ($mes) {
        case '01':
        case '03':
        case '05':
        case '07':
        case '08':
        case '10':
        case '12':
            $fec_i = $anio . '-' . $mes . '-' . $dia;
            $fec_f = $anio . '-' . $mes . '-31';
            break;
        case '02':
            $fec_i = $anio . '-' . $mes . '-' . $dia;
            if (date('L', strtotime("$anio-01-01")) === '1') {
                $bis = '29';
            } else {
                $bis = '28';
            }
            $fec_f = $anio . '-' . $mes . '-' . $bis;
            break;
        case '04':
        case '06':
        case '09':
        case '11':
            $fec_i = $anio . '-' . $mes . '-' . $dia;
            $fec_f = $anio . '-' . $mes . '-30';
            break;
        default:
            echo 'Error Fatal';
            break;
    }
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "SELECT *
            FROM seg_incapacidad
            WHERE fec_inicio BETWEEN '$fec_i' AND '$fec_f'";
        $rs = $cmd->query($sql);
        $incapac = $rs->fetchAll();
        $cmd = null;
    } catch (PDOException $e) {
        echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
    }
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "SELECT *
            FROM seg_licenciasmp
            WHERE fec_inicio BETWEEN '$fec_i' AND '$fec_f'";
        $rs = $cmd->query($sql);
        $licencia = $rs->fetchAll();
        $cmd = null;
    } catch (PDOException $e) {
        echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
    }
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "SELECT *
            FROM seg_vacaciones
            WHERE fec_inicio BETWEEN '$fec_i' AND '$fec_f'";
        $rs = $cmd->query($sql);
        $vacacion = $rs->fetchAll();
        $cmd = null;
    } catch (PDOException $e) {
        echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
    }
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "SELECT id_cuota_sindical, id_sindicato, id_empleado, porcentaje_cuota, fec_inicio
                    FROM		
                        (SELECT *
                            FROM
                                seg_cuota_sindical
                            ORDER BY fec_inicio DESC) AS t 
                    GROUP BY id_empleado";
        $rs = $cmd->query($sql);
        $porcuotasind = $rs->fetchAll();
        $cmd = null;
    } catch (PDOException $e) {
        echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
    }
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "SELECT * FROM seg_metodo_pago";
        $rs = $cmd->query($sql);
        $metpago = $rs->fetchAll();
        $cmd = null;
    } catch (PDOException $e) {
        echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../head.php' ?>

<body class="sb-nav-fixed <?php
                            if ($_SESSION['navarlat'] === '1') {
                                echo 'sb-sidenav-toggled';
                            }
                            ?>">
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
                                    LISTA DE EMPLEADOS A LIQUIDAR
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div class="table-responsive w-100">
                                <form id="formLiqNomina">
                                    <div class="left-block py-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <select class="custom-select" id="slcMesLiqNom" name="slcMesLiqNom">
                                                    <?php
                                                    if (isset($_GET['mes'])) {
                                                        foreach ($meses as $m) {
                                                            if ($_GET['mes'] === $m['codigo']) {
                                                                echo '<option selected value="' . $m['codigo'] . '">' . $m['nom_mes'] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $m['codigo'] . '">' . $m['nom_mes'] . '</option>';
                                                            }
                                                        }
                                                    } else {
                                                        echo '<option selected value="00">--Selecionar mes a liquidar--</option>';
                                                        foreach ($meses as $m) {
                                                            echo '<option value="' . $m['codigo'] . '">' . $m['nom_mes'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_GET['mes'])) {
                                    ?>
                                        <table id="dataTable" class="table table-striped table-bordered table-sm nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center centro-vertical"> Todos <br><input id="selectAll" type="checkbox" checked></th>
                                                    <th class="text-center centro-vertical">No. Doc.</th>
                                                    <th class="text-center centro-vertical">Nombre Completo</th>
                                                    <th class="text-center centro-vertical">Dias Lab.</th>
                                                    <th class="text-center centro-vertical">Dias Incap.</th>
                                                    <th class="text-center centro-vertical">Dias Lic.</th>
                                                    <th class="text-center centro-vertical">Dias Vac.</th>
                                                    <th class="text-center centro-vertical">Método Pago</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <div></div>
                                                <?php
                                                foreach ($obj as $o) {
                                                    if ($o['estado'] === '1') {
                                                ?>
                                                        <tr id="filaempl">
                                                            <td>
                                                                <div class="center-block listado">
                                                                    <input clase="setAll" [] type="checkbox" name="check<?php echo $o['id_empleado'] ?>" checked value="1">
                                                                </div>
                                                            </td>
                                                            <td><?php echo $o['no_documento'] ?></td>
                                                            <td><?php echo mb_strtoupper($o['apellido1'] . ' ' . $o['apellido2'] . ' ' . $o['nombre1'] . ' ' . $o['nombre2'] . ' ') ?></td>
                                                            <td><?php
                                                                $idbusc = $o['id_empleado'];
                                                                $d = 0;
                                                                $dIncap = 0;
                                                                $dLic = 0;
                                                                $dVac = 0;
                                                                foreach ($incapac as $in) {
                                                                    if (intval($idbusc) === intval($in['id_empleado'])) {
                                                                        $fi = intval(date('Ym', strtotime($in['fec_inicio'])));
                                                                        $ff = intval(date('Ym', strtotime($in['fec_fin'])));
                                                                        $dif = $ff - $fi;
                                                                        if (intval($dif) > 0) {
                                                                            $start = new DateTime($in['fec_inicio']);
                                                                            $end = new DateTime($fec_f);
                                                                            $tiem = $start->diff($end);
                                                                            $d = intval($tiem->format('%d')) + 1 + $d;
                                                                        } else {
                                                                            $start = new DateTime($in['fec_inicio']);
                                                                            $end = new DateTime($in['fec_fin']);
                                                                            $tiem = $start->diff($end);
                                                                            $d = intval($tiem->format('%d')) + 1 + $d;
                                                                        }
                                                                        $dIncap = intval($tiem->format('%d')) + 1;
                                                                    }
                                                                }
                                                                foreach ($licencia as $lc) {
                                                                    if (intval($idbusc) === intval($lc['id_empleado'])) {
                                                                        $fi = intval(date('Ym', strtotime($lc['fec_inicio'])));
                                                                        $ff = intval(date('Ym', strtotime($lc['fec_fin'])));
                                                                        $dif = $ff - $fi;
                                                                        if (intval($dif) > 0) {
                                                                            $start = new DateTime($lc['fec_inicio']);
                                                                            $end = new DateTime($fec_f);
                                                                            $tiem = $start->diff($end);
                                                                            $d = intval($tiem->format('%d')) + 1 + $d;
                                                                        } else {
                                                                            $start = new DateTime($lc['fec_inicio']);
                                                                            $end = new DateTime($lc['fec_fin']);
                                                                            $tiem = $start->diff($end);
                                                                            $d = intval($tiem->format('%d')) + 1 + $d;
                                                                        }
                                                                        $dLic = intval($tiem->format('%d')) + 1;
                                                                    }
                                                                }
                                                                foreach ($vacacion as $vs) {
                                                                    if (intval($idbusc) === intval($vs['id_empleado'])) {
                                                                        $fi = intval(date('Ym', strtotime($vs['fec_inicio'])));
                                                                        $ff = intval(date('Ym', strtotime($vs['fec_fin'])));
                                                                        $dif = $ff - $fi;
                                                                        if (intval($dif) > 0) {
                                                                            $start = new DateTime($vs['fec_inicio']);
                                                                            $end = new DateTime($fec_f);
                                                                            $tiem = $start->diff($end);
                                                                            $d = intval($tiem->format('%d')) + 1 + $d;
                                                                        } else {
                                                                            $start = new DateTime($vs['fec_inicio']);
                                                                            $end = new DateTime($vs['fec_fin']);
                                                                            $tiem = $start->diff($end);
                                                                            $d = intval($tiem->format('%d')) + 1 + $d;
                                                                        }
                                                                        $dVac = intval($tiem->format('%d')) + 1;
                                                                    }
                                                                }
                                                                if ($mes === '02' && intval($d) == 28 && intval($d) == 29) {
                                                                    $diaslabor = 0;
                                                                } else {
                                                                    $diaslabor = 30 - intval($d);
                                                                }
                                                                if (intval($d) === 31) {
                                                                    $diaslabor = 0;
                                                                }
                                                                echo '<div class="diaslab"><input type="number" class="form-control altura" name="numDiaLab_' . $o['id_empleado'] . '" max="' . $diaslabor . '" min= "0" placeholder="1-30" value="' . $diaslabor . '"></div>'
                                                                    . '   <input type="number" name="numIdEmplDiaLab_' . $o['id_empleado'] . '" value="' . $o['id_empleado'] . '" hidden>'
                                                                    . '   <input type="number" name="numSalBas_' . $o['id_empleado'] . '" value="' . $o['salario_basico'] . '" hidden>';
                                                                $porcuotasindkey = array_search($idbusc, array_column($porcuotasind, 'id_empleado'));
                                                                $idcuotasind = 0;
                                                                $por100 = 0;
                                                                if ($porcuotasindkey !== '') {
                                                                    foreach ($porcuotasind as $pcs) {
                                                                        if (intval($pcs['id_empleado']) === intval($idbusc)) {
                                                                            $idcuotasind = $pcs['id_cuota_sindical'];
                                                                            $por100 = $pcs['porcentaje_cuota'];
                                                                        }
                                                                    }
                                                                }
                                                                echo '<input type="text" name="txtPorcCuotaSind_' . $o['id_empleado'] . '" value="' . $por100 . '" hidden>'
                                                                    . '<input type="number" name="numIdCuotaSind_' . $o['id_empleado'] . '" value="' . $idcuotasind . '" hidden>'
                                                                ?></td>
                                                            <td class="text-center">
                                                                <?php
                                                                echo $dIncap;
                                                                echo '<input type="number" id="dayIncap_' . $o['id_empleado'] . '" value="' . $dIncap . '" hidden>';
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                echo $dLic;
                                                                echo '<input type="number" id="dayLic_' . $o['id_empleado'] . '" value="' . $dLic . '" hidden>';
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                echo $dVac;
                                                                echo '<input type="number" id="dayVac_' . $o['id_empleado'] . '" value="' . $dVac . '" hidden>';
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <select class="form-control form-control-sm w-60 altura py-0" name="slcMetPag<?php echo $o['id_empleado'] ?>">
                                                                    <?php
                                                                    foreach ($metpago as $mp) {
                                                                        if ($mp['codigo'] !== '47') {
                                                                            echo '<option value="' . $mp['codigo'] . '">' . $mp['metodo'] . '</option>';
                                                                        } else {
                                                                            echo '<option selected value="' . $mp['codigo'] . '">' . $mp['metodo'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>No. Doc.</th>
                                                    <th class="text-center">Nombre Completo</th>
                                                    <th>Dias Lab.</th>
                                                    <th>Dias Incap.</th>
                                                    <th>Dias Lic.</th>
                                                    <th>Dias Vac.</th>
                                                    <th class="text-center">Método Pago</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                </form>
                            </div>
                            <div class="center-block py-2">
                                <div class="form-group">
                                    <?php
                                        if ($_GET['mes'] === '06' || $_GET['mes'] === '12') {
                                            echo '<button class="btn btn-info" id="btnLiqPrima">Liquidar Prima</button>';
                                        }
                                    ?>
                                    <button class="btn btn-success" id="btnLiqNom">Liquidar nómina</button>
                                    <a type="button" class="btn btn-danger" href="../../inicio.php"> Cancelar</a>
                                </div>
                            </div>
                        <?php
                                    }
                        ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../footer.php' ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-circle fa-lg" style="color:red"></i>
                            ¡Error!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divMsgError">
                        No hay empleados nuevos para liquidar
                        <br>
                        <a id="btnDetallesLiq" class="btn btn-link" href="#">Detalles</a>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary btn-sm" data-dismiss="modal"> Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="divModalExito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divDone">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                            ¡Correcto!
                        </h5>
                    </div>
                    <div class="modal-body" id="divMsgExito">
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary btn-sm" data-dismiss="modal"> Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="divModalEspera" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divDone">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                            Liquidando...
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divMsgExito">
                        <div class="spinner-grow text-warning" role="status">
                            <span class="sr-only">Liquidando...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../scripts.php' ?>
</body>

</html>