<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_epss";
    $rs = $cmd->query($sql);
    $eps = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_arl";
    $rs = $cmd->query($sql);
    $arl = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_riesgos_laboral";
    $rs = $cmd->query($sql);
    $rlab = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_afp";
    $rs = $cmd->query($sql);
    $afp = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT * FROM seg_tipo_empleado";
    $rs = $cmd->query($sql);
    $tipoempleado = $rs->fetchAll();
    $sql = "SELECT * FROM seg_subtipo_empl";
    $rs = $cmd->query($sql);
    $subtipoemp = $rs->fetchAll();
    $sql = "SELECT * FROM seg_tipo_contrato";
    $rs = $cmd->query($sql);
    $tipocontrato = $rs->fetchAll();
    $sql = "SELECT * FROM seg_tipos_documento";
    $rs = $cmd->query($sql);
    $tipodoc = $rs->fetchAll();
    $sql = "SELECT * FROM seg_cargo_empleado";
    $rs = $cmd->query($sql);
    $cargo = $rs->fetchAll();
    $sql = "SELECT * FROM seg_pais";
    $rs = $cmd->query($sql);
    $pais = $rs->fetchAll();
    $sql = "SELECT * FROM seg_departamento ORDER BY nombre_dpto";
    $rs = $cmd->query($sql);
    $dpto = $rs->fetchAll();
    $sql = "SELECT * FROM seg_bancos ORDER BY nom_banco";
    $rs = $cmd->query($sql);
    $banco = $rs->fetchAll();
    $sql = "SELECT * FROM seg_tipo_cta ORDER BY tipo_cta";
    $rs = $cmd->query($sql);
    $tipocta = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$error = "Debe diligenciar este campo";
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../../head.php' ?>

<body class="sb-nav-fixed <?php
                            if ($_SESSION['navarlat'] === '1') {
                                echo 'sb-sidenav-toggled';
                            }
                            ?>">
    <?php include '../../../navsuperior.php' ?>
    <div id="layoutSidenav">
        <?php include '../../../navlateral.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid p-2">
                    <div class="card mb-4">
                        <div class="card-header" id="divTituloPag">
                            <i class="fas fa-user-plus fa-lg" style="color: #07CF74;"></i>
                            REGISTRAR EMPLEADO
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div class="card-header p-2" id="divDivisor">
                                <div class="text-center">DATOS DE EMPLEADO</div>
                            </div>
                            <div class="shadow">
                                <form id="formNuevoEmpleado">
                                    <div class="form-row p-2">
                                        <div class="form-group col-md-3">
                                            <label for="slcTipoEmp" class="small">Tipo de empleado</label>
                                            <select id="slcTipoEmp" name="slcTipoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="0">--Selecionar tipo--</option>
                                                <?php
                                                foreach ($tipoempleado as $te) {
                                                    echo '<option value="' . $te['id_tip_empl'] . '">' . $te['descripcion'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcTipoEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="slcSubTipoEmp" class="small">Subtipo de empleado</label>
                                            <select id="slcSubTipoEmp" name="slcSubTipoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="0">--Selecionar subtipo--</option>
                                                <?php
                                                foreach ($subtipoemp as $ste) {
                                                    echo '<option value="' . $ste['id_sub_emp'] . '">' . $ste['descripcion'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcSubTipoEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slcAltoRiesgo" class="small">Alto riesgo</label>
                                            <select id="slcAltoRiesgo" name="slcAltoRiesgo" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="a">--Selecionar--</option>
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                            <div id="eslcAltoRiesgo" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slcTipoContratoEmp" class="small">Tipo de contrato</label>
                                            <select id="slcTipoContratoEmp" name="slcTipoContratoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="0">--Selecionar tipo--</option>
                                                <?php
                                                foreach ($tipocontrato as $tc) {
                                                    echo '<option value="' . $tc['id_tip_contrato'] . '">' . $tc['descripcion'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcTipoContratoEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slcTipoDocEmp" class="small">Tipo de documento</label>
                                            <select id="slcTipoDocEmp" name="slcTipoDocEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="0">--Selecionar tipo--</option>
                                                <?php
                                                foreach ($tipodoc as $td) {
                                                    echo '<option value="' . $td['id_tipodoc'] . '">' . $td['descripcion'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcTipoDocEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row p-2">
                                        <div class="form-group col-md-3">
                                            <label for="txtCCempleado" class="small">Número de documento</label>
                                            <input type="text" class="form-control form-control-sm" id="txtCCempleado" name="txtCCempleado" placeholder="Identificación">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="slcGenero" class="small">Género</label>
                                            <select id="slcGenero" name="slcGenero" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option value="0">--Selecionar--</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                            <div id="eslcGenero" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtNomb1Emp" class="small">Primer nombre</label>
                                            <input type="text" class="form-control form-control-sm" id="txtNomb1Emp" name="txtNomb1Emp" placeholder="Nombre">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtNomb2Emp" class="small">Segundo nombre</label>
                                            <input type="text" class="form-control form-control-sm" id="txtNomb2Emp" name="txtNomb2Emp" placeholder="Nombre">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtApe1Emp" class="small">Primer apellido</label>
                                            <input type="text" class="form-control form-control-sm" id="txtApe1Emp" name="txtApe1Emp" placeholder="Apellido">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtApe2Emp" class="small">Segundo apellido</label>
                                            <input type="text" class="form-control form-control-sm" id="txtApe2Emp" name="txtApe2Emp" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="form-row p-2">
                                        <div class="form-group col-md-3">
                                            <label for="datInicio" class="small">Fecha de inicio</label>
                                            <input type="date" class="form-control form-control-sm" id="datInicio" name="datInicio">
                                            <div id="edatInicio" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slcSalIntegral" class="small">Salario integral</label>
                                            <select id="slcSalIntegral" name="slcSalIntegral" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="a">--Selecionar--</option>
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                            <div id="eslcSalIntegral" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="numSalarioEmp" class="small">Salario (base)</label>
                                            <input type="text" class="form-control form-control-sm" id="numSalarioEmp" name="numSalarioEmp" placeholder="Salario básico">
                                            <div id="enumSalarioEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mailEmp" class="small">Correo</label>
                                            <input type="email" class="form-control form-control-sm" id="mailEmp" name="mailEmp" placeholder="Correo electrónico">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtTelEmp" class="small">Contacto</label>
                                            <input type="text" class="form-control form-control-sm" id="txtTelEmp" name="txtTelEmp" placeholder="Teléfono/celular">
                                        </div>
                                    </div>
                                    <div class="form-row p-2">
                                        <div class="form-group col-md-2">
                                            <label for="slcCargoEmp" class="small">Cargo</label>
                                            <select id="slcCargoEmp" name="slcCargoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="0">--Selecionar cargo--</option>
                                                <?php
                                                foreach ($cargo as $c) {
                                                    echo '<option value="' . $c['id_cargo'] . '">' . $c['descripcion_carg'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slcPaisEmp" class="small">País</label>
                                            <select id="slcPaisEmp" name="slcPaisEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="0">--Selecionar País--</option>
                                                <?php
                                                foreach ($pais as $p) {
                                                    echo '<option value="' . $p['id_pais'] . '">' . $p['nombre_pais'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcPaisEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slcDptoEmp" class="small">Departamento</label>
                                            <select id="slcDptoEmp" name="slcDptoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="0">--Selecionar departamento--</option>
                                                <?php
                                                foreach ($dpto as $d) {
                                                    echo '<option value="' . $d['id_dpto'] . '">' . $d['nombre_dpto'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcDptoEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="slcMunicipioEmp" class="small">Municipio</label>
                                            <select id="slcMunicipioEmp" name="slcMunicipioEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example" placeholder="elegir mes">
                                                <option selected value="0">Debe elegir departamento</option>
                                            </select>
                                            <div id="eslcMunicipioEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="txtDireccion" class="small">Dirección</label>
                                            <input type="text" class="form-control form-control-sm" id="txtDireccion" name="txtDireccion" placeholder="Residencial">
                                            <div id="etxtDireccion" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row p-2">
                                        <div class="form-group col-md-3">
                                            <label for="slcBancoEmp" class="small">Banco</label>
                                            <select id="slcBancoEmp" name="slcBancoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="0">--Selecionar banco--</option>
                                                <?php
                                                foreach ($banco as $b) {
                                                    echo '<option value="' . $b['id_banco'] . '">' . $b['nom_banco'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcBancoEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="selTipoCta" class="small">Tipo de cuenta</label>
                                            <select id="selTipoCta" name="selTipoCta" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <option selected value="0">--Selecionar--</option>
                                                <?php
                                                foreach ($tipocta as $tcb) {
                                                    echo '<option value="' . $tcb['id_tipo_cta'] . '">' . $tcb['tipo_cta'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eselTipoCta" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtCuentaBanc" class="small">Número de cuenta</label>
                                            <input type="text" class="form-control form-control-sm" id="txtCuentaBanc" name="txtCuentaBanc" placeholder="Sin espacios">
                                            <div id="etxtCuentaBanc" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="number" id="numEstadoEmp" value="1" name="numEstadoEmp" hidden>
                                    <div class="card-header py-2" id="divDivisor">
                                        <div class="text-center">DATOS DE EMPRESA PRESTADORA DE SALUD (EPS)</div>
                                    </div>
                                    <div class="form-row p-2">
                                        <div class="form-group col-md-4">
                                            <label for="slcEps" class="small">EPS</label>
                                            <select id="slcEps" name="slcEps" class="form-control form-control-sm py-0" aria-label="Default select example">
                                                <option selected value="0">--Selecionar EPS--</option>
                                                <?php
                                                foreach ($eps as $e) {
                                                    echo '<option value="' . $e['id_eps'] . '">' . $e['nombre_eps'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="datFecAfilEps" class="small">Afilición</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control form-control-sm" name="datFecAfilEps" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="datFecRetEps" class="small">Retiro</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control form-control-sm" name="datFecRetEps" value="<?php echo date('Y') ?>-12-31">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header py-2" id="divDivisor">
                                        <div class="text-center">DATOS DE ASEGURADORA DE RIESGOS LABORALES (ARL)</div>
                                    </div>
                                    <div class="form-row p-2">
                                        <div class="form-group col-md-4">
                                            <label for="slcArl" class="small">ARL</label>
                                            <select id="slcArl" id="slcArl" name="slcArl" class="form-control form-control-sm py-0" aria-label="Default select example">
                                                <option selected value="0">--Selecionar ARL--</option>
                                                <?php
                                                foreach ($arl as $a) {
                                                    echo '<option value="' . $a['id_arl'] . '">' . $a['nombre_arl'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="datFecAfilArl" class="small">Afilición</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control form-control-sm" name="datFecAfilArl" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="datFecRetArl" class="small">Retiro</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control form-control-sm" name="datFecRetArl" value="<?php echo date('Y') ?>-12-31">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="slcRiesLab" class="small">Riesgo laboral</label>
                                            <select id="slcRiesLab" name="slcRiesLab" class="form-control form-control-sm py-0" aria-label="Default select example">
                                                <option selected value="0">--Selecionar clase--</option>
                                                <?php
                                                foreach ($rlab as $r) {
                                                    echo '<option value="' . $r['id_rlab'] . '">' . $r['clase'] . ' - ' . $r['riesgo'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-header py-2" id="divDivisor">
                                        <div class="text-center">DATOS DE ADMINISTRADORA DE FONDOS DE PENSIONES (AFP)</div>
                                    </div>
                                    <div class="form-row px-2 pt-2">
                                        <div class="form-group col-md-4">
                                            <label for="slcAfp" class="small">AFP</label>
                                            <select id="slcAfp" name="slcAfp" class="form-control form-control-sm py-0" aria-label="Default select example">
                                                <option selected value="0">--Selecionar AFP--</option>
                                                <?php
                                                foreach ($afp as $a) {
                                                    echo '<option value="' . $a['id_afp'] . '">' . $a['nombre_afp'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="datFecAfilAfp" class="small">Afilición</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control form-control-sm" name="datFecAfilAfp" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="datFecRetAfp" class="small">Retiro</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control form-control-sm" name="datFecRetAfp" value="<?php echo date('Y') ?>-12-31">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center pb-3">
                                        <button class="btn btn-primary btn-sm" id="btnNuevoEmpleado">Registrar</button>
                                        <a type="button" class="btn btn-danger btn-sm" href="../listempleados.php"> Cancelar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../../footer.php' ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divDone">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                            ¡Correcto!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divMsgDone">

                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary btn-sm" href="javascript:location.reload()">Aceptar</a>
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
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../../scripts.php' ?>
</body>

</html>