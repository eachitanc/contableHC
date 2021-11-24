<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu ">
            <div class="nav">
                <!--<a class="nav-link sombra" href="<?php //echo $_SESSION['urlin'] 
                                                        ?>/inicio.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-home fa-lg" style="color: #5DADE2;"></i></div>
                    Inicio
                </a>-->
                <div class="sb-sidenav-menu-heading">MÓDULOS</div>
                <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon "><i class="fas fa-calculator fa-lg" style="color: #2ECC71CC;"></i></div>
                    Nómina
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav ">
                        <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/empleados/listempleados.php"><i class="fas fa-users fa-sm" style="color: #85C1E9;"></i>&nbsp;Empleados</a>
                        <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth2" aria-expanded="false" aria-controls="pagesCollapseAuth2">
                            <i class="fas fa-donate fa-sm" style="color: #FFC300CC;"></i>&nbsp;Devengados
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth2" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/extras/horas/listhoraextra.php"><i class="fas fa-history fa-xs" style="color: #F9E79F;"></i>&nbsp;Horas extra</a>
                                <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/extras/viaticos/listviaticos.php"><i class="fas fa-suitcase-rolling fa-xs" style="color: #73C6B6;"></i>&nbsp;Viáticos</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth3" aria-expanded="false" aria-controls="pagesCollapseAuth3">
                            <i class="fas fa-medkit fa-sm" style="color: #A569BD;"></i>&nbsp;Seg. social
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth3" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/eps/listeps.php"><i class="fas fa-hospital fa-xs" style="color: #EC7063;"></i>&nbsp;EPS</a>
                                <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/arl/listarl.php"><i class="far fa-hospital fa-xs" style="color: #F8C471;"></i>&nbsp;ARL</a>
                                <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/seguridad_social/afp/listafp.php"><i class="fas fa-gopuram fa-xs" style="color: #E59866;"></i>&nbsp;AFP</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#liqnomina" aria-expanded="false" aria-controls="liqnomina">
                            <i class="fas fa-money-check-alt fa-sm" style="color: #fc6404;"></i>&nbsp;Liq. Nómina
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                        </a>
                        <div class="collapse" id="liqnomina" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/liquidar_nomina/listempliquidar.php"><i class="fas fa-file-invoice-dollar fa-xs" style="color: #2ECC71;"></i>&nbsp;Mensual</a>
                                <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/liquidar_nomina/liqxempleado.php"><i class="fas fa-funnel-dollar fa-xs"></i>&nbsp;Por Empleado</a>
                                <a class="nav-link collapsed sombra" href="<?php echo $_SESSION['urlin'] ?>/nomina/liquidar_nomina/mostrar/liqxmes.php"><i class="far fa-calendar-check fa-sm" style="color: #2471A3;"></i>&nbsp;Liquidado</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <!--MODULO-->
                <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#collapseTerceros" aria-expanded="false" aria-controls="collapseTerceros">
                    <div class="form-row">
                        <div class="div-icono px-1">
                            <span class="fas fa-people-arrows fa-lg" style="color: #2874A6"></span>
                        </div>
                        <div>
                            Terceros
                        </div>
                    </div>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                </a>
                <div class="collapse" id="collapseTerceros" aria-labelledby="headingTerceros" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/terceros/gestion/listterceros.php"><i class="fas fa-users fa-sm" style="color: #85C1E9;"></i>&nbsp;Gestión</a>
                        <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Mas Opciones
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link sombra" href="#">Elegir 4</a>
                                <a class="nav-link sombra" href="#">Elegir 5</a>
                                <a class="nav-link sombra" href="#">Elegir 6</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <!--MODULO-->
                <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#collapseContratacion" aria-expanded="false" aria-controls="collapseContratacion">
                    <div class="form-row">
                        <div class="div-icono px-1">
                            <span class="fas fa-file-signature fa-lg" style="color: #A569BD"></span>
                        </div>
                        <div>
                            Contratación
                        </div>
                    </div>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                </a>
                <div class="collapse" id="collapseContratacion" aria-labelledby="headingContratacion" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/contratacion/gestion/lista_tipos.php"><i class="fas fa-users fa-sm" style="color: #85C1E9;"></i>&nbsp;Gestión</a>
                        <a class="nav-link sombra" href="<?php echo $_SESSION['urlin'] ?>/contratacion/adquisiciones/lista_adquisiciones.php"><i class="fas fa-users fa-sm" style="color: #85C1E9;"></i>&nbsp;Adquisiciones</a>
                        <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#otrasOpcContrat" aria-expanded="false" aria-controls="otrasOpcContrat">
                            Mas Opciones
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                        </a>
                        <div class="collapse" id="otrasOpcContrat" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link sombra" href="#">Elegir 4</a>
                                <a class="nav-link sombra" href="#">Elegir 5</a>
                                <a class="nav-link sombra" href="#">Elegir 6</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <!--MODULO-->
                <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="false" aria-controls="collapsePages2">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-plus fa-lg" style="color: #F1C40F"></i></div>
                    Otros
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages2" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth2" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Opciones
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth2" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link sombra" href="#">Elegir 1</a>
                                <a class="nav-link sombra" href="#">Elegir 2</a>
                                <a class="nav-link sombra" href="#">Elegir 3</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed sombra" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Mas Opciones
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-caret-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link sombra" href="#">Elegir 4</a>
                                <a class="nav-link sombra" href="#">Elegir 5</a>
                                <a class="nav-link sombra" href="#">Elegir 6</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <!--MODULO-->
                <div class="sb-sidenav-menu-heading">Otros Reportes</div>
                <a class="nav-link sombra" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Reportes
                </a>
                <a class="nav-link sombra" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Estats
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer py-0">
            <div class="small">Actualmente:</div>
            <div class="small">
                <?php
                echo "Vigencia: " . $_SESSION['vigencia'];
                echo '<br>';
                echo 'Usuario: &nbsp' . mb_strtoupper($_SESSION['user']);
                ?>
            </div>
        </div>
    </nav>
</div>