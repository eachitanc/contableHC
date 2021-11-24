<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';

$idemp = $_POST['idUpEmpl'];
$vigencia = $_SESSION['vigencia'];

function pesos($valor)
{
    return '$' . number_format($valor, 2);
}

try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_empleado WHERE id_empleado = '$idemp'";
    $rs = $cmd->query($sql);
    $obj = $rs->fetch();
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
    $iddpto = $obj['departamento'];
    $sql = "SELECT * FROM seg_departamento ORDER BY nombre_dpto";
    $rs = $cmd->query($sql);
    $dpto = $rs->fetchAll();
    $sql = "SELECT * FROM seg_municipios WHERE id_departamento = '$iddpto' ORDER BY nom_municipio";
    $rs = $cmd->query($sql);
    $municipio = $rs->fetchAll();
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
                            <i class="fas fa-user-edit fa-lg" style="color: #07CF74;"></i>
                            ACTUALIZAR EMPLEADO
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <form id="formUpEmpleado">
                                <form id="formNuevoEmpleado">
                                    <div class="form-row py-0">
                                        <div class="form-group col-md-3">
                                            <label for="slcTipoEmp" class="small">Tipo de empleado</label>
                                            <select id="slcTipoEmp" name="slcTipoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <?php
                                                foreach ($tipoempleado as $te) {
                                                    if ($te['id_tip_empl'] !== $obj['tipo_empleado']) {
                                                        echo '<option value="' . $te['id_tip_empl'] . '">' . $te['descripcion'] . '</option>';
                                                    } else {
                                                        echo '<option selected value="' . $te['id_tip_empl'] . '">' . $te['descripcion'] . '</option>';
                                                    }
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
                                                <?php
                                                foreach ($subtipoemp as $ste) {
                                                    if ($st['id_sub_emp'] !== $obj['subtipo_empleado']) {
                                                        echo '<option value="' . $ste['id_sub_emp'] . '">' . $ste['descripcion'] . '</option>';
                                                    } else {
                                                        echo '<option selected value="' . $ste['id_sub_emp'] . '">' . $ste['descripcion'] . '</option>';
                                                    }
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
                                                <?php
                                                if ($obj['alto_riesgo_pension'] === '0') {
                                                    echo '<option selected value="0">No</option>'
                                                        . '<option value="1">Si</option>';
                                                } else {
                                                    echo '<option selected value="1">Si</option>'
                                                        . '<option value="0">No</option>';
                                                }
                                                ?>


                                            </select>
                                            <div id="eslcAltoRiesgo" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slcTipoContratoEmp" class="small">Tipo de contrato</label>
                                            <select id="slcTipoContratoEmp" name="slcTipoContratoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <?php
                                                foreach ($tipocontrato as $tc) {
                                                    if ($obj['tipo_contrato'] === $tc['id_tip_contrato']) {
                                                        echo '<option selected value="' . $tc['id_tip_contrato'] . '">' . $tc['descripcion'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $tc['id_tip_contrato'] . '">' . $tc['descripcion'] . '</option>';
                                                    }
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
                                                    if ($obj['tipo_doc'] === $td['id_tipodoc']) {
                                                        echo '<option selected value="' . $td['id_tipodoc'] . '">' . $td['descripcion'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $td['id_tipodoc'] . '">' . $td['descripcion'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcTipoDocEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row py-0">
                                        <div class="form-group col-md-3">
                                            <label for="txtCCempleado" class="small">Número de documento</label>
                                            <input type="text" class="form-control form-control-sm" id="txtCCempleado" name="txtCCempleado" value="<?php echo $obj['no_documento']; ?>" placeholder="Identificación">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="slcUpGenero" class="small">Género</label>
                                            <select id="slcUpGenero" name="slcUpGenero" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <?php
                                                if ($obj['genero'] === 'M') {
                                                    echo '<option selected value="M">Masculino</option>'
                                                        . '<option value="F">Femenino</option>';
                                                } else {
                                                    echo '<option selected value="F">Femenino</option>'
                                                        . '<option value="M">Masculino</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcUpGenero" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtNomb1Emp" class="small">Primer nombre</label>
                                            <input type="text" class="form-control form-control-sm" id="txtNomb1Emp" name="txtNomb1Emp" value="<?php echo $obj['nombre1']; ?>" placeholder="Nombre">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtNomb2Emp" class="small">Segundo nombre</label>
                                            <input type="text" class="form-control form-control-sm" id="txtNomb2Emp" name="txtNomb2Emp" value="<?php echo $obj['nombre2']; ?>" placeholder="Nombre">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtApe1Emp" class="small">Primer apellido</label>
                                            <input type="text" class="form-control form-control-sm" id="txtApe1Emp" name="txtApe1Emp" value="<?php echo $obj['apellido1']; ?>" placeholder="Apellido">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtApe2Emp" class="small">Segundo apellido</label>
                                            <input type="text" class="form-control form-control-sm" id="txtApe2Emp" name="txtApe2Emp" value="<?php echo $obj['apellido2']; ?>" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="datInicio" class="small">Fecha de inicio</label>
                                            <input type="date" class="form-control form-control-sm" id="datInicio" value="<?php echo $obj['fech_inicio']; ?>" name="datInicio">
                                            <div id="edatInicio" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="datFecRetiro" class="small">Fecha de retiro</label>
                                            <input type="date" class="form-control form-control-sm" id="datFecRetiro" name="datFecRetiro">
                                            <div id="edatInicio" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slcSalIntegral" class="small">Salario integral</label>
                                            <select id="slcSalIntegral" name="slcSalIntegral" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <?php
                                                if ($obj['salario_integral'] === '0') {
                                                    echo '<option selected value="0">No</option>'
                                                        . '<option value="1">Si</option>';
                                                } else {
                                                    echo '<option selected value="1">Si</option>'
                                                        . '<option value="0">No</option>';
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcSalIntegral" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="numSalarioEmp" class="small">Salario (base)</label>
                                            <input type="text" class="form-control form-control-sm" id="numSalarioEmp" name="numSalarioEmp" value="<?php
                                                                                                                                                        $ide = $obj['id_empleado'];
                                                                                                                                                        $empkey = array_search($ide, array_column($salarios, 'id_empleado'));
                                                                                                                                                        if ($empkey !== "") {
                                                                                                                                                            foreach ($salarios as $sa) {
                                                                                                                                                                if ($ide === $sa['id_empleado']) {
                                                                                                                                                                    echo ($sa['salario_basico']);
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                        ?>" placeholder="Salario básico">
                                            <div id="enumSalarioEmp" class="invalid-tooltip">
                                                <?php
                                                echo $error
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="mailEmp" class="small">Correo</label>
                                            <input type="email" class="form-control form-control-sm" id="mailEmp" name="mailEmp" value="<?php echo $obj['correo']; ?>" placeholder="Correo electrónico">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtTelEmp" class="small">Contacto</label>
                                            <input type="text" class="form-control form-control-sm" id="txtTelEmp" name="txtTelEmp" value="<?php echo $obj['telefono']; ?>" placeholder="Teléfono/celular">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="slcCargoEmp" class="small">Cargo</label>
                                            <select id="slcCargoEmp" name="slcCargoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <?php
                                                foreach ($cargo as $c) {
                                                    if ($obj['cargo'] === $c['id_cargo']) {
                                                        echo '<option selected value="' . $c['id_cargo'] . '">' . $c['descripcion_carg'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $c['id_cargo'] . '">' . $c['descripcion_carg'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slcPaisEmp" class="small">País</label>
                                            <select id="slcPaisEmp" name="slcPaisEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <?php
                                                foreach ($pais as $p) {
                                                    if ($obj['pais'] === $p['id_pais']) {
                                                        echo '<option selected value="' . $p['id_pais'] . '">' . $p['nombre_pais'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $p['id_pais'] . '">' . $p['nombre_pais'] . '</option>';
                                                    }
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
                                                <?php
                                                foreach ($dpto as $d) {
                                                    if ($obj['departamento'] === $d['id_dpto']) {
                                                        echo '<option selected value="' . $d['id_dpto'] . '">' . $d['nombre_dpto'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $d['id_dpto'] . '">' . $d['nombre_dpto'] . '</option>';
                                                    }
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
                                                <?php
                                                foreach ($municipio as $m) {
                                                    if ($obj['municipio'] === $m['id_municipio']) {
                                                        echo '<option selected value="' . $m['id_municipio'] . '">' . $m['nom_municipio'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $m['id_municipio'] . '">' . $m['nom_municipio'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div id="eslcMunicipioEmp" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="txtDireccion" class="small">Dirección</label>
                                            <input type="text" class="form-control form-control-sm" id="txtDireccion" name="txtDireccion" value="<?php echo $obj['direccion'] ?>" placeholder="Residencial">
                                            <div id="etxtDireccion" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="slcBancoEmp" class="small">Banco</label>
                                            <select id="slcBancoEmp" name="slcBancoEmp" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                                                <?php
                                                foreach ($banco as $b) {
                                                    if ($obj['id_banco'] === $b['id_banco']) {
                                                        echo '<option selected value="' . $b['id_banco'] . '">' . $b['nom_banco'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $b['id_banco'] . '">' . $b['nom_banco'] . '</option>';
                                                    }
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
                                                <?php
                                                foreach ($tipocta as $tcb) {
                                                    if ($obj['tipo_cta'] === $tcb['id_tipo_cta']) {
                                                        echo '<option selected value="' . $tcb['id_tipo_cta'] . '">' . $tcb['tipo_cta'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $tcb['id_tipo_cta'] . '">' . $tcb['tipo_cta'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div id="eselTipoCta" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="txtCuentaBanc" class="small">Número de cuenta</label>
                                            <input type="text" class="form-control form-control-sm" id="txtCuentaBanc" name="txtCuentaBanc" value="<?php echo $obj['cuenta_bancaria'] ?>" placeholder="Sin espacios">
                                            <div id="etxtCuentaBanc" class="invalid-tooltip">
                                                <?php echo $error ?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="number" id="idEmpleado" name="idEmpleado" value="<?php echo $obj['id_empleado'] ?>" hidden>
                                    <button class="btn btn-primary btn-sm" id="btnUpEmpleado"> Actualizar</button>
                                    <a type="button" class="btn btn-danger btn-sm" href="../listempleados.php"> Cancelar</a>
                                </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../../footer.php' ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalupEmpHecho" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divDone">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                            ¡Correcto!
                        </h5>
                    </div>
                    <div class="modal-body text-center">
                        Datos de empleado actualizado correctamente.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" id="btnCerrarModalupEmpH">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="divModalupError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeader">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-circle fa-lg" style="color:red"></i>
                            ¡Error!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divcontenido">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="divModalNewEmpError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeader">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-circle fa-lg" style="color:red"></i>
                            ¡Error!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divErrorNewEmpSQL">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" id="btnCerrarModalNewError">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../../scripts.php' ?>
</body>

</html>