<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../index.php");</script>';
    exit();
}
include '../../conexion.php';

function pesos($valor)
{
    return '$' . number_format($valor, 2);
}

$id = $_POST['idDetalEmpl'];
$vigencia = $_SESSION['vigencia'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT *
            FROM
                seg_empleado
            INNER JOIN seg_municipios 
                ON (municipio = seg_municipios.id_municipio)
            INNER JOIN seg_departamento 
                ON (departamento = seg_departamento.id_dpto) AND (seg_municipios.id_departamento = seg_departamento.id_dpto)
            INNER JOIN seg_cargo_empleado 
                ON (seg_empleado.cargo = seg_cargo_empleado.id_cargo)
            WHERE id_empleado = '$id'
            LIMIT 1";
    $rs = $cmd->query($sql);
    $obj = $rs->fetch();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT id_novedad, seg_epss.id_eps, nombre_eps, CONCAT(nit, '-', digito_verific) AS nit, fec_afiliacion, fec_retiro
            FROM
                seg_novedades_eps
            INNER JOIN seg_epss 
                ON (seg_novedades_eps.id_eps = seg_epss.id_eps)
            WHERE id_empleado = '$id'
                ORDER BY fec_afiliacion ASC";
    $rs = $cmd->query($sql);
    $eps = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT id_novarl, seg_arl.id_arl, nombre_arl, CONCAT(nit_arl, '-', dig_ver) AS nitarl, id_riesgo, CONCAT(clase, ' - ', riesgo) AS riesgo, fec_afiliacion, fec_retiro
            FROM
                seg_novedades_arl
            INNER JOIN seg_arl 
                ON (seg_novedades_arl.id_arl = seg_arl.id_arl)
            INNER JOIN seg_riesgos_laboral 
                ON (seg_novedades_arl.id_riesgo = seg_riesgos_laboral.id_rlab)
            WHERE id_empleado = '$id'
            ORDER BY fec_afiliacion ASC";
    $rs = $cmd->query($sql);
    $arl = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_epss ORDER BY nombre_eps ASC";
    $rs = $cmd->query($sql);
    $epsnov = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_arl ORDER BY nombre_arl ASC";
    $rs = $cmd->query($sql);
    $arlnov = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_riesgos_laboral";
    $rs = $cmd->query($sql);
    $rlaboral = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT * FROM seg_afp ORDER BY nombre_afp ASC";
    $rs = $cmd->query($sql);
    $afp = $rs->fetchAll();
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $sql = "SELECT id_novafp, seg_novedades_afp.id_afp, nombre_afp, CONCAT(nit_afp, '-',dig_verf) AS nitafp, fec_afiliacion, seg_novedades_afp.fec_retiro
            FROM
                seg_novedades_afp
            INNER JOIN seg_afp 
                ON (seg_novedades_afp.id_afp = seg_afp.id_afp)
            INNER JOIN seg_empleado 
                ON (seg_novedades_afp.id_empleado = seg_empleado.id_empleado)
            WHERE seg_empleado.id_empleado = '$id'
            ORDER BY fec_afiliacion ASC";
    $rs = $cmd->query($sql);
    $afpnov = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT seg_empleado.id_empleado, vigencia, salario_basico
            FROM
                seg_salarios_basico
            INNER JOIN seg_empleado 
                ON (seg_salarios_basico.id_empleado = seg_empleado.id_empleado)
            WHERE vigencia = '$vigencia' AND  seg_empleado.id_empleado = '$id'";
    $rs = $cmd->query($sql);
    $salemp = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$iduser = $_SESSION['id_user'];
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
    $sql = "SELECT * FROM seg_juzgados ORDER BY municipio";
    $rs = $cmd->query($sql);
    $juzgado = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM
                seg_incapacidad
            INNER JOIN seg_tipo_incapacidad 
                ON (seg_incapacidad.id_tipo = seg_tipo_incapacidad.id_tipo)
            WHERE id_empleado = '$id'
            ORDER BY fec_fin ASC";
    $rs = $cmd->query($sql);
    $listincap = $rs->fetchAll();
    $sql = "SELECT * FROM seg_tipo_incapacidad ORDER BY id_tipo";
    $rs = $cmd->query($sql);
    $tipincap = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT * 
            FROM seg_tipo_embargo
            ORDER BY id_tipo_emb ASC";
    $rs = $cmd->query($sql);
    $tipoembargo = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../head.php' ?>

<body class="sb-nav-fixed 
<?php
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
                                    <i class="fas fa-address-book fa-lg" style="color: #07CF74;"></i>
                                    DETALLES EMPLEADO
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="headingOne">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#datosperson" aria-expanded="true" aria-controls="collapseOne">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="far fa-address-book fa-lg" style="color: #3498DB;"></span>
                                                    </div>
                                                    <div>
                                                        DATOS PERSONALES
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="datosperson" class="collapse show" aria-labelledby="headingOne">
                                        <div class="card-body">
                                            <div class="shadow detalles-empleado">
                                                <div class="row">
                                                    <div class="div-mostrar bor-top-left col-md-2">
                                                        <label class="lbl-mostrar">IDENTIFICACIÓN</label>
                                                        <div class="div-cont"><?php echo $obj['no_documento'] ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-4">
                                                        <label class="lbl-mostrar">NOMBRE COMPLETO</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($obj['nombre1'] . ' ' . $obj['nombre2'] . ' ' . $obj['apellido1'] . ' ' . $obj['apellido2']) ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">DEPARTAMENTO</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($obj['nombre_dpto']) ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">MUNICIPIO</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($obj['nom_municipio']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="div-mostrar bor-top-right col-md-2">
                                                        <label class="lbl-mostrar">DIRECCIÓN</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($obj['direccion']) ?></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="div-mostrar col-md-4">
                                                        <label class="lbl-mostrar">CORREO</label>
                                                        <div class="div-cont"><?php echo $obj['correo'] ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">CONTACTO</label>
                                                        <div class="div-cont"><?php echo $obj['telefono'] ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">FECHA DE INGRESO</label>
                                                        <div class="div-cont"><?php echo $obj['fech_inicio'] ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">CARGO ACTUAL</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($obj['descripcion_carg']) ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">SALARIO BÁSICO</label>
                                                        <input type="text" id="txtSalBas" value="<?php echo $salemp['salario_basico'] ?>" hidden>
                                                        <div class="div-cont"><?php echo pesos($salemp['salario_basico']) ?></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="div-mostrar col-md-4">
                                                        <label class="lbl-mostrar">EPS ACTUAL</label>
                                                        <div class="div-cont">
                                                            <?php
                                                            $nomeps = "NO SE HA REGISTRADO EPS";
                                                            foreach ($eps as $e) {
                                                                $nomeps = $e['nombre_eps'];
                                                            }
                                                            echo mb_strtoupper($nomeps);
                                                            ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-4">
                                                        <label class="lbl-mostrar">AFP ACTUAL</label>
                                                        <div class="div-cont">
                                                            <?php $nomAFP = "NO SE HA REGISTRADO AFP";
                                                            foreach ($afpnov as $afps) {
                                                                $nomAFP = $afps['nombre_afp'];
                                                            }
                                                            echo mb_strtoupper($nomAFP);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="div-mostrar col-md-4">
                                                        <label class="lbl-mostrar">ARL ACTUAL</label>
                                                        <div class="div-cont">
                                                            <?php $nomarl = "NO SE HA REGISTRADO ARL";
                                                            foreach ($arl as $a) {
                                                                $nomarl = $a['nombre_arl'];
                                                            }
                                                            echo mb_strtoupper($nomarl);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="div-mostrar bor-bottom-left col-md-2">
                                                        <label class="lbl-mostrar">CLASE DE RIESGO</label>
                                                        <div class="div-cont">
                                                            <?php
                                                            $riesgo = "NO SE HA REGISTRADO ARL";
                                                            foreach ($arl as $a) {
                                                                $riesgo = $a['riesgo'];
                                                            }
                                                            echo $riesgo;
                                                            ?></div>

                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">ESTADO</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($obj['estado'] == '1' ? 'Activo' : 'Inactivo') ?></div>
                                                    </div>
                                                    <div class="div-mostrar bor-bottom-right col-md-8">
                                                        <label class="lbl-mostrar">MAS DATOS</label>
                                                        <div class="div-cont">ADMINISTRADOR</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- parte-->
                                <div class="table-responsive">
                                    <div class="card">
                                        <div class="card-header card-header-detalles py-0 headings" id="headingTwo">
                                            <h5 class="mb-0">
                                                <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                    <div class="form-row">
                                                        <div class="div-icono">
                                                            <span class="fas fa-hospital fa-lg" style="color: #EC7063;"></span>
                                                        </div>
                                                        <div>
                                                            HISTORIAL EPSs
                                                        </div>
                                                    </div>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                                            <div class="card-body">
                                                <div class="input-group mb-3">
                                                    <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                        <div class="col-md-1 offset-md-11" title="Registrar EPS">
                                                            <button id="btnShowAddNovEps" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                                <i class="fas fa-plus fa-lg"></i>
                                                            </button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div id="divhidden" class="fondo-sm shadow p-3 mb-3 rounded oculto">
                                                    <form id="formAddEpsNovedad">
                                                        <input type="number" id="idEmpNovEps" name="idEmpNovEps" value="<?php echo $id ?>" hidden>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="slcEpsNovedad">EPS</label>
                                                                <select id="slcEpsNovedad" name="slcEpsNovedad" class="form-control py-0" aria-label="Default select example">
                                                                    <option selected value="0">--Selecionar EPS--</option>
                                                                    <?php
                                                                    foreach ($epsnov as $e) {
                                                                        echo '<option value="' . $e['id_eps'] . '">' . $e['nombre_eps'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="datFecAfilEpsNovedad">Afilición</label>
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control" id="datFecAfilEpsNovedad" name="datFecAfilEpsNovedad" value="<?php echo date('Y-m-d') ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="datFecRetEpsNovedad">Retiro</label>
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control" id="datFecRetEpsNovedad" name="datFecRetEpsNovedad" value="<?php echo date('Y') ?>-12-31">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <center>
                                                            <button class="btn btn-primary btn-sm" id="btnAddNovedadEps">Registrar</button>
                                                            <button class="btn btn-danger btn-sm" id="btnXNovedadEps">Cancelar</button>
                                                        </center>
                                                    </form>
                                                </div>
                                                <div>
                                                    <table id="tableEps" class="table table-striped table-bordered table-sm nowrap table-hover shadow" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombres</th>
                                                                <th>NIT</th>
                                                                <th>Fecha afiliación</th>
                                                                <th>Fecha retiro</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="modificarEpss">
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="divUpNovedadEPS" class="py-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="headingThree">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="far fa-hospital fa-lg" style="color: #F8C471;"></span>
                                                    </div>
                                                    <div>
                                                        HISTORIAL ARLs
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                    <div class="col-md-1 offset-md-11" title="Registrar ARL">
                                                        <button id="btnShowAddNovArl" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                            <i class="fas fa-plus fa-lg"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div id="divhiddenArl" class="fondo-sm shadow p-3 mb-3 rounded oculto">
                                                <form id="formAddArlNovedad">
                                                    <input type="number" id="idEmpNovArl" name="idEmpNovArl" value="<?php echo $id ?>" hidden>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-5">
                                                            <label for="slcArlNovedad">ARL</label>
                                                            <select id="slcArlNovedad" name="slcArlNovedad" class="form-control py-0" aria-label="Default select example">
                                                                <option selected value="0">--Selecionar ARL--</option>
                                                                <?php
                                                                foreach ($arlnov as $a) {
                                                                    echo '<option value="' . $a['id_arl'] . '">' . $a['nombre_arl'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="slcRiesLabNov">Riesgo laboral</label>
                                                            <select id="slcRiesLabNov" name="slcRiesLabNov" class="form-control py-0" aria-label="Default select example">
                                                                <option selected value="0">--Selecionar clase--</option>
                                                                <?php
                                                                foreach ($rlaboral as $r) {
                                                                    echo '<option value="' . $r['id_rlab'] . '">' . $r['clase'] . ' - ' . $r['riesgo'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="datFecAfilArlNovedad">Afilición</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecAfilArlNovedad" name="datFecAfilArlNovedad" value="<?php echo date('Y-m-d') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="datFecRetArlNovedad">Retiro</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecRetArlNovedad" name="datFecRetArlNovedad" value="<?php echo date('Y') ?>-12-31">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <center>
                                                        <button class="btn btn-primary btn-sm" id="btnAddNovedadArl">Registrar</button>
                                                        <button class="btn btn-danger btn-sm" id="btnXNovedadArl">Cancelar</button>
                                                    </center>
                                                </form>
                                            </div>
                                            <table id="tableArl" class="table table-striped table-bordered table-sm display nowrap table-hover shadow" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>NIT</th>
                                                        <th>Clase riesgo</th>
                                                        <th>Fecha afiliación</th>
                                                        <th>Fecha retiro</th>
                                                        <th>Acciones</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="modificarArls">
                                                </tbody>
                                            </table>
                                            <div id="divUpNovedadARL" class="py-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="historyafp">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="fas fa-gopuram fa-lg" style="color: #E59866;"></span>
                                                    </div>
                                                    <div>
                                                        HISTORIAL AFPs
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="historyafp">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                    <div class="col-md-1 offset-md-11" title="Registrar AFP">
                                                        <button id="btnShowAddNovAfp" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                            <i class="fas fa-plus fa-lg"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div id="divhiddenAfp" class="fondo-sm shadow p-3 mb-3 rounded oculto">
                                                <form id="formAddAfpNovedad">
                                                    <input type="number" id="idEmpNovAfp" name="idEmpNovAfp" value="<?php echo $id ?>" hidden>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="slcAfpNovedad">AFP</label>
                                                            <select id="slcAfpNovedad" name="slcAfpNovedad" class="form-control py-0" aria-label="Default select example">
                                                                <option selected value="0">--Selecionar AFP--</option>
                                                                <?php
                                                                foreach ($afp as $a) {
                                                                    echo '<option value="' . $a['id_afp'] . '">' . $a['nombre_afp'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecAfilAfpNovedad">Afilición</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecAfilAfpNovedad" name="datFecAfilAfpNovedad" value="<?php echo date('Y-m-d') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecRetAfpNovedad">Retiro</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecRetAfpNovedad" name="datFecRetAfpNovedad" value="<?php echo date('Y') ?>-12-31">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <center>
                                                        <button class="btn btn-primary btn-sm" id="btnAddNovedadAfp">Registrar</button>
                                                        <button class="btn btn-danger btn-sm" id="btnXNovedadAfp">Cancelar</button>
                                                    </center>
                                                </form>
                                            </div>
                                            <table id="tableAfp" class="table table-striped table-bordered table-sm display nowrap table-hover shadow" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>NIT</th>
                                                        <th>Fecha afiliación</th>
                                                        <th>Fecha retiro</th>
                                                        <th>Acciones</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="modificarAfps" class="py-1">
                                                </tbody>
                                            </table>
                                            <div id="divUpNovedadAFP">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="libranzas">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="fas fa-file-invoice-dollar fa-lg" style="color: #28B463;"></span>
                                                    </div>
                                                    <div>
                                                        LIBRANZAS
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="libranzas">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                    <div class="col-md-1 offset-md-11" title="Registrar Libranza">
                                                        <button id="btnShowAddLibranza" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                            <i class="fas fa-plus fa-lg"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div id="divhiddenLibranza" class="shadow p-3 mb-3 rounded fondo-sm oculto">
                                                <form id="formAddLibranza">
                                                    <input type="number" id="idEmpLibranza" name="idEmpLibranza" value="<?php echo $id ?>" hidden>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="slcEntidad">Entidad financiera</label>
                                                            <select id="slcEntidad" name="slcEntidad" class="form-control py-0" aria-label="Default select example">
                                                                <option selected value="0">--Selecionar Entidad--</option>
                                                                <?php
                                                                foreach ($banco as $b) {
                                                                    echo '<option value="' . $b['id_banco'] . '">' . $b['nom_banco'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <div id="eslcEntidad" class="invalid-tooltip">
                                                                <?php echo 'Diligenciar este campo' ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="numValTotal">Valor Total</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="numValTotal" name="numValTotal" min="1" placeholder="Total libranza">
                                                            </div>
                                                            <div id="enumValTotal" class="invalid-tooltip">
                                                                <?php echo 'Diligenciar este campo' ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="numTotCuotasLib">Cuotas Totales</label>
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" id="numTotCuotasLib" name="numTotCuotasLib" min="1" placeholder="Cant. de cuotas">
                                                            </div>
                                                            <div id="enumTotCuotasLib" class="invalid-tooltip">
                                                                <?php echo 'Debe ser mayor a 0' ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="txtDescripLib">Descripción</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="txtDescripLib" name="txtDescripLib" placeholder="Descripción de la libranza">
                                                                <div id="etxtDescripLib" class="invalid-tooltip">
                                                                    <?php echo 'Campo Obligatorio' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label for="txtValLibMes">Valor mes</label>
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" id="txtValLibMes" name="txtValLibMes" placeholder="Cuota mensual">
                                                            </div>
                                                            <div id="etxtValLibMes" class="invalid-tooltip">
                                                                <?php echo 'Campo Obligatorio' ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="txtPorcLibMes">Porcentaje %</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="txtPorcLibMes" name="txtPorcLibMes" placeholder="Ej: 10.5">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecInicioLib">Fecha Inicio</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecInicioLib" name="datFecInicioLib" value="<?php echo date('Y-m-d') ?>">
                                                                <div id="edatFecInicioLib" class="invalid-tooltip">
                                                                    <?php echo 'Inicio debe ser menor' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecFinLib">Fecha Fin</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecFinLib" name="datFecFinLib" value="<?php echo date('Y') ?>-12-31">
                                                                <div id="edatFecFinLib" class="invalid-tooltip">
                                                                    <?php echo 'Fin debe ser mayor' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <center>
                                                        <button class="btn btn-primary btn-sm" id="btnAddLibranza">Registrar</button>
                                                        <button class="btn btn-danger btn-sm" id="btnXAddLibranza">Cancelar</button>
                                                    </center>
                                                </form>
                                            </div>
                                            <table id="tableLibranza" class="table table-striped table-bordered table-sm display nowrap table-hover shadow" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Entidad</th>
                                                        <th>Valor Total</th>
                                                        <th>Cuotas</th>
                                                        <th>Val. Mes</th>
                                                        <th>Porcentaje</th>
                                                        <th>Valor pagado</th>
                                                        <th>Cuotas pagadas</th>
                                                        <th>Fecha Inicio</th>
                                                        <th>Fecha Final</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="modificarLibranzas">
                                                </tbody>
                                            </table>
                                            <div id="divUpNovLibranza" class="py-1"></div>
                                            <div id="divShowResLibranza" class="py-1"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="embargos">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="fas fa-coins fa-lg" style="color: #F1C40F;"></span>
                                                    </div>
                                                    <div>
                                                        EMBARGOS
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseSix" class="collapse" aria-labelledby="embargo">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                    <div class="col-md-1 offset-md-11" title="Registrar Embargo">
                                                        <button id="btnShowAddEmbargo" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                            <i class="fas fa-plus fa-lg"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div id="divhiddenEmbargo" class="shadow p-3 mb-3 rounded fondo-sm oculto">
                                                <form id="formAddEmbargo">
                                                    <input type="number" id="idEmpEmbargo" name="idEmpEmbargo" value="<?php echo $id ?>" hidden>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="slcJuzgado">Juzgado</label>
                                                            <select id="slcJuzgado" name="slcJuzgado" class="form-control py-0" aria-label="Default select example">
                                                                <option selected value="0">--Selecionar Juzgado--</option>
                                                                <?php
                                                                foreach ($juzgado as $j) {
                                                                    echo '<option value="' . $j['id_juzgado'] . '">' . $j['nom_juzgado'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <div id="eslcJuzgado" class="invalid-tooltip">
                                                                <?php echo 'Diligenciar este campo' ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="numTipoEmbargo">Tipo</label>
                                                            <select id="slcTipoEmbargo" name="slcTipoEmbargo" class="form-control py-0" aria-label="Default select example">
                                                                <option selected value="0">--Selecionar tipo--</option>
                                                                <?php
                                                                foreach ($tipoembargo as $tpe) {
                                                                    echo '<option value="' . 'te=' . $tpe['id_tipo_emb'] . '&ie=' . $id . '">' . mb_strtoupper($tpe['tipo']) . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <div id="eslcTipoEmbargo" class="invalid-tooltip">
                                                                <?php echo 'Diligenciar este campo' ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="numDctoAprox">Dcto. Máximo</label>
                                                            <div class="form-group">
                                                                <div class="form-control" id="divDctoAprox">
                                                                    0
                                                                    <input type="number" id="numDctoAprox" name="numDctoAprox" value="0" hidden>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="numTotEmbargo">Total Embargo</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="numTotEmbargo" name="numTotEmbargo" min="1" placeholder="Valor total">
                                                            </div>
                                                            <div id="enumTotEmbargo" class="invalid-tooltip">
                                                                <?php echo 'Campo obligatorio' ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label for="txtValEmbargoMes"> Valor Embargo Mensual</label>
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" id="txtValEmbargoMes" name="txtValEmbargoMes" min="1" placeholder="Valor mes">
                                                            </div>
                                                            <div id="etxtValEmbargoMes" class="invalid-tooltip">
                                                                <?php echo 'Campo obligatorio' ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="txtPorcEmbMes"> % Embargo Mes</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="txtPorcEmbMes" name="txtPorcEmbMes" placeholder="Ej: 5.2">
                                                            </div>
                                                            <div id="enumValEmbargoMes" class="invalid-tooltip">
                                                                <?php echo 'Campo obligatorio' ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecInicioEmb">Fecha Inicio</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecInicioEmb" name="datFecInicioEmb" value="<?php echo date('Y-m-d') ?>">
                                                                <div id="edatFecInicioEmb" class="invalid-tooltip">
                                                                    <?php echo 'Inicio debe ser menor' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecFinEmb">Fecha Fin</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecFinEmb" name="datFecFinEmb" value="<?php echo date('Y') ?>-12-31">
                                                                <div id="edatFecFinEmb" class="invalid-tooltip">
                                                                    <?php echo 'Fin debe ser mayor' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="txtEstadoEmbargo" value="1" hidden>
                                                    <center>
                                                        <button class="btn btn-primary btn-sm" id="btnAddEmbargo">Registrar</button>
                                                        <button class="btn btn-danger btn-sm" id="btnXAddEmbargo">Cancelar</button>
                                                    </center>
                                                </form>
                                            </div>
                                            <table id="tableEmbargo" class="table table-striped table-bordered table-sm display nowrap table-hover shadow" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Juzgado</th>
                                                        <th>Valor total</th>
                                                        <th>Porcentaje</th>
                                                        <th>Valor mes</th>
                                                        <th>Valor pagado</th>
                                                        <th>Fecha Inicio</th>
                                                        <th>Fecha Fin</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="modificarEmbargos">
                                                </tbody>
                                            </table>
                                            <div id="divUpNovEmbargo" class="py-1"></div>
                                            <div id="divShowResEmbargo" class="py-1"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="sindicatos">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="fas fa-users fa-lg" style="color: #95A5A6;"></span>
                                                    </div>
                                                    <div>
                                                        SINDICATOS
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseSeven" class="collapse" aria-labelledby="sindicato">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                    <div class="col-md-1 offset-md-11" title="Registrar Sindicato">
                                                        <button id="btnShowAddSindicato" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                            <i class="fas fa-plus fa-lg"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div id="divhiddenSindicato" class="shadow p-3 mb-3 rounded fondo-sm oculto">
                                                <form id="formAddSindicato">
                                                    <input type="number" id="idEmpSindicato" name="idEmpSindicato" value="<?php echo $id ?>" hidden>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="slcSindicato">Sindicato</label>
                                                            <select id="slcSindicato" name="slcSindicato" class="form-control py-0" aria-label="Default select example">
                                                                <option selected value="0">--Selecionar Sindicato--</option>
                                                                <?php
                                                                foreach ($listsind as $ls) {
                                                                    echo '<option value="' . $ls['id_sindicato'] . '">' . mb_strtoupper($ls['nom_sindicato']) . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <div id="eslcSindicato" class="invalid-tooltip">
                                                                <?php echo 'Diligenciar este campo' ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="txtPorcentajeSind">Porcentaje %</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="txtPorcentajeSind" name="txtPorcentajeSind" placeholder="Ej: 10.5">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecInicioSind">Fecha Inicio</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecInicioSind" name="datFecInicioSind" value="<?php echo date('Y-m-d') ?>">
                                                                <div id="edatFecInicioSind" class="invalid-tooltip">
                                                                    <?php echo 'Inicio debe ser menor' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecFinSind">Fecha Fin</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecFinSind" name="datFecFinSind">
                                                                <div id="edatFecFinSind" class="invalid-tooltip">
                                                                    <?php echo 'Fin debe ser mayor' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <center>
                                                        <button class="btn btn-primary btn-sm" id="btnAddSindicato">Registrar</button>
                                                        <button class="btn btn-danger btn-sm" id="btnXAddSindicato">Cancelar</button>
                                                    </center>
                                                </form>
                                            </div>
                                            <div>
                                                <table id="tableSindicato" class="table table-striped table-bordered table-sm display nowrap table-hover shadow" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Sindicato</th>
                                                            <th>Porcentaje</th>
                                                            <th>Cantidad Aportes</th>
                                                            <th>Total Aportes</th>
                                                            <th>Fecha Inicio</th>
                                                            <th>Fecha Fin</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="modificarSindicatos">
                                                    </tbody>
                                                </table>
                                                <div id="divUpNovSindicato" class="py-1"></div>
                                                <div id="divShowResSindicato" class="py-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="incapacidades">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="fas fa-procedures fa-lg" style="color: #1ABC9C;"></span>
                                                    </div>
                                                    <div>
                                                        INCAPACIDADES
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseEight" class="collapse" aria-labelledby="incapacidad">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                    <div class="col-md-1 offset-md-11" title="Registrar Incapacidad">
                                                        <button id="btnShowAddIncapacidad" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                            <i class="fas fa-plus fa-lg"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div id="divhiddenIncapacidad" class="shadow p-3 mb-3 rounded fondo-sm oculto">
                                                <form id="formAddIncapacidad">
                                                    <input type="number" id="idEmpIncapacidad" name="idEmpIncapacidad" value="<?php echo $id ?>" hidden>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label for="slcTipIncapacidad">Tipo de Incapacidad</label>
                                                            <select id="slcTipIncapacidad" name="slcTipIncapacidad" class="form-control py-0" aria-label="Default select example">
                                                                <option selected value="0">--Selecionar Tipo--</option>
                                                                <?php
                                                                foreach ($tipincap as $ti) {
                                                                    echo '<option value="' . $ti['id_tipo'] . '">' . mb_strtoupper($ti['tipo']) . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <div id="eslcTipIncapacidad" class="invalid-tooltip">
                                                                <?php echo 'Diligenciar este campo' ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecInicioIncap">Fecha Inicio</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecInicioIncap" name="datFecInicioIncap" value="<?php echo date('Y-m-d') ?>">
                                                                <div id="edatFecInicioIncap" class="invalid-tooltip">
                                                                    <?php echo 'Inicio debe ser menor' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="datFecFinIncap">Fecha Fin</label>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" id="datFecFinIncap" name="datFecFinIncap" value="<?php $fecha = date('Y-m-d');
                                                                                                                                                            $tomo = strtotime("+ 1 day", strtotime($fecha));
                                                                                                                                                            $mañana = date('Y-m-d', $tomo);
                                                                                                                                                            echo $mañana;
                                                                                                                                                            ?>">
                                                                <div id="edatFecFinIncap" class="invalid-tooltip">
                                                                    <?php echo 'Fin debe ser mayor' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Cantidad Días</label>
                                                            <div class="form-control" id="divCantDiasIncap">
                                                                2
                                                                <input type="number" id="numCantDiasIncap" name="numCantDiasIncap" value="2" hidden>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <center>
                                                        <button class="btn btn-primary btn-sm" id="btnAddIncapacidad">Registrar</button>
                                                        <button class="btn btn-danger btn-sm" id="btnXAddIncapacidad">Cancelar</button>
                                                    </center>
                                                </form>
                                            </div>
                                            <div>
                                                <table id="tableIncapacidad" class="table table-striped table-bordered table-sm display table-hover shadow" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Tipo Incapacidad</th>
                                                            <th>Fecha Inicio</th>
                                                            <th>Fecha Fin</th>
                                                            <th>Días</th>
                                                            <th>Valor liquidado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="modificarIncapacidades">
                                                    </tbody>
                                                </table>
                                                <div id="divUpNovIncapacidad" class="py-1"></div>
                                                <div id="divShowResIncapacidad" class="py-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="otros">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="fas fa-angle-double-right fa-lg" style="color: #8E44AD;"></span>
                                                    </div>
                                                    <div>
                                                        OTROS: VACIONES,LICENCIAS
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseNine" class="collapse" aria-labelledby="otros">
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-header  card-header-detalles py-0 headings" id="vacaciones">
                                                    <h5 class="mb-0">
                                                        <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseVac" aria-expanded="false" aria-controls="collapseVac">
                                                            <div class="form-row">
                                                                <div class="div-icono">
                                                                    <span class="fas fa-umbrella-beach fa-lg" style="color: #F4D03F;"></span>
                                                                </div>
                                                                <div>
                                                                    VACACIONES
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseVac" class="collapse" aria-labelledby="vacaciones">
                                                    <div class="card-body">
                                                        <div class="input-group mb-3">
                                                            <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                                <div class="col-md-1 offset-md-11" title="Registrar Vacaciones">
                                                                    <button id="btnShowAddVacacion" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                                        <i class="fas fa-plus fa-lg"></i>
                                                                    </button>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div id="divhiddenVacaciones" class="shadow p-3 mb-3 rounded fondo-sm oculto">
                                                            <form id="formAddVacaciones">
                                                                <input type="number" id="idEmpVacacion" name="idEmpVacacion" value="<?php echo $id ?>" hidden>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-2">
                                                                        <label for="slcVacAnticip">Anticipadas</label>
                                                                        <div class="form-group">
                                                                            <select id="slcVacAnticip" name="slcVacAnticip" class="form-control py-0" aria-label="Default select example">
                                                                                <option selected value="0">--Selecionar--</option>
                                                                                <option value="1">Si</option>
                                                                                <option value="2">No</option>
                                                                            </select>
                                                                            <div id="eslcVacAnticip" class="invalid-tooltip">
                                                                                <?php echo 'Selecionar una opción' ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="datFecInicioVac">Fecha Inicio</label>
                                                                        <div class="form-group">
                                                                            <input type="date" class="form-control" id="datFecInicioVac" name="datFecInicioVac" value="<?php echo date('Y-m-d') ?>">
                                                                            <div id="edatFecInicioVac" class="invalid-tooltip">
                                                                                <?php echo 'Inicio debe ser menor' ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="datFecFinVac">Fecha Fin</label>
                                                                        <div class="form-group">
                                                                            <input type="date" class="form-control" id="datFecFinVac" name="datFecFinVac">
                                                                            <div id="edatFecFinVac" class="invalid-tooltip">
                                                                                <?php echo 'Fin debe ser mayor' ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label>Días inactivo</label>
                                                                        <div class="form-control" id="divCantDiasVac">
                                                                            0
                                                                            <input type="number" id="numCantDiasVac" name="numCantDiasVac" value="0" hidden>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label>Días hábiles</label>
                                                                        <input type="number" class="form-control" id="numCantDiasHabVac" name="numCantDiasHabVac" value="0">
                                                                        <div id="enumCantDiasHabVac" class="invalid-tooltip">
                                                                            <?php echo 'Debe ser mayor a 0 y menor o igual a Dias inactivo' ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <center>
                                                                    <button class="btn btn-primary btn-sm" id="btnAddVacacion">Registrar</button>
                                                                    <button class="btn btn-danger btn-sm" id="btnXAddVacacion">Cancelar</button>
                                                                </center>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <table id="tableVacaciones" class="table table-striped table-bordered table-sm display table-hover shadow" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Anticipada</th>
                                                                        <th>Fecha Inicio</th>
                                                                        <th>Fecha Fin</th>
                                                                        <th>Días Inactivo</th>
                                                                        <th>Dias hábiles</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="modificarVacaciones">
                                                                </tbody>
                                                            </table>
                                                            <div id="divUpNovVacacion" class="py-1"></div>
                                                            <div id="divShowResVacacion" class="py-1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--parte-->
                                            <div class="card">
                                                <div class="card-header card-header-detalles py-0 headings" id="Licencia">
                                                    <h5 class="mb-0">
                                                        <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseLic" aria-expanded="false" aria-controls="collapseLic">
                                                            <div class="form-row">
                                                                <div class="div-icono">
                                                                    <span class="fas fa-baby fa-lg" style="color: #2980B9;"></span>
                                                                </div>
                                                                <div>
                                                                    LICENCIAS
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseLic" class="collapse" aria-labelledby="licencia">
                                                    <div class="card-body">
                                                        <div class="input-group mb-3">
                                                            <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                                <div class="col-md-1 offset-md-11" title="Registrar Licencia">
                                                                    <button id="btnShowAddLicencia" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                                        <i class="fas fa-plus fa-lg"></i>
                                                                    </button>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div id="divhiddenLicencia" class="shadow p-3 mb-3 rounded fondo-sm oculto">
                                                            <form id="formAddLicencia">
                                                                <input type="number" id="idEmpLicencia" name="idEmpLicencia" value="<?php echo $id ?>" hidden>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-2">
                                                                        <label>Tipo</label>
                                                                        <div class="form-control" id="divTipLic">
                                                                            <?php if ($obj['genero'] === 'F') {
                                                                                echo  'Materna';
                                                                                $tipl = '1';
                                                                            } else {
                                                                                echo 'Paterna';
                                                                                $tipl = '0';
                                                                            } ?>
                                                                            <input type="txt" id="txtTipoLic" name="txtTipoLic" value="<?php echo $tipl ?>" hidden>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="datFecInicioLic">Fecha Inicio</label>
                                                                        <div class="form-group">
                                                                            <input type="date" class="form-control" id="datFecInicioLic" name="datFecInicioLic" value="<?php echo date('Y-m-d') ?>">
                                                                            <div id="edatFecInicioLic" class="invalid-tooltip">
                                                                                <?php echo 'Inicio debe ser menor' ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="datFecFinLic">Fecha Fin</label>
                                                                        <div class="form-group">
                                                                            <input type="date" class="form-control" id="datFecFinLic" name="datFecFinLic">
                                                                            <div id="edatFecFinLic" class="invalid-tooltip">
                                                                                <?php echo 'Fin debe ser mayor' ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label>Días inactivo</label>
                                                                        <div class="form-control" id="divCantDiasLic">
                                                                            0
                                                                            <input type="number" id="numCantDiasLic" name="numCantDiasLic" value="0" hidden>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label>Días hábiles</label>
                                                                        <input type="number" class="form-control" id="numCantDiasHabLic" name="numCantDiasHabLic" value="0">
                                                                        <div id="enumCantDiasHabLic" class="invalid-tooltip">
                                                                            <?php echo 'Debe ser mayor a 0 y menor o igual a Dias inactivo' ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <center>
                                                                    <button class="btn btn-primary btn-sm" id="btnAddLicencia">Registrar</button>
                                                                    <button class="btn btn-danger btn-sm" id="btnXAddLicencia">Cancelar</button>
                                                                </center>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <table id="tableLicencia" class="table table-striped table-bordered table-sm display table-hover table-hover shadow" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Fecha Inicio</th>
                                                                        <th>Fecha Fin</th>
                                                                        <th>Días Inactivo</th>
                                                                        <th>Dias hábiles</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="modificarLicencias">
                                                                </tbody>
                                                            </table>
                                                            <div id="divUpNovLicencia" class="py-1"></div>
                                                            <div id="divShowResLicencia" class="py-1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center pt-4">
                                <a type="button" class="btn btn-danger" style="width: 6rem;" href="listempleados.php"> Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../footer.php' ?>
        </div>
        <!-- Modal -->
        <input type="text" id="delrow" value="0" hidden>
        <div class="modal fade" id="divModalConfDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeaderConfir">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-triangle fa-lg" style="color: #E67E22;"></i>
                            ¡Confirmar!
                        </h5>
                    </div>
                    <div class="modal-body" id="divMsgConfdel">

                    </div>
                    <div class="modal-footer" id="divBtnsModalDel"></div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="divModalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
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
                        <a type="button" id="btnXdone" class="btn btn-primary btn-sm" data-dismiss="modal"> Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php include '../../scripts.php' ?>
</body>

</html>