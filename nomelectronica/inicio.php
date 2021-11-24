<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include 'head.php' ?>

<body class="sb-nav-fixed <?php if ($_SESSION['navarlat'] === '1') {
                                echo 'sb-sidenav-toggled';
                            } ?>">
    <?php include 'navsuperior.php' ?>
    <div id="layoutSidenav">
        <?php include 'navlateral.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid p-2">
                    <div class="card mb-4">
                        <div class="card-header" id="divTituloPag">
                            <i class="fas fa-house-user fa-lg" style="color: #1D80F7"></i> INICIO
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div class="center-block">
                                <div class="container-fluid">
                                    <div class="input-group">
                                        <div id="modulo01" class="col mb-4">
                                            <div class="card shadow-g" style="width: 12rem;">
                                                <a data-toggle="collapse" href="#nomEmpleados" role="button" aria-expanded="false" aria-controls="nomEmpleados">
                                                    <img class="card-img-top" src="images/nomina.png" title="NÓMINA">
                                                </a>
                                                <div class="collapse py-2" id="nomEmpleados">
                                                    <a class="nav-link py-0 altura sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/empleados/listempleados.php">
                                                        <div class="input-group">
                                                            <i class="fas fa-users fa-sm py-1" style="color: #85C1E9;"></i>&nbsp;Empleados
                                                        </div>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="change_row nav-link collapsed py-0 altura sombra" href="#" data-toggle="collapse" data-target="#devHoexViat" aria-expanded="true" aria-controls="devHoexViat">
                                                        <div class="input-group">
                                                            <i class="fas fa-donate fa-sm py-1" style="color: #FFC300CC;"></i>&nbsp;Devengados
                                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                                                        </div>
                                                    </a>
                                                    <div class="collapse" id="devHoexViat">
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="<?php echo $_SESSION['urlin'] ?>/nomina/extras/horas/listhoraextra.php"><i class="fas fa-history fa-xs" style="color: #F9E79Fff;"></i>&nbsp;Horas extra</a>
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="<?php echo $_SESSION['urlin'] ?>/nomina/extras/viaticos/listviaticos.php"><i class="fas fa-suitcase-rolling fa-xs" style="color: #73C6B6ff;"></i>&nbsp;Viáticos</a>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="change_row nav-link collapsed py-0 altura sombra" href="#" data-toggle="collapse" data-target="#segSocial" aria-expanded="false" aria-controls="segSocial">
                                                        <div class="input-group">
                                                            <i class="fas fa-medkit fa-sm py-1" style="color: #A569BD;"></i>&nbsp;Seguridad Social
                                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                                                        </div>
                                                    </a>
                                                    <div class="collapse" id="segSocial">
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/eps/listeps.php"><i class="fas fa-hospital fa-xs" style="color: #EC7063;"></i>&nbsp;EPS</a>
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/arl/listarl.php"><i class="far fa-hospital fa-xs" style="color: #F8C471;"></i>&nbsp;ARL</a>
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/afp/listafp.php"><i class="fas fa-gopuram fa-xs" style="color: #E59866;"></i>&nbsp;AFP</a>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="nav-link collapsed py-0 altura sombra" href="#" data-toggle="collapse" data-target="#liqNomina" aria-expanded="false" aria-controls="liqNomina">
                                                        <div class="input-group">
                                                            <i class="fas fa-money-check-alt fa-sm py-1" style="color: #D35400CC;"></i>&nbsp;Liquidar Nómina
                                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                                                        </div>
                                                    </a>
                                                    <div class="collapse" id="liqNomina">
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="<?php echo $_SESSION['urlin'] ?>/nomina/liquidar_nomina/listempliquidar.php"><i class="fas fa-file-invoice-dollar fa-xs" style="color: #2ECC71;"></i>&nbsp;Mensual</a>
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="<?php echo $_SESSION['urlin'] ?>/nomina/liquidar_nomina/liqxempleado.php"><i class="fas fa-funnel-dollar fa-xs"></i>&nbsp;Por Empleado</a>
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="<?php echo $_SESSION['urlin'] ?>/nomina/liquidar_nomina/mostrar/liqxmes.php"><i class="far fa-calendar-check fa-xs" style="color: #2471A3;"></i>&nbsp;Liquidado</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="modulo02" class="col mb-4">
                                            <div class="card shadow-g" style="width: 12rem;">
                                                <a data-toggle="collapse" href="#terceros" role="button" aria-expanded="false" aria-controls="terceros">
                                                    <img class="card-img-top" src="images/terceros.png" title="TERCEROS">
                                                </a>
                                                <div class="collapse py-2" id="terceros">
                                                    <a class="nav-link py-0 altura sombra" href="<?php echo $_SESSION['urlin'] ?>/terceros/gestion/listterceros.php">
                                                        <div class="input-group">
                                                            <i class="fas fa-users fa-sm py-1" style="color: #85C1E9;"></i>&nbsp;Gestion
                                                        </div>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="change_row nav-link collapsed py-0 altura sombra" href="#" data-toggle="collapse" data-target="#divOtro" aria-expanded="true" aria-controls="divOtro">
                                                        <div class="input-group">
                                                            <i class="fas fa-donate fa-sm py-1" style="color: #FFC300CC;"></i>&nbsp;Mas
                                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                                                        </div>
                                                    </a>
                                                    <div class="collapse" id="divOtro">
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="#"><i class="fas fa-history fa-xs" style="color: #F9E79Fff;"></i>&nbsp;Otras mas</a>
                                                        <div class="dropdown-divider w-75 ml-auto mr-0 mr-md-3 my-2 my-md-1"></div>
                                                        <a class="nav-link py-0 small alto-20 sombra ml-4 mr-0 mr-md-3 my-2 my-md-1" href="#"><i class="fas fa-suitcase-rolling fa-xs" style="color: #73C6B6ff;"></i>&nbsp;Mas otras</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="modulo03" class="col mb-4">
                                            <div class="card shadow-g" style="width: 12rem;">
                                                <a data-toggle="collapse" href="#algo0" role="button" aria-expanded="false" aria-controls="algo0">
                                                    <img class="card-img-top" src="images/contratacion.png" title="CONTRACIÓN">
                                                </a>
                                                <div class="collapse py-2" id="algo0">
                                                    <a class="nav-link py-0 altura sombra" href="#">
                                                        <div class="input-group">
                                                            <i class="fas fa-users fa-sm py-1" style="color: #85C1E9;"></i>&nbsp;Otro
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="center-block">
                                <div class="container-fluid">
                                    <div class="input-group">
                                        <div id="modulo04" class="col mb-4">
                                            <div class="card shadow-g" style="width: 12rem;">
                                                <a data-toggle="collapse" href="#algo1" role="button" aria-expanded="false" aria-controls="algo1">
                                                    <img class="card-img-top" src="images/vacio.png" title="OTRA">
                                                </a>
                                                <div class="collapse py-2" id="algo1">
                                                    <a class="nav-link py-0 altura sombra" href="#">
                                                        <div class="input-group">
                                                            <i class="fas fa-users fa-sm py-1" style="color: #85C1E9;"></i>&nbsp;Otro
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="modulo05" class="col mb-4">
                                            <div class="card shadow-g" style="width: 12rem;">
                                                <a data-toggle="collapse" href="#algo2" role="button" aria-expanded="false" aria-controls="algo2">
                                                    <img class="card-img-top" src="images/vacio.png" title="OTRA">
                                                </a>
                                                <div class="collapse py-2" id="algo2">
                                                    <a class="nav-link py-0 altura sombra" href="#">
                                                        <div class="input-group">
                                                            <i class="fas fa-users fa-sm py-1" style="color: #85C1E9;"></i>&nbsp;Otro
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="modulo06" class="col mb-4">
                                            <div class="card shadow-g" style="width: 12rem;">
                                                <a data-toggle="collapse" href="#algo4" role="button" aria-expanded="false" aria-controls="algo4">
                                                    <img class="card-img-top" src="images/vacio.png" title="OTRA">
                                                </a>
                                                <div class="collapse py-2" id="algo4">
                                                    <a class="nav-link py-0 altura sombra" href="#">
                                                        <div class="input-group">
                                                            <i class="fas fa-users fa-sm py-1" style="color: #85C1E9;"></i>&nbsp;Otro
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'footer.php' ?>
        </div>
    </div>
    <?php include 'scripts.php' ?>
</body>

</html>