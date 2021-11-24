<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
if (isset($_GET['trab'])) {
    $idemhe = $_GET['trab'];
} else {
    $idemhe = $_POST['idEmHe'];
}

try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT * FROM seg_empleado WHERE id_empleado = '$idemhe'";
    $rs = $cmd->query($sql);
    $empleado = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$error = 'Debe diligenciar este campo';
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
                            <i class="fas fa-clock fa-lg" style="color: #07CF74;"></i>
                            REGISTRO HORAS EXTRA.
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div class="row">
                                <div class="center-block">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="divNomComp">
                                                <?php
                                                echo mb_strtoupper($empleado['nombre1'] . ' ' . $empleado['nombre2'] . ' ' . $empleado['apellido1'] . ' ' . $empleado['apellido2']);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="divNomComp">
                                                <?php echo $empleado['no_documento']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <form id="formAddHe">
                                <input type="number" id="numidemp" name="numidemp" value="<?php echo $idemhe ?>" hidden>
                                <div>
                                    <div class="row">
                                        <div class="div-mostrar div-lg bor-top-left col-md-3 text-center">
                                            <strong>Tipo de Hora</strong>
                                        </div>
                                        <div class="div-mostrar div-lg col-md-2 text-center">
                                            <strong>Fecha Laborada Inicio</strong>
                                        </div>
                                        <div class="div-mostrar div-lg col-md-2 text-center">
                                            <strong>Fecha Laborada Fin</strong>
                                        </div>
                                        <div class="div-mostrar div-lg col-md-2 text-center">
                                            <strong>Hora Inicio</strong>
                                        </div>
                                        <div class="div-mostrar div-lg col-md-2 text-center">
                                            <strong>Hora Fin</strong>
                                        </div>
                                        <div class="div-mostrar div-lg bor-top-right col-md-1 text-center">
                                            <strong>Cantidad</strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="div-mostrar div-lg-cp col-md-3">
                                            <input hidden type="number" id="numIdHeDo" name="numIdHeDo" value="1">
                                            <strong>&nbsp&nbsp&nbspDiurna</strong>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeDoI" name="datFecLabHeDoI">
                                            <div id="eFecLabHeDoI" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeDoF" name="datFecLabHeDoF">
                                            <div id="eFecLabHeDoF" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                            <div id="eFecMenorDo" class="invalid-tooltip">
                                                <?php echo "Fecha Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeInicioHeDo" name="timeInicioHeDo" step="2">
                                            <div id="etimeInicioHeDo" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeFinHeDo" name="timeFinHeDo" step="2">
                                            <div id="eHoraMenorDo" class="invalid-tooltip">
                                                <?php echo "Hora Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-1 text-center">
                                            <div class="form-control form-control-sm" id="CantHeDo">
                                                Se calcula
                                                <input type="number" id="numCantHeDo" name="numCantHeDo" value="99" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="div-mostrar div-lg-cp div-gris col-md-3">
                                            <input hidden type="number" id="numIdHeNo" name="numIdHeNo" value="2">
                                            <strong>&nbsp&nbsp&nbspNocturna</strong>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeNoI" name="datFecLabHeNoI">
                                            <div id="edatFecLabHeNoI" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeNoF" name="datFecLabHeNoF">
                                            <div id="edatFecLabHeNoF" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                            <div id="eFecMenorNo" class="invalid-tooltip">
                                                <?php echo "Fecha Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeInicioHeNo" name="timeInicioHeNo" step="2">
                                            <div id="etimeInicioHeNo" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeFinHeNo" name="timeFinHeNo" step="2">
                                            <div id="eHoraMenorNo" class="invalid-tooltip">
                                                <?php echo "Hora Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris col-md-1 text-center">
                                            <div class="form-control form-control-sm" id="CantHeNo">
                                                Se calcula
                                                <input type="number" id="numCantHeNo" name="numCantHeNo" value="99" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="div-mostrar div-lg-cp col-md-3">
                                            <input hidden type="number" id="numRecIdHeNo" name="numRecIdHeNo" value="3">
                                            <strong>&nbsp&nbsp&nbspRecargo Nocturno</strong>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datRecFecLabHeNoI" name="datRecFecLabHeNoI">
                                            <div id="edatRecFecLabHeNoI" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datRecFecLabHeNoF" name="datRecFecLabHeNoF">
                                            <div id="edatRecFecLabHeNoF" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                            <div id="eRecFecMenorNo" class="invalid-tooltip">
                                                <?php echo "Fecha Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeRecInicioHeNo" name="timeRecInicioHeNo" step="2">
                                            <div id="etimeRecInicioHeNo" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeRecFinHeNo" name="timeRecFinHeNo" step="2">
                                            <div id="eRecHoraMenorNo" class="invalid-tooltip">
                                                <?php echo "Hora Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-1 text-center">
                                            <div class="form-control form-control-sm" id="RecCantHeNo">
                                                Se calcula
                                                <input type="number" id="numRecCantHeNo" name="numRecCantHeNo" value="99" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="div-mostrar div-lg-cp div-gris col-md-3">
                                            <input hidden type="number" id="numIdHeDd" name="numIdHeDd" value="4">
                                            <strong>&nbsp&nbsp&nbspDiurna Dominical y Festivo</strong>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 div-gris text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeDdI" name="datFecLabHeDdI">
                                            <div id="edatFecLabHeDdI" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 div-gris text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeDdF" name="datFecLabHeDdF">
                                            <div id="edatFecLabHeDdF" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                            <div id="eFecMenorDd" class="invalid-tooltip">
                                                <?php echo "Fecha Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 div-gris text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeInicioHeDd" name="timeInicioHeDd" step="2">
                                            <div id="etimeInicioHeDd" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 div-gris text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeFinHeDd" name="timeFinHeDd" step="2">
                                            <div id="eHoraMenorDd" class="invalid-tooltip">
                                                <?php echo "Hora Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-1 div-gris text-center">
                                            <div class="form-control form-control-sm" id="CantHeDd">
                                                Se calcula
                                                <input type="number" id="numCantHeDd" name="numCantHeDd" value="99" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="div-mostrar div-lg-cp col-md-3">
                                            <input hidden type="number" id="numRecIdHeDd" name="numRecIdHeDd" value="5">
                                            <strong>&nbsp&nbsp&nbspRecargo Diurno Dominical y Festivo</strong>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datRecFecLabHeDdI" name="datRecFecLabHeDdI">
                                            <div id="edatRecFecLabHeDdI" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datRecFecLabHeDdF" name="datRecFecLabHeDdF">
                                            <div id="edatRecFecLabHeDdF" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                            <div id="eRecFecMenorDd" class="invalid-tooltip">
                                                <?php echo "Fecha Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeRecInicioHeDd" name="timeRecInicioHeDd" step="2">
                                            <div id="etimeInicioHeDd" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeRecFinHeDd" name="timeRecFinHeDd" step="2">
                                            <div id="eRecHoraMenorDd" class="invalid-tooltip">
                                                <?php echo "Hora Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-1 text-center">
                                            <div class="form-control form-control-sm" id="RecCantHeDd">
                                                Se calcula
                                                <input type="number" id="numRecCantHeDd" name="numRecCantHeDd" value="99" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="div-mostrar div-lg-cp div-gris col-md-3">
                                            <input hidden type="number" id="numIdHeNd" name="numIdHeNd" value="6">
                                            <strong>&nbsp&nbsp&nbspNocturna Dominical y Festivos</strong>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeNdI" name="datFecLabHeNdI">
                                            <div id="edatFecLabHeNdI" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                            <div id="eFecMenorNd" class="invalid-tooltip">
                                                <?php echo "Fecha Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeNdF" name="datFecLabHeNdF">
                                            <div id="edatFecLabHeNdF" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                            <div id="eFecMenorNd" class="invalid-tooltip">
                                                <?php echo "Fecha Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeInicioHeNd" name="timeInicioHeNd" step="2">
                                            <div id="etimeInicioHeNd" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeFinHeNd" name="timeFinHeNd" step="2">
                                            <div id="eHoraMenorNd" class="invalid-tooltip">
                                                <?php echo "Hora Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp div-gris  col-md-1 text-center">
                                            <div class="form-control form-control-sm" id="CantHeNd">
                                                Se calcula
                                                <input type="number" id="numCantHeNd" name="numCantHeNd" value="99" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="div-mostrar div-lg-cp bor-bottom-left col-md-3">
                                            <input hidden type="number" id="numIdHeHd" name="numIdHeHd" value="7">
                                            <strong>&nbsp&nbsp&nbspRecargo Nocturno Dominical y Festivo</strong>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeHdI" name="datFecLabHeHdI">
                                            <div id="edatFecLabHeHdI" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="date" class="form-control form-control-sm" id="datFecLabHeHdF" name="datFecLabHeHdF">
                                            <div id="edatFecLabHeHdF" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                            <div id="eFecMenorHd" class="invalid-tooltip">
                                                <?php echo "Fecha Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeInicioHeHd" name="timeInicioHeHd" step="2">
                                            <div id="etimeInicioHeHd" class="invalid-tooltip">
                                                <?php echo "Diligenciar este campo" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp col-md-2 text-center">
                                            <input type="time" class="form-control form-control-sm" id="timeFinHeHd" name="timeFinHeHd" step="2">
                                            <div id="eHoraMenorHd" class="invalid-tooltip">
                                                <?php echo "Hora Inicio es Mayor" ?>
                                            </div>
                                        </div>
                                        <div class="div-mostrar div-lg-cp bor-bottom-right col-md-1 text-center">
                                            <div class="form-control form-control-sm" id="CantHeHd">
                                                Se calcula
                                                <input type="number" id="numCantHeHd" name="numCantHeHd" value="99" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="txtdocEmp" name="txtdocEmp" value="<?php echo $empleado['no_documento'] ?>" hidden>
                                <br>
                                <button class="btn btn-primary btn-sm" id="btnAddHe">Registrar</button>
                                <a type="button" class="btn btn-danger btn-sm" href="../../../empleados/listempleados.php"> Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../../../footer.php' ?>
        </div>
        <div class="modal fade" id="divModalExito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divDone">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                            ¡Correcto!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divMsgExito">

                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary btn-sm" href="<?php echo $_SESSION['urlin'] ?>/nomina/extras/horas/registrar/registrohe.php?trab=<?php echo $idemhe ?> ">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="divModalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <button type="button" class="btn btn-primary btn-sm" id="btnModalError">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../../../scripts.php' ?>
</body>

</html>